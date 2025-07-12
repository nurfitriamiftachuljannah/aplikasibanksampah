@extends('layouts/app')

@section('content')
    <h1 class="h3 mb-4 text-gray-800"> 
        <i class="fas fa-plus mr-2"></i>
        {{ $title }}
    </h1>

    <div class="card-body">
    <form action="{{ route('tabungan.update', $tabungan->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nama Nasabah</label>
        <select name="nasabah_id" class="form-control">
        <option value="">-- Pilih Nama Nasabah --</option>
        @foreach($nasabah as $nasabah)
        <option value="{{ $nasabah->id }}" {{ $nasabah->id == $tabungan->nasabah_id ? 'selected' : '' }}>
        {{ $nasabah->nama }}
        </option>
        @endforeach
        </select>
    </div>

    <div class="mb-3">
    <label>Saldo Saat Ini</label>
    @php
    $nasabahId = $tabungan->nasabah_id;
    $setor = \App\Models\Penyetoran::where('nasabah_id', $nasabahId)->sum('total');
    $tarik = \App\Models\Tabungan::where('nasabah_id', $nasabahId)->sum('jumlah');
    $sisaSaldo = $setor - $tarik;
    @endphp

    <input type="text" id="saldo" class="form-control"
    value="Rp {{ number_format($sisaSaldo, 0, ',', '.') }}" readonly>

    </div>

    <div class="mb-3">
        <label class="form-label">
        <span class="tex-danger">*</span>
        Tanggal
        </label>
        <input type="date" name="tanggal" class="form-control" value="{{ request('tanggal') }}">
    </div>

    <div class="mb-3">
        <label>Jumlah Penarikan</label>
        <input type="number" name="jumlah" class="form-control" required>
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
@endsection

@push('scripts')
<script>
    document.querySelector('select[name="nasabah_id"]').addEventListener('change', function() {
        let nasabahId = this.value;
        if (nasabahId) {
            fetch(`/get-saldo/${nasabahId}`)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('saldo').value = 'Rp ' + new Intl.NumberFormat('id-ID').format(data.saldo);
                });
        } else {
            document.getElementById('saldo').value = '';
        }
    });
</script>
@endpush

     