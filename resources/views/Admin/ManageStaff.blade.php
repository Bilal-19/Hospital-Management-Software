@extends('AdminLayout.main')
@section('section')
    <!-- Main Content -->
    <main class="flex-1 p-6 overflow-x-auto">
        <div class="bg-white p-6 rounded shadow">
            <div class="flex flex-col md:flex-row justify-between md:items-center mb-5">
                <div>
                    <h2 class="text-xl font-semibold">Manage Users</h2>
                    <p class="text-sm text-gray-500">{{ count($users) }} records found</p>
                </div>
                <div>
                    <button onclick="openModal()" class="bg-black text-white px-3 py-1 rounded-md mt-3 md:mt-0"><i
                            class="fa-solid fa-user-plus"></i>
                        Add User</button>
                </div>
            </div>
<div class="overflow-x-auto">
    <table class="min-w-max md:w-full">
        <tr class="border-b border-gray-500">
            <th class="p-3">ID</th>
            <th class="p-3">Name</th>
            <th class="p-3">Email</th>
            <th class="p-3">Role</th>
            <th class="p-3">Registered On</th>
            <th class="p-3">Actions</th>
        </tr>
        @foreach ($users as $record)
            <tr class="border-b border-gray-300">
                <td class="p-3">{{ $record->id }}</td>
                <td class="p-3">{{ $record->name }}</td>
                <td class="p-3">{{ $record->email }}</td>
                <td class="p-3">{{ $record->role }}</td>
                <td class="p-3">{{ date('M d, Y', strtotime($record->created_at)) }}</td>
                <td class="p-3 flex space-x-2">
                    <a href="{{ route('ResetPassword', ['id' => $record->id]) }}" class="bg-blue-700 text-white px-2 py-1 rounded-md">
                        <i class="fa-solid fa-key "></i> Reset Password
                    </a>
                    <a href="{{ route('DeleteAccount', ['id' => $record->id]) }}" class="bg-red-700 text-white px-2 py-1 rounded-md">
                        <i class="fa-solid fa-trash"></i> Delete
                    </a>
                    @if ($record->role != 'Patient')
                        <a href="{{ route('Admin.GeneratePaySlip', ['id' => $record->id]) }}" class="bg-green-700 text-white px-2 py-1 rounded-md"><i class="fa-solid fa-wallet"></i> Generate Pay Slip</a>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
</div>

            {{-- Modal --}}
            <div id="modal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
                <div class="rounded shadow bg-white w-1/2 p-6">
                    <h3 class="text-center text-2xl font-medium">Register New User</h3>
                    <form action="{{ route('Create.Account') }}" autocomplete="off" method="post">
                        @csrf
                        <div class="flex flex-col my-3">
                            <label for="username">Username:</label>
                            <input type="text" name="username"
                                class="border border-[#9CA3AF] rounded-md p-1 focus:outline-none">
                        </div>

                        <div class="flex flex-col my-3">
                            <label for="email">Email:</label>
                            <input type="email" name="email"
                                class="border border-[#9CA3AF] rounded-md p-1 focus:outline-none">
                        </div>

                        <div class="flex flex-col my-3">
                            <label for="role">Role:</label>
                            <select name="role" class="border border-[#9CA3AF] rounded-md p-1 focus:outline-none">
                                <option value="Doctor">Doctor</option>
                                <option value="Receptionist">Receptionist</option>
                                <option value="Pharmacists">Pharmacist</option>
                                <option value="Lab Technicians">Lab Technicians</option>
                                <option value="Patient">Patient</option>
                            </select>
                        </div>

                        <div>
                            <button class="bg-black text-white px-3 py-2 rounded-md">Create New Account</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </main>
    </div>


    @push('script')
        <script>
            function openModal() {
                document.getElementById('modal').classList.remove("hidden")
            }

            function closeModal() {
                document.getElementById('modal').classList.add("hidden")
            }
        </script>
    @endpush
@endsection
