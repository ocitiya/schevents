<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

use DataTables;

use App\Models\Athlete;
use App\Models\Country;
use App\Models\Federation;
use Exception;

class AthleteController extends Controller {
	public function index (Request $request) {
		return view('admin.athlete.index');
	}

	public function create () {
		$data = [
			"federations" => Federation::get(),
			"countries" => Country::get()
		];

		return view('admin.athlete.form', $data);
	}

	public function update ($id) {
		$athlete = Athlete::find($id);

		$data = [
			"data" => $athlete,
			"federations" => Federation::get(),
			"countries" => Country::get()
		];
		return view('admin.athlete.form', $data);
	}

	public function detail ($id) {
		$athlete = Athlete::find($id);
		$data = [ "data" => $athlete ];

		return view('admin.athlete.detail', $data);
	}

	public function store (Request $request) {
		$isCreate = $request->id == null ? true : false;
		$validation = [
			'name' => 'required|max:255',
			'gender' => 'required',
			'date_of_birth' => 'nullable|date',
			'height' => 'nullable|integer',
			'weight' => 'nullable|integer',
			'nickname' => 'nullable|string',
			'surname' => 'nullable|string',
			'country_id' => 'nullable|uuid',
			'county_id' => 'nullable|uuid',
			'municipality_id' => 'nullable|uuid',
			'wingspan' => 'nullable|string',
			'age' => 'nullable|integer',
			'federation_id' => 'required|uuid',
			'association_id' => 'nullable|uuid',
			'image' => 'nullable|mimes:jpg,png'
		];
		
		$validated = $request->validate($validation);

		if ($request->hasFile('image')) {
			if(!Storage::exists("/public/athlete/image")) Storage::makeDirectory("/public/athlete/image");
			$file = $request->file('image');

			$filenameWithExt = $request->file('image')->getClientOriginalName();
			$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
			$extension = $request->file('image')->getClientOriginalExtension();

			$filename = $filename.'_'.time().'.'.$extension;
			$path = storage_path('app/public/athlete/image/').$filename;
			$file->storeAs('public/athlete/image', $filename);

			// Resize image
			$img = Image::make($file->getRealPath())
				->resize(512, 512, function ($constraint) {
					$constraint->aspectRatio();
				})
				->fit(512, 512, null, 'center')
				->save($path, 80);
		}

		$athlete = null;
		if ($isCreate) {
			$athlete = new Athlete();
		} else {
			$athlete = Athlete::find($request->id);
			if ($request->hasFile('image')) {
				$oldPath = storage_path('app/public/athlete/logo/').$athlete->image;
				if (file_exists($oldPath) && is_file($oldPath)) {
					unlink($oldPath);
				}
			}
		}
		
		try {
			$athlete->name = ucwords($request->name);
			$athlete->gender = $request->gender;
			$athlete->date_of_birth = $request->date_of_birth;
			$athlete->height = $request->height;
			$athlete->weight = $request->weight;
			$athlete->nickname = $request->nickname;
			$athlete->surname = $request->surname;
			$athlete->country_id = $request->country_id;
			$athlete->county_id = $request->county_id;
			$athlete->municipality_id = $request->municipality_id;
			$athlete->wingspan = $request->wingspan;
			$athlete->age = $request->age;
			$athlete->federation_id = $request->federation_id;
			$athlete->association_id = $request->association_id;
			if ($request->hasFile('image')) $athlete->image = $filename;
			$athlete->save();

			return redirect()
				->route("admin.masterdata.athlete.index")
				->with('success', 'Data successfully saved');
		} catch (Exception $exception) {
			return redirect()->back()
				->withErrors($exception->getMessage());
		}
	}

	public function delete (Request $request) {
		$validated = $request->validate([
			'id' => 'required|numeric'
		]);

		try {
			$athlete = Athlete::find($request->id);

			try {
				$oldPath = storage_path('app/public/athlete/logo/').$athlete->image;
				unlink($oldPath);
			} catch (Exception $e) {}

			$athlete->delete();

			$request->session()->flash('message', "Atlet {$athlete->name} successfully deleted");
			return response()->json([
				"status" => true,
				"message" => null
			]);
		} catch (Exception $exception) {
			return response()->json([
				"status" => false,
				"message" => $exception->getMessage()
			]);
		}
	}

	public function list (Request $request) {
		$showAll = $request->has('showall') ? (boolean) $request->showall : false;
		$page = $request->has('page') ? $request->page : 1;
		if (empty($page)) $page = 1; 
		$search = $request->has('search') ? $request->search : null;
		$federationId = $request->has("federation_id") ? $request->federation_id : null;
		$limit = 10;

		$model = Athlete::when($search != null, function ($query) use ($search) {
			$query->where('name', 'LIKE', '%'.$search.'%');
		})->when(!empty($federationId), function ($query) use ($federationId) {
			$query->where("federation_id", $federationId);
		});

		$athlete = clone $model->when(!$showAll, function ($query) use ($limit, $page) {
			$query->take($limit)->skip(($page - 1) * $limit);
		})->get();


		$total = clone $model;
		$total = $model->count();

		$total = Athlete::when($search != null, function ($query) use ($search) {
			$query->where('name', 'LIKE', '%'.$search.'%');
		})->count();

		return response()->json([
			"status" => true,
			"message" => null,
			"data" => [
				"list" => $athlete,
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
		$data = Athlete::with(["federation", "association", "country", "county", "municipality"])
			->get();
		return DataTables::of($data)->make(true);
	}
}
