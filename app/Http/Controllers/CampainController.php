<?php

namespace App\Http\Controllers;

use App\Models\Campain;
use App\Models\PromptTamplate;
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
        $promptTamplate = PromptTamplate::all();
        return inertia::render('Campains/Create', ['promptTamplates' => $promptTamplate]);
    }

    public function store(Request $request)
    {
        $team = Auth::user()->currentTeam;
        $form = $request->all();


        $team->campains()->create([
            'name' => $form['name'],
            'prompt_tamplate_id' => $form['prompt_tamplate_id'],
            'start_date' => $form['start_date'],
            'end_date' => $form['end_date'],
            
        ]);
    }
}
