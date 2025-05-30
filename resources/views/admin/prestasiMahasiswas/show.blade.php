@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.prestasiMahasiswa.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.prestasi-mahasiswas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
                
                @if(!($prestasiMahasiswa->is_draft ?? false))
                    @php
                        $validationStatus = $prestasiMahasiswa->validation_status ?? 'pending';
                    @endphp
                    
                    @if($validationStatus === 'pending')
                        <button type="button" class="btn btn-success btn-validate" 
                                data-id="{{ $prestasiMahasiswa->id }}" 
                                data-name="{{ $prestasiMahasiswa->nama_kegiatan ?? 'Draft' }}">
                            <i class="fas fa-check"></i> Validate
                        </button>
                        
                        <button type="button" class="btn btn-danger btn-reject" 
                                data-id="{{ $prestasiMahasiswa->id }}" 
                                data-name="{{ $prestasiMahasiswa->nama_kegiatan ?? 'Draft' }}">
                            <i class="fas fa-times"></i> Reject
                        </button>
                    @endif
                @endif
            </div>
            
            <!-- Validation Status Display -->
            @if(!($prestasiMahasiswa->is_draft ?? false))
                <div class="alert alert-info">
                    <h5><i class="fas fa-info-circle"></i> Status Validasi</h5>
                    @php
                        $validationStatus = $prestasiMahasiswa->validation_status ?? 'pending';
                    @endphp
                    
                    @if($validationStatus === 'validated')
                        <span class="badge badge-success badge-lg">
                            <i class="fas fa-check-circle"></i> Validated
                        </span>
                        @if($prestasiMahasiswa->validation_notes)
                            <div class="mt-2">
                                <strong>Catatan Validasi:</strong><br>
                                {{ $prestasiMahasiswa->validation_notes }}
                            </div>
                        @endif
                        @if($prestasiMahasiswa->validated_at)
                            <div class="mt-1 text-muted">
                                <small>Validated at: {{ 
                                    is_object($prestasiMahasiswa->validated_at) 
                                        ? $prestasiMahasiswa->validated_at->format('d M Y H:i') 
                                        : date('d M Y H:i', strtotime($prestasiMahasiswa->validated_at)) 
                                }}</small>
                            </div>
                        @endif
                    @elseif($validationStatus === 'rejected')
                        <span class="badge badge-danger badge-lg">
                            <i class="fas fa-times-circle"></i> Rejected
                        </span>
                        @if($prestasiMahasiswa->validation_notes)
                            <div class="mt-2">
                                <strong>Alasan Penolakan:</strong><br>
                                <div class="alert alert-danger mt-1">
                                    {{ $prestasiMahasiswa->validation_notes }}
                                </div>
                            </div>
                        @endif
                    @else
                        <span class="badge badge-warning badge-lg">
                            <i class="fas fa-clock"></i> Pending Validation
                        </span>
                        <div class="mt-2 text-muted">
                            <small>Submission is waiting for admin review.</small>
                        </div>
                    @endif
                </div>
            @endif
            
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.prestasiMahasiswa.fields.user') }}
                        </th>
                        <td>
                            {{ $prestasiMahasiswa->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prestasiMahasiswa.fields.skim') }}
                        </th>
                        <td>
                            {{ App\Models\PrestasiMahasiswa::SKIM_RADIO[$prestasiMahasiswa->skim] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prestasiMahasiswa.fields.tingkat') }}
                        </th>
                        <td>
                            {{ App\Models\PrestasiMahasiswa::TINGKAT_RADIO[$prestasiMahasiswa->tingkat] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prestasiMahasiswa.fields.nama_kegiatan') }}
                        </th>
                        <td>
                            {{ $prestasiMahasiswa->nama_kegiatan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prestasiMahasiswa.fields.kategori') }}
                        </th>
                        <td>
                            {{ $prestasiMahasiswa->kategori->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prestasiMahasiswa.fields.tanggal_awal') }}
                        </th>
                        <td>
                            {{ $prestasiMahasiswa->tanggal_awal }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prestasiMahasiswa.fields.tanggal_akhir') }}
                        </th>
                        <td>
                            {{ $prestasiMahasiswa->tanggal_akhir }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prestasiMahasiswa.fields.jumlah_peserta') }}
                        </th>
                        <td>
                            {{ App\Models\PrestasiMahasiswa::JUMLAH_PESERTA_RADIO[$prestasiMahasiswa->jumlah_peserta] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prestasiMahasiswa.fields.perolehan_juara') }}
                        </th>
                        <td>
                            {{ App\Models\PrestasiMahasiswa::PEROLEHAN_JUARA_SELECT[$prestasiMahasiswa->perolehan_juara] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prestasiMahasiswa.fields.nama_penyelenggara') }}
                        </th>
                        <td>
                            {{ $prestasiMahasiswa->nama_penyelenggara }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prestasiMahasiswa.fields.tempat_penyelenggara') }}
                        </th>
                        <td>
                            {{ $prestasiMahasiswa->tempat_penyelenggara }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prestasiMahasiswa.fields.keikutsertaan') }}
                        </th>
                        <td>
                            {{ App\Models\PrestasiMahasiswa::KEIKUTSERTAAN_RADIO[$prestasiMahasiswa->keikutsertaan] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prestasiMahasiswa.fields.dosen_pembimbing') ?? 'Dosen Pembimbing' }}
                        </th>
                        <td>
                            {{ $prestasiMahasiswa->dosen_pembimbing }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prestasiMahasiswa.fields.url_publikasi') }}
                        </th>
                        <td>
                            {{ $prestasiMahasiswa->url_publikasi }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prestasiMahasiswa.fields.surat_tugas') }}
                        </th>
                        <td>
                            @foreach($prestasiMahasiswa->surat_tugas as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prestasiMahasiswa.fields.sertifikat') }}
                        </th>
                        <td>
                            @foreach($prestasiMahasiswa->sertifikat as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prestasiMahasiswa.fields.foto_dokumentasi') }}
                        </th>
                        <td>
                            @foreach($prestasiMahasiswa->foto_dokumentasi as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prestasiMahasiswa.fields.surat_tugas_pembimbing') }}
                        </th>
                        <td>
                            @if($prestasiMahasiswa->surat_tugas_pembimbing)
                                <a href="{{ $prestasiMahasiswa->surat_tugas_pembimbing->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prestasiMahasiswa.fields.bukti_sipsmart') }}
                        </th>
                        <td>
                            @foreach($prestasiMahasiswa->bukti_sipsmart as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.prestasiMahasiswa.fields.no_wa') }}
                        </th>
                        <td>
                            {{ $prestasiMahasiswa->no_wa }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.prestasi-mahasiswas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#prestasi_mahasiswa_prestasi_mahasiswa_details" role="tab" data-toggle="tab">
                {{ trans('cruds.prestasiMahasiswaDetail.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="prestasi_mahasiswa_prestasi_mahasiswa_details">
            @includeIf('admin.prestasiMahasiswas.relationships.prestasiMahasiswaPrestasiMahasiswaDetails', ['prestasiMahasiswaDetails' => $prestasiMahasiswa->pesertas])
        </div>
    </div>
</div>

<!-- Validation Confirmation Modal -->
<div class="modal fade" id="validateModal" tabindex="-1" role="dialog" aria-labelledby="validateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="validateModalLabel">
                    <i class="fas fa-check text-success"></i> Validasi Prestasi Mahasiswa
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="validateForm" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="alert alert-success">
                        <i class="fas fa-info-circle"></i> 
                        Apakah Anda yakin ingin memvalidasi prestasi mahasiswa ini? 
                        Status akan berubah menjadi "Tervalidasi".
                    </div>
                    <div class="form-group">
                        <label for="validation_notes_approve">
                            <i class="fas fa-comment"></i> Catatan Validasi (Opsional)
                        </label>
                        <textarea class="form-control" id="validation_notes_approve" name="validation_notes" rows="3" 
                                  placeholder="Berikan catatan validasi (opsional)..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-check"></i> Validasi Prestasi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rejectModalLabel">
                    <i class="fas fa-times-circle text-danger"></i> Tolak Prestasi Mahasiswa
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="rejectForm" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="validation_notes">
                            <i class="fas fa-comment"></i> Alasan Penolakan <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control" id="validation_notes" name="validation_notes" rows="4" 
                                  placeholder="Berikan alasan mengapa prestasi ini ditolak..." required></textarea>
                        <small class="form-text text-muted">
                            Catatan ini akan dikirim ke mahasiswa sehingga mereka dapat memperbaiki submission mereka.
                        </small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-times-circle"></i> Tolak Prestasi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
@parent
<script>
$(function () {
  // Handle validation
  $(document).on('click', '.btn-validate', function() {
    const prestasiId = $(this).data('id');
    const prestasiName = $(this).data('name');
    
    $('#validateForm').attr('action', '/admin/prestasi-mahasiswas/' + prestasiId + '/approved');
    $('#validateModalLabel').html('<i class="fas fa-check text-success"></i> Validasi Prestasi: ' + prestasiName);
    $('#validation_notes_approve').val(''); // Clear previous notes
    $('#validateModal').modal('show');
  });

  // Handle rejection
  $(document).on('click', '.btn-reject', function() {
    const prestasiId = $(this).data('id');
    const prestasiName = $(this).data('name');
    
    $('#rejectForm').attr('action', '/admin/prestasi-mahasiswas/' + prestasiId + '/reject');
    $('#rejectModalLabel').html('<i class="fas fa-times-circle text-danger"></i> Tolak Prestasi: ' + prestasiName);
    $('#validation_notes').val(''); // Clear previous notes
    $('#rejectModal').modal('show');
  });

  // Handle form submissions
  $('#validateForm').on('submit', function(e) {
    e.preventDefault();
    
    $.ajax({
      url: $(this).attr('action'),
      method: 'POST',
      data: $(this).serialize() + '&_method=PATCH',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(response) {
        $('#validateModal').modal('hide');
        if (response.success) {
          // Show success message and reload page
          alert(response.message);
          location.reload();
        }
      },
      error: function(xhr) {
        $('#validateModal').modal('hide');
        alert('Gagal memvalidasi prestasi. Silakan coba lagi.');
      }
    });
  });

  $('#rejectForm').on('submit', function(e) {
    e.preventDefault();
    
    if (!$('#validation_notes').val().trim()) {
      alert('Alasan penolakan harus diisi!');
      return;
    }
    
    $.ajax({
      url: $(this).attr('action'),
      method: 'POST',
      data: $(this).serialize() + '&_method=PATCH',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function(response) {
        $('#rejectModal').modal('hide');
        if (response.success) {
          // Show success message and reload page
          alert(response.message);
          location.reload();
        }
      },
      error: function(xhr) {
        $('#rejectModal').modal('hide');
        alert('Gagal menolak prestasi. Silakan coba lagi.');
      }
    });
  });
});
</script>
@endsection
