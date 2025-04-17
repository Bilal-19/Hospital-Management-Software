@extends('AdminLayout.main')
@section('section')
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <div class="w-full flex flex-col md:flex-row space-y-5 md:space-y-0 md:space-x-10">
            <div class="md:w-1/2 bg-white p-6 rounded-md shadow">
                <h2 class="text-xl font-semibold mb-4">Add Department</h2>
                <form action="{{route("Admin.CreateDepartment")}}" method="post">
                    @csrf
                    <div class="flex flex-col">
                        <label for="departmentName">Department Name:</label>
                        <input type="text" name="departmentName"
                        placeholder="Enter department name"
                            class="border border-[#9CA3AF] rounded-md p-1 focus:outline-none">
                    </div>
                    <button class="my-5 bg-black text-white px-3 py-2 rounded text-sm">Create Department</button>
                </form>
            </div>

            <div class="md:w-1/2 bg-white p-6 rounded-md shadow">
                <h2 class="text-xl font-semibold mb-4">Assign Department to Staff</h2>
                <form action="{{route("Admin.AssignDepartment")}}" method="post">
                    @csrf
                    <div class="flex flex-col mb-5">
                        <label for="departmentName">Select Department:</label>
                        <select name="departmentName" id="departmentName" class="border border-[#9CA3AF] rounded-md p-1 focus:outline-none">
                            @foreach ($fetchDepartments as $dept)
                                <option value="{{$dept}}">{{$dept}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex flex-col mb-5">
                        <label for="staffName">Select Staff:</label>
                        <select name="staffName" id="staffName" class="border border-[#9CA3AF] rounded-md p-1 focus:outline-none">
                            @foreach ($fetchStaff as $rec)
                                <option value="{{$rec}}">{{$rec}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button class="mb-5 bg-black text-white px-3 py-2 rounded text-sm">Assign Staff</button>
                </form>
            </div>
        </div>
    </main>
    </div>
@endsection
