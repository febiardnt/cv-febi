<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Skill;

class SkillController extends Controller
{
    public function index()
    {
        $profile = Profile::firstOrFail();

        $skills = Skill::where('profile_id', $profile->id)
            ->orderBy('skill_name')
            ->get();

        return view('admin.skills.index', compact('profile', 'skills'));
    }

    public function store(Request $request)
    {
        $profile = Profile::firstOrFail();

        $validated = $request->validate([
            'skill_name' => 'required|string|max:255',
            'proficiency' => 'required|integer|min:0|max:100',
        ]);

        $validated['profile_id'] = $profile->id;

        Skill::create($validated);

        return redirect()
            ->route('admin.skills.index')
            ->with('success', 'Keahlian berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $profile = Profile::firstOrFail();

        $skill = Skill::where('profile_id', $profile->id)
            ->findOrFail($id);

        return view('admin.skills.edit', compact('skill'));
    }

    public function update(Request $request, $id)
    {
        $profile = Profile::firstOrFail();

        $skill = Skill::where('profile_id', $profile->id)
            ->findOrFail($id);

        $validated = $request->validate([
            'skill_name' => 'required|string|max:255',
            'proficiency' => 'required|integer|min:0|max:100',
        ]);

        $skill->update($validated);

        return redirect()
            ->route('admin.skills.index')
            ->with('success', 'Keahlian berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $profile = Profile::firstOrFail();

        $skill = Skill::where('profile_id', $profile->id)
            ->findOrFail($id);

        $skill->delete();

        return redirect()
            ->route('admin.skills.index')
            ->with('success', 'Keahlian berhasil dihapus!');
    }
}
