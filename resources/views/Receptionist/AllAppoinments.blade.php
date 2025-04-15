@extends('ReceptionistLayout.main')

@section('section')
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <div class="w-full bg-white rounded shadow p-6">
            <h3 class="text-lg font-semibold mb-4">All Appoinments</h3>
            <table class="w-80 md:w-full">
                <tr class="border-b border-gray-500 text-[#6B7280] text-xs">
                    <th class="font-medium text-start py-3">Date & Time</th>
                    <th class="font-medium text-start py-3">Doctor</th>
                    <th class="font-medium text-start py-3">Department</th>
                    <th class="font-medium text-start py-3">Patient Name</th>
                    <th class="font-medium text-start py-3">Reason for Visit</th>
                    <th class="font-medium text-start py-3">Actions</th>
                </tr>
                @foreach ($fetchAppoinments as $record)
                    <tr class="border-b border-gray-300 text-sm text-[#111827]">
                        <td class="py-3">{{ date('M d, Y', strtotime($record->appointmentDate)) }}
                            {{ $record->appointmentTime }}</td>
                        <td class="py-3">{{ $record->doctorName }}</td>
                        <td class="py-3">{{ $record->department }}</td>
                        <td class="py-3">{{ $record->patientName }}</td>
                        <td class="py-3">{{ $record->reasonForVisit }}</td>
                        <td class="py-3">
                            <button href="" onclick="openRescheduleModal({{ $record->id }})" type="button"
                                class="font-medium text-black mr-3">Reschedule</button>
                            <a href="{{ route('Receptionist.CancelAppointment', ['id' => $record->id]) }}"
                                class="font-medium text-[#DC2626]">Cancel</a>
                        </td>
                    </tr>
                @endforeach
            </table>

            <!-- Modal -->
            <div id="rescheduleModal"
                class="fixed inset-0 z-50 hidden bg-black bg-opacity-40 flex items-center justify-center">
                <div class="bg-white rounded-lg w-96 p-6 shadow-md">
                    <h2 class="text-lg font-semibold mb-4">Reschedule Appointment</h2>
                    <form method="POST" action="{{route("Receptionist.RescheduleAppointment")}}">
                        @csrf
                        <input type="hidden" name="id" id="appointmentId">

                        <div class="flex flex-col my-3">
                            <label for="date">Date:</label>
                            <input type="text" required name="appointmentDate" placeholder="Select appoinment date"
                                onfocus="(this.type='date')"
                                class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none">
                        </div>

                        <div class="flex flex-col my-3">
                            <label for="appoinmentTime">Available Time Slot:</label>
                            <select name="appointmentTime" required id="appoinmentTime"
                                class="bg-white px-3 py-1 rounded-md border border-slate-300 focus:outline-none capitalize">
                                @php
                                    $timeSlotArr = [
                                        '9:00 AM',
                                        '9:30 AM',
                                        '10:00 AM',
                                        '10:30 AM',
                                        '11:00 AM',
                                        '11:30 AM',
                                        '12:00 PM',
                                        '12:30 PM',
                                        '2:00 PM',
                                        '2:30 PM',
                                        '3:00 PM',
                                    ];
                                @endphp
                                @foreach ($timeSlotArr as $value)
                                    <option value="{{ $value }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex justify-end space-x-2">
                            <button type="button" onclick="closeRescheduleModal()"
                                class="bg-gray-300 px-3 py-1 rounded text-sm">Cancel</button>
                            <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded text-sm">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </main>

    @push('custom-js-script')
        <script>
            function openRescheduleModal(id) {
                document.getElementById('rescheduleModal').classList.remove('hidden');
                document.getElementById('appointmentId').value = id;
            }

            function closeRescheduleModal() {
                document.getElementById('rescheduleModal').classList.add('hidden');
            }
        </script>
    @endpush
@endsection
