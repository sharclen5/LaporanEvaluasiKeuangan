<x-layout :province="$province">
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="flex justify-center space-x-4">
        @foreach (['pendapatan' => 'Pendapatan', 'belanja' => 'Belanja', 'pembiayaan' => 'Pembiayaan'] as $key => $label)
            <div class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                <div class="flex justify-between items-start w-full">
                    <div class="flex-col items-center">
                        <div class="flex items-center mb-1">
                            <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white me-1">
                                Realisasi {{ $label }} {{ $province }}
                            </h5>
                        </div>
                        <div class="flex items-center mb-4">
                            <form action="{{ route('dashboard', $province) }}" method="GET">
                                <label for="year" class="mr-2 text-gray-700 dark:text-gray-200">Pilih Tahun:</label>
                                <select name="year" id="year" class="p-2 border border-gray-300 rounded dark:bg-gray-700 dark:text-gray-300" onchange="this.form.submit()">
                                    @foreach ($years as $year)
                                        <option value="{{ $year }}" {{ $year == $selectedYear ? 'selected' : '' }}>{{ $year }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Pie Chart -->
                <div class="py-6" id="{{ $key }}-chart" data-percentage="{{ $percentages[$key] }}"></div>
            </div>
        @endforeach
    </div>
</x-layout>
