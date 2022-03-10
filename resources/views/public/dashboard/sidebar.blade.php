<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.html">
            <span class="align-middle">Kanggotan</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Pages
            </li>

            <li class="sidebar-item {{ set_active('dashboard') }}">
                <a class="sidebar-link" href="{{ route('dashboard') }}">
                    <i class="fa-solid fa-grip align-middle"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>

            {{-- <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="fa-solid fa-user align-middle"></i> <span class="align-middle">Profile</span>
                </a>
            </li> --}}
            <li class="sidebar-item {{ set_active(['haul-massal.input', 'haul-massal.show', 'haul-massal.bulk-store']) }}">
                <a class="sidebar-link has-arrow" href="#!" data-bs-toggle="collapse"
                    data-bs-target="#haulmassal-dropdown" aria-expanded="false" aria-controls="navAuthentication">
                    <i class="fa-solid fa-user-astronaut align-middle"></i> <span class="align-middle">Haul
                        Massal</span>
                </a>
                <div id="haulmassal-dropdown" class="collapse" data-bs-parent="#sideNavbar">
                    <ul class="nav flex-column">
                        <li class="sidebar-item">
                            <a class="sidebar-link children-sidebar" href="{{ route('haul-massal.input') }}">Input
                                Data</a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link children-sidebar" href="{{ route('haul-massal.show') }}">List
                                Data</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="sidebar-header">
                Sekretaris Area
            </li>
            
            <li class="sidebar-item">
                <li class="sidebar-item {{ set_active('secretary-area') }}">
                    <a class="sidebar-link has-arrow" href="#!" data-bs-toggle="collapse"
                        data-bs-target="#presensi-dropdown" aria-expanded="false" aria-controls="navAuthentication">
                        <i class="fa-solid fa-calendar-check align-middle"></i> <span class="align-middle">Presensi</span>
                    </a>
                    <div id="presensi-dropdown" class="collapse" data-bs-parent="#sideNavbar">
                        <ul class="nav flex-column">
                            <li class="sidebar-item">
                                <a class="sidebar-link children-sidebar" href="{{route('secretary-area')}}">Piket Puasa</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link children-sidebar" href="{{route('secretary-area')}}">Rapat Rutin</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </li>
            <li class="sidebar-item">
                <li class="sidebar-item {{ set_active('secretary-area-2') }}">
                    <a class="sidebar-link has-arrow" href="#!" data-bs-toggle="collapse"
                        data-bs-target="#undangan-dropdown" aria-expanded="false" aria-controls="undangan">
                        <i class="fa-solid fa-paper-plane align-middle"></i> <span class="align-middle">Buat Undangan</span>
                    </a>
                    <div id="undangan-dropdown" class="collapse" data-bs-parent="#sideNavbar">
                        <ul class="nav flex-column">
                            <li class="sidebar-item">
                                <a class="sidebar-link children-sidebar" href="{{route('secretary-area-2')}}">Undangan Rapat</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link children-sidebar" href="{{route('secretary-area-2')}}">Undangan Kegiatan</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link children-sidebar" href="{{route('secretary-area-2')}}">Berita Lelayu</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </li>
            <li class="sidebar-header">
                Keuangan
            </li>
            
            <li class="sidebar-item ">
                <li class="sidebar-item {{ set_active('bendahara-area') }}">
                    <a class="sidebar-link has-arrow" href="#!" data-bs-toggle="collapse"
                        data-bs-target="#keuangan-dropdown" aria-expanded="false" aria-controls="navAuthentication">
                        <i class="fa-solid fa-coins align-middle"></i> <span class="align-middle">Keuangan</span>
                    </a>
                    <div id="keuangan-dropdown" class="collapse" data-bs-parent="#sideNavbar">
                        <ul class="nav flex-column">
                            <li class="sidebar-item">
                                <a class="sidebar-link children-sidebar" href="{{route('bendahara-area')}}">Pemasukan/Pengeluaran</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link children-sidebar" href="{{route('bendahara-area')}}">Laporan Keuangan</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </li>
        </ul>
    </div>
</nav>
