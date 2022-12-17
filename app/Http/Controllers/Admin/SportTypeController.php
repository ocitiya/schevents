<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Championships;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;
use Yajra\DataTables\Datatables;
use Intervention\Image\Facades\Image;

use App\Models\SportType;
use App\Models\Federation;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SportTypeController extends Controller {
	public function index (Request $request) {
		$defaultFederation = $request->has("federation_id") ? $request->federation_id : null;

		$data = [
			"default_federation" => $defaultFederation,
			"federation_name" => ($defaultFederation != null) ? Federation::find($defaultFederation)->name : null
		];

		return view('admin.sport_type.index', $data);
	}

	public function create (Request $request) {
		$data = [
			"default_federation" => $request->has("federation_id") ? $request->federation_id : null,
			"championships" => Championships::get()
		];

		return view('admin.sport_type.form', $data);
	}

	public function update (Request $request, $id) {
		$types = SportType::find($id);
		$data = [
			"default_federation" => $request->has("federation_id") ? $request->federation_id : null,
			"championships" => Championships::get(),
			"data" => $types
		];

		return view('admin.sport_type.form', $data);
	}

	public function detail ($id) {
		$types = SportType::find($id);
		$data = [ "data" => $types ];

		return view('admin.sport_type.detail', $data);
	}

	public function store (Request $request) {
		$isCreate = $request->id == null ? true : false;
		$validation = [
			'sport_id' => 'required|uuid',
			'stream_url' => 'mimes:jpg,png',
			'championship_id' => 'required|numeric'
		];
			
		$validated = $request->validate($validation);

		// Upload Image
		if ($request->hasFile('image')) {
			if(!Storage::exists("/public/link_stream/image")) Storage::makeDirectory("/public/link_stream/image");
			$file = $request->file('image');

			$filenameWithExt = $request->file('image')->getClientOriginalName();
			$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
			$extension = $request->file('image')->getClientOriginalExtension();

			$filename = $filename.'_'.time().'.'.$extension;
			$path = storage_path('app/public/link_stream/image/').$filename;
			$file->storeAs('public/link_stream/image', $filename);

			// Resize image
			$img = Image::make($file->getRealPath())
				->resize(1280, 720)
				->save($path, 80);
		}

		$types = null;
		if ($isCreate) {
			$types = new SportType;
			$types->id = Str::uuid();
			$types->created_by = Auth::id();
		} else {
			$types = SportType::find($request->id);
			if ($request->hasFile('image')) {
				$oldPath = storage_path('app/public/link_stream/image/').$types->image;
				if (file_exists($oldPath) && !is_dir($oldPath)) {
					unlink($oldPath);
				}
			}
		}
		
		try {
			$types->sport_id = ucwords($request->sport_id);
			$types->championship_id = $request->championship_id;
			if ($request->hasFile('image')) $types->image = $filename;
			$types->save();

			if ($request->is_default_federation == 1) {
				return redirect()
					->route("admin.sport.type.index", ["federation_id" => $request->federation_id])
					->with('success', 'Data successfully saved');
			} else {
				return redirect()
					->route("admin.sport.type.index")
					->with('success', 'Data successfully saved');
			}

		} catch (QueryException $exception) {
			if ($request->hasFile('image')) {
				unlink($path);
			}
			return redirect()->back()
				->withErrors($exception->getMessage());
		}
	}

	public function delete (Request $request) {
		$validated = $request->validate([
			'id' => 'required|uuid'
		]);

		try {
			$type = SportType::find($request->id);

			$path = storage_path('app/public/link_stream/image/').$type->image;
			if (file_exists($path) && !is_dir($path)) {
				unlink($path);
			}

			$type->forceDelete();

			session()->flash('message', "{$type->name} successfully deleted");
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
		
		$federation_id = $request->has('federation_id') ? $request->federation_id : null;
		if ($federation_id == "null") $federation_id = null;

		$championship_id = $request->has('championship_id') ? $request->championship_id : null;
		if ($championship_id == "null") $championship_id = null;

		$user_id = $request->has('user_id') ? $request->user_id : null;

		$page = $request->has('page') ? $request->page : 1;
		if (empty($page)) $page = 1; 
		$limit = 10;

		$model = SportType::when($search != null, function ($query) use ($search) {
			$query->where('name', 'LIKE', '%'.$search.'%');
		})->when(!empty($federation_id), function ($query) use ($federation_id) {
			$query->where("federation_id", $federation_id);
		})->when(!empty($championship_id), function ($query) use ($championship_id) {
			$query->where("championship_id", $championship_id);
		})->when($user_id != null, function ($query) use ($user_id) {
			$query->where("created_by", $user_id);
		})->with(["federation", "sport", "championship"]);

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
		$data = SportType::with(["federation", "sport", "user", "championship"])
			->when($request->federation_id != null, function ($query) use ($request) {
				$query->where("federation_id", $request->federation_id);
			})->when($request->championship_id != null, function ($query) use ($request) {
				$query->where("championship_id", $request->championship_id);
			})
			->when(Session::get("role") == "user", function ($q) {
				$q->where("created_by", Auth::id());
			})
			->get();
		
		return Datatables::of($data)->make(true);
	}

	public function validateName (Request $request) {
		$data = SportType::where('name', $request->name)->first();

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
