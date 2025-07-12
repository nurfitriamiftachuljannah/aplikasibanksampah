<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Penyetoran</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        h2 { text-align: center; margin-bottom: 10px; }
    </style>
</head>
<body>
    <h2>Laporan Data Penyetoran</h2>

        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead class="bg-primary text-white">
            <tr>
            <th>Nasabah</th>
            <th>Jenis Sampah</th>
            <th>Berat (kg)</th>
            <th>Harga per kg</th>
            <th>Total</th>
            <th>Tanggal Penyetoran</th>          
            </tr>
        </thead>
        <tbody>
            @foreach($penyetoran as $item)
                <tr>
                    <td>{{ $item->nasabah->nama ?? '-' }}</td>
                    <td>{{ $item->jenisSampah->nama ?? '-' }}</td>
                    <td>{{ $item->berat }} kg</td>
                    <td>Rp {{ number_format($item->harga_per_kg) }}</td>
                    <td>Rp {{ number_format($item->total) }}</td>
                    <td>{{ $item->tanggal_setor }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
