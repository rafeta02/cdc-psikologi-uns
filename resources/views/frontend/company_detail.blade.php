@extends('layouts.jobcy')

@section('title', $company->name)

@section('content')
    <!-- Start home -->
    <section class="page-title-box">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="text-center text-white">
                        <h3 class="mb-4">{{ $company->name }} </h3>
                        <div class="page-next">
                            <nav class="d-inline-block" aria-label="breadcrumb text-center">
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Company</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"> {{ $company->name }} </li>
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

     <!-- START CANDIDATE-DETAILS -->
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card side-bar">
                        <div class="card-body p-4">
                            <div class="candidate-profile text-center">
                                <img src="{{ $company->image ?? asset('jobcy/images/featured-job/img-02.png') }}" alt="" class="avatar-lg rounded-circle">
                                <h6 class="fs-18 mb-1 mt-4">{{ $company->name }} </h6>
                                <p class="text-muted mb-4">{{ $company->location }}</p>
                                <ul class="candidate-detail-social-menu list-inline mb-0">
                                    <li class="list-inline-item">
                                        <a href="javascript:void(0)" class="social-link"><i class="uil uil-twitter-alt"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="javascript:void(0)" class="social-link"><i class="uil uil-whatsapp"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="javascript:void(0)" class="social-link"><i class="uil uil-phone-alt"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div><!--end candidate-profile-->

                        <div class="candidate-profile-overview  card-body border-top p-4">
                            <h6 class="fs-17 fw-medium mb-3">Company Profile</h6>
                            <ul class="list-unstyled mb-0">
                                <li>
                                    <div class="d-flex">
                                        <label class="text-dark">Industry Area</label>
                                        <div>
                                            <p class="text-muted mb-0">{{ $company->industry->name ?? '' }}</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <label class="text-dark">Ownership</label>
                                        <div>
                                            <p class="text-muted mb-0">{{ ucwords($company->ownership) ?? '' }}</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <label class="text-dark">Scale</label>
                                        <div>
                                            <p class="text-muted mb-0">{{ ucwords($company->scale) ?? '' }}</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <label class="text-dark">Employees</label>
                                        <div>
                                            <p class="text-muted text-break mb-0">{{ angka($company->number_of_employee) }} Person</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div><!--candidate-profile-overview-->
                        <div class="candidate-profile-overview  card-body border-top p-4">
                            <h6 class="fs-17 fw-medium mb-3">Company Contact</h6>
                            <ul class="list-unstyled mb-0">
                                <li>
                                    <div class="d-flex">
                                        <label class="text-dark">Phone</label>
                                        <div>
                                            <p class="text-muted mb-0">{{ $company->telephone }}</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <label class="text-dark">Email</label>
                                        <div>
                                            <p class="text-muted mb-0">{{ $company->email }}</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <label class="text-dark">Website</label>
                                        <div>
                                            <p class="text-muted mb-0">{{ $company->website }}</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <label class="text-dark">Address</label>
                                        <div>
                                            <p class="text-muted text-break mb-0">{{ $company->address }}</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div><!--candidate-profile-overview-->
                        {{-- <div class="card-body p-4 border-top">
                            <div class="ur-detail-wrap">
                                <div class="ur-detail-wrap-header">
                                    <h6 class="fs-17 fw-medium mb-3">Working Days</h6>
                                </div>
                                <div class="ur-detail-wrap-body">
                                    <ul class="working-days">
                                        <li>Monday<span>9AM - 5PM</span></li>
                                        <li>Tuesday<span>9AM - 5PM</span></li>
                                        <li>Wednesday<span>9AM - 5PM</span></li>
                                        <li>Thursday<span>9AM - 5PM</span></li>
                                        <li>Friday<span>9AM - 5PM</span></li>
                                        <li>Saturday<span>9AM - 5PM</span></li>
                                        <li>Sunday<span class="text-danger">Close</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div><!--end card-body--> --}}
                        {{-- <div class="card-body p-4 border-top">
                            <h6 class="fs-17 fw-medium mb-4">Company Location</h6>
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d193595.15830869428!2d-74.119763973046!3d40.69766374874431!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sin!4v1628067715234!5m2!1sen!2sin"
                                style="width:100%"  height="250" allowfullscreen="" loading="lazy"></iframe>
                        </div> --}}
                    </div><!--end card-->
                </div><!--end col-->

                <div class="col-lg-8">
                    <div class="card ms-lg-4 mt-4 mt-lg-0">
                        <div class="card-body p-4">

                            <div class="mb-5">
                                <h6 class="fs-17 fw-medium mb-4">About Company</h6>
                                <div class="text-muted">{!! $company->description !!}</div>
                            </div>

                            {{-- <div class="candidate-portfolio mb-5">
                                <h6 class="fs-17 fw-medium mb-4">Gallery</h6>
                                <div class="row g-3">
                                    <div class="col-lg-6">
                                        <div class="candidate-portfolio-box card border-0">
                                            <img src="{{ asset('jobcy/images/featured-job/img-01.png') }}" alt="" class="img-fluid">
                                            <div class="bg-overlay"></div>
                                            <div class="zoom-icon">
                                                <a href="{{ asset('jobcy/images/featured-job/img-01.png') }}" class="image-popup text-white" data-title="Project Leader" data-description="There are many variations of passages of available, but the majority alteration in some form."><i class="uil uil-search-alt"></i></a>
                                            </div>
                                        </div>
                                    </div><!-- end col -->
                                    <div class="col-lg-6">
                                        <div class="candidate-portfolio-box card border-0">
                                            <img src="{{ asset('jobcy/images/featured-job/img-01.png') }}" alt="" class="img-fluid">
                                            <div class="bg-overlay"></div>
                                            <div class="zoom-icon">
                                                <a href="{{ asset('jobcy/images/featured-job/img-01.png') }}" class="image-popup text-white" data-title="Project Leader" data-description="There are many variations of passages of available, but the majority alteration in some form."><i class="uil uil-search-alt"></i></a>
                                            </div>
                                        </div>
                                    </div><!-- end col -->
                                    <div class="col-lg-12">
                                        <div class="candidate-portfolio-box card border-0">
                                            <img src="{{ asset('jobcy/images/featured-job/img-01.png') }}" alt="" class="img-fluid">
                                            <div class="bg-overlay"></div>
                                            <div class="zoom-icon">
                                                <a href="{{ asset('jobcy/images/featured-job/img-01.png') }}" class="image-popup text-white" data-title="Project Leader" data-description="There are many variations of passages of available, but the majority alteration in some form."><i class="uil uil-search-alt"></i></a>
                                            </div>
                                        </div>
                                    </div><!-- end col -->
                                </div><!-- end row -->
                            </div><!-- end portfolio --> --}}

                            <div>
                                @if ($jobs->isEmpty())
                                    <h6 class="fs-17 fw-medium mb-4">No Job Opening</h6>
                                @else
                                    <h6 class="fs-17 fw-medium mb-4">Current Opening</h6>
                                    <div id="job-list">
                                        @include('partials.job-list', ['jobs' => $jobs])
                                    </div>
                                @endif
                            </div>
                        </div><!-- card body end -->
                    </div><!--end card-->
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->
    </section>
    <!-- END CANDIDATE-DETAILS -->
@endsection

@section('scripts')
<script>
    // AJAX Filtering Function
    function filterJobs(page = 1) {
        $.ajax({
            url: '{{ route('jobs') }}',
            type: 'GET',
            data: {
                company: {{ $company->id }},
                page: page // Include the current page number for pagination
            },
            success: function(data) {
                $('#job-list').html(data);
            }
        });
    }

    // Handle pagination link clicks
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        filterCompanies(page);
    });
</script>
@endsection