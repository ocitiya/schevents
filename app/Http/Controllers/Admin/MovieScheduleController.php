<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Database\QueryException;
use Yajra\DataTables\Datatables;

use App\Models\Movie;
use App\Models\MovieSchedule;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class MovieScheduleController extends Controller {
	public function index (Request $request) {
		return view('admin.movie_schedule.index');
	}

	public function create (Request $request) {
		$data = [
			"movies" => Movie::get()
		];

		return view('admin.movie_schedule.form', $data);
	}

	public function update (Request $request, $id) {
		$movieSchedule = MovieSchedule::find($id);
		$data = [
			"data" => $movieSchedule,
			"movies" => Movie::get()
		];

		return view('admin.movie_schedule.form', $data);
	}

	public function detail ($id) {
		$movieSchedule = MovieSchedule::find($id);
		$data = [ "data" => $movieSchedule ];

		return view('admin.movie_schedule.detail', $data);
	}

	public function store (Request $request) {
		$isCreate = $request->id == null ? true : false;
		$validation = [
			'movie_id' => 'required|numeric',
      'show_date' => 'required|date',
      'link' => 'required|url'
		];

		$validated = $request->validate($validation);

		$movieSchedule = null;
		if ($isCreate) {
			$movieSchedule = new MovieSchedule();
      $movieSchedule->created_by = Auth::id();
		} else {
			$movieSchedule = MovieSchedule::find($request->id);
      $movieSchedule->updated_by = Auth::id();
		}
		
		try {
			$movieSchedule->movie_id = $request->movie_id;
			$movieSchedule->show_date = $request->show_date;
			$movieSchedule->link = $request->link;
			$movieSchedule->save();

			$movie = Movie::find($request->movie_id);

			return redirect()
				->route("admin.movie.schedule.index")
				->with('success', "Jadwal Film {$movie->name} berhasil disimpan");

		} catch (QueryException $exception) {
			return redirect()->back()
				->withErrors($exception->getMessage());
		}
	}

	public function delete (Request $request) {
		try {
			$movieSchedule = MovieSchedule::find($request->id);

			$movie = Movie::find($movieSchedule->movie_id);

			$movieSchedule->delete();

			session()->flash('message', "Jadwal Film {$movie->name} berhasil dihapus");
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

		$model = MovieSchedule::when($search != null, function ($query) use ($search) {
			$query->where('name', 'LIKE', '%'.$search.'%');
		});

		$movieSchedule = clone($model)->when(!$showAll, function ($query) use ($limit, $page) {
			$query->take($limit)->skip(($page - 1) * $limit);
		})->get();

		$total = $model->count();
		
		return response()->json([
			"status" => true,
			"message" => null,
			"data" => [
				"list" => $movieSchedule,
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
		$data = MovieSchedule::with(["movie", "created_name", "updated_name"])
			->get();
		
		return Datatables::of($data)
			->addIndexColumn()
			->make(true);
	}
}
