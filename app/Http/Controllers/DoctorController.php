<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{
    public function index()
    {
        if (Auth::check() && Auth::user()->role === "Doctor") {
            return view("Doctor.Dashboard");
        } else {
            return view("Registration.Login");
        }
    }

    public function markDoctorAttendance()
    {
        $userID = Auth::user()->id;
        $fetchMyAttendance = DB::table("staff")->where("user_id", "=", $userID)->get();
        return view("Doctor.MarkAttendance", with(compact("fetchMyAttendance")));
    }

    public function myProfile()
    {
        if (Auth::user()) {
            $userID = Auth::user()->id;
            $fetchRecord = DB::table("doctors")->where("user_id", "=", $userID)->first();
            return view("Doctor.MyProfile", with(compact("fetchRecord")));
        }
    }

    public function readPatient()
    {
        $fetchRecords = DB::table("patients")->
            where("user_id", "=", Auth::user()->id)->
            paginate(10);
        $countRecords = DB::table("patients")->count();
        return view("Doctor.Patients", with(compact("fetchRecords", "countRecords")));
    }

    public function addPatient()
    {
        return view("Doctor.AddPatient");
    }

    public function createPatient(Request $request)
    {
        $newPatientCreated = DB::table("patients")->insert([
            "fullName" => $request->fullName,
            "age" => $request->age,
            "gender" => $request->gender,
            "emailAddress" => $request->emailAddress,
            "phoneNumber" => $request->phoneNumber,
            "reasonForVisit" => $request->reasonForVisit,
            "medicalHistory" => $request->medicalHistory,
            "user_id" => Auth::user()->id,
            "created_at" => now()
        ]);

        if ($newPatientCreated) {
            toastr()->success("New patient registered successfully");
            return redirect()->back();
        } else {
            toastr()->info("Please check error message. Something went wrong.");
            return redirect()->back();
        }
    }

    public function markTodayAttendance(Request $request)
    {
        $carbonDate = Carbon::now();
        $todaysDate = $carbonDate->toDateString();

        $countAttendance = DB::table("staff")->
            where("user_id", "=", Auth::user()->id)->
            orWhere("created_at", "=", "$todaysDate%")->
            count();

        if ($countAttendance >= 1) {
            toastr()->info("You've already checked in.");
        } else {
            $isMarkPresent = DB::table("staff")->insert([
                "user_id" => Auth::user()->id,
                "created_at" => now()
            ]);

            if ($isMarkPresent) {
                toastr()->success("Attendance mark successfully");
            } else {
                toastr()->error("something went wrong");
            }
        }
        return redirect()->back();

    }

    public function updateMyProfile(Request $request)
    {
        if ($request->file("profilePicture")) {
            $imagePath = time() . '.' . $request->profilePicture->getClientOriginalExtension();
            $request->profilePicture->move("Doctors/Profile", $imagePath);
        } else {
            $extractImagePath = DB::table("doctors")->
                select("profilePicture")->
                where("user_id", "=", Auth::user()->id)->
                first();
            $imagePath = $extractImagePath->profilePicture;
        }
        $isUpdated = DB::table("doctors")
            ->where('user_id', '=', Auth::user()->id)
            ->update([
                "fullName" => $request->fullName,
                "gender" => $request->gender,
                "dateOfBirth" => $request->dateOfBirth,
                "profilePicture" => $imagePath,
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
                "status" => $request->status,
                "updated_at" => now()
            ]);
        if ($isUpdated) {
            toastr()->success("Profile updated");
            return redirect()->back();
        } else {
            toastr()->error("Something went wrong");
            return redirect()->back();
        }
    }

    public function viewAllAppoinments()
    {
        $fetchAppoinments = DB::table("appoinments")->
            where("doctorName", "=", Auth::user()->name)->
            paginate(10);
        return view("Doctor.ViewAllAppoinments", with(compact("fetchAppoinments")));
    }
}
