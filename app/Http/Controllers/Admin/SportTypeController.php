<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\SportType;

class SportTypeController extends Controller {
	public function index (Request $request) {
		$page = $request->has('page') ? $request->page : 1;
		if (empty($page)) $page = 1; 
		$search = $request->has('search') ? $request->search : null;
		$limit = 10;

		$types = SportType::when($search != null, function ($query) use ($search) {
        $query->where('name', 'LIKE', '%'.$search.'%');
      })
      ->take($limit)
			->skip($page - 1)
			->get();

		$total = SportType::when($search != null, function ($query) use ($search) {
			$query->where('name', 'LIKE', '%'.$search.'%');
		})->count();

		$data = [
			"types" => $types,
			"total" => $total,
			"page" => $page,
			"search" => $search,
			"total_page" => ceil($total / $limit)
		];

		return view('admin.sport_type.index', $data);
	}

	public function create () {
		return view('admin.sport_type.form');
	}

	public function update ($id) {
		$types = SportType::find($id);

		$data = [ "data" => $types ];
		return view('admin.sport_type.form', $data);
	}

	public function detail ($id) {
		$types = SportType::find($id);
		$data = [ "data" => $types ];

		return view('admin.sport_type.detail', $data);
	}

	public function store (Request $request) {
		$validated = $request->validate([
			'name' => 'required|max:255'
		]);

		$isCreate = $request->id == null ? true : false;

		$types = null;
		if ($isCreate) {
			$types = new SportType;
			$types->id = Str::uuid();
		} else {
			$types = SportType::find($request->id);
		}
		
		try {
			$types->name = ucwords($request->name);
			$types->save();

			return redirect()
				->route("admin.sport.type.index")
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
			$type = SportType::find($request->id);
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
}
