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
        $fetchMyAttendance = DB::table("staff")->where("user_id","=",Auth::user()->id)->get();
        return view("Receptionist.MarkAttendance", with(compact("fetchMyAttendance")));
    }

    public function manageAppointments()
    {
        $fetchDoctorName = DB::table("doctors")->
            pluck('fullName');
        $fetchAppoinments = DB::table("appoinments")->limit(3)->get();
        return view("Receptionist.ManageAppoinments", with(compact("fetchDoctorName", "fetchAppoinments")));
    }

    public function createAppoinment(Request $request)
    {
        $isAppoinmentCreated = DB::table("appoinments")->insert([
            "department" => $request->department,
            "doctorName" => $request->doctor,
            "appoinmentDate" => $request->appoinmentDate,
            "appoinmentTime" => $request->appoinmentTime,
            "patientName" => $request->patientName,
            "reasonForVisit" => $request->reasonForVisit,
            "user_id" => Auth::user()->id,
            "created_at" => now()
        ]);

        if ($isAppoinmentCreated) {
            toastr()->success("Appoinment booked successfully");
            return redirect()->back();
        } else {
            toastr()->info("Something went wrong. Please check error message");
            return redirect()->back();
        }
    }

    public function receptionistProfile()
    {
        // 'first() - used to fetch single record'
        $UserID = Auth::user()->id;
        $fetchRecord = DB::table("receptionist")->where('user_id', '=', $UserID)->first();
        return view("Receptionist.MyProfile", with(compact("fetchRecord")));
    }

    public function updateReceptionistProfile(Request $request)
    {
        $UserID = Auth::user()->id;
        $isUpdated = DB::table("receptionist")->
            where("id", "=", $UserID)->
            update([
                "fullName" => $request->fullName,
                "gender" => $request->gender,
                "emailAddress" => $request->emailAddress,
                "phoneNumber" => $request->phoneNumber,
                "assignedDepartment" => $request->assignedDepartment,
                "shiftTiming" => $request->shiftTiming,
                "joiningDate" => $request->joiningDate,
                "updated_at" => now()
            ]);
        if ($isUpdated) {
            toastr()->success("Profile updated.");
            return redirect()->back();
        }
        else {
            dd($isUpdated);
            toastr()->error("Something went wrong. Try again later.");
            return redirect()->back();
        }
    }
}
