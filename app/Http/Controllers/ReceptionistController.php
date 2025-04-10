<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ReceptionistController extends Controller
{
    public function index()
    {
        if (Auth::check() && Auth::user()->role === "Receptionist") {
            return view("Receptionist.Dashboard");
        } else {
            return view("Registration.Login");
        }
    }

    public function markAttendance()
    {
        $fetchMyAttendance = DB::table("staff")->where("user_id", "=", Auth::user()->id)->get();
        return view("Receptionist.MarkAttendance", with(compact("fetchMyAttendance")));
    }

    public function manageAppointments()
    {
        $fetchDoctorName = DB::table("doctors")->
            pluck('fullName');
        $fetchAppoinments = DB::table("appoinments")->limit(3)->get();
        return view("Receptionist.ManageAppoinments", with(compact("fetchDoctorName", "fetchAppoinments")));
    }

    public function allAppoinments(){
        $fetchAppoinments = DB::table("appoinments")->paginate(15);
        return view("Receptionist.AllAppoinments", with(compact( "fetchAppoinments")));
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
            where("user_id", "=", $UserID)->
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
        } else {
            toastr()->error("Something went wrong. Try again later.");
            return redirect()->back();
        }
    }

    public function generateBills()
    {
        $fetchDoctors = DB::table("doctors")->pluck('fullName');
        $fetchBillHistory = DB::table("receipt")->where("user_id", "=", Auth::user()->id)->limit(3)->get();
        return view("Receptionist.GenerateBills", with(compact("fetchBillHistory", "fetchDoctors")));
    }

    public function createBill(Request $request)
    {
        $isInvoiceGenerated = DB::table("receipt")->insert(
            [
                "patientName" => $request->patientName,
                "doctorName" => $request->doctorName,
                "serviceName" => $request->serviceName,
                "serviceAmount" => $request->serviceAmount,
                "testName" => $request->testName,
                "testCost" => $request->testCost,
                "medicineName" => $request->medicineName,
                "medicinePrice" => $request->medicinePrice,
                "totalAmount" => $request->serviceAmount + $request->testCost + $request->medicinePrice,
                "paymentMode" => $request->paymentMode,
                "status" => "Paid",
                "user_id" => Auth::user()->id,
                "created_at" => now()
            ]
        );

        if ($isInvoiceGenerated) {
            toastr()->success("Invoice generated successfully.");
            return redirect()->back();
        } else {
            toastr()->error("Something went wrong. Try again later.");
            return redirect()->back();
        }
    }

    public function getInvoices()
    {
        $fetchBillHistory = DB::table("receipt")->
            where("user_id", "=", Auth::user()->id)->
            get();
        return view("Receptionist.Invoices", with(compact("fetchBillHistory")));
    }

    public function allDoctors(Request $request)
    {
        if ($request->search) {
            $fetchRecords = DB::table("doctors")->
                where("fullName", "=", $request->search)
                ->orWhere("department", "=", $request->search)
                ->get();
        } else {
            $fetchRecords = DB::table("doctors")->get();
        }
        return view("Receptionist.AllDoctors", with(compact("fetchRecords")));
    }
}
