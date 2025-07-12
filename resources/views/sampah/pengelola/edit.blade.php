@extends('layouts/app')

@section('content')
    <h1 class="h3 mb-4 text-gray-800"> 
        <i class="fas fa-plus mr-2"></i>
        {{ $title }}
    </h1>

    <div class="card-body">
    <form action="{{ route('datasampah.update', $sampah->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <span class="text-danger">*</span>
        <label for="nama">Jenis Sampah</label>
        <select name="jenis_sampah_id" id="jenis_sampah"class="form-control" required>
        <option value="" selected disabled>-- Pilih Jenis Sampah --</option>
        @foreach ($jenissampah as $item)
        <option value="{{ $item->id }}" data-harga="{{ $item->harga }}"
        {{ $sampah->jenis_sampah_id == $item->id ? 'selected' : '' }}>
        {{ $item->nama }}
        </option>
        @endforeach
        </select>
    </div>

    <!-- Harga Otomatis -->
    <div class="form-group">
    <span class="tex-danger">*</span>
    <label for="foto">Harga Per Kg</label>
    <input type="text" name="harga_display" id="harga_display" class="form-control" readonly
       value="{{ number_format($sampah->harga, 0, ',', '.') }}">
    <input type="hidden" name="harga" id="harga" value="{{ $sampah->harga }}">
    </div>
            
    <div class="form-group">
    <span class="tex-danger">*</span>
    <label for="foto">Foto</label>
    <input type="file" name="foto" class="form-control" accept="image/*">
    @error('foto')   
    <small class="text-danger">                     
    {{ $message }}
    </small>
    @enderror
    @if($sampah->foto)
    <img src="{{ asset('foto_sampah/' . $sampah->foto) }}" width="100" class="mb-2">
    @endif
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

        function updateHarga() {
        const selectedOption = jenisSelect.options[jenisSelect.selectedIndex];
        const harga = selectedOption.getAttribute('data-harga') || 0;
        hargaInput.value = harga;
        hargaDisplay.value = Number(harga).toLocaleString('id-ID');
        }

        jenisSelect.addEventListener('change', updateHarga);

        // Panggil saat load
        updateHarga();
        });

</script>
@endpush
