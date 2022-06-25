<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InstallController;

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\CountriesController;

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
	Route::prefix('admin')->as('admin.')->middleware('auth')->group(function () {
		Route::get('login', [LoginController::class, 'login'])->name('login');
		Route::get('forgot-password', [LoginController::class, 'forgotPassword'])->name('forgot-password');

		Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

		Route::group(['prefix' => 'location', 'as' => 'location.'], function () {
			Route::group(['prefix' => 'countries', 'as' => 'countries.'], function () {
				Route::get('/', [CountriesController::class, 'index'])->name('index');
				Route::get('/create', [CountriesController::class, 'create'])->name('create');
				Route::get('/update/{id}', [CountriesController::class, 'update'])->name('update');
			});
		});
	});
});
// Route::get('/', function () {
//     return view('welcome');
// });
