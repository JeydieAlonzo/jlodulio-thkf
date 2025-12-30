<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Schedule</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if ($errors->any())
                    <div class="alert alert-danger mb-4 text-red-600">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('schedules.store') }}" method="POST">
                    @csrf 

                    <div class="grid grid-cols-2 gap-4">
                        <div class="mb-3">
                            <label for="start_time" class="block font-medium text-gray-700">Start Time</label>
                            <input type="time" class="form-control border-gray-300 rounded-md shadow-sm mt-1 block w-full" 
                                id="start_time" name="start_time" value="{{ old('start_time') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="end_time" class="block font-medium text-gray-700">End Time</label>
                            <input type="time" class="form-control border-gray-300 rounded-md shadow-sm mt-1 block w-full" 
                                id="end_time" name="end_time" value="{{ old('end_time') }}" required>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Save</button>
                        <a href="{{ route('schedules.index') }}" class="ml-3 text-gray-600">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>