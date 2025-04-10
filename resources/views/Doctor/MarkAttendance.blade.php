@extends('DoctorLayout.main')

@section('section')
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-4">Mark Attendance</h2>


            <form action="{{ route('Doctor.MarkPresent') }}" method="POST">
                @csrf
                <div class="w-full mt-5 grid grid-cols-1 md:grid-cols-3 md:gap-5 space-y-3 md:space-y-0">
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
        </div>

        <div class="w-full bg-white rounded shadow p-6 mt-10">
            <h3 class="text-lg font-semibold mb-4">My Previous Attendance</h3>
            <table class="w-full">
                <tr class="border-b border-gray-500 text-[#6B7280] text-xs">
                    <th class="font-medium text-start py-3">Date</th>
                    <th class="font-medium text-start py-3">Logged In Time</th>
                </tr>
                @foreach ($fetchMyAttendance as $record)
                    <tr class="border-b border-gray-300 text-sm text-[#111827]">
                        <td class="py-3">{{date("M d, Y", strtotime($record->date))}}</td>
                        <td class="py-3">{{$record->time}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </main>
    </div>
@endsection
