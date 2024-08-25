@php
    $totalPages = $paginator->lastPage();
    $currentPage = $paginator->currentPage();
    $pageLimit = 7; // Number of page links to show

    // Calculate the start and end page numbers
    $start = max(1, $currentPage - floor($pageLimit / 2));
    $end = min($totalPages, $start + $pageLimit - 1);

    // Adjust the start and end if there's not enough pages
    if ($end - $start + 1 < $pageLimit) {
        $start = max(1, $end - $pageLimit + 1);
    }
@endphp


@if ($totalPages > 1)
    <ul class="pagination job-pagination mb-0 justify-content-center">
        <!-- Previous Page Link -->
        <li class="page-item {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" tabindex="-1">
                <i class="mdi mdi-chevron-double-left fs-15"></i>
            </a>
        </li>

        <!-- Page Links -->
        @for ($i = $start; $i <= $end; $i++)
            <li class="page-item {{ $paginator->currentPage() == $i ? 'active' : '' }}">
                <a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
            </li>
        @endfor

        <!-- Next Page Link -->
        <li class="page-item {{ !$paginator->hasMorePages() ? 'disabled' : '' }}">
            <a class="page-link" href="{{ $paginator->nextPageUrl() }}">
                <i class="mdi mdi-chevron-double-right fs-15"></i>
            </a>
        </li>
    </ul>
@endif
