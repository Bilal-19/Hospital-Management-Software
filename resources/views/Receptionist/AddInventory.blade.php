@extends('ReceptionistLayout.main')

@section('section')
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-10">Add Inventory</h2>

            <form action="{{route("Receptionist.CreateInventory")}}" method="post">
                @csrf
                <div class="w-full grid grid-cols-3 gap-5">
                    <div class="flex flex-col">
                        <label for="itemName">Item Name:</label>
                        <input type="text" name="itemName" placeholder="Enter item name"
                            class="border border-[#9CA3AF] rounded-md px-2 p-1 focus:outline-none">
                    </div>

                    <div class="flex flex-col">
                        <label for="category">Select Category:</label>
                        <select name="category" id="category"
                            class="border border-[#9CA3AF] rounded-md px-2 p-1 focus:outline-none">
                            <option value="Medicine">Medicine</option>
                            <option value="Equipment">Equipment</option>
                            <option value="Lab Item">Lab Item</option>
                            <option value="Supply">Supply</option>
                        </select>
                    </div>

                    <div class="flex flex-col">
                        <label for="quantityInStock">Stock Quantity:</label>
                        <input type="number" name="quantityInStock" placeholder="Enter stock quantity"
                            class="border border-[#9CA3AF] rounded-md px-2 p-1 focus:outline-none" min="5">
                    </div>

                    <div class="flex flex-col">
                        <label for="unit">Unit:</label>
                        <input type="text" name="unit" placeholder="Enter unit"
                            class="border border-[#9CA3AF] rounded-md px-2 p-1 focus:outline-none">
                    </div>

                    <div class="flex flex-col">
                        <label for="minimumStockLevel">Minimum Stock Level:</label>
                        <input type="number" name="minimumStockLevel" placeholder="Enter minimum stock level"
                            class="border border-[#9CA3AF] rounded-md px-2 p-1 focus:outline-none" min="10">
                    </div>

                    <div class="flex flex-col">
                        <label for="batchNumber">Batch Number:</label>
                        <input type="text" name="batchNumber" placeholder="Enter Batch Number"
                            class="border border-[#9CA3AF] rounded-md px-2 p-1 focus:outline-none">
                    </div>

                    <div class="flex flex-col">
                        <label for="expiryDate">Expiry Date:</label>
                        <input type="text" name="expiryDate" placeholder="Select expiry date"
                            onfocus="(this.type='date')"
                            class="border border-[#9CA3AF] rounded-md px-2 p-1 focus:outline-none">
                    </div>

                    <div class="flex flex-col">
                        <label for="supplierName">Supplier Name:</label>
                        <input type="text" name="supplierName" placeholder="Enter supplier name"
                            class="border border-[#9CA3AF] rounded-md px-2 p-1 focus:outline-none">
                    </div>

                    <div class="flex flex-col">
                        <label for="purchaseDate">Purchase Date:</label>
                        <input type="text" name="purchaseDate" placeholder="Select purchase date"
                            onfocus="(this.type='date')"
                            class="border border-[#9CA3AF] rounded-md px-2 p-1 focus:outline-none">
                    </div>

                    <div class="flex flex-col">
                        <label for="status">Select Status:</label>
                        <select name="status" id="status"
                            class="border border-[#9CA3AF] rounded-md px-2 p-1 focus:outline-none">
                            <option value="Available">Available</option>
                            <option value="Low Stock">Low Stock</option>
                            <option value="Out of Stock">Out of Stock</option>
                            <option value="Expired">Expired</option>
                        </select>
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
