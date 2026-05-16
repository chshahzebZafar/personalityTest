@extends('user.layouts.master',[
    'title' => '| Transaction History'
])
@section('main-content')
    <main class="main_wrapper overflow-hidden">

        @if(Auth::guard('candidate')->check())
        @includeIf('user.layouts.header')
        @endif

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
                                    <h4>Transaction History</h4>
                                </div>
                                <hr class="mt-40">

                                @if(count($payments) > 0)
                                <div class="row">
                                    @foreach($payments as $payment)
                                    <div class="col-xl-12 mb-4">
                                        <div class="payment__card">
                                            <div class="payment__card__header">
                                                <div class="payment__card__left">
                                                    <span class="payment__badge paid">&#10003; Paid</span>
                                                    <span class="payment__id">TXN: {{ $payment->transaction_id ?? '—' }}</span>
                                                </div>
                                                <div class="payment__card__right">
                                                    <span class="payment__amount">
                                                        {{ $payment->transaction_currency ?? '' }}
                                                        {{ $payment->transaction_amount ? number_format($payment->transaction_amount, 2) : '—' }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="payment__card__body">
                                                <div class="payment__detail__row">
                                                    <span class="payment__detail__label">Payment Method</span>
                                                    <span class="payment__detail__value">{{ $payment->payment_name ?? ($payment->payment_type ?? '—') }}</span>
                                                </div>
                                                <div class="payment__detail__row">
                                                    <span class="payment__detail__label">Issuer</span>
                                                    <span class="payment__detail__value">{{ $payment->issuer_name ?? '—' }}</span>
                                                </div>
                                                <div class="payment__detail__row">
                                                    <span class="payment__detail__label">Mobile No.</span>
                                                    <span class="payment__detail__value">{{ $payment->mobile_no ?? '—' }}</span>
                                                </div>
                                                <div class="payment__detail__row">
                                                    <span class="payment__detail__label">Payment Date</span>
                                                    <span class="payment__detail__value">
                                                        {{ $payment->enrollment_date ? \Carbon\Carbon::parse($payment->enrollment_date)->format('d M Y, h:i A') : \Carbon\Carbon::parse($payment->created_at)->format('d M Y, h:i A') }}
                                                    </span>
                                                </div>
                                                <div class="payment__detail__row">
                                                    <span class="payment__detail__label">Test Ref.</span>
                                                    <span class="payment__detail__value">{{ $payment->quiz_id ?? '—' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @else
                                <div class="text-center" style="padding: 60px 0;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="none" viewBox="0 0 24 24" stroke="#ccc" stroke-width="1.5" style="margin-bottom:16px;">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                                    </svg>
                                    <h5 style="color:#aaa;">No transactions found</h5>
                                    <p style="color:#bbb;font-size:14px;">Your payment history will appear here once you complete a payment.</p>
                                </div>
                                @endif

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
    .payment__card {
        border: 1px solid #e8e8e8;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        background: #fff;
    }

    .payment__card__header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px 20px;
        background: #f8f9fa;
        border-bottom: 1px solid #e8e8e8;
    }

    .payment__card__left {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .payment__badge.paid {
        background: #e6f9ee;
        color: #28a745;
        font-weight: 600;
        font-size: 13px;
        padding: 4px 12px;
        border-radius: 20px;
        border: 1px solid #b7f0cb;
    }

    .payment__id {
        color: #888;
        font-size: 13px;
    }

    .payment__amount {
        font-size: 20px;
        font-weight: 700;
        color: #2d2d2d;
    }

    .payment__card__body {
        padding: 16px 20px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px 24px;
    }

    .payment__detail__row {
        display: flex;
        flex-direction: column;
        gap: 3px;
    }

    .payment__detail__label {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #aaa;
        font-weight: 600;
    }

    .payment__detail__value {
        font-size: 14px;
        color: #4e4e4e;
        font-weight: 500;
    }

    @media (max-width: 576px) {
        .payment__card__body {
            grid-template-columns: 1fr;
        }
        .payment__card__header {
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
        }
    }
</style>
@endpush
