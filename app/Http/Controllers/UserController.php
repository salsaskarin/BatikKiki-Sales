<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

use App\Models\User;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
    $user = User::all();
    return view('user.home', ['user' => $user]);
    }

    public function addUser()
    {
        return view("user.addUser");

    }

    public function storeUser(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->birth = $request->birth;
        $user->save();

        return redirect()->to('/user');
    }

    public function makeAdmin(Request $request, $id) //user
    {

        User::where('id',$id)->update([
            'is_Admin'=>$request->isAdmin,
        ]);
        return redirect()->to('/user');
    }

    public function deleteUsers($id)
    {
    DB::table('users')->where('id',$id)->delete();
    return redirect('/user');
    }

    
}
