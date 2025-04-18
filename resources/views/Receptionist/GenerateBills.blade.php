@extends('ReceptionistLayout.main')

@section('section')
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-4">Generate Bill</h2>

            <form action="{{ route('Receptionist.CreateBill') }}" method="post" autocomplete="off">
                @csrf
                <div class="mt-5 grid grid-cols-1 md:grid-cols-3 gap-x-5 gap-y-2">
                    <div class="flex flex-col">
                        <label>Patient</label>
                        <select name="patientName"
                            class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none">
                            @foreach ($fetchPatientDirectory as $value)
                                <option value="{{ $value }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex flex-col">
                        <label>Doctor</label>
                        <select name="doctorName"
                            class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none">
                            @foreach ($fetchDoctors as $value)
                                <option value="{{ $value }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="paymentMode">Payment Mode:</label>
                        <div class="flex flex-row space-x-10">
                            <div class="flex flex-row mt-2">
                                <input type="radio" name="paymentMode"
                                    class="bg-white border border-slate-300 focus:outline-none mr-1 inline" value="Cash">
                                <label>Cash</label>
                            </div>

                            <div class="flex flex-row mt-2">
                                <input type="radio" name="paymentMode"
                                    class="bg-white border border-slate-300 focus:outline-none mr-1 inline" value="Credit">
                                <label>Credit</label>
                            </div>

                            <div class="flex flex-row mt-2">
                                <input type="radio" name="paymentMode"
                                    class="bg-white border border-slate-300 focus:outline-none mr-1 inline"
                                    value="Insurance">
                                <label>Insurance</label>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col col-span-3">
                        <label>Services</label>
                        <div class="w-full flex flex-row justify-between">
                            <input type="text" name="serviceName" placeholder="Service Description"
                                class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none md:w-2/3 mr-1">
                            <input type="number" name="serviceAmount" id="serviceAmount" placeholder="Amount"
                                class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none md:w-1/3">
                        </div>
                    </div>

                    <div class="flex flex-col col-span-3">
                        <label>Lab Tests</label>
                        <div class="w-full flex flex-row justify-between">
                            <input type="text" name="testName" placeholder="Test Name"
                                class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none md:w-2/3 mr-1">
                            <input type="number" name="testCost" placeholder="Cost" id="testCost"
                                class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none md:w-1/3">
                        </div>
                    </div>

                    <div class="flex flex-col col-span-3">
                        <label>Medicines</label>
                        <div class="w-full flex flex-row justify-between">
                            <input type="text" name="medicineName" placeholder="Medicine Name"
                                class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none md:w-2/3 mr-1">
                            <input type="number" name="medicinePrice" placeholder="Total Price" id="medicinePrice"
                                class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none md:w-1/3" min="1">
                        </div>
                    </div>


                </div>

                <div class="flex flex-row my-5 space-x-2">
                    <p>Total Amount: </p>
                    <p id="totalAmount" name="totalAmount">$0</p>
                </div>
                <div>
                    <button class="w-full bg-black text-white rounded-md px-2 py-2">Generate Bill</button>
                </div>
            </form>
        </div>

        <div class="bg-white rounded shadow p-6 mt-5">
            <div class="flex items-center justify-between mb-5">
                <div>
                    <h2 class="text-xl font-semibold">Billing History</h2>
                    <p class="text-sm text-black/80">{{ count($fetchBillHistory) }} records found</p>
                </div>
                <div>
                    <a href="{{ route('Receptionist.GetInvoices') }}" class="bg-black text-white px-3 py-2 rounded-md">View
                        All Bills</a>
                </div>
            </div>
            <form action="">
                <div class="w-full flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-4">
                    <input type="date" class="w-80 md:w-1/4 bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none">
                    <input type="text" placeholder="Patient Name" class="w-80 md:w-1/4 bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none">
                    <input type="text" placeholder="Doctor Name" class="w-80 md:w-1/4 bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none">
                    <button class="w-80 md:w-1/4 px-3 py-1 rounded bg-black text-white">Search</button>
                </div>
            </form>
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
                            <a href="{{ route('Receptionist.DownloadInvoice', ['id' => $record->id]) }}"
                                class="font-medium text-black mr-3">
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
