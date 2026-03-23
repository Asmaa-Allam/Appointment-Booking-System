<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function availability(Request $request)
    {
        return response()->json([
            'message' => 'Not implemented yet',
        ], 501);
    }

    public function myAppointments(Request $request)
    {
        return response()->json([
            'message' => 'Not implemented yet',
        ], 501);
    }

    public function store(Request $request)
    {
        return response()->json([
            'message' => 'Not implemented yet',
        ], 501);
    }

    public function cancel(Request $request, int $appointment)
    {
        return response()->json([
            'message' => 'Not implemented yet',
        ], 501);
    }
}

