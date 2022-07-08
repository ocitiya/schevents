<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Country;

class CountriesController extends Controller {
	public function index (Request $request) {
		return view('admin.countries.index');
	}

	public function create () {
		return view('admin.countries.form');
	}

	public function update ($id) {
		$countries = Country::find($id);
		$data = [ "data" => $countries ];

		return view('admin.countries.form', $data);
	}

	public function detail ($id) {
		$countries = Country::find($id);
		$data = [ "data" => $countries ];

		return view('admin.countries.detail', $data);
	}

	public function store (Request $request) {
		$validated = $request->validate([
			'name' => 'required|max:255',
			'alpha2_code' => 'required|size:2',
			'dial_code' => 'required'
		]);

		$isCreate = $request->id == null ? true : false;

		$countries = null;
		if ($isCreate) {
			$countries = new Country;
			$countries->id = Str::uuid();
		} else {
			$countries = Country::find($request->id);
		}
		
		try {
			$countries->name = $request->name;
			$countries->alpha2_code = $request->alpha2_code;
			$countries->dial_code = $request->dial_code;
			$countries->save();

			return redirect()
				->route("admin.location.countries.index")
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
			$limit = $request->has('limit') ? $request->limit : 10;

			$countries = Country::when($search != null, function ($query) use ($search) {
				$query->where('name', 'LIKE', '%'.$search.'%');
			})
				->take($limit)
				->skip(($page - 1) * $limit)
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
}
