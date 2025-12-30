<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Library Sections') }}
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

            {{-- LOGIC: Check User Type --}}
            {{-- Assuming ID 3 is Admin. Adjust if your Admin ID is different. --}}
            @if(auth()->user()->usertype_id === 3) 

                {{-- ========================================== --}}
                {{--  ADMIN VIEW: Management Table              --}}
                {{-- ========================================== --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex justify-between mb-4">
                        <h3 class="text-lg font-bold">Manage Sections</h3>
                        <a href="{{ route('sections.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            + Add New Section
                        </a>
                    </div>

                    <table class="table-auto w-full border-collapse border border-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="border p-2 text-left">ID</th>
                                <th class="border p-2 text-left">Section Name</th>
                                <th class="border p-2 text-left">Description</th>
                                <th class="border p-2 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sections as $section)
                                <tr class="hover:bg-gray-50">
                                    <td class="border p-2">{{ $section->id }}</td>
                                    <td class="border p-2 font-bold">{{ $section->section_name }}</td>
                                    <td class="border p-2 text-gray-600">{{ Str::limit($section->description, 50) }}</td>
                                    <td class="border p-2 text-center">
                                        <a href="{{ route('sections.edit', $section->id) }}" class="text-yellow-600 hover:text-yellow-900 mr-2">Edit</a>
                                        
                                        <form action="{{ route('sections.destroy', $section->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <div class="mt-4">{{ $sections->links() }}</div>
                </div>

            @else

                {{-- ========================================== --}}
                {{--  STUDENT / TEACHER VIEW: Selection Cards   --}}
                {{-- ========================================== --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        
                        <h3 class="text-lg font-bold mb-4">Where would you like to go?</h3>

                        <div class="space-y-4">
                            @foreach($sections as $section)
                                <div class="flex flex-col md:flex-row justify-between items-center border border-gray-200 rounded-lg p-4 hover:bg-gray-50 transition">
                                    
                                    <div class="mb-4 md:mb-0">
                                        <h4 class="text-xl font-bold text-blue-600">
                                            {{ $section->section_name }}
                                        </h4>
                                        <p class="text-gray-600 text-sm mt-1 max-w-2xl">
                                            {{ $section->description ?? 'No description available for this section.' }}
                                        </p>
                                    </div>

                                    <div class="flex-shrink-0 ml-4">
                                        
                                        {{-- LOGIC START --}}
                                        @if(auth()->user()->usertype_id == 1)
                                            {{-- STUDENT: Goes to Create Page --}}
                                            <a href="{{ route('reservations.create', ['section_id' => $section->id]) }}" 
                                               class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow transition transform hover:scale-105">
                                                Book Now →
                                            </a>

                                        @elseif(auth()->user()->usertype_id == 2)
                                            {{-- LIBRARIAN: Goes to Index Page (Filtered) --}}
                                            <a href="{{ route('reservations.index', ['section_id' => $section->id]) }}" 
                                               class="inline-block bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-lg shadow transition transform hover:scale-105">
                                                View Bookings →
                                            </a>
                                        @endif
                                        {{-- LOGIC END --}}

                                    </div>

                                </div>
                            @endforeach
                        </div>

                        @if($sections->isEmpty())
                            <p class="text-center text-gray-500 py-4">No sections available at the moment.</p>
                        @endif

                    </div>
                </div>

            @endif

        </div>
    </div>
</x-app-layout>