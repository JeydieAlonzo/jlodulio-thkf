<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Section Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    {{-- Header / Title --}}
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-2xl font-bold text-gray-900">{{ $section->section_name }}</h3>
                        <span class="px-3 py-1 text-xs font-semibold text-gray-500 bg-gray-100 rounded-full">
                            ID: {{ $section->id }}
                        </span>
                    </div>

                    {{-- Description --}}
                    <div class="mb-6">
                        <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Description</h4>
                        <p class="mt-2 text-gray-700 text-lg leading-relaxed">
                            {{ $section->description ?? 'No description provided.' }}
                        </p>
                    </div>

                    {{-- Timestamps --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8 border-t border-gray-100 pt-6">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Created At</dt>
                            <dd class="mt-1 text-gray-900">{{ $section->created_at?->format('M d, Y h:i A') ?? 'N/A' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Last Updated</dt>
                            <dd class="mt-1 text-gray-900">{{ $section->updated_at?->format('M d, Y h:i A') ?? 'N/A' }}</dd>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex justify-end gap-3 mt-6">
                        {{-- Back Button --}}
                        <a href="{{ route('sections.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded shadow hover:bg-gray-300 transition">
                            Back to List
                        </a>

                        {{-- Edit/Delete (Only for Admins/Librarians if needed) --}}
                        @if(auth()->user()->usertype_id == 3) 
                            <a href="{{ route('sections.edit', $section->id) }}" class="bg-indigo-600 text-white px-4 py-2 rounded shadow hover:bg-indigo-700 transition">
                                Edit Section
                            </a>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>