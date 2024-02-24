<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    } // End method

    public function UserProfile()
    {
        return view('frontend.dashboard.user_profile');
    } // End mehtod

    public function UserProfileUpdate(Request $request)
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
            @unlink(public_path('upload/user_images/'.$user->photo));
            $imageName = date('YmdHi').$image->getClientOriginalName();
            $image->move(public_path('upload/user_images'),$imageName);
            $user['photo'] = $imageName;
        }

        $user->save();

        $notification = array(
            'message' => 'User Profile Updated Successfully!',
            'alert-type' => 'info'
        );

        return back()->with($notification);

    } // End method

    public function UserChangePassword()
    {
        return view('frontend.dashboard.user_change_password');
    } // End method

    public function UserUpdatePassword(Request $request)
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
            'message' => 'User\'s Password Changed Successfully!',
            'alert-type' => 'success'
        );

        return back()->with($notification);
    } // End method

    public function UserLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'User Logout Successfully!',
            'alert-type' => 'success'
        );

        return redirect('/login')->with($notification);
    } // End method
}
