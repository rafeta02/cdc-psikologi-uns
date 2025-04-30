@extends('layouts.jobcy')

@section('title', $magang->name . ' | ' . $magang->company->name)

@section('content')
    <!-- Start home -->
    <section class="page-title-box">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="text-center text-white">
                        <h3 class="mb-4">{{ $magang->name }}</h3>
                        <div class="page-next">
                            <nav class="d-inline-block" aria-label="breadcrumb text-center">
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('magang') }}">Internship/Magang</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">{{ $magang->company->name }}</li>
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


    <!-- START MAGANG-DEATILS -->
    <section class="section">
        <div class="container">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            
            <div class="row">
                <div class="col-lg-8">
                    <div class="card job-detail overflow-hidden">
                        <div>
                            <img src="{{ asset('jobcy/images/jobs/img-' . str_pad(rand(1, 7), 2, '0', STR_PAD_LEFT) . '.jpg') }}" alt="" class="img-fluid" style="width: 100%; height: 320px; object-fit: cover;">
                            <div class="job-details-compnay-profile">
                                <img src="{{ $magang->company->image ? $magang->company->image->getUrl() : asset('jobcy/images/default-company.png') }}" alt="" class="img-fluid rounded-3 rounded-3" style="width: 120px; height: 120px; object-fit: cover;">
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="mb-1">{{ $magang->name }}</h5>
                                    </div><!--end col-->
                                </div><!--end row-->
                            </div>

                            <div class="mt-4">
                                <div class="row g-2">
                                    <div class="col-lg-6">
                                        <div class="border rounded-start p-3">
                                            <p class="text-muted mb-0 fs-13">Program Type</p>
                                            <p class="fw-medium fs-15 mb-0">{{ $magang->type }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="border p-3">
                                            <p class="text-muted fs-13 mb-0">Company</p>
                                            <p class="fw-medium mb-0">{{ $magang->company->name }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="border p-3">
                                            <p class="text-muted fs-13 mb-0">Internship Needs</p>
                                            <p class="fw-medium mb-0">{{ $magang->needs ?? 'Not specified' }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="border p-3">
                                            <p class="text-muted fs-13 mb-0">Slots Filled</p>
                                            <p class="fw-medium mb-0">{{ $magang->filled ?? '0' }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="border p-3">
                                            <p class="text-muted fs-13 mb-0">Open Date</p>
                                            <p class="fw-medium mb-0">{{ \Carbon\Carbon::parse($magang->open_date)->format('j F, Y') }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="border p-3">
                                            <p class="text-muted fs-13 mb-0">Close Date</p>
                                            <p class="fw-medium mb-0">
                                                @if ($magang->close_date_exist == 1)
                                                    {{ \Carbon\Carbon::parse($magang->close_date)->format('j F, Y') }}
                                                @else
                                                    Close without prior notice
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div><!--end Experience-->

                            <div class="mt-4">
                                <h5 class="mb-3">Description</h5>
                                <div class="job-detail-desc mt-2">
                                    <p class="text-muted mb-0">{!! $magang->description !!}</p>
                                </div>
                            </div>

                            <div class="mt-4">
                                <h5 class="mb-3">Requirements</h5>
                                <div class="job-details-desc">
                                    {!! $magang->persyaratan !!}
                                </div>
                            </div>

                            <div class="mt-4">
                                <h5 class="mb-3">How to Apply</h5>
                                <div class="job-details-desc">
                                    {!! $magang->registrasi !!}
                                </div>
                            </div>

                            <div class="mt-5 pt-3">
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item mt-1">
                                        Share this internship:
                                    </li>
                                    <li class="list-inline-item mt-1">
                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="btn btn-primary btn-hover"><i class="uil uil-facebook-f"></i> Facebook</a>
                                    </li>
                                    <li class="list-inline-item mt-1">
                                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($magang->name) }}" target="_blank" class="btn btn-info btn-hover"><i class="uil uil-twitter-alt"></i> Twitter</a>
                                    </li>
                                    <li class="list-inline-item mt-1">
                                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}" target="_blank" class="btn btn-success btn-hover"><i class="uil uil-linkedin-alt"></i> linkedin</a>
                                    </li>
                                </ul>
                            </div>
                        </div><!--end card-body-->
                    </div><!--end job-detail-->

                    @if (!$relatedMagangs->isEmpty())
                        <div class="mt-4">
                            <h5>Related Internships</h5>
                            <div id="related-magang">
                                @foreach($relatedMagangs as $magang)
                                    <div class="job-box card mt-4">
                                        <div class="p-4">
                                            <div class="row">
                                                <div class="col-lg-2">
                                                    <a href="{{ route('magang-detail', ['slug' => $magang->slug]) }}"><img src="{{ $magang->company->image ? $magang->company->image->getUrl() : asset('jobcy/images/default-company.png') }}" alt="" class="img-fluid rounded-3" style="width: 90px; height: 90px; object-fit: cover;"></a>
                                                </div><!--end col-->
                                                <div class="col-lg-10">
                                                    <div class="mt-3 mt-lg-0">
                                                        <h5 class="fs-17 mb-1"><a href="{{ route('magang-detail', ['slug' => $magang->slug]) }}" class="text-dark">{{ $magang->name }}</a></h5>
                                                        <ul class="list-inline mb-2">
                                                            <li class="list-inline-item">
                                                                <p class="text-muted fs-16 mb-0"><a href="{{ route('company-detail', $magang->company->slug ?? '') }}" class="text-dark">{{ $magang->company->name }}</a></p>
                                                            </li>
                                                        </ul>
                                                        <ul class="list-inline mb-2">
                                                            <li class="list-inline-item">
                                                                <p class="text-muted fs-12 mb-0"><i class="mdi mdi-domain"></i> PROGRAM : {{ strtoupper($magang->type ?? '') }}</p>
                                                            </li>
                                                        </ul>
                                                        <div class="mt-2">
                                                            @if ($magang->type == 'MBKM')
                                                                <span class="badge bg-success-subtle text-success mt-1">MBKM</span>
                                                            @else
                                                                <span class="badge bg-primary-subtle text-primary mt-1">Regular</span>
                                                            @endif
                                                            
                                                            @if($magang->featured)
                                                                <span class="badge bg-warning-subtle text-warning mt-1">Featured</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div><!--end col-->
                                            </div><!--end row-->
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <a href="{{ route('magang') }}" class="primary-link form-text">View More <i class="mdi mdi-arrow-right"></i></a>
                        </div>
                    @endif
                </div><!--end col-->

                <div class="col-lg-4 mt-4 mt-lg-0">
                    <!--start side-bar-->
                    <div class="side-bar ms-lg-4">
                        <div class="card job-overview">
                            <div class="card-body p-4">
                                <h6 class="fs-17">Internship Overview</h6>
                                <ul class="list-unstyled mt-4 mb-0">
                                    <li>
                                        <div class="d-flex mt-4">
                                            <i class="uil uil-building icon bg-primary-subtle text-primary"></i>
                                            <div class="ms-3">
                                                <h6 class="fs-14 mb-2">Company</h6>
                                                <p class="text-muted mb-0">{{ $magang->company->name }}</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex mt-4">
                                            <i class="uil uil-clock-eight icon bg-primary-subtle text-primary"></i>
                                            <div class="ms-3">
                                                <h6 class="fs-14 mb-2">Program Type</h6>
                                                <p class="text-muted mb-0">{{ $magang->type }}</p>
                                            </div>
                                        </div>
                                    </li>
                                    @if($magang->needs)
                                    <li>
                                        <div class="d-flex mt-4">
                                            <i class="uil uil-users-alt icon bg-primary-subtle text-primary"></i>
                                            <div class="ms-3">
                                                <h6 class="fs-14 mb-2">Available Positions</h6>
                                                <p class="text-muted mb-0">{{ $magang->needs - ($magang->filled ?? 0) }} openings</p>
                                            </div>
                                        </div>
                                    </li>
                                    @endif
                                    <li>
                                        <div class="d-flex mt-4">
                                            <i class="uil uil-star-half-alt icon bg-primary-subtle text-primary"></i>
                                            <div class="ms-3">
                                                <h6 class="fs-14 mb-2">Featured</h6>
                                                <p class="text-muted mb-0">{{ $magang->featured ? 'Yes' : 'No' }}</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex mt-4">
                                            <i class="uil uil-calendar-alt icon bg-primary-subtle text-primary"></i>
                                            <div class="ms-3">
                                                <h6 class="fs-14 mb-2">Application Deadline</h6>
                                                <p class="text-muted mb-0">
                                                    @if ($magang->close_date_exist == 1)
                                                        {{ \Carbon\Carbon::parse($magang->close_date)->format('j F, Y') }}
                                                    @else
                                                        Close without prior notice
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <div class="mt-3">
                                    <a href="{{ route('company-detail', $magang->company->slug ?? '') }}" class="btn btn-primary btn-hover w-100 mt-2">Visit Company <i class="uil uil-arrow-right"></i></a>
                                    
                                    @auth
                                        <a href="{{ route('magang.apply', ['slug' => $magang->slug]) }}" class="btn btn-success btn-hover w-100 mt-2">Apply Now <i class="uil uil-check"></i></a>
                                    @else
                                        <a href="{{ route('login') }}" class="btn btn-outline-success btn-hover w-100 mt-2">Login to Apply <i class="uil uil-signin"></i></a>
                                    @endauth
                                </div>
                            </div><!--end card-body-->
                        </div><!--end job-overview-->

                        <div class="card company-profile mt-4">
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <img src="{{ $magang->company->image ? $magang->company->image->getUrl() : asset('jobcy/images/default-company.png') }}" alt="" class="img-fluid rounded-3" style="width: 120px; height: 120px; object-fit: cover;">

                                    <div class="mt-4">
                                        <h6 class="fs-17 mb-1">{{ $magang->company->name }}</h6>
                                        <p class="text-muted">{{ $magang->company->industry->name ?? '' }}</p>
                                    </div>
                                </div>
                                <ul class="list-unstyled mt-4">
                                    @if($magang->company->website)
                                    <li>
                                        <div class="d-flex">
                                            <i class="uil uil-globe text-primary fs-18"></i>
                                            <div class="ms-3">
                                                <h6 class="fs-14 mb-1">Website</h6>
                                                <p class="text-muted mb-0 fs-14">{{ $magang->company->website }}</p>
                                            </div>
                                        </div>
                                    </li>
                                    @endif
                                    @if($magang->company->location)
                                    <li>
                                        <div class="d-flex mt-3">
                                            <i class="uil uil-map-marker text-primary fs-18"></i>
                                            <div class="ms-3">
                                                <h6 class="fs-14 mb-1">Location</h6>
                                                <p class="text-muted mb-0 fs-14">{{ $magang->company->location }}</p>
                                            </div>
                                        </div>
                                    </li>
                                    @endif
                                    @if($magang->company->email)
                                    <li>
                                        <div class="d-flex mt-3">
                                            <i class="uil uil-envelope text-primary fs-18"></i>
                                            <div class="ms-3">
                                                <h6 class="fs-14 mb-1">Email</h6>
                                                <p class="text-muted mb-0 fs-14">{{ $magang->company->email }}</p>
                                            </div>
                                        </div>
                                    </li>
                                    @endif
                                </ul>
                                <div class="mt-4">
                                    <a href="{{ route('company-detail', $magang->company->slug ?? '') }}" class="btn btn-primary btn-hover w-100 rounded"><i class="mdi mdi-eye"></i> View Company</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end side-bar-->
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->
    </section>
    <!-- END MAGANG-DETAILS -->
@endsection 