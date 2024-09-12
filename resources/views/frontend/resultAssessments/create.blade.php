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
        width: 40px;  /* Adjust size as needed */
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
    .agree {
        font-size: 1.5rem;
        color: #28a745;
        font-weight: bold;
        margin-right: 20px;
    }
    .disagree {
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

    /* Base styling for the radio group */
    .custom-radio-group {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 30px;
        flex-wrap: nowrap;
    }
    .custom-radio-group label {
        position: relative;
        margin: 0 12px;
        cursor: pointer;
        font-size: 16px;
        color: #6c757d;
        font-weight: 500;
        display: flex;
        align-items: center;
    }
    .custom-radio-group input[type="radio"] {
        display: none;
    }

    .custom-radio-group label::before {
        content: '';
        display: inline-block;
        width: 40px;  /* Adjust the size of the radio circles */
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
    .custom-radio-group input[type="radio"]:checked + label::before {
        background-color: #28a745; /* Green background for the first option */
        border-color: #28a745; /* Match the border to the background */
        color: white; /* White checkmark */
        content: '✔'; /* Display the checkmark inside the circle */
    }
    .custom-radio-group input[type="radio"]:nth-of-type(2):checked + label::before {
        background-color: #6f42c1; /* Purple background for the second option */
        border-color: #6f42c1; /* Match the border to the background */
        color: white; /* White checkmark */
        content: '✔'; /* Display the checkmark inside the circle */
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

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    Asessment Karier dan Kepribadian
                </div>

                <div class="card-body">
                    <form id="personalityForm" method="POST" action="{{ route("frontend.assessments.store") }}">
                        @method('POST')
                        @csrf

                        @php
                            $totalSteps = count($question1->chunk(10)) + count($question2->chunk(10)) + count($question3->chunk(10));
                        @endphp

                        <div class="step active">
                            <div class="form-group">
                                <p>
                                    Halo!👋🏼<br>
                                    Perkenalkan, kami dari Career Development Center Fakultas Psikologi UNS. Di sini, kami ingin meminta bantuan Saudara/i untuk mengisi asesmen karier dalam rangka meningkatkan optimalisasi pengembangan karier di Fakultas Psikologi UNS.
                                    <br>
                                    Asesmen karier ini terdiri dari 3 bagian, yang masing-masing mengukur:
                                    <ul>
                                        <li>Minat Pekerjaan</li>
                                        <li>Kesiapan Kerja</li>
                                        <li>Kepercayaan Diri dalam Karier</li>
                                    </ul>
                                    Estimasi pengerjaan asesmen karier ini membutuhkan waktu sekitar 30 menit <br>
                                    Kriteria responden yang kami butuhkan adalah mahasiswa/i aktif Universitas Sebelas Maret. Identitas dan hasil asesmen bersifat rahasia dan hanya akan digunakan untuk kepentingan penelitian. <br>
                                    Terima kasih banyak atas kesediaan Saudara/i untuk mengisi asesmen karier kami☺️🙏🏼<br>
                                    Apabila ada yang ingin ditanyakan, silakan menghubungi👇🏼<br>
                                    📲: 085692156358 (Florine)
                                </p>
                            </div>
                            <div class="form-group">
                                <label class="required" for="initial">{{ trans('cruds.resultAssessment.fields.initial') }}</label>
                                <input class="form-control" type="text" name="initial" id="initial" value="{{ old('initial', '') }}" required>
                                @if($errors->has('initial'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('initial') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.resultAssessment.fields.initial_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label class="required" for="age">{{ trans('cruds.resultAssessment.fields.age') }}</label>
                                <input class="form-control" type="number" name="age" id="age" value="{{ old('age', '') }}" step="1" required>
                                @if($errors->has('age'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('age') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.resultAssessment.fields.age_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label class="required">{{ trans('cruds.resultAssessment.fields.gender') }}</label>
                                @foreach(App\Models\ResultAssessment::GENDER_RADIO as $key => $label)
                                    <div>
                                        <input type="radio" id="gender_{{ $key }}" name="gender" value="{{ $key }}" {{ old('gender', '') === (string) $key ? 'checked' : '' }} required>
                                        <label for="gender_{{ $key }}">{{ $label }}</label>
                                    </div>
                                @endforeach
                                @if($errors->has('gender'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('gender') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.resultAssessment.fields.gender_helper') }}</span>
                            </div>
                            <div class="form-group">
                                <label class="required" for="field">{{ trans('cruds.resultAssessment.fields.field') }}</label>
                                <input class="form-control" type="text" name="field" id="field" value="{{ old('field', '') }}" required>
                                @if($errors->has('field'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('field') }}
                                    </div>
                                @endif
                                <span class="help-block with-icon">{{ trans('cruds.resultAssessment.fields.field_helper') }}</span>
                            </div>
                        </div>

                        @foreach ($question1->chunk(10) as $index => $questionPair)
                            <div class="step {{ $index === 0 ? 'active' : '' }}">
                                <div class="step-number-label">Step {{ $index + 2 }} of {{ $totalSteps }}</div>
                                @foreach ($questionPair as $question)
                                    <div class="card mb-3">
                                        <p class="question text-center">{{ $question->text }}</p>
                                        <div class="custom-radio-group">
                                            <span class="agree">Suka</span>
                                            <input type="radio" id="id_HCI_{{ $question->code }}_1" name="HCI_{{ $question->code }}" value="1">
                                            <label for="id_HCI_{{ $question->code }}_1"></label>

                                            <input type="radio" id="id_HCI_{{ $question->code }}_0" name="HCI_{{ $question->code }}" value="0">
                                            <label for="id_HCI_{{ $question->code }}_0"></label>

                                            <span class="disagree">Tidak Suka</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                        @foreach ($question2->chunk(10) as $index => $questionPair)
                            <div class="step">
                                <div class="step-number-label">Step {{ $index + 2 + count($question1->chunk(10)) }} of {{ $totalSteps }}</div>
                                @foreach ($questionPair as $question)
                                    <div class="card mb-3">
                                        <p class="question text-center">{{ $question->text }}</p>
                                        <div class="radio-group">
                                            <span class="agree">Sangat Sesuai</span>

                                            <input type="radio" id="id_WR_{{ $question->code }}_5" name="WR_{{ $question->code }}" value="5">
                                            <label for="id_WR_{{ $question->code }}_5"></label>

                                            <input type="radio" id="id_WR_{{ $question->code }}_4" name="WR_{{ $question->code }}" value="4">
                                            <label for="id_WR_{{ $question->code }}_4"></label>

                                            <input type="radio" id="id_WR_{{ $question->code }}_3" name="WR_{{ $question->code }}" value="3">
                                            <label for="id_WR_{{ $question->code }}_3"></label>

                                            <input type="radio" id="id_WR_{{ $question->code }}_2" name="WR_{{ $question->code }}" value="2">
                                            <label for="id_WR_{{ $question->code }}_2"></label>

                                            <input type="radio" id="id_WR_{{ $question->code }}_1" name="WR_{{ $question->code }}" value="1">
                                            <label for="id_WR_{{ $question->code }}_1"></label>

                                            <span class="disagree">Sangat Tidak Sesuai</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                        @foreach ($question3->chunk(10) as $index => $questionPair)
                            <div class="step">
                                <div class="step-number-label">Step {{ $index + 2 + count($question1->chunk(10)) + count($question2->chunk(10)) }} of {{ $totalSteps }}</div>
                                @foreach ($questionPair as $question)
                                    <div class="card mb-3">
                                        <p class="question text-center">{{ $question->text }}</p>
                                        <div class="radio-group">
                                            <span class="agree">Sangat Percaya Diri</span>

                                            <input type="radio" id="id_CCI_{{ $question->code }}_5" name="CCI_{{ $question->code }}" value="5">
                                            <label for="id_CCI_{{ $question->code }}_5"></label>

                                            <input type="radio" id="id_CCI_{{ $question->code }}_4" name="CCI_{{ $question->code }}" value="4">
                                            <label for="id_CCI_{{ $question->code }}_4"></label>

                                            <input type="radio" id="id_CCI_{{ $question->code }}_3" name="CCI_{{ $question->code }}" value="3">
                                            <label for="id_CCI_{{ $question->code }}_3"></label>

                                            <input type="radio" id="id_CCI_{{ $question->code }}_2" name="CCI_{{ $question->code }}" value="2">
                                            <label for="id_CCI_{{ $question->code }}_2"></label>

                                            <input type="radio" id="id_CCI_{{ $question->code }}_1" name="CCI_{{ $question->code }}" value="1">
                                            <label for="id_CCI_{{ $question->code }}_1"></label>

                                            <span class="disagree">Sangat Tidak Percaya Diri</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach

                        <!-- Navigation Buttons -->
                        <div class="step-buttons text-center mt-5">
                            <button type="button" class="btn btn-secondary previous " onclick="nextPrev(-1)">
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
        if (n === 1) {
            let allFieldsValid = true;
            let firstInvalidField = null;

            // Validate required radio groups
            const radioGroups = currentStepElem.querySelectorAll('.radio-group, .custom-radio-group');
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

            // Validate other required fields
            const requiredFields = currentStepElem.querySelectorAll('input[required]');
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    allFieldsValid = false;
                    if (!firstInvalidField) {
                        firstInvalidField = field;
                    }
                } else if (field.type === 'number' && field.value < field.min) {
                    allFieldsValid = false;
                    if (!firstInvalidField) {
                        firstInvalidField = field;
                    }
                }
            });

            if (!allFieldsValid) {
                // If any required field is not filled, show the alert
                Swal.fire({
                    icon: 'warning',
                    title: 'Incomplete',
                    text: 'Please fill all required fields before proceeding to the next step.',
                    confirmButtonText: 'OK'
                }).then(() => {
                    // Scroll to the first incomplete field
                    setTimeout(() => {
                        if (firstInvalidField) {
                            firstInvalidField.scrollIntoView({
                                behavior: 'smooth',
                                block: 'center'
                            });
                            firstInvalidField.focus(); // Optionally set focus
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
