@extends('AuthenticationLayout.main')

@section('main-section')
    <div class="w-full flex flex-col md:flex-row items-center space-x-36">
        <div class="hidden md:block md:w-3/6 bg-[url('images/Registration.jpg')] min-h-screen bg-cover bg-no-repeat mb-0">
        </div>
        <div class="w-80 md:w-2/6 md:mr-10">
            <h2 class="text-[#111827] text-2xl font-bold my-3">Create your account</h2>
            <p class="text-[#6B7280] text-sm">Welcome to Hospital Management System Portal. </p>

            <form action="{{ route('Create.Account') }}" class="my-10" autocomplete="off" method="post">
                @csrf
                <div class="flex flex-col">
                    <label for="username" class="text-[#111827] font-medium mb-1">Full Name:</label>
                    <input type="text" name="username" id="username"
                        class="border border-[#9CA3AF] rounded-md p-2 focus:outline-none">
                    @error('username')
                        <span class="text-red-700 text-sm">{{ 'Please enter your full name' }}</span>
                    @enderror
                </div>

                <div class="my-5 flex flex-col">
                    <label for="email" class="text-[#111827] font-medium mb-1">Email:</label>
                    <input type="email" name="email" id="email"
                        class="border border-[#9CA3AF] rounded-md p-2 focus:outline-none">
                    @error('email')
                        <span class="text-red-700 text-sm">{{ 'Please enter your email' }}</span>
                    @enderror
                </div>

                <div class="my-5 flex flex-col">
                    <label for="password" class="text-[#111827] font-medium mb-1">Password:</label>
                    <input type="password" name="password" id="password"
                        class="border border-[#9CA3AF] rounded-md p-2 focus:outline-none">
                    @error('password')
                        <span class="text-red-700 text-sm">{{ 'Please enter new password' }}</span>
                    @enderror
                </div>

                <div class="my-5 flex flex-col">
                    <label for="role" class="text-[#111827] font-medium mb-1">Role:</label>
                    <select name="role" id="role"
                        class="border border-[#9CA3AF] rounded-md py-2 px-3 focus:outline-none">
                        <option value="Admin">Admin</option>
                        <option value="Doctor">Doctor</option>
                        <option value="Receptionist">Receptionist</option>
                        <option value="Patients">Patient</option>
                    </select>
                    @error('role')
                        <span class="text-red-700 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <button class="my-5 w-full bg-black text-white p-2 rounded-md cursor-pointer">Create Account</button>


                <p class="my-2 text-center text-[#374151]">Already have an account? <a href={{ route('Login') }}
                        class="text-black">Sign in</a></p>

            </form>
        </div>
    </div>
@endsection
