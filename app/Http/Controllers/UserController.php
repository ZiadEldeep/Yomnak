<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache; // ✅ تم إضافة هذا السطر
use App\Models\User;
use App\Mail\SendCodeMail;

class UserController extends Controller
{
    // ✅ تسجيل مستخدم جديد
    public function register(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users',
                'phone' => 'required|string|unique:users|min:10|max:15',
                'password' => 'required|string|min:6',
            ]);

            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'],
                'password' => Hash::make($validatedData['password']),
            ]);

            return response()->json(['message' => 'تم التسجيل بنجاح', 'user' => $user], 201);
        } catch (\Exception $e) {
            Log::error("خطأ أثناء التسجيل: " . $e->getMessage());
            return response()->json(['error' => 'حدث خطأ أثناء التسجيل'], 500);
        }
    }

    // ✅ تسجيل الدخول
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json(['message' => 'بيانات تسجيل الدخول غير صحيحة'], 401);
        }

        // ✅ حذف أي توكنات قديمة (اختياري)
        if (method_exists($user, 'tokens')) {
            $user->tokens()->delete();
        }

        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json(['message' => 'تم تسجيل الدخول بنجاح', 'user' => $user, 'token' => $token]);
    }

    public function updatePassword(Request $request)
    {
        // ✅ التحقق من البيانات المدخلة
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        try {
            // ✅ البحث عن المستخدم عبر البريد الإلكتروني
            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return response()->json(['message' => 'المستخدم غير موجود'], 404);
            }

            // ✅ تحديث كلمة المرور بعد تشفيرها
            $user->update([
                'password' => Hash::make($request->new_password),
            ]);

            return response()->json(['message' => 'تم تحديث كلمة المرور بنجاح'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'حدث خطأ أثناء التحديث'], 500);
        }
    }

    public function sendVerificationCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        try {
            // ✅ إنشاء كود تحقق عشوائي مكون من 6 أرقام
            $code = rand(100000, 999999);

            // ✅ حفظ الكود مؤقتًا في الكاش لمدة 10 دقائق
            Cache::put('verification_code_' . $request->email, $code, now()->addMinutes(10));

            // ✅ إرسال البريد الإلكتروني
            Mail::raw("كود التحقق الخاص بك هو: $code", function ($message) use ($request) {
                $message->to($request->email)
                        ->subject('كود التحقق الخاص بك');
            });

            // ✅ إرجاع كود التحقق في الاستجابة أيضًا
            return response()->json([
                'message' => 'تم إرسال كود التحقق بنجاح',
                'verification_code' => $code
            ], 200);

        } catch (\Throwable $e) {
            Log::error("خطأ في إرسال كود التحقق: " . $e->getMessage());

            return response()->json([
                'message' => 'حدث خطأ أثناء إرسال الكود',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
