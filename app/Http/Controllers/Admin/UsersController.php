<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Role;

use Illuminate\Http\Request;
use Illuminate\Routing\Console\MiddlewareMakeCommand;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
     public function _construct(){
         $this -> middleware('auth');
     }
   
    public function index(){
        $users = User::all();
        return view ('admin.users.index')->with('users', $users);
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit')->with([
            'user'=> $user ,
            'roles'=> $roles
        ]);
     }

     public function update(Request $request, User $user){
         $user->roles()->sync($request->roles);

        return redirect()->route('admin.users.index');
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */

    public function destroy(User $user)
    {
          $user-> roles()->detach();
          $user-> delete();

          return redirect()->route('admin.users.index');
    }
}
