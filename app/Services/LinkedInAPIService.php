<?php

namespace App\Services;



use LinkedInscr\Exception;
use Illuminate\Http\Request;

use LinkedInscr\AccessToken;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;

class LinkedInAPIService
{
    private $client;
    public function __construct()
    {
        $this->client = App::make('LinkedInAPIClient');
        $this->client->setRedirectUrl(route('linkedin-callback'));
    }

    public function oauth()
    {

        $scopes = [
            'w_member_social',
            'profile',
            'email',
            'openid'
        ];

        $loginUrl = $this->client->getLoginUrl($scopes);
        return redirect($loginUrl);
    }

    public function callback(Request $request)
    {
        $accsessCode = $request->input('code');

        if (!$accsessCode) {
            return redirect('/');
        }


        try {
            $accessToken = $this->client->getAccessToken($accsessCode);
        } catch (Exception $e) {
            dd($e);
        }



        $team = Auth::user()->currentTeam;
        $socialData = $team->socialData;

        $socialData->update([
            'linkedin' => json_encode($accessToken),
        ]);

        return;
    }

    public function shere()
    {
        $team = Auth::user()->currentTeam;
        $socialData = $team->socialData;
        $accessTokenData = json_decode($socialData->linkedin, true);
        $accessToken = new AccessToken($accessTokenData['token'], $accessTokenData['expiresAt']);

        $this->client->setAccessToken($accessToken);


        try {
            $profile = $this->client->get(
                'userinfo',
            );
        } catch (Exception $e) {
            dd($e);
        }

        try {
            $share = $this->client->post(
                'ugcPosts',
                [
                    'author' => 'urn:li:person:' . $profile['sub'],
                    'lifecycleState' => 'PUBLISHED',
                    'specificContent' => [
                        'com.linkedin.ugc.ShareContent' => [
                            'shareCommentary' => [
                                'text' => 'Checkout this amazing PHP SDK for LinkedIn!'
                            ],
                            'shareMediaCategory' => 'ARTICLE',
                            'media' => [
                                [
                                    'status' => 'READY',
                                    'description' => [
                                        'text' => 'OAuth 2 flow, composer Package.'
                                    ],
                                    'originalUrl' => 'https://github.com/zoonman/linkedin-api-php-client',
                                    'title' => [
                                        'text' => 'PHP Client for LinkedIn API'
                                    ]
                                ]
                            ]
                        ]
                    ],
                    'visibility' => [
                        'com.linkedin.ugc.MemberNetworkVisibility' => 'CONNECTIONS'
                    ]
                ]
            );
        } catch (Exception $e) {
            dd($e);
        }

        dd($share);
    }
}
