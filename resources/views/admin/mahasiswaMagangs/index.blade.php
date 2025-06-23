@extends('layouts.admin')
@section('content')
<style>
    .datatable-MahasiswaMagang tbody tr td {
        vertical-align: middle !important;
    }
    .datatable-MahasiswaMagang .dropdown-item {
        white-space: normal;
        padding: 0.5rem 1rem;
    }
    .datatable-MahasiswaMagang .dropdown-menu {
        max-width: 250px;
    }
    .datatable-MahasiswaMagang tbody tr:hover {
        background-color: rgba(0,0,0,0.02);
    }
</style>
@can('mahasiswa_magang_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.mahasiswa-magangs.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.mahasiswaMagang.title_singular') }}
            </a>
            <a class="btn btn-info ml-2" href="{{ route('admin.mahasiswa-magangs.dashboard') }}">
                <i class="fas fa-tachometer-alt"></i> Phase Dashboard
            </a>
            <button type="button" class="btn btn-warning ml-2" data-toggle="modal" data-target="#exportModal">
                <i class="fas fa-file-excel"></i> Export to Excel
            </button>
        </div>
    </div>
@endcan

<!-- Export Modal -->
<div class="modal fade" id="exportModal" tabindex="-1" role="dialog" aria-labelledby="exportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exportModalLabel">Export Mahasiswa Magang Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="GET" action="{{ route('admin.mahasiswa-magangs.export') }}">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="start_date">Start Date</label>
                                <input type="date" name="start_date" id="start_date" class="form-control" 
                                       value="{{ request('start_date') }}">
                                <small class="form-text text-muted">Leave empty to export from the beginning</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="end_date">End Date</label>
                                <input type="date" name="end_date" id="end_date" class="form-control"
                                       value="{{ request('end_date') }}">
                                <small class="form-text text-muted">Leave empty to export until now</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Quick Date Ranges</label>
                                <div class="btn-group d-block mb-3" role="group">
                                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="setDateRange('today')">Today</button>
                                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="setDateRange('week')">This Week</button>
                                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="setDateRange('month')">This Month</button>
                                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="setDateRange('year')">This Year</button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="clearDates()">Clear</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="date_field">Filter by Date Field</label>
                                <select name="date_field" id="date_field" class="form-control">
                                    <option value="created_at" {{ request('date_field') == 'created_at' ? 'selected' : '' }}>Application Date (Created At)</option>
                                    <option value="updated_at" {{ request('date_field') == 'updated_at' ? 'selected' : '' }}>Last Updated</option>
                                    <option value="pretest_completed_at" {{ request('date_field') == 'pretest_completed_at' ? 'selected' : '' }}>Pretest Completion Date</option>
                                    <option value="posttest_completed_at" {{ request('date_field') == 'posttest_completed_at' ? 'selected' : '' }}>Posttest Completion Date</option>
                                </select>
                                <small class="form-text text-muted">Choose which date field to filter by</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle"></i>
                                <strong>Export Options:</strong>
                                <ul class="mb-0 mt-2">
                                    <li>Select a date range to export specific period data</li>
                                    <li>Choose the date field to filter by (application date, updates, test completion, etc.)</li>
                                    <li>Leave dates empty to export all records</li>
                                    <li>Export includes all student information, status, and document details</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-download"></i> Export to Excel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
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
                        Current Phase
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
{ data: 'current_phase', name: 'current_phase', sortable: false, searchable: false },
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
  
  // Ensure events are bound after DataTable is fully loaded
  table.on('draw', function() {
    console.log('DataTable redrawn - events should be working');
  });
  
  // Action buttons for approve/reject - using event delegation for dynamically loaded content
  $(document).on('click', '.approve-btn', function(e) {
    e.preventDefault();
    let id = $(this).data('id');
    $('#approve-modal').modal('show');
    $('#approve-form').attr('action', '{{ route("admin.mahasiswa-magangs.approve", ":id") }}'.replace(':id', id));
  });
  
  $(document).on('click', '.reject-btn', function(e) {
    e.preventDefault();
    let id = $(this).data('id');
    if(confirm('Are you sure you want to reject this application?')) {
      $.ajax({
        url: '{{ route("admin.mahasiswa-magangs.reject", ":id") }}'.replace(':id', id),
        type: 'POST',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
          'Content-Type': 'application/json'
        },
        success: function(response) {
          location.reload();
        },
        error: function(xhr, status, error) {
          alert('Error: ' + error);
        }
      });
    }
  });
  
  $(document).on('click', '.verify-btn', function(e) {
    e.preventDefault();
    let id = $(this).data('id');
    window.location.href = '{{ route("admin.mahasiswa-magangs.verify-documents", ":id") }}'.replace(':id', id);
  });
});

// Export modal enhancements
$('#exportModal').on('shown.bs.modal', function () {
  // Set default end date to today if not set
  if (!$('#end_date').val()) {
    $('#end_date').val(new Date().toISOString().slice(0, 10));
  }
});

// Validate date range
$('#start_date, #end_date').on('change', function() {
  var startDate = $('#start_date').val();
  var endDate = $('#end_date').val();
  
  if (startDate && endDate && startDate > endDate) {
    alert('Start date cannot be after end date');
    $(this).val('');
  }
});

// Quick date range functions
function setDateRange(range) {
  var today = new Date();
  var startDate, endDate;
  
  switch(range) {
    case 'today':
      startDate = endDate = today.toISOString().slice(0, 10);
      break;
    case 'week':
      var firstDay = new Date(today.setDate(today.getDate() - today.getDay()));
      var lastDay = new Date(today.setDate(today.getDate() - today.getDay() + 6));
      startDate = firstDay.toISOString().slice(0, 10);
      endDate = lastDay.toISOString().slice(0, 10);
      break;
    case 'month':
      var firstDay = new Date(today.getFullYear(), today.getMonth(), 1);
      var lastDay = new Date(today.getFullYear(), today.getMonth() + 1, 0);
      startDate = firstDay.toISOString().slice(0, 10);
      endDate = lastDay.toISOString().slice(0, 10);
      break;
    case 'year':
      var firstDay = new Date(today.getFullYear(), 0, 1);
      var lastDay = new Date(today.getFullYear(), 11, 31);
      startDate = firstDay.toISOString().slice(0, 10);
      endDate = lastDay.toISOString().slice(0, 10);
      break;
  }
  
  $('#start_date').val(startDate);
  $('#end_date').val(endDate);
}

function clearDates() {
  $('#start_date').val('');
  $('#end_date').val('');
}

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