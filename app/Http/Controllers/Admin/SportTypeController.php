<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

use DataTables;

use App\Models\SportType;

class SportTypeController extends Controller {
	public function index (Request $request) {
		return view('admin.sport_type.index');
	}

	public function create () {
		return view('admin.sport_type.form');
	}

	public function update ($id) {
		$types = SportType::find($id);

		$data = [ "data" => $types ];
		return view('admin.sport_type.form', $data);
	}

	public function detail ($id) {
		$types = SportType::find($id);
		$data = [ "data" => $types ];

		return view('admin.sport_type.detail', $data);
	}

	public function store (Request $request) {
		$isCreate = $request->id == null ? true : false;
		$validation = [
			'name' => 'required|max:255',
			'stream_url' => 'required|url'
		];
		
		if ($isCreate) {
			array_push($validation, [
				'image' => 'required|mimes:jpg,png'
			]);
		} else {
			array_push($validation, [
				'image' => 'mimes:jpg,png'
			]);
		}
			
		$validated = $request->validate($validation);

		// Upload Image
		if ($request->hasFile('image')) {
			if(!Storage::exists("/public/sport/image")) Storage::makeDirectory("/public/sport/image");
			$file = $request->file('image');

			$filenameWithExt = $request->file('image')->getClientOriginalName();
			$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
			$extension = $request->file('image')->getClientOriginalExtension();

			$filename = $filename.'_'.time().'.'.$extension;
			$path = storage_path('app/public/sport/image/').$filename;
			$file->storeAs('public/sport/image', $filename);

			// Resize image
			$img = Image::make($file->getRealPath())
				->resize(1024, 1024, function ($constraint) {
					$constraint->aspectRatio();
				})
				->save($path, 80);
		}

		$types = null;
		if ($isCreate) {
			$types = new SportType;
			$types->id = Str::uuid();
		} else {
			$types = SportType::find($request->id);
			if ($request->hasFile('image')) {
				$oldPath = storage_path('app/public/sport/image/').$school->logo;
				if (file_exists($oldPath)) {
					unlink($oldPath);
				}
			}
		}
		
		try {
			$types->name = ucwords($request->name);
			if ($request->hasFile('image')) $types->image = $filename;
			$types->stream_url = $request->stream_url;
			$types->save();

			return redirect()
				->route("admin.sport.type.index")
				->with('success', 'Data successfully saved');
		} catch (QueryException $exception) {
			unlink($path);
			return redirect()->back()
				->withErrors($exception->getMessage());
		}
	}

	public function delete (Request $request) {
		$validated = $request->validate([
			'id' => 'required|uuid'
		]);

		try {
			$type = SportType::find($request->id);
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

	public function list (Request $request) {
		$page = $request->has('page') ? $request->page : 1;
		if (empty($page)) $page = 1; 
		$search = $request->has('search') ? $request->search : null;
		$limit = 10;

		$types = SportType::when($search != null, function ($query) use ($search) {
        $query->where('name', 'LIKE', '%'.$search.'%');
      })
      ->take($limit)
			->skip($page - 1)
			->get();

		$total = SportType::when($search != null, function ($query) use ($search) {
			$query->where('name', 'LIKE', '%'.$search.'%');
		})->count();

		return response()->json([
			"status" => true,
			"message" => null,
			"data" => [
				"list" => $types,
				"pagination" => [
					"total" => $total,
					"page" => (int) $page,
					"search" => $search,
					"limit" => $limit,
					"total_page" => ceil($total / $limit)
				]
			]
		]);
	}

	public function listDatatable(Request $request) {
		$data = SportType::get();
		return Datatables::of($data)->make(true);
	}
}
