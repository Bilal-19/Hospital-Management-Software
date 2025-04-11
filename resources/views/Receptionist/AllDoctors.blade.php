@extends('ReceptionistLayout.main')

@section('section')
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <div class="p-6">
            <div class="w-full grid grid-cols-3 gap-5">
                @foreach ($fetchRecords as $record)
                    <div class="flex space-x-2 bg-white p-6 rounded-md shadow">
                        <div>
                            <img src="" alt="profile">
                        </div>
                        <div>
                            <h4 class="font-semibold text-lg">{{$record->fullName}}</h4>
                            <p class="text-sm text-[#6B7280]">{{$record->department}}</p>
                            <p>Available</p>
                        </div>
                    </div>
                @endforeach

                <div class="flex space-x-2 bg-white p-6 rounded-md shadow">
                    <div>
                        <img src="" alt="profile">
                    </div>
                    <div>
                        <h4 class="font-semibold text-lg">Dr. John Smith</h4>
                        <p class="text-sm text-[#6B7280]">Cardiology</p>
                        <p>Available</p>
                    </div>
                </div>

                <div class="flex space-x-2 bg-white p-6 rounded-md shadow">
                    <div>
                        <img src="" alt="profile">
                    </div>
                    <div>
                        <h4 class="font-semibold text-lg">Dr. John Smith</h4>
                        <p class="text-sm text-[#6B7280]">Cardiology</p>
                        <p>Available</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
    </div>
@endsection
