<div class="service-details-area pt-100 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="service-side-bar">
                    

                    <div class="services-bar-widget">
                        <h3 class="title">User Sidebar</h3>
                        <div class="side-bar-categories">
<img src="{{ (!empty($profileData->photo) ? asset('upload/user_images/'.$profileData->photo) : url('upload/no_image.jpg')) }}" class="rounded mx-auto d-block" alt="Image" style="width:100px; height:80px;"> 
<div class="text-center" style="font-weight: bold"><br>
    <p>{{$profileData->name}}</p>
    <p>{{$profileData->email}}</p>
</div>
<br>

<ul> 
    
    <li>
        <a href="{{ route('dashboard') }}">User Dashboard</a>
    </li>
    <li>
        <a href="{{ route('user.profile') }}">User Profile </a>
    </li>
    <li>
        <a href="{{ route('user.change.password') }}">Change Password</a>
    </li>
    <li>
        <a href="{{route('user.bookings')}}">Booking Details </a>
    </li>
    <li>
        <a href="{{ route('user.logout') }}">Logout </a>
    </li>
</ul>
                        </div>
                    </div>

                
                </div>
</div>