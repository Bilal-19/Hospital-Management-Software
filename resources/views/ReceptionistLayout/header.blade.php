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
    <header class="bg-emerald-700 text-white py-4 px-6 flex justify-between items-center">
        <h1 class="text-lg md:text-2xl font-semibold">Hospital Management Software</h1>
        <button id="menu-btn" class="md:hidden text-white text-md">
            <i class="fas fa-bars"></i>
        </button>
    </header>

    <!-- Main Layout -->
    <div class="flex flex-1">
        <!-- Sidebar -->
        <aside id="sidebar"
            class="bg-emerald-700 text-black w-64 space-y-4 py-6 px-5 absolute md:relative z-10 top-16 left-0 md:top-0 md:flex md:flex-col transform -translate-x-full md:translate-x-0 transition-transform duration-200 ease-in-out h-max-screen">
            <nav class="space-y-7">
                <a href="{{ route('Receptionist.Dashboard') }}"
                    class="flex gap-3 px-4 py-2 space-x-1 items-center border-b {{ request()->routeIs('Receptionist.Dashboard') ? 'bg-white text-emerald-700 rounded-md' : 'text-white' }}">
                    <i class="w-2 fa-solid fa-house"></i>
                    <span class="inline">Dashboard</span>
                </a>
                <a href="{{ route('Receptionist.MarkAttendance') }}"
                    class="flex items-center gap-3 px-4 py-2 space-x-1 border-b {{ request()->routeIs('Receptionist.MarkAttendance') ? 'bg-white text-emerald-700 rounded-md' : 'text-white' }}">
                    <i class="w-2 fa-solid fa-clipboard-check"></i>
                    <span class="inline">Mark Attendance</span>
                </a>
                <a href="{{ route('Receptionist.ManageAppointments') }}"
                    class="flex items-center gap-3 px-4 py-2 space-x-1 border-b {{ request()->routeIs('Receptionist.ManageAppointments') ? 'bg-white text-emerald-700 rounded-md' : 'text-white' }}">
                    <i class="w-2 fas fa-notes-medical"></i>
                    <span class="inline">Book Appoinments</span>
                </a>
                <a href="{{ route('Receptionist.AllPatients') }}"
                    class="flex items-center gap-3 px-4 py-2 border-b {{ request()->routeIs('Receptionist.AllPatients') ? 'bg-white text-black rounded hover:bg-gray-200' : 'text-white' }}">
                    <i class="fa-solid fa-notes-medical"></i>
                    <span class="inline">All Patients</span>
                </a>
                <a href="{{ route('Receptionist.AllAppoinments') }}"
                    class="flex items-center gap-3 px-4 py-2 space-x-1 border-b {{ request()->routeIs('Receptionist.AllAppoinments') ? 'bg-white text-emerald-700 rounded-md' : 'text-white' }}">
                    <i class="w-2 fas fa-notes-medical"></i>
                    <span class="inline">All Appoinments</span>
                </a>
                <a href="{{ route('Receptionist.GenerateBills') }}"
                    class="flex items-center gap-3 px-4 py-2 space-x-1 border-b {{ request()->routeIs('Receptionist.GenerateBills') ? 'bg-white text-emerald-700 rounded-md' : 'text-white' }}">
                    <i class="w-2 fas fa-receipt"></i>
                    <span class="inline">Generate Bill</span>
                </a>
                <a href="{{ route('Receptionist.GetInvoices') }}"
                    class="flex items-center gap-3 px-4 py-2 space-x-1 border-b {{ request()->routeIs('Receptionist.GetInvoices') ? 'bg-white text-emerald-700 rounded-md' : 'text-white' }}">
                    <i class="w-2 fa-solid fa-file-invoice"></i>
                    <span class="inline">Invoices</span>
                </a>
                <a href="{{ route('Receptionist.AllDoctors') }}"
                    class="flex items-center gap-3 px-4 py-2 space-x-1 border-b {{ request()->routeIs('Receptionist.AllDoctors') ? 'bg-white text-emerald-700 rounded-md' : 'text-white' }}">
                    <i class="w-2 fa-solid fa-user-doctor"></i>
                    <span class="inline">All Doctors</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-2 space-x-1 border-b text-white">
                    <i class="w-2 fa-solid fa-file-invoice-dollar"></i>
                    <span class="inline">Salary Receipt</span>
                </a>
                <a href="{{ route('Receptionist.Profile') }}"
                    class="flex items-center gap-3 px-4 py-2 space-x-1 border-b {{ request()->routeIs('Receptionist.Profile') ? 'bg-white text-emerald-700 rounded-md' : 'text-white' }}">
                    <i class="w-2 fa-solid fa-user"></i>
                    <span class="inline">My Profile</span>
                </a>
                <a href="{{ route('LogOutUser') }}"
                    class="flex items-center gap-3 px-4 py-2 space-x-1 border-b {{ request()->routeIs('LogOutUser') ? 'bg-white text-emerald-700 rounded-md' : 'text-white' }}">
                    <i class="w-2 fa-solid fa-right-from-bracket"></i>
                    <span class="inline">Log Out</span>
                </a>
            </nav>
        </aside>
