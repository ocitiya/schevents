<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;

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

Route::get('/', [DashboardController::class, 'index'])->name('index');

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
	Route::get('login', [LoginController::class, 'login'])->name('login');
	Route::get('forgot-password', [LoginController::class, 'forgotPassword'])->name('forgot-password');

	Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

	Route::group(['prefix' => 'countries', 'as' => 'countries.'], function () {
		Route::get('/', [CountriesController::class, 'index'])->name('index');
	});
});

// Route::get('/', function () {
//     return view('welcome');
// });
