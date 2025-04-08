@extends("ReceptionistLayout.main")

@section('section')
    <!-- Main Content -->
    <main class="flex-1 p-6">
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-4">Welcome to the Dashboard</h2>
            <p class="text-gray-600 capitalize">Welcome Receptionist, {{ Auth::user()->name }}</p>
        </div>
    </main>
    </div>
@endsection
