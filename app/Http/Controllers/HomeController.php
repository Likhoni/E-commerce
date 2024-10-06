<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //backend
    public function home(){
        return view('backend.pages.dashboard');

    }

}
