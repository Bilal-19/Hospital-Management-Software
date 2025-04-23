<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ReceptionistController;
use Illuminate\Support\Facades\Route;

// Group Routes that shared same Authentication controller
Route::controller(AuthenticationController::class)->group(
    function () {
        Route::get("/", 'LoginView')->name('Login');
        Route::get("/register", 'RegisterView')->name('Register');
        Route::get("/forget-password", 'forgetPassword')->name('Forget.Password');
        Route::post("/create-account", 'createUserAccount')->name('Create.Account');
        Route::post("/verify-credentials", 'LoginUser')->name('VerifyUserCredentials');
        Route::post("/send-password", 'sendPassword')->name('sendPassword');
        Route::get("/generate-password", 'generatePassword')->name('Generate.Password');
        Route::get("/sign-out", 'LogOutUser')->name('LogOutUser');
        Route::get("/reset-password/{id}", 'resetPassword')->name('ResetPassword');
        Route::get("/delete-account/{id}", 'deleteAccount')->name('DeleteAccount');
    }
);



Route::get("/send-email", [EmailController::class, "sendEmail"])->name("Send.Email");

// Group Routes that shared same Doctor controller
Route::controller(DoctorController::class)->group(
    function () {
        Route::get("/doctor-dashboard", 'index')->name('Doctor.Dashboard');
        Route::get("/patients", 'readPatient')->name('Doctor.PatientDirectory');
        Route::get("/mark-doctor-attendance", 'markDoctorAttendance')->name('Doctor.AllAttendance');
        Route::get("/doctor-profile", 'myProfile')->name('Doctor.Profile');
        Route::post("/mark-todays-attendance", 'markTodayAttendance')->name('Doctor.MarkPresent');
        Route::post("/update-profile", 'updateMyProfile')->name('Doctor.UpdateProfile');
        Route::post("/create-patient", 'createPatient')->name('Doctor.CreatePatientProfile');
        Route::get("/doctor-all-appoinments", 'viewAllAppointments')->name('Doctor.AllAppoinments');
        Route::get("/add-diagnose/{id}", 'addDiagnosNote')->name('Doctor.AddDiagnosNote');
        Route::post("/update-patient-record/{id}", 'updatePatientRecord')->name('Doctor.UpdatePatientRecord');
        Route::get("/patient-visit-history/{id}", 'patientVisitHistory')->name('Doctor.patientVisitHistory');
        Route::get("/refer-patient/{id}", 'referToSpecialist')->name('Doctor.ReferToSpecialist');
        Route::post("/create-referral", 'createReferral')->name('Doctor.CreateReferral');
        Route::get("/doctor-salary", 'fetchMySalReceipts')->name('Doctor.MyPreviousSalary');
    }
);


// Group Routes that shared same Receptionist controller
Route::controller(ReceptionistController::class)->group(
    function () {
        Route::get("/receptionist-dashboard", 'index')->name('Receptionist.Dashboard');
        Route::get("/mark-attendance", 'markAttendance')->name('Receptionist.MarkAttendance');
        Route::get("/appointments", 'manageAppointments')->name('Receptionist.ManageAppointments');
        Route::post("/create-appointment", 'createAppointment')->name('Receptionist.CreateAppoinment');
        Route::get("/receptionist-profile", 'receptionistProfile')->name('Receptionist.Profile');
        Route::post("/update-receptionist-profile", 'updateReceptionistProfile')->name('Receptionist.UpdateProfile');
        Route::get("/generate-bill", 'generateBills')->name('Receptionist.GenerateBills');
        Route::post("/create-invoice", 'createBill')->name('Receptionist.CreateBill');
        Route::get("/all-invoices", 'getInvoices')->name('Receptionist.GetInvoices');
        Route::get("/all-doctors", 'allDoctors')->name('Receptionist.AllDoctors');
        Route::get("/all-appointments", 'allAppointments')->name('Receptionist.AllAppointments');
        Route::get("/all-patients", 'allPatients')->name('Receptionist.AllPatients');
        Route::get("/add-patient", 'addPatient')->name('Receptionist.AddPatient');
        Route::get("/cancel-appointment/{id}", 'cancelAppointment')->name('Receptionist.CancelAppointment');
        Route::post("/reschedule-appointment", 'rescheduleAppointment')->name('Receptionist.RescheduleAppointment');
        Route::get("/download-invoice/{id}", 'downloadInvoice')->name('Receptionist.DownloadInvoice');
        Route::get("/my-salary", 'fetchSalaries')->name('Receptionist.MySalary');
        Route::get("/all-inventories", 'readInventories')->name('Receptionist.Inventories');
        Route::get("/add-inventory", 'addInventory')->name('Receptionist.AddInventory');
        Route::post("/create-inventory", 'createInventory')->name('Receptionist.CreateInventory');
        Route::get("/delete-inventory/{id}", 'deleteInventory')->name('Receptionist.DeleteInventory');
        Route::get("/edit-inventory/{id}", 'editInventory')->name('Receptionist.EditInventory');
        Route::post("/update-inventory/{id}", 'updateInventory')->name('Receptionist.UpdateInventory');
    }
);

// Group Routes that shared same Admin controller
Route::controller(AdminController::class)->group(
    function () {
        Route::get("/admin-dashboard", 'index')->name('Admin.Dashboard');
        Route::get("/manage-staff", 'manageStaff')->name('Admin.ManageStaff');
        Route::get("/manage-shift", 'shiftManagement')->name('Admin.ShiftManagement');
        Route::post("/create-shift", 'createShift')->name('Admin.CreateShift');
        Route::get("/pay-slip", 'employeePaySlip')->name('Admin.EmployeePaySlip');
        Route::get("/generate-pay-slip/{id}", 'generatePaySlip')->name('Admin.GeneratePaySlip');
        Route::get("/download-slip/{id}", 'downloadSlip')->name('Admin.DownloadSlip');
        Route::get("/departments", 'departmentManagement')->name('Admin.DepartmentManagement');
        Route::post("/create-department", 'createDepartment')->name('Admin.CreateDepartment');
        Route::post("/assign-department", 'assignDepartmentToStaff')->name('Admin.AssignDepartment');
        Route::get("/staff-attendance", 'staffAttendance')->name('Admin.StaffAttendance');
    }
);
