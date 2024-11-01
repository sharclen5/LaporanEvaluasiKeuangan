@props(['province'])

<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <title>{{ $title }}</title>
</head>

<body class="h-full">

    <div class="min-h-full">
        @if (!request()->routeIs('index', 'home'))
            <x-navbar :province="$province"></x-navbar>
        @else 
            <x-navbarhome></x-navbarhome>
        @endif

        @if (!request()->routeIs('index', 'home'))
            <x-header>{{ $title }}</x-header>
            @else 
            <x-header />
        @endif
        

        <main>
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </main>

    </div>



    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="./assets/vendor/d3/d3.min.js"></script>
    <script src="./assets/vendor/topojson/build/topojson.min.js"></script>
    <script src="./assets/vendor/datamaps/dist/datamaps.world.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    @vite('resources/js/app.js')
</body>

</html>
