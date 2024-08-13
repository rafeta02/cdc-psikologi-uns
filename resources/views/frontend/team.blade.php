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


    <!-- START TEAM-PAGE -->
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="team-box card border-0 mt-4">
                        <div class="team-img position-relative mx-auto">
                            <img src="{{ asset('jobcy/images/user/img-01.jpg') }}" alt="" class="img-thumbnail">
                            <ul class="team-social list-unstyled">
                                <li><a href="javascript:void(0)"><i class="mdi mdi-facebook"></i></a></li>
                                <li class="my-1"><a href="javascript:void(0)"><i class="mdi mdi-twitter"></i></a> </li>
                                <li><a href="javascript:void(0)"><i class="mdi mdi-skype"></i></a></li>
                            </ul>
                        </div>
                        <div class="team-content card-body text-center">
                            <a href="javascript:void(0)" class="primary-link"><h6 class="fs-17 mb-1">Rebecca Swartz</h6></a>
                            <p class="text-muted mb-0">Founder & CEO</p>
                        </div>
                    </div><!--end team-box-->
                </div><!--end col-->

                <div class="col-lg-4 col-md-6">
                    <div class="team-box card border-0 mt-4">
                        <div class="team-img position-relative mx-auto">
                            <img src="{{ asset('jobcy/images/user/img-02.jpg') }}" alt="" class="img-thumbnail">
                            <ul class="team-social list-unstyled">
                                <li><a href="javascript:void(0)"><i class="mdi mdi-facebook"></i></a></li>
                                <li class="my-1"><a href="javascript:void(0)"><i class="mdi mdi-twitter"></i></a> </li>
                                <li><a href="javascript:void(0)"><i class="mdi mdi-skype"></i></a></li>
                            </ul>
                        </div>
                        <div class="team-content card-body text-center">
                            <a href="javascript:void(0)" class="primary-link"><h6 class="fs-17 mb-1">James Lemire</h6></a>
                            <p class="text-muted mb-0">Project Manager</p>
                        </div>
                    </div><!--end team-box-->
                </div><!--end col-->

                <div class="col-lg-4 col-md-6">
                    <div class="team-box card border-0 mt-4">
                        <div class="team-img position-relative mx-auto">
                            <img src="{{ asset('jobcy/images/user/img-03.jpg') }}" alt="" class="img-thumbnail">
                            <ul class="team-social list-unstyled">
                                <li><a href="javascript:void(0)"><i class="mdi mdi-facebook"></i></a></li>
                                <li class="my-1"><a href="javascript:void(0)"><i class="mdi mdi-twitter"></i></a> </li>
                                <li><a href="javascript:void(0)"><i class="mdi mdi-skype"></i></a></li>
                            </ul>
                        </div>
                        <div class="team-content card-body text-center">
                            <a href="javascript:void(0)" class="primary-link"><h6 class="fs-17 mb-1">Charles Dickens</h6></a>
                            <p class="text-muted mb-0">Financial Analyst</p>
                        </div>
                    </div><!--end team-box-->
                </div><!--end col-->

                <div class="col-lg-4 col-md-6">
                    <div class="team-box card border-0 mt-4">
                        <div class="team-img position-relative mx-auto">
                            <img src="{{ asset('jobcy/images/user/img-04.jpg') }}" alt="" class="img-thumbnail">
                            <ul class="team-social list-unstyled">
                                <li><a href="javascript:void(0)"><i class="mdi mdi-facebook"></i></a></li>
                                <li class="my-1"><a href="javascript:void(0)"><i class="mdi mdi-twitter"></i></a> </li>
                                <li><a href="javascript:void(0)"><i class="mdi mdi-skype"></i></a></li>
                            </ul>
                        </div>
                        <div class="team-content card-body text-center">
                            <a href="javascript:void(0)" class="primary-link"><h6 class="fs-17 mb-1">Jeffrey Montgomery</h6></a>
                            <p class="text-muted mb-0">UI/UX Designer</p>
                        </div>
                    </div><!--end team-box-->
                </div><!--end col-->

                <div class="col-lg-4 col-md-6">
                    <div class="team-box card border-0 mt-4">
                        <div class="team-img position-relative mx-auto">
                            <img src="{{ asset('jobcy/images/user/img-05.jpg') }}" alt="" class="img-thumbnail">
                            <ul class="team-social list-unstyled">
                                <li><a href="javascript:void(0)"><i class="mdi mdi-facebook"></i></a></li>
                                <li class="my-1"><a href="javascript:void(0)"><i class="mdi mdi-twitter"></i></a> </li>
                                <li><a href="javascript:void(0)"><i class="mdi mdi-skype"></i></a></li>
                            </ul>
                        </div>
                        <div class="team-content card-body text-center">
                            <a href="javascript:void(0)" class="primary-link"><h6 class="fs-17 mb-1">Brooke Hayes</h6></a>
                            <p class="text-muted mb-0">Team Leader</p>
                        </div>
                    </div><!--end team-box-->
                </div><!--end col-->

                <div class="col-lg-4 col-md-6">
                    <div class="team-box card border-0 mt-4">
                        <div class="team-img position-relative mx-auto">
                            <img src="{{ asset('jobcy/images/user/img-06.jpg') }}" alt="" class="img-thumbnail">
                            <ul class="team-social list-unstyled">
                                <li><a href="javascript:void(0)"><i class="mdi mdi-facebook"></i></a></li>
                                <li class="my-1"><a href="javascript:void(0)"><i class="mdi mdi-twitter"></i></a> </li>
                                <li><a href="javascript:void(0)"><i class="mdi mdi-skype"></i></a></li>
                            </ul>
                        </div>
                        <div class="team-content card-body text-center">
                            <a href="javascript:void(0)" class="primary-link"><h6 class="fs-17 mb-1">Olivia Murphy</h6></a>
                            <p class="text-muted mb-0">Designer</p>
                        </div>
                    </div><!--end team-box-->
                </div><!--end col-->

                <div class="col-lg-4 col-md-6">
                    <div class="team-box card border-0 mt-4">
                        <div class="team-img position-relative mx-auto">
                            <img src="{{ asset('jobcy/images/user/img-07.jpg') }}" alt="" class="img-thumbnail">
                            <ul class="team-social list-unstyled">
                                <li><a href="javascript:void(0)"><i class="mdi mdi-facebook"></i></a></li>
                                <li class="my-1"><a href="javascript:void(0)"><i class="mdi mdi-twitter"></i></a> </li>
                                <li><a href="javascript:void(0)"><i class="mdi mdi-skype"></i></a></li>
                            </ul>
                        </div>
                        <div class="team-content card-body text-center">
                            <a href="javascript:void(0)" class="primary-link"><h6 class="fs-17 mb-1">Betty Richards</h6></a>
                            <p class="text-muted mb-0">Developer</p>
                        </div>
                    </div><!--end team-box-->
                </div><!--end col-->

                <div class="col-lg-4 col-md-6">
                    <div class="team-box card border-0 mt-4">
                        <div class="team-img position-relative mx-auto">
                            <img src="{{ asset('jobcy/images/user/img-08.jpg') }}" alt="" class="img-thumbnail">
                            <ul class="team-social list-unstyled">
                                <li><a href="javascript:void(0)"><i class="mdi mdi-facebook"></i></a></li>
                                <li class="my-1"><a href="javascript:void(0)"><i class="mdi mdi-twitter"></i></a> </li>
                                <li><a href="javascript:void(0)"><i class="mdi mdi-skype"></i></a></li>
                            </ul>
                        </div>
                        <div class="team-content card-body text-center">
                            <a href="javascript:void(0)" class="primary-link"><h6 class="fs-17 mb-1">Gabriel Palmer</h6></a>
                            <p class="text-muted mb-0">Back End Developer</p>
                        </div>
                    </div><!--end team-box-->
                </div><!--end col-->

                <div class="col-lg-4 col-md-6">
                    <div class="team-box card border-0 mt-4">
                        <div class="team-img position-relative mx-auto">
                            <img src="{{ asset('jobcy/images/user/img-09.jpg') }}" alt="" class="img-thumbnail">
                            <ul class="team-social list-unstyled">
                                <li><a href="javascript:void(0)"><i class="mdi mdi-facebook"></i></a></li>
                                <li class="my-1"><a href="javascript:void(0)"><i class="mdi mdi-twitter"></i></a> </li>
                                <li><a href="javascript:void(0)"><i class="mdi mdi-skype"></i></a></li>
                            </ul>
                        </div>
                        <div class="team-content card-body text-center">
                            <a href="javascript:void(0)" class="primary-link"><h6 class="fs-17 mb-1">Gabriel Palmer</h6></a>
                            <p class="text-muted mb-0">Back End Developer</p>
                        </div>
                    </div><!--end team-box-->
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->
    </section>
    <!-- START TEAM-PAGE -->
@endsection
