<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Welcome | City College</title>

    <!-- Fonts & Styles -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .fade-in {
            animation: fadeIn 1s ease-out forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body
    class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC] flex p-6 lg:p-8 items-center justify-center min-h-screen flex-col font-[figtree]">

    <!-- Main Content -->
    <main class="text-center fade-in">
        <!-- Optional Icon or Logo -->
        <div class="mb-6">
            <img src="{{ asset('storage/citycollegelogo.png') }}" alt="City College Logo"
                class="w-23 h-20 mx-auto shadow-md dark:shadow-white/10">
        </div>

        <h1 class="text-4xl lg:text-5xl font-bold mb-4">
            Welcome to City College
        </h1>
        <p class="text-lg text-gray-600 dark:text-gray-400 mb-8 max-w-xl mx-auto">
            Discover our projects and actions.
        </p>

        @if (Route::has('register'))
            <a href="{{ route('register') }}"
                class="inline-block bg-orange-600 hover:bg-orange-700 text-white px-6 py-3 rounded-lg text-base font-semibold transition">
                Join Now
            </a>
        @endif
        @if (Route::has('login'))
            <a href="{{ route('login') }}"
                class="inline-block bg-orange-600 hover:bg-orange-700 text-white px-6 py-3 rounded-lg text-base font-semibold transition">
                Log in
            </a>
        @endif
    </main>

</body>

</html>
