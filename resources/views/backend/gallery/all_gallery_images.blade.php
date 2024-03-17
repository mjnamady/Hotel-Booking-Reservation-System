@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Gallery</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Gallery Images</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('add.image') }}" class="btn btn-primary px-5 radius-30">Add Image(s)</a>
        </div>
    </div>
    <!--end breadcrumb-->
    <hr/>
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{route('delete.multi.image')}}">
            @csrf
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Select</th>
                            <th>S\N</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($galleryImages as $key => $image)
                        <tr>
                            <td style="width:50px">
                                <div class="form-check">
									<input class="form-check-input" name="image_id[]" type="checkbox" value="{{ $image->id }}" id="flexCheckDefault">
								</div>
                            </td>
                            <td style="width:50px">{{ $key+1 }}</td>
                            <td> <img src="{{ asset($image->photo) }}" alt="" style="width:60px;height:40px;"> </td>
                            <td>
                                <a href="{{ route('edit.image', $image->id) }}" type="button" class="btn btn-outline-warning radius-30">Edit</a>
                                <a href="{{ route('delete.image', $image->id) }}" id="delete" type="button" class="btn btn-outline-danger radius-30">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <button type="submit" class="btn btn-danger px-5">Delete Multiple Images</button>
            </form>
        </div>
    </div>
   
    <hr/>
   
</div>




@endsection