<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage User Types') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Success Message --}}
            @if(session('success'))
                <div class="alert alert-success mb-4 text-green-700 bg-green-100 p-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between mb-4">
                    <h3 class="text-lg font-bold">User Types List</h3>
                    <a href="{{ route('usertypes.create') }}" class="btn btn-primary bg-blue-500 text-white px-4 py-2 rounded">
                        + Add New Type
                    </a>
                </div>

                <table class="table-auto w-full border-collapse border border-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="border p-2 text-left">ID</th>
                            <th class="border p-2 text-left">Name</th>
                            <th class="border p-2 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usertypes as $type)
                            <tr>
                                <td class="border p-2">{{ $type->id }}</td>
                                <td class="border p-2">{{ $type->role }}</td>
                                <td class="border p-2 text-center">
                                    <a href="{{ route('usertypes.show', $type->id) }}" class="text-blue-600 hover:text-blue-900 mr-2">View</a>
                                    <a href="{{ route('usertypes.edit', $type->id) }}" class="text-yellow-600 hover:text-yellow-900 mr-2">Edit</a>
                                    
                                    <button type="button" class="text-gray-400 cursor-not-allowed" title="Deletion disabled for system roles" disabled>
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <div class="mt-4">
                    {{ $usertypes->links() }} {{-- Pagination links --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>