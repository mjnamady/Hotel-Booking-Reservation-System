<?php

namespace App\Http\Controllers\frontend;

use Carbon\Carbon;
use App\Models\Room;
use App\Models\Facility;
use App\Models\booking;
use Carbon\CarbonPeriod;
use App\Models\MultiImage;
use Illuminate\Http\Request;
use App\Models\RoomBookedDate;
use App\Http\Controllers\Controller;

class AllRoomsController extends Controller
{
    public function AllRoomsPage(){

        $roomsData = Room::latest()->get();
        return view('frontend.rooms.all_rooms', compact('roomsData'));
    } // End Method

    public function RoomDetailV($id){
        $roomDetails = Room::findOrFail($id);
        $multiImages = MultiImage::where('rooms_id', $id)->get();
        $facilities = Facility::where('rooms_id', $id)->get();
        $otherRooms = Room::where('id', '!=', $id)->orderBy('id', 'DESC')->limit(2)->get();
        return view('frontend.rooms.room_details', compact('roomDetails', 'multiImages', 'facilities', 'otherRooms'));
    } // End Method

    public function BookingSearch(Request $request){

        $request->flash();

        if ($request->check_in == $request->check_out) {

            $notification = array(
                'message' => 'Something went worng!',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }

        $sdate = date('Y-m-d',strtotime($request->check_in));
        $edate = date('Y-m-d',strtotime($request->check_out));
        $alldate = Carbon::create($edate)->subDay();
        $d_period = CarbonPeriod::create($sdate,$alldate);

        $dt_array = [];
        foreach ($d_period as $period) {
           array_push($dt_array, date('Y-m-d', strtotime($period)));
        }

       

        $check_date_booking_ids = RoomBookedDate::whereIn('book_date',$dt_array)->distinct()->pluck('booking_id')->toArray();

        $rooms = Room::withCount('room_numbers')->where('status',1)->get();

        return view('frontend.rooms.search_room',compact('rooms','check_date_booking_ids'));
    } // End Method

    public function SearchRoomDetails(Request $request, $id)
    {
        $request->flash();

        $roomDetails = Room::findOrFail($id);
        $multiImages = MultiImage::where('rooms_id', $id)->get();
        $facilities = Facility::where('rooms_id', $id)->get();
        $otherRooms = Room::where('id', '!=', $id)->orderBy('id', 'DESC')->limit(2)->get();

        $room_id = $id;
        return view('frontend.rooms.search_room_details', compact('roomDetails', 'multiImages', 'facilities', 'otherRooms', 'room_id'));

    } // End Method

    public function CheckRoomAvailability(Request $request){

        $sdate = date('Y-m-d',strtotime($request->check_in));
        $edate = date('Y-m-d',strtotime($request->check_out));
        $alldate = Carbon::create($edate)->subDay();
        $d_period = CarbonPeriod::create($sdate,$alldate);
        $dt_array = [];
        foreach ($d_period as $period) {
           array_push($dt_array, date('Y-m-d', strtotime($period)));
        }

        $check_date_booking_ids = RoomBookedDate::whereIn('book_date',$dt_array)->distinct()->pluck('booking_id')->toArray();

        $room = Room::withCount('room_numbers')->find($request->room_id);

        $bookings = Booking::withCount('assign_rooms')->whereIn('id',$check_date_booking_ids)->where('rooms_id',$room->id)->get()->toArray();

        $total_book_room = array_sum(array_column($bookings,'assign_rooms_count'));

        $av_room = @$room->room_numbers_count-$total_book_room;

        $toDate = Carbon::parse($request->check_in);
        $fromDate = Carbon::parse($request->check_out);
        $nights = $toDate->diffInDays($fromDate);

        return response()->json(['available_room'=>$av_room, 'total_nights'=>$nights ]);
    } // End Method
}