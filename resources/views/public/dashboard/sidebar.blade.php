<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.html">
            <span class="align-middle">Kanggotan</span>
        </a>
        
        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Pages
            </li>
            
            <li class="sidebar-item active">
                <a class="sidebar-link" href="#">
                    <i class="fa-solid fa-grip align-middle"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>
            
            {{-- <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="fa-solid fa-user align-middle"></i> <span class="align-middle">Profile</span>
                </a>
            </li> --}}
            <li class="sidebar-item">
                <a class="sidebar-link has-arrow" href="#!"
                data-bs-toggle="collapse" data-bs-target="#navAuthentication" aria-expanded="false"
                aria-controls="navAuthentication">
                <i class="fa-solid fa-user-astronaut align-middle"></i> <span class="align-middle">Haul Massal</span>
            </a>
            <div id="navAuthentication" class="collapse"
            data-bs-parent="#sideNavbar">
            <ul class="nav flex-column">
                <li class="sidebar-item">
                    <a class="sidebar-link " href="">Input Data</a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link " href="">List Data</a>
                </li>
            </ul>
        </ul>
    </div>
</nav>