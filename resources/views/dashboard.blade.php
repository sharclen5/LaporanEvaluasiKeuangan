<x-layout :province="$province">
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="flex justify-center space-x-4">
        @foreach (['pendapatan' => 'Pendapatan', 'belanja' => 'Belanja', 'pembiayaan' => 'Pembiayaan'] as $key => $label)
            <div class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                <div class="flex justify-between items-start w-full">
                    <div class="flex-col items-center">
                        <div class="flex items-center mb-4">
                            <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white me-1">
                                Realisasi {{ $label }} {{ $province }}
                            </h5>
                        </div>
                        <div class="flex items-center">
                            <form action="{{ route('dashboard', $province) }}" method="GET" class="year-form">
                                <input type="hidden" name="year_pendapatan" value="{{ $selectedYears['pendapatan'] }}">
                                <input type="hidden" name="year_belanja" value="{{ $selectedYears['belanja'] }}">
                                <input type="hidden" name="year_pembiayaan" value="{{ $selectedYears['pembiayaan'] }}">
                                <label for="year-{{ $key }}" class="mr-2 text-gray-700 dark:text-gray-200">Pilih Tahun:</label>
                                <select name="year_{{ $key }}" id="year-{{ $key }}" class="p-2 border border-gray-300 rounded dark:bg-gray-700 dark:text-gray-300" onchange="updateURL(this)">
                                    @foreach ($years as $year)
                                        <option value="{{ $year }}" {{ $year == $selectedYears[$key] ? 'selected' : '' }}>{{ $year }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex items-center justify-center h-80" id="{{ $key }}-chart" data-percentage="{{ $percentages[$key] }}">
                    @if (is_null($percentages[$key]))
                        <p class="text-center text-gray-600 dark:text-gray-400">Data Kosong, Silahkan Isi Terlebih Dahulu</p>
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
