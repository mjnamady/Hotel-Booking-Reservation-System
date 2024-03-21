<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PermissionExport;
use App\Imports\PermissionImport;


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


}
