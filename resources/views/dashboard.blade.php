<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Control Panel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                {{-- 1. SECTIONS MANAGEMENT --}}
                <a href="{{ route('sections.index') }}" class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-50 transition">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">📚 Sections</h5>
                    <p class="font-normal text-gray-700">Manage library areas (Multimedia, Discussion Rooms, etc.)</p>
                </a>

                {{-- 2. RESERVATIONS MANAGEMENT --}}
                <a href="{{ route('reservations.index') }}" class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-50 transition">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">📅 Reservations</h5>
                    <p class="font-normal text-gray-700">View and manage all bookings from all users.</p>
                </a>

                {{-- 3. USER TYPES (Roles) --}}
                <a href="{{ route('usertypes.index') }}" class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-50 transition">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">🛡️ User Types</h5>
                    <p class="font-normal text-gray-700">Define roles (Student, Librarian, Admin).</p>
                </a>

                {{-- 4. USERS MANAGEMENT --}}
                <a href=" {{ route('users.index') }} " class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-50 transition opacity-75">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">👥 Users</h5>
                    <p class="font-normal text-gray-700">Manage accounts, promote/demote users.</p>
                </a>

                {{-- 5. RESOURCES (Items within Sections) --}}
                <a href=" {{ route('resources.index') }} " class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-50 transition opacity-75">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">💻 Resources</h5>
                    <p class="font-normal text-gray-700">Manage computers, tables, and specific items.</p>
                </a>

                {{-- 6. SCHEDULE (Time Slots) --}}
                <a href=" {{ route('schedules.index') }} " class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-50 transition opacity-75">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">⏰ Schedules</h5>
                    <p class="font-normal text-gray-700">Set opening hours and available time blocks.</p>
                </a>

            </div>

        </div>
    </div>
</x-app-layout>