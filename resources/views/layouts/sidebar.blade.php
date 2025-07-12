        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-hand-holding-usd"></i>

                </div>
                <div class="sidebar-brand-text mx-3">Siresik </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ $menuDashboard ?? '' }}">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                MENU PENGELOLA
            </div>

            <!-- Nav Item - Charts -->
            <li class="nav-item {{ $menuAdminPengelola ?? '' }}">
                <a class="nav-link" href="{{ route('datapengelola.index') }}">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Data Pengelola</span></a>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item {{ $menuPengelolaNasabah ?? '' }}">
                <a class="nav-link" href="{{ route('datanasabah.index') }}">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Data Nasabah</span></a>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item {{ $menuPengelolaSampah ?? '' }}">
                <a class="nav-link" href="{{ route('datasampah.index') }}">
                    <i class="fas fa-fw fa-trash"></i>
                    <span>Data Sampah</span></a>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item {{ $menuPengelolaPenyetoran ?? '' }}">
                <a class="nav-link" href="{{ route('penyetoran.index') }}">
                    <i class="fas fa-fw fa-balance-scale"></i>
                    <span>Data Penyetoran</span></a>
            </li>

            <!-- Nav Item - Charts -->
            <li class="nav-item {{ $menuTabungan ?? '' }}">
                <a class="nav-link" href="{{ route('tabungan.index') }}">
                    <i class="fas fa-fw fa-wallet"></i>
                    <span>Data Tabungan</span></a>
            </li>

            

          
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->