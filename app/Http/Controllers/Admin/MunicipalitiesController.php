<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

use DataTables;

use App\Models\County;
use App\Models\Municipality;

class MunicipalitiesController extends Controller {
	public function index (Request $request) {
		return view('admin.municipalities.index');
	}

	public function create () {
    $counties = County::get();
    
    $data = [ "counties" => $counties ];
		return view('admin.municipalities.form', $data);
	}

	public function update ($id) {
    $counties = County::get();
		$municipality = Municipality::find($id);

		$data = [ "data" => $municipality, "counties" => $counties ];
		return view('admin.municipalities.form', $data);
	}

	public function detail ($id) {
		$municipality = Municipality::with(['county'])->find($id);
		$data = [ "data" => $municipality ];

		return view('admin.municipalities.detail', $data);
	}

	public function store (Request $request) {
		$isCreate = $request->id == null ? true : false;
		
		$validated = $request->validate([
      'county_id' => 'required|uuid',
			'name' => 'required|max:255',
			'logo' => 'nullable|mimes:jpg,png'
		]);

		if ($request->hasFile('logo')) {
			if(!Storage::exists("/public/municipalities/logo")) Storage::makeDirectory("/public/municipalities/logo");
			$file = $request->file('logo');

			$filenameWithExt = $request->file('logo')->getClientOriginalName();
			$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
			$extension = $request->file('logo')->getClientOriginalExtension();

			$filename = $filename.'_'.time().'.'.$extension;
			$path = storage_path('app/public/municipalities/logo/').$filename;
			$file->storeAs('public/municipalities/logo', $filename);

			// Resize image
			$img = Image::make($file->getRealPath())
				->resize(512, 512, function ($constraint) {
					$constraint->aspectRatio();
				})
				->save($path, 80);
		}

		$municipality = null;
		if ($isCreate) {
			$municipality = new Municipality;
			$municipality->id = Str::uuid();
		} else {
			$municipality = Municipality::find($request->id);
			if ($request->hasFile('logo')) {
				$oldPath = storage_path('app/public/municipalities/logo/').$counties->logo;
				if (file_exists($oldPath) && is_file($oldPath)) {
					unlink($oldPath);
				}
			}
		}
		
		try {
			$municipality->county_id = $request->county_id;
			$municipality->name = ucwords($request->name);
			if ($request->hasFile('logo')) $municipality->logo = $filename;
			$municipality->save();

			return redirect()
				->route("admin.location.municipalities.index")
				->with('success', 'Data successfully saved');
		} catch (QueryException $exception) {
			return redirect()->back()
				->withErrors($exception->getMessage());
		}
	}

	public function listDatatable(Request $request) {
		$data = Municipality::withCount(["schools"])->get();
		return Datatables::of($data)->make(true);
	}

	public function list (Request $request) {
		try {
			$page = $request->has('page') ? $request->page : 1;
			if (empty($page)) $page = 1; 
			$search = $request->has('search') ? $request->search : null;
			$limit = 10;

			$municipalities = Municipality::with(['county'])
				->when($search != null, function ($query) use ($search) {
					$query->where('name', 'LIKE', '%'.$search.'%');
				})
				->take($limit)
				->skip($page - 1)
				->get();

			$total = Municipality::when($search != null, function ($query) use ($search) {
				$query->where('name', 'LIKE', '%'.$search.'%');
			})->count();

			return response()->json([
				"status" => true,
				"message" => null,
				"data" => [
					"list" => $municipalities,
					"pagination" => [
						"total" => $total,
						"page" => (int) $page,
						"search" => $search,
						"limit" => $limit,
						"total_page" => ceil($total / $limit)
					]
				]
			]);
		} catch (QueryException $exception) {
			return response()->json([
				"status" => false,
				"message" => $exception->getMessage()
			]);
		}
	}
}
