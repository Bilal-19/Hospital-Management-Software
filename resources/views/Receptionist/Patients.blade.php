@extends('ReceptionistLayout.main')

@section('section')
    <!-- Main Content -->
    <main class="flex-1 p-6 overflow-x-auto">
        <div class="bg-white p-6 rounded shadow">
            <div class="flex flex-col md:flex-row justify-between md:items-center">
                <div>
                    <h2 class="text-xl font-semibold">Patients</h2>
                    <p class="text-gray-600 mb-5 md:mb-0 text-sm">{{ $countRecords }} records found</p>
                </div>
                <div>
                    <a href="{{ route('Receptionist.AddPatient') }}" class="bg-black text-white px-3 py-2 rounded-md"><i
                            class="fa-solid fa-user-plus"></i> Add
                        New Patient</a>
                </div>
            </div>

            <form action="{{route("Receptionist.AllPatients")}}" method="get" class="w-full flex flex-col md:flex-row md:space-x-2 my-5 space-y-2 md:space-y-0" autocomplete="off">
                <input type="text" name="search" placeholder="Search by patient name, reason for visit"
                    class="border border-[#9CA3AF] rounded-md p-1 focus:outline-none w-70 md:w-4/5 text-sm">
                <button class="w-70 md:w-1/5 bg-black text-white rounded-md">Search</button>
            </form>


            <div class="overflow-x-auto my-5">
                <table class="min-w-max md:w-full">
                    <tr class="border-b border-gray-500 text-[#6B7280] text-xs">
                        <th class="p-3">Patient Name</th>
                        <th class="p-3">Age</th>
                        <th class="p-3">Contact Number</th>
                        <th class="p-3">Reason for Visit</th>
                        <th class="p-3">Gender</th>
                    </tr>
                    @foreach ($fetchRecords as $record)
                        <tr class="border-b border-gray-300 text-sm text-[#111827]">
                            <td class="p-3">{{ $record->fullName }}</td>
                            <td class="p-3">{{ $record->age }}</td>
                            <td class="p-3">{{ $record->phoneNumber }}</td>
                            <td class="p-3">{{ $record->reasonForVisit }}</td>
                            <td class="p-3">{{ $record->gender }}</td>
                        </tr>
                    @endforeach
                </table>
                <p class="my-5">{{$fetchRecords}}</p>
            </div>
        </div>
    </main>
    </div>
@endsection
