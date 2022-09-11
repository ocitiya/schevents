<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InstallController;

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\CountriesController;
use App\Http\Controllers\Admin\ProvincesController;
use App\Http\Controllers\Admin\CountiesController;
use App\Http\Controllers\Admin\MunicipalitiesController;
use App\Http\Controllers\Admin\SportTypeController;
use App\Http\Controllers\Admin\SportController;
use App\Http\Controllers\Admin\SchoolController;
use App\Http\Controllers\Admin\MatchScheduleController;
use App\Http\Controllers\Admin\StadiumController;
use App\Http\Controllers\Admin\TeamTypeController;
use App\Http\Controllers\Admin\AssociationController;
use App\Http\Controllers\Admin\FederationController;
use App\Http\Controllers\Admin\SocmedController;
use App\Http\Controllers\Admin\SocmedAccountController;
use App\Http\Controllers\Admin\UserDetailController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('install', [InstallController::class, 'index'])->name('install');
Route::get('install/step2', [InstallController::class, 'step2'])->name('install.step2');

Route::post('store/step1', [InstallController::class, 'storeStep1'])->name('install.store.step1');
Route::post('store/step2', [InstallController::class, 'storeStep2'])->name('install.store.step2');

Route::middleware(['haveInstalled'])->group(function () {
  // Route::get('/', [DashboardController::class, 'index'])->name('index');

  // Admin Route
  Route::prefix('admin')->as('admin.')->group(function () {
    Route::get('login', [LoginController::class, 'login'])->name('login');
    Route::get('forgot-password', [LoginController::class, 'forgotPassword'])->name('forgot-password');
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

    Route::post('login-auth', [LoginController::class, 'loginAuth'])->name('login.auth');

    Route::middleware('auth')->group(function () {
      Route::get('change-password', [AdminDashboardController::class, 'changePassword'])->name('change-password');
      Route::post('update-password', [AdminDashboardController::class, 'updatePassword'])->name('update-password');
      
      Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

      // admin.location
      Route::group(['prefix' => 'location', 'as' => 'location.'], function () {
        Route::group(['prefix' => 'countries', 'as' => 'countries.'], function () {
          Route::get('/', [CountriesController::class, 'index'])->name('index');
          Route::get('/create', [CountriesController::class, 'create'])->name('create');
          Route::get('/update/{id}', [CountriesController::class, 'update'])->name('update');
          Route::get('/detail/{id}', [CountriesController::class, 'detail'])->name('detail');

          Route::post('/store', [CountriesController::class, 'store'])->name('store');
        });

        // admin.location.provinces
        Route::group(['prefix' => 'provinces', 'as' => 'provinces.'], function () {
          Route::get('/', [ProvincesController::class, 'index'])->name('index');
          Route::get('/create', [ProvincesController::class, 'create'])->name('create');
          Route::get('/update/{id}', [ProvincesController::class, 'update'])->name('update');
          Route::get('/detail/{id}', [ProvincesController::class, 'detail'])->name('detail');

          Route::post('/store', [ProvincesController::class, 'store'])->name('store');
        });

        // admin.location.counties
        Route::group(['prefix' => 'counties', 'as' => 'counties.'], function () {
          Route::get('/', [CountiesController::class, 'index'])->name('index');
          Route::get('/create', [CountiesController::class, 'create'])->name('create');
          Route::get('/update/{id}', [CountiesController::class, 'update'])->name('update');
          Route::get('/detail/{id}', [CountiesController::class, 'detail'])->name('detail');

          Route::post('/store', [CountiesController::class, 'store'])->name('store');
        });

        // admin.location.municipalities
        Route::group(['prefix' => 'municipalities', 'as' => 'municipalities.'], function () {
          Route::get('/', [MunicipalitiesController::class, 'index'])->name('index');
          Route::get('/create', [MunicipalitiesController::class, 'create'])->name('create');
          Route::get('/update/{id}', [MunicipalitiesController::class, 'update'])->name('update');
          Route::get('/detail/{id}', [MunicipalitiesController::class, 'detail'])->name('detail');

          Route::post('/store', [MunicipalitiesController::class, 'store'])->name('store');
          Route::post('/delete', [MunicipalitiesController::class, 'delete'])->name('delete');
        });
      });

      Route::group(['prefix' => 'sport', 'as' => 'sport.'], function () {
        Route::group(['prefix' => 'type', 'as' => 'type.'], function () {
          Route::get('/', [SportTypeController::class, 'index'])->name('index');
          Route::get('/create', [SportTypeController::class, 'create'])->name('create');
          Route::get('/update/{id}', [SportTypeController::class, 'update'])->name('update');
          Route::get('/detail/{id}', [SportTypeController::class, 'detail'])->name('detail');

          Route::post('/store', [SportTypeController::class, 'store'])->name('store');
          Route::post('/delete', [SportTypeController::class, 'delete'])->name('delete');
        });

        Route::get('/', [SportController::class, 'index'])->name('index');
        Route::get('/create', [SportController::class, 'create'])->name('create');
        Route::get('/update/{id}', [SportController::class, 'update'])->name('update');
        Route::get('/detail/{id}', [SportController::class, 'detail'])->name('detail');

        Route::post('/store', [SportController::class, 'store'])->name('store');
        Route::post('/delete', [SportController::class, 'delete'])->name('delete');
      });
    });

    Route::group(['prefix' => 'school', 'as' => 'school.'], function () {
      Route::get('/', [SchoolController::class, 'index'])->name('index');
      Route::get('/create', [SchoolController::class, 'create'])->name('create');
      Route::get('/update/{id}', [SchoolController::class, 'update'])->name('update');
      Route::get('/detail/{id}', [SchoolController::class, 'detail'])->name('detail');

      Route::post('/store', [SchoolController::class, 'store'])->name('store');
      Route::post('/delete', [SchoolController::class, 'delete'])->name('delete');
    });

    Route::group(['prefix' => 'match-schedule', 'as' => 'match-schedule.'], function () {
      Route::get('/', [MatchScheduleController::class, 'index'])->name('index');
      Route::get('/create', [MatchScheduleController::class, 'create'])->name('create');
      Route::get('/update/{id}', [MatchScheduleController::class, 'update'])->name('update');
      Route::get('/detail/{id}', [MatchScheduleController::class, 'detail'])->name('detail');
      Route::get('/city/{id}', [MatchScheduleController::class, 'city'])->name('city');

      Route::post('/store', [MatchScheduleController::class, 'store'])->name('store');
      Route::post('/delete', [MatchScheduleController::class, 'delete'])->name('delete');

      Route::get('/federation', [MatchScheduleController::class, 'indexFederation'])->name('federation.index');

      // Untuk Antar Kota
      // Route::get('/incity', [MatchScheduleController::class, 'indexInCity'])->name('incity.index');
      // Route::get('/incity/create', [MatchScheduleController::class, 'inCityCreate'])->name('incity.create');
      // Route::get('/incity/update/{id}', [MatchScheduleController::class, 'inCityUpdate'])->name('incity.update');
    });

    Route::group(['prefix' => 'masterdata', 'as' => 'masterdata.'], function () {
      // Socmed Route
      Route::group(['prefix' => 'socmed', 'as' => 'socmed.'], function () {
        Route::get('/', [SocmedController::class, 'index'])->name('index');
        Route::get('/create', [SocmedController::class, 'create'])->name('create');
        Route::get('/update/{id}', [SocmedController::class, 'update'])->name('update');
        Route::get('/detail/{id}', [SocmedController::class, 'detail'])->name('detail');

        Route::post('/store', [SocmedController::class, 'store'])->name('store');
        Route::post('/delete', [SocmedController::class, 'delete'])->name('delete');
      });

      // account Socmed Route
      Route::group(['prefix' => 'socmed-account', 'as' => 'socmed-account.'], function () {
        Route::get('/', [SocmedAccountController::class, 'index'])->name('index');
        Route::get('/create', [SocmedAccountController::class, 'create'])->name('create');
        Route::get('/update/{id}', [SocmedAccountController::class, 'update'])->name('update');
        Route::get('/detail/{id}', [SocmedAccountController::class, 'detail'])->name('detail');

        Route::post('/store', [SocmedAccountController::class, 'store'])->name('store');
        Route::post('/delete', [SocmedAccountController::class, 'delete'])->name('delete');
      });

      Route::group(['prefix' => 'team_type', 'as' => 'team_type.'], function () {
        Route::get('/', [TeamTypeController::class, 'index'])->name('index');
        Route::get('/create', [TeamTypeController::class, 'create'])->name('create');
        Route::get('/update/{id}', [TeamTypeController::class, 'update'])->name('update');
        Route::get('/detail/{id}', [TeamTypeController::class, 'detail'])->name('detail');

        Route::post('/store', [TeamTypeController::class, 'store'])->name('store');
        Route::post('/delete', [TeamTypeController::class, 'delete'])->name('delete');
      });

      Route::group(['prefix' => 'team_type', 'as' => 'team_type.'], function () {
        Route::get('/', [TeamTypeController::class, 'index'])->name('index');
        Route::get('/create', [TeamTypeController::class, 'create'])->name('create');
        Route::get('/update/{id}', [TeamTypeController::class, 'update'])->name('update');
        Route::get('/detail/{id}', [TeamTypeController::class, 'detail'])->name('detail');

        Route::post('/store', [TeamTypeController::class, 'store'])->name('store');
        Route::post('/delete', [TeamTypeController::class, 'delete'])->name('delete');
      });

      Route::group(['prefix' => 'association', 'as' => 'association.'], function () {
        Route::get('/', [AssociationController::class, 'index'])->name('index');
        Route::get('/create', [AssociationController::class, 'create'])->name('create');
        Route::get('/update/{id}', [AssociationController::class, 'update'])->name('update');
        Route::get('/detail/{id}', [AssociationController::class, 'detail'])->name('detail');

        Route::post('/store', [AssociationController::class, 'store'])->name('store');
        Route::post('/delete', [AssociationController::class, 'delete'])->name('delete');
      });

      Route::group(['prefix' => 'federation', 'as' => 'federation.'], function () {
        Route::get('/', [FederationController::class, 'index'])->name('index');
        Route::get('/create', [FederationController::class, 'create'])->name('create');
        Route::get('/update/{id}', [FederationController::class, 'update'])->name('update');
        Route::get('/detail/{id}', [FederationController::class, 'detail'])->name('detail');

        Route::post('/store', [FederationController::class, 'store'])->name('store');
        Route::post('/delete', [FederationController::class, 'delete'])->name('delete');
      });

      Route::group(['prefix' => 'stadium', 'as' => 'stadium.'], function () {
        Route::get('/', [StadiumController::class, 'index'])->name('index');
        Route::get('/create', [StadiumController::class, 'create'])->name('create');
        Route::get('/update/{id}', [StadiumController::class, 'update'])->name('update');
        Route::get('/detail/{id}', [StadiumController::class, 'detail'])->name('detail');
  
        Route::post('/store', [StadiumController::class, 'store'])->name('store');
        Route::post('/delete', [StadiumController::class, 'delete'])->name('delete');
      });
    });

    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
      Route::get('/', [UserDetailController::class, 'index'])->name('index');
      Route::get('/create', [UserDetailController::class, 'create'])->name('create');
      Route::get('/update/{id}', [UserDetailController::class, 'update'])->name('update');
      Route::get('/detail/{id}', [UserDetailController::class, 'detail'])->name('detail');

      Route::post('/store', [UserDetailController::class, 'store'])->name('store');
      Route::post('/delete', [UserDetailController::class, 'delete'])->name('delete');
    });
  });

  Route::get("schedule/{id}", [MatchScheduleController::class, "schedulePreview"]);

  Route::get('{any}', function () {
    return view('app');
  })->where('any','.*');
});
// Route::get('/', function () {
//     return view('welcome');
// });
