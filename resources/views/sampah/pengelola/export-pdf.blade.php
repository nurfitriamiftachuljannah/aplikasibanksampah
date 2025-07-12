<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Sampah</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        h2 { text-align: center; margin-bottom: 10px; }
    </style>
</head>
<body>
    <h2>Laporan Data Sampah</h2>

        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead class="bg-primary text-white">
            <tr>
            <th>No</th>
            <th>Jenis Sampah</th>
            <th>Harga (Rp)</th>
            <th>Foto</th>           
            </tr>
        </thead>
        <tbody>
            @foreach($sampah as $item)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $item->jenisSampah->nama }}</td>
                    <td>{{ number_format($item->harga, 0, ',', '.') }}</td>
                    <td>
                    <img src="{{ public_path('foto_sampah/' . $item->foto) }}" 
                        width="60" alt="Foto {{ $item->jenisSampah->nama }}">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
