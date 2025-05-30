@extends('layouts.frontend')
@section('content')
<style>
    .magang-card {
        transition: transform 0.3s, box-shadow 0.3s;
        height: 100%;
    }
    .magang-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .card-header-custom {
        background-color: #f8f9fa;
        border-bottom: 1px solid rgba(0,0,0,0.125);
        padding: 0.75rem 1.25rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .card-badge {
        font-size: 85%;
        padding: 0.25em 0.5em;
        margin-right: 0.25rem;
    }
    .btn-action-icon {
        width: 30px;
        height: 30px;
        padding: 0;
        line-height: 30px;
        text-align: center;
        border-radius: 50%;
    }
    .card-footer-custom {
        background-color: #fff;
        border-top: 1px solid rgba(0,0,0,0.125);
        padding: 0.75rem;
    }
    .card-text-muted {
        color: #6c757d;
        font-size: 0.9rem;
    }
    .card-info-row {
        margin-bottom: 0.5rem;
        display: flex;
        flex-wrap: wrap;
    }
    .card-info-label {
        font-weight: bold;
        margin-right: 0.5rem;
        min-width: 100px;
    }
    .action-buttons {
        margin-bottom: 25px;
    }
    .action-buttons .btn {
        margin-right: 10px;
        margin-bottom: 10px;
        padding: 8px 16px;
        border-radius: 8px;
        transition: all 0.3s;
        font-weight: 500;
        box-shadow: 0 2px 5px rgba(0,0,0,0.08);
        display: inline-flex;
        align-items: center;
    }
    .action-buttons .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }
    .action-buttons .btn i {
        margin-right: 8px;
    }
    .btn-success {
        background: linear-gradient(45deg, #28a745, #20c997);
        border-color: #28a745;
    }
    .btn-primary {
        background: linear-gradient(45deg, #007bff, #6610f2);
        border-color: #007bff;
    }
    .btn-info {
        background: linear-gradient(45deg, #17a2b8, #138496);
        border-color: #17a2b8;
    }
    .btn-secondary {
        background: linear-gradient(45deg, #6c757d, #5a6268);
        border-color: #6c757d;
    }
    .card-action-wrapper {
        position: absolute;
        top: 15px;
        right: 15px;
        z-index: 10;
    }
    .card-action-btn {
        padding: 6px 14px;
        border-radius: 6px;
        font-weight: 500;
        box-shadow: 0 2px 4px rgba(0,0,0,0.08);
        transition: all 0.3s;
    }
    .card-action-btn.btn-rounded {
        border-radius: 20px;
        padding: 10px 20px;
        background: linear-gradient(45deg, #007bff, #0056b3);
        border: none;
        font-size: 0.95rem;
    }
    .card-action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }
    .dropdown-menu {
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        border: none;
        padding: 8px 0;
    }
    .dropdown-item {
        padding: 8px 16px;
        transition: background-color 0.2s;
    }
    .dropdown-item:hover {
        background-color: rgba(0,123,255,0.1);
    }
    .dropdown-item i {
        margin-right: 8px;
        width: 16px;
        text-align: center;
    }
    .dropdown-divider {
        margin: 4px 0;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('mahasiswa_magang_create')
                <div class="action-buttons">
                        <a class="btn btn-success" href="{{ route('frontend.mahasiswa-magangs.create') }}">
                        <i class="fas fa-plus-circle"></i> {{ trans('global.add') }} {{ trans('cruds.mahasiswaMagang.title_singular') }}
                        </a>
                        <a class="btn btn-primary" href="{{ route('magang') }}">
                        <i class="fas fa-clipboard-list"></i> Apply for Internship
                        </a>
                        <a class="btn btn-info" href="{{ route('frontend.mahasiswa-magangs.create') }}">
                        <i class="fas fa-file-signature"></i> Direct Internship Application
                        </a>
                        <a class="btn btn-secondary" href="{{ route('frontend.test-magangs.index') }}">
                        <i class="fas fa-chart-bar"></i> My Test Results
                        </a>
                </div>
            @endcan
            
            <div class="card mb-4">
                <div class="card-header">
                    {{ trans('cruds.mahasiswaMagang.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="row">
                                @foreach($mahasiswaMagangs as $key => $mahasiswaMagang)
                            <div class="col-12 mb-4">
                                <div class="card magang-card h-100 border-0 shadow-sm">
                                    <div class="card-header-custom">
                                        <h5 class="card-title mb-0">{{ $mahasiswaMagang->nama ?? '' }}</h5>
                                        <span class="badge badge-{{ $mahasiswaMagang->approve == 'APPROVED' ? 'success' : ($mahasiswaMagang->approve == 'REJECTED' ? 'danger' : 'warning') }}">
                                            {{ App\Models\MahasiswaMagang::APPROVE_SELECT[$mahasiswaMagang->approve] ?? '' }}
                                        </span>
                                    </div>
                                    
                                    <div class="card-body">
                                        <div class="row">
                                            <!-- Information Column -->
                                            <div class="col-md-6">
                                                <h6 class="font-weight-bold mb-3">Internship Information</h6>
                                                <div class="card-info-row">
                                                    <span class="card-info-label">{{ trans('cruds.mahasiswaMagang.fields.mahasiswa') }}:</span>
                                                    <span>{{ $mahasiswaMagang->mahasiswa->name ?? '' }}</span>
                                                </div>
                                                
                                                <div class="card-info-row">
                                                    <span class="card-info-label">{{ trans('cruds.mahasiswaMagang.fields.semester') }}:</span>
                                                    <span>{{ $mahasiswaMagang->semester ?? '' }}</span>
                                                </div>
                                                
                                                <div class="card-info-row">
                                                    <span class="card-info-label">{{ trans('cruds.mahasiswaMagang.fields.type') }}:</span>
                                                    <span>{{ App\Models\MahasiswaMagang::TYPE_SELECT[$mahasiswaMagang->type] ?? '' }}</span>
                                                </div>
                                                
                                                <div class="card-info-row">
                                                    <span class="card-info-label">{{ trans('cruds.mahasiswaMagang.fields.magang') }}:</span>
                                                    <span>{{ $mahasiswaMagang->magang->name ?? '' }}</span>
                                                </div>
                                                
                                                <div class="card-info-row">
                                                    <span class="card-info-label">{{ trans('cruds.mahasiswaMagang.fields.instansi') }}:</span>
                                                    <span>{{ $mahasiswaMagang->instansi ?? '' }}</span>
                                                </div>
                                            </div>
                                            
                                            <!-- Status Checklist Column -->
                                            <div class="col-md-6">
                                                <h6 class="font-weight-bold mb-3">Status</h6>
                                                
                                                <div class="card-info-row">
                                                    <span class="card-info-label">Approval:</span>
                                                    <span class="badge badge-{{ $mahasiswaMagang->approve == 'APPROVED' ? 'success' : ($mahasiswaMagang->approve == 'REJECTED' ? 'danger' : 'warning') }}">
                                                        {{ App\Models\MahasiswaMagang::APPROVE_SELECT[$mahasiswaMagang->approve] ?? '' }}
                                                    </span>
                                                    @if($mahasiswaMagang->approval_notes)
                                                        <button type="button" class="btn btn-sm btn-link ml-2 p-0" data-toggle="modal" data-target="#approvalNotesModal-{{ $mahasiswaMagang->id }}">
                                                            <i class="fas fa-comment"></i> View Notes
                                                        </button>
                                                    @endif
                                                </div>
                                                
                                                <div class="card-info-row">
                                                    <span class="card-info-label">Verification:</span>
                                                    <span class="badge badge-{{ $mahasiswaMagang->verified == 'APPROVED' ? 'success' : ($mahasiswaMagang->verified == 'REJECTED' ? 'danger' : 'warning') }}">
                                                        {{ App\Models\MahasiswaMagang::VERIFIED_SELECT[$mahasiswaMagang->verified] ?? '' }}
                                                    </span>
                                                    @if($mahasiswaMagang->verification_notes && $mahasiswaMagang->mahasiswa_id === auth()->id())
                                                        <button type="button" class="btn btn-sm btn-link ml-2 p-0" data-toggle="modal" data-target="#verificationNotesModal-{{ $mahasiswaMagang->id }}">
                                                            <i class="fas fa-comment"></i> View Notes
                                                        </button>
                                                    @endif
                                                </div>
                                                
                                                <div class="card-info-row">
                                                    <span class="card-info-label">Tests:</span>
                                                    <div>
                                                        <span class="badge badge-{{ $mahasiswaMagang->pretest ? 'success' : 'secondary' }} mr-1">
                                                            Pretest: {{ $mahasiswaMagang->pretest ? 'Completed' : 'Pending' }}
                                                        </span>
                                                        <span class="badge badge-{{ $mahasiswaMagang->posttest ? 'success' : 'secondary' }}">
                                                Posttest: {{ $mahasiswaMagang->posttest ? 'Completed' : 'Pending' }}
                                                        </span>
                                                    </div>
                                            </div>
                                                
                                                @if(count($mahasiswaMagang->berkas_magang) > 0)
                                                <div class="card-info-row">
                                                    <span class="card-info-label">{{ trans('cruds.mahasiswaMagang.fields.berkas_magang') }}:</span>
                                                    <div>
                                            @foreach($mahasiswaMagang->berkas_magang as $key => $media)
                                                            <a href="{{ $media->getUrl() }}" target="_blank" class="badge badge-info mb-1 mr-1">
                                                                <i class="fas fa-file-alt"></i> File {{ $key + 1 }}
                                                </a>
                                            @endforeach
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer-custom">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="dropdown">
                                              <button class="btn btn-primary dropdown-toggle card-action-btn btn-rounded" type="button" id="actionDropdown-{{ $mahasiswaMagang->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-cogs"></i> Actions
                                              </button>
                                              <div class="dropdown-menu" aria-labelledby="actionDropdown-{{ $mahasiswaMagang->id }}">
                                                <!-- Basic Actions -->
                                                @can('mahasiswa_magang_show')
                                                    <a class="dropdown-item" href="{{ route('frontend.mahasiswa-magangs.show', $mahasiswaMagang->id) }}">
                                                        <i class="fas fa-eye text-primary"></i> {{ trans('global.view') }}
                                                    </a>
                                                @endcan

                                                @can('mahasiswa_magang_edit')
                                                    <a class="dropdown-item" href="{{ route('frontend.mahasiswa-magangs.edit', $mahasiswaMagang->id) }}">
                                                        <i class="fas fa-edit text-info"></i> {{ trans('global.edit') }}
                                                    </a>
                                                @endcan

                                                @if($mahasiswaMagang->approve === 'REJECTED' && $mahasiswaMagang->mahasiswa_id === auth()->id())
                                                    <a class="dropdown-item" href="{{ route('frontend.mahasiswa-magangs.resubmit', $mahasiswaMagang->id) }}">
                                                        <i class="fas fa-redo text-warning"></i> Resubmit Files
                                                    </a>
                                                @endif

                                                @if($mahasiswaMagang->verification_notes && $mahasiswaMagang->mahasiswa_id === auth()->id())
                                                    <button type="button" class="dropdown-item" data-toggle="modal" data-target="#verificationNotesModal-{{ $mahasiswaMagang->id }}">
                                                        <i class="fas fa-comment text-info"></i> View Admin Notes
                                                    </button>
                                                @endif
                                                
                                                <div class="dropdown-divider"></div>
                                                
                                                <!-- Test Actions -->
                                                @if($mahasiswaMagang->approve === 'APPROVED' && !$mahasiswaMagang->pretest && $mahasiswaMagang->mahasiswa_id === auth()->id())
                                                    <a class="dropdown-item" href="/mahasiswa-magang/{{ $mahasiswaMagang->id }}/test/PRETEST">
                                                        <i class="fas fa-clipboard-list text-info"></i> Take Pre-Test
                                                    </a>
                                                @endif

                                                @if($mahasiswaMagang->approve === 'APPROVED' && $mahasiswaMagang->pretest && !$mahasiswaMagang->posttest && $mahasiswaMagang->mahasiswa_id === auth()->id())
                                                    <a class="dropdown-item" href="/mahasiswa-magang/{{ $mahasiswaMagang->id }}/test/POSTTEST">
                                                        <i class="fas fa-clipboard-check text-success"></i> Take Post-Test
                                                    </a>
                                                @endif
                                                
                                                <div class="dropdown-divider"></div>

                                                <!-- Monitoring Actions -->
                                                @if($mahasiswaMagang->approve === 'APPROVED' && $mahasiswaMagang->mahasiswa_id === auth()->id())
                                                    <a class="dropdown-item" href="{{ route('frontend.monitoring-magangs.create', ['magang_id' => $mahasiswaMagang->id]) }}">
                                                        <i class="fas fa-file-upload text-info"></i> Upload Monitoring
                                                    </a>
                                                    <a class="dropdown-item" href="{{ route('frontend.monitoring-magangs.index', ['magang_id' => $mahasiswaMagang->id]) }}">
                                                        <i class="fas fa-list text-secondary"></i> View Monitoring
                                                    </a>
                                                
                                                    <!-- Document Actions -->
                                                    <a class="dropdown-item" href="{{ route('frontend.mahasiswa-magangs.upload-final-documents', $mahasiswaMagang->id) }}">
                                                        <i class="fas fa-file-archive text-success"></i> Upload Final Documents
                                                    </a>
                                                @endif
                                                
                                                @if($mahasiswaMagang->verified === 'APPROVED' && $mahasiswaMagang->mahasiswa_id === auth()->id())
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="{{ route('admin.mahasiswa-magangs.generate-certificate', $mahasiswaMagang->id) }}" target="_blank">
                                                        <i class="fas fa-certificate text-warning"></i> View Certificate
                                                    </a>
                                                @endif

                                                @can('mahasiswa_magang_delete')
                                                    <div class="dropdown-divider"></div>
                                                    <form action="{{ route('frontend.mahasiswa-magangs.destroy', $mahasiswaMagang->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <button type="submit" class="dropdown-item text-danger">
                                                            <i class="fas fa-trash"></i> {{ trans('global.delete') }}
                                                        </button>
                                                    </form>
                                                @endcan
                                              </div>
                                            </div>
                                            <small class="text-muted">ID: {{ $mahasiswaMagang->id }}</small>
                                        </div>
                                    </div>
                                              </div>
                                            </div>

                                            <!-- Verification Notes Modal -->
                                            @if($mahasiswaMagang->verification_notes && $mahasiswaMagang->mahasiswa_id === auth()->id())
                                                <div class="modal fade" id="verificationNotesModal-{{ $mahasiswaMagang->id }}" tabindex="-1" role="dialog" aria-labelledby="verificationNotesModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="verificationNotesModalLabel">Verification Notes</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="p-3 bg-light border rounded">
                                                                    {{ $mahasiswaMagang->verification_notes }}
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                            <!-- Approval Notes Modal -->
                            @if($mahasiswaMagang->approval_notes)
                                <div class="modal fade" id="approvalNotesModal-{{ $mahasiswaMagang->id }}" tabindex="-1" role="dialog" aria-labelledby="approvalNotesModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="approvalNotesModalLabel">Approval Notes</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="p-3 bg-light border rounded">
                                                    {{ $mahasiswaMagang->approval_notes }}
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                                @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection