<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('sort_order')->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'required|string',
            'icon'         => 'nullable|string|max:100',
            'badge_labels' => 'nullable|string|max:255',
            'sort_order'   => 'integer|min:0',
            'is_active'    => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);
        Service::create($validated);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service created successfully.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'required|string',
            'icon'         => 'nullable|string|max:100',
            'badge_labels' => 'nullable|string|max:255',
            'sort_order'   => 'integer|min:0',
            'is_active'    => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);
        $service->update($validated);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')
            ->with('success', 'Service deleted.');
    }
}
