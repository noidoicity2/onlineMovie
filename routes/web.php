<?php

use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\MovieController;
use App\Http\Middleware\CheckLogin;
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

Route::get('/', function () {
    return view('admin.layout.mainLayout');
});
//Route::get('login' , function () {
//    return view('login');
//})->name('login');
Route::prefix('auth')->group(function () {
    Route::get('login', [AuthController::class , 'Login'])->name('login');
    Route::get('logout', function (){return view('login');})->name('logout');

    Route::post('postlogin', [AuthController::class ,'PostLogin'] )->name('post_login');
});
//Route::get('/getAll', [MovieController::class, 'getAll']);

//start admin route

//end admin route
Route::prefix('admin')->middleware(CheckLogin::class)->group(function () {
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
        Route::get('listMovie' , [MovieController::class , 'all'])->name('list_movie');
        Route::get('/', [MovieController::class , 'all']);

        Route::post('postAdd' , [MovieController::class, 'PostAddMovie'])->name('post_add_movie');
        Route::post('postDelete' , [MovieController::class, 'PostDeleteMovie'])->name('post_delete_movie');
        Route::post('postEdit' , [MovieController::class, 'PostEditMovie'])->name('post_edit_movie');

    });


});
//start Client route

//end Client route
