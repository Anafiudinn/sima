<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Divisi;
use App\Models\Tempat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // hanya tampilkan user role 'user'
        $users = User::where('role', 'user')
            ->with('divisi', 'tempat')
            ->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $divisis = Divisi::all();
        $tempats = Tempat::all();
        return view('admin.users.create', compact('divisis', 'tempats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users',
            'password'  => 'required|string|min:8|confirmed',
            'role'      => 'required|string|in:admin,user',
            'divisi_id' => 'required|exists:divisis,id',
            'tempat_id' => 'required|exists:tempats,id',
        ]);

        User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role'      => $request->role,
            'divisi_id' => $request->divisi_id,
            'tempat_id' => $request->tempat_id,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $divisis = Divisi::all();
        $tempats = Tempat::all();
        return view('admin.users.edit', compact('user', 'divisis', 'tempats'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role'      => 'required|string|in:admin,user',
            'divisi_id' => 'required|exists:divisis,id',
            'tempat_id' => 'required|exists:tempats,id',
            'password'  => 'nullable|string|min:8|confirmed',
        ]);

        $data = $request->only(['name', 'email', 'role', 'divisi_id', 'tempat_id']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
    }

    public function getTempatByDivisi($divisiId)
    {
        $tempats = Tempat::where('divisi_id', $divisiId)
            ->pluck('nama_tempat', 'id');

        return response()->json($tempats);
    }
}
