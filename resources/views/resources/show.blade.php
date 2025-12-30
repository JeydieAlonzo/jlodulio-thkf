<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Resource') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <h3 class="text-lg font-bold mb-6 border-b pb-2">Resource Details</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    {{-- Resource Name --}}
                    <div>
                        <label class="block text-gray-500 text-xs font-bold uppercase tracking-wider">Resource Name</label>
                        <div class="mt-1 text-gray-900 text-lg font-medium">
                            {{ $resource->resource_name }}
                        </div>
                    </div>

                    {{-- Resource Type --}}
                    <div>
                        <label class="block text-gray-500 text-xs font-bold uppercase tracking-wider">Type</label>
                        <div class="mt-1 text-gray-900 text-lg">
                            {{ $resource->resource_type }}
                        </div>
                    </div>

                    {{-- Assigned Section (via Relationship) --}}
                    <div>
                        <label class="block text-gray-500 text-xs font-bold uppercase tracking-wider">Assigned Section</label>
                        <div class="mt-1 text-gray-900 text-lg font-bold text-blue-600">
                            {{-- This grabs the name through the relationship, handled safely --}}
                            {{ $resource->section->section_name ?? 'Unassigned' }}
                        </div>
                    </div>

                    {{-- Availability --}}
                    @if($resource->availability)
                    <div>
                        <label class="block text-gray-500 text-xs font-bold uppercase tracking-wider">Availability</label>
                        <div class="mt-1 text-gray-900 text-lg">
                            {{ $resource->availability }}
                        </div>
                    </div>
                    @endif

                </div>

                {{-- Description --}}
                <div class="mt-6">
                    <label class="block text-gray-500 text-xs font-bold uppercase tracking-wider">Description</label>
                    <div class="mt-2 p-4 bg-gray-50 rounded border text-gray-700 whitespace-pre-line">
                        {{ $resource->description ?: 'No description provided.' }}
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="mt-8 flex items-center">
                    <a href="{{ route('resources.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-3">
                        &larr; Back to List
                    </a>
                    
                    <a href="{{ route('resources.edit', $resource->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">
                        Edit Resource
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>