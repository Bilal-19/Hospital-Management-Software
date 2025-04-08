<?php

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

Route::get("/login", [AuthenticationController::class, 'LoginView'])->name('Login');
Route::get("/register", [AuthenticationController::class, 'RegisterView'])->name('Register');
Route::get("/forget-password", [AuthenticationController::class, 'forgetPassword'])->name('Forget.Password');
Route::post("/create-account", [AuthenticationController::class, 'createUserAccount'])->name('Create.Account');
Route::post("/verify-credentials", [AuthenticationController::class, 'VerifyUserCredentials'])->name('VerifyUserCredentials');
Route::post("/send-password", [AuthenticationController::class, 'sendPassword'])->name('sendPassword');
Route::get("/generate-password", [AuthenticationController::class, 'generatePassword'])->name('Generate.Password');

Route::get("/send-email",[EmailController::class,"sendEmail"])->name("Send.Email");


Route::get("/doctor-dashboard",[DoctorController::class,'index'])->name('Doctor.Dashboard');
Route::get("/patients",[DoctorController::class,'readPatient'])->name('Doctor.PatientDirectory');
Route::get("/add-patient",[DoctorController::class,'addPatient'])->name('Doctor.AddPatient');
Route::get("/mark-attendance",[DoctorController::class,'markAttendance'])->name('Doctor.MarkAttendance');
Route::get("/doctor-profile",[DoctorController::class,'myProfile'])->name('Doctor.Profile');
Route::post("/mark-todays-attendance",[DoctorController::class,'markTodayAttendance'])->name('Doctor.MarkPresent');
Route::post("/update-profile",[DoctorController::class,'updateMyProfile'])->name('Doctor.UpdateProfile');
Route::post("/create-patient",[DoctorController::class,'createPatient'])->name('Doctor.CreatePatientProfile');

Route::get("/receptionist-dashboard",[ReceptionistController::class,'index'])->name('Receptionist.Dashboard');
Route::get("/mark-attendance",[ReceptionistController::class,'markAttendance'])->name('Receptionist.MarkAttendance');
