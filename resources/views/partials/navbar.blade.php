<!--Navbar Start-->
<nav class="navbar navbar-expand-lg fixed-top sticky" id="navbar">
    <div class="container-fluid custom-container">
        <a class="navbar-brand text-dark fw-bold me-auto" href="{{ route('home') }}">
            <img src="{{ asset('jobcy/images/logo-cdc.png') }}" height="44" alt="" class="logo-dark" />
            <img src="{{ asset('jobcy/images/logo-cdc-white.png') }}" height="44" alt="" class="logo-light" />
        </a>
        <div>
            <button class="navbar-toggler me-3" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-label="Toggle navigation">
                <i class="mdi mdi-menu"></i>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mx-auto navbar-center">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link">Home</a>
                </li>
                <li class="nav-item dropdown dropdown-hover">
                    <a class="nav-link" href="javascript:void(0)" id="jobsdropdown" role="button" data-bs-toggle="dropdown">
                        Find Job<div class="arrow-down"></div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-center" aria-labelledby="jobsdropdown">
                        <li><a class="dropdown-item" href="{{ route('jobs') }}">Find By Position</a></li>
                        <li><a class="dropdown-item" href="{{ route('companies') }}">Find By Company</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown dropdown-hover">
                    <a class="nav-link" href="javascript:void(0)" id="productdropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        News
                        <div class="arrow-down"></div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-center" aria-labelledby="productdropdown">
                        @foreach ($categoryMenus = categoryMenu() as $categoryMenu)
                            <li><a class="dropdown-item" href="{{ route('news', ['category' => $categoryMenu->slug]) }}">{{ $categoryMenu->name }}</a></li>
                        @endforeach
                    </ul>
                </li><!--end dropdown-->
                <li class="nav-item">
                    <a href="{{ route('alumni-caring') }}" class="nav-link">Alumni Caring</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('tracer-study') }}" class="nav-link">Tracer Study</a>
                </li>
                <li class="nav-item dropdown dropdown-hover">
                    <a class="nav-link" href="javascript:void(0)" id="productdropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        About Us
                        <div class="arrow-down"></div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-center" aria-labelledby="productdropdown">
                        <li><a class="dropdown-item" href="#">Privacy Policy</a></li>
                        <li><a class="dropdown-item" href="#">About Us</a></li>
                    </ul>
                </li><!--end dropdown-->
            </ul><!--end navbar-nav-->
        </div>
        <!--end navabar-collapse-->

        <ul class="header-menu list-inline d-flex align-items-center mb-0">
            <li class="list-inline-item dropdown my-2 d-none d-md-block">
                <a href="{{ route('frontend.home') }}" class="btn btn-primary me-2">
                    @guest
                        <i class="mdi mdi-account-circle"></i> Login
                    @else
                        <i class="mdi mdi-home-account"></i> Dashboard
                    @endguest
                </a>
            </li>
        </ul>

    </div>
    <!--end container-->
</nav>
<!-- Navbar End -->
