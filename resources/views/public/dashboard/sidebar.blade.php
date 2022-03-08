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
            <li class="sidebar-item {{ set_active(['haul-massal.input', 'haul-massal.show']) }}">
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
                Presensi
            </li>
            
            <li class="sidebar-item">
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="#!" data-bs-toggle="collapse"
                        data-bs-target="#presensi-dropdown" aria-expanded="false" aria-controls="navAuthentication">
                        <i class="fa-solid fa-calendar-check align-middle"></i> <span class="align-middle">Presensi</span>
                    </a>
                    <div id="presensi-dropdown" class="collapse" data-bs-parent="#sideNavbar">
                        <ul class="nav flex-column">
                            <li class="sidebar-item">
                                <a class="sidebar-link children-sidebar" href="#">Piket Puasa</a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link children-sidebar" href="#">Rapat Rutin</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </li>
        </ul>
    </div>
</nav>
