<div class="d-flex flex-wrap gap-1" style="gap: 0.25rem;">
    @can($viewGate)
        <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.' . $crudRoutePart . '.show', $row->id) }}" title="{{ trans('global.view') }}">
            <i class="fas fa-eye"></i>
        </a>
    @endcan
    
    @can($editGate)
        <a class="btn btn-sm btn-outline-info" href="{{ route('admin.' . $crudRoutePart . '.edit', $row->id) }}" title="{{ trans('global.edit') }}">
            <i class="fas fa-edit"></i>
        </a>
    @endcan
    
    {{-- Add approve/reject buttons for pending applications --}}
    @if($row->approve === 'PENDING')
        <button class="btn btn-sm btn-outline-success approve-btn" data-id="{{ $row->id }}" title="Approve">
            <i class="fas fa-check"></i>
        </button>
        <button class="btn btn-sm btn-outline-danger reject-btn" data-id="{{ $row->id }}" title="Reject">
            <i class="fas fa-times"></i>
        </button>
    @endif
    
    {{-- Add verify button for completed applications that need verification --}}
    @if($row->approve === 'APPROVED' && $row->verified === 'PENDING')
        <button class="btn btn-sm btn-outline-warning verify-btn" data-id="{{ $row->id }}" title="Verify Documents">
            <i class="fas fa-check-circle"></i>
        </button>
    @endif
    
    {{-- Add certificate button for verified applications --}}
    @if($row->verified === 'APPROVED')
        <a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.mahasiswa-magangs.generate-certificate', $row->id) }}" target="_blank" title="Certificate">
            <i class="fas fa-certificate"></i>
        </a>
    @endif
    
    @can($deleteGate)
        <form action="{{ route('admin.' . $crudRoutePart . '.destroy', $row->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" class="d-inline">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit" class="btn btn-sm btn-outline-danger" title="{{ trans('global.delete') }}">
                <i class="fas fa-trash"></i>
            </button>
        </form>
    @endcan
</div> 