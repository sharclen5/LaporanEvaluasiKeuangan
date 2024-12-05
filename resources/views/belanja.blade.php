<x-layout :province="$province">

    @php
        $filteredData = $datas->where('categories_id', 2);
        $sortedDatas = $filteredData->sortByDesc('year')->take(5)->sortBy('year');
        $current = $sortedDatas->last();
        $previous = $sortedDatas->slice(-2, 1)->first();
        $earliest = $sortedDatas->first();
        $currentPercentage = $current ? number_format($current->percentage, 2, ',', '.') : null;
        $targetComparison = $current ? $current->realization <=> $current->budget : null;
        $budgetComparison =
            $current && $previous ? (($current->budget - $previous->realization) / $previous->realization) * 100 : null;
        $realizationComparison =
            $current && $previous
                ? (($current->realization - $previous->realization) / $previous->realization) * 100
                : null;
    @endphp

    <x-slot:title>
        {{ $title }}
    </x-slot:title>

    @if (!$filteredData->isEmpty())
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div></div>
            <div style="display: flex; gap: 10px;">
                <button type="submit" data-modal-target="update-modal" data-modal-toggle="update-modal"
                    class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                    </svg>
                    Edit
                </button>

                <button type="submit" data-modal-target="create-modal" data-modal-toggle="create-modal"
                    class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    New
                </button>
            </div>
        </div>
    @endif

    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8" style="font-family: 'Bookman Old Style'; font-size: 12pt;">
        @if ($filteredData->isEmpty())
            <div class="flex items-center justify-center min-h-[200px] mt-24">
                <button type="button" data-modal-target="create-modal" data-modal-toggle="create-modal"
                    class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    Add New Data
                </button>
            </div>
        @else
            <div class="content relative overflow-x-auto sm:rounded-lg mb-8">
                <h2>Gambaran Realisasi {{ $title }} dalam 5 (lima) tahun terakhir (TA {{ $earliest->year }} s.d.
                    TA {{ $current->year }}), sebagaimana tabel berikut:</h2>
                    <div class="overflow-x-auto">
                        <table class="mt-5 min-w-full shadow-md text-sm text-center rtl:text-right"
                            style="font-family: 'Bookman Old Style'; font-size: 12pt;">
                            <thead class="text-xs bg-gray-300" style="font-family: 'Bookman Old Style'; font-size: 12pt;">
                                <tr>
                                    <th scope="col" class="px-6 py-3 border-r">
                                        Tahun
                                    </th>
                                    <th scope="col" class="px-6 py-3 border-r">
                                        Anggaran <br> (Rp)
                                    </th>
                                    <th scope="col" class="px-6 py-3 border-r">
                                        Realisasi <br> (Rp)
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        %
                                    </th>
                                </tr>
                            </thead>
                            <tbody style="font-family: 'Bookman Old Style'; font-size: 12pt;">
                                @foreach ($sortedDatas as $data)
                                    <tr class="bg-white border-b hover:bg-gray-50">
                                        <td class="px-6 py-4 border-r">{{ $data->year }}</td>
                                        <td class="px-6 py-4 border-r">{{ number_format($data->budget, 2, ',', '.') }}</td>
                                        <td class="px-6 py-4 border-r">{{ number_format($data->realization, 2, ',', '.') }}</td>
                                        <td class="px-6 py-4">{{ number_format($data->percentage, 2, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    

                <p class="text-justify mt-8" style="font-family: 'Bookman Old Style'; font-size: 12pt;">

                    Berdasarkan data tersebut, capaian realisasi {{ $title }} TA {{ $current->year }}

                    @if ($targetComparison < 0)
                        tidak mencapai target yang ditetapkan dalam APBD karena sampai pada akhir tahun realisasi
                        {{ $subTitle }} tercapai sebesar {{ $currentPercentage }}%.
                    @elseif ($targetComparison > 0)
                        melampaui target yang ditetapkan dalam APBD dengan capaian sebesar {{ $currentPercentage }}%.
                    @else
                        mencapai target yang ditetapkan dalam APBD dengan capaian sebesar {{ $currentPercentage }}%.
                    @endif

                    Penetapan target {{ $subTitle }} TA {{ $current->year }}
                    {{ $budgetComparison > 0 ? 'lebih tinggi' : 'lebih rendah' }}
                    {{ number_format(abs($budgetComparison), 2, ',', '.') }}% atau
                    {{ $budgetComparison > 0 ? 'meningkat' : 'menurun' }} sebesar
                    Rp{{ number_format(abs($current->budget - $previous->realization), 2, ',', '.') }}
                    dari realisasi {{ $subTitle }} TA {{ $previous->year }}.
                </p>

                <p class="text-justify" style="font-family: 'Bookman Old Style'; font-size: 12pt;">
                    Apabila realisasi {{ $subTitle }} TA {{ $current->year }} dibandingkan dengan realisasi
                    {{ $subTitle }} TA {{ $previous->year }}, terdapat
                    {{ $realizationComparison > 0 ? 'peningkatan' : 'penurunan' }}
                    {{ number_format(abs($realizationComparison), 2, ',', '.') }}% atau sebesar
                    Rp{{ number_format(abs($current->realization - $previous->realization), 2, ',', '.') }}.

                    Realisasi {{ $subTitle }} tersebut
                    @if ($realizationComparison < $averagePercentageChange)
                        lebih rendah
                    @elseif ($realizationComparison > $averagePercentageChange)
                        lebih tinggi
                    @endif
                    dari rata-rata realisasi {{ $subTitle }} yang
                    {{ $averagePercentageChange > 0 ? 'meningkat' : 'menurun' }}
                    sebesar {{ number_format($averagePercentageChange, 2, ',', '.') }}% dalam 5 (lima) tahun terakhir.
                </p>


            </div>

            <div class="flex flex-wrap justify-center gap-4 mt-8">
                <!-- Tombol Download PDF -->
                <button id="downloadPdf"
                    class="text-white flex items-center justify-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 w-full sm:w-auto">
                    Download as PDF
                    <svg class="ml-1 w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M9 2.221V7H4.221a2 2 0 0 1 .365-.5L8.5 2.586A2 2 0 0 1 9 2.22ZM11 2v5a2 2 0 0 1-2 2H4a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2 2 2 0 0 0 2 2h12a2 2 0 0 0 2-2 2 2 0 0 0 2-2v-7a2 2 0 0 0-2-2V4a2 2 0 0 0-2-2h-7Zm-6 9a1 1 0 0 0-1 1v5a1 1 0 1 0 2 0v-1h.5a2.5 2.5 0 0 0 0-5H5Zm1.5 3H6v-1h.5a.5.5 0 0 1 0 1Zm4.5-3a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h1.376A2.626 2.626 0 0 0 15 15.375v-1.75A2.626 2.626 0 0 0 12.375 11H11Zm1 5v-3h.375a.626.626 0 0 1 .625.626v1.748a.625.625 0 0 1-.626.626H12Zm5-5a1 1 0 0 0-1 1v5a1 1 0 1 0 2 0v-1h1a1 1 0 1 0 0-2h-1v-1h1a1 1 0 1 0 0-2h-2Z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            
                <!-- Tombol Download Word -->
                <button id="downloadWord"
                    class="text-white flex items-center justify-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 w-full sm:w-auto">
                    Download as Word
                    <svg class="ml-1 w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Zm2 0V2h7a2 2 0 0 1 2 2v16a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Zm-1.02 4.804a1 1 0 1 0-1.96.392l1 5a1 1 0 0 0 1.838.319L12 15.61l1.143 1.905a1 1 0 0 0 1.838-.319l1-5a1 1 0 0 0-1.962-.392l-.492 2.463-.67-1.115a1 1 0 0 0-1.714 0l-.67 1.116-.492-2.464Z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
            

        @endif
    </div>

    


    <!-- Update modal -->
    <div id="update-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Edit {{ $title }}
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-toggle="update-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="{{ route('pendapatan.update', $province) }}" method="POST" class="p-4 md:p-5">
                    @csrf
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="year" class="block mb-2 text-sm font-medium text-gray-900">Tahun</label>
                            <select name="year" id="year"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                                required>
                                <option value="">Pilih tahun</option>
                                @foreach ($years as $year)
                                    <option id="year" value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="budget"
                                class="block mb-2 text-sm font-medium text-gray-900">Anggaran</label>
                            <input type="text" name="budget" id="budget"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                pattern="^\d+(\,\d{1,2})?$" required>
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="realization"
                                class="block mb-2 text-sm font-medium text-gray-900">Realisasi</label>
                            <input type="text" name="realization" id="realization"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                pattern="^\d+(\,\d{1,2})?$" required>
                        </div>
                        <input type="hidden" name="categories_id" value="2">
                    </div>
                    <div class="flex justify-between">
                        <button type="submit"
                            class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Confirm
                        </button>
                        <button type="button" data-modal-target="delete-modal" data-modal-toggle="delete-modal"
                            class="text-white inline-flex items-center bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Delete
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="delete-modal" tabindex="-1"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-gray-700 rounded-lg shadow">
                <button type="button"
                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="delete-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-white dark:text-gray-400">Are you sure you want to delete
                        this entry?</h3>
                    <button onclick="confirmDelete()" type="button"
                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                        Yes, I'm sure
                    </button>
                    <button data-modal-hide="delete-modal" type="button"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No,
                        cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Create modal -->
    <div id="create-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Tambah Data Baru
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-toggle="create-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>


                <!-- Modal body -->
                <form action="{{ route('pendapatan.create', $province) }}" method="POST" class="p-4 md:p-5">
                    @csrf
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="year" class="block mb-2 text-sm font-medium text-gray-900">Tahun</label>
                            <input type="number" name="year" id="year" min="1945" max="2999"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                required>
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="budget"
                                class="block mb-2 text-sm font-medium text-gray-900">Anggaran</label>
                            <input type="text" name="budget" id="budget"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                pattern="^\d+(\,\d{1,2})?$" required>
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label for="realization"
                                class="block mb-2 text-sm font-medium text-gray-900">Realisasi</label>
                            <input type="text" name="realization" id="realization"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                pattern="^\d+(\,\d{1,2})?$" required>
                        </div>
                        <input type="hidden" name="categories_id" value="2">
                    </div>
                    <button type="submit"
                        class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Confirm
                    </button>
                </form>
            </div>
        </div>
    </div>


</x-layout>
