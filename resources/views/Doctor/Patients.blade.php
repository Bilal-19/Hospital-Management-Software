@extends('DoctorLayout.main')

@section('section')
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <div class="bg-white p-6 rounded shadow flex flex-col md:flex-row justify-between md:items-center">
            <div>
                <h2 class="text-xl font-semibold md:mb-4">Patients</h2>
                <p class="text-gray-600 capitalize mb-5 md:mb-0">40 records found</p>
            </div>
            <div>
                <a href="{{route("Doctor.AddPatient")}}" class="bg-black text-white px-3 py-2 rounded-md"><i class="fa-solid fa-user-plus"></i> Add
                    New Patient</a>
            </div>
        </div>

        <div class="w-full mt-10">
            <div class="w-1/2 bg-white p-6 rounded shadow overflow-auto">
                <h4 class="text-lg mb-4 font-bold text-center">Upcomming Appointments</h4>
                <table>
                    <tr>
                        <th class="border border-slate-400 p-3">Patient Name</th>
                        <th class="border border-slate-400 p-3">Appointment Time</th>
                        <th class="border border-slate-400 p-3">Reason for Visit</th>
                        <th class="border border-slate-400 p-3">Actions</th>
                    </tr>
                    <tr>
                        <td class="border border-slate-400 p-3">Raza</td>
                        <td class="border border-slate-400 p-3">10:00 AM</td>
                        <td class="border border-slate-400 p-3">Follow-up for Diabetes</td>
                        <td class="border border-slate-400 p-3">✏️ Edit</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-400 p-3">Sana Khan</td>
                        <td class="border border-slate-400 p-3">10:30 AM</td>
                        <td class="border border-slate-400 p-3">Chest Pain</td>
                        <td class="border border-slate-400 p-3">✏️ Edit</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-400 p-3">Ahmed Malik </td>
                        <td class="border border-slate-400 p-3">11:00 AM</td>
                        <td class="border border-slate-400 p-3">Blood Pressure Check</td>
                        <td class="border border-slate-400 p-3">✏️ Edit</td>
                    </tr>
                    <tr>
                        <td class="border border-slate-400 p-3">Fatima Noor</td>
                        <td class="border border-slate-400 p-3">11:30 AM</td>
                        <td class="border border-slate-400 p-3">Routine Checkup</td>
                        <td class="border border-slate-400 p-3">✏️ Edit</td>
                    </tr>
                </table>
            </div>
        </div>
    </main>
    </div>
@endsection
