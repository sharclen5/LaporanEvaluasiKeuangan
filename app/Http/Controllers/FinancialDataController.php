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
    $title = 'Pendapatan Provinsi ' . $province;
    $subTitle = 'Pendapatan';

    $provinceModel = Province::where('name', $province)->first();
    if (!$provinceModel) {
        return redirect()->back()->with('error', 'Province not found.');
    }

    $provinceId = $provinceModel->id;
    $datas = FinancialData::where('province_id', $provinceId)->where('categories_id', 1)->get();
    $averagePercentageChange = $this->calculateAverageRealization($provinceId, 1);

    // Get distinct years from the FinancialData table
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
    
}
