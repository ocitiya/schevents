<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class LoginController extends Controller {
	public function login () {
		return view('admin.login');
	}

	public function forgotPassword () {
		return view('admin.forgot-password');
	}

	public function loginAuth (Request $request) {
		$validated = $request->validate([
			'username' => 'required',
			'password' => 'required',
		]);

		$user = User::where("username", $request->username)
			->get("email")
			->first();

		if (!$user) {
			return redirect()->back()->withErrors('username or password incorrect');
		}

		$credentials = ["email" => $user->email, "password" => $request->password];
		if (!Auth::attempt($credentials)) {
			return redirect()->back()->withErrors('username or password incorrect');
		}
		
		return redirect()->route('admin.dashboard')->withInput(
			$request->except("password")
		);
	}

	public function logout (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
		
    return redirect()->route('admin.login')
			->with('success', 'You have successfully logout');
	}
}
