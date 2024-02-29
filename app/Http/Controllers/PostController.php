<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Posts/Index');
        
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

        $post = $team->posts()->create([
            'title' => $form['title'],
            'content' => $form['content'],
            "tagsState" => $form['dynamicTagsState']
        ]);
        $path = "/user-". $user->id . "/" . "team-". $team->id ."/". "postsFiles" . "/" . "post-" . $post->id  . "/";

        $photos = [];

        foreach ($form['photos'] as $key => $photo) {
    
            $file_path = $path. "filemane" . ".extestion";
            $photos[] = [
                'path' => $file_path,
                'order' => $key,
            ];
        }
        if (count($photos) > 0) $post->photos()->createMany($photos);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
