@extends('frontend.layout.base')

@section('title', "About ours university")

@section('content')
    <div class="xs-sidebar-group info-group">
        <div class="xs-overlay xs-bg-black"></div>
        <div class="xs-sidebar-widget">
            <div class="sidebar-widget-container">
                <div class="widget-heading">
                    <a href="#" class="close-side-widget">
                        X
                    </a>
                </div>
                <div class="sidebar-textwidget">

                    <div class="sidebar-info-contents">
                        <div class="content-inner">
                            <div class="logo">
                                <a href="index.html"><img src="images/logo-2.png" alt=""/></a>
                            </div>
                            <div class="content-box">
                                <h2>About Us</h2>
                                <p class="text">The argument in favor of using filler text goes something like this: If
                                    you use real content in the Consulting Process, anytime you reach a review point
                                    you’ll end up reviewing and negotiating the content itself and not the design.</p>
                                <a href="#" class="theme-btn btn-style-two"><span class="txt">Se connecter</span></a>
                            </div>
                            <ul class="social-box">
                                <li class="facebook"><a href="#" class="fa fa-facebook-f"></a></li>
                                <li class="twitter"><a href="#" class="fa fa-twitter"></a></li>
                                <li class="linkedin"><a href="#" class="fa fa-linkedin"></a></li>
                                <li class="instagram"><a href="#" class="fa fa-instagram"></a></li>
                                <li class="youtube"><a href="#" class="fa fa-youtube"></a></li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <section class="contact-banner-section">
        <div class="pattern-layer-one" style=></div>
        <div class="pattern-layer-two" style=></div>
        <div class="pattern-layer-three" style=></div>
        <div class="auto-container">
            <div class="content-box">
                <h2>Fees</h2>
                <div class="text">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat
                    nulla pariatur Duis aute irure dolor in reprehenderit in
                </div>
            </div>
        </div>
    </section>
    <section class="professional-section">
        <div class="background-layer-one" style=></div>
        <div class="auto-container">
            <div class="row clearfix">

                <div class="images-column col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <div class="pattern-layer" style=></div>
                        <div class="pattern-layer-two" style=></div>
                        <div class="color-layer"></div>
                        <div class="color-layer-two"></div>
                        <div class="image wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                            <div class="image">
                                <img src="images/resource/contact.png" alt=""/>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content-column col-lg-6 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <div class="pattern-layer-three" style=></div>
                        <div class="sec-title">
                            <div class="title">Fees</div>
                            <h2>More about our <br/> Fees</h2>
                        </div>
                        <div class="bold-text"><p>recently with desktop publishing software like Aldus PageMaker
                                including versions of Lorem Ipsum.</p></div>
                        <div class="btn-box">
                            <Link to={'/'} class="theme-btn btn-style-four">
                            <span class="txt">Download</span></Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
