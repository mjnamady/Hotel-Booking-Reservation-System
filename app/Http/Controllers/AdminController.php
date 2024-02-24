<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function AdminDashboard(){
        return view('admin.index');
    } // End method

    public function AdminLogout (Request $request) 
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'Admin Logout Successfully!',
            'alert-type' => 'success'
        );


        return redirect('/admin/login')->with($notification);
    } // End method

    public function AdminLogin()
    {
        return view('admin.admin_login_view');
    } // End method

    public function AdminProfile()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_profile_view', compact('profileData'));
    } // End method

    public function AdminProfileUpdate(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        
        if($request->hasFile('photo'))
        {
            $image = $request->file('photo');
            @unlink(public_path('upload/admin_images/'.$user->photo));
            $imageName = date('YmdHi').$image->getClientOriginalName();
            $image->move(public_path('upload/admin_images'),$imageName);
            $user['photo'] = $imageName;
        }

        $user->save();

        $notification = array(
            'message' => 'Profile Updated Successfully!',
            'alert-type' => 'success'
        );

        return back()->with($notification);

    } // End method

    public function AdminChangePassword()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_change_password_view', compact('profileData'));
    } // End method

    public function AdminUpdatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        if(!Hash::check($request->old_password, Auth::user()->password))
        {
            $notification = array(
                'message' => 'Old Password Does Not Match!',
                'alert-type' => 'error'
            );
    
            return back()->with($notification);
        }

        User::whereId(auth::user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        $notification = array(
            'message' => 'Password Changed Successfully!',
            'alert-type' => 'success'
        );

        return back()->with($notification);
    } // End method
}
