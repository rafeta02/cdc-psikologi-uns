@extends('layouts.jobcy')

@section('title', 'Home - Career Development Center Fakultas Psikologi UNS')

@section('content')
    <!-- START HOME -->
    <section class="bg-home" id="home">
        <div class="bg-overlay"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center text-white mb-5">
                        <h1 class="display-5 fw-semibold mb-3">Thousands of Careers, Perfectly Tailored for <span class="text-warning fw-bold">Psychology Graduates</span></h1>
                        <p class="fs-17">Find jobs, internships, scholarships, and more opportunities!</p>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
            <form action="#">
                <div class="registration-form">
                    <div class="row g-0">
                        <div class="col-lg-3">
                            <div class="filter-search-form filter-border mt-3 mt-lg-0">
                                <i class="uil uil-briefcase-alt"></i>
                                <input type="search" id="job-title" class="form-control filter-input-box" placeholder="Job, Company name...">
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-3">
                            <div class="filter-search-form filter-border mt-3 mt-lg-0">
                                <i class="uil uil-map-marker"></i>
                                <select class="form-select" name="city" id="city">
                                    <option value="" disabled selected>Type City or Province</option>
                                </select>
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-3">
                            <div class="filter-search-form mt-3 mt-lg-0">
                                <i class="uil uil-clipboard-notes"></i>
                                <select class="form-select " data-trigger name="position" id="position">
                                    <option value="" disabled selected>Select a Position</option>
                                    @foreach($positions as $id => $entry)
                                        <option value="{{ $id }}" {{ old('position') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-3">
                            <div class="mt-3 mt-lg-0 h-100">
                                <button class="btn btn-primary submit-btn w-100 h-100" onclick="location.href = '{{ route('jobs') }}'"><i class="uil uil-search me-1"></i> Find Job</button>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end container-->
            </form>

            {{-- <div class="row">
                <div class="col-lg-12">
                    <ul class="treding-keywords list-inline mb-0 text-white-50 mt-4 mt-lg-3 text-center">
                        <li class="list-inline-item text-white"><i class="mdi mdi-tag-multiple-outline text-warning fs-18"></i> Trending Keywords:</li>
                        <li class="list-inline-item"><a href="javascript:void(0)">Design,</a></li>
                        <li class="list-inline-item"><a href="javascript:void(0)">Development,</a></li>
                        <li class="list-inline-item"><a href="javascript:void(0)">Manager,</a></li>
                        <li class="list-inline-item"><a href="javascript:void(0)">Senior</a></li>
                    </ul>
                </div>
                <!--end col-->
            </div> --}}
            <!--end row-->
        </div>
        <!--end container-->
    </section>
    <!-- End Home -->

    <!-- START SHAPE -->
    <div class="position-relative">
        <div class="shape">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="1440" height="150" preserveAspectRatio="none" viewBox="0 0 1440 220">
                <g mask="url(&quot;#SvgjsMask1004&quot;)" fill="none">
                    <path d="M 0,213 C 288,186.4 1152,106.6 1440,80L1440 250L0 250z" fill="rgba(255, 255, 255, 1)"></path>
                </g>
                <defs>
                    <mask id="SvgjsMask1004">
                        <rect width="1440" height="250" fill="#ffffff"></rect>
                    </mask>
                </defs>
            </svg>
        </div>
    </div>
    <!-- END SHAPE -->

    <!-- START CATEGORY -->
    {{-- <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title text-center">
                        <h3 class="title">Browser Jobs Categories </h3>
                        <p class="text-muted">Post a job to tell us about your project. We'll quickly match you with the
                            right freelancers.</p>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
            <div class="row">
                <div class="col-lg-3 col-md-6 mt-4 pt-2">
                    <div class="popu-category-box rounded text-center">
                        <div class="popu-category-icon icons-md">
                            <i class="uim uim-layers-alt"></i>
                        </div>
                        <div class="popu-category-content mt-4">
                            <a href="javascript:void(0)" class="text-dark stretched-link">
                                <h5 class="fs-18">IT & Software</h5>
                            </a>
                            <p class="text-muted mb-0">2024 Jobs</p>
                        </div>
                    </div><!--end popu-category-box-->
                </div>
                <!--end col-->
                <div class="col-lg-3 col-md-6 mt-4 pt-2">
                    <div class="popu-category-box rounded text-center">
                        <div class="popu-category-icon icons-md">
                            <i class="uim uim-airplay"></i>
                        </div>
                        <div class="popu-category-content mt-4">
                            <a href="{{ route('jobs') }}" class="text-dark stretched-link">
                                <h5 class="fs-18">Technology</h5>
                            </a>
                            <p class="text-muted mb-0">1250 Jobs</p>
                        </div>
                    </div><!--end popu-category-box-->
                </div>
                <!--end col-->
                <div class="col-lg-3 col-md-6 mt-4 pt-2">
                    <div class="popu-category-box rounded text-center">
                        <div class="popu-category-icon icons-md">
                            <i class="uim uim-bag"></i>
                        </div>
                        <div class="popu-category-content mt-4">
                            <a href="{{ route('jobs') }}" class="text-dark stretched-link">
                                <h5 class="fs-18">Government</h5>
                            </a>
                            <p class="text-muted mb-0">802 Jobs</p>
                        </div>
                    </div><!--end popu-category-box-->
                </div>
                <!--end col-->
                <div class="col-lg-3 col-md-6 mt-4 pt-2">
                    <div class="popu-category-box rounded text-center">
                        <div class="popu-category-icon icons-md">
                            <i class="uim uim-user-md"></i>
                        </div>
                        <div class="popu-category-content mt-4">
                            <a href="{{ route('jobs') }}" class="text-dark stretched-link">
                                <h5 class="fs-18">Accounting / Finance</h5>
                            </a>
                            <p class="text-muted mb-0">577 Jobs</p>
                        </div>
                    </div><!--end popu-category-box-->
                </div>
                <!--end col-->
                <div class="col-lg-3 col-md-6 mt-4 pt-2">
                    <div class="popu-category-box rounded text-center">
                        <div class="popu-category-icon icons-md">
                            <i class="uim uim-hospital"></i>
                        </div>
                        <div class="popu-category-content mt-4">
                            <a href="{{ route('jobs') }}" class="text-dark stretched-link">
                                <h5 class="fs-18">Construction / Facilities</h5>
                            </a>
                            <p class="text-muted mb-0">285 Jobs</p>
                        </div>
                    </div><!--end popu-category-box-->
                </div>
                <!--end col-->
                <div class="col-lg-3 col-md-6 mt-4 pt-2">
                    <div class="popu-category-box rounded text-center">
                        <div class="popu-category-icon icons-md">
                            <i class="uim uim-telegram-alt"></i>
                        </div>
                        <div class="popu-category-content mt-4">
                            <a href="{{ route('jobs') }}" class="text-dark stretched-link">
                                <h5 class="fs-18">Tele-communications</h5>
                            </a>
                            <p class="text-muted mb-0">495 Jobs</p>
                        </div>
                    </div><!--end popu-category-box-->
                </div>
                <!--end col-->
                <div class="col-lg-3 col-md-6 mt-4 pt-2">
                    <div class="popu-category-box rounded text-center">
                        <div class="popu-category-icon icons-md">
                            <i class="uim uim-scenery"></i>
                        </div>
                        <div class="popu-category-content mt-4">
                            <a href="{{ route('jobs') }}" class="text-dark stretched-link">
                                <h5 class="fs-18">Design & Multimedia</h5>
                            </a>
                            <p class="text-muted mb-0">1045 Jobs</p>
                        </div>
                    </div><!--end popu-category-box-->
                </div>
                <!--end col-->
                <div class="col-lg-3 col-md-6 mt-4 pt-2">
                    <div class="popu-category-box rounded text-center">
                        <div class="popu-category-icon icons-md">
                            <i class="uim uim-android-alt"></i>
                        </div>
                        <div class="popu-category-content mt-4">
                            <a href="{{ route('jobs') }}" class="text-dark stretched-link">
                                <h5 class="fs-18">Human Resource</h5>
                            </a>
                            <p class="text-muted mb-0">1516 Jobs</p>
                        </div>
                    </div><!--end popu-category-box-->
                </div>
                <!--end col-->
            </div>
            <!--end row-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="mt-5 text-center">
                        <a href="{{ route('jobs') }}" class="btn btn-primary btn-hover">Browse All Categories <i class="uil uil-arrow-right"></i></a>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div>
        <!--end container-->
    </section> --}}
    <!-- END CATEGORY -->

    <!-- START JOB-LIST -->
    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title text-center mb-4 pb-2">
                        <h4 class="title">Find Your Dream Job Here!</h4>
                        <p class="text-muted mb-1">Search by job type — whether it's internships or full-time positions, the choice is yours!</p>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <ul class="job-list-menu nav nav-pills nav-justified flex-column flex-sm-row mb-4" id="pills-tab"
                        role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="recent-jobs-tab" data-bs-toggle="pill"
                                data-bs-target="#recent-jobs" type="button" role="tab" aria-controls="recent-jobs"
                                aria-selected="true">Recent Jobs</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="freelancer-tab" data-bs-toggle="pill"
                                data-bs-target="#freelancer" type="button" role="tab" aria-controls="freelancer"
                                aria-selected="false">Internship</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="full-time-tab" data-bs-toggle="pill"
                                data-bs-target="#full-time" type="button" role="tab" aria-controls="full-time"
                                aria-selected="false">Full Time</button>
                        </li>
                    </ul>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="recent-jobs" role="tabpanel" aria-labelledby="recent-jobs-tab">
                            @foreach ($recentJobs as $job)
                                <div class="job-box card mt-4">
                                    {{-- <div class="bookmark-label text-center">
                                        <a href="javascript:void(0)" class="text-white align-middle"><i class="mdi mdi-star"></i></a>
                                    </div> --}}
                                    <div class="p-4">
                                        <div class="row align-items-center">
                                            <div class="col-md-2">
                                                <div class="text-center mb-4 mb-md-0">
                                                    <a href="{{ route('job-detail', $job->slug) }}"><img src="{{ $job->company->image ? $job->company->image->getUrl() : asset('jobcy/images/default-company.png') }}" alt="" class="img-fluid rounded-3" style="width: 90px; height: 90px; object-fit: cover;"></a>
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-md-3">
                                                <div class="mb-2 mb-md-0">
                                                    <h5 class="fs-18 mb-1"><a href="{{ route('job-detail', $job->slug) }}" class="text-dark">{{ $job->name }}</a>
                                                    </h5>
                                                    <p class="text-muted fs-14 mb-0">{{ $job->company->name }}</p>
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-md-3">
                                                @forelse ($job->locations as $location)
                                                    <div class="d-flex mb-1">
                                                        <div class="flex-shrink-0">
                                                            <i class="mdi mdi-map-marker text-primary me-1"></i>
                                                        </div>
                                                        <p class="text-muted mb-0">
                                                            @if ($job->locations->count() > 1)
                                                                {{ $location->name ?? '' }}
                                                            @else
                                                                {{ $location->regency_with_province_name ?? '' }}
                                                            @endif
                                                        </p>
                                                    </div>
                                                @empty
                                                    <div class="d-flex mb-1">
                                                        <div class="flex-shrink-0">
                                                            <i class="mdi mdi-map-marker text-primary me-1"></i>
                                                        </div>
                                                        <p class="text-muted mb-0">
                                                            To be determined/ Flexible/ Remote options available.
                                                        </p>
                                                    </div>
                                                @endforelse
                                            </div>
                                            <!--end col-->
                                            <div class="col-md-2">
                                                <div>
                                                    <p class="text-muted mb-2"><i class="mdi mdi-domain"></i> {{ ucwords($job->industry->name ?? '') }}</p>
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-md-2">
                                                <div>
                                                    @if ($job->type == 'fulltime')
                                                        <span class="badge bg-success-subtle text-success mt-1">Full Time</span>
                                                    @elseif ($job->type == 'parttime')
                                                        <span class="badge bg-danger-subtle text-danger mt-1">Part Time</span>
                                                    @else
                                                        <span class="badge bg-primary-subtle text-primary mt-1">Internship</span>
                                                    @endif

                                                    @foreach ($job->tags as $tag)
                                                        <span class="badge bg-info-subtle text-info mt-1">{{ $tag->name }}</span>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <!--end col-->
                                        </div>
                                        <!--end row-->
                                    </div>
                                    <div class="p-3 bg-light">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4">
                                                <div>
                                                    <i class="mdi mdi-alarm"></i> <span class="text-muted">Open {{ \Carbon\Carbon::parse($job->open_date)->diffForHumans() }}</span>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4">
                                                <div class="text-center">
                                                    <i class="mdi mdi-alpha-e-circle-outline"></i> <span class="text-muted">Experience : {{ ucwords($job->experience->name ?? '') }}</span>
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-4 col-md-4">
                                                <div class="text-start text-md-end">
                                                    <i class="mdi mdi-clock-outline"></i>
                                                    <span class="text-muted">
                                                        @if ($job->close_date_exist == 1)
                                                            Closed on {{ \Carbon\Carbon::parse($job->close_date)->format('j F, Y') }}
                                                        @else
                                                            Close without prior notice.
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                            <!--end col-->
                                            {{-- <div class="col-lg-2 col-md-2">
                                                <div class="text-start text-md-end">
                                                    <a href="{{ route('job-detail', $job->slug) }}" data-bs-toggle="modal" class="primary-link">Detail <i class="mdi mdi-chevron-double-right"></i></a>
                                                </div>
                                            </div> --}}
                                            <!--end col-->
                                        </div>
                                        <!--end row-->
                                    </div>
                                </div>
                                <!--end job-box-->
                            @endforeach

                            <div class="text-center mt-4 pt-2">
                                <a href="{{ route('jobs') }}" class="btn btn-primary">View More <i class="uil uil-arrow-right"></i></a>
                            </div>
                        </div>
                        <!--end recent-jobs-tab-->

                        <div class="tab-pane fade" id="freelancer" role="tabpanel" aria-labelledby="freelancer-tab">
                            @foreach ($interns as $job)
                            <div class="job-box card mt-4">
                                {{-- <div class="bookmark-label text-center">
                                    <a href="javascript:void(0)" class="text-white align-middle"><i class="mdi mdi-star"></i></a>
                                </div> --}}
                                <div class="p-4">
                                    <div class="row align-items-center">
                                        <div class="col-md-2">
                                            <div class="text-center mb-4 mb-md-0">
                                                <a href="{{ route('job-detail', $job->slug) }}"><img src="{{ $job->company->image ? $job->company->image->getUrl() : asset('jobcy/images/default-company.png') }}" alt="" class="img-fluid rounded-3" style="width: 90px; height: 90px; object-fit: cover;"></a>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-md-3">
                                            <div class="mb-2 mb-md-0">
                                                <h5 class="fs-18 mb-1"><a href="{{ route('job-detail', $job->slug) }}" class="text-dark">{{ $job->name }}</a>
                                                </h5>
                                                <p class="text-muted fs-14 mb-0">{{ $job->company->name }}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-md-3">
                                            @forelse ($job->locations as $location)
                                                <div class="d-flex mb-1">
                                                    <div class="flex-shrink-0">
                                                        <i class="mdi mdi-map-marker text-primary me-1"></i>
                                                    </div>
                                                    <p class="text-muted mb-0">
                                                        @if ($job->locations->count() > 1)
                                                            {{ $location->name ?? '' }}
                                                        @else
                                                            {{ $location->regency_with_province_name ?? '' }}
                                                        @endif
                                                    </p>
                                                </div>
                                            @empty
                                                <div class="d-flex mb-1">
                                                    <div class="flex-shrink-0">
                                                        <i class="mdi mdi-map-marker text-primary me-1"></i>
                                                    </div>
                                                    <p class="text-muted mb-0">
                                                        To be determined/ Flexible/ Remote options available.
                                                    </p>
                                                </div>
                                            @endforelse
                                        </div>
                                        <!--end col-->
                                        <div class="col-md-2">
                                            <div>
                                                <p class="text-muted mb-2"><i class="mdi mdi-domain"></i> {{ ucwords($job->industry->name ?? '') }}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-md-2">
                                            <div>
                                                @if ($job->type == 'fulltime')
                                                    <span class="badge bg-success-subtle text-success mt-1">Full Time</span>
                                                @elseif ($job->type == 'parttime')
                                                    <span class="badge bg-danger-subtle text-danger mt-1">Part Time</span>
                                                @else
                                                    <span class="badge bg-primary-subtle text-primary mt-1">Internship</span>
                                                @endif

                                                @foreach ($job->tags as $tag)
                                                    <span class="badge bg-info-subtle text-info mt-1">{{ $tag->name }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </div>
                                <div class="p-3 bg-light">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4">
                                            <div>
                                                <i class="mdi mdi-alarm"></i> <span class="text-muted">Open {{ \Carbon\Carbon::parse($job->open_date)->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4">
                                            <div class="text-center">
                                                <i class="mdi mdi-alpha-e-circle-outline"></i> <span class="text-muted">Experience : {{ ucwords($job->experience->name ?? '') }}</span>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4 col-md-4">
                                            <div class="text-start text-md-end">
                                                <i class="mdi mdi-clock-outline"></i>
                                                <span class="text-muted">
                                                    @if ($job->close_date_exist == 1)
                                                        Closed on {{ \Carbon\Carbon::parse($job->close_date)->format('j F, Y') }}
                                                    @else
                                                        Close without prior notice.
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        {{-- <div class="col-lg-2 col-md-2">
                                            <div class="text-start text-md-end">
                                                <a href="{{ route('job-detail', $job->slug) }}" data-bs-toggle="modal" class="primary-link">Detail <i class="mdi mdi-chevron-double-right"></i></a>
                                            </div>
                                        </div> --}}
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </div>
                            </div>
                                <!--end job-box-->
                            @endforeach

                            <div class="text-center mt-4 pt-2">
                                <a href="{{ route('jobs') }}" class="btn btn-primary">View More <i class="uil uil-arrow-right"></i></a>
                            </div>
                        </div>
                        <!--end freelancer-tab-->

                        <div class="tab-pane fade" id="full-time" role="tabpanel" aria-labelledby="full-time-tab">
                            @foreach ($fulltimes as $job)
                            <div class="job-box card mt-4">
                                {{-- <div class="bookmark-label text-center">
                                    <a href="javascript:void(0)" class="text-white align-middle"><i class="mdi mdi-star"></i></a>
                                </div> --}}
                                <div class="p-4">
                                    <div class="row align-items-center">
                                        <div class="col-md-2">
                                            <div class="text-center mb-4 mb-md-0">
                                                <a href="{{ route('job-detail', $job->slug) }}"><img src="{{ $job->company->image ? $job->company->image->getUrl() : asset('jobcy/images/default-company.png') }}" alt="" class="img-fluid rounded-3" style="width: 90px; height: 90px; object-fit: cover;"></a>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-md-3">
                                            <div class="mb-2 mb-md-0">
                                                <h5 class="fs-18 mb-1"><a href="{{ route('job-detail', $job->slug) }}" class="text-dark">{{ $job->name }}</a>
                                                </h5>
                                                <p class="text-muted fs-14 mb-0">{{ $job->company->name }}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-md-3">
                                            @forelse ($job->locations as $location)
                                                <div class="d-flex mb-1">
                                                    <div class="flex-shrink-0">
                                                        <i class="mdi mdi-map-marker text-primary me-1"></i>
                                                    </div>
                                                    <p class="text-muted mb-0">
                                                        @if ($job->locations->count() > 1)
                                                            {{ $location->name ?? '' }}
                                                        @else
                                                            {{ $location->regency_with_province_name ?? '' }}
                                                        @endif
                                                    </p>
                                                </div>
                                            @empty
                                                <div class="d-flex mb-1">
                                                    <div class="flex-shrink-0">
                                                        <i class="mdi mdi-map-marker text-primary me-1"></i>
                                                    </div>
                                                    <p class="text-muted mb-0">
                                                        To be determined/ Flexible/ Remote options available.
                                                    </p>
                                                </div>
                                            @endforelse
                                        </div>
                                        <!--end col-->
                                        <div class="col-md-2">
                                            <div>
                                                <p class="text-muted mb-2"><i class="mdi mdi-domain"></i> {{ ucwords($job->industry->name ?? '') }}</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-md-2">
                                            <div>
                                                @if ($job->type == 'fulltime')
                                                    <span class="badge bg-success-subtle text-success mt-1">Full Time</span>
                                                @elseif ($job->type == 'parttime')
                                                    <span class="badge bg-danger-subtle text-danger mt-1">Part Time</span>
                                                @else
                                                    <span class="badge bg-primary-subtle text-primary mt-1">Internship</span>
                                                @endif

                                                @foreach ($job->tags as $tag)
                                                    <span class="badge bg-info-subtle text-info mt-1">{{ $tag->name }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </div>
                                <div class="p-3 bg-light">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4">
                                            <div>
                                                <i class="mdi mdi-alarm"></i> <span class="text-muted">Open {{ \Carbon\Carbon::parse($job->open_date)->diffForHumans() }}</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4">
                                            <div class="text-center">
                                                <i class="mdi mdi-alpha-e-circle-outline"></i> <span class="text-muted">Experience : {{ ucwords($job->experience->name ?? '') }}</span>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-4 col-md-4">
                                            <div class="text-start text-md-end">
                                                <i class="mdi mdi-clock-outline"></i>
                                                <span class="text-muted">
                                                    @if ($job->close_date_exist == 1)
                                                        Closed on {{ \Carbon\Carbon::parse($job->close_date)->format('j F, Y') }}
                                                    @else
                                                        Close without prior notice.
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        {{-- <div class="col-lg-2 col-md-2">
                                            <div class="text-start text-md-end">
                                                <a href="{{ route('job-detail', $job->slug) }}" data-bs-toggle="modal" class="primary-link">Detail <i class="mdi mdi-chevron-double-right"></i></a>
                                            </div>
                                        </div> --}}
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </div>
                            </div>
                                <!--end job-box-->
                            @endforeach

                            <div class="text-center mt-4 pt-2">
                                <a href="{{route('jobs')}}" class="btn btn-primary">View More <i class="uil uil-arrow-right"></i></a>
                            </div>
                        </div>
                        <!--end full-time-tab-->
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>
    <!-- END JOB-LIST -->

    <!--START CTA-->
    <section class="section bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="text-center">
                        <h2 class="text-primary mb-4">Browse Our <span class="text-warning fw-bold">5,000+</span> Latest
                            Jobs</h2>
                        <p class="text-muted">Post a job to tell us about your project. We'll quickly match you with
                            the right job position.</p>
                        <div class="mt-4 pt-2">
                            <a href="{{ route('jobs') }}" class="btn btn-primary btn-hover">Started Now <i class="uil uil-rocket align-middle ms-1"></i></a>
                        </div>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->
    </section>
    <!--END CTA-->

    <!-- START BLOG -->
    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="section-title text-center mb-5">
                        <h3 class="title mb-3">Quick Career Tips <br> <span class="text-warning fw-bold">from Alumni: Insights for Success!</span></h3>
                        <p class="text-muted">Get ahead in your career with practical advice straight from FAPSI alumni who have walked the path before you. From landing your first job to thriving in the workplace, these quick, actionable tips will help you navigate the world of work with confidence and clarity. Learn from their experiences and take your career to the next level!</p>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
            <div class="row">
                @foreach ($posts as $post)
                <div class="col-lg-4 col-md-6">
                    <div class="blog-box card p-2 mt-3">
                        <div class="blog-img position-relative overflow-hidden">
                            <img src="{{ $post->image ? $post->image->getUrl() : asset('jobcy/images/blog/img-' . str_pad(rand(1, 10), 2, '0', STR_PAD_LEFT) . '.jpg') }}" alt="" class="img-fluid">
                            <div class="bg-overlay"></div>
                            <div class="author">
                                <p class=" mb-0"><i class="mdi mdi-account text-light"></i> <a href="javascript:void(0)" class="text-light user">{{ $post->author->name }}</a></p>
                                <p class="text-light mb-0 date"><i class="mdi mdi-calendar-check"></i> {{ Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</p>
                            </div>
                            {{-- <div class="likes">
                                <ul class="list-unstyled mb-0">
                                    <li class="list-inline-item"><a href="javascript:void(0)" class="text-white"><i
                                                class="mdi mdi-heart-outline me-1"></i> 33</a></li>
                                    <li class="list-inline-item"><a href="javascript:void(0)" class="text-white"><i
                                                class="mdi mdi-comment-outline me-1"></i> 08</a></li>
                                </ul>
                            </div> --}}
                        </div>
                        <div class="card-body">
                            <a href="{{ route('blog-detail', $post->slug) }}" class="primary-link">
                                <h5 class="fs-17">{{ $post->title }}</h5>
                            </a>
                            <p class="text-muted">{!! $post->excerpt !!}</p>
                            <a href="{{ route('alumni-caring-detail', $post->slug) }}" class="form-text text-primary">Read more <i class="mdi mdi-chevron-right align-middle"></i></a>
                        </div>
                    </div><!--end blog-box-->
                </div><!--end col-->
                @endforeach
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>
    <!-- END BLOG -->
@endsection

@section('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Initialize Choices.js
    const choices = new Choices('#city', {
        placeholder: true,
        placeholderValue: 'Search for a location',
        searchEnabled: true, // Enable search functionality
        searchResultLimit: 10, // Limit number of results displayed
        shouldSort: false // Disable sorting to retain order from server
    });

    function loadCity(query) {
        return fetch('{{ route("select.getRegencies") }}?q=' + encodeURIComponent(query))
            .then(response => response.json())
            .then(data => {
                return data.map(item => ({
                    value: item.id,   // Use the `id` field for the value
                    label: item.text  // Use the `name` field for the label
                }));
            });
    }

    // Handle the AJAX response with Choices.js
    document.querySelector('#city').addEventListener('search', function(event) {
        const searchTerm = event.detail.value;

        if (searchTerm.length >= 3) {
            loadCity(searchTerm).then(options => {
                // Clear previous choices and set new options
                choices.clearStore();
                choices.setChoices(options, 'value', 'label', true);
            });
        }
    });

    const positionChoices = new Choices('#position', {
        placeholder: true,
        placeholderValue: 'Select a category',
        searchEnabled: true,
        searchResultLimit: 10,
        shouldSort: false
    });
})
</script>
@endsection
