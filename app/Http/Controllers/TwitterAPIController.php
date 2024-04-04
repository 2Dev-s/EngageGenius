<?php

namespace App\Http\Controllers;

use App\Models\Post;

use Illuminate\Http\Request;

use Atymic\Twitter\Facade\Twitter;

use Illuminate\Support\Facades\Auth;
use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterAPIController extends Controller
{

    public function oauth(Request $request)
    {

        session('oauth_token', '');
        session('oauth_token_secret', '');

        $connection = new TwitterOAuth(env("TWITTER_CONSUMER_KEY"), env("TWITTER_CONSUMER_KEY_SECRET"));
        $request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => route('twitter-callback')));

        session(['oauth_token' => $request_token['oauth_token']]);
        session(['oauth_token_secret' => $request_token['oauth_token_secret']]);

        return redirect($connection->url('oauth/authorize', ['oauth_token' => $request_token['oauth_token']]));
    }
    public  function callback(Request $request)
    {
        $request_token['oauth_token'] = session('oauth_token');
        $request_token['oauth_token_secret'] = session('oauth_token_secret');

        $connection = new TwitterOAuth(env("TWITTER_CONSUMER_KEY"), env("TWITTER_CONSUMER_KEY_SECRET"), $request_token['oauth_token'], $request_token['oauth_token_secret']); // app as user
        $access_token = $connection->oauth("oauth/access_token", ["oauth_verifier" => $request->all()['oauth_verifier']]);

        $team = Auth::user()->currentTeam;
        $socialData = $team->socialData;


        $res = $socialData->update([
            'twitter_access_token' => $access_token['oauth_token'],
            'twitter_access_token_secret' => $access_token['oauth_token_secret'],
        ]);


        return redirect()->route('posts');
    }

    public function post(Post $post, Request $request)
    {
        $team = Auth::user()->currentTeam;
        $socialData = $team->socialData;

        $connection = new TwitterOAuth(env("TWITTER_CONSUMER_KEY"), env("TWITTER_CONSUMER_KEY_SECRET"), $socialData["twitter_access_token"], $socialData->twitter_access_token_secret);

        $media = $this->postMedia($connection);
        $connection->setApiVersion(2);

        $data = [
                "text" => "test",
                "media" => [
                    "media_ids" => [$media]
                ]
        ];

        // https://developer.twitter.com/en/docs/twitter-api/tweets/manage-tweets/api-reference/post-tweets#tab0

        $statuses = $connection->post("tweets", $data);
        dd($statuses);
        /* return redirect()->route('dashboard'); */
    }

    public function postMedia(TwitterOAuth $connection)
    {
        $connection->setApiVersion(1.1);
        $options = [
            "chunkedUpload" => true
        ];
        $requestPayload = ['media' => "F:\Work\Projects\PHP\EngageGenius\\testImage.jpeg", "media_category" => "tweet_image"];

        // https://developer.twitter.com/en/docs/twitter-api/v1/media/upload-media/api-reference/post-media-upload

        $media = $connection->upload('media/upload', $requestPayload, $options);

        return  $media->media_id_string;
    }
}
