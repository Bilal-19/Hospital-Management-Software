@extends("AuthenticationLayout.main")

@section("main-section")
<div class="w-full flex flex-col md:flex-row justify-between items-center">
    <div class="w-80 md:w-2/6 m-8 md:m-10">
        <h2 class="text-[#111827] text-2xl font-bold mb-3">Sign in to your account</h2>
        <p class="text-[#6B7280] text-sm">Welcome back! Please enter your details. </p>

        <form action="{{route("VerifyUserCredentials")}}" class="my-10" autocomplete="off" method="post">
            @csrf
            <div class="flex flex-col">
                <label for="email" class="text-[#111827] font-medium mb-1">Email:</label>
                <input type="email" name="email" id="email"
                    class="border border-[#9CA3AF] rounded-md p-2 focus:outline-none">
            </div>

            <div class="mt-5 flex flex-col">
                <label for="password" class="text-[#111827] font-medium mb-1">Password:</label>
                <input type="password" name="password" id="password"
                    class="border border-[#9CA3AF] rounded-md p-2 focus:outline-none">
            </div>

            <div class="flex flex-row justify-between my-5">
                <p class="text-sm text-[#374151]"><input type="checkbox" name="remember"> Remember me</p>
                <a href="{{route("Forget.Password")}}" class="font-semibold text-sm">Forgot Password?</a>
            </div>

            <button class="w-full bg-black text-white p-2 rounded-md cursor-pointer">Sign in</button>


            <p class="my-5 text-center text-[#374151]">Don't have an account? <a href={{route("Register")}}
                    class="text-black">Register</a></p>

        </form>
    </div>
    <div class="w-80 hidden md:block md:w-3/6 bg-[url('images/authentication.png')] min-h-screen bg-cover bg-no-repeat mb-0">
    </div>
</div>
@endsection
