@extends('layouts/app')

@section('content')
    <h1 class="h3 mb-4 text-gray-800"> 
        <i class="fas fa-plus mr-2"></i>
        {{ $title ?? 'Judul Halaman' }}
    </h1>

    <div class="card">
        <div class="card-header">
                <a href="{{ route('datasampah.index') }}" class="btn btn-sm btn-success">
                    <i class="fas fa-arrow-left mr-2"></i> 
                    Kembali
                </a>
        </div>
            <div class="card-body">
                @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif

                <form action="{{ route('datasampah.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
               <!-- input lainnya -->
              
                <!-- Jenis Sampah -->
               <div class="form-group">
                <span class="text-danger">*</span>
                <label for="nama">Jenis Sampah</label>
                <select name="jenis_sampah_id" id="jenis_sampah"class="form-control" required>
                    <option value="" selected disabled>-- Pilih Jenis Sampah --</option>
                    @foreach ($jenissampah as $item)
                        <option value="{{ $item->id }}" data-harga="{{ $item->harga }}">
                          {{ $item->nama }}
                        </option>
                     @endforeach
                  
                
                </select>
                </div>

            <!-- Harga Otomatis -->
            <div class="form-group">
                <span class="tex-danger">*</span>
                <label for="foto">Harga Per Kg</label>
                <input type="text" name="harga_display" id="harga_display" class="form-control" readonly>
                <input type="hidden" name="harga" id="harga"> 
            </div>
            
                <div class="form-group">
                    <span class="tex-danger">*</span>
                    <label for="foto">Foto</label>
                     <input type="file" name="foto" class="form-control" accept="image/*" required>
                        @error('foto')   
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

@push('scripts')
    <script>
         document.addEventListener('DOMContentLoaded', function () {
         const jenisSelect = document.getElementById('jenis_sampah');
         const hargaInput = document.getElementById('harga');
         const hargaDisplay = document.getElementById('harga_display');

     jenisSelect.addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        const harga = selectedOption.getAttribute('data-harga');

        hargaInput.value = harga; // untuk dikirim ke server
        hargaDisplay.value = Number(harga).toLocaleString('id-ID'); // untuk ditampilkan tanpa desimal
        });
        });

</script>
@endpush


     