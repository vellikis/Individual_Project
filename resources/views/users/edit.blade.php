<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-xl mx-auto">
        <form method="POST" action="{{ route('users.update', $user->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label>Name</label>
                <input type="text" name="name" class="border rounded w-full" value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="mb-4">
                <label>Email</label>
                <input type="email" name="email" class="border rounded w-full" value="{{ old('email', $user->email) }}" required>
            </div>
            <div class="mb-4">
                <label>User Type</label>
                <select name="user_type" class="border rounded w-full" required>
                    <option value="public visitor" {{ $user->user_type == 'public_visitor' ? 'selected' : '' }}>Public visitor</option>
                    <option value="admin" {{ $user->user_type == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="partner" {{ $user->user_type == 'partner' ? 'selected' : '' }}>Partner</option>
                    <option value="participant" {{ $user->user_type == 'participant' ? 'selected' : '' }}>Participant</option>
                </select>
            </div>

            <div x-data="{ open: false }" class="relative inline-block w-full">
                <x-label for="projects" :value="__('Select Projects')" />

                <button type="button" @click="open = !open"
                    class="w-full px-4 py-2 text-left border border-gray-300 rounded shadow-sm bg-white focus:outline-none mb-4">
                    Assign Projects
                </button>

                <div x-show="open" @click.away="open = false"
                    class="absolute z-10 mt-2 w-full bg-white border border-gray-300 rounded shadow-lg max-h-60 overflow-y-auto">
                    <div class="p-2 space-y-1">
                        @foreach($projects as $project)
                            <label class="flex items-center space-x-2">
                            <input type="checkbox" name="projects[]" value="{{ $project->id }}"
    class="text-indigo-600 border-gray-300 rounded focus:ring-indigo-500"
    {{ $user->projects->contains('id', $project->id) ? 'checked' : '' }}>

                                <span>{{ $project->title }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <a href="{{ route('users.index') }}"
                class="mr-2 inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition ease-in-out duration-150">
                    Cancel
                </a>
                <x-button type="submit">Update</x-button>
            </div>
        </form>
    </div>
</x-app-layout>
