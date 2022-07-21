<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

use DataTables;

use App\Models\Association;
use App\Models\Federation;

class AssociationController extends Controller {
	public function index (Request $request) {
		return view('admin.association.index');
	}

	public function create () {
    $data = [
      "federations" => Federation::get()
    ];

		return view('admin.association.form', $data);
	}

	public function update ($id) {
		$association = Association::find($id);

		$data = [ "data" => $association ];
		return view('admin.association.form', $data);
	}

	public function detail ($id) {
		$types = Association::find($id);
		$data = [ "data" => $types ];

		return view('admin.association.detail', $data);
	}

	public function store (Request $request) {
		$isCreate = $request->id == null ? true : false;
		$validation = [
			'name' => 'required|max:255',
			'abbreviation' => 'required|max:255',
			'federation_id' => 'required|uuid',
			'logo' => 'mimes:jpg,png'
		];
		
		$validated = $request->validate($validation);

    if ($request->hasFile('logo')) {
			if(!Storage::exists("/public/association/logo")) Storage::makeDirectory("/public/association/logo");
			$file = $request->file('logo');

			$filenameWithExt = $request->file('logo')->getClientOriginalName();
			$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
			$extension = $request->file('logo')->getClientOriginalExtension();

			$filename = $filename.'_'.time().'.'.$extension;
			$path = storage_path('app/public/association/logo/').$filename;
			$file->storeAs('public/association/logo', $filename);

			// Resize image
			$img = Image::make($file->getRealPath())
				->resize(512, 512, function ($constraint) {
					$constraint->aspectRatio();
				})
				->fit(512, 512, null, 'center')
				->save($path, 80);
		}

		$association = null;
		if ($isCreate) {
			$association = new Association;
			$association->id = Str::uuid();
		} else {
			$association = Association::find($request->id);
      if ($request->hasFile('logo')) {
				$oldPath = storage_path('app/public/association/logo/').$association->logo;
				if (file_exists($oldPath)) {
					unlink($oldPath);
				}
			}
		}
		
		try {
			$association->name = ucwords($request->name);
			$association->federation_id = $request->federation_id;
			$association->abbreviation = $request->abbreviation;
      if ($request->hasFile('logo')) $association->logo = $filename;
			$association->save();

			return redirect()
				->route("admin.masterdata.association.index")
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
			$type = Association::find($request->id);
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

		$federation_id = $request->has('federation_id') ? $request->federation_id : null;

		$types = Association::when($search != null, function ($query) use ($search) {
      $query->where('name', 'LIKE', '%'.$search.'%');
    })
		->when(!$showAll, function ($query) {
			$query->take($limit)->skip(($page - 1) * $limit);
		})
		->when($federation_id != null, function ($query) use ($federation_id) {
			$query->where('federation_id', $federation_id);
		})
    ->get();

		$total = Association::when($search != null, function ($query) use ($search) {
			$query->where('name', 'LIKE', '%'.$search.'%');
		})->when($federation_id != null, function ($query) use ($federation_id) {
			$query->where('federation_id', $federation_id);
		})->count();

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
		$data = Association::with(["federation"])->get();
		return Datatables::of($data)->make(true);
	}

  public function validateName (Request $request) {
		$data = Association::where('name', $request->name)->first();

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
