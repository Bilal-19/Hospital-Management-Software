@extends('ReceptionistLayout.main')

@section('section')
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <div class="bg-white p-6 rounded shadow mb-10">
            <h2 class="text-xl font-semibold mb-4">Manage Appoinments</h2>
            <p class="text-gray-600 capitalize">30 records found</p>
        </div>

        <div class="w-full mt-15 bg-white rounded shadow p-6">
            <h3 class="text-lg font-semibold mb-4">Book Appoinment</h3>

            <form action="{{route("Receptionist.CreateAppoinment")}}" method="post" autocomplete="off">
                @csrf
                <div class="grid md:grid-cols-2 gap-5">
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
                        <input type="text" required name="appoinmentDate" placeholder="Select appoinment date" onfocus="(this.type='date')" class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none">
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
                </div>
                <button class="w-full bg-emerald-700 text-white py-2 rounded-md mt-5">Book Now</button>
            </form>
        </div>
    </main>
@endsection
