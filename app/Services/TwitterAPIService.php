<?php
namespace App\Services;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Support\Facades\Storage;

class TwitterAPIService {
    private $client;
    public function __construct() {
        $this->client = new TwitterOAuth(env("TWITTER_CONSUMER_KEY"), env("TWITTER_CONSUMER_KEY_SECRET"));
    }

    public function oauth() {
        $request_token = $this->client->oauth('oauth/request_token', array('oauth_callback' => route('twitter-callback')));

        session(['oauth_token' => $request_token['oauth_token']]);
        session(['oauth_token_secret' => $request_token['oauth_token_secret']]);

        $url = $this->client->url('oauth/authorize', ['oauth_token' => $request_token['oauth_token']]);

        return redirect($url);
    }

    public function callback(Request $request) {
        $request_token['oauth_token'] = session('oauth_token');
        $request_token['oauth_token_secret'] = session('oauth_token_secret');

        $this->client = new TwitterOAuth(env("TWITTER_CONSUMER_KEY"), env("TWITTER_CONSUMER_KEY_SECRET"), $request_token['oauth_token'], $request_token['oauth_token_secret']); // app as user
        $access_token =  $this->client->oauth("oauth/access_token", ["oauth_verifier" => $request->all()['oauth_verifier']]);

        $team = Auth::user()->currentTeam;
        $socialData = $team->socialData();
        
        $res = $socialData->update(['twitter' => $access_token]);

    }

    public function share(Post $post)
    {
        $team = Auth::user()->currentTeam;
        $socialData = $team->socialData;

        $request_token = json_decode($socialData->twitter);

        $this->client = new TwitterOAuth(env("TWITTER_CONSUMER_KEY"), env("TWITTER_CONSUMER_KEY_SECRET"), $request_token->oauth_token, $request_token->oauth_token_secret);
    

        $data = [
                "text" => $post->content . "\n\n" . $post->tags,
                "media" => [
                    "media_ids" => $this->uploadPostMedia($post),
                ]
        ];

        $this->client->setApiVersion(2); // Important to set the API version to 2
        // https://developer.twitter.com/en/docs/twitter-api/tweets/manage-tweets/api-reference/post-tweets#tab0

        $statuses = $this->client->post("tweets", $data);

        return $statuses;
    }

    

    private function uploadPostMedia(Post $post) {

        $this->client->setApiVersion(1.1); // Important to set the API version to 1.1

        $photos = $post->photos->toArray();

        if (count($photos) > 4) {
            $photos = array_slice($photos, 0, 3); // Twitter only allows 4 photos per tweet
        }

        $mediaIds = [];

        foreach  ($photos as $photo) {
            $path = Storage::path("\\public" . $photo["path"]);
            $mediaIds[] = $this->postMedia($path);
        }

        return $mediaIds;
    }

    
    private function postMedia(String $path)
    {
        $options = [
            "chunkedUpload" => true
        ];

        $requestPayload = ['media' => $path, "media_category" => "tweet_image"];
        
        $media = $this->client->upload('media/upload', $requestPayload, $options);
        return  $media->media_id_string;
    }

}