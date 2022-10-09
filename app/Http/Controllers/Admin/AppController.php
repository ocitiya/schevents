<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Database\QueryException;
use Yajra\DataTables\Datatables;

use App\Models\App;

class AppController extends Controller {
	public function update() {
		$data = ["data" => App::first()];

		return view('admin.app.form', $data);
	}

	public function detail() {
		$data = ["data" => App::first()];

		return view('admin.app.detail', $data);
	}

	public function store (Request $request) {
		$validation = [
			'name' => 'required|string',
			'logo' => 'nullable|mimes:jpg,png',
			'description' => 'required|string'
		];

		$validated = $request->validate($validation);

		// Upload Image
		if ($request->hasFile('image')) {
			if(!Storage::exists("/public/app/image")) Storage::makeDirectory("/public/app/image");
			$file = $request->file('image');

			$filenameWithExt = $request->file('image')->getClientOriginalName();
			$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
			$extension = $request->file('image')->getClientOriginalExtension();

			$filename = $filename.'_'.time().'.'.$extension;
			$path = storage_path('app/public/app/image/').$filename;
			$file->storeAs('public/app/image', $filename);

			// Resize image
			$img = Image::make($file->getRealPath())
				->resize(1024, 1024, function ($constraint) {
					$constraint->aspectRatio();
				})
				->save($path, 80);
		}

		$app = App::find($request->id);
		if ($request->hasFile('image')) {
			$oldPath = storage_path('app/public/app/image/').$app->image;
			if (file_exists($oldPath) && !is_dir($oldPath)) {
				unlink($oldPath);
			}
		}
		
		try {
			if ($request->hasFile('image')) $app->logo = $filename;
			$app->description = $request->description;
			$app->save();

			return redirect()
				->route("admin.app.profile.detail")
				->with('success', 'Data successfully saved');

		} catch (QueryException $exception) {
			if ($request->hasFile('image')) unlink($path);
			return redirect()->back()
				->withErrors(["error" => $exception->getMessage()]);
		}
	}
}
