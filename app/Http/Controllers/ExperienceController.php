<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Experience;

class ExperienceController extends Controller
{
    public function index()
    {
        $profile = Profile::firstOrFail();

        $experiences = Experience::where('profile_id', $profile->id)
            ->orderByDesc('start_date')
            ->get();

        return view('admin.experiences.index', compact(
            'profile',
            'experiences'
        ));
    }

    public function store(Request $request)
    {
        $profile = Profile::firstOrFail();

        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
        ]);

        $validated['profile_id'] = $profile->id;
        $validated['is_current'] = $request->boolean('is_current');

        if ($validated['is_current']) {
            $validated['end_date'] = null;
        }

        Experience::create($validated);

        return redirect()
            ->route('admin.experiences.index')
            ->with('success', 'Pengalaman berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $profile = Profile::firstOrFail();

        $experience = Experience::where('profile_id', $profile->id)
            ->findOrFail($id);

        return view('admin.experiences.edit', compact('experience'));
    }

    public function update(Request $request, $id)
    {
        $profile = Profile::firstOrFail();

        $experience = Experience::where('profile_id', $profile->id)
            ->findOrFail($id);

        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'nullable|string',
        ]);

        $validated['is_current'] = $request->boolean('is_current');

        if ($validated['is_current']) {
            $validated['end_date'] = null;
        }

        $experience->update($validated);

        return redirect()
            ->route('admin.experiences.index')
            ->with('success', 'Pengalaman berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $profile = Profile::firstOrFail();

        $experience = Experience::where('profile_id', $profile->id)
            ->findOrFail($id);

        $experience->delete();

        return redirect()
            ->route('admin.experiences.index')
            ->with('success', 'Pengalaman berhasil dihapus!');
    }
}
