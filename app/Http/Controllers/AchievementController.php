<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Profile;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
    // Menampilkan daftar prestasi
    public function index()
    {
        $profile = Profile::firstOrFail();

        $achievements = Achievement::where('profile_id', $profile->id)
            ->latest()
            ->get();

        return view('admin.achievements.index', compact('achievements'));
    }

    // Menambahkan prestasi
    public function store(Request $request)
    {
        $profile = Profile::firstOrFail();

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'issuer' => 'nullable|string|max:255',
            'date' => 'nullable|date',
            'description' => 'nullable|string',
            'certificate_file' => 'nullable|string|max:255',
        ]);

        $validated['profile_id'] = $profile->id;

        Achievement::create($validated);

        return redirect()->route('admin.achievements.index')
            ->with('success', 'Prestasi berhasil ditambahkan.');
    }

    // Menampilkan halaman edit
    public function edit($id)
    {
        $profile = Profile::firstOrFail();

        $achievement = Achievement::where('profile_id', $profile->id)
            ->findOrFail($id);

        return view('admin.achievements.edit', compact('achievement'));
    }

    // Memperbarui prestasi
    public function update(Request $request, $id)
    {
        $profile = Profile::firstOrFail();

        $achievement = Achievement::where('profile_id', $profile->id)
            ->findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'issuer' => 'nullable|string|max:255',
            'date' => 'nullable|date',
            'description' => 'nullable|string',
            'certificate_file' => 'nullable|string|max:255',
        ]);

        $achievement->update($validated);

        return redirect()->route('admin.achievements.index')
            ->with('success', 'Prestasi berhasil diperbarui.');
    }

    // Menghapus prestasi
    public function destroy($id)
    {
        $profile = Profile::firstOrFail();

        $achievement = Achievement::where('profile_id', $profile->id)
            ->findOrFail($id);

        $achievement->delete();

        return redirect()->route('admin.achievements.index')
            ->with('success', 'Prestasi berhasil dihapus.');
    }
}
