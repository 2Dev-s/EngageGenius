<?php

namespace App\Http\Controllers\Mics;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GuestPagesController extends Controller
{
    public function index()
    {   
        // dd(User::teamSubsciptionTresholdReached());
        Inertia::share("userTeamTreasholdReached",User::teamSubsciptionTresholdReached());
        if (Auth::check()) {
            return Inertia::render('UserDashboard/Dashboard', [
                'userIsSubscribed' => request()->user()->subscribed(),
                'userIsOnTrial' => request()->user()->onTrial()
            ]);
        }

        return Inertia::render('Home');
    }

    public function pricing()
    {
        if (Auth::check()) {
            return Inertia::render('UserDashboard/Pages/Pricing');
        }
        return Inertia::render('Pricing');
    }

    public function TermsOfService()
    {
        return Inertia::render('Legal/TearmsOfService');
    }

    public function PrivacyPolicy()
    {
        return Inertia::render('Legal/PrivacyPolicy');
    }
    
}