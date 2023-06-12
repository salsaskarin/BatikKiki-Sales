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
    
    public function searchUser(Request $request)
    {
        $keyword = $request->search;
        $user = User::where('name', 'like', "%" . $keyword . "%")->get();
        return view('user.home', compact('user'));
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
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'address' => 'required|max:255',
            'phone' => 'required|digits_between:11,14',
            'birth' => 'required',
            'gender' => 'required',
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

        return redirect()->to('/user')
        ->with('success','Data pegawai berhasil ditambahkan.');
    }

    public function makeAdmin(Request $request, $id) //user
    {

        User::where('id',$id)->update([
            'is_Admin'=>$request->isAdmin,
        ]);
        return redirect()->to('/user')
        ->with('success','Role pegawai berhasil diubah.');
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
            'email' => ['required', 'string', 'email', 'max:50', 'unique:'.User::class],
            'address' => 'required|max:255',
            'phone' => 'required|numeric',
            'birth' => 'required',
            'gender' => 'required',
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
        ->with('success','Data pegawai berhasil diperbarui.');
    }

    public function deleteUser($id)
    {
    DB::table('users')->where('id',$id)->delete();
    return redirect()->to('/user')
        ->with('success','Data pegawai berhasil dihapus.');
    }
}
