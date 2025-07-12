@extends('layouts/app')

@section('content')
    <h1 class="h3 mb-4 text-gray-800"> 
        <i class="fas fa-wallet mr-2"></i>
        {{ $title ?? 'Judul Halaman' }}

    </h1>

    <div class="card">
        <div class="card-header d-flex flex-wrap justify-content-center justify-content-xl-between">
            <div class="mb-1 mr-2">
                <a href="{{ route('tabungan.create') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus mr-2"></i> 
                    Tarik Saldo
                </a>
            </div>
            <div>
                <a href="{{ route('tabungan.export.pdf') }}" class="btn btn-sm btn-danger">
                    <i class="fas fa-file-pdf mr-2"></i> 
                    PDF
                </a>
            </div>
        </div>
        <div class="card-body">
            <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Riwayat Tabungan</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <form method="GET" class="mb-3 row">
                        <div class="col">
                        <input type="text" name="nama" placeholder="Nama Nasabah" class="form-control" value="{{ request('nama') }}">
                        </div>
                        <div class="col">
                        <input type="date" name="tanggal_awal" class="form-control" value="{{ request('tanggal_awal') }}">
                        </div>
                        <div class="col">
                        <input type="date" name="tanggal_akhir" class="form-control" value="{{ request('tanggal_akhir') }}">
                        </div>
                        <div class="col">
                        <button class="btn btn-secondary">Filter</button>
                        </div>
                        </form>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="bg-primary text-white">
                                        <tr class="text-center">
                                            <th>Nama</th>
                                            <th>Saldo Saat Ini</th>
                                            <th>Tanggal</th>
                                            <th>Jumlah Tarik Saldo</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tabungan as $item)
                                        <tr class="text-center">
                                            <td>{{ $item->nasabah->nama }}</td>
                                            @php
                                            $nasabahId = $item->nasabah_id;
                                            $setoran = \App\Models\Penyetoran::where('nasabah_id', $nasabahId)->sum('total');
                                            $tarikan = \App\Models\Tabungan::where('nasabah_id', $nasabahId)->sum('jumlah');
                                            $sisaSaldo = $setoran - $tarikan;
                                            @endphp
                                            <td>Rp {{ number_format($sisaSaldo, 0, ',', '.') }}</td>

                                            <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                                            <td>{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                                            <td class="text-center">
                                                <a href= "{{ route('tabungan.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('tabungan.destroy', $item->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?')">
                                                <i class="fas fa-trash"></i>
                                                </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $tabungan->links() }}
                            </div>
                        </div>
                    </div>
        </div>
    </div>


@endsection

     