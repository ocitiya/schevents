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
use App\Models\MovieMovieType;
use App\Models\MovieType;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MovieController extends Controller {
	public function index (Request $request) {
		return view('admin.movie.index');
	}

	public function create (Request $request) {
		$data = [
			"movieTypes" => MovieType::get()
		];

		return view('admin.movie.form', $data);
	}

	public function update (Request $request, $id) {
		$movie = Movie::find($id);
		$types = MovieMovieType::where("movie_id", $id)
			->pluck("movie_type_id");

		$movie->movie_type_id = json_encode($types);
		
		$data = [
			"data" => $movie,
			"movieTypes" => MovieType::get()
		];

		return view('admin.movie.form', $data);
	}

	public function detail ($id) {
		$movie = Movie::with(["movie_type" => function ($query) {
			$query->with(["movie_type"]);
		}])->find($id);
		
		return response()->json([
			"status" => true,
			"message" => false,
			"data" => $movie
		]);
	}

	public function store (Request $request) {
		$isCreate = $request->id == null ? true : false;
		$validation = [
			'name' => 'required|string|max:255',
			'movie_type_id' => 'required|array',
      'director' => 'nullable|string|max:255',
      'produced_by' => 'nullable|string|max:255',
      'cast' => 'nullable|string|max:255',
      'filmmaker' => 'nullable|string|max:255',
      'music_director' => 'nullable|string|max:255',
      'description' => 'nullable|string|max:255',
      'duration' => 'nullable|string|max:255',
			'image' => 'nullable|mimes:jpg,png',
      'release_date' => 'nullable|date|max:255'
		];

		$validated = $request->validate($validation);

		// Upload Image
		if ($request->hasFile('image')) {
			if(!Storage::exists("/public/movie/image")) Storage::makeDirectory("/public/movie/image");
			$file = $request->file('image');

			$filenameWithExt = $request->file('image')->getClientOriginalName();
			$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
			$filename = preg_replace('/\s+/', '', $filename);
			$extension = $request->file('image')->getClientOriginalExtension();

			$filename = $filename.'_'.time().'.'.$extension;
			$path = storage_path('app/public/movie/image/').$filename;
			$file->storeAs('public/movie/image', $filename);

			// Resize image
			$img = Image::make($file->getRealPath())
				->resize(1024, 1024, function ($constraint) {
					$constraint->aspectRatio();
				})
				->save($path, 80);
		}
		
		$movie = null;
		if ($isCreate) {
			$movie = new Movie();
      $movie->created_by = Auth::id();
		} else {
			$movie = Movie::find($request->id);
      $movie->updated_by = Auth::id();

			if ($request->hasFile('image')) {
				$oldPath = storage_path('app/public/movie/image/').$movie->image;
				if (file_exists($oldPath) && !is_dir($oldPath)) {
					unlink($oldPath);
				}
			}
		}
		
		try {
			DB::beginTransaction();

			$movie->name = ucwords($request->name);
			$movie->director = $request->director;
			$movie->produced_by = $request->produced_by;
			$movie->cast = $request->cast;
			$movie->filmmaker = $request->filmmaker;
			$movie->music_director = $request->music_director;
			$movie->description = $request->description;
			$movie->duration = $request->duration;
			if ($request->hasFile('image')) $movie->image = $filename;
			$movie->release_date = $request->release_date;
			$movie->save();

			$types = MovieMovieType::where("movie_id", $movie->id)->get();
			foreach($types as $item) {
				$item->delete();
			}

			foreach ($request->movie_type_id as $item) {
				$movie_type_list = new MovieMovieType;
				$movie_type_list->movie_id = $movie->id;
				$movie_type_list->movie_type_id = $item;
				$movie_type_list->save();
			}

			DB::commit();

			return redirect()
				->route("admin.movie.index")
				->with('success', "Film {$movie->name} berhasil disimpan");

		} catch (QueryException $exception) {
			DB::rollBack();

			if ($request->hasFile('image')) unlink($path);
			return redirect()->back()
				->withErrors($exception->getMessage());
		}
	}

	public function delete (Request $request) {
		try {
			$movie = Movie::find($request->id);
			$movie->deleted_at = Carbon::now();
			$movie->deleted_by = Auth::id();
			$movie->save();

			session()->flash('message', "Film {$movie->name} berhasil dihapus");
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

		$model = Movie::when($search != null, function ($query) use ($search) {
			$query->where('name', 'LIKE', '%'.$search.'%');
		})
			->orderBy("release_date", "DESC")
			->with([
				"movie_type" => function ($query) {
					$query->with(["movie_type"]);
				}
			]);

		$movie = clone($model)->when(!$showAll, function ($query) use ($limit, $page) {
			$query->take($limit)->skip(($page - 1) * $limit);
		})->get();

		$total = $model->count();
		
		return response()->json([
			"status" => true,
			"message" => null,
			"data" => [
				"list" => $movie,
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
		$data = Movie::with(["movie_type" => function ($q) {
			$q->with(["movie_type"]);
		}])
			->get();
		
		return Datatables::of($data)
			->addIndexColumn()
			->make(true);
	}

	public function validateName (Request $request) {
		$data = Movie::where('name', $request->name)->first();

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
