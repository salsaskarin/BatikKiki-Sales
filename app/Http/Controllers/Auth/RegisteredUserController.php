<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
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
    
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request['address'],
            'phone' => $request['phone'],
            'birth' => $request['birth'],
            'gender' => $request['gender'],
            'is_Admin' => 0,
        ]);

        event(new Registered($user));

        return redirect()->to('/user');
    }

    public function makeAdmin(Request $request, $id) //user
    {

        User::where('id',$id)->update([
            'is_Admin'=>$request->isAdmin,
        ]);
        return redirect()->to('/user');
    }

    public function editUser($id)
    {

        $user = DB::table('users')->where('id',$id)->get();
        return view('user.editUser',['user'=>$user]);

    }

    public function updateUser(Request $request)
    {
        $request->validate([
             'name' => ['required', 'string', 'max:255'],
            // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::where('id',$request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            // 'password' => Hash::make($request->password),
            'address' => $request['address'],
            'phone' => $request['phone'],
            'birth' => $request['birth'],
            'gender' => $request['gender'],
        ]);
               
        return redirect()->to('/user')
                        ->with('success','User created successfully.');
    }

    public function deleteUser($id)
    {
    DB::table('users')->where('id',$id)->delete();
    return redirect('/user');
    }
}
