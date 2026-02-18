<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak QR Code Massal</title>
    <style>
        @page {
            size: A4;
            margin: 10mm;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            -webkit-print-color-adjust: exact;
        }
        .grid-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr); /* 2 kolom per baris */
            gap: 15mm;
            padding: 5mm;
        }
        .card {
            border: 1px dashed #ccc;
            padding: 15px;
            display: flex;
            align-items: center;
            gap: 15px;
            page-break-inside: avoid; /* Jangan potong kartu di pindah halaman */
            background-color: #fff;
            border-radius: 8px;
        }
        .qr-code {
            width: 120px;
            height: 120px;
            flex-shrink: 0;
        }
        .info {
            flex: 1;
        }
        .info h3 {
            margin: 0 0 5px 0;
            font-size: 16px;
            color: #333;
            text-transform: uppercase;
        }
        .info p {
            margin: 2px 0;
            font-size: 12px;
            color: #555;
        }
        .logo {
            font-size: 10px;
            font-weight: bold;
            color: #999;
            margin-bottom: 5px;
            letter-spacing: 1px;
        }
        
        @media print {
            .no-print { display: none; }
            body { background-color: #fff; }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="no-print" style="padding: 20px; text-align: center; background: #f0f0f0; border-bottom: 1px solid #ddd; margin-bottom: 20px;">
        <button onclick="window.print()" style="padding: 10px 20px; background: #4F46E5; color: white; border: none; border-radius: 5px; cursor: pointer; font-weight: bold;">Cetak Sekarang</button>
        <button onclick="window.close()" style="padding: 10px 20px; background: #ddd; color: #333; border: none; border-radius: 5px; cursor: pointer; margin-left: 10px;">Tutup</button>
        <p style="margin-top: 10px; font-size: 12px; color: #666;">Tips: Atur 'Scale' di pengaturan print browser jika ukuran tidak pas.</p>
    </div>

    <div class="grid-container">
        @foreach($mahasiswa as $mhs)
        <div class="card">
            <div class="qr-code">
                <!-- QR Code SVG injected directly -->
                {!! $mhs->qr_image !!}
            </div>
            <div class="info">
                <div class="logo">MATLA DIGITAL KTM</div>
                <h3>{{ $mhs->nama }}</h3>
                <p><strong>NIM:</strong> {{ $mhs->nim }}</p>
                <p><strong>Prodi:</strong> {{ $mhs->prodi }}</p>
                <p><strong>Status:</strong> <span style="color: {{ $mhs->status=='aktif'?'green':'red' }}">{{ ucfirst($mhs->status) }}</span></p>
            </div>
        </div>
        @endforeach
    </div>

</body>
</html>
