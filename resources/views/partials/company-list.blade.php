<!-- Company Cards -->
@if ($companies->isEmpty())
    <div class="row" style="margin-bottom: 120px">
        <div class="col-12 text-center">
            <p class="text-muted">No companies found.</p>
        </div>
    </div>
@else
    <div class="row">
        @foreach ($companies as $company)
            <div class="col-lg-4 col-md-6">
                <div class="card text-center mb-4">
                    <div class="card-body px-4 py-5">
                        <div class="featured-label">
                            <span class="featured">FEATURED <i class="mdi mdi-star-outline"></i></span>
                        </div>
                        <img src="{{ asset('jobcy/images/featured-job/img-01.png') }}" alt="" class="img-fluid rounded-3">
                        <div class="mt-4">
                            <a href="{{ route('company-detail', $company->slug) }}" class="primary-link">
                                <h6 class="fs-18 mb-2">{{ $company->name }}</h6>
                            </a>
                            <p class="text-muted mb-3">{{ $company->location }}</p>
                            <p class="mb-4"><small class="text-muted">Perusahaan</small> {{ ucfirst($company->ownership) }}; <small class="text-muted">skala</small> {{ ucfirst($company->scale) }};<br><small class="text-muted">bidang industri</small> {{ ucwords($company->industry->name ?? '') }}</small></p>

                            <a href="{{ route('company-detail', $company->slug) }}" class="btn btn-primary">
                                {{ openingJobs($company->id) }} Opening Jobs
                            </a>
                        </div>
                    </div>
                </div>
            </div><!--end col-->
        @endforeach
    </div><!--end row-->

    <!-- Pagination controls -->
    <div class="row">
        <div class="col-lg-12 mt-5">
            <nav aria-label="Page navigation example">
                @include('partials.custom-pagination', ['paginator' => $companies])
            </nav>
        </div><!--end col-->
    </div><!-- end row -->
@endif