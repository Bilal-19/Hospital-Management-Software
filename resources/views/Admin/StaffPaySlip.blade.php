@extends('AdminLayout.main')
@section('section')
    <!-- Main Content -->
    <main class="flex-1 p-6">

        <div class="bg-white p-6 rounded shadow mt-5">
            <h2 class="text-xl font-semibold mb-5">Employees Pay Slip</h2>
            <table class="w-80 md:w-full">
                <tr class="border-b border-gray-500 text-[#6B7280] text-xs">
                    <th class="font-medium text-start py-3">Staff ID</th>
                    <th class="font-medium text-start py-3">Staff Name</th>
                    <th class="font-medium text-start py-3">Role</th>
                    <th class="font-medium text-start py-3">Email</th>
                    <th class="font-medium text-start py-3">Amount Paid</th>
                    <th class="font-medium text-start py-3">Actions</th>
                </tr>
                @foreach ($fetchSalaryRecords as $record)
                    <tr class="border-b border-gray-300 text-sm text-[#111827]">
                        <td class="py-3">EMP-{{ $record->id }}</td>
                        <td class="py-3">{{ $record->name }}</td>
                        <td class="py-3">{{ $record->role }}</td>
                        <td class="py-3">{{ $record->email }}</td>
                        <td class="py-3">{{ $record->grossEarning }} PKR</td>
                        <td class="py-3">
                            <a href="{{route("Admin.DownloadSlip", ["id" => $record->id])}}">Download Slip</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </main>
    </div>
@endsection
