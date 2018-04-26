<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */

    public function index()
    {
        return view('user.index', ['users' => User::all()]);
    }
    
    public function create()
    {
        return view('user.create');
    }

  /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('user.edit',compact('user','id'));
    }

    
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $this->validate(request(), [
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $user->name = $request->get('name');
        $user->username = $request->get('username');
        $user->password = $request->get('password');
        $user->administrator = $request->get('administrator');
        $user->save();
        return redirect('/users')->with('success', 'User has been updated');
    }
        
    public function store(Request $request)
      {
            $user = $this->validate(request(), [
                'name' => 'required|string|max:255',
                'username' => 'required|string|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
            ]);
            
            $user['password'] = Hash::make($user['password']);
            User::create($user);
            return redirect('/users')->with('success', 'User has been added');
      }
   
    protected function destroy($id){
        $user = User::find($id);
        $user->delete();
        return redirect('users')->with('success','Product has been  deleted');        
    }

    public function action($id, $action, $status = null)
    {        

        $ids = explode(",", $id);
        if ($action == "delete") {
            
        }

        switch ($action) {
            case 'delete':
                foreach ($ids as $id) {
                    User::find($id)->delete();
                }                
                return redirect('users')->with('success','User(s) has been deleted');        
                break;
            
            default:
                return redirect('timesheets')->with('error','There was no action selected');        
                break;
        }        
    }

}