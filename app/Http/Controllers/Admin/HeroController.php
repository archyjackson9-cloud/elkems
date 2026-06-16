<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroController extends Controller
{
    public function edit()
    {
        $hero = HeroSection::first() ?? new HeroSection();
        return view('admin.hero.edit', compact('hero'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'heading'              => 'required|string|max:255',
            'subheading'           => 'required|string|max:255',
            'button_primary_text'  => 'required|string|max:100',
            'button_primary_url'   => 'required|string|max:255',
            'button_secondary_text'=> 'required|string|max:100',
            'button_secondary_url' => 'required|string|max:255',
            'background_image'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'is_active'            => 'boolean',
        ]);

        $hero = HeroSection::firstOrNew(['id' => 1]);

        if ($request->hasFile('background_image')) {
            if ($hero->background_image) {
                Storage::disk('public')->delete($hero->background_image);
            }
            $validated['background_image'] = $request->file('background_image')
                ->store('hero', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active', true);
        $hero->fill($validated)->save();

        return back()->with('success', 'Hero section updated successfully.');
    }
}
