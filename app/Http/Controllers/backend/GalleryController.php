<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class GalleryController extends Controller
{
    public function GalleryImage(){
        $galleryImages = Gallery::latest()->get();
        return view('backend.gallery.all_gallery_images', compact('galleryImages'));
    } // End Method

    public function AddImage(){
        return view('backend.gallery.add_images');
    } // End Method

    public function StoreGalleryImage(Request $request){

        $images = $request->galleryImages;
        
        foreach ($images as $image) {

            $manager = new ImageManager(new Driver());
            $imageName = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(550,550);
            $img->toJpeg(80)->save(base_path('public/upload/gallery/'.$imageName));
            $saved_url = 'upload/gallery/'.$imageName;

            $gallery = new Gallery();
            $gallery->photo = $saved_url;
            $gallery->save();
        }

        $notification = array(
            'message' => 'GalleryImages Added Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('gallery.image')->with($notification);
    } // End Method

    public function EditImage($id){
        $image = Gallery::findOrFail($id);
        return view('backend.gallery.edit_image',compact('image'));
    } // End Method

    public function UpdateGalleryImage(Request $request){
        // dd($request->galleryImage);
        $oldImage = Gallery::findOrFail($request->id);

        $manager = new ImageManager(new Driver);
        $newImageName = hexdec(uniqid()).'.'.$request->file('galleryImage')->getClientOriginalExtension();
        @unlink('upload/gallery/'.$oldImage->photo);
        $manager->read($request->galleryImage)
        ->resize(550,550)
        ->toJpeg(80)
        ->save(base_path('public/upload/gallery/'.$newImageName));

        $image_path = 'upload/gallery/'.$newImageName;
        Gallery::find($request->id)->update([
            'photo' => $image_path
        ]);

        $notification = array(
            'message' => 'GalleryImage Updated Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('gallery.image')->with($notification);
    }  // End Method

    public function DeleteImage($id){
        $image = Gallery::findOrFail($id);
        @unlink($image->photo);
        $image->delete();

        $notification = array(
            'message' => 'GalleryImage Deleted Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('gallery.image')->with($notification);
    } // End Method

    public function DeleteMultiImage(Request $request){
        $img_ids = $request->image_id;
        foreach($img_ids as $id){
            $image = Gallery::findOrFail($id);
            @unlink($image->photo);
            $image->delete();
        }

        $notification = array(
            'message' => 'Multiple-Images Deleted Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('gallery.image')->with($notification);
    } // End Method

    public function AllGalleryImage(){
        $allGallery = Gallery::latest()->limit(9)->get();
        return view('frontend.gallery.all_gallery_images',compact('allGallery'));
    } // End Method
}