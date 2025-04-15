<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view("Admin.Dashboard");
    }

    public function manageStaff(){
        $users = DB::table("users")->where("role","!=", "Admin")->get();
        return view("Admin.ManageStaff",with(compact("users")));
    }
}
