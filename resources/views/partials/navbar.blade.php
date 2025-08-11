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
                        <li><a class="dropdown-item" href="{{ route('magang') }}">Internship/Magang</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('news', ['category' => 'acara-berita']) }}" class="nav-link">News</a>
                </li>
                <li class="nav-item dropdown dropdown-hover">
                    <a class="nav-link" href="javascript:void(0)" id="newsdropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Achievement
                        <div class="arrow-down"></div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-center" aria-labelledby="newsdropdown">
                        {{-- @foreach ($categoryMenus = categoryMenu() as $categoryMenu)
                            <li><a class="dropdown-item" href="{{ route('news', ['category' => $categoryMenu->slug]) }}">{{ $categoryMenu->name }}</a></li>
                        @endforeach --}}
                        {{-- <li><a class="dropdown-item" href="{{ route('news', ['category' => 'acara-berita']) }}">News</a></li> --}}
                        {{-- <li><a class="dropdown-item" href="{{ route('news', ['category' => 'beasiswa']) }}">Beasiswa</a></li> --}}
                        <li><a class="dropdown-item" href="{{ route('prestasi') }}">Prestasi Mahasiswa</a></li>
                        <li><a class="dropdown-item" href="{{ route('jadwal-lomba') }}">Jadwal Lomba</a></li>
                        <li><a class="dropdown-item" href="{{ route('infografis') }}">Infografis Prestasi</a></li>
                    </ul>
                </li><!--end dropdown-->
                <li class="nav-item">
                    <a href="{{ route('magang') }}" class="nav-link">Magang</a>
                </li>
                {{-- <li class="nav-item dropdown dropdown-hover">
                    <a class="nav-link" href="javascript:void(0)" id="mbkmdropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Magang Mahasiswa
                        <div class="arrow-down"></div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-center" aria-labelledby="mbkmdropdown">
                        <li><a class="dropdown-item" href="{{ route('magang') }}">Magang</a></li>
                        <li><a class="dropdown-item" href="#">Skripsi</a></li>
                        <li><a class="dropdown-item" href="#">KKN</a></li>
                    </ul>
                </li><!--end dropdown--> --}}
                <li class="nav-item dropdown dropdown-hover">
                    <a class="nav-link" href="javascript:void(0)" id="alumnidropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Alumni
                        <div class="arrow-down"></div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-center" aria-labelledby="alumnidropdown">
                        <li><a class="dropdown-item" href="#">Profil Alumni</a></li>
                        @auth
                        <li><a class="dropdown-item" href="{{ route('alumni-caring') }}">Alumni Caring</a></li>
                        @endauth
                    </ul>
                </li>
                <li class="nav-item dropdown dropdown-hover">
                    <a class="nav-link" href="javascript:void(0)" id="tracer-study" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Tracer Study
                        <div class="arrow-down"></div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-center" aria-labelledby="tracer-study">
                        <li><a class="dropdown-item" href="{{ route('tracer-alumni') }}">Untuk Alumni</a></li>
                        <li><a class="dropdown-item" href="{{ route('tracer-study') }}">Untuk Stakeholder</a></li>
                        <li><a class="dropdown-item" target="_blank" href="https://tracer.uns.ac.id/">Tracer Study Universitas</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown dropdown-hover">
                    <a class="nav-link" href="javascript:void(0)" id="about-us" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        About
                        <div class="arrow-down"></div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-center" aria-labelledby="about-us">
                        <li><a class="dropdown-item" href="{{ route('about-us') }}">Profil Fakultas Psikologi UNS</a></li>
                        <li><a class="dropdown-item" href="{{ route('team') }}">Profil CDC Fakultas Psikologi UNS</a></li>
                        <li><a class="dropdown-item" href="{{ route('team') }}">Informasi Job Posting</a></li>
                    </ul>
                </li>
                <!--end dropdown-->
                {{-- <li class="nav-item dropdown dropdown-hover">
                    <a class="nav-link" href="javascript:void(0)" id="productdropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        About Us
                        <div class="arrow-down"></div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-center" aria-labelledby="productdropdown">
                        <li><a class="dropdown-item" href="#">Privacy Policy</a></li>
                        <li><a class="dropdown-item" href="#">About Us</a></li>
                    </ul>
                </li><!--end dropdown--> --}}
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
