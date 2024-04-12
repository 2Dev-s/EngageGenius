<?php

namespace App\Http\Controllers\InternalPostSystem;

use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Campain;

use Illuminate\Http\Request;
use App\Models\PromptTamplate;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\ExternalAPIEndpoints\OpenAiController;

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

    public function edit(Campain $campain, Request $request)
    {
        $user = Auth::user();
        $team = $user->currentTeam;
        if ($team->id != $campain->team_id) return redirect()->route('posts');
        $promptTamplate = PromptTamplate::all();

        return inertia::render('Campains/Edit', ['campain' => $campain, 'promptTamplates' => $promptTamplate]);
    }
    public function list()
    {
        $campains = Auth::user()->currentTeam->campains;
        return inertia::render('Campains/List', ['campains' => $campains]);
    }

    public function store(Request $request)
    {
        $team = Auth::user()->currentTeam;
        $form = $request->all();

        $team->campains()->create([
            'title' => $form['title'],
            'description' => $form['description'],
            'niche' => $form['niche'],
            'tamplate_id' => $form['tamplate_id'],
            "posts_count" => $form['posts_count'],
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

    public function update(Campain $id, Request $request)
    {
        $user = Auth::user();
        $team = $user->currentTeam;
        if ($team->id != $id->team_id) return redirect()->route('posts');
        $form = $request->all();
        $id->update([
            'title' => $form['title'],
            'description' => $form['description'],
            'niche' => $form['niche'],
            'posts_count' => intval($form['posts_count']),
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

    public function generatePosts(Campain $campain) {
        $count = intval($campain->posts_count);

        $team = $campain->team;
        $user = $team->owner;

        if (!$campain) return;
        if ($count < 1) return;
        
        $open = new OpenAiController();
        $posts = [];

        for ($i = 0; $i < $count; $i++) {
            $res = $open->createPostFromCampain($campain);
            $post = [
                "title" => explode("\n", $res)[0],
                "content" => explode("\n", $res)[1],
                "team_id" => $campain->team_id,
                "campain_id" => $campain->id,
            ];
            $posts[] = $post;
        }

        $posts = $campain->posts()->createMany($posts);
        $base65_res = $open->generateImage($campain->image_data);
        $base65_res = "data:image/png;base64," .  $base65_res[0]->b64_json;
        if (!$posts) return;

        $path = "/user-" . $user->id . "/" . "team-" . $team->id . "/" . "campainFiles" . "/" . "campain-" . $campain->id  . "/";
        $file_path = $path . "photo-" . now()->unix() . "-" . rand(1, 10000) . "." . ".jpeg";
        
        Storage::disk('public')->put($file_path, file_get_contents($base65_res));

        $photo = [
            'path' => $file_path,
            'order' => 0,
        ];

        foreach ($posts as $post) {$post->photos()->create($photo);}

        return redirect()->route('posts.list');
    }

}
