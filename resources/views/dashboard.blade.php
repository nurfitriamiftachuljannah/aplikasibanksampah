@extends('layouts/app')

@section('content')
    <h1 class="h3 mb-4 text-gray-800"> 
        <i class="fas fa-tachometer-alt mr-2"></i>
        {{ $title }}
    </h1>

        <div class="row">

        <!-- Earnings Total Pengelola -->
             <div class="col-xl-3 col-md-6 mb-4">
             <div class="card border-left-success shadow h-100 py-2">
             <div class="card-body">
             <div class="row no-gutters align-items-center">
             <div class="col mr-2">
             <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
              Total Pengelola</div>
             <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPengelola }}</div>
             </div>
                <div class="col-auto">
                  <i class="fas fa-user fa-2x text-gray-300"></i>
                </div>
             </div>
             </div>
             </div>
             </div>

        <!-- Earnings Total Nasabah -->
             <div class="col-xl-3 col-md-6 mb-4">
             <div class="card border-left-success shadow h-100 py-2">
             <div class="card-body">
             <div class="row no-gutters align-items-center">
             <div class="col mr-2">
             <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
              Total Nasabah</div>
             <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalNasabah }}</div>
             </div>
                <div class="col-auto">
                  <i class="fas fa-user fa-2x text-gray-300"></i>
                </div>
             </div>
             </div>
             </div>
             </div>

              <!-- Earnings Total Saldo -->
            <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
            <div class="row no-gutters align-items-center">
            <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
              Total Saldo Masuk</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($totalSaldoPenyetoran, 0, ',', '.') }}</div>
             </div>
                <div class="col-auto">
                  <i class="fas fa-coins fa-2x text-gray-300"></i>
                </div>
             </div>
             </div>
             </div>
             </div>

             <!-- Earnings Total Saldo -->
            <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
            <div class="row no-gutters align-items-center">
            <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
              Saldo Keluar</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($totalTarikSaldo, 0, ',', '.') }}</div>
             </div>
                <div class="col-auto">
                  <i class="fas fa-coins fa-2x text-gray-300"></i>
                </div>
             </div>
             </div>
             </div>
             </div>

@endsection

     