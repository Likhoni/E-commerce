<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendHomeController extends Controller
{ 
    public function frontendHome(){

         $categories = Category::all();
         $products = Product::all();
        //dd($categories);
        return view('frontend.pages.homePage', compact('categories','products'));

    }

}
