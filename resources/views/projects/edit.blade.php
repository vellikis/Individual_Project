{{-- resources/views/projects/edit.blade.php --}}
@php
    $isParticipant = auth()->user()->user_type === 'participant';
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Project') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <form action="{{ route('projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @if ($isParticipant)
                        {{-- Participant can only edit Description --}}
                        <div class="mb-4">
                            <x-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" class="w-full mt-1 rounded border-gray-300" rows="4" required>{{ old('description', $project->description) }}</textarea>
                            @error('description')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    @else
                        {{-- Admin/Owner: Full form --}}
                        <div class="mb-4">
                            <x-label for="title" :value="__('Title')" />
                            <x-input id="title" name="title" type="text" class="w-full mt-1"
                                value="{{ old('title', $project->title) }}" required />
                            @error('title')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <x-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" class="w-full mt-1 rounded border-gray-300" rows="4" required>{{ old('description', $project->description) }}</textarea>
                            @error('description')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        @if ($project->images->isNotEmpty())
                            <div class="mb-6">
                                <x-label :value="__('Existing Images')" />
                                <ul class="mt-2 list-disc list-inside">
                                    @foreach ($project->images as $img)
                                        <li class="flex items-center space-x-2">
                                            <label class="flex items-center space-x-2">
                                                <input type="checkbox" name="delete_images[]"
                                                    value="{{ $img->id }}"
                                                    class="form-checkbox h-5 w-5 text-red-600" />
                                                <span class="text-gray-800 break-all">
                                                    {{ \Illuminate\Support\Str::afterLast($img->image_path, '/') }}
                                                </span>
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                                <p class="text-sm text-gray-500 mt-1">
                                    {{ __('Check any file to remove it; leave unchecked to keep it.') }}
                                </p>
                            </div>
                        @endif

                        <div class="mb-4">
                            <x-label for="images" :value="__('Add New Images')" />
                            <input type="file" name="images[]" multiple accept="image/*" class="form-control mt-1" />
                            @error('images.*')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <x-label for="partner_name" :value="__('Partner Name')" />
                            <x-input id="partner_name" name="partner_name" type="text" class="w-full mt-1"
                                value="{{ old('partner_name', $project->partner_name) }}" required />
                            @error('partner_name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <x-label for="partner_link" :value="__('Partner Link (URL)')" />
                            <x-input id="partner_link" name="partner_link" type="url" class="w-full mt-1"
                                value="{{ old('partner_link', $project->partner_link) }}" required />
                            @error('partner_link')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <x-label for="participants" :value="__('Participants')" />
                            <textarea id="participants" name="participants" class="w-full mt-1 rounded border-gray-300" rows="3">{{ old('participants', $project->participants) }}</textarea>
                            @error('participants')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <x-label for="department" :value="__('Department')" />
                            <select id="department" name="department" class="w-full mt-1 border rounded" required>
                                @foreach (['Computer Science Department', 'Business Studies Department', 'Psychology Department', 'English Language Department'] as $dept)
                                    <option value="{{ $dept }}"
                                        {{ old('department', $project->department) === $dept ? 'selected' : '' }}>
                                        {{ $dept }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-6">
                            <x-label for="status" :value="__('Status')" />
                            <select id="status" name="status" class="w-full mt-1 border rounded" required>
                                <option value="on going"
                                    {{ old('status', $project->status) === 'on going' ? 'selected' : '' }}>
                                    {{ __('On going') }}
                                </option>
                                <option value="completed"
                                    {{ old('status', $project->status) === 'completed' ? 'selected' : '' }}>
                                    {{ __('Completed') }}
                                </option>
                            </select>
                        </div>
                    @endif

                    {{-- Form Actions --}}
                    <div class="flex justify-end">
                        <a href="{{ route('projects.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 mr-2">
                            {{ __('Cancel') }}
                        </a>
                        <x-button type="submit" class="bg-indigo-600 hover:bg-indigo-700">
                            {{ __('Update Project') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
