<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;
use Illuminate\Http\Request;
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

        $campaigns = $team->campains()->where('ended', false)->get();
        $posts = $team->posts()->where('published', false)->get();
        
        return Inertia::render('Posts/Index', [
            'posts' => $posts,
            'campaigns' => $campaigns
        ]);
    }

    public function test()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Posts/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = $request->user();
        $team = $user->currentTeam;
        $form = $request->all();

        $post = [
            'title' => $form['title'],
            'content' => $form['content'],
            "tagsState" => $form['dynamicTagsState']
        ];

        
        foreach ($form["socials"] as $social) {$post[$social] = true;};
        $post = $team->posts()->create($post);
        
        $path = "/user-" . $user->id . "/" . "team-" . $team->id . "/" . "postsFiles" . "/" . "post-" . $post->id  . "/";

        $photos = [];

        foreach ($form['orderedFiles'] as $key => $photo) {
            $file = $photo['file'];

            $file_path = $path ."photo-" . now()->unix() . "-" . rand(1,10000) . "." . $file->extension();
            Storage::disk('public')->put($file_path, "test");

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
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::where('id', $request->id)->first();

        if (!$post) return;

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'team_id' => $request->team_id,
            "tags" => $request->dynamicTagsState
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
