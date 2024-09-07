<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Livewire Social</title>
    @livewireStyles
    @vite('resources/css/app.css')
</head>

<body class="bg-slate-100">
    @auth
        <div class="w-full bg-white px-4 md:px-8 lg:px-16 xl:px-32 2xl:px-64 sticky top-0">
            <livewire:layouts.navbar />
        </div>
    @endauth

    <div class="w-full px-4 md:px-8 lg:px-16 xl:px-32 2xl:px-64">
        {{ $slot }}
    </div>
    @livewireScripts
</body>

</html>
