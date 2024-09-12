@extends('layouts.jobcy')

@section('title', $category ?? 'News' . ' - Career Development Center Fakultas Psikologi UNS')

@section('content')
    <!-- Start home -->
    <section class="page-title-box">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="text-center text-white">
                        <h3 class="mb-4">{{ $category ?? 'News' }}</h3>
                        <div class="page-next">
                            <nav class="d-inline-block" aria-label="breadcrumb text-center">
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"> {{ $category ?? 'News' }} </li>
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


    <!-- START BLOG-PAGE -->
    <section class="section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="mb-4">
                        <h4>Featured Article</h4>
                    </div>
                </div><!--end col-->

                <div id="blogCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000">
                    <div class="carousel-inner">

                        @foreach ($featured as $item)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                            <div class="row">
                                <div class="col-lg-7">
                                    <div class="post-preview overflow-hidden rounded-3 mb-3 mb-lg-0">
                                        <a href="{{ route('blog-detail', $item->slug) }}"><img src="{{ $item->image ? $item->image->getUrl() : asset('jobcy/images/blog/img-' . str_pad(rand(1, 10), 2, '0', STR_PAD_LEFT) . '.jpg') }}" alt="Blog" class="img-fluid blog-img" /></a>
                                    </div>
                                </div><!--end col-->
                                <div class="col-lg-5">
                                    <article class="post position-relative">
                                        <div class="post ms-lg-4">
                                            <p class="text-muted mb-3">
                                                <i class="uil uil-user"></i> Posted By {{ $item->author->name }}
                                                &#9;<i class="uil uil-browser"></i>
                                                @foreach ($item->categories as $category)
                                                    {{ $category->name }} {{ $loop->last ? '' : ', ' }}
                                                @endforeach
                                                &#9;<i class="uil uil-calendar-alt"></i> {{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                                            </p>
                                            <h5 class="mb-4"><a href="{{ route('blog-detail', $item->slug) }}" class="primary-link">{{ $item->title }}</a></h5>
                                            <p class="text-muted">
                                                {!! $item->excerpt !!}
                                            </p>
                                        </div>
                                    </article>
                                </div><!--end col-->
                            </div><!--end row-->
                        </div><!--end carousel-item-->
                        @endforeach
                    </div><!--end carousel-inner-->

                     <!-- Visible Controls -->
                    <a class="carousel-control-prev" href="#blogCarousel" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true" style="filter: invert(100%);"></span>
                        <span class="visually-hidden">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#blogCarousel" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true" style="filter: invert(100%);"></span>
                        <span class="visually-hidden">Next</span>
                    </a>
                </div><!--end carousel-->

            </div><!--end row-->
            <div class="row mt-5">
                <div class="col-lg-12">
                    <div>
                        <h4>All Article</h4>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
            <div class="row">
                @foreach ($posts as $item)
                    <div class="col-lg-6">
                        <article class="post position-relative mt-5">
                            <div class="post-preview overflow-hidden mb-3 rounded-3">
                                <a href="{{ route('blog-detail', $item->slug) }}"><img src="{{ $item->image ? $item->image->getUrl() : asset('jobcy/images/blog/img-' . str_pad(rand(1, 10), 2, '0', STR_PAD_LEFT) . '.jpg') }}" alt="" class="img-fluid blog-img"></a>
                            </div>
                            <p class="text-muted mb-2">
                                <i class="uil uil-user"></i> Posted By {{ $item->author->name }}
                                &#9;<i class="uil uil-browser"></i>
                                @foreach ($item->categories as $category)
                                    {{ $category->name }} {{ $loop->last ? '' : ', ' }}
                                @endforeach
                                &#9;<i class="uil uil-calendar-alt"></i> {{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}
                            </p>
                            <h5 class="mb-3"><a href="{{ route('blog-detail', $item->slug) }}" class="primary-link">{{ $item->title }}</a></h5>
                            <p class="text-muted">
                                {!! $item->excerpt !!}
                            </p>
                        </article>
                    </div><!--end col-->
                @endforeach
            </div><!--end row-->

            <!-- Pagination controls -->
            <div class="row">
                <div class="col-lg-12 mt-5">
                    <nav aria-label="Page navigation example">
                        @include('partials.custom-pagination', ['paginator' => $posts])
                    </nav>
                </div><!--end col-->
            </div><!-- end row -->
        </div><!-- end container -->
    </section>
    <!-- END BLOG-PAGE -->
@endsection
