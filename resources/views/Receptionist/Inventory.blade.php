@extends('ReceptionistLayout.main')

@section('section')
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <div class="bg-white p-6 rounded shadow">
            <div class="flex flex-col md:flex-row justify-between items-center mb-10">
                <div>
                    <h2 class="text-xl font-semibold">Manage All Inventories</h2>
                    <p class="text-sm text-black/80">{{ count($fetchInventories) }} records found</p>
                </div>
                <div>
                    <a href="{{route("Receptionist.AddInventory")}}" class="bg-black text-white px-3 py-2 rounded-md">Add Inventory</a>
                </div>
            </div>
            <table class="w-80 md:w-full">
                <tr class="border-b border-gray-500 text-[#6B7280] text-xs">
                    <th class="font-medium text-start py-3">ID</th>
                    <th class="font-medium text-start py-3">Item Name</th>
                    <th class="font-medium text-start py-3">Stock Quantity</th>
                    <th class="font-medium text-start py-3">Per Unit Price</th>
                    <th class="font-medium text-start py-3">Status</th>
                    <th class="font-medium text-start py-3">Actions</th>
                </tr>
                @foreach ($fetchInventories as $record)
                    <tr class="border-b border-gray-300 text-sm text-[#111827]">
                        <td class="py-3">{{ $record->id }}</td>
                        <td class="py-3">{{ $record->itemName }}</td>
                        <td class="py-3">{{ $record->quantityInStock }}</td>
                        <td class="py-3">{{ $record->perUnitPrice }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </main>
    </div>
@endsection
