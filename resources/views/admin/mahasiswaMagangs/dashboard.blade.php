@extends('layouts.admin')
@section('content')
<style>
    .stat-card {
        border-radius: 15px;
        transition: transform 0.2s ease-in-out;
        border: none;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
    }
    .stat-number {
        font-size: 2.5rem;
        font-weight: bold;
    }
    .phase-card {
        border-radius: 10px;
        margin-bottom: 1rem;
    }
    .student-item {
        padding: 0.75rem;
        margin-bottom: 0.5rem;
        border-radius: 8px;
        background-color: #f8f9fa;
        border-left: 4px solid #007bff;
    }
    .progress-indicator {
        height: 8px;
        border-radius: 4px;
        background-color: #e9ecef;
        margin-bottom: 1rem;
    }
    .progress-fill {
        height: 100%;
        border-radius: 4px;
        transition: width 0.3s ease;
    }
</style>

<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0">Student Internship Dashboard</h1>
            <div>
                <a href="{{ route('admin.mahasiswa-magangs.index') }}" class="btn btn-outline-primary">
                    <i class="fas fa-table"></i> View DataTable
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-5">
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card stat-card bg-warning text-white">
            <div class="card-body text-center">
                <div class="stat-number">{{ $stats['pending_applications'] }}</div>
                <p class="card-text mb-0"><i class="fas fa-clock"></i> Pending Applications</p>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card stat-card bg-primary text-white">
            <div class="card-body text-center">
                <div class="stat-number">{{ $stats['in_internship'] + $stats['awaiting_pretest'] }}</div>
                <p class="card-text mb-0"><i class="fas fa-user-graduate"></i> Active Students</p>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card stat-card bg-info text-white">
            <div class="card-body text-center">
                <div class="stat-number">{{ $stats['awaiting_verification'] }}</div>
                <p class="card-text mb-0"><i class="fas fa-file-check"></i> Awaiting Verification</p>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card stat-card bg-success text-white">
            <div class="card-body text-center">
                <div class="stat-number">{{ $stats['completed'] }}</div>
                <p class="card-text mb-0"><i class="fas fa-graduation-cap"></i> Completed</p>
            </div>
        </div>
    </div>
</div>

<!-- Progress Overview -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-chart-line"></i> Overall Progress</h5>
            </div>
            <div class="card-body">
                <div class="progress-indicator">
                    <div class="progress-fill bg-success" style="width: {{ $stats['total'] > 0 ? ($stats['completed'] / $stats['total']) * 100 : 0 }}%"></div>
                </div>
                <div class="row text-center">
                    <div class="col">
                        <small class="text-muted">Completion Rate</small><br>
                        <strong>{{ $stats['total'] > 0 ? round(($stats['completed'] / $stats['total']) * 100, 1) : 0 }}%</strong>
                    </div>
                    <div class="col">
                        <small class="text-muted">Total Students</small><br>
                        <strong>{{ $stats['total'] }}</strong>
                    </div>
                    <div class="col">
                        <small class="text-muted">Active Internships</small><br>
                        <strong>{{ $stats['in_internship'] }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Phase Breakdown -->
<div class="row">
    @foreach($studentsByPhase as $phase => $students)
        @if($students->count() > 0)
            <div class="col-lg-6 col-md-12 mb-4">
                <div class="card phase-card">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">
                            @if(str_contains($phase, 'Phase 1'))
                                <span class="badge badge-warning mr-2">{{ $students->count() }}</span>
                            @elseif(str_contains($phase, 'Rejected'))
                                <span class="badge badge-danger mr-2">{{ $students->count() }}</span>
                            @elseif(str_contains($phase, 'Phase 2'))
                                <span class="badge badge-info mr-2">{{ $students->count() }}</span>
                            @elseif(str_contains($phase, 'Phase 3'))
                                <span class="badge badge-primary mr-2">{{ $students->count() }}</span>
                            @elseif(str_contains($phase, 'Phase 4'))
                                <span class="badge badge-warning mr-2">{{ $students->count() }}</span>
                            @elseif(str_contains($phase, 'Completed'))
                                <span class="badge badge-success mr-2">{{ $students->count() }}</span>
                            @else
                                <span class="badge badge-secondary mr-2">{{ $students->count() }}</span>
                            @endif
                            {{ $phase }}
                        </h6>
                    </div>
                    <div class="card-body" style="max-height: 300px; overflow-y: auto;">
                        @foreach($students as $student)
                            <div class="student-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ $student->nama }}</strong>
                                        <small class="text-muted d-block">{{ $student->nim }} • {{ $student->instansi }}</small>
                                    </div>
                                    <div class="text-right">
                                        <a href="{{ route('admin.mahasiswa-magangs.show', $student->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @if(str_contains($phase, 'Phase 1') && $student->approve === 'PENDING')
                                            <button class="btn btn-sm btn-success approve-btn ml-1" data-id="{{ $student->id }}">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        @endif
                                        @if(str_contains($phase, 'Phase 4: Document Verification'))
                                            <a href="{{ route('admin.mahasiswa-magangs.verify-documents', $student->id) }}" class="btn btn-sm btn-warning ml-1">
                                                <i class="fas fa-file-check"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                @if(str_contains($phase, 'Phase 3') && $student->pretest)
                                    @php
                                        $monitoringCount = \App\Models\MonitoringMagang::where('magang_id', $student->id)->count();
                                    @endphp
                                    <div class="mt-2">
                                        <small class="text-info">
                                            <i class="fas fa-chart-line"></i> 
                                            Monitoring Reports: {{ $monitoringCount }}/1
                                        </small>
                                        @if($student->pretest_completed_at)
                                            @php
                                                $daysElapsed = now()->diffInDays($student->pretest_completed_at);
                                                $daysRemaining = max(0, 30 - $daysElapsed);
                                            @endphp
                                            <small class="text-primary ml-3">
                                                <i class="fas fa-calendar"></i>
                                                @if($daysRemaining > 0)
                                                    {{ $daysRemaining }} days until posttest
                                                @else
                                                    Posttest available
                                                @endif
                                            </small>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</div>

<!-- Quick Actions -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-bolt"></i> Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <a href="{{ route('admin.mahasiswa-magangs.index') }}?approve=PENDING" class="btn btn-warning btn-block">
                            <i class="fas fa-clock"></i> Review Pending Applications ({{ $stats['pending_applications'] }})
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('admin.mahasiswa-magangs.index') }}?verified=PENDING" class="btn btn-info btn-block">
                            <i class="fas fa-file-check"></i> Verify Documents ({{ $stats['awaiting_verification'] }})
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('admin.test-magangs.index') }}" class="btn btn-primary btn-block">
                            <i class="fas fa-clipboard-list"></i> View Test Results
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('admin.monitoring-magangs.index') }}" class="btn btn-secondary btn-block">
                            <i class="fas fa-chart-line"></i> Monitor Progress Reports
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Approve Modal -->
<div class="modal fade" id="approve-modal" tabindex="-1" role="dialog" aria-labelledby="approveModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="approveModalLabel">Approve Internship Application</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="approve-form" method="POST">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label for="dosen_pembimbing">Supervising Lecturer (Dosen Pembimbing)</label>
            <select name="dosen_pembimbing" id="dosen_pembimbing" class="form-control select2" required>
              @foreach($dospems as $id => $entry)
                <option value="{{ $id }}">{{ $entry }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success">Approve Application</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection

@section('scripts')
@parent
<script>
$(document).ready(function() {
    // Initialize select2
    $('.select2').select2({
        dropdownParent: $('#approve-modal'),
        placeholder: 'Select Supervising Lecturer',
        allowClear: true
    });

    // Approve button click handler
    $('.approve-btn').on('click', function() {
        let id = $(this).data('id');
        $('#approve-modal').modal('show');
        $('#approve-form').attr('action', '{{ route("admin.mahasiswa-magangs.approve", ":id") }}'.replace(':id', id));
    });
    
    // Auto-refresh every 30 seconds
    setTimeout(function() {
        location.reload();
    }, 30000);
});
</script>
@endsection 