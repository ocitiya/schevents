<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Database\QueryException;
use Yajra\DataTables\Datatables;

use App\Models\SocmedAccount;
use Illuminate\Support\Facades\Auth;

use Session;

class SocmedAccountController extends Controller {
	public function index (Request $request) {
		return view('admin.socmed-account.index');
	}

	public function create (Request $request) {
		return view('admin.socmed-account.form');
	}

	public function update (Request $request, $id) {
		$sport = SocmedAccount::find($id);
		$data = [
			"data" => $sport
		];

		return view('admin.socmed-account.form', $data);
	}

	public function detail ($id) {
		$socmed = SocmedAccount::find($id);
		$data = [ "data" => $socmed ];

		return view('admin.socmed-account.detail', $data);
	}

	public function store (Request $request) {
		$isCreate = $request->id == null ? true : false;
		$validation = [
			'socmed_id' => 'required|uuid',
			'federation_id' => 'required|uuid',
      'account_profile' => 'required|string|max:255',
      'username' => 'required|string|max:255',
      'email' => 'nullable|email|max:255',
      'phone' => 'nullable|string|max:255',
      'password' => 'required|string|max:255'
		];

		$validated = $request->validate($validation);

		$socmed = null;
		if ($isCreate) {
			$socmed = new SocmedAccount;
			$socmed->created_by_id = Auth::id();
		} else {
			$socmed = SocmedAccount::find($request->id);
			$socmed->updated_by_id = Auth::id();
		}
		
		try {
			$socmed->socmed_id = $request->socmed_id;
			$socmed->federation_id = $request->federation_id;
			$socmed->account_profile = $request->account_profile;
			$socmed->username = $request->username;
			$socmed->email = $request->email;
			$socmed->phone = $request->phone;
			$socmed->password = $request->password;
			$socmed->save();

			return redirect()
				->route("admin.masterdata.socmed-account.index")
				->with('success', 'Data successfully saved');

		} catch (QueryException $exception) {
			return redirect()->back()
				->withErrors($exception->getMessage());
		}
	}

	public function delete (Request $request) {
		$validated = $request->validate([
			'id' => 'required|numeric'
		]);

		try {
			$socmed = SocmedAccount::find($request->id);
			$socmed->deleted_by_id = Auth::id();
			$socmed->save();
			$socmed->delete();

			session()->flash('message', "{$socmed->name} successfully deleted");
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

		$model = SocmedAccount::when($search != null, function ($query) use ($search) {
			$query->where('name', 'LIKE', '%'.$search.'%');
		});

		$socmed = clone($model)->when(!$showAll, function ($query) use ($limit, $page) {
			$query->take($limit)->skip(($page - 1) * $limit);
		})->get();

		$total = $model->count();
		
		return response()->json([
			"status" => true,
			"message" => null,
			"data" => [
				"list" => $socmed,
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
		$role = $request->session()->get('role');

		$data = SocmedAccount::with(["socmed", "federation", "created_by"])
			->whereHas("created_by", function ($q) use ($role) {
				$q->whereHas("user_detail", function ($sq) use ($role) {
					$sq->when($role === "superadmin", function ($w) {
						$w->where("level", "superadmin")
							->orWhere("level", "admin")
							->orWhere("level", "user");
					})->when($role === "admin", function ($w) {
						$w->where("level", "superadmin")
							->orWhere("level", "admin")
							->orWhere("level", "user");
					})->when($role === "user", function ($w) {
						$w->where("level", "user");
					});
				});
			})
			->get();
		
		return Datatables::of($data)->make(true);
	}

	public function validateName (Request $request) {
		$data = SocmedAccount::where('name', $request->name)->first();

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
