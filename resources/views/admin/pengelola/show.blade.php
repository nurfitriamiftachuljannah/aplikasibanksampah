@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <h3>{{ $title }}</h3>
    <div class="card shadow mt-3">
        <div class="card-body">
            <h5>Nama: {{ $pengelola->nama }}</h5>
            <p>Email: {{ $pengelola->email }}</p>
            <p>Peran: {{ $pengelola->peran }}</p>
            <p>Status: {{ $pengelola->is_status ? 'Aktif' : 'Tidak Aktif' }}</p>
        </div>
    </div>
    <a href="{{ route('datapengelola.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
