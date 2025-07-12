@extends('layouts/app')

@section('content')
    <h1 class="h3 mb-4 text-gray-800"> 
        <i class="fas fa-plus mr-2"></i>
        {{ $title ?? 'Judul Halaman' }}
    </h1>

    <div class="card">
        <div class="card-header">
                <a href="{{ route('datanasabah.index') }}" class="btn btn-sm btn-success">
                    <i class="fas fa-arrow-left mr-2"></i> 
                    Kembali
                </a>
        </div>
            <div class="card-body">
                <form action="{{ route('datanasabah.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
               <!-- input lainnya -->
              
                <div class="row mb-2">
                    <div class="col-xl-6 mb-3">
                        <label class="form-label">
                            <span class="tex-danger">*</span>
                            Nama
                        </label>
                        <input type="text" name="nama" class="form-control @error('nama') 
                        is-invalid @enderror" value="{{ old('nama') }}">
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
                        class="form-control @error('telepon') is-invalid @enderror" 
                        value="{{ old('telepon') }}">
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
                         <textarea name="alamat" class="form-control">{{ old('alamat') }}</textarea>
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
                     <input type="file" name="foto" class="form-control" accept="image/*" required>
                    </div>
                        @error('foto')   
                        <small class="text-danger">                     
                        {{ $message }}
                        </small>
                        @enderror
                    </div>
                    <div class="col-xl-6 mb-3">
                        <label class="form-label">
                            <span class="text-danger">*</span>
                            Email
                        </label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
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
                            <option value="Pengelola">Pengelola</option>
                            <option value="Nasabah">Nasabah</option>
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
                    
            </div>
    </div>
@endsection

     