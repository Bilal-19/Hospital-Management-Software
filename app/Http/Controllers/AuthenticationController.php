<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Str;

class AuthenticationController extends EmailController
{
    public function LoginView()
    {
        return view("Registration.Login");
    }

    public function RegisterView()
    {
        return view("Registration.Register");
    }

    public function forgetPassword()
    {
        return view("Registration.ForgetPassword");
    }

    public function getEmailCount($userEmail)
    {
        $countEmail = DB::table('users')->
            where('email', '=', $userEmail)->
            count();
        return $countEmail;
    }

    public function generatePassword()
    {
        $newPassword = Str::random(8);
        return $newPassword;
    }

    public function createRoleBaseAccount($tableName, $userID, $username, $email)
    {
        $result = DB::table($tableName)->insert([
            "fullName" => $username,
            "emailAddress" => $email,
            'created_at' => now(),
            "user_id" => $userID
        ]);
        return $result;
    }

    public function createUserAccount(Request $request)
    {
        // Form Validation
        $request->validate([
            "username" => "required",
            "email" => "required",
            "password" => "required",
            "role" => "required",
        ]);
        // Check if email already exist or not
        $isEmailAlreadyExist = $this->getEmailCount($request->email);

        if ($isEmailAlreadyExist >= 1) {
            toastr()->error('User with this email already exist');
            return redirect()->back();
        } else {
            $userID = DB::table('users')->insertGetId(
                [
                    'name' => $request->username,
                    'email' => $request->email,
                    'password' => $request->password ? Hash::make($request->password) : Hash::make(12345678),
                    'role' => $request->role,
                    'created_at' => now()
                ]
            );

            if ($request->role === "Doctor") {
                $this->createRoleBaseAccount("doctors", $userID, $request->username, $request->email);
                toastr()->success("Account created successfully.");
            } else if ($request->role === "Receptionist") {
                $this->createRoleBaseAccount("receptionist", $userID, $request->username, $request->email);
                toastr()->success("Account created successfully.");
            } else if ($request->role === "Patient") {
                $this->createRoleBaseAccount("patients", $userID, $request->username, $request->email);
                toastr()->success("Account created successfully.");
            } else {
                toastr()->info("Something went wrong. Please try again later.");
            }
            return redirect()->back();
        }
    }

    public function checkCredentials($email, $password)
    {
        $findUser = DB::table("users")->
            where("email", "=", $email)->first();
        if ($findUser && Hash::check($password, $findUser->password)) {
            return $findUser;
        } else {
            return null;
        }

    }
    public function LoginUser(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Form Validation
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user) {
                if ($user->role == 'Doctor') {
                    return view("Doctor.Dashboard");
                } elseif ($user->role == 'Receptionist') {
                    return view("Receptionist.Dashboard");
                } elseif ($user->role == 'Admin') {
                    return view("Admin.Dashboard");
                } else {
                    return view("Registration.Login");
                }
            } else {
                toastr()->error("User with this email doesnot exist.");
            }
        } else {
            toastr()->info("Invalid email or Password");
            return view("Registration.Login");
        }
    }
    public function sendPassword(Request $request)
    {
        $userEmail = $request->email;

        $accountExist = $this->getEmailCount($userEmail);

        if ($accountExist == 1) {
            $newPassword = $this->generatePassword();
            DB::table("users")->
                where('email', '=', $userEmail)->
                update(['password' => Hash::make($newPassword)]);
            $isEmailDispatch = $this->sendEmail(
                $newPassword,
                "Here's your new password",
                "Password reset",
                $userEmail
            );
            if ($isEmailDispatch) {
                toastr()->success("New password sent to your email.");
                return redirect()->back();
            } else {
                toastr()->info("Something went wrong.");
                return redirect()->back();
            }
        } else {
            toastr()->error("User with this email doesn't exist");
            return redirect()->back();
        }
    }

    public function LogOutUser()
    {
        if (Auth::check()) {
            Auth::logout();
            return view("Registration.Login");
        } else {
            return redirect()->back();
        }
    }

    public function resetPassword($id)
    {
        $findAccount = DB::table("users")->find($id);
        $userEmail = $findAccount->email;
        $isPasswordReset = DB::table("users")->
            where('email', '=', $userEmail)->
            update([
                'password' => Hash::make("12345678"),
                'updated_at' => now()
            ]);
        if ($isPasswordReset) {
            toastr()->success("Password reset.");
        } else {
            toastr()->error("Try again later.");
        }
        return redirect()->back();
    }

    public function deleteAccount($id)
    {
        $isAccountDeleted = DB::table("users")->delete($id);
        if ($isAccountDeleted) {
            toastr()->success("Account removed successfully.");
        } else {
            toastr()->error("Try again later.");
        }
        return redirect()->back();
    }
}
