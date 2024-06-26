@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Roles Permission</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Roles In Permission</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('add.role.permission') }}" class="btn btn-primary px-4">Add Roles In Permission</a>
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
                            <th>Role Name</th>
                            <th>Permission </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $key => $role)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                @foreach ($role->permissions as $perm)
                                    <span class="badge bg-danger">{{ $perm->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('admin.edit.role', $role->id) }}" type="button" class="btn btn-outline-warning radius-30">Edit</a>
                                <a href="{{ route('admin.delete.role', $role->id) }}" id="delete" type="button" class="btn btn-outline-danger radius-30">Delete</a>
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