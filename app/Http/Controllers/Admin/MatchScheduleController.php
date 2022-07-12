<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Database\QueryException;

use DateTime;

use App\Models\MatchSchedule;
use App\Models\School;
use App\Models\SportType;

class MatchScheduleController extends Controller {
	public function index (Request $request) {
		return view('admin.match-schedule.index');
	}

	public function create () {
		$schools = School::get();
		$types = SportType::get();

		$data = [
			"schools" => $schools,
			"types" => $types
		];

		return view('admin.match-schedule.form', $data);
	}

	public function update ($id) {
    $schools = School::get();
		$types = SportType::get();

		$schedule = MatchSchedule::find($id);
		$dt = new DateTime($schedule->datetime);
		$schedule->date = $dt->format("Y-m-d");
		$schedule->time_hour = $dt->format("H");
		$schedule->time_minute = $dt->format("i");

		$data = [
			"data" => $schedule,
			"schools" => $schools,
			"types" => $types
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
      'school1_id' => 'required|uuid',
      'school2_id' => 'required|uuid',
			'team_gender' => 'required|in:all,male,female',
			'link' => 'required|url',
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
			$schedule->school1_id = $request->school1_id;
			$schedule->school2_id = $request->school2_id;
			$schedule->team_gender = $request->team_gender;
			$schedule->datetime = $datetime;
			$schedule->link = $request->link;
			$schedule->keywords = $keywords;
			$schedule->save();

			return redirect()
				->route("admin.match-schedule.index")
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

		$schedule = MatchSchedule::take($limit)
			->skip($page - 1)
			->with(["school1", "school2"])
			->orderBy('datetime')
			->get();

		$total = MatchSchedule::orderBy('datetime')
			->count();

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
}
