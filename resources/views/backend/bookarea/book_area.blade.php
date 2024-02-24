@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Book Area</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Update Book Area</li>
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
                        <div class="card-body">
                            <form id="myForm" method="POST" action="{{ route('book.area.update') }}" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="id" value="{{ $bookingData->id }}">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Short Title </h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="text" name="short_title" class="form-control" value="{{ $bookingData->short_title }}" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Main Title</h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="text" name="main_title" class="form-control" value="{{ $bookingData->main_title }}" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Short_description</h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <textarea name="short_desc" class="form-control" placeholder="Short Desc.." rows="3" required="">
                                            {{ $bookingData->short_desc }}
                                        </textarea>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Booking Url</h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="text" name="book_url" class="form-control" value="{{ $bookingData->book_url }}" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Image</h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input id="image" class="form-control" name="image" type="file" id="formFile">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0"></h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <img id="showImage" src="{{ (!empty($bookingData->image)) ? url($bookingData->image) : url('upload/no_image.jpg') }}" alt="Admin" class="rounded-circle p-1 bg-primary" width="80">
                                </div>

                                <div class="row mt-4">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="submit" class="btn btn-primary px-4" value="Update Bookarea" />
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
   

    });

</script>

@endsection