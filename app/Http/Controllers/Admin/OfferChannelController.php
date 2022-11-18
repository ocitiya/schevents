<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

class OfferChannelController extends Controller {
	public function index (Request $request) {
		return view('admin.offer_channel.index');
	}

	public function create (Request $request) {
		$data = [
			"users" => User::get()
		];

		return view('admin.offer_channel.form', $data);
	}

	public function update (Request $request, $id) {
		$offerChannel = OfferChannel::find($id);
		$data = [
			"data" => $offerChannel,
			"users" => User::get()
		];

		return view('admin.offer_channel.form', $data);
	}

	public function detail ($id) {
		$offerBanner= OfferChannel::find($id);
		$data = [ "data" => $offerBanner];

		return view('admin.offer_channel.detail', $data);
	}

	public function store (Request $request) {
		$isCreate = $request->id == null ? true : false;
		$validation = [
      'name' => 'required|string|max:255',
      'code' => 'required|string',
			'user_id' => 'required|uuid'
		];

		$validated = $request->validate($validation);

		$offerChannel= null;
		if ($isCreate) {
			$offerChannel= new OfferChannel();
      $offerChannel->created_by = Auth::id();
		} else {
			$offerChannel= OfferChannel::find($request->id);
      $offerChannel->updated_by = Auth::id();
		}
		
		try {
      $offerChannel->name = ucwords($request->name);
			$offerChannel->code = $request->code;
			$offerChannel->user_id = $request->user_id;
			$offerChannel->save();

			return redirect()
				->route("admin.offer.masterdata.channel.index")
				->with('success', "Channel {$request->name} berhasil dibuat");

		} catch (QueryException $exception) {
			return redirect()->back()
				->withErrors($exception->getMessage());
		}
	}

	public function delete (Request $request) {
		try {
			$offerChannel= OfferChannel::find($request->id);
			$offerChannel->delete();

			session()->flash('message', "{$offerChannel->name} berhasil dihapus");
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

		$model = OfferChannel::when($search != null, function ($query) use ($search) {
			$query->where('name', 'LIKE', '%'.$search.'%');
		});

		$offerChannel = clone($model)->when(!$showAll, function ($query) use ($limit, $page) {
			$query->take($limit)->skip(($page - 1) * $limit);
		})->get();

		$total = $model->count();
		
		return response()->json([
			"status" => true,
			"message" => null,
			"data" => [
				"list" => $offerChannel,
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
		$data = OfferChannel::with(["user"])->get();
		
		return Datatables::of($data)
			->addIndexColumn()
			->make(true);
	}

	public function validateName (Request $request) {
		$data = OfferChannel::where('name', $request->name)->first();

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
