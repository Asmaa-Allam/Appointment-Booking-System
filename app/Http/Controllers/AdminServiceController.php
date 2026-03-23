<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminServiceController extends Controller
{
    public function store(Request $request)
    {
        return response()->json([
            'message' => 'Not implemented yet',
        ], 501);
    }

    public function update(Request $request, int $service)
    {
        return response()->json([
            'message' => 'Not implemented yet',
        ], 501);
    }

    public function toggleStatus(Request $request, int $service)
    {
        return response()->json([
            'message' => 'Not implemented yet',
        ], 501);
    }
}

