<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        if (Auth::user()){
            return view("Doctor.Dashboard");
        } else {
            return view("welcome");
        }

    }
}
