@extends('layouts.admin')
@section('content')
@can('prestasi_mahasiswa_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.prestasi-mahasiswas.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.prestasiMahasiswa.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<!-- Success/Error Messages -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="card">
    <div class="card-header">
        {{ trans('cruds.prestasiMahasiswa.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.prestasi-mahasiswas.export") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Export Prestasi Mahasiswa</label>

                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="far fa-calendar-alt"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control float-right" name="date" id="date" value="">
                </div>
                <!-- /.input group -->
            </div>
            <div class="form-group">
                <button class="btn btn-warning" type="submit">
                    Export
                </button>
            </div>
        </form>
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-PrestasiMahasiswa">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.prestasiMahasiswa.fields.nama_kegiatan') }}
                    </th>
                    <th>
                        {{ trans('cruds.prestasiMahasiswa.fields.tingkat') }}
                    </th>
                    <th>
                        {{ trans('cruds.prestasiMahasiswa.fields.kategori') }}
                    </th>
                    <th>
                        {{ trans('cruds.prestasiMahasiswa.fields.perolehan_juara') }}
                    </th>
                    <th>
                        {{ trans('cruds.prestasiMahasiswa.fields.nama_penyelenggara') }}
                    </th>
                    <th>
                        {{ trans('cruds.prestasiMahasiswa.fields.tempat_penyelenggara') }}
                    </th>
                    <th>
                        No WA
                    </th>
                    <th>
                        {{ trans('cruds.prestasiMahasiswa.fields.keikutsertaan') }}
                    </th>
                    <th>
                        {{ trans('cruds.prestasiMahasiswa.fields.dosen_pembimbing') ?? 'Dosen Pembimbing' }}
                    </th>
                    <th>
                        {{ trans('cruds.prestasiMahasiswa.fields.url_publikasi') }}
                    </th>
                    <th>
                        Status Approval
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>
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

@endsection
@section('scripts')
@parent
<script>
$(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.prestasi-mahasiswas.index') }}",
    columns: [
        { data: 'placeholder', name: 'placeholder' },
        { data: 'nama_kegiatan', name: 'nama_kegiatan', class : 'text-center' },
        { data: 'tingkat', name: 'tingkat', class : 'text-center' },
        { data: 'kategori_name', name: 'kategori.name', class : 'text-center' },
        { data: 'perolehan_juara', name: 'perolehan_juara', class : 'text-center' },
        { data: 'nama_penyelenggara', name: 'nama_penyelenggara', class : 'text-center' },
        { data: 'tempat_penyelenggara', name: 'tempat_penyelenggara', class : 'text-center' },
        { data: 'no_wa', name: 'no_wa', class : 'text-center' },
        { data: 'keikutsertaan', name: 'keikutsertaan', class : 'text-center' },
        { data: 'dosen_pembimbing', name: 'dosen_pembimbing', class : 'text-center' },
        { data: 'url_publikasi', name: 'url_publikasi', class : 'text-center' },
        { data: 'approval_status', name: 'approval_status', class : 'text-center' },
        { data: 'actions', name: '{{ trans('global.actions') }}', class : 'text-center' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 50,
  };
  let table = $('.datatable-PrestasiMahasiswa').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

  $('#date').daterangepicker({
    locale: {
      format: 'YYYY-MM-DD'
    },
  });

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
  $(document).on('click', '.btn-reject-validation', function() {
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
          // Show success message
          $('body').prepend(`
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <i class="fas fa-check-circle"></i> ${response.message}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          `);
          
          // Refresh table
          table.ajax.reload();
          
          // Auto-hide alert after 5 seconds
          setTimeout(function() {
            $('.alert-success').fadeOut();
          }, 5000);
        }
      },
      error: function(xhr) {
        $('#validateModal').modal('hide');
        $('body').prepend(`
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle"></i> Gagal memvalidasi prestasi. Silakan coba lagi.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        `);
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
          // Show success message
          $('body').prepend(`
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <i class="fas fa-check-circle"></i> ${response.message}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          `);
          
          // Refresh table
          table.ajax.reload();
          
          // Auto-hide alert after 5 seconds
          setTimeout(function() {
            $('.alert-success').fadeOut();
          }, 5000);
        }
      },
      error: function(xhr) {
        $('#rejectModal').modal('hide');
        $('body').prepend(`
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle"></i> Gagal menolak prestasi. Silakan coba lagi.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        `);
      }
    });
  });
});
</script>
@endsection
