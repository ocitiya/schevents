<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Database\QueryException;
use Yajra\DataTables\Datatables;

use App\Models\Socmed;

class SocmedController extends Controller {
	public function index (Request $request) {
		return view('admin.socmed.index');
	}

	public function create (Request $request) {
		return view('admin.socmed.form');
	}

	public function update (Request $request, $id) {
		$sport = Socmed::find($id);
		$data = [
			"data" => $sport
		];

		return view('admin.socmed.form', $data);
	}

	public function detail ($id) {
		$socmed = Socmed::find($id);
		$data = [ "data" => $socmed ];

		return view('admin.socmed.detail', $data);
	}

	public function store (Request $request) {
		$isCreate = $request->id == null ? true : false;
		$validation = [
			'name' => 'required|max:255',
			'image' => 'mimes:jpg,png',
      'link' => 'nullable|url'
		];

		$validated = $request->validate($validation);

		// Upload Image
		if ($request->hasFile('image')) {
			if(!Storage::exists("/public/socmed/image")) Storage::makeDirectory("/public/socmed/image");
			$file = $request->file('image');

			$filenameWithExt = $request->file('image')->getClientOriginalName();
			$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
			$extension = $request->file('image')->getClientOriginalExtension();

			$filename = $filename.'_'.time().'.'.$extension;
			$path = storage_path('app/public/socmed/image/').$filename;
			$file->storeAs('public/socmed/image', $filename);

			// Resize image
			$img = Image::make($file->getRealPath())
				->resize(1024, 1024, function ($constraint) {
					$constraint->aspectRatio();
				})
				->save($path, 80);
		}
		
		$socmed = null;
		if ($isCreate) {
			$socmed = new Socmed;
			$socmed->id = Str::uuid();
		} else {
			$socmed = Socmed::find($request->id);
			if ($request->hasFile('image')) {
				$oldPath = storage_path('app/public/socmed/image/').$socmed->image;
				if (file_exists($oldPath) && !is_dir($oldPath)) {
					unlink($oldPath);
				}
			}
		}
		
		try {
			$socmed->name = ucwords($request->name);
			if ($request->hasFile('image')) $socmed->image = $filename;
		  $socmed->link = $request->link;
			$socmed->save();

			return redirect()
				->route("admin.masterdata.socmed.index")
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
			$socmed = Socmed::find($request->id);
			$socmed->delete();

			session()->flash('message', "{$socmed->name} successfully deleted");
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

		$page = $request->has('page') ? $request->page : 1;
		if (empty($page)) $page = 1; 
		$limit = 10;

		$model = Socmed::when($search != null, function ($query) use ($search) {
			$query->where('name', 'LIKE', '%'.$search.'%');
		});

		$socmed = clone($model)->when(!$showAll, function ($query) use ($limit, $page) {
			$query->take($limit)->skip(($page - 1) * $limit);
		})->get();

		$total = $model->count();
		
		return response()->json([
			"status" => true,
			"message" => null,
			"data" => [
				"list" => $socmed,
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
		$data = Socmed::get();
		
		return Datatables::of($data)->make(true);
	}

	public function validateName (Request $request) {
		$data = Socmed::where('name', $request->name)->first();

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
