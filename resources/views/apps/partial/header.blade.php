<header class="main-header header-style-two">
    <div class="header-upper">
        <div class="outer-container clearfix">
            <div class="pull-left logo-box">
                <div class="logo">
                    <a href="{{ route('home.index') }}">
                        <img
                            class="img-fluid"
                            style="height: 40px; width:90px; margin: 0; padding: 0; "
                            src="{{ asset('assets/apps/images/VincoWhite/SVG/Vinco color French.svg') }}" alt="" title="">
                    </a>
                </div>
            </div>
            <div class="nav-outer clearfix">
                <div class="mobile-nav-toggler">
                    <span class="icon flaticon-menu"></span>
                </div>
                <nav class="main-menu navbar-expand-md">
                    <div class="navbar-header">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="navbar-collapse collapse clearfix" id="navbarSupportedContent">
                        <ul class="navigation clearfix">
                            <li class="dropdown has-mega-menu">
                                <a href="#">
                                    <span>Campus <i class="fa fa-arrow-down"></i></span>
                                </a>
                                <div class="mega-menu">
                                    <div class="upper-box">
                                        <div class="page-links-box">
                                            <a href="#" class="link"><span class="icon flaticon-bullhorn"></span>Marketing</a>
                                            <a href="#" class="link"><span class="icon flaticon-cyclist"></span>Lifestyle</a>
                                            <a href="#" class="link"><span class="icon flaticon-bar-chart"></span>Business</a>
                                            <a href="#" class="link"><span class="icon flaticon-software"></span>Software</a>
                                            <a href="#" class="link"><span class="icon flaticon-atom"></span>Science</a>
                                            <a href="#" class="link"><span class="icon flaticon-webpage"></span>IT Management</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li><a href="{{ route('home.index') }}">Home</a></li>
                            <li><a href="{{ route('about.index') }}">About</a></li>
                            <li><a href="{{ route('courses.index') }}">Short courses</a></li>
                            <li><a href="{{ route('calendar.index') }}">Calendar</a></li>
                            <li><a href="{{ route('fees.index') }}">Fees</a></li>
                            <li><a href="{{ route('events.index') }}">Events</a></li>
                            <li><a href="{{ route('library.index') }}">Libraries</a></li>
                        </ul>
                    </div>
                </nav>
                <div class="outer-box clearfix">
                    <div class="cart-box">
                        <div class="dropdown">
                            <button class="cart-box-btn dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="flaticon-shopping-bag-1"></span>
                                <span class="total-cart">2</span>
                            </button>
                            <div class="dropdown-menu pull-right cart-panel" aria-labelledby="dropdownMenu1">
                                <div class="cart-product">
                                    <div class="inner">
                                        <div class="cross-icon">
                                            <span class="icon fa fa-remove"></span>
                                        </div>
                                        <div class="image">
                                            <img src="" alt="" />
                                        </div>
                                        <h3><a href="#">Product 01</a></h3>
                                        <div class="quantity-text">Quantity 1</div>
                                        <div class="price">$99.00</div>
                                    </div>
                                </div>
                                <ul class="btns-boxed">
                                    <li><a href="#">View All</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="nav-btn navSidebar-button">
                        <span class="icon flaticon-menu-4"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="sticky-header">
        <div class="auto-container clearfix">
            <div class="logo pull-left">
                <a href="{{ route('home.index') }}" title="">
                    <img src="{{ asset('assets/apps/images/logo.png') }}" alt="" title="">
                </a>
            </div>
            <div class="pull-right">
                <nav class="main-menu"></nav>
                <div class="outer-box clearfix"></div>
            </div>
        </div>
    </div>

    <div class="mobile-menu">
        <div class="menu-backdrop"></div>
        <div class="close-btn">
            <span class="icon flaticon-multiply"></span>
        </div>
        <nav class="menu-box">
            <div class="nav-logo">
                <a href="{{ route('home.index') }}">
                    <img src="{{ asset('assets/apps/images/logo.png') }}" alt="" title="">
                </a>
            </div>
            <div class="menu-outer"></div>
        </nav>
    </div>
</header>
