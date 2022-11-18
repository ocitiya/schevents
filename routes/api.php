<?php

use App\Http\Controllers\Admin\AppContactUsController;
use App\Http\Controllers\Admin\AppFollowUsController;
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
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\FederationController;
use App\Http\Controllers\Admin\MovieController;
use App\Http\Controllers\Admin\MovieScheduleController;
use App\Http\Controllers\Admin\MovieTypeController;
use App\Http\Controllers\Admin\OfferBannerController;
use App\Http\Controllers\Admin\OfferCampaignController;
use App\Http\Controllers\Admin\OfferChannelController;
use App\Http\Controllers\Admin\OffersController;
use App\Http\Controllers\Admin\SocmedAccountController;
use App\Http\Controllers\Admin\SocmedController;
use App\Http\Controllers\Admin\SportController;
use App\Http\Controllers\Admin\UserDetailController;

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
Route::get('/school/detail/{school_id?}', [SchoolController::class, 'detailApi']);
Route::get('/school/random', [SchoolController::class, 'random']);

Route::get('/stadium/list', [StadiumController::class, 'list']);
Route::get('/stadium/listDatatable', [StadiumController::class, 'listDatatable']);

Route::get('/state/listDatatable', [CountiesController::class, 'listDatatable']);
Route::post('/city/listDatatable', [MunicipalitiesController::class, 'listDatatable']);

Route::get('/sport-type/list', [SportTypeController::class, 'list']);
Route::post('/sport-type/listDatatable', [SportTypeController::class, 'listDatatable']);
Route::post('/sport-type/validate', [SportTypeController::class, 'validateName']);

Route::get('/sport/list', [SportController::class, 'list']);
Route::get('/sport/listDatatable', [SportController::class, 'listDatatable']);
Route::post('/sport/validate', [SportController::class, 'validateName']);

Route::get('/socmed/list', [SocmedController::class, 'list']);
Route::get('/socmed/listDatatable', [SocmedController::class, 'listDatatable']);
Route::post('/socmed/validate', [SocmedController::class, 'validateName']);

// /api/offer/campaign
Route::get('/offer/campaign/list', [OfferCampaignController::class, 'list']);
Route::get('/offer/campaign/listDatatable', [OfferCampaignController::class, 'listDatatable']);
Route::post('/offer/campaign/validate', [OfferCampaignController::class, 'validateName']);

// /api/offer/channel
Route::get('/offer/channel/list', [OfferChannelController::class, 'list']);
Route::get('/offer/channel/listDatatable', [OfferChannelController::class, 'listDatatable']);
Route::post('/offer/channel/validate', [OfferChannelController::class, 'validateName']);

// /api/offer
Route::get('/offer/list', [OffersController::class, 'list']);
Route::get('/offer/listDatatable', [OffersController::class, 'listDatatable']);

// /api/offer/banner
Route::get('/offer/banner/list', [OfferBannerController::class, 'list']);
Route::get('/offer/banner/listDatatable', [OfferBannerController::class, 'listDatatable']);
Route::post('/offer/banner/validate', [OfferBannerController::class, 'validateName']);

// /api/movie
Route::get('/movie/list', [MovieController::class, 'list']);
Route::get('/movie/listDatatable', [MovieController::class, 'listDatatable']);
Route::get('/movie/detail/{id}', [MovieController::class, 'detail']);
Route::post('/movie/validate', [MovieController::class, 'validateName']);

// /api/movie/type
Route::get('/movie/type/list', [MovieTypeController::class, 'list']);
Route::get('/movie/type/listDatatable', [MovieTypeController::class, 'listDatatable']);
Route::post('/movie/type/validate', [MovieTypeController::class, 'validateName']);

// /api/movie/schedule
Route::get('/movie/schedule/list', [MovieScheduleController::class, 'list']);
Route::get('/movie/schedule/listDatatable', [MovieScheduleController::class, 'listDatatable']);

// /api/event
Route::get('/event/list', [EventController::class, 'list']);
Route::get('/event/listDatatable', [EventController::class, 'listDatatable']);
Route::post('/event/validate', [EventController::class, 'validateName']);

// /api/socmed-account
Route::get('/socmed-account/list', [SocmedAccountController::class, 'list']);
Route::get('/socmed-account/listDatatable', [SocmedAccountController::class, 'listDatatable']);
Route::post('/socmed-account/validate', [SocmedAccountController::class, 'validateName']);

Route::get('/team_type/listDatatable', [TeamTypeController::class, 'listDatatable']);

Route::get('/association/list', [AssociationController::class, 'list']);
Route::get('/association/listDatatable', [AssociationController::class, 'listDatatable']);

Route::post('/association/validate', [AssociationController::class, 'validateName']);

Route::get('/federation/list', [FederationController::class, 'list']);
Route::get('/federation/listDatatable', [FederationController::class, 'listDatatable']);
Route::post('/federation/validate', [FederationController::class, 'validateName']);

Route::get('/user/list', [UserDetailController::class, 'list']);
Route::get('/user/listDatatable', [UserDetailController::class, 'listDatatable']);
Route::get('/user/validate', [UserDetailController::class, 'validateUser']);

Route::get('/match-schedule/list', [MatchScheduleController::class, 'list']);
Route::get('/match-schedule/listOnFederation', [MatchScheduleController::class, 'listOnFederation']);
Route::post('/match-schedule/listDatatable', [MatchScheduleController::class, 'listDatatable']);
Route::get('/match-schedule/cityMatchDatatable', [MatchScheduleController::class, 'cityMatchDatatable']);
Route::get('/match-schedule/detail/{id}', [MatchScheduleController::class, 'detailAPI']);
Route::get('/match-schedule/news/list', [MatchScheduleController::class, 'newsList']);
Route::get('/match-schedule/latest-video', [MatchScheduleController::class, 'latestVideoAPI']);
Route::get('/match-schedule/scores', [MatchScheduleController::class, 'scoreAPI']);

Route::get('/banner/list', [BannerController::class, 'list']);
Route::get('/banner/listDatatable', [BannerController::class, 'listDatatable']);

Route::get('/app/contact_us/list', [AppContactUsController::class, 'list']);
Route::get('/app/contact_us/listDatatable', [AppContactUsController::class, 'listDatatable']);

Route::get('/app/follow_us/list', [AppFollowUsController::class, 'list']);
Route::get('/app/follow_us/listDatatable', [AppFollowUsController::class, 'listDatatable']);
