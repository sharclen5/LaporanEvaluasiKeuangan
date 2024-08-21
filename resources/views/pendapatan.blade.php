<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <div class="relative overflow-x-auto sm:rounded-lg mb-8">
            <h2>Belanja Pegawai</h2>
            <h2>Gambaran Realisasi Belanja Pegawai dalam 5 (lima) tahun terakhir (TA 2019 s.d. TA 2023), sebagaimana tabel berikut:</h2>
            <table class="mt-5 w-full shadow-md text-sm text-center rtl:text-right dark:text-gray-400">
                <thead class="text-xs bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
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
                <tbody>
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td scope="row"
                            class="px-6 py-4 border-r">
                            2019
                        </td>
                        <td class="px-6 py-4 border-r">
                            736.803.921.223,68
                        </td>
                        <td class="px-6 py-4 border-r">
                            724.616.535.883,00
                        </td>
                        <td class="px-6 py-4">
                            98,93
                        </td>
                    </tr>
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td scope="row"
                            class="px-6 py-4 border-r">
                            2020
                        </td>
                        <td class="px-6 py-4 border-r">
                            736.287.397.663,91
                        </td>
                        <td class="px-6 py-4 border-r">
                            722.372.799.447,00
                        </td>
                        <td class="px-6 py-4">
                            98,35
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td scope="row"
                            class="px-6 py-4 border-r">
                            2021
                        </td>
                        <td class="px-6 py-4 border-r">
                            648.646.882.922,81
                        </td>                   
                        <td class="px-6 py-4 border-r">
                            625.036.929.705,00
                        </td>
                        <td class="px-6 py-4">
                            98,11
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td scope="row"
                            class="px-6 py-4 border-r">
                            2022
                        </td>
                        <td class="px-6 py-4 border-r">
                            693.156.866.730,00
                        </td>
                        <td class="px-6 py-4 border-r">
                            637.738.706.092,20
                        </td>
                        <td class="px-6 py-4">
                            96,36
                        </td>
                    </tr>
                    <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td scope="row"
                            class="px-6 py-4 border-r">
                            2023
                        </td>
                        <td class="px-6 py-4 border-r">
                            721.606.151.725,00
                        </td> 
                        <td class="px-6 py-4 border-r">
                            657.826.026.577,00
                        </td>
                        <td class="px-6 py-4">
                            91,16
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div> 

</x-layout>