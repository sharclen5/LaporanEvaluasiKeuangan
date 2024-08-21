<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-center rtl:text-right dark:text-gray-400">
                <thead class="text-xs bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Tahun
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Anggaran <br> (Rp)
                        </th>
                        <th scope="col" class="px-6 py-3">
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
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            2019
                        </th>
                        <td class="px-6 py-4">
                            736.803.921.223,68
                        </td>
                        <td class="px-6 py-4">
                            724.616.535.883,00
                        </td>
                        <td class="px-6 py-4">
                            98,93
                        </td>
                    </tr>
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            2020
                        </th>
                        <td class="px-6 py-4">
                            736.287.397.663,91
                        </td>
                        <td class="px-6 py-4">
                            722.372.799.447,00
                        </td>
                        <td class="px-6 py-4">
                            98,35
                        </td>
                    </tr>
                    <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            2021
                        </th>
                        <td class="px-6 py-4">
                            648.646.882.922,81
                        </td>
                        <td class="px-6 py-4">
                            625.036.929.705,00
                        </td>
                        <td class="px-6 py-4">
                            98,11
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div> 

</x-layout>