<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Renderer\Image\GDImageBackEnd;
use BaconQrCode\Writer;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;





class MahasiswaController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX (SEARCH + FILTER + PAGINATION)
    |--------------------------------------------------------------------------
    */
    public function index(Request $request)
    {
        $query = Mahasiswa::with('user')->latest();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('nim', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($uq) use ($search) {
                        $uq->where('email', 'like', "%{$search}%");
                    });
            });
        }

        // Filter Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $mahasiswa = $query->paginate(10)->withQueryString();

        return view('admin.mahasiswa.index', compact('mahasiswa'));
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        return view('admin.mahasiswa.create');
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email',
            'nim'           => 'required|string|max:50|unique:mahasiswa,nim',
            'prodi'         => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
        ]);

        DB::transaction(function () use ($request) {

            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => bcrypt('password123'),
                'role'     => 'mahasiswa',
            ]);

            Mahasiswa::create([
                'user_id'       => $user->id,
                'nim'           => $request->nim,
                'nama'          => $request->name,
                'prodi'         => $request->prodi,
                'jenis_kelamin' => $request->jenis_kelamin,
                'status'        => 'aktif',
                'qr_token'      => Str::uuid(),
            ]);
        });

        return redirect()
            ->route('admin.mahasiswa.index')
            ->with('success', 'Mahasiswa berhasil ditambahkan');
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */
    public function edit($id)
    {
        $mahasiswa = Mahasiswa::with('user')->findOrFail($id);

        return view('admin.mahasiswa.edit', compact('mahasiswa'));
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::with('user')->findOrFail($id);

        $request->validate([
            'name'          => 'required|string|max:255',
            'prodi'         => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'status'        => 'required|in:aktif,nonaktif',
        ]);

        DB::transaction(function () use ($request, $mahasiswa) {

            // Update user
            if ($mahasiswa->user) {
                $mahasiswa->user->update([
                    'name' => $request->name,
                ]);
            }

            // Update mahasiswa
            $mahasiswa->update([
                'nama'          => $request->name,
                'prodi'         => $request->prodi,
                'jenis_kelamin' => $request->jenis_kelamin,
                'status'        => $request->status,
            ]);
        });

        return redirect()
            ->route('admin.mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil diperbarui');
    }

    /*
    |--------------------------------------------------------------------------
    | QR PREVIEW
    |--------------------------------------------------------------------------
    */
    public function qr($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        $qr = QrCode::size(300)
            ->format('svg')
            ->generate(url('/ktm/p/' . $mahasiswa->qr_token));

        return view('admin.mahasiswa.qr', compact('mahasiswa', 'qr'));
    }

    /*
    |--------------------------------------------------------------------------
    | QR DOWNLOAD
    |--------------------------------------------------------------------------
    */
    public function downloadQr($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        $url = url('/ktm/p/' . $mahasiswa->qr_token);

        $qr = new \Endroid\QrCode\QrCode($url);
        $qr->setSize(400);
        $qr->setMargin(10);

        $writer = new \Endroid\QrCode\Writer\PngWriter();
        $result = $writer->write($qr);

        return response($result->getString())
            ->header('Content-Type', 'image/png')
            ->header(
                'Content-Disposition',
                'attachment; filename="QR-' . $mahasiswa->nim . '.png"'
            );
    }




    /*
    |--------------------------------------------------------------------------
    | TOGGLE STATUS
    |--------------------------------------------------------------------------
    */
    public function toggleStatus($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        $mahasiswa->update([
            'status' => $mahasiswa->status === 'aktif' ? 'nonaktif' : 'aktif'
        ]);

        return back()->with('success', 'Status mahasiswa diperbarui');
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::with('user')->findOrFail($id);

        DB::transaction(function () use ($mahasiswa) {

            if ($mahasiswa->user) {
                $mahasiswa->user->delete();
            }

            $mahasiswa->delete();
        });

        return back()->with('success', 'Mahasiswa berhasil dihapus');
    }

    /*
    |--------------------------------------------------------------------------
    | EXPORT CSV
    |--------------------------------------------------------------------------
    */
    public function exportCsv(Request $request)
    {
        $filename = 'data-mahasiswa-' . date('Y-m-d') . '.csv';

        $mahasiswa = Mahasiswa::with('user')->latest()->get();

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['NIM', 'Nama', 'Email', 'Prodi', 'Jenis Kelamin', 'Status', 'Tanggal Daftar'];

        $callback = function () use ($mahasiswa, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($mahasiswa as $m) {
                $row['NIM']           = $m->nim;
                $row['Nama']          = $m->nama;
                $row['Email']         = $m->user->email ?? '-';
                $row['Prodi']         = $m->prodi;
                $row['Jenis Kelamin'] = $m->jenis_kelamin;
                $row['Status']        = $m->status;
                $row['Tanggal Daftar'] = $m->created_at->format('Y-m-d H:i:s');

                fputcsv($file, array($row['NIM'], $row['Nama'], $row['Email'], $row['Prodi'], $row['Jenis Kelamin'], $row['Status'], $row['Tanggal Daftar']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /*
    |--------------------------------------------------------------------------
    | PRINT VIEW
    |--------------------------------------------------------------------------
    */
    /*
    |--------------------------------------------------------------------------
    | PRINT VIEW (DATA)
    |--------------------------------------------------------------------------
    */
    public function print(Request $request)
    {
        $mahasiswa = Mahasiswa::with('user')->latest()->get();
        return view('admin.mahasiswa.print', compact('mahasiswa'));
    }

    /*
    |--------------------------------------------------------------------------
    | BULK PRINT QR
    |--------------------------------------------------------------------------
    */
    public function bulkPrint(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:mahasiswa,id',
        ]);

        $mahasiswa = Mahasiswa::whereIn('id', $request->ids)->get();

        // Generate QR for each
        foreach ($mahasiswa as $mhs) {
            $mhs->qr_image = QrCode::size(150)
                ->color(0, 0, 0)
                ->margin(2)
                ->generate(url('/ktm/p/' . $mhs->qr_token));
        }

        return view('admin.mahasiswa.bulk_qr', compact('mahasiswa'));
    }
}
