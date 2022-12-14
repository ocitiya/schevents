<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Carbon;

class LoginController extends Controller {
	public function username(){
    return 'username';
	}

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
			->with(['user_detail'])
			->first();

		if (!$user) {
			return redirect()->back()->withErrors('username or password incorrect');
		}

		if ($user->is_active == 0) {
			return redirect()->back()->withErrors('Akun Anda sudah tidak aktif lagi');
		}

		$credentials = ["username" => $user->username, "password" => $request->password];
		if (!Auth::attempt($credentials)) {
			return redirect()->back()->withErrors('username or password incorrect')
				->withInput(
					$request->except("password")
				);
		}
		
		$userDetail = UserDetail::where("user_id", Auth::id())->first();
		$userDetail->last_login = Carbon::now();
		$userDetail->save();

		$request->session()->put('role', $user->user_detail->level);
		if ($user->is_default == 1) {
			return redirect()->route('admin.change-password');
		} else {
			return redirect()->route('admin.dashboard');
		}
	}

	public function logout (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
		
    return redirect()->route('admin.login')
			->with('success', 'You have successfully logout');
	}

	public function resetRequest (Request $request) {
		$user = User::where("username", $request->username)->first();
		if ($user) {
			$user->is_reset = 1;
			$user->save();
	
			return redirect()->route('admin.login')
				->with('success', 'Password reset has been requested to admin');
		} else {
			return redirect()->route('admin.login')
				->withErrors(['Username does not exist!']);
		}
	}
}
