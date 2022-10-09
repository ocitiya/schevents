<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Database\QueryException;
use Yajra\DataTables\Datatables;

use App\Models\AppFollowUs;

class AppFollowUsController extends Controller {
	public function index () {
		return view('admin.app_follow_us.index');
	}

	public function create () {
    $data = [ "follow_us" => AppFollowUs::get() ];

		return view('admin.app_follow_us.form', $data);
	}

	public function update($id) {
		$data = ["data" => AppFollowUs::find($id)];

		return view('admin.app_follow_us.form', $data);
	}

	public function detail($id) {
		$data = ["data" => AppFollowUs::find($id)];

		return view('admin.app_follow_us.detail', $data);
	}

	public function store (Request $request) {
		$isCreate = $request->id == null ? true : false;
		$validation = [
			'type' => 'required|in:facebook,instagram,twitter',
			'image' => 'nullable|mimes:jpg,png',
			'link' => 'required|url'
		];

		$validated = $request->validate($validation);

		// Upload Image
		if ($request->hasFile('image')) {
			if(!Storage::exists("/public/app_follow_us/image")) Storage::makeDirectory("/public/app_follow_us/image", 0755);
			$file = $request->file('image');

			$filenameWithExt = $request->file('image')->getClientOriginalName();
			$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
			$extension = $request->file('image')->getClientOriginalExtension();

			$filename = $filename.'_'.time().'.'.$extension;
			$path = storage_path('app/public/app_follow_us/image/').$filename;
			$file->storeAs('public/app_follow_us/image', $filename);

			// Resize image
			$img = Image::make($file->getRealPath())
				->resize(1024, 1024, function ($constraint) {
					$constraint->aspectRatio();
				})
				->save($path, 80);
		}

		$follow_us = null;
		if ($isCreate) {
			$follow_us = new AppFollowUs;
		} else {
			$follow_us = AppFollowUs::find($request->id);
			if ($request->hasFile('image')) {
				$oldPath = storage_path('app/public/app_follow_us/image/').$follow_us->image;
				if (file_exists($oldPath) && !is_dir($oldPath)) {
					unlink($oldPath);
				}
			}
		}
		
		try {
			$follow_us->type = $request->type;
			if ($request->hasFile('image')) $follow_us->logo = $filename;
			$follow_us->link = $request->link;
			$follow_us->save();

			return redirect()
				->route("admin.app.follow_us.index")
				->with('success', 'Data successfully saved');

		} catch (QueryException $exception) {
			if ($request->hasFile('image')) unlink($path);
			return redirect()->back()
				->withErrors(["error" => $exception->getMessage()]);
		}
	}

	public function delete (Request $request) {
		$validated = $request->validate([ 'id' => 'required' ]);

		try {
			$follow_us = AppFollowUs::find($request->id);
			$oldPath = storage_path('app/public/app_follow_us/image/').$follow_us->logo;
			if (file_exists($oldPath) && !is_dir($oldPath)) {
				unlink($oldPath);
			}
			$follow_us->delete();

			session()->flash('message', "Data successfully deleted");
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
		$showAll = $request->has('showall') ? (boolean) $request->showall : false;

		$page = $request->has('page') ? $request->page : 1;
		if (empty($page)) $page = 1; 
		$limit = 10;

		$model = new AppFollowUs();

		$total = clone($model);
		$total = $total->count();

		$types = $model->when(!$showAll, function ($query) use ($limit, $page) {
			$query->take($limit)->skip(($page - 1) * $limit);
		})->get();

		return response()->json([
			"status" => true,
			"message" => null,
			"data" => [
				"list" => $types,
				"pagination" => [
					"total" => $total,
					"page" => !$showAll ? (int) $page : -1,
					"limit" => !$showAll ? $limit : -1,
					"total_page" => !$showAll ? ceil($total / $limit) : 1
				]
			]
		]);
	}

	public function listDatatable(Request $request) {
		$data = AppFollowUs::get();
		return Datatables::of($data)->make(true);
	}
}
