@extends('AdminLayout.main')
@section('section')
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <div class="bg-white p-6 rounded shadow">
            <div class="flex flex-row justify-between items-center mb-5">
                <div>
                    <h2 class="text-xl font-semibold">Manage Users</h2>
                    <p class="text-sm text-gray-500">{{ count($users) }} records found</p>
                </div>
                <div>
                    <button onclick="openModal()" class="bg-black text-white px-5 py-2 rounded-md"><i
                            class="fa-solid fa-user-plus"></i>
                        Add User</button>
                </div>
            </div>
            <table class="w-full">
                <tr class="border-b border-gray-500">
                    <th class="py-3">ID</th>
                    <th class="py-3">Name</th>
                    <th class="py-3">Email</th>
                    <th class="py-3">Role</th>
                    <th class="py-3">Registered On</th>
                    <th class="py-3">Actions</th>
                </tr>
                @foreach ($users as $record)
                    <tr class="border-b border-gray-300">
                        <td class="py-3">{{ $record->id }}</td>
                        <td class="py-3">{{ $record->name }}</td>
                        <td class="py-3">{{ $record->email }}</td>
                        <td class="py-3">{{ $record->role }}</td>
                        <td class="py-3">{{ date('M d, Y', strtotime($record->created_at)) }}</td>
                        <td class="py-3 flex space-x-2">
                            <a href="{{route("ResetPassword",["id"=>$record->id])}}" class="text-blue-700"><i class="fa-solid fa-key"></i></a>
                            <a href="" class="text-red-700"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </table>

            {{-- Modal --}}
            <div id="modal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-50 flex items-center justify-center">
                <div class="rounded shadow bg-white w-1/2 p-6">
                    <h3 class="text-center text-2xl font-medium">Register New User</h3>
                    <form action="{{route("Create.Account")}}" autocomplete="off" method="post">
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
