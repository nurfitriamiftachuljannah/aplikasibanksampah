@extends('layouts/app')

@section('content')
    <h1 class="h3 mb-4 text-gray-800"> 
        <i class="fas fa-user mr-2"></i>
        {{ $title ?? 'Judul Halaman' }}

    </h1>

    <div class="card">
        <div class="card-header d-flex flex-wrap justify-content-center justify-content-xl-between">
            <div class="mb-1 mr-2">
                <a href="{{ route('datapengelola.create') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus mr-2"></i> 
                    Tambah Data
                </a>
            </div>
            <div>
                <a href="{{ route('datapengelola.export.pdf') }}" class="btn btn-sm btn-danger">
                    <i class="fas fa-file-pdf mr-2"></i> 
                    PDF
                </a>
            </div>
        </div>
        <div class="card-body">
            <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tabel Data Pengelola</h6>
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
                                        @foreach ($pengelola as $item)
                                        <tr class="text-center">
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->telepon }}</td>
                                            <td>{{ $item->alamat }}</td>
                                            <td>
                                            <img src="{{ asset('foto_pengelola/' . $item->foto) }}" 
                                                width="60" alt="Foto {{ $item->nama }}">
                                            </td>

                                            <td>
                                                @if ($item->peran == 'Pengelola')
                                                <span class="badge badge-dark">
                                                    {{ $item->peran }}
                                                </span>
                                                @else
                                                <span class="badge badge-info">
                                                    {{ $item->peran }}
                                                </span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                            <a href= "{{ route('datapengelola.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('datapengelola.destroy', $item->id) }}" method="POST" style="display:inline;">
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

     