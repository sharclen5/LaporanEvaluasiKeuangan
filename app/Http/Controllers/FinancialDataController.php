<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FinancialDataController extends Controller
{
    public function showDashboard($province)
    {
        // Set the title dynamically based on the province
        $title = 'Dashboard ' . $province ;

        // Return the view with the title and province data
        return view('dashboard', [
            'title' => $title,
            'province' => $province
        ]);
    }
}
