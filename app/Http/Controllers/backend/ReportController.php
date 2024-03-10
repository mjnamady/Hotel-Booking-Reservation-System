<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\booking;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function BookingReport(){
        return view('backend.report.report_search_view');
    } // End Method1

    public function BookingReportSearch(Request $request){

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $bookings = booking::where('check_in', '>=', $startDate)->where('check_out', '<=', $endDate)->get();

        return view('backend.report.report_search_by_date',compact('bookings','startDate','endDate'));
    } // End Method1
}
