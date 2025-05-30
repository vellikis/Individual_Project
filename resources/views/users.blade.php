@php
    use Illuminate\Support\Str;
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                {{-- Page Title --}}
                <div class="px-5 py-5">
                    <h3 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Users') }}
                    </h3>
                </div>

                <div class="px-5 py-5">
                    {{-- Sort + Add User Bar --}}
                    <div class="flex items-center justify-between mb-4">
                        {{-- Sort Dropdown --}}
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" class="px-4 py-2 bg-white border rounded">
                                Sort by:
                                @switch($sort)
                                    @case('created_at')
                                        Date Registered
                                    @break

                                    @case('name')
                                        Name
                                    @break

                                    @case('email')
                                        Email
                                    @break

                                    @case('user_type')
                                        Type
                                    @break

                                    @default
                                        Date Registered
                                @endswitch
                                <span class="ml-1 text-xs">{{ strtoupper($direction) }}</span>
                            </button>

                            <div x-show="open" @click.away="open = false"
                                class="absolute mt-1 bg-white border rounded shadow z-10">
                                @foreach (['created_at', 'name', 'email', 'user_type'] as $field)
                                    @foreach (['asc', 'desc'] as $dir)
                                        <a href="{{ route('users.index', array_merge(request()->except('page'), ['sort' => $field, 'direction' => $dir])) }}"
                                            class="block px-4 py-2 text-sm hover:bg-gray-100 {{ $sort == $field && $direction == $dir ? 'font-semibold bg-gray-100' : '' }}">
                                            {{ $field === 'created_at' ? 'Date Registered' : Str::title(str_replace('_', ' ', $field)) }}
                                            {{ $dir === 'asc' ? '↑' : '↓' }}
                                        </a>
                                    @endforeach
                                @endforeach
                            </div>
                        </div>

                        {{-- Add New User --}}
                        @if (auth()->user()->user_type !== 'partner')
                            <a href="{{ route('users.create') }}">
                                <x-button>Add new user</x-button>
                            </a>
                        @endif
                    </div>

                    {{-- Users Table --}}
                    <div class="overflow-x-auto">
                        <table class="w-full table-fixed border-collapse">
                            <thead>
                                <tr class="bg-gray-100 border-b">
                                    <th class="w-1/3 px-6 py-3 text-left">Name</th>
                                    <th class="w-1/3 px-6 py-3 text-left">Email</th>
                                    <th class="w-1/6 px-6 py-3 text-left">User Type</th>
                                    <th class="w-1/6 px-6 py-3 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr class="border-b">
                                        <td class="px-6 py-2 whitespace-nowrap">{{ $user->name }}</td>
                                        <td class="px-6 py-2 whitespace-nowrap">{{ $user->email }}</td>
                                        <td class="px-6 py-2 whitespace-nowrap capitalize">{{ $user->user_type }}</td>
                                        <td class="px-6 py-2 text-center whitespace-nowrap">
                                            <a href="{{ route('users.edit', $user->id) }}">
                                                <x-button>Edit</x-button>
                                            </a>

                                            @if (auth()->user()->user_type !== 'partner')
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                    class="inline-block" onsubmit="return confirm('Are you sure?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <x-button class="bg-red-600 hover:bg-red-700 ml-2">
                                                        Delete
                                                    </x-button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{-- Pagination (sort & direction) --}}
                        <div class="mt-4">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
