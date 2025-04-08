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

    public function myProfile()
    {
        if (Auth::user()) {
            $userID = Auth::user()->id;
            $fetchRecord = DB::table("doctors")->find($userID);
            return view("Doctor.MyProfile", with(compact("fetchRecord")));
        }
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

        if ($isMarkPresent) {
            toastr()->success("Your attendance mark successfully");
            return redirect()->back();
        } else {
            toastr()->error("something went wrong");
            return redirect()->back();
        }
    }

    public function updateMyProfile(Request $request)
    {
        $isUpdated = DB::table("doctors")
        ->where('user_id', '=', Auth::user()->id)
        ->update([
                "fullName" => $request->fullName,
                "gender" => $request->gender,
                "dateOfBirth" => $request->dateOfBirth,
                "emailAddress" => $request->emailAddress,
                "phoneNumber" => $request->phoneNumber,
                "department" => $request->department,
                "yearsOfExperience" => $request->yearsOfExperience,
                "licenseNumber" => $request->licenseNumber,
                "consultationFee" => $request->consultationFee,
                "availableOnMon" => $request->Monday,
                "availableOnTue" => $request->Tuesday,
                "availableOnWed" => $request->Wednesday,
                "availableOnThurs" => $request->Thursday,
                "availableOnFri" => $request->Friday,
                "availableOnSat" => $request->Saturday,
                "created_at" => now()
            ]);
        if ($isUpdated){
            toastr()->success("Profile updated");
            return redirect()->back();
        } else {
            toastr()->error("Something went wrong");
            return redirect()->back();
        }
    }
}
