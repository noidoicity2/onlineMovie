<?php

use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\CountryController;
use App\Http\Controllers\admin\DasboardController;
use App\Http\Controllers\admin\DirectorController;
use App\Http\Controllers\admin\MembershipController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\client\CommentController;
use App\Http\Controllers\client\MembershipController as ClientMembership;
use App\Http\Controllers\admin\MovieController;

use App\Http\Controllers\admin\PaymentController;
use App\Http\Controllers\admin\TransactionController;
use App\Http\Controllers\client\RatingController;
use App\Http\Controllers\client\TransactionController as ClientTransaction;
use App\Http\Controllers\client\ClientMovieController;
use App\Http\Controllers\client\HomeController;

use App\Http\Middleware\CheckLogin;
use App\Http\Middleware\testRestrict;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

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

Route::get('/',  [HomeController::class , 'home']);
//Route::get('login' , function () {
//    return view('login');
//})->name('login');
Route::prefix('auth')->group(function () {
    Route::get('login', [AuthController::class , 'Login'])->name('login');
    Route::get('register', [AuthController::class , 'Register'])->name('register');
    Route::get('logout',[AuthController::class , 'Logout'] )->name('logout');

    Route::post('postlogin', [AuthController::class ,'PostLogin'] )->name('post_login');
    Route::post('postRegister', [AuthController::class ,'PostRegister'] )->name('post_register');

});
//Route::get('/getAll', [ClientMovieController::class, 'getAll']);

//start admin route


Route::prefix('admin')->middleware(CheckLogin::class)->group(function () {
    Route::get('/hls',[MovieController::class , 'testHls']);
    Route::get('/users', function () {
        // Matches The "/admin/users" URL
    });
    Route::get('/movies', function () {
        // Matches The "/admin/users" URL
    });
    Route::get('/actors', function () {
        // Matches The "/admin/users" URL
    });
    Route::get('/seasons', function () {
        // Matches The "/admin/users" URL
    });
    Route::get('/actors', function () {
        // Matches The "/admin/users" URL
    });
    Route::get('/roles', function () {
        // Matches The "/admin/users" URL
    });
    Route::prefix('sliders')->group(function () {
        // Matches The "/admin/users" URL
        Route::get('/add', [SliderController::class , 'AddSlider'])->name("add_slider");
        Route::post('postAddSlider', [SliderController::class , 'PostAddSlider'])->name("post_add_slider");

    });
    Route::get('/dashboard', [DasboardController::class ,'Index'])->name("dashboard");


    Route::prefix('category')->group(function () {
        Route::get('/add', function () {
            return view("admin.page.category.addCategory");
        })->name('add_category');
        Route::get('/edit/{id?}', [CategoryController::class , 'Edit'])->name("edit_category");
        Route::post('/postAdd',[CategoryController::class , 'PostAddCategory'])->name("post_add_category");
        Route::post('/postDelete',[CategoryController::class , 'PostDeleteCategory'])->name("post_delete_category");
        Route::post('/postEdit',[CategoryController::class , 'PostEditCategory'])->name("post_edit_category");

        Route::get('/listCategory', [CategoryController::class , 'all'])->name('list_category');
        Route::get('/', [CategoryController::class , 'all']);
    });

    Route::prefix('membership')->group(function () {
        Route::get('/', [MembershipController::class , 'ListMembership'])->name("list_membership");

        Route::get('/add', [MembershipController::class , 'Add'])->name("add_membership");
        Route::get('/edit/{id}', [MembershipController::class , 'Edit'])->name("edit_payment_method");
        Route::post('/postEdit', [MembershipController::class , 'PostEditMembership'])->name("post_edit_membership");
        Route::post('/postAdd', [MembershipController::class , 'PostAddMembership'])->name("post_add_membership");
        Route::post('/postDelete', [MembershipController::class , 'PostDeleteMembership'])->name("post_delete_membership");
    });


    Route::prefix('payment')->group(function () {
        Route::get('/', [PaymentController::class , 'ListPaymentMethod'])->name("list_payment_method");
        Route::get('/add', [PaymentController::class , 'Add'])->name("add_payment_method");
        Route::get('/edit/{id}', [PaymentController::class , 'Edit'])->name("edit_payment_method");
        Route::post('/postEdit', [PaymentController::class , 'PostEditPayment'])->name("post_edit_payment_method");
        Route::post('/postAdd', [PaymentController::class , 'PostAddPayment'])->name("post_add_payment_method");
        Route::post('/postDelete', [PaymentController::class , 'PostDeletePayment'])->name("post_delete_payment_method");
    });


    Route::prefix('movie')->group(function () {

        Route::get('/add',[MovieController::class , 'Add'])->name('add_movie');
        Route::get('{id}/addEpisode/',[MovieController::class , 'AddEpisode'])->name('add_episode');
        Route::get('paginate={paginate?}&orderBy={orderBy}' , [MovieController::class , 'ListMovie'])->name('movie_paginate');
        Route::get('/listMovie' , [MovieController::class , 'ListMovie'])->name('list_movie');


        Route::get('/', [MovieController::class , 'all']);

        Route::post('postAdd' , [MovieController::class, 'PostAddMovie'])->name('post_add_movie');
        Route::post('postDelete' , [MovieController::class, 'PostDeleteMovie'])->name('post_delete_movie');
        Route::post('postEdit' , [MovieController::class, 'PostEditMovie'])->name('post_edit_movie');
        Route::post('postAddEpisode' , [MovieController::class, 'PostAddEpisode'])->name('post_add_episode');


    });

    Route::prefix('country')->group(function () {
        Route::get('/add', function () {
            return view("admin.page.country.addCountry");
        })->name('add_country');
        Route::get('listCountry' , [CountryController::class , 'all'])->name('list_country');
        Route::get('/', [CountryController::class , 'all']);

        Route::post('postAdd' , [CountryController::class, 'PostAddCountry'])->name('post_add_country');
        Route::post('postDelete' , [CountryController::class, 'PostDeleteCountry'])->name('post_delete_country');
        Route::post('postEdit' , [CountryController::class, 'PostEditCountry'])->name('post_edit_country');

    });

    Route::prefix('director')->group(function () {
        Route::get('/add', function () {
            return view("admin.page.Director.addDirector");
        })->name('add_Director');
        Route::get('listDirector' , [DirectorController::class , 'all'])->name('list_Director');
        Route::get('/', [DirectorController::class , 'all']);

        Route::post('postAdd' , [DirectorController::class, 'PostAddDirector'])->name('post_add_director');
        Route::post('postDelete' , [DirectorController::class, 'PostDeleteDirector'])->name('post_delete_director');
        Route::post('postEdit' , [DirectorController::class, 'PostEditDirector'])->name('post_edit_director');

    });


});
//end admin route


//start Client route
Route::prefix('client')->group(function () {
//    Route::get('/{slug}', [ClientMovieController::class, 'getMovie']);
    Route::get('favorite', [ClientMovieController::class , 'Favorite'])->name('favorite_movie');
    Route::Post('postAddToFavorite', [ClientMovieController::class , 'PostAddFavorite'])->name('add_to_favorite');


    Route::get('transactions', [ClientTransaction::class , 'History'])->name('transaction_history');
//    Route::get('payment', [TransactionController::class , 'create']);
    Route::get('payment/return', [ClientMembership::class , 'return'])->name('return_payment');

    Route::get('bookmark', [ClientMembership::class , 'GetBookMarkMovie'])->name('get_bookmark_movie');
    Route::Post('postBookMark', [ClientMovieController::class , 'PostBookMark'])->name('add_to_bookmark');

    Route::get('search', [ClientMovieController::class, 'Filter'])->name('search');
    Route::get('filter' , [ClientMovieController::class , 'Filter'])->name('filter');
    Route::get('profile', function () {});

    Route::post('postRateMovie' , [RatingController::class , 'PostRateMovie'])->name('post_rate_movie');


    Route::get('donate', function () {});
    Route::get('home', [HomeController::class , 'home'])->name('home_customer');
    Route::get('movieSeries-{id}', [ClientMovieController::class , 'MovieSeries']);

    Route::get('buyvip', [ClientMembership::class , 'ListMemberShip'])->name('buy_vip');
    Route::Post('createPayment', [ClientMembership::class , 'createPaymentUrl'])->name('create_payment');
    Route::get('previewPurchase/{id}&&day={day}', [ClientMembership::class , 'PreviewPurchase'])->name('preview_purchase');

});

//end Client route
Route::prefix('movie')->group(function() {

    Route::get('requestMovie' , [ClientMovieController::class , 'RequestMovie'])->name('request_movie');
    Route::get('postRequestMovie' , [ClientMovieController::class , 'PostRequestMovie'])->name('post_request_movie');

    Route::get('inTheater' , [ClientMovieController::class , 'GetTheaterMovie'])->name('get_theater_movie');

    Route::get('movieSeries', [ClientMovieController::class , 'GetMovieSeries'])->name('get_movie_series');
    Route::get('category={slug}_{id}', [ClientMovieController::class , 'GetMovieByCategory'])->name('get_movie_by_category');
    Route::get('{slug}_{id}/episodes', [ClientMovieController::class , 'ListEpisode'])->name('list_episode');

    Route::get('/{slug}_{id}', [ClientMovieController::class , 'GetMovieBySlug'])->middleware(testRestrict::class)->name('get_movie_by_slug');
    Route::get('/watch/{slug}_{id}', [ClientMovieController::class , 'Watch'])->name('watch_movie');
    Route::get('episodes/watch/{slug}_{id}', [ClientMovieController::class , 'WatchEpisode'])->name('watch_episode');

    Route::post('addComment' , [CommentController::class , 'PostAddComment'])->name('post_add_comment');

});
Route::prefix('countries')->group(function() {
    Route::get('/' , [ClientMovieController::class, 'GetAllContries'])->name('get_all_country)');
    Route::get('/{slug}_{id}/' , [ClientMovieController::class, 'GetMovieByCountry'])->name('get_movie_by_country');


});

Route::get('/storage/image/{slug}/{img}')->middleware(testRestrict::class);
DB::listen(function($sql) {
    Log::info($sql->sql);
    Log::info($sql->bindings);
    Log::info($sql->time);
});

