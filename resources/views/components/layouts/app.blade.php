<!DOCTYPE html>
<html lang="en" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" x-init="$watch('darkMode', value => localStorage.setItem('darkMode', value))" x-bind:class="{ 'dark': darkMode }">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Livewire Social</title>

    <!-- Ensure dark mode is applied before the content loads -->
    <script>
        if (localStorage.getItem('darkMode') === 'true' ||
            (!localStorage.getItem('darkMode') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.css"
        integrity="sha512-vEia6TQGr3FqC6h55/NdU3QSM5XR6HSl5fW71QTKrgeER98LIMGwymBVM867C1XHIkYD9nMTfWK2A0xcodKHNA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.js"
        integrity="sha512-aGWPnmdBhJ0leVHhQaRASgb0InV/Z2BWsscdj1Vwt29Oic91wECPixuXsWESpFfCcYPLfOlBZzN2nqQdMxlGTQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-100 dark:bg-slate-900 dark:text-white">
    @auth
        <div class="w-full bg-white px-4 md:px-8 lg:px-16 xl:px-32 2xl:px-64 z-50 sticky top-0 dark:bg-slate-900">
            <livewire:layouts.navbar />

        </div>
    @endauth

    <div class="w-full px-4 md:px-8 lg:px-16 xl:px-32 2xl:px-64">
        {{ $slot }}
    </div>


</body>

</html>
