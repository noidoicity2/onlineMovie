<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\MovieController;
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
//Route::get('/getAll', [MovieController::class, 'getAll']);

//start admin route

//end admin route
Route::prefix('admin')->group(function () {
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

//    Route::get('/category/add', function () {
//        // Matches The "/admin/users" URL
//        return view("admin.page.category.addCategory");
//    });
    Route::prefix('category')->group(function () {
        Route::get('/add', function () {
            // Matches The "/admin/users" URL
            return view("admin.page.category.addCategory");
        });
        Route::post('/postAdd',[CategoryController::class , 'PostAddCategory'])->name("post_add_category");
        Route::get('/listCategory', [CategoryController::class , 'all']);
        Route::get('/', function () {
            // Matches The "/admin/users" URL
            return "<h1> hello </h1>";
        });
    });

});
//start Client route

//end Client route
