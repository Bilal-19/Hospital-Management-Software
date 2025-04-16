<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view("Admin.Dashboard");
    }

    public function manageStaff()
    {
        $users = DB::table("users")->
            where("role", "!=", "Admin")->
            get();
        return view("Admin.ManageStaff", with(compact("users")));
    }

    public function shiftManagement()
    {
        $fetchStaffList = DB::table("users")->
            where("role", "!=", "Admin")->
            where("role", "!=", "Patient")
            ->pluck('name');
        $fetchAllStaffShift = DB::table("shift")->get();
        return view("Admin.ShiftManagement", with(compact("fetchStaffList","fetchAllStaffShift")));
    }

    public function createShift(Request $request){
        $isShiftCreated = DB::table("shift")->insert([
            "staffName" => $request->staffName,
            "startDate" => $request->startDate,
            "endDate" => $request->endDate,
            "applicableDays" => $request->applicableDays,
            "assignedBy" => Auth::user()->name,
            "created_at" => now()
        ]);

        if ($isShiftCreated){
            toastr()->success("Shift assigned to selected employee.");
        } else {
            toastr()->info("Something went wrong. Please try again later.");
        }
        return redirect()->back();
    }
}
