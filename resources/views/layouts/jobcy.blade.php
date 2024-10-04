<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @yield('meta')
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('jobcy/images/favicon.ico') }}">
        <!-- Swiper Css -->
        <link rel="stylesheet" href="{{ asset('jobcy/libs/swiper/swiper-bundle.min.css') }}">
        <!-- Choise Css -->
        <link rel="stylesheet" href="{{ asset('jobcy/libs/choices.js/public/assets/styles/choices.min.css') }}">
        <!-- Bootstrap Css -->
        <link href="{{ asset('jobcy/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"/>
        <!-- Icons Css -->
        <link href="{{ asset('jobcy/css/icons.min.css') }}" rel="stylesheet" />
        <!-- App Css-->
        <link href="{{ asset('jobcy/css/app.min.css') }}" id="app-style" rel="stylesheet" />
        <!--Custom Css-->
        <link rel="stylesheet" href="{{ asset('jobcy/css/custom.css') }}"> <!-- Add custom CSS file if needed -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" />
        @yield('styles')
    </head>
<body>
    @include('sweetalert::alert')
    @include('partials.loader')

    <!-- Begin page -->
    <div>
        @include('partials.navbar')

        <div class="main-content">

            <div class="page-content">

                @yield('content')

            </div>
            <!-- End Page-content -->

            @include('partials.footer')

            @include('partials.switcher')

            <!--start back-to-top-->
            <button onclick="topFunction()" id="back-to-top">
                <i class="mdi mdi-arrow-up"></i>
            </button>
            <!--end back-to-top-->
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

   <!-- JAVASCRIPT -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script src="{{ asset('jobcy/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
   <script src="https://unicons.iconscout.com/release/v4.0.0/script/monochrome/bundle.js"></script>

   <!-- Choice Js -->
   <script src="{{ asset('jobcy/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>

   <!-- Swiper Js -->
   <script src="{{ asset('jobcy/libs/swiper/swiper-bundle.min.js') }}"></script>

   <!-- Job-list Init Js -->
   {{-- <script src="{{ asset('jobcy/js/pages/job-list.init.js') }}"></script> --}}

   <!-- Switcher Js -->
   <script src="{{ asset('jobcy/js/pages/switcher.init.js') }}"></script>

   <script src="{{ asset('jobcy/js/pages/index.init.js') }}"></script>

   <script src="{{ asset('jobcy/js/app.js') }}"></script>

   {{-- <script src="{{ asset('jobcy/js/custom.js') }}"></script> <!-- Add custom JS file if needed --> --}}

   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>

   <script>
    document.addEventListener("DOMContentLoaded", function() {
        const images = document.querySelectorAll('.animate-on-view');

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('in-view'); // Add the class to start animation
                }
            });
        });

        images.forEach(image => {
            observer.observe(image); // Observe each image
        });
    });
   </script>
   @yield('scripts')
</body>
</html>
