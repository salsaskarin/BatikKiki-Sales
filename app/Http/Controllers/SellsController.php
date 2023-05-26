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
use Illuminate\Http\JsonResponse;

use App\Models\User;
use App\Models\Product;
use App\Models\Sells;


class SellsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
    $sells = DB::table('sells')
    ->join('product','product.id','=','sells.product_id')
    ->select('sells.*', 'product.name as p_name')
    ->get();
    return view('sells.home', ['sells' => $sells]);
    }

    // public function getData()
    // {
    //     // $response = Http::get('http://localhost:8000/api/treatment/index');
    //     // $response = $response->object();
    //     // dd($response);

    //     // $title = 'Treatments';
    //     // if (request('category')) {
    //     //     $title = "Semua Treatments";
    //     // }
    //     // return view('admin.home', [
    //     //    'title' => 'Treatments' . $title,
    //     //     'active' => 'events',
    //     //     'treatments' => $response->data,
    //     // ]);
    //     $sells = Sells::all();
    //     return view('dashboard', ['user' => $user,'sells'=>$sells]);
    // }

    public function addSells()
    {
        return view("sells.addSells");

    }

    public function autocomplete(Request $request): JsonResponse
    {
        $data = Product::select("name")
                    ->where('name', 'LIKE', '%'. $request->get('query'). '%')
                    ->get();
         
        return response()->json($data);
    }
    
    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'size' => 'required',
            'stock' => 'required',
            'details' => 'required',
            'highest_price' => 'required',
            'lowest_price' => 'required',
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // if ($request->hasfile('image')) {
        //     $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$request->file('image')->getClientOriginalName());
        //     $request->file('image')->move(public_path('images/product'), $filename);
        // }

        Product::create([
            'name' => $request->name,
            'size' => $request ->size,
            'stock' => $request->stock,
            'details' => $request->details,
            'highest_price' => $request->highest_price,
            'lowest_price' => $request->lowest_price,
            // 'image' => $filename,
        ]);
        // dd($shop);

        return redirect()->to('/produk');
    }
    
}
