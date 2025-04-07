<?php

namespace App\Http\Controllers;

use App\Mail\ForgetPasswordEmail;
use Illuminate\Http\Request;
use Mail;

class EmailController extends Controller
{
    public function sendEmail($password,$subject,$message, $userEmail)
    {
        $request = Mail::to($userEmail)->
            send(new ForgetPasswordEmail($password, $message, $subject, $userEmail));
        if ($request){
            return true;
        } else {
            return false;
        }
    }
}
