<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class DashboardController extends Controller {
	public function index () {
		return view('admin.dashboard.index');
	}

	public function changePassword () {
		return view('admin.change-password');
	}

	public function updatePassword (Request $request) {
		$validated = $request->validate([
			'password' => 'required|min:6',
			'password_confirmation' => 'required|same:password'
		]);

		try {
			$user = User::find(Auth::id());
			$user->password = $request->password;
			$user->is_default = 0;
			$user->save();
		} catch (QueryException $exception) {
			return redirect()->back()
				->withErrors($exception->getMessage());
		}

		return redirect()->route('admin.dashboard');
	}
}
