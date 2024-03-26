@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3"> Edit Roles </div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">In Permissions </li>
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
                            {{-- <h5 class="mb-4">Add Roles </h5> --}}
                            <form class="row g-3" method="POST" action="{{route('admin.role.update',$role->id)}}">
                                @csrf

                                <div class="col-md-6">
                                    <label for="input2" class="form-label">Role Name </label>
                                    {{-- <input type="hidden" name="id" value="{{ $role->id }}"> --}}
                                    <h2>{{ $role->name }}</h2>
                                </div>

                                <div class="form-check">
									<input class="form-check-input" type="checkbox" id="CheckDefaultMain">
									<label class="form-check-label" for="CheckDefaultMain">Select All</label>
								</div>

                                <hr>

                                <div class="row">

                                    @foreach ($permission_groups as $permG)
                                    
                                        <div class="col-3">
                                            @php
                                                $permissions = App\Models\User::getPermissions($permG->group_name);
                                            @endphp
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="flexCheckDefault" {{ App\Models\User::roleHasPermission($role,$permissions) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="flexCheckDefault">{{ $permG->group_name }}</label>
                                            </div>
                                            <br>
                                        </div>

                                        <div class="col-9">
                                            @foreach ($permissions as $permission)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="permission[]" value="{{ $permission->id }}" id="CheckDefault{{ $permission->id }}" {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="flexCheckDefault">{{ $permission->name }}</label>
                                                </div>
                                            @endforeach
                                            <br>  
                                        </div> 
                                    @endforeach
                                </div>

                                <div class="col-md-12">
                                    <div class="d-md-flex d-grid align-items-center gap-3">
                                        <button type="submit" class="btn btn-primary px-4">Save Changes </button>
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

    $('#CheckDefaultMain').click(function(){
        if($(this).is(':checked')){
            $('input[type=checkbox]').prop('checked', true);
        } else {
            $('input[type=checkbox]').prop('checked', false);
        }
    });

</script>

@endsection