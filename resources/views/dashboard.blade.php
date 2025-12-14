<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Available Library Sections') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
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
                                        {{-- We use Green to distinguish it from the student action --}}
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
                        <p class="text-center text-gray-500 py-4">No sections found. Please ask an admin to add one.</p>
                    @endif

                </div>
            </div>

        </div>
    </div>
</x-app-layout>