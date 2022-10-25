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

Route::get('/', [App\Http\Controllers\HomeController::class, 'welcome'])->name('welcome');

Auth::routes();



// Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'doLogin'])->name('login');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/settings', [App\Http\Controllers\SettingsController::class, 'index'])->name('settings');
Route::get('/items', [App\Http\Controllers\ItemsController::class, 'index'])->name('items');

Route::get('/categories', [App\Http\Controllers\CategoriesController::class, 'index'])->name('categories');
Route::get('/subcategories', [App\Http\Controllers\SubcategoriesController::class, 'index'])->name('subcategories');

Route::post('/categories/add', [App\Http\Api\CategoriesController::class, 'post'])->name('categories/add');
Route::post('/subcategories/add', [App\Http\Api\SubcategoriesController::class, 'post'])->name('subcategories/add');
Route::post('/items/add', [App\Http\Api\ItemsController::class, 'post'])->name('items/add');