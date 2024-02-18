<!--MAIN HEADER AREA START -->
<nav class="navbar navbar-expand-lg fixed-top trans-navigation">
    <div class="container">
        <a class="navbar-brand" href="{{route('home')}}">
            {{-- <img src="images/logo.png" alt="" class="img-fluid b-logo"> --}}
            <span class="h3 fw-bold text-white">Kanggotan</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <i class="fa fa-bars"></i>
            </span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav ">
                <li class="nav-item {{set_active('home')}}">
                    <a class="nav-link smoth-scroll" href="{{route('home')}}">Home</a>
                </li>
                <li class="nav-item">
                    <li class="nav-item dropdown {{set_active('haul-massal.2022')}}">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarWelcome" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            Haul Massal
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarWelcome">
                            <a class="dropdown-item " href="{{route('haul-massal.2022')}}">
                                Haul Massal 2022
                            </a>
                            <a class="dropdown-item " href="{{route('haul-massal.2023')}}">
                                Haul Massal 2023
                            </a>
                            <a class="dropdown-item " href="{{route('haul-massal.2024')}}">
                                Haul Massal 2024
                            </a>
                        </div>
                    </li>
                <li class="nav-item">
                    <a class="nav-link smoth-scroll" href="">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link smoth-scroll" href="">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link smoth-scroll fw-bold" href="#" id="signin-btn">Sign In</a>
                    <a class="nav-link smoth-scroll fw-bold signout-btn hidden" href="#" id="signout-btn">Sign Out</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!--MAIN HEADER AREA END -->
