<?php

namespace App\Http\Controllers\ExternalAPIEndpoints;

use Illuminate\Http\Request;
use App\Services\LinkedInAPIService;

use App\Http\Controllers\Controller;
class LinkedinApiController extends Controller
{
    public function oauth(LinkedInAPIService $linkedInAPIService)
    {
        return $linkedInAPIService->oauth();
    }

    public function callback(Request $request, LinkedInAPIService $linkedInAPIService)
    {
        
        $linkedInAPIService->callback($request);

        return redirect()->route('posts');
    }

    public function postPost(LinkedInAPIService $linkedInAPIService)
    {
        return $linkedInAPIService->shere();
    }
}
