<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Project') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <x-label for="title" :value="__('Title')" />
                        <x-input id="title" name="title" type="text" class="w-full mt-1"
                            value="{{ old('title') }}" required />
                        @error('title')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <x-label for="description" :value="__('Description')" />
                        <textarea id="description" name="description" class="w-full mt-1 rounded border-gray-300">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="mb-4">
                        <x-label for="image" :value="__('Project Image')" />
                        <input type="file" name="images[]" multiple accept="image/*" class="form-control" />
                        @error('image')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <x-label for="partner_name" :value="__('Partner Name')" />
                        <x-input id="partner_name" name="partner_name" type="text" class="w-full mt-1"
                            value="{{ old('partner_name') }}" required />
                        @error('partner_name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <x-label for="partner_link" :value="__('Partner Link (URL)')" />
                        <x-input id="partner_link" name="partner_link" type="url" class="w-full mt-1"
                            value="{{ old('partner_link') }}" required />
                        @error('partner_link')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <x-label for="participants" :value="__('Participants')" />
                        <textarea id="participants" name="participants" class="w-full mt-1 rounded border-gray-300"
                            placeholder="List the participants…">{{ old('participants') }}</textarea>
                        @error('participants')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label>Department</label>
                        <select name="department" class="border rounded w-full" required>
                            <option value='Computer Science Department'>Computer Science Department</option>
                            <option value='Business Studies Department'>Business Studies Department</option>
                            <option value='Psychology Departmen'>Psychology Departmen</option>
                            <option value='English Language Department'>English Language Department</option>
                        </select>
                    </div>

                    <div class="mb-6">
                        <label>Status</label>
                        <select name="status" class="border rounded w-full" required>
                            <option value='on going'>On going</option>
                            <option value='completed'>Completed</option>
                        </select>
                    </div>

                    <div class="flex justify-end">
                        <a href="{{ route('projects.index') }}"
                            class="mr-2 inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition ease-in-out duration-150">
                            Cancel
                        </a>
                        <x-button class="bg-indigo-600 hover:bg-indigo-700">
                            {{ __('Create Project') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
