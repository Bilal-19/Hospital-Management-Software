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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: "Roboto", sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">
    <!-- Topbar -->
    <header class="bg-slate-700 text-white py-4 px-6 flex justify-between items-center">
        <h1 class="text-xl md:text-2xl font-semibold">Hospital Management Software</h1>
        <button id="menu-btn" class="md:hidden text-white text-xl">
            <i class="fas fa-bars"></i>
        </button>
    </header>

    <!-- Main Layout -->
    <div class="flex flex-1">
        <!-- Sidebar -->
        <aside id="sidebar"
            class="bg-slate-700 text-black w-64 space-y-4 py-6 px-4 absolute md:relative z-10 top-16 left-0 md:top-0 md:flex md:flex-col transform -translate-x-full md:translate-x-0 transition-transform duration-200 ease-in-out h-screen">
            <nav class="space-y-10">
                <a href="#" class="flex items-center gap-3 px-4 py-2 bg-white text-black rounded hover:bg-gray-200">
                    <i class="fa-solid fa-house"></i>
                    <span class="inline">Dashboard</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-2 bg-white text-black rounded hover:bg-gray-200">
                    <i class="fa-solid fa-clipboard-check"></i>
                    <span class="inline">Mark Attendance</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-2 bg-white text-black rounded hover:bg-gray-200">
                    <i class="fa-solid fa-calendar-check"></i>
                    <span class="inline">View Appointments</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-2 bg-white text-black rounded hover:bg-gray-200">
                    <i class="fa-solid fa-notes-medical"></i>
                    <span class="inline">Update Diagnosis</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-2 bg-white text-black rounded hover:bg-gray-200">
                    <i class="fa-solid fa-file-invoice-dollar"></i>
                    <span class="inline">Salary Receipt</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <div class="bg-white p-6 rounded shadow">
                <h2 class="text-xl font-semibold mb-4">Welcome to the Dashboard</h2>
                <p class="text-gray-600">This is the main content area of the Hospital Management Software.</p>
            </div>
        </main>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const menuBtn = document.getElementById('menu-btn');

        menuBtn.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });
    </script>
</body>

</html>
