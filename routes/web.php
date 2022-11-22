<?php

use App\Http\Controllers\Admin\AppContactUsController;
use App\Http\Controllers\Admin\AppController;
use App\Http\Controllers\Admin\AppFollowUsController;
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
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\FederationController;
use App\Http\Controllers\Admin\LPMovieController;
use App\Http\Controllers\Admin\LPSportController;
use App\Http\Controllers\Admin\LPTypeController;
use App\Http\Controllers\Admin\MovieController;
use App\Http\Controllers\Admin\MovieScheduleController;
use App\Http\Controllers\Admin\MovieTypeController;
use App\Http\Controllers\Admin\OfferBannerController;
use App\Http\Controllers\Admin\OfferCampaignController;
use App\Http\Controllers\Admin\OfferChannelController;
use App\Http\Controllers\Admin\OffersController;
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
    
    Route::post('reset-request', [LoginController::class, 'resetRequest'])->name('reset.request');
    Route::post('login-auth', [LoginController::class, 'loginAuth'])->name('login.auth');
    
    Route::middleware('auth')->group(function () {
      Route::get('change-password', [AdminDashboardController::class, 'changePassword'])->name('change-password');
      Route::post('update-password', [AdminDashboardController::class, 'updatePassword'])->name('update-password');
      Route::get('my-account', [AdminDashboardController::class, 'myAccount'])->name('my-account');
      Route::get('my-account/edit', [AdminDashboardController::class, 'myAccountEdit'])->name('my-account.edit');
      Route::post('my-account/store', [AdminDashboardController::class, 'myAccountStore'])->name('my-account.store');
      Route::get('my-account/change-password', [AdminDashboardController::class, 'myAccountChangePassword'])->name('my-account.change-password');
      
      Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

      Route::group(['prefix' => 'app', 'as' => 'app.'], function () {
        Route::group(['prefix' => 'banner', 'as' => 'banner.'], function () {
          Route::get('/', [BannerController::class, 'index'])->name('index');
          Route::get('/create', [BannerController::class, 'create'])->name('create');
          Route::get('/update/{id}', [BannerController::class, 'update'])->name('update');
          Route::get('/detail/{id}', [BannerController::class, 'detail'])->name('detail');

          Route::post('/store', [BannerController::class, 'store'])->name('store');
          Route::post('/delete', [BannerController::class, 'delete'])->name('delete');
        });

        Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
          Route::get('/', [AppController::class, 'index'])->name('index');
          Route::get('/update', [AppController::class, 'update'])->name('update');
          Route::get('/detail', [AppController::class, 'detail'])->name('detail');

          Route::post('/store', [AppController::class, 'store'])->name('store');
        });

        Route::group(['prefix' => 'contact_us', 'as' => 'contact_us.'], function () {
          Route::get('/', [AppContactUsController::class, 'index'])->name('index');
          Route::get('/create', [AppContactUsController::class, 'create'])->name('create');
          Route::get('/update/{id}', [AppContactUsController::class, 'update'])->name('update');
          Route::get('/detail/{id}', [AppContactUsController::class, 'detail'])->name('detail');

          Route::post('/store', [AppContactUsController::class, 'store'])->name('store');
          Route::post('/delete', [AppContactUsController::class, 'delete'])->name('delete');
        });

        Route::group(['prefix' => 'follow_us', 'as' => 'follow_us.'], function () {
          Route::get('/', [AppFollowUsController::class, 'index'])->name('index');
          Route::get('/create', [AppFollowUsController::class, 'create'])->name('create');
          Route::get('/update/{id}', [AppFollowUsController::class, 'update'])->name('update');
          Route::get('/detail/{id}', [AppCoAppFollowUsControllerntactUsController::class, 'detail'])->name('detail');

          Route::post('/store', [AppFollowUsController::class, 'store'])->name('store');
          Route::post('/delete', [AppFollowUsController::class, 'delete'])->name('delete');
        });
      });

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

    // Match Schedule
    // /admin/match-schedule
    Route::group(['prefix' => 'match-schedule', 'as' => 'match-schedule.'], function () {
      Route::get('/', [MatchScheduleController::class, 'index'])->name('index');
      Route::get('/create', [MatchScheduleController::class, 'create'])->name('create');
      Route::get('/update/{id}', [MatchScheduleController::class, 'update'])->name('update');
      Route::get('/detail/{id}', [MatchScheduleController::class, 'detail'])->name('detail');
      Route::get('/city/{id}', [MatchScheduleController::class, 'city'])->name('city');

      Route::post('/store', [MatchScheduleController::class, 'store'])->name('store');
      Route::post('/delete', [MatchScheduleController::class, 'delete'])->name('delete');
      Route::post('/delete-all', [MatchScheduleController::class, 'deleteAll'])->name('delete-all');

      Route::get('/federation', [MatchScheduleController::class, 'indexFederation'])->name('federation.index');

      // Untuk Antar Kota
      // Route::get('/incity', [MatchScheduleController::class, 'indexInCity'])->name('incity.index');
      // Route::get('/incity/create', [MatchScheduleController::class, 'inCityCreate'])->name('incity.create');
      // Route::get('/incity/update/{id}', [MatchScheduleController::class, 'inCityUpdate'])->name('incity.update');
    });

    // LP ROUTE
    // /admin/lp
    Route::group(['prefix' => 'lp', 'as' => 'lp.'], function () {

      // /admin/lp/masterdata
      Route::group(['prefix' => 'masterdata', 'as' => 'masterdata.'], function () {
        
        // /admin/lp/masterdata/type
        Route::group(['prefix' => 'type', 'as' => 'type.'], function () {
          Route::get('/', [LPTypeController::class, 'index'])->name('index');
          Route::get('/create', [LPTypeController::class, 'create'])->name('create');
          Route::get('/update/{id}', [LPTypeController::class, 'update'])->name('update');
          Route::get('/detail/{id}', [LPTypeController::class, 'detail'])->name('detail');

          Route::post('/store', [LPTypeController::class, 'store'])->name('store');
          Route::post('/delete', [LPTypeController::class, 'delete'])->name('delete');
        });
      });

      // /admin/lp/movie
      Route::group(['prefix' => 'movie', 'as' => 'movie.'], function () {
        Route::get('/', [LPMovieController::class, 'index'])->name('index');
        Route::get('/create', [LPMovieController::class, 'create'])->name('create');
        Route::get('/update/{id}', [LPMovieController::class, 'update'])->name('update');
        Route::get('/detail/{id}', [LPMovieController::class, 'detail'])->name('detail');

        Route::post('/store', [LPMovieController::class, 'store'])->name('store');
        Route::post('/delete', [LPMovieController::class, 'delete'])->name('delete');
      });
      
      // /admin/lp/sport
      Route::group(['prefix' => 'sport', 'as' => 'sport.'], function () {
        Route::get('/', [LPSportController::class, 'index'])->name('index');
        Route::get('/create', [LPSportController::class, 'create'])->name('create');
        Route::get('/update/{id}', [LPSportController::class, 'update'])->name('update');
        Route::get('/detail/{id}', [LPSportController::class, 'detail'])->name('detail');

        Route::post('/store', [LPSportController::class, 'store'])->name('store');
        Route::post('/delete', [LPSportController::class, 'delete'])->name('delete');
      });
    });

    // OFFER ROUTE
    // /admin/offer/campaign
    Route::group(['prefix' => 'offer', 'as' => 'offer.'], function () {

      // /admin/offer/campaign/masterdata
      Route::group(['prefix' => 'masterdata', 'as' => 'masterdata.'], function () {

        // /admin/offer/masterdata/campaign
        Route::group(['prefix' => 'campaign', 'as' => 'campaign.'], function () {
          Route::get('/', [OfferCampaignController::class, 'index'])->name('index');
          Route::get('/create', [OfferCampaignController::class, 'create'])->name('create');
          Route::get('/update/{id}', [OfferCampaignController::class, 'update'])->name('update');
          Route::get('/detail/{id}', [OfferCampaignController::class, 'detail'])->name('detail');

          Route::post('/store', [OfferCampaignController::class, 'store'])->name('store');
          Route::post('/delete', [OfferCampaignController::class, 'delete'])->name('delete');
        });

        // /admin/offer/masterdata/banner
        Route::group(['prefix' => 'banner', 'as' => 'banner.'], function () {
          Route::get('/', [OfferBannerController::class, 'index'])->name('index');
          Route::get('/create', [OfferBannerController::class, 'create'])->name('create');
          Route::get('/update/{id}', [OfferBannerController::class, 'update'])->name('update');
          Route::get('/detail/{id}', [OfferBannerController::class, 'detail'])->name('detail');

          Route::post('/store', [OfferBannerController::class, 'store'])->name('store');
          Route::post('/delete', [OfferBannerController::class, 'delete'])->name('delete');
        });

        // /admin/offer/masterdata/channel
        Route::group(['prefix' => 'channel', 'as' => 'channel.'], function () {
          Route::get('/', [OfferChannelController::class, 'index'])->name('index');
          Route::get('/create', [OfferChannelController::class, 'create'])->name('create');
          Route::get('/update/{id}', [OfferChannelController::class, 'update'])->name('update');
          Route::get('/detail/{id}', [OfferChannelController::class, 'detail'])->name('detail');

          Route::post('/store', [OfferChannelController::class, 'store'])->name('store');
          Route::post('/delete', [OfferChannelController::class, 'delete'])->name('delete');
        });
      });

      Route::get('/', [OffersController::class, 'index'])->name('index');
      Route::get('/create', [OffersController::class, 'create'])->name('create');
      Route::get('/update/{id}', [OffersController::class, 'update'])->name('update');
      Route::get('/detail/{id}', [OffersController::class, 'detail'])->name('detail');

      Route::post('/store', [OffersController::class, 'store'])->name('store');
      Route::post('/delete', [OffersController::class, 'delete'])->name('delete');
    });

    // MOVIE ROUTE
    // /admin/movie/
    Route::group(['prefix' => 'movie', 'as' => 'movie.'], function () {
    
      // /admin/movie/masterdata
      Route::group(['prefix' => 'masterdata', 'as' => 'masterdata.'], function () {

        // /admin/movie/masterdata/type
        Route::group(['prefix' => 'type', 'as' => 'type.'], function () {
          Route::get('/', [MovieTypeController::class, 'index'])->name('index');
          Route::get('/create', [MovieTypeController::class, 'create'])->name('create');
          Route::get('/update/{id}', [MovieTypeController::class, 'update'])->name('update');
          Route::get('/detail/{id}', [MovieTypeController::class, 'detail'])->name('detail');

          Route::post('/store', [MovieTypeController::class, 'store'])->name('store');
          Route::post('/delete', [MovieTypeController::class, 'delete'])->name('delete');
        });
      });

      // /admin/movie/schedule
      Route::group(['prefix' => 'schedule', 'as' => 'schedule.'], function () {
        Route::get('/', [MovieScheduleController::class, 'index'])->name('index');
        Route::get('/create', [MovieScheduleController::class, 'create'])->name('create');
        Route::get('/update/{id}', [MovieScheduleController::class, 'update'])->name('update');
        Route::get('/detail/{id}', [MovieScheduleController::class, 'detail'])->name('detail');

        Route::post('/store', [MovieScheduleController::class, 'store'])->name('store');
        Route::post('/delete', [MovieScheduleController::class, 'delete'])->name('delete');
        Route::post('/delete-all', [MovieScheduleController::class, 'deleteAll'])->name('delete-all');
      });

      Route::get('/', [MovieController::class, 'index'])->name('index');
      Route::get('/create', [MovieController::class, 'create'])->name('create');
      Route::get('/update/{id}', [MovieController::class, 'update'])->name('update');
      Route::get('/detail/{id}', [MovieController::class, 'detail'])->name('detail');

      Route::post('/store', [MovieController::class, 'store'])->name('store');
      Route::post('/delete', [MovieController::class, 'delete'])->name('delete');
    });
    // END MOVIE ROUTE

    // /admin/masterdata
    Route::group(['prefix' => 'masterdata', 'as' => 'masterdata.'], function () {

      // /admin/masterdata/event
      Route::group(['prefix' => 'event', 'as' => 'event.'], function () {
        Route::get('/', [EventController::class, 'index'])->name('index');
        Route::get('/create', [EventController::class, 'create'])->name('create');
        Route::get('/update/{id}', [EventController::class, 'update'])->name('update');
        Route::get('/detail/{id}', [EventController::class, 'detail'])->name('detail');

        Route::post('/store', [EventController::class, 'store'])->name('store');
        Route::post('/delete', [EventController::class, 'delete'])->name('delete');
        Route::post('/delete-all', [EventController::class, 'deleteAll'])->name('delete');
      });

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
      Route::get('/reset/{id}', [UserDetailController::class, 'reset'])->name('reset');
      Route::get('/detail/{id}', [UserDetailController::class, 'detail'])->name('detail');

      Route::post('/store', [UserDetailController::class, 'store'])->name('store');
      Route::post('/delete', [UserDetailController::class, 'delete'])->name('delete');
    });
  });

  Route::get("schedule/{id}", [MatchScheduleController::class, "schedulePreview"]);
  Route::get("movie/schedule/{id}", [MovieScheduleController::class, "schedulePreview"]);

  Route::get('{any}', function () {
    return view('app');
  })->where('any','.*');
});
// Route::get('/', function () {
//     return view('welcome');
// });
