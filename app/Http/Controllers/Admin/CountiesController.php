<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Province;
use App\Models\County;

class CountiesController extends Controller {
	public function index (Request $request) {
		return view('admin.counties.index');
	}

	public function create () {
    $provinces = Province::get();
    
    $data = [ "provinces" => $provinces ];
		return view('admin.counties.form', $data);
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
		$validated = $request->validate([
      'province_id' => 'required|uuid',
			'name' => 'required|max:255'
		]);

		$isCreate = $request->id == null ? true : false;

		$counties = null;
		if ($isCreate) {
			$counties = new County;
			$counties->id = Str::uuid();
		} else {
			$counties = County::find($request->id);
		}
		
		try {
			$counties->province_id = $request->province_id;
			$counties->name = ucwords($request->name);
			$counties->save();

			return redirect()
				->route("admin.location.counties.index")
				->with('success', 'Data successfully saved');
		} catch (QueryException $exception) {
			return redirect()->back()
				->withErrors($exception->getMessage());
		}
	}

	public function list (Request $request) {
		try {
			$page = $request->has('page') ? $request->page : 1;
			if (empty($page)) $page = 1; 
			$search = $request->has('search') ? $request->search : null;
			$limit = 10;

			$counties = County::with(['province'])
				->when($search != null, function ($query) use ($search) {
					$query->where('name', 'LIKE', '%'.$search.'%');
				})
				->take($limit)
				->skip($page - 1)
				->get();

			$total = County::when($search != null, function ($query) use ($search) {
				$query->where('name', 'LIKE', '%'.$search.'%');
			})->count();

			return response()->json([
				"status" => true,
				"message" => null,
				"data" => [
					"list" => $counties,
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
