<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $mahasiswa = Auth::user()->mahasiswa;

        if (!$mahasiswa) {
            // Jika user login sebagai mahasiswa tapi data belum ada (edge case)
            abort(404, 'Data Mahasiswa tidak ditemukan.');
        }

        return view('mahasiswa.dashboard', compact('mahasiswa'));
    }
}
