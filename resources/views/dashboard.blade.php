<x-layout :province="$province">
    <x-slot:title>{{ $title }}</x-slot:title>

    <!-- Responsive grid container for side-by-side layout -->
    <div class="flex flex-wrap justify-center md:justify-start space-y-4 md:space-y-0 md:space-x-4">
        @foreach (['pendapatan' => 'Pendapatan', 'belanja' => 'Belanja', 'pembiayaan' => 'Pembiayaan'] as $key => $label)
            <div class="max-w-sm w-full md:w-1/3 bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                <div class="flex flex-col space-y-4">
                    <div>
                        <h5 class="text-lg md:text-xl font-bold leading-none text-gray-900 dark:text-white">
                            Realisasi {{ $label }} {{ $province }}
                        </h5>
                    </div>

                    <form action="{{ route('dashboard', $province) }}" method="GET" class="year-form">
                        <input type="hidden" name="year_pendapatan" value="{{ $selectedYears['pendapatan'] }}">
                        <input type="hidden" name="year_belanja" value="{{ $selectedYears['belanja'] }}">
                        <input type="hidden" name="year_pembiayaan" value="{{ $selectedYears['pembiayaan'] }}">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-2 sm:space-y-0 sm:space-x-2">
                            <label for="year-{{ $key }}" class="text-gray-700 dark:text-gray-200">
                                Pilih Tahun:
                            </label>
                            <select name="year_{{ $key }}" id="year-{{ $key }}" 
                                class="p-2 border border-gray-300 rounded dark:bg-gray-700 dark:text-gray-300 w-full sm:w-auto" 
                                onchange="updateURL(this)">
                                @foreach ($years as $year)
                                <option value="{{ $year }}" {{ $year == $selectedYears[$key] ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>

                <div class="mt-8 flex items-center justify-center h-60 sm:h-80" id="{{ $key }}-chart" data-percentage="{{ $percentages[$key] }}">
                    @if (is_null($percentages[$key]))
                        <p class="text-center text-gray-600 dark:text-gray-400">
                            Data Kosong, Silahkan Isi Terlebih Dahulu
                        </p>
                    @else
                        <div></div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <script>
        const updateURL = (selectElement) => {
            const form = selectElement.closest('form');
            const formData = new FormData(form);

            // Ambil URL saat ini
            const url = new URL(window.location.href);

            // Perbarui parameter di URL
            formData.forEach((value, key) => {
                url.searchParams.set(key, value);
            });

            // Navigasi ke URL baru tanpa menambahkan duplikasi
            window.location.href = url.toString();
        };
    </script>
</x-layout>
