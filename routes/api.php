<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\CountriesController;
use App\Http\Controllers\Admin\ProvincesController;
use App\Http\Controllers\Admin\CountiesController;
use App\Http\Controllers\Admin\MunicipalitiesController;
use App\Http\Controllers\Admin\SchoolController;
use App\Http\Controllers\Admin\MatchScheduleController;
use App\Http\Controllers\Admin\SportTypeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/country/list', [CountriesController::class, 'list']);
Route::get('/province/list/{country_id?}', [ProvincesController::class, 'list']);
Route::get('/county/list/{province_id?}', [CountiesController::class, 'list']);
Route::get('/municipality/list/{county_id?}', [MunicipalitiesController::class, 'list']);
Route::get('/school/list/{school_id?}', [SchoolController::class, 'list']);
Route::get('/match-schedule/list', [MatchScheduleController::class, 'list']);
Route::get('/sport-type/list', [SportTypeController::class, 'list']);
