<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class BlogController extends Controller
{
    public function BlogCategory(){
        $category = BlogCategory::latest()->get();
        return view('backend.category.blog_category', compact('category'));
    } // End Method

    public function StoreCategory(Request $request){

        BlogCategory::insert([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ','-', $request->category_name))
        ]);

        $notification = array(
            'message' => 'Blog Category Added Successfully.',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // End Method

    public function EditBlogCategory($id){
        $categories = BlogCategory::find($id);
        return response()->json($categories);
    } // End Method

    public function UpdateCategory(Request $request){

        $cat_id = $request->cat_id;

        BlogCategory::find($cat_id)->update([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ','-', $request->category_name))
        ]);

        $notification = array(
            'message' => 'BlogCategory Updated Successfully.',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // End Method

    public function DeleteCategory($id){
        BlogCategory::findOrFail($id)->delete();
        $notification = array(
            'message' => 'BlogCategory Deleted Successfully.',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // End Method


    ////////// All Blog Functions ///////////

    public function AllBlogPost(){
        $posts = BlogPost::latest()->get();
        return view('backend.post.all_post',compact('posts'));
    } // End Method

    public function AddBlogPost(){
        $bcategories = BlogCategory::latest()->get();
        return view('backend.post.add_blog_post',compact('bcategories'));
    } // End Method

    public function StoreBlogPost(Request $request){
       
        if($request->hasFile('post_image'))
        {
            $manager = new ImageManager(new Driver());

            $name_gen = hexdec(uniqid()).'.'. $request->file('post_image')->getClientOriginalExtension();

            $img = $manager->read($request->file('post_image'));
            $img = $img->resize(550,370);

            $img->toJpeg(80)->save(base_path('public/upload/blog/'.$name_gen));
            $save_url = 'upload/blog/'.$name_gen;

            BlogPost::insert([
                'blogcat_id' => $request->category_id,
                'user_id' => Auth::user()->id,
                'post_title' => $request->post_title,
                'post_slug' => strtolower(str_replace(' ','-',$request->post_title)),
                'short_desc' => $request->short_desc,
                'long_desc' => $request->long_desc,
                'post_image' => $save_url,
                'created_at' => Carbon::now()
            ]);
        }

        $notification = array(
            'message' => 'BlogPost Uploaded Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('all.blog.post')->with($notification);
    } // End Method

    public function EditBlogPost($id){
        $bcategories = BlogCategory::latest()->get();
        $post = BlogPost::findOrFail($id);
        return view('backend.post.edit_blog_post',compact('bcategories','post'));
    } // End Method

    public function UpdateBlogPost(Request $request){
        
        $post_id = $request->post_id;

        if($request->hasFile('post_image'))
        {
            $manager = new ImageManager(new Driver());

            $name_gen = hexdec(uniqid()).'.'. $request->file('post_image')->getClientOriginalExtension();

            $img = $manager->read($request->file('post_image'));
            $img = $img->resize(550,370);
           
            $img->toJpeg(80)->save(base_path('public/upload/blog/'.$name_gen));
            $save_url = 'upload/blog/'.$name_gen;

            BlogPost::find($post_id)->update([
                'blogcat_id' => $request->category_id,
                'user_id' => Auth::user()->id,
                'post_title' => $request->post_title,
                'post_slug' => strtolower(str_replace(' ','-',$request->post_title)),
                'short_desc' => $request->short_desc,
                'long_desc' => $request->long_desc,
                'post_image' => $save_url,
                'updated_at' => Carbon::now()
            ]);

            $notification = array(
                'message' => 'BlogPost Updated With Image Successfully!',
                'alert-type' => 'success'
            );
            
            return redirect()->route('all.blog.post')->with($notification);
        } else {

            BlogPost::find($post_id)->update([
                'blogcat_id' => $request->category_id,
                'user_id' => Auth::user()->id,
                'post_title' => $request->post_title,
                'post_slug' => strtolower(str_replace(' ','-',$request->post_title)),
                'short_desc' => $request->short_desc,
                'long_desc' => $request->long_desc,
                'updated_at' => Carbon::now()
            ]);

            $notification = array(
                'message' => 'BlogPost Updated Without Image Successfully!',
                'alert-type' => 'success'
            );
            
            return redirect()->route('all.blog.post')->with($notification);
        }
    }  // End Method

}
