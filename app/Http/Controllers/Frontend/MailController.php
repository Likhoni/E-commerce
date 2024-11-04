<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Throwable;

class MailController extends Controller
{
    public function sendMail(){
        try{
            $toEmailAddrress = "mahmud@gmail.com";
            $welcomeMessage = "Hello There, Hope you are doing well, All the best.";
            $response = Mail::to($toEmailAddrress)->send(new SendMail($welcomeMessage));


        }catch(Throwable $e){

            notify()->error('something went wrong');

            return redirect()->route('frontend.homepage');
        }
    }
}
