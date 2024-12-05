<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;
use App\Models\FinancialData;

class FinancialDataController extends Controller
{

    public function showDashboard($province, Request $request)
    {
    
        // Mendapatkan data provinsi
        $provinceModel = Province::whereRaw('LOWER(name) = ?', [strtolower($province)])->first();
        if (!$provinceModel) {
            return redirect()->back()->with('error', 'Province not found.');
        }

        $provinceName = $provinceModel->name; // Ambil nama asli dengan case dari database
        $title = 'Dashboard ' . $provinceName;
    
        $provinceId = $provinceModel->id;
    
        // Mendapatkan tahun yang terpilih untuk setiap kategori
        $selectedYears = [
            'pendapatan' => $request->get('year_pendapatan', date('Y')),
            'belanja' => $request->get('year_belanja', date('Y')),
            'pembiayaan' => $request->get('year_pembiayaan', date('Y')),
        ];
    
        // Mendapatkan data persentase berdasarkan kategori
        $percentages = [
            'pendapatan' => FinancialData::where('province_id', $provinceId)
                ->where('categories_id', 1)
                ->where('year', $selectedYears['pendapatan'])
                ->value('percentage'),
            'belanja' => FinancialData::where('province_id', $provinceId)
                ->where('categories_id', 2)
                ->where('year', $selectedYears['belanja'])
                ->value('percentage'),
            'pembiayaan' => FinancialData::where('province_id', $provinceId)
                ->where('categories_id', 3)
                ->where('year', $selectedYears['pembiayaan'])
                ->value('percentage'),
        ];
    
        // Mendapatkan daftar tahun yang tersedia
        $years = FinancialData::where('province_id', $provinceId)
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');
    
        return view('dashboard', [
            'title' => $title,
            'province' => $province,
            'years' => $years,
            'selectedYears' => $selectedYears,
            'percentages' => $percentages,
        ]);
    }
    
    
    private function calculateAverageRealization($provinceId, $categoryId)
    {
        // Ambil data realisasi 5 tahun terakhir berdasarkan province dan kategori
        $realizations = FinancialData::where('province_id', $provinceId)
            ->where('categories_id', $categoryId)
            ->orderBy('year', 'desc')
            ->take(5)
            ->pluck('realization')
            ->reverse()
            ->values();

        $percentageChanges = [];
        for ($i = 1; $i < count($realizations); $i++) {
            $previous = $realizations[$i - 1];
            $current = $realizations[$i];
            $percentageChange = (($current - $previous) / $previous) * 100;
            $percentageChanges[] = $percentageChange;
        }

        $averagePercentageChange = count($percentageChanges) > 0
            ? array_sum($percentageChanges) / count($percentageChanges)
            : 0;

        return $averagePercentageChange;
    }

    public function getDataByYear(Request $request)
    {
        $year = $request->input('year');
        $categoryId = $request->input('categories_id');

        // Validasi input
        if (!$year || !$categoryId) {
            return response()->json([], 400); // Bad Request jika parameter tidak lengkap
        }

        // Ambil data hanya jika `deleted_at` bernilai NULL
        $data = FinancialData::where('year', $year)
            ->where('categories_id', $categoryId)
            ->whereNull('deleted_at')
            ->orderBy('id', 'desc')
            ->get();

        return response()->json($data);
    }


    public function createFinancialData(Request $request, $province)
    {
        // Validasi input
        $request->validate([
            'year' => 'required|integer|min:1945|max:2999',
            'budget' => 'required|numeric',
            'realization' => 'required|numeric',
            'categories_id' => 'required|integer',
        ]);

        // Cari provinsi berdasarkan nama
        $provinceModel = Province::where('name', $province)->first();
        if (!$provinceModel) {
            return redirect()->back()->with('error', 'Province not found.');
        }

        $categoriesId = $request->input('categories_id');
        $year = $request->input('year');

        // Validasi tidak ada tahun yang sama untuk kategori dan provinsi yang sama
        $existingData = FinancialData::where('province_id', $provinceModel->id)
            ->where('categories_id', $categoriesId)
            ->where('year', $year)
            ->first();

        if ($existingData) {
            return redirect()->back()->with('error', 'Data untuk tahun tersebut sudah ada, harap periksa kembali.');
        }

        // Simpan data baru
        $financialData = new FinancialData();
        $financialData->province_id = $provinceModel->id;
        $financialData->categories_id = $categoriesId;
        $financialData->year = $year;
        $financialData->budget = $request->input('budget');
        $financialData->realization = $request->input('realization');

        if ($financialData->save()) {
            return redirect()->back()->with('success', 'Data added successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to add data.');
        }
    }

    public function updateFinancialData(Request $request, $province)
    {
        // Validate the input data
        $request->validate([
            'year' => 'required|integer',
            'budget' => 'required|numeric',
            'realization' => 'required|numeric',
            'categories_id' => 'required|integer', // Add validation for categories_id
        ]);

        // Get categories_id from the request
        $categories_id = $request->input('categories_id');

        // Find the FinancialData entry to update, filtering by categories_id
        $financialData = FinancialData::where('province_id', Province::where('name', $province)->first()->id)
            ->where('year', $request->input('year'))
            ->where('categories_id', $categories_id) // Filter by categories_id
            ->first();

        if (!$financialData) {
            return redirect()->back()->with('error', 'Data not found.');
        }

        // Update the budget and realization fields
        $financialData->budget = $request->input('budget');
        $financialData->realization = $request->input('realization');
        $financialData->save();

        return redirect()->back()->with('success', 'Data updated successfully.');
    }

    public function deleteFinancialData(Request $request, $province)
    {
        // Validate input data
        $request->validate([
            'year' => 'required|integer',
            'categories_id' => 'required|integer',
        ]);

        // Find the province by name
        $provinceModel = Province::where('name', $province)->first();
        if (!$provinceModel) {
            return response()->json(['error' => 'Province not found.'], 404);
        }

        // Get year and categories_id from request
        $year = $request->input('year');
        $categories_id = $request->input('categories_id');

        // Find the FinancialData entry to delete
        $financialData = FinancialData::where('province_id', $provinceModel->id)
            ->where('year', $year)
            ->where('categories_id', $categories_id)
            ->first();

        if (!$financialData) {
            return response()->json(['error' => 'Data not found.'], 404);
        }

        if ($financialData->delete()) {
            return response()->json(['success' => 'Data deleted successfully.'], 200);
        } else {
            return response()->json(['error' => 'Failed to delete data.'], 500);
        }
    }

    public function showPendapatan($province)
    {
    
        $subTitle = 'Pendapatan';

        $provinceModel = Province::whereRaw('LOWER(name) = ?', [strtolower($province)])->first();
        if (!$provinceModel) {
            return redirect()->back()->with('error', 'Province not found.');
        }

        $provinceName = $provinceModel->name; // Ambil nama asli dengan case dari database
        $title = 'Pendapatan Provinsi ' . $provinceName;

        $provinceId = $provinceModel->id;
        $datas = FinancialData::where('province_id', $provinceId)->where('categories_id', 1)->get();
        $averagePercentageChange = $this->calculateAverageRealization($provinceId, 1);

        $years = FinancialData::where('province_id', $provinceId)->distinct()->orderBy('year')->pluck('year');

        return view('pendapatan', [
            'title' => $title,
            'province' => $provinceName,
            'datas' => $datas,
            'subTitle' => $subTitle,
            'averagePercentageChange' => $averagePercentageChange,
            'years' => $years,
        ]);
    }

    public function showBelanja($province)
    {
    
        $subTitle = 'Belanja';

        $provinceModel = Province::whereRaw('LOWER(name) = ?', [strtolower($province)])->first();
        if (!$provinceModel) {
            return redirect()->back()->with('error', 'Province not found.');
        }

        $provinceName = $provinceModel->name; // Ambil nama asli dengan case dari database
        $title = 'Belanja Provinsi ' . $provinceName;

        $provinceId = $provinceModel->id;
        $datas = FinancialData::where('province_id', $provinceId)->where('categories_id', 2)->get();
        $averagePercentageChange = $this->calculateAverageRealization($provinceId, 2);

        $years = FinancialData::where('province_id', $provinceId)->distinct()->orderBy('year')->pluck('year');

        return view('belanja', [
            'title' => $title,
            'province' => $provinceName,
            'datas' => $datas,
            'subTitle' => $subTitle,
            'averagePercentageChange' => $averagePercentageChange,
            'years' => $years,
        ]);
    }

    public function showPembiayaan($province)
    {
    
        $subTitle = 'Pembiayaan';
        $category = 'pembiayaan';

        $provinceModel = Province::whereRaw('LOWER(name) = ?', [strtolower($province)])->first();
        if (!$provinceModel) {
            return redirect()->back()->with('error', 'Province not found.');
        }

        $provinceName = $provinceModel->name; // Ambil nama asli dengan case dari database
        $title = 'Pembiayaan Provinsi ' . $provinceName;

        $provinceId = $provinceModel->id;
        $datas = FinancialData::where('province_id', $provinceId)->where('categories_id', 3)->get();
        $averagePercentageChange = $this->calculateAverageRealization($provinceId, 3);

        $years = FinancialData::where('province_id', $provinceId)->distinct()->orderBy('year')->pluck('year');

        return view('pembiayaan', [
            'title' => $title,
            'province' => $provinceName,
            'datas' => $datas,
            'subTitle' => $subTitle,
            'category' => $category,
            'averagePercentageChange' => $averagePercentageChange,
            'years' => $years,
        ]);
    }

    public function showPendapatanAsliDaerah($province)
    {
    
        $subTitle = 'Pendapatan Asli Daerah';
        $category = 'Pendapatan Asli Daerah';

        $provinceModel = Province::whereRaw('LOWER(name) = ?', [strtolower($province)])->first();
        if (!$provinceModel) {
            return redirect()->back()->with('error', 'Province not found.');
        }

        $provinceName = $provinceModel->name; // Ambil nama asli dengan case dari database
        $title = 'Pendapatan Asli Daerah Provinsi ' . $provinceName;

        $provinceId = $provinceModel->id;
        $datas = FinancialData::where('province_id', $provinceId)->where('categories_id', 4)->get();
        $averagePercentageChange = $this->calculateAverageRealization($provinceId, 4);

        $years = FinancialData::where('province_id', $provinceId)->distinct()->orderBy('year')->pluck('year');

        return view('pendapatan.pendapatanaslidaerah', [
            'title' => $title,
            'province' => $provinceName,
            'datas' => $datas,
            'subTitle' => $subTitle,
            'category' => $category,
            'averagePercentageChange' => $averagePercentageChange,
            'years' => $years,
        ]);
    }

    public function showPendapatanPajakDaerah($province)
    {
    
        $subTitle = 'Pendapatan Pajak Daerah';
        $category = 'Pendapatan Pajak Daerah';

        $provinceModel = Province::whereRaw('LOWER(name) = ?', [strtolower($province)])->first();
        if (!$provinceModel) {
            return redirect()->back()->with('error', 'Province not found.');
        }

        $provinceName = $provinceModel->name; // Ambil nama asli dengan case dari database
        $title = 'Pendapatan Pajak Daerah Provinsi ' . $provinceName;

        $provinceId = $provinceModel->id;
        $datas = FinancialData::where('province_id', $provinceId)->where('categories_id', 5)->get();
        $averagePercentageChange = $this->calculateAverageRealization($provinceId, 5);

        $years = FinancialData::where('province_id', $provinceId)->distinct()->orderBy('year')->pluck('year');

        return view('pendapatan.pendapatanaslidaerah.pajakdaerah', [
            'title' => $title,
            'province' => $provinceName,
            'datas' => $datas,
            'subTitle' => $subTitle,
            'category' => $category,
            'averagePercentageChange' => $averagePercentageChange,
            'years' => $years,
        ]);
    }

    public function showPendapatanRetribusiDaerah($province)
    {
        $title = 'Pendapatan Retribusi Daerah Provinsi ' . $province;
        $subTitle = 'Pendapatan Retribusi Daerah';

        $provinceModel = Province::where('name', $province)->first();
        if (!$provinceModel) {
            return redirect()->back()->with('error', 'Province not found.');
        }

        $provinceId = $provinceModel->id;
        $datas = FinancialData::where('province_id', $provinceId)->where('categories_id', 6)->get();
        $averagePercentageChange = $this->calculateAverageRealization($provinceId, 6);

        $years = FinancialData::where('province_id', $provinceId)->distinct()->orderBy('year')->pluck('year');

        return view('pendapatan.pendapatanaslidaerah.retribusidaerah', [
            'title' => $title,
            'province' => $province,
            'datas' => $datas,
            'subTitle' => $subTitle,
            'averagePercentageChange' => $averagePercentageChange,
            'years' => $years,
        ]);
    }

    public function showPendapatanHPKDD($province)
    {
        $title = 'Pendapatan Hasil Pengelolaan Kekayaan Daerah yang Dipisahkan Provinsi ' . $province;
        $subTitle = 'Pendapatan Hasil Pengelolaan Kekayaan Daerah yang Dipisahkan';

        $provinceModel = Province::where('name', $province)->first();
        if (!$provinceModel) {
            return redirect()->back()->with('error', 'Province not found.');
        }

        $provinceId = $provinceModel->id;
        $datas = FinancialData::where('province_id', $provinceId)->where('categories_id', 7)->get();
        $averagePercentageChange = $this->calculateAverageRealization($provinceId, 7);

        $years = FinancialData::where('province_id', $provinceId)->distinct()->orderBy('year')->pluck('year');

        return view('pendapatan.pendapatanaslidaerah.phpkdd', [
            'title' => $title,
            'province' => $province,
            'datas' => $datas,
            'subTitle' => $subTitle,
            'averagePercentageChange' => $averagePercentageChange,
            'years' => $years,
        ]);
    }

    public function showPendapatanLainLainPAD($province)
    {
        $title = 'Lain-lain Pendapatan Asli Daerah yang Sah Provinsi ' . $province;
        $subTitle = 'Lain-lain Pendapatan Asli Daerah yang Sah';

        $provinceModel = Province::where('name', $province)->first();
        if (!$provinceModel) {
            return redirect()->back()->with('error', 'Province not found.');
        }

        $provinceId = $provinceModel->id;
        $datas = FinancialData::where('province_id', $provinceId)->where('categories_id', 8)->get();
        $averagePercentageChange = $this->calculateAverageRealization($provinceId, 8);

        $years = FinancialData::where('province_id', $provinceId)->distinct()->orderBy('year')->pluck('year');

        return view('pendapatan.pendapatanaslidaerah.lainlainpad', [
            'title' => $title,
            'province' => $province,
            'datas' => $datas,
            'subTitle' => $subTitle,
            'averagePercentageChange' => $averagePercentageChange,
            'years' => $years,
        ]);
    }

    public function showPendapatanTransfer($province)
    {
        $title = 'Pendapatan Transfer Provinsi ' . $province;
        $subTitle = 'Pendapatan Transfer';

        $provinceModel = Province::where('name', $province)->first();
        if (!$provinceModel) {
            return redirect()->back()->with('error', 'Province not found.');
        }

        $provinceId = $provinceModel->id;
        $datas = FinancialData::where('province_id', $provinceId)->where('categories_id', 9)->get();
        $averagePercentageChange = $this->calculateAverageRealization($provinceId, 9);

        $years = FinancialData::where('province_id', $provinceId)->distinct()->orderBy('year')->pluck('year');

        return view('pendapatan.pendapatantransfer', [
            'title' => $title,
            'province' => $province,
            'datas' => $datas,
            'subTitle' => $subTitle,
            'averagePercentageChange' => $averagePercentageChange,
            'years' => $years,
        ]);
    }
}
