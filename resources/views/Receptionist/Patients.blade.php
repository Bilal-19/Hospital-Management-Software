@extends('ReceptionistLayout.main')

@section('section')
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <div class="bg-white p-6 rounded shadow flex flex-col md:flex-row justify-between md:items-center">
            <div>
                <h2 class="text-xl font-semibold">Patients</h2>
                <p class="text-gray-600 mb-5 md:mb-0 text-sm">{{$countRecords}} records found</p>
            </div>
            <div>
                <a href="{{ route('Receptionist.AddPatient') }}" class="bg-black text-white px-3 py-2 rounded-md"><i
                        class="fa-solid fa-user-plus"></i> Add
                    New Patient</a>
            </div>
        </div>

        <div class="w-full mt-10 bg-white p-6 rounded shadow overflow-auto">
            <table class="w-full">
                <tr class="border-b border-gray-500 text-[#6B7280] text-xs">
                    <th class="font-medium text-start py-3">Patient Name</th>
                    <th class="font-medium text-start py-3">Age</th>
                    <th class="font-medium text-start py-3">Contact Number</th>
                    <th class="font-medium text-start py-3">Reason for Visit</th>
                    <th class="font-medium text-start py-3">Gender</th>
                    <th class="font-medium text-start py-3">Actions</th>
                </tr>
                @foreach ($fetchRecords as $record)
                    <tr class="border-b border-gray-300 text-sm text-[#111827]">
                        <td class="py-3">{{ $record->fullName }}</td>
                        <td class="py-3">{{ $record->age }}</td>
                        <td class="py-3">{{ $record->phoneNumber }}</td>
                        <td class="py-3">{{ $record->reasonForVisit }}</td>
                        <td class="py-3">{{ $record->gender }}</td>
                        <td class="py-3 space-x-2">
                            <a href="" class="text-blue-700"><i class="fa-solid fa-user-pen"></i></a>
                            <a href="" class="text-red-700"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </main>
    </div>
@endsection
