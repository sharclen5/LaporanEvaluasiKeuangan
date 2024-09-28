<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Models\Provinces;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    public function index()
    {
        $provinces = Province::paginate(8);
        return view('provinces.index', compact('provinces'));
    }

    public function create()
    {
        return view('provinces.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Province::create($request->all());

        return redirect()->route('provinces.index')
                         ->with('success', 'Provinces created successfully.');
    }

    public function show(Province $provinces)
    {
        return view('provinces.show', compact('provinces'));
    }

    public function edit(Province $provinces)
    {
        return view('provinces.edit', compact('provinces'));
    }

    public function update(Request $request, Province $provinces)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $provinces->update($request->all());

        return redirect()->route('provinces.index')
                         ->with('success', 'Provinces updated successfully.');
    }

    public function destroy(Province $provinces)
    {
        $provinces->delete();

        return redirect()->route('provinces.index')
                         ->with('success', 'Provinces deleted successfully.');
    }
}