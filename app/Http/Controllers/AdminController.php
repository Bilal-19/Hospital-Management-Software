<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\AssignOp\Concat;
use function Laravel\Prompts\select;

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

    public function getHospitalStaffNames()
    {
        $fetchStaffList = DB::table("users")->
            where("role", "!=", "Admin")->
            where("role", "!=", "Patient")
            ->pluck('name');
        return $fetchStaffList;
    }
    public function shiftManagement()
    {
        $fetchStaffList = $this->getHospitalStaffNames();
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

    public function DoctorAndUserInnerJoin()
    {
        $fetchDoctors = DB::table("users")->
            join("doctors", "doctors.user_id", "=", "users.id")->
            select('name', 'department', 'role')->get();
        return $fetchDoctors;
    }

    public function ReceptionistAndUserInnerJoin()
    {
        $fetchReceptionist = DB::table("users")->
            join("receptionist", "receptionist.user_id", "=", "users.id")->
            select('name', 'department', 'role')->
            get();
        return $fetchReceptionist;
    }

    public function getDepartmentNames()
    {
        $fetchDepartments = DB::table("departments")->
            pluck('departmentName');
        return $fetchDepartments;
    }

    public function departmentManagement()
    {
        $fetchDepartments = $this->getDepartmentNames();
        $fetchStaff = $this->DoctorAndUserInnerJoin()->concat($this->ReceptionistAndUserInnerJoin());
        // return $fetchStaff;
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

    public function updateStaffDepartment($tableName, $staffName, $department)
    {
        return DB::table($tableName)->
            where("fullName", "=", $staffName)
            ->update([
                "department" => $department,
                "updated_at" => now()
            ]);
    }
    public function assignDepartmentToStaff(Request $request)
    {
        $staffName = $request->staffName;
        $findStaff = DB::table("users")->
            where("name", "=", $staffName)->
            first();
        $staffRole = $findStaff->role;

        if ($staffRole == "Doctor") {
            $this->updateStaffDepartment("doctors", $staffName, $request->departmentName);
            toastr()->success("Assigned department to the staff.");
        } elseif ($staffRole == "Receptionist") {
            $this->updateStaffDepartment("receptionist", $staffName, $request->departmentName);
            toastr()->success("Assigned department to the staff.");
        } else {
            toastr()->info("Something went wrong. Please try again later.");
        }
        return redirect()->back();
    }

    public function getStaffDepartment()
    {
        $fetchDoctors = DB::table("users")->
            join("doctors", "doctors.user_id", "=", "users.id")->
            get();
        return $fetchDoctors;
    }
}
