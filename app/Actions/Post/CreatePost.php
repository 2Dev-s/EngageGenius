<?php
namespace App\Actions\Post;

use Illuminate\Contracts\Cache\Store;
use App\Http\Requests\Post\StoreRequest;
use App\Models\Post;
use Carbon\Carbon;

const SOCIALS = [
    'post_to_twitter',
    'post_to_pinterest',
    'post_to_facebook',
    'post_to_instagram',
    'post_to_linkedin'
];
class CreatePost
{

    private function handleTags($tags) { // handles tags and returns them as a string
        if ($tags && count($tags) > 0) {
            $tags = array_map(fn ($tag): string => "#" . $tag, $tags);
            $tags = implode(" ", $tags);
            return $tags;
        }

        return null;
    }

    private function handlePhotos($files, Post $post) { // handles photos and returns them as an array
        
        if ($files && count($files) > 0) {
            $files = array_map(function ($file, $i) { // sets order for each file (made for reusability of funtion in update method)
                $file["position"] = $i;
                return $file;
            }, $files, array_keys($files));

            $post->createPhotos($files);
        }

        return;
    }

    private function handleSocials($socials) { // handles socials and returns them as an array

        $selectedSocials = [];

        foreach (SOCIALS as $social) {
            $selectedSocials[$social] = ((in_array($social, $socials)) ? true : false);
        };

        return $selectedSocials;
    }

    public function handel(StoreRequest $request)
    {
        $user = $request->user();
        $team = $user->currentTeam;
        
        $form = $request->all();
        if (!$team) return redirect("/");

        $post = [
            "title"=> $form['title'],
            "description"=> $form['description'],
            "publish_date" => Carbon::parse($form["publish_date"]),
            "tags" => $this->handleTags($form["tags"]),
            ...$this->handleSocials($form["socials"]), // merges socials array with post array  (array with key value of socail and if going to be posted or not)
        ];

        $post = $team->posts()->create($post);
        
        $this->handlePhotos($form['files'], $post);
        
        return;
    }
}