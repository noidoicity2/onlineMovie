<?php

use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\CountryController;
use App\Http\Controllers\admin\DirectorController;
use App\Http\Controllers\admin\MovieController;

use App\Http\Controllers\client\ClientMovieController;
use App\Http\Controllers\client\HomeController;
use App\Http\Middleware\CheckLogin;
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
    Route::get('logout', function (){return view('login');})->name('logout');

    Route::post('postlogin', [AuthController::class ,'PostLogin'] )->name('post_login');
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
    Route::get('/dashboard', function() {

    })->name("dashboard");


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


    Route::prefix('movie')->group(function () {

        Route::get('/add', function () {
            return view("admin.page.movie.addMovie");
        })->name('add_movie');
        Route::get('paginate={paginate?}&orderBy={orderBy}' , [MovieController::class , 'ListMovie'])->name('movie_paginate');
        Route::get('/listMovie' , [MovieController::class , 'ListMovie'])->name('list_movie');
        Route::get('/', [MovieController::class , 'all']);

        Route::post('postAdd' , [MovieController::class, 'PostAddMovie'])->name('post_add_movie');
        Route::post('postDelete' , [MovieController::class, 'PostDeleteMovie'])->name('post_delete_movie');
        Route::post('postEdit' , [MovieController::class, 'PostEditMovie'])->name('post_edit_movie');


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
    Route::get('favorite', function () {});
    Route::get('cart', function () {});
    Route::get('wishlist', function () {});
    Route::get('profile', function () {});
    Route::get('payment', function () {});
    Route::get('bookMark', function () {});
    Route::get('profile', function () {});

    Route::get('search', function () {});
    Route::get('donate', function () {});
    Route::get('home', [HomeController::class , 'home']);

    Route::get('jw' ,[ClientMovieController::class,'testJw']);

});

//end Client route
Route::prefix('movie')->group(function() {
    Route::get('/{slug}_{id}', [ClientMovieController::class , 'GetMovieBySlug'])->name('get_movie_by_slug');
});
DB::listen(function($sql) {
    Log::info($sql->sql);
    Log::info($sql->bindings);
    Log::info($sql->time);
});

