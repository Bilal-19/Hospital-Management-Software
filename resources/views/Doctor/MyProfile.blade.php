@extends('DoctorLayout.main')

@section('section')
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-4">My Profile</h2>
        </div>

        <form action="{{ route('Doctor.UpdateProfile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <h4 class="text-lg font-semibold my-4">Personal Information</h4>
            <div class="w-full grid grid-cols-1 md:grid-cols-3 gap-5 space-y-1 md:space-y-0">
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
                    <label for="profilePicture">Profile Picture (Optional):</label>
                    <input type="file" name="profilePicture" id="profilePicture"
                        class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none capitalize">
                </div>

                <div class="flex flex-col">
                    <label for="dateOfBirth">Date of Birth:</label>
                    <input type="date" name="dateOfBirth" id="dateOfBirth" value="{{ $fetchRecord->dateOfBirth }}"
                        class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none">
                </div>

                <div class="flex flex-col">
                    <label for="emailAddress">Email Address:</label>
                    <input type="email" name="emailAddress" id="emailAddress" value="{{ $fetchRecord->emailAddress }}" readonly
                        class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none">
                </div>

                <div class="flex flex-col">
                    <label for="phoneNumber">Phone Number:</label>
                    <input type="text" name="phoneNumber" id="phoneNumber" value="{{ $fetchRecord->phoneNumber }}"
                        class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none">
                </div>

                <div class="flex flex-col">
                    <label for="department">Department:</label>
                    <select name="department" id="department"
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
                            <option value="{{ $value }}" {{$fetchRecord->department == $value ? "selected" : ""}}>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex flex-col">
                    <label for="yearsOfExperience">Years of Experience:</label>
                    <select name="yearsOfExperience" id="yearsOfExperience"
                        class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none capitalize">
                        @for ($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}" {{$fetchRecord->yearsOfExperience == $i ? "selected" : ""}}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>

                <div class="flex flex-col">
                    <label for="licenseNumber">License Number:</label>
                    <input type="text" name="licenseNumber" id="licenseNumber" value="{{$fetchRecord->licenseNumber}}"
                        class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none">
                </div>

                <div class="flex flex-col">
                    <label for="consultationFee">Consultation Fee:</label>
                    <input type="number" name="consultationFee" id="consultationFee" value="{{$fetchRecord->consultationFee}}"
                        class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none">
                </div>

                <div class="flex flex-col">
                    <label for="status">Status:</label>
                    <select name="status" id="status"
                        class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none capitalize">
                        <option value="Available" {{ $fetchRecord->status == "Available" ? "selected" : "" }}>Available</option>
                        <option value="Unavailable" {{ $fetchRecord->status == "Unavailable" ? "selected" : "" }}>Unavailable</option>
                    </select>
                </div>

                <div class="flex flex-col justify-center">
                    <p>Available Days:</p>
                    <div class="flex flex-row justify-between">
                        <div>
                            <span class="flex flex-row">
                                <input type="checkbox" name="Monday" id="Monday" class="mr-2" {{$fetchRecord->availableOnMon == "on" ? "checked" : ""}}>
                                <label for="Monday">Monday</label>
                            </span>

                            <span class="flex flex-row">
                                <input type="checkbox" name="Tuesday" id="Tuesday" class="mr-2" {{$fetchRecord->availableOnTue == "on" ? "checked" : ""}}>
                                <label for="Tuesday">Tuesday</label>
                            </span>

                            <span class="flex flex-row">
                                <input type="checkbox" name="Wednesday" id="Wednesday" class="mr-2" {{$fetchRecord->availableOnWed == "on" ? "checked" : ""}}>
                                <label for="Wednesday">Wednesday</label>
                            </span>
                        </div>
                        <div>
                            <span class="flex flex-row">
                                <input type="checkbox" name="Monday" id="Thursday" class="mr-2" {{$fetchRecord->availableOnThurs == "on" ? "checked" : ""}}>
                                <label for="Thursday">Thursday</label>
                            </span>

                            <span class="flex flex-row">
                                <input type="checkbox" name="Friday" id="Friday" class="mr-2" {{$fetchRecord->availableOnFri == "on" ? "checked" : ""}}>
                                <label for="Friday">Friday</label>
                            </span>

                            <span class="flex flex-row">
                                <input type="checkbox" name="Saturday" id="Saturday" class="mr-2" {{$fetchRecord->availableOnSat == "on" ? "checked" : ""}}>
                                <label for="Saturday">Saturday</label>
                            </span>
                        </div>
                    </div>



                </div>

            </div>
            <button class="bg-black text-white px-3 py-1 rounded-md mt-5">Update Profile</button>
        </form>
    </main>
    </div>
@endsection
