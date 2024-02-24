<?php

namespace App\Http\Controllers\backend;

use App\Models\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bookarea;
use Carbon\Carbon;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class TeamController extends Controller
{
    public function AllTeam()
    {
        $allTeam = Team::latest()->get();
        return view('backend.team.all_team', compact('allTeam'));
    } // End method

    public function AddTeam()
    {
        return view('backend.team.add_team');
    } // End method

    public function StoreTeam(Request $request)
    {

        if($request->hasFile('image'))
        {
            $manager = new ImageManager(new Driver());

            $name_gen = hexdec(uniqid()).'.'. $request->file('image')->getClientOriginalExtension();

            $img = $manager->read($request->file('image'));
            $img = $img->resize(550,670);

            $img->toJpeg(80)->save(base_path('public/upload/team/'.$name_gen));
            $save_url = 'upload/team/'.$name_gen;

            Team::insert([
                'name' => $request->name,
                'position' => $request->position,
                'facebook' => $request->facebook,
                'image' => $save_url,
                'created_at' => Carbon::now()
            ]);

            $notification = array(
                'message' => 'Team Inserted Successfully!',
                'alert-type' => 'success'
            );
    
            return redirect()->route('all.team')->with($notification);
        }

    } // End method

    public function EditTeam($id)
    {
        $teamInfo = Team::findOrFail($id);
        return view('backend.team.edit_team', compact('teamInfo'));
    } // End method

    public function UpdateTeam(Request $request)
    {
        if($request->hasFile('image'))
        {
            $manager = new ImageManager(new Driver());

            $name_gen = hexdec(uniqid()).'.'. $request->file('image')->getClientOriginalExtension();
            $oldImage = Team::findOrFail($request->id);
            @unlink($oldImage->image);
            $img = $manager->read($request->file('image'));
            $img = $img->resize(550,670);

            $img->toJpeg(80)->save(base_path('public/upload/team/'.$name_gen));
            $save_url = 'upload/team/'.$name_gen;

            Team::findOrFail($request->id)->update([
                'name' => $request->name,
                'position' => $request->position,
                'facebook' => $request->facebook,
                'image' => $save_url,
                'updated_at' => Carbon::now()
            ]);

            $notification = array(
                'message' => 'Team Updated With Image Successfully!',
                'alert-type' => 'success'
            );
    
            return redirect()->route('all.team')->with($notification);
        }
        else 
        {
            Team::findOrFail($request->id)->update([
                'name' => $request->name,
                'position' => $request->position,
                'facebook' => $request->facebook,
                'updated_at' => Carbon::now()
            ]);

            $notification = array(
                'message' => 'Team Updated Without Image Successfully!',
                'alert-type' => 'success'
            );
    
            return redirect()->route('all.team')->with($notification);
        }
    } // End method

    public function DeleteTeam($id)
    {
        $team = Team::findOrfail($id);
        unlink($team->image);
        $team->delete();

        $notification = array(
            'message' => 'Team Deleted Successfully!',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);

    } // End method

    // =============== Book Area All Methods ==========================
    public function BookArea()
    {
        $bookingData = Bookarea::find(1);
        return view('backend.bookarea.book_area', compact('bookingData'));
    } // End method

    public function BookAreaUpdate(Request $request)
    {
        if($request->hasFile('image'))
        {
            $manager = new ImageManager(new Driver());

            $name_gen = hexdec(uniqid()).'.'. $request->file('image')->getClientOriginalExtension();
            $oldImage = Bookarea::findOrFail($request->id);
            @unlink($oldImage->image);
            $img = $manager->read($request->file('image'));
            $img = $img->resize(1000,1000);

            $img->toJpeg(80)->save(base_path('public/upload/bookarea/'.$name_gen));
            $save_url = 'upload/bookarea/'.$name_gen;

            Bookarea::findOrFail($request->id)->update([
                'short_title' => $request->short_title,
                'main_title' => $request->main_title,
                'short_desc' => $request->short_desc,
                'image' => $save_url,
                'updated_at' => Carbon::now()
            ]);

            $notification = array(
                'message' => 'Bookarea Updated With Image Successfully!',
                'alert-type' => 'success'
            );
    
            return redirect()->back()->with($notification);
        }
        else 
        {
            Bookarea::findOrFail($request->id)->update([
                'short_title' => $request->short_title,
                'main_title' => $request->main_title,
                'short_desc' => $request->short_desc,
                'updated_at' => Carbon::now()
            ]);

            $notification = array(
                'message' => 'Bookarea Updated Without Image Successfully!',
                'alert-type' => 'success'
            );
    
            return redirect()->back()->with($notification);
        }
    } // End method
}
