<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\NewsController;
use App\Http\Controllers\api\v1\SongController;
use App\Http\Controllers\api\v1\AlbumController;
use App\Http\Controllers\api\v1\ChurchController;
use App\Http\Controllers\api\v1\AdvertisementController;
use App\Http\Controllers\api\v1\GiftController;
use App\Http\Controllers\api\v1\UserController;
use App\Http\Controllers\api\v1\PaymentController;
use App\Http\Controllers\api\v1\PayoutController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('register', [UserController::class, 'register']);
Route::get('news', [NewsController::class,'index']);
Route::get('news/{id}', [NewsController::class,'show']);
Route::get('news-detail/{slug}', [NewsController::class,'showNews']);
//albums
Route::get('albums', [AlbumController::class,'index']);
Route::get('albums/{id}', [AlbumController::class,'show']);
//Church and its address
Route::get('churches', [ChurchController::class,'index']);
Route::get('churches/{id}', [ChurchController::class,'show']);
//Advertisement
Route::get('ads', [AdvertisementController::class,'index']);
Route::get('ads/{id}', [AdvertisementController::class,'show']);
//Songs
Route::get('songs', [SongController::class,'index']);
Route::get('songs/{id}', [SongController::class,'show']);
