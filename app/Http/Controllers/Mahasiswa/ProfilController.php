<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\ProfilMahasiswa;

class ProfilController extends Controller
{
    /**
     * Form edit profil mahasiswa
     */
    public function edit()
    {
        $mahasiswa = Auth::user()->mahasiswa;

        if (!$mahasiswa) {
            abort(404);
        }

        return view('mahasiswa.profil', compact('mahasiswa'));
    }

    /**
     * Update profil mahasiswa
     */
    public function update(Request $request)
    {
        $request->validate([
            'tentang_saya'   => 'nullable|string|max:1000',
            'fotoInput'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $mahasiswa = Auth::user()->mahasiswa;

        if (!$mahasiswa) {
            abort(404);
        }

        $profil = $mahasiswa->profil ?? $mahasiswa->profil()->create([]);

        /*
        |--------------------------------------------------------------------------
        | HANDLE CROPPED IMAGE
        |--------------------------------------------------------------------------
        */
        if ($request->hasFile('fotoInput')) {
            $file = $request->file('fotoInput');

            $request->validate([
                'fotoInput' => 'image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $filename = 'profil_' . time() . '.' . $file->getClientOriginalExtension();

            // Hapus foto lama jika ada
            if ($profil->foto && Storage::disk('public')->exists($profil->foto)) {
                Storage::disk('public')->delete($profil->foto);
            }

            // Simpan foto baru
            $path = $file->storeAs('profil', $filename, 'public');
            $profil->foto = $path;
        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE TEXT
        |--------------------------------------------------------------------------
        */
        $profil->tentang_saya = $request->tentang_saya;
        $profil->save();

        session()->flash('success', 'Profil berhasil diperbarui');

        return redirect('/ktm/mahasiswa/dashboard');
    }
}
