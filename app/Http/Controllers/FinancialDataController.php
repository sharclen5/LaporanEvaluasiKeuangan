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
        $title = 'Dashboard ' . $province ;

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
            ->orderBy('year')
            ->take(5)
            ->pluck('realization');

        // Hitung perubahan persentase setiap tahun
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


    public function showPendapatan($province)
    {
        // Set the title dynamically based on the province
        $title = 'Pendapatan Provinsi ' .$province;
        $subTitle = 'Pendapatan';

        $idProvince = Province::where('name', $province)->first()->id;

        // tinggal ngambil data yang perlu ditampilin ke tabel terus return
        $datas = FinancialData::where('province_id', $idProvince)->where('categories_id', 1)->get();

        // Calculate average percentage change
        $averagePercentageChange = $this->calculateAverageRealization($idProvince, 1);

        // dd($datas);

        // Return the view with the title and province data
        return view('pendapatan', [
            'title' => $title,
            'province' => $province,
            'datas' => $datas,
            'subTitle' => $subTitle,
            'averagePercentageChange' => $averagePercentageChange,
        ]);
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
    
}
