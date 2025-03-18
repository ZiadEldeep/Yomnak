<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{
    /**
     * إرسال رسالة جديدة
     */
    public function sendMessage(Request $request)
{
    $request->validate([
        'sender_id' => 'required|exists:users,id',
        'receiver_id' => 'required|exists:users,id',
        'message' => 'required|string|min:1', // تأكد أن الرسالة ليست فارغة
    ]);

    $message = new Message();
    $message->sender_id = $request->sender_id;
    $message->receiver_id = $request->receiver_id;
    $message->message = $request->message; // تأكد من وجود الرسالة هنا
    $message->save();

    return response()->json(['success' => true, 'message' => 'Message sent successfully'], 200);
}

    /**
     * جلب جميع الرسائل بين المستخدم الحالي ومستخدم معين
     */
    public function getMessages($receiver_id)
    {
        $messages = Message::where(function ($query) use ($receiver_id) {
            $query->where('sender_id', Auth::id())
                  ->where('receiver_id', $receiver_id);
        })->orWhere(function ($query) use ($receiver_id) {
            $query->where('sender_id', $receiver_id)
                  ->where('receiver_id', Auth::id());
        })->orderBy('created_at', 'asc')->get();

        return response()->json(['messages' => $messages]);
    }

    /**
     * تحديث حالة الرسائل إلى "مقروءة"
     */
    public function markAsRead($message_id)
    {
        $message = Message::where('id', $message_id)
                          ->where('receiver_id', Auth::id())
                          ->first();

        if (!$message) {
            return response()->json(['error' => 'الرسالة غير موجودة أو لا تملك الصلاحية'], 403);
        }

        $message->update(['is_read' => true]);

        return response()->json(['message' => 'تم تحديث حالة القراءة بنجاح', 'data' => $message], 200);
    }

}
