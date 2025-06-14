<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\User;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified', 'admin']);
    }

    public function index()
    {
        $totalBerita = Berita::count();
        $totalUser = User::where('role', 'user')->count();
        $beritaTerbaru = Berita::latest()->take(5)->get();

        return view('admin.dashboard', compact('totalBerita', 'totalUser', 'beritaTerbaru'));
    }
}
