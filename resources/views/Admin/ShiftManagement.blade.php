@extends('AdminLayout.main')
@section('section')
    <!-- Main Content -->
    <main class="flex-1">
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-10">Assign Shift to Staff</h2>

            <form action="{{ route('Admin.CreateShift') }}" class="w-full grid grid-cols-1 md:grid-cols-2 gap-x-5 gap-y-3"
                method="post">
                @csrf
                <div class="flex flex-col">
                    <label for="staffName">Select Staff Name:</label>
                    <select name="staffName"
                        class="bg-white px-3 py-1.5 rounded-md border border-slate-300 focus:outline-none">
                        @foreach ($fetchStaffList as $record)
                            <option value="{{ $record }}">{{ $record }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex flex-col">
                    <label for="startDate">Start Date:</label>
                    <input type="date" name="startDate"
                        class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none">
                </div>

                <div class="flex flex-col">
                    <label for="endDate">End Date:</label>
                    <input type="date" name="endDate"
                        class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none">
                </div>

                <div class="flex flex-col">
                    <label for="applicableDays">Applicable Days:</label>
                    <select name="applicableDays"
                        class="bg-white px-3 py-1.5 rounded-md border border-slate-300 focus:outline-none">
                        <option value="Monday to Friday">Monday to Friday</option>
                        <option value="Monday to Saturday">Monday to Saturday</option>
                    </select>
                </div>

                <div class="md:col-span-2 mt-3">
                    <button class="bg-black text-white px-3 py-2 rounded-md w-full">Create Staff Shift</button>
                </div>
            </form>
        </div>

        <div class="bg-white p-6 rounded shadow mt-5">
            <h2 class="text-xl font-semibold mb-5">Employees Shift</h2>
            <table class="w-80 md:w-full">
                <tr class="border-b border-gray-500 text-[#6B7280] text-xs">
                    <th class="font-medium text-start py-3">ID</th>
                    <th class="font-medium text-start py-3">Staff Name</th>
                    <th class="font-medium text-start py-3">Start Date</th>
                    <th class="font-medium text-start py-3">End Date</th>
                    <th class="font-medium text-start py-3">Applicable Days</th>
                    <th class="font-medium text-start py-3">Assigned By</th>
                    <th class="font-medium text-start py-3">Status</th>
                    <th class="font-medium text-start py-3">Actions</th>
                </tr>
                @foreach ($fetchAllStaffShift as $record)
                    <tr class="border-b border-gray-300 text-sm text-[#111827]">
                        <td class="py-3">{{ $record->id }}</td>
                        <td class="py-3">{{ $record->staffName }}</td>
                        <td class="py-3">
                            {{ date('d-M-Y', strtotime($record->startDate)) }}
                        </td>
                        <td class="py-3">
                            {{ date('d-M-Y', strtotime($record->endDate)) }}
                        </td>
                        <td class="py-3">{{ $record->applicableDays }}</td>
                        <td class="py-3">{{ $record->assignedBy }}</td>
                        <td class="py-3">{{ $record->status }}</td>
                        <td class="py-3">
                            <a href="">Update</a>
                            <a href="">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </main>
    </div>
@endsection
