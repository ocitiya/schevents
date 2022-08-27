<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

use DataTables;

use App\Models\Federation;

class FederationController extends Controller {
	public function index (Request $request) {
		return view('admin.federation.index');
	}

	public function create () {
		return view('admin.federation.form');
	}

	public function update ($id) {
		$federation = Federation::find($id);

		$data = [ "data" => $federation ];
		return view('admin.federation.form', $data);
	}

	public function detail ($id) {
		$types = Federation::find($id);
		$data = [ "data" => $types ];

		return view('admin.federation.detail', $data);
	}

	public function store (Request $request) {
		$isCreate = $request->id == null ? true : false;
		$validation = [
			'name' => 'required|max:255',
			'abbreviation' => 'required|max:255',
			'logo' => 'mimes:jpg,png'
		];
		
		$validated = $request->validate($validation);

    if ($request->hasFile('logo')) {
			if(!Storage::exists("/public/federation/logo")) Storage::makeDirectory("/public/federation/logo");
			$file = $request->file('logo');

			$filenameWithExt = $request->file('logo')->getClientOriginalName();
			$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
			$extension = $request->file('logo')->getClientOriginalExtension();

			$filename = $filename.'_'.time().'.'.$extension;
			$path = storage_path('app/public/federation/logo/').$filename;
			$file->storeAs('public/federation/logo', $filename);

			// Resize image
			$img = Image::make($file->getRealPath())
				->resize(512, 512, function ($constraint) {
					$constraint->aspectRatio();
				})
				->fit(512, 512, null, 'center')
				->save($path, 80);
		}

		$federation = null;
		if ($isCreate) {
			$federation = new Federation;
			$federation->id = Str::uuid();
		} else {
			$federation = Federation::find($request->id);
      if ($request->hasFile('logo')) {
				$oldPath = storage_path('app/public/federation/logo/').$federation->logo;
				if (file_exists($oldPath) && is_file($oldPath)) {
					unlink($oldPath);
				}
			}
		}
		
		try {
			$federation->name = ucwords($request->name);
			$federation->abbreviation = $request->abbreviation;
      if ($request->hasFile('logo')) $federation->logo = $filename;
			$federation->save();

			return redirect()
				->route("admin.masterdata.federation.index")
				->with('success', 'Data successfully saved');
		} catch (QueryException $exception) {
			if (is_file($path)) {
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
			$type = Federation::find($request->id);
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
		$showAll = $request->has('showall') ? (boolean) $request->showall : false;
		$search = $request->has('search') ? $request->search : null;

		$page = $request->has('page') ? $request->page : 1;
		if (empty($page)) $page = 1; 
		$limit = 10;

		$model = Federation::withCount("sports")
			->when($search != null, function ($query) use ($search) {
				$query->where('name', 'LIKE', '%'.$search.'%');
			});

		$types = clone($model)->when(!$showAll, function ($query) use ($limit, $page) {
			$query->take($limit)->skip(($page - 1) * $limit);
		});

		$total = clone($model)->count();

		return response()->json([
			"status" => true,
			"message" => null,
			"data" => [
				"list" => $types,
				"pagination" => [
					"total" => $total,
					"search" => $search,
					"page" => !$showAll ? (int) $page : -1,
					"limit" => !$showAll ? $limit : -1,
					"total_page" => !$showAll ? ceil($total / $limit) : 1
				]
			]
		]);
	}

	public function listDatatable(Request $request) {
		$data = Federation::withCount("sports")->get();
		return Datatables::of($data)->make(true);
	}

  public function validateName (Request $request) {
		$data = Federation::where('name', $request->name)->first();

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
