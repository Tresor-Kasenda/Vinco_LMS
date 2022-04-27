<footer class="main-footer">
    <div class="circle-layer"></div>
    <div class="pattern-layer-one" style="background-image: url(images/background/pattern-12.png)"></div>
    <div class="pattern-layer-two" style="background-image: url(images/background/pattern-13.png)"></div>
    <div class="pattern-layer-three" style="background-image: url(images/background/pattern-14.png)"></div>
    <div class="pattern-layer-four" style="background-image: url(images/background/pattern-13.png)"></div>
    <div class="auto-container">
        <div class="widgets-section">
            <div class="row clearfix">
                <div class="footer-column col-lg-5 col-md-12 col-sm-12">
                    <div class="footer-widget logo-widget">
                        <div class="logo">
                            <a href="{{ route('home.index') }}">
                                <img src="{{ asset('assets/apps/images/logo.png') }}" alt="" />
                            </a>
                        </div>
                        <ul class="info-list">
                            <li>Tel:<a href="tel:+0845-371-02-02"> 0845 371 02 02</a></li>
                            <li>Email:<a href="mailto:info@yoursite.co.uk"> info@yoursite.co.uk</a></li>
                        </ul>
                        <ul class="social-box">
                            <li class="twitter"><a target="_blank" href="http://twitter.com/" class="fa fa-twitter"></a></li>
                            <li class="pinterest"><a target="_blank" href="http://pinterest.com/" class="fa fa-pinterest-p"></a></li>
                            <li class="facebook"><a target="_blank" href="http://facebook.com/" class="fa fa-facebook-f"></a></li>
                            <li class="dribbble"><a target="_blank" href="http://dribbble.com/" class="fa fa-dribbble"></a></li>
                        </ul>
                    </div>
                </div>
                <div class="footer-column col-lg-7 col-md-12 col-sm-12">
                    <div class="row clearfix">
                        <div class="column col-lg-4 col-md-4 col-sm-12">
                            <h5>About</h5>
                            <ul class="list">
                                <li><a href="#">About</a></li>
                                <li><a href="#">News</a></li>
                                <li><a href="#">Impact</a></li>
                            </ul>
                        </div>
                        <div class="column col-lg-4 col-md-4 col-sm-12">
                            <h5>Need some help?</h5>
                            <ul class="list">
                                <li><a href="#">FAQs</a></li>
                                <li><a href="#">Child safety</a></li>
                                <li><a href="#">Help Centre</a></li>
                            </ul>
                        </div>
                        <div class="column col-lg-4 col-md-4 col-sm-12">
                            <h5>Courses</h5>
                            <ul class="list">
                                <li><a href="#">Khan Kids app</a></li>
                                <li><a href="#">Science & engineering</a></li>
                                <li><a href="#">Computing</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="row clearfix">
                <div class="copyright-column col-lg-6 col-md-12 col-sm-12">
                    <div class="copyright">Copyright {{ now()->format('Y') }}, All Right Reserved</div>
                </div>
                <div class="nav-column col-lg-6 col-md-12 col-sm-12">
                    <ul>
                        <li><a href="about.html">SiteMap</a></li>
                        <li><a href="about.html">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
