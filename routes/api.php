<?php

use App\Http\Controllers\API\AnnouncementController;
use App\Http\Controllers\API\DownloadController;
use App\Http\Controllers\API\UsersController;
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

Route::prefix('announcement')->group(function () {
    Route::put('/', [AnnouncementController::class, 'update']);
    Route::get('/latest_3', [AnnouncementController::class, 'getLatest3Announcement']);
});

Route::prefix('download')->group(function () {
    Route::get('/from_announcement', [DownloadController::class, 'from_announcement']);
});

Route::get('users', [UsersController::class, 'index']);
Route::post('tambah-users', [UsersController::class, 'store']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
