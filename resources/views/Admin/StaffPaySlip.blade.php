@extends('AdminLayout.main')
@section('section')
    <!-- Main Content -->
    <main class="flex-1 p-6 overflow-x-auto">

        <div class="bg-white p-6 rounded shadow mt-5">
            <h2 class="text-xl font-semibold">Employees Pay Slip</h2>
            <p class="text-gray-500 text-sm">{{count($fetchSalaryRecords)}} records found</p>
            <form action="{{route("Admin.EmployeePaySlip")}}" class="w-full flex flex-row space-x-2 my-5" autocomplete="off" method="get">
                <input type="text" name="search" placeholder="Search by name, email or role"
                    class="border border-[#9CA3AF] rounded-md p-1 focus:outline-none w-4/5">
                <button class="w-1/5 bg-black text-white rounded-md">Search</button>
            </form>
            <div class="overflow-x-auto">
                <table class="min-w-max md:w-full ">
                    <tr class="border-b border-gray-500 text-[#6B7280] text-xs">
                        <th class="font-medium text-start py-3 px-3">ID</th>
                        <th class="font-medium text-start py-3 px-3">Name</th>
                        <th class="font-medium text-start py-3 px-3">Role</th>
                        <th class="font-medium text-start py-3 px-3">Email</th>
                        <th class="font-medium text-start py-3 px-3">Amount Paid</th>
                        <th class="font-medium text-start py-3 px-3">Paid On</th>
                        <th class="font-medium text-start py-3 px-3">Actions</th>
                    </tr>
                    @foreach ($fetchSalaryRecords as $record)
                        <tr class="border-b border-gray-300 text-sm text-[#111827]">
                            <td class="py-3 px-3">EMP-{{ $record->id }}</td>
                            <td class="py-3 px-3">{{ $record->name }}</td>
                            <td class="py-3 px-3">{{ $record->role }}</td>
                            <td class="py-3 px-3">{{ $record->email }}</td>
                            <td class="py-3 px-3">{{ $record->grossEarning }} USD</td>
                            <td class="py-3 px-3">{{ date('d M Y', strtotime($record->created_at)) }}</td>
                            <td class="py-3 px-3">
                                <a href="{{ route('Admin.DownloadSlip', ['id' => $record->id]) }}"
                                    class="bg-blue-600 text-white px-3 py-2 rounded hover:bg-blue-800">
                                    <i class="fa-solid fa-file-arrow-down"></i>
                                    Download Slip
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </main>
    </div>
@endsection
