<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Facebook\Facebook;

class FacebookApiController extends Controller
{
    public $connection;

    public function __construct()
    {
        $this->connection = new Facebook([
            'app_id' => '{app-id}',
            'app_secret' => '{app-secret}',
            'default_graph_version' => 'v2.10',
            //'default_access_token' => '{access-token}', // optional
        ]);
    }

    public function getOauth(Request $req)
    {
        return redirect($this->connection->getRedirectLoginHelper());
    }

    public function callback(Request $req)
    {
        return $this->connection->get('/me');
    }
}
