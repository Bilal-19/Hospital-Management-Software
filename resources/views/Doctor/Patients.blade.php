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
                <a href="{{ route('Doctor.AddPatient') }}" class="bg-black text-white px-3 py-2 rounded-md"><i
                        class="fa-solid fa-user-plus"></i> Add
                    New Patient</a>
            </div>
        </div>

        <div class="w-full mt-10 bg-white p-6 rounded shadow overflow-auto">

                <table class="w-full">
                    <tr>
                        <th class="border border-slate-400 p-3">Patient Name</th>
                        <th class="border border-slate-400 p-3">Age</th>
                        <th class="border border-slate-400 p-3">Reason for Visit</th>
                        <th class="border border-slate-400 p-3">Gender</th>
                    </tr>
                    @foreach ($fetchRecords as $record)
                        <tr>
                            <td class="border border-slate-400 p-3">{{$record->fullName}}</td>
                            <td class="border border-slate-400 p-3">{{$record->age}}</td>
                            <td class="border border-slate-400 p-3">{{$record->reasonForVisit}}</td>
                            <td class="border border-slate-400 p-3">{{$record->gender}}</td>
                        </tr>
                    @endforeach
                </table>
        </div>
    </main>
    </div>
@endsection
