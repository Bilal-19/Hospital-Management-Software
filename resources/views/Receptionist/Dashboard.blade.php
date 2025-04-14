@extends('ReceptionistLayout.main')

@section('section')
@php
    $isAttendanceMarked = DB::table('staff')
        ->where('created_at', '=', 'now()%')
        ->orWhere('user_id', '=', Auth::user()->id)
        ->count();
@endphp
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-4">Welcome to the Dashboard</h2>
            <p class="text-gray-600 capitalize">Welcome {{ Auth::user()->name }}</p>
            <div class="flex flex-row justify-between items-center">
                <p class="text-gray-600 capitalize text-sm">Attendance Status:
                    {{ $isAttendanceMarked == 1 ? 'Present' : 'Absent' }}</p>

                @if ($isAttendanceMarked == 0)
                    <form action="{{ route('Doctor.MarkPresent') }}" method="POST">
                        @csrf
                        <button class="bg-black text-white px-3 py-1 rounded-md">Mark Attendance</button>
                    </form>
                @endif
            </div>
        </div>

        @php
            $countAppoinments = DB::table('appoinments')->count();
            $totalRevenue = DB::table('receipt')
                ->where('user_id', '=', Auth::user()->id)
                ->sum('totalAmount');
            $availableDoctors = DB::table('doctors')->where("status","=","Available")->count();
            $unavailableDoctors = DB::table('doctors')->where("status","=","Unavailable")->count()
        @endphp
        <div class="w-full mt-10 flex flex-col md:flex-row justify-between md:space-x-10 space-y-5 md:space-y-0">
            <div class="bg-white rounded-md shadow border-t border-emerald-700 p-6 text-center w-80 md:w-1/3">
                <h3 class="text-lg">Total <span class="font-medium text-emerald-700">Appoinments</span></h3>
                <p class="text-gray-500"><i class="fas fa-notes-medical mr-1"></i> {{ $countAppoinments }} </p>
            </div>

            <div class="bg-white rounded-md shadow border-t border-emerald-700 p-6 text-center w-80 md:w-1/3">
                <h3 class="text-lg">Total <span class="font-medium text-emerald-700">Revenue</span></h3>
                <p class="text-gray-500">${{$totalRevenue}}</p>
            </div>

            <div class="bg-white rounded-md shadow border-t border-emerald-700 p-6 text-center w-80 md:w-1/3">
                <h3 class="text-lg">Total <span class="font-medium text-emerald-700">Doctors</span></h3>
                <p class="text-gray-500">{{$availableDoctors}} Available | {{$unavailableDoctors}} Unavailable</p>
            </div>
        </div>
    </main>
    </div>
@endsection
