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
		$state_id = $request->has('state_id') ? $request->state_id : null;

    $data = [ "state_id" => $state_id ];
    if ($state_id != null) {
      $stateName = County::find($state_id)->name;
      $data["state_name"] = $stateName;
    }

		return view('admin.municipalities.index', $data);
	}

	public function create (Request $request) {
		$state_id = $request->has('state_id') ? $request->state_id : null;
    $counties = County::get();
    
    $data = [
			"counties" => $counties,
			"state_id" => $state_id
		];

		return view('admin.municipalities.form', $data);
	}

	public function update (Request $request, $id) {
		$state_id = $request->has('state_id') ? $request->state_id : null;
    $counties = County::get();
		$municipality = Municipality::find($id);

		$data = [
			"data" => $municipality,
			"counties" => $counties,
			"state_id" => $state_id
		];

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

		$municipality = null;
		if ($isCreate) {
			$municipality = new Municipality;
			$municipality->id = Str::uuid();
		} else {
			$municipality = Municipality::find($request->id);
		}
		
		try {
			$municipality->county_id = $request->county_id;
			$municipality->name = ucwords($request->name);
			$municipality->save();

			if ($request->has("isStateDefault")) {
				return redirect()
					->route("admin.location.municipalities.index", ["state_id" => $request->county_id])
					->with('success', 'Data successfully saved');
			} else {
				return redirect()
					->route("admin.location.municipalities.index")
					->with('success', 'Data successfully saved');
			}

		} catch (QueryException $exception) {
			return redirect()->back()
				->withErrors($exception->getMessage());
		}
	}

	public function listDatatable(Request $request) {
		$stateId = isset($request->state_id) ? $request->state_id : null;
		
		$data = Municipality::withCount(["schools"])
			->with(["county"])
			->when($stateId != null, function ($subQuery) use ($stateId) {
				$subQuery->where('county_id', $stateId);
			})
			->get();
		return Datatables::of($data)->make(true);
	}

	public function list (Request $request) {
		try {
			$showAll = $request->has('showall') ? (boolean) $request->showall : false;
			$search = $request->has('search') ? $request->search : null;
			$state_id = $request->has('state_id') ? $request->state_id : null;
			$id = $request->has('id') ? $request->id : null;
			
			$page = $request->has('page') ? $request->page : 1;
			if (empty($page)) $page = 1; 
			
			$limit = 10;

			$model = Municipality::with(['county'])
				->when($search != null, function ($query) use ($search) {
					$query->where('name', 'LIKE', '%'.$search.'%');
				})
				->when($state_id != null, function ($query) use ($state_id) {
					$query->where('county_id', $state_id);
				})
				->when($id != null, function ($query) use ($id) {
					$query->where('id', $id);
				});

			$model2 = $model;
			$total = $model2->count();

			$municipalities = $model->when(!$showAll, function ($query) use ($limit, $page) {
				$query->take($limit)->skip(($page - 1) * $limit);
			})
				->withCount('schools')
				->orderBy('name')
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
