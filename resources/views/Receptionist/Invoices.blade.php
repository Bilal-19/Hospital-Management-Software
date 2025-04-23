@extends('ReceptionistLayout.main')

@section('section')
    <!-- Main Content -->
    <main class="flex-1 p-6 overflow-x-auto">
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold">All Invoices</h2>
            <p class="text-sm text-gray-500">{{ count($fetchBillHistory) }} record found</p>
            <form action="{{route('Receptionist.GetInvoices')}}" method="get" class="my-5">
                <div class="w-full flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-4">
                    <input required name="invoiceDate" type="text" placeholder="Select Date" onfocus="(this.type='date')" class="w-75 md:w-1/4 bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none">
                    <input required name="patientName" type="text" placeholder="Patient Name" class="w-75 md:w-1/4 bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none">
                    <input required name="doctorName" type="text" placeholder="Doctor Name" class="w-75 md:w-1/4 bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none">
                    <button class="w-75 md:w-1/4 px-3 py-1 rounded bg-black text-white">Search</button>
                </div>
            </form>
            <div class="overflow-x-auto">
                <table class="min-w-max md:w-full">
                    <tr class="border-b border-gray-500 text-[#6B7280] text-xs">
                        <th class="p-3">Date</th>
                        <th class="p-3">Invoice No</th>
                        <th class="p-3">Patient</th>
                        <th class="p-3">Doctor</th>
                        <th class="p-3">Amount</th>
                        <th class="p-3">Status</th>
                        <th class="p-3">Actions</th>
                    </tr>
                    @foreach ($fetchBillHistory as $record)
                        <tr class="border-b border-gray-300 text-sm text-[#111827]">
                            <td class="p-3">{{ date('M d, Y', strtotime($record->created_at)) }}</td>
                            <td class="p-3">INV-{{ $record->id }}</td>
                            <td class="p-3">{{ $record->patientName }}</td>
                            <td class="p-3">{{ $record->doctorName }}</td>
                            <td class="p-3">${{ $record->totalAmount }}</td>
                            <td class="p-3">
                                @if ($record->status == 'Paid')
                                    <p class="text-[#166534] font-semibold">{{ $record->status }}</p>
                                @else
                                    <p class="text-[#854D0E] font-semibold">{{ $record->status }}</p>
                                @endif
                            </td>
                            <td class="p-3">
                                <a href="" class="font-medium text-black mr-3">
                                    <i class="fa-solid fa-file-arrow-down"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
                <p class="my-5">{{$fetchBillHistory}}</p>
            </div>
        </div>
    </main>
    </div>


@endsection
