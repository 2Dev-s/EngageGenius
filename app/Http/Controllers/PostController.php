<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\PostPhoto;
use Inertia\Inertia;
use Illuminate\Http\Request;
use function PHPSTORM_META\map;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $team = Auth::user()->currentTeam;
        if (!$team) return redirect("/");

        $campaigns = $team->campains()->where('ended', false)->get() ;
        $posts = $team->posts()->where('published', false)->get() ;

        if (!$campaigns) $campaigns = [];
        if (!$posts) $posts = [];
        
        return Inertia::render('Posts/Index', [
            'posts' => $posts,
            'campaigns' => $campaigns
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Posts/Create');
    }


    /**
     * Show the list for creating a new resource.
     */
    public function list()
    {
        $team = Auth::user()->currentTeam;
        
        return Inertia::render('Posts/List', [
            'posts' => $team->posts()->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) 
    {
        $user = $request->user();
        $team = $user->currentTeam;
        $form = $request->all();
        $form["tags"] = array_map(fn($tag): string => "#" .$tag, $form['tags']);
        $form["tags"] = implode(" ", $form["tags"]);

        $post = [
            'title' => $form['title'],
            'content' => $form['content'],
            "tags" => $form["tags"],
            "publish_date" => Carbon::parse($form["postDate"]),
        ];

        foreach ($form["socials"] as $social) {$post[$social] = true;};

        $post = $team->posts()->create($post);
        
        $path = "/user-" . $user->id . "/" . "team-" . $team->id . "/" . "postsFiles" . "/" . "post-" . $post->id  . "/";

        $photos = [];

        foreach ($form['files'] as $key => $photo) {
            $file = $photo['file'];

            $file_path = $path ."photo-" . now()->unix() . "-" . rand(1,10000) . "." . $file->extension();

            Storage::disk('public')->put($file_path, file_get_contents($file));

            $photos[] = [
                'path' => $file_path,
                'order' => $key,
            ];
        }

        if (count($photos) > 0) $post->photos()->createMany($photos);

        return redirect()->route('posts');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        
        if (!$post) return;
        $photos = $post->photos();
        $photos = $photos->orderBy('order')->get();   

        $post = $post->attributesToArray();
        $post["tags"] = explode(" ", $post["tags"]);
        $post["files"]= $photos;

        return Inertia::render('Posts/Edit', [
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        if (!$post) return;

        $user = $request->user();
        $form = $request->all();
        $team = $user->currentTeam;
        
        $photos = [];

        $form["tags"] = array_map(fn($tag): string => "#" .$tag, $form['tags']);
        $form["tags"] = implode(" ", $form["tags"]);
        
        $post = [
            'title' => $form['title'],
            'content' => $form['content'],
            "tags" => $form["tags"],
            "publish_date" => Carbon::parse($form["postDate"]),
        ];
        
        if ($form["socials"]) foreach ($form["socials"] as $social) {$post[$social] = true;};

        $post = $team->posts()->where('id', $form["id"])->update($post);
        if (!$post) return;
        $post = $team->posts()->where('id', $form["id"])->first();

        $path = "/user-" . $user->id . "/" . "team-" . $team->id . "/" . "postsFiles" . "/" . "post-" .$post->id  . "/";
        foreach ($form['files'] as $index => $photo) { // Loop through each photo
            if($photo['origin'] == "server") { 
                PostPhoto::where(['id' => $photo['id']])->update(['order' => $index]); 
                continue;
            };

            if($photo['origin'] == "client") {
                $file = $photo['file'];

                $file_path = $path ."photo-" . now()->unix() . "-" . rand(1,10000) . "." . $file->extension();

                Storage::disk('public')->put($file_path, file_get_contents($file));
    
                $photos[] = [
                    'path' => $file_path,
                    'order' => $index,
                ];
                if (count($photos) > 0) $post->photos()->createMany($photos);
                continue;
            };


            return redirect()->route('posts');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Post $post)
    {
        if (!$post) return;
        $post->delete();
        return redirect()->route('posts');
    }
}
