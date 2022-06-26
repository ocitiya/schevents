<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {
	public function login () {
		return view('admin.login');
	}

	public function forgotPassword () {
		return view('admin.forgot-password');
	}

	public function loginAuth (Request $request) {
		$validated = $request->validate([
			'email' => 'required|email',
			'password' => 'required',
		]);

		$credentials = $request->only('email', 'password');
		if (Auth::attempt($credentials)) {
			return redirect()->route('admin.dashboard');
		}

		return redirect()->back()->withErrors('email or password incorrect');
	}

	public function logout (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
		
    return redirect()->route('admin.login')
			->with('success', 'You have successfully logout');
	}
}
