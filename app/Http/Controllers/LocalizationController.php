<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocalizationController extends Controller
{
    public function changeLang($lang_name)
    {
        session()->put('locale', $lang_name);
        return redirect()->back();
    }
}
