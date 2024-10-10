@extends('layouts.jobcy')

@section('title', 'Tracer Study Alumni - Career Development Center Fakultas Psikologi UNS')

@section('styles')
    <style>
    .table-radio {
        width: 100%;
        border-spacing: 0;
        border-collapse: separate;
    }

    .table-radio th,
    .table-radio td {
        text-align: center;
        padding: 10px;
        border: none;
        vertical-align: middle; /* Center vertically */
    }

    .table-radio th {
        /* font-weight: bold; */
        color: #495057;
    }

    .table-radio td {
        background-color: #ffffff;
    }

    .table-radio .form-check {
        margin-bottom: 0;
        display: flex;
        justify-content: center; /* Center horizontally */
        align-items: center; /* Center vertically */
    }

    .table-radio .form-check-input {
        transform: scale(1.5);
        margin-top: 0;
    }
    </style>
@endsection

@section('content')
    <!-- Start home -->
    <section class="page-title-box">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="text-center text-white">
                        <h3 class="mb-4">Tracer Alumni</h3>
                        <div class="page-next">
                            <nav class="d-inline-block" aria-label="breadcrumb text-center">
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                    <li class="breadcrumb-item" aria-current="page"> Tracer Alumni </li>
                                    <li class="breadcrumb-item active" aria-current="page"> Untuk Alumni </li>
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

    <!-- START JOBS-POST-EDIT -->
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="primary-bg-subtle p-3">
                        <h5 class="mb-0 fs-17"></h5>
                        <div class="text-center mb-5">
                            <h3>Kepuasan Pengguna Lulusan<br>Fakultas Psikologi Universitas Sebelas Maret</h3>
                        </div>
                    </div>
                    <div class="mt-2">
                        <h5>Para Alumni yang terhormat,</h5>
                        <p class="text-muted">
                            Merupakan suatu hal yang membanggakan jika Bapak/Ibu bersedia meluangkan waktu sejenak untuk membantu kami dalam melaksanakan suatu survey yang ditujukan kepada seluruh Alumni Program Studi Psikologi Fakultas Psikologi Universitas Sebelas Maret.
                        </p>
                        <p class="text-muted mb-2">
                            Bantuan dan kerja sama Saudara dalam pelaksanaan survey ini akan dapat memberikan gambaran umum tentang kualitas Alumni Program Studi Psikologi Universitas Sebelas Maret. Umpan balik Bapak/Ibu akan berguna sebagai bahan pertimbangan yang sangat penting dalam melakukan usaha-usaha peningkatan mutu pendidikan lebih lanjut yang kami upayakan meliputi penelaahan kurikulum berkelanjutan, pengembangan metode belajar, dan pengembangan soft skill yang dirasakan perlu untuk lulusan Program Studi Psikologi Fakultas Psikologi Universitas Sebelas Maret.
                        </p>
                        <p class="text-muted mb-4">
                            Demikian atas perhatian dan kesediaan para Alumni, kami sampaikan terima kasih yang sebesar-besarnya.
                        </p>
                        <figure class="blog-blockquote mt-2">
                            <figcaption class="blockquote-footer fs-15 mb-4">
                            Hormat Kami,
                            <br><br>
                            <cite title="Source Title" class="text-primary fw-semibold">
                                Career Development Center Fakultas Psikologi<br>
                                Universitas Sebelas Maret
                            </cite>
                            </figcaption>
                        </figure>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
            <form id="tracerAlumni" action="{{ route('tracer-alumni-store') }}" class="job-post-form shadow mt-4" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="job-post-content box-shadow-md rounded-3 p-4">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label for="nama" class="form-label required">NIM</label>
                                <input type="text" class="form-control" name="nim" id="nim" placeholder="Nomor Induk Mahasiswa" value="{{ old('nim') }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label for="nama" class="form-label required">Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Lengkap" value="{{ old('nama') }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label for="telephone" class="form-label required">Nomor Telfon / Whatsapp</label>
                                <input type="text" class="form-control" name="telephone" id="telephone" value="{{ old('telephone') }}" placeholder="Nomor Telfon / Whatsapp" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label for="email" class="form-label required">Email</label>
                                <input type="text" class="form-control" type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label required">Kota Asal</label>
                                <select class="form-select" name="kota_asal_id" id="kota_asal_id" required>
                                    <option value="" disabled selected>Type City or Province</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label required">Kota Domisili</label>
                                <select class="form-select" name="kota_domisili_id" id="kota_domisili_id" required>
                                    <option value="" disabled selected>Type City or Province</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label required">Angkatan</label>
                                <select class="form-select" data-trigger name="angkatan" id="angkatan" required>
                                    <option value disabled {{ old('kesibukan', null) === null ? 'selected' : '' }} required>{{ trans('global.pleaseSelect') }}</option>
                                    @foreach(App\Models\TracerAlumnu::ANGKATAN_SELECT as $key => $label)
                                        <option value="{{ $key }}" {{ old('angkatan', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label class="form-label required">Kesibukan saat ini ?</label>
                                <select class="form-control" data-trigger name="kesibukan" id="kesibukan" required>
                                    <option value disabled {{ old('kesibukan', null) === null ? 'selected' : '' }} required>{{ trans('global.pleaseSelect') }}</option>
                                    @foreach(App\Models\TracerAlumnu::KESIBUKAN_SELECT as $key => $label)
                                        <option value="{{ $key }}" {{ old('kesibukan', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-4">
                                <label class="form-label required">{{ trans('cruds.tracerAlumnu.fields.partisipasi') }}</label>
                                @foreach(App\Models\TracerAlumnu::PARTISIPASI_RADIO as $key => $label)
                                    <div>
                                        <input type="radio" id="partisipasi_{{ $key }}" name="partisipasi" value="{{ $key }}" {{ old('partisipasi', '') === (string) $key ? 'checked' : '' }} required>
                                        <label for="partisipasi_{{ $key }}">{{ $label }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label for="nama_instansi" class="form-label required">Nama Instansi</label>
                                <input type="text" class="form-control" name="nama_instansi" id="nama_instansi" placeholder="Nama Instansi" value="{{ old('nama_instansi') }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label for="jabatan_instansi" class="form-label required">Jabatan Instansi</label>
                                <input type="text" class="form-control" name="jabatan_instansi" id="jabatan_instansi" value="{{ old('jabatan_instansi') }}" placeholder="Jabatan Instansi" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-4">
                                <label class="form-label required">Range Pendapatan Perbulan ?</label>
                                <table>
                                    @foreach(App\Models\TracerAlumnu::PENDAPATAN_RADIO as $key => $label)
                                    <tr>
                                        <td style="width: 42px">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" id="pendapatan_{{ $key }}" name="pendapatan" value="{{ $key }}" {{ old('pendapatan', '') === (string) $key ? 'checked' : '' }} required></td>
                                            </div>
                                        <td><label for="pendapatan_{{ $key }}">{{ $label }}</label></td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="captcha">Captcha</label>
                                <div>
                                    <img src="{{ captcha_src() }}" alt="CAPTCHA Image" id="captcha-image">
                                    <button type="button" onclick="refreshCaptcha()"><i class="mdi mdi-reload"></i></button>
                                </div>
                                <input type="text" class="form-control" id="captcha" name="captcha" placeholder="Captcha" required>
                            </div>
                        </div>
                        <div class="col-lg-12 d-flex justify-content-center mt-5">
                            <button type="submit" class="btn btn-primary" onclick="validateTracerAlumniForm(event)">Submit <i class="mdi mdi-send"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div><!--end container-->
    </section>
    <!-- END JOBS-POST-EDIT -->
@endsection


@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const angkatanChoices = new Choices('#angkatan', {
        placeholder: true,
        placeholderValue: 'Select a category',
        searchEnabled: true,
        searchResultLimit: 10,
        shouldSort: false
    });

    const kesibukanChoices = new Choices('#kesibukan', {
        placeholder: true,
        placeholderValue: 'Select a category',
        searchEnabled: true,
        searchResultLimit: 10,
        shouldSort: false
    });

    const kotaAsalChoices = new Choices('#kota_asal_id', {
        placeholder: true,
        placeholderValue: 'Search for a location',
        searchEnabled: true, // Enable search functionality
        searchResultLimit: 10, // Limit number of results displayed
        shouldSort: false // Disable sorting to retain order from server
    });

    const kotaDomisiliChoices = new Choices('#kota_domisili_id', {
        placeholder: true,
        placeholderValue: 'Search for a location',
        searchEnabled: true, // Enable search functionality
        searchResultLimit: 10, // Limit number of results displayed
        shouldSort: false // Disable sorting to retain order from server
    });

    function loadCity(query) {
        return fetch('{{ route("select.getRegencies") }}?q=' + encodeURIComponent(query))
            .then(response => response.json())
            .then(data => {
                return data.map(item => ({
                    value: item.id,   // Use the `id` field for the value
                    label: item.text  // Use the `name` field for the label
                }));
            });
    }

    // Handle the AJAX response with Choices.js
    document.querySelector('#kota_asal_id').addEventListener('search', function(event) {
        const searchTerm = event.detail.value;

        if (searchTerm.length >= 3) {
            loadCity(searchTerm).then(options => {
                // Clear previous choices and set new options
                kotaAsalChoices.clearStore();
                kotaAsalChoices.setChoices(options, 'value', 'label', true);
            });
        }
    });

    // Handle the AJAX response with Choices.js
    document.querySelector('#kota_domisili_id').addEventListener('search', function(event) {
        const searchTerm = event.detail.value;

        if (searchTerm.length >= 3) {
            loadCity(searchTerm).then(options => {
                // Clear previous choices and set new options
                kotaDomisiliChoices.clearStore();
                kotaDomisiliChoices.setChoices(options, 'value', 'label', true);
            });
        }
    });
});
</script>
<script type="text/javascript">
    function refreshCaptcha() {
        var captcha = document.getElementById('captcha-image');
        captcha.src = captcha.src + '?' + Math.random();
    }

    function validateTracerAlumniForm(event) {
        event.preventDefault(); // Prevent the form from submitting

        // Select the form by its ID
        const form = document.getElementById('tracerAlumni');

        // Check all required fields
        const requiredFields = form.querySelectorAll('[required]');
        let allFilled = true;

        requiredFields.forEach(function(field) {
            if (!field.value.trim()) {
                allFilled = false;
                // Add a red border to highlight the empty fields (optional)
                field.classList.add('is-invalid');
            } else {
                field.classList.remove('is-invalid');
            }
        });

        if (!allFilled) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please fill all the required fields!',
            });
        } else {
            form.submit(); // Submit the form if all fields are filled
        }
    }
</script>
@if($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: 'There were some problems with your input.',
                html: '<ul>' +
                    @foreach($errors->all() as $error)
                        '<li>{{ $error }}</li>' +
                    @endforeach
                '</ul>',
                confirmButtonText: 'OK'
            });
        });
    </script>
@endif

@if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK',
                timer: 4000 // Auto-close after 3 seconds
            });
        });
    </script>
@endif
@endsection
