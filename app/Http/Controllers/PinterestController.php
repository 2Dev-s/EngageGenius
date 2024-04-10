<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DirkGroenen\Pinterest\Pinterest;

class PinterestController extends Controller
{
    //
    public function oauth(){

        $pinterest = new Pinterest(env("PINTEREST_CLIENT_ID"), env("PINTEREST_CLIENT_SECRET"));
        $loginurl = $pinterest->auth->getLoginUrl(route('pinterest-callback'), array('read_public'));
        dd($loginurl); 
        return redirect($loginurl);
    }

    public function callback(){

        
    }}
