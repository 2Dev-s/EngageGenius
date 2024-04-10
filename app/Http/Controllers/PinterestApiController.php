<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DirkGroenen\Pinterest\Pinterest;

class PinterestApiController extends Controller
{
    public $connection;
    public $scopes = [
        'read_public'
    ];

    public function __construct()
    {
        $this->connection = new Pinterest('PINTEREST_CLIENT_ID', 'PINTEREST_CLIENT_SECRET');
    }

    public function oauth()
    {
        return redirect($this->connection->auth->getLoginUrl(route('pinterest-callback'), $this->scopes));
    }

    public function callback(Request $req)
    {
        if(!$req->code) return 'callback url error';

        $token = $this->connection->auth->getOAuthToken($req->code);
        $this->connection->auth->setOAuthToken($token->access_token);
    }

    public function CreatePost(){
        $this->connection->pins->create(array(
            "note"          => "Test board from API",
            "image_url"     => "https://download.unsplash.com/photo-1438216983993-cdcd7dea84ce",
            "board"         => "dasdfs"
        ));
    }
}
