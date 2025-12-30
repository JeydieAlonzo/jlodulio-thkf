<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Schedule') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <h3 class="text-lg font-bold mb-6 border-b pb-2">Schedule Details</h3>

                {{-- Row 1: ID (Full Width) --}}
                <div class="mb-6">
                    <label class="block text-gray-500 text-xs font-bold uppercase tracking-wider">Schedule ID</label>
                    <div class="mt-1 text-gray-900 text-lg">
                        {{ $schedule->id }}
                    </div>
                </div>

                {{-- Row 2: Start and End Time (Side by Side) --}}
                <div class="grid grid-cols-2 gap-10">
                    <div>
                        <label class="block text-gray-500 text-xs font-bold uppercase tracking-wider">Start Time</label>
                        <div class="mt-1 text-gray-900 text-xl font-medium">
                            {{ \Carbon\Carbon::parse($schedule->start_time)->format('g:i A') }}
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-500 text-xs font-bold uppercase tracking-wider">End Time</label>
                        <div class="mt-1 text-gray-900 text-xl font-medium">
                            {{ \Carbon\Carbon::parse($schedule->end_time)->format('g:i A') }}
                        </div>
                    </div>
                </div>

                <div class="mt-8">
                    <a href="{{ route('schedules.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        &larr; Back to List
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>