<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendOrderController extends Controller
{
    public function addCart()
    {
        return view('frontend.pages.add-to-cart');
    }
}
