<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendHomeController extends Controller
{ 
//     public function frontendHome(Request $request)
// {
//     $categories = Category::all();
    
//     // Check if a category is selected
//     if ($request->has('category_id') && $request->category_id != 'all') {
//         $products = Product::where('category_id', $request->category_id)->get();
//     } else {
//         // If no category is selected or 'all' is selected, show all products
//         $products = Product::all();
//     }

//     return view('frontend.pages.homePage', compact('categories', 'products'));
//}

public function frontendHome() {

    $categories = Category::all();
    
    $products = Product::with('category')->get();

    return view('frontend.pages.homePage', compact('categories', 'products'));
}

}
