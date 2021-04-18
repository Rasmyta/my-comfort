<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" />

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @livewireStyles

    <!-- Alpine -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="{{ asset('js/intranet/init-alpine.js') }}"></script>

    <!-- Charts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>
    <script src="{{ asset('js/intranet/charts-lines.js') }}" defer></script>
    <script src="{{ asset('js/intranet/charts-pie.js') }}" defer></script>
</head>

<body>
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">

        @include("intranet.sidebar")

        <div class="flex flex-col flex-1 w-full">

            @include("intranet.header")

            <main class="h-full overflow-y-auto">
                <div class="container px-6 mx-auto grid">

                    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                        {{ $title }}
                    </h2>

                    {{ $slot }}

                </div>
            </main>
        </div>


    </div>

    @stack('modals')

    @livewireScripts
</body>

</html>
