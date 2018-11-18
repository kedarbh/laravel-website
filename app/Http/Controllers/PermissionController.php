<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;
use Session;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //list all permissions
        $permissions = Permission::orderBy('id', 'asc')->paginate(10);
        return view('management.permissions.index')->withPermissions($permissions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return a view to create a new permission
        return view('management.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate user input before saving on database
        if ($request->permission_type == 'basic') {
            $this->validate($request, [
                'display_name' => 'required|max:255',
                'name' => 'required|max:255|alphadash|unique:permissions,name',
                'description' => 'sometimes|max:255'
            ]);
            $permission = new Permission();
            $permission->display_name = ucwords($request->display_name);
            $permission->name = $request->name; //slug
            $permission->description = $request->description;
            $permission->save();

            Session::flash('flash_message', 'Permissions were all successfully added');
            return redirect()->route('permissions.index');
        } elseif ($request->permission_type == 'crud') {
            $this->validate($request, [
                'resource' => 'required|min:3|max:100|alpha'
            ]);

            $crud = explode(',', $request->crud_selected);
            if (count($crud) > 0) {
                foreach ($crud as $item) {
                    $name = strtolower($item) . '-' . strtolower($request->resource);
                    $display_name = ucwords($item . " " . $request->resource);
                    $description = "Allows User to " . strtoupper($item) . " " . ucwords($request->resource);

                    $permission = new Permission();
                    $permission->display_name = $display_name;
                    $permission->name = $name; //slug
                    $permission->description = $description;
                    $permission->save();
                }

                Session::flash('flash_message', 'Permissions were all successfully added');
                return redirect()->route('permissions.index');
            }
        } else {
            // Session::flash('flash_message', 'Please update fields with error');
            return redirect()->route('permissions.create')->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //display the permission type with the id
        $permission = Permission::findOrFail($id);
        return view('management.permissions.show')->withPermission($permission);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $permission = Permission::findOrFail($id);
        return view('management.permissions.edit')->withPermission($permission);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'display_name' => 'required|max:255',
            'desciption' =>'sometimes|max:255'
        ]);

        $permission = Permission::findOrFail($id);
        $permission->display_name = $request->display_name;
        $permission->description = $request->description;
        $permission->save();

        Session::flash('flash_message', $permission->display_name . ' permission updated successfully');
        return redirect()->route('permissions.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        //not using destroy method on this for now. It will only be availabe to superuser only after role assignment
    }
}
