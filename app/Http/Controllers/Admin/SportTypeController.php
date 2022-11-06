<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;
use Yajra\DataTables\Datatables;

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
			"federations" => Federation::get()
		];

		return view('admin.sport_type.form', $data);
	}

	public function update (Request $request, $id) {
		$types = SportType::find($id);
		$data = [
			"default_federation" => $request->has("federation_id") ? $request->federation_id : null,
			"federations" => Federation::get(),
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
			'stream_url' => 'required|url',
			'federation_id' => 'required|uuid'
		];
			
		$validated = $request->validate($validation);

		$types = null;
		if ($isCreate) {
			$types = new SportType;
			$types->id = Str::uuid();
			$types->created_by = Auth::id();
		} else {
			$types = SportType::find($request->id);
		}
		
		try {
			$types->sport_id = ucwords($request->sport_id);
			$types->federation_id = $request->federation_id;
			$types->stream_url = $request->stream_url;
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
			$type->delete();

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
		$user_id = $request->has('user_id') ? $request->user_id : null;

		$page = $request->has('page') ? $request->page : 1;
		if (empty($page)) $page = 1; 
		$limit = 10;

		$model = SportType::when($search != null, function ($query) use ($search) {
			$query->where('name', 'LIKE', '%'.$search.'%');
		})->when($federation_id != null, function ($query) use ($federation_id) {
			$query->where("federation_id", $federation_id);
		})->when($user_id != null, function ($query) use ($user_id) {
			$query->where("created_by", $user_id);
		})->with(["federation", "sport"]);

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
		$data = SportType::with(["federation", "sport", "user"])
			->when($request->federation_id != null, function ($query) use ($request) {
				$query->where("federation_id", $request->federation_id);
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
