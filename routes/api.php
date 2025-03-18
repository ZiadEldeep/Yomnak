<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;

// ✅ مسارات عامة
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/update-password', [UserController::class, 'updatePassword']);
Route::post('/send-code', [UserController::class, 'sendVerificationCode']);


// ✅ مسارات محمية للمستخدمين المسجلين فقط
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return response()->json(['user' => $request->user()]);
    });
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/messages/send', [MessageController::class, 'sendMessage']);
    Route::get('/messages/{receiver_id}', [MessageController::class, 'getMessages']);
    Route::post('/messages/read/{message_id}', [MessageController::class, 'markAsRead']);
});
