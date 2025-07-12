@extends('layouts/app')

@section('content')
    <h1 class="h3 mb-4 text-gray-800"> 
        <i class="fas fa-plus mr-2"></i>
        {{ $title }}
    </h1>

    <div class="card-body">
    <form action="{{ route('datapengelola.update', $pengelola->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row mb-2">
    <div class="col-xl-6 mb-3">
    <label class="form-label">
    <span class="tex-danger">*</span>
        Nama
    </label>
    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('pengelola', $pengelola->nama) }}">
    @error('nama')   
    <small class="text-danger">                     
    {{ $message }}
    </small>
    @enderror
    </div>

    <div class="col-xl-6 mb-3">
    <label class="form-label">
    <span class="tex-danger">*</span>
            Telepon
    </label>
    <input type="text" name="telepon" 
    class="form-control @error('telepon') is-invalid @enderror" value="{{ old('telepon', $pengelola->telepon) }}">
    @error('telepon')   
    <small class="text-danger">                     
    {{ $message }}
    </small>
    @enderror
    </div>

    <div class="col-xl-6 mb-3">
    <label class="form-label">
    <span class="text-danger">*</span>
            Alamat
    </label>
    <textarea name="alamat" class="form-control" rows="4">{{ old('alamat', $pengelola->alamat) }}</textarea>
    @error('alamat')   
    <small class="text-danger">                     
    {{ $message }}
    </small>
    @enderror    
    </div>

    <div class="col-xl-6 mb-3">
    <div class="form-group">
    <span class="tex-danger">*</span>
    <label for="foto">Foto</label>
    <input type="file" name="foto" class="form-control" accept="image/*">
    </div>
    @error('foto')   
    <small class="text-danger">                     
    {{ $message }}
    </small>
    @enderror
    @if($pengelola->foto)
    <div class="mb-2">
        <img src="{{ asset('foto_pengelola/'.$pengelola->foto) }}" width="100">
    </div>
    @endif
    </div>

    <div class="col-xl-6 mb-3">
    <label class="form-label">
    <span class="text-danger">*</span>
        Email
    </label>
    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $pengelola->email) }}" >
    @error('email')
    <small class="text-danger">
    {{ $message }}
    </small>
    @enderror
    </div>
                    
    <div class="col-xl-12 mb-3">
    <label class="form-label ">
    <span class="text-danger">*</span>
        Peran
    </label>
    <select name="peran" class="form-control @error('peran') is-invalid @enderror">
    <option selected disabled>--Pilih Peran--</option>
    <option value="Pengelola" {{ old('peran', $pengelola->peran) == 'Pengelola' ? 'selected' : '' }}>Pengelola</option>
    <option value="Nasabah" {{ old('peran', $pengelola->peran) == 'Nasabah' ? 'selected' : '' }}>Nasabah</option>
    </select>
    @error('peran')
    <small class="text-danger">
    {{ $message }}
    </small>
    @enderror
    </div>
    <div class="col-xl-6 mb-3">
    <label class="form-label">
    <span class="text-danger">*</span>
        Password
    </label>
    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
        @error('password')
    <small class="text-danger">
    {{ $message }}
    </small>
    @enderror
    </div>
    <div class="col-xl-6 mb-3">
    <label class="form-label">
    <span class="text-danger">*</span>
        Password Konfirmasi
    </label>
    <input type="password" name="password_confirmation" class="form-control @error('password') is-invalid @enderror">
        @error('password')
    <small class="text-danger">
        {{ $message }}
    </small>
        @enderror
    </div>

    <div>
        <button type="submit" class="btn btn-sm btn-primary">
        <i class="fas fa-save mr-2"></i>
        Simpan
        </button>
    </div>
</form>
</div>
@endsection
