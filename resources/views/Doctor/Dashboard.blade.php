@extends('DoctorLayout.main')

@section('section')
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-4">Welcome to the Dashboard</h2>
            <p class="text-gray-600 capitalize">Welcome {{ Auth::user()->name }}</p>
        </div>

        <div class="w-full bg-white rounded shadow p-6 mt-10">
            <h3 class="text-lg font-semibold mb-4">Upcoming Appoinments</h3>
            <table class="w-full">
                <tr class="border-b border-gray-500 text-[#6B7280] text-xs">
                    <th class="font-medium text-start py-3">Date</th>
                    <th class="font-medium text-start py-3">Time</th>
                    <th class="font-medium text-start py-3">Patient Name</th>
                    <th class="font-medium text-start py-3">Reason for Visit</th>
                </tr>
                @foreach ($fetchAppoinments as $record)
                    <tr class="border-b border-gray-300 text-sm text-[#111827]">
                        <td class="py-3">{{date("M d, Y", strtotime($record->appoinmentDate))}}</td>
                        <td class="py-3">{{$record->appoinmentTime}}</td>
                        <td class="py-3">{{$record->patientName}}</td>
                        <td class="py-3">{{$record->reasonForVisit}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </main>
    </div>
@endsection
