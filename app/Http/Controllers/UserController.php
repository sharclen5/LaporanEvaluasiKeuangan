<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // Ambil parameter pencarian
        $search = $request->get('search', '');
    
        // Ambil parameter sorting
        $sortColumn = $request->get('sort', 'name');
        $sortDirection = $request->get('direction', 'asc');
    
        // Query untuk mengambil data berdasarkan pencarian
        $users = User::when($search, function ($query, $search) {
                $query->where('name', 'like', "%$search%")
                      ->orWhere('email', 'like', "%$search%");
            })
            ->orderBy($sortColumn, $sortDirection)
            ->paginate(10);
    
        return view('usermanagement', [
            'users' => $users,
            'title' => 'User Management',
            'sort' => $sortColumn,
            'direction' => $sortDirection,
            'search' => $search,
        ]);
    }
    

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:admin,user',
            'password' => 'required|min:8',
        ]);
    
        // Simpan data pengguna baru ke database
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'password' => $validated['password'], // Otomatis di-hash jika menggunakan casts
        ]);
    
        return redirect()->route('users.index')->with('success', 'User added successfully.');
    }
    


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'role' => 'required|in:admin,user',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
