<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CountriesController extends Controller {
	public function index () {
		return view('admin.countries.index');
	}

	public function create () {
		return view('admin.countries.form');
	}

	public function update ($id) {
		$data = [
			"id" => $id
		];

		return view('admin.countries.form', $data);
	}
}
