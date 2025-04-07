<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
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

    public function createUserAccount(Request $request)
    {
        // Check if email already exist or not
        $isEmailAlreadyExist = DB::table('users')->
            where('email', '=', $request->email)->
            count();

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
        // 1. Check if email exist or not
        $userEmail = $request->email;

        $accountExist = DB::table("users")->where("email", "=", $userEmail)->count();

        if ($accountExist == 1) {
            $fetchPassword = DB::table("users")->where('email', '=', $userEmail)->first();
            return $fetchPassword->password;
        } else {
            toastr()->error("User with this email doesn't exist");
            return redirect()->back();
        }

    }
}
