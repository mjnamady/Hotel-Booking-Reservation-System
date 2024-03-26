@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Teams</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Teams</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('add.team') }}" class="btn btn-primary px-5 radius-30">Add Team</a>
        </div>
    </div>
    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">All Teams</h6>
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
                            <th>Position</th>
                            <th>Facebook Url</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($allTeam as $key => $team)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td> <img src="{{ asset($team->image) }}" alt="" style="width:60px;height:40px;"> </td>
                            <td>{{ $team->name }}</td>
                            <td>{{ $team->position }}</td>
                            <td>{{ $team->facebook }}</td>
                            <td>
                                @if (Auth::user()->can('team.edit'))
                                <a href="{{ route('edit.team', $team->id) }}" type="button" class="btn btn-outline-warning radius-30">Edit</a>
                                @endif
                                @if (Auth::user()->can('team.delete'))
                                <a href="{{ route('delete.team', $team->id) }}" id="delete" type="button" class="btn btn-outline-danger radius-30">Delete</a>
                                @endif
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