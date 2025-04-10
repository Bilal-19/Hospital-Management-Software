@extends('ReceptionistLayout.main')

@section('section')
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-4">Generate Bill</h2>

            <form action="{{route("Receptionist.CreateBill")}}" method="post">
                @csrf
                <div class="mt-10 grid grid-cols-2 gap-5">
                    <div class="flex flex-col">
                        <label>Services</label>
                        <div class="w-full flex flex-row justify-between">
                            <input type="text" name="serviceName" placeholder="Service Description"
                                class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none md:w-2/3 mr-2">
                            <input type="number" name="serviceAmount" id="serviceAmount" placeholder="Amount"
                                class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none md:w-1/3">
                        </div>
                    </div>

                    <div class="flex flex-col">
                        <label>Lab Tests</label>
                        <div class="w-full flex flex-row justify-between">
                            <input type="text" name="testName" placeholder="Test Name"
                                class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none md:w-2/3 mr-2">
                            <input type="number" name="testCost" placeholder="Cost" id="testCost"
                                class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none md:w-1/3">
                        </div>
                    </div>

                    <div class="flex flex-col">
                        <label>Medicines</label>
                        <div class="w-full flex flex-row justify-between">
                            <input type="text" name="medicineName" placeholder="Medicine Name"
                                class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none md:w-2/3 mr-2">
                            <input type="number" name="medicinePrice" placeholder="Price" id="medicinePrice"
                                class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none md:w-1/3">
                        </div>
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
                </div>
                <hr class="my-5">
                <div class="flex flex-row justify-between my-5">
                    <p>Total Amount:</p>
                    <p id="totalAmount" name="totalAmount">$0</p>
                </div>
                <div>
                    <button class="w-full bg-black text-white rounded-md px-2 py-2">Generate Bill</button>
                </div>
            </form>
        </div>
    </main>
    </div>

    @push('custom-js-script')
        <script>
            const totalAmountEl = document.getElementById("totalAmount")
            function calculateBillRealTime(changeElementID){
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
