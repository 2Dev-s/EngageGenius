<?php

namespace App\Http\Controllers\InternalPostSystem;

use UpdatePost;
use App\Models\Post;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Actions\Post\CreatePost;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Post\StoreRequest;

use App\Http\Requests\Post\UpdateReqest;
use App\Http\Controllers\ExternalAPIEndpoints\TwitterAPIController;

class PostController extends Controller
{
public $socials = [
    'post_to_twitter',
    'post_to_pinterest',
    'post_to_facebook',
    'post_to_instagram',
    'post_to_linkedin'
];

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

        return Inertia::render('Posts/List', [
            'posts' => $team->posts()->get()
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
    public function edit($id)
    {
        $post = Post::find($id);
        if (!$post or empty($post)) return;

        $photos = $post->photos();
        $photos = $photos->orderBy('order')->get();

        $post = $post->attributesToArray();
        
        $post["tags"] = explode(" ", $post["tags"]);
        $post["tags"] = array_map(fn ($tag): string => str_replace("#", "", $tag), $post['tags']);

        $post["files"] = $photos;
        
        return Inertia::render('Posts/Edit', [
            'post' => $post
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
