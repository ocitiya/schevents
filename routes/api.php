<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AppController;

use App\Http\Controllers\Admin\CountriesController;
use App\Http\Controllers\Admin\ProvincesController;
use App\Http\Controllers\Admin\CountiesController;
use App\Http\Controllers\Admin\MunicipalitiesController;
use App\Http\Controllers\Admin\SchoolController;
use App\Http\Controllers\Admin\MatchScheduleController;
use App\Http\Controllers\Admin\SportTypeController;
use App\Http\Controllers\Admin\StadiumController;
use App\Http\Controllers\Admin\TeamTypeController;
use App\Http\Controllers\Admin\AssociationController;
use App\Http\Controllers\Admin\FederationController;

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

Route::get('/app/detail', [AppController::class, 'detail']);
Route::get('/country/list', [CountriesController::class, 'list']);
Route::get('/province/list/{country_id?}', [ProvincesController::class, 'list']);

Route::get('/county/list/{province_id?}', [CountiesController::class, 'list']);
Route::post('/county/validate', [CountiesController::class, 'validateCounty']);

Route::get('/municipality/list/{county_id?}', [MunicipalitiesController::class, 'list']);

Route::get('/school/list/{school_id?}', [SchoolController::class, 'list']);
Route::post('/school/listDatatable', [SchoolController::class, 'listDatatable']);
Route::post('/school/validate', [SchoolController::class, 'validateSchool']);

Route::get('/match-schedule/list', [MatchScheduleController::class, 'list']);

Route::get('/stadium/list', [StadiumController::class, 'list']);
Route::get('/stadium/listDatatable', [StadiumController::class, 'listDatatable']);

Route::get('/state/listDatatable', [CountiesController::class, 'listDatatable']);
Route::post('/city/listDatatable', [MunicipalitiesController::class, 'listDatatable']);

Route::get('/sport-type/list', [SportTypeController::class, 'list']);
Route::post('/sport-type/listDatatable', [SportTypeController::class, 'listDatatable']);
Route::post('/sport-type/validate', [SportTypeController::class, 'validateName']);

Route::get('/team_type/listDatatable', [TeamTypeController::class, 'listDatatable']);

Route::get('/association/list', [AssociationController::class, 'list']);
Route::get('/association/listDatatable', [AssociationController::class, 'listDatatable']);

Route::post('/association/validate', [AssociationController::class, 'validateName']);

Route::get('/federation/listDatatable', [FederationController::class, 'listDatatable']);
Route::post('/federation/validate', [FederationController::class, 'validateName']);

Route::get('/match-schedule/listOnFederation', [MatchScheduleController::class, 'listOnFederation']);
Route::post('/match-schedule/listDatatable', [MatchScheduleController::class, 'listDatatable']);
Route::get('/match-schedule/cityMatchDatatable', [MatchScheduleController::class, 'cityMatchDatatable']);
Route::get('/match-schedule/detail/{id}', [MatchScheduleController::class, 'detailAPI']);
Route::get('/match-schedule/news/list', [MatchScheduleController::class, 'newsList']);
Route::get('/match-schedule/latest-video', [MatchScheduleController::class, 'latestVideoAPI']);
Route::get('/match-schedule/scores', [MatchScheduleController::class, 'scoreAPI']);

