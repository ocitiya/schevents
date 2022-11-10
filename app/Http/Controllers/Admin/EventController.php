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
use Exception;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller {
	public function index (Request $request) {
		return view('admin.event.index');
	}

	public function create (Request $request) {
		return view('admin.event.form');
	}

	public function update (Request $request, $id) {
		$event = Event::find($id);
		$data = [
			"data" => $event
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
      'start_date' => 'required|date',
      'end_date' => 'nullable|date',
      'description' => 'nullable|string|max:255',
      'link' => 'required|url',
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
			$event->start_date = $request->start_date;
			$event->end_date = $request->end_date;
			$event->description = $request->description;
			if ($request->hasFile('image')) $event->image = $filename;
		  $event->link = $request->link;
			$event->save();

			return redirect()
				->route("admin.masterdata.event.index")
				->with('success', 'Data successfully saved');

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

		$page = $request->has('page') ? $request->page : 1;
		if (empty($page)) $page = 1; 
		$limit = 10;

		$model = Event::when($search != null, function ($query) use ($search) {
			$query->where('name', 'LIKE', '%'.$search.'%');
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
		$data = Event::get();
		
		return Datatables::of($data)->make(true);
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
}
