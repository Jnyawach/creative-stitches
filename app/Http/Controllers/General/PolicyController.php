<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\Term;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PolicyController extends Controller
{
    //
    public function copyrightGuideline()
    {
        $term = Term::where('category', 'copyright')->first();
        return inertia::render('copyright-guidelines', compact('term'));

    }

    public function cookiePolicy()
    {
        $term = Term::where('category', 'cookie')->first();
        return inertia::render('cookie-policy',compact('term'));
    }

    public function privacyPolicy()
    {
        $term = Term::where('category', 'policy')->first();
        return inertia::render('privacy-policy',compact('term'));
    }

    public function terms()
    {
        $term = Term::where('category', 'terms')->first();
        return inertia::render('terms-and-conditions', compact('term'));
    }
}
