<?php

namespace App\Http\Controllers\ExternalAPIEndpoints;

use Illuminate\Http\Request;
use LinkedIn\Client;
use LinkedIn\Scope;
use LinkedIn\AccessToken;
use App\Http\Controllers\Controller;
class LinkedinApiController extends Controller
{
    private $connection;
    private $scopes = [
       "w_member_social",
    ];

    public function __construct()
    {
        $this->connection = new Client(
            '77irngxzr7ujjl',
            'b4ZKLnNWBOp7PYuu'
        );

        $this->connection->setRedirectUrl(route('linkedin-callback'));
    }

    public function oauth()
    {
        $loginUrl = $this->connection->getLoginUrl($this->scopes);

        return redirect($loginUrl);
    }

    public function callback(Request $request)
    {
        if (!$request->code) return;

        // error: Refresh token is not available
        
        $accessToken = $this->connection->getAccessToken($request->code);

        return $accessToken;
    }
}
