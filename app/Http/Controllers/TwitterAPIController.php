<?php

namespace App\Http\Controllers;

use App\Models\Post;

use Illuminate\Http\Request;

use Atymic\Twitter\Facade\Twitter;

use Illuminate\Support\Facades\Auth;
use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterAPIController extends Controller
{
    //
    public function getOauth(Request $request) {

        session('oauth_token', '');
        session('koauth_token_secretey', '');

        $connection = new TwitterOAuth("kwA8XtEyiPGOdkvN3gJtNgToA", "YXEnfShva7emo93e98VlqUnkvUqaoCfJ0ennqYLEkAYcOSCTPU");
        $request_token = $connection->oauth('oauth/request_token', ['oauth_callback' => route('twitter-callback')]);

        session(['oauth_token' => $request_token['oauth_token']]);
        session(['oauth_token_secret' => $request_token['oauth_token_secret']]);

        return redirect($connection->url('oauth/authorize', ['oauth_token' => $request_token['oauth_token']]));
    }
/*     public  function callback(Request $request){
        $request_token['oauth_token'] = session('oauth_token');
        $request_token['oauth_token_secret'] = session('oauth_token_secret');

        $connection = new TwitterOAuth("kwA8XtEyiPGOdkvN3gJtNgToA","YXEnfShva7emo93e98VlqUnkvUqaoCfJ0ennqYLEkAYcOSCTPU", $request_token['oauth_token'], $request_token['oauth_token_secret']); // app as user
        $access_token = $connection->oauth("oauth/access_token", ["oauth_verifier" => $request->all()['oauth_verifier']]);

        Auth::user()->currentTeam->socialData()->update([
            'twitter_access_token' => $access_token['oauth_token'],
            'twitter_access_token_secret' => $access_token['oauth_token_secret'],
        ]);

        return redirect()->route('posts');
    } */
    public function oauth(Request $request) {
        $token = Twitter::getRequestToken(route('twitter.callback'));

/*         if (isset($token['oauth_token_secret'])) {
            $url = Twitter::getAuthenticateUrl($token['oauth_token']);
    
            Session::put('oauth_state', 'start');
            Session::put('oauth_request_token', $token['oauth_token']);
            Session::put('oauth_request_token_secret', $token['oauth_token_secret']);
    
            return Redirect::to($url);
        }
    
        return Redirect::route('twitter.error'); */
    }

    public  function callback(Request $request){
        return;
    }

    public function post(Post $post, Request $request) {
        $team = Auth::user()->currentTeam;
        $socialData = $team ->socialData;

        $status = Twitter::usingCredentials(
            "kwA8XtEyiPGOdkvN3gJtNgToA",
            "YXEnfShva7emo93e98VlqUnkvUqaoCfJ0ennqYLEkAYcOSCTPU",
            $socialData->twitter_access_token, 
            $socialData->twitter_access_token_secret)->forApiV1()->postTweet(['status' => 'Laravel is beautiful', 'response_format' => 'json']);

        dd($status);    
        /* return redirect()->route('dashboard'); */
    }

    
}
