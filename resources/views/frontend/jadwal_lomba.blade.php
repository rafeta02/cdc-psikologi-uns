@extends('layouts.jobcy')

@section('title', 'Jadwal Lomba - Career Development Center Fakultas Psikologi UNS')

@section('content')
    <!-- Start home -->
    <section class="page-title-box">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="text-center text-white">
                        <h3 class="mb-4">Jadwal Lomba</h3>
                        <div class="page-next">
                            <nav class="d-inline-block" aria-label="breadcrumb text-center">
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Jadwal Lomba</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>
    <!-- end home -->

    <!-- START SHAPE -->
    <div class="position-relative" style="z-index: 1">
        <div class="shape">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 250">
                <path fill="" fill-opacity="1"
                    d="M0,192L120,202.7C240,213,480,235,720,234.7C960,235,1200,213,1320,202.7L1440,192L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z"></path>
            </svg>
        </div>
    </div>
    <!-- END SHAPE -->

    <!-- START JADWAL-LOMBA -->
    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="text-center mb-5">
                        <h2 class="mb-3">Jadwal Lomba</h2>
                        <p class="text-muted fs-17 para-desc">Temukan berbagai lomba dan kompetisi yang tersedia untuk mahasiswa</p>
                    </div>

                    <!-- Filter Section -->
                    <div class="card job-box mt-4">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h6 class="fs-17 mb-0">Filter Berdasarkan Tingkat:</h6>
                                <!-- View Toggle -->
                                <div class="btn-group" role="group" aria-label="View toggle">
                                    <button type="button" class="btn btn-outline-primary active" id="calendarViewBtn" onclick="switchView('calendar')">
                                        <i class="uil uil-calendar-alt me-1"></i> Calendar
                                    </button>
                                    <button type="button" class="btn btn-outline-primary" id="listViewBtn" onclick="switchView('list')">
                                        <i class="uil uil-list-ul me-1"></i> List
                                    </button>
                                </div>
                            </div>
                            
                            <div class="row">
                                <!-- All Types Card -->
                                <div class="col-lg-2 col-md-4 col-6 mb-3">
                                    <div class="filter-card active" data-type="" onclick="selectFilter(this, '')">
                                        <div class="card h-100 border-2 cursor-pointer filter-option-card">
                                            <div class="card-body text-center p-3">
                                                <div class="filter-icon mb-2">
                                                    <i class="uil uil-list-ul icon-size text-primary"></i>
                                                </div>
                                                <h6 class="fs-15 mb-1">Semua</h6>
                                                <small class="text-muted fs                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 wwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww    w   wSs-14">Tingkat</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Lokal Card -->
                                <div class="col-lg-2 col-md-4 col-6 mb-3">
                                    <div class="filter-card" data-type="lokal" onclick="selectFilter(this, 'lokal')">
                                        <div class="card h-100 border-2 cursor-pointer filter-option-card">
                                            <div class="card-body text-center p-3">
                                                <div class="filter-icon mb-2">
                                                    <i class="uil uil-home icon-size text-success"></i>
                                                </div>
                                                <small class="text-muted fs-14">Tingkat</small>
                                                <h6 class="fs-15 mb-1">Lokal</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Regional Card -->
                                <div class="col-lg-2 col-md-4 col-6 mb-3">
                                    <div class="filter-card" data-type="wilayah" onclick="selectFilter(this, 'wilayah')">
                                        <div class="card h-100 border-2 cursor-pointer filter-option-card">
                                            <div class="card-body text-center p-3">
                                                <div class="filter-icon mb-2">
                                                    <i class="uil uil-map-marker icon-size text-info"></i>
                                                </div>
                                                <small class="text-muted fs-14">Tingkat</small>
                                                <h6 class="fs-15 mb-1">Wilayah</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- National Card -->
                                <div class="col-lg-2 col-md-4 col-6 mb-3">
                                    <div class="filter-card" data-type="nasional" onclick="selectFilter(this, 'nasional')">
                                        <div class="card h-100 border-2 cursor-pointer filter-option-card">
                                            <div class="card-body text-center p-3">
                                                <div class="filter-icon mb-2">
                                                    <i class="uil uil-shield icon-size text-warning"></i>
                                                </div>
                                                <small class="text-muted fs-14">Tingkat</small>
                                                <h6 class="fs-15 mb-1">Nasional</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- International Card -->
                                <div class="col-lg-2 col-md-4 col-6 mb-3">
                                    <div class="filter-card" data-type="internasional" onclick="selectFilter(this, 'internasional')">
                                        <div class="card h-100 border-2 cursor-pointer filter-option-card">
                                            <div class="card-body text-center p-3">
                                                <div class="filter-icon mb-2">
                                                    <i class="uil uil-globe icon-size text-danger"></i>
                                                </div>
                                                <small class="text-muted fs-14">Tingkat</small>
                                                <h6 class="fs-14 mb-1">Internasional</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Pendampingan Card -->
                                <div class="col-lg-2 col-md-4 col-6 mb-3">
                                    <div class="filter-card" data-type="pendampingan" onclick="selectFilter(this, 'pendampingan')">
                                        <div class="card h-100 border-2 cursor-pointer filter-option-card">
                                            <div class="card-body text-center p-3">
                                                <div class="filter-icon mb-2">
                                                    <i class="uil uil-users-alt icon-size text-purple"></i>
                                                </div>
                                                <small class="text-muted fs-12">Pendampingan</small>
                                                <h6 class="fs-15 mb-1">Lomba</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Legend -->
                            <div class="row mt-3">
                                <div class="col-12">
                                    <div class="d-flex flex-wrap gap-2 justify-content-center">
                                        <span class="badge bg-success-subtle text-success d-flex align-items-center">
                                            <span class="me-1">●</span> Lokal
                                        </span>
                                        <span class="badge bg-info-subtle text-info d-flex align-items-center">
                                            <span class="me-1">●</span> Wilayah
                                        </span>
                                        <span class="badge bg-warning-subtle text-warning d-flex align-items-center">
                                            <span class="me-1">●</span> Nasional
                                        </span>
                                        <span class="badge bg-danger-subtle text-danger d-flex align-items-center">
                                            <span class="me-1">●</span> Internasional
                                        </span>
                                        <span class="badge bg-purple-subtle text-purple d-flex align-items-center">
                                            <span class="me-1">●</span> Pendampingan Lomba
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Calendar Container -->
                    <div class="card job-box mt-4" id="calendarContainer">
                        <div class="card-body p-4">
                            <div id="calendar"></div>
                        </div>
                    </div>

                    <!-- List Container -->
                    <div class="card job-box mt-4" id="listContainer" style="display: none;">
                        <div class="card-header">
                            <h5 class="fs-17 mb-0">
                                <i class="uil uil-list-ul me-2"></i>Daftar Lomba
                                <span class="badge bg-primary ms-2" id="contestCount">0</span>
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div id="contestList">
                                <!-- Contest list will be populated here -->
                            </div>
                            <div id="listLoading" class="text-center py-5" style="display: none;">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <p class="mt-2 text-muted">Memuat data lomba...</p>
                            </div>
                            <div id="noContests" class="text-center py-5" style="display: none;">
                                <i class="uil uil-info-circle" style="font-size: 48px;" class="text-muted mb-3"></i>
                                <h5 class="text-muted">Tidak ada lomba ditemukan</h5>
                                <p class="text-muted">Coba ubah filter atau pilih kategori lain</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END JADWAL-LOMBA -->

<!-- Event Detail Modal -->
<div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fs-17" id="eventModalLabel">Detail Lomba</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="eventDetails">
                    <!-- Event details will be populated here -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <a href="#" id="eventLink" class="btn btn-primary" target="_blank" style="display: none;">Kunjungi Link</a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<!-- FullCalendar CSS -->
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css" rel="stylesheet">
<style>
    .fc-event {
        cursor: pointer;
    }
    
    .fc-event:hover {
        opacity: 0.8;
    }
    
    .event-lokal {
        background-color: #28a745 !important;
        border-color: #28a745 !important;
    }
    
    .event-wilayah {
        background-color: #17a2b8 !important;
        border-color: #17a2b8 !important;
    }
    
    .event-nasional {
        background-color: #ffc107 !important;
        border-color: #ffc107 !important;
        color: #000 !important;
    }
    
    .event-internasional {
        background-color: #dc3545 !important;
        border-color: #dc3545 !important;
    }
    
    .event-pendampingan {
        background-color: #6f42c1 !important;
        border-color: #6f42c1 !important;
    }
    
    .fc-toolbar-title {
        font-size: 1.5rem !important;
        font-weight: 600 !important;
    }
    
    .fc-button {
        background-color: #0d6efd !important;
        border-color: #0d6efd !important;
    }
    
    .fc-button:hover {
        background-color: #0b5ed7 !important;
        border-color: #0a58ca !important;
    }

    /* Filter Card Styles */
    .filter-card {
        transition: all 0.3s ease;
    }

    .filter-option-card {
        transition: all 0.3s ease;
        border-color: #dee2e6 !important;
    }

    .filter-card:hover .filter-option-card {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        border-color: #007bff !important;
    }

    .filter-card.active .filter-option-card {
        border-color: #007bff !important;
        background-color: #f8f9ff;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,123,255,0.2);
    }

    .filter-card.active h6 {
        color: #007bff !important;
        font-weight: 600;
    }

    .filter-card.active .filter-icon i {
        color: #007bff !important;
    }

    .cursor-pointer {
        cursor: pointer;
    }

    .filter-icon {
        transition: all 0.3s ease;
    }

    .filter-card:hover .filter-icon {
        transform: scale(1.1);
    }

    .filter-card.active .filter-icon {
        transform: scale(1.1);
    }

    .icon-size {
        font-size: 2rem;
    }

    /* List View Styles */
    .contest-item {
        transition: all 0.3s ease;
        border-left: 4px solid transparent;
        border-radius: 8px;
    }

    .contest-item:hover {
        background-color: #f8f9fa;
        border-left-color: #007bff;
        transform: translateX(5px);
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .contest-item.lokal {
        border-left-color: #28a745;
    }

    .contest-item.wilayah {
        border-left-color: #17a2b8;
    }

    .contest-item.nasional {
        border-left-color: #ffc107;
    }

    .contest-item.internasional {
        border-left-color: #dc3545;
    }

    .contest-item.pendampingan {
        border-left-color: #6f42c1;
    }

    .contest-date {
        min-width: 80px;
    }

    .contest-type-icon {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        color: white;
        margin-right: 8px;
        font-weight: 600;
    }

    .contest-type-icon.lokal {
        background-color: #28a745;
    }

    .contest-type-icon.wilayah {
        background-color: #17a2b8;
    }

    .contest-type-icon.nasional {
        background-color: #ffc107;
        color: #000;
    }

    .contest-type-icon.internasional {
        background-color: #dc3545;
    }

    .contest-type-icon.pendampingan {
        background-color: #6f42c1;
    }

    .job-box {
        border: 1px solid #e9ecef;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .job-box:hover {
        box-shadow: 0 8px 30px rgba(0,0,0,0.1);
        transform: translateY(-2px);
    }

    @media (max-width: 768px) {
        .filter-card .card-body {
            padding: 1rem !important;
        }
        
        .icon-size {
            font-size: 1.5rem !important;
        }

        .contest-item .col-md-2 {
            margin-bottom: 0.5rem;
        }
    }

    /* Purple color classes */
    .text-purple {
        color: #6f42c1 !important;
    }

    .bg-purple-subtle {
        background-color: rgba(111, 66, 193, 0.1) !important;
    }

    .text-purple {
        color: #6f42c1 !important;
    }
</style>
@endsection

@section('scripts')
<!-- FullCalendar JS -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
<script>
let currentFilter = '';
let calendar;
let currentView = 'calendar';
let contestsData = [];
let eventModal; // Global modal instance

document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    
    // Initialize modal using Bootstrap 5
    eventModal = new bootstrap.Modal(document.getElementById('eventModal'));
    
    calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'id',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        buttonText: {
            today: 'Hari Ini',
            month: 'Bulan',
            week: 'Minggu',
            day: 'Hari'
        },
        events: function(info, successCallback, failureCallback) {
            loadContestData(successCallback, failureCallback);
        },
        eventClick: function(info) {
            showEventDetails(info.event);
        },
        height: 'auto',
        eventDisplay: 'block'
    });
    
    calendar.render();
    loadListData();
});

// Load contest data
function loadContestData(successCallback, failureCallback) {
    // Build URL with parameters
    let url = '{{ route("jadwal-lomba-events") }}';
    if (currentFilter) {
        url += '?type=' + encodeURIComponent(currentFilter);
    }
    
    fetch(url, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Content-Type': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        contestsData = data;
        if (successCallback) successCallback(data);
        if (currentView === 'list') {
            renderListView(data);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        if (failureCallback) failureCallback(error);
    });
}

// Load list data
function loadListData() {
    if (currentView === 'list') {
        document.getElementById('listLoading').style.display = 'block';
        document.getElementById('contestList').style.display = 'none';
        document.getElementById('noContests').style.display = 'none';
        
        loadContestData();
    }
}

// Render list view
function renderListView(contests) {
    const listContainer = document.getElementById('contestList');
    const loadingContainer = document.getElementById('listLoading');
    const noContestsContainer = document.getElementById('noContests');
    const countBadge = document.getElementById('contestCount');
    
    loadingContainer.style.display = 'none';
    
    if (contests.length === 0) {
        listContainer.style.display = 'none';
        noContestsContainer.style.display = 'block';
        countBadge.textContent = '0';
        return;
    }
    
    noContestsContainer.style.display = 'none';
    listContainer.style.display = 'block';
    countBadge.textContent = contests.length;
    
    // Sort contests by start date
    contests.sort((a, b) => new Date(a.start) - new Date(b.start));
    
    let html = '';
    contests.forEach(contest => {
        const startDate = contest.start ? new Date(contest.start).toLocaleDateString('id-ID', {
            day: '2-digit',
            month: 'short',
            year: 'numeric'
        }) : '-';
        
        const endDate = contest.end ? new Date(contest.end).toLocaleDateString('id-ID', {
            day: '2-digit',
            month: 'short',
            year: 'numeric'
        }) : '-';
        
        const typeLabels = {
            'lokal': 'L',
            'wilayah': 'W',
            'nasional': 'N',
            'internasional': 'I',
            'pendampingan': 'P'
        };
        
        const typeLabel = typeLabels[contest.type] || '-';
        const typeNames = {
            'lokal': 'Lokal',
            'wilayah': 'Wilayah',
            'nasional': 'Nasional',
            'internasional': 'Internasional',
            'pendampingan': 'Pendampingan Lomba'
        };
        const typeName = typeNames[contest.type] || contest.type.charAt(0).toUpperCase() + contest.type.slice(1);
        
        html += `
            <div class="contest-item ${contest.type} p-3 mb-3 border rounded cursor-pointer" onclick="showEventDetailsFromList('${contest.id}')">
                <div class="row align-items-center">
                    <div class="col-md-1 col-2 text-center">
                        <div class="contest-type-icon ${contest.type}" title="${typeName}">
                            ${typeLabel}
                        </div>
                    </div>
                    <div class="col-md-5 col-10">
                        <h6 class="fs-16 mb-1 text-truncate">${contest.title}</h6>
                        <small class="text-muted fs-14">
                            <i class="uil uil-user-circle me-1"></i>
                            ${contest.penyelenggara || 'Tidak diketahui'}
                        </small>
                    </div>
                    <div class="col-md-3 col-6">
                        <small class="text-muted d-block fs-14">
                            <i class="uil uil-calendar-alt me-1"></i>
                            Mulai: ${startDate}
                        </small>
                        ${contest.end ? `<small class="text-muted d-block fs-14">
                            <i class="uil uil-clock me-1"></i>
                            Deadline: ${endDate}
                        </small>` : ''}
                    </div>
                    <div class="col-md-2 col-6 text-end">
                        <span class="badge bg-${getTypeColorClass(contest.type)}-subtle text-${getTypeColorClass(contest.type)}">${typeName}</span>
                    </div>
                    <div class="col-md-1 col-12 text-end">
                        <i class="uil uil-angle-right-b text-muted"></i>
                    </div>
                </div>
                ${contest.description ? `
                    <div class="row mt-2">
                        <div class="col-12">
                            <small class="text-muted fs-14">${contest.description.substring(0, 150)}${contest.description.length > 150 ? '...' : ''}</small>
                        </div>
                    </div>
                ` : ''}
            </div>
        `;
    });
    
    listContainer.innerHTML = html;
}

// Show event details from list
function showEventDetailsFromList(eventId) {
    const contest = contestsData.find(c => c.id == eventId);
    if (contest) {
        // Create a fake event object for compatibility
        const fakeEvent = {
            title: contest.title,
            start: contest.start ? new Date(contest.start) : null,
            end: contest.end ? new Date(contest.end) : null,
            extendedProps: {
                description: contest.description,
                penyelenggara: contest.penyelenggara,
                link: contest.link,
                type: contest.type
            }
        };
        showEventDetails(fakeEvent);
    }
}

// Show event details
function showEventDetails(event) {
    // Format dates
    const startDate = event.start ? new Date(event.start).toLocaleDateString('id-ID', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    }) : '-';
    
    const endDate = event.end ? new Date(event.end).toLocaleDateString('id-ID', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    }) : '-';
    
    // Get type label
    const typeLabels = {
        'lokal': 'Lokal',
        'wilayah': 'Wilayah', 
        'nasional': 'Nasional',
        'internasional': 'Internasional',
        'pendampingan': 'Pendampingan Lomba'
    };
    
    const typeLabel = typeLabels[event.extendedProps.type] || event.extendedProps.type;
    const typeBadgeClass = `bg-${getTypeColorClass(event.extendedProps.type)}-subtle text-${getTypeColorClass(event.extendedProps.type)}`;
    
    // Populate modal content
    document.getElementById('eventDetails').innerHTML = `
        <div class="row">
            <div class="col-md-8">
                <h4 class="mb-3 fs-18">${event.title}</h4>
            </div>
            <div class="col-md-4">
                <span class="badge ${typeBadgeClass} fs-15">${typeLabel}</span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p class="text-muted mb-2 fs-15"><strong>Penyelenggara:</strong> ${event.extendedProps.penyelenggara || '-'}</p>
                <p class="text-muted mb-2 fs-15"><strong>Tanggal Mulai:</strong> ${startDate}</p>
                <p class="text-muted mb-3 fs-15"><strong>Deadline:</strong> ${endDate}</p>
                ${event.extendedProps.description ? `<p class="fs-15"><strong>Deskripsi:</strong></p><p class="fs-15">${event.extendedProps.description}</p>` : ''}
            </div>
        </div>
    `;
    
    // Show/hide link button
    const linkBtn = document.getElementById('eventLink');
    if (event.extendedProps.link) {
        linkBtn.href = event.extendedProps.link;
        linkBtn.style.display = 'inline-block';
    } else {
        linkBtn.style.display = 'none';
    }
    
    // Show modal using Bootstrap 5 method
    eventModal.show();
}

// Switch between calendar and list view
function switchView(view) {
    currentView = view;
    
    const calendarBtn = document.getElementById('calendarViewBtn');
    const listBtn = document.getElementById('listViewBtn');
    const calendarContainer = document.getElementById('calendarContainer');
    const listContainer = document.getElementById('listContainer');
    
    if (view === 'calendar') {
        calendarBtn.classList.add('active');
        listBtn.classList.remove('active');
        calendarContainer.style.display = 'block';
        listContainer.style.display = 'none';
        calendar.render();
    } else {
        listBtn.classList.add('active');
        calendarBtn.classList.remove('active');
        calendarContainer.style.display = 'none';
        listContainer.style.display = 'block';
        loadListData();
    }
}

// Filter card selection function
function selectFilter(element, type) {
    // Remove active class from all filter cards
    document.querySelectorAll('.filter-card').forEach(card => {
        card.classList.remove('active');
    });
    
    // Add active class to selected card
    element.classList.add('active');
    
    // Update current filter
    currentFilter = type;
    
    // Refresh data based on current view
    if (currentView === 'calendar') {
        calendar.refetchEvents();
    } else {
        loadListData();
    }
}

function getTypeColorClass(type) {
    const colorMap = {
        'lokal': 'success',
        'wilayah': 'info',
        'nasional': 'warning',
        'internasional': 'danger',
        'pendampingan': 'purple'
    };
    return colorMap[type] || 'secondary';
}

// Additional function to manually close modal if needed
function closeModal() {
    eventModal.hide();
}
</script>
@endsection 