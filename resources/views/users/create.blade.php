<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            {{ __('Create User') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-xl mx-auto">
        <form method="POST" action="{{ route('users.store') }}">
            @csrf

            <div class="mb-4">
                <label>Name</label>
                <input type="text" name="name" class="border rounded w-full" required>
            </div>

            <div class="mb-4">
                <label>Email</label>
                <input type="email" name="email" class="border rounded w-full" required>
            </div>

            <div class="mb-4">
                <label>Password</label>
                <input type="password" name="password" class="border rounded w-full" required>
            </div>

            <div class="mb-4">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" class="border rounded w-full" required>
            </div>

            <div class="mb-4">
                <label>User Type</label>
                <select name="user_type" class="border rounded w-full" required>
                    <option value='public_visitor'>Public Visitor</option>
                    <option value='admin'>Admin</option>
                    <option value='partner'>Partner</option>
                    <option value='participant'>Participant</option>
                </select>
            </div>

            <div x-data="{ open: false }" class="relative inline-block w-full">
                <x-label for="projects" :value="__('Select Projects')" />

                <button type="button" @click="open = !open"
                    class="w-full px-4 py-2 text-left border border-gray-300 rounded shadow-sm bg-white focus:outline-none">
                    Assign Projects
                </button>

                <div x-show="open" @click.away="open = false"
                    class="absolute z-10 mt-2 w-full bg-white border border-gray-300 rounded shadow-lg max-h-60 overflow-y-auto">
                    <div class="p-2 space-y-1">
                        @foreach($projects as $project)
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" name="projects[]" value="{{ $project->id }}"
                                    class="text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                <span>{{ $project->title }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>

            <x-button type="submit">Create</x-button>
        </form>
    </div>
</x-app-layout>
