<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InstallController extends Controller {
	public function index () {
		return view('install.step1');
	}

  public function step2 () {
		return view('install.step2');
	}
}
