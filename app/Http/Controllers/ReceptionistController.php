<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReceptionistController extends Controller
{
    // Dashboard
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
        $fetchMyAttendance = DB::table("staff")->
            where("user_id", "=", Auth::user()->id)
            ->get();
        return view("Receptionist.MarkAttendance", with(compact("fetchMyAttendance")));
    }

    // Book Appointments

    public function getDoctorNames()
    {
        $fetchDoctorName = DB::table("doctors")->pluck('fullName');
        return $fetchDoctorName;
    }

    public function getPatientNames()
    {
        $fetchPatientName = DB::table("patients")->pluck('fullName');
        return $fetchPatientName;
    }

    public function getAppointments($limitVal = null)
    {
        if ($limitVal) {
            return DB::table("appointments")
                ->whereDate("appointmentDate", ">=", today())
                ->where("status", "=", "confirmed")
                ->limit($limitVal)
                ->orderBy("appointmentDate")
                ->get();
        } else {
            return DB::table("appointments")
                ->whereDate("appointmentDate", ">=", today())
                ->where("status", "=", "confirmed")
                ->orderBy("appointmentDate")
                ->paginate(10);
        }
    }
    public function manageAppointments()
    {
        $fetchDoctorName = $this->getDoctorNames();
        $fetchPatientName = $this->getPatientNames();
        $fetchAppointments = $this->getAppointments(3);
        $fetchDepartments = DB::table("departments")->pluck("departmentName");
        return view("Receptionist.ManageAppointments", with(compact(
            "fetchDoctorName",
            "fetchAppointments",
            "fetchPatientName",
            "fetchDepartments"
        )));
    }

    public function allAppointments()
    {
        $fetchAppointments = $this->getAppointments();
        return view("Receptionist.AllAppointments", with(compact("fetchAppointments")));
    }

    public function createAppointment(Request $request)
    {
        // Form Validation
        $request->validate([
            "department" => "required",
            "doctor" => "required",
            "appointmentDate" => "required",
            "appointmentTime" => "required",
            "patientName" => "required",
            "reasonForVisit" => "required",
        ]);
        $isAppointmentCreated = DB::table("appointments")->insert([
            "department" => $request->department,
            "doctorName" => $request->doctor,
            "appointmentDate" => $request->appoinmentDate,
            "appointmentTime" => $request->appoinmentTime,
            "patientName" => $request->patientName,
            "reasonForVisit" => $request->reasonForVisit,
            "user_id" => Auth::user()->id,
            "created_at" => now()
        ]);

        if ($isAppointmentCreated) {
            toastr()->success("Appointment booked successfully");
            return redirect()->back();
        } else {
            toastr()->info("Something went wrong. Please check error message");
            return redirect()->back();
        }
    }

    public function cancelAppointment($id)
    {
        $isCancelled = DB::table("appointments")->
            where("id", "=", $id)->
            update([
                "status" => "cancel",
                "updated_at" => now()
            ]);
        if ($isCancelled) {
            toastr()->success("Appointment cancel successfully");
        } else {
            toastr()->info("Something went wrong.");
        }
        return redirect()->back();
    }

    public function rescheduleAppointment(Request $request)
    {
        $updateAppointment = DB::table("appointments")->
            where("id", "=", $request->id)->
            update([
                "appointmentDate" => $request->appointmentDate,
                "appointmentTime" => $request->appointmentTime,
                "updated_at" => now()
            ]);

        if ($updateAppointment) {
            toastr()->success("Appointment rescheduled successfully");
        } else {
            toastr()->info("Something went wrong. Try again later.");
        }
        return redirect()->back();
    }

    //Patients
    public function addPatient()
    {
        return view("Receptionist.AddPatient");
    }

    public function allPatients(Request $request)
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
        $countRecords = DB::table("patients")->count();
        return view("Receptionist.Patients", with(compact("fetchRecords", "countRecords")));
    }

    // Billing & Invoices
    public function generateBills(Request $request)
    {
        if ($request->invoiceDate && $request->patientName && $request->doctorName) {
            $fetchBillHistory = DB::table("receipt")->
                where("user_id", "=", Auth::user()->id)->
                where("patientName", "=", $request->patientName)->
                where("doctorName", "=", $request->doctorName)->
                where("created_at", 'like', "$request->invoiceDate%")->
                limit(3)->
                get();
        } else {
            $fetchBillHistory = DB::table("receipt")->
                where("user_id", "=", Auth::user()->id)->
                limit(3)->
                get();
        }
        $fetchDoctors = $this->getDoctorNames();
        $fetchPatientDirectory = DB::table("patients")->pluck("fullName");
        return view(
            "Receptionist.GenerateBills",
            with(compact("fetchBillHistory", "fetchDoctors", "fetchPatientDirectory"))
        );
    }

    public function createBill(Request $request)
    {
        // Form Validation
        $request->validate([
            "patientName" => "required",
            "doctorName" => "required",
            "serviceName" => "required",
            "serviceAmount" => "required",
            "testName" => "required",
            "testCost" => "required",
            "medicineName" => "required",
            "medicinePrice" => "required",
            "paymentMode" => "required",
        ]);
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

    public function getInvoices(Request $request)
    {
        if ($request->invoiceDate && $request->patientName && $request->doctorName) {
            $fetchBillHistory = DB::table("receipt")->
                where("user_id", "=", Auth::user()->id)->
                where("patientName", "=", $request->patientName)->
                where("doctorName", "=", $request->doctorName)->
                where("created_at", 'like', "$request->invoiceDate%")->
                limit(3)->
                get();
        } else {
            $fetchBillHistory = DB::table("receipt")->
                where("user_id", "=", Auth::user()->id)->
                paginate(10);
        }
        return view("Receptionist.Invoices", with(compact("fetchBillHistory")));
    }

    public function downloadInvoice($id)
    {
        $findInvoice = DB::table("receipt")->find($id);
        $loadFile = Pdf::loadView("PDF.PdfInvoice", with(compact("findInvoice")));
        return $loadFile->download("Invoice.pdf");
    }


    //All Doctors
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

    //Salary Receipt
    public function fetchSalaries()
    {
        $userID = Auth::user()->id;
        $fetchSalaries = DB::table("salary")->where("employeeId", "=", $userID)->get();
        return view("Receptionist.MySalary", with(compact("fetchSalaries")));
    }


    //My Profile
    public function receptionistProfile()
    {
        // 'first() - used to fetch single record'
        $UserID = Auth::user()->id;
        $myShift = DB::table("shift")->where("staffName", "=", Auth::user()->name)->first();
        $fetchRecord = DB::table("receptionist")->where('user_id', '=', $UserID)->first();
        return view("Receptionist.MyProfile", with(compact("fetchRecord", "myShift")));
    }

    public function updateReceptionistProfile(Request $request)
    {
        $UserID = Auth::user()->id;
        $isUpdated = DB::table("receptionist")->
            where("user_id", "=", $UserID)->
            update([
                "fullName" => $request->fullName,
                "gender" => $request->gender,
                "phoneNumber" => $request->phoneNumber,
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

    // Inventory Management
    public function readInventories(Request $request)
    {
        if ($request->search) {
            $fetchInventories = DB::table("inventory")->
                where("itemName", "=", $request->search)->
                orWhere("supplierName", "=", $request->search)->
                get();
        } else {
            $fetchInventories = DB::table("inventory")->get();
        }
        return view("Receptionist.Inventory", with(compact("fetchInventories")));
    }

    public function addInventory()
    {
        return view("Receptionist.AddInventory");
    }

    public function getInventoryStatus($stockQuantity, $stockLevel, $expiryDate)
    {
        if ($stockQuantity >= $stockLevel) {
            $status = "Available";
        } elseif ($stockQuantity < $stockLevel) {
            $status = "Low Stock";
        } elseif ($stockQuantity === 0) {
            $status = "Out of Stock";
        } elseif ($expiryDate > today()) {
            $status = "Expired";
        }
        return $status;
    }

    public function createInventory(Request $request)
    {
        $status = $this->getInventoryStatus(
            $request->quantityInStock,
            $request->minimumStockLevel,
            $request->expiryDate
        );

        // Form Validation
        $request->validate([
            "itemName" => "required",
            "category" => "required",
            "quantityInStock" => "required",
            "unit" => "required",
            "minimumStockLevel" => "required",
            "batchNumber" => "required",
            "expiryDate" => "required",
            "supplierName" => "required",
            "pricePerUnit" => "required",
        ]);

        $addInventory = DB::table("inventory")->insert([
            "itemName" => $request->itemName,
            "category" => $request->category,
            "quantityInStock" => $request->quantityInStock,
            "unit" => $request->unit,
            "minimumStockLevel" => $request->minimumStockLevel,
            "batchNumber" => $request->batchNumber,
            "expiryDate" => $request->expiryDate,
            "supplierName" => $request->supplierName,
            "purchaseDate" => $request->purchaseDate,
            "pricePerUnit" => $request->pricePerUnit,
            "totalValue" => $request->pricePerUnit * $request->quantityInStock,
            "status" => $status,
            "notes" => $request->notes ?? "Not provided",
            "created_at" => now()
        ]);

        if ($addInventory) {
            toastr()->success("Item added to inventory");
        } else {
            toastr()->info("Something went wrong. Please check error message.");
        }
        return redirect()->back();
    }

    public function deleteInventory($id)
    {
        $isDeleted = DB::table("inventory")->
            where("id", "=", $id)
            ->delete();

        if ($isDeleted) {
            toastr()->success("Inventory removed.");
        } else {
            toastr()->info("Something went wrong. Please check error message.");
        }
        return redirect()->back();
    }

    public function editInventory($id)
    {
        $findInventory = DB::table("inventory")->find($id);
        return view("Receptionist.EditInventory", with(compact("findInventory")));
    }

    public function updateInventory($id, Request $request)
    {
        $status = $this->getInventoryStatus($request->quantityInStock, $request->minimumStockLevel, $request->expiryDate);
        $isUpdated = DB::table("inventory")->where("id", "=", $id)->update([
            "itemName" => $request->itemName,
            "category" => $request->category,
            "quantityInStock" => $request->quantityInStock,
            "unit" => $request->unit,
            "minimumStockLevel" => $request->minimumStockLevel,
            "batchNumber" => $request->batchNumber,
            "expiryDate" => $request->expiryDate,
            "supplierName" => $request->supplierName,
            "purchaseDate" => $request->purchaseDate,
            "pricePerUnit" => $request->pricePerUnit,
            "totalValue" => $request->pricePerUnit * $request->quantityInStock,
            "status" => $status,
            "notes" => $request->notes,
            "updated_at" => now()
        ]);

        if ($isUpdated) {
            toastr()->success("Inventory updated.");
        } else {
            toastr()->error("Something went wrong. Please try again later.");
        }
        return redirect()->back();
    }
}
