<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Campain;
use Illuminate\Http\Request;
use App\Models\PromptTamplate;
use Illuminate\Support\Facades\Auth;

class CampainController extends Controller
{
    //
    public function index(){
        $campains = Auth::user()->currentTeam->campains;
        return inertia::render('Campains/Index', ['campains' => $campains]);   
    }

    public function create(){
        $promptTamplate = PromptTamplate::all();
        return inertia::render('Campains/Create', ['promptTamplates' => $promptTamplate]);
    }

    public function edit(Campain $campain , Request $request){
        $user = Auth::user();
        $team = $user->currentTeam;
        if ($team->id != $campain->team_id) return redirect()->route('posts');
        $promptTamplate = PromptTamplate::all();

        return inertia::render('Campains/Edit', ['campain' => $campain, 'promptTamplates' => $promptTamplate]);
    }

    public function list(){
        $campains = Auth::user()->currentTeam->campains;
        return inertia::render('Campains/List', ['campains' => $campains]);
    }


    public function store(Request $request){
        $team = Auth::user()->currentTeam;
        $form = $request->all();

        $team->campains()->create([
            'title' => $form['title'],
            'description' => $form['description'],
            'niche' => $form['niche'],
            'tamplate_id' => $form['tamplate_id'],
            'product_description' => $form['product_description'],
            'product_features' => $form['product_features'],
            'image_data' => $form['image_data'],
            'discount' => $form['discount'],
            'cta_text' => $form['cta_text'],
            'redirect_link' => $form['redirect_link'],
            'start_date' =>  Carbon::parse($form['start_date']),
            'end_date' => Carbon::parse($form['end_date']),
        ]);

        return redirect()->route('posts');
    }

    public function update(Campain $id , Request $request){
        $user = Auth::user();
        $team = $user->currentTeam;
        if ($team->id != $id->team_id) return redirect()->route('posts');
        $form = $request->all(); 
        $id->update([
            'title' => $form['title'],
            'description' => $form['description'],
            'niche' => $form['niche'],
            'tamplate_id' => $form['tamplate_id'],
            'product_description' => $form['product_description'],
            'product_features' => $form['product_features'],
            'image_data' => $form['image_data'],
            'discount' => $form['discount'],
            'cta_text' => $form['cta_text'],
            'redirect_link' => $form['redirect_link'],
            'start_date' =>  Carbon::parse($form['start_date']),
            'end_date' => Carbon::parse($form['end_date']),
        ]);
        
        return redirect()->route('posts');
    }

    public function delete(Campain $campain)
    {
        if (!$campain) return;
        $campain->delete();
        return redirect()->route('posts');
    }

    public function generatePosts(Campain $campain, int $count ){

    }
}
