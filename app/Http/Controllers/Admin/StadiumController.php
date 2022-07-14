<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Database\QueryException;

use App\Models\Country;
use App\Models\Stadium;

class StadiumController extends Controller {
	public function index (Request $request) {
		return view('admin.stadium.index');
	}

	public function create (Request $request) {
		$data = [
			"default_city" => $request->has("city_id") ? $request->city_id : null
		];

		return view('admin.stadium.form', $data);
	}

	public function update ($id) {
		$types = Stadium::find($id);

		$data = [ "data" => $types ];
		return view('admin.stadium.form', $data);
	}

	public function detail ($id) {
		$types = Stadium::find($id);
		$data = [ "data" => $types ];

		return view('admin.stadium.detail', $data);
	}

	public function store (Request $request) {
		$validated = $request->validate([
			'name' => 'required|max:255',
			'county_id' => 'required|uuid',
		]);

		$isCreate = $request->id == null ? true : false;

		$stadium = null;
		if ($isCreate) {
			$stadium = new Stadium;
			$stadium->id = Str::uuid();
		} else {
			$stadium = Stadium::find($request->id);
		}

		try {
			$stadium->name = $request->name;
			$stadium->country_id = Country::first()->id;
			$stadium->county_id = $request->county_id;
			$stadium->save();

			return redirect()->route('admin.stadium.index');
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
			$type = Stadium::find($request->id);
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

		$stadiums = Stadium::with(['county'])
			->when($search != null, function ($query) use ($search) {
        $query->where('name', 'LIKE', '%'.$search.'%');
      })
      ->take($limit)
			->skip($page - 1)
			->get();

		$total = Stadium::when($search != null, function ($query) use ($search) {
			$query->where('name', 'LIKE', '%'.$search.'%');
		})->count();

		return response()->json([
			"status" => true,
			"message" => null,
			"data" => [
				"list" => $stadiums,
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
