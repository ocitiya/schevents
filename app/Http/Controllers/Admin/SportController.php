<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Database\QueryException;
use Yajra\DataTables\Datatables;

use App\Models\Sport;

class SportController extends Controller {
	public function index (Request $request) {
		return view('admin.sport.index');
	}

	public function create (Request $request) {
		return view('admin.sport.form');
	}

	public function update (Request $request, $id) {
		$sport = Sport::find($id);
		$data = [
			"data" => $sport
		];

		return view('admin.sport.form', $data);
	}

	public function detail ($id) {
		$types = Sport::find($id);
		$data = [ "data" => $types ];

		return view('admin.sport.detail', $data);
	}

	public function store (Request $request) {
		$isCreate = $request->id == null ? true : false;
		$validation = [
			'name' => 'required|max:255',
			'image' => 'mimes:jpg,png'
		];
			
		$validated = $request->validate($validation);

		// Upload Image
		if ($request->hasFile('image')) {
			if(!Storage::exists("/public/sport_type/image")) Storage::makeDirectory("/public/sport_type/image");
			$file = $request->file('image');

			$filenameWithExt = $request->file('image')->getClientOriginalName();
			$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
			$extension = $request->file('image')->getClientOriginalExtension();

			$filename = $filename.'_'.time().'.'.$extension;
			$path = storage_path('app/public/sport_type/image/').$filename;
			$file->storeAs('public/sport_type/image', $filename);

			// Resize image
			$img = Image::make($file->getRealPath())
				->resize(1024, 1024, function ($constraint) {
					$constraint->aspectRatio();
				})
				->save($path, 80);
		}
		
		$types = null;
		if ($isCreate) {
			$types = new Sport;
			$types->id = Str::uuid();
		} else {
			$types = Sport::find($request->id);
			if ($request->hasFile('image')) {
				$oldPath = storage_path('app/public/sport_type/image/').$types->image;
				if (file_exists($oldPath) && !is_dir($oldPath)) {
					unlink($oldPath);
				}
			}
		}
		
		try {
			$types->name = ucwords($request->name);
			if ($request->hasFile('image')) $types->image = $filename;
			$types->save();

			return redirect()
				->route("admin.sport.index")
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
		$validated = $request->validate([
			'id' => 'required|uuid'
		]);

		try {
			$type = Sport::find($request->id);
			$type->delete();

			session()->flash('message', "{$type->name} successfully deleted");
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
		$search = $request->has('search') ? $request->search : null;
		$showAll = $request->has('showall') ? (boolean) $request->showall : false;
		$federationId = $request->has('federation_id') ? $request->federation_id : null;
		if ($federationId == "null") $federationId = null;

		$page = $request->has('page') ? $request->page : 1;
		if (empty($page)) $page = 1; 
		$limit = 10;

		$model = Sport::when($search != null, function ($query) use ($search) {
			$query->where('name', 'LIKE', '%'.$search.'%');
		})->when(!empty($federationId) && $federationId != 'n/a', function ($query) use ($federationId) {
			$query->whereHas("sport_types", function ($query) use ($federationId) {
				$query->where("federation_id", $federationId);
			});
		});

		$types = clone($model)->when(!$showAll, function ($query) use ($limit, $page) {
			$query->take($limit)->skip(($page - 1) * $limit);
		})->get();

		$total = $model->count();
		
		return response()->json([
			"status" => true,
			"message" => null,
			"data" => [
				"list" => $types,
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
		$data = Sport::get();
		
		return Datatables::of($data)->make(true);
	}

	public function validateName (Request $request) {
		$data = Sport::where('name', $request->name)->first();

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
