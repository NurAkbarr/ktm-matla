<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Mahasiswa;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMahasiswa = Mahasiswa::count();
        $totalUser = User::count();
        $totalAktif = Mahasiswa::where('status', 'aktif')->count();
        $totalNonAktif = Mahasiswa::where('status', '!=', 'aktif')->count();

        // Chart Distribution by Prodi
        $prodiStats = Mahasiswa::select('prodi', DB::raw('count(*) as total'))
            ->groupBy('prodi')
            ->get();

        $prodiLabels = $prodiStats->pluck('prodi');
        $prodiData = $prodiStats->pluck('total');

        // Chart Distribution by Status
        // $statusStats = Mahasiswa::select('status', DB::raw('count(*) as total'))
        //     ->groupBy('status')
        //     ->get();

        return view('admin.dashboard', compact(
            'totalMahasiswa',
            'totalUser',
            'totalAktif',
            'totalNonAktif',
            'prodiLabels',
            'prodiData'
        ));
    }
}
