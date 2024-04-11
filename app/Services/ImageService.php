<?php
namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
class ImageService
{
    public function __construct()
    {
        // 
    }

    static public function uploadPostPhoto(Post $post, $file){
        $team = $post->team;
        $user = $team->owner;

        $path = "\\user-" . $user->id . "\\" . "team-" . $team->id . "\\" . "postsFiles" . "\\" . "post-" . $post->id  . "\\";

        $file_path = $path . "photo-" . now()->unix() . "-" . rand(1, 10000) . "." . $file->extension();

        Storage::disk('public')->put($file_path, file_get_contents($file));

        return $file_path;
    }


}