<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\MultiImage;
use App\Models\Room;
use App\Models\RoomNumber;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Intervention\Image\Colors\Rgb\Channels\Red;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use PhpParser\Node\Expr\FuncCall;
use PHPUnit\Framework\Constraint\Count;

class RoomController extends Controller
{
    public function EditRoom($id)
    {
        $basic_facility = Facility::where('rooms_id',$id)->get();
        $multiImgs = MultiImage::where('rooms_id',$id)->get();
        $allRoomNumbers = RoomNumber::where('rooms_id',$id)->get();
        $editData = Room::findOrFail($id);
        return view('backend.allrooms.rooms.edit_room', compact('editData', 'basic_facility', 'multiImgs', 'allRoomNumbers'));
    } // End method

    public function UpdateRoom(Request $request,$id)
    {
        $room = Room::find($id);
        $room->roomtype_id = $room->roomtype_id;
        $room->total_adult = $request->total_adult;
        $room->total_child = $request->total_child;
        $room->room_capacity = $request->room_capacity;
        $room->price = $request->price;

        $room->size = $request->size;
        $room->view = $request->view;
        $room->bed_style = $request->bed_style;
        $room->discount = $request->discount;
        $room->short_desc = $request->short_desc;
        $room->description = $request->description;
        $room->status = 1;

        /// Update single image
        if($request->hasFile('image')) {

            $manager = new ImageManager(new Driver());

            $name_gen = hexdec(uniqid()).'.'. $request->file('image')->getClientOriginalExtension();

            @unlink('upload/roomimg/'.$room->image);
            $img = $manager->read($request->file('image'));
            $img = $img->resize(550,850);

            $img->toJpeg(80)->save(base_path('public/upload/roomimg/'.$name_gen));
            $room['image'] = $name_gen;
        }

        $room->save();

        /// Update for facility table

        if($request->facility_name == NULL){

            $notification = array(
                'message' => 'Sorry! No Basic Facility Selected.',
                'alert-type' => 'error'
            );
    
            return redirect()->back()->with($notification);
        }
        else {
            Facility::where('rooms_id', $id)->delete();
            $facilities = Count($request->facility_name);
            for($i = 0; $i < $facilities; $i++){
                $fcount = new Facility();
                $fcount->rooms_id = $room->id;
                $fcount->facility_name = $request->facility_name[$i];
                $fcount->save();
            } // End for loop
        } // End else statement

        /// Update Multi Images

        if($room->save()){

            $files = $request->multi_img;

            if(!empty($files)){
                $subimage = MultiImage::where('rooms_id',$id)->get()->toArray();
                MultiImage::where('rooms_id',$id)->delete();
            }

            if(!empty($files)){

                foreach($files as $file){

                    $manager = new ImageManager(new Driver());

                    $name_gen = hexdec(uniqid()) .'.'. $file->getClientOriginalName();
                    @unlink('upload/roomimg/multi_img/'.$file);
                    $img = $manager->read($file);
                    $img = $img->resize(1000,700);
        
                    $img->toJpeg(80)->save(base_path('public/upload/roomimg/multi_img/'.$name_gen));

                    $subimage['multi_img'] = $name_gen;

                    $subimage = new MultiImage();
                    $subimage->rooms_id = $room->id;
                    $subimage->multi_img = $name_gen;

                    $subimage->save();
                }
            }

        } // End if


        $notification = array(
            'message' => 'Room Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 

    } // End method

    public function MultiImageDelete($id){

        $clickedImage = MultiImage::where('id',$id)->first();

        if($clickedImage) {

            $imagePath = $clickedImage->multi_img;
           
            // Check if the file exists before unlinking 
            if(file_exists($imagePath)){
                unlink($imagePath);
                echo "Image Unlinked Successfully!";
            } else {
                echo "Image Does Not Exist!";
            }

            // Delete the record from database
            MultiImage::where('id',$id)->delete();
        }

        $notification = array(
            'message' => 'Multi Image Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 


    } // End method

    public function StoreRoomNumber(Request $request, $id) {
        
        $roomNumberData = new RoomNumber();

        $roomNumberData->rooms_id = $id;
        $roomNumberData->room_type_id = $request->roomtype_id;
        $roomNumberData->room_no = $request->room_no;
        $roomNumberData->status = $request->status;
        $roomNumberData->save();

        $notification = array(
            'message' => 'Room Number Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('room.type.list')->with($notification); 

    } // End mehtod

    public function EditRoomNumber($id){
        $roomNoDetails = RoomNumber::find($id);
        return view('backend.allrooms.rooms.edit_room_no', compact('roomNoDetails'));
    } // End method

    public function RoomNumberUpdate(Request $request, $id){

        $roomNo = RoomNumber::findOrFail($id);

        $roomNo->room_no = $request->room_no;
        $roomNo->status = $request->status;
        $roomNo->save();

        $notification = array(
            'message' => 'Room Number Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('room.type.list')->with($notification); 

    } // End method

    public function DeleteRoomNumber($id){
        RoomNumber::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Room Number Deleted!',
            'alert-type' => 'success'
        );

        return redirect()->route('room.type.list')->with($notification); 
    } // End method


    public function DeleteRoom($id){

        $room = Room::find($id);

        if(file_exists('upload/roomimg/'.$room->image) && !empty($room->image)){

            @unlink('upload/roomimg/'.$room->image);

        }

        $subimage = MultiImage::where('rooms_id', $room->id)->get()->toArray();

        if(!empty($subimage)){

           foreach ($subimage as $value) {

            if(!empty($value)){
                @unlink('upload/roomimg/multi_img/'.$value['multi_img']);
            }

           }

        }

        Facility::where('rooms_id', $room->id)->delete();
        MultiImage::where('rooms_id', $room->id)->delete();
        RoomNumber::where('rooms_id', $room->id)->delete();
        RoomType::where('id', $room->roomtype_id)->delete();
        $room->delete();

        
        $notification = array(
            'message' => 'Room Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('room.type.list')->with($notification); 

    } // End method
}
