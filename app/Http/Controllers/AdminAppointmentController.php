<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;

class AdminAppointmentController extends Controller
{
    // 👁️‍🗨️ عرض جميع الحجوزات
    public function index()
    {
        $appointments = Appointment::with('service', 'user')
            ->orderBy('appointment_date', 'asc')
            ->orderBy('appointment_time', 'asc')
            ->get();

        return response()->json([
            'appointments' => $appointments
        ]);
    }

    // ✏️ تحديث حالة حجز معين
    public function updateStatus(Appointment $appointment, Request $request)
    {
        $request->validate([
            'status' => 'required|in:booked,cancelled,completed'
        ]);

        $appointment->status = $request->status;
        $appointment->save();

        return response()->json([
            'message' => 'Appointment status updated successfully',
            'appointment' => $appointment
        ]);
    }
}