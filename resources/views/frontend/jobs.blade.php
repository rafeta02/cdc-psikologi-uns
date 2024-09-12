@extends('layouts.jobcy')

@section('title', "Jobs - Career Development Center Fakultas Psikologi UNS")

@section('content')
    <!-- Start home -->
    <section class="page-title-box">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="text-center text-white">
                        <h3 class="mb-4">Jobs</h3>
                        <div class="page-next">
                            <nav class="d-inline-block" aria-label="breadcrumb text-center">
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"> Jobs </li>
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

    <!-- START JOB-LIST -->
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="me-lg-5">
                        <div class="job-list-header">
                            <form id="filter-form">
                                <div class="row g-2 mb-2">
                                    <div class="col-lg-10 col-md-12">
                                        <div class="filler-job-form">
                                            <i class="uil uil-briefcase-alt"></i>
                                            <input type="search" class="form-control filter-job-input-box" id="name" name="name" placeholder="Job Name, Description.... ">
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-lg-2 col-md-6">
                                        <button type="button" class="btn btn-primary w-100" onclick="filterJobs()"><i class="uil uil-filter"></i> Filter</button>
                                    </div><!--end col-->
                                </div>
                                <div class="row g-2">
                                    <div class="col-lg-5 col-md-12">
                                        <div class="filler-job-form">
                                            <i class="uil uil-location-point"></i>
                                            <select class="form-select" name="city" id="city">
                                                <option value="" disabled selected>Type City or Province</option>
                                            </select>
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-lg-5 col-md-6">
                                        <div class="filler-job-form">
                                            <i class="uil uil-clipboard-notes"></i>
                                            <select class="form-select " data-trigger name="position" id="position">
                                                <option value="" disabled selected>Select a Position</option>
                                                @foreach($positions as $id => $entry)
                                                    <option value="{{ $id }}" {{ old('position') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div><!--end col-->
                                    <div class="col-lg-2 col-md-6">
                                        <button type="button" class="btn btn-danger w-100" onclick="location.reload();"><i class="uil uil-history-alt"></i> Reset</button>
                                    </div><!--end col-->
                                </div><!--end row-->
                            </form>
                        </div><!--end job-list-header-->

                        <div id="job-list">
                            @include('partials.job-list', ['jobs' => $jobs])
                        </div>
                    </div>

                </div>
                <!-- START SIDE-BAR -->
                <div class="col-lg-3">
                    <div class="side-bar mt-5 mt-lg-0">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item mt-3">
                                <h2 class="accordion-header" id="datePosted">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#dateposted" aria-expanded="false" aria-controls="dateposted">
                                        Only Open Jobs
                                    </button>
                                </h2>
                                <div id="dateposted" class="accordion-collapse collapse show" aria-labelledby="datePosted">
                                    <div class="accordion-body">
                                        <div class="side-title form-check-all">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="onlyopen" value="open" />
                                                <label class="form-check-label ms-2 text-muted" for="onlyopen">
                                                    Only Open Jobs
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end accordion-item -->

                            <div class="accordion-item mt-4">
                                <h2 class="accordion-header" id="jobType">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#jobtype" aria-expanded="false" aria-controls="jobtype">
                                        Type of employment
                                    </button>
                                </h2>
                                <div id="jobtype" class="accordion-collapse collapse show" aria-labelledby="jobType">
                                    <div class="accordion-body">
                                        <div class="side-title">
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" value="" type="radio" name="job_type" id="job_type0" checked>
                                                <label class="form-check-label ms-2 text-muted" for="job_type0">
                                                    All
                                                </label>
                                            </div>
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" value="fulltime" type="radio" name="job_type" id="job_type1">
                                                <label class="form-check-label ms-2 text-muted" for="job_type1">
                                                    Full Time
                                                </label>
                                            </div>
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" value="parttime" type="radio" name="job_type" id="job_type2">
                                                <label class="form-check-label ms-2 text-muted" for="job_type2">
                                                    Part Time
                                                </label>
                                            </div>
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" value="internship" type="radio" name="job_type" id="job_type3">
                                                <label class="form-check-label ms-2 text-muted" for="job_type3">
                                                    Internship
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end accordion-item -->

                            <div class="accordion-item mt-4">
                                <h2 class="accordion-header" id="industryAccordion">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#industryArea" aria-expanded="true" aria-controls="industryArea">
                                        Industry Area
                                    </button>
                                </h2>
                                <div id="industryArea" class="accordion-collapse collapse show" aria-labelledby="industryArea">
                                <div class="accordion-body">
                                    <div class="side-title">
                                        <select class="form-select " data-trigger name="industry" id="industry">
                                            <option value="" selected>All</option>
                                            @foreach($industries as $id => $entry)
                                                <option value="{{ $id }}" {{ old('industry') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div><!-- end accordion-item -->

                            <div class="accordion-item mt-4">
                                <h2 class="accordion-header" id="experienceAccordion">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#experienceAccordion" aria-expanded="true" aria-controls="experienceAccordion">
                                        Job Experience
                                    </button>
                                </h2>
                                <div id="experienceAccordion" class="accordion-collapse collapse show" aria-labelledby="experienceAccordion">
                                <div class="accordion-body">
                                    <div class="side-title">
                                        <select class="form-select" data-trigger name="experience" id="experience">
                                            <option value="" selected>All</option>
                                            @foreach($experiences as $id => $entry)
                                                <option value="{{ $id }}" {{ old('experience') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div><!-- end accordion-item -->

                            <div class="accordion-item mt-4">
                                <h2 class="accordion-header" id="tagAccordion">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#tagAccordion" aria-expanded="false" aria-controls="tagAccordion">
                                        Additional Tag
                                    </button>
                                </h2>
                                <div id="tagAccordion" class="accordion-collapse collapse show" aria-labelledby="tagAccordion">
                                    <div class="accordion-body">
                                        <div class="side-title">
                                            <select class="form-select" data-trigger name="tag[]" id="tag" multiple>
                                                @foreach($tags as $id => $entry)
                                                    <option value="{{ $id }}" {{ old('tag') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end accordion-item -->

                            <div class="accordion-item mt-4">
                                <h2 class="accordion-header" id="educationAccordion">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#educationTags" aria-expanded="false" aria-controls="tagcloud">
                                        Education
                                    </button>
                                </h2>
                                <div id="educationTags" class="accordion-collapse collapse show" aria-labelledby="educationTags">
                                    <div class="accordion-body">
                                        <div class="side-title">
                                            <select class="form-select" data-trigger name="education[]" id="education" multiple>
                                                @foreach($educations as $id => $entry)
                                                    <option value="{{ $id }}" {{ old('education') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end accordion-item -->

                            <div class="accordion-item mt-4">
                                <h2 class="accordion-header" id="departmentAccordion">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#departmentOne" aria-expanded="true" aria-controls="departmentOne">
                                        Department
                                    </button>
                                </h2>
                                <div id="departmentOne" class="accordion-collapse collapse show" aria-labelledby="departmentOne">
                                    <div class="accordion-body">
                                        <div class="side-title">
                                            <select class="form-select " data-trigger name="department[]" id="department" multiple>
                                                @foreach($departments as $id => $entry)
                                                    <option value="{{ $id }}" {{ old('department') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div><!-- end accordion-item -->
                            </div>
                        </div><!--end accordion-->

                    </div><!--end side-bar-->
                </div>
                <!-- END SIDE-BAR -->
            </div>
        </div>
    </section>
    <!-- END JOB-LIST -->
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

    const positionChoices = new Choices('#position', {
        placeholder: true,
        placeholderValue: 'Select a category',
        searchEnabled: true,
        searchResultLimit: 10,
        shouldSort: false
    });

    const industryChoices = new Choices('#industry', {
        placeholder: true,
        placeholderValue: 'All Industries',
        searchEnabled: true,
        searchResultLimit: 10,
        shouldSort: false,
    });

    const experienceChoices = new Choices('#experience', {
        placeholder: true,
        placeholderValue: 'All Experiences',
        searchEnabled: true,
        searchResultLimit: 10,
        shouldSort: false,
    });

    const tagChoices = new Choices('#tag', {
        placeholder: true,
        placeholderValue: 'Filter Tags',
        searchEnabled: true,
        searchResultLimit: 10,
        shouldSort: false,
        removeItemButton: true
    });

    const departmentChoices = new Choices('#department', {
        placeholder: true,
        placeholderValue: 'Filter Departments',
        searchEnabled: true,
        searchResultLimit: 10,
        shouldSort: false,
        removeItemButton: true
    });

    const educationChoices = new Choices('#education', {
        placeholder: true,
        placeholderValue: 'Filter Educations',
        searchEnabled: true,
        searchResultLimit: 10,
        shouldSort: false,
        removeItemButton: true
    });

    // AJAX Filtering Function
    function filterJobs(page = 1) {
        let name = document.getElementById('name').value;
        let city = document.getElementById('city').value;
        let position = document.getElementById('position').value;
        let industry = document.getElementById('industry').value;
        let experience = document.getElementById('experience').value;
        let jobType = document.querySelector('input[name="job_type"]:checked').value;
        let education = Array.from(document.getElementById('education').selectedOptions).map(option => option.value);
        let departments = Array.from(document.getElementById('department').selectedOptions).map(option => option.value);
        let tags = Array.from(document.getElementById('tag').selectedOptions).map(option => option.value);
        let onlyOpen = document.getElementById('onlyopen').checked ? 'open' : '';

        $.ajax({
            url: '{{ route('jobs') }}',
            type: 'GET',
            data: {
                name: name,
                city: city,
                position: position,
                industry: industry,
                experience: experience,
                job_type: jobType,
                department: departments,
                education: education,
                tag: tags,
                onlyopen: onlyOpen,
                page: page // Include the current page number for pagination
            },
            success: function(data) {
                $('#job-list').html(data);
            }
        });
    }

    // Handle sidebar filters change events
    document.querySelectorAll('#industry, input[name="job_type"], #onlyopen, #department, #education, #experience, #tag').forEach(element => {
        element.addEventListener('change', function() {
            console.log('clicked')
            filterJobs();
        });
    });

    // Handle pagination link clicks
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        filterCompanies(page);
    });
</script>
@endsection
