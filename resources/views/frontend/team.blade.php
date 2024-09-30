@extends('layouts.jobcy')

@section('title', 'Our Team')

@section('content')
    <!-- Start home -->
    <section class="page-title-box">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="text-center text-white">
                        <h3 class="mb-4">Team</h3>
                        <div class="page-next">
                            <nav class="d-inline-block" aria-label="breadcrumb text-center">
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"> Team </li>
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
    <section class="section">
        <div class="container">
            <div class="row align-items-center g-0">
                <div class="col-lg-6">
                    <div class="about-img mt-4 mt-lg-0">
                        <img src="{{ asset('img/MeetTheTeam.png') }}" alt="" class="img-fluid rounded" style="width: 512px; height: auto; object-fit: cover;">
                    </div>
                </div><!--end col-->
                <div class="col-lg-6">
                    <div class="section-title me-lg-5">
                        <h6 class="sub-title">Meet The Team</h6>
                        <h2 class="title mb-4">Who <span class="text-warning fw-bold">(CDC FAPSI)</span> Behind The scene ?</h2>

                        <p class="text-muted">
                            Di balik semua operasional kami, terdapat tim berdedikasi yang siap mendukung perjalanan Anda. Dipimpin oleh Ibu Fadjri Kirana Anggarani, S.Psi., M.A., tim kami bekerja tanpa henti untuk memastikan pengalaman terbaik bagi Anda. Bersama dengan Florine Mulia dan Jonathan Liandres Edwan, kami berkomitmen untuk membantu Anda meraih kesuksesan.
                        </p>
                    </div>
                </div><!--end col-->
            </div><!--end row-->

            <div class="row mt-5">
                <div class="col-lg-12 col-md-12">
                    <div class="team-box card border-0 mt-4">
                        <div class="team-img position-relative mx-auto">
                            <img src="{{ asset('img/bu_kiki.png') }}" alt="" class="img-thumbnail" style="width: 216px; height: 280px; object-fit: cover;"  >
                            <ul class="team-social list-unstyled">
                                <li><a href="javascript:void(0)"><i class="mdi mdi-facebook"></i></a></li>
                                <li class="my-1"><a href="javascript:void(0)"><i class="mdi mdi-twitter"></i></a> </li>
                                <li><a href="javascript:void(0)"><i class="mdi mdi-skype"></i></a></li>
                            </ul>
                        </div>
                        <div class="team-content card-body text-center">
                            <a href="javascript:void(0)" class="primary-link"><h6 class="fs-17 mb-1">Fadjri Kirana Anggarani, S.Psi., M.A.</h6></a>
                            <p class="text-muted mb-0">Head of Career Development Center Fakultas Psikologi UNS</p>
                        </div>
                    </div><!--end team-box-->
                </div><!--end col-->
            </div>
            <div class="row mt-2">
                <div class="col-lg-6 col-md-6">
                    <div class="team-box card border-0 mt-4">
                        <div class="team-img position-relative mx-auto">
                            <img src="{{ asset('img/flo.png') }}" alt="" class="img-thumbnail" style="width: 216px; height: 280px; object-fit: cover;">
                            <ul class="team-social list-unstyled">
                                <li><a href="javascript:void(0)"><i class="mdi mdi-facebook"></i></a></li>
                                <li class="my-1"><a href="javascript:void(0)"><i class="mdi mdi-twitter"></i></a> </li>
                                <li><a href="javascript:void(0)"><i class="mdi mdi-skype"></i></a></li>
                            </ul>
                        </div>
                        <div class="team-content card-body text-center">
                            <a href="javascript:void(0)" class="primary-link"><h6 class="fs-17 mb-1">Florine Mulia</h6></a>
                            <p class="text-muted mb-0">General Affairs and Administrative Assistant </p>
                        </div>
                    </div><!--end team-box-->
                </div><!--end col-->

                <div class="col-lg-6 col-md-6">
                    <div class="team-box card border-0 mt-4">
                        <div class="team-img position-relative mx-auto">
                            <img src="{{ asset('img/jo.png') }}" alt="" class="img-thumbnail" style="width: 216px; height: 280px; object-fit: cover;">
                            <ul class="team-social list-unstyled">
                                <li><a href="javascript:void(0)"><i class="mdi mdi-facebook"></i></a></li>
                                <li class="my-1"><a href="javascript:void(0)"><i class="mdi mdi-twitter"></i></a> </li>
                                <li><a href="javascript:void(0)"><i class="mdi mdi-skype"></i></a></li>
                            </ul>
                        </div>
                        <div class="team-content card-body text-center">
                            <a href="javascript:void(0)" class="primary-link"><h6 class="fs-17 mb-1">Jonathan Liandres Edwan</h6></a>
                            <p class="text-muted mb-0">Graphic Designer and Content Creator Assistant</p>
                        </div>
                    </div><!--end team-box-->
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->
    </section>
    <!-- END ABOUT -->
@endsection
