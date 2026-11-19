<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Profile;

class AdminController extends Controller
{
    public function index()
    {
        $profile = Profile::with([
            'educations',
            'experiences',
            'organizations',
            'skills',
            'achievements',
            'contacts',
        ])->first();

        return view('admin.index', compact('profile'));
    }

    public function editProfile()
    {
        $profile = Profile::firstOrFail();

        return view('admin.edit-profile', compact('profile'));
    }

    public function updateProfile(Request $request)
    {
        $profile = Profile::firstOrFail();

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:255|unique:profiles,nim,' . $profile->id,
            'program_studi' => 'nullable|string|max:255',
            'universitas' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'telepon' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'tentang_saya' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($profile->foto) {
                Storage::disk('public')->delete($profile->foto);
            }

            $validated['foto'] = $request->file('foto')
                ->store('profiles', 'public');
        }

        $profile->update($validated);

        return redirect()
            ->route('admin.index')
            ->with('success', 'Profil berhasil diperbarui!');
    }
}
