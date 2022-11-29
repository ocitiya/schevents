<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Championships;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Database\QueryException;
use Yajra\DataTables\Datatables;

use App\Models\User;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ChampionshipController extends Controller {
	public function index () {
		return view('admin.championship.index');
	}

	public function create () {
		return view('admin.championship.form');
	}

	public function update ($id) {
		$data = [ "data" => Championships::find($id) ];

		return view('admin.championship.form', $data);
	}

	public function detail ($id) {
		$data = [ "data" => Championships::find($id) ];

		return view('admin.offers.detail', $data);
	}

	public function store (Request $request) {
		$isCreate = $request->id == null ? true : false;
		$validation = [
      'name' => 'required|string',
			'image' => 'nullable|mimes:jpg,png'
		];

		$validated = $request->validate($validation);
		$path = "";

		if ($request->hasFile('image')) {
			if(!Storage::exists("/public/championship/image")) Storage::makeDirectory("/public/championship/image");
			$file = $request->file('image');

			$filenameWithExt = $request->file('image')->getClientOriginalName();
			$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
			$extension = $request->file('image')->getClientOriginalExtension();

			$filename = $filename.'_'.time().'.'.$extension;
			$path = storage_path('app/public/championship/image/').$filename;
			$file->storeAs('public/championship/image', $filename);

			// Resize image
			$img = Image::make($file->getRealPath())
				->resize(512, 512, function ($constraint) {
					$constraint->aspectRatio();
				})
				->fit(512, 512, null, 'center')
				->save($path, 80);
		}

		$championship = null;
		if ($isCreate) {
			$championship = new Championships();
      $championship->created_by = Auth::id();
		} else {
			$championship = Championships::find($request->id);
      $championship->updated_by = Auth::id();

			if ($request->hasFile('image')) {
				$oldPath = storage_path('app/public/federation/logo/').$championship->image;
				if (file_exists($oldPath) && is_file($oldPath)) {
					unlink($oldPath);
				}
			}
		}
		
		try {
      $championship->name = ucwords($request->name);
			if ($request->hasFile('image')) $championship->image = $filename;
			$championship->save();

			return redirect()
				->route("admin.masterdata.championship.index")
				->with('success', "Kejuaraan {$request->name} berhasil dibuat");

		} catch (QueryException $exception) {
			if (is_file($path)) unlink($path);

			return redirect()->back()
				->withErrors($exception->getMessage());
		}
	}

	public function delete (Request $request) {
		try {
			$championship = Championships::find($request->id);

			$oldPath = storage_path('app/public/federation/logo/').$championship->image;
			if (file_exists($oldPath) && is_file($oldPath)) {
				unlink($oldPath);
			}

			$championship->delete();

			session()->flash('message', "Kejuaraan {$championship->name} berhasil dihapus");
			return response()->json([
				"status" => true,
				"message" => null
			]);
		} catch (Exception $e) {
			return response()->json([
				"status" => false,
				"message" => $e->getMessage()
			]);
		}
	}

	public function list (Request $request) {
		$search = $request->has('search') ? $request->search : null;
		$showAll = $request->has('showall') ? (boolean) $request->showall : false;

		$page = $request->has('page') ? $request->page : 1;
		if (empty($page)) $page = 1; 
		$limit = 10;

		$model = Championships::when($search != null, function ($query) use ($search) {
			$query->where('name', 'LIKE', '%'.$search.'%');
		});

		$championship = clone($model)->when(!$showAll, function ($query) use ($limit, $page) {
			$query->take($limit)->skip(($page - 1) * $limit);
		})->get();

		$total = $model->count();
		
		return response()->json([
			"status" => true,
			"message" => null,
			"data" => [
				"list" => $championship,
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
		$data = Championships::get();
		
		return Datatables::of($data)
			->addIndexColumn()
			->make(true);
	}

	public function validateName (Request $request) {
		$data = Championships::where("name", $request->name)
			->first();

		if (!$data) {
			return response()->json([
				"status" => true,
				"message" => null,
				"data" => null
			]);
		} else {
			return response()->json([
				"status" => false,
				"message" => "Nama sudah ada",
				"data" => null
			]);
		}
	}
}
