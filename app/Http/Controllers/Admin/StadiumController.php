<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Database\QueryException;

use App\Models\Country;
use App\Models\Stadium;
use Yajra\DataTables\Facades\DataTables;

class StadiumController extends Controller {
  public function index (Request $request) {
    return view('admin.stadium.index');
  }

  public function create (Request $request) {
    $data = [
      "countries" => Country::get(),
      "default_city" => $request->has("city_id") ? $request->city_id : null
    ];

    return view('admin.stadium.form', $data);
  }

  public function update ($id) {
    $data = [
      "countries" => Country::get(),
      "data" => Stadium::find($id)
    ];
    return view('admin.stadium.form', $data);
  }

  public function detail ($id) {
    $types = Stadium::find($id);
    $data = [ "data" => $types ];

    return view('admin.stadium.detail', $data);
  }

  public function store (Request $request) {
    $validation = [
      'name' => 'required|max:255',
      'country_id' => 'required|uuid',
      'county_id' => 'nullable|uuid',
      'municipality_id' => 'required|uuid',
      'nickname' => 'nullable|string',
      'address' => 'nullable|string',
      'owner' => 'nullable|string',
      'capacity' => 'nullable|string',
      'surface' => 'nullable|string',
      'logo' => 'mimes:jpg,png',
    ];

    $validated = $request->validate($validation);

    $isCreate = $request->id == null ? true : false;

    $stadium = null;
    if ($isCreate) {
      $stadium = new Stadium;
      $stadium->id = Str::uuid();
    } else {
      $stadium = Stadium::find($request->id);

      if ($request->hasFile('image')) {
        $oldPath = storage_path('app/public/stadium/image/').$stadium->image;
        if (file_exists($oldPath && is_file($oldPath))) {
          unlink($oldPath);
        }
      }
    }

    // Upload Image
    if ($request->hasFile('image')) {
      if(!Storage::exists("/public/stadium/image")) Storage::makeDirectory("/public/stadium/image");
      $file = $request->file('image');

      $filenameWithExt = $request->file('image')->getClientOriginalName();
      $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
      $extension = $request->file('image')->getClientOriginalExtension();

      $filename = $filename.'_'.time().'.'.$extension;
      $path = storage_path('app/public/stadium/image/').$filename;
      $file->storeAs('public/stadium/image', $filename);

      // Resize image
      $img = Image::make($file->getRealPath())
        ->resize(512, 512, function ($constraint) {
          $constraint->aspectRatio();
        })
        ->save($path, 80);
    }

    try {
      $stadium->name = $request->name;
      $stadium->country_id = Country::first()->id;
      $stadium->county_id = $request->county_id;
      $stadium->municipality_id = $request->municipality_id;
      $stadium->nickname = $request->nickname;
      $stadium->address = $request->address;
      $stadium->owner = $request->owner;
      $stadium->capacity = $request->capacity;
      $stadium->surface = $request->surface;
      if ($request->hasFile('image')) $stadium->image = $filename;
      $stadium->save();

      return redirect()->route('admin.masterdata.stadium.index');
    } catch (QueryException $exception) {
      if ($request->hasFile('image')) unlink($path);
      
      return redirect()->back()
        ->withErrors($exception->getMessage());
    }
  }

  public function delete (Request $request) {
    $validated = $request->validate([
      'id' => 'required|uuid'
    ]);

    try {
      $type = Stadium::find($request->id);
      $type->delete();

      $request->session()->flash('message', "{$type->name} successfully deleted");
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

  public function listDatatable(Request $request) {
    $data = Stadium::with(["country", "county", "municipality"])
      ->get();

    return Datatables::of($data)->make(true);
  }

  public function list (Request $request) {
    $showAll = $request->has('showall') ? (boolean) $request->showall : false;
    $search = $request->has('search') ? $request->search : null;

    $page = $request->has('page') ? $request->page : 1;
    if (empty($page)) $page = 1; 
    $limit = 10;

    $model = Stadium::with(['county'])
      ->when($search != null, function ($query) use ($search) {
        $query->where('name', 'LIKE', '%'.$search.'%');
      })
      ->get();

    $total = clone($model);
    $total = $total->count();

    $stadiums = $model->when(!$showAll, function ($query) use ($limit, $page) {
      $query->take($limit)->skip(($page - 1) * $limit);
    })->get();

    return response()->json([
      "status" => true,
      "message" => null,
      "data" => [
        "list" => $stadiums,
        "pagination" => [
          "total" => $total,
          "page" => !$showAll ? (int) $page : -1,
          "limit" => !$showAll ? $limit : -1,
          "total_page" => !$showAll ? ceil($total / $limit) : 1,
          "search" => $search
        ]
      ]
    ]);
  }
}
