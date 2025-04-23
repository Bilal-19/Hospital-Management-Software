@extends('ReceptionistLayout.main')

@section('section')
    <!-- Main Content -->
    <main class="flex-1 p-6 overflow-x-auto">
        <div class="p-6">
            <h2 class="text-xl font-semibold">All Doctors</h2>
            <p class="text-gray-600 text-sm mb-5">{{ count($fetchRecords) }} records found</p>
            <div class="w-70 md:w-full mb-10">
                <form action="{{ route('Receptionist.AllDoctors') }}" method="get" class="flex flex-row" autocomplete="off">
                    <input type="text" name="search" placeholder="Search by doctor name or department"
                        class="w-72 md:w-4/5 focus:outline-none border border-gray-300 px-3 text-sm py-2">
                    <button class="w-20 md:w-1/5 bg-black text-white px-1 md:px-3 py-1 text-sm"><i class="fa-solid fa-magnifying-glass"></i> Search</button>
                </form>
            </div>

            <div class="w-full grid grid-cols-1 md:grid-cols-3 gap-5">
                @foreach ($fetchRecords as $record)
                    <div class="flex items-center space-x-3 bg-white p-6 rounded-md shadow">
                        <div>
                            @if ($record->profilePicture)
                                <img src="{{ asset('Doctors/Profile/' . $record->profilePicture) }}" alt="profile"
                                    class="rounded-full size-16 object-cover">
                            @else
                                @if ($record->gender == 'Male')
                                    <img src="https://www.shutterstock.com/image-vector/male-doctor-smiling-selfconfidence-flat-260nw-2281709217.jpg"
                                        alt="profile" class="rounded-full size-16 object-cover">
                                @else
                                <img src="https://img.freepik.com/premium-vector/female-doctor-character-physician-hospital-checkup-patient-healthy-treatment-personnel_505557-11354.jpg?semt=ais_hybrid&w=740"
                                        alt="profile" class="rounded-full size-16 object-cover">
                                @endif
                            @endif
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
