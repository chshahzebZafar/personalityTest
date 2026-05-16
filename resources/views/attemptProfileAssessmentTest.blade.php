@extends('layouts.master')



@section('main-content')

    <main class="main_wrapper overflow-hidden">



        {{-- Instruction Modal --}}

        <!--<div class="modal fade" id="instructionModal" tabindex="-1" aria-labelledby="instructionModalLabel" data-backdrop="static" data-keyboard="false">-->

        <!--    <div class="modal-dialog modal-xl">-->

        <!--        <div class="modal-content">-->

        <!--            <div class="modal-header">-->

        <!--                <h5 class="modal-title" id="instructionModalLabel">Personality Assessment Quiz:</h5>-->

        <!--            </div>-->

        <!--            <div class="modal-body">-->

        <!--                <p>Discover your professional strengths and how well your natural traits align with different roles and organizational needs. Answer honestly and read the instructions carefully. Keep in mind - your responses reveal where you naturally excel and help organizations see where you’ll thrive the most.</p>-->

        <!--            </div>-->

        <!--            <div class="modal-footer">-->

        <!--                <button type="button" class="btn btn-primary" id="start-test">Begin Your Personality Assessment Quiz</button>-->

        <!--            </div>-->

        <!--        </div>-->

        <!--    </div>-->

        <!--</div>-->

        <style>

    /* Modal CSS */

    .modal-content {

        border: none;

        border-radius: 24px;

        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);

        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;

        overflow: hidden;

    }



    .modal-header {

        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);

        padding: 28px 32px;

        border-bottom: none;

    }



    .modal-title {

        font-size: 28px;

        font-weight: 700;

        color: white;

        letter-spacing: -0.3px;

        margin: 0;

    }



    .modal-body {

        padding: 32px;

        background: #ffffff;

    }



    .modal-body p {

        font-size: 18px;

        line-height: 1.6;

        color: #334155;

        margin: 0;

        font-weight: 450;

    }



    .modal-footer {

        padding: 24px 32px 32px 32px;

        background: #f8fafc;

        border-top: 1px solid #e2e8f0;

        display: flex;

        flex-direction: column;

        align-items: flex-start;

        gap: 16px;

    }



    .btn-primary {

        background: #3b82f6;

        border: none;

        padding: 12px 28px;

        font-size: 16px;

        font-weight: 600;

        border-radius: 40px;

        transition: all 0.2s ease;

        width: auto;

        min-width: 220px;

    }



    .btn-primary:hover {

        background: #2563eb;

        transform: translateY(-2px);

        box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);

    }



    .login-link {

        width: 100%;

        text-align: center;

        margin-top: 4px;

    }



    .login-link small {

        font-size: 14px;

        color: #64748b;

    }



    .login-link a {

        color: #3b82f6;

        text-decoration: none;

        font-weight: 600;

        margin-left: 4px;

    }



    .login-link a:hover {

        text-decoration: underline;

        color: #1d4ed8;

    }



    /* Modal backdrop (optional enhancement) */

    .modal-backdrop {

        background-color: rgba(15, 23, 42, 0.7);

    }

    /* Center the start-test button in modal footer */

#instructionModal .modal-footer {

    display: flex;

    flex-direction: column;

    align-items: center !important;

    justify-content: center !important;

    text-align: center;

}



#instructionModal .modal-footer .btn-primary {

    margin: 0 auto;

    display: block;

}



#instructionModal .modal-footer .login-link {

    text-align: center;

    width: 100%;

}

</style>



<div class="modal fade" id="instructionModal" tabindex="-1" aria-labelledby="instructionModalLabel" data-backdrop="static" data-keyboard="false">

    <div class="modal-dialog modal-xl">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="instructionModalLabel">Personality Assessment Quiz:</h5>

            </div>

            <div class="modal-body">

                <p>Discover your professional strengths and how well your natural traits align with different roles and organizational needs. Answer honestly and read the instructions carefully. Keep in mind - your responses reveal where you naturally excel and help organizations see where you’ll thrive the most.</p>

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-primary" id="start-test">Begin Your Personality Assessment Quiz</button>

                <div class="login-link">

                    <small>Already have an account? <a href="{{ route('login') }}">Login here</a></small>

                </div>

            </div>

        </div>

    </div>

</div>



        {{-- Timer --}}

        <!-- <div id="timer-container">

            <span id="timer">25:00</span>

        </div> -->



        {{-- Test Area --}}

<div class="dashboardarea" style="margin-botom: 12px">

    <div class="dashboard">

        <div class="container-fluid full__width__padding">

            <div id="test-container">

                <div id="test-content">

                    <div class="quiz-container shadow p-4 bg-white rounded" id="test-area">

                        {{-- Optional Paragraph --}}

                        @if(!empty($question->question->paragraph))

                            <div id="question_paragraph">

                                {!! $question->question->paragraph->content !!}

                            </div>

                        @endif



                        {{-- Question Header --}}

                        <div class="question-header mb-4 d-flex justify-content-between align-items-center">

                            <h4 class="text-primary mb-0">Question# {{ $totalQuestionsAnswered ?? 1 }} / 40</h4>

                            <span id="subCategoryName" class="text-muted">

                                <strong>Category:</strong> {{ $question->category->name ?? '' }}

                            </span>

                        </div>



                        {{-- Question Content --}}

                        <div id="question-content"

                             data-id="{{ $question->id }}">

                            <p class="question-text font-weight-bold">

                                {!! $question->question_text ?? '' !!}

                            </p>

                        </div>

                        <input type="hidden" value="" id="quizId">

                        {{-- Slider Input --}}

                        <div id="options-container" class="mt-3">

                            <div class="satisfaction-slider-container">

                                <div class="satisfaction-slider-wrapper">



                                    {{-- Scale Numbers --}}

                                    <div class="slider-numbers">

                                        @for($i = 0; $i <= 10; $i++)

                                            <span>{{ $i }}</span>

                                        @endfor

                                    </div>



                                    {{-- Range Input --}}

                                    <input type="range" min="0" max="10" value="0" step="1" id="satisfaction-slider">



                                    {{-- Labels --}}

                                    <div class="slider-labels">

                                        <span>Statement is not true for you at all.</span>

                                        <span></span><span></span><span></span>

                                        <span>Statement is sometimes true, sometimes untrue</span>

                                        <span></span><span></span><span></span>

                                        <span>Statement perfectly describes you.</span>

                                    </div>



                                </div>

                            </div>

                        </div>



                        {{-- Next Button --}}

                        <button id="next-question-btn" class="btn btn-primary m-lg-3" style="display: none">Next Question</button>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

    </main>

@endsection



@push('css')

    <link rel="stylesheet" href="{{ asset('public/user/css/test_styles.css') }}">

    <style>

    /* Mobile adjustments - Updated */

@media (max-width: 768px) {

    /* Remove all outer spacing */

    .main_wrapper,

    .dashboardarea,

    .dashboard,

    .container-fluid.full__width__padding {

        padding: 0 !important;

        margin: 0 !important;

    }



    /* Make test content full width */

    #test-content {

        width: 100% !important;

        min-height: 100vh !important;

        padding: 0 !important;

        display: flex;

        flex-direction: column;

    }



    /* Make quiz container full screen */

    .quiz-container {

        width: 100% !important;

        min-height: 100vh !important;

        border-radius: 0 !important;

        margin: 0 !important;

        padding: 20px 15px !important;

        box-shadow: none !important;

        display: flex;

        flex-direction: column;

    }



    /* Keep space for fixed timer */

    .quiz-container {

        padding-top: 80px !important;

    }



    /* REMOVE FIXED POSITIONING - Make Next button normal flow */

    #next-question-btn {

        width: 100% !important;

        position: relative !important; /* Changed from fixed */

        bottom: auto !important; /* Removed fixed positioning */

        left: auto !important; /* Removed fixed positioning */

        border-radius: 8px !important; /* Changed from 0 */

        padding: 12px !important; /* Slightly reduced padding */

        margin-top: 5px !important; /* Add space above button */

        margin-bottom: 20px !important; /* Add space below button */

        z-index: auto !important; /* Changed from 999 */

    }



    /* REMOVE bottom margin hack */

    #options-container {

        margin-bottom: 20px !important; /* Reduced from 80px */

    }



    /* Adjust timer position */

    #timer-container {

        top: 10px !important;

        right: 10px !important;

        font-size: 1.1rem !important;

        padding: 6px 14px !important;

    }

}



/* Extra small devices */

@media (max-width: 576px) {

    .quiz-container {

        padding: 70px 12px 20px 12px !important; /* Reduced bottom padding */

    }



    #next-question-btn {

        padding: 10px !important;

        margin-top: 5px !important;

        margin-bottom: 15px !important;

    }

}



/* Update the slider-labels styles for mobile */

@media (max-width: 768px) {

    /* Override the default flex display for slider-labels on mobile */

    .slider-labels {

        display: flex !important;

        flex-direction: column !important;

        align-items: center !important;

        justify-content: center !important;

        gap: 15px !important;

        margin-top: 25px !important;

        width: 100% !important;

    }



    /* Hide all spans initially */

    .slider-labels > span {

        display: none !important;

        width: 100% !important;

        text-align: center !important;

        padding: 8px 5px !important;

        margin: 2px 0 !important;

        background: transparent !important;

    }



    /* Show only the text labels */

    .slider-labels > span:first-child,

    .slider-labels > span:nth-child(5),

    .slider-labels > span:last-child {

        display: block !important;

        font-weight: bold !important;

        font-size: 14px !important;

        line-height: 1.4 !important;

        color: #000 !important;

        border: 1px solid #ddd;

        border-radius: 8px;

        background-color: rgba(255, 255, 255, 0.8) !important;

        box-shadow: 0 2px 4px rgba(0,0,0,0.1);

    }



    /* Add number indicators */

    .slider-labels > span:first-child:before {

        content: "1-3: ";

        font-weight: bold;

        color: #ff4d4d;

    }



    .slider-labels > span:nth-child(5):before {

        content: "4-7: ";

        font-weight: bold;

        color: #ffa500;

    }



    .slider-labels > span:last-child:before {

        content: "8-10: ";

        font-weight: bold;

        color: #4dff72;

    }



    /* Make sure the slider wrapper has enough space */

    .satisfaction-slider-wrapper {

        padding-bottom: 10px !important;

    }



    /* Adjust the slider container */

    .satisfaction-slider-container {

        padding: 15px 10px 25px 10px !important;

    }

}



/* Landscape orientation on mobile */

@media (max-width: 768px) and (orientation: landscape) {

    .slider-labels {

        flex-direction: row !important;

        flex-wrap: wrap !important;

        justify-content: space-between !important;

        gap: 8px !important;

    }



    .slider-labels > span:first-child,

    .slider-labels > span:nth-child(5),

    .slider-labels > span:last-child {

        width: 32% !important;

        font-size: 12px !important;

        min-height: 80px;

        display: flex;

        align-items: center;

        justify-content: center;

    }



    .slider-labels > span:first-child:before,

    .slider-labels > span:nth-child(5):before,

    .slider-labels > span:last-child:before {

        display: block;

        width: 100%;

        text-align: center;

        margin-bottom: 5px;

    }

}

    /* Center Screen Loader Styles */

#global-loader {

    display: none;

    position: fixed;

    top: 0;

    left: 0;

    width: 100%;

    height: 100%;

    background: rgba(255, 255, 255, 0.95);

    z-index: 99999;

    justify-content: center;

    align-items: center;

    flex-direction: column;

    backdrop-filter: blur(3px);

}



#global-loader .spinner-border {

    width: 4rem;

    height: 4rem;

    border-width: 0.25rem;

    animation: spinner-border 0.75s linear infinite;

}



#global-loader p {

    margin-top: 20px;

    font-size: 18px;

    color: #007bff;

    font-weight: 500;

    letter-spacing: 0.5px;

}



/* Dark mode support */

.is_dark #global-loader {

    background: rgba(0, 0, 0, 0.9);

}



.is_dark #global-loader p {

    color: #fff;

}



@keyframes spinner-border {

    to { transform: rotate(360deg); }

}



/* Mobile adjustments */

@media (max-width: 768px) {

    #global-loader .spinner-border {

        width: 3rem;

        height: 3rem;

    }



    #global-loader p {

        font-size: 16px;

        margin-top: 15px;

    }

}



    /* ============================= */

/* FULL SCREEN TEST ON MOBILE   */

/* ============================= */



@media (max-width: 768px) {



    /* Remove all outer spacing */

    .main_wrapper,

    .dashboardarea,

    .dashboard,

    .container-fluid.full__width__padding {

        padding: 0 !important;

        margin: 0 !important;

    }



    /* Make test content full width */

    #test-content {

        width: 100% !important;

        min-height: 100vh !important;

        padding: 0 !important;

        display: flex;

        flex-direction: column;

    }



    /* Make quiz container full screen */

    .quiz-container {

        width: 100% !important;

        min-height: 100vh !important;

        border-radius: 0 !important;

        margin: 0 !important;

        padding: 20px 15px !important;

        box-shadow: none !important;

    }



    /* Keep space for fixed timer */

    .quiz-container {

        padding-top: 80px !important;

    }



    /* Make Next button full width at bottom */

    #next-question-btn {

        width: 100% !important;

        position: fixed;

        bottom: 0;

        left: 0;

        border-radius: 0 !important;

        padding: 15px !important;

        z-index: 999;

    }



    /* Add bottom spacing so content not hidden behind button */

    #options-container {

        margin-bottom: 80px !important;

    }



    /* Adjust timer position */

    #timer-container {

        top: 10px !important;

        right: 10px !important;

        font-size: 1.1rem !important;

        padding: 6px 14px !important;

    }

}



/* Extra small devices */

@media (max-width: 576px) {

    .quiz-container {

        padding: 70px 12px 100px 12px !important;

    }

}





    /* Custom media queries for mobile responsiveness */

@media (max-width: 768px) {

    /* Make modal take up more screen space on mobile */

    #instructionModal .modal-dialog {

        margin: 10px;

        max-width: calc(100% - 20px);

    }



    /* Adjust modal content spacing */

    #instructionModal .modal-content {

        border-radius: 10px;

    }



    /* Adjust header for mobile */

    #instructionModal .modal-header {

        padding: 15px 20px;

    }



    #instructionModal .modal-title {

        font-size: 1.25rem;

        text-align: center;

        width: 100%;

    }



    /* Adjust body content for mobile */

    #instructionModal .modal-body {

        padding: 20px;

        max-height: 70vh;

        overflow-y: auto;

        font-size: 0.95rem;

    }



    /* Better spacing for list items */

    #instructionModal .modal-body ol {

        padding-left: 20px;

        margin-bottom: 1rem;

    }



    #instructionModal .modal-body li {

        margin-bottom: 0.75rem;

        line-height: 1.4;

    }



    /* Adjust footer for mobile */

    #instructionModal .modal-footer {

        padding: 15px 20px;

        flex-direction: column;

        gap: 10px;

    }



    /* Make button full width on mobile */

    #instructionModal .modal-footer .btn {

        width: 100%;

        padding: 12px;

        font-size: 1rem;

        margin: 0;

    }

}



/* Extra small devices (phones less than 576px) */

@media (max-width: 576px) {

    #instructionModal .modal-dialog {

        margin: 5px;

        max-width: calc(100% - 10px);

    }



    #instructionModal .modal-header,

    #instructionModal .modal-body,

    #instructionModal .modal-footer {

        padding: 15px;

    }



    #instructionModal .modal-title {

        font-size: 1.1rem;

    }



    #instructionModal .modal-body {

        font-size: 0.9rem;

        max-height: 65vh;

    }



    #instructionModal .modal-body ol {

        padding-left: 15px;

    }



    #instructionModal .modal-body li {

        margin-bottom: 0.5rem;

    }

}



/* Landscape orientation on mobile */

@media (max-width: 768px) and (orientation: landscape) {

    #instructionModal .modal-body {

        max-height: 60vh;

    }



    #instructionModal .modal-dialog {

        max-height: 90vh;

    }

}

        .satisfaction-slider-container {

            text-align: center;

            padding: 30px;

            border-radius: 15px;

            background: linear-gradient(90deg, #ff4d4d, #4dff72);

            transition: background-color 0.3s ease;

        }

        .satisfaction-slider-wrapper {

            margin: 20px auto;

            width: 90%;

        }

        .slider-numbers, .slider-labels {

            display: flex;

            justify-content: space-between;

            font-size: 14px;

            font-weight: bold;

            color: #000;

        }

        .slider-labels span {

            width: 15%;

            text-align: center;

            font-size: 12px;

            line-height: 1.1;

        }

        input[type="range"] {

            width: 100%;

            appearance: none;

            height: 10px;

            border-radius: 5px;

            background: #d9d9d9;

            outline: none;

        }

        input[type="range"]::-webkit-slider-thumb,

        input[type="range"]::-moz-range-thumb {

            width: 20px;

            height: 20px;

            border-radius: 50%;

            background: #fff;

            border: 2px solid #000;

            cursor: pointer;

        }

        .quiz-container {

            border: 1px solid #ddd;

            border-radius: 8px;

            padding: 20px;

            background-color: #f9f9f9;

            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);

        }

        .question-header {

            border-bottom: 2px solid #007bff;

            padding-bottom: 8px;

            margin-bottom: 20px;

        }

        #timer-container {

            position: fixed;

            top: 20px;

            right: 20px;

            background-color: #343a40;

            color: #fff;

            font-size: 1.5rem;

            font-weight: bold;

            padding: 10px 20px;

            border-radius: 50px;

            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);

            z-index: 9999;

            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;

        }

        .modal-body ol li {

            margin-bottom: 8px;

        }

        .swal2-rounded {

            border-radius: 1rem !important;

        }

        .swal2-border {

            border: 2px solid #4CAF50;

        }



        /* Dark Mode Styles */

        .is_dark .quiz-container {

            background-color: var(--lightGrey7);

            border-color: var(--borderColor);

            color: var(--contentColor);

        }



        .is_dark .question-text {

            color: var(--contentColor);

        }



        .is_dark .question-header h4 {

            color: var(--headingColor);

        }



        .is_dark .question-header {

            border-bottom-color: var(--primaryColor);

        }



        .is_dark #question_paragraph {

            color: var(--contentColor);

        }



        .is_dark .satisfaction-slider-container {

            background: linear-gradient(90deg, #ff4d4d, #4dff72);

        }



        .is_dark .slider-numbers,

        .is_dark .slider-labels {

            color: var(--contentColor);

        }



        .is_dark .modal-content {

            background-color: var(--lightGrey7);

            color: var(--contentColor);

        }



        .is_dark .modal-header {

            border-bottom-color: var(--borderColor);

        }



        .is_dark .modal-footer {

            border-top-color: var(--borderColor);

        }



        .is_dark .modal-title {

            color: var(--headingColor) !important;

        }



        .is_dark .modal-body {

            color: var(--contentColor) !important;

        }



        .is_dark .modal-body p {

            color: var(--contentColor) !important;

        }



        .is_dark .modal-body ol li {

            color: var(--contentColor) !important;

        }



        .is_dark .modal-body ol li strong {

            color: var(--headingColor) !important;

        }

        /* Add these styles at the end of your CSS section */



@media (max-width: 768px) {

    /* Override the default flex display for slider-labels on mobile */

    .slider-labels {

        display: flex !important;

        flex-direction: column !important;

        align-items: center !important;

        justify-content: center !important;

        gap: 15px !important;

        margin-top: 25px !important;

        width: 100% !important;

    }



    /* Hide all spans initially */

    .slider-labels > span {

        display: none !important;

        width: 100% !important;

        text-align: center !important;

        padding: 8px 5px !important;

        margin: 2px 0 !important;

        background: transparent !important;

    }



    /* Show only the text labels */

    .slider-labels > span:first-child,

    .slider-labels > span:nth-child(5),

    .slider-labels > span:last-child {

        display: block !important;

        font-weight: bold !important;

        font-size: 14px !important;

        line-height: 1.4 !important;

        color: #000 !important;

        border: 1px solid #ddd;

        border-radius: 8px;

        background-color: rgba(255, 255, 255, 0.8) !important;

        box-shadow: 0 2px 4px rgba(0,0,0,0.1);

    }



    /* Add number indicators */

    .slider-labels > span:first-child:before {

        content: "1-3: ";

        font-weight: bold;

        color: #ff4d4d;

    }



    .slider-labels > span:nth-child(5):before {

        content: "4-7: ";

        font-weight: bold;

        color: #ffa500;

    }



    .slider-labels > span:last-child:before {

        content: "8-10: ";

        font-weight: bold;

        color: #4dff72;

    }



    /* Make sure the slider wrapper has enough space */

    .satisfaction-slider-wrapper {

        padding-bottom: 10px !important;

    }



    /* Adjust the slider container */

    .satisfaction-slider-container {

        padding: 15px 10px 25px 10px !important;

    }

}



@media (max-width: 576px) {

    .slider-labels > span:first-child,

    .slider-labels > span:nth-child(5),

    .slider-labels > span:last-child {

        font-size: 13px !important;

        padding: 6px 4px !important;

    }



    .slider-labels {

        gap: 10px !important;

        margin-top: 20px !important;

    }

}



@media (max-width: 768px) and (orientation: landscape) {

    .slider-labels {

        flex-direction: row !important;

        flex-wrap: wrap !important;

        justify-content: space-between !important;

        gap: 8px !important;

    }



    .slider-labels > span:first-child,

    .slider-labels > span:nth-child(5),

    .slider-labels > span:last-child {

        width: 32% !important;

        font-size: 12px !important;

        min-height: 80px;

        display: flex;

        align-items: center;

        justify-content: center;

    }



    .slider-labels > span:first-child:before,

    .slider-labels > span:nth-child(5):before,

    .slider-labels > span:last-child:before {

        display: block;

        width: 100%;

        text-align: center;

        margin-bottom: 5px;

    }

}

    </style>

@endpush



@push('js')

    <script src="{{ asset('public/user/sweetalert2/sweetalert2.all.min.js') }}"></script>

    {{-- <script type="module" src="{{ asset('public/user/js/secureEnvironment/secureTest.js?v=0.2') }}"></script> --}}

    <script>

        localStorage.removeItem('profile_assessment_test_responses');

        const isLoggedIn = {{ Auth::guard('candidate')->check() ? 'true' : 'false' }};



        // Simple start handler (secure environment disabled)

        document.getElementById('start-test').addEventListener('click', function() {

            $('#instructionModal').modal('hide');

            document.getElementById('test-container').style.display = 'block';

        });

        let questionNumber = 1;

        function saveQuestionResponse(questionId, score) {

            let responses = localStorage.getItem('profile_assessment_test_responses');

            responses = responses ? JSON.parse(responses) : [];

            const index = responses.findIndex(r => r.question_bank_id === questionId);

            if (index !== -1) {

                responses[index].score = score;

            } else {

                responses.push({ question_bank_id: questionId, score: score });

            }



            const jsonString = JSON.stringify(responses);



            // Save in localStorage

            localStorage.setItem('profile_assessment_test_responses', jsonString);



        }

        if(isLoggedIn)

        {

            function saveQuestionIntoDB(questionId, score,categoryId)

            {

                $.ajax({

                    url: "{{ route('profileAssessmentTest.fetch-next-question') }}",

                    method: "POST",

                    data: {

                        _token: "{{ csrf_token() }}",

                        category_id: categoryId,

                        satisfactionScore: score,

                        currentQuestion: questionId,

                        quiz_id: $('#quizId').val()

                    },

                    success: function(res) {

                        if (res.success) {

                            $('#quizId').val(res.quizId);

                        $('#question-content').attr('data-id', res.question.id).html('<p class="question-text font-weight-bold">' + res.question.question_text + '</p>');

                        $('#subCategoryName').html("<strong>Category: </strong>"+res.question.category.name);

                        questionNumber++;

                        $('.question-header h4').text('Question# ' + questionNumber + '/ 40');

                        $('#satisfaction-slider').val(0);

                    }

                    },

                    error: function (xhr) {

                        if (xhr.status === 404) {

                            Swal.fire({

                                title: '🎉 Test Completed!',

                                html: `

                        <p style="font-size: 16px;">Thank you for your effort. Your test has been successfully submitted.</p>

                        <p style="font-size: 14px; color: #555;">To check your result, please register an account.</p>

                    `,

                                icon: 'success',

                                confirmButtonText: 'Get me to Tests List',

                                confirmButtonColor: '#4CAF50',

                                allowOutsideClick: false,

                                allowEscapeKey: false,

                                customClass: {

                                    popup: 'swal2-rounded swal2-border'

                                }

                            }).then(result => {

                                if (result.isConfirmed) {

                                    window.location.href = "{{ route('assessment.test.list') }}";

                                }

                            });

                        }

                    },

                    complete: function() {

                        // Hide center loader

                        $('#global-loader').fadeOut(300);



                        // Only show next button if there's a value selected

                        const val = $('#satisfaction-slider').val();

                        if (val > 0) {

                            $('#next-question-btn').show();

                        }

                    }

                });

            }

        }



        $(document).ready(function () {

    $('#instructionModal').modal('show');



    // Create loader element and add to DOM

    $('body').append(`

        <div id="global-loader" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255, 255, 255, 0.8); z-index: 99999; justify-content: center; align-items: center; flex-direction: column;">

            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">

                <span class="sr-only">Loading...</span>

            </div>

            <p style="margin-top: 15px; font-size: 16px; color: #333; font-weight: 500;">Loading next question...</p>

        </div>

    `);



    $('#next-question-btn').on('click', function () {

        // Show center loader

        $('#global-loader').fadeIn(300).css('display', 'flex');



        // Hide the next button temporarily

        $(this).hide();



        const questionId = $('#question-content').attr('data-id');

        const categoryId = {{ $question->category_id ?? 'null' }};

        const score = $('#satisfaction-slider').val();

        if(isLoggedIn)

        {

            saveQuestionIntoDB(questionId, score,categoryId);

        }

        else

        {

            saveQuestionResponse(questionId, score);

            $.ajax({

            url: "{{ route('profileAssessmentTest.fetch-next-question') }}",

            method: "POST",

            data: {

                _token: "{{ csrf_token() }}",

                category_id: categoryId,

                satisfactionScore: score,

                currentQuestion: questionId,

            },

            success: function (res) {

                if (res.success) {



                    $('#question-content').attr('data-id', res.question.id).html('<p class="question-text font-weight-bold">' + res.question.question_text + '</p>');

                    $('#subCategoryName').html("<strong>Category: </strong>"+res.question.category.name);

                    questionNumber++;

                    $('.question-header h4').text('Question# ' + questionNumber+ ' / 40');

                    $('#satisfaction-slider').val(0);

                }

            },

            error: function (xhr) {

                if (xhr.status === 404) {

                    Swal.fire({

                        title: '🎉 Test Completed!',

                        html: `

                        <p style="font-size: 16px;">Thank you for your effort. Your test has been successfully submitted.</p>

                        <p style="font-size: 14px; color: #555;">To check your result, please register an account.</p>

                    `,

                        icon: 'success',

                        confirmButtonText: 'Register Now',

                        confirmButtonColor: '#4CAF50',

                        allowOutsideClick: false,

                        allowEscapeKey: false,

                        customClass: {

                            popup: 'swal2-rounded swal2-border'

                        }

                    }).then(result => {

                        if (result.isConfirmed) {

                            window.location.href = "{{ route('register') }}";

                        }

                    });

                }

            },

            complete: function() {

                // Hide center loader

                $('#global-loader').fadeOut(300);



                // Only show next button if there's a value selected

                const val = $('#satisfaction-slider').val();

                if (val > 0) {

                    $('#next-question-btn').show();

                }

            }

        });

        }

    });



    $('#satisfaction-slider').on('input', function () {

        const val = $(this).val();

        $('#next-question-btn').toggle(val > 0);



        const red = Math.round(255 - (val - 1) * (255 / 9));

        const green = Math.round((val - 1) * (255 / 9));

        $('.satisfaction-slider-container').css('background', `rgb(${red}, ${green}, 72)`);

    });

});

    </script>

@endpush

