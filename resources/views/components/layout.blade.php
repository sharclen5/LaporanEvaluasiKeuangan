<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />
    <title>{{ $title }}</title>
</head>

<body class="h-full">

    <div class="min-h-full">
        <x-navbar></x-navbar>
        <x-header>{{ $title }}</x-header>

        <main>
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            {{ $slot }}
            </div>
        </main>

    </div>



    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    @vite('resources/js/app.js')
</body>

</html>
