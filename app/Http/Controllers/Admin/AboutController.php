<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutSection;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function edit()
    {
        $about = AboutSection::singleton();
        return view('admin.about.edit', compact('about'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'description'       => 'required|string',
            'mission_statement' => 'required|string',
        ]);

        $about = AboutSection::singleton();
        $about->fill($validated)->save();

        return back()->with('success', 'About section updated successfully.');
    }
}
