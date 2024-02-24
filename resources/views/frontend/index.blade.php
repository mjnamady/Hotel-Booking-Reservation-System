 @extends('frontend.main_master')
 @section('main')
     
        <!-- Banner Area -->
        <div class="banner-area" style="height: 480px;">
            <div class="container">
                <div class="banner-content">
                    <h1>Discover a Hotel & Resort to Book a Suitable Room</h1>
                    
                    
                </div>
            </div>
        </div>
        <!-- Banner Area End -->

        <!-- Banner Form Area -->
       @include('frontend.home.banner_form')
        <!-- Banner Form Area End -->

        <!-- Room Area -->
        @include('frontend.home.room_area')
        <!-- Room Area End -->

        <!-- Book Area Two-->
        @include('frontend.home.book_area_two')
        <!-- Book Area Two End -->

        <!-- Services Area Three -->
        @include('frontend.home.services')
        <!-- Services Area Three End -->

        <!-- Team Area Three -->
        @include('frontend.home.team_area')
        <!-- Team Area Three End -->

        <!-- Testimonials Area Three -->
        @include('frontend.home.testimonials_area')
        <!-- Testimonials Area Three End -->

        <!-- FAQ Area -->
        @include('frontend.home.faq_area')
        <!-- FAQ Area End -->

        <!-- Blog Area -->
        @include('frontend.home.blog_area')
        <!-- Blog Area End -->
@endsection