<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OfferBanner;
use App\Models\OfferCampaign;
use App\Models\OfferChannel;
use App\Models\Offers;
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

class OffersController extends Controller {
	public function index (Request $request) {
		return view('admin.offers.index');
	}

	public function create (Request $request) {
		$data = [
			"campaign" => OfferCampaign::get(),
			"channels" => OfferChannel::get()
		];

		return view('admin.offers.form', $data);
	}

	public function update (Request $request, $id) {
		$offers = Offers::find($id);
		$data = [
			"data" => $offers,
			"campaign" => OfferCampaign::get(),
			"channels" => OfferChannel::get()
		];

		return view('admin.offers.form', $data);
	}

	public function detail ($id) {
		$offers= Offers::with(["campaign", "banner", "channel"])->find($id);
		$data = [ "data" => $offers];

		return view('admin.offers.detail', $data);
	}

	public function store (Request $request) {
		$isCreate = $request->id == null ? true : false;
		$validation = [
      'campaign_id' => 'required|int',
			'banner_id' => 'required|int',
			'channel_id' => 'required|int',
			'long_link' => 'required|url',
			'short_link' => 'required|url'
		];

		$validated = $request->validate($validation);

		$offers = null;
		if ($isCreate) {
			$offers= new Offers();
      $offers->created_by = Auth::id();
		} else {
			$offers= Offers::find($request->id);
      $offers->updated_by = Auth::id();
		}
		
		try {
      $offers->campaign_id = $request->campaign_id;
			$offers->banner_id = $request->banner_id;
			$offers->channel_id = $request->channel_id;
			$offers->long_link = $request->long_link;
			$offers->short_link = $request->short_link;
			$offers->save();

			return redirect()
				->route("admin.offer.index")
				->with('success', "Promosi {$request->name} berhasil dibuat");

		} catch (QueryException $exception) {
			return redirect()->back()
				->withErrors($exception->getMessage());
		}
	}

	public function delete (Request $request) {
		try {
			$offers= Offers::find($request->id);
			$offers->delete();

			session()->flash('message', "{$offers->name} berhasil dihapus");
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

		$model = Offers::when($search != null, function ($query) use ($search) {
			$query->where('name', 'LIKE', '%'.$search.'%');
		});

		$offers = clone($model)->when(!$showAll, function ($query) use ($limit, $page) {
			$query->take($limit)->skip(($page - 1) * $limit);
		})->get();

		$total = $model->count();
		
		return response()->json([
			"status" => true,
			"message" => null,
			"data" => [
				"list" => $offers,
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
		$data = Offers::with([
			"campaign",
			"banner",
			"channel" => function ($query) {
				$query->with(["user"]);
			}
		])->get();
		
		return Datatables::of($data)
			->addIndexColumn()
			->make(true);
	}

	public function validateOffer (Request $request) {
		$campaign_id = $request->campaign_id;
		$banner_id = $request->banner_id;
		$channel_id = $request->channel_id;

		$data = Offers::where("campaign_id", $campaign_id)
			->where("banner_id", $banner_id)
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
				"message" => "Link Promosi tidak ditemukan untuk data campaign, banner dan channel saat ini.",
				"data" => null
			]);
		}
	}
}
