<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
            {{ $project->title }}
        </h2>
    </x-slot>

    @php
        $imagePaths = $project->images->map(fn($image) => asset('storage/' . $image->image_path));
    @endphp

    <div class="max-w-5xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        <!-- Image Carousel -->
        <div x-data="{ activeSlide: 0, slides: {{ $imagePaths->toJson() }} }" class="relative overflow-hidden rounded-2xl shadow-lg mb-8">
            <!-- Slides -->
            <template x-for="(slide, index) in slides" :key="index">
                <div x-show="activeSlide === index" class="transition-all duration-700">
                    <img :src="slide" class="w-full h-96 object-cover rounded-2xl">
                </div>
            </template>

            <!-- Navigation Buttons -->
            <div class="absolute inset-0 flex items-center justify-between px-4">
                <button @click="activeSlide = (activeSlide === 0) ? slides.length - 1 : activeSlide - 1"
                    class="bg-white p-2 rounded-full shadow hover:bg-gray-100">
                    &#8592;
                </button>
                <button @click="activeSlide = (activeSlide + 1) % slides.length"
                    class="bg-white p-2 rounded-full shadow hover:bg-gray-100">
                    &#8594;
                </button>
            </div>

            <!-- Dots -->
            <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex gap-2">
                <template x-for="(slide, index) in slides" :key="index">
                    <div @click="activeSlide = index"
                        :class="{ 'bg-blue-600': activeSlide === index, 'bg-gray-300': activeSlide !== index }"
                        class="w-3 h-3 rounded-full cursor-pointer transition-all"></div>
                </template>
            </div>
        </div>

        <!-- Project Details -->
        <div class="bg-white p-6 rounded-xl shadow space-y-6">
            <div>
                <strong class="text-gray-700">Description:</strong>
                <p class="text-gray-600 leading-relaxed whitespace-pre-line">
                    {{ $project->description }}
                </p>
            </div>

            <div>
                <strong class="text-gray-700">Partner:</strong>
                <a href="{{ $project->partner_link }}" target="_blank"
                    class="text-blue-600 hover:text-blue-800 underline break-all">
                    {{ $project->partner_name }}
                </a>
            </div>

            <div>
                <strong class="text-gray-700">Participants:</strong>
                <p class="text-gray-600 leading-relaxed whitespace-pre-line">
                    {{ $project->participants ?: '—' }}
                </p>
            </div>

            <div class="flex flex-wrap gap-4 text-sm">
                <div>
                    <strong class="text-gray-700">Status:</strong>
                    <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full">{{ $project->status }}</span>
                </div>
                <div>
                    <strong class="text-gray-700">Department:</strong>
                    <span class="text-gray-800">{{ $project->department }}</span>
                </div>
            </div>

            <!-- Admin/Owner Actions -->
            @if (Auth::user()->user_type === 'admin' || Auth::user()->projects->contains($project->id))
                <div class="flex flex-wrap gap-4 mt-6">
                    <a href="{{ route('projects.edit', $project->id) }}">
                        <x-button>Edit</x-button>
                    </a>

                    @if (Auth::user()->user_type === 'admin')
                        <form action="{{ route('projects.destroy', $project->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this project?')">
                            @csrf
                            @method('DELETE')
                            <x-button class="bg-red-600 hover:bg-red-700">Delete</x-button>
                        </form>
                    @endif
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
