<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">User Details</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <h3 class="text-lg font-bold mb-6 border-b pb-2">Profile Information</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-500 text-xs font-bold uppercase tracking-wider">Full Name</label>
                        <div class="mt-1 text-gray-900 text-lg font-medium">
                            {{ $user->first_name }} {{ $user->last_name }}
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-500 text-xs font-bold uppercase tracking-wider">Username</label>
                        <div class="mt-1 text-gray-900 text-lg">
                            {{ $user->name }}
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-500 text-xs font-bold uppercase tracking-wider">Email Address</label>
                        <div class="mt-1 text-gray-900 text-lg">
                            {{ $user->email }}
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-500 text-xs font-bold uppercase tracking-wider">Role</label>
                        <div class="mt-1 text-gray-900 text-lg">
                            {{ $user->userType->usertype_name ?? 'Unassigned' }}
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-500 text-xs font-bold uppercase tracking-wider">Contact Number</label>
                        <div class="mt-1 text-gray-900 text-lg">
                            {{ $user->contact_number ?: 'N/A' }}
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-gray-500 text-xs font-bold uppercase tracking-wider">Date Joined</label>
                        <div class="mt-1 text-gray-900 text-lg">
                            {{ $user->created_at->format('F j, Y') }}
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex items-center">
                    <a href="{{ route('users.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-3">
                        &larr; Back to List
                    </a>
                    <a href="{{ route('users.edit', $user->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">
                        Edit User
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>