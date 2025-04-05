<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use function Laravel\Prompts\error;

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
}
