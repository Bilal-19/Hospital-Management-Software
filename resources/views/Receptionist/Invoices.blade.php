@extends('ReceptionistLayout.main')

@section('section')
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold">All Invoices</h2>
            <p class="text-sm text-black/80 mb-10">{{ count($fetchBillHistory) }} records found</p>
            <table class="w-80 md:w-full">
                <tr class="border-b border-gray-500 text-[#6B7280] text-xs">
                    <th class="font-medium text-start py-3">Date</th>
                    <th class="font-medium text-start py-3">Invoice No</th>
                    <th class="font-medium text-start py-3">Patient</th>
                    <th class="font-medium text-start py-3">Doctor</th>
                    <th class="font-medium text-start py-3">Amount</th>
                    <th class="font-medium text-start py-3">Status</th>
                    <th class="font-medium text-start py-3">Actions</th>
                </tr>
                @foreach ($fetchBillHistory as $record)
                    <tr class="border-b border-gray-300 text-sm text-[#111827]">
                        <td class="py-3">{{ date('M d, Y', strtotime($record->created_at)) }}</td>
                        <td class="py-3">INV-{{ $record->id }}</td>
                        <td class="py-3">{{ $record->patientName }}</td>
                        <td class="py-3">{{ $record->doctorName }}</td>
                        <td class="py-3">${{ $record->totalAmount }}</td>
                        <td class="py-3">
                            @if ($record->status == 'Paid')
                                <p class="text-[#166534] font-semibold">{{ $record->status }}</p>
                            @else
                                <p class="text-[#854D0E] font-semibold">{{ $record->status }}</p>
                            @endif
                        </td>
                        <td class="py-3">
                            <a href="" class="font-medium text-black mr-3">
                                <i class="fa-solid fa-file-arrow-down"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </main>
    </div>

    @push('custom-js-script')
        <script>
            const totalAmountEl = document.getElementById("totalAmount")

            function calculateBillRealTime(changeElementID) {
                document.getElementById(changeElementID).addEventListener("change", () => {
                    const total = Number(document.getElementById("serviceAmount").value) +
                        Number(document.getElementById("testCost").value) +
                        Number(document.getElementById("medicinePrice").value);
                    totalAmountEl.innerText = `$${total}`;
                })
            }

            calculateBillRealTime("serviceAmount")
            calculateBillRealTime("testCost")
            calculateBillRealTime("medicinePrice")
        </script>
    @endpush
@endsection
