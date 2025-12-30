<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Schedules') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="alert alert-success mb-4 text-green-700 bg-green-100 p-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between mb-4">
                    <h3 class="text-lg font-bold">Time Slots</h3>
                    <a href="{{ route('schedules.create') }}" class="btn btn-primary bg-blue-500 text-white px-4 py-2 rounded">
                        + Add Schedule
                    </a>
                </div>

                <table class="table-auto w-full border-collapse border border-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="border p-2 text-left">Start Time</th>
                            <th class="border p-2 text-left">End Time</th>
                            <th class="border p-2 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($schedules as $schedule)
                            <tr>
                                {{-- Format time to AM/PM for display --}}
                                <td class="border p-2">{{ \Carbon\Carbon::parse($schedule->start_time)->format('g:i A') }}</td>
                                <td class="border p-2">{{ \Carbon\Carbon::parse($schedule->end_time)->format('g:i A') }}</td>
                                <td class="border p-2 text-center">
                                    <a href="{{ route('schedules.show', $schedule->id) }}" class="text-blue-600 hover:text-blue-900 mr-2">View</a>
                                    <a href="{{ route('schedules.edit', $schedule->id) }}" class="text-yellow-600 hover:text-yellow-900 mr-2">Edit</a>
                                    
                                    <form action="{{ route('schedules.destroy', $schedule->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this schedule?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">{{ $schedules->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>