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
    Route::get('increment_nav_clicks', 'incrementNav');
    Route::get('increment_hero_clicks', 'incrementHero');
    Route::get('increment_news_clicks', 'incrementNews');
    Route::get('increment_most_read_clicks', 'incrementMostRead');
    Route::get('increment_footer_clicks', 'incrementFooter');
    Route::get('unique_navigation', 'incrementUniqueNavClicks');
    Route::get('unique_hero', 'incrementUniqueHeroClicks');
    Route::get('unique_news', 'incrementUniqueNewsClicks');
    Route::get('unique_most_read', 'incrementUniqueMostReadClicks');
    Route::get('unique_footer' , 'incrementUniqueFooterClicks');
    Route::get('top_news_categories', 'getTopNewsCategories');
    Route::get('clicks/{period}', 'getClicksByPeriod');
});

Route::get('/get_category', [CategoryController::class, 'getCategories']);
Route::get('/get_category/{id}', [CategoryController::class, 'getCategory']);
