<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\PortofolioMahasiswa;

class PortofolioController extends Controller
{
    public function index()
    {
        $mahasiswa = Auth::user()->mahasiswa;

        if (!$mahasiswa) {
            abort(404);
        }

        return view('mahasiswa.portofolio', compact('mahasiswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => ['required', 'string', 'max:255', 'regex:/\S/'],
            'deskripsi' => ['nullable', 'string', 'max:1000', 'regex:/\S/'],
            'link' => 'nullable|url',
            'files.*' => 'nullable|mimes:pdf,jpg,jpeg,png|max:5120',
        ], [
            'judul.regex' => 'Judul tidak boleh hanya berisi spasi.',
            'deskripsi.regex' => 'Deskripsi tidak boleh hanya berisi spasi.',
        ]);

        $mahasiswa = Auth::user()->mahasiswa;

        if (!$mahasiswa) {
            abort(404);
        }


        // Minimal harus ada salah satu: file atau link
        if (!$request->hasFile('files') && !$request->filled('link')) {
            return back()->with('error', 'Minimal upload file atau isi link portofolio.');
        }

        if ($request->hasFile('files')) {

            foreach ($request->file('files') as $file) {

                $path = $file->store('portofolio', 'public');

                PortofolioMahasiswa::create([
                    'mahasiswa_id' => $mahasiswa->id,
                    'judul' => $request->judul,
                    'deskripsi' => $request->deskripsi,
                    'link' => $request->link,
                    'file' => $path
                ]);
            }
        } else {

            PortofolioMahasiswa::create([
                'mahasiswa_id' => $mahasiswa->id,
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'link' => $request->link,
                'file' => null
            ]);
        }

        return redirect('/ktm/mahasiswa/dashboard')->with('success', 'Portofolio berhasil ditambahkan.');
    }



    public function destroy($id)
    {
        $mahasiswa = Auth::user()->mahasiswa;

        if (!$mahasiswa) {
            abort(404);
        }

        $porto = PortofolioMahasiswa::where('id', $id)
            ->where('mahasiswa_id', $mahasiswa->id)
            ->firstOrFail();

        if ($porto->file) {
            Storage::disk('public')->delete($porto->file);
        }

        $porto->delete();

        return back()->with('success', 'Portofolio berhasil dihapus');
    }
}
