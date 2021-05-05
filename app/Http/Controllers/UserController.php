<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        $data = User::all()->sortByDesc("id");
        return view('users.index', ['users'=>$data]);
    }

    public function edit($id)
    {
        $data = User::find($id);
        return view('profile.edit',['users'=>$data]);
    }

    public function update(Request $req)
    {
            $user = User::find($req->id);
            $user->name=$req->name;
            $user->email=$req->email;
            $user->save();
            return redirect('user')->withStatus(__('User successfully updated.')); 
    }
    public function delete($id)
    {
        $data = User::find($id);
        $data->delete();
        return back()->withStatus(__('User successfully deleted.')); 
    }

    public function add(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|max:14',
            'password_confirmation' => 'required|same:password',
        ]);
        $user = new User;
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=$request->password;
        $user->save();
        return redirect('user')->withStatus(__('User successfully added.'));  
    }
}
