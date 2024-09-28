<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $provinces = Province::paginate(8);
        return view('home', ['provinces' => $provinces, 'title' => 'Home']);
    }
}