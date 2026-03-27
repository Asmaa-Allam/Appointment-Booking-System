<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class AppointmentController extends Controller
{
     // GET /api/availability
     public function availability(Request $request)
     {
         // Validate input
         $request->validate([
             'service_id' => 'required|exists:services,id',
             'date' => 'required|date|after_or_equal:today',
         ]);
 
         $serviceId = $request->service_id;
         $date = $request->date;
 
         // Get the service duration
         $service = Service::findOrFail($serviceId);
         $duration = $service->duration_minutes; // assumed integer in minutes
 
         // Define working hours (مثلاً 9:00 - 17:00)
         $startTime = Carbon::parse('09:00');
         $endTime = Carbon::parse('17:00');
 
         // Generate all possible slots
         $slots = [];
         $current = clone $startTime;
 
         while ($current->lte($endTime->subMinutes($duration))) {
             $slots[] = $current->format('H:i');
             $current->addMinutes($duration);
         }
 
         // Get booked appointments for this date and service
         $bookedTimes = Appointment::where('service_id', $serviceId)
             ->where('appointment_date', $date)
             ->pluck('appointment_time')
             ->toArray();
 
         // Filter out booked slots
         $availableSlots = array_diff($slots, $bookedTimes);
 
         return response()->json([
             'service_id' => $serviceId,
             'date' => $date,
             'available_slots' => array_values($availableSlots),
         ]);
     }

    public function myAppointments(Request $request)
    {
        $user = $request->user();

        $appointments = \App\Models\Appointment::with('service') // eager loading
            ->where('user_id', $user->id)
            ->orderBy('appointment_date', 'asc')
            ->orderBy('appointment_time', 'asc')
            ->get();
    
        return response()->json([
            'appointments' => $appointments
        ]);
    }

    

public function cancel($id, Request $request)
{
    $user = $request->user();

    $appointment = \App\Models\Appointment::find($id);

    // ❌ إذا الحجز غير موجود
    if (!$appointment) {
        return response()->json([
            'error' => 'Appointment not found'
        ], 404);
    }

    // 🔐 تحقق أن الحجز يخص المستخدم
    if ($appointment->user_id !== $user->id) {
        return response()->json([
            'error' => 'Unauthorized'
        ], 403);
    }

    // ❌ إذا الحجز ملغي مسبقًا
    if ($appointment->status === 'cancelled') {
        return response()->json([
            'error' => 'Appointment already cancelled'
        ], 400);
    }

    // ❌ (اختياري) منع إلغاء حجز مكتمل
    if ($appointment->status === 'completed') {
        return response()->json([
            'error' => 'Cannot cancel completed appointment'
        ], 400);
    }

    // ✅ تحديث الحالة بدل الحذف (أفضل practice)
    $appointment->status = 'cancelled';
    $appointment->save();

    return response()->json([
        'message' => 'Appointment cancelled successfully'
    ]);
}

public function create(Service $service)
{
    // ترجع صفحة اختيار التاريخ والوقت مع بيانات الخدمة
    return view('appointments.create', compact('service'));
}

 // حفظ الحجز
 public function store(Request $request)
 {
    $request->validate([
        'service_id' => 'required|exists:services,id',
        'start_time' => 'required|date|after_or_equal:now',
    ]);

    // حساب end_time تلقائيًا حسب مدة الخدمة
    $service = Service::findOrFail($request->service_id);
    $start = Carbon::parse($request->start_time); // من الفورم
    $end = $start->copy()->addMinutes($service->duration);

     // منع الحجز المزدوج
    $exists = Appointment::where('service_id', $request->service_id)
    ->where(function($query) use ($start, $end) {
        $query->whereBetween('start_time', [$start, $end])
            ->orWhereBetween('end_time', [$start, $end]);
    })
    ->exists();

    if ($exists) {
        return back()->withErrors(['start_time' => 'هذا الموعد محجوز بالفعل'])->withInput();
    }
    
    // حفظ الحجز
    Appointment::create([
        'user_id' => Auth::id(),
        'service_id' => $request->service_id,
        'start_time' => $start,
        'end_time' => $end,
        'status' => 'Booked',
        'notes' => $request->notes ?? null,
    ]);

     return redirect()->route('appointments.my')->with('success', 'تم حجز الموعد بنجاح');
 }
}

