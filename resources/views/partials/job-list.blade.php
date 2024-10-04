@if ($jobs->isEmpty())
    <div class="row" style="margin-top: 150px; margin-bottom: 150px">
        <div class="col-12 text-center">
            <p class="text-muted">No jobs found.</p>
        </div>
    </div>
@else
    @foreach($jobs as $job)
        <div class="job-box card mt-4">
            <div class="p-4">
                <div class="row">
                    <div class="col-lg-2">
                        <a href="{{ route('job-detail', $job->slug) }}"><img src="{{ $job->company->image ? $job->company->image->getUrl() : asset('jobcy/images/default-company.png') }}" alt="" class="img-fluid rounded-3" style="width: 90px; height: 90px; object-fit: cover;"></a>
                    </div><!--end col-->
                    <div class="col-lg-10">
                        <div class="mt-3 mt-lg-0">
                            <h5 class="fs-17 mb-1"><a href="{{ route('job-detail', $job->slug) }}" class="text-dark">{{ $job->name }}</a> <small class="text-muted fw-normal">({{ $job->position->name ?? '' }})</small></h5>
                            <ul class="list-inline mb-2">
                                <li class="list-inline-item">
                                    <p class="text-muted fs-16 mb-0"><a href="{{ route('company-detail', $job->company->slug ?? '') }}" class="text-dark">{{ $job->company->name }}</a></p>
                                </li>
                            </ul>
                            <ul class="list-inline mb-2">
                                <li class="list-inline-item">
                                    <p class="text-muted fs-12 mb-0"><i class="mdi mdi-domain"></i> INDUSTRI : {{ strtoupper($job->industry->name ?? '') }}</p>
                                </li>
                                <li class="list-inline-item">
                                    <p class="text-muted fs-12 mb-0">
                                        <i class="mdi mdi-alpha-e-circle-outline"></i> EXPERIENCE : {{ strtoupper($job->experience->name ?? '') }}
                                    </p>
                                </li>
                                <li class="list-inline-item">
                                    <p class="text-muted fs-12 mb-0">
                                        <i class="mdi mdi-map-marker"></i>
                                        LOCATION :
                                        @forelse ($job->locations as $location)
                                            {{ $location->name ?? '' }};
                                        @empty
                                            TO BE DETERMINED
                                        @endforelse
                                    </p>
                                </li>
                                <li class="list-inline-item">
                                    <p class="text-muted fs-12 mb-0">
                                        <i class="mdi mdi-school "></i> EDUCATION :
                                        @foreach($job->education as $key => $education)
                                            {{ strtoupper($education->name) }};
                                        @endforeach
                                    </p>
                                </li>
                                {{-- <li class="list-inline-item">
                                    <p class="text-muted fs-12 mb-0">
                                        <i class="mdi mdi-shape-plus "></i> DEPARTMENT :
                                        @foreach($job->departments as $key => $department)
                                            {{ strtoupper($department->name) }};
                                        @endforeach
                                    </p>
                                </li> --}}
                            </ul>
                            <div class="mt-2">
                                @if ($job->type == 'fulltime')
                                    <span class="badge bg-success-subtle text-success  mt-1">Full Time</span>
                                @elseif ($job->type == 'parttime')
                                    <span class="badge bg-danger-subtle text-danger  mt-1">Part Time</span>
                                @else
                                    <span class="badge bg-primary-subtle text-primary  mt-1">Internship</span>
                                @endif

                                @foreach ($job->tags as $tag)
                                    <span class="badge bg-info-subtle text-info mt-1">{{ $tag->name }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->
            </div>
            <div class="p-3 bg-light">
                <div class="row justify-content-between">
                    <div class="col-md-6">
                        <div>
                            <i class="mdi mdi-alarm"></i> <span class="text-muted">Open {{ \Carbon\Carbon::parse($job->open_date)->diffForHumans() }}</span>
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-md-5">
                        <div class="text-md-end">
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
                </div>
                <!--end row-->
            </div>
        </div>
    @endforeach

    <!-- Pagination controls -->
    <div class="row">
        <div class="col-lg-12 mt-5">
            <nav aria-label="Page navigation example">
                @include('partials.custom-pagination', ['paginator' => $jobs])
            </nav>
        </div><!--end col-->
    </div><!-- end row -->
@endif
