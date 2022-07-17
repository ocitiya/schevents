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

	public function create () {
		$schools = School::get();
		$types = SportType::get();
		$cities = County::get();
		$team_types = TeamType::get();

		$data = [
			"schools" => $schools,
			"types" => $types,
			"cities" => $cities,
			"team_types" => $team_types
		];

		return view('admin.match-schedule.form', $data);
	}

	public function update ($id) {
		$schools = School::get();
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
			"schools" => $schools,
			"types" => $types,
			"cities" => $cities,
			"team_types" => $team_types
		];
		return view('admin.match-schedule.form', $data);
	}

	public function detail ($id) {
		$schedule = MatchSchedule::with(['school1', 'school2', 'sport_type'])->find($id);
		$data = [ "data" => $schedule ];

		return view('admin.match-schedule.detail', $data);
	}

	public function store (Request $request) {
		$validated = $request->validate([
      'sport_type_id' => 'required|uuid',
      'county_id' => 'required|uuid',
      'school1_id' => 'required|uuid',
      'school2_id' => 'required|uuid',
      'stadium' => 'max:255',
			'team_type_id' => 'required|uuid',
			'team_gender' => 'required|in:boy,girl',
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
			$schedule->school1_id = $request->school1_id;
			$schedule->school2_id = $request->school2_id;
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

	public function list (Request $request) {
		$page = $request->has('page') ? $request->page : 1;
		if (empty($page)) $page = 1; 
		$search = $request->has('search') ? $request->search : null;
		$limit = 10;

		$type = $request->has('type') ? $request->type : "all";

		$schedule = MatchSchedule::with(["county", "school1", "school2", "team_type", "sport_type"]);

		switch ($type) {
			case "all":
				break;

			case "ongoing":

				$schedule->where('datetime', '>=', DB::raw('NOW()'));

				break;

			default:
				break;
		}

		$schedule = $schedule->orderBy('datetime')
			->orderBy('created_at')
			->take($limit)
			->skip(($page - 1) * $limit)
			->get();
		$total = MatchSchedule::count();

		return response()->json([
			"status" => true,
			"message" => null,
			"data" => [
				"list" => $schedule,
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

	function cityMatchDatatable () {
		$data = County::withCount('match')->get();
		return Datatables::of($data)->make(true);
	}

	function listDatatable () {
		$cityId = isset($request->city_id) ? $request->city_id : null;

		$data = MatchSchedule::with(["county", "school1", "school2", "team_type", "sport_type"])
			->when($cityId != null, function ($subQuery) use ($cityId) {
				$subQuery->where('county_id', $cityId);
			})
			->get();
		return Datatables::of($data)->make(true);
	}
}
