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
use App\Models\Product;


class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
    $product = Product::all();
    return view('product.home', ['product' => $product]);
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
        $product = Product::all();
        return view('dashboard', ['user' => $user,'product'=>$product]);
    }

    public function addProduct()
    {
        return view("product.addProduct");

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

    public function editProduct($id)
    {

        $product = DB::table('product')->where('id',$id)->get();
        return view('product.editProduct',['product'=>$product]);

    }
    public function updateProduct(Request $request)
    {
        $product = Product::findOrFail($request->id);

        if ($request->hasfile('image')) {
            $filename = round(microtime(true) * 1000).'-'.str_replace(' ','-',$request->file('image')->getClientOriginalName());
            $request->file('image')->move(public_path('images/product'), $filename);
        }

        if($request->hasfile('image')){
            Product::where('id',$request->id)->update([
                'name' => $request->name,
                'details' => $request->details,
                'highest_price' => $request->highest_price,
                'lowest_price' => $request->lowest_price,
                'stock' => $request->stock,
                'image' => $filename,
            ]);
        }else{
            Product::where('id',$request->id)->update([
                'name' => $request->name,
                'details' => $request->details,
                'highest_price' => $request->highest_price,
                'lowest_price' => $request->lowest_price,
                'stock' => $request->stock,
            ]);
        }
        return redirect()->to('/produk');
    }

    // public function deleteStock($id)
    // {
    // DB::table('stock')->where('id',$id)->delete();
    // return redirect('/home/stock');
    // }

    
}
