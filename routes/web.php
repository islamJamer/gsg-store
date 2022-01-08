<?php

use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\DashboardController;
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
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index']);

// Route::get('/page', [DashboardController::class, 'page']);

// CRUD: Craete, Read, Update, Delete

Route::group([
    'prefix' => '/dashboard/categories',
    'as' => 'dashboard.categories.'
], function(){
    // 1. Read Route:
    // To make it possible, I should:
    //          1- App\Http\Controllers\Dashboard\CategoriesController@index
    //          2- Uncomment protected $namespace = 'App\\Http\\Controllers'; from App -> Providers -> RouteServiceProvider.php
    // Route::get('/dashboard/categories', 'CategoriesController@index'); // legacy style
    Route::get('/', [CategoriesController::class, 'index'])->name('index');

    // 2. Create Route:
    Route::get('/create', [CategoriesController::class, 'create'])->name('create');

    Route::post('', [CategoriesController::class, 'post'])->name('post');

    // 3. update Route:
    Route::get('/{id}/edit', [CategoriesController::class, 'edit'])->name('edit');

    Route::put('/{id}', [CategoriesController::class, 'update'])->name('update');

    // 4. Delete Rout
    Route::delete('/{id}', [CategoriesController::class, 'destroy'])->name('destroy');
});






