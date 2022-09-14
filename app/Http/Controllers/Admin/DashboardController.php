<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

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
      if ($request->has("old_password")) {
        if (!Hash::check($request->old_password, $user->password)) {
          return redirect()->back()
            ->withErrors("Old password is not match");
        }
      }

      $user->password = $request->password;
      $user->is_default = 0;
      $user->save();
    } catch (QueryException $exception) {
      return redirect()->back()
        ->withErrors($exception->getMessage());
    }

    return redirect()
      ->route('admin.dashboard')
      ->with('success', "Password successfully saved");
  }

  public function myAccount () {
    $account = User::with(["user_detail"])
      ->find(Auth::id());

    $data = ["data" => $account];

    return view("admin.dashboard.my-account", $data);
  }

  public function myAccountChangePassword () {
    return view("admin.dashboard.my-account-change-password");
  }

  public function myAccountEdit () {
    $user = User::find(Auth::id())->toArray();
    $userDetail = UserDetail ::where("user_id", Auth::id())->first()->toArray();
    unset($user["id"]);

    $data = [
      "data" => (object) array_merge($userDetail, $user)
    ];

    return view("admin.dashboard.my-account-edit", $data);
  }

  public function myAccountStore (Request $request) {
    $validation = [
      'username' => 'required|string|max:255',
      'email' => 'nullable|email',
      'name' => 'required|max:255',
      'telephone' => 'required|string',
      'gender' => 'required|in:female,male',
      'address' => 'required|string',
      'avatar' => 'mimes:jpg,png',
      'facebook' => 'nullable|string',
      'instagram' => 'nullable|string',
      'twitter' => 'nullable|string'
    ];

    $validated = $request->validate($validation);

    // Upload Image
    if ($request->hasFile('avatar')) {
      if(!Storage::exists("/public/user/image")) Storage::makeDirectory("/public/user/image");
      $file = $request->file('avatar');

      $filenameWithExt = $request->file('avatar')->getClientOriginalName();
      $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
      $extension = $request->file('avatar')->getClientOriginalExtension();

      $filename = $filename.'_'.time().'.'.$extension;
      $path = storage_path('app/public/user/image/').$filename;
      $file->storeAs('public/user/image', $filename);

      // Resize image
      $img = Image::make($file->getRealPath())
        ->resize(1024, 1024, function ($constraint) {
          $constraint->aspectRatio();
        })
        ->save($path, 80);
    }
    
    $user = User::find(Auth::id());
    $userDetail = UserDetail::where("user_id", Auth::id())->first();

    if ($request->hasFile('avatar')) {
      $oldPath = storage_path('app/public/user/image/').$userDetail->avatar;
      if (file_exists($oldPath) && !is_dir($oldPath)) {
        unlink($oldPath);
      }
    }
    
    try {
      $user->name = ucwords($request->name);
      $user->email = $request->email;
      $user->username = $request->username;
      
      $userDetail->telephone = $request->telephone;
      $userDetail->gender = $request->gender;
      if ($request->hasFile('avatar')) $userDetail->avatar = $filename;
      $userDetail->address = $request->address;
      $userDetail->facebook = $request->facebook;
      $userDetail->instagram = $request->instagram;
      $userDetail->twitter = $request->twitter;

      $user->save();
      $userDetail->save();

      return redirect()
        ->route("admin.my-account")
        ->with('success', "Data successfully saved");

    } catch (QueryException $exception) {
      if ($request->hasFile('avatar')) unlink($path);

      return redirect()->back()
        ->withErrors($exception->getMessage());
    }
  }
}
