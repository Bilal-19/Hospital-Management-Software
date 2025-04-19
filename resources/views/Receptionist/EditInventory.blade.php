@extends('ReceptionistLayout.main')

@section('section')
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-10">Edit Inventory</h2>

            <form action="{{ route('Receptionist.UpdateInventory', ['id'=>$findInventory->id]) }}" method="post">
                @csrf
                <div class="w-full grid grid-cols-2 gap-5">
                    <div class="flex flex-col">
                        <label for="itemName">Item Name:</label>
                        <input type="text" name="itemName" placeholder="Enter item name"
                            value="{{ $findInventory->itemName }}"
                            class="border border-[#9CA3AF] rounded-md px-2 p-1 focus:outline-none">
                    </div>

                    <div class="flex flex-col">
                        <label for="category">Select Category:</label>
                        <select name="category" id="category"
                            class="border border-[#9CA3AF] rounded-md px-2 p-1 focus:outline-none">
                            <option value="Medicine" {{ $findInventory->category == 'Medicine' ? 'selected' : '' }}>Medicine
                            </option>
                            <option value="Equipment" {{ $findInventory->category == 'Equipment' ? 'selected' : '' }}>
                                Equipment</option>
                            <option value="Lab Item" {{ $findInventory->category == 'Lab Item' ? 'selected' : '' }}>Lab Item
                            </option>
                            <option value="Supply" {{ $findInventory->category == 'Supply' ? 'selected' : '' }}>Supply
                            </option>
                        </select>
                    </div>

                    <div class="flex flex-col">
                        <label for="quantityInStock">Stock Quantity:</label>
                        <input type="number" name="quantityInStock" placeholder="Enter stock quantity"
                            value="{{ $findInventory->quantityInStock }}"
                            class="border border-[#9CA3AF] rounded-md px-2 p-1 focus:outline-none" min="0">
                    </div>

                    <div class="flex flex-col">
                        <label for="unit">Unit:</label>
                        <input type="text" name="unit" placeholder="Enter unit"
                            value="{{ $findInventory->unit }}"
                            class="border border-[#9CA3AF] rounded-md px-2 p-1 focus:outline-none">
                    </div>

                    <div class="flex flex-col">
                        <label for="minimumStockLevel">Minimum Stock Level:</label>
                        <input type="number" name="minimumStockLevel" placeholder="Enter minimum stock level"
                            value="{{ $findInventory->minimumStockLevel }}"
                            class="border border-[#9CA3AF] rounded-md px-2 p-1 focus:outline-none" min="10">
                    </div>

                    <div class="flex flex-col">
                        <label for="batchNumber">Batch Number:</label>
                        <input type="text" name="batchNumber" placeholder="Enter Batch Number"
                            value="{{ $findInventory->batchNumber }}"
                            class="border border-[#9CA3AF] rounded-md px-2 p-1 focus:outline-none">
                    </div>

                    <div class="flex flex-col">
                        <label for="expiryDate">Expiry Date:</label>
                        <input type="text" name="expiryDate" placeholder="Select expiry date"
                            onfocus="(this.type='date')" value="{{ $findInventory->expiryDate }}"
                            class="border border-[#9CA3AF] rounded-md px-2 p-1 focus:outline-none">
                    </div>

                    <div class="flex flex-col">
                        <label for="supplierName">Supplier Name:</label>
                        <input type="text" name="supplierName" placeholder="Enter supplier name"
                            value="{{ $findInventory->supplierName }}"
                            class="border border-[#9CA3AF] rounded-md px-2 p-1 focus:outline-none">
                    </div>

                    <div class="flex flex-col">
                        <label for="purchaseDate">Purchase Date:</label>
                        <input type="text" name="purchaseDate" placeholder="Select purchase date"
                            onfocus="(this.type='date')" value="{{ $findInventory->purchaseDate }}"
                            class="border border-[#9CA3AF] rounded-md px-2 p-1 focus:outline-none">
                    </div>

                    <div class="flex flex-col">
                        <label for="pricePerUnit">Per Unit Price:</label>
                        <input type="text" name="pricePerUnit" placeholder="Enter per unit price"
                            value="{{ $findInventory->pricePerUnit }}"
                            class="border border-[#9CA3AF] rounded-md px-2 p-1 focus:outline-none">
                    </div>

                    <div class="flex flex-col">
                        <label for="notes">Notes:</label>
                        <input type="text" name="notes" placeholder="Enter notes"
                            value="{{ $findInventory->notes }}"
                            class="border border-[#9CA3AF] rounded-md px-2 p-1 focus:outline-none">
                    </div>
                </div>
                <button class="bg-black text-white px-3 py-1 rounded-md mt-5">Update Inventory</button>
            </form>
        </div>
    </main>
    </div>
@endsection
