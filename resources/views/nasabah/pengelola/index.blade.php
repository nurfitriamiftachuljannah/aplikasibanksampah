
@extends('layouts/app')
@section('content')
    <h1 class="h3 mb-4 text-gray-800"> 
        <i class="fas fa-user mr-2"></i>
        {{ $title ?? 'Judul Halaman' }}
    </h1>

    <div class="card">
        <div class="card-header d-flex flex-wrap justify-content-center justify-content-xl-between">
            <div class="mb-1 mr-2">
                <a href="{{ route('datanasabah.create') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus mr-2"></i> 
                    Tambah Data
                </a>
            </div>
            <div>
                <a href="{{ route('datanasabah.export.pdf') }}" class="btn btn-sm btn-danger">
                    <i class="fas fa-file-pdf mr-2"></i> 
                    PDF
                </a>
            </div>
        </div>
        <div class="card-body">
            <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tabel Data Nasabah</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="bg-primary text-white">
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Telepon</th>
                                            <th>Alamat</th>
                                            <th>Foto</th>
                                            <th>Peran</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($nasabah as $row)
                                        <tr class="text-center">
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $row->nama }}</td>
                                            <td>{{ $row->telepon }}</td>
                                            <td>{{ $row->alamat }}</td>
                                            <td>
                                            <img src="{{ asset('foto_nasabah/' . $row->foto) }}" 
                                                width="60" alt="Foto {{ $row->nama }}">
                                            </td>

                                            <td>
                                                @if ($row->peran == 'Pengelola')
                                                <span class="badge badge-dark">
                                                    {{ $row->peran }}
                                                </span>
                                                @else
                                                <span class="badge badge-info">
                                                    {{ $row->peran }}
                                                </span>
                                                @endif
                                            </td>
                                            <td>
                                            <div class="d-flex gap-2">
                                            <a href="{{ route('datanasabah.edit', $row->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                            </a>

                                            <form action="{{ route('datanasabah.destroy', $row->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                        </div>
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

     