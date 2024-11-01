<x-layout :province="$province">

    <x-slot:title>
        <div style="display: flex; justify-content: space-between; align-items: center;">
            {{ $title }}
            <button type="submit" data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg class="w-6 h-6 text-white dark:text-gray-80-" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                  </svg>                      
                  Edit
            </button>
        </div>
    </x-slot:title>

    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8" style="font-family: 'Bookman Old Style'; font-size: 12pt;">
        <div class="relative overflow-x-auto sm:rounded-lg mb-8">
            <h2>Gambaran Realisasi {{ $title }} dalam 5 (lima) tahun terakhir (TA 2019 s.d. TA 2023), sebagaimana tabel berikut:</h2>
            <table class="mt-5 w-full shadow-md text-sm text-center rtl:text-right dark:text-gray-400" style="font-family: 'Bookman Old Style'; font-size: 12pt;">
                <thead class="text-xs bg-gray-300 dark:bg-gray-700 dark:text-gray-400" style="font-family: 'Bookman Old Style'; font-size: 12pt;">
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
                    @foreach ($datas as $data)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4 border-r">{{ $data->year }}</td>
                            <td class="px-6 py-4 border-r">{{ number_format($data->budget, 2, ',', '.') }}</td>
                            <td class="px-6 py-4 border-r">{{ number_format($data->realization, 2, ',', '.') }}</td>
                            <td class="px-6 py-4">{{ number_format($data->percentage, 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <p class="text-justify mt-8" style="font-family: 'Bookman Old Style'; font-size: 12pt;">
                Berdasarkan data tersebut, capaian realisasi {{ $title }} TA {{ $datas->last()->year }}
                @php
                    $current = $datas->last();
                    $previous = $datas[count($datas) - 2];
                    $currentPercentage = number_format($current->percentage, 2, ',', '.');
                    $targetComparison = $current->realization <=> $current->budget;
                    $budgetComparison = ($current->budget - $previous->realization) / $previous->realization * 100;
                    $realizationComparison = ($current->realization - $previous->realization) / $previous->realization * 100;
                @endphp
            
                @if ($targetComparison < 0)
                    tidak mencapai target yang ditetapkan dalam APBD karena sampai pada akhir tahun realisasi {{ $subTitle }} tercapai sebesar {{ $currentPercentage }}%.
                @elseif ($targetComparison > 0)
                    melampaui target yang ditetapkan dalam APBD dengan capaian sebesar {{ $currentPercentage }}%.
                @else
                    mencapai target yang ditetapkan dalam APBD dengan capaian sebesar {{ $currentPercentage }}%.
                @endif
            
                Penetapan target {{ $subTitle }} TA {{ $current->year }} 
                {{ $budgetComparison > 0 ? 'lebih tinggi' : 'lebih rendah' }}
                {{ number_format(abs($budgetComparison), 2, ',', '.') }}% atau 
                {{ $budgetComparison > 0 ? 'meningkat' : 'menurun' }} sebesar Rp{{ number_format(abs($current->budget - $previous->realization), 2, ',', '.') }} 
                dari realisasi {{ $subTitle }} TA {{ $previous->year }}.
            </p>
            
            <p class="text-justify" style="font-family: 'Bookman Old Style'; font-size: 12pt;">
                Apabila realisasi {{ $subTitle }} TA {{ $current->year }} dibandingkan dengan realisasi {{ $subTitle }} TA {{ $previous->year }}, terdapat 
                {{ $realizationComparison > 0 ? 'peningkatan' : 'penurunan' }}
                {{ number_format(abs($realizationComparison), 2, ',', '.') }}% atau sebesar {{ number_format(abs($current->realization - $previous->realization), 2, ',', '.') }}.
            
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
    </div>

    
<!-- Main modal -->
<div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Edit {{ $title }}
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>
            <!-- Modal body -->
            <form action="{{ route('pendapatan.update', $province) }}" method="POST" class="p-4 md:p-5">
                @csrf
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="year" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tahun</label>
                        <select name="year" id="year" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                            <option value="">Pilih tahun</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                        </select>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="budget" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Anggaran</label>
                        <input type="text" name="budget" id="budget" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" pattern="^\d+(\,\d{1,2})?$" required>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="realization" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Realisasi</label>
                        <input type="text" name="realization" id="realization" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" pattern="^\d+(\,\d{1,2})?$" required>
                    </div>
                </div>
                <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Confirm
                </button>
            </form>
        </div>
    </div>
</div>


</x-layout>
