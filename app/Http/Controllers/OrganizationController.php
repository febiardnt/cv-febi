<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Organization;

class OrganizationController extends Controller
{
    public function index()
    {
        $profile = Profile::firstOrFail();

        $organizations = Organization::where('profile_id', $profile->id)
            ->orderByDesc('start_year')
            ->get();

        return view('admin.organizations.index', compact(
            'profile',
            'organizations'
        ));
    }

    public function store(Request $request)
    {
        $profile = Profile::firstOrFail();

        $validated = $request->validate([
            'organization_name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'start_year' => 'nullable|integer|min:1950|max:2100',
            'end_year' => 'nullable|integer|min:1950|max:2100',
            'description' => 'nullable|string',
        ]);

        if (
            !empty($validated['end_year']) &&
            !empty($validated['start_year']) &&
            $validated['end_year'] < $validated['start_year']
        ) {
            return back()
                ->withErrors(['end_year' => 'Tahun selesai tidak boleh sebelum tahun mulai.'])
                ->withInput();
        }

        $validated['profile_id'] = $profile->id;

        Organization::create($validated);

        return redirect()
            ->route('admin.organizations.index')
            ->with('success', 'Organisasi berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $profile = Profile::firstOrFail();

        $organization = Organization::where('profile_id', $profile->id)
            ->findOrFail($id);

        return view('admin.organizations.edit', compact('organization'));
    }

    public function update(Request $request, $id)
    {
        $profile = Profile::firstOrFail();

        $organization = Organization::where('profile_id', $profile->id)
            ->findOrFail($id);

        $validated = $request->validate([
            'organization_name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'start_year' => 'nullable|integer|min:1950|max:2100',
            'end_year' => 'nullable|integer|min:1950|max:2100',
            'description' => 'nullable|string',
        ]);

        if (
            !empty($validated['end_year']) &&
            !empty($validated['start_year']) &&
            $validated['end_year'] < $validated['start_year']
        ) {
            return back()
                ->withErrors(['end_year' => 'Tahun selesai tidak boleh sebelum tahun mulai.'])
                ->withInput();
        }

        $organization->update($validated);

        return redirect()
            ->route('admin.organizations.index')
            ->with('success', 'Organisasi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $profile = Profile::firstOrFail();

        $organization = Organization::where('profile_id', $profile->id)
            ->findOrFail($id);

        $organization->delete();

        return redirect()
            ->route('admin.organizations.index')
            ->with('success', 'Organisasi berhasil dihapus!');
    }
}
