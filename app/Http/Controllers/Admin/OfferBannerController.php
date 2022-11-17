<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Database\QueryException;
use Yajra\DataTables\Datatables;

use App\Models\OfferBanner;
use App\Models\OfferCampaign;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class OfferBannerController extends Controller {
	public function index (Request $request) {
		return view('admin.offer_banner.index');
	}

	public function create (Request $request) {
		$data = [
			"campaign" => OfferCampaign::get()
		];

		return view('admin.offer_banner.form', $data);
	}

	public function update (Request $request, $id) {
		$offerBanner= OfferBanner::find($id);
		$data = [
			"data" => $offerBanner,
			"campaign" => OfferCampaign::get()
		];

		return view('admin.offer_banner.form', $data);
	}

	public function detail ($id) {
		$offerBanner= OfferBanner::find($id);
		$data = [ "data" => $offerBanner];

		return view('admin.offer_banner.detail', $data);
	}

	public function store (Request $request) {
		$isCreate = $request->id == null ? true : false;
		$validation = [
			'campaign_id' => 'required|int',
			'name' => 'required|string|max:255'
		];

		$validated = $request->validate($validation);

		$offerBanner= null;
		if ($isCreate) {
			$offerBanner= new OfferBanner();
      $offerBanner->created_by = Auth::id();
		} else {
			$offerBanner= OfferBanner::find($request->id);
      $offerBanner->updated_by = Auth::id();
		}
		
		try {
			$offerBanner->campaign_id = $request->campaign_id;
			$offerBanner->name = ucwords($request->name);
			$offerBanner->save();

			return redirect()
				->route("admin.offer.masterdata.banner.index")
				->with('success', "Banner {$request->name} berhasil dibuat");

		} catch (QueryException $exception) {
			return redirect()->back()
				->withErrors($exception->getMessage());
		}
	}

	public function delete (Request $request) {
		try {
			$offerBanner= OfferBanner::find($request->id);
			$offerBanner->delete();

			session()->flash('message', "{$offerBanner->name} berhasil dihapus");
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

		$model = OfferBanner::when($search != null, function ($query) use ($search) {
			$query->where('name', 'LIKE', '%'.$search.'%');
		});

		$offerBanner = clone($model)->when(!$showAll, function ($query) use ($limit, $page) {
			$query->take($limit)->skip(($page - 1) * $limit);
		})->get();

		$total = $model->count();
		
		return response()->json([
			"status" => true,
			"message" => null,
			"data" => [
				"list" => $offerBanner,
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
		$data = OfferBanner::with(["campaign"])->get();
		
		return Datatables::of($data)
			->addIndexColumn()
			->make(true);
	}

	public function validateName (Request $request) {
		$data = OfferBanner::where('name', $request->name)->first();

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
