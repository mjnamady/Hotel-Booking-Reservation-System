@extends('frontend.main_master')
@section('main')

    <!-- Inner Banner -->
    <div class="inner-banner inner-bg3">
        <div class="container">
            <div class="inner-title">
                <ul>
                    <li>
                        <a href="/">Home</a>
                    </li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li>{{ $post->post_title }}</li>
                </ul>
                <h3>{{ $post->post_title }}</h3>
            </div>
        </div>
    </div>
    <!-- Inner Banner End -->

    <!-- Blog Details Area -->
    <div class="blog-details-area pt-100 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog-article">
                        <div class="blog-article-img">
                            <img src="{{ url($post->post_image) }}" alt="Images" style="width: 1000px; height:600px">
                        </div>

                        <div class="blog-article-title">
                            <h2>{{ $post->post_title }}</h2>
                            <ul>
                                
                                <li>
                                    <i class='bx bx-user'></i>
                                    {{ $post['user']['name'] }}
                                </li>

                                <li>
                                    <i class='bx bx-calendar'></i>
                                    {{ $post->created_at->format('M D Y') }}
                                </li>
                            </ul>
                        </div>
                        
                        <div class="article-content">
                            <p>
                               {!! $post->long_desc !!}
                            </p>
                        </div>

                        @php
                            $comments = App\Models\Comment::where('post_id', $post->id)->where('status', '1')->latest()->get();
                        @endphp

                        <div class="comments-wrap">
                            <h3 class="title">Comments</h3>
                            <ul>
                                @foreach ($comments as $comment)
                                <li>
                                    <img src="{{ (!empty($comment->user->photo)) ? url('upload/user_images/'.$comment->user->photo) : url('upload/no_image.jpg') }}" alt="Image" style="width:50px;height:50px;">
                                    <h3>{{ $comment->user->name }}</h3>
                                    <span>{{ $comment->created_at->format('M D, Y') }}</span>
                                    <p>
                                        {{ $comment->message }}
                                    </p>
                                     
                                </li>
                                @endforeach
                            </ul>
                        </div>

                        @php
                            if (Auth::check()) {
                                $id = Auth::user()->id;
                                $userData = App\Models\User::find($id);
                            } else {
                                $userData = null;
                            }
                        @endphp
                        
                        <div class="comments-form">
                            <div class="contact-form">
                                <h2>Leave A Comment</h2>
                                @auth
                                <form method="POST" action="{{ route('store.comment') }}">
                                    @csrf

                                    <div class="row">
                                        @if ($userData)
                                            <input type="hidden" name="user_id" value="{{ $userData->id }}"> 
                                        @endif
                                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <textarea name="message" class="form-control" id="message" cols="30" rows="8" required data-error="Write your message" placeholder="Your Message"></textarea>
                                            </div>
                                        </div>

                                       
                                        <div class="col-lg-12 col-md-12">
                                            <button type="submit" class="default-btn btn-bg-three">
                                                Post A Comment
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                @else 
                                <p>Please <a href="{{ route('login') }}">Login</a> in order to write comment(s). </p>
                                @endauth
                            </div>
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
    <!-- Blog Details Area End -->








@endsection