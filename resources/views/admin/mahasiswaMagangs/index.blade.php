@extends('layouts.admin')
@section('content')
@can('mahasiswa_magang_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.mahasiswa-magangs.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.mahasiswaMagang.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.mahasiswaMagang.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-MahasiswaMagang">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.mahasiswaMagang.fields.mahasiswa') }}
                    </th>
                    <th>
                        {{ trans('cruds.mahasiswaMagang.fields.nama') }}
                    </th>
                    <th>
                        {{ trans('cruds.mahasiswaMagang.fields.semester') }}
                    </th>
                    <th>
                        {{ trans('cruds.mahasiswaMagang.fields.type') }}
                    </th>
                    <th>
                        {{ trans('cruds.mahasiswaMagang.fields.magang') }}
                    </th>
                    <th>
                        {{ trans('cruds.mahasiswaMagang.fields.instansi') }}
                    </th>
                    <th>
                        {{ trans('cruds.mahasiswaMagang.fields.approve') }}
                    </th>
                    <th>
                        {{ trans('cruds.mahasiswaMagang.fields.dosen_pembimbing') }}
                    </th>
                    <th>
                        {{ trans('cruds.mahasiswaMagang.fields.berkas_magang') }}
                    </th>
                    <th>
                        {{ trans('cruds.mahasiswaMagang.fields.verified') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('mahasiswa_magang_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.mahasiswa-magangs.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.mahasiswa-magangs.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'mahasiswa_name', name: 'mahasiswa.name' },
{ data: 'nama', name: 'nama' },
{ data: 'semester', name: 'semester' },
{ data: 'type', name: 'type' },
{ data: 'magang_name', name: 'magang.name' },
{ data: 'instansi', name: 'instansi' },
{ data: 'approve', name: 'approve' },
{ data: 'dosen_pembimbing', name: 'dosen_pembimbing' },
{ data: 'berkas_magang', name: 'berkas_magang', sortable: false, searchable: false },
{ data: 'verified', name: 'verified' },
{ 
    data: 'actions', 
    name: '{{ trans('global.actions') }}',
    render: function (data, type, row) {
        return data;
    }
}
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 50,
  };
  let table = $('.datatable-MahasiswaMagang').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
  // Action buttons for approve/reject
  $(document).on('click', '.approve-btn', function() {
    let id = $(this).data('id');
    $('#approve-modal').modal('show');
    $('#approve-form').attr('action', '/admin/mahasiswa-magangs/' + id + '/approve');
  });
  
  $(document).on('click', '.reject-btn', function() {
    let id = $(this).data('id');
    if(confirm('Are you sure you want to reject this application?')) {
      $.ajax({
        url: '/admin/mahasiswa-magangs/' + id + '/reject',
        type: 'POST',
        headers: {'x-csrf-token': _token},
        success: function() {
          location.reload();
        }
      });
    }
  });
  
  $(document).on('click', '.verify-btn', function() {
    let id = $(this).data('id');
    if(confirm('Are you sure you want to verify this application?')) {
      window.location.href = '/admin/mahasiswa-magangs/' + id + '/verify';
    }
  });
});

</script>

<!-- Approve Modal -->
<div class="modal fade" id="approve-modal" tabindex="-1" role="dialog" aria-labelledby="approveModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="approveModalLabel">Approve Magang Application</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="approve-form" method="POST">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label for="dosen_pembimbing">Dosen Pembimbing</label>
            <input type="text" name="dosen_pembimbing" id="dosen_pembimbing" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Approve</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection