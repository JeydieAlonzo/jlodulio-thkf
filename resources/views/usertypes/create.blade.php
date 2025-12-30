<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create User Type') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                {{-- NOTICE: Enum Limitation --}}
                <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6" role="alert">
                    <p class="font-bold">Creation Disabled</p>
                    <p>The "Role" field is set to an <strong>ENUM</strong> in the database. You cannot create new roles dynamically here. To add a new role (like "Intern"), a developer must update the database structure.</p>
                </div>

                {{-- We keep the form structure but disable everything --}}
                <form>
                    <div class="mb-3">
                        <label for="role" class="block font-medium text-gray-700">User Type Role</label>
                        <input 
                            type="text" 
                            class="form-control bg-gray-100 border-gray-300 rounded-md shadow-sm mt-1 block w-full text-gray-500 cursor-not-allowed" 
                            id="role" 
                            name="role" 
                            value="Cannot add new roles" 
                            readonly 
                            disabled>
                    </div>

                    <div class="mt-4">
                        {{-- Disabled Grey Button --}}
                        <button type="button" class="bg-gray-400 text-white px-4 py-2 rounded cursor-not-allowed" disabled>
                            Save Disabled
                        </button>
                        <a href="{{ route('usertypes.index') }}" class="ml-3 text-gray-600 hover:text-gray-900">Go Back</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>