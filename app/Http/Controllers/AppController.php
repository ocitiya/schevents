<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

use App\Models\App;
use App\Models\Championships;
use App\Models\Event;
use App\Models\School;
use App\Models\Sport;

class AppController extends Controller {
	public function detail () {
    try {
      return response()->json([
        "status" => true,
        "message" => null,
        "data" => App::select("name", "description", "logo")->first()
      ]);
    } catch (QueryException $exception) {
			return response()->json([
        "status" => false,
        "message" => null,
        "data" => null
      ]);
    }
  }

  public function countData () {
    try {
      $data = [
        "event_score" => Championships::count(),
        "sport_score" => Sport::count(),
        "team_score" => School::count()
      ];

      return response()->json([
        "status" => true,
        "message" => null,
        "data" => $data
      ]);
    } catch (QueryException $exception) {
			return response()->json([
        "status" => false,
        "message" => null,
        "data" => null
      ]);
    }
  }
}
