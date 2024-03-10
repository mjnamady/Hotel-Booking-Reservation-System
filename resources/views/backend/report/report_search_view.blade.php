@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Booking Report Search</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Booking Report Search</li>
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
                            <h5 class="mb-4">Search Booking Report </h5>
                            <form class="row g-3" method="POST" action="{{route('booking.report.search')}}">
                                @csrf

                                <div class="col-md-6">
                                    <label for="input2" class="form-label">Start Date </label>
                                    <input type="date" name="start_date" class="form-control" id="input2">
                                </div>

                                <div class="col-md-6">
                                    <label for="input2" class="form-label">End Date </label>
                                    <input type="date" name="end_date" class="form-control" id="input2">
                                </div>

                                <div class="col-md-12">
                                    <div class="d-md-flex d-grid align-items-center gap-3">
                                        <button type="submit" class="btn btn-primary px-4">Searchs</button>
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