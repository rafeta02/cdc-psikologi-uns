@extends('layouts.jobcy')

@section('title', 'Infografis')

@section('content')
    <!-- Start home -->
    <section class="page-title-box">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="text-center text-white">
                        <h3 class="mb-4">Infografis</h3>
                        <div class="page-next">
                            <nav class="d-inline-block" aria-label="breadcrumb text-center">
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"> Infografis </li>
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


    <!-- START ABOUT -->
    <section class="section overflow-hidden">
        <div class="container">
            <div class="row align-items-center g-0">
                <div class="col-lg-12">
                    <div class="section-title me-lg-5">
                        <h6 class="sub-title">Infografis</h6>
                        <h2 class="title mb-4">Infografis Prestasi Mahasiswa</h2>

                        <p class="text-muted">Infografis ini menampilkan berbagai pencapaian mahasiswa dalam berbagai bidang, termasuk akademik, olahraga, seni, dan kompetisi tingkat nasional maupun internasional. Dengan visualisasi data yang menarik, infografis ini memberikan gambaran mengenai jumlah penghargaan, kategori prestasi, serta kontribusi mahasiswa dalam meningkatkan reputasi institusi. Informasi ini juga bertujuan untuk menginspirasi mahasiswa lain agar terus berprestasi dan berkontribusi dalam bidang yang mereka tekuni.</p>

                        <div class="row mt-4 pt-2">
                            <div class="col-md-12">
                                {!! $tingkat_chart->container() !!}
                            </div>
                        </div>
                        <div class="row mt-2 pt-2">
                            <div class="col-md-12">
                                {!! $kategori_chart->container() !!}
                            </div>
                        </div>
                        <div class="row mt-2 pt-2">
                            <div class="col-md-12">
                                <canvas id="achievementsChart" width="800" height="400"></canvas>
                            </div>
                        </div>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->
    </section>
    <!-- END ABOUT -->

    <!-- COUNTER START -->
    <section class="section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="counter-box mt-3">
                        <div class="counters text-center">
                            <h5 class="counter mb-0">10,000+</h5>
                            <h6 class="fs-16 mt-3">Student</h6>
                        </div>
                    </div>
                </div><!--end col-->
                <div class="col-lg-3 col-md-6">
                    <div class="counter-box mt-3">
                        <div class="counters text-center">
                            <h5 class="counter mb-0">7500+</h5>
                            <h6 class="fs-16 mt-3">Achievement</h6>
                        </div>
                    </div>
                </div><!--end col-->
                <div class="col-lg-3 col-md-6">
                    <div class="counter-box mt-3">
                        <div class="counters text-center">
                            <h5 class="counter mb-0">8.85K</h5>
                            <h6 class="fs-16 mt-3">Positive Feedback</h6>
                        </div>
                    </div>
                </div><!--end col-->
                <div class="col-lg-3 col-md-6">
                    <div class="counter-box mt-3">
                        <div class="counters text-center">
                            <h5 class="counter mb-0">9875</h5>
                            <h6 class="fs-16 mt-3">Members</h6>
                        </div>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->
    </section>
    <!-- COUNTER END -->
@endsection

@section('scripts')
<script src="{{ $tingkat_chart->cdn() }}"></script>
<script src="{{ $kategori_chart->cdn() }}"></script>

{{ $tingkat_chart->script() }}
{{ $kategori_chart->script() }}

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('achievementsChart').getContext('2d');
        const achievementsChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($years) !!},
                datasets: [{
                    label: 'Jumlah Prestasi Mahasiswa',
                    data: {!! json_encode($counts) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Jumlah Prestasi Mahasiswa per Tahun'
                    },
                    legend: {
                        position: 'top',
                    },
                }
            }
        });
    });
</script>
@endsection
