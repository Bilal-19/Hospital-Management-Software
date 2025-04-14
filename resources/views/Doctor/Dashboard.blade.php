@extends('DoctorLayout.main')
@php
    $fetchAppoinments = DB::table('appoinments')
        ->where('doctorName', '=', Auth::user()->name)
        ->limit(3)
        ->get();

    $isAttendanceMarked = DB::table('staff')
        ->where('created_at', '=', 'now()%')
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
                    {{ $isAttendanceMarked == 1 ? 'Present' : 'Absent' }}</p>

                @if ($isAttendanceMarked == 0)
                    <form action="{{ route('Doctor.MarkPresent') }}" method="POST">
                        @csrf
                        <button class="bg-black text-white px-3 py-1 rounded-md">Mark Attendance</button>
                    </form>
                @endif
            </div>
        </div>



        <div class="w-full my-5 flex flex-col md:flex-row justify-between space-y-5 md:space-y-0">
            <div class="w-80 mx-auto md:mx-0 md:w-1/4 bg-white rounded-md shadow p-6 border-1 border-t border-t-slate-700 flex flex-col items-center justify-center space-x-2">
                <p class="text-lg font-medium text-gray-800">Today's Patient</p>
                <p><i class="fa-solid fa-hospital-user"></i> 100</p>
            </div>

            <div class="w-80 mx-auto md:mx-0 md:w-1/4 bg-white rounded-md shadow p-6 border-1 border-t border-t-slate-700 flex flex-col items-center justify-center space-x-2">
                <p class="text-lg font-medium text-gray-800">Appointments</p>
                <p> <i class="fa-solid fa-calendar-check"></i> 100</p>
            </div>

            <div class="w-80 mx-auto md:mx-0 md:w-1/4 bg-white rounded-md shadow p-6 border-1 border-t border-t-slate-700 flex flex-col items-center justify-center space-x-2">
                <p class="text-lg font-medium text-gray-800">Diagnosis</p>
                <p> <i class="fa-solid fa-person-dots-from-line"></i> 100</p>
            </div>
        </div>

        <div class="w-full bg-white rounded shadow p-6 mt-10">
            <h3 class="text-lg font-semibold mb-4">Upcoming Appoinments</h3>
            <table class="w-full">
                <tr class="border-b border-gray-500">
                    <th class="py-3">Date</th>
                    <th class="py-3">Time</th>
                    <th class="py-3">Patient Name</th>
                    <th class="py-3">Reason for Visit</th>
                </tr>
                @foreach ($fetchAppoinments as $record)
                    <tr class="border-b border-gray-300">
                        <td class="py-3">{{ date('M d, Y', strtotime($record->appoinmentDate)) }}</td>
                        <td class="py-3">{{ $record->appoinmentTime }}</td>
                        <td class="py-3">{{ $record->patientName }}</td>
                        <td class="py-3">{{ $record->reasonForVisit }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </main>
    </div>
@endsection
