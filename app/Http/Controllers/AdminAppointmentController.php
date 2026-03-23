<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminAppointmentController extends Controller
{
    public function index(Request $request)
    {
        return response()->json([
            'message' => 'Not implemented yet',
        ], 501);
    }

    public function updateStatus(Request $request, int $appointment)
    {
        return response()->json([
            'message' => 'Not implemented yet',
        ], 501);
    }
}

