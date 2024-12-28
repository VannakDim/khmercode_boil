<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

        <h1 class="logo mr-auto kh-koulen"><a href="/"><span>កូនខ្មែរ</span>កូដ</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html" class="logo mr-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

        <nav class="nav-menu d-none d-lg-block">

            <ul>

                <li class="{{ request()->is('/') ? 'active' : '' }}"><a href="/">Home</a></li>
                <li class="{{ request()->is('blog*') ? 'active' : '' }}"><a href="{{ route('home.blog') }}">Blog</a></li>

                <li class="{{ request()->is('about') ? 'active' : '' }}"><a href="{{ route('home.about') }}">About</a>
                    {{-- <ul>
                        <li><a href="{{ route('home.about') }}">About Us</a></li>
                        <li><a href="team.html">Team</a></li>
                        <li><a href="testimonials.html">Testimonials</a></li>
                        <li class="drop-down"><a href="#">Deep Drop Down</a>
                            <ul>
                                <li><a href="#">Deep Drop Down 1</a></li>
                                <li><a href="#">Deep Drop Down 2</a></li>
                            </ul>
                        </li> 
                    </ul> --}}
                </li>

                {{-- <li><a href="services.html">Services</a></li>
                <li><a href="portfolio.html">Portfolio</a></li>
                <li><a href="pricing.html">Pricing</a></li>
                <li><a href="blog.html">Blog</a></li> --}}
                <li class="{{ request()->is('contact') ? 'active' : '' }}">
                    <a href="{{ route('home.contact') }}">Contact</a>
                </li>

                <li><a href="#" class="facebook"><i class="fa-brands fa-facebook social-link"></i></a></li>
                <li><a href="#" class="instagram"><i class="fa-brands fa-square-instagram social-link"></i></a></li>
                <li><a href="#" class="linkedin"><i class="fa-brands fa-linkedin social-link"></i></a></li>



            </ul>
        </nav><!-- .nav-menu -->
    </div>
</header><!-- End Header -->
