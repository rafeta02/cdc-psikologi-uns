@extends('layouts.jobcy')

@section('title', 'Article Search - Career Development Center Fakultas Psikologi UNS')

@section('content')
    <!-- Start home -->
    <section class="page-title-box">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="text-center text-white">
                        <h3 class="mb-4">
                        @if(request()->input('search') || request()->input('tag'))
                            Search results for: {{ request()->input('search') ?? '' }} {{ request()->input('tag') ?? '' }}
                        @endif
                        </h3>
                        <div class="page-next">
                            <nav class="d-inline-block" aria-label="breadcrumb text-center">
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Article</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        @if(request('search'))
                                            Search results for: {{ request('search') }}
                                        @endif
                                        @if(request('tag'))
                                            Tag results for: {{ request('tag') }}
                                        @endif
                                    </li>
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


    <!-- START BLOG-DETAILS -->
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    @if ($posts->isEmpty())
                        <div class="row" style="margin-bottom: 120px">
                            <div class="col-12 text-center">
                                <p class="text-muted">No articles found.</p>
                            </div>
                        </div>
                    @else
                        <div class="blog-post">
                            <div class="row">
                                @foreach ($posts as $item)
                                    <div class="col-lg-6 mb-4">
                                        <div class="card blog-grid-box p-2">
                                            <img src="{{ $item->image ? $item->image->getUrl() : asset('jobcy/images/blog/img-' . str_pad(rand(1, 10), 2, '0', STR_PAD_LEFT) . '.jpg') }}" alt="" class="img-fluid">
                                            <div class="card-body">
                                                <ul class="list-inline d-flex justify-content-between mb-3">
                                                    <li class="list-inline-item">
                                                        <p class="text-muted mb-0"><a href="{{ route('blog-detail', $item->slug) }}" class="text-muted fw-medium">{{ $item->author->name }}</a> - {{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</p>
                                                    </li>
                                                    {{-- <li class="list-inline-item">
                                                        <p class="text-muted mb-0"><i class="mdi mdi-eye"></i> 432</p>
                                                    </li> --}}
                                                </ul>
                                                <a href="{{ route('blog-detail', $item->slug) }}" class="primary-link"><h6 class="fs-17">{{ $item->title }}</h6></a>
                                                <p class="text-muted">{!! $item->excerpt !!}</p>
                                                <div>
                                                    <a href="{{ route('blog-detail', $item->slug) }}" class="form-text text-primary">Read More <i class="uil uil-angle-right-b"></i></a>
                                                </div>
                                            </div>
                                        </div><!--end blog-grid-box-->
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
                        </div><!--end col-->
                    @endif
                </div><!--end col-->
                <div class="col-lg-4 col-md-5">
                    @include('partials.sidebar-blog', ['popularPosts' => $popularPosts, 'tags' => $tags])
                    <!--end sidebar-->
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->
    </section>
    <!-- START BLOG-DETAILS -->
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
      var swiper = new Swiper('.blogdetailSlider', {
        slidesPerView: 1, // Number of slides to show at once
        spaceBetween: 10, // Space between slides
        loop: true, // Infinite loop
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
        pagination: {
          el: '.swiper-pagination',
          clickable: true,
        },
      });

      var swiper = new Swiper('.blogSlider', {
        slidesPerView: 1, // Number of slides to show at once
        spaceBetween: 10, // Space between slides
        loop: true, // Infinite loop
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
        pagination: {
          el: '.swiper-pagination',
          clickable: true,
        },
      });
    });
  </script>
  @endsection
