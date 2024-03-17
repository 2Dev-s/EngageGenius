<?php

namespace App\Http\Controllers;

use App\Models\Campain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CampainController extends Controller
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

    public function store(Request $request)
    {
        $team = Auth::user()->currentTeam;
        $form = $request->all();
        dd($form);
        $team->campains()->create([
            "name" => $form["tittle"],
            "description" => $form["content"],
            "goal",
            "niche",
            "task",
            "start",
            "end"
        ]);


    }
}
