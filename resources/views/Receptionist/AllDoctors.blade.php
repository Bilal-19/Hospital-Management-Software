@extends('ReceptionistLayout.main')

@section('section')
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <div class="p-6">
            <h2 class="text-xl font-semibold">All Doctors</h2>
            <p class="text-gray-600 text-sm mb-5">{{ count($fetchRecords) }} records found</p>
            <div class="w-full mb-10">
                <form action="{{route("Receptionist.AllDoctors")}}" method="get" class="flex flex-row">
                    <input type="text" name="search" placeholder="Search by doctor name or department" class="w-4/5 focus:outline-none border border-gray-300 px-3 text-sm py-2">
                    <button class="w-1/5 bg-black text-white px-3 py-1">Search</button>
                </form>
            </div>

            <div class="w-full grid grid-cols-1 md:grid-cols-3 gap-5">
                @foreach ($fetchRecords as $record)
                    <div class="flex items-center space-x-3 bg-white p-6 rounded-md shadow">
                        <div>
                            <img src="{{ 'https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTR8fGRvY3RvcnN8ZW58MHx8MHx8fDA%3D' }}"
                                alt="profile" class="rounded-full size-16 object-cover">
                        </div>
                        <div>
                            <h4 class="font-semibold text-lg">{{ $record->fullName }}</h4>
                            <p class="text-sm text-[#6B7280]">{{ $record->department }}</p>
                            @if ($record->status === 'Available')
                                <button
                                    class="text-[#166534] text-xs font-medium bg-[#DCFCE7] px-2.5 py-0.5 rounded-3xl">{{ $record->status }}</button>
                            @else
                                <button
                                    class="text-[#991B1B] text-xs font-medium bg-[#FEE2E2] px-2.5 py-0.5 rounded-3xl">{{ $record->status }}</button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
    </div>
@endsection
