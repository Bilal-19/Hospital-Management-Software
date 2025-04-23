@extends('ReceptionistLayout.main')

@section('section')
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-10">Add Inventory</h2>

            <form action="{{ route('Receptionist.CreateInventory') }}" method="post">
                @csrf
                <div class="w-full grid grid-cols-2 gap-5">
                    <div class="flex flex-col">
                        <label for="itemName">Item Name:</label>
                        <input type="text" name="itemName" placeholder="Enter item name"
                            class="border border-[#9CA3AF] rounded-md px-2 p-1 focus:outline-none">
                        @error('itemName')
                            <span class="text-red-700 text-sm">{{ 'Please enter item name' }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col">
                        <label for="category">Select Category:</label>
                        <select name="category" id="category"
                            class="border border-[#9CA3AF] rounded-md px-2 p-1 focus:outline-none">
                            <option value=""></option>
                            <option value="Medicine">Medicine</option>
                            <option value="Equipment">Equipment</option>
                            <option value="Lab Item">Lab Item</option>
                            <option value="Supply">Supply</option>
                        </select>
                        @error('category')
                            <span class="text-red-700 text-sm">{{ 'Please select item category' }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col">
                        <label for="quantityInStock">Stock Quantity:</label>
                        <input type="number" name="quantityInStock" placeholder="Enter stock quantity"
                            class="border border-[#9CA3AF] rounded-md px-2 p-1 focus:outline-none" min="0">
                        @error('quantityInStock')
                            <span class="text-red-700 text-sm">{{ 'Please enter stock quantity' }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col">
                        <label for="unit">Unit:</label>
                        <input type="text" name="unit" placeholder="Enter unit"
                            class="border border-[#9CA3AF] rounded-md px-2 p-1 focus:outline-none">
                        @error('unit')
                            <span class="text-red-700 text-sm">{{ 'Please enter unit (tablets, pairs etc)' }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col">
                        <label for="minimumStockLevel">Minimum Stock Level:</label>
                        <input type="number" name="minimumStockLevel" placeholder="Enter minimum stock level"
                            class="border border-[#9CA3AF] rounded-md px-2 p-1 focus:outline-none" min="10">
                        @error('minimumStockLevel')
                            <span class="text-red-700 text-sm">{{ 'Please enter minimum stock level' }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col">
                        <label for="batchNumber">Batch Number:</label>
                        <input type="text" name="batchNumber" placeholder="Enter Batch Number"
                            class="border border-[#9CA3AF] rounded-md px-2 p-1 focus:outline-none">
                        @error('batchNumber')
                            <span class="text-red-700 text-sm">{{ 'Please input batch number' }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col">
                        <label for="expiryDate">Expiry Date:</label>
                        <input type="text" name="expiryDate" placeholder="Select expiry date"
                            onfocus="(this.type='date')"
                            class="border border-[#9CA3AF] rounded-md px-2 p-1 focus:outline-none">
                        @error('expiryDate')
                            <span class="text-red-700 text-sm">{{ 'Please select item expiry date' }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col">
                        <label for="supplierName">Supplier Name:</label>
                        <input type="text" name="supplierName" placeholder="Enter supplier name"
                            class="border border-[#9CA3AF] rounded-md px-2 p-1 focus:outline-none">
                        @error('supplierName')
                            <span class="text-red-700 text-sm">{{ 'Please enter supplier name' }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col">
                        <label for="purchaseDate">Purchase Date:</label>
                        <input type="text" name="purchaseDate" placeholder="Select purchase date"
                            onfocus="(this.type='date')"
                            class="border border-[#9CA3AF] rounded-md px-2 p-1 focus:outline-none">
                        @error('purchaseDate')
                            <span class="text-red-700 text-sm">{{ 'Please select purchase date' }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col">
                        <label for="pricePerUnit">Per Unit Price:</label>
                        <input type="text" name="pricePerUnit" placeholder="Enter per unit price"
                            class="border border-[#9CA3AF] rounded-md px-2 p-1 focus:outline-none">
                        @error('pricePerUnit')
                            <span class="text-red-700 text-sm">{{ 'Please enter per unit price' }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col">
                        <label for="notes">Notes:</label>
                        <input type="text" name="notes" placeholder="Enter notes"
                            class="border border-[#9CA3AF] rounded-md px-2 p-1 focus:outline-none">
                    </div>
                </div>
                <button class="bg-black text-white px-3 py-1 rounded-md mt-5">Submit</button>
            </form>
        </div>
    </main>
    </div>
@endsection
