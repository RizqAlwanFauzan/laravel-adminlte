<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link">
        <img src="{{ asset('assets/myassets/dist/img/logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">My App</span>
    </a>
    <div class="sidebar">
        <div class="user-panel d-flex mb-3 mt-3 pb-3">
            <div class="image">
                <img src="{{ asset('assets/adminlte/dist/img/avatar5.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Rizq Alwan Fauzan</a>
            </div>
        </div>
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs(['data-keanggotaan.grup', 'data-keanggotaan.anggota']) ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs(['data-keanggotaan.grup', 'data-keanggotaan.anggota']) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Data Keanggotaan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('data-keanggotaan.grup') }}" class="nav-link {{ request()->routeIs('data-keanggotaan.grup') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Grup</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('data-keanggotaan.anggota') }}" class="nav-link {{ request()->routeIs('data-keanggotaan.anggota') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Anggota</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>
