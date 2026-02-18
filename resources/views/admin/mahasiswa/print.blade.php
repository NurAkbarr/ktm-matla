<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa - KTM Digital</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        h1, h4 { text-align: center; margin-bottom: 5px; }
        p { text-align: center; margin-top: 0; color: #666; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; font-size: 12px; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .badge { padding: 4px 8px; border-radius: 4px; font-size: 10px; font-weight: bold; }
        .aktif { background-color: #d1fae5; color: #065f46; } /* Green */
        .nonaktif { background-color: #fee2e2; color: #991b1b; } /* Red */
        
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body onload="window.print()">

    <h1>DATA MAHASISWA</h1>
    <h4>KTM DIGITAL - MATLA</h4>
    <p>Dicetak pada: {{ date('d F Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Prodi</th>
                <th>L/P</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mahasiswa as $index => $m)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td>{{ $m->nim }}</td>
                <td>{{ $m->nama }}</td>
                <td>{{ $m->user->email ?? '-' }}</td>
                <td>{{ $m->prodi }}</td>
                <td>{{ $m->jenis_kelamin == 'laki-laki' ? 'L' : 'P' }}</td>
                <td style="text-align: center;">
                    <span class="badge {{ $m->status }}">
                        {{ strtoupper($m->status) }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="no-print" style="margin-top: 20px; text-align: center;">
        <button onclick="window.print()" style="padding: 10px 20px; cursor: pointer;">Cetak / Simpan PDF</button>
        <button onclick="window.close()" style="padding: 10px 20px; cursor: pointer;">Tutup</button>
    </div>

</body>
</html>
