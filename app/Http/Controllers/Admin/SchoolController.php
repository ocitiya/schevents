<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Database\QueryException;

use App\Models\School;

class SchoolController extends Controller {
	public function index (Request $request) {
		return view('admin.school.index');
	}

	public function create () {
		return view('admin.school.form');
	}

	public function update ($id) {
		$types = School::find($id);

		$data = [ "data" => $types ];
		return view('admin.school.form', $data);
	}

	public function detail ($id) {
		$types = School::find($id);
		$data = [ "data" => $types ];

		return view('admin.school.detail', $data);
	}

	public function store (Request $request) {
		$validated = $request->validate([
			'name' => 'required|max:255',
			'country_id' => 'required|uuid',
			'province_id' => 'required|uuid',
			'county_id' => 'required|uuid',
			'municipality_id' => 'required|uuid',
			'logo' => 'required|mimes:jpg,png',
			'level_of_education' => 'required|in:kindergarden,elementary school,junior high school,senior high school,vocational school,university,college',
		]);

		$isCreate = $request->id == null ? true : false;

		// Upload Image
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

		$school = null;
		if ($isCreate) {
			$school = new School;
			$school->id = Str::uuid();
		} else {
			$school = School::find($request->id);
			$oldPath = storage_path('app/public/school/logo/').$school->logo;
			unlink($oldPath);
		}

		try {
			$school->name = $request->name;
			$school->country_id = $request->country_id;
			$school->province_id = $request->province_id;
			$school->county_id = $request->county_id;
			$school->municipality_id = $request->municipality_id;
			$school->level_of_education = $request->level_of_education;
			$school->logo = $filename;
			$school->save();

			return redirect()->route('admin.school.index');
		} catch (QueryException $exception) {
			unlink($path);
			return redirect()->back()
				->withErrors($exception->getMessage());
		}
	}

	public function storeOld (Request $request) {
		$validated = $request->validate([
			'name' => 'required|max:255'
		]);

		$isCreate = $request->id == null ? true : false;

		$types = null;
		if ($isCreate) {
			$types = new School;
			$types->id = Str::uuid();
		} else {
			$types = School::find($request->id);
		}
		
		try {
			$types->name = ucwords($request->name);
			$types->save();

			return redirect()
				->route("admin.school.index")
				->with('success', 'Data successfully saved');
		} catch (QueryException $exception) {
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

	public function list (Request $request) {
		$page = $request->has('page') ? $request->page : 1;
		if (empty($page)) $page = 1; 
		$search = $request->has('search') ? $request->search : null;
		$limit = 10;

		$schools = School::when($search != null, function ($query) use ($search) {
        $query->where('name', 'LIKE', '%'.$search.'%');
      })
      ->take($limit)
			->skip($page - 1)
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
					"page" => (int) $page,
					"search" => $search,
					"limit" => $limit,
					"total_page" => ceil($total / $limit)
				]
			]
		]);
	}
}
