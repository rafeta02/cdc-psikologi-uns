@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.validate') }} {{ trans('cruds.prestasiMahasiswa.title_singular') }}
    </div>

    <div class="card-body">
        <div class="mb-4">
            <a class="btn btn-default" href="{{ route('admin.prestasi-mahasiswas.index') }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>
        
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Detail Prestasi
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>{{ trans('cruds.prestasiMahasiswa.fields.nama_kegiatan') }}</th>
                                    <td>{{ $prestasiMahasiswa->nama_kegiatan }}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('cruds.prestasiMahasiswa.fields.skim') }}</th>
                                    <td>{{ App\Models\PrestasiMahasiswa::SKIM_RADIO[$prestasiMahasiswa->skim] ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('cruds.prestasiMahasiswa.fields.tingkat') }}</th>
                                    <td>{{ App\Models\PrestasiMahasiswa::TINGKAT_RADIO[$prestasiMahasiswa->tingkat] ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('cruds.prestasiMahasiswa.fields.kategori') }}</th>
                                    <td>{{ $prestasiMahasiswa->kategori->name ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('cruds.prestasiMahasiswa.fields.perolehan_juara') }}</th>
                                    <td>{{ App\Models\PrestasiMahasiswa::PEROLEHAN_JUARA_SELECT[$prestasiMahasiswa->perolehan_juara] ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('cruds.prestasiMahasiswa.fields.nama_penyelenggara') }}</th>
                                    <td>{{ $prestasiMahasiswa->nama_penyelenggara }}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('cruds.prestasiMahasiswa.fields.keikutsertaan') }}</th>
                                    <td>{{ App\Models\PrestasiMahasiswa::KEIKUTSERTAAN_RADIO[$prestasiMahasiswa->keikutsertaan] ?? '' }}</td>
                                </tr>
                                <tr>
                                    <th>{{ trans('cruds.prestasiMahasiswa.fields.dosen_pembimbing') }}</th>
                                    <td>{{ $prestasiMahasiswa->dosen_pembimbing }}</td>
                                </tr>
                                <tr>
                                    <th>Peserta</th>
                                    <td>
                                        <ul>
                                            @foreach($prestasiMahasiswa->pesertas as $peserta)
                                                <li>{{ $peserta->nama }} ({{ $peserta->nim }})</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header bg-secondary text-white">
                        Dokumen Pendukung
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Surat Tugas</h5>
                                <div class="file-list">
                                    @foreach($prestasiMahasiswa->surat_tugas as $key => $media)
                                        <div class="mb-2">
                                            <a href="{{ $media->getUrl() }}" target="_blank">
                                                {{ $media->file_name }}
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5>Sertifikat</h5>
                                <div class="file-list">
                                    @foreach($prestasiMahasiswa->sertifikat as $key => $media)
                                        <div class="mb-2">
                                            <a href="{{ $media->getUrl() }}" target="_blank">
                                                {{ $media->file_name }}
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <h5>Foto Dokumentasi</h5>
                                <div class="file-list">
                                    @foreach($prestasiMahasiswa->foto_dokumentasi as $key => $media)
                                        <div class="mb-2">
                                            <a href="{{ $media->getUrl() }}" target="_blank">
                                                {{ $media->file_name }}
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5>Surat Tugas Pembimbing</h5>
                                <div class="file-list">
                                    @if($prestasiMahasiswa->surat_tugas_pembimbing)
                                        <div class="mb-2">
                                            <a href="{{ $prestasiMahasiswa->surat_tugas_pembimbing->getUrl() }}" target="_blank">
                                                {{ $prestasiMahasiswa->surat_tugas_pembimbing->file_name }}
                                            </a>
                                        </div>
                                    @else
                                        <span class="text-muted">Tidak ada file</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <h5>Bukti SIPSMART</h5>
                                <div class="file-list">
                                    @foreach($prestasiMahasiswa->bukti_sipsmart as $key => $media)
                                        <div class="mb-2">
                                            <a href="{{ $media->getUrl() }}" target="_blank">
                                                {{ $media->file_name }}
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        Form Validasi
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route("admin.prestasi-mahasiswas.process-validation", [$prestasiMahasiswa->id]) }}" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="form-group">
                                <label class="required" for="validation_status">{{ trans('cruds.prestasiMahasiswa.fields.validation_status') }}</label>
                                <select class="form-control {{ $errors->has('validation_status') ? 'is-invalid' : '' }}" name="validation_status" id="validation_status" required>
                                    <option value="">{{ trans('global.pleaseSelect') }}</option>
                                    @foreach(App\Models\PrestasiMahasiswa::STATUS_SELECT as $key => $label)
                                        <option value="{{ $key }}" {{ old('validation_status', $prestasiMahasiswa->validation_status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('validation_status'))
                                    <span class="text-danger">{{ $errors->first('validation_status') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.validation_status_helper') }}</span>
                            </div>
                            
                            <div class="form-group">
                                <label for="validation_notes">{{ trans('cruds.prestasiMahasiswa.fields.validation_notes') }}</label>
                                <textarea class="form-control {{ $errors->has('validation_notes') ? 'is-invalid' : '' }}" name="validation_notes" id="validation_notes" rows="5">{{ old('validation_notes', $prestasiMahasiswa->validation_notes) }}</textarea>
                                @if($errors->has('validation_notes'))
                                    <span class="text-danger">{{ $errors->first('validation_notes') }}</span>
                                @endif
                                <span class="help-block">{{ trans('cruds.prestasiMahasiswa.fields.validation_notes_helper') }}</span>
                            </div>
                            
                            <div class="form-group mt-4">
                                <button class="btn btn-primary btn-block" type="submit">
                                    {{ trans('global.save') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                
                @if($prestasiMahasiswa->validation_status != 'pending')
                <div class="card mt-3">
                    <div class="card-header bg-info text-white">
                        Riwayat Validasi
                    </div>
                    <div class="card-body">
                        <p><strong>Status:</strong> 
                            <span class="badge {{ $prestasiMahasiswa->validation_status == 'validated' ? 'badge-success' : 'badge-danger' }}">
                                {{ App\Models\PrestasiMahasiswa::STATUS_SELECT[$prestasiMahasiswa->validation_status] ?? '' }}
                            </span>
                        </p>
                        <p><strong>Tanggal Validasi:</strong> {{ $prestasiMahasiswa->validated_at ? $prestasiMahasiswa->validated_at->format('d/m/Y H:i') : '-' }}</p>
                        <p><strong>Validator:</strong> {{ $prestasiMahasiswa->validator->name ?? '-' }}</p>
                        <p><strong>Catatan:</strong></p>
                        <div class="border p-2 rounded bg-light">
                            {{ $prestasiMahasiswa->validation_notes ?: 'Tidak ada catatan' }}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection 