<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Database\QueryException;

use DataTables;

use App\Models\Country;
use App\Models\School;
use App\Models\County;

class SchoolController extends Controller {
	public function index (Request $request) {
		$defaultCity = $request->has("city_id") ? $request->city_id : null;

		$data = [
			"default_city" => $defaultCity,
			"city_name" => ($defaultCity != null) ? County::find($defaultCity)->name : null
		];

		return view('admin.school.index', $data);
	}

	public function create (Request $request) {
		$data = [
			"default_city" => $request->has("city_id") ? $request->city_id : null
		];

		return view('admin.school.form', $data);
	}

	public function update (Request $request, $id) {
		$types = School::find($id);

		$data = [
		    "data" => $types,
		    "default_city" => $request->has("city_id") ? $request->city_id : null
		];
		return view('admin.school.form', $data);
	}

	public function detail ($id) {
		$types = School::find($id);
		$data = [ "data" => $types ];

		return view('admin.school.detail', $data);
	}

	public function store (Request $request) {
		$validation = [
			'name' => 'required|max:255',
			'county_id' => 'required|uuid',
			'logo' => 'mimes:jpg,png'
		];

		$isCreate = $request->id == null ? true : false;
		$validated = $request->validate($validation);
		
		// Upload Image
		if ($request->hasFile('logo')) {
			if(!Storage::exists("/public/school/logo")) Storage::makeDirectory("/public/school/logo");
			$file = $request->file('logo');

			$filenameWithExt = $request->file('logo')->getClientOriginalName();
			$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
			$extension = $request->file('logo')->getClientOriginalExtension();

			$filename = $filename.'_'.time().'.'.$extension;
			$path = storage_path('app/public/school/logo/').$filename;
			$file->storeAs('public/school/logo', $filename);

			// Resize image
			$img = Image::make($file->getRealPath())
				->resize(512, 512, function ($constraint) {
					$constraint->aspectRatio();
				})
				->fit(512, 512, null, 'center')
				->save($path, 80);
		}

		$school = null;
		if ($isCreate) {
			$school = new School;
			$school->id = Str::uuid();
		} else {
			$school = School::find($request->id);
			if ($request->hasFile('logo')) {
				$oldPath = storage_path('app/public/school/logo/').$school->logo;
				unlink($oldPath);
			}
		}

		try {
			$school->name = $request->name;
			$school->country_id = Country::first()->id;
			$school->county_id = $request->county_id;
			if ($request->hasFile('logo')) $school->logo = $filename;
			$school->save();

			if ($request->redirect_city == 1) {
				$city_id = $request->county_id;
				return redirect()->route('admin.school.index', ["city_id" => $city_id]);
			} else {
				return redirect()->route('admin.school.index');
			}

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
			$type = School::find($request->id);
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

	public function validateSchool (Request $request) {
		$data = School::where('name', $request->school)->first();

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

	public function listDatatable(Request $request) {
		$cityId = isset($request->city_id) ? $request->city_id : null;

		$data = School::with(["county"])
			->when($cityId != null, function ($subQuery) use ($cityId) {
				$subQuery->where('county_id', $cityId);
			})
			->get();

		return Datatables::of($data)->make(true);
	}

	public function list (Request $request) {
		$showAll = $request->has('showall') ? (boolean) $request->showall : false;
		$search = $request->has('search') ? $request->search : null;
		$county_id = $request->has('county_id') ? $request->county_id : null;
		
		$page = $request->has('page') ? $request->page : 1;
		if (empty($page)) $page = 1; 
		$limit = 10;

		$schools = School::with(['county'])
			->when($search != null, function ($query) use ($search) {
        $query->where('name', 'LIKE', '%'.$search.'%');
      })
			->when(!$showAll, function ($query) {
				$query->take($limit)->skip(($page - 1) * $limit);
			})
			->when($county_id != null, function ($query) use ($county_id) {
				$query->where('county_id', $county_id);
			})
			->get();

		$total = School::when($search != null, function ($query) use ($search) {
			$query->where('name', 'LIKE', '%'.$search.'%');
		})->count();

		return response()->json([
			"status" => true,
			"message" => null,
			"data" => [
				"list" => $schools,
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
}
