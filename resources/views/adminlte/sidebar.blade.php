<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('adminlte') }}/dist/img/logo-jnt.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">JNT SIMAS Apps</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                @if (auth()->user()->status == 'admin')
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}"
                            class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Master User<i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('user') }}"
                                    class="nav-link {{ Request::is('user*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>List User</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user.create') }}"
                                    class="nav-link {{ Request::is('user/create*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tambah User</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Master Cabang<i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('cabang.list') }}"
                                    class="nav-link {{ Request::is('list_cabang*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>List Cabang</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('cabang.create') }}"
                                    class="nav-link {{ Request::is('cabang/create*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tambah Cabang</p>
                                </a>
                            </li>
                        </ul>

                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-briefcase"></i>
                            <p>Master Barang<i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('barang') }}"
                                    class="nav-link {{ Request::is('barang*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>List Barang</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('barang.create') }}"
                                    class="nav-link {{ Request::is('barang/create*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tambah Barang</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>Laporan Transaksi<i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('list.peminjaman.admin') }}" class="nav-link {{ Request::is('list/peminjaman*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Peminjaman</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('konfirmasi_ambil.admin') }}" class="nav-link {{ Request::is('konfirmasi_ambil/admin*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Konfirmasi Pengambilan</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if (auth()->user()->status == 'user')
                    <li class="nav-item">
                        <a href="{{ route('dashboard.user') }}"
                            class="nav-link {{ Request::is('dashboard_user*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-briefcase"></i>
                            <p>Transaksi<i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('barang_user') }}"
                                    class="nav-link {{ Request::is('barang_user*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Peminjaman</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('peminjaman.history') }}"
                            class="nav-link {{ Request::is('peminjaman/history*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-book"></i>
                            <p>History</p>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->status == 'manager')
                    <li class="nav-item">
                        <a href="{{ route('dashboard.manager') }}"
                            class="nav-link {{ Request::is('dashboard_manager*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('peminjaman.approval_manager') }}"
                            class="nav-link {{ Request::is('peminjaman/approval_manager*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-book"></i>
                            <p>Approval</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Master Pengguna<i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('cabang.versi_manager') }}"
                                    class="nav-link {{ Request::is('cabang/versiManager*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>List User Cabang</p>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('barang.list') }}" class="nav-link {{ Request::is('list-barang*') ? 'active' : '' }}">
                            <i class="fas fa-list nav-icon"></i>
                            <p>List Barang</p>
                        </a>
                    </li>

                @endif
                @if (auth()->user()->status == 'hq')
                    <li class="nav-item">
                        <a href="{{ route('dashboard.hq') }}"
                            class="nav-link {{ Request::is('dashboard_hq*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Master Pengguna<i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('manager_cabang') }}"
                                    class="nav-link {{ Request::is('manager_cabang*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Manager Cabang</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('cabang.versi_hq') }}"
                                    class="nav-link {{ Request::is('cabang/versiHq*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>User Cabang</p>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('peminjaman.approval_hq') }}"
                            class="nav-link {{ Request::is('peminjaman/approval_hq*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-book"></i>
                            <p>Approval</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('barang.list') }}" class="nav-link {{ Request::is('barang/list*') ? 'active' : '' }}">
                            <i class="fas fa-list nav-icon"></i>
                            <p>List Barang</p>
                        </a>
                    </li>
                @endif

                <li class="nav-item">
                    <a href="{{ route('user.profile') }}"
                        class="nav-link {{ Request::is('user/profile*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Profile</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
