<?php

namespace App\Http\Controllers\Public;

use App\Models\Materi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PublicMateriController extends Controller
{
    public function index()
    {
        $materi = Materi::latest()->paginate(10);
        return view('public.materi.index', compact('materi'));
    }

    public function view(Materi $materi)
    {
        return view('public.materi.view', compact('materi'));
    }
}
