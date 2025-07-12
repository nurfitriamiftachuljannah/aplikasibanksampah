@extends('layouts/app')

@section('content')
    <h1 class="h3 mb-4 text-gray-800"> 
        <i class="fas fa-plus mr-2"></i>
        {{ $title }}
    </h1>

    <div class="card">
        <div class="card-header">
                <a href="{{ route('tabungan.index') }}" class="btn btn-sm btn-success">
                    <i class="fas fa-arrow-left mr-2"></i> 
                    Kembali
                </a>
        </div>
            <div class="card-body">
                <form action="{{ route('tabungan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
               <!-- input lainnya -->

               <div class="mb-3">
                <label>Nama Nasabah</label>
                <select name="nasabah_id" class="form-control" required>
                <option disabled selected>Pilih Nasabah</option>
                @foreach ($nasabah as $item)
                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                @endforeach
                </select>
                </div>

                <div class="mb-3">
                <label>Saldo Saat Ini</label>
                <input type="text" id="saldo" class="form-control" readonly>
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

     