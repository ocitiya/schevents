<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Championships;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Yajra\DataTables\Datatables;

use DateTime;
use Carbon\Carbon;

use App\Models\MatchSchedule;
use App\Models\School;
use App\Models\SportType;
use App\Models\Stadium;
use App\Models\County;
use App\Models\TeamType;
use App\Models\Federation;
use App\Models\LPSports;
use App\Models\LPTypes;
use App\Models\OfferChannel;
use App\Models\Sport;
use Illuminate\Support\Facades\Session;

class MatchScheduleController extends Controller {
  protected $now;
  public function __construct(Request $request) {
    if ($request->header('Timezone') != null) {
      $this->now = Carbon::now($request->header('Timezone'))->setTimezone('UTC');
    } else {
      $this->now = Carbon::now();
    }
  }
    
  public function index (Request $request) {
    $federation_id = $request->has('federation_id') ? $request->federation_id : null;

    $data = [ "federation_id" => $federation_id ];
    if ($federation_id != null) {
      $federationName = Federation::find($federation_id)->name;
      $data["federation_name"] = $federationName;
    }

    return view('admin.match-schedule.index', $data);
  }

  public function indexFederation (Request $request) {
    return view('admin.match-schedule.index-federation');
  }

  public function city (Request $request, $city_id) {
    $data = ["city" => County::find($city_id)];
    return view('admin.match-schedule.city', $data);
  }

  public function create (Request $request) {
    $federation_id = $request->has('federation_id') ? $request->federation_id : null;

    $data = [
      "lp_sports" => LPSports::with(["channel", "type"])->get(),
      "team_types" => TeamType::get(),
      "federations" => Federation::get(),
      "federation_id" => $federation_id,
      "stadiums" => Stadium::get(),
      "championships" => Championships::get()
    ];

    return view('admin.match-schedule.form', $data);
  }

  public function update (Request $request, $id) {
    $federation_id = $request->has('federation_id') ? $request->federation_id : null;

    $schedule = MatchSchedule::find($id);
    $dt = new DateTime($schedule->datetime);
    $schedule->date = $dt->format("Y-m-d");
    $schedule->time_hour = $dt->format("H");
    $schedule->time_minute = $dt->format("i");

    $data = [
      "data" => $schedule,
      "lp_sports" => LPSports::with(["channel", "type"])->get(),
      "team_types" => TeamType::get(),
      "federations" => Federation::get(),
      "federation_id" => $federation_id,
      "stadiums" => Stadium::get(),
      "championships" => Championships::get()
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
      'championship_id' => 'nullable|int',
      'federation_id' => 'nullable|uuid',
      'sport_id' => 'required|uuid',
      'school1_id' => 'required|uuid',
      'match_system' => 'in:home,away,neutral',
      'school2_id' => 'required|uuid',
      'match_system2' => 'in:home,away,neutral',
      'score1' => 'nullable|numeric',
      'score2' => 'nullable|numeric',
      'youtube_link' => 'nullable|string',
      'team_gender' => 'in:boy,girl',
      'stadium' => 'nullable|uuid',
      'team_type_id' => 'uuid',
      'date' => 'required|date',
      'time_hour' => 'required|min:0|max:59',
      'time_minute' => 'required|min:0|max:23',
      'lp_type_id' => 'nullable|int',
      'channel_id' => 'nullable|int'
    ]);

    $isCreate = $request->id == null ? true : false;

    $schedule = null;
    if ($isCreate) {
      $schedule = new MatchSchedule;
      $schedule->id = Str::uuid();
      $schedule->created_by = Auth::id();
    } else {
      $schedule = MatchSchedule::find($request->id);
      $schedule->updated_by = Auth::id();
    }

    $school1 = School::with(["county", "association"])->find($request->school1_id);
    $school2 = School::with(["county", "association"])->find($request->school2_id);
    $team_type = TeamType::find($request->team_type_id);

    $federation = null;
    if (!empty($request->federation_id)) {
      $federation = Federation::find($request->federation_id);
    }

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
    $sport = Sport::find($request->sport_id);

    $keywords = 
    $keywords = [
      $school1->name,
      $school2->name,
      $school1->nickname,
      $school2->nickname
    ];

    if (empty($request->championship_id)) {
      if (!empty($school1->association)) {
        $abbr = str_replace("-", "", $school1->association->abbreviation);
        $abbr = str_replace(" ", "", $abbr);
        array_push($keywords, $abbr);
      }
  
      // if (!empty($school2->association)) {
      //   $abbr = str_replace("-", "", $school2->association->abbreviation);
      //   $abbr = str_replace(" ", "", $abbr);
      //   array_push($keywords, $abbr);
      // }
  
      if (!empty($federation)) {
        array_push($keywords, "{$federation->abbreviation}{$sport->name}"); 
      }
    } else {
      $championship = Championships::find($request->championship_id)->name;
      array_push($keywords, $championship); 
    }

    array_push($keywords, $sport->name); 

    $keywords = array_unique($keywords);
    $keywords = implode(",", $keywords);

    try {
      $schedule->championship_id = $request->championship_id;
      $schedule->federation_id = $request->federation_id;
      $schedule->sport_id = $request->sport_id;
      $schedule->school1_id = $request->school1_id;
      $schedule->match_system = $request->match_system;
      $schedule->school2_id = $request->school2_id;
      $schedule->match_system2 = $request->match_system2;
      $schedule->score1 = $request->score1;
      $schedule->score2 = $request->score2;
      $schedule->youtube_link = $request->youtube_link;
      $schedule->team_gender = $request->team_gender;
      $schedule->stadium_id = $request->stadium_id;
      $schedule->team_type_id = $team_type->id;
      $schedule->datetime = $datetime;
      $schedule->keywords = $keywords;
      $schedule->lp_type_id = $request->lp_type_id;
      $schedule->channel_id = $request->channel_id;
      $schedule->save();

      if (isset($request->isDefaultFederation)) {
        return redirect()
          ->route("admin.match-schedule.index", [ "federation_id" => $request-> federation_id ])
          ->with('success', 'Schedule successfully saved');
      } else {
        return redirect()
          ->route("admin.match-schedule.index")
          ->with('success', 'Schedule successfully saved');
      }
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

      session()->flash('message', "Schedule successfully deleted");
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

  public function deleteAll (Request $request) {
    $validated = $request->validate([
      'state' => 'required|in:have-played,last-week,old-data'
    ]);

    try {
      $stateText = null;
      if ($request->state == 'have-played') {
        $stateText = 'sudah bermain';
      } else if ($request->state == 'last-week') {
        $stateText = 'minggu lalu';
      } else if ($request->state == 'old-data') {
        $stateText = 'data lama';
      }
      
      $model = new MatchSchedule;
      $model = $this->_scheduleType($model, $request->state);

      $model->delete();

      session()->flash('message', "Schedule {$stateText} successfully deleted");
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
    $model = $this->_scheduleType($model, $type);

    $total = clone($model)->count();
    $news = clone($model)->take($limit)->skip(($page - 1) * $limit)->get();

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

    $type = $request->has('type') ? $request->type : "have-played";

    $model = $this->_scheduleType($model, $type);
    $total = clone($model)->count();

    $scores = clone($model)->take($limit)->skip(($page - 1) * $limit)->get();
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
    $federation_id = $request->has('federation_id') ? $request->federation_id : null;
    $sport_id = $request->has('sport_id') ? $request->sport_id : null;
    $date = $request->has('date') ? $request->date : null;

    $page = $request->has('page') ? $request->page : 1;
    if (empty($page)) $page = 1; 
    $limit = $request->has('limit') ? $request->limit : 10;

    $type = $request->has('type') ? $request->type : "all";

    $model = MatchSchedule::with([
      "county",
      "school1" => function ($subQuery) {
        $subQuery->with(['county', 'municipality']);
      },
      "school2" => function ($subQuery) {
        $subQuery->with(['county', 'municipality']);
      },
      "team_type",
      "sport_type" => function ($subQuery) {
        $subQuery->with(["sport"]);
      },
      "federation",
      "stadium"
    ]);

    $model = $this->_scheduleType($model, $type);
    $model = $model->when($school_id != null, function ($query) use ($school_id) {
      return $query->where('school1_id', $school_id)
        ->orWhere('school2_id', $school_id);
    })->when($federation_id != null, function ($query) use ($federation_id) {
      return $query->where('federation_id', $federation_id);
    })->when($sport_id != null, function ($query) use ($sport_id) {
      return $query->where('sport_type_id', $sport_id);
    })->when($date != null, function ($query) use ($date) {
      return $query->whereDate('datetime', $date);
    })
      ->orderBy('datetime')
      ->orderBy('created_at');

    $total = clone($model);
    $total = $total->count();

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
    $state = $request->state;

    $model = MatchSchedule::with([
      "school1" => function ($query) {
        return $query->with(["municipality", "county"]);
      },
      "school2" => function ($query) {
        return $query->with(["municipality", "county"]);
      },
      "sport",
      "team_type",
      "stadium",
      "sport_type" => function ($q) {
        $q->withTrashed()->with(["sport"]);
      },
      "createdBy" => function ($query) {
        return $query->select("id", "username", "name");
      },
      "updatedBy" => function ($query) {
        return $query->select("id", "username", "name");
      },
      "federation", "lp_type", "channel", "championship"
    ])
      ->when($request->federation_id != null, function ($query) use ($request) {
        $query->where("federation_id", $request->federation_id);
      })
      ->when(Session::get("role") == "user", function ($q) {
        $q->where("created_by", Auth::id());
      });

    $model = $this->_scheduleType($model, $state);
    $model = $model->get();
      
    return Datatables::of($model)->make(true);
  }

  function listOnFederation (Request $request) {
    $model = Federation::withCount("matchSchedule");
    $model = $model->get();
      
    return Datatables::of($model)->make(true);
  }

  private function _scheduleType($model, $type) {
    switch ($type) {
      case "all":
        return $model;

      case "old-data":
        $date = clone($this->now);
        $date = $date->subDays(14);

        return $model->whereDate('datetime', '<', $date);

      case "last-week":
        $date1 = clone($this->now);
        $date1 = $date1->subDays(14);

        $date2 = clone($this->now);
        $date2 = $date2->subDays(7);

        return $model->whereBetween('datetime', [$date1, $date2]);

      case "have-played":
        $date1 = clone($this->now);
        $date1 = $date1->subHours(3);

        $date2 = clone($this->now);
        $date2 = $date2->subDays(7);

        return $model->whereBetween('datetime', [$date2, $date1]);

      case "live":
        $date1 = clone($this->now);
        $date1 = $date1->subHours(2);

        $date2 = clone($this->now);
        $date2 = $date2->addHours(3);

        return $model->whereBetween('datetime', [$date1, $date2]);

      case "today":
        $date1 = clone($this->now);
        $date1 = $date1->today();

        // return $model->whereBetween('datetime', [$date2, $date1]);
        return $model->whereDate('datetime', $date1);

      case "tomorrow":
        $date1 = clone($this->now);
        $date1 = $date1->addDays(1);

        return $model->whereDate('datetime', $date1);

      case "this-week":
        $date1 = clone($this->now);
        $date1 = $date1->addDays(7);

        $date2 = clone($this->now);
        $date2 = $date2->addHours(12);

        return $model->whereBetween('datetime', [$date2, $date1]);
        
      case "upcoming":
        $date = clone($this->now);
        $date = $date->addDays(7);

        return $model->whereDate('datetime', '>', $date);

      default:
        return $model;
    }
  }

  function schedulePreview (Request $request, $id) {
    $model = MatchSchedule::with([
      "county",
      "school1" => function ($subQuery) {
        return $subQuery->with(['county']);
      },
      "school2" => function ($subQuery) {
        return $subQuery->with(['county']);
      },
      "team_type",
      "sport_type" => function ($q) {
        $q->withTrashed();
      }
    ])
      ->find($id);

    if ($model) {
      $model->federation = Federation::find($model->federation_id);

      $data = ["data" => $model];
      return view("shedule-preview", $data);
    } else {
      return abort(404);
    }
  }
}
