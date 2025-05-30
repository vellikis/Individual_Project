<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Frequently Asked Questions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto space-y-4 px-6 sm:px-8 lg:px-10">
            @foreach ([
        [
            'q' => 'What undergraduate and postgraduate programs does City College in Thessaloniki offer?',
            'a' => 'City College offers Bachelor’s degrees in Computer Science, Business Studies, Psychology, and English Language, Linguistics and Literature, plus Master’s programs in Software Development, Cognitive Neuropsychology and International Relations and European Union Studies.',
        ],
        ['q' => 'How can I collaborate on a research or development project at City College?', 'a' => 'Browse our Projects page to see ongoing projects. Then reach out to the administrators via the contact form. We get back to you as soon as possible.'],
        ['q' => 'What student life and extracurricular activities are available on campus?', 'a' => 'CITY College is an exciting place to study in.  Student life goes far beyond classrooms, essays and exams. There’s so much to do. Student clubs and societies, parties, excursions and numerous events enrich the overall student experience.Through a diverse selection of club activities we offer our students the opportunity to acquire new skills, improve existing ones and become more knowledgeable in a particular area of interest.'],
    ] as $item)
                <div x-data="{ open: false }" class="border border-gray-200 rounded-lg overflow-hidden">
                    <button @click="open = !open"
                        class="w-full flex items-center
                     pl-12 pr-6 py-5
                     bg-[#fc6120] text-white text-2xl font-semibold tracking-wide
                     focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#fc6120]">
                        <!-- flex-1 + text-center to center the question text -->
                        <span class="flex-1 text-center">
                            {{ $item['q'] }}
                        </span>

                        <svg :class="open ? 'rotate-180' : ''" class="h-6 w-6 transition-transform duration-200"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="open" x-transition
                        class="pl-12 pr-6 py-6
                     bg-white text-gray-700 text-lg tracking-wide text-center">
                        {{ $item['a'] }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
