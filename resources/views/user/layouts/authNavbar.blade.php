<div class="container-fluid full__width__padding">
    <div class="row">
        <div class="col-xl-12">
            <div class="dashboardarea__wraper">
                <div class="dashboardarea__img">
                    <div class="dashboardarea__inner">
                        <div class="dashboardarea__left">
                            <div class="dashboardarea__left__img">
                                <img loading="lazy"
                                    src="{{ isset(Auth::guard('candidate')->user()->profile->profile_picture) ? asset('public/' . Auth::guard('candidate')->user()->profile->profile_picture) : asset('public/assets/images/avatars/profile-avatar.png') }}"
                                    alt="{{ Auth::guard('candidate')->user()->name }} Profile Picture">
                            </div>
                            <div class="dashboardarea__left__content">
                                <h5>Hello</h5>
                                <h4 id="authenticated_user">
                                    {{ Auth::guard('candidate')->user()->name }}
                                </h4>
                            </div>
                        </div>
                        <div class="dashboardarea__star">
                            @php
                                $percentile = config('settings.profile_percentile'); // Retrieve percentile from middleware
                            @endphp

                            {{-- Display numeric rating and percentile --}}
                            <!-- <span>Percentile {{ round($percentile) }}%</span> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
