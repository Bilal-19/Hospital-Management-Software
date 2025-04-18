@extends('AdminLayout.main')
@section('section')
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <div class="w-full mt-5">
            <div class="overflow-x-auto bg-white rounded p-6">
                <h2 class="text-xl font-semibold mb-4">Staff Attendance</h2>
                <table class="min-w-max md:w-full">
                    <tr class="border-b border-gray-500">
                        <th class="p-3">ID</th>
                        <th class="p-3">Name</th>
                        <th class="p-3">Email</th>
                        <th class="p-3">Date</th>
                        <th class="p-3">Time</th>
                    </tr>
                    @foreach ($fetchStaffAttendance as $record)
                        <tr class="border-b border-gray-300">
                            <td class="p-3">{{ $record->id }}</td>
                            <td class="p-3">{{ $record->name }}</td>
                            <td class="p-3">{{ $record->email }}</td>
                            <td class="p-3">{{ date('d M Y', strtotime($record->created_at)) }}</td>
                            <td class="p-3">{{ date('h:i:sa', strtotime($record->created_at)) }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </main>
    </div>
@endsection
