<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CampinController extends Controller
{
    //
    public function index()
    {
        $campains = Auth::user()->currentTeam->campains;
        return inertia::render('Campains/Index', ['campains' => $campains]);   
    }

    public function create()
    {
        return inertia::render('Campains/Create');
    }

    public function store()
    {
        dd("Work in Progress");
    }
}
