@extends('layouts.jobcy')

@section('title', $job->name . ' | ' . $job->company->name)

@section('content')
    <!-- Start home -->
    <section class="page-title-box">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="text-center text-white">
                        <h3 class="mb-4">{{ $job->name }}</h3>
                        <div class="page-next">
                            <nav class="d-inline-block" aria-label="breadcrumb text-center">
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Jobs</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"> {{ $job->company->name }}</li>
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


    <!-- START JOB-DEATILS -->
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card job-detail overflow-hidden">
                        <div>
                            <img src="{{ asset('jobcy/images/jobs/img-' . str_pad(rand(1, 7), 2, '0', STR_PAD_LEFT) . '.jpg') }}" alt="" class="img-fluid" style="width: 100%; height: 320px; object-fit: cover;">
                            <div class="job-details-compnay-profile">
                                <img src="{{ $job->company->image ? $job->company->image->getUrl() : asset('jobcy/images/default-company.png') }}" alt="" class="img-fluid rounded-3 rounded-3" style="width: 120px; height: 120px; object-fit: cover;">
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="mb-1">{{ $job->name }}</h5>
                                        {{-- <ul class="list-inline text-muted mb-0">
                                            <li class="list-inline-item">
                                                <i class="mdi mdi-account"></i> 8 Vacancy
                                            </li>
                                            <li class="list-inline-item text-warning review-rating">
                                                <span class="badge bg-warning">4.8</span> <i class="mdi mdi-star align-middle"></i><i class="mdi mdi-star align-middle"></i><i class="mdi mdi-star align-middle"></i><i class="mdi mdi-star align-middle"></i><i class="mdi mdi-star-half-full align-middle"></i>
                                            </li>
                                        </ul> --}}
                                    </div><!--end col-->
                                    {{-- <div class="col-lg-4">
                                        <ul class="list-inline mb-0 text-lg-end mt-3 mt-lg-0">
                                            <li class="list-inline-item">
                                                <div class="favorite-icon">
                                                    <a href="javascript:void(0)"><i class="uil uil-heart-alt"></i></a>
                                                </div>
                                            </li>
                                            <li class="list-inline-item">
                                                <div class="favorite-icon">
                                                    <a href="javascript:void(0)"><i class="uil uil-setting"></i></a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div><!--end col--> --}}
                                </div><!--end row-->
                            </div>

                            <div class="mt-4">
                                <div class="row g-2">
                                    <div class="col-lg-6">
                                        <div class="border rounded-start p-3">
                                            <p class="text-muted mb-0 fs-13">Position</p>
                                            <p class="fw-medium fs-15 mb-0">{{ $job->position->name }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="border p-3">
                                            <p class="text-muted fs-13 mb-0">Type of Employment</p>
                                            <p class="fw-medium mb-0">{{ \App\Models\Vacancy::TYPE_SELECT[$job->type] }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="border p-3">
                                            <p class="text-muted fs-13 mb-0">Industry</p>
                                            <p class="fw-medium mb-0">{{ $job->industry->name }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="border p-3">
                                            <p class="text-muted fs-13 mb-0">Experience</p>
                                            <p class="fw-medium mb-0">{{ $job->experience->name }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="border p-3">
                                            <p class="text-muted fs-13 mb-0">Location</p>
                                            @forelse ($job->locations as $location)
                                                <p class="fw-medium mb-0">{{ ucwords($location->regency_with_province_name ?? '')}}</p>
                                            @empty
                                                <p class="fw-medium mb-0">To be determined/ Flexible/ Remote options available.</p>
                                            @endforelse
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="border rounded-start p-3">
                                            <p class="text-muted mb-0 fs-13">Education</p>
                                            <p class="fw-medium fs-15 mb-0">
                                                @foreach($job->education as $key => $education)
                                                    <span class="badge bg-primary">{{ $education->name }}</span>
                                                @endforeach
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="border p-3">
                                            <p class="text-muted fs-13 mb-0">Department</p>
                                            <p class="fw-medium mb-0">
                                                @foreach($job->departments as $key => $department)
                                                    <span class="badge bg-success">{{ $department->name }}</span>
                                                @endforeach
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="border p-3">
                                            <p class="text-muted fs-13 mb-0">Additional Tags</p>
                                            <p class="fw-medium mb-0">
                                                @foreach($job->tags as $key => $tag)
                                                    <span class="badge bg-info">{{ $tag->name }}</span>
                                                @endforeach
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div><!--end Experience-->

                            <div class="mt-4">
                                <h5 class="mb-3">Requirements </h5>
                                <div class="job-detail-desc mt-2">
                                    {!! $job->persyaratan_umum !!}
                                </div>
                            </div>

                            <div class="mt-4">
                                <h5 class="mb-3">Job Description</h5>
                                <div class="job-detail-desc">
                                    <p class="text-muted mb-0">{!! $job->description !!}</p>
                                </div>
                            </div>

                            <div class="mt-4">
                                <h5 class="mb-3">How to Register</h5>
                                <div class="job-details-desc">
                                    {!! $job->registration !!}
                                </div>
                            </div>

                            <div class="mt-5 pt-3">
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item mt-1">
                                        Share this job:
                                    </li>
                                    <li class="list-inline-item mt-1">
                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="btn btn-primary btn-hover"><i class="uil uil-facebook-f"></i> Facebook</a>
                                    </li>
                                    <li class="list-inline-item mt-1">
                                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($job->name) }}" target="_blank" class="btn btn-info btn-hover"><i class="uil uil-twitter-alt"></i> Twitter</a>
                                    </li>
                                    <li class="list-inline-item mt-1">
                                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}" target="_blank" class="btn btn-success btn-hover"><i class="uil uil-linkedin-alt"></i> linkedin</a>
                                    </li>
                                </ul>
                            </div>
                        </div><!--end card-body-->
                    </div><!--end job-detail-->

                    @if (!$relatedJobs->isEmpty())
                        <div class="mt-4">
                            <h5>Related Jobs</h5>
                            @include('partials.job-single', ['jobs' => $relatedJobs])
                        </div>

                        {{-- <div class="text-center mt-4">
                            <a href="{{ route('jobs') }}" class="primary-link form-text">View More <i class="mdi mdi-arrow-right"></i></a>
                        </div> --}}
                    @endif

                </div><!--end col-->

                <div class="col-lg-4 mt-4 mt-lg-0">
                    <!--start side-bar-->
                    <div class="side-bar ms-lg-4">
                        <div class="card job-overview">
                            <div class="card-body p-4">
                                <h6 class="fs-17">Job Overview</h6>
                                <ul class="list-unstyled mt-4 mb-0">
                                    <li>
                                        <div class="d-flex mt-4">
                                            <i class="uil uil-user icon bg-primary-subtle text-primary"></i>
                                            <div class="ms-3">
                                                <h6 class="fs-14 mb-2">Job Title</h6>
                                                <p class="text-muted mb-0">{{ $job->name }}</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex mt-4">
                                            <i class="uil uil-star-half-alt icon bg-primary-subtle text-primary"></i>
                                            <div class="ms-3">
                                                <h6 class="fs-14 mb-2">Position</h6>
                                                <p class="text-muted mb-0"> {{ $job->position->name ?? '' }}</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex mt-4">
                                            <i class="uil uil-star-half-alt icon bg-primary-subtle text-primary"></i>
                                            <div class="ms-3">
                                                <h6 class="fs-14 mb-2">Type of Employment</h6>
                                                <p class="text-muted mb-0"> {{ \App\Models\Vacancy::TYPE_SELECT[$job->type] }}</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex mt-4">
                                            <i class="uil uil-location-point icon bg-primary-subtle text-primary"></i>
                                            <div class="ms-3">
                                                <h6 class="fs-14 mb-2">Location</h6>
                                                @forelse ($job->locations as $location)
                                                    <p class="fw-medium mb-0">{{ ucwords($location->name ?? '')}}</p>
                                                @empty
                                                    <p class="fw-medium mb-0">To be determined.</p>
                                                @endforelse
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex mt-4">
                                            <i class="uil uil-building icon bg-primary-subtle text-primary"></i>
                                            <div class="ms-3">
                                                <h6 class="fs-14 mb-2">Industry</h6>
                                                <p class="text-muted mb-0">{{ $job->industry->name ?? '' }}</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex mt-4">
                                            <i class="uil uil-graduation-cap icon bg-primary-subtle text-primary"></i>
                                            <div class="ms-3">
                                                <h6 class="fs-14 mb-2">Education</h6>
                                                <p class="text-muted mb-0">
                                                    @foreach($job->education as $key => $education)
                                                        <span class="badge bg-primary">{{ $education->name }}</span>
                                                    @endforeach
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex mt-4">
                                            <i class="uil uil-vertical-distribute-bottom icon bg-primary-subtle text-primary"></i>
                                            <div class="ms-3">
                                                <h6 class="fs-14 mb-2">Department</h6>
                                                <p class="text-muted mb-0">
                                                    @foreach($job->departments as $key => $department)
                                                        <span class="badge bg-success">{{ $department->name }}</span>
                                                    @endforeach
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex mt-4">
                                            <i class="uil uil-tag icon bg-primary-subtle text-primary"></i>
                                            <div class="ms-3">
                                                <h6 class="fs-14 mb-2">Additional Tag</h6>
                                                <p class="text-muted mb-0">
                                                    @foreach($job->tags as $key => $tag)
                                                        <span class="badge bg-info">{{ $tag->name }}</span>
                                                    @endforeach
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex mt-4">
                                            <i class="uil uil-history icon bg-primary-subtle text-primary"></i>
                                            <div class="ms-3">
                                                <h6 class="fs-14 mb-2">Date Posted</h6>
                                                <p class="text-muted mb-0">{{ \Carbon\Carbon::parse($job->open_date)->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex mt-4">
                                            <i class="uil uil-history-alt icon bg-primary-subtle text-primary"></i>
                                            <div class="ms-3">
                                                <h6 class="fs-14 mb-2">Close Date</h6>
                                                <p class="text-muted mb-0">
                                                    @if ($job->close_date_exist == 1)
                                                        Closed on {{ \Carbon\Carbon::parse($job->close_date)->format('j F, Y') }}
                                                    @else
                                                        Close without prior notice.
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                {{-- <div class="mt-3">
                                    <a href="#applyNow" data-bs-toggle="modal" class="btn btn-primary btn-hover w-100 mt-2">Apply Now <i class="uil uil-arrow-right"></i></a>
                                    <a href="bookmark-jobs.html" class="btn btn-soft-warning btn-hover w-100 mt-2"><i class="uil uil-bookmark"></i> Add Bookmark</a>
                                </div> --}}
                            </div><!--end card-body-->
                        </div><!--end job-overview-->

                        <div class="card company-profile mt-4">
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <img src="{{ $company->image ? $company->image->getUrl() : asset('jobcy/images/default-company.png') }}" alt="" class="img-fluid rounded-3" style="width: 120px; height: 120px; object-fit: cover;">

                                    <div class="mt-4">
                                        <h6 class="fs-19 mb-1">{{ $company->name }}</h6>
                                        <p class="fs-14 text-muted">{{ $company->regency->regency_with_province_name }}</p>
                                        <p class="fs-6 text-muted">{!! Str::words($company->description, 42, ' ...') !!}</p>
                                    </div>
                                </div>
                                <ul class="list-unstyled mt-4">
                                    <li>
                                        <div class="d-flex">
                                            <i class="uil uil-phone-volume text-primary fs-4"></i>
                                            <div class="ms-3">
                                                <h6 class="fs-14 mb-2">Phone</h6>
                                                <p class="text-muted fs-14 mb-0">{{ $company->telephone }}</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="mt-3">
                                        <div class="d-flex">
                                            <i class="uil uil-envelope text-primary fs-4"></i>
                                            <div class="ms-3">
                                                <h6 class="fs-14 mb-2">Email</h6>
                                                <p class="text-muted fs-14 mb-0">{{ $company->email }}</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="mt-3">
                                        <div class="d-flex">
                                            <i class="uil uil-globe text-primary fs-4"></i>
                                            <div class="ms-3">
                                                <h6 class="fs-14 mb-2">Website</h6>
                                                <p class="text-muted fs-14 text-break mb-0">{{ $company->website }}</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="mt-3">
                                        <div class="d-flex">
                                            <i class="uil uil-map-marker text-primary fs-4"></i>
                                            <div class="ms-3">
                                                <h6 class="fs-14 mb-2">Address</h6>
                                                <p class="text-muted fs-14 mb-0">{{ $company->address }}</p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <div class="mt-4">
                                    <a href="{{ route('company-detail', $company->slug) }}" class="btn btn-primary btn-hover w-100 rounded"><i class="mdi mdi-eye"></i> View Profile</a>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="mt-4">
                            <h6 class="fs-16 mb-3">Job location</h6>
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d193595.15830869428!2d-74.119763973046!3d40.69766374874431!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sin!4v1628067715234!5m2!1sen!2sin" style="width:100%"  height="250" allowfullscreen="" loading="lazy"></iframe>
                        </div> --}}
                    </div>
                    <!--end side-bar-->
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->
    </section>
    <!-- START JOB-DEATILS -->
@endsection
