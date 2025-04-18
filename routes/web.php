<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ReceptionistController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get("/", [AuthenticationController::class, 'LoginView'])->name('Login');
Route::get("/register", [AuthenticationController::class, 'RegisterView'])->name('Register');
Route::get("/forget-password", [AuthenticationController::class, 'forgetPassword'])->name('Forget.Password');
Route::post("/create-account", [AuthenticationController::class, 'createUserAccount'])->name('Create.Account');
Route::post("/verify-credentials", [AuthenticationController::class, 'LoginUser'])->name('VerifyUserCredentials');
Route::post("/send-password", [AuthenticationController::class, 'sendPassword'])->name('sendPassword');
Route::get("/generate-password", [AuthenticationController::class, 'generatePassword'])->name('Generate.Password');
Route::get("/sign-out", [AuthenticationController::class, 'LogOutUser'])->name('LogOutUser');
Route::get("/reset-password/{id}", [AuthenticationController::class, 'resetPassword'])->name('ResetPassword');
Route::get("/delete-account/{id}", [AuthenticationController::class, 'deleteAccount'])->name('DeleteAccount');


Route::get("/send-email",[EmailController::class,"sendEmail"])->name("Send.Email");


Route::get("/doctor-dashboard",[DoctorController::class,'index'])->name('Doctor.Dashboard');
Route::get("/patients",[DoctorController::class,'readPatient'])->name('Doctor.PatientDirectory');
Route::get("/mark-doctor-attendance",[DoctorController::class,'markDoctorAttendance'])->name('Doctor.AllAttendance');
Route::get("/doctor-profile",[DoctorController::class,'myProfile'])->name('Doctor.Profile');
Route::post("/mark-todays-attendance",[DoctorController::class,'markTodayAttendance'])->name('Doctor.MarkPresent');
Route::post("/update-profile",[DoctorController::class,'updateMyProfile'])->name('Doctor.UpdateProfile');
Route::post("/create-patient",[DoctorController::class,'createPatient'])->name('Doctor.CreatePatientProfile');
Route::get("/doctor-all-appoinments",[DoctorController::class,'viewAllAppoinments'])->name('Doctor.AllAppoinments');
Route::get("/add-diagnose/{id}",[DoctorController::class,'addDiagnosNote'])->name('Doctor.AddDiagnosNote');
Route::post("/update-patient-record/{id}",[DoctorController::class,'updatePatientRecord'])->name('Doctor.UpdatePatientRecord');
Route::get("/patient-visit-history/{id}",[DoctorController::class,'patientVisitHistory'])->name('Doctor.patientVisitHistory');
Route::get("/refer-patient/{id}",[DoctorController::class,'referToSpecialist'])->name('Doctor.ReferToSpecialist');
Route::post("/create-referral",[DoctorController::class,'createReferral'])->name('Doctor.CreateReferral');
Route::get("/doctor-salary", [DoctorController::class, 'fetchMySalReceipts'])->name('Doctor.MyPreviousSalary');



Route::get("/receptionist-dashboard",[ReceptionistController::class,'index'])->name('Receptionist.Dashboard');
Route::get("/mark-attendance",[ReceptionistController::class,'markAttendance'])->name('Receptionist.MarkAttendance');
Route::get("/appointments",[ReceptionistController::class,'manageAppointments'])->name('Receptionist.ManageAppointments');
Route::post("/create-appointment",[ReceptionistController::class,'createAppoinment'])->name('Receptionist.CreateAppoinment');
Route::get("/receptionist-profile",[ReceptionistController::class,'receptionistProfile'])->name('Receptionist.Profile');
Route::post("/update-receptionist-profile",[ReceptionistController::class,'updateReceptionistProfile'])->name('Receptionist.UpdateProfile');
Route::get("/generate-bill",[ReceptionistController::class,'generateBills'])->name('Receptionist.GenerateBills');
Route::post("/create-invoice",[ReceptionistController::class,'createBill'])->name('Receptionist.CreateBill');
Route::get("/all-invoices",[ReceptionistController::class,'getInvoices'])->name('Receptionist.GetInvoices');
Route::get("/all-doctors",[ReceptionistController::class,'allDoctors'])->name('Receptionist.AllDoctors');
Route::get("/all-appoinments",[ReceptionistController::class,'allAppoinments'])->name('Receptionist.AllAppoinments');
Route::get("/all-patients",[ReceptionistController::class,'allPatients'])->name('Receptionist.AllPatients');
Route::get("/add-patient",[ReceptionistController::class,'addPatient'])->name('Receptionist.AddPatient');
Route::get("/cancel-appointment/{id}",[ReceptionistController::class,'cancelAppointment'])->name('Receptionist.CancelAppointment');
Route::post("/reschedule-appointment",[ReceptionistController::class,'rescheduleAppointment'])->name('Receptionist.RescheduleAppointment');
Route::get("/download-invoice/{id}",[ReceptionistController::class,'downloadInvoice'])->name('Receptionist.DownloadInvoice');
Route::get("/my-salary", [ReceptionistController::class, 'fetchSalaries'])->name('Receptionist.MySalary');
Route::get("/all-inventories", [ReceptionistController::class, 'readInventories'])->name('Receptionist.Inventories');
Route::get("/add-inventory", [ReceptionistController::class, 'addInventory'])->name('Receptionist.AddInventory');
Route::post("/create-inventory", [ReceptionistController::class, 'createInventory'])->name('Receptionist.CreateInventory');
Route::get("/delete-inventory/{id}", [ReceptionistController::class, 'deleteInventory'])->name('Receptionist.DeleteInventory');
Route::get("/edit-inventory/{id}", [ReceptionistController::class, 'editInventory'])->name('Receptionist.EditInventory');
Route::post("/update-inventory/{id}", [ReceptionistController::class, 'updateInventory'])->name('Receptionist.UpdateInventory');

Route::get("/admin-dashboard",[AdminController::class,'index'])->name('Admin.Dashboard');
Route::get("/manage-staff",[AdminController::class,'manageStaff'])->name('Admin.ManageStaff');
Route::get("/manage-shift",[AdminController::class,'shiftManagement'])->name('Admin.ShiftManagement');
Route::post("/create-shift",[AdminController::class,'createShift'])->name('Admin.CreateShift');
Route::get("/pay-slip",[AdminController::class,'employeePaySlip'])->name('Admin.EmployeePaySlip');
Route::get("/generate-pay-slip/{id}",[AdminController::class,'generatePaySlip'])->name('Admin.GeneratePaySlip');
Route::get("/download-slip/{id}",[AdminController::class,'downloadSlip'])->name('Admin.DownloadSlip');
Route::get("/departments",[AdminController::class,'departmentManagement'])->name('Admin.DepartmentManagement');
Route::post("/create-department",[AdminController::class,'createDepartment'])->name('Admin.CreateDepartment');
Route::post("/assign-department",[AdminController::class,'assignDepartmentToStaff'])->name('Admin.AssignDepartment');
Route::get("/staff-attendance",[AdminController::class,'staffAttendance'])->name('Admin.StaffAttendance');
