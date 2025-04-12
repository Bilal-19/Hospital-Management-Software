@extends('DoctorLayout.main')

@section('section')
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-4">Previous Attendance</h2>
            <table class="w-full">
                <tr class="border-b border-gray-500 text-[#6B7280] text-xs">
                    <th class="font-medium text-start py-3">Date</th>
                    <th class="font-medium text-start py-3">Logged In Time</th>
                </tr>
                @foreach ($fetchMyAttendance as $record)
                    <tr class="border-b border-gray-300 text-sm text-[#111827]">
                        <td class="py-3">{{date("M d, Y", strtotime($record->created_at))}}</td>
                        <td class="py-3">{{date("h:m:s a", strtotime($record->created_at))}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </main>
    </div>
@endsection
