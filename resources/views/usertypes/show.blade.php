<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View User Type') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <h3 class="text-lg font-bold mb-4 border-b pb-2">User Type Details</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- ID Field --}}
                    <div>
                        <label class="block font-medium text-gray-500 text-sm uppercase tracking-wider">System ID</label>
                        <div class="mt-1 p-3 bg-gray-50 border rounded text-gray-900 font-mono">
                            {{ $usertype->id }}
                        </div>
                    </div>

                    {{-- Role Name Field --}}
                    <div>
                        <label class="block font-medium text-gray-500 text-sm uppercase tracking-wider">Role Name</label>
                        <div class="mt-1 p-3 bg-gray-50 border rounded text-gray-900 font-bold">
                            {{ $usertype->role }}
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex items-center">
                    <a href="{{ route('usertypes.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        &larr; Back to List
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>