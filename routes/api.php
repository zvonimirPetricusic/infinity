<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/categories', [App\Http\Api\CategoriesController::class, 'get'])->name('categories');
Route::get('/subcategories', [App\Http\Api\SubcategoriesController::class, 'get'])->name('subcategories');

Route::get('/chatbot/countUsers', [App\Http\Api\ChatbotController::class, 'countUsers'])->name('chatbot');
Route::get('/chatbot/scrapeGoogle', [App\Http\Api\ChatbotController::class, 'scrapeGoogle'])->name('chatbot');

Route::get('/chatbot/companyContact', [App\Http\Api\ChatbotController::class, 'companyContact'])->name('chatbot');
Route::get('/chatbot/price', [App\Http\Api\ChatbotController::class, 'price'])->name('chatbot');
Route::get('/chatbot/color', [App\Http\Api\ChatbotController::class, 'color'])->name('chatbot');
Route::get('/chatbot/selectedColor', [App\Http\Api\ChatbotController::class, 'selectedColor'])->name('chatbot');
Route::post('/chatbot/createUser', [App\Http\Api\ChatbotController::class, 'createUser'])->name('chatbot');
Route::post('/chatbot/reservation', [App\Http\Api\ChatbotController::class, 'reservation'])->name('chatbot');


Route::post('/chatbot/checkSim', [App\Http\Api\ChatbotController::class, 'checkSim'])->name('chatbot');



