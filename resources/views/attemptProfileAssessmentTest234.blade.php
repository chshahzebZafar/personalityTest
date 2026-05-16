@extends('layouts.master')

@section('main-content')
    <main class="main_wrapper overflow-hidden">

        {{-- Instruction Modal --}}
        <div class="modal fade instruction-modal" id="instructionModal" tabindex="-1" aria-labelledby="instructionModalLabel" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content instruction-modal__content">
                    <div class="modal-header instruction-modal__header">
                        <div class="instruction-modal__titlewrap">
                            <div class="instruction-modal__icon" aria-hidden="true">🧠</div>
                            <div>
                                <h5 class="modal-title instruction-modal__title" id="instructionModalLabel">Personality Test Instructions</h5>
                                <div class="instruction-modal__subtitle">Quick read. Fast answers. Best results.</div>
                            </div>
                        </div>
                        <button type="button" class="close instruction-modal__close" data-dismiss="modal" aria-label="Close" style="display:none;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body instruction-modal__body">
                        <div class="instruction-grid">
                            <div class="instruction-card instruction-card--primary">
                                <div class="instruction-card__title">How it works</div>
                                <div class="instruction-steps">
                                    <div class="instruction-step">
                                        <div class="instruction-step__badge">1</div>
                                        <div class="instruction-step__text"><strong>Read one statement</strong> and rate yourself from <strong>1 to 10</strong>.</div>
                                    </div>
                                    <div class="instruction-step">
                                        <div class="instruction-step__badge">2</div>
                                        <div class="instruction-step__text">Use your <strong>first instinct</strong>. Don’t overthink.</div>
                                    </div>
                                    <div class="instruction-step">
                                        <div class="instruction-step__badge">3</div>
                                        <div class="instruction-step__text">Move to the next statement and repeat.</div>
                                    </div>
                                </div>
                            </div>

                            <div class="instruction-card">
                                <div class="instruction-card__title">Scoring guide</div>
                                <div class="score-scale">
                                    <div class="score-pill score-pill--low">
                                        <div class="score-pill__range">1–3</div>
                                        <div class="score-pill__label">Not true for you</div>
                                    </div>
                                    <div class="score-pill score-pill--mid">
                                        <div class="score-pill__range">4–6</div>
                                        <div class="score-pill__label">Sometimes true</div>
                                    </div>
                                    <div class="score-pill score-pill--high">
                                        <div class="score-pill__range">7–10</div>
                                        <div class="score-pill__label">Very true</div>
                                    </div>
                                </div>
                                <div class="instruction-muted">
                                    There are <strong>no right or wrong</strong> answers — your responses reflect your perspective.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer instruction-modal__footer">
                        <div class="instruction-consent">
                            By starting, you confirm you’ve read the instructions.
                        </div>
                        <button type="button" class="btn btn-primary instruction-start-btn" id="start-test">
                            Start Test
                            <span class="instruction-start-btn__icon" aria-hidden="true">➜</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Timer --}}
        <div id="timer-container">
            <span id="timer">25:00</span>
        </div>

        {{-- Test Area --}}
        <div class="dashboardarea" style="margin-botom: 12px">
            <div class="dashboard">
                <div class="container-fluid full__width__padding">
                    <div id="test-container">
                        <div id="test-content">
                            <div class="quiz-container shadow p-4 bg-white rounded" id="test-area">

                                {{-- Optional Paragraph (safe) --}}
                                @php($questionParagraph = data_get($question, 'question.paragraph.content'))
                                <div id="question_paragraph" class="question-paragraph-card" style="{{ empty($questionParagraph) ? 'display:none;' : '' }}">
                                    <div class="question-paragraph-title">Context</div>
                                    <div class="question-paragraph-body">
                                        {!! $questionParagraph !!}
                                    </div>
                                </div>

                                {{-- Question Header --}}
                                <div class="question-header mb-4 d-flex justify-content-between align-items-center">
                                    <span class="question-chip" id="question-chip">Question {{ $totalQuestionsAnswered ?? 1 }}</span>
                                    <span id="subCategoryName" class="text-muted">
                                        <strong>Category:</strong> {{ $question->category->name ?? '' }}
                                    </span>
                                </div>

                                {{-- Question Content --}}
                                <div id="question-content"
                                     data-id="{{ $question->id }}"
                                >
                                    <h2>
                                        {!! $question->question_text ?? '' !!}
                                    </h2>
                                    <!--<p class="question-helper-tip">-->
                                    <!--    Answer quickly with your first instinct – there are no right or wrong answers here.-->
                                    <!--</p>-->
                                </div>

                                {{-- Slider Input + Emoji Mood --}}
                                <div id="options-container" class="mt-3">
                                    <div class="satisfaction-slider-container">
                                        <div class="satisfaction-slider-wrapper">

                                            {{-- Mood card --}}
                                            <div class="mood-card mb-3">
                                                <div class="mood-emoji" id="mood-emoji" aria-hidden="true">😐</div>
                                                <div class="mood-text-group">
                                                    <div class="mood-title">How much does this sound like you?</div>
                                                    <div class="mood-text" id="mood-text">
                                                        Slide to rate from "not me at all" to "exactly me".
                                                    </div>
                                                    <div class="encouragement-text" id="encouragement-text"></div>
                                                </div>
                                                <div class="mood-score-pill" id="mood-score-pill">
                                                    <span id="mood-score-value">0</span>/10
                                                </div>
                                            </div>

                                            {{-- Scale Numbers --}}
                                            <div class="slider-numbers">
                                                @for($i = 0; $i <= 10; $i++)
                                                    <span>{{ $i }}</span>
                                                @endfor
                                            </div>

                                            {{-- Range Input with floating value bubble --}}
                                            <div class="slider-track-wrapper">
                                                <input type="range"
                                                       min="0"
                                                       max="10"
                                                       value="0"
                                                       step="1"
                                                       id="satisfaction-slider"
                                                       class="satisfaction-slider-modern">
                                                <div class="slider-value-bubble" id="slider-value-bubble">
                                                    <span id="slider-value-text">0</span>
                                                </div>
                                            </div>

                                            {{-- Labels --}}
                                            <div class="slider-labels">
                                                <span>Not true for me at all</span>
                                                <span></span><span></span><span></span>
                                                <span>Sometimes true, sometimes untrue</span>
                                                <span></span><span></span><span></span>
                                                <span>Perfectly describes me</span>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>

                            {{-- Next Button --}}
                            <button id="next-question-btn" class="btn btn-primary m-lg-3 btn-next-question" style="display: none">
                                <span class="btn-next-label">Next statement</span>
                                <span class="btn-next-icon">➜</span>
                            </button>
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
        .satisfaction-slider-container {
            text-align: center;
            padding: 32px 28px;
            border-radius: 18px;
            background: radial-gradient(circle at top left, #eff6ff 0, #ffffff 45%, #fdf2ff 100%);
            box-shadow: 0 18px 45px rgba(15, 23, 42, 0.16);
        }

        .satisfaction-slider-wrapper {
            margin: 18px auto 10px;
            width: min(720px, 100%);
        }

        .slider-numbers,
        .slider-labels {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            font-weight: 600;
            color: #0f172a;
        }

        .slider-labels span {
            width: 18%;
            text-align: center;
            font-size: 11px;
            line-height: 1.2;
        }

        .slider-track-wrapper {
            position: relative;
            margin: 14px 0 10px;
        }

        .satisfaction-slider-modern {
            width: 100%;
            appearance: none;
            height: 12px;
            border-radius: 999px;
            background: linear-gradient(90deg, #e5e7eb 0%, #e5e7eb 100%);
            outline: none;
            box-shadow: inset 0 1px 3px rgba(15, 23, 42, 0.18);
        }

        .satisfaction-slider-modern::-webkit-slider-thumb {
            appearance: none;
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: #ffffff;
            border: 3px solid #4f46e5;
            box-shadow: 0 6px 14px rgba(79, 70, 229, 0.4);
            cursor: pointer;
            transition: transform 0.15s ease, box-shadow 0.15s ease;
        }

        .satisfaction-slider-modern::-moz-range-thumb {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: #ffffff;
            border: 3px solid #4f46e5;
            box-shadow: 0 6px 14px rgba(79, 70, 229, 0.4);
            cursor: pointer;
            transition: transform 0.15s ease, box-shadow 0.15s ease;
        }

        .satisfaction-slider-modern:active::-webkit-slider-thumb,
        .satisfaction-slider-modern:active::-moz-range-thumb {
            transform: scale(1.08);
            box-shadow: 0 10px 22px rgba(79, 70, 229, 0.5);
        }

        .slider-value-bubble {
            position: absolute;
            top: -40px;
            left: 0;
            transform: translateX(-50%);
            padding: 4px 10px;
            border-radius: 999px;
            background: #0f172a;
            color: #f9fafb;
            font-size: 11px;
            font-weight: 600;
            white-space: nowrap;
            pointer-events: none;
        }

        .slider-value-bubble::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);
            border-width: 5px 5px 0 5px;
            border-style: solid;
            border-color: #0f172a transparent transparent transparent;
        }

        .slider-value-bubble span {
            font-size: 12px;
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
        .question-chip {
            display: inline-flex;
            align-items: center;
            padding: 4px 12px;
            border-radius: 999px;
            background: rgba(79, 70, 229, 0.10);
            color: #4338ca;
            font-size: 0.82rem;
            font-weight: 700;
            letter-spacing: 0.2px;
        }
        .question-helper-tip {
            margin-top: 6px;
            font-size: 0.83rem;
            color: #6b7280;
        }
        .question-paragraph-card {
            margin-bottom: 14px;
            padding: 12px 14px;
            border-radius: 14px;
            background: rgba(2, 132, 199, 0.06);
            border: 1px solid rgba(2, 132, 199, 0.18);
            color: #0f172a;
        }
        .question-paragraph-title {
            font-size: 0.78rem;
            font-weight: 700;
            color: #0369a1;
            letter-spacing: 0.4px;
            text-transform: uppercase;
            margin-bottom: 6px;
        }
        .question-paragraph-body {
            font-size: 0.92rem;
            line-height: 1.45;
            color: #0f172a;
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

        /*.is_dark .question-text {*/
        /*    color: var(--contentColor);*/
        /*}*/

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
            background: radial-gradient(circle at top left, #020617 0, #020617 40%, #020617 100%);
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

        /* Instruction modal redesign */
        /* Backdrop: lighter + modern blur (avoid full black) */
        .modal-backdrop.show {
            opacity: 1;
            background: white;
            /*background: #0b1220;*/
        }
     
        /* Ensure instruction modal stays centered */
        .instruction-modal .modal-dialog {
            margin: 1.25rem auto;
        }
        .instruction-modal .modal-dialog.modal-dialog-centered {
            min-height: calc(100% - 2.5rem);
            /*background: red;*/
            margin-top: -45px;
        }

        .instruction-modal__content {
            border: 0;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 24px 70px rgba(15, 23, 42, 0.25);
        }
        .instruction-modal.fade .modal-dialog {
            
            transform: translateY(18px) scale(0.98);
            transition: transform 180ms ease, opacity 180ms ease;
        }
        .instruction-modal.show .modal-dialog {
            transform: translateY(0) scale(1);
        }
        .instruction-modal__header {
            border: 0;
            padding: 18px 20px;
            background: radial-gradient(circle at top left, rgba(79,70,229,0.20), rgba(236,72,153,0.12), rgba(255,255,255,0.9));
        }
        .instruction-modal__titlewrap {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .instruction-modal__icon {
            width: 46px;
            height: 46px;
            border-radius: 14px;
            display: grid;
            place-items: center;
            font-size: 1.4rem;
            background: rgba(255,255,255,0.8);
            border: 1px solid rgba(148,163,184,0.55);
        }
        .instruction-modal__title {
            font-weight: 800;
            color: #0f172a;
            margin: 0;
        }
        .instruction-modal__subtitle {
            margin-top: 2px;
            font-size: 0.85rem;
            color: rgba(15, 23, 42, 0.65);
            font-weight: 600;
        }
        .instruction-modal__body {
            padding: 18px 20px 8px;
            background: #ffffff;
        }
        .instruction-grid {
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            gap: 14px;
        }
        .instruction-card {
            border-radius: 16px;
            padding: 14px 14px;
            border: 1px solid rgba(148, 163, 184, 0.45);
            background: rgba(248, 250, 252, 0.9);
        }
        .instruction-card--primary {
            background: linear-gradient(135deg, rgba(79,70,229,0.10), rgba(34,197,94,0.10));
            border-color: rgba(79,70,229,0.18);
        }
        .instruction-card__title {
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 10px;
            font-size: 0.95rem;
        }
        .instruction-steps {
            display: grid;
            gap: 10px;
        }
        .instruction-step {
            display: grid;
            grid-template-columns: 26px 1fr;
            gap: 10px;
            align-items: start;
        }
        .instruction-step__badge {
            width: 26px;
            height: 26px;
            border-radius: 999px;
            display: grid;
            place-items: center;
            font-size: 0.78rem;
            font-weight: 800;
            color: #ffffff;
            background: #4f46e5;
            box-shadow: 0 10px 24px rgba(79,70,229,0.35);
        }
        .instruction-step__text {
            color: rgba(15, 23, 42, 0.85);
            font-size: 0.92rem;
            line-height: 1.35;
        }
        .score-scale {
            display: grid;
            gap: 8px;
        }
        .score-pill {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 14px;
            border: 1px solid rgba(148,163,184,0.45);
            background: rgba(255,255,255,0.9);
        }
        .score-pill__range {
            font-weight: 900;
            letter-spacing: 0.2px;
            color: #0f172a;
        }
        .score-pill__label {
            color: rgba(15, 23, 42, 0.7);
            font-weight: 600;
            font-size: 0.9rem;
        }
        .score-pill--low { border-color: rgba(239,68,68,0.25); background: rgba(254,226,226,0.55); }
        .score-pill--mid { border-color: rgba(249,115,22,0.25); background: rgba(255,237,213,0.55); }
        .score-pill--high { border-color: rgba(34,197,94,0.25); background: rgba(220,252,231,0.55); }
        .instruction-muted {
            margin-top: 10px;
            font-size: 0.86rem;
            color: rgba(15, 23, 42, 0.65);
        }
        .instruction-modal__footer {
            border: 0;
            padding: 14px 20px 18px;
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }
        .instruction-consent {
            font-size: 0.86rem;
            color: rgba(15, 23, 42, 0.65);
            font-weight: 600;
        }
        .instruction-start-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            border: 0;
            border-radius: 999px;
            padding: 10px 18px;
            font-weight: 800;
            background: linear-gradient(135deg, #4f46e5, #6366f1);
            box-shadow: 0 14px 30px rgba(79, 70, 229, 0.45);
        }
        .instruction-start-btn:hover {
            background: linear-gradient(135deg, #4338ca, #4f46e5);
            box-shadow: 0 18px 38px rgba(79, 70, 229, 0.5);
        }
        .instruction-start-btn__icon {
            transform: translateX(0);
            transition: transform 0.15s ease;
        }
        .instruction-start-btn:hover .instruction-start-btn__icon {
            transform: translateX(2px);
        }
        @media (max-width: 992px) {
            .instruction-grid {
                grid-template-columns: 1fr;
            }
        }
        .is_dark .instruction-modal__body,
        .is_dark .instruction-modal__footer {
            background: var(--lightGrey7);
        }
        .is_dark .instruction-modal__header {
            background: radial-gradient(circle at top left, rgba(79,70,229,0.25), rgba(236,72,153,0.14), rgba(2,6,23,0.95));
        }
        .is_dark .instruction-modal__title,
        .is_dark .instruction-step__text,
        .is_dark .instruction-card__title {
            color: var(--headingColor);
        }
        .is_dark .instruction-modal__subtitle,
        .is_dark .instruction-muted,
        .is_dark .instruction-consent,
        .is_dark .score-pill__label {
            color: var(--contentColor);
        }

        @media (max-width: 576px) {
            .instruction-modal .modal-dialog {
                margin: 0.75rem;
            }
            .instruction-modal__header,
            .instruction-modal__body,
            .instruction-modal__footer {
                padding-left: 14px;
                padding-right: 14px;
            }
        }

        /* Mood card + emoji styles */
        .mood-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            padding: 14px 18px;
            border-radius: 16px;
            background: linear-gradient(135deg, rgba(59,130,246,0.08), rgba(236,72,153,0.08));
            border: 1px solid rgba(148,163,184,0.5);
        }

        .mood-emoji {
            font-size: 2.4rem;
            filter: drop-shadow(0 6px 14px rgba(15,23,42,0.3));
            transition: transform 0.2s ease, filter 0.2s ease;
        }

        .mood-emoji.mood-emoji-pop {
            animation: mood-pop 0.35s ease-out;
        }

        .mood-text-group {
            flex: 1;
            text-align: left;
        }

        .mood-title {
            font-size: 0.95rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 2px;
        }

        .mood-text {
            font-size: 0.82rem;
            color: #4b5563;
        }

        .encouragement-text {
            margin-top: 4px;
            font-size: 0.78rem;
            color: #16a34a;
            font-weight: 600;
        }

        .mood-score-pill {
            padding: 6px 12px;
            border-radius: 999px;
            background: #0f172a;
            color: #f9fafb;
            font-size: 0.8rem;
            font-weight: 600;
            min-width: 64px;
            text-align: center;
        }

        .mood-score-pill span {
            font-size: 0.92rem;
        }

        @keyframes mood-pop {
            0% {
                transform: scale(0.7) translateY(4px);
                opacity: 0;
            }
            60% {
                transform: scale(1.15) translateY(-2px);
                opacity: 1;
            }
            100% {
                transform: scale(1) translateY(0);
                opacity: 1;
            }
        }

        /* Next button redesign */
        .btn-next-question {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 26px;
            border-radius: 999px;
            border: none;
            background: linear-gradient(135deg, #4f46e5, #6366f1);
            color: #f9fafb;
            font-weight: 600;
            font-size: 0.95rem;
            box-shadow: 0 10px 24px rgba(79, 70, 229, 0.45);
            transition: transform 0.15s ease, box-shadow 0.15s ease, background 0.2s ease;
        }

        .btn-next-question .btn-next-icon {
            font-size: 1rem;
            transform: translateX(0);
            transition: transform 0.15s ease;
        }

        .btn-next-question:hover {
            background: linear-gradient(135deg, #4338ca, #4f46e5);
            box-shadow: 0 14px 30px rgba(79, 70, 229, 0.5);
            transform: translateY(-1px);
            color: #f9fafb;
        }

        .btn-next-question:hover .btn-next-icon {
            transform: translateX(2px);
        }

        .btn-next-question:active {
            transform: translateY(0);
            box-shadow: 0 8px 18px rgba(79, 70, 229, 0.45);
        }
    </style>
@endpush

@push('js')
    <script src="{{ asset('public/user/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script type="module" src="{{ asset('public/user/js/secureEnvironment/secureTest.js') }}"></script>
    <script>
        // Mirror previous behavior (saving, loader, flow) while keeping new design
        localStorage.removeItem('profile_assessment_test_responses');

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
            localStorage.setItem('profile_assessment_test_responses', jsonString);
        }

        $(document).ready(function () {
            $('#instructionModal').modal('show');

            let questionNumber = 1;
            $('#question-chip').text('Question ' + questionNumber);

            // Center loader overlay (as before)
            if (!$('#global-loader').length) {
                $('body').append(`
                    <div id="global-loader" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255, 255, 255, 0.8); z-index: 99999; justify-content: center; align-items: center; flex-direction: column;">
                        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                        <p style="margin-top: 15px; font-size: 16px; color: #333; font-weight: 500;">Loading next question...</p>
                    </div>
                `);
            }

            function updateSliderUI(value) {
                const val = parseInt(value, 10) || 0;
                const percent = (val / 10) * 100;

                // Gradient track from red -> amber -> green
                const gradient = `linear-gradient(90deg,
                    #fecaca 0%,
                    #f97316 40%,
                    #22c55e 100%)`;

                const $slider = $('#satisfaction-slider');
                $slider.css({
                    'background-image': gradient,
                    'background-size': percent + '% 100%',
                    'background-repeat': 'no-repeat'
                });

                // Move value bubble
                const $bubble = $('#slider-value-bubble');
                $bubble.css('left', percent + '%');
                $('#slider-value-text').text(val);

                // Update mood card + encouragement
                const $emoji = $('#mood-emoji');
                const $moodText = $('#mood-text');
                const $scoreSpan = $('#mood-score-value');
                const $encouragement = $('#encouragement-text');

                let emoji = '😐';
                let text = 'It is sometimes true, sometimes untrue for you.';

                if (val === 0) {
                    emoji = '😶';
                    text = 'You feel this statement does not describe you at all.';
                    $encouragement.text('Trust your gut – your honest answer is what matters most.');
                } else if (val >= 1 && val <= 3) {
                    emoji = '😕';
                    text = 'It feels mostly untrue for you.';
                    $encouragement.text('Thanks for being clear about what doesn’t fit you.');
                } else if (val >= 4 && val <= 6) {
                    emoji = '😐';
                    text = 'It is sometimes true, sometimes untrue for you.';
                    $encouragement.text('Nice balance – you’re noticing the nuance in how this fits you.');
                } else if (val >= 7 && val <= 8) {
                    emoji = '🙂';
                    text = 'This sounds quite a lot like you.';
                    $encouragement.text('Great insight – you seem to recognize this part of yourself well.');
                } else if (val >= 9 && val <= 10) {
                    emoji = '😄';
                    text = 'This statement perfectly describes you.';
                    $encouragement.text('Love the clarity – you’re very confident this is you.');
                }

                $emoji.text(emoji);
                $moodText.text(text);
                $scoreSpan.text(val);

                // Trigger emoji micro-animation
                $emoji.removeClass('mood-emoji-pop');
                void $emoji[0].offsetWidth; // force reflow
                $emoji.addClass('mood-emoji-pop');
            }

            $('#next-question-btn').on('click', function () {
                const $btn = $(this);

                // Show center loader and temporarily hide button (as before)
                $('#global-loader').fadeIn(300).css('display', 'flex');
                $btn.hide();

                const questionId = $('#question-content').attr('data-id');
                const categoryId = {{ $question->category_id ?? 'null' }};
                const score = $('#satisfaction-slider').val();

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
                            const $questionContent = $('#question-content');

                            // Hide/clear the paragraph "context" area on next questions
                            // (The fetch-next-question endpoint doesn't return paragraph content,
                            // so leaving it visible would show stale text from the first question.)
                            $('#question_paragraph').hide().find('.question-paragraph-body').html('');

                            // Replace question area completely so prior text can't linger
                            // $questionContent
                            //     .attr('data-id', res.question.id)
                            //     .html(
                            //         // '<p class="question-text>' + (res.question.question_text || '') + '</p>' +
                            //         // '<p class="question-helper-tip">Answer quickly with your first instinct – there are no right or wrong answers here.</p>'
                            //     );

                            $questionContent.removeClass('question-fade-in');
                            void $questionContent[0].offsetWidth;
                            $questionContent.addClass('question-fade-in');

                            // Category label as before
                            const categoryName = res.question.category ? res.question.category.name : '';
                            $('#subCategoryName').html(categoryName ? '<strong>Category: </strong>' + categoryName : '');

                            // Question counter chip
                            questionNumber++;
                            $('#question-chip').text('Question ' + questionNumber);

                            // Reset slider + UI
                            $('#satisfaction-slider').val(0);
                            updateSliderUI(0);
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
                    complete: function () {
                        // Hide center loader
                        $('#global-loader').fadeOut(300);

                        // Only show next button again if value is selected
                        const val = parseInt($('#satisfaction-slider').val(), 10) || 0;
                        if (val > 0) {
                            $btn.show();
                        }
                    }
                });
            });

            $('#satisfaction-slider').on('input', function () {
                const val = parseInt($(this).val(), 10) || 0;
                $('#next-question-btn').toggle(val > 0);

                // Old container background animation (kept commented as requested)
                // const red = Math.round(255 - (val - 1) * (255 / 9));
                // const green = Math.round((val - 1) * (255 / 9));
                // $('.satisfaction-slider-container').css('background', `rgb(${red}, ${green}, 72)`);

                updateSliderUI(val);
            });

            // Initial UI state
            updateSliderUI(0);
        });
    </script>
@endpush
