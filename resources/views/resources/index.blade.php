<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Resources') }}
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
                    <h3 class="text-lg font-bold">Resources List</h3>
                    <a href="{{ route('resources.create') }}" class="btn btn-primary bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        + Add Resource
                    </a>
                </div>

                <table class="table-auto w-full border-collapse border border-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="border p-2 text-left">Name</th>
                            <th class="border p-2 text-left">Type</th>
                            <th class="border p-2 text-left">Section</th>
                            <th class="border p-2 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($resources as $resource)
                            <tr class="hover:bg-gray-50">
                                <td class="border p-2 font-bold">{{ $resource->resource_name }}</td>
                                <td class="border p-2">{{ $resource->resource_type }}</td>
                                
                                {{-- Display Section Name via Relationship --}}
                                <td class="border p-2 text-gray-600">
                                    {{ $resource->section->section_name ?? 'Unassigned' }}
                                </td>

                                <td class="border p-2 text-center">
                                    {{-- View Button --}}
                                    <a href="{{ route('resources.show', $resource->id) }}" class="text-blue-600 hover:text-blue-900 mr-3 font-medium">
                                        View
                                    </a>

                                    {{-- Edit Button --}}
                                    <a href="{{ route('resources.edit', $resource->id) }}" class="text-yellow-600 hover:text-yellow-900 mr-3 font-medium">
                                        Edit
                                    </a>
                                    
                                    {{-- Delete Button --}}
                                    <form action="{{ route('resources.destroy', $resource->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this resource?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 font-medium">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        @if($resources->isEmpty())
                            <tr>
                                <td colspan="4" class="border p-4 text-center text-gray-500">
                                    No resources found. Click "Add Resource" to create one.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                
                {{-- Pagination Links --}}
                <div class="mt-4">
                    {{ $resources->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>