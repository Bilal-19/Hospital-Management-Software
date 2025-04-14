@extends('ReceptionistLayout.main')

@section('section')
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <div class="bg-white p-6 rounded shadow mb-10">
            <h2 class="text-xl font-semibold mb-4">Register New Patient</h2>
        </div>

        <form action="{{route("Doctor.CreatePatientProfile")}}" method="POST" autocomplete="off">
            @csrf
            <div class="w-full space-y-1 md:space-y-0 grid md:grid-cols-2 gap-3">
                <div class="flex flex-col">
                    <label for="fullName">Full Name:</label>
                    <input required type="text" name="fullName" id="fullName" placeholder="Enter patient's full name"
                        class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none capitalize">
                </div>

                <div class="flex flex-col">
                    <label for="age">Age:</label>
                    <input required type="text" name="age" id="age" placeholder="Enter age"
                        class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none">
                </div>


                <div class="flex flex-col">
                    <label for="gender">Gender:</label>
                    <select required name="gender" id="gender"
                        class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none capitalize">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>

                <div class="flex flex-col">
                    <label for="emailAddress">Email Address:</label>
                    <input required type="email" name="emailAddress" id="emailAddress" placeholder="Enter email address"
                        class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none">
                </div>

                <div class="flex flex-col">
                    <label for="phoneNumber">Phone Number:</label>
                    <input required type="text" name="phoneNumber" id="phoneNumber" placeholder="Enter phone number"
                        class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none">
                </div>


                <div class="flex flex-col">
                    <label for="reasonForVisit">Reason for Visit:</label>
                    <input required type="text" name="reasonForVisit" id="reasonForVisit" placeholder="Enter reason for your visit"
                        class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none">
                </div>

                <div class="flex flex-col">
                    <label for="medicalHistory">Medical History:</label>
                    <textarea required name="medicalHistory" id="medicalHistory" rows="5" placeholder="Enter relevant medical history"
                        class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none resize-none">
                    </textarea>
                </div>


            </div>
            <button class="bg-black text-white px-3 py-1 rounded-md mt-5">Register Patient</button>
        </form>
    </main>
    </div>
@endsection
