@extends('layouts.jobcy')

@section('title', "Magang - Career Development Center Fakultas Psikologi UNS")

@section('content')
    <!-- Start home -->
    <section class="page-title-box">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="text-center text-white">
                        <h3 class="mb-4">Magang</h3>
                        <div class="page-next">
                            <nav class="d-inline-block" aria-label="breadcrumb text-center">
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Magang</li>
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

    <!-- START MAGANG/INTERNSHIP-LIST -->
    <section class="section">
        <div class="container">
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="me-lg-5">
                        <div class="job-list-header">
                            <form id="filter-form">
                                <div class="row g-2 mb-2">
                                    <div class="col-lg-10 col-md-12">
                                        <div class="filler-job-form">
                                            <i class="uil uil-briefcase-alt"></i>
                                            <input type="search" class="form-control filter-job-input-box" id="name" name="name" placeholder="Internship Name, Description.... ">
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-lg-2 col-md-6">
                                        <button type="button" class="btn btn-primary w-100" onclick="filterMagang()"><i class="uil uil-filter"></i> Filter</button>
                                    </div><!--end col-->
                                </div>
                                <div class="row g-2">
                                    <div class="col-lg-5 col-md-12">
                                        <div class="filler-job-form">
                                            <i class="uil uil-building"></i>
                                            <select class="form-select" name="company" id="company">
                                                <option value="" selected>All Companies</option>
                                                @foreach($companies as $id => $entry)
                                                    <option value="{{ $id }}">{{ $entry }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-lg-5 col-md-6">
                                        <div class="filler-job-form">
                                            <i class="uil uil-clipboard-notes"></i>
                                            <select class="form-select" name="type" id="type">
                                                <option value="" selected>All Programs</option>
                                                <option value="MBKM">MBKM</option>
                                                <option value="REGULER">Regular</option>
                                            </select>
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-lg-2 col-md-6">
                                        <button type="button" class="btn btn-danger w-100" id="reset-btn"><i class="uil uil-history-alt"></i> Reset</button>
                                    </div><!--end col-->
                                </div><!--end row-->
                            </form>
                        </div><!--end job-list-header-->

                        <div id="magang-list">
                            @include('partials.magang-list', ['magangs' => $magangs])
                        </div>
                    </div>

                </div>
                <!-- END SIDE-BAR -->
            </div><!--end row-->
        </div><!--end container-->
    </section>
    <!-- END MAGANG/INTERNSHIP-LIST -->
@endsection

@section('scripts')
<script>
    // Initialize Choices.js for company dropdown
    const companyChoices = new Choices('#company', {
        placeholder: true,
        placeholderValue: 'Search for a Company',
        searchEnabled: true,
        searchResultLimit: 10,
        shouldSort: false,
        removeItemButton: true
    });

    // Function to load companies via AJAX
    function loadCompanies(query) {
        return fetch('{{ route("select.getCompanies") }}?q=' + encodeURIComponent(query))
            .then(response => response.json())
            .then(data => {
                return data;  // The endpoint already returns the correct format
            });
    }

    // Handle the search event for company dropdown
    document.querySelector('#company').addEventListener('search', function(event) {
        const searchTerm = event.detail.value;

        if (searchTerm && searchTerm.length >= 2) {
            loadCompanies(searchTerm).then(options => {
                // Clear previous choices and set new options
                companyChoices.clearChoices();
                companyChoices.setChoices(options, 'id', 'text', true);
            });
        }
    });

    // Initialize Choices.js for type dropdown
    const typeChoices = new Choices('#type', {
        placeholder: true,
        placeholderValue: 'Select Program Type',
        searchEnabled: false,
        removeItemButton: true
    });

    // AJAX Filtering Function
    function filterMagang(page = 1) {
        let name = document.getElementById('name').value;
        let company = companyChoices.getValue(true);  // Get the raw value
        let type = typeChoices.getValue(true);        // Get the raw value

        console.log("Filtering with:", {
            name: name,
            company: company,
            type: type,
            page: page
        });

        $.ajax({
            url: '{{ route('magang') }}',
            type: 'GET',
            data: {
                name: name,
                company: company,
                type: type,
                page: page
            },
            beforeSend: function() {
                $('#magang-list').html('<div class="text-center py-5"><div class="spinner-border text-primary" role="status"></div><p class="mt-2">Loading internships...</p></div>');
            },
            success: function(data) {
                $('#magang-list').html(data);
                
                // Update URL for sharing/bookmarking
                updateURL(name, company, type, page);
            },
            error: function(xhr, status, error) {
                console.error("Error in AJAX request:", error);
                $('#magang-list').html('<div class="alert alert-danger">An error occurred while fetching data. Please try again.</div>');
            }
        });
    }
    
    function updateURL(name, company, type, page) {
        // Create URL parameters object
        const params = new URLSearchParams();
        
        // Add parameters that have values
        if (name) params.set('name', name);
        if (company) params.set('company', company);
        if (type) params.set('type', type);
        if (page && page > 1) params.set('page', page);
        
        // Update URL without reloading page
        const newURL = window.location.protocol + "//" + window.location.host + 
                      window.location.pathname + (params.toString() ? '?' + params.toString() : '');
        window.history.pushState({path: newURL}, '', newURL);
    }

    // Reset filters
    document.getElementById('reset-btn').addEventListener('click', function() {
        // Reset input field
        document.getElementById('name').value = '';
        
        // Reset select dropdowns
        companyChoices.setChoiceByValue('');
        typeChoices.setChoiceByValue('');
        
        // Apply filters
        filterMagang();
        
        // Reset URL
        const newURL = window.location.protocol + "//" + window.location.host + window.location.pathname;
        window.history.pushState({path: newURL}, '', newURL);
    });

    // Handle pagination link clicks
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        filterMagang(page);
    });
    
    // Apply URL parameters if present
    (function applyUrlParameters() {
        const urlParams = new URLSearchParams(window.location.search);
        
        // Apply parameters to form elements
        if (urlParams.has('name')) document.getElementById('name').value = urlParams.get('name');
        
        if (urlParams.has('company')) {
            try {
                companyChoices.setChoiceByValue(urlParams.get('company'));
                
                // If we have a company ID but no preloaded choices, load it
                if (companyChoices.getValue(true) === undefined) {
                    fetch('{{ route("select.getCompanies") }}?id=' + urlParams.get('company'))
                        .then(response => response.json())
                        .then(data => {
                            if (data.length > 0) {
                                companyChoices.setChoices(data, 'id', 'text', false);
                                companyChoices.setChoiceByValue(urlParams.get('company'));
                            }
                        });
                }
            } catch (e) {
                console.warn("Could not set company value:", e);
            }
        }
        
        if (urlParams.has('type')) {
            try {
                typeChoices.setChoiceByValue(urlParams.get('type'));
            } catch (e) {
                console.warn("Could not set type value:", e);
            }
        }
        
        // If any filter is present in URL, apply filters automatically
        if (urlParams.toString()) {
            const page = urlParams.has('page') ? urlParams.get('page') : 1;
            // Short delay to ensure selects are fully initialized
            setTimeout(() => filterMagang(page), 100);
        }
    })();
    
    // Trigger filters when dropdowns change
    document.getElementById('company').addEventListener('change', function() {
        filterMagang();
    });
    
    document.getElementById('type').addEventListener('change', function() {
        filterMagang();
    });
    
    // Enable pressing Enter to filter
    document.getElementById('name').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            filterMagang();
        }
    });
</script>
@endsection 