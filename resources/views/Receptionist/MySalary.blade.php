@extends('ReceptionistLayout.main')

@section('section')
    <!-- Main Content -->
    <main class="flex-1 p-6 overflow-x-auto">
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-4">Monthly Salary</h2>
            <div class="overflow-x-auto">
                <table class="min-w-max md:w-full">
                    <tr class="border-b border-gray-500 text-[#6B7280] text-xs">
                        <th class="p-3">Employee ID</th>
                        <th class="p-3">Month</th>
                        <th class="p-3">Received On</th>
                        <th class="p-3">Total Earning</th>
                        <th class="p-3">Allowance</th>
                        <th class="p-3">Action</th>
                    </tr>
                    @foreach ($fetchSalaries as $record)
                        <tr class="border-b border-gray-300 text-sm text-[#111827]">
                            <td class="p-3">EMP-{{$record->employeeId}}</td>
                            <td class="p-3">{{$record->salaryMonth}}</td>
                            <td class="p-3">{{date("M d, Y", strtotime($record->created_at))}}</td>
                            <td class="p-3">{{$record->grossEarning}} PKR</td>
                            <td class="p-3">{{$record->houseRentAllowance + $record->travelAllowance + $record->medicalAllowance}} PKR</td>
                            <td class="p-3">
                                <a href="{{route("Admin.DownloadSlip", ["id" => $record->id])}}" class="bg-blue-600 text-white px-3 py-2 rounded hover:bg-blue-800">
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
