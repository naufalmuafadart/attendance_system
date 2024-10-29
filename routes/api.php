<?php

use App\Http\Controllers\API\AnnouncementController;
use App\Http\Controllers\API\DownloadController;
use App\Http\Controllers\API\MappingShiftController;
use App\Http\Controllers\API\AttendanceRequest;
use App\Http\Controllers\API\ShiftController;
use App\Http\Controllers\API\ShiftPatternController;
use App\Http\Controllers\API\TwoWeekShiftPatternController;
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
    Route::get('/', [AnnouncementController::class, 'getAll']);
    Route::get('/latest_3', [AnnouncementController::class, 'getLatest3Announcement']);
    Route::get('/{id}', [AnnouncementController::class, 'get_by_id']);
    Route::put('/', [AnnouncementController::class, 'update']);
    Route::get('/get_users_and_their_position', [AnnouncementController::class, 'get_users_and_their_position']);
});

Route::prefix('attendance_request')->group(function () {
    Route::get('/', [AttendanceRequest::class, 'get']);
    Route::get('/admin_view', [AttendanceRequest::class, 'get_for_admin_view']);
    Route::post('/', [AttendanceRequest::class, 'insert']);
    Route::post('/approve/{id}', [AttendanceRequest::class, 'approve']);
    Route::post('/reject/{id}', [AttendanceRequest::class, 'reject']);
});

Route::prefix('shift')->group(function () {
    Route::get('/', [ShiftController::class, 'get']);
    Route::get('/get_by_user_id_and_date', [ShiftController::class, 'get_by_user_id_and_date']);
});

Route::prefix('user')->group(function () {
    Route::get('/users_and_their_position', [UsersController::class, 'get_users_and_their_position']);
    Route::get('/shift_pattern/{id}', [UsersController::class, 'get_by_shift_pattern_id']);
    Route::get('/two_week_shift_pattern/{id}', [UsersController::class, 'get_by_two_week_shift_pattern_id']);
});

Route::prefix('mapping_shift')->group(function () {
    Route::post('/', [MappingShiftController::class, 'insert']);
});

Route::prefix('shift_pattern')->group(function () {
    Route::get('/', [ShiftPatternController::class, 'get']);
    Route::post('/', [ShiftPatternController::class, 'insert']);
    Route::post('/assign_user', [ShiftPatternController::class, 'assign_user']);
    Route::get('/{id}', [ShiftPatternController::class, 'get_by_id']);
});

Route::prefix('two_week_shift_pattern')->group(function () {
    Route::get('/', [TwoWeekShiftPatternController::class, 'get']);
    Route::get('/{id}', [TwoWeekShiftPatternController::class, 'get_by_id']);
    Route::post('/assign_user', [TwoWeekShiftPatternController::class, 'assign_user']);
    Route::post('/', [TwoWeekShiftPatternController::class, 'insert']);
});

Route::prefix('download')->group(function () {
    Route::get('/from_announcement', [DownloadController::class, 'from_announcement']);
});

Route::get('users', [UsersController::class, 'index']);
Route::post('tambah-users', [UsersController::class, 'store']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
