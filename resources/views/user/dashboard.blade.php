@extends('user.layouts.master',[
    'title' => '| Dashboard'
])
@section('main-content')
<main class="main_wrapper overflow-hidden">
    <!-- headar section start -->
    @includeIf('user.layouts.header')
    <!-- header section end -->

    <!-- Mobile Menu Start Here -->
    <div class="mobile-off-canvas-active">
        <a class="mobile-aside-close"><i class="icofont  icofont-close-line"></i></a>
        <div class="header-mobile-aside-wrap">
            <!--   <div class="mobile-search">
                      <form class="search-form" action="#">
                          <input type="text" placeholder="Search entire store…">
                          <button class="button-search"><i class="icofont icofont-search-2"></i></button>
                      </form>
                  </div> -->
            <div class="mobile-menu-wrap headerarea">

                <div class="mobile-navigation">

                    <nav>
                        <ul class="mobile-menu">
                            <li class="menu-item-has-children"><a href="{{ route('assessment.test.list') }}">Download Result</a></li>
                            <li class="menu-item"><a href="{{ route('attemptTest') }}">Attempt Personality Test</a></li>
                        </ul>
                    </nav>

                </div>

            </div>
        </div>
    </div>
    

    <!-- dashboardarea__area__start  -->
    <div class="dashboardarea" style="margin-botom: 12px">
        @auth('candidate')
        @includeIf('user.layouts.authNavbar')
        @endauth
        <div class="dashboard">
            <div class="container-fluid full__width__padding">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-12">
                        @auth('candidate')
                        @includeIf('user.layouts.left-sidebar')
                        @endauth
                    </div>
                    <div class="col-xl-9 col-lg-9 col-md-12">
                        <div class="dashboard__content__wraper">
                            <div class="dashboard__section__title">
                                <h4>Dashboard</h4>
                            </div>
{{--                            <div class="row">--}}
{{--                                <div class="col-xl-4 col-lg-6 col-md-12 col-12">--}}
{{--                                    <a href="">--}}
{{--                                        <div class="dashboard__single__counter">--}}
{{--                                            <div class="counterarea__text__wraper">--}}
{{--                                                <div class="counter__img">--}}
{{--                                                    <img loading="lazy"--}}
{{--                                                        src="{{ asset('public/user/img/counter/counter__1.png') }}"--}}
{{--                                                        alt="counter">--}}
{{--                                                </div>--}}
{{--                                                <div class="counter__content__wraper">--}}
{{--                                                    <div class="counter__number">--}}
{{--                                                        <span class="counter">{{ $testCompleted ?? 0 }}</span>--}}
{{--                                                    </div>--}}
{{--                                                    <p>Test Completed</p>--}}

{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                                <div class="col-xl-4 col-lg-6 col-md-12 col-12 enrollmnt_tab"--}}
{{--                                    title="Click to Enroll Now">--}}
{{--                                    <a href="">--}}
{{--                                        <div class="dashboard__single__counter">--}}
{{--                                            <div class="counterarea__text__wraper">--}}
{{--                                                <div class="counter__img">--}}
{{--                                                    <img loading="lazy"--}}
{{--                                                        src="{{ asset('public/user/img/counter/counter__2.png') }}"--}}
{{--                                                        alt="counter">--}}
{{--                                                </div>--}}

{{--                                                <div class="counter__content__wraper">--}}
{{--                                                    <div class="counter__number">--}}
{{--                                                        <span class="counter">{{ $totalUpcomingBatches ?? 0 }}</span>--}}
{{--                                                    </div>--}}
{{--                                                    <p>Upcoming RTCAT Batches</p>--}}

{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                                <div class="col-xl-4 col-lg-6 col-md-12 col-12">--}}
{{--                                    <div class="dashboard__single__counter">--}}
{{--                                        <div class="counterarea__text__wraper">--}}
{{--                                            <div class="counter__img">--}}
{{--                                                <img loading="lazy"--}}
{{--                                                    src="{{ asset('public/user/img/counter/counter__3.png') }}"--}}
{{--                                                    alt="counter">--}}
{{--                                            </div>--}}
{{--                                            <div class="counter__content__wraper">--}}
{{--                                                <div class="counter__number">--}}
{{--                                                    <span class="counter">0</span>--}}
{{--                                                </div>--}}
{{--                                                <p>Recommended Tests</p>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-xl-4 col-lg-6 col-md-12 col-12">--}}
{{--                                    <a href="">--}}
{{--                                        <div class="dashboard__single__counter">--}}
{{--                                            <div class="counterarea__text__wraper">--}}
{{--                                                <div class="counter__img">--}}
{{--                                                    <img loading="lazy"--}}
{{--                                                        src="{{ asset('public/user/img/counter/counter__4.png') }}"--}}
{{--                                                        alt="counter">--}}
{{--                                                </div>--}}
{{--                                                <div class="counter__content__wraper">--}}
{{--                                                    <div class="counter__number">--}}
{{--                                                        <span class="counter">{{ $totalCertificates ?? 0 }}</span>--}}

{{--                                                    </div>--}}
{{--                                                    <p>Certificates</p>--}}

{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </a>--}}
{{--                                </div>--}}

{{--                                <div class="col-xl-4 col-lg-6 col-md-12 col-12">--}}
{{--                                    <a href="">--}}
{{--                                        <div class="dashboard__single__counter">--}}
{{--                                            <div class="counterarea__text__wraper">--}}
{{--                                                <div class="counter__img">--}}
{{--                                                    <img loading="lazy"--}}
{{--                                                        src="{{ asset('public/user/img/counter/counter__3.png') }}"--}}
{{--                                                        alt="counter">--}}
{{--                                                </div>--}}
{{--                                                <div class="counter__content__wraper">--}}
{{--                                                    <div class="counter__number">--}}
{{--                                                        <span class="counter">{{ $testCompleted ?? 0 }}</span>--}}

{{--                                                    </div>--}}
{{--                                                    <p>Results</p>--}}

{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                                <div class="col-xl-4 col-lg-6 col-md-12 col-12">--}}
{{--                                    <div class="dashboard__single__counter">--}}
{{--                                        <div class="counterarea__text__wraper">--}}
{{--                                            <div class="counter__img">--}}
{{--                                                <img loading="lazy"--}}
{{--                                                    src="{{ asset('public/user/img/counter/counter__4.png') }}"--}}
{{--                                                    alt="counter">--}}
{{--                                            </div>--}}
{{--                                            <div class="counter__content__wraper">--}}
{{--                                                <div class="counter__number">--}}
{{--                                                    <!--<span class="counter">Coming Soon</span>-->--}}
{{--                                                    <span class="counter">0</span>--}}

{{--                                                </div>--}}
{{--                                                <p>Promotions</p>--}}

{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                        {{-- <div class="dashboard__content__wraper">--}}
                            {{-- <div class="dashboard__section__title">--}}
                                {{-- <h4>Dashboard</h4>--}}
                                {{-- <a href="../course.html">See More...</a>--}}
                                {{-- </div>--}}
                            {{-- <div class="row">--}}
                                {{-- <div class="col-xl-12">--}}
                                    {{-- <div class="dashboard__table table-responsive">--}}
                                        {{-- <table>--}}
                                            {{-- <thead>--}}
                                                {{-- <tr>--}}
                                                    {{-- <th>Course Name</th>--}}
                                                    {{-- <th>Enrolled</th>--}}
                                                    {{-- <th>Rating</th>--}}
                                                    {{-- </tr>--}}
                                                {{-- </thead>--}}
                                            {{-- <tbody>--}}
                                                {{-- <tr>--}}
                                                    {{-- <th><a href="#">Javascript</a></th>--}}
                                                    {{-- <td>1100</td>--}}
                                                    {{-- <td>--}}
                                                        {{-- <div class="dashboard__table__star">--}}
                                                            {{-- <i class="icofont-star"></i>--}}
                                                            {{-- <i class="icofont-star"></i>--}}
                                                            {{-- <i class="icofont-star"></i>--}}
                                                            {{-- <i class="icofont-star"></i>--}}
                                                            {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="feather feather-star">
                                                                <polygon
                                                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                                </polygon>
                                                            </svg>--}}
                                                            {{-- </div>--}}
                                                        {{-- </td>--}}
                                                    {{-- </tr>--}}
                                                {{-- <tr class="dashboard__table__row">--}}
                                                    {{-- <th><a href="#">PHP</a></th>--}}
                                                    {{-- <td>700</td>--}}
                                                    {{-- <td>--}}
                                                        {{-- <div class="dashboard__table__star">--}}
                                                            {{-- <i class="icofont-star"></i>--}}
                                                            {{-- <i class="icofont-star"></i>--}}
                                                            {{-- <i class="icofont-star"></i>--}}
                                                            {{-- <i class="icofont-star"></i>--}}
                                                            {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="feather feather-star">
                                                                <polygon
                                                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                                </polygon>
                                                            </svg>--}}
                                                            {{-- </div>--}}
                                                        {{-- </td>--}}
                                                    {{-- </tr>--}}
                                                {{-- <tr>--}}
                                                    {{-- <th><a href="#">HTML</a></th>--}}
                                                    {{-- <td>1350</td>--}}
                                                    {{-- <td>--}}
                                                        {{-- <div class="dashboard__table__star">--}}
                                                            {{-- <i class="icofont-star"></i>--}}
                                                            {{-- <i class="icofont-star"></i>--}}
                                                            {{-- <i class="icofont-star"></i>--}}
                                                            {{-- <i class="icofont-star"></i>--}}
                                                            {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="feather feather-star">
                                                                <polygon
                                                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                                </polygon>
                                                            </svg>--}}
                                                            {{-- </div>--}}
                                                        {{-- </td>--}}
                                                    {{-- </tr>--}}
                                                {{-- <tr class="dashboard__table__row">--}}
                                                    {{-- <th><a href="#">Graphic</a></th>--}}
                                                    {{-- <td>1266</td>--}}
                                                    {{-- <td>--}}
                                                        {{-- <div class="dashboard__table__star">--}}
                                                            {{-- <i class="icofont-star"></i>--}}
                                                            {{-- <i class="icofont-star"></i>--}}
                                                            {{-- <i class="icofont-star"></i>--}}
                                                            {{-- <i class="icofont-star"></i>--}}
                                                            {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="feather feather-star">
                                                                <polygon
                                                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                                                </polygon>
                                                            </svg>--}}
                                                            {{-- </div>--}}
                                                        {{-- </td>--}}
                                                    {{-- </tr>--}}
                                                {{-- </tbody>--}}
                                            {{-- </table>--}}
                                        {{-- </div>--}}
                                    {{-- </div>--}}
                                {{-- </div>--}}
                            {{-- </div>--}}
                    </div>


                </div>
            </div>
        </div>

    </div>
    <!-- dashboardarea__area__end   -->
    @include('user.layouts.footer')
</main>
@push('css')
    <style>
        .dashboard__single__counter:hover {
            background-color: #ff7913;
        }
    </style>
@endpush
@endsection
