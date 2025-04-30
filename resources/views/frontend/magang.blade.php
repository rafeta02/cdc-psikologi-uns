@extends('layouts.jobcy')

@section('title', "Internship/Magang - Career Development Center Fakultas Psikologi UNS")

@section('content')
    <!-- Start home -->
    <section class="page-title-box">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="text-center text-white">
                        <h3 class="mb-4">Internship / Magang</h3>
                        <div class="page-next">
                            <nav class="d-inline-block" aria-label="breadcrumb text-center">
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Internship/Magang</li>
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

    <!-- START MAGANG/INTERNSHIP-LIST -->
    <section class="section">
        <div class="container">
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            
            <div class="row">
                <div class="col-lg-9">
                    <div class="me-lg-5">
                        <div class="job-list-header">
                            <form id="filter-form">
                                <div class="row g-2 mb-2">
                                    <div class="col-lg-10 col-md-12">
                                        <div class="filler-job-form">
                                            <i class="uil uil-briefcase-alt"></i>
                                            <input type="search" class="form-control filter-job-input-box" id="name" name="name" placeholder="Internship Name, Description.... ">
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-lg-2 col-md-6">
                                        <button type="button" class="btn btn-primary w-100" onclick="filterMagang()"><i class="uil uil-filter"></i> Filter</button>
                                    </div><!--end col-->
                                </div>
                                <div class="row g-2">
                                    <div class="col-lg-5 col-md-12">
                                        <div class="filler-job-form">
                                            <i class="uil uil-building"></i>
                                            <select class="form-select" name="company" id="company">
                                                <option value="" selected>All Companies</option>
                                                @foreach($companies as $id => $entry)
                                                    <option value="{{ $id }}" {{ old('company') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-lg-5 col-md-6">
                                        <div class="filler-job-form">
                                            <i class="uil uil-clipboard-notes"></i>
                                            <select class="form-select" data-trigger name="type" id="type">
                                                <option value="" selected>All Programs</option>
                                                <option value="MBKM">MBKM</option>
                                                <option value="REGULER">Regular</option>
                                            </select>
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-lg-2 col-md-6">
                                        <button type="button" class="btn btn-danger w-100" onclick="location.reload();"><i class="uil uil-history-alt"></i> Reset</button>
                                    </div><!--end col-->
                                </div><!--end row-->
                            </form>
                        </div><!--end job-list-header-->

                        <div id="magang-list">
                            @include('partials.magang-list', ['magangs' => $magangs])
                        </div>
                    </div>

                </div>
                <!-- START SIDE-BAR -->
                <div class="col-lg-3">
                    <div class="side-bar mt-5 mt-lg-0">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item mt-3">
                                <h2 class="accordion-header" id="datePosted">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#dateposted" aria-expanded="false" aria-controls="dateposted">
                                        Only Open Internships
                                    </button>
                                </h2>
                                <div id="dateposted" class="accordion-collapse collapse show" aria-labelledby="datePosted">
                                    <div class="accordion-body">
                                        <div class="side-title form-check-all">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="onlyopen" value="open" />
                                                <label class="form-check-label ms-2 text-muted" for="onlyopen">
                                                    Only Open Internships
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end accordion-item -->

                            <div class="accordion-item mt-4">
                                <h2 class="accordion-header" id="internshipType">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#internshiptype" aria-expanded="false" aria-controls="internshiptype">
                                        Type of Program
                                    </button>
                                </h2>
                                <div id="internshiptype" class="accordion-collapse collapse show" aria-labelledby="internshipType">
                                    <div class="accordion-body">
                                        <div class="side-title">
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" value="" type="radio" name="magang_type" id="magang_type0" checked>
                                                <label class="form-check-label ms-2 text-muted" for="magang_type0">
                                                    All
                                                </label>
                                            </div>
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" value="MBKM" type="radio" name="magang_type" id="magang_type1">
                                                <label class="form-check-label ms-2 text-muted" for="magang_type1">
                                                    MBKM
                                                </label>
                                            </div>
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" value="REGULER" type="radio" name="magang_type" id="magang_type2">
                                                <label class="form-check-label ms-2 text-muted" for="magang_type2">
                                                    Regular
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end accordion-item -->
                        </div><!--end accordion-->
                    </div><!--end side-bar-->
                </div><!--end col-->
                <!-- END SIDE-BAR -->
            </div><!--end row-->
        </div><!--end container-->
    </section>
    <!-- END MAGANG/INTERNSHIP-LIST -->
@endsection

@section('script')
<script>
    function filterMagang() {
        var form = $('#filter-form');
        var name = $('#name').val();
        var company = $('#company').val();
        var type = $('#type').val();
        var onlyopen = $('#onlyopen').is(':checked') ? 1 : 0;
        var magang_type = $('input[name="magang_type"]:checked').val();

        $.ajax({
            url: '{{ route('magang') }}',
            type: 'GET',
            data: {
                name: name,
                company: company,
                type: magang_type || type,
                onlyopen: onlyopen
            },
            beforeSend: function() {
                $('#magang-list').html('<div class="text-center"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>');
            },
            success: function(data) {
                $('#magang-list').html(data);
            },
            error: function() {
                $('#magang-list').html('<div class="alert alert-danger">An error occurred while fetching data.</div>');
            }
        });
    }

    $(document).ready(function() {
        // Bind events to sidebar filters
        $('#onlyopen').change(function() {
            filterMagang();
        });

        $('input[name="magang_type"]').change(function() {
            filterMagang();
        });
    });
</script>
@endsection 