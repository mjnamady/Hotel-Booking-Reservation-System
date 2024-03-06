@extends('frontend.main_master')
@section('main')



<!-- Inner Banner -->
<div class="inner-banner inner-bg4">
    <div class="container">
        <div class="inner-title">
            <ul>
                <li>
                    <a href="/">Home</a>
                </li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li>{{ $scat->category_name }}</li>
            </ul>
            <h3>{{ $scat->category_name }}</h3>
        </div>
    </div>
</div>
<!-- Inner Banner End -->

<!-- Blog Style Area -->
<div class="blog-style-area pt-100 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">

                @foreach ($blogs as $blog)
                <div class="col-lg-12">
                    <div class="blog-card">
                        <div class="row align-items-center">
                            <div class="col-lg-5 col-md-4 p-0">
                                <div class="blog-img">
                                    <a href="{{ url('blog/post/detail',$blog->post_slug) }}">
                                        <img src="{{ url($blog->post_image) }}" alt="Images">
                                    </a>
                                </div>
                            </div>

                            <div class="col-lg-7 col-md-8 p-0">
                                <div class="blog-content">
                                    <span>{{ $blog->created_at->format('M D, Y') }}</span>
                                    <h3>
                                        <a href="{{ url('blog/post/detail',$blog->post_slug) }}">{{ $blog->post_title }}</a>
                                    </h3>
                                    <p>{{ $blog->short_desc }}</p>
                                    <a href="{{ url('blog/post/detail',$blog->post_slug) }}" class="read-btn">
                                        Read More
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                <div class="col-lg-12 col-md-12">
                    <div class="pagination-area">
                        {{ $blogs->links('vendor.pagination.custom_p') }}
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="side-bar-wrap">
                    <div class="search-widget">
                        <form class="search-form">
                            <input type="search" class="form-control" placeholder="Search...">
                            <button type="submit">
                                <i class="bx bx-search"></i>
                            </button>
                        </form>
                    </div>
                    <div class="services-bar-widget">
                        <h3 class="title">Blog Category</h3>
                        <div class="side-bar-categories">
                            <ul>
                                @foreach ($bcategories as $cat)
                                    <li>
                                        <a href="{{ url('category/wise/blog',$cat->id) }}">{{ $cat->category_name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="side-bar-widget">
                        <h3 class="title">Recent Posts</h3>
                        <div class="widget-popular-post">

                            @foreach ($lposts as $post)
                                <article class="item">
                                    <a href="{{ url('blog/post/detail',$post->post_slug) }}" class="thumb">
                                        <img src="{{ url($post->post_image) }}" alt="" style="width: 80px; height:80px;">
                                    </a>
                                    <div class="info">
                                        <h4 class="title-text">
                                            <a href="{{ url('blog/post/detail',$post->post_slug) }}">
                                                {{ $post->post_title }}
                                            </a>
                                        </h4>
                                        <ul>
                                            <li>
                                                <i class='bx bx-user'></i>
                                                29K
                                            </li>
                                            <li>
                                                <i class='bx bx-message-square-detail'></i>
                                                15K
                                            </li>
                                        </ul>
                                    </div>
                                </article>
                                @endforeach

                        </div>
                    </div>

                 
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Blog Style Area End -->




@endsection