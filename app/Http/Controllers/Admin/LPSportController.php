<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LPSports;
use App\Models\LPTypes;
use App\Models\OfferChannel;
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

class LPSportController extends Controller {
	public function index () {
		return view('admin.lp-sport.index');
	}

	public function create () {
    $data = [
			"types" => LPTypes::get(),
      "channels" => OfferChannel::get()
    ];

		return view('admin.lp-sport.form', $data);
	}

	public function update ($id) {
		$data = [
			"types" => LPTypes::get(),
      "data" => LPSports::find($id),
      "channels" => OfferChannel::get()
    ];

		return view('admin.lp-sport.form', $data);
	}

	// public function detail ($id) {
	// 	$data = [ "data" => LPSports::find($id) ];

	// 	return view('admin.offers.detail', $data);
	// }

	public function store (Request $request) {
		$isCreate = $request->id == null ? true : false;
		$validation = [
      'lp_type_id' => 'required|int',
      'channel_id' => 'required|int',
      'short_link' => 'required|url',
      'long_link' => 'required|url'
		];

		$validated = $request->validate($validation);

		$lpSport = null;
		if ($isCreate) {
			$lpSport= new LPSports();
      $lpSport->created_by = Auth::id();
		} else {
			$lpSport= LPSports::find($request->id);
      $lpSport->updated_by = Auth::id();
		}
		
		try {
      $lpSport->lp_type_id = $request->lp_type_id;
      $lpSport->channel_id = $request->channel_id;
      $lpSport->short_link = $request->short_link;
      $lpSport->long_link = $request->long_link;
			$lpSport->save();

			return redirect()
				->route("admin.lp.sport.index")
				->with('success', "LP olahraga berhasil dibuat");

		} catch (QueryException $exception) {
			return redirect()->back()
				->withErrors($exception->getMessage());
		}
	}

	public function delete (Request $request) {
		try {
			$lpSport= LPSports::find($request->id);
			$lpSport->delete();

			session()->flash('message', "LP olahraga berhasil dihapus");
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

		$model = LPSports::when($search != null, function ($query) use ($search) {
			$query->where('name', 'LIKE', '%'.$search.'%');
		});

		$lpSport = clone($model)->when(!$showAll, function ($query) use ($limit, $page) {
			$query->take($limit)->skip(($page - 1) * $limit);
		})->get();

		$total = $model->count();
		
		return response()->json([
			"status" => true,
			"message" => null,
			"data" => [
				"list" => $lpSport,
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
		$data = LPSports::with(["channel", "type"])->get();
		
		return Datatables::of($data)
			->addIndexColumn()
			->make(true);
	}

	public function validateLP(Request $request) {
		$lp_type_id = $request->lp_type_id;
		$channel_id = $request->channel_id;

		$data = LPSports::where("lp_type_id", $lp_type_id)
			->where("channel_id", $channel_id)
			->first();

		if ($data) {
			return response()->json([
				"status" => true,
				"message" => null,
				"data" => null
			]);
		} else {
			return response()->json([
				"status" => false,
				"message" => "Link Promosi tidak ditemukan untuk data LP dan channel saat ini.",
				"data" => null
			]);
		}
	}
}
