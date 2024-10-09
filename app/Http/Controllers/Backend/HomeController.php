<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //backend
    public function home(){
        return view('backend.pages.dashboard');

    }

}
