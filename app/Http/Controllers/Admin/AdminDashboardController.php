<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Materi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalMateri = Materi::count();
        $totalUser = User::where('role', 'user')->count();
        $totalDownload = Materi::sum('download_count');

        // Pastikan variabel ini dikirimkan ke view
        return view('admin.dashboard', compact('totalMateri', 'totalUser', 'totalDownload'));
    }
}