<?php

namespace App\Services;

use App\Models\Post;
use LinkedInscr\Exception;
use Illuminate\Http\Request;

use LinkedInscr\AccessToken;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\TryCatch;

class LinkedInAPIService
{
    private $client;
    private $accessToken = null;
    private const USERIDPREFIX = 'urn:li:person:';
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

    public function getAuthorURNId()
    {

        try {
            $profile = $this->client->get(
                'userinfo',
            );
        } catch (Exception $e) {
            dd($e);
        }

        return self::USERIDPREFIX . $profile['sub'];
    }

    public function handleMedia()
    {
        /* $photos = $post->photos; */
        $photos = [
            'F:\Work\Projects\PHP\EngageGenius\public\storage\user-1\team-2\postsFiles\post-51\photo-1714416312-6593.jpg',
            'F:\Work\Projects\PHP\EngageGenius\public\storage\user-1\team-2\postsFiles\post-51\photo-1714416313-4496.jpg',
            'F:\Work\Projects\PHP\EngageGenius\public\storage\user-1\team-2\postsFiles\post-51\photo-1714416313-5627.jpg',
            'F:\Work\Projects\PHP\EngageGenius\public\storage\user-1\team-2\postsFiles\post-51\photo-1714416313-5741.jpg'
        ];

        $media = [];
        foreach ($photos as $photo) {
            $urn = $this->uploadImage($photo);
            if (!$urn) continue;

            $media[] = [
                'media' => $urn,
                'status' => "PROCESSING",
            ];
        }

        return $media;
    }

    private function uploadImage($path)
    {
        try {
            $uploadReqestResp = $this->client->post("images?action=initializeUpload", [
                "initializeUploadRequest" => [
                    "owner" => $this->getAuthorURNId(),
                ],
            ]);
        } catch (Exception $th) {
            dd($th);
        }

        $file = file_get_contents($path);

        $uploadResp = Http::withBody($file, 'image')
            ->withToken($this->accessToken['token'])
            ->put($uploadReqestResp["value"]['uploadUrl']);

        if ($uploadResp->status() != 201) return null;

        return $uploadReqestResp["value"]["image"];
    }
    public function shere()
    {
        $team = Auth::user()->currentTeam;
        $socialData = $team->socialData;
        $accessTokenData = json_decode($socialData->linkedin, true);
        $accessToken = new AccessToken($accessTokenData['token'], $accessTokenData['expiresAt']);

        $this->accessToken = $accessTokenData;
        $this->client->setAccessToken($accessToken);

        $post = Post::find(51)->first();

        $payLoad = [
            'author' => $this->getAuthorURNId(),
            "lifecycleState" => "PUBLISHED",
            "specificContent" => [
                "com.linkedin.ugc.ShareContent" => [
                    "shareCommentary" => ["text" => $post->description],
                    'media' => $this->handleMedia(),
                    "shareMediaCategory" => "ARTICLE"
                ],
            ],
            "visibility" => [
                "com.linkedin.ugc.MemberNetworkVisibility" => "PUBLIC",
            ]
        ];

        dump($payLoad);

        try {
            $share = $this->client->post('ugcPosts', $payLoad);
        } catch (Exception $e) {
            dd($e);
        }

        dd($share);

        /*         try {
            $share = $this->client->post(
                'ugcPosts',
                [
                    'author' => 'urn:li:person:' . $this->getAuthorURNId(),
                    "lifecycleState"=> "PUBLISHED",
                    "specificContent" => [
                        "shareCommentary" => [
                            "text" => $post->description
                        ],
                        'media' => [
                            [],
                            [],
                            []
                        ],
                        "shareMediaCategory" => "ARTICLE"
                    ],
                    "visibility"=> [
                        "com.linkedin.ugc.MemberNetworkVisibility"=> "PUBLIC",
                    ]
                ]
            );
        } catch (Exception $e) {
            dd($e);
        } */
    }
}
