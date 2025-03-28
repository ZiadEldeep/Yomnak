<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class NotificationController extends Controller
{
    // إنشاء إشعار جديد
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'message' => 'required|string|max:255',
            'type' => 'required|string|max:50',
        ]);

        $notification = Notification::create($validated);

        return response()->json([
            'notification' => $notification->load('user'),
            'message' => 'Notification created successfully.'
        ], 201);
    }

    // جلب جميع الإشعارات لمستخدم معين
    public function index($userId)
    {
        $notifications = Notification::where('user_id', $userId)
            ->with('user') // تحميل بيانات المستخدم
            ->orderBy('created_at', 'desc')
            ->paginate(10); // جلب 10 إشعارات في كل صفحة

        return response()->json([
            'notifications' => $notifications,
            'message' => $notifications->isEmpty() ? 'No notifications found.' : 'Notifications retrieved successfully.'
        ], 200);
    }

    // حذف إشعار معين لمستخدم معين
    public function destroy($userId, $notificationId)
    {
        $notification = Notification::where('id', $notificationId)
            ->where('user_id', $userId)
            ->firstOrFail();

        // التأكد من أن المستخدم لديه الصلاحية لحذف الإشعار
        $this->authorize('delete', $notification);

        $notification->delete();

        return response()->json(['message' => 'Notification deleted successfully.'], 200);
    }
}
