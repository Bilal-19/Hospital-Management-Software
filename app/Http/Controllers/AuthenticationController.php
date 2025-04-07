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

    public function createUserAccount(Request $request)
    {
        // Check if email already exist or not
        $isEmailAlreadyExist = $this->getEmailCount($request->email);

        if ($isEmailAlreadyExist >= 1) {
            toastr()->error('User with this email already exist');
            return redirect()->back();
        } else {
            $isUserCreated = DB::table('users')->insert(
                [
                    'name' => $request->username,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'role' => $request->role,
                    'created_at' => now()
                ]
            );

            if ($isUserCreated) {
                toastr()->success('Account created successfully');
                return redirect()->back();

            }
        }
    }

    public function VerifyUserCredentials(Request $request)
    {
        $userCredentials = $request->validate(
            [
                'email' => 'required',
                'password' => 'required'
            ]
        )
        ;
        $haveAccount = Auth::attempt($userCredentials);
        dd($haveAccount);
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
}
