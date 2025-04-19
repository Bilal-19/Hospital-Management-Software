@extends('DoctorLayout.main')

@section('section')
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <div class="w-full bg-white rounded shadow p-6 mt-5">
            <h3 class="text-lg font-semibold mb-4">Update Doagnosis</h3>
            <form action="{{route("Doctor.UpdatePatientRecord", ["id"=>$findAppointmentRec->id])}}" method="post">
                @csrf
                <p class="mb-3 text-[#374151] text-sm font-medium">Patient: {{ $findAppointmentRec->patientName }}</p>
                <div class="flex md:flex-row space-x-20 my-3 text-[#374151] text-sm font-medium">
                    <p>Date: {{ $findAppointmentRec->appointmentDate }}</p>
                    <p>Time: {{ $findAppointmentRec->appointmentTime }}</p>
                </div>
                <p class="text-[#374151] text-sm font-medium">Visit Reason: {{ $findAppointmentRec->reasonForVisit }}</p>

                <div class="flex flex-col md:flex-row md:space-x-5">
                    <div class="my-3 flex flex-col w-80 md:w-1/3">
                        <label for="diagnosis">Diagnosis:</label>
                        <textarea name="diagnosis" class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none resize-none text-sm">{{$findAppointmentRec->diagnosis}}</textarea>
                    </div>

                    <div class="my-3 flex flex-col w-80 md:w-1/3">
                        <label for="medicine">Medicines:</label>
                        <textarea name="medicine" class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none resize-none text-sm">{{$findAppointmentRec->medicine}}</textarea>
                    </div>

                    <div class="my-3 flex flex-col w-80 md:w-1/3">
                        <label for="symptoms">Symptoms:</label>
                        <textarea name="symptoms" class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none resize-none text-sm">{{$findAppointmentRec->symptoms}}</textarea>
                    </div>
                </div>

                <button class="text-white bg-black px-5 py-1 rounded-md">Save</button>
            </form>
        </div>
    </main>
    </div>
@endsection
