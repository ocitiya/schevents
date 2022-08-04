<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

use Auth;
use DataTables;
use DateTime;

use Carbon\Carbon;

use App\Models\MatchSchedule;
use App\Models\School;
use App\Models\SportType;
use App\Models\Stadium;
use App\Models\County;
use App\Models\TeamType;

class MatchScheduleController extends Controller {
	public function index (Request $request) {
		return view('admin.match-schedule.index');
	}

	public function city (Request $request, $city_id) {
		$data = ["city" => County::find($city_id)];
		return view('admin.match-schedule.city', $data);
	}

	public function indexInCity (Request $request) {
		return view('admin.match-schedule.index-incity');
	}

	public function inCityCreate (Request $request) {
		$types = SportType::get();
		$cities = County::get();
		$team_types = TeamType::get();

		$data = [
			"types" => $types,
			"cities" => $cities,
			"team_types" => $team_types
		];

		return view('admin.match-schedule.form-incity', $data);
	}

	public function inCityUpdate (Request $request, $id) {
		$types = SportType::get();
		$cities = County::get();
		$team_types = TeamType::get();

		$schedule = MatchSchedule::find($id);
		$dt = new DateTime($schedule->datetime);
		$schedule->date = $dt->format("Y-m-d");
		$schedule->time_hour = $dt->format("H");
		$schedule->time_minute = $dt->format("i");

		$data = [
			"data" => $schedule,
			"types" => $types,
			"cities" => $cities,
			"team_types" => $team_types
		];

		return view('admin.match-schedule.form-incity', $data);
	}

	public function create (Request $request) {
		$types = SportType::get();
		$cities = County::get();
		$team_types = TeamType::get();

		$data = [
			"types" => $types,
			"cities" => $cities,
			"team_types" => $team_types,
			"default_city" => $request->has("city_id") ? $request->city_id : null
		];

		return view('admin.match-schedule.form', $data);
	}

	public function update (Request $request, $id) {
		$types = SportType::get();
		$cities = County::get();
		$team_types = TeamType::get();

		$schedule = MatchSchedule::find($id);
		$dt = new DateTime($schedule->datetime);
		$schedule->date = $dt->format("Y-m-d");
		$schedule->time_hour = $dt->format("H");
		$schedule->time_minute = $dt->format("i");

		$data = [
			"data" => $schedule,
			"types" => $types,
			"cities" => $cities,
			"team_types" => $team_types,
			"default_city" => $request->has("city_id") ? $request->city_id : null
		];

		return view('admin.match-schedule.form', $data);
	}

	public function detail ($id) {
		$schedule = MatchSchedule::with(['school1', 'school2'])->find($id);
		$schedule->sport_type = (object) DB::select("SELECT * FROM sport_types WHERE id = '{$schedule->sport_type_id}'")[0];
		$data = [ "data" => $schedule ];

		return view('admin.match-schedule.detail', $data);
	}

	public function store (Request $request) {
		$validated = $request->validate([
      'sport_type_id' => 'required|uuid',
      'county_id' => 'required|uuid',
      'county2_id' => 'uuid',
      'school1_id' => 'required|uuid',
      'school2_id' => 'required|uuid',
      'stadium' => 'max:255',
			'team_type_id' => 'required|uuid',
			'team_gender' => 'in:boy,girl',
			'date' => 'required|date',
			'time_hour' => 'required|min:0|max:59',
			'time_minute' => 'required|min:0|max:23'
		]);

		$isCreate = $request->id == null ? true : false;

		$schedule = null;
		if ($isCreate) {
			$schedule = new MatchSchedule;
			$schedule->id = Str::uuid();
		} else {
			$schedule = MatchSchedule::find($request->id);
		}

		$school1 = School::find($request->school1_id);
		$school2 = School::find($request->school2_id);

		$level_of_education1 = explode(" ", $school1->level_of_education);
		$level_of_education2 = explode(" ", $school2->level_of_education);

		$level_of_education = [];
		foreach ($level_of_education1 as $item) {
			array_push($level_of_education, $item);
		}

		foreach ($level_of_education2 as $item) {
			if (!in_array($item, $level_of_education)) {
				array_push($level_of_education, $item);
			}
		}

		$level_of_education = implode(",", $level_of_education);

		$datetime = "{$request->date} {$request->time_hour}:{$request->time_minute}";
		$keywords = "{$school1->name},{$school2->name},{$level_of_education}";

		try {
			$schedule->sport_type_id = $request->sport_type_id;
			$schedule->county_id = $request->county_id;
			$schedule->county2_id = $request->county2_id;
			$schedule->school1_id = $request->school1_id;
			$schedule->school2_id = $request->school2_id;
			$schedule->score1 = $request->score1;
			$schedule->score2 = $request->score2;
			$schedule->youtube_link = $request->youtube_link;
			$schedule->stadium = $request->stadium;
			$schedule->team_type_id = $request->team_type_id;
			$schedule->team_gender = $request->team_gender;
			$schedule->datetime = $datetime;
			$schedule->keywords = $keywords;
			$schedule->created_by = Auth::id();
			$schedule->save();

			return redirect()
				->route("admin.match-schedule.city", ["id" => $request->county_id])
				->with('success', 'Schedule successfully saved');
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
			$type = MatchSchedule::find($request->id);
			$type->delete();

			$request->session()->flash('message', "Schedule successfully deleted");
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

	public function latestVideoAPI (Request $request) {
		$page = $request->has('page') ? $request->page : 1;
		if (empty($page)) $page = 1; 
		$limit = $request->has('limit') ? $request->limit : 10;

		$model = MatchSchedule::with([
			"county",
			"school1" => function ($subQuery) {
				return $subQuery->with(['county']);
			},
			"school2" => function ($subQuery) {
				return $subQuery->with(['county']);
			},
			"team_type",
			"sport_type"
		]);

		$date1 = Carbon::now();
		$date2 = Carbon::now()->subDays(7);
		$model = $model->orderBy('datetime')
			->orderBy('created_at', 'desc')
			->whereBetween('datetime', [$date2, $date1]);
		
		$model2 = $model;
		$total = $model2->count();

		$news = $model->take($limit)->skip(($page - 1) * $limit)->get();

		return response()->json([
			"status" => true,
			"message" => null,
			"data" => [
				"list" => $news,
				"pagination" => [
					"total" => $total,
					"page" => (int) $page,
					"limit" => $limit,
					"total_page" => ceil($total / $limit)
				]
			]
		]);
	}

	public function detailAPI ($id) {
		$model = MatchSchedule::with([
			"county",
			"school1" => function ($subQuery) {
				return $subQuery->with(['county']);
			},
			"school2" => function ($subQuery) {
				return $subQuery->with(['county']);
			},
			"team_type",
			"sport_type"
		])
			->find($id);

		return response()->json([
			"data" => $model,
			"status" => true,
			"message" => null
		]);
	}

	public function newsList (Request $request) {
		$page = $request->has('page') ? $request->page : 1;
		if (empty($page)) $page = 1; 
		$limit = $request->has('limit') ? $request->limit : 30;

		$model = MatchSchedule::with([
			"county",
			"school1" => function ($subQuery) {
				return $subQuery->with(['county']);
			},
			"school2" => function ($subQuery) {
				return $subQuery->with(['county']);
			},
			"team_type",
			"sport_type"
		]);

		$type = $request->has('type') ? $request->type : "all";
		switch ($type) {
			case "all":
				break;

			case "minggu-lalu":
				$date1 = Carbon::now()->subDays(14);
				$now2 = Carbon::now()->subDays(7);
				$model->whereBetween('datetime', [$date1, $now2]);
				break;

			case "sudah-bermain":
				$date1 = Carbon::now()->subHours(3);
				$date2 = Carbon::now()->subDays(7);
				$model->whereBetween('datetime', [$date2, $date1]);
				break;

			default: break;
		}
		
		$model2 = $model;
		$total = $model2->count();

		$news = $model->take($limit)->skip(($page - 1) * $limit)->get();

		return response()->json([
			"status" => true,
			"message" => null,
			"data" => [
				"list" => $news,
				"pagination" => [
					"total" => $total,
					"page" => (int) $page,
					"limit" => $limit,
					"total_page" => ceil($total / $limit)
				]
			]
		]);
	}

	public function scoreAPI (Request $request) {
		$page = $request->has('page') ? $request->page : 1;
		if (empty($page)) $page = 1; 
		$limit = $request->has('limit') ? $request->limit : 10;

		$model = MatchSchedule::with([
			"county",
			"school1" => function ($subQuery) {
				return $subQuery->with(['county']);
			},
			"school2" => function ($subQuery) {
				return $subQuery->with(['county']);
			},
			"team_type"
		]);

		$type = $request->has('type') ? $request->type : "sudah-bermain";
		switch ($type) {
			case "all":
				break;

			case "akan-datang":
				$date = Carbon::now()->addDays(7);
				$model->where('datetime', '>', $date);
				break;

			case "hari-ini":
				$date = Carbon::today();
				$model->whereDate('datetime', $date);
				break;

			case "minggu-ini":
				$date1 = Carbon::now()->addDays(7);
				$date2 = Carbon::now()->subHours(2);

				$model->whereBetween('datetime', [$date2, $date1]);
				break;

			case "minggu-lalu":
				$date1 = Carbon::now()->subDays(14);
				$now2 = Carbon::now()->subDays(7);
				$model->whereBetween('datetime', [$date1, $now2]);
				break;

			case "sudah-bermain":
				$date1 = Carbon::now()->subHours(3);
				$date2 = Carbon::now()->subDays(7);
				$model->whereBetween('datetime', [$date2, $date1]);
				break;

			default: break;
		}
		
		$model2 = $model;
		$total = $model2->count();

		$scores = $model->take($limit)->skip(($page - 1) * $limit)->get();
		foreach($scores as $item) {
			$item->sport_type = (object) DB::select("SELECT * FROM sport_types WHERE id = '{$item->sport_type_id}'")[0];
		}
		$groups = [];
		foreach ($scores as $item) {
			// if ($item->sport_type == null) continue;
			$groups[$item->sport_type->name][] = $item;
		}

		return response()->json([
			"status" => true,
			"message" => null,
			"data" => [
				"list" => $groups,
				"pagination" => [
					"total" => $total,
					"page" => (int) $page,
					"limit" => $limit,
					"total_page" => ceil($total / $limit)
				]
			]
		]);
	}

	public function list (Request $request) {
		$showAll = $request->has('showall') ? (boolean) $request->showall : false;
		$school_id = $request->has('school_id') ? $request->school_id : null;

		$page = $request->has('page') ? $request->page : 1;
		if (empty($page)) $page = 1; 
		$limit = $request->has('limit') ? $request->limit : 10;

		$type = $request->has('type') ? $request->type : "all";

		$model = MatchSchedule::with([
			"county",
			"school1" => function ($subQuery) {
				return $subQuery->with(['county']);
			},
			"school2" => function ($subQuery) {
				return $subQuery->with(['county']);
			},
			"team_type",
			"sport_type"
		]);

		switch ($type) {
			case "all":
				break;

			case "have-played":
				$date1 = Carbon::now()->subHours(3);
				$date2 = Carbon::now()->subDays(7);

				$model->whereBetween('datetime', [$date2, $date1]);
				break;

			case "live":
				$date1 = Carbon::now()->subHours(2);
				$date2 = Carbon::now()->addHours(3);

				$model->whereBetween('datetime', [$date1, $date2]);
				break;

			case "this-week":
				$date1 = Carbon::now()->addDays(7);
				$date2 = Carbon::now()->subHours(2);

				$model->whereBetween('datetime', [$date2, $date1]);
				break;

			case "today":
				$date = Carbon::today();
				$model->whereDate('datetime', $date);
				break;
				
			case "upcoming":
			    $date = Carbon::today()->addDays(7);
				$model->whereDate('datetime', '>', $date);
				break;

			default:
				break;
		}

		$model = $model->orderBy('datetime')
			->orderBy('created_at')
			->when($school_id != null, function ($query) use ($school_id) {
				$query->where('school1_id', $school_id)->orWhere('school2_id', $school_id);
			});

		$model2 = $model;
		$total = $model2->count();

		$schedule = $model->when(!$showAll, function ($query) use ($limit, $page) {
			$query->take($limit)->skip(($page - 1) * $limit);
		})->get();

		return response()->json([
			"status" => true,
			"message" => null,
			"data" => [
				"list" => $schedule,
				"pagination" => [
					"total" => $total,
					"page" => !$showAll ? (int) $page : -1,
					"limit" => !$showAll ? $limit : -1,
					"total_page" => !$showAll ? ceil($total / $limit) : 1
				]
			]
		]);
	}

	function cityMatchDatatable () {
		$data = County::withCount('match')->get();
		return Datatables::of($data)->make(true);
	}

	function listDatatable (Request $request) {
		$cityId = isset($request->city_id) ? $request->city_id : null;
		$incity = isset($request->incity) ? (boolean) $request->incity : false;
		$state = $request->state;

		$data = MatchSchedule::with(["county", "county2", "school1", "school2", "team_type", "sport_type"])
			->when($cityId != null, function ($subQuery) use ($cityId) {
				$subQuery->where('county_id', $cityId);
			})
			->when($state == 'minggu-lalu', function ($subQuery) {
				$now1 = Carbon::now()->subDays(14);
				$now2 = Carbon::now()->subDays(7);
				$subQuery->whereBetween('datetime', [$now1, $now2]);
			})
			->when($state == 'sudah-bermain', function ($subQuery) {
				$date1 = Carbon::now()->subHours(3);
				$date2 = Carbon::now()->subDays(7);
				$subQuery->whereBetween('datetime', [$date2, $date1]);
			})
			->when($state == 'hari-ini', function ($subQuery) {
				$date = Carbon::today();
				$subQuery->whereDate('datetime', $date);
			})
			->when($state == 'sedang-bermain', function ($subQuery) {
				$date1 = Carbon::now()->subHours(2);
				$date2 = Carbon::now()->addHours(3);

				$subQuery->whereBetween('datetime', [$date1, $date2]);
			})
			->when($state == 'akan-bermain', function ($subQuery) {
				$date2 = Carbon::now()->addDays(7);
				$subQuery->where('datetime', '>', $date2);
			})
			->when($state == 'minggu-ini', function ($subQuery) {
				$date1 = Carbon::now()->addDays(7);
				$date2 = Carbon::now()->subHours(2);

				$subQuery->whereBetween('datetime', [$date2, $date1]);
			})
			->when($incity, function ($subQuery) {
				$subQuery->whereNotNull('county2_id');
			})
			->get();
		return Datatables::of($data)->make(true);
	}
}
