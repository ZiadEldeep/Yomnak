<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    // إضافة خدمة جديدة مع صورة
    public function store(Request $request)
{
    $request->validate([
        'service_name' => 'required|string|max:255',
        'service_description' => 'required|string',
        'service_owner' => 'required|string|max:255',
        'service_location' => 'required|string|max:255',
        'service_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // التحقق من استقبال البيانات
    if (!$request->has('service_name')) {
        return response()->json(['error' => 'لم يتم استقبال البيانات بالشكل الصحيح'], 400);
    }

    $data = $request->only(['service_name', 'service_description', 'service_owner', 'service_location']);

    if ($request->hasFile('service_image')) {
        $path = $request->file('service_image')->store('services', 'public');
        $data['service_image'] = $path;
    }

    $service = Service::create($data);

    return response()->json([
        'message' => 'تمت إضافة الخدمة بنجاح',
        'service' => $service,
    ], 201);
}




    // عرض جميع الخدمات
    public function index()
    {
        $services = Service::all()->map(function ($service) {
            if ($service->service_image) {
                $service->service_image = asset('storage/' . $service->service_image);
            }
            return $service;
        });

        return response()->json($services);
    }

    // عرض خدمة معينة
    public function show($id)
    {
        $service = Service::find($id);
        if (!$service) {
            return response()->json(['error' => 'الخدمة غير موجودة'], 404);
        }

        // تعديل الصورة في الاستجابة لجعلها رابط كامل
        if ($service->service_image) {
            $service->service_image = asset('storage/' . $service->service_image);
        }

        return response()->json($service);
    }

    // تحديث الخدمة
    public function update(Request $request, $id)
    {
        $service = Service::find($id);
        if (!$service) {
            return response()->json(['error' => 'الخدمة غير موجودة'], 404);
        }

        $request->validate([
            'service_feedback' => 'nullable|numeric|min:0|max:5',
            'service_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // دعم تحديث الصورة
        ]);

        $data = $request->all();

        if ($request->hasFile('service_image')) {
            if ($service->service_image) {
                Storage::disk('public')->delete($service->service_image); // حذف الصورة القديمة
            }
            $path = $request->file('service_image')->store('services', 'public');
            $data['service_image'] = $path;
        }

        $service->update($data);

        // تعديل الصورة في الاستجابة لجعلها رابط كامل
        $service->service_image = $service->service_image ? asset('storage/' . $service->service_image) : null;

        return response()->json([
            'message' => 'تم تحديث الخدمة بنجاح',
            'service' => $service
        ]);
    }

    // حذف الخدمة
    public function destroy($id)
    {
        $service = Service::find($id);
        if (!$service) {
            return response()->json(['error' => 'الخدمة غير موجودة'], 404);
        }

        if ($service->service_image) {
            Storage::disk('public')->delete($service->service_image); // حذف الصورة عند حذف الخدمة
        }

        $service->delete();
        return response()->json(['message' => 'تم حذف الخدمة بنجاح']);
    }
}
