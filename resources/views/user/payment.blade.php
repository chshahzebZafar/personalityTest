@extends('user.layouts.master',[
    'title' => '| Test payment'
])
@section('main-content')
    <main class="main_wrapper overflow-hidden">

        @if(Auth::guard('candidate')->check())
        @includeIf('user.layouts.header')
        @endif
        <!-- Mobile Menu Start Here -->
        <div class="mobile-off-canvas-active">
            <a class="mobile-aside-close"><i class="icofont  icofont-close-line"></i></a>
            <div class="header-mobile-aside-wrap">
                <div class="mobile-search">
                    <form class="search-form" action="#">
                        <input type="text" placeholder="Search entire store…">
                        <button class="button-search"><i class="icofont icofont-search-2"></i></button>
                    </form>
                </div>
                <div class="mobile-menu-wrap headerarea">

                    <div class="mobile-navigation">
                        <nav>
                            <ul class="mobile-menu">
                                <li class="menu-item-has-children"><a href="">Home</a></li>
                                <li class="menu-item"><a href="">About</a></li>

                                <li class="menu-item-has-children "><a href="javascript:void(0)">Services</a>

                                    <ul class="dropdown">
                                        <li class="menu-item"><a href="javascript:void(0)">Resume Building</a></li>
                                        <li class="menu-item"><a href="javascript:void(0)">Interview Preparation</a>
                                        </li>
                                        <li class="menu-item"><a href="javascript:void(0)">Personal Growth Test</a></li>
                                        <!--  <li class="menu-item-has-children">
                                                 <div class="mega__menu__img">
                                                 <a href="#"><img loading="lazy"  src="img/mega/mega_menu_2.png" alt="Mega Menu"></a>
                                                 </div>
                                         </li> -->
                                    </ul>
                                </li>
                                <li class="menu-item"><a href="javascript:void(0)">RTPP Blog</a></li>
                                <li class="menu-item"><a href="javascript:void(0)">Contact Us</a></li>

                            </ul>
                        </nav>

                    </div>

                </div>
                <div class="mobile-curr-lang-wrap">
                    <div class="single-mobile-curr-lang">
                        <a class="mobile-language-active" href="#">Language <i class="icofont-thin-down"></i></a>
                        <div class="lang-curr-dropdown lang-dropdown-active">
                            <ul>
                                <li><a href="#">English (US)</a></li>
                                <li><a href="#">English (UK)</a></li>
                                <li><a href="#">Spanish</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- <div class="single-mobile-curr-lang">
                                <a class="mobile-currency-active" href="#">Currency <i class="icofont-thin-down"></i></a>
                                <div class="lang-curr-dropdown curr-dropdown-active">
                                    <ul>
                                        <li><a href="#">USD</a></li>
                                        <li><a href="#">EUR</a></li>
                                        <li><a href="#">Real</a></li>
                                        <li><a href="#">BDT</a></li>
                                    </ul>
                                </div>
                            </div> -->

                    <div class="single-mobile-curr-lang">
                        <a class="mobile-account-active" href="#">My Account <i class="icofont-thin-down"></i></a>
                        <div class="lang-curr-dropdown account-dropdown-active">
                            <ul>
                                <li><a href="">Login</a></li>
                                <li><a href="../login.html">/ Create Account</a></li>
                                <li><a href="../login.html">My Account</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="mobile-social-wrap">
                    <a class="facebook" href="#"><i class="icofont icofont-facebook"></i></a>
                    <a class="twitter" href="#"><i class="icofont icofont-twitter"></i></a>
                    <a class="pinterest" href="#"><i class="icofont icofont-pinterest"></i></a>
                    <a class="instagram" href="#"><i class="icofont icofont-instagram"></i></a>
                    <a class="google" href="#"><i class="icofont icofont-youtube-play"></i></a>
                </div>
            </div>
        </div>
        <!-- Mobile Menu end Here -->


        <!-- theme fixed shadow -->
        <div>
            <div class="theme__shadow__circle"></div>
            <div class="theme__shadow__circle shadow__right"></div>
        </div>
        <!-- theme fixed shadow -->


        <!-- dashboardarea__menu__start   -->
        <div class="dashboardarea" style="margin-botom: 12px">
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
                                <div class="dashboard__section__title" style="display: flex; justify-content: space-between; align-items: center;">
                                    <h4>Payment</h4>
                                </div>
                                <div class="row">
                                    <div class="col-xl-12">
                                        <form id="PayFast_payment_form" name="PayFast-payment-form" method='post'
                                              action="https://ipg1.apps.net.pk/Ecommerce/api/Transaction/PostTransaction">
                                            <div class="row">
                                                <div class="col-xl-4 disp-none">
                                                    <div class="dashboard__form__wraper">
                                                        <div class="dashboard__form__input">
                                                            <label>Currency</label>
                                                            <input type="text" id="CURRENCY_CODE"
                                                                   name="CURRENCY_CODE"
                                                                   placeholder="Currency code"
                                                                   value="PKR">

                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-xl-4
                                                disp-none">
                                                    <div class="dashboard__form__wraper">
                                                        <div class="dashboard__form__input">
                                                            <label>Merchant ID</label>
                                                            <input type="text" id="MERCHANT_ID"
                                                                   name="MERCHANT_ID"
                                                                   placeholder="Enter Merchant ID"
                                                                   value="{{ env('MERCHANT_ID') }}">
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-xl-4 disp-none">
                                                    <div class="dashboard__form__wraper">
                                                        <div class="dashboard__form__input">
                                                            <label>Test Title</label>
                                                            <input type="text" id="MERCHANT_NAME"
                                                                   name="MERCHANT_NAME"
                                                                   placeholder="Merchant name"
                                                                   value="RTCAT Personality Test" readonly>

                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-xl-4 disp-none
                                                ">
                                                    <div class="dashboard__form__wraper">
                                                        <div class="dashboard__form__input">
                                                            <label>Token</label>
                                                            <input type="text" id="TOKEN"
                                                                   name="TOKEN"
                                                                   placeholder="Token"
                                                                   value="{{ $token }}">

                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-xl-4 disp-none
                                                ">
                                                    <div class="dashboard__form__wraper">
                                                        <div class="dashboard__form__input">
                                                            <label>Success URL</label>
                                                            <input type="url" id="SUCCESS_URL"
                                                                   name="SUCCESS_URL"
                                                                   placeholder="Success Url"
                                                                   value="{{ route('user.paymentSuccess') }}">

                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-xl-4 disp-none
                                                disp-none
                                                ">
                                                    <div class="dashboard__form__wraper">
                                                        <div class="dashboard__form__input">
                                                            <label>Failure URL</label>
                                                            <input type="url" id="FAILURE_URL"
                                                                   name="FAILURE_URL"
                                                                   placeholder="Failure Url"
                                                                   value="{{ route('user.paymentFailed') }}">

                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-xl-4 disp-none

                                                ">
                                                    <div class="dashboard__form__wraper">
                                                        <div class="dashboard__form__input">
                                                            <label>Checkout URL</label>
                                                            <input type="url" id="CHECKOUT_URL"
                                                                   name="CHECKOUT_URL"
                                                                   placeholder="Checkout URL"
                                                                   value="{{ route('user.paymentCheckout') }}">

                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col-xl-6 col-lg-6">
                                                    <div class="dashboard__form__wraper">
                                                        <div class="dashboard__form__input">
                                                            <label>Candidate Name</label>
                                                            <input type="text" id="CUSTOMER_NAME"
                                                                   name="CUSTOMER_NAME"
                                                                   placeholder="Candidate Name"
                                                                   value="{{ Auth::guard('candidate')->user()->name ?? '' }}" readonly disabled>

                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-xl-6 col-lg-6">
                                                    <div class="dashboard__form__wraper">
                                                        <div class="dashboard__form__input">
                                                            <label>Candidate Email</label>
                                                            <input type="email" id="CUSTOMER_EMAIL_ADDRESS"
                                                                   name="CUSTOMER_EMAIL_ADDRESS"
                                                                   placeholder="Candidate email"
                                                                   value="{{ Auth::guard('candidate')->user()->email }}" readonly>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-lg-6">
                                                    <div class="dashboard__form__wraper">
                                                        <div class="dashboard__form__input">
                                                            <label>Candidate Mobile</label>
                                                            <input type="text" id="CUSTOMER_MOBILE_NO"
                                                                   name="CUSTOMER_MOBILE_NO"
                                                                   placeholder="Candidate Mobile number"
                                                                   value="{{ Auth::guard('candidate')->user()->phone_number ?? 000000000000 }}">

                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-xl-6 col-lg-6">
                                                    <div class="dashboard__form__wraper">
                                                        <div class="dashboard__form__input">
                                                            <label>Transaction Amount</label>
                                                            <input readonly type="number" id="TXNAMT"
                                                                   name="TXNAMT"
                                                                   placeholder="Amount"
                                                                   value="{{ $fee ?? 0 }}">

                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-xl-4
                                                disp-none
                                                ">
                                                    <div class="dashboard__form__wraper">
                                                        <div class="dashboard__form__input">
                                                            <label>Basket ID</label>
                                                            <input type="text" id="BASKET_ID"
                                                                   name="BASKET_ID"
                                                                   placeholder="Basket ID"
                                                                   value="{{ $quiz_id }}">

                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-xl-4
                                                disp-none
                                                ">
                                                    <div class="dashboard__form__wraper">
                                                        <div class="dashboard__form__input">
                                                            <label>Transaction Date</label>
                                                            <input type="datetime-local" id="ORDER_DATE"
                                                                   name="ORDER_DATE"
                                                                   placeholder="Currency code"
                                                                   value="{{ date('Y-m-d H:i:s', time()) }}">

                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-xl-4
                                                disp-none
                                                ">
                                                    <div class="dashboard__form__wraper">
                                                        <div class="dashboard__form__input">
                                                            <label>Signature</label>
                                                            <input type="text" id="SIGNATURE"
                                                                   name="SIGNATURE"
                                                                   placeholder="Enter Signature"
                                                                   value="SOMERANDOM-STRING">

                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-xl-4
                                                disp-none
                                                ">
                                                    <div class="dashboard__form__wraper">
                                                        <div class="dashboard__form__input">
                                                            <label>Version</label>
                                                            <input type="text" id="VERSION"
                                                                   name="VERSION"
                                                                   placeholder="Version"
                                                                   value="MERCHANTCART-0.1">

                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-xl-4 disp-none">
                                                    <div class="dashboard__form__wraper">
                                                        <div class="dashboard__form__input">
                                                            <label>Test Description</label>
                                                            <input type="text" id="TXNDESC"
                                                                   name="TXNDESC"
                                                                   placeholder="Test Description"
                                                                   value="{{ $quiz?->title ?? '' }}" readonly disabled>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-xl-4
                                                disp-none
                                                ">
                                                    <div class="dashboard__form__wraper">
                                                        <div class="dashboard__form__input">
                                                            <label>Proccode</label>
                                                            <input type="text" id="PROCCODE"
                                                                   name="PROCCODE"
                                                                   placeholder="Enter PROCCODE"
                                                                   value="00">

                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-xl-4
                                                disp-none

                                                ">
                                                    <div class="dashboard__form__wraper">
                                                        <div class="dashboard__form__input">
                                                            <label>Transaction Type</label>
                                                            <input type="text" id="TRAN_TYPE"
                                                                   name="TRAN_TYPE"
                                                                   placeholder="Transaction Type"
                                                                   value="ECOMM_PURCHASE">

                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-xl-4
                                                disp-none

                                                ">
                                                    <div class="dashboard__form__wraper">
                                                        <div class="dashboard__form__input">
                                                            <label>Store ID/Terminal ID (optional):</label>
                                                            <input type="text" id="STORE_ID"
                                                                   name="STORE_ID"
                                                                   placeholder="Store ID/Terminal ID"
                                                                   value="">

                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-xl-4
                                                    disp-none
                                                ">
                                                    <div class="dashboard__form__wraper">
                                                        <div class="dashboard__form__input">
                                                            <label>Recurring transaction:</label>
                                                            <input type="text" id="RECURRING_TXN"
                                                                   name="RECURRING_TXN"
                                                                   placeholder="Recurring transaction"
                                                                   value="False">

                                                        </div>
                                                    </div>

                                                </div>
                                                <INPUT TYPE="HIDDEN" NAME="MERCHANT_USERAGENT" value="{{ request()->header('User-Agent') }}">
                                                <INPUT TYPE="HIDDEN" NAME="ITEMS[0][SKU]" value="SAMPLE-SKU-01">
                                                <INPUT TYPE="HIDDEN" NAME="ITEMS[0][NAME]" value="{{ $quiz?->title ?? 'Profile Assessment' }}">
                                                <INPUT TYPE="HIDDEN" NAME="ITEMS[0][PRICE]" value="{{ $fee }}">
                                                <INPUT TYPE="HIDDEN" NAME="ITEMS[0][QTY]" value="1">
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="dashboard__form__button">
                                                        <button class="default__button float-end">Pay</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- dashboardarea__menu__end   -->


                @if(Auth::guard('candidate')->check())
                    @includeIf('user.layouts.footer')
                 @endif
    </main>
@push('css')
    <style>
        .disp-none
        {
            display: none;
        }
    </style>
@endpush
@endsection
