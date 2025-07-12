@extends('layouts/app')

@section('content')
    <h1 class="h3 mb-4 text-gray-800"> 
        <i class="fas fa-balance-scale mr-2"></i>
        {{ $title }}
    </h1>

    <div class="card">
        <div class="card-header d-flex flex-wrap justify-content-center justify-content-xl-between">
            <div class="mb-1 mr-2">
                <a href="{{ route('penyetoran.create') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus mr-2"></i> 
                    Tambah Data
                </a>
            </div>
            <div>
                <a href="{{ route('penyetoran.export.pdf') }}" class="btn btn-sm btn-danger">
                    <i class="fas fa-file-pdf mr-2"></i> 
                    PDF
                </a>
            </div>
        </div>
        <div class="card-body">
            <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tabel Data Penyetoran</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead class="bg-primary text-white">
                                <tr class="text-center">
                                <th>Nasabah</th>
                                <th>Jenis Sampah</th>
                                <th>Berat (kg)</th>
                                <th>Harga per kg</th>
                                <th>Total</th>
                                <th>Tanggal Penyetoran</th>
                                <th>Aksi</th>
                                </tr>
                                </thead>
                                    <tbody>
                                        @foreach($penyetorans as $item)
                                        <tr class="text-center">
                                        <td>{{ $item->nasabah->nama ?? '-' }}</td>
                                        <td>{{ $item->jenisSampah->nama ?? '-' }}</td>
                                        <td>{{ $item->berat }} kg</td>
                                        <td>Rp {{ number_format($item->harga_per_kg) }}</td>
                                        <td>Rp {{ number_format($item->total) }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->tanggal_setor)->format('d-m-Y') }}</td>
                                        <td class="text-center">
                                            <a href= "{{ route('penyetoran.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('penyetoran.destroy', $item->id) }}" method="POST" style="display:inline;">
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
                            </div>
                        </div>
                    </div>
        </div>
    </div>
@endsection

     