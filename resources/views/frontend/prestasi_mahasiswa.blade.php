@extends('layouts.jobcy')

@section('title', "Prestasi Mahasiswa - Career Development Center Fakultas Psikologi UNS")

@section('content')
    <!-- Start home -->
    <section class="page-title-box">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="text-center text-white">
                        <h3 class="mb-4">Prestasi Mahasiswa</h3>
                        <div class="page-next">
                            <nav class="d-inline-block" aria-label="breadcrumb text-center">
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"> Prestasi Mahasiswa </li>
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

    <!-- START JOB-LIST -->

    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="candidate-list-widgets mb-4">
                        <form action="#">
                            <div class="row g-2">
                                <div class="col-lg-3">
                                    <div class="filler-job-form">
                                        <i class="uil uil-location-point"></i>
                                        <select class="form-select " data-trigger name="kategori" id="kategori">
                                            <option value="" disabled selected>Select a Category</option>
                                            @foreach($categories as $id => $entry)
                                                <option value="{{ $id }}" {{ old('kategori') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><!--end col-->
                                <div class="col-lg-3">
                                    <div class="filler-job-form">
                                        <i class="uil uil-clipboard-notes"></i>
                                        <select class="form-control" name="keikutsertaan" id="keikutsertaan">
                                            <option value="" disabled selected>Select Keikutsertaan</option>
                                            @foreach(App\Models\PrestasiMahasiswa::KEIKUTSERTAAN_RADIO as $key => $label)
                                                <option value="{{ $key }}" {{ old('keikutsertaan', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><!--end col-->
                                <div class="col-lg-3">
                                    <div class="filler-job-form">
                                        <i class="uil uil-clipboard-notes"></i>
                                        <select class="form-control" name="tingkat" id="tingkat">
                                            <option value="" disabled selected>Select Tingkat Kegiatan</option>
                                            @foreach(App\Models\PrestasiMahasiswa::TINGKAT_RADIO as $key => $label)
                                                <option value="{{ $key }}" {{ old('tingkat', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><!--end col-->
                                <div class="col-lg-3">
                                    <div>
                                        <button type="button" class="btn btn-primary" onclick="filterPrestasi()"><i class="uil uil-filter"></i> Filter</button>
                                        <button type="button" class="btn btn-danger ms-2" onclick="location.reload();"><i class="uil uil-history-alt"></i> Reset</button>
                                    </div>
                                </div>
                            </div><!--end row-->
                        </form><!--end form-->
                    </div>
                </div><!--end col-->
            </div><!--end row-->

            <div class="row">
                <div class="col-lg-12">
                    <div id="prestasi-list">
                        @include('partials.prestasi-list', ['prestasis' => $prestasis])
                    </div>
                </div><!--end col-->
            </div><!--end row-->

        </div><!--end container-->
    </section>
    <!-- END JOB-LIST -->
@endsection

@section('scripts')
<script>

    const kategoriChoices = new Choices('#kategori', {
        placeholder: true,
        placeholderValue: 'Select a category',
        searchEnabled: true,
        searchResultLimit: 10,
        shouldSort: false
    });

    const keikutsertaanChoices = new Choices('#keikutsertaan', {
        placeholder: true,
        placeholderValue: 'Select Keikutsertaan',
        searchEnabled: true,
        searchResultLimit: 10,
        shouldSort: false,
    });

    const tingkatChoices = new Choices('#tingkat', {
        placeholder: true,
        placeholderValue: 'Select Tingkat Kegiatan',
        searchEnabled: true,
        searchResultLimit: 10,
        shouldSort: false,
    });

    // AJAX Filtering Function
    function filterPrestasi(page = 1) {
        let kategori = document.getElementById('kategori').value;
        let keikutsertaan = document.getElementById('keikutsertaan').value;
        let tingkat = document.getElementById('tingkat').value;

        $.ajax({
            url: '{{ route('prestasi') }}',
            type: 'GET',
            data: {
                kategori: kategori,
                keikutsertaan: keikutsertaan,
                tingkat: tingkat,
                page: page // Include the current page number for pagination
            },
            success: function(data) {
                $('#prestasi-list').html(data);
            }
        });
    }

    // Handle pagination link clicks
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        filterPrestasi(page);
    });
</script>
@endsection
