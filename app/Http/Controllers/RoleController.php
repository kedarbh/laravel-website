<?php

namespace App\Http\Controllers;

use App\Role;
use App\Permission;
use Illuminate\Http\Request;
use Session;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //display all available roles
        $roles = Role::all();
        return view('management.roles.index')->withRoles($roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //redirect to a create view
        $permissions = Permission::all();
        return view('management.roles.create')->withPermissions($permissions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate request firs
        $this->validate($request, [
            'display_name' => 'required|min:3|max:100',
            'name' => 'required|max:100|unique:roles',
            'description' => 'sometimes|max:255'
        ]);

        $role = new Role;
        $role->display_name = ucwords($request->display_name);
        $role->name = $request->name;
        $role->description = $request->description;
        $role->save();

        if ($request->permissions) {
            $role->syncPermissions(explode(',', $request->permissions));
        }

        $request->session()->flash('flash_message', 'Role created successfully');

        return redirect()->route('roles.show', $role->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //show the role with assigned permission
        $role = Role::where('id', $id)->with('permissions')->first();
        return view('management.roles.show')->withRole($role);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $role = Role::where('id', $id)->with('permissions')->first();
        $permissions = Permission::all();
        return view('management.roles.edit')->withRole($role)->withPermissions($permissions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validate
        $this->validate($request, [
            'display_name' => 'required|min:3|max:100',
            'description' => 'sometimes|required|max:255'
        ]);

        $role = Role::findOrFail($id);
        $role->display_name = $request->display_name;
        $role->description = $request->description;
        $role->save();
        // dd($request->permissions);
        if ($request->permissions) {
            $role->syncPermissions(explode(',', $request->permissions));
        }
        // dd($role->permissions);
        Session::flash('flash_message', 'Successfully update the '. $role->display_name . ' role in the database.');
        return redirect()->route('roles.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
    }
}
