<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Tabungan</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        h2 { text-align: center; margin-bottom: 10px; }
    </style>
</head>
<body>
    <h2>Laporan Tabungan Nasabah</h2>
    
    <table>
        <thead>
            <tr class="text-center">
                <th>Nama</th>
                <th>Saldo Saat Ini</th>
                <th>Tanggal</th>
                <th>Jumlah Tarik Saldo</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tabungan as $item)
                <tr class="text-center">
                    <td>{{ $item->nasabah->nama }}</td>
                    <td>Rp {{ number_format($saldo, 0, ',', '.') }}</td>
                    <td>{{ $item->tanggal }}</td>
                    <td>{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
