<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Welcome') }}
        </h2>
    </x-slot>

    <div class="py-12">
        {{-- Banner --}}
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 mb-8">
            <div class="bg-[#fc6120] text-white rounded-lg p-6 text-center text-xl sm:text-xl">
                <p>Take a Look at Our Highlighted Projects</p>
            </div>
        </div>
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 mt-8">
            <!-- Swiper container -->
            <div class="swiper rounded-lg shadow-lg">
                <div class="swiper-wrapper">
                    <!-- Slide 1 -->
                    <div class="swiper-slide">
                        <a href="/projects/1" class="block w-full h-96 overflow-hidden">
                            <img src="/storage/city-college.jpg" class="w-full h-full object-cover" alt="Project 1">
                        </a>
                    </div>
                    <!-- Slide 2 -->
                    <div class="swiper-slide">
                        <a href="/projects/2" class="block w-full h-96 overflow-hidden">
                            <img src="/storage/images.jpeg" class="w-full h-full object-cover" alt="Project 2">
                        </a>
                    </div>
                </div>

                <!-- Navigation arrows -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
                <!-- Pagination dots -->
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new Swiper('.swiper', {
                loop: true,
                slidesPerView: 1,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
            });
        });
    </script>




    <div class="mt-8 px-6 sm:px-8 md:px-12 lg:px-16">
        <div class="max-w-3xl mx-auto bg-orange-500 text-white rounded-lg p-6 text-center text-xl sm:text-xl"
            style="background-color: #fc6120;">
            <p>
                CITY College, University of York Europe Campus has been granted International Campus status by the
                University of York and it is part of the University of York community, one of the leading UK
                Universities in Europe. Bridging the UK with the South East and Eastern Europe, CITY College offers to
                students the unique opportunity to study for a top class British degree in their region.
            </p>
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-center">
            <a href="https://york.citycollege.eu/m/index.php?chlang=GR_EL"
                style="background-color: #fc6120; min-width: 360px;"
                class="inline-block text-white font-bold text-2xl px-16 py-6 rounded-lg shadow hover:opacity-90 transition text-center">
                Visit City College
            </a>
        </div>
    </div>

    <div class="mt-8 px-6 sm:px-8 md:px-12 lg:px-16">
        <div class="max-w-3xl mx-auto bg-[#fc6120] text-white rounded-lg p-6 flex flex-col sm:flex-row items-center gap-6"
            style="background-color: #fc6120;">
            <!-- Left: Image -->
            <div class="w-full sm:w-1/3 flex justify-center">
                <img src="/storage/phone1.png" alt="Contact preview"
                    class="w-full max-w-xs h-auto rounded-md object-cover">
            </div>

            <!-- Title Text Button -->
            <div class="w-full sm:w-2/3 text-center">
                <h3 class="text-2xl font-semibold mb-2">
                    Don't hesitate to contact us!
                </h3>
                <p class="text-base mb-4">
                    Here you’ll find all the ways to reach us—phone, email, our address, and social media links. We’re
                    always happy to answer your questions or welcome you on campus!
                </p>

                <!-- container -->
                <div class="flex justify-center">
                    <a href="{{ route('contact.index') }}"
                        style="background-color: #ffffff; color: #fc6120; min-width: 250px;"
                        class="inline-block font-bold text-xl px-16 py-4 rounded-lg shadow border border-[#fc6120] hover:bg-[#fc6120] hover:text-white transition text-center">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-8 px-6 sm:px-8 md:px-12 lg:px-16">
        <div class="max-w-3xl mx-auto bg-[#fc6120] text-white rounded-lg p-6 flex flex-col sm:flex-row items-center gap-6"
            style="background-color: #fc6120;">
            <!-- Left: Image -->
            <div class="w-full sm:w-1/3">
                <img src="/storage/question.png" alt="Contact preview" class="w-full h-auto rounded-md object-cover">
            </div>

            <!-- Title Text Button -->
            <div class="w-full sm:w-2/3 text-center">
                <h3 class="text-2xl font-semibold mb-2">
                    Do you have any questions?
                </h3>
                <p class="text-base mb-4">
                    Here you’ll find all the popular questions that we have been asked along the years. Feel free to
                    check this page and learn more about us.
                </p>

                <!-- container -->
                <div class="flex justify-center">
                    <a href="{{ route('faq.index') }}"
                        style="background-color: #ffffff; color: #fc6120; min-width: 250px;"
                        class="inline-block font-bold text-xl px-16 py-4 rounded-lg shadow border border-[#fc6120] hover:bg-[#fc6120] hover:text-white transition text-center">
                        FAQ
                    </a>
                </div>
            </div>
        </div>
    </div>

    <style>
        .swiper-button-next,
        .swiper-button-prev {
            color: #fc6120 !important;
            background: white !important;
            width: 50px !important;
            height: 50px !important;
            border-radius: 50% !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2) !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
        }

        /* Adjust arrow positioning inside the circle */
        .swiper-button-next::after,
        .swiper-button-prev::after {
            font-size: 24px !important;
            font-weight: bold !important;
        }

        /* Custom Swiper navigation arrows */
        .swiper-button-next,
        .swiper-button-prev {
            color: #fc6120 !important;
        }

        /* Custom Swiper pagination bullets */
        .swiper-pagination-bullet {
            background: #fc6120 !important;
            opacity: 0.5 !important;
        }

        .swiper-pagination-bullet-active {
            opacity: 1 !important;
        }
    </style>

</x-app-layout>
