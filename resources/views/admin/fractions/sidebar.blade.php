<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('backend/assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Rocker</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
        </div>
     </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('admin.dashboard') }}">
                <div class="parent-icon"><i class='bx bx-home-alt'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
       
        @if (Auth::user()->can('team.menu'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Manage Team</div>
            </a>
            <ul>
                @if (Auth::user()->can('team.all'))
                <li> <a href="{{ route('all.team') }}"><i class='bx bx-radio-circle'></i>All Team</a>
                </li>
                @endif

                @if (Auth::user()->can('team.add'))
                <li> <a href="{{ route('add.team') }}"><i class='bx bx-radio-circle'></i>Add Team</a>
                </li>
                @endif
            </ul>
        </li>
        @endif

        @if (Auth::user()->can('bookarea.menu'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Manage Bookarea</div>
            </a>
            <ul>
                @if (Auth::user()->can('update.bookarea'))
                <li> <a href="{{ route('book.area') }}"><i class='bx bx-radio-circle'></i>Update Bookarea</a>
                </li>
                @endif
            </ul>
        </li>
        @endif

        @if (Auth::user()->can('room.type.menu'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Manage Room Type</div>
            </a>
            <ul>
                @if (Auth::user()->can('room.type'))
                <li> <a href="{{ route('room.type.list') }}"><i class='bx bx-radio-circle'></i>Room Type List</a>
                </li>
                @endif
            </ul>
        </li>
        @endif

        <li class="menu-label">Manage Bookings</li>
        @if (Auth::user()->can('booking.menu'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cart'></i>
                </div>
                <div class="menu-title">Bookings</div>
            </a>
            <ul>
                @if (Auth::user()->can('booking.list'))
                <li> <a href="{{ route('booking.list') }}"><i class='bx bx-radio-circle'></i>Booking List</a> </li>
                @endif

                @if (Auth::user()->can('booking.add'))
                <li> <a href="{{ route('add.room.list') }}"><i class='bx bx-radio-circle'></i>Add Booking </a> </li>
                @endif
            </ul>
        </li>
        @endif

        @if (Auth::user()->can('booking.add'))
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Manage RoomList</div>
            </a>
            <ul>
                <li> <a href="{{route('view.room.list')}}"><i class='bx bx-radio-circle'></i>Room List</a>
                </li>
            </ul>
        </li>
        @endif

        @if (Auth::user()->can('setting.menu'))
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Setting </div>
            </a>
            <ul>
                <li> <a href="{{route('smtp.setting')}}"><i class='bx bx-radio-circle'></i>SMTP Setting</a></li>
                <li> <a href="{{route('site.setting')}}"><i class='bx bx-radio-circle'></i>Site Setting</a></li>
            </ul>
        </li>
        @endif

        @if (Auth::user()->can('testimonial.menu'))
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Testimonial </div>
            </a>
            <ul>
                @if (Auth::user()->can('testimonial.all'))
                <li> <a href="{{route('all.testimonial')}}"><i class='bx bx-radio-circle'></i>All Testimonials</a> </li>
                @endif
                @if (Auth::user()->can('testimonial.add'))
                <li> <a href="{{route('add.testimonial')}}"><i class='bx bx-radio-circle'></i>Add Testimonial</a> </li>
                @endif
            </ul>
        </li>
        @endif

        @if (Auth::user()->can('blog.menu'))
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Blog </div>
            </a>
            <ul>
                @if (Auth::user()->can('blog.category'))
                <li> <a href="{{route('blog.category')}}"><i class='bx bx-radio-circle'></i>Blog Category</a> </li>
                @endif
                @if (Auth::user()->can('blog.post.list'))
                <li> <a href="{{route('all.blog.post')}}"><i class='bx bx-radio-circle'></i>All Blog Posts</a> </li>
                @endif
            </ul>
        </li>
        @endif

        @if (Auth::user()->can('contact.message.menu'))
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Contact US </div>
            </a>
            <ul>
                <li> <a href="{{route('contact.us')}}"><i class='bx bx-radio-circle'></i>Messages</a>
                </li>
            </ul>
        </li>
        @endif

        @if (Auth::user()->can('gallery.menu'))
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Gallery </div>
            </a>
            <ul>
                <li> <a href="{{route('gallery.image')}}"><i class='bx bx-radio-circle'></i>Gallery Images </a>
                </li>
            </ul>
        </li>
        @endif

        @if (Auth::user()->can('comment.menu'))
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Manage Comment </div>
            </a>
            <ul>
                <li> <a href="{{route('all.comment')}}"><i class='bx bx-radio-circle'></i>All Comment </a>
                </li>
            </ul>
        </li>
        @endif

        @if (Auth::user()->can('booking.report.menu'))
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Booking Report </div>
            </a>
            <ul>
                <li> <a href="{{route('booking.report')}}"><i class='bx bx-radio-circle'></i>Search Report </a>
                </li>
            </ul>
        </li>
        @endif

        @if (Auth::user()->can('role.permission.menu'))
        <li class="menu-label">Role and Permissions</li>

        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Role $ Permission </div>
            </a>
            <ul>
                <li> <a href="{{route('all.permission')}}"><i class='bx bx-radio-circle'></i>All Permissions </a></li>
                <li> <a href="{{route('all.roles')}}"><i class='bx bx-radio-circle'></i>All Roles </a></li>
                <li> <a href="{{route('add.role.permission')}}"><i class='bx bx-radio-circle'></i>Role In Permission </a></li>
                <li> <a href="{{route('all.role.permission')}}"><i class='bx bx-radio-circle'></i>All Role Permission </a></li>
            </ul>
        </li>
        @endif

        <li class="menu-label">Manage Admin User</li>

        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Manage Admin User </div>
            </a>
            <ul>
                <li> <a href="{{route('all.admin.user')}}"><i class='bx bx-radio-circle'></i>All Admin User </a></li>
                <li> <a href="{{route('add.admin.user')}}"><i class='bx bx-radio-circle'></i>Add Admin </a></li>
            </ul>
        </li>

       
        <li class="menu-label">Others</li>
             
        <li>
            <a href="#" target="_blank">
                <div class="parent-icon"><i class="bx bx-support"></i>
                </div>
                <div class="menu-title">Support</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>