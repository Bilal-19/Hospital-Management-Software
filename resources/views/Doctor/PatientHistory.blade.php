@extends('DoctorLayout.main')

@section('section')
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <div class="w-full bg-white rounded shadow p-6 mt-5">
            <h3 class="text-lg font-semibold mb-4">Patient Visit History</h3>

            <table class="w-full">
                <tr class="border-b border-gray-500">
                    <th class="py-3">Date</th>
                    <th class="py-3">Visit Reason</th>
                    <th class="py-3">Diagnosis</th>
                    <th class="py-3">Medicine</th>
                    <th class="py-3">Symptoms</th>
                </tr>
                @foreach ($findAppointmentHistory as $record)
                    <tr class="border-b border-gray-300">
                        <td class="py-3">{{ $record->appoinmentDate }}</td>
                        <td class="py-3">{{ $record->reasonForVisit }}</td>
                        <td class="py-3">{{ $record->diagnosis }}</td>
                        <td class="py-3">{{ $record->medicine }}</td>
                        <td class="py-3">{{ $record->symptoms }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </main>
    </div>
@endsection
