@extends('layouts.jobcy')

@section('title', 'Tracer Alumni')

@section('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
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
            <form action="#" class="job-post-form shadow mt-4" enctype="multipart/form-data">
                <div id="step-1" class="job-post-content box-shadow-md rounded-3 p-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-4">
                                <label for="nama" class="form-label required">Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Lengkap" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-4">
                                <label for="nama_instansi" class="form-label required">Nama Instansi</label>
                                <input type="text" class="form-control" name="nama_instansi" id="nama_instansi" placeholder="Nama Instansi" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-4">
                                <label for="nama_alumni" class="form-label required">Nama Lengkap Alumni</label>
                                <input type="text" class="form-control" name="nama_alumni" id="nama_alumni" placeholder="Nama Lengkap Alumni" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-4">
                                <label for="tahun_lulus" class="form-label required">Tahun Lulus</label>
                                <input type="number" class="form-control" name="tahun_lulus" id="tahun_lulus" placeholder="Tahun Lulus" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-4">
                                <label for="waktu_tunggu" class="form-label required">Waktu Tunggu</label>
                                <input type="number" class="form-control" name="waktu_tunggu" id="waktu_tunggu" placeholder="Waktu Tunggu" required>
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
                                <label for="choices-single-location" class="form-label">Kriteria/Kategori</label>
                                <select class="form-select" data-trigger name="choices-single-location" id="choices-single-location"
                                    aria-label="Default select example">
                                    <option value="ME">Montenegro</option>
                                    <option value="MS">Montserrat</option>
                                    <option value="MA">Morocco</option>
                                    <option value="MZ">Mozambique</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-4">
                                <label class="form-label required">SKIM Kegiatan Mahasiswa</label>
                                @foreach(App\Models\PrestasiMahasiswa::SKIM_RADIO as $key => $label)
                                    <div>
                                        <input type="radio" id="skim_{{ $key }}" name="skim" value="{{ $key }}" {{ old('skim', '') === (string) $key ? 'checked' : '' }} required>
                                        <label for="skim_{{ $key }}">{{ $label }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-4">
                                <label class="form-label required">Tingkat Kegiatan</label>
                                @foreach(App\Models\PrestasiMahasiswa::TINGKAT_RADIO as $key => $label)
                                    <div>
                                        <input type="radio" id="tingkat_{{ $key }}" name="tingkat" value="{{ $key }}" {{ old('tingkat', '') === (string) $key ? 'checked' : '' }} required>
                                        <label for="tingkat_{{ $key }}">{{ $label }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-4">
                                <label for="nama_kegiatan" class="form-label required">Nama Kegiatan</label>
                                <input type="text" class="form-control" id="nama_kegiatan" placeholder="Nama Kegiatan" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-4">
                                <label for="choices-single-location" class="form-label">Kriteria/Kategori</label>
                                <select class="form-select" data-trigger name="choices-single-location" id="choices-single-location"
                                    aria-label="Default select example">
                                    <option value="ME">Montenegro</option>
                                    <option value="MS">Montserrat</option>
                                    <option value="MA">Morocco</option>
                                    <option value="MZ">Mozambique</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label for="tanggal_awal" class="form-label required">Tanggal Awal Kegiatan</label>
                                <input type="date" class="form-control" id="tanggal_awal" name="tanggal_awal" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label for="tanggal_akhir" class="form-label required">Tanggal Akhir Kegiatan</label>
                                <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-4">
                                <label class="form-label required">Jumlah Peserta Kegiatan</label>
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
                                        <input type="radio" id="kesesuaian_bidang_{{ $key }}" name="kesesuaian_bidang" value="{{ $key }}" {{ old('keikutsertaan', '') === (string) $key ? 'checked' : '' }} required>
                                        <label for="kesesuaian_bidang_{{ $key }}">{{ $label }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label for="nama_kegiatan" class="form-label required">Nama Penyelenggara</label>
                                <input type="text" class="form-control" id="nama_penyelenggara" name="nama_penyelenggara" placeholder="Nama Penyelenggara" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label for="nama_kegiatan" class="form-label required">Tempat Penyelenggara</label>
                                <input type="text" class="form-control" id="tempat_penyelenggara" name="tempat_penyelenggara" placeholder="Tempat Penyelenggaraan" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label for="choices-single-location" class="form-label">Perolehan Juara</label>
                                <select class="form-select" data-trigger name="choices-single-location" id="choices-single-location"
                                    aria-label="Default select example">
                                    <option value="ME">Montenegro</option>
                                    <option value="MS">Montserrat</option>
                                    <option value="MA">Morocco</option>
                                    <option value="MZ">Mozambique</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-4">
                                <label for="nama_kegiatan" class="form-label required">Url Publikasi Kegiatan</label>
                                <input type="text" class="form-control" name="url_publikasi" id="url_publikasi" placeholder="Url Publikasi Kegiatan" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="surat_tugas">{{ trans('cruds.prestasiMahasiswa.fields.surat_tugas') }}</label>
                            <div class="needsclick dropzone" id="surat_tugas-dropzone">
                            </div>
                            @if($errors->has('surat_tugas'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('surat_tugas') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.surat_tugas_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="sertifikat">{{ trans('cruds.prestasiMahasiswa.fields.sertifikat') }}</label>
                            <div class="needsclick dropzone" id="sertifikat-dropzone">
                            </div>
                            @if($errors->has('sertifikat'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('sertifikat') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.sertifikat_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="foto_dokumentasi">{{ trans('cruds.prestasiMahasiswa.fields.foto_dokumentasi') }}</label>
                            <div class="needsclick dropzone" id="foto_dokumentasi-dropzone">
                            </div>
                            @if($errors->has('foto_dokumentasi'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('foto_dokumentasi') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.foto_dokumentasi_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="surat_tugas_pembimbing">{{ trans('cruds.prestasiMahasiswa.fields.surat_tugas_pembimbing') }}</label>
                            <div class="needsclick dropzone" id="surat_tugas_pembimbing-dropzone">
                            </div>
                            @if($errors->has('surat_tugas_pembimbing'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('surat_tugas_pembimbing') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.surat_tugas_pembimbing_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="bukti_sipsmart">{{ trans('cruds.prestasiMahasiswa.fields.bukti_sipsmart') }}</label>
                            <div class="needsclick dropzone" id="bukti_sipsmart-dropzone">
                            </div>
                            @if($errors->has('bukti_sipsmart'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('bukti_sipsmart') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.bukti_sipsmart_helper') }}</span>
                        </div>
                        <div class="text-end">
                            <a href="javascript:void(0)" class="btn btn-primary" onclick="nextStep(2)">Next</a>
                        </div>
                    </div>
                </div>

                <div id="step-2" class="job-post-content box-shadow-md rounded-3 p-4 d-none">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" placeholder="Email Address">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label for="phoneNumber" class="form-label">Phone Number</label>
                                <input type="number" class="form-control" id="phoneNumber" placeholder="Phone Number">
                            </div>
                        </div>


                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label for="jobtype" class="form-label">Job Type</label>
                                <input type="text" class="form-control" id="jobtype" placeholder="Job type">
                            </div>
                        </div>
                        <div class="text-end">
                            <a href="javascript:void(0)" class="btn btn-success" onclick="prevStep(1)">Back</a>
                            <a href="javascript:void(0)" class="btn btn-primary" onclick="nextStep(3)">Next</a>
                        </div>
                    </div>
                </div>

                <div id="step-3" class="job-post-content box-shadow-md rounded-3 p-4 d-none">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label for="designation" class="form-label">Designation</label>
                                <input type="text" class="form-control" id="designation" placeholder="Designation">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label for="salary" class="form-label">Salary($)</label>
                                <input type="number" class="form-control" id="salary" placeholder="Salary">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-4">
                                <label for="lastdate" class="form-label">Application Deadline Date</label>
                                <input type="date" class="form-control" id="lastdate">
                            </div>
                        </div>
                        <div class="col-lg-12 text-end">
                            <a href="javascript:void(0)" class="btn btn-success" onclick="prevStep(2)">Back</a>
                            <a href="javascript:void(0)" class="btn btn-primary">Post Now <i class="mdi mdi-send"></i></a>
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
<script>
    function nextStep(step) {
        // Get all input fields in the current step
        const currentStep = document.getElementById('step-' + (step - 1));
        const inputs = currentStep.querySelectorAll('input[required], textarea[required], select[required]');

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

        if (!allValid) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please fill in all required fields before proceeding!',
            });
            return;
        }

        // Proceed to the next step
        document.getElementById('step-' + (step - 1)).classList.add('d-none');
        document.getElementById('step-' + step).classList.remove('d-none');
    }

    function prevStep(step) {
        document.getElementById('step-' + (step + 1)).classList.add('d-none');
        document.getElementById('step-' + step).classList.remove('d-none');
    }
</script>
@endsection
