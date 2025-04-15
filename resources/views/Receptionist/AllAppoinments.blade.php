@extends('ReceptionistLayout.main')

@section('section')
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <div class="w-full bg-white rounded shadow p-6">
            <h3 class="text-lg font-semibold mb-4">All Appoinments</h3>
            <table class="w-80 md:w-full">
                <tr class="border-b border-gray-500 text-[#6B7280] text-xs">
                    <th class="font-medium text-start py-3">Date & Time</th>
                    <th class="font-medium text-start py-3">Doctor</th>
                    <th class="font-medium text-start py-3">Department</th>
                    <th class="font-medium text-start py-3">Patient Name</th>
                    <th class="font-medium text-start py-3">Reason for Visit</th>
                    <th class="font-medium text-start py-3">Actions</th>
                </tr>
                @foreach ($fetchAppoinments as $record)
                    <tr class="border-b border-gray-300 text-sm text-[#111827]">
                        <td class="py-3">{{date("M d, Y", strtotime($record->appointmentDate))}} {{$record->appointmentTime}}</td>
                        <td class="py-3">{{$record->doctorName}}</td>
                        <td class="py-3">{{$record->department}}</td>
                        <td class="py-3">{{$record->patientName}}</td>
                        <td class="py-3">{{$record->reasonForVisit}}</td>
                        <td class="py-3">
                            <a href="" class="font-medium text-black mr-3">Reschedule</a>
                            <a href="{{route("Receptionist.CancelAppointment",["id"=>$record->id])}}" class="font-medium text-[#DC2626]">Cancel</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </main>
@endsection
