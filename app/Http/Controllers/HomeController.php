<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $features = [
            [
                'title' => 'Pusat Materi',
                'desc' => 'Akses semua materi internal dengan mudah dan cepat.',
                'icon' => '📚'
            ],
            [
                'title' => 'Divisi & Tempat',
                'desc' => 'Lihat informasi divisi dan tempat kerja yang tersedia.',
                'icon' => '🏢'
            ],
            [
                'title' => 'Kontak Kami',
                'desc' => 'Hubungi kami untuk pertanyaan atau bantuan lebih lanjut.',
                'icon' => '☎️'
            ],
        ];

        return view('public.home', compact('features'));
    }
}
