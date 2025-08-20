<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\HistoryDownload;
use Illuminate\Support\Facades\Auth;

class HistoryDownloadController extends Controller
{
    public function index()
    {
        $history = HistoryDownload::with('materi')
            ->where('user_id', Auth::id())
            ->orderBy('downloaded_at', 'desc')
            ->get();

        return view('user.history.index', compact('history'));
    }
}
