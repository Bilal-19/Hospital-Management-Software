<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    public function LoginView()
    {
        return view("Registration.Login");
    }

    public function RegisterView(){
        return view("Registration.Register");
    }
}
