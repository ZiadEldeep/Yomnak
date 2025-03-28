<?php

use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
use App\Http\Controllers\UserController;
=======

use App\Http\Controllers\NotificationController;

Route::post('/notifications', [NotificationController::class, 'store']);
Route::get('/notifications/{userId}', [NotificationController::class, 'index']);
Route::delete('/notifications/{userId}/{notificationId}', [NotificationController::class, 'destroy']);


>>>>>>> f3446f99f5d101c032f2eaacd74cfbf7adadadb1
use App\Http\Controllers\MessageController;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/messages/send', [MessageController::class, 'sendMessage']); // إرسال رسالة
    Route::get('/messages/{receiver_id}', [MessageController::class, 'getMessages']); // جلب جميع الرسائل بين المستخدم الحالي ومستلم معين
    Route::patch('/messages/read/{message_id}', [MessageController::class, 'markAsRead']); // تحديث حالة الرسائل إلى مقروءة
});

use App\Http\Controllers\ServiceController;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/services', [ServiceController::class, 'store']); // إضافة خدمة جديدة
    Route::get('/services', [ServiceController::class, 'index']); // عرض جميع الخدمات
    Route::get('/services/{id}', [ServiceController::class, 'show']); // عرض خدمة معينة
    Route::put('/services/{id}', [ServiceController::class, 'update']); // تحديث خدمة
    Route::delete('/services/{id}', [ServiceController::class, 'destroy']); // حذف خدمة
});


<<<<<<< HEAD
Route::post('/services', [ServiceController::class, 'store']); // إضافة خدمة جديدة
Route::get('/services', [ServiceController::class, 'index']); // عرض جميع الخدمات
Route::get('/services/{id}', [ServiceController::class, 'show']); // عرض خدمة معينة
Route::put('/services/{id}', [ServiceController::class, 'update']); // تحديث خدمة
Route::delete('/services/{id}', [ServiceController::class, 'destroy']); // حذف خدمة
Route::get('/services', [ServiceController::class, 'getAllServiceNames']);
=======
use App\Http\Controllers\UserController;

Route::post('/register', [UserController::class, 'register']); // تسجيل مستخدم جديد
Route::post('/login', [UserController::class, 'login']); // تسجيل الدخول
Route::post('/send-verification-code', [UserController::class, 'sendVerificationCode']); // إرسال كود التحقق
Route::post('/update-password', [UserController::class, 'updatePassword']); // تحديث كلمة المرور
>>>>>>> f3446f99f5d101c032f2eaacd74cfbf7adadadb1
