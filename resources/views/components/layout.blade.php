@props(['title', 'province' => null])


<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <title>{{ $title }}</title>
</head>

<body class="h-full" data-province="{{ $province ?? '' }}">

    <div class="min-h-full">
        @if (!request()->routeIs('index', 'home', 'users.index', 'profile.edit'))
            <x-navbar :province="$province"></x-navbar>
        @else
            <x-navbarhome></x-navbarhome>
        @endif

        @if (!request()->routeIs('index', 'home', 'profile.edit'))
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

    <script>
        document.getElementById('year').addEventListener('change', function() {
            const year = this.value;
            const categoryId = document.querySelector('input[name="categories_id"]').value;

            if (year && categoryId) {
                fetch(`/get-data-by-year?year=${year}&categories_id=${categoryId}`)
                    .then(response => {
                        if (!response.ok) {
                            alert('An error occurred while fetching data.');
                            throw new Error(`HTTP status ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data && data.length > 0) {
                            // Validasi jika `deleted_at` tidak null (optional di sisi JS)
                            const validData = data.filter(item => !item.deleted_at);

                            if (validData.length > 0) {
                                document.getElementById('budget').value = validData[0]?.budget || '';
                                document.getElementById('realization').value = validData[0]?.realization || '';
                            } else {
                                document.getElementById('budget').value = '';
                                document.getElementById('realization').value = '';
                            }
                        } else {
                            // Reset nilai jika tidak ada data valid
                            document.getElementById('budget').value = '';
                            document.getElementById('realization').value = '';
                        }
                    })
                    .catch(error => console.error('Error fetching data:', error));
            } else {
                alert('Please select a year and ensure category ID is available.');
            }
        });




        function confirmDelete() {
            const year = document.getElementById('year').value;
            const categoryId = document.querySelector('input[name="categories_id"]').value;
            const province = document.body.getAttribute('data-province');

            fetch(`/${province}/pendapatan/delete`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        year: year,
                        categories_id: categoryId
                    })
                })
                .then(response => {
                    if (response.ok) {
                        alert("Data deleted successfully.");
                        // Close the modal
                        const deleteModal = document.getElementById('delete-modal');
                        deleteModal.classList.add('hidden'); // Hides the modal
                        location.reload(); // Reloads the page
                    } else {
                        alert("Failed to delete data.");
                    }
                })
                .catch(error => console.error('Error:', error));
        }



        // Fungsi untuk mendapatkan nama file dinamis dari judul halaman
        function getFileName() {
            // Ambil judul halaman dari elemen <title> atau elemen dengan kelas 'page-title'
            const title = document.title || document.querySelector('.page-title')?.innerText || 'Laporan';
            // Ganti spasi dengan underscore (_) untuk format nama file
            return title.replace(/\s+/g, '_').trim();
        }

        // Download PDF
        document.getElementById('downloadPdf').addEventListener('click', function() {
            const element = document.querySelector('.content'); // Elemen yang akan dikonversi

            // Nama file dinamis
            const dynamicFileName = getFileName() + '.pdf';

            // Set PDF options
            const options = {
                margin: 0.5,
                filename: dynamicFileName,
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2
                },
                jsPDF: {
                    unit: 'in',
                    format: 'a4',
                    orientation: 'portrait'
                }
            };

            html2pdf().set(options).from(element).save();
        });

        // Download Word
        document.getElementById('downloadWord').addEventListener('click', function() {
            const element = document.querySelector('.content'); // Elemen yang akan dikonversi

            // Nama file dinamis
            const dynamicFileName = getFileName() + '.doc';

            // Ekstrak konten HTML
            const content = element.innerHTML;

            // Header dan footer untuk format Word
            const header = `
    <html xmlns:o='urn:schemas-microsoft-com:office:office' 
          xmlns:w='urn:schemas-microsoft-com:office:word' 
          xmlns='http://www.w3.org/TR/REC-html40'>
    <head><meta charset='utf-8'><title>${dynamicFileName}</title></head><body>`;
            const footer = "</body></html>";
            const html = header + content + footer;

            // Buat file Blob untuk Word
            const blob = new Blob(['\ufeff', html], {
                type: 'application/msword'
            });

            // Buat link download
            const url = URL.createObjectURL(blob);
            const link = document.createElement('a');
            link.href = url;
            link.download = dynamicFileName; // Nama file dinamis
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        });
    </script>



    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="./assets/vendor/d3/d3.min.js"></script>
    <script src="./assets/vendor/topojson/build/topojson.min.js"></script>
    <script src="./assets/vendor/datamaps/dist/datamaps.world.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    @vite('resources/js/app.js')
</body>

</html>
