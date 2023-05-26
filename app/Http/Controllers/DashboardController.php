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


class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function rules()
    {
        return view('rules');
    }

    public function getData()
    {
        // $response = Http::get('http://localhost:8000/api/treatment/index');
        // $response = $response->object();
        // dd($response);

        // $title = 'Treatments';
        // if (request('category')) {
        //     $title = "Semua Treatments";
        // }
        // return view('admin.home', [
        //    'title' => 'Treatments' . $title,
        //     'active' => 'events',
        //     'treatments' => $response->data,
        // ]);
        $stock = Stock::all();
        return view('dashboard', ['user' => $user,'stock'=>$stock]);
    }
    
}
