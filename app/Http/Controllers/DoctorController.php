<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        if (Auth::check() && Auth::user()->role === "Doctor") {
            $userID = Auth::user()->id;
            $fetchMyAttendance = DB::table("staff")->where("user_id", "=", $userID)->get();
            return view("Doctor.MarkAttendance", with(compact("fetchMyAttendance")));
        } else {
            return view("Registration.Login");
        }

    }

    public function myProfile()
    {
        if (Auth::user()) {
            $userID = Auth::user()->id;
            $fetchRecord = DB::table("doctors")->where("user_id", "=", $userID)->first();
            $myShift = DB::table("shift")->where("staffName", "=", Auth::user()->name)->first();
            return view("Doctor.MyProfile", with(compact("fetchRecord", "myShift")));
        }
    }

    public function readPatient(Request $request)
    {
        if ($request->search) {
            $fetchRecords = DB::table("patients")->
                where("fullName", "=", $request->search)->
                orWhere("reasonForVisit", "=", $request->search)->
                paginate(10);
        } else {
            $fetchRecords = DB::table("patients")->
                paginate(10);
        }
        return view("Doctor.Patients", with(compact("fetchRecords")));
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

        $newUserRec = DB::table("users")->insert([
            "name" => $request->fullName,
            "email" => $request->emailAddress,
            "password" => Hash::make("12345678"),
            "role" => "Patient",
            "created_at" => now()
        ]);

        if ($newPatientCreated && $newUserRec) {
            toastr()->success("Patient registered successfully.");
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
            whereDate("created_at", "=", today())->
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

    public function viewAllAppointments(Request $request)
    {
        $search = $request->search;
        // print_r($search);

        if ($search) {
            $fetchAppoinments = DB::table("appointments")->
                where("doctorName", "=", Auth::user()->name)->
                where("appointmentDate", ">=", today())->
                orWhere("patientName", "=", $search)->
                orWhere("reasonForVisit", "=", $search)->
                orWhere("department", "=", $search)->
                orderBy("appointmentDate")->
                paginate(15);
        } else {
            $fetchAppoinments = DB::table("appointments")->
                where("doctorName", "=", Auth::user()->name)->
                where("appointmentDate", ">=", today())->
                orderBy("appointmentDate")->
                paginate(15);
        }
        return view("Doctor.ViewAllAppoinments", with(compact("fetchAppoinments")));
    }

    public function addDiagnosNote($id)
    {
        $findAppointmentRec = DB::table("appointments")->find($id);
        return view("Doctor.UpdateDiagnosis", with(compact("findAppointmentRec")));
    }

    public function updatePatientRecord($id, Request $request)
    {
        $findAppointmentRec = DB::table("appointments")->find($id);

        $isRecUpdated = DB::table("appointments")->where("id", "=", $id)->update([
            "diagnosis" => $request->diagnosis,
            "medicine" => $request->medicine,
            "symptoms" => $request->symptoms,
            "updated_at" => now()
        ]);

        if ($isRecUpdated) {
            toastr()->success("Updated: Diagnosis & Prescription");
        } else {
            toastr()->error("Something went wrong");
        }
        return redirect()->back();
    }

    public function patientVisitHistory($id)
    {

        $findPatient = DB::table("patients")->find($id);
        $findAppointmentHistory = DB::table("appointments")->
            where("patientName", "=", $findPatient->fullName)->
            get();
        return view("Doctor.PatientHistory", with(compact("findAppointmentHistory")));
    }

    public function referToSpecialist($patientID)
    {
        $findPatient = DB::table("patients")->find($patientID);
        $doctorsList = DB::table("doctors")->pluck("fullName");
        return view("Doctor.Refer", with(compact("findPatient", "doctorsList")));
    }

    public function createReferral(Request $request)
    {
        $isRefferalCreated = DB::table("referral")->insert([
            "doctorName" => $request->doctorName,
            "patientName" => $request->patientName,
            "reasons" => $request->reasons,
            "notes" => $request->notes,
            "doctorID" => Auth::user()->id,
            "created_at" => now()
        ]);

        if ($isRefferalCreated) {
            toastr()->success("Successfully referred this patient to selected doctor");
        } else {
            toastr()->error("Sometmessage: hing went wrong. Try again later.");
        }
        return redirect()->back();
    }

    public function fetchMySalReceipts()
    {
        $userID = Auth::user()->id;
        $fetchSalaries = DB::table("salary")->where("employeeId", "=", $userID)->get();
        return view("Doctor.ViewSalaryReceipt", with(compact("fetchSalaries")));
    }
}
