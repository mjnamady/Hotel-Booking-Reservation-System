<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;



class TestimonialController extends Controller
{
    public function AllTestimonial(){
        $testimonials = Testimonial::latest()->get();
        return view('backend.testimonial.all_testimonials', compact('testimonials'));
    } // End Method

    public function AddTestimonial(){
        return view('backend.testimonial.add_testimonial');
    } // End Method

    public function StoreTestimonial(Request $request){
        
        if($request->hasFile('image'))
        {
            $manager = new ImageManager(new Driver());

            $name_gen = hexdec(uniqid()).'.'. $request->file('image')->getClientOriginalExtension();

            $img = $manager->read($request->file('image'));
            $img = $img->resize(50,50);

            $img->toJpeg(80)->save(base_path('public/upload/testimonial/'.$name_gen));
            $save_url = 'upload/testimonial/'.$name_gen;

            Testimonial::insert([
                'name' => $request->name,
                'city' => $request->city,
                'message' => $request->message,
                'image' => $save_url,
                'created_at' => Carbon::now()
            ]);

            $notification = array(
                'message' => 'Testimonial Uplaoded Successfully!',
                'alert-type' => 'success'
            );
    
            return redirect()->route('all.testimonial')->with($notification);
        }
    } // End Method

    public function EditTestimonial($id){
        $testimonial = Testimonial::find($id);
        return view('backend.testimonial.edit_testimonial', compact('testimonial'));
    } // End Method

    public function UpdateTestimonial(Request $request){

        $test_id = $request->id;

        if($request->hasFile('image'))
        {
            $manager = new ImageManager(new Driver());

            $name_gen = hexdec(uniqid()).'.'. $request->file('image')->getClientOriginalExtension();

            $img = $manager->read($request->file('image'));
            $img = $img->resize(50,50);

            $img->toJpeg(80)->save(base_path('public/upload/testimonial/'.$name_gen));
            $save_url = 'upload/testimonial/'.$name_gen;

            Testimonial::find($test_id)->update([
                'name' => $request->name,
                'city' => $request->city,
                'message' => $request->message,
                'image' => $save_url,
                'updated_at' => Carbon::now()
            ]);

            $notification = array(
                'message' => 'Testimonial Updated With Image Successfully!',
                'alert-type' => 'success'
            );
    
            return redirect()->route('all.testimonial')->with($notification);
        } 
        
        else {

            Testimonial::find($test_id)->update([
                'name' => $request->name,
                'city' => $request->city,
                'message' => $request->message,
                'updated_at' => Carbon::now()
            ]);

            $notification = array(
                'message' => 'Testimonial Updated Without Image Successfully!',
                'alert-type' => 'success'
            );
    
            return redirect()->route('all.testimonial')->with($notification);
        }

    } // End Method

    public function DeleteTestimonial($id){
        $testimonial = Testimonial::findOrFail($id);
        if(!empty($testimonial->image)){
            unlink($testimonial->image);
        }

        $testimonial->delete();

        $notification = array(
            'message' => 'Testimonial Deleted Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('all.testimonial')->with($notification);

    } // End Method
}
