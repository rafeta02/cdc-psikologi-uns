@extends('layouts.jobcy')

@section('title', "Company - Career Development Center Fakultas Psikologi UNS")

@section('content')
    <!-- Start home -->
    <section class="page-title-box">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="text-center text-white">
                        <h3 class="mb-4">Company</h3>
                        <div class="page-next">
                            <nav class="d-inline-block" aria-label="breadcrumb text-center">
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"> Company </li>
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

    <!-- START COMPANY-LIST -->
    <section class="section">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="job-list-header">
                    <form id="filter-form">
                    {{-- <form action="{{ route('companies') }}" method="GET"> --}}
                        <div class="row g-2">
                            <div class="col-lg-3 col-md-6">
                                <div class="filler-job-form">
                                    <i class="uil uil-briefcase-alt"></i>
                                    <input type="search" class="form-control filter-job-input-box" id="name" name="name" placeholder="Company Name ...">
                                </div>
                            </div><!--end col-->
                            <div class="col-lg-4 col-md-8">
                                <div class="filler-job-form">
                                    <i class="uil uil-location-point"></i>
                                    <select class="form-select" name="city" id="city">
                                        <option value="" disabled selected>Type City or Province</option>
                                    </select>
                                </div>
                            </div><!--end col-->
                            <div class="col-lg-3 col-md-6">
                                <div class="filler-job-form">
                                    <i class="uil uil-clipboard-notes"></i>
                                    <select class="form-select " data-trigger name="industry" id="industry">
                                        <option value="" disabled selected>Select an Industry</option>
                                        @foreach($industries as $id => $entry)
                                            <option value="{{ $id }}" {{ old('industry') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div><!--end col-->
                            <div class="col-lg-2 col-md-4">
                                <button type="button" class="btn btn-primary w-100" onclick="filterCompanies()"><i class="uil uil-filter"></i> Filter</button>
                                {{-- <button type="submit" class="btn btn-primary w-100"><i class="uil uil-filter"></i> Filter</a> --}}
                            </div><!--end col-->
                        </div><!--end row-->
                    </form>
                </div><!--end job-list-header-->
            </div><!--end row-->
            <!-- Display companies -->
            <!-- Company List -->
            <div id="company-list">
                @include('partials.company-list', ['companies' => $companies])
            </div>

        </div><!--end container-->
    </section>
    <!-- END COMPANY-LIST -->
@endsection

@section('scripts')
<script>
    // Initialize Choices.js
    const choices = new Choices('#city', {
        placeholder: true,
        placeholderValue: 'Search for a location',
        searchEnabled: true, // Enable search functionality
        searchResultLimit: 10, // Limit number of results displayed
        shouldSort: false // Disable sorting to retain order from server
    });

    function loadCity(query) {
        return fetch('{{ route("select.getRegencies") }}?q=' + encodeURIComponent(query))
            .then(response => response.json())
            .then(data => {
                return data.map(item => ({
                    value: item.id,   // Use the `id` field for the value
                    label: item.text  // Use the `name` field for the label
                }));
            });
    }

    // Handle the AJAX response with Choices.js
    document.querySelector('#city').addEventListener('search', function(event) {
        const searchTerm = event.detail.value;

        if (searchTerm.length >= 3) {
            loadCity(searchTerm).then(options => {
                // Clear previous choices and set new options
                choices.clearStore();
                choices.setChoices(options, 'value', 'label', true);
            });
        }
    });

    const industryChoices = new Choices('#industry', {
            placeholder: true,
            placeholderValue: 'Select a category',
            searchEnabled: true,
            searchResultLimit: 10,
            shouldSort: false
        });

    // AJAX Filtering Function
    function filterCompanies(page = 1) {
        let name = document.getElementById('name').value;
        let city = document.getElementById('city').value;
        let industry = document.getElementById('industry').value;

        $.ajax({
            url: '{{ route('companies') }}',
            type: 'GET',
            data: {
                name: name,
                city: city,
                industry: industry,
                page: page // Include the current page number for pagination
            },
            success: function(data) {
                $('#company-list').html(data);
            }
        });
    }

    // Handle pagination link clicks
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        filterCompanies(page);
    });
</script>
@endsection
