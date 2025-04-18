@extends('AdminLayout.main')
@section('section')
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <div class="w-full mt-5">
            <div class="overflow-x-auto bg-white rounded p-6">
                <h2 class="text-xl font-semibold">Staff Attendance</h2>
                <p class="text-sm text-gray-500">
                    @if (count($fetchStaffAttendance) >= 1)
                        {{ count($fetchStaffAttendance) }} records found
                    @else
                        No records found
                    @endif
                </p>
                <form action="{{ route('Admin.StaffAttendance') }}" method="get" class="my-5 text-sm" autocomplete="off">
                    <div class="md:w-full flex flex-col md:flex-row md:space-x-4">
                        <input name="employeeName" type="text" placeholder="Employee Name"
                            class="border border-[#9CA3AF] rounded-md p-1 focus:outline-none w-80 md:w-2/5">
                        <input name="startDate" type="text" placeholder="Start date" onfocus="(this.type='date')"
                            class="border border-[#9CA3AF] rounded-md p-1 focus:outline-none w-80 md:w-2/5">
                        <input name="endDate" type="text" placeholder="End Date" onfocus="(this.type='date')"
                            class="border border-[#9CA3AF] rounded-md p-1 focus:outline-none w-80 md:w-2/5">
                        <button
                            class="border border-[#9CA3AF] rounded-md px-3 py-1 bg-black text-white w-80 md:w-1/5">Search</button>
                    </div>
                </form>
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
