<?php

namespace App\Http\Controllers;

use App\Models\Profile;

class PortfolioController extends Controller
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

        return view('portfolio.index', compact('profile'));
    }
}
