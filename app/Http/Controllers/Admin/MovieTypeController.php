<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Database\QueryException;
use Yajra\DataTables\Datatables;

use App\Models\MovieType;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class MovieTypeController extends Controller {
	public function index (Request $request) {
		return view('admin.movie_type.index');
	}

	public function create (Request $request) {
		return view('admin.movie_type.form');
	}

	public function update (Request $request, $id) {
		$movieType= MovieType::find($id);
		$data = [
			"data" => $movieType
		];

		return view('admin.movie_type.form', $data);
	}

	public function detail ($id) {
		$movieType= MovieType::find($id);
		$data = [ "data" => $movieType];

		return view('admin.movie_type.detail', $data);
	}

	public function store (Request $request) {
		$isCreate = $request->id == null ? true : false;
		$validation = [
			'name' => 'required|string|max:255'
		];

		$validated = $request->validate($validation);

		$movieType= null;
		if ($isCreate) {
			$movieType= new MovieType();
      $movieType->created_by = Auth::id();
		} else {
			$movieType= MovieType::find($request->id);
      $movieType->updated_by = Auth::id();
		}
		
		try {
			$movieType->name = ucwords($request->name);
			$movieType->save();

			return redirect()
				->route("admin.movie.masterdata.type.index")
				->with('success', 'Jenis film berhasil disimpan!');

		} catch (QueryException $exception) {
			return redirect()->back()
				->withErrors($exception->getMessage());
		}
	}

	public function delete (Request $request) {
		try {
			$movieType= MovieType::find($request->id);
			$movieType->deleted_by = Auth::id();
			$movieType->deleted_at = Carbon::now();
			$movieType->save();

			session()->flash('message', "{$movieType->name} successfully deleted");
			return response()->json([
				"status" => true,
				"message" => null
			]);
		} catch (Exception $e) {
			return response()->json([
				"status" => false,
				"message" => $e->getMessage()
			]);
		}
	}

	public function list (Request $request) {
		$search = $request->has('search') ? $request->search : null;
		$showAll = $request->has('showall') ? (boolean) $request->showall : false;

		$page = $request->has('page') ? $request->page : 1;
		if (empty($page)) $page = 1; 
		$limit = 10;

		$model = MovieType::when($search != null, function ($query) use ($search) {
			$query->where('name', 'LIKE', '%'.$search.'%');
		});

		$movieType= clone($model)->when(!$showAll, function ($query) use ($limit, $page) {
			$query->take($limit)->skip(($page - 1) * $limit);
		})->get();

		$total = $model->count();
		
		return response()->json([
			"status" => true,
			"message" => null,
			"data" => [
				"list" => $movieType,
				"pagination" => [
					"total" => $total,
					"search" => $search,
					"page" => !$showAll ? (int) $page : 1,
					"limit" => !$showAll ? $limit : -1,
					"total_page" => !$showAll ? ceil($total / $limit) : 1
				]
			]
		]);
	}

	public function listDatatable(Request $request) {
		$data = MovieType::get();
		
		return Datatables::of($data)
			->addIndexColumn()
			->make(true);
	}

	public function validateName (Request $request) {
		$data = MovieType::where('name', $request->name)->first();

		if ($data) {
			return response()->json([
				"status" => true,
				"message" => null,
				"data" => false
			]);
		} else {
			return response()->json([
				"status" => true,
				"message" => null,
				"data" => true
			]);
		}
	}
}
