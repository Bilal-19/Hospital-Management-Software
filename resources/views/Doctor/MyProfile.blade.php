@extends('DoctorLayout.main')

@section('section')
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-4">My Profile</h2>


        <form action="{{ route('Doctor.UpdateProfile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <h4 class="text-lg font-semibold my-4">Personal Information</h4>
            <img src="{{asset("Doctors/Profile/".$fetchRecord->profilePicture)}}" alt="my-profile" class="size-32 my-5 object-cover rounded-full">
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

                <div class="flex flex-col">
                    <label>Available Days:</label>
                    <input type="text" readonly value="{{$myShift->applicableDays}}" class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none">
                </div>

            </div>
            <button class="bg-black text-white px-3 py-1 rounded-md mt-5">Update Profile</button>
        </form>
    </div>
    </main>
    </div>
@endsection
