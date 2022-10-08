<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Database\QueryException;
use Yajra\DataTables\Datatables;

use App\Models\Banner;

class BannerController extends Controller {
	public function index () {
		return view('admin.banner.index');
	}

	public function create () {
		return view('admin.banner.form');
	}

	public function update ($id) {
		$banners = Banner::find($id);
		$data = [ "data" => $banners ];

		return view('admin.banner.form', $data);
	}

	public function detail ($id) {
		$banners = Banner::find($id);
		$data = [ "data" => $banners ];

		return view('admin.banner.detail', $data);
	}

	public function store (Request $request) {
		$isCreate = $request->id == null ? true : false;

		// Upload Image
		if ($request->hasFile('image')) {
			if(!Storage::exists("/public/banner/image")) Storage::makeDirectory("/public/banner/image");
			$file = $request->file('image');

			$filenameWithExt = $request->file('image')->getClientOriginalName();
			$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
			$extension = $request->file('image')->getClientOriginalExtension();

			$filename = $filename.'_'.time().'.'.$extension;
			$path = storage_path('app/public/banner/image/').$filename;
			$file->storeAs('public/banner/image', $filename);

			// Resize image
			$img = Image::make($file->getRealPath())
				->resize(1024, 1024, function ($constraint) {
					$constraint->aspectRatio();
				})
				->save($path, 80);
		}

		$banner = null;
		if ($isCreate) {
			$banner = new Banner;
		} else {
			$banner = Banner::find($request->id);
      $oldPath = storage_path('app/public/banner/image/').$banner->image;
      if (file_exists($oldPath)) {
        unlink($oldPath);
			}
		}
		
		try {
			$banner->image = $filename;
			$banner->save();

      return redirect()
        ->route("admin.app.banner.index")
        ->with('success', 'Data successfully saved');

		} catch (QueryException $exception) {
			unlink($path);
			return redirect()->back()
				->withErrors($exception->getMessage());
		}
	}

	public function delete (Request $request) {
		try {
			$banner = Banner::find($request->id);
      $oldPath = storage_path('app/public/banner/image/').$banner->image;
      if (file_exists($oldPath)) {
        unlink($oldPath);
			}
			$banner->delete();

			session()->flash('message', "Banner successfully deleted");
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

		$model = new Banner;

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
					"page" => !$showAll ? (int) $page : 1,
					"limit" => !$showAll ? $limit : -1,
					"total_page" => !$showAll ? ceil($total / $limit) : 1
				]
			]
		]);
	}

	public function listDatatable() {
		$data = Banner::get();
		
		return Datatables::of($data)->make(true);
	}
}
