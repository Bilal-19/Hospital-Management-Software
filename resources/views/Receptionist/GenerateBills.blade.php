@extends('ReceptionistLayout.main')

@section('section')
    <!-- Main Content -->
    <main class="flex-1 p-6 overflow-x-auto">
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-4">Generate Bill</h2>

            <form action="{{ route('Receptionist.CreateBill') }}" method="post" autocomplete="off">
                @csrf
                <div class="mt-5 grid grid-cols-1 md:grid-cols-3 md:gap-x-5 gap-y-2">
                    <div class="flex flex-col">
                        <label>Patient</label>
                        <select name="patientName"
                            class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none">
                            <option value="">Select Patient Name</option>
                            @foreach ($fetchPatientDirectory as $value)
                                <option value="{{ $value }}">{{ $value }}</option>
                            @endforeach
                        </select>
                        @error('patientName')
                            <span class="text-red-700 text-sm">{{ 'Please select patient name from the list' }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col">
                        <label>Doctor</label>
                        <select name="doctorName"
                            class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none">
                            <option value="">Select Doctor Name</option>
                            @foreach ($fetchDoctors as $value)
                                <option value="{{ $value }}">{{ $value }}</option>
                            @endforeach
                        </select>
                        @error('doctorName')
                            <span class="text-red-700 text-sm">{{ 'Please select doctor name from the list' }}</span>
                        @enderror
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
                        @error('paymentMode')
                            <span class="text-red-700 text-sm">{{ 'Please select payment mode' }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col col-span-1 md:col-span-3">
                        <label>Services</label>
                        <div class="w-70 md:w-full flex flex-row justify-between space-x-5">
                            <div class="flex flex-col w-3/4">
                                <input type="text" name="serviceName" placeholder="Service Description"
                                    class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none min-w-25 md:w-full mr-1">
                                @error('serviceName')
                                    <span class="text-red-700 text-sm">{{ 'Please enter service name' }}</span>
                                @enderror
                            </div>
                            <div class="flex flex-col w-1/4">
                                <input type="number" name="serviceAmount" id="serviceAmount" placeholder="Amount"
                                    class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none min-w-20 md:w-full">
                                @error('serviceAmount')
                                    <span class="text-red-700 text-sm">{{ 'Please enter service amount' }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col col-span-1 md:col-span-3">
                        <label>Lab Tests</label>
                        <div class="w-70 md:w-full flex flex-row justify-between space-x-5">
                            <div class="flex flex-col w-3/4">
                                <input type="text" name="testName" placeholder="Test Name"
                                    class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none min-w-25 md:w-full mr-1">
                                @error('testName')
                                    <span class="text-red-700 text-sm">{{ 'Please enter lab test name' }}</span>
                                @enderror
                            </div>
                            <div class="flex flex-col w-1/4">
                                <input type="number" name="testCost" placeholder="Cost" id="testCost"
                                    class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none min-w-20 md:w-full">
                                @error('testCost')
                                    <span class="text-red-700 text-sm">{{ 'Please enter lab test cost' }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col col-span-1 md:col-span-3">
                        <label>Medicines</label>
                        <div class="w-70 md:w-full flex flex-row justify-between space-x-5">
                            <div class="flex flex-col w-3/4">
                                <input type="text" name="medicineName" placeholder="Medicine Name"
                                    class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none min-w-25 md:w-full mr-1">
                                @error('medicineName')
                                    <span class="text-red-700 text-sm">{{ 'Please enter medicine name' }}</span>
                                @enderror
                            </div>
                            <div class="flex flex-col w-1/4">
                                <input type="number" name="medicinePrice" placeholder="Total Price" id="medicinePrice"
                                    class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none min-w-20 md:w-full"
                                    min="1">
                                @error('medicinePrice')
                                    <span class="text-red-700 text-sm">{{ 'Please enter medicine price' }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>


                </div>

                <div class="flex flex-row my-5 space-x-2">
                    <p>Total Amount: </p>
                    <p id="totalAmount" name="totalAmount">$0</p>
                </div>
                <div>
                    <button class="w-full bg-black text-white rounded-md px-2 py-2"><i class="fa-solid fa-file-invoice"></i>
                        Generate Bill</button>
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
                    <a href="{{ route('Receptionist.GetInvoices') }}" class="bg-black text-white px-3 py-2 rounded-md"><i class="fa-solid fa-eye"></i> View
                        All Bills</a>
                </div>
            </div>
            <form action="{{ route('Receptionist.GenerateBills') }}" method="get" class="my-5">
                <div class="w-full flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-4">
                    <input required name="invoiceDate" type="text" placeholder="Select Date" onfocus="(this.type='date')"
                        class="w-75 md:w-1/4 bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none">
                    <input required name="patientName" type="text" placeholder="Patient Name"
                        class="w-75 md:w-1/4 bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none">
                    <input required name="doctorName" type="text" placeholder="Doctor Name"
                        class="w-75 md:w-1/4 bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none">
                    <button class="w-75 md:w-1/4 px-3 py-1 rounded bg-black text-white"><i class="fa-solid fa-magnifying-glass"></i> Search</button>
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
                                <a href="{{ route('Receptionist.DownloadInvoice', ['id' => $record->id]) }}"
                                    class="font-medium text-black mr-3">
                                    <i class="fa-solid fa-file-arrow-down"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
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
