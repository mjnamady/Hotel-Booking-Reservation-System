@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Room Type</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Room Type List</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('add.room.type') }}" class="btn btn-primary px-5 radius-30">Add Room Type</a>
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
                            <th>Image</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                        @foreach($allRoomType as $key => $roomType)
                        @php
                            $rooms = App\Models\Room::where('roomtype_id', $roomType->id)->get();
                        @endphp
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td> <img src="{{ (!empty($roomType->room->image)) ? url('upload/roomimg/'.$roomType->room->image) : url('upload/no_image.jpg') }}" alt="" style="width:50px; height:30px;"> </td>
                            <td>{{ $roomType->name }}</td>
                            
                            <td>
                                @foreach($rooms as $roomy)
                                <a href="{{ route('edit.room', $roomy->id) }}" type="button" class="btn btn-outline-warning radius-30">Edit</a>
                                <a href="{{ route('delete.room', $roomy->id) }}" id="delete" type="button" class="btn btn-outline-danger radius-30">Delete</a>
                                @endforeach
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