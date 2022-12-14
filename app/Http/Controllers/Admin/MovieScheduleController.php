<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LPMovies;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Database\QueryException;
use Yajra\DataTables\Datatables;

use App\Models\Movie;
use App\Models\MovieSchedule;
use App\Models\OfferCampaign;
use App\Models\OfferChannel;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MovieScheduleController extends Controller {
	protected $now;
  public function __construct(Request $request) {
    if ($request->header('Timezone') != null) {
      $this->now = Carbon::now($request->header('Timezone'))->setTimezone('UTC');
    } else {
      $this->now = Carbon::now();
    }
  }

	public function index (Request $request) {
		return view('admin.movie_schedule.index');
	}

	public function create (Request $request) {
		$data = [
			"movies" => Movie::get(),
			"campaign" => OfferCampaign::get(),
			"channels" => LPMovies::with("channel")->get()
		];

		return view('admin.movie_schedule.form', $data);
	}

	public function update (Request $request, $id) {
		$data = [
			"data" => MovieSchedule::find($id),
			"movies" => Movie::get(),
			"campaign" => OfferCampaign::get(),
			"channels" => LPMovies::with("channel")->get()
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
      'campaign_id' => 'required|int',
      'banner_id' => 'required|int',
      'channel_id' => 'required|int'
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

		$movie = Movie::find($request->movie_id);
		
		try {
			$movieSchedule->movie_id = $request->movie_id;
			$movieSchedule->release_date = $movie->release_date;
			$movieSchedule->campaign_id = $request->campaign_id;
		  $movieSchedule->banner_id = $request->banner_id;
		  $movieSchedule->channel_id = $request->channel_id;
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
		})
			->with(["movie" => function ($query) {
				$query->with(["movie_type" => function ($query) {
					$query->with(["movie_type"]);
				}]);
			}]);

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
    $state = $request->state;

		$model = MovieSchedule::with([
			"created_name", "updated_name",
			"movie" => function ($query) {
				$query->with([
					"movie_type" => function ($query) {
						$query->with(["movie_type"]);
					}
				]);
			},
			"campaign", "banner", "channel"
		])->when(Session::get("role") == "user", function ($q) {
			$q->where("created_by", Auth::id());
		});

		$model = $this->_scheduleType($model, $state);
		$model = $model->get();
		
		return Datatables::of($model)
			->addIndexColumn()
			->make(true);
	}

	public function schedulePreview (Request $request, $id) {
		$model = MovieSchedule::with([
			"movie" => function ($query) {
				$query->with([
					"movie_type" => function ($query) {
						$query->with(["movie_type"]);
					}
				]);
			}
		])
			->find($id);

		if ($model) {
			$types = [];
			foreach ($model->movie->movie_type as $item) {
				array_push($types, $item->movie_type->name);
			}

			$model->movie->types = implode(", ", $types);
			$data = ["data" => $model];
			return view("movie.schedule-preview", $data);
		} else {
			return abort(404);
		}
	}

	private function _scheduleType($model, $type) {
    switch ($type) {
      case "all":
        return $model;

      case "streaming":
        $date = clone($this->now);

				$model->whereDate("release_date", "<=", $date);

        return $model;

      case "upcoming":
        $date = clone($this->now);

        $model->whereDate("release_date", ">", $date);
				return $model;

      default:
        return $model;
    }
  }
}
