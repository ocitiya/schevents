<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InstallController;

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\CountriesController;
use App\Http\Controllers\Admin\ProvincesController;
use App\Http\Controllers\Admin\CountiesController;

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
	Route::get('/', [DashboardController::class, 'index'])->name('index');

	// Admin Route
	Route::prefix('admin')->as('admin.')->group(function () {
		Route::get('login', [LoginController::class, 'login'])->name('login');
		Route::get('forgot-password', [LoginController::class, 'forgotPassword'])->name('forgot-password');
		Route::get('logout', [LoginController::class, 'logout'])->name('logout');

		Route::post('login-auth', [LoginController::class, 'loginAuth'])->name('login.auth');

		Route::middleware('auth')->group(function () {
			Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

			Route::group(['prefix' => 'location', 'as' => 'location.'], function () {
				Route::group(['prefix' => 'countries', 'as' => 'countries.'], function () {
					Route::get('/', [CountriesController::class, 'index'])->name('index');
					Route::get('/create', [CountriesController::class, 'create'])->name('create');
					Route::get('/update/{id}', [CountriesController::class, 'update'])->name('update');
					Route::get('/detail/{id}', [CountriesController::class, 'detail'])->name('detail');

					Route::post('/store', [CountriesController::class, 'store'])->name('store');
				});

				Route::group(['prefix' => 'provinces', 'as' => 'provinces.'], function () {
					Route::get('/', [ProvincesController::class, 'index'])->name('index');
					Route::get('/create', [ProvincesController::class, 'create'])->name('create');
					Route::get('/update/{id}', [ProvincesController::class, 'update'])->name('update');
					Route::get('/detail/{id}', [ProvincesController::class, 'detail'])->name('detail');

					Route::post('/store', [ProvincesController::class, 'store'])->name('store');
				});

				Route::group(['prefix' => 'counties', 'as' => 'counties.'], function () {
					Route::get('/', [CountiesController::class, 'index'])->name('index');
					Route::get('/create', [CountiesController::class, 'create'])->name('create');
					Route::get('/update/{id}', [CountiesController::class, 'update'])->name('update');
					Route::get('/detail/{id}', [CountiesController::class, 'detail'])->name('detail');

					Route::post('/store', [CountiesController::class, 'store'])->name('store');
				});
			});
		});
	});
});
// Route::get('/', function () {
//     return view('welcome');
// });
