@extends('ReceptionistLayout.main')

@section('section')
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <div class="bg-white p-6 rounded shadow">
            <div class="flex flex-col md:flex-row justify-between items-center mb-5">
                <div>
                    <h2 class="text-xl font-semibold">Manage All Inventories</h2>
                    <p class="text-sm text-black/80">{{ count($fetchInventories) }} records found</p>
                </div>
                <div>
                    <a href="{{ route('Receptionist.AddInventory') }}" class="bg-black text-white px-3 py-2 rounded-md">Add
                        Inventory</a>
                </div>
            </div>
            <form action="{{route("Receptionist.Inventories")}}" method="get" class="w-full flex flex-row space-x-3 mb-5" autocomplete="off">
                <input type="text" placeholder="Enter medicine name or supplier name" name="search"
                    class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none w-4/5">
                <button class="px-3 py-1 bg-black text-white w-1/5">Search</button>
            </form>
            <table class="w-80 md:w-full">
                <tr class="border-b border-gray-500 text-[#6B7280] text-xs">
                    <th class="font-medium text-start py-3">ID</th>
                    <th class="font-medium text-start py-3">Item Name</th>
                    <th class="font-medium text-start py-3">Stock Quantity</th>
                    <th class="font-medium text-start py-3">Per Unit Price</th>
                    <th class="font-medium text-start py-3">Supplier Name</th>
                    <th class="font-medium text-start py-3">Status</th>
                    <th class="font-medium text-start py-3">Actions</th>
                </tr>
                @foreach ($fetchInventories as $record)
                    <tr class="border-b border-gray-300 text-sm text-[#111827]">
                        <td class="py-3">{{ $record->id }}</td>
                        <td class="py-3">{{ $record->itemName }}</td>
                        <td class="py-3">{{ $record->quantityInStock }}</td>
                        <td class="py-3">{{ $record->pricePerUnit }} PKR</td>
                        <td class="py-3">{{ $record->supplierName }}</td>
                        <td class="py-3">
                            @if ($record->status == 'Available')
                                <p class="text-green-700">{{ $record->status }}</p>
                            @elseif ($record->status == 'Low Stock')
                                <p class="text-orange-700">{{ $record->status }}</p>
                            @elseif ($record->status == 'Out of Stock')
                                <p class="text-red-700">{{ $record->status }}</p>
                            @endif
                        </td>
                        <td class="py-3 space-x-3">
                            <a href="{{ route('Receptionist.EditInventory', ['id' => $record->id]) }}"
                                class="text-blue-700"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="{{ route('Receptionist.DeleteInventory', ['id' => $record->id]) }}"
                                class="text-red-700"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </main>
    </div>
@endsection
