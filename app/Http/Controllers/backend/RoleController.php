<?php

namespace App\Http\Controllers\backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Exports\PermissionExport;
use App\Imports\PermissionImport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function AllPermission(){
        $permissions = Permission::latest()->get();
        return view('backend.pages.permission.all_permission', compact('permissions'));
    } // End Method

    public function AddPermission(){
        return view('backend.pages.permission.add_permission');
    } // End Method

    public function StorePermission(Request $request){
        Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name
        ]);

        $notification = array(
            'message' => 'Permission Added Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('all.permission')->with($notification);
    } // End Method

    public function EditPermission($id){

        $permission = Permission::findOrFail($id);

        return view('backend.pages.permission.edit_permission', compact('permission'));

    } // End Method

    public function UpdatePermission(Request $request){
        $pId = $request->id;
        Permission::find($pId)->update([
            'name' => $request->name,
            'group_name' => $request->group_name
        ]);

        $notification = array(
            'message' => 'Permission Updated Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('all.permission')->with($notification);
    } // End Method

    public function DeletePermission($id){

        Permission::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Permission Deleted Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // End Method

    public function PermissionImport(){
        return view('backend.pages.permission.import_permission');
    } // End Method

    public function Export(){
        return Excel::download(new PermissionExport, 'permission.xlsx');
    } // End Method

    public function Import(Request $request){

        Excel::import(new PermissionImport, $request->file('permission_doc'));

        $notification = array(
            'message' => 'Permission Uploaded Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('all.permission')->with($notification);
    } // End Method

    /////// Roles All Methods
    
    public function AllRoles(){
        $roles = Role::latest()->get();
        return view('backend.pages.role.all_role', compact('roles'));
    } // End Method

    public function AddRole(){
        return view('backend.pages.role.add_role');
    } // End Method

    public function StoreRole(Request $request){
        Role::create([
            'name' => $request->name
        ]);

        $notification = array(
            'message' => 'Role Created Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('all.roles')->with($notification);
    } // End Method

    public function EditRole($id){
        $role = Role::findOrFail($id);
        return view('backend.pages.role.edit_role', compact('role'));
    } // End Method

    public function UpdateRole(Request $request){
        $role_id = $request->id;
        Role::findOrFail($role_id)->update([
            'name' => $request->name
        ]);

        $notification = array(
            'message' => 'Role Updated Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('all.roles')->with($notification);
    } // End Method

    public function DeleteRole($id){
        Role::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Role Deleted Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('all.roles')->with($notification);

    } // End Method


    /////////// Role In Permission All Routes

    public function AddRolePermission(){
        $roles = Role::all();
        $permissions = Permission::all();
        $permission_groups = User::getPermissionGroup();
        return view('backend.pages.rolesetup.add_role_permission', compact('roles','permissions','permission_groups'));
    } // End Method

    public function RolePermissionStore(Request $request){
        $role_id = $request->role_id;
        $permissions = $request->permission;

        $data = array();
        foreach ($permissions as $perm_id) {
            $data['role_id'] = $role_id;
            $data['permission_id'] = $perm_id;
            DB::table('role_has_permissions')->insert($data);
        }

        $notification = array(
            'message' => 'Role Permission Added Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('all.role.permission')->with($notification);
    }  // End Method


    public function AllRolePermission(){
        $roles = Role::all();
        return view('backend.pages.rolesetup.all_role_permission', compact('roles'));
    } // End Method


    public function AdminEditRole($id){
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $permission_groups = User::getPermissionGroup();
        return view('backend.pages.rolesetup.edit_role_permission', compact('role','permissions','permission_groups'));
    } // End Method

    public function AdminRoleUpdate(Request $request, $id){

        $role = Role::find($id);
        $permissions = [];
        $post_permissions = $request->permission;

        if(!empty($post_permissions)){

            foreach ($post_permissions as $key => $perm) {
                $permissions[intval($perm)] = intval($perm);
            }

            $role->syncPermissions($permissions);
        }
        
        $notification = array(
            'message' => 'Role Permission Updated Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('all.role.permission')->with($notification);
    } // End Method

    public function AdminDeleteRole($id){

        $role = Role::findOrFail($id);
        if(!is_null($role)){
            $role->delete();
        }


        $notification = array(
            'message' => 'Role Permission Deleted Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


}
