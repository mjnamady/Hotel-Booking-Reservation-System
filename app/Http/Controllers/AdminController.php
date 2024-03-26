<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Colors\Rgb\Channels\Red;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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

    public function AllAdminUser(){
        $admins = User::where('role','admin')->get();
        return view('backend.pages.admin.all_admin', compact('admins'));
    } // End method

    public function AddAdminUser(){
        $roles = Role::all();
        return view('backend.pages.admin.add_admin',compact('roles'));
    } // End Method

    public function StoreAdminUser(Request $request){
    
        $admin = new User();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->address = $request->address;
        $admin->role = 'Admin';
        $admin->status = 'Active';
        $admin->password = Hash::make($request->password);
        $admin->save();

        if ($request->role_id) {
            $admin->assignRole((int)$request->role_id);
        }
        $notification = array(
            'message' => 'Admin User Created Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('all.admin.user')->with($notification);
    } // End Method

    public function EditAdminUser($id){
        $admin = User::findOrFail($id);
        $roles = Role::all();
        return view('backend.pages.admin.edit_admin_user',compact('admin','roles'));
    } // End Method

    public function UpdateAdminUser(Request $request, $id){
        $admin = User::find($id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->address = $request->address;
        $admin->role = 'Admin';
        $admin->status = 'Active';
        $admin->save();

        $admin->roles()->detach();
        if ($request->role_id) {
            $admin->assignRole((int)$request->role_id);
        }
        $notification = array(
            'message' => 'Admin User Updated Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('all.admin.user')->with($notification);
    } // End Method

    public function DeleteAdminUser($id){
        $admin = User::findOrFail($id);
        if(!is_null($admin)){
            $admin->delete();
        }
        $notification = array(
            'message' => 'Admin User Deleted Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // End Method



}
