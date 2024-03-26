@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Edit Admin </div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">User </li>
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
                            <h5 class="mb-4">Edit Admin User </h5>
                            <form class="row g-3" method="POST" action="{{route('update.admin.user',$admin->id)}}">
                                @csrf

                                <div class="col-md-6">
                                    <label for="input2" class="form-label">Admin User Name </label>
                                    <input type="text" name="name" class="form-control" value="{{ $admin->name }}">
                                </div>

                                <div class="col-md-6">
                                    <label for="input2" class="form-label">Admin User Email </label>
                                    <input type="email" name="email" class="form-control" value="{{ $admin->email }}">
                                </div>

                                <div class="col-md-6">
                                    <label for="input2" class="form-label">Admin User Phone </label>
                                    <input type="text" name="phone" class="form-control" value="{{ $admin->phone }}">
                                </div>

                                <div class="col-md-6">
                                    <label for="input2" class="form-label">Admin User Address </label>
                                    <input type="text" name="address" class="form-control" value="{{ $admin->address }}">
                                </div>

                                <div class="col-md-6">
                                    <label for="input2" class="form-label">Role </label>
                                    <select name="role_id" class="form-select mb-3" aria-label="Default select example" required>
                                        <option selected="">Select Role..</option>
                                        @foreach ($roles as $role)
                                            <option {{ $admin->hasRole($role) ? 'selected' : '' }} value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>


                                <div class="col-md-12">
                                    <div class="d-md-flex d-grid align-items-center gap-3">
                                        <button type="submit" class="btn btn-primary px-4">Add Admin User </button>
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

@endsection