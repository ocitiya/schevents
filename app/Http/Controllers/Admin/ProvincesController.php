<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Country;
use App\Models\Province;

class ProvincesController extends Controller {
	public function index (Request $request) {
		$page = $request->has('page') ? $request->page : 1;
		if (empty($page)) $page = 1; 
		$search = $request->has('search') ? $request->search : null;
		$limit = 10;

		$provinces = Province::with(['country'])
      ->when($search != null, function ($query) use ($search) {
        $query->where('name', 'LIKE', '%'.$search.'%');
      })
      ->take($limit)
			->skip($page - 1)
			->get();

		$total = Province::when($search != null, function ($query) use ($search) {
			$query->where('name', 'LIKE', '%'.$search.'%');
		})->count();

		$data = [
			"provinces" => $provinces,
			"total" => $total,
			"page" => $page,
			"search" => $search,
			"total_page" => ceil($total / $limit)
		];

		return view('admin.provinces.index', $data);
	}

	public function create () {
    $countries = Country::get();
    
    $data = [ "countries" => $countries ];
		return view('admin.provinces.form', $data);
	}

	public function update ($id) {
    $countries = Country::get();
		$provinces = Province::find($id);

		$data = [ "data" => $provinces, "countries" => $countries ];
		return view('admin.provinces.form', $data);
	}

	public function detail ($id) {
		$provinces = Province::with(['country'])->find($id);
		$data = [ "data" => $provinces ];

		return view('admin.provinces.detail', $data);
	}

	public function store (Request $request) {
		$validated = $request->validate([
      'country_id' => 'required|uuid',
			'name' => 'required|max:255'
		]);

		$isCreate = $request->id == null ? true : false;

		$provinces = null;
		if ($isCreate) {
			$provinces = new Province;
			$provinces->id = Str::uuid();
		} else {
			$provinces = Province::find($request->id);
		}
		
		try {
			$provinces->country_id = $request->country_id;
			$provinces->name = ucwords($request->name);
			$provinces->save();

			return redirect()
				->route("admin.location.provinces.index")
				->with('success', 'Data successfully saved');
		} catch (QueryException $exception) {
			return redirect()->back()
				->withErrors($exception->getMessage());
		}
	}
}
