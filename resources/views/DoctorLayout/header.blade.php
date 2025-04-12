<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hospital Management Software Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">
    <!-- Topbar -->
    <header class="bg-slate-700 text-white py-4 px-6 flex justify-between items-center">
        <h1 class="text-lg md:text-2xl font-semibold">Hospital Management Software</h1>
        <button id="menu-btn" class="md:hidden text-white text-md">
            <i class="fas fa-bars"></i>
        </button>
    </header>

    <!-- Main Layout -->
    <div class="flex flex-1">
        <!-- Sidebar -->
        <aside id="sidebar"
            class="bg-slate-700 text-black w-64 space-y-4 py-6 px-4 absolute md:relative z-10 top-16 left-0 md:top-0 md:flex md:flex-col transform -translate-x-full md:translate-x-0 transition-transform duration-200 ease-in-out h-min-screen">
            <nav class="space-y-10">
                <a href="{{ route('Doctor.Dashboard') }}"
                    class="flex items-center gap-3 px-4 py-2 border-b {{ request()->routeIs('Doctor.Dashboard') ? 'bg-white text-black rounded hover:bg-gray-200' : 'text-white' }}">
                    <i class="fa-solid fa-house"></i>
                    <span class="inline">Dashboard</span>
                </a>
                <a href="{{ route('Doctor.MarkAttendance') }}"
                    class="flex items-center gap-3 px-4 py-2 border-b {{ request()->routeIs('Doctor.MarkAttendance') ? 'bg-white text-black rounded hover:bg-gray-200' : 'text-white' }}">
                    <i class="fa-solid fa-clipboard-check"></i>
                    <span class="inline">Mark Attendance</span>
                </a>
                <a href="{{route("Doctor.AllAppoinments")}}"
                    class="flex items-center gap-3 px-4 py-2 border-b {{ request()->routeIs('Doctor.AllAppoinments') ? 'bg-white text-black rounded hover:bg-gray-200' : 'text-white' }}">
                    <i class="fa-solid fa-calendar-check"></i>
                    <span class="inline">View Appointments</span>
                </a>
                <a href="{{ route('Doctor.PatientDirectory') }}"
                    class="flex items-center gap-3 px-4 py-2 border-b {{ request()->routeIs('Doctor.PatientDirectory') ? 'bg-white text-black rounded hover:bg-gray-200' : 'text-white' }}">
                    <i class="fa-solid fa-notes-medical"></i>
                    <span class="inline">Patients</span>
                </a>
                <a href="#"
                    class="flex items-center gap-3 px-4 py-2 border-b text-white">
                    <i class="fa-solid fa-file-invoice-dollar"></i>
                    <span class="inline">Salary Receipt</span>
                </a>
                <a href="{{ route('Doctor.Profile') }}"
                    class="flex items-center gap-3 px-4 py-2 border-b {{ request()->routeIs('Doctor.Profile') ? 'bg-white text-black rounded hover:bg-gray-200' : 'text-white' }}">
                    <i class="fa-solid fa-user-doctor"></i>
                    <span class="inline">My Profile</span>
                </a>
                <a href="{{ route('LogOutUser') }}"
                    class="flex items-center gap-3 px-4 py-2 border-b {{ request()->routeIs('LogOutUser') ? 'bg-white text-black rounded hover:bg-gray-200' : 'text-white' }}">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span class="inline">Log Out</span>
                </a>
            </nav>
        </aside>
