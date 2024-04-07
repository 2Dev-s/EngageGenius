<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DirkGroenen\Pinterest\Pinterest;

class PinterestController extends Controller
{
    //
    public function oauth(){

        $pinterest = new Pinterest(env(""), env(""));

    }

    public function callback(){

        
    }}
