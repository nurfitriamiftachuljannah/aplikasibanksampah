@extends('layouts/app')

@section('content')
    <h1 class="h3 mb-4 text-gray-800"> 
        <i class="fas fa-plus mr-2"></i>
        {{ $title }}
    </h1>

    <div class="card-body">
    <form action="{{ route('penyetoran.update', $penyetoran->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nama Nasabah</label>
        <select name="nasabah_id" class="form-control">
        <option value="">-- Pilih Nama Nasabah --</option>
        @foreach($nasabah as $nasabah)
        <option value="{{ $nasabah->id }}" {{ $nasabah->id == $penyetoran->nasabah_id ? 'selected' : '' }}>
        {{ $nasabah->nama }}
        </option>

        @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Jenis Sampah</label>
        <select name="jenis_sampah_id" id="jenis_sampah_id" class="form-control" required>
        <option value="">-- Pilih Jenis Sampah --</option>
        @foreach($jenissampah as $item)
        <option value="{{ $item->id }}" data-harga="{{ $item->harga }}" {{ $item->id == $penyetoran->jenis_sampah_id ? 'selected' : '' }}>
        {{ $item->nama }}
        </option>
        @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Berat (kg)</label>
        <input type="number" step="0.01" name="berat" id="berat" class="form-control" value="{{ $penyetoran->berat }}">
    </div>

    <div class="mb-3">
        <label>Harga per kg</label>
        <input type="number" name="harga_per_kg" id="hargaPerKg" class="form-control" value="{{ $penyetoran->harga_per_kg }}" readonly>
    </div>

    <div class="mb-3">
        <label>Total</label>
        <input type="number" name="total" id="total" class="form-control" value="{{ $penyetoran->total }}" readonly>
    </div>

    <div class="mb-3">
        <label>Tanggal Penyetoran</label>
        <input type="date" name="tanggal_setor" class="form-control" value="{{ $penyetoran->tanggal_setor }}" required>
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
<script>
    const jenisSelect = document.getElementById('jenis_sampah_id');
    const hargaPerKgInput = document.getElementById('hargaPerKg');
    const beratInput = document.getElementById('berat');
    const totalInput = document.getElementById('total');

    function hitungTotal() {
        const harga = parseFloat(hargaPerKgInput.value) || 0;
        const berat = parseFloat(beratInput.value) || 0;
        totalInput.value = harga * berat;
    }

    jenisSelect.addEventListener('change', function () {
        const selected = this.options[this.selectedIndex];
        const harga = selected.getAttribute('data-harga');
        hargaPerKgInput.value = harga;
        hitungTotal();
    });

    beratInput.addEventListener('input', hitungTotal);
</script>


@endsection

