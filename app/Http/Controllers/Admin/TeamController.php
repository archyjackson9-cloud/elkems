<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    public function index()
    {
        $members = TeamMember::orderBy('sort_order')->get();
        return view('admin.team.index', compact('members'));
    }

    public function create()
    {
        return view('admin.team.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:150',
            'position'     => 'required|string|max:150',
            'bio'          => 'nullable|string',
            'photo'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'linkedin_url' => 'nullable|url|max:255',
            'twitter_url'  => 'nullable|url|max:255',
            'sort_order'   => 'integer|min:0',
            'is_active'    => 'boolean',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('team', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active', true);
        TeamMember::create($validated);

        return redirect()->route('admin.team.index')
            ->with('success', 'Team member added successfully.');
    }

    public function edit(TeamMember $team)
    {
        return view('admin.team.edit', compact('team'));
    }

    public function update(Request $request, TeamMember $team)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:150',
            'position'     => 'required|string|max:150',
            'bio'          => 'nullable|string',
            'photo'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'linkedin_url' => 'nullable|url|max:255',
            'twitter_url'  => 'nullable|url|max:255',
            'sort_order'   => 'integer|min:0',
            'is_active'    => 'boolean',
        ]);

        if ($request->hasFile('photo')) {
            if ($team->photo) {
                Storage::disk('public')->delete($team->photo);
            }
            $validated['photo'] = $request->file('photo')->store('team', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active', true);
        $team->update($validated);

        return redirect()->route('admin.team.index')
            ->with('success', 'Team member updated successfully.');
    }

    public function destroy(TeamMember $team)
    {
        if ($team->photo) {
            Storage::disk('public')->delete($team->photo);
        }
        $team->delete();
        return redirect()->route('admin.team.index')->with('success', 'Team member deleted.');
    }
}
