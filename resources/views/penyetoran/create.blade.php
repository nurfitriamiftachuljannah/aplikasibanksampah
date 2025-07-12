@extends('layouts/app')

@section('content')
    <h1 class="h3 mb-4 text-gray-800"> 
        <i class="fas fa-plus mr-2"></i>
        {{ $title ?? 'Judul Halaman' }}
    </h1>

    <div class="card">
        <div class="card-header">
                <a href="{{ route('penyetoran.index') }}" class="btn btn-sm btn-success">
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

        <form action="{{ route('penyetoran.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Nama Nasabah</label>
            <select name="nasabah_id" class="form-control">
                <option value="">-- Pilih Nama Nasabah --</option>
                @foreach($nasabah as $nasabah)
                    <option value="{{ $nasabah->id }}">{{ $nasabah->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Jenis Sampah</label>
            <select name="jenis_sampah_id" id="jenis_sampah_id" class="form-control" required>
            <option value="">-- Pilih Jenis Sampah --</option>
            @foreach($jenissampah as $item)
            <option value="{{ $item->id }}" data-harga="{{ $item->harga }}">{{ $item->nama }}</option>
            @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Berat (kg)</label>
            <input type="number" step="0.01" name="berat" id="berat" class="form-control">
        </div>

        <div class="mb-3">
            <label>Harga per kg</label>
            <input type="number" name="harga_per_kg" id="hargaPerKg" class="form-control" readonly>
        </div>

        <div class="mb-3">
            <label>Total</label>
            <input type="number" name="total" id="total" class="form-control" readonly>
        </div>

        <div class="mb-3">
            <label>Tanggal Penyetoran</label>
            <input type="date" name="tanggal_setor" class="form-control" required>
        </div>

        <div>
            <button type="submit" class="btn btn-sm btn-primary">
            <i class="fas fa-save mr-2"></i>
            Simpan
            </button>
        </div>
        </form>
        
       
    <script>
    const jenisSelect = document.getElementById('jenis_sampah_id');
    const hargaInput = document.getElementById('hargaPerKg');
    const beratInput = document.getElementById('berat');
    const totalInput = document.getElementById('total');

    function updateFields() {
        const selectedOption = jenisSelect.options[jenisSelect.selectedIndex];
        const harga = parseFloat(selectedOption.getAttribute('data-harga')) || 0;
        const berat = parseFloat(beratInput.value) || 0;
        hargaInput.value = harga;
        totalInput.value = berat * harga;
    }

    jenisSelect.addEventListener('change', updateFields);
    beratInput.addEventListener('input', updateFields);
</script>

            
@endsection



     