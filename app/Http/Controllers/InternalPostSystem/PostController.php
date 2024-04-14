<?php

namespace App\Http\Controllers\InternalPostSystem;


use App\Models\Post;
use Inertia\Inertia;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ExternalAPIEndpoints\TwitterAPIController;

use Illuminate\Support\Facades\Auth;

use App\Actions\InternalPostSystem\CreatePost;
use App\Actions\InternalPostSystem\UpdatePost;

use App\Http\Requests\InternalPostSystem\StoreRequest;
use App\Http\Requests\InternalPostSystem\UpdateReqest;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $team = Auth::user()->currentTeam;
        if (!$team) return redirect("/");

        $campaigns = $team->campains()->where('ended', false)->get();
        $posts = $team->posts()->where('published', false)->get();

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
        $campains = $team->campains->toArray();
        return Inertia::render('Posts/List', [
            'posts' => $team->posts()->get(),
            'campains' => $campains,
            "socials" => POSTSOCIALS
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request, CreatePost $createPost)
    {
        $request->validated();

        $createPost->handel($request);
        
        return redirect()->route('posts');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if (!$post or empty($post)) return;

        $postData = $post->attributesToArray();
        $postData["tags"] = postHandleTagsUnpack($post["tags"]);
        $postData["socials"] = postHandleSocialsToArray($postData);
        $postData["files"] = $post->photos()->orderBy('order')->get();

        return Inertia::render('Posts/Edit', [
            'post' => $postData
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReqest $request, Post $post, UpdatePost $updatePost)
    {
        $request->validated();

        $updatePost->handle($request, $post);

        return redirect()->route('posts');
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


    public function publish(Post $post, Request $req)
    {
        $twitter = new TwitterAPIController();
        (($req->Twitter) ? $twitter->post($post->id) : ''); // if request has twitter return post function
        (($req->Pinterest) ? 'return post function' : ''); // if request has Pinterest return post function
        (($req->Instagram) ? 'return post function' : ''); // if request has Instagram return post function
        (($req->Facebook) ? 'return post function' : ''); // if request has Facebook return post function
        (($req->Linkedin) ? 'return post function' : ''); // if request has Linkedin return post function

        $post->update([
            'published' => true
        ]);
    }
}
