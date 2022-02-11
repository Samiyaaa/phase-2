<?php

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('blogs', 'App\Http\Controllers\BlogsController');
Auth::routes();

Route::resource('roles', 'App\Http\Controllers\RolesController');
Auth::routes();

Route::resource('categories', 'App\Http\Controllers\CategoriesController');
Auth::routes();

Route::resource('tags', 'App\Http\Controllers\TagsController');
Auth::routes();

Route::resource('users', 'App\Http\Controllers\UsersController');
Auth::routes();

Route::resource('roleUsers', 'App\Http\Controllers\RoleUserController');
Auth::routes();
