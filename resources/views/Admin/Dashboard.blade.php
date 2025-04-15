@extends('AdminLayout.main')
@php
    $isAttendanceMarked = DB::table('staff')
        ->whereDate('created_at', today())
        ->where('user_id', '=', Auth::user()->id)
        ->count();

    // Check no of today's appoinment -- count
$todayDate = date('Y-m-d', strtotime(now()));
$countTodayAppointment = DB::table('appointments')
    ->where('appointmentDate', '=', $todayDate)
    ->orWhere('user_id', '=', Auth::user()->id)
        ->count();

@endphp

@section('section')
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-4">Welcome to the Dashboard</h2>
            <p class="text-gray-600 capitalize">Welcome {{ Auth::user()->name }}</p>
            <div class="flex flex-row justify-between items-center">
                <p class="text-gray-600 capitalize text-sm">Attendance Status:
                    {{ $isAttendanceMarked >= 1 ? 'Present' : 'Absent' }}</p>

                @if ($isAttendanceMarked == 0)
                    <form action="{{ route('Doctor.MarkPresent') }}" method="POST">
                        @csrf
                        <button class="bg-black text-white px-3 py-1 rounded-md">Mark Attendance</button>
                    </form>
                @endif
            </div>
        </div>



        <div class="w-full my-5 flex flex-col md:flex-row justify-between space-y-5 md:space-y-0">
            <div
                class="w-80 mx-auto md:mx-0 md:w-1/4 bg-white rounded-md shadow p-6 border-1 border-t border-t-slate-700 flex flex-col items-center justify-center space-x-2">
                <p class="text-lg font-medium text-gray-800">April Patients</p>
                <p><i class="fa-solid fa-hospital-user"></i> {{ $countTodayAppointment }}</p>
            </div>

            <div
                class="w-80 mx-auto md:mx-0 md:w-1/4 bg-white rounded-md shadow p-6 border-1 border-t border-t-slate-700 flex flex-col items-center justify-center space-x-2">
                <p class="text-lg font-medium text-gray-800">Appointments</p>
                <p> <i class="fa-solid fa-calendar-check"></i> 100</p>
            </div>

            <div
                class="w-80 mx-auto md:mx-0 md:w-1/4 bg-white rounded-md shadow p-6 border-1 border-t border-t-slate-700 flex flex-col items-center justify-center space-x-2">
                <p class="text-lg font-medium text-gray-800">Revenue</p>
                <p> <i class="fa-solid fa-dollar-sign"></i> 100</p>
            </div>
        </div>
    </main>
    </div>
@endsection
