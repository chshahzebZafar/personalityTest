<style>
    .disp-none {
        display: none;
    }
</style>
<div class="dashboard__inner sticky-top">
    <div class="dashboard__nav__title">
        <h6>Welcome <br>
            {{ Auth::guard('candidate')->user()->name }}
        </h6>
    </div>
    <div class="dashboard__nav">
        <ul>
            <!--<li>-->
            <!--    <a class="@if(\Illuminate\Support\Facades\Route::currentRouteName() == 'user.dashboard') active @endif"-->
            <!--        href="">-->
            <!--        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"-->
            <!--            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"-->
            <!--            class="feather feather-home">-->
            <!--            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>-->
            <!--            <polyline points="9 22 9 12 15 12 15 22"></polyline>-->
            <!--        </svg>-->
            <!--        Dashboard</a>-->
            <!--</li>-->
            <li id="my_test_side_bar_link" class="">
    <a class="@if(Route::currentRouteName() == 'assessment.test.list') active @endif"
       href="{{ route('assessment.test.list') }}">

       @if(Route::currentRouteName() == '')
           {{-- Active icon --}}
           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-check-circle">
               <circle cx="12" cy="12" r="10"></circle>
               <path d="M9 12l2 2l4-4"></path>
           </svg>
       @else
           {{-- Default icon --}}
           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-help-circle">
               <circle cx="12" cy="12" r="10"></circle>
               <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
               <line x1="12" y1="17" x2="12.01" y2="17"></line>
           </svg>
       @endif

       Download Result
    </a>
</li>
            <li>
                <a class="@if(Route::currentRouteName() == 'candidate.payment.history') active @endif"
                   href="{{ route('candidate.payment.history') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                        <line x1="1" y1="10" x2="23" y2="10"></line>
                    </svg>
                    Transaction History
                </a>
            </li>
            <li id="my_test_side_bar_link" class="">
                <a class="@if(Route::currentRouteName() == 'attemptTest') active @endif"
                   href="{{ route('attemptTest') }}">

                        {{-- Default icon --}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-help-circle">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                            <line x1="12" y1="17" x2="12.01" y2="17"></line>
                        </svg>
                    Attempt Personality Test
                </a>
            </li>
            <li>
                <a href="{{ route('candidate.logout') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="feather feather-volume-1">
                        <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"></polygon>
                        <path d="M15.54 8.46a5 5 0 0 1 0 7.07"></path>
                    </svg>
                    Logout</a>
            </li>
        </ul>
    </div>
</div>
