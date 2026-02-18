<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SkillMahasiswa;

class SkillController extends Controller
{
    /**
     * Tampilkan halaman skill mahasiswa
     */
    public function index()
    {
        $mahasiswa = Auth::user()->mahasiswa;

        if (!$mahasiswa) {
            abort(404);
        }

        $skills = $mahasiswa->skills()->latest()->get();

        return view('mahasiswa.skill', compact('mahasiswa', 'skills'));
    }

    /**
     * Tambah skill baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_skill' => 'required|string|max:100',
            'level'      => 'required|in:dasar,menengah,mahir',
        ]);

        $mahasiswa = Auth::user()->mahasiswa;

        if (!$mahasiswa) {
            abort(404);
        }

        // 🔥 Batasi maksimal 10 skill
        if ($mahasiswa->skills()->count() >= 10) {
            return back()->with('error', 'Maksimal 10 skill diperbolehkan.');
        }

        // 🔥 Cegah skill duplikat
        $exists = SkillMahasiswa::where('mahasiswa_id', $mahasiswa->id)
            ->where('nama_skill', $request->nama_skill)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Skill sudah pernah ditambahkan.');
        }

        SkillMahasiswa::create([
            'mahasiswa_id' => $mahasiswa->id,
            'nama_skill'   => $request->nama_skill,
            'level'        => $request->level,
        ]);

        return redirect('/ktm/mahasiswa/dashboard')->with('success', 'Skill berhasil ditambahkan.');
    }

    /**
     * Hapus skill
     */
    public function destroy($id)
    {
        $mahasiswa = Auth::user()->mahasiswa;

        $skill = SkillMahasiswa::where('id', $id)
            ->where('mahasiswa_id', $mahasiswa->id)
            ->firstOrFail();

        $skill->delete();

        return back()->with('success', 'Skill berhasil dihapus.');
    }
}
