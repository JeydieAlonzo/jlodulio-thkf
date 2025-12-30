<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="alert alert-success mb-4 text-green-700 bg-green-100 p-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger mb-4 text-red-700 bg-red-100 p-3 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between mb-4">
                    <h3 class="text-lg font-bold">Users List</h3>
                    <a href="{{ route('users.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        + Add New User
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="table-auto w-full border-collapse border border-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="border p-2 text-left">Full Name</th>
                                <th class="border p-2 text-left">Username</th>
                                <th class="border p-2 text-left">Email</th>
                                <th class="border p-2 text-left">Role</th>
                                <th class="border p-2 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="hover:bg-gray-50">
                                    <td class="border p-2 font-bold">
                                        {{ $user->first_name }} {{ $user->last_name }}
                                    </td>
                                    <td class="border p-2">{{ $user->name }}</td>
                                    <td class="border p-2 text-sm text-gray-600">{{ $user->email }}</td>
                                    <td class="border p-2">
                                        @php
                                            // 1. Define the names for your IDs/Enum Indices here
                                            // Adjust these names if ID 2 is "Librarian" instead of "Teacher"
                                            $roleNames = [
                                                1 => 'Student',
                                                2 => 'Teacher', 
                                                3 => 'Admin',
                                            ];

                                            // 2. Get the role name, or default to the Raw ID/Enum value if not found
                                            $displayRole = $roleNames[$user->usertype_id] ?? $user->usertype_id;
                                        @endphp

                                        <span class="px-2 py-1 rounded text-xs font-bold 
                                            {{ $user->usertype_id == 3 ? 'bg-red-200 text-red-800' : 
                                            ($user->usertype_id == 2 ? 'bg-green-200 text-green-800' : 'bg-blue-200 text-blue-800') }}">
                                            
                                            {{-- Display the Mapped Name --}}
                                            {{ $displayRole }}
                                        </span>
                                    </td>
                                    <td class="border p-2 text-center">
                                        <a href="{{ route('users.show', $user->id) }}" class="text-blue-600 hover:text-blue-900 mr-2 text-sm">View</a>
                                        <a href="{{ route('users.edit', $user->id) }}" class="text-yellow-600 hover:text-yellow-900 mr-2 text-sm">Edit</a>
                                        
                                        @if(auth()->id() !== $user->id)
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this user? This cannot be undone.');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 text-sm">Delete</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>