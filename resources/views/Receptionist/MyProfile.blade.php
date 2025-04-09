@extends('ReceptionistLayout.main')

@section('section')
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-4">My Profile</h2>
        </div>

        <form action="{{route("Receptionist.UpdateProfile")}}" method="post" autocomplete="off">
            @csrf
            <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-5 space-y-1 md:space-y-0 mt-10">
                <div class="flex flex-col">
                    <label for="fullName">Full Name:</label>
                    <input type="text" name="fullName" id="fullName" value="{{ $fetchRecord->fullName }}"
                        class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none capitalize">
                </div>

                <div class="flex flex-col">
                    <label for="gender">Gender:</label>
                    <select name="gender" id="gender"
                        class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none capitalize">
                        <option value="Male" {{ $fetchRecord->gender == "Male" ? "selected" : "" }}>Male</option>
                        <option value="Female" {{ $fetchRecord->gender == "Female" ? "selected" : "" }}>Female</option>
                    </select>
                </div>

                <div class="flex flex-col">
                    <label for="emailAddress">Email Address:</label>
                    <input type="email" name="emailAddress" id="emailAddress" value="{{ $fetchRecord->emailAddress }}"
                        class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none">
                </div>

                <div class="flex flex-col">
                    <label for="phoneNumber">Phone Number:</label>
                    <input type="text" name="phoneNumber" id="phoneNumber" value="{{ $fetchRecord->phoneNumber }}"
                        class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none">
                </div>

                <div class="flex flex-col">
                    <label for="assignedDepartment">Assigned Department:</label>
                    <select name="assignedDepartment" id="assignedDepartment"
                        class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none capitalize">
                        @php
                            $departmentArr = [
                                'Front Desk',
                                'OPD',
                                'Emergency',
                                'General Medicine'
                            ];
                        @endphp
                        @foreach ($departmentArr as $value)
                            <option value="{{ $value }}" {{$fetchRecord->assignedDepartment == $value ? "selected" : ""}}>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex flex-col">
                    <label for="shiftTiming">Shift Timing:</label>
                    <select name="shiftTiming" id="shiftTiming"
                        class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none capitalize">
                        @php
                            $staffShiftArr = [
                                '9 AM - 5 PM',
                                '10 AM - 6 PM'
                            ];
                        @endphp
                        @foreach ($staffShiftArr as $value)
                            <option value="{{ $value }}" {{$fetchRecord->shiftTiming == $value ? "selected" : ""}}>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex flex-col">
                    <label for="joiningDate">Joining Date::</label>
                    <input type="date" name="joiningDate" id="joiningDate" value="{{$fetchRecord->joiningDate}}"
                        class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none w-80">
                </div>

            </div>
            <button class="bg-black text-white px-3 py-1 rounded-md mt-5">Update Profile</button>
        </form>
    </main>
    </div>
@endsection
