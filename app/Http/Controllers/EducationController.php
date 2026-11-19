<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Education;

class EducationController extends Controller
{
    public function index()
    {
        $profile = Profile::firstOrFail();

        $educations = Education::where('profile_id', $profile->id)
            ->orderByDesc('start_year')
            ->get();

        return view('admin.educations.index', compact(
            'profile',
            'educations'
        ));
    }

    public function store(Request $request)
    {
        $profile = Profile::firstOrFail();

        $validated = $request->validate([
            'school_name' => 'required|string|max:255',
            'degree' => 'required|string|max:100',
            'major' => 'nullable|string|max:255',
            'start_year' => 'required|integer|min:1950|max:2100',
            'end_year' => 'nullable|integer|min:1950|max:2100',
            'description' => 'nullable|string',
        ]);

        if (
            !empty($validated['end_year']) &&
            $validated['end_year'] < $validated['start_year']
        ) {
            return back()
                ->withErrors(['end_year' => 'Tahun selesai tidak boleh sebelum tahun mulai.'])
                ->withInput();
        }

        $validated['profile_id'] = $profile->id;

        Education::create($validated);

        return redirect()
            ->route('admin.educations.index')
            ->with('success', 'Pendidikan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $profile = Profile::firstOrFail();

        $education = Education::where('profile_id', $profile->id)
            ->findOrFail($id);

        return view('admin.educations.edit', compact('education'));
    }

    public function update(Request $request, $id)
    {
        $profile = Profile::firstOrFail();

        $education = Education::where('profile_id', $profile->id)
            ->findOrFail($id);

        $validated = $request->validate([
            'school_name' => 'required|string|max:255',
            'degree' => 'required|string|max:100',
            'major' => 'nullable|string|max:255',
            'start_year' => 'required|integer|min:1950|max:2100',
            'end_year' => 'nullable|integer|min:1950|max:2100',
            'description' => 'nullable|string',
        ]);

        if (
            !empty($validated['end_year']) &&
            $validated['end_year'] < $validated['start_year']
        ) {
            return back()
                ->withErrors(['end_year' => 'Tahun selesai tidak boleh sebelum tahun mulai.'])
                ->withInput();
        }

        $education->update($validated);

        return redirect()
            ->route('admin.educations.index')
            ->with('success', 'Pendidikan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $profile = Profile::firstOrFail();

        $education = Education::where('profile_id', $profile->id)
            ->findOrFail($id);

        $education->delete();

        return redirect()
            ->route('admin.educations.index')
            ->with('success', 'Pendidikan berhasil dihapus!');
    }
}
