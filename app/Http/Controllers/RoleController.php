<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public $title = ["Roles", 'roles'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = $this->title;
        $data = Role::where('guard_name', 'web')->paginate(10);
        $permissions = Permission::where('guard_name', 'web')->get();
        $permission_groups = User::getpermissionGroups();
        return view('admin.role.index', compact('title', 'data', 'permissions', 'permission_groups'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $role = Role::create([
            'name' => $request->name,

        ]);

        $data = array();
        $permissions = $request->permission;
        if (!empty($permissions)) {
            // Sync permissions if there are any
            $role->syncPermissions($permissions);
        }

        $notification = array(
            'message' => 'Role Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $edit = $role = Role::where('guard_name', 'web')->findOrFail($id);
        $permission_groups = User::getpermissionGroups();
        $html = view('admin.pertial.role_form', compact('edit', 'permission_groups'))->render();
        return response()->json(['html' => $html]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
      
        $role = Role::findOrFail($id);

        // Update the role attributes
        $role->update([
            'name' => $request->name,
        ]);

        $permissions = $request->permission;

        if (!empty($permissions)) {
            // Sync permissions if there are any
            $role->syncPermissions($permissions);
        }


        $notification = array(
            'message' => 'Role Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Role Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
