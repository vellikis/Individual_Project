{{-- resources/views/projects/index.blade.php --}}
@php $type = Auth::user()->user_type; @endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Projects') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex justify-between px-5 py-5">
                    <h3 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Projects') }}
                    </h3>
                </div>
                <div class="px-5 py-5">

                    <div class="flex items-center justify-between mb-4">
                        <!-- Sort Dropdown -->
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open"
                                class="px-4 py-2 bg-white border rounded shadow-sm hover:bg-gray-50">
                                Sort by:
                                @switch($sort)
                                    @case('created_at')
                                        Date Created
                                    @break

                                    @case('title')
                                        Title
                                    @break

                                    @case('department')
                                        Department
                                    @break

                                    @case('status')
                                        Status
                                    @break

                                    @case('partner_name')
                                        Partner
                                    @break

                                    @default
                                        Newest
                                @endswitch
                                <span class="ml-1 text-xs">{{ strtoupper($direction) }}</span>
                            </button>
                            <div x-show="open" @click.away="open = false"
                                class="absolute mt-1 bg-white border rounded shadow z-10">
                                @foreach (['created_at', 'title', 'department', 'status', 'partner_name'] as $field)
                                    @foreach (['asc', 'desc'] as $dir)
                                        <a href="{{ route('projects.index', array_merge(request()->except('page'), ['sort' => $field, 'direction' => $dir])) }}"
                                            class="block px-4 py-2 text-sm hover:bg-gray-100 {{ $sort == $field && $direction == $dir ? 'font-semibold bg-gray-100' : '' }}">
                                            {{ $field === 'created_at' ? 'Date Created' : Str::title(str_replace('_', ' ', $field)) }}
                                            {{ $dir === 'asc' ? '↑' : '↓' }}
                                        </a>
                                    @endforeach
                                @endforeach
                            </div>
                        </div>

                        <!-- New Project button -->
                        @if (in_array($type, ['admin', 'partner'], true))
                            <a href="{{ route('projects.create') }}">
                                <x-button>Add New Project</x-button>
                            </a>
                        @endif
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto border-collapse whitespace-nowrap">
                            <table class="w-full table-auto border-collapse">
                                <thead>
                                    <tr class="bg-gray-100 border-b">
                                        <th class="px-4 py-2 text-left">Image</th>
                                        <th class="px-4 py-2 text-left">Title</th>
                                        <th class="px-4 py-2 text-left">Partner</th>
                                        <th class="px-4 py-2 text-left">Department</th>
                                        <th class="px-4 py-2 text-left">Status</th>
                                        <th class="px-4 py-2 text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($projects as $project)
                                        @php $firstImage = $project->images->first(); @endphp
                                        <tr class="border-b">
                                            <td class="px-4 py-2">
                                                @if ($firstImage)
                                                    <img src="{{ asset('storage/' . $firstImage->image_path) }}"
                                                        alt="Project Image" class="w-16 h-16 object-cover rounded">
                                                @else
                                                    <span class="text-gray-400 italic">No Image</span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-2">{{ $project->title }}</td>
                                            <td class="px-4 py-2">
                                                <a href="{{ $project->partner_link }}" target="_blank"
                                                    class="text-blue-500 hover:text-blue-700">
                                                    {{ $project->partner_name }}
                                                </a>
                                            </td>
                                            <td class="px-4 py-2">{{ $project->department }}</td>
                                            <td class="px-4 py-2">{{ $project->status }}</td>
                                            <td class="px-4 py-2 text-center">
                                                <!--show preview -->
                                                <a href="{{ route('projects.show', $project->id) }}">
                                                    <x-button class="bg-gray-200 text-gray-800 hover:bg-gray-300">
                                                        Preview
                                                    </x-button>
                                                </a>

                                                <!-- Only admins, partners & participants can edit -->
                                                @if (in_array($type, ['admin', 'partner', 'participant'], true))
                                                    <a href="{{ route('projects.edit', $project->id) }}">
                                                        <x-button>Edit</x-button>
                                                    </a>
                                                @endif

                                                <!-- Only admins can delete -->
                                                @if ($type === 'admin')
                                                    <form action="{{ route('projects.destroy', $project->id) }}"
                                                        method="POST" class="inline-block"
                                                        onsubmit="return confirm('Are you sure?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <x-button
                                                            class="bg-red-600 hover:bg-red-700 ml-2">Delete</x-button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-4">
                                {{ $projects->links() }}
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
