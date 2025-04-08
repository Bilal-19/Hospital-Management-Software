@extends('DoctorLayout.main')

@section('section')
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-4">Mark Attendance</h2>
        </div>

        <form action="{{route("Doctor.MarkPresent")}}" method="POST">
            @csrf
            <div class="w-full mt-5 grid grid-cols-3 gap-5 space-y-3 md:space-y-0">
                <div class="flex flex-col">
                    <label for="doctorID">ID:</label>
                    <input type="number" name="doctorID" id="doctorID" readonly value="{{ Auth::user()->id }}"
                        class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none">
                </div>

                <div class="flex flex-col">
                    <label for="doctorName">Name:</label>
                    <input type="text" name="doctorName" id="doctorName" readonly value="{{ Auth::user()->name }}"
                        class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none capitalize">
                </div>

                <div class="flex flex-col">
                    <label for="doctorEmail">Email:</label>
                    <input type="email" name="doctorEmail" id="doctorEmail" readonly value="{{ Auth::user()->email }}"
                        class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none w-80">
                </div>

                <div class="flex flex-col">
                    <label for="currentDate">Date:</label>
                    <input type="date" name="currentDate" id="currentDate"
                        class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none w-80" required>
                </div>

                <div class="flex flex-col">
                    <label for="loggedIn">Time:</label>
                    <input type="time" name="loggedIn" id="loggedIn"
                        class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none w-80" required>
                </div>

                <div class="flex flex-col">
                    <label for="remarks">Notes / Remarks:</label>
                    <input type="text" name="remarks" id="remarks"
                        class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none w-80" required>
                </div>

            </div>
            <button class="bg-black text-white px-3 py-1 rounded-md mt-5">Mark Attendance</button>
        </form>
    </main>
    </div>
@endsection
