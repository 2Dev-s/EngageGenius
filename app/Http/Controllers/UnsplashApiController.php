<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Unsplash\HttpClient;
use Unsplash\Search;

class UnsplashApiController extends Controller
{
    private $connection;
    private $scopes = [
        'public',
        'read' /*
        'read_user',
        'write_user',
        'read_photos',
        'write_photos',
        'write_likes',
        'read_collections',
        'write_collections' */
    ];

    public function search(Request $request)
    {
        $qurey = $request->query('qurey');
        if (!$qurey) return response()->json(['error' => 'No query provided'], 400);
        
        HttpClient::init([
            'applicationId'    => '0NsI0DLBaYUT4A5T8q87Ps-NEPU-Pi36h0KabcQZCZM',
            'secret'           => 'O6jwSrUQF4H4pn0I8JHxzttKmo7o9-hNUoknuqajRTQ',
            'callbackUrl'      => route('unsplash.callback'),
            'utmSource'        => 'asd',
        ]);

        $page = 3;
        $per_page = 15;
        $orientation = 'landscape';

        $photos = Search::photos($qurey, $page, $per_page, $orientation)->getResults();

        return response()->json($photos);
    }
}
