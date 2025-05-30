<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contact Us') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto space-y-6 px-6 sm:px-8 lg:px-10">


            {{-- Accordion data --}}
            @php
                $contacts = [
                    [
                        'title' => 'Phone',
                        'body' => '<p>Tel: (+30) 2310 224 186, 275 575</p>
                                    <p>Fax: (+30) 2310 287 564</p>',
                    ],
                    [
                        'title' => 'Email',
                        'body' => '<p>
                                      <a href="mailto:acadreg@york.citycollege.eu" 
                                         class="underline hover:text-gray-200">
                                        acadreg@york.citycollege.eu
                                      </a>
                                    </p>',
                    ],
                    [
                        'title' => 'Address',
                        'body' => '<p>3, Leontos Sofou Street,<br/>546 26 Thessaloniki, Greece</p>
                                    <p>24, Proxenou Koromila Street,<br/>546 22 Thessaloniki, Greece</p>',
                    ],
                    [
                        'title' => 'Social Media',
                        'body' => '<div class="flex flex-col items-center space-y-2">
                                      <a href="https://www.facebook.com/citycollegethess/" 
                                         target="_blank" class="underline hover:text-gray-200">
                                         Facebook
                                      </a>
                                      <a href="https://www.instagram.com/citycollegethess/" 
                                         target="_blank" class="underline hover:text-gray-200">
                                         Instagram
                                      </a>
                                      <a href="https://www.linkedin.com/company/citycollegethess/" 
                                         target="_blank" class="underline hover:text-gray-200">
                                         LinkedIn
                                      </a>
                                    </div>',
                    ],
                ];
            @endphp

            {{-- Accordions --}}
            @foreach ($contacts as $section)
                <div x-data="{ open: false }" class="border border-gray-200 rounded-lg overflow-hidden">
                    <button @click="open = !open"
                        class="w-full flex items-center justify-center
                               px-6 py-4
                               bg-[#fc6120] text-white text-2xl font-semibold tracking-wide
                               hover:bg-orange-600 transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fc6120]">
                        <span class="flex-1 text-center">{{ $section['title'] }}</span>
                        <svg :class="open ? 'rotate-180' : ''" class="h-6 w-6 transition-transform duration-200"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="open" x-transition.duration.200ms
                        class="px-6 py-5 bg-white text-gray-700 text-lg tracking-wide text-center">
                        {!! $section['body'] !!}
                    </div>
                </div>
            @endforeach

            {{-- Success flash --}}
            @if (session('success'))
                <div class="px-6 py-4 bg-green-100 text-green-800 rounded-lg text-center">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Contact form --}}
            <div class="mt-12 bg-white p-8 rounded-lg shadow">
                <h3 class="text-2xl font-semibold mb-4 text-center">Send us a message</h3>

                <form action="{{ route('contact.send') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-gray-700 font-medium">Your Name</label>
                        <input name="name" type="text" value="{{ old('name') }}"
                            class="w-full mt-1 p-3 border rounded @error('name') border-red-500 @enderror" />
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium">Your Email</label>
                        <input name="email" type="email" value="{{ old('email') }}"
                            class="w-full mt-1 p-3 border rounded @error('email') border-red-500 @enderror" />
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-700 font-medium">Message</label>
                        <textarea name="message" rows="5"
                            class="w-full mt-1 p-3 border rounded @error('message') border-red-500 @enderror">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-center">
                        <button type="submit"
                            class="px-6 py-3 bg-[#fc6120] text-white font-semibold rounded hover:bg-orange-600 transition">
                            Send Message
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
