<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::orderBy('sort_order')->get();
        return view('admin.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('admin.clients.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:150',
            'logo'        => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'logo_text'   => 'nullable|string|max:255',
            'logo_style'  => 'nullable|string|max:500',
            'website_url' => 'nullable|url|max:255',
            'sort_order'  => 'integer|min:0',
            'is_active'   => 'boolean',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('clients', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active', true);
        Client::create($validated);

        return redirect()->route('admin.clients.index')
            ->with('success', 'Client added successfully.');
    }

    public function edit(Client $client)
    {
        return view('admin.clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:150',
            'logo'        => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'logo_text'   => 'nullable|string|max:255',
            'logo_style'  => 'nullable|string|max:500',
            'website_url' => 'nullable|url|max:255',
            'sort_order'  => 'integer|min:0',
            'is_active'   => 'boolean',
        ]);

        if ($request->hasFile('logo')) {
            if ($client->logo) {
                Storage::disk('public')->delete($client->logo);
            }
            $validated['logo'] = $request->file('logo')->store('clients', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active', true);
        $client->update($validated);

        return redirect()->route('admin.clients.index')
            ->with('success', 'Client updated successfully.');
    }

    public function destroy(Client $client)
    {
        if ($client->logo) {
            Storage::disk('public')->delete($client->logo);
        }
        $client->delete();
        return redirect()->route('admin.clients.index')->with('success', 'Client deleted.');
    }
}
