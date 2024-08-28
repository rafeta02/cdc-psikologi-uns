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
                    {{ trans('global.create') }} {{ trans('cruds.assessments.title_singular') }}
                </div>

                <div class="card-body">
                    <form id="personalityForm" method="POST" action="{{ route("frontend.assessments.store") }}">
                        @method('POST')
                        @csrf

                        @php
                            $totalSteps = count($question1->chunk(10)) + count($question2->chunk(10)) + count($question3->chunk(10));
                        @endphp

                        @foreach ($question1->chunk(10) as $index => $questionPair)
                            <div class="step {{ $index === 0 ? 'active' : '' }}">
                                <div class="step-number-label">Step {{ $index + 1 }} of {{ $totalSteps }}</div>
                                @foreach ($questionPair as $question)
                                    <div class="card mb-3">
                                        <p class="question text-center">{{ $question->text }}</p>
                                        <div class="custom-radio-group">
                                            <span class="agree">Yes</span>
                                            <input type="radio" id="id_HCI_{{ $question->code }}_1" name="HCI_{{ $question->code }}" value="1">
                                            <label for="id_HCI_{{ $question->code }}_1"></label>

                                            <input type="radio" id="id_HCI_{{ $question->code }}_0" name="HCI_{{ $question->code }}" value="0">
                                            <label for="id_HCI_{{ $question->code }}_0"></label>

                                            <span class="disagree">No</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                        @foreach ($question2->chunk(10) as $index => $questionPair)
                            <div class="step">
                                <div class="step-number-label">Step {{ $index + 1 + count($question1->chunk(10)) }}</div>
                                @foreach ($questionPair as $question)
                                    <div class="card mb-3">
                                        <p class="question text-center">{{ $question->text }}</p>
                                        <div class="radio-group">
                                            <span class="agree">Agree</span>

                                            <input type="radio" id="id_WR_{{ $question->code }}_1" name="WR_{{ $question->code }}" value="1">
                                            <label for="id_WR_{{ $question->code }}_1"></label>

                                            <input type="radio" id="id_WR_{{ $question->code }}_2" name="WR_{{ $question->code }}" value="2">
                                            <label for="id_WR_{{ $question->code }}_2"></label>

                                            <input type="radio" id="id_WR_{{ $question->code }}_3" name="WR_{{ $question->code }}" value="3">
                                            <label for="id_WR_{{ $question->code }}_3"></label>

                                            <input type="radio" id="id_WR_{{ $question->code }}_4" name="WR_{{ $question->code }}" value="4">
                                            <label for="id_WR_{{ $question->code }}_4"></label>

                                            <input type="radio" id="id_HCI_{{ $question->code }}_5" name="HCI_{{ $question->code }}" value="5">
                                            <label for="id_HCI_{{ $question->code }}_5"></label>

                                            <span class="disagree">Disagree</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                        @foreach ($question3->chunk(10) as $index => $questionPair)
                            <div class="step">
                                <div class="step-number-label">Step {{ $index + 1 + count($question1->chunk(10)) + count($question2->chunk(10)) }}</div>
                                @foreach ($questionPair as $question)
                                    <div class="card mb-3">
                                        <p class="question text-center">{{ $question->text }}</p>
                                        <div class="radio-group">
                                            <span class="agree">Agree</span>

                                            <input type="radio" id="id_WR_{{ $question->code }}_1" name="WR_{{ $question->code }}" value="1">
                                            <label for="id_WR_{{ $question->code }}_1"></label>

                                            <input type="radio" id="id_WR_{{ $question->code }}_2" name="WR_{{ $question->code }}" value="2">
                                            <label for="id_WR_{{ $question->code }}_2"></label>

                                            <input type="radio" id="id_WR_{{ $question->code }}_3" name="WR_{{ $question->code }}" value="3">
                                            <label for="id_WR_{{ $question->code }}_3"></label>

                                            <input type="radio" id="id_WR_{{ $question->code }}_4" name="WR_{{ $question->code }}" value="4">
                                            <label for="id_WR_{{ $question->code }}_4"></label>

                                            <input type="radio" id="id_HCI_{{ $question->code }}_5" name="HCI_{{ $question->code }}" value="5">
                                            <label for="id_HCI_{{ $question->code }}_5"></label>

                                            <span class="disagree">Disagree</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach

                        <!-- Navigation Buttons -->
                        <div class="step-buttons text-center mt-5">
                            <button type="button" class="btn btn-secondary previous " onclick="nextPrev(-1)">
                                <i class="fas fa-arrow-left"></i> Previous
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
            const radioGroups = currentStepElem.querySelectorAll('.radio-group, .custom-radio-group');
            let allAnswered = true;
            let firstIncompleteRadio = null;

            radioGroups.forEach(group => {
                const inputs = group.querySelectorAll('input[type="radio"]');
                const isAnswered = Array.from(inputs).some(input => input.checked);
                if (!isAnswered) {
                    allAnswered = false;
                    if (!firstIncompleteRadio) {
                        firstIncompleteRadio = group.querySelector('input[type="radio"]');
                    }
                }
            });

            if (!allAnswered) {
                // If not all questions are answered, show the alert
                Swal.fire({
                    icon: 'warning',
                    title: 'Incomplete',
                    text: 'Please answer all questions before proceeding to the next step.',
                    confirmButtonText: 'OK'
                }).then(() => {
                    // Scroll to the first incomplete radio button
                    setTimeout(() => {
                        if (firstIncompleteRadio) {
                            firstIncompleteRadio.scrollIntoView({
                                behavior: 'smooth',
                                block: 'center'
                            });
                            firstIncompleteRadio.focus(); // Optionally set focus
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
