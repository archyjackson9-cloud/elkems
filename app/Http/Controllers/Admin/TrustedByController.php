<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrustedBy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TrustedByController extends Controller
{
    public function index()
    {
        $trustedBys = TrustedBy::orderBy('sort_order')->get();
        return view('admin.trusted-by.index', compact('trustedBys'));
    }

    public function create()
    {
        return view('admin.trusted-by.create');
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
            $validated['logo'] = $request->file('logo')->store('trusted-by', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active', true);
        TrustedBy::create($validated);

        return redirect()->route('admin.trusted-by.index')
            ->with('success', 'Trusted-by entry added successfully.');
    }

    public function edit(TrustedBy $trustedBy)
    {
        return view('admin.trusted-by.edit', compact('trustedBy'));
    }

    public function update(Request $request, TrustedBy $trustedBy)
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
            if ($trustedBy->logo) {
                Storage::disk('public')->delete($trustedBy->logo);
            }
            $validated['logo'] = $request->file('logo')->store('trusted-by', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active', true);
        $trustedBy->update($validated);

        return redirect()->route('admin.trusted-by.index')
            ->with('success', 'Trusted-by entry updated successfully.');
    }

    public function destroy(TrustedBy $trustedBy)
    {
        if ($trustedBy->logo) {
            Storage::disk('public')->delete($trustedBy->logo);
        }
        $trustedBy->delete();
        return redirect()->route('admin.trusted-by.index')->with('success', 'Trusted-by entry deleted.');
    }
}
