@extends('DoctorLayout.main')

@section('section')
    <!-- Main Content -->
    <main class="flex-1 p-6 overflow-x-auto">
        <div class="w-full bg-white rounded shadow p-6 mt-5">
            <h3 class="text-lg font-semibold">All Appointments</h3>
            <p class="text-gray-500 text-sm">{{count($fetchAppoinments)}} records found</p>
            <form action="{{route("Doctor.AllAppoinments")}}" method="get" class="w-full flex flex-col md:flex-row md:space-x-2 my-5 space-y-2 md:space-y-0" autocomplete="off">
                <input type="text" name="search" placeholder="Search by patient name, reason for visit"
                    class="border border-[#9CA3AF] rounded-md p-1 focus:outline-none w-70 md:w-4/5 text-sm">
                <button class="w-70 md:w-1/5 bg-black text-white rounded-md">Search</button>
            </form>
            <div class="overflow-x-auto">
                <table class="min-w-max md:w-full">
                    <tr class="border-b border-gray-500 text-[#6B7280] text-xs">
                        <th class="font-medium text-start p-3">Date</th>
                        <th class="font-medium text-start p-3">Time</th>
                        <th class="font-medium text-start p-3">Patient Name</th>
                        <th class="font-medium text-start p-3">Department</th>
                        <th class="font-medium text-start p-3">Reason for Visit</th>
                        <th class="font-medium text-start p-3">Actions</th>
                    </tr>
                    @foreach ($fetchAppoinments as $record)
                        <tr class="border-b border-gray-300 text-sm text-[#111827]">
                            <td class="p-3">{{ date('M d, Y', strtotime($record->appointmentDate)) }}</td>
                            <td class="p-3">{{ date("h:i:sa", strtotime($record->appointmentTime)) }}</td>
                            <td class="p-3">{{ $record->patientName }}</td>
                            <td class="p-3">{{ $record->department }}</td>
                            <td class="p-3">{{ $record->reasonForVisit }}</td>
                            <td class="p-3">
                                <a href="{{ route('Doctor.AddDiagnosNote', ['id' => $record->id]) }}"
                                    class="bg-black text-white px-2 py-2 rounded-md">
                                    <i class="fa-solid fa-notes-medical"></i> Add Notes
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
                <p class="my-5">{{$fetchAppoinments}}</p>
            </div>
        </div>
    </main>
    </div>
@endsection
