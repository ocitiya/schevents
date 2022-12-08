<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Database\QueryException;

use Yajra\DataTables\Datatables;

use App\Models\Country;
use App\Models\School;
use App\Models\County;
use App\Models\Municipality;
use App\Models\Federation;

class SchoolController extends Controller {
  public function index (Request $request) {
    $defaultCountry = $request->has("country_id") ? $request->country_id : null;
    $defaultState = $request->has("state_id") ? $request->state_id : null;
    $defaultCity = $request->has("city_id") ? $request->city_id : null;

    $data = [
      "default_country" => $defaultCountry,
      "default_state" => $defaultState,
      "default_city" => $defaultCity,
      "city_name" => ($defaultCity != null) ? Municipality::find($defaultCity)->name : null
    ];
    
    return view('admin.school.index', $data);
  }

  public function create (Request $request) {
    $defaultCountry = $request->has("country_id") ? $request->country_id : null;
    $defaultState = $request->has("state_id") ? $request->state_id : null;
    $defaultCity = $request->has("city_id") ? $request->city_id : null;

    if ($defaultState == "null") $defaultState = null;

    $data = [
      "countries" => Country::get(),
      "default_country" => $defaultCountry,
      "default_state" => $defaultState,
      "default_city" => $defaultCity,
      "federations" => Federation::get()
    ];

    return view('admin.school.form', $data);
  }

  public function update (Request $request, $id) {
    $types = School::find($id);

    $data = [
      "countries" => Country::get(),
      "data" => $types,
      "default_state" => $request->has("state_id") ? $request->state_id : null,
      "default_city" => $request->has("city_id") ? $request->city_id : null,
      "federations" => Federation::get()
    ];

    return view('admin.school.form', $data);
  }

  public function detail ($id) {
    $types = School::find($id);
    $data = [ "data" => $types ];

    return view('admin.school.detail', $data);
  }

  public function detailApi ($school_id) {
    return response()->json([
      "status" => true,
      "message" => null,
      "data" => School::with(["county", "federation", "municipality"])->find($school_id)
    ]);
  }

  public function store (Request $request) {
    $validation = [
      'name' => 'required|max:255',
      'nickname' => 'nullable|string',
      'country_id' => 'required|uuid',
      'county_id' => 'nullable|uuid',
      'municipality_id' => 'nullable|uuid',
      'federation_id' => 'nullable|uuid',
      'association_id' => 'uuid',
      'logo' => 'mimes:jpg,png',
    ];

    $isCreate = $request->id == null ? true : false;
    $validated = $request->validate($validation);

    $school = null;
    if ($isCreate) {
      $validateSchool = School::where("federation_id", $request->federation_id)
        ->where("county_id", $request->county_id)
        ->where("municipality_id", $request->municipality_id)
        ->where("name", $request->name)
        ->count();
      
      if ($validateSchool > 0) {
        $state = County::find($request->county_id)->name;
        $city = Municipality::find($request->municipality_id)->name;
        $federation = Federation::find($request->federation_id)->name;

        return redirect()->back()
          ->withInput($request->input())
          ->withErrors(["Sekolah dengan nama {$request->name} di Federasi {$federation} dengan 
            State {$state} dan Kota {$city} telah ada, silahkan input dengan nama lain"]); 
      }
        
      $school = new School;
      $school->id = Str::uuid();
    } else {
      $school = School::find($request->id);

      if ($request->hasFile('logo')) {
        $oldPath = storage_path('app/public/school/logo/').$school->logo;
        if (file_exists($oldPath && is_file($oldPath))) {
          unlink($oldPath);
        }
      }
    }

    // Upload Image
    if ($request->hasFile('logo')) {
      if(!Storage::exists("/public/school/logo")) Storage::makeDirectory("/public/school/logo");
      $file = $request->file('logo');

      $filenameWithExt = $request->file('logo')->getClientOriginalName();
      $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
      $extension = $request->file('logo')->getClientOriginalExtension();

      $filename = $filename.'_'.time().'.'.$extension;
      $path = storage_path('app/public/school/logo/').$filename;
      $file->storeAs('public/school/logo', $filename);

      // Resize image
      $img = Image::make($file->getRealPath())
        ->resize(512, 512, function ($constraint) {
          $constraint->aspectRatio();
        })
        ->fit(512, 512, null, 'center')
        ->save($path, 80);
    }

    try {
      $school->name = $request->name;
      $school->nickname = $request->nickname;
      $school->country_id = $request->country_id;
      $school->county_id = $request->county_id;
      $school->municipality_id = $request->municipality_id;
      $school->federation_id = $request->federation_id;
      $school->association_id = $request->association_id;
      if ($request->hasFile('logo')) $school->logo = $filename;
      $school->save();

      if ($request->redirect_city == 1) {
        return redirect()->route('admin.school.index', [
          "state_id" => $request->county_id,
          "city_id" => $request->municipality_id
        ]);
        
      } else {
        return redirect()->route('admin.school.index');
      }

    } catch (QueryException $exception) {
      if ($request->hasFile('logo')) unlink($path);

      return redirect()->back()
        ->withInput($request->input())
        ->withErrors($exception->getMessage());
    }
  }

  public function delete (Request $request) {
    $validated = $request->validate([
      'id' => 'required|uuid'
    ]);

    try {
      $type = School::find($request->id);
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

  public function validateSchool (Request $request) {
    $data = School::where('name', $request->school)->first();

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

  public function listDatatable(Request $request) {
    $cityId = isset($request->city_id) ? $request->city_id : null;
    $federationId = isset($request->federation_id) ? $request->federation_id : null;
    $isNationalTeam = $request->is_national_team == "true" ? true : false;

    $data = School::with(["municipality", "federation", "association", "county"])
      ->when($cityId != null, function ($query) use ($cityId) {
        $query->where('municipality_id', $cityId);
      })
      ->when($federationId != null, function ($query) use ($federationId) {
        $query->where('federation_id', $federationId);
      })
      ->when($isNationalTeam, function ($query) {
        $query->where("is_national_team", 1);
      })
      ->when(!$isNationalTeam, function ($query) {
        $query->where("is_national_team", 0);
      })
      ->get();

    return Datatables::of($data)->make(true);
  }

  public function list (Request $request) {
    $showAll = $request->has('showall') ? (boolean) $request->showall : false;
    $search = $request->has('search') ? $request->search : null;
    $county_id = $request->has('county_id') ? $request->county_id : null;
    $federation_id = $request->has('federation_id') ? $request->federation_id : null;
    $isNationalTeam = $request->is_national_team == "true" ? true : false;
    
    $page = $request->has('page') ? $request->page : 1;
    if (empty($page)) $page = 1; 
    $limit = 10;

    $model = School::with(["federation", "association", "municipality", "county"])
      ->when($search != null, function ($query) use ($search) {
        $query->where('name', 'LIKE', '%'.$search.'%');
      })
      ->when($county_id != null, function ($query) use ($county_id) {
        $query->where('county_id', $county_id);
      })
      ->when(!empty($federation_id), function ($query) use ($federation_id) {
        $query->when($federation_id == "n/a", function ($query) use ($federation_id) {
          $query->whereNull('federation_id');
        });

        $query->when($federation_id != "n/a", function ($query) use ($federation_id) {
          $query->where('federation_id', $federation_id);
        });
      })->when($isNationalTeam, function ($query) {
        $query->where("is_national_team", 1);
      })
      ->when(!$isNationalTeam, function ($query) {
        $query->where("is_national_team", 0);
      });

    $schools = clone($model)->when(!$showAll, function ($query) use ($limit, $page) {
      $query->take($limit)->skip(($page - 1) * $limit);
    })
      ->orderBy('name')
      ->get();

    $total = $model->count();

    return response()->json([
      "status" => true,
      "message" => null,
      "data" => [
        "list" => $schools,
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

  function random () {
    $model = School::inRandomOrder()->limit(30)
      ->select("id", "name", "nickname", "name", "logo")
      ->get();

    return response()->json([
      "status" => true,
      "message" => null,
      "data" => $model
    ]);
  }
}
