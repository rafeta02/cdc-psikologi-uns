@extends('layouts.jobcy')

@section('title', 'Tracer Alumni - Career Development Center Fakultas Psikologi UNS')

@section('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
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
                                    <li class="breadcrumb-item active" aria-current="page"> Tracer Alumni </li>
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
                        <h5>Stakeholder yang terhormat,</h5>
                        <p class="text-muted">
                            Merupakan suatu hal yang membanggakan jika Bapak/Ibu bersedia meluangkan waktu sejenak untuk membantu kami dalam melaksanakan suatu survey yang ditujukan kepada seluruh pengguna alumni Program Studi Psikologi Fakultas Psikologi Universitas Sebelas Maret.
                        </p>
                        <p class="text-muted mb-2">
                            Bantuan dan kerja sama Saudara dalam pelaksanaan survey ini akan dapat memberikan gambaran umum tentang kualitas alumni Program Studi Psikologi Universitas Sebelas Maret. Umpan balik Bapak/Ibu akan berguna sebagai bahan pertimbangan yang sangat penting dalam melakukan usaha-usaha peningkatan mutu pendidikan lebih lanjut yang kami upayakan meliputi penelaahan kurikulum berkelanjutan, pengembangan metode belajar, dan pengembangan soft skill yang dirasakan perlu untuk lulusan Program Studi Psikologi Fakultas Psikologi Universitas Sebelas Maret.
                        </p>
                        <p class="text-muted mb-4">
                            Demikian atas perhatian dan kesediaan Stakeholder, kami sampaikan terima kasih yang sebesar-besarnya.
                        </p>
                        <figure class="blog-blockquote mt-2">
                            <figcaption class="blockquote-footer fs-15 mb-4">
                            Hormat Kami,
                            <br><br>
                            <cite title="Source Title" class="text-primary fw-semibold">
                                Ketua Program Studi Psikologi<br>
                                Universitas Sebelas Maret
                            </cite>
                            </figcaption>
                        </figure>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
            <form action="{{ route('tracer-study-store') }}" class="job-post-form shadow mt-4" enctype="multipart/form-data" method="POST">
                @csrf
                <input type="hidden" id="current-step" name="current_step" value="1">
                <!-- Step 1 -->
                <div id="step-1" class="job-post-content box-shadow-md rounded-3 p-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-4">
                                <label for="nama" class="form-label required">Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Lengkap" value="{{ old('nama') }}" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-4">
                                <label for="nama_instansi" class="form-label required">Nama Instansi</label>
                                <input type="text" class="form-control" name="nama_instansi" id="nama_instansi" value="{{ old('nama_instansi') }}" placeholder="Nama Instansi" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-4">
                                <label for="nama_alumni" class="form-label required">Nama Lengkap Alumni</label>
                                <input type="text" class="form-control" name="nama_alumni" id="nama_alumni" placeholder="Nama Lengkap Alumni" value="{{ old('nama_alumni') }}" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-4">
                                <label for="tahun_lulus" class="form-label required">Tahun Lulus</label>
                                <input type="number" class="form-control" name="tahun_lulus" id="tahun_lulus" placeholder="Tahun Lulus" value="{{ old('tahun_lulus') }}" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-4">
                                <label for="waktu_tunggu" class="form-label required">Waktu Tunggu (Tahun)</label>
                                <input type="number" class="form-control" name="waktu_tunggu" id="waktu_tunggu" placeholder="Waktu Tunggu" value="{{ old('waktu_tunggu') }}" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-4">
                                <label class="form-label required">Tingkat Tempat Bekerja</label>
                                @foreach(App\Models\TracerStakeholder::TINGKAT_INSTANSI_RADIO as $key => $label)
                                    <div>
                                        <input type="radio" id="tingkat_instansi_{{ $key }}" name="tingkat_instansi" value="{{ $key }}" {{ old('tingkat_instansi', '') === (string) $key ? 'checked' : '' }} required>
                                        <label for="tingkat_instansi_{{ $key }}">{{ $label }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-4">
                                <label class="form-label required">Kesesuaian Bidang Kerja</label>
                                @foreach(App\Models\TracerStakeholder::KESESUAIAN_BIDANG_RADIO as $key => $label)
                                    <div>
                                        <input type="radio" id="kesesuaian_bidang_{{ $key }}" name="kesesuaian_bidang" value="{{ $key }}" {{ old('kesesuaian_bidang', '') === (string) $key ? 'checked' : '' }} required>
                                        <label for="kesesuaian_bidang_{{ $key }}">{{ $label }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="text-end">
                            <a href="javascript:void(0)" class="btn btn-primary" onclick="nextStep(2)">Next</a>
                        </div>
                    </div>
                </div>

                <!-- Step 2 -->
                <div id="step-2" class="job-post-content box-shadow-md rounded-3 p-4 d-none">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-4">
                                <label class="form-label required">Kompetensi Alumni</label>
                                <table class="table table-borderless table-radio">
                                    <thead>
                                        <tr>
                                            <th scope="col"></th>
                                            <th scope="col text-center" width="15%">Sangat Baik</th>
                                            <th scope="col text-center" width="15%">Baik</th>
                                            <th scope="col text-center" width="15%">Cukup</th>
                                            <th scope="col text-center" width="15%">Kurang</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach([
                                            'integritas' => 'Integritas (etika & moral)',
                                            'keahlian' => 'Keahlian berdasarkan bidang ilmu (profesionalisme)',
                                            'bahasa_inggris' => 'Kemampuan Bahasa Inggris',
                                            'teknologi_informasi' => 'Penggunaan teknologi informasi',
                                            'komunikasi' => 'Komunikasi',
                                            'kerjasama' => 'Kerjasama tim',
                                            'pengembangan_diri' => 'Pengembangan Diri'
                                        ] as $name => $label)
                                            <tr>
                                                <td style="text-align: left">- {{ $label }}</td>
                                                @foreach(['sangat_baik' => 'Sangat Baik', 'baik' => 'Baik', 'cukup' => 'Cukup', 'kurang' => 'Kurang'] as $value => $text)
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="{{ $name }}" value="{{ $value }}" {{ old($name, '') === $value ? 'checked' : '' }} required>
                                                        </div>
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="kepuasan_alumni" class="form-label required">Apakah selama ini Saudara atau perusahaan telah puas terhadap hasil kerja lulusan Program Studi Psikologi Fakultas Psikologi Universitas Sebelas Maret? Mohon disebutkan alasan secara rinci.</label>
                                <textarea class="form-control" id="kepuasan_alumni" name="kepuasan_alumni" rows="5" required>{{ old('kepuasan_alumni') }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="saran" class="form-label required">Saran Saudara atau perusahaan untuk meningkatkan kualitas pendidikan di Program Studi Psikologi Fakultas Psikologi Universitas Sebelas Maret.</label>
                                <textarea class="form-control" id="saran" name="saran" rows="5" required>{{ old('saran') }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-4">
                                <label class="form-label required">Bersediakan Anda dikontak secara langsung atau melalui alumni terkait kerjasama dengan CDC Fakultas Psikologi UNS untuk keperluan campus hiring?</label>
                                @foreach(App\Models\TracerStakeholder::KETERSEDIAAN_CAMPUS_HIRING_RADIO as $key => $label)
                                    <div>
                                        <input type="radio" id="ketersediaan_campus_hiring_{{ $key }}" name="ketersediaan_campus_hiring" value="{{ $key }}" {{ old('ketersediaan_campus_hiring', '') === (string) $key ? 'checked' : '' }} required>
                                        <label for="ketersediaan_campus_hiring_{{ $key }}">{{ $label }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="tanda_tangan" class="form-label required">Tanda Tangan, Sebagai bukti bahwa data yang diisikan adalah yang sebenar-benarnya.</label>
                                <input class="form-control" type="file" id="tanda_tangan" name="tanda_tangan" required>
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
                        <div class="text-end">
                            <a href="javascript:void(0)" class="btn btn-success" onclick="prevStep(1)">Back</a>
                            <button type="submit" class="btn btn-primary">Submit <i class="mdi mdi-send"></i></button>
                        </div>
                    </div>
                </div>
            </form>

        </div><!--end container-->
    </section>
    <!-- END JOBS-POST-EDIT -->
@endsection


@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
<script type="text/javascript">
    function refreshCaptcha() {
        var captcha = document.getElementById('captcha-image');
        captcha.src = captcha.src + '?' + Math.random();
    }
</script>
<script>
@if (session('current_step'))
    document.addEventListener('DOMContentLoaded', function () {
        var step = "{{ session('current_step') }}";
        showStep(step);
    });
@endif

    const form = document.querySelector('form'); // Adjust if your form has a specific ID or class

    function showStep(step) {
        // Hide all steps
        document.querySelectorAll('.job-post-content').forEach(function (element) {
            element.classList.add('d-none');
        });

        // Show the selected step
        document.getElementById('step-' + step).classList.remove('d-none');

        // Update the current step hidden input
        document.getElementById('current-step').value = step;
    }

    function nextStep(step) {
        // Get all input fields in the current step
        const currentStep = document.getElementById('step-' + (step - 1));
        const inputs = currentStep.querySelectorAll('input[required], textarea[required], select[required]');
        const requiredRadioGroups = currentStep.querySelectorAll('input[type="radio"][required]');

        // Validate each required field
        let allValid = true;
        inputs.forEach(input => {
            if (!input.value.trim()) {
                allValid = false;
                input.classList.add('is-invalid');  // Optionally add Bootstrap's 'is-invalid' class for visual feedback
            } else {
                input.classList.remove('is-invalid');
            }
        });

        // Validate radio button groups
        requiredRadioGroups.forEach(radio => {
            const radioGroupName = radio.name;
            const radioGroup = currentStep.querySelectorAll(`input[name="${radioGroupName}"]`);
            const isChecked = Array.from(radioGroup).some(radio => radio.checked);

            if (!isChecked) {
                allValid = false;
                radioGroup.forEach(radio => radio.classList.add('is-invalid'));
            } else {
                radioGroup.forEach(radio => radio.classList.remove('is-invalid'));
            }
        });

        if (!allValid) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please fill in all required fields before proceeding!',
            });
            return;
        }

        showStep(step);
    }

    function prevStep(step) {
        showStep(step);
    }

    form.addEventListener('submit', function(event) {
        if (!validateStep2()) {
            event.preventDefault(); // Prevent form submission
        }
    });

    function validateStep2() {
        // Check radio buttons
        const radioGroups = ['integritas', 'keahlian', 'bahasa_inggris', 'teknologi_informasi', 'komunikasi', 'kerjasama', 'pengembangan_diri'];
        let valid = true;

        radioGroups.forEach(group => {
            if (!document.querySelector(`input[name="${group}"]:checked`)) {
                valid = false;
                alert(`Please select a value for ${group.replace('_', ' ')}`);
            }
        });

        // Check textareas
        const textareas = ['kepuasan_alumni', 'saran'];
        textareas.forEach(id => {
            if (!document.getElementById(id).value.trim()) {
                valid = false;
                alert(`Please fill out the ${id.replace('_', ' ')}`);
            }
        });

        // Check file input
        if (!document.getElementById('tanda_tangan').files.length) {
            valid = false;
            alert('Please upload a file for tanda tangan.');
        }

        // Check captcha
        if (!document.getElementById('captcha').value.trim()) {
            valid = false;
            alert('Please enter the captcha.');
        }

        return valid;
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
