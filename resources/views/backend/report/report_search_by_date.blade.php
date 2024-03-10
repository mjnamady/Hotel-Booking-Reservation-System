@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Reports</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Searched Report Result </li>
                    <li class="breadcrumb-item active" aria-current="page"><span class="badge bg-danger">{{ $startDate }}</span> To <span class="badge bg-warning">{{ $endDate }}</span> </li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('booking.report') }}" class="btn btn-primary px-5 radius-30">Search Report</a>
        </div>
    </div>
    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">All Searced Report</h6>
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>S\N</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Payment Method</th>
                            <th>Total Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bookings as $key => $report)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $report->code }}</td>
                            <td>{{ $report->name }}</td>
                            <td>{{ $report->email }}</td>
                            <td>{{ $report->payment_method }}</td>
                            <td>{{ $report->total_price }}</td>
                            <td>
                                <a href="{{route('download.invoice', $report->id)}}" class="btn btn-warning" style="border-radius: 10px"> <i class="lni lni-download"></i> Download Invoice</a>
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