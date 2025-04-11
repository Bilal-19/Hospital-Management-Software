@extends('ReceptionistLayout.main')

@section('section')
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <div class="p-6">
            <div class="w-full grid grid-cols-3 gap-5">
                @foreach ($fetchRecords as $record)
                    <div class="flex items-center space-x-3 bg-white p-6 rounded-md shadow">
                        <div>
                            <img src="{{ asset('Doctors/Profile/' . $record->profilePicture) }}" alt="profile"
                                class="rounded-full size-16 object-cover">
                        </div>
                        <div>
                            <h4 class="font-semibold text-lg">{{ $record->fullName }}</h4>
                            <p class="text-sm text-[#6B7280]">{{ $record->department }}</p>
                            @if ($record->status === 'Available')
                                <button
                                    class="text-[#166534] text-xs font-medium bg-[#DCFCE7] px-2.5 py-0.5 rounded-3xl">{{$record->status}}</button>
                            @else
                                <button
                                    class="text-[#991B1B] text-xs font-medium bg-[#FEE2E2] px-2.5 py-0.5 rounded-3xl">{{$record->status}}</button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
    </div>
@endsection
