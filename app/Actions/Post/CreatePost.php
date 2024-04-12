<?php
namespace App\Actions\Post;

use Illuminate\Contracts\Cache\Store;
use App\Http\Requests\Post\StoreRequest;
use App\Models\Post;
use Carbon\Carbon;
class CreatePost
{

    public function handel(StoreRequest $request) { // handles the request and creates the post handels the logik behind it
        $user = $request->user();
        $team = $user->currentTeam;
        
        $form = $request->all();
        if (!$team) return redirect("/");

        $post = [
            "title"=> $form['title'], // no valiation do to requeirent in the request
            "description"=> $form['description'], // ^
            "tags" => postHandleTags($form["tags"]),
            "publish_date" => Carbon::parse($form["publish_date"]), // ^ 
            ...postHandleSocials($form["socials"]), // merges socials array with post array  (array with key value of socail and if going to be posted or not)
        ];

        $post = $team->posts()->create($post);
        $files = postAddOrderAttributetoPhotos($form['files']);
        if (count($files) > 0) $post->createPhotos($files);
    
        return;
    }
}