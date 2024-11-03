<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;
use App\Models\FinancialData;

class FinancialDataController extends Controller
{

    public function showDashboard($province)
    {
        // Set the title dynamically based on the province
        $title = 'Dashboard ' . $province;

        // $id = Province::where('name', $province)->first()->id;
        // dd($id);

        // Return the view with the title and province data
        return view('dashboard', [
            'title' => $title,
            'province' => $province,
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

        // Ambil data berdasarkan tahun yang dipilih
        $data = FinancialData::where('year', $year)->get();

        return response()->json($data);
    }


    public function createFinancialData(Request $request, $province)
    {
        $request->validate([
            'year' => 'required|integer',
            'budget' => 'required|numeric',
            'realization' => 'required|numeric',
            'categories_id' => 'required|integer',
        ]);

        $provinceModel = Province::where('name', $province)->first();
        if (!$provinceModel) {
            return redirect()->back()->with('error', 'Province not found.');
        }

        $categoriesId = $request->input('categories_id');

        $financialData = new FinancialData();
        $financialData->province_id = $provinceModel->id;
        $financialData->categories_id = $categoriesId;
        $financialData->year = $request->input('year');
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
        ]);

        // Find the FinancialData entry to update
        $financialData = FinancialData::where('province_id', Province::where('name', $province)->first()->id)
            ->where('year', $request->input('year'))
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

    public function showPendapatan($province)
    {
        $title = 'Pendapatan Provinsi ' . $province;
        $subTitle = 'Pendapatan';

        $provinceModel = Province::where('name', $province)->first();
        if (!$provinceModel) {
            return redirect()->back()->with('error', 'Province not found.');
        }

        $provinceId = $provinceModel->id;
        $datas = FinancialData::where('province_id', $provinceId)->where('categories_id', 1)->get();
        $averagePercentageChange = $this->calculateAverageRealization($provinceId, 1);

        $years = FinancialData::where('province_id', $provinceId)->distinct()->orderBy('year')->pluck('year');

        return view('pendapatan', [
            'title' => $title,
            'province' => $province,
            'datas' => $datas,
            'subTitle' => $subTitle,
            'averagePercentageChange' => $averagePercentageChange,
            'years' => $years,
        ]);
    }

    public function showBelanja($province)
    {
        $title = 'Belanja Provinsi ' . $province;
        $subTitle = 'Belanja';

        $provinceModel = Province::where('name', $province)->first();
        if (!$provinceModel) {
            return redirect()->back()->with('error', 'Province not found.');
        }

        $provinceId = $provinceModel->id;
        $datas = FinancialData::where('province_id', $provinceId)->where('categories_id', 2)->get();
        $averagePercentageChange = $this->calculateAverageRealization($provinceId, 2);

        $years = FinancialData::where('province_id', $provinceId)->distinct()->orderBy('year')->pluck('year');

        return view('belanja', [
            'title' => $title,
            'province' => $province,
            'datas' => $datas,
            'subTitle' => $subTitle,
            'averagePercentageChange' => $averagePercentageChange,
            'years' => $years,
        ]);
    }

    public function showPembiayaan($province)
    {
        $title = 'Pembiayaan Provinsi ' . $province;
        $subTitle = 'Pembiayaan';

        $provinceModel = Province::where('name', $province)->first();
        if (!$provinceModel) {
            return redirect()->back()->with('error', 'Province not found.');
        }

        $provinceId = $provinceModel->id;
        $datas = FinancialData::where('province_id', $provinceId)->where('categories_id', 3)->get();
        $averagePercentageChange = $this->calculateAverageRealization($provinceId, 3);

        $years = FinancialData::where('province_id', $provinceId)->distinct()->orderBy('year')->pluck('year');

        return view('pembiayaan', [
            'title' => $title,
            'province' => $province,
            'datas' => $datas,
            'subTitle' => $subTitle,
            'averagePercentageChange' => $averagePercentageChange,
            'years' => $years,
        ]);
    }

    public function showPendapatanAsliDaerah($province)
    {
        $title = 'Pendapatan Asli Daerah Provinsi ' . $province;
        $subTitle = 'Pendapatan Asli Daerah';

        $provinceModel = Province::where('name', $province)->first();
        if (!$provinceModel) {
            return redirect()->back()->with('error', 'Province not found.');
        }

        $provinceId = $provinceModel->id;
        $datas = FinancialData::where('province_id', $provinceId)->where('categories_id', 4)->get();
        $averagePercentageChange = $this->calculateAverageRealization($provinceId, 4);

        $years = FinancialData::where('province_id', $provinceId)->distinct()->orderBy('year')->pluck('year');

        return view('pendapatan.pendapatanaslidaerah', [
            'title' => $title,
            'province' => $province,
            'datas' => $datas,
            'subTitle' => $subTitle,
            'averagePercentageChange' => $averagePercentageChange,
            'years' => $years,
        ]);
    }

    public function showPendapatanPajakDaerah($province)
    {
        $title = 'Pendapatan Pajak Daerah Provinsi ' . $province;
        $subTitle = 'Pendapatan Pajak Daerah';

        $provinceModel = Province::where('name', $province)->first();
        if (!$provinceModel) {
            return redirect()->back()->with('error', 'Province not found.');
        }

        $provinceId = $provinceModel->id;
        $datas = FinancialData::where('province_id', $provinceId)->where('categories_id', 5)->get();
        $averagePercentageChange = $this->calculateAverageRealization($provinceId, 5);

        $years = FinancialData::where('province_id', $provinceId)->distinct()->orderBy('year')->pluck('year');

        return view('pendapatan.pendapatanaslidaerah.pajakdaerah', [
            'title' => $title,
            'province' => $province,
            'datas' => $datas,
            'subTitle' => $subTitle,
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
