@extends('layouts.jobcy')

@section('title', $post->title)

@section('meta')
{!! SEOMeta::generate() !!}
@endsection

@section('content')
    <!-- Start home -->
    <section class="page-title-box">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="text-center text-white">
                        <h3 class="mb-4">{{ $post->title }}</h3>
                        <div class="page-next">
                            <nav class="d-inline-block" aria-label="breadcrumb text-center">
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                    <li class="breadcrumb-item"><a href="javascript:void(0)">Article</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"> {{ $post->title }} </li>
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
                    <div class="blog-post">
                        <div class="swiper blogdetailSlider">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <img src="{{ $post->image ? $post->image->getUrl() : asset('jobcy/images/blog/img-' . str_pad(rand(1, 10), 2, '0', STR_PAD_LEFT) . '.jpg') }}" alt="" class="img-fluid rounded-3" style="width: 100%; height: auto; object-fit: cover;">
                                </div>
                            </div>
                        </div>

                        <ul class="list-inline mb-0 mt-3 text-muted">
                            <li class="list-inline-item">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <i class="uil uil-user"></i>
                                    </div>
                                    <div class="ms-2 flex-grow-1">
                                        <p class="mb-0"> Posted By {{ $post->author->name }}</p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-inline-item">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <i class="uil uil-browser"></i>
                                    </div>
                                    <div class="ms-2 flex-grow-1">
                                        <p class="mb-0">
                                            @foreach ($post->categories as $category)
                                                {{ $category->name }} {{ $loop->last ? '' : ', ' }}
                                            @endforeach
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-inline-item">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <i class="uil uil-calendar-alt"></i>
                                    </div>
                                    <div class="ms-2">
                                        <p class="mb-0"> {{ Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</p>
                                    </div>
                                </div>
                            </li>
                            {{-- <li class="list-inline-item">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <i class="uil uil-comments-alt"></i>
                                    </div>
                                    <div class="ms-2 flex-grow-1">
                                        <p class="mb-0"> 2 Comments</p>
                                    </div>
                                </div>
                            </li> --}}
                        </ul>
                        <div class="mt-4">
                           {!! $post->content !!}

                            <div class="d-flex align-items-center mb-4">
                                <div class="flex-shrink-0">
                                    <b>Tags:</b>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    @foreach ($post->tags as $tag)
                                        <span class="badge bg-success-subtle text-success mt-1 fs-14">{{ $tag->name }}</span>
                                    @endforeach
                                </div>
                            </div>
                            <ul class="blog-social-menu list-inline mb-0 text-end">
                                <li class="list-inline-item">
                                    <b>Share post:</b>
                                </li>
                                <li class="list-inline-item">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="social-link bg-primary-subtle text-primary">
                                        <i class="uil uil-facebook-f"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($post->title) }}" target="_blank" class="social-link bg-info-subtle text-info">
                                        <i class="uil uil-twitter-alt"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="https://api.whatsapp.com/send?text={{ urlencode($post->title . ' ' . $post->url) }}" target="_blank" class="social-link bg-success-subtle text-success">
                                        <i class="uil uil-whatsapp"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}" target="_blank" class="social-link bg-primary-subtle text-primary">
                                        <i class="uil uil-linkedin-alt"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="mt-5">
                            <h5 class="border-bottom pb-3"> Related Articles</h5>
                            <div class="swiper blogSlider pb-5 mt-4">
                                <div class="swiper-wrapper">
                                    @foreach($relatedPosts->chunk(2) as $postPair)
                                        <div class="swiper-slide">
                                            <div class="row">
                                                @foreach($postPair as $item)
                                                    <div class="col-6">
                                                        <div class="card blog-modern-box overflow-hidden border-0">
                                                            <img src="{{ $item->image ? $item->image->getUrl() : asset('jobcy/images/blog/img-' . str_pad(rand(1, 10), 2, '0', STR_PAD_LEFT) . '.jpg') }}" alt="" class="img-fluid">
                                                            <div class="bg-overlay"></div>
                                                            <div class="card-img-overlay">
                                                            <a href="{{ route('blog-detail', $item->slug) }}" class="text-white"><h5 class="card-title">{{ $item->title }}</h5></a>
                                                            <p class="card-text text-white-50"> {{ $item->author->name }} - {{ Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div><!--end blogSlider-->
                                    @endforeach
                                </div>
                                <div class="swiper-pagination"></div>
                            </div><!--end blogSlider-->
                        </div><!--end related post-->
                    </div>
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
