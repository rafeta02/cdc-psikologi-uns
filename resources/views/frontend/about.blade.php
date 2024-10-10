@extends('layouts.jobcy')

@section('title', 'About Us - Career Development Center Fakultas Psikologi UNS')

@section('content')
    <!-- Start home -->
    <section class="page-title-box">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="text-center text-white">
                        <h3 class="mb-4">About Us</h3>
                        <div class="page-next">
                            <nav class="d-inline-block" aria-label="breadcrumb text-center">
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"> About Us </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>
    <!-- end home -->

    <!-- START SHAPE -->
    <div class="position-relative" style="z-index: 1">
        <div class="shape">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 250">
                <path fill="" fill-opacity="1"
                    d="M0,192L120,202.7C240,213,480,235,720,234.7C960,235,1200,213,1320,202.7L1440,192L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z"></path>
            </svg>
        </div>
    </div>
    <!-- END SHAPE -->


    <!-- START ABOUT -->
    <section class="section overflow-hidden">
        <div class="container">
            <div class="row align-items-center g-0">
                <div class="col-lg-6">
                    <div class="section-title me-lg-5">
                        <h6 class="sub-title">About Us</h6>
                        <h2 class="title mb-4">Who Are <span class="text-warning fw-bold">We</span> ?</h2>

                        <p class="text-muted">
                            Career Development Center Fakultas Psikologi (CDC FPsi) Universitas Sebelas Maret merupakan pusat pengembangan karier yang diperuntukkan bagi mahasiswa Fakultas Psikologi Universitas Sebelas Maret. Kami bertujuan untuk mencetak lulusan Fakultas Psikologi UNS yang berdaya saing kerja di tingkat nasional maupun internasional. CDC FPsi dibentuk pada Tahun 2024 menyusul berubahnya Program Studi Psikologi menjadi Fakultas Psikologi pada tanggal 11 Maret 2022 sesuai SK Rektor Universitas Sebelas Maret Nomor 320/UN27/HK/2022.
                        </p>

                        <div class="row mt-4 pt-2">
                            <div class="col-md-6">
                                <ul class="list-unstyled about-list text-muted mb-0 mb-md-3">
                                    <li> Visi </li>
                                    <li> Misi </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div><!--end col-->
                <div class="col-lg-6">
                <div class="about-img mt-4 mt-lg-0">
                    <img src="{{ asset('img/gedung_d.png') }}" alt="" class="img-fluid rounded" style="width: 660px; height: auto; object-fit: cover;">
                </div>
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->
    </section>
    <!-- END ABOUT -->
@endsection
