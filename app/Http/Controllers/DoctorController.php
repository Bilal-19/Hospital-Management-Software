<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{
    public function index()
    {
        if (Auth::user()) {
            return view("Doctor.Dashboard");
        } else {
            return view("welcome");
        }
    }

    public function markAttendance()
    {
        return view("Doctor.MarkAttendance");
    }

    public function markTodayAttendance(Request $request)
    {
        $isMarkPresent = DB::table("staff")->insert([
            "staff_name" => $request->doctorName,
            "date" => $request->currentDate,
            "time" => $request->loggedIn,
            "notes" => $request->remarks,
            "staff_id" => $request->doctorID,
            "created_at" => now()
        ]);

        if ($isMarkPresent){
            toastr()->success("Your attendance mark successfully");
            return redirect()->back();
        } else {
            toastr()->error("something went wrong");
            return redirect()->back();
        }
    }
}
