@extends('AdminLayout.main')
@section('section')
    <!-- Main Content -->
    <main class="flex-1 p-3 md:p-6 overflow-x-auto">
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
            <div class="overflow-x-auto">
                <table class="min-w-max md:w-full">
                    <tr class="border-b border-gray-500 text-[#6B7280] text-xs">
                        <th class="font-medium text-start p-3">ID</th>
                        <th class="font-medium text-start p-3">Staff Name</th>
                        <th class="font-medium text-start p-3">Start Date</th>
                        <th class="font-medium text-start p-3">End Date</th>
                        <th class="font-medium text-start p-3">Applicable Days</th>
                        <th class="font-medium text-start p-3">Assigned By</th>
                        <th class="font-medium text-start p-3">Status</th>
                    </tr>
                    @foreach ($fetchAllStaffShift as $record)
                        <tr class="border-b border-gray-300 text-sm text-[#111827]">
                            <td class="p-3">{{ $record->id }}</td>
                            <td class="p-3">{{ $record->staffName }}</td>
                            <td class="p-3">
                                {{ date('d-M-Y', strtotime($record->startDate)) }}
                            </td>
                            <td class="p-3">
                                {{ date('d-M-Y', strtotime($record->endDate)) }}
                            </td>
                            <td class="p-3">{{ $record->applicableDays }}</td>
                            <td class="p-3">{{ $record->assignedBy }}</td>
                            <td class="p-3">{{ $record->status }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </main>
    </div>
@endsection
