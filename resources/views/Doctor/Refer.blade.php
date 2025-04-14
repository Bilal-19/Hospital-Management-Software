@extends('DoctorLayout.main')

@section('section')
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-4 text-center">Referral Form</h2>

            <form action="{{route("Doctor.CreateReferral")}}" class="w-full" method="post">
                @csrf
                <div class="flex flex-col my-3 md:w-1/2 mx-auto">
                    <label for="doctorName">Select Doctor:</label>
                    <select name="doctorName" class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none capitalize">
                        @foreach ($doctorsList as $value)
                            <option value="{{ $value }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex flex-col my-3 md:w-1/2 mx-auto">
                    <label for="patientName">Patient:</label>
                    <input type="text" name="patientName" class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none capitalize" value="{{$findPatient->fullName}}" readonly>
                </div>

                <div class="flex flex-col my-3 md:w-1/2 mx-auto">
                    <label for="reasons">Reasons:</label>
                    <input type="text" name="reasons" class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none">
                </div>

                <div class="flex flex-col my-3 md:w-1/2 mx-auto">
                    <label for="notes">Notes:</label>
                    <input type="text" name="notes" class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none">
                </div>

                <div class="md:w-1/2 mx-auto my-3">
                    <button class="bg-black block text-white px-2 py-1 w-full rounded-md">Confirm</button>
                </div>
            </form>
        </div>
    </main>
    </div>
@endsection
