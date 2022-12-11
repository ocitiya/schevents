<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

// use App\Models\County;
use App\Models\Country;
use App\Models\School;
use Illuminate\Database\QueryException;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;

class countriesController extends Controller {
	public function index (Request $request) {
		$state_id = $request->has('state_id') ? $request->state_id : null;

    $data = [ "state_id" => $state_id ];
    if ($state_id != null) {
      $stateName = Country::find($state_id)->name;
      $data["state_name"] = $stateName;
    }

		return view('admin.countries.index', $data);
	}

	public function create (Request $request) {
    $counties = Country::get();
    
    $data = [
			"counties" => $counties
		];

		return view('admin.countries.form', $data);
	}

	public function update (Request $request, $id) {
		$data = [
			"data" => Country::find($id)
		];

		return view('admin.countries.form', $data);
	}

	public function detail ($id) {
		$country = Country::with(['county'])->find($id);
		$data = [ "data" => $country ];

		return view('admin.countries.detail', $data);
	}

	public function store (Request $request) {
		$isCreate = $request->id == null ? true : false;
		
		$validated = $request->validate([
			'name' => 'required|max:255',
			'alpha3_code' => 'nullable|min:3|max:3',
			'image' => 'nullable|file|mimes:jpg,png'
		]);

		$country = null;
		if ($isCreate) {
			$country = new Country;
			$country->id = Str::uuid();
		} else {
			$country = Country::find($request->id);
			if ($request->hasFile('image')) {
				$oldPath = storage_path('app/public/countries/image/').$country->image;
				if (file_exists($oldPath) && is_file($oldPath)) {
					unlink($oldPath);
				}
			}
		}

		if ($request->hasFile('image')) {
			if(!Storage::exists("/public/countries/image")) Storage::makeDirectory("/public/countries/image");
			$file = $request->file('image');

			$filenameWithExt = $request->file('image')->getClientOriginalName();
			$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
			$extension = $request->file('image')->getClientOriginalExtension();

			$filename = $filename.'_'.time().'.'.$extension;
			$path = storage_path('app/public/countries/image/').$filename;
			$file->storeAs('public/countries/image', $filename);

			// Resize image
			$img = Image::make($file->getRealPath())
				->resize(512, 512, function ($constraint) {
					$constraint->aspectRatio();
				})
				->save($path, 80);
		}
		
		try {
			$country->name = ucwords($request->name);
			$country->alpha3_code = $request->alpha3_code;
			$country->has_state = $request->has('has_state') ? 1 : 0;
			if ($request->hasFile('image')) $country->image = $filename;
			$country->save();

			$this->generateNationalTeam($country);

			return redirect()
				->route("admin.location.countries.index")
				->with('success', 'Data successfully saved');

		} catch (QueryException $exception) {
			unlink($path);
			return redirect()->back()
				->withErrors($exception->getMessage());
		}
	}

	public function generateNationalTeam($country) {
		$check = School::where("country_id", $country->id)
			->where("is_national_team", true)
			->first();

		$school = null;
		if (!$check) {
			$school = new School;
			$school->id = Str::uuid();
		} else {
			$school = clone $check;

			if (!empty($school->logo)) {
				$oldPath = storage_path('app/public/school/logo/').$school->logo;
				unlink($oldPath);
			}
		}

		$school->name = $country->name;
		$school->is_national_team = true;
		$school->abbreviation = $country->alpha3_code;
		$school->country_id = $country->id;

		$path = storage_path('app/public/countries/image/').$country->image;
		$newPath = storage_path('app/public/school/logo/').$country->image;
		if (file_exists($path) && !is_dir($path)) {
			copy($path, $newPath);
		}

		$school->logo = $country->image;
		$school->save();
	}

	public function listDatatable(Request $request) {
		$stateId = isset($request->state_id) ? $request->state_id : null;
		$data = Country::get();

		return Datatables::of($data)->make(true);
	}

	public function list (Request $request) {
		try {
			$showAll = $request->has('showall') ? (boolean) $request->showall : false;
			$search = $request->has('search') ? $request->search : null;
			$id = $request->has('id') ? $request->id : null;
			
			$page = $request->has('page') ? $request->page : 1;
			if (empty($page)) $page = 1; 
			
			$limit = 10;

			$model = Country::when($search != null, function ($query) use ($search) {
					$query->where('name', 'LIKE', '%'.$search.'%');
				})
				->when($id != null, function ($query) use ($id) {
					$query->where('id', $id);
				});

			$model2 = $model;
			$total = $model2->count();

			$countries = $model->when(!$showAll, function ($query) use ($limit, $page) {
				$query->take($limit)->skip(($page - 1) * $limit);
			})
				->orderBy('name')
				->get();

			$total = Country::when($search != null, function ($query) use ($search) {
				$query->where('name', 'LIKE', '%'.$search.'%');
			})->count();

			return response()->json([
				"status" => true,
				"message" => null,
				"data" => [
					"list" => $countries,
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

	public function delete (Request $request) {
		$validated = $request->validate([
			'id' => 'required|uuid'
		]);

		try {
			$country = Country::find($request->id);

			// $oldPath = storage_path('app/public/countries/image/').$country->image;
			// if (file_exists($oldPath) && !is_dir($oldPath)) {
			// 	unlink($oldPath);
			// }

			$country->delete();

			$school = School::where("country_id", $country->id)
				->where("is_national_team", true)
				->delete();

			$request->session()->flash('message', "{$country->name} successfully deleted");
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

	public function hasState ($id) {
		try {
			$data = Country::find($id);
			
			return response()->json([
				"status" => $data->has_state == 1 ? true : false,
				"message" => null
			]);
		} catch (QueryException $exception) {
			return response()->json([
				"status" => false,
				"message" => $exception->getMessage()
			]);
		}
	}
}
