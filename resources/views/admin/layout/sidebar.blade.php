<!--
====================================
————————— LEFT SIDEBAR —————————————
====================================
-->
<aside class="left-sidebar bg-sidebar">
    <div id="sidebar" class="sidebar sidebar-with-footer">
        <!-- Aplication Brand -->
        <div class="app-brand">
            <a href="{{ route('dashboard') }}">
                <svg class="brand-icon" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" width="30"
                    height="33" viewBox="0 0 30 33">
                    <g fill="none" fill-rule="evenodd">
                        <path class="logo-fill-blue" fill="#7DBCFF" d="M0 4v25l8 4V0zM22 4v25l8 4V0z" />
                        <path class="logo-fill-white" fill="#FFF" d="M11 4v25l8 4V0z" />
                    </g>
                </svg>
                <span class="brand-name">កូនខ្មែរ Dashboard</span>
            </a>
        </div>
        <!-- begin sidebar scrollbar -->
        <div class="sidebar-scrollbar">

            <!-- sidebar menu -->
            <ul class="nav sidebar-inner" id="sidebar-menu">



                <li class="has-sub {{ request()->is('dashboard*') ? 'active' : '' }}">
                    <a class="sidenav-item-link" href="/dashboard">
                        <i class="fa-solid fa-chart-simple"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
               
                </li>

                @php
                    $url = Request::segment(1);
                    $component = ['slider', 'service', 'about', 'team','contact'];
                    $blog = ['post', 'tag', 'category'];
                    $home = ['brand'];
                @endphp
                <li class="has-sub @if (in_array($url, $home)) expand active @endif">
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#home"
                        aria-expanded="false" aria-controls="dashboard">
                        <i class="fa-solid fa-house"></i>
                        <span class="nav-text">Home</span> <b class="caret"></b>
                    </a>
                    <ul class="collapse {{ request()->is('brand*') ? 'show' : '' }}" id="home"
                        data-parent="#sidebar-menu">
                        <div class="sub-menu">

                            <li class="{{ request()->is('brand*') ? 'active' : '' }}">
                                <a class="sidenav-item-link" href="{{ route('all.brand') }}">
                                    <i class="fa-solid fa-caret-right {{ request()->is('brand*') ? 'fa-beat' : '' }}"></i>
                                    <span class="nav-text">Brand</span>
                                </a>
                            </li>


                        </div>
                    </ul>
                </li>


                <li class="has-sub @if (in_array($url, $component)) expand active @endif">
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#pages"
                        aria-expanded="false" aria-controls="pages">
                        <i class="fa-solid fa-wand-magic-sparkles"></i>
                        <span class="nav-text">COMPONENTS</span> <b class="caret"></b>
                    </a>
                    <ul class="collapse @if (in_array($url, $component)) show @endif" id="pages"
                        data-parent="#sidebar-menu">
                        <div class="sub-menu">


                            <li class="{{ request()->is('slider*') ? 'active' : '' }}">
                                <a class="sidenav-item-link" href="{{ route('all.slider') }}">
                                    <i class="fa-solid fa-caret-right {{ request()->is('slider*') ? 'fa-beat' : '' }}"></i>
                                    <span class="nav-text">SLIDER</span>

                                </a>
                            </li>

                            <li class="{{ request()->is('about*') ? 'active' : '' }}">
                                <a class="sidenav-item-link" href="{{ route('all.about') }}">
                                    <i class="fa-solid fa-caret-right {{ request()->is('about*') ? 'fa-beat' : '' }}"></i>
                                    <span class="nav-text">ABOUT</span>

                                </a>
                            </li>

                            <li class="{{ request()->is('team*') ? 'active' : '' }}">
                                <a class="sidenav-item-link" href="{{ route('all.team') }}">
                                    <i class="fa-solid fa-caret-right {{ request()->is('team*') ? 'fa-beat' : '' }}"></i>
                                    <span class="nav-text">TEAM</span>

                                </a>
                            </li>


                            <li class="{{ request()->is('service*') ? 'active' : '' }}">
                                <a class="sidenav-item-link" href="{{ route('all.service') }}">
                                    <i class="fa-solid fa-caret-right {{ request()->is('service*') ? 'fa-beat' : '' }}"></i>
                                    <span class="nav-text"> SERVICES</span>

                                </a>
                            </li>

                            <li class="{{ request()->is('contact*') ? 'active' : '' }}">
                                <a class="sidenav-item-link" href="{{ route('edit.contact') }}">
                                    <i class="fa-solid fa-caret-right {{ request()->is('contact*') ? 'fa-beat' : '' }}"></i>
                                    <span class="nav-text"> CONTACT</span>

                                </a>
                            </li>



                        </div>
                    </ul>
                </li>

                <li class="has-sub @if (in_array($url, $blog)) expand active @endif">
                    <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#blogs"
                        aria-expanded="false" aria-controls="blogs">
                        <i class="fa-solid fa-signs-post"></i>
                        <span class="nav-text">BLOGS</span> <b class="caret"></b>
                    </a>
                    <ul class="collapse @if (in_array($url, $blog)) show @endif" id="blogs"
                        data-parent="#sidebar-menu">
                        <div class="sub-menu">

                            <li class="{{ request()->is('post*') ? 'active' : '' }}">
                                <a class="sidenav-item-link" href="{{ route('all.post') }}">
                                    <i class="fa-solid fa-caret-right {{ request()->is('post*') ? 'fa-beat' : '' }}"></i>
                                    <span class="nav-text">POSTS</span>

                                </a>
                            </li>

                            <li class="{{ request()->is('tag*') ? 'active' : '' }}">
                                <a class="sidenav-item-link" href="{{ route('all.about') }}">
                                    <i class="fa-solid fa-caret-right {{ request()->is('tag*') ? 'fa-beat' : '' }}"></i>
                                    <span class="nav-text">TAGS</span>

                                </a>
                            </li>

                            <li class="{{ request()->is('category*') ? 'active' : '' }}">
                                <a class="sidenav-item-link" href="{{ route('all.team') }}">
                                    <i class="fa-solid fa-caret-right {{ request()->is('category*') ? 'fa-beat' : '' }}"></i>
                                    <span class="nav-text">CATEGORIES</span>

                                </a>
                            </li>
                        </div>
                    </ul>
                </li>




        </div>
        {{-- 
        <hr class="separator" />

        <div class="sidebar-footer">
            <div class="sidebar-footer-content">
                <h6 class="text-uppercase">
                    Cpu Uses <span class="float-right">40%</span>
                </h6>
                <div class="progress progress-xs">
                    <div class="progress-bar active" style="width: 40%;" role="progressbar"></div>
                </div>
                <h6 class="text-uppercase">
                    Memory Uses <span class="float-right">65%</span>
                </h6>
                <div class="progress progress-xs">
                    <div class="progress-bar progress-bar-warning" style="width: 65%;" role="progressbar">
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</aside>
