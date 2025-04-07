<?php

namespace App\Http\Controllers;

use App\Mail\ForgetPasswordEmail;
use Illuminate\Http\Request;
use Mail;

class EmailController extends Controller
{
    public function sendEmail()
    {
        $email_message = "Here's your password";
        $subject = "Hello User";
        $request = Mail::to("bilalmuhammadyousuf543@gmail.com")->
            send(new ForgetPasswordEmail($email_message, $subject));
        dd($request);
    }
}
