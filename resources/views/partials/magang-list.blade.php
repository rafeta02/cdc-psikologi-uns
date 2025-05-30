@if ($magangs->isEmpty())
    <div class="row" style="margin-top: 150px; margin-bottom: 150px">
        <div class="col-12 text-center">
            <p class="text-muted">No internships found.</p>
        </div>
    </div>
@else
    @foreach($magangs as $magang)
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
                                <li class="list-inline-item">
                                    <p class="text-muted fs-12 mb-0">
                                        <i class="mdi mdi-account-group"></i> NEEDS : {{ $magang->needs ?? 'Not specified' }}
                                    </p>
                                </li>
                                @if($magang->filled)
                                <li class="list-inline-item">
                                    <p class="text-muted fs-12 mb-0">
                                        <i class="mdi mdi-account-check"></i> FILLED : {{ $magang->filled ?? '0' }}
                                    </p>
                                </li>
                                @endif
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
            <div class="p-3 bg-light">
                <div class="row justify-content-between">
                    <div class="col-md-6">
                        <div>
                            <i class="mdi mdi-alarm"></i> <span class="text-muted">Open {{ \Carbon\Carbon::parse($magang->open_date)->diffForHumans() }}</span>
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-md-5">
                        <div class="text-md-end">
                            <i class="mdi mdi-clock-outline"></i>
                            <span class="text-muted">
                                @if ($magang->close_date_exist == 1)
                                    Closed on {{ \Carbon\Carbon::parse($magang->close_date)->format('j F, Y') }}
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
            <div class="p-3 bg-white text-end">
                @auth
                    <a href="{{ route('frontend.magang.apply', ['slug' => $magang->slug]) }}" class="btn btn-primary">Apply Now</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-primary">Login to Apply</a>
                @endauth
            </div>
        </div>
    @endforeach

    <!-- Pagination controls -->
    <div class="row">
        <div class="col-lg-12 mt-5">
            <nav aria-label="Page navigation example">
                @include('partials.custom-pagination', ['paginator' => $magangs])
            </nav>
        </div><!--end col-->
    </div><!-- end row -->
@endif 