@extends('layouts.jobcy')

@section('title', 'Infografis')

@section('content')
    <!-- Start home -->
    <section class="page-title-box">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="text-center text-white">
                        <h3 class="mb-4">Infografis</h3>
                        <div class="page-next">
                            <nav class="d-inline-block" aria-label="breadcrumb text-center">
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"> Infografis </li>
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
                <div class="col-lg-12">
                    <div class="section-title me-lg-5">
                        <h6 class="sub-title">Infografis</h6>
                        <h2 class="title mb-4">Infografis Prestasi Mahasiswa</h2>

                        <p class="text-muted">Start working with Jobcy that can provide everything you need to generate awareness, drive traffic, connect. Dummy text is text that is used in the publishing industry or by web designers to occupy the space which will later be filled with 'real' content.</p>

                        <div class="row mt-4 pt-2">
                            <div class="col-md-12">
                                {!! $chart->container() !!}
                            </div>
                        </div>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->
    </section>
    <!-- END ABOUT -->

    <!-- COUNTER START -->
    <section class="section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="counter-box mt-3">
                        <div class="counters text-center">
                            <h5 class="counter mb-0">10,000+</h5>
                            <h6 class="fs-16 mt-3">Student</h6>
                        </div>
                    </div>
                </div><!--end col-->
                <div class="col-lg-3 col-md-6">
                    <div class="counter-box mt-3">
                        <div class="counters text-center">
                            <h5 class="counter mb-0">7500+</h5>
                            <h6 class="fs-16 mt-3">Achievement</h6>
                        </div>
                    </div>
                </div><!--end col-->
                <div class="col-lg-3 col-md-6">
                    <div class="counter-box mt-3">
                        <div class="counters text-center">
                            <h5 class="counter mb-0">8.85K</h5>
                            <h6 class="fs-16 mt-3">Positive Feedback</h6>
                        </div>
                    </div>
                </div><!--end col-->
                <div class="col-lg-3 col-md-6">
                    <div class="counter-box mt-3">
                        <div class="counters text-center">
                            <h5 class="counter mb-0">9875</h5>
                            <h6 class="fs-16 mt-3">Members</h6>
                        </div>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->
    </section>
    <!-- COUNTER END -->
@endsection

@section('scripts')
<script src="{{ $chart->cdn() }}"></script>

{{ $chart->script() }}
@endsection
