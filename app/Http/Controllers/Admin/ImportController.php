<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ImportController extends Controller
{
    public function create()
    {
        return view('admin.mahasiswa.import');
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:2048',
        ]);

        $file = $request->file('file');
        $csvData = array_map('str_getcsv', file($file->getRealPath()));

        // Remove header row if exists (assuming first row is header)
        // Check if first row contains 'NIM' or 'Nama'
        if (isset($csvData[0]) && (stripos($csvData[0][0], 'nim') !== false || stripos($csvData[0][1], 'nama') !== false)) {
            array_shift($csvData);
        }

        $count = 0;
        $errors = [];

        DB::beginTransaction();
        try {
            foreach ($csvData as $index => $row) {
                // Expected format: NIM, Nama, Email, Prodi
                // Adjust index based on CSV structure
                // Let's assume: 0=NIM, 1=Nama, 2=Email, 3=Prodi

                if (count($row) < 4) {
                    continue; // Skip invalid rows
                }

                $nim = trim($row[0]);
                $nama = trim($row[1]);
                $email = trim($row[2]);
                $prodi = trim($row[3]);

                // Validate uniqueness
                if (Mahasiswa::where('nim', $nim)->exists() || User::where('email', $email)->exists()) {
                    $errors[] = "Baris " . ($index + 2) . ": NIM $nim atau Email $email sudah ada.";
                    continue;
                }

                // Create User
                $user = User::create([
                    'name' => $nama,
                    'email' => $email,
                    'password' => Hash::make('12345678'), // Default password
                    'role' => 'mahasiswa',
                ]);

                // Create Mahasiswa
                Mahasiswa::create([
                    'user_id' => $user->id,
                    'nim' => $nim,
                    'nama' => $nama,
                    'prodi' => $prodi,
                    'status' => 'aktif',
                    'qr_token' => Str::random(32),
                ]);

                $count++;
            }

            DB::commit();

            if (count($errors) > 0) {
                return redirect()->route('admin.mahasiswa.index')
                    ->with('success', "$count mahasiswa berhasil diimpor.")
                    ->with('warning', implode('<br>', array_slice($errors, 0, 5)) . (count($errors) > 5 ? '... dan lainnya.' : ''));
            }

            return redirect()->route('admin.mahasiswa.index')->with('success', "$count mahasiswa berhasil diimpor!");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat impor: ' . $e->getMessage());
        }
    }
}
