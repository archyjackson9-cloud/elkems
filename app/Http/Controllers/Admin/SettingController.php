<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    protected array $keys = [
        'site_name', 'tagline', 'phone', 'email', 'address',
        'linkedin', 'twitter', 'facebook',
        'admin_email', 'google_maps_embed',
        'footer_text',
    ];

    public function edit()
    {
        $settings = [];
        foreach ($this->keys as $key) {
            $settings[$key] = Setting::get($key, '');
        }
        return view('admin.settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_name'         => 'nullable|string|max:150',
            'tagline'           => 'nullable|string|max:255',
            'phone'             => 'nullable|string|max:50',
            'email'             => 'nullable|email|max:150',
            'address'           => 'nullable|string|max:255',
            'linkedin'          => 'nullable|url|max:255',
            'twitter'           => 'nullable|url|max:255',
            'facebook'          => 'nullable|url|max:255',
            'admin_email'       => 'nullable|email|max:150',
            'google_maps_embed' => 'nullable|string',
            'footer_text'       => 'nullable|string|max:500',
        ]);

        foreach ($validated as $key => $value) {
            Setting::set($key, $value ?? '');
        }

        return back()->with('success', 'Settings updated successfully.');
    }
}
