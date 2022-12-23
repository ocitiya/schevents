<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LPTypes;
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

class LPTypeController extends Controller {
	public function index () {
		return view('admin.lp-types.index');
	}

	public function create () {
		return view('admin.lp-types.form');
	}

	public function update ($id) {
		$data = [ "data" => LPTypes::find($id) ];

		return view('admin.lp-types.form', $data);
	}

	public function detail ($id) {
		$data = [ "data" => LPTypes::find($id) ];

		return view('admin.offers.detail', $data);
	}

	public function store (Request $request) {
		$isCreate = $request->id == null ? true : false;
		$validation = [
      'name' => 'required|string',
			'image' => 'nullable|file|mimes:jpg,png'
		];

		$validated = $request->validate($validation);

		$lpType = null;
		if ($isCreate) {
			$lpType= new LPTypes();
      $lpType->created_by = Auth::id();
		} else {
			$lpType= LPTypes::find($request->id);
      $lpType->updated_by = Auth::id();

			if ($request->hasFile('image')) {
				$oldPath = storage_path('app/public/lp-type/image/').$lpType->image;
				if (file_exists($oldPath) && is_file($oldPath)) {
					unlink($oldPath);
				}
			}
		}

		if ($request->hasFile('image')) {
			if(!Storage::exists("/public/lp-type/image")) Storage::makeDirectory("/public/lp-type/image");
			$file = $request->file('image');

			$filenameWithExt = $request->file('image')->getClientOriginalName();
			$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
			$extension = $request->file('image')->getClientOriginalExtension();

			$filename = $filename.'_'.time().'.'.$extension;
			$path = storage_path('app/public/lp-type/image/').$filename;
			$file->storeAs('public/lp-type/image', $filename);

			// Resize image
			$img = Image::make($file->getRealPath())
				->resize(512, 512, function ($constraint) {
					$constraint->aspectRatio();
				})
				->save($path, 80);
		}
		
		try {
      $lpType->name = $request->name;
			if ($request->hasFile('image')) $lpType->image = $filename;
			$lpType->save();

			return redirect()
				->route("admin.lp.masterdata.type.index")
				->with('success', "Tipe LP {$request->name} berhasil dibuat");

		} catch (QueryException $exception) {
			unlink($path);
			return redirect()->back()
				->withErrors($exception->getMessage());
		}
	}

	public function delete (Request $request) {
		try {
			$lpType= LPTypes::find($request->id);

			$oldPath = storage_path('app/public/lp-type/image/').$lpType->image;
      try { unlink($oldPath); } catch (Exception $e) {}
			$lpType->delete();

			session()->flash('message', "Tipe LP {$lpType->name} berhasil dihapus");
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

		$model = LPTypes::when($search != null, function ($query) use ($search) {
			$query->where('name', 'LIKE', '%'.$search.'%');
		});

		$lpType = clone($model)->when(!$showAll, function ($query) use ($limit, $page) {
			$query->take($limit)->skip(($page - 1) * $limit);
		})->get();

		$total = $model->count();
		
		return response()->json([
			"status" => true,
			"message" => null,
			"data" => [
				"list" => $lpType,
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
		$data = LPTypes::get();
		
		return Datatables::of($data)
			->addIndexColumn()
			->make(true);
	}

	public function validateName (Request $request) {
		$data = LPTypes::where("name", $request->name)
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
