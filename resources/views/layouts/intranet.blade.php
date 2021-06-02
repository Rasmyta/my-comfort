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
    <link rel="stylesheet" href="https://unpkg.com/filepond/dist/filepond.css" />
    <link rel="stylesheet"
        href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css">

    @livewireStyles

    <!-- Alpine -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="{{ asset('js/intranet/init-alpine.js') }}"></script>

    <!-- Charts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
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

    <!-- Tippy Tooltips (Development) -->
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.min.js"></script>
    <script src="https://unpkg.com/tippy.js@6/dist/tippy-bundle.umd.js"></script>
    <!-- Tippy Tooltips (Production)
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6"></script>

    <script src="{{ asset('js/custom.js') }}" defer></script>
    -->


    <script>
        $('document').ready(function() {
            // Tooltips
            tippy("#tooltipExport", {
                content: "No se seleccionaron elementos!",
            });
            tippy(".tooltipTimetable", {
                content: "Haz doble click para editar",
            });

            editTimetable();
        });

        function editTimetable() {
            let confirm = document.getElementById('confirm-time');
            [].forEach.call(document.getElementsByClassName('weekDays'), function(row) {
                let inputs = row.querySelectorAll('input');

                row.addEventListener('dblclick', event => {
                    inputs.forEach(input => {
                        input.style.background = '#F9E79F';
                        input.removeAttribute('disabled');

                        confirm.style.display = 'block';
                    });
                });

            });
        }

    </script>

    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>

</body>

</html>
