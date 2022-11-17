<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Database\QueryException;
use Yajra\DataTables\Datatables;

use App\Models\OfferCampaign;

use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class OfferCampaignController extends Controller {
	public function index (Request $request) {
		return view('admin.offer_campaign.index');
	}

	public function create (Request $request) {
		return view('admin.offer_campaign.form');
	}

	public function update (Request $request, $id) {
		$offerCampaign= OfferCampaign::find($id);
		$data = [
			"data" => $offerCampaign
		];

		return view('admin.offer_campaign.form', $data);
	}

	public function detail ($id) {
		$offerCampaign= OfferCampaign::find($id);
		$data = [ "data" => $offerCampaign];

		return view('admin.offer_campaign.detail', $data);
	}

	public function store (Request $request) {
		$isCreate = $request->id == null ? true : false;
		$validation = [
			'name' => 'required|string|max:255',
			'image' => 'nullable|mimes:jpg,png'
		];

		$validated = $request->validate($validation);

		// Upload Image
		if ($request->hasFile('image')) {
			if(!Storage::exists("/public/campaign/image")) Storage::makeDirectory("/public/campaign/image");
			$file = $request->file('image');

			$filenameWithExt = $request->file('image')->getClientOriginalName();
			$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
			$filename = preg_replace('/\s+/', '', $filename);
			$extension = $request->file('image')->getClientOriginalExtension();

			$filename = $filename.'_'.time().'.'.$extension;
			$path = storage_path('app/public/campaign/image/').$filename;
			$file->storeAs('public/campaign/image', $filename);

			// Resize image
			$img = Image::make($file->getRealPath())
				->resize(1024, 1024, function ($constraint) {
					$constraint->aspectRatio();
				})
				->save($path, 80);
		}

		$offerCampaign= null;
		if ($isCreate) {
			$offerCampaign= new OfferCampaign();
      $offerCampaign->created_by = Auth::id();
		} else {
			$offerCampaign= OfferCampaign::find($request->id);
      $offerCampaign->updated_by = Auth::id();

			if ($request->hasFile('image')) {
				$oldPath = storage_path('app/public/campaign/image/').$offerCampaign->image;
				if (file_exists($oldPath) && !is_dir($oldPath)) {
					unlink($oldPath);
				}
			}
		}
		
		try {
			$offerCampaign->name = ucwords($request->name);
			if ($request->hasFile('image')) $offerCampaign->image = $filename;
			$offerCampaign->save();

			return redirect()
				->route("admin.offer.masterdata.campaign.index")
				->with('success', "Campaign {$request->name} berhasil dibuat");

		} catch (QueryException $exception) {
			return redirect()->back()
				->withErrors($exception->getMessage());
		}
	}

	public function delete (Request $request) {
		try {
			$offerCampaign= OfferCampaign::find($request->id);

			$oldPath = storage_path('app/public/campaign/image/').$offerCampaign->image;
			if (file_exists($oldPath) && !is_dir($oldPath)) {
				unlink($oldPath);
			}

			$offerCampaign->delete();

			session()->flash('message', "{$offerCampaign->name} berhasil dihapus");
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

		$model = OfferCampaign::when($search != null, function ($query) use ($search) {
			$query->where('name', 'LIKE', '%'.$search.'%');
		});

		$offerCampaign= clone($model)->when(!$showAll, function ($query) use ($limit, $page) {
			$query->take($limit)->skip(($page - 1) * $limit);
		})->get();

		$total = $model->count();
		
		return response()->json([
			"status" => true,
			"message" => null,
			"data" => [
				"list" => $offerCampaign,
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
		$data = OfferCampaign::get();
		
		return Datatables::of($data)
			->addIndexColumn()
			->make(true);
	}

	public function validateName (Request $request) {
		$data = OfferCampaign::where('name', $request->name)->first();

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
