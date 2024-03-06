@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Edit Post</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Blog Post</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body p-4">
                            <h5 class="mb-4">Edit Blog Post</h5>
                            <form class="row g-3" method="POST" id="myForm" action="{{route('update.blog.post')}}" enctype="multipart/form-data">
                                @csrf

                                <div class="col-md-6">
                                    <input type="hidden" name="post_id" value="{{$post->id}}">
                                    <label for="input1" class="form-label">Blog Category</label>
                                    <select name="category_id" id="input7" class="form-select">
                                        <option selected="" value="0">Select Category...</option>
                                        @foreach ($bcategories as $cat)
                                            <option {{ ($post->blogcat_id == $cat->id)? 'selected' : '' }} value="{{$cat->id}}">{{$cat->category_name}}</option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="input2" class="form-label">Post Title</label>
                                    <input type="text" name="post_title" class="form-control" value="{{ $post->post_title }}">
                                </div>

                                <div class="col-md-12">
                                    <label for="input3" class="form-label">Short Description</label>
                                    <textarea class="form-control" name="short_desc" rows="3">
                                        {{ $post->short_desc }}
                                    </textarea>
                                </div>

                                <div class="col-md-12">
                                    <label for="input11" class="form-label">Long Description</label>
                                    <textarea class="form-control" name="long_desc" id="mytextarea">
                                        {{ $post->long_desc }}
                                    </textarea>
                                </div>

                                <div class="col-md-8">
                                    <div class="form-check">
                                        <label class="form-label" for="input12">Blog Image</label>
                                        <input id="image" class="form-control" name="post_image" type="file" id="formFile">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-check">
                                        <label class="form-label" for="input12"></label>
                                        <img id="showImage" src="{{ url($post->post_image) }}" alt="Blog Image" class="rounded-circle p-1 bg-primary" width="80">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="d-md-flex d-grid align-items-center gap-3">
                                        <button type="submit" class="btn btn-primary px-4">Update Post</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                 
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
    
            // AUTOMATIC LOAD IMAGE
            $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
   


        $('#myForm').validate({
            rules: {
                category_id: {
                    required : true,
                },
                
                post_title: {
                    required : true,
                }, 

                short_desc: {
                    required : true,
                }, 

                long_desc: {
                    required : true,
                },

                // post_image: {
                //     required : true,
                // }
                
            },

            messages :{
                category_id: {
                    required : 'Please Select Post Category',
                }, 

                post_title: {
                    required : 'Please Enter Post Title',
                }, 
                 
                short_desc: {
                    required : 'Please Enter Type in the Short Description',
                }, 

                long_desc_desc: {
                    required : 'Please Enter Type in the Long Description...',
                }, 


                // post_image: {
                //     required : 'Please Select Post Image',
                // }, 

            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });

</script>

@endsection