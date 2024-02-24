<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    public function RoomTypeList(){
        $allRoomType = RoomType::orderBy('id', 'DESC')->get();
        return view('backend.allrooms.roomtype.view_roomtype', compact('allRoomType'));
    } // End method

    public function AddRoomType(){
        return view('backend.allrooms.roomtype.add_roomtype');
    } // End method

    public function StoreRoomType(Request $request){
        $roomType_id = RoomType::insertGetId([
            'name' => $request->name
        ]);

        Room::insert([
            'roomtype_id' => $roomType_id
        ]);

        $notification = array (
            'message' => 'RoomType Inserted Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('room.type.list')->with($notification);
    } // End method

}
