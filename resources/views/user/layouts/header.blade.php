@if(Auth::guard('candidate')->check())
    <header>
        <div class="headerarea headerarea__3 header__sticky header__area">
            <div class="container desktop__menu__wrapper">
                <div class="row">
                    <div class="col-xl-2 col-lg-2 col-md-6">
                        <div class="headerarea__left">
                            <div class="headerarea__left__logo">

                                <a href=""><img style="    width: 140px;" loading="lazy"
                                        src="{{ asset('public/user/img/login/1733810127.webp') }}"
                                        alt="{{ config('settings.site_detail.company_name') }} logo"></a>
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-7 main_menu_wrap">
                        <div class="headerarea__main__menu">
                            <nav>
                            </nav>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="headerarea__right">

                        </div>
                    </div>

                </div>

            </div>


            <div class="container-fluid mob_menu_wrapper">
                <div class="row align-items-center">
                    <div class="col-6">
                        <div class="mobile-logo">
                            <a class="logo__dark" href="#">
                                <img loading="lazy" src="{{ asset('public/user/img/login/1733810127.webp') }}" alt="logo"></a>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="header-right-wrap">
                            <!--<div class="headerarea__login">-->
                            <!--    <a href="login.html"><i class="icofont-user-alt-5"></i></a>-->
                            <!--</div>-->

                            <div class="mobile-off-canvas">
                                <a class="mobile-aside-button" href="#"><i class="icofont-navigation-menu"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
@else
    <!--<div class="topbararea">-->
    <!--    <div class="container">-->
    <!--        <div class="row">-->
    <!--            <div class="col-xl-6 col-lg-6">-->
    <!--                <div class="topbar__left">-->
    <!--                    <ul>-->
    <!--                        <li>-->
    <!--                            Call Us: +92 341 3743 196-->
    <!--                        </li>-->
    <!--                        <li>-->
    <!--                            - Mail Us: MWaqas1512@gmail.com-->
    <!--                        </li>-->
    <!--                    </ul>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="col-xl-6 col-lg-6">-->
    <!--                <div class="topbar__right">-->
    <!--                    <div class="topbar__icon">-->
    <!--                        <i class="icofont-location-pin"></i>-->
    <!--                    </div>-->
    <!--                    <div class="topbar__text">-->
    <!--                        <p>DGKhan, Punjab Pakistan</p>-->
    <!--                    </div>-->
    <!--                    <div class="topbar__list">-->
    <!--                        <ul>-->
    <!--                            <li>-->
    <!--                                <a href="#"><i class="icofont-facebook"></i></a>-->
    <!--                            </li>-->
    <!--                            <li>-->
    <!--                                <a href="#"><i class="icofont-twitter"></i></a>-->
    <!--                            </li>-->
    <!--                            <li>-->
    <!--                                <a href="#"><i class="icofont-instagram"></i></a>-->
    <!--                            </li>-->
    <!--                            <li>-->
    <!--                                <a href="#"><i class="icofont-youtube-play"></i></a>-->
    <!--                            </li>-->
    <!--                        </ul>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->
    <header>
        <div class="headerarea headerarea__3 header__sticky header__area">
            <div class="container desktop__menu__wrapper">
                <div class="row">
                    <div class="col-xl-2 col-lg-2 col-md-6">
                        <div class="headerarea__left">
                            <div class="headerarea__left__logo">

                                <a href="{{ route('user.index') }}"><img loading="lazy"
                                        src="{{ asset('public/user/img/logo/logo_1.png') }}" alt="logo"
                                        style="height: 60px; width: auto;"></a>
                            </div>

                        </div>
                    </div>
                    <!--<div class="col-xl-7 col-lg-7 main_menu_wrap">-->
                    <!--    <div class="headerarea__main__menu">-->
                    <!--        <nav>-->
                                <!--<ul>-->
                                    <!--<li class="active"><a href="">Home</a></li>-->
                                    <!--<li class=""><a href="">About</a></li>-->
                                <!--    <li><a class="headerarea__has__dropdown"-->
                                <!--            href="">Services</a>-->
                                        <!--<ul class="headerarea__submenu headerarea__submenu--third--wrap">-->
                                        <!--    <li><a href="">Resume Building</a> </li>-->
                                        <!--    <li>-->
                                        <!--        <a href="">Interview Preparation</a></li>-->
                                        <!--    <li><a href="">Personal Growth Test </a></li>-->
                                        <!--</ul>-->
                                <!--    </li>-->
                                    <!--<li class=""><a href=""> RTAPP Blog</a></li>-->
                                <!--    <li class=""><a href="">Contact Us</a></li>-->
                                <!--</ul>-->
                    <!--        </nav>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="hreobannerarea__button__2">
                            <a class="default__button" href="{{ route('login') }}"> Login</a>
                            <a class="default__button hreobannerarea__button__3"
                                href="{{ route('register') }}">Register</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid mob_menu_wrapper">
                <div class="row align-items-center">
                    <div class="col-6">
                        <div class="mobile-logo">
                            <a class="logo__dark" href="#"><img loading="lazy"
                                    src="{{ asset('public/user/img/logo/rtcat-logo.png') }}" alt="rtcat-logo"
                                    style="height: 60px; width: auto;"></a>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="header-right-wrap">
                            <div class="headerarea__login">
                                <a href="{{ route('user.login') }}"><i class="icofont-user-alt-5"></i></a>
                            </div>

                            <div class="mobile-off-canvas">
                                <a class="mobile-aside-button" href="#"><i class="icofont-navigation-menu"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endif
