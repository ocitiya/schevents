<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Database\QueryException;
use Yajra\DataTables\Datatables;

use App\Models\UserDetail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserDetailController extends Controller {
  public function index () {
    return view('admin.user.index');
  }

  public function create () {
    return view('admin.user.form');
  }

  public function update ($id) {
    $userDetail = UserDetail::find($id)->toArray();
    $user = User::find($userDetail["user_id"])->toArray();
    unset($user["id"]);

    $data = [
      "data" => (object) array_merge($userDetail, $user)
    ];

    return view('admin.user.form', $data);
  }

  public function detail ($id) {
    $types = UserDetail::find($id);
    $data = [ "data" => $types ];

    return view('admin.user.detail', $data);
  }

  public function store (Request $request) {
    $isCreate = $request->id == null ? true : false;
    $validation = [
      'username' => 'required|string|max:255',
      'email' => 'nullable|email',
      'name' => 'required|max:255',
      'level' => 'required|in:superadmin,admin,user',
      'telephone' => 'required|string',
      'gender' => 'required|in:female,male',
      'address' => 'required|string',
      'avatar' => 'mimes:jpg,png',
      'facebook' => 'nullable|string',
      'instagram' => 'nullable|string',
      'twitter' => 'nullable|string'
    ];

    if ($isCreate) {
      array_merge($validation, [ 'password' => 'required|string', ]);
    }
      
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
    
    $user = null;
    $userDetail = null;
    if ($isCreate) {
      $user = new User();
      $user->id = Str::uuid();
      $user->is_default = 1;
      $user->is_active = 1;
      $user->password = $request->password;

      $userDetail = new UserDetail();
      $userDetail->id = Str::uuid();
      $userDetail->user_id = $user->id;
    } else {
      $userDetail = UserDetail::find($request->id);
      $user = User::find($userDetail->user_id);
      $user->is_active = $request->has("is_active") ? 1: 0;

      if ($request->hasFile('avatar')) {
        $oldPath = storage_path('app/public/user/image/').$userDetail->avatar;
        if (file_exists($oldPath) && !is_dir($oldPath)) {
          unlink($oldPath);
        }
      }
    }
    
    try {
      $user->name = ucwords($request->name);
      $user->email = $request->email;
      $user->username = $request->username;

      $userDetail->level = $request->level;
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
        ->route("admin.user.index")
        ->with('success', "User {$user->name} successfully saved");

    } catch (QueryException $exception) {
      if ($request->hasFile('avatar')) unlink($path);

      return redirect()->back()
        ->withErrors($exception->getMessage());
    }
  }

  public function delete (Request $request) {
    $validated = $request->validate([
      'id' => 'required|uuid'
    ]);

    try {
      $userDetail = UserDetail::find($request->id);
      $user = User::find($userDetail->user_id);
      $user->delete();
      $userDetail->delete();

      session()->flash('message', "User {$user->name} successfully deleted");
      return response()->json([
        "status" => true,
        "message" => null
      ]);
    } catch (QueryException $exception) {
      return response()->json([
        "status" => false,
        "message" => $exception->getMessage()
      ]);
    }
  }

  public function list (Request $request) {
    $search = $request->has('search') ? $request->search : null;
    $showAll = $request->has('showall') ? (boolean) $request->showall : false;

    $page = $request->has('page') ? $request->page : 1;
    if (empty($page)) $page = 1; 
    $limit = 10;

    $model = UserDetail::when($search != null, function ($query) use ($search) {
      $query->where('name', 'LIKE', '%'.$search.'%');
    })->with(["user"]);

    $types = clone($model)->when(!$showAll, function ($query) use ($limit, $page) {
      $query->take($limit)->skip(($page - 1) * $limit);
    })->get();

    $total = $model->count();
    
    return response()->json([
      "status" => true,
      "message" => null,
      "data" => [
        "list" => $types,
        "pagination" => [
          "total" => $total,
          "search" => $search,
          "page" => !$showAll ? (int) $page : 1,
          "limit" => !$showAll ? $limit : -1,
          "total_page" => !$showAll ? ceil($total / $limit) : 1
        ]
      ]
    ]);
  }

  public function listDatatable(Request $request) {
    $data = UserDetail::with(["user"])
      ->whereHas("user")
      ->get();
    
    return Datatables::of($data)->make(true);
  }

  public function validateUser (Request $request) {
    $data = User::where('username', $request->username)->first();

    if ($data) {
      return response()->json([
        "status" => true,
        "message" => null,
        "data" => false
      ]);
    } else {
      return response()->json([
        "status" => true,
        "message" => null,
        "data" => true
      ]);
    }
  }
}
