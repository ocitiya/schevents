<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

use App\Models\App;
use App\Models\User;
use App\Models\UserDetail;

class InstallController extends Controller {
	public function index () {
		$appData = App::count();
		if ($appData > 0) {
			return redirect()->route('install.step2');
		} else {
			return view('install.step1');
		}
	}

	public function storeStep1 (Request $request) {
		$validated = $request->validate([
			'name' => 'required|max:255',
			'logo' => 'required|mimes:jpg,png|max:512',
		]);

		// Upload Image
		if(!Storage::exists("/public/app/image")) Storage::makeDirectory("/public/app/image");

		$file = $request->file('logo');

		$filenameWithExt = $request->file('logo')->getClientOriginalName();
		$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
		$extension = $request->file('logo')->getClientOriginalExtension();

		$filename = $filename.'_'.time().'.'.$extension;
		$path = storage_path('app/public/app/image/').$filename;
		$file->storeAs('public/app/image', $filename);

		// Resize image
		$img = Image::make($file->getRealPath())
			->resize(512, 512, function ($constraint) {
				$constraint->aspectRatio();
			})
			->fit(512, 512, null, 'center')
			->save($path, 80);

		try {
			$model = new App;
			$model->id = Str::uuid();
			$model->name = $request->name;
			$model->logo = $filename;
			$model->save();

			return redirect()->route('install.step2');
		} catch (QueryException $exception) {
			unlink($path);
			return redirect()->back()
				->withErrors($exception->getMessage());
		}
	}

	public function storeStep2 (Request $request) {
		$validated = $request->validate([
			'name' => 'required|max:255',
			'email' => 'required|email',
			'username' => 'required|max:255',
			'password' => 'required|min:6',
			'password_confirmation' => 'required|same:password',
			'gender' => 'required|in:male,female'
		]);

		try {
			$userId = Str::uuid();

			$users = new User;
			$users->id = $userId;
			$users->name = $request->name;
			$users->email = $request->email;
			$users->username = $request->username;
			$users->password = $request->password;
			$users->save();
		} catch (QueryException $exception) {
			return redirect()->back()
				->withErrors($exception->getMessage());
		}

		try {
			$usersDetail = new UserDetail;
			$usersDetail->id = Str::uuid();
			$usersDetail->level = 'sysadmin';
			$usersDetail->gender = $request->gender;
			$usersDetail->save();
		} catch (QueryException $exception) {
			$users = User::find($userId)->delete();
			return redirect()->back()
				->withErrors($exception->getMessage());
		}

		$users = User::find($userId);
		Auth::login($users);

		return redirect()->route('admin.dashboard');
	}

  public function step2 () {
		return view('install.step2');
	}
}
