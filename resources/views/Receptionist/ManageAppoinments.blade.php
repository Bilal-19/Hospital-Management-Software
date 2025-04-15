@extends('ReceptionistLayout.main')

@section('section')
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <div class="w-80 md:w-full bg-white rounded shadow p-6 mb-10">
            <h3 class="text-lg font-semibold mb-4">Book Appoinment</h3>

            <form action="{{ route('Receptionist.CreateAppoinment') }}" method="post" autocomplete="off">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <div class="flex flex-col">
                        <label for="department">Department:</label>
                        <select name="department" id="department" required
                            class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none capitalize">
                            @php
                                $departmentArr = [
                                    'Cardiology',
                                    'Neurology',
                                    'Pediatrics',
                                    'Orthopedics',
                                    'Dermatology',
                                    'General Medicine',
                                ];
                            @endphp
                            @foreach ($departmentArr as $value)
                                <option value="{{ $value }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex flex-col">
                        <label for="doctor">Doctor:</label>
                        <select name="doctor" id="doctor" required
                            class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none capitalize">
                            @foreach ($fetchDoctorName as $value)
                                <option value="{{ $value }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex flex-col">
                        <label for="date">Date:</label>
                        <input type="text" required name="appoinmentDate" placeholder="Select appoinment date"
                            onfocus="(this.type='date')"
                            class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none">
                    </div>

                    <div class="flex flex-col">
                        <label for="appoinmentTime">Available Time Slot:</label>
                        <select name="appoinmentTime" required id="appoinmentTime"
                            class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none capitalize">
                            @php
                                $timeSlotArr = [
                                    '9:00 AM',
                                    '9:30 AM',
                                    '10:00 AM',
                                    '10:30 AM',
                                    '11:00 AM',
                                    '11:30 AM',
                                    '12:00 PM',
                                    '12:30 PM',
                                    '2:00 PM',
                                    '2:30 PM',
                                    '3:00 PM',
                                ];
                            @endphp
                            @foreach ($timeSlotArr as $value)
                                <option value="{{ $value }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex flex-col">
                        <label for="patientName">Patient Name:</label>
                        <select name="patientName" id="patientName" required
                            class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none capitalize">
                            @foreach ($fetchPatientName as $value)
                                <option value="{{ $value }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex flex-col">
                        <label for="reasonForVisit">Reason for Visit:</label>
                        <input type="text" required name="reasonForVisit" placeholder="Enter patient name"
                            class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none">
                    </div>
                </div>
                <button
                    class="w-full bg-black text-white py-2 rounded-md mt-5 hover:transform duration-500 hover:bg-black/90">Book
                    Now</button>
            </form>
        </div>

        <div class="w-full bg-white rounded shadow p-6">
            <div class="flex flex-row justify-between items-center mb-5">
                <div>
                    <h3 class="text-lg font-semibold">Upcoming Appoinments</h3>
                    @if (count($fetchAppoinments) == 0)
                        <p class="text-gray-700 text-sm">No records found</p>
                    @else
                        <p class="text-gray-700 text-sm">{{ count($fetchAppoinments) }} records found</p>
                    @endif
                </div>
                <div>
                    <a href="{{ route('Receptionist.AllAppoinments') }}"
                        class="bg-black text-white px-3 py-2 rounded-md">View All Appointments</a>
                </div>
            </div>
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
                        <td class="py-3">{{ date('M d, Y', strtotime($record->appointmentDate)) }}
                            {{ $record->appointmentTime }}</td>
                        <td class="py-3">{{ $record->doctorName }}</td>
                        <td class="py-3">{{ $record->department }}</td>
                        <td class="py-3">{{ $record->patientName }}</td>
                        <td class="py-3">{{ $record->reasonForVisit }}</td>
                        <td class="py-3">
                            <a href="" class="font-medium text-black mr-3">Reschedule</a>
                            <a href="{{ route('Receptionist.CancelAppointment', ['id' => $record->id]) }}"
                                class="font-medium text-[#DC2626]">Cancel</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </main>
@endsection
