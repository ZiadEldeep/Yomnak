<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ServiceController;

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


Route::post('/services', [ServiceController::class, 'store']); // إضافة خدمة جديدة
Route::get('/services', [ServiceController::class, 'index']); // عرض جميع الخدمات
Route::get('/services/{id}', [ServiceController::class, 'show']); // عرض خدمة معينة
Route::put('/services/{id}', [ServiceController::class, 'update']); // تحديث خدمة
Route::delete('/services/{id}', [ServiceController::class, 'destroy']); // حذف خدمة
Route::get('/services', [ServiceController::class, 'getAllServiceNames']);
