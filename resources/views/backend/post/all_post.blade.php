@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Posts</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Post</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('add.blog.post') }}" class="btn btn-primary px-5 radius-30">Add Post</a>
        </div>
    </div>
    <!--end breadcrumb-->
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>S\N</th>
                            <th>Post Title</th>
                            <th>Category Name</th>
                            <th>Post Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $key => $post)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $post->post_title }}</td>
                            <td>{{ $post['category']['category_name'] }}</td>
                            <td> <img src="{{ asset($post->post_image) }}" alt="" style="width:60px;height:40px;"> </td>
                            <td>
                                <a href="{{ route('edit.blog.post', $post->id) }}" type="button" class="btn btn-outline-warning radius-30">Edit</a>
                                <a href="{{ route('delete.blog.post', $post->id) }}" id="delete" type="button" class="btn btn-outline-danger radius-30">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
   
    <hr/>
   
</div>

@endsection