<x-layout>

    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @foreach ($provinces->sortBy('name') as $province)
            <div class="bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <a href="{{ url('/' . $province->name . '/dashboard') }}">
                <div class="flex justify-center items-center mb-2 mt-2">
                <img class="rounded-lg w-56 h-56" src="/images/{{ $province->name }}.png"
                    alt="{{ $province->name }}" />
                </div>
                <div class="p-2 h-16 bg-blue-500 rounded-lg flex justify-center items-center">
                <h5 class="text-2xl text-center font-bold tracking-tight text-white dark:text-white">
                    {{ $province->name }}</h5>
                </div>
            </a>
            </div>
        @endforeach
    </div>

    <div class="mt-4 px-2 flex justify-center">
        {{ $provinces->links() }} <!-- Pagination links -->
    </div>

    

</x-layout>
