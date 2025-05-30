<div class="dropdown d-inline-block">
    <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton-{{ $row->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-cogs"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton-{{ $row->id }}">
        @can($viewGate)
            <a class="dropdown-item" href="{{ route('admin.' . $crudRoutePart . '.show', $row->id) }}">
                <i class="fas fa-eye text-primary"></i> {{ trans('global.view') }}
            </a>
        @endcan
        
        @can($editGate)
            <a class="dropdown-item" href="{{ route('admin.' . $crudRoutePart . '.edit', $row->id) }}">
                <i class="fas fa-edit text-info"></i> {{ trans('global.edit') }}
            </a>
        @endcan
        
        {{-- Add approve/reject buttons for pending applications --}}
        @if($row->approve === 'PENDING')
            <div class="dropdown-divider"></div>
            <button class="dropdown-item approve-btn" data-id="{{ $row->id }}">
                <i class="fas fa-check text-success"></i> Approve
            </button>
            <button class="dropdown-item reject-btn" data-id="{{ $row->id }}">
                <i class="fas fa-times text-danger"></i> Reject
            </button>
        @endif
        
        {{-- Add verify button for completed applications that need verification --}}
        @if($row->approve === 'APPROVED' && $row->verified === 'PENDING')
            <div class="dropdown-divider"></div>
            <button class="dropdown-item verify-btn" data-id="{{ $row->id }}">
                <i class="fas fa-check-circle text-primary"></i> Verify Documents
            </button>
        @endif
        
        {{-- Add certificate button for verified applications --}}
        @if($row->verified === 'APPROVED')
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('admin.mahasiswa-magangs.generate-certificate', $row->id) }}" target="_blank">
                <i class="fas fa-certificate text-warning"></i> Certificate
            </a>
        @endif
        
        @can($deleteGate)
            <div class="dropdown-divider"></div>
            <form action="{{ route('admin.' . $crudRoutePart . '.destroy', $row->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="dropdown-item text-danger">
                    <i class="fas fa-trash"></i> {{ trans('global.delete') }}
                </button>
            </form>
        @endcan
    </div>
</div> 