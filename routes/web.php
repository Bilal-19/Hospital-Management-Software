<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ProfileController;
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

Route::get("/send-email",[EmailController::class,"sendEmail"])->name("Send.Email");
