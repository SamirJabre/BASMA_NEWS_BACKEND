<?php

use App\Http\Controllers\AggregateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CountVisitController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
});

Route::post('/count_visits', [CountVisitController::class, 'countCategoryClick']);

Route::controller(AggregateController::class)->group(function () {
    Route::get('increment_nav_clicks', 'increment_Nav');
    Route::get('increment_hero_clicks', 'increment_hero');
    Route::get('increment_news_clicks', 'increment_News');
    Route::get('increment_most_read_clicks', 'increment_Most_read');
    Route::get('increment_footer_clicks', 'increment_Footer');
});

Route::post('/increment-click', [AggregateController::class, 'incrementSectionClick']);
Route::get('/unique-clicks/{section}', [AggregateController::class, 'getUniqueClicks']);
Route::get('/get_category', [CategoryController::class, 'getCategories']);
Route::get('/get_category/{id}', [CategoryController::class, 'getCategory']);
Route::get('/unique_footer', [AggregateController::class, 'increment_unique_footer_clicks']);




Route::get('/clicks/{period}', [AggregateController::class, 'getClicksByPeriod']);
Route::get('/top-news-categories', [AggregateController::class, 'getTopNewsCategories']);