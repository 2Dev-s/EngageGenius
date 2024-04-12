<?php

namespace App\Actions\InternalPostSystem;

use App\Models\Post;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use App\Http\Requests\InternalPostSystem\UpdateReqest;

class UpdatePost
{

    public function handle(UpdateReqest $request,Post $post)
    {
        if (!$post) return;
        

        $user = $request->user();
        $form = $request->all();
        $team = $user->currentTeam;

        if ($post->id !== $form["id"]) return;

        $post = [
            'title' => $form['title'], // no valiation do to requeirent in the request
            'description' => $form['description'],  // ^
            "tags" => postHandleTags($form["tags"]),  // ^
            "publish_date" => Carbon::parse($form["publish_date"]), 
            ...postHandleSocials($form["socials"]), // merges socials array with post array (array with key value of socail and if going to be posted or not)
        ];
        
        $team->posts()->where('id', $form["id"])->update($post);

        $post = $team->posts()->where('id', $form["id"])->first();

        if ($form['files'] && count($form['files']) > 0) {
            $files = postAddOrderAttributetoPhotos($form['files']);

            $oldPhotos = Arr::where($files, function ($value) { return ($value['origin'] == "server"); });
            $newPhotos = Arr::where($files, function ($value) { return ($value['origin'] !== "server" ); });
    
            if (count($newPhotos) > 0) $post->createPhotos($newPhotos);
            if (count($oldPhotos) > 0) $post->updatePhotos($oldPhotos);
        }

        return;
    }
}