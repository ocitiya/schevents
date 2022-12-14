<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Database\QueryException;
use Yajra\DataTables\Datatables;

use App\Models\Event;
use App\Models\OfferCampaign;
use App\Models\OfferChannel;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class EventController extends Controller {
  protected $now;
  public function __construct(Request $request) {
    if ($request->header('Timezone') != null) {
      $this->now = Carbon::now($request->header('Timezone'))->setTimezone('UTC');
    } else {
      $this->now = Carbon::now();
    }
  }

  public function index (Request $request) {
    return view('admin.event.index');
  }

  public function create (Request $request) {
    $data = [
      "campaign" => OfferCampaign::get(),
      "channels" => OfferChannel::get()
    ];

    return view('admin.event.form', $data);
  }

  public function update (Request $request, $id) {
    $data = [
      "data" => Event::find($id),
      "campaign" => OfferCampaign::get(),
      "channels" => OfferChannel::get()
    ];

    return view('admin.event.form', $data);
  }

  public function detail ($id) {
    $event = Event::find($id);
    $data = [ "data" => $event ];

    return view('admin.event.detail', $data);
  }

  public function store (Request $request) {
    $isCreate = $request->id == null ? true : false;
    $validation = [
      'name' => 'required|string|max:255',
      'campaign_id' => 'required|int',
      'banner_id' => 'required|int',
      'channel_id' => 'required|int',
      'start_date' => 'required|date',
      'end_date' => 'nullable|date',
      'description' => 'nullable|string|max:255',
      'image' => 'nullable|mimes:jpg,png',
    ];

    $validated = $request->validate($validation);

    // Upload Image
    if ($request->hasFile('image')) {
      if(!Storage::exists("/public/event/image")) Storage::makeDirectory("/public/event/image");
      $file = $request->file('image');

      $filenameWithExt = $request->file('image')->getClientOriginalName();
      $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
      $extension = $request->file('image')->getClientOriginalExtension();

      $filename = $filename.'_'.time().'.'.$extension;
      $path = storage_path('app/public/event/image/').$filename;
      $file->storeAs('public/event/image', $filename);

      // Resize image
      $img = Image::make($file->getRealPath())
        ->resize(1024, 1024, function ($constraint) {
          $constraint->aspectRatio();
        })
        ->save($path, 80);
    }
    
    $event = null;
    if ($isCreate) {
      $event = new Event;
      $event->created_by = Auth::id();
    } else {
      $event = Event::find($request->id);
      $event->updated_by = Auth::id();

      if ($request->hasFile('image')) {
        $oldPath = storage_path('app/public/event/image/').$event->image;
        if (file_exists($oldPath) && !is_dir($oldPath)) {
          unlink($oldPath);
        }
      }
    }
    
    try {
      $event->name = ucwords($request->name);
      $event->campaign_id = $request->campaign_id;
      $event->banner_id = $request->banner_id;
      $event->channel_id = $request->channel_id;
      $event->start_date = $request->start_date;
      $event->end_date = empty($request->end_date) ? $request->start_date : $request->end_date;
      $event->description = $request->description;
      if ($request->hasFile('image')) $event->image = $filename;
      $event->save();

      return redirect()
        ->route("admin.masterdata.event.index")
        ->with('success', 'Event {$event->name} berhasil disimpan');

    } catch (QueryException $exception) {
      if ($request->hasFile('image')) {
        unlink($path);
      }
      return redirect()->back()
        ->withErrors($exception->getMessage());
    }
  }

  public function delete (Request $request) {
    try {
      $event = Event::find($request->id);

      if (!empty($event->image)) {
        $oldPath = storage_path('app/public/event/image/').$event->image;
        if (file_exists($oldPath) && !is_dir($oldPath)) {
          unlink($oldPath);
        }
      }

      $event->delete();

      session()->flash('message', "{$event->name} successfully deleted");
      return response()->json([
        "status" => true,
        "message" => null
      ]);
    } catch (Exception $e) {
      return response()->json([
        "status" => false,
        "message" => $e->getMessage()
      ]);
    }
  }

  public function list (Request $request) {
    $search = $request->has('search') ? $request->search : null;
    $showAll = $request->has('showall') ? (boolean) $request->showall : false;
    $name = $request->has('name') ? $request->name : null;
    $date = $request->has('date') ? $request->date : null;
    // $showAll = $request->has('showall') ? (boolean) $request->showall : false;

    $page = $request->has('page') ? $request->page : 1;
    if (empty($page)) $page = 1; 
    $limit = $request->has('limit') ? $request->limit : 10;

    $type = $request->has('type') ? $request->type : "all";
    $type == "null" ? $request->type : "all";

    $model = Event::select("*");
    $model = $this->_scheduleType($model, $type);
    $model = $model->when(!empty($search), function ($query) use ($search) {
      $query->where('name', 'LIKE', '%'.$search.'%');
    })->when(!empty($name), function ($query) use ($name) {
      $query->where('name', 'LIKE', '%'.$name.'%');
    })->when(!empty($date), function ($query) use ($date) {
      $query
        ->whereDate("start_date", "<=", $date)
        ->whereDate("end_date", ">=", $date);
    });

    $event = clone($model)->when(!$showAll, function ($query) use ($limit, $page) {
      $query->take($limit)->skip(($page - 1) * $limit);
    })->get();

    $total = $model->count();
    
    return response()->json([
      "status" => true,
      "message" => null,
      "data" => [
        "list" => $event,
        "pagination" => [
          "total" => $total,
          "search" => $search,
          "page" => !$showAll ? (int) $page : 1,
          "limit" => !$showAll ? $limit : -1,
          "total_page" => !$showAll ? ceil($total / $limit) : 1
        ]
      ]
    ]);
  }

  public function listDatatable(Request $request) {
    $state = $request->state;

    $model = Event::when(Session::get("role") == "user", function ($q) {
      $q->where("created_by", Auth::id());
    })
    ->with(["created_name", "updated_name", "campaign", "banner", "channel"]);

    $model = $this->_scheduleType($model, $state);
    $model = $model->get();
    
    return Datatables::of($model)->make(true);
  }

  public function validateName (Request $request) {
    $data = Event::where('name', $request->name)->first();

    if ($data) {
      return response()->json([
        "status" => true,
        "message" => null,
        "data" => false
      ]);
    } else {
      return response()->json([
        "status" => true,
        "message" => null,
        "data" => true
      ]);
    }
  }

  private function _scheduleType($model, $type) {
    switch ($type) {
      case "all":
        return $model;

      case "live":
        $date = clone($this->now);

        $model->whereDate("start_date", "<=", $date);
        $model->whereDate("end_date", ">=", $date);

        return $model;

      case "upcoming":
        $date = clone($this->now);

        $model->whereDate("start_date", ">", $date);
        return $model;

      case "closed":
        $date = clone($this->now);

        $model->whereDate("end_date", "<", $date);
        return $model;

      default:
        return $model;
    }
  }
  
  public function deleteAll (Request $request) {
    $validated = $request->validate([
      'state' => 'required|in:closed'
    ]);

    try {
      $stateText = null;
      if ($request->state == 'closed') {
        $stateText = 'Sudah Selesai';
      }
      
      $model = Event::select("*");
      $model = $this->_scheduleType($model, $request->state);

      $model->delete();

      session()->flash('message', "Jadwal event {$stateText} berhasil dihpapus");
      return response()->json([
        "status" => true,
        "message" => null
      ]);
    } catch (QueryException $exception) {
      return response()->json([
        "status" => false,
        "message" => $exception->getMessage()
      ]);
    }
  }
}
