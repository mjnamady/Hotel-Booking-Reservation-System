@php
    $settings = App\Models\SiteSetting::find(1);
@endphp
 <!-- Top Header Start -->
 <header class="top-header top-header-bg">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-2 pr-0">
                <div class="language-list">
                    <select class="language-list-item">
                        <option>English</option>
                        <option>العربيّة</option>
                        <option>Deutsch</option>
                        <option>Português</option>
                        <option>简体中文</option>
                    </select>	
                </div>
            </div>

            <div class="col-lg-9 col-md-10">
                <div class="header-right">
                    <ul>
                        <li>
                            <i class='bx bx-home-alt'></i>
                            <a href="#">{{ $settings->address }}</a>
                        </li>
                        <li>
                            <i class='bx bx-phone-call'></i>
                            <a href="tel:+1-(123)-456-7890">{{ $settings->phone }}</a>
                        </li>
                        @auth
                            <li>
                                <i class='bx bxs-user-pin'></i>
                                <a href="{{ route('dashboard') }}">Dashboard</a>
                            </li>

                            <li>
                                <i class='bx bxs-user-rectangle'></i>
                                <a href="{{ route('user.logout') }}">Logout</a>
                            </li>
                        @else
                            <li>
                                <i class='bx bxs-user-pin'></i>
                                <a href="{{ route('login') }}">Login</a>
                            </li>

                            <li>
                                <i class='bx bxs-user-rectangle'></i>
                                <a href="{{ route('register') }}">Register</a>
                            </li>
                        @endauth
                       
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Top Header End -->

<!-- Start Navbar Area -->
<div class="navbar-area">
    <!-- Menu For Mobile Device -->
    <div class="mobile-nav">
        <a href="{{ url('/') }}" class="logo">
            <img src="{{asset($settings->logo)}}" class="logo-one" alt="Logo">
            <img src="{{asset($settings->logo)}}" class="logo-two" alt="Logo">
        </a>
    </div>

    <!-- Menu For Desktop Device -->
    <div class="main-nav">
        <div class="container">
            <nav class="navbar navbar-expand-md navbar-light ">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{asset($settings->logo)}}" class="logo-one" alt="Logo">
                    <img src="{{asset($settings->logo)}}" class="logo-two" alt="Logo">
                </a>

                <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                    <ul class="navbar-nav m-auto">
                        <li class="nav-item">
                            <a href="{{ url('/') }}" class="nav-link active">
                                Home
                            </a>
                            
                        </li>
                        <li class="nav-item">
                            <a href="about.html" class="nav-link">
                                About
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Restaurant 
                            </a>
                          
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Recreation 
                            </a>
                            
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('all.gallery.image') }}" class="nav-link">
                                Gallery
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('all.blogs') }}" class="nav-link">
                                Blog
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('all.rooms.page') }}" class="nav-link">
                                All Rooms
                                <i class='bx bx-chevron-down'></i>
                            </a>
                            @php
                                $allrooms = App\Models\Room::all();
                            @endphp
                            <ul class="dropdown-menu">
                                @foreach ($allrooms as $item)
                                    <li class="nav-item">
                                        <a href="room.html" class="nav-link">
                                            {{ $item['type']['name'] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('contact.page') }}" class="nav-link">
                                Contact
                            </a>
                        </li>

                        <li class="nav-item-btn">
                            <a href="#" class="default-btn btn-bg-one border-radius-5">Book Now</a>
                        </li>
                    </ul>

                    <div class="nav-btn">
                        <a href="#" class="default-btn btn-bg-one border-radius-5">Book Now</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
<!-- End Navbar Area -->