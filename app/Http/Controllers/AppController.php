<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

use App\Models\App;

class AppController extends Controller {
	public function detail () {
    try {
      return response()->json([
        "status" => true,
        "message" => null,
        "data" => App::first()
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
