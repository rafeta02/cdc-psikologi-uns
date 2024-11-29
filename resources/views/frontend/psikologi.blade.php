@extends('layouts.jobcy')

@section('title', 'Profil Fakultas Psikologi UNS - Career Development Center Fakultas Psikologi UNS')

@section('content')
    <!-- Start home -->
    <section class="page-title-box">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="text-center text-white">
                        <h3 class="mb-4">Profil Fakultas Psikologi UNS</h3>
                        <div class="page-next">
                            <nav class="d-inline-block" aria-label="breadcrumb text-center">
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"> Profil Fakultas Psikologi UNS </li>
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
                        <h6 class="sub-title">Profil Fakultas Psikologi UNS</h6>
                        <h2 class="title mb-4">Who Are <span class="text-warning fw-bold">We</span> ?</h2>

                        <div class="row">
                            <div class="col-12">
                                <div class="about-img mt-4 mt-lg-0" style="max-width: 1280px; width: 100%;">
                                    <img 
                                        src="{{ asset('img/gedung_d.png') }}" 
                                        alt="Gambar Gedung Fakultas Psikologi" 
                                        class="img-fluid rounded" 
                                        style="width: 100%; height: auto; object-fit: cover;">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="col-12">
                                <p class="text-muted" style="text-align: justify">
                                    Kebutuhan masyarakat terhadap Layanan Jasa Psikologi berkembang pesat di Indonesia tidak saja di ruang-ruang Praktek Psikologi tetapi juga di berbagai media lain seperti media masa, ceramah, seminar dan lain-lain. Dalam perkembangannya Psikologi Profesional memperoleh tempat dan peran yang jelas dalam masyarakat. Sehubungan dengan hal tersebut maka mulai Tahun Akademik 2004/ 2005 Universitas Sebelas Maret telah ikut mengembangkan disiplin Psikologi sebagai salah satu Program Studi. Pada tahap awal Program Studi Psikologi berdiri masih menginduk di Fakultas Kedokteran seperti juga beberapa Fakultas Psikologi lain di Indonesia yang pada awalnya merupakan Program Studi di bawah Fakultas Kedokteran. Pada Tahun 2022 Program Studi Psikologi mulai memisahkan diri dari Fakultas Kedokteran dan menjadi Fakultas baru di Universitas Sebelas Maret lebih tepatnya tanggal 11 Maret 2022 sesuai SK Rektor Universitas Sebelas Maret Nomor 320/UN27/HK/2022 pada jenjang Sarjana. Fakultas Psikologi memiliki satu Program Studi yaitu S1 Psikologi yang dalam kegiatan pembelajaran Mahasiswa dibimbing untuk melakukan Penelitian dan Studi Kasus sehingga ilmu yang didapatkan dapat diimplementasikan dengan kebutuhan di masyarakat. Rencana kedepan Fakultas Psikologi akan membuka 2 Program Studi S2 baru yaitu Program Profesi Psikolog dan Program Magister Sains yang saat ini sudah mulai dilakukan persiapan penyusunan serta perencanaan pendiriannya.
                                </p>
                            </div>
                        </div>

                        <div class="row mt-2 pt-2">
                            <div class="col-md-12">
                                <h2 class="text-muted title">Visi</h2>
                                <p class="text-muted" style="text-align: justify;">
                                    Menjadi Institusi yang memiliki keunggulan di tingkat Internasional dalam penyelenggaraan Pendidikan, Riset, dan Terapan Psikologi berbasis Budaya, yang berorientasi pada peningkatan kesejahteraan masyarakat.
                                </p>
                        
                                <h2 class="text-muted title">Misi</h2>
                                <ul class="list-unstyled about-list text-muted mb-0 mb-md-3">
                                    <li>
                                        Memenuhi standar kompetensi lulusan Psikologi yang memiliki daya saing, menjiwai nilai Budaya dan berorientasi pada peningkatan kesejahteraan masyarakat.
                                    </li>
                                    <li>
                                        Menyelenggarakan Penelitian dan Pengabdian dengan Perspektif Psikologi Budaya, bereputasi Internasional dan berkontribusi dalam kesejahteraan masyarakat.
                                    </li>
                                    <li>
                                        Memperluas jejaring kerjasama Internasional yang mendukung peningkatan kualitas SDM dan Reputasi Global.
                                    </li>
                                    <li>
                                        Menyelenggarakan manajemen Fakultas berbasis tata kelola yang baik (Good Governance).
                                    </li>
                                </ul>
                        
                                <h2 class="text-muted title">Tujuan</h2>
                                <ul class="list-unstyled about-list text-muted mb-0 mb-md-3">
                                    <li>
                                        Terwujudnya layanan Pendidikan dengan standar kualitas unggul yang diakui oleh Lembaga Penjamin Mutu Nasional dan Internasional.
                                    </li>
                                    <li>
                                        Tercapainya karya ilmiah berbasis pada Penelitian Psikologi Budaya yang berkontribusi dalam pengembangan Ilmu Psikologi.
                                    </li>
                                    <li>
                                        Terlaksananya kegiatan pengabdian dan pelayanan berbasis Penelitian Psikologi yang berdampak langsung terhadap kesejahteraan masyarakat.
                                    </li>
                                    <li>
                                        Terlaksananya kegiatan kerjasama lembaga bereputasi di tingkat Internasional dalam rangka peningkatan kualitas Pendidikan, Penelitian, dan Inovasi.
                                    </li>
                                </ul>
                        
                                <h2 class="text-muted title">Sasaran dan Strategi</h2>
                                <ul class="list-unstyled about-list text-muted mb-0 mb-md-3">
                                    <li>
                                        <strong>Sasaran Tahap I (2011 - 2015):</strong> Penguatan lembaga dan Infrastruktur Dasar Pendidikan, serta pembangunan reputasi Nasional.
                                    </li>
                                    <li>
                                        <strong>Sasaran Tahap II (2015 - 2019):</strong> Rintisan pengembangan kualitas Pendidikan, penguatan aspek keunggulan, serta pembangunan untuk menuju reputasi Internasional.
                                    </li>
                                    <li>
                                        <strong>Sasaran Tahap III (2019 - 2023):</strong> Fakultas Psikologi UNS sebagai Psikologi yang unggul di kawasan Asia Pasifik, penguatan kerjasama dengan mitra-mitra Luar Negeri dengan melakukan program-program Pendidikan Internasional, seperti pertukaran Mahasiswa dan Peneliti/ Dosen, kolaborasi Riset serta Pengabdian.
                                    </li>
                                    <li>
                                        <strong>Sasaran Tahap IV (2023 - 2027):</strong> Kokohnya kerjasama Internasional dan menghasilkan Inovasi yang berpengaruh di kancah Internasional.
                                    </li>
                                </ul>
                            </div>
                        </div>
                         
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->
    </section>
    <!-- END ABOUT -->
@endsection
