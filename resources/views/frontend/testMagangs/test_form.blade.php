@extends('layouts.frontend')

@section('styles')
<style>
    .question {
        font-size: 1.5rem;
        margin-bottom: 2rem;
        font-weight: 600;
        color: #343a40;
    }
    .radio-group {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 30px;
        flex-wrap: nowrap;
    }
    .radio-group label {
        position: relative;
        margin: 0 12px;
        cursor: pointer;
        font-size: 16px;
        color: #6c757d;
        font-weight: 500;
        display: flex;
        align-items: center;
    }
    .radio-group input[type="radio"] {
        display: none;
    }
    .radio-group label::before {
        content: '';
        display: inline-block;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: 2px solid #6c757d;
        margin-right: 10px;
        transition: all 0.3s ease;
        vertical-align: middle;
        text-align: center;
        line-height: 36px;
        font-size: 20px;
        color: transparent;
    }
    .radio-group input[type="radio"]:nth-of-type(1) + label {
        color: #28a745;
    }
    .radio-group input[type="radio"]:nth-of-type(1):checked + label::before {
        background-color: #28a745;
        border-color: #28a745;
        color: white;
        content: '✔';
    }
    .radio-group input[type="radio"]:nth-of-type(2) + label {
        color: #28a745;
    }
    .radio-group input[type="radio"]:nth-of-type(2):checked + label::before {
        background-color: #28a745;
        border-color: #28a745;
        color: white;
        content: '✔';
    }
    .radio-group input[type="radio"]:nth-of-type(3) + label {
        color: #6c757d;
    }
    .radio-group input[type="radio"]:nth-of-type(3):checked + label::before {
        background-color: #6c757d;
        border-color: #6c757d;
        color: white;
        content: '✔';
    }
    .radio-group input[type="radio"]:nth-of-type(4) + label {
        color: #6f42c1;
    }
    .radio-group input[type="radio"]:nth-of-type(4):checked + label::before {
        background-color: #6f42c1;
        border-color: #6f42c1;
        color: white;
        content: '✔';
    }
    .radio-group input[type="radio"]:nth-of-type(5) + label {
        color: #6f42c1;
    }
    .radio-group input[type="radio"]:nth-of-type(5):checked + label::before {
        background-color: #6f42c1;
        border-color: #6f42c1;
        color: white;
        content: '✔';
    }
    .radio-group input[type="radio"]:nth-of-type(1) + label::before,
    .radio-group input[type="radio"]:nth-of-type(5) + label::before {
        width: 50px;
        height: 50px;
        line-height: 50px;
    }
    .radio-group input[type="radio"]:nth-of-type(2) + label::before,
    .radio-group input[type="radio"]:nth-of-type(3) + label::before,
    .radio-group input[type="radio"]:nth-of-type(4) + label::before {
        width: 40px;
        height: 40px;
        line-height: 40px;
    }
    .radio-group input[type="radio"]:nth-of-type(3) + label::before {
        width: 30px;
        height: 30px;
        line-height: 30px;
    }
    .never {
        font-size: 1.5rem;
        color: #28a745;
        font-weight: bold;
        margin-right: 20px;
    }
    .always {
        font-size: 1.5rem;
        color: #6f42c1;
        font-weight: bold;
        margin-left: 20px;
    }
    .step {
        display: none;
    }
    .step.active {
        display: block;
    }
    .step-buttons {
        text-align: center;
        margin-top: 50px;
    }
    .step-buttons .btn {
        margin: 0 10px;
    }
    .step-number-label {
        text-align: center;
        font-size: 1.25rem;
        font-weight: bold;
        color: #343a40;
        margin-bottom: 20px;
    }
</style>
@endsection

@section('title', 'Pretest/Posttest Magang - CDC Fakultas Psikologi UNS')

@section('breadcumb')
<div class="container">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">{{ $type == 'PRETEST' ? 'Pretest' : 'Posttest' }} Magang</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('frontend.mahasiswa-magangs.index') }}">Internship Applications</a></li>
                <li class="breadcrumb-item active">{{ $type == 'PRETEST' ? 'Pretest' : 'Posttest' }}</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ $type == 'PRETEST' ? 'Pretest' : 'Posttest' }} Magang
                </div>

                <div class="card-body">
                    <form id="testForm" method="POST" action="{{ route('frontend.test-magangs.storeTest') }}">
                        @csrf
                        <input type="hidden" name="type" value="{{ $type }}">
                        <input type="hidden" name="magang_id" value="{{ $magang_id }}">

                        <div class="step active">
                            <div class="form-group">
                                <h5>Selamat Datang di {{ $type == 'PRETEST' ? 'Pretest' : 'Posttest' }} Magang</h5>
                                <p>
                                    Asesmen ini dirancang untuk mengevaluasi perkembangan Anda selama program magang. Dengan menjawab setiap pertanyaan secara jujur, Anda akan mendapatkan wawasan mengenai aspek-aspek yang perlu Anda kembangkan. Pastikan Anda mengisi dengan cermat untuk mendapatkan hasil yang akurat.
                                </p>
                            </div>
                        </div>

                        <div class="step">
                            <div class="step-number-label">Step 1 of 2</div>
                            @php
                                $questions1 = [
                                    1 => 'Saya senang ketika bekerja dengan orang lain untuk menyelesaikan masalah.',
                                    2 => 'Saya tetap merasa nyaman dalam kondisi pekerjaan yang berubah.',
                                    3 => 'Saya mengingat informasi baru dengan mudah.',
                                    4 => 'Saya memberikan hasil yang baik dalam situasi yang berubah.',
                                    5 => 'Saya optimis dapat mempelajari informasi baru.',
                                    6 => 'Saya berpikir sangat logis ketika menyelesaikan berbagai masalah.',
                                    7 => 'Saya menikmati perubahan suasana ketika melakukan berbagai pekerjaan.',
                                    8 => 'Saya memahami pendekatan yang terbaik untuk mempelajari sesuatu yang baru.',
                                    9 => 'Saya berusaha mencari feedback tentang keterampilan dan kemampuan yang dimiliki.'
                                ];
                            @endphp

                            @foreach($questions1 as $number => $question)
                                <div class="card mb-3">
                                    <p class="question text-center">{{ $number }}. {{ $question }}</p>
                                    <div class="radio-group">
                                        <span class="never">Tidak Pernah</span>

                                        <input type="radio" id="q_{{ $number }}_1" name="q_{{ $number }}" value="1">
                                        <label for="q_{{ $number }}_1">1</label>

                                        <input type="radio" id="q_{{ $number }}_2" name="q_{{ $number }}" value="2">
                                        <label for="q_{{ $number }}_2">2</label>

                                        <input type="radio" id="q_{{ $number }}_3" name="q_{{ $number }}" value="3">
                                        <label for="q_{{ $number }}_3">3</label>

                                        <input type="radio" id="q_{{ $number }}_4" name="q_{{ $number }}" value="4">
                                        <label for="q_{{ $number }}_4">4</label>

                                        <input type="radio" id="q_{{ $number }}_5" name="q_{{ $number }}" value="5">
                                        <label for="q_{{ $number }}_5">5</label>

                                        <span class="always">Selalu</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="step">
                            <div class="step-number-label">Step 2 of 2</div>
                            @php
                                $questions2 = [
                                    10 => 'Saya tidak langsung menerima informasi dari orang lain begitu saja.',
                                    11 => 'Saya merasa puas saat menggali lebih dalam tentang cara-cara untuk menyelesaikan masalah.',
                                    12 => 'Jika satu pendekatan pemecahan masalah itu gagal, saya mencoba cara yang lain.',
                                    13 => 'Saya mencari orang baru, untuk belajar tentang topik di luar bidang pekerjaan saya.',
                                    14 => 'Saya dapat menemukan cara untuk menyelesaikan pekerjaan bahkan saat tidak diberikan arahan yang jelas.',
                                    15 => 'Saya berkenalan dengan banyak orang untuk mencari tahu cara menjadi seseorang yang lebih efektif dan efisien.',
                                    16 => 'Saya senang belajar dari orang lain',
                                    17 => 'Saya mencari cara untuk menggunakan pengetahuan baru.',
                                    18 => 'Saya seringkali didatangi orang lain ketika mereka membutuhkan bantuan menyelesaikan masalah.'
                                ];
                            @endphp

                            @foreach($questions2 as $number => $question)
                                <div class="card mb-3">
                                    <p class="question text-center">{{ $number }}. {{ $question }}</p>
                                    <div class="radio-group">
                                        <span class="never">Tidak Pernah</span>

                                        <input type="radio" id="q_{{ $number }}_1" name="q_{{ $number }}" value="1">
                                        <label for="q_{{ $number }}_1">1</label>

                                        <input type="radio" id="q_{{ $number }}_2" name="q_{{ $number }}" value="2">
                                        <label for="q_{{ $number }}_2">2</label>

                                        <input type="radio" id="q_{{ $number }}_3" name="q_{{ $number }}" value="3">
                                        <label for="q_{{ $number }}_3">3</label>

                                        <input type="radio" id="q_{{ $number }}_4" name="q_{{ $number }}" value="4">
                                        <label for="q_{{ $number }}_4">4</label>

                                        <input type="radio" id="q_{{ $number }}_5" name="q_{{ $number }}" value="5">
                                        <label for="q_{{ $number }}_5">5</label>

                                        <span class="always">Selalu</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Navigation Buttons -->
                        <div class="step-buttons text-center mt-5">
                            <button type="button" class="btn btn-secondary previous" onclick="nextPrev(-1)">
                                <i class="fas fa-arrow-left"></i> Prev
                            </button>
                            <button type="button" class="btn btn-primary next" onclick="nextPrev(1)">
                                Next <i class="fas fa-arrow-right"></i>
                            </button>
                            <button type="submit" class="btn btn-primary submit">Submit <i class="fas fa-paper-plane"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    let currentStep = 0;
    showStep(currentStep);

    function showStep(step) {
        const steps = document.getElementsByClassName("step");
        const prevBtn = document.querySelector(".btn-secondary");
        const nextBtn = document.querySelector(".btn-primary.next");
        const submitBtn = document.querySelector(".btn-primary.submit");

        // Hide all steps and show the current step
        for (let i = 0; i < steps.length; i++) {
            steps[i].classList.remove("active");
        }
        steps[step].classList.add("active");

        // Update button visibility
        prevBtn.style.display = step === 0 ? "none" : "inline";
        nextBtn.style.display = step === steps.length - 1 ? "none" : "inline";
        submitBtn.style.display = step === steps.length - 1 ? "inline" : "none";
    }

    function nextPrev(n) {
        const steps = document.getElementsByClassName("step");
        const currentStepElem = Array.from(steps).find(step => step.classList.contains("active"));
        const currentStepIndex = Array.from(steps).indexOf(currentStepElem);

        // Validation for moving forward
        if (n === 1 && currentStepIndex > 0) {
            let allFieldsValid = true;
            let firstInvalidField = null;

            // Validate required radio groups
            const radioGroups = currentStepElem.querySelectorAll('.radio-group');
            radioGroups.forEach(group => {
                const inputs = group.querySelectorAll('input[type="radio"]');
                const isAnswered = Array.from(inputs).some(input => input.checked);
                if (!isAnswered) {
                    allFieldsValid = false;
                    if (!firstInvalidField) {
                        firstInvalidField = group.querySelector('input[type="radio"]');
                    }
                }
            });

            if (!allFieldsValid) {
                // If any required field is not filled, show the alert
                Swal.fire({
                    icon: 'warning',
                    title: 'Incomplete',
                    text: 'Please answer all questions before proceeding to the next step.',
                    confirmButtonText: 'OK'
                }).then(() => {
                    // Scroll to the first incomplete field
                    setTimeout(() => {
                        if (firstInvalidField) {
                            firstInvalidField.scrollIntoView({
                                behavior: 'smooth',
                                block: 'center'
                            });
                        }
                    }, 500);
                });
                return; // Exit the function without moving to the next step
            }
        }

        // Handle navigation
        let nextStepIndex = currentStepIndex + n;
        if (nextStepIndex >= 0 && nextStepIndex < steps.length) {
            showStep(nextStepIndex);
        }

        // Scroll to the top of the page
        window.scrollTo({
            top: 0,
            behavior: 'smooth' // for smooth scrolling
        });
    }
</script>
@endsection 