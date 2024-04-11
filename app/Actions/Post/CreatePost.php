<?php
namespace App\Actions\Post;

use Illuminate\Contracts\Cache\Store;
use App\Http\Requests\Post\StoreRequest;
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
        ];

        if ($form["tags"] && count($form["tags"]) > 0) {
            $form["tags"] = array_map(fn ($tag): string => "#" . $tag, $form['tags']);
            $form["tags"] = implode(" ", $form["tags"]);
            $post["tags"] = $form["tags"];
        }

        if ($form['socials'] && count($form['socials']) > 0 ) {
            foreach ($form["socials"] as $social) {
                if (in_array($social, SOCIALS)) { // check if social is a valid social
                    $post[$social] = true;
                }
            };
        }

        $post = $team->posts()->create($post);
        
        $form['files'] = array_map(function ($file, $i) { // sets order for each file (made for reusability of funtion in update method)
            $file["position"] = $i;
            return $file;
          }, $form['files'], array_keys($form['files']));

        $post->createPhotos($form['files']);
        
        return;
    }
}