<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

// use DataTables;

use App\Models\Province;
use App\Models\Country;
use App\Models\County;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class CountiesController extends Controller {
	public function index (Request $request) {
		return view('admin.counties.index');
	}

	public function create () {
		return view('admin.counties.form');
	}

	public function update ($id) {
    $provinces = Province::get();
		$counties = County::find($id);

		$data = [ "data" => $counties, "provinces" => $provinces ];
		return view('admin.counties.form', $data);
	}

	public function detail ($id) {
		$counties = County::with(['province'])->find($id);
		$data = [ "data" => $counties ];

		return view('admin.counties.detail', $data);
	}

	public function store (Request $request) {
		$isCreate = $request->id == null ? true : false;

		$validated = $request->validate([
			'name' => 'required|max:255',
			'abbreviation' => 'required|max:255',
			'logo' => 'nullable|mimes:jpg,png'
		]);

		if ($request->hasFile('logo')) {
			if(!Storage::exists("/public/counties/logo")) Storage::makeDirectory("/public/counties/logo");
			$file = $request->file('logo');

			$filenameWithExt = $request->file('logo')->getClientOriginalName();
			$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
			$extension = $request->file('logo')->getClientOriginalExtension();

			$filename = $filename.'_'.time().'.'.$extension;
			$path = storage_path('app/public/counties/logo/').$filename;
			$file->storeAs('public/counties/logo', $filename);

			// Resize image
			$img = Image::make($file->getRealPath())
				->resize(512, 512, function ($constraint) {
					$constraint->aspectRatio();
				})
				->save($path, 80);
		}

		$counties = null;
		if ($isCreate) {
			$counties = new County;
			$counties->id = Str::uuid();
		} else {
			$counties = County::find($request->id);
			if ($request->hasFile('logo')) {
				$oldPath = storage_path('app/public/counties/logo/').$counties->logo;
				if (file_exists($oldPath) && is_file($oldPath)) {
					unlink($oldPath);
				}
			}
		}
		
		try {
			$counties->country_id = Country::first()->id;
			$counties->abbreviation = $request->abbreviation;
			$counties->name = ucwords($request->name);
			if ($request->hasFile('logo')) $counties->logo = $filename;
			$counties->save();

			return redirect()
				->route("admin.location.counties.index")
				->with('success', 'Data successfully saved');
		} catch (Exception $exception) {
			return redirect()->back()
				->withErrors($exception->getMessage());
		}
	}

	public function listDatatable(Request $request) {
		$data = County::withCount(["municipality"])->get();
		return Datatables::of($data)->make(true);
	}

	public function list (Request $request, $countryId = null) {
		try {
			$showAll = $request->has('showall') ? (boolean) $request->showall : false;
			$search = $request->has('search') ? $request->search : null;
			$countryId = $request->has('country_id') ? $request->country_id : null;

			$page = $request->has('page') ? $request->page : 1;
			if (empty($page)) $page = 1; 
			$limit = 10;

			$model = County::with(['province'])
				->when($search != null, function ($query) use ($search) {
					$query->where('name', 'LIKE', '%'.$search.'%');
				})
				->when(!empty($countryId), function ($q) use ($countryId) {
					$q->where("country_id", $countryId);
				});

			$model2 = $model;
			$total = $model2->count();

			$counties = $model->when(!$showAll, function ($query) use ($limit, $page) {
				$query->take($limit)->skip(($page - 1) * $limit);
			})
				->orderBy('name')
				->get();

			return response()->json([
				"status" => true,
				"message" => null,
				"data" => [
					"list" => $counties,
					"pagination" => [
						"total" => $total,
						"search" => $search,
						"page" => !$showAll ? (int) $page : -1,
						"limit" => !$showAll ? $limit : -1,
						"total_page" => !$showAll ? ceil($total / $limit) : 1
					]
				]
			]);
		} catch (Exception $exception) {
			return response()->json([
				"status" => false,
				"message" => $exception->getMessage()
			]);
		}
	}

	public function validateCounty (Request $request) {
		$data = County::where('name', $request->county)->first();

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
