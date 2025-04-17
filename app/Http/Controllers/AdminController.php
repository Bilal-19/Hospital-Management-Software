<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
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

    public function getHospitalStaff()
    {
        $fetchStaffList = DB::table("users")->
            where("role", "!=", "Admin")->
            where("role", "!=", "Patient")
            ->pluck('name');
        return $fetchStaffList;
    }
    public function shiftManagement()
    {
        $fetchStaffList = $this->getHospitalStaff();
        $fetchAllStaffShift = DB::table("shift")->limit(4)->get();
        return view("Admin.ShiftManagement", with(compact("fetchStaffList", "fetchAllStaffShift")));
    }

    public function createShift(Request $request)
    {
        $isShiftCreated = DB::table("shift")->insert([
            "staffName" => $request->staffName,
            "startDate" => $request->startDate,
            "endDate" => $request->endDate,
            "applicableDays" => $request->applicableDays,
            "assignedBy" => Auth::user()->name,
            "created_at" => now()
        ]);

        if ($isShiftCreated) {
            toastr()->success("Shift assigned to selected employee.");
        } else {
            toastr()->info("Something went wrong. Please try again later.");
        }
        return redirect()->back();
    }

    public function employeePaySlip()
    {
        $fetchSalaryRecords = DB::table("users")->
            join("salary", "users.id", "=", "salary.employeeId")->
            get();
        return view("Admin.StaffPaySlip", with(compact("fetchSalaryRecords")));
    }

    public function generatePaySlip($id)
    {
        $findEmp = DB::table("users")->where("id", "=", $id)->first();
        $empRole = $findEmp->role;

        // Allowance
        $houseRentAllowance = 10000;
        $travelAllowance = 5000;
        $medicalAllowance = 3000;

        if ($empRole == "Doctor") {
            $basicSalary = 80000;
        } elseif ($empRole == "Receptionist") {
            $basicSalary = 45000;
        } else {
            $basicSalary = 30000;
        }

        $grossEarning = $houseRentAllowance + $travelAllowance + $medicalAllowance + $basicSalary;


        // Check salary count of employee for the current month
        $month = date("M-Y", strtotime(now()));
        $countSal = DB::table("salary")->
            where("employeeID", "=", $id)->
            where("salaryMonth", "=", $month)->
            count();

        if ($countSal >= 1) {
            toastr()->info("Salary of selected employee already generated.");
        } else {
            DB::table("salary")->insert([
                "employeeId" => $id,
                "salaryMonth" => $month,
                "basicSalary" => $basicSalary,
                "houseRentAllowance" => $houseRentAllowance,
                "travelAllowance" => $travelAllowance,
                "medicalAllowance" => $medicalAllowance,
                "grossEarning" => $grossEarning,
                "created_at" => now()
            ]);
            toastr()->success("Salary Slip Generated.");
        }
        return redirect()->back();
    }

    public function downloadSlip($id)
    {
        $findSalRecord = DB::table("salary")->find($id);
        $findStaffRecord = DB::table("users")->
            where("id", "=", $findSalRecord->employeeId)->
            first();
        return Pdf::loadView("PDF.SalarySlip", with(compact("findSalRecord", "findStaffRecord")))->download("SalarySlip.pdf");
    }

    public function departmentManagement()
    {
        $fetchDepartments = DB::table("departments")->
            pluck('departmentName');
        $fetchStaff = $this->getHospitalStaff();
        return view("Admin.DepartmentManagement", with(compact("fetchDepartments", "fetchStaff")));
    }

    public function createDepartment(Request $request)
    {
        $isRecordCreated = DB::table("departments")->insert([
            "departmentName" => $request->departmentName,
            "created_at" => now()
        ]);

        if ($isRecordCreated) {
            toastr()->success("Department added successfully.");
        } else {
            toastr()->info("Something went wrong.");
        }
        return redirect()->back();
    }

    public function assignDepartmentToStaff(Request $request)
    {
        $staffName = $request->staffName;
        $findStaff = DB::table("users")->
            where("name", "=", $staffName)->
            first();
        $staffRole = $findStaff->role;

        if ($staffRole == "Doctor") {
            DB::table("doctors")->
                where("fullName", "=", $staffName)
                ->update([
                    "department" => $request->departmentName,
                    "updated_at" => now()
                ]);
            toastr()->success("Assigned department to the staff.");
        } elseif ($staffRole == "Receptionist") {
            DB::table("receptionist")->
                where("fullName", "=", $staffName)
                ->update([
                    "assignedDepartment" => $request->departmentName,
                    "updated_at" => now()
                ]);
            toastr()->success("Assigned department to the staff.");
        } else {
            toastr()->info("Something went wrong. Please try again later.");
        }
        return redirect()->back();
    }
}
