<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Hash;
use Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id','asc')->paginate(10);
        return view ('management.users.index')->withUsers($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('management.users.create')->withRoles($roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate the user input first
        $this->validate($request, [
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users',
            'password' => array(
                                'required',
                                'min:8',
                                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/'
                            )
        ], [
            'password.regex' => 'Your password must contain at-least 1 Uppercase, 1 Lowercase, 1 Number and 1 special character.'
        ]);
        //add user to the database
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        if ($request->roles) {
            $user->syncRoles(explode(',', $request->roles));
          }

        Session::flash('flash_message', 'Successfully created user!');
        return redirect()->route('users.show', $user->id);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findorfail($id);
        return view('management.users.show')->withUser($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findorfail($id);
        return view('management.users.edit')->withUser($user);
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
        //
        $this->validate($request, [
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users,email,'.$id,
            'password' => array(
                                'sometimes',
                                'min:8',
                                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/'
                            )
            ], [
            'password.regex' => 'Your password must contain at-least 1 Uppercase, 1 Lowercase, 1 Number and 1 special character.'
            ]);

        //update user info with new entry
          $user = User::findOrFail($id);
          $user->name = $request->name;
          $user->email = $request->email;
          $user->password = Hash::make($request->password);

          $user->save();

        // $user->update($request->all());

          Session::flash('flash_message','User Updated Successfully');
          return redirect()->route('users.show', $user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete a user
        $user = User::findOrFail($id);

        $user->delete();

        Session::flash('flash_message', 'User Deleted Successfully');

        return redirect()->route('users.index');
    }
}
