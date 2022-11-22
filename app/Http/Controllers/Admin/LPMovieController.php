<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LPMovies;
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

class LPMovieController extends Controller {
	public function index () {
		return view('admin.lp-movie.index');
	}

	public function create () {
    $data = [
			"types" => LPTypes::get(),
      "channels" => OfferChannel::get()
    ];

		return view('admin.lp-movie.form', $data);
	}

	public function update ($id) {
		$data = [
			"types" => LPTypes::get(),
      "data" => LPMovies::find($id),
      "channels" => OfferChannel::get()
    ];

		return view('admin.lp-movie.form', $data);
	}

	// public function detail ($id) {
	// 	$data = [ "data" => LPMovies::find($id) ];

	// 	return view('admin.offers.detail', $data);
	// }

	public function store (Request $request) {
		$isCreate = $request->id == null ? true : false;
		$validation = [
      'lp_type_id' => 'required|int',
      'channel_id' => 'required|int',
      'short_link' => 'nullable|url',
      'long_link' => 'nullable|url'
		];

		$validated = $request->validate($validation);

		$lpMovie = null;
		if ($isCreate) {
			$lpMovie= new LPMovies();
      $lpMovie->created_by = Auth::id();
		} else {
			$lpMovie= LPMovies::find($request->id);
      $lpMovie->updated_by = Auth::id();
		}
		
		try {
      $lpMovie->lp_type_id = $request->lp_type_id;
      $lpMovie->channel_id = $request->channel_id;
      $lpMovie->short_link = $request->short_link;
      $lpMovie->long_link = $request->long_link;
			$lpMovie->save();

			return redirect()
				->route("admin.lp.movie.index")
				->with('success', "LP Movie berhasil dibuat");

		} catch (QueryException $exception) {
			return redirect()->back()
				->withErrors($exception->getMessage());
		}
	}

	public function delete (Request $request) {
		try {
			$lpMovie= LPMovies::find($request->id);
			$lpMovie->delete();

			session()->flash('message', "LP Movie berhasil dihapus");
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

		$model = LPMovies::when($search != null, function ($query) use ($search) {
			$query->where('name', 'LIKE', '%'.$search.'%');
		});

		$lpMovie = clone($model)->when(!$showAll, function ($query) use ($limit, $page) {
			$query->take($limit)->skip(($page - 1) * $limit);
		})->get();

		$total = $model->count();
		
		return response()->json([
			"status" => true,
			"message" => null,
			"data" => [
				"list" => $lpMovie,
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
		$data = LPMovies::with(["channel", "type"])->get();
		
		return Datatables::of($data)
			->addIndexColumn()
			->make(true);
	}
}
