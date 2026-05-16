@extends('user.layouts.master',[
    'title' => '| Attempted Tests List'
])
@section('main-content')
    <main class="main_wrapper overflow-hidden">

        @if(Auth::guard('candidate')->check())
        @includeIf('user.layouts.header')
        @endif
     

        <!-- dashboardarea__area__start  -->
        <div class="dashboardarea sp_bottom_100">
            @if(Auth::guard('candidate')->check())
            @includeIf('user.layouts.authNavbar')
            @endif

            <div class="dashboard">
                <div class="container-fluid full__width__padding">
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-12">
                            @includeIf('user.layouts.left-sidebar')
                        </div>
                        <div class="col-xl-9 col-lg-9 col-md-12">
                            <div class="dashboard__content__wraper">
                                <div class="dashboard__section__title">
                                    <h4>Personality Assessment Result</h4>
                                </div>
                                <hr class="mt-40">
                                <div class="row">

                                    <div class="col-xl-12">
                                        <div class="dashboard__table table-responsive">
                                            <table>
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Test Date</th>
                                                    <th>Test Status</th>
                                                    <th>Payment Status</th>
                                                    <th>Amount</th>
                                                    <th>Transaction ID</th>
                                                    <th>Payment Date</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody id="quizTableBody">
    @if(count($tests) > 0)
        @foreach($tests as $key => $value)
            @php
                $isCompleted = $value->scores_count >= $totalQuestions;
            @endphp
            <tr>
                <td data-label="#">{{ $key + 1 }}</td>
                <td data-label="Test Date">{{ \Carbon\Carbon::parse($value->created_at)->format('d M Y, h:i A') }}</td>
                <td data-label="Test Status">
                    @if($isCompleted)
                        <span style="color:#28a745;font-weight:600;">&#10003; Completed</span>
                    @else
                        <span style="color:#f0a500;font-weight:600;">&#9679; In Progress ({{ $value->scores_count }}/{{ $totalQuestions }})</span>
                    @endif
                </td>
                <td data-label="Payment Status">
                    @if($value->payment_status === 'paid')
                        <span style="color:#28a745;font-weight:600;">&#10003; Paid</span>
                    @else
                        <span style="color:#dc3545;font-weight:600;">Unpaid</span>
                    @endif
                </td>
                <td data-label="Amount">
                    {{ $value->paymentTransaction ? $value->paymentTransaction->transaction_currency . ' ' . number_format($value->paymentTransaction->transaction_amount, 2) : ($value->payment_amount ? number_format($value->payment_amount, 2) : '—') }}
                </td>
                <td data-label="Transaction ID">
                    {{ $value->paymentTransaction ? $value->paymentTransaction->transaction_id : '—' }}
                </td>
                <td data-label="Payment Date">
                    {{ $value->paymentTransaction && $value->paymentTransaction->enrollment_date ? \Carbon\Carbon::parse($value->paymentTransaction->enrollment_date)->format('d M Y') : '—' }}
                </td>
                <td data-label="Action">
                    <div style="display:flex;flex-wrap:wrap;gap:6px;align-items:center;">
                        @if($value->payment_status === 'paid')
                            <a class="btn btn-success" target="_blank" href="{{ route('assessment.test.download.result',['quiz_id' => $value->id]) }}" style="font-size:13px;padding:6px 12px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16" style="margin-right:4px;">
                                    <path d="M.5 9.9V14a1 1 0 0 0 1 1h13a1 1 0 0 0 1-1V9.9a.5.5 0 0 0-1 0V14H1.5V9.9a.5.5 0 0 0-1 0z"/>
                                    <path d="M7.646 10.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 9.293V1.5a.5.5 0 0 0-1 0v7.793L5.354 7.146a.5.5 0 1 0-.708.708l3 3z"/>
                                </svg>
                                Download
                            </a>
                            <a class="btn" href="{{ route('attemptTest') }}" style="font-size:13px;padding:6px 12px;background:#4E4E4E;color:#fff;border-radius:5px;text-decoration:none;">
                                &#8635; Re-attempt
                            </a>
                        @else
                            <a class="btn" href="{{ route('assessment.test.download.result',['quiz_id' => $value->id]) }}" style="font-size:13px;padding:6px 14px;background:#FF7A15;color:#fff;border-radius:5px;text-decoration:none;font-weight:600;">
                                Pay Now
                            </a>
                        @endif
                    </div>
                </td>
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="8" class="text-center">No tests found</td>
        </tr>
    @endif
</tbody>
<!--                                                <tbody id="quizTableBody">-->

<!--                                                @if(count($tests) > 0)-->
<!--                                                    @foreach($tests as $key => $value)-->
<!--                                                        <tr>-->
<!--                                                        <td>{{ $key + 1 }}</td>-->
<!--                                                            <td>{{ \Carbon\Carbon::parse($value->created_at)->format('l, d M Y, h:i A') }}</td>-->
<!--                                                        <td>{{ $value->payment_status }}</td>-->
<!--                                                        <td>-->
<!--{{--                                                            @if($value->payment_status == 'unpaid')--}}-->
<!--                                                            <a class="btn btn-success" href="{{ route('assessment.test.download.result',['quiz_id' => $value->id]) }}">-->
                                                                <!-- Download SVG Icon -->
<!--                                                                <svg xmlns="http://www.w3.org/2000/svg"-->
<!--                                                                     width="16" height="16"-->
<!--                                                                     fill="currentColor"-->
<!--                                                                     viewBox="0 0 16 16"-->
<!--                                                                     style="margin-right: 5px;">-->
<!--                                                                    <path d="M.5 9.9V14a1 1 0 0 0 1 1h13a1 1 0 0 0 1-1V9.9a.5.5 0 0 0-1 0V14H1.5V9.9a.5.5 0 0 0-1 0z"/>-->
<!--                                                                    <path d="M7.646 10.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 9.293V1.5a.5.5 0 0 0-1 0v7.793L5.354 7.146a.5.5 0 1 0-.708.708l3 3z"/>-->
<!--                                                                </svg>-->
<!--                                                                Download Result-->
<!--                                                            </a>-->
<!--{{--                                                            @endif--}}-->
<!--                                                        </td>-->
<!--                                                        </tr>-->
<!--                                                    @endforeach-->
<!--                                                @else-->
<!--                                                    <tr>-->
<!--                                                        <td colspan="6" class="text-center">-->
<!--                                                            No data found-->
<!--                                                        </td>-->
<!--                                                    </tr>-->
<!--                                                @endif-->
<!--                                                </tbody>-->
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                    </div>
                </div>
            </div>
        </div>
        @includeIf('user.layouts.footer')

    </main>

@endsection

@push('css')
    <style>
    /* Responsive table – stacked layout on mobile */
@media (max-width: 767px) {
    /* Force table to behave like block elements */
    .dashboard__table table,
    .dashboard__table thead,
    .dashboard__table tbody,
    .dashboard__table th,
    .dashboard__table td,
    .dashboard__table tr {
        display: block;
    }

    /* Hide table headers */
    .dashboard__table thead {
        display: none;
    }

    /* Style each row as a card */
    .dashboard__table tr {
        margin-bottom: 1.5rem;
        border: 1px solid var(--borderColor, #dee2e6);
        border-radius: 8px;
        padding: 0.75rem;
        background-color: var(--lightGrey7, #fff);
    }

    /* Style each cell as a flex row */
    .dashboard__table td {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.5rem 0;
        border: none;
        border-bottom: 1px dashed var(--borderColor, #dee2e6);
        font-size: 0.9rem;
    }

    /* Remove bottom border from last cell */
    .dashboard__table td:last-child {
        border-bottom: none;
    }

    /* Show data-label as pseudo-element */
    .dashboard__table td::before {
        content: attr(data-label);
        font-weight: 600;
        width: 40%; /* Adjust as needed */
        min-width: 120px; /* Ensures label doesn't get too small */
        color: var(--headingColor, #333);
    }

    /* Adjust the button for mobile */
    .dashboard__table td:last-child::before {
        content: attr(data-label);
    }

    .dashboard__table .btn-success {
        padding: 0.25rem 0.75rem;
        font-size: 0.85rem;
        white-space: nowrap;
    }

    .dashboard__table .btn-success svg {
        margin-right: 5px;
    }

    /* Optional: shorten date format on very small screens */
    .dashboard__table td[data-label="Attempt Date Time"] {
        font-size: 0.8rem;
        word-break: break-word;
    }

    /* For the empty state */
    .dashboard__table td[colspan] {
        display: block;
        text-align: center;
    }
}

/* For very small screens (below 400px), make label column even smaller */
@media (max-width: 399px) {
    .dashboard__table td::before {
        min-width: 100px;
    }
}
    
        /* Dark Mode Styles */
        .is_dark .dashboard__content__wraper {
            color: var(--contentColor);
        }

        .is_dark .dashboard__section__title h4 {
            color: var(--headingColor);
        }

        .is_dark .dashboard__table table {
            color: var(--contentColor);
        }

        .is_dark .dashboard__table table thead th {
            background-color: var(--lightGrey7);
            color: var(--headingColor);
            border-color: var(--borderColor);
        }

        .is_dark .dashboard__table table tbody td {
            border-color: var(--borderColor);
        }

        .is_dark .dashboard__table table tbody th {
            border-color: var(--borderColor);
        }

        .is_dark .modal-content {
            background-color: var(--lightGrey7);
            color: var(--contentColor);
            border-color: var(--borderColor);
        }

        .is_dark .modal-header {
            background-color: var(--lightGrey7);
            border-bottom-color: var(--borderColor);
        }

        .is_dark .modal-header .modal-title {
            color: var(--headingColor);
        }

        .is_dark .modal-header .btn-close {
            filter: invert(1);
        }

        .is_dark .modal-body {
            background-color: var(--lightGrey7);
            color: var(--contentColor);
        }

        .is_dark .modal-footer {
            background-color: var(--lightGrey7);
            border-top-color: var(--borderColor);
        }

        .is_dark .breadcrumb__title h2 {
            color: var(--headingColor);
        }

        .is_dark .breadcrumb__inner ul li {
            color: var(--contentColor);
        }

        .is_dark .breadcrumb__inner ul li a {
            color: var(--contentColor);
        }

        .is_dark .breadcrumb__inner ul li a:hover {
            color: var(--primaryColor);
        }
    </style>
@endpush
