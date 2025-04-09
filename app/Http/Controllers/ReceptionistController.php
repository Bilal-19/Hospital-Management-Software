<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ReceptionistController extends Controller
{
    public function index()
    {
        return view("Receptionist.Dashboard");
    }

    public function markAttendance()
    {
        return view("Receptionist.MarkAttendance");
    }

    public function manageAppointments()
    {
        $fetchDoctorName = DB::table("doctors")->
            pluck('fullName');
        return view("Receptionist.ManageAppoinments", with(compact("fetchDoctorName")));
    }

    public function createAppoinment(Request $request)
    {
        $isAppoinmentCreated = DB::table("appoinments")->insert([
            "department" => $request->department,
            "doctorName" => $request->doctor,
            "appoinmentDate" => $request->appoinmentDate,
            "appoinmentTime" => $request->appoinmentTime,
            "user_id" => Auth::user()->id,
            "created_at" => now()
        ]);

        if ($isAppoinmentCreated){
            toastr()->success("Appoinment booked successfully");
            return redirect()->back();
        } else {
            toastr()->info("Something went wrong. Please check error message");
            return redirect()->back();
        }
    }
}
