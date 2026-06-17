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

        if (!empty($validated['google_maps_embed'])) {
            $validated['google_maps_embed'] = $this->normalizeMapUrl($validated['google_maps_embed']);
        }

        foreach ($validated as $key => $value) {
            Setting::set($key, $value ?? '');
        }

        return back()->with('success', 'Settings updated successfully.');
    }

    private function normalizeMapUrl(string $input): string
    {
        $input = trim($input);

        // User pasted the full <iframe> tag — extract the src
        if (str_contains($input, '<iframe')) {
            preg_match('/src=["\']([^"\']+)["\']/', $input, $matches);
            $input = $matches[1] ?? '';
        }

        // Already a proper embed URL
        if (str_contains($input, 'google.com/maps/embed')) {
            return $input;
        }

        // Regular share URL — convert to embed URL
        // e.g. https://www.google.com/maps/place/Accra/@5.6037,... -> embed equivalent
        if (preg_match('/google\.com\/maps/', $input)) {
            // Extract @lat,lng,zoom if present
            if (preg_match('/@([-\d.]+),([-\d.]+),(\d+)z/', $input, $m)) {
                return "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d0!2d{$m[2]}!3d{$m[1]}!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zM!5e0!3m2!1sen!2sgh!4v0&q={$m[1]},{$m[2]}&z={$m[3]}";
            }
        }

        return $input;
    }
}
