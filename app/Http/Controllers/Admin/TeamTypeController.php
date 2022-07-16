<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

use DataTables;

use App\Models\TeamType;

class TeamTypeController extends Controller {
	public function index (Request $request) {
		return view('admin.team_type.index');
	}

	public function create () {
		return view('admin.team_type.form');
	}

	public function update ($id) {
		$types = TeamType::find($id);

		$data = [ "data" => $types ];
		return view('admin.team_type.form', $data);
	}

	public function detail ($id) {
		$types = TeamType::find($id);
		$data = [ "data" => $types ];

		return view('admin.team_type.detail', $data);
	}

	public function store (Request $request) {
		$isCreate = $request->id == null ? true : false;
		$validation = [
			'name' => 'required|max:255'
		];
		
		$validated = $request->validate($validation);

		$types = null;
		if ($isCreate) {
			$types = new TeamType;
			$types->id = Str::uuid();
		} else {
			$types = TeamType::find($request->id);
		}
		
		try {
			$types->name = ucwords($request->name);
			$types->save();

			return redirect()
				->route("admin.masterdata.team_type.index")
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
			$type = TeamType::find($request->id);
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

		$types = TeamType::when($search != null, function ($query) use ($search) {
            $query->where('name', 'LIKE', '%'.$search.'%');
        })
        ->take($limit)
        ->skip($page - 1)
        ->get();

		$total = TeamType::when($search != null, function ($query) use ($search) {
			$query->where('name', 'LIKE', '%'.$search.'%');
		})->count();

		return response()->json([
			"status" => true,
			"message" => null,
			"data" => [
				"list" => $types,
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
		$data = TeamType::get();
		return Datatables::of($data)->make(true);
	}
}
