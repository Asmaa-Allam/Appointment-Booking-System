<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $services = Service::query()
            ->where('is_active', true)
            ->orderBy('id')
            ->get(['id', 'name', 'description', 'duration_minutes', 'price', 'is_active']);

        return response()->json($services);
    }

    public function show(int $service)
    {
        $serviceModel = Service::query()
            ->where('is_active', true)
            ->where('id', $service)
            ->firstOrFail(['id', 'name', 'description', 'duration_minutes', 'price', 'is_active']);

        return response()->json($serviceModel);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'duration_minutes' => ['required', 'integer', 'min:1'],
            'price' => ['required', 'numeric', 'min:0'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $service = Service::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'duration_minutes' => $validated['duration_minutes'],
            'price' => $validated['price'],
            'is_active' => $validated['is_active'] ?? true,
        ]);

        return response()->json($service, 201);
    }

    public function update(Request $request, int $service)
    {
        $serviceModel = Service::query()->findOrFail($service);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'duration_minutes' => ['required', 'integer', 'min:1'],
            'price' => ['required', 'numeric', 'min:0'],
            'is_active' => ['sometimes', 'boolean'],
        ]);

        $serviceModel->update([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'duration_minutes' => $validated['duration_minutes'],
            'price' => $validated['price'],
            'is_active' => $validated['is_active'] ?? $serviceModel->is_active,
        ]);

        return response()->json($serviceModel);
    }

    public function destroy(Request $request, int $service)
    {
        $serviceModel = Service::query()->findOrFail($service);
        $serviceModel->delete();

        return response()->json([
            'message' => 'Service deleted',
        ]);
    }
}

