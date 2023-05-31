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

    public function details($id)
    {
        $product = DB::table('product')->where('id',$id)->get();
        return view('product.detailsProduct',['product'=>$product]);
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
    //     $product = Product::all();
    //     return view('dashboard', ['user' => $user,'product'=>$product]);
    // }

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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($image = $request->file('image')) {
            $destinationPath = 'images/product';
            $productImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $productImage);
            $input['image'] = "$productImage";
        }

        Product::create([
            'name' => $request->name,
            'size' => $request ->size,
            'stock' => $request->stock,
            'details' => $request->details,
            'highest_price' => $request->highest_price,
            'lowest_price' => $request->lowest_price,
            'image' => $productImage,
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
        $request->validate([
            'name' => 'required',
            'size' => 'required',
            'stock' => 'required',
            'details' => 'required',
            'highest_price' => 'required',
            'lowest_price' => 'required',
        ]);

        Product::where('id',$request->id)->update([
            'name' => $request->name,
            'size' => $request ->size,
            'stock' => $request->stock,
            'details' => $request->details,
            'highest_price' => $request->highest_price,
            'lowest_price' => $request->lowest_price,
        ]);
        if ($image = $request->file('image')) {
            $destinationPath = 'images/product';
            $productImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $productImage);
            $input['image'] = "$productImage";

            Product::where('id',$request->id)->update([
                'image' => $productImage,
            ]);
        }
        
        return redirect()->to('/produk')
                        ->with('success','Product created successfully.');
    }

    public function deleteProduct($id)
    {
    DB::table('product')->where('id',$id)->delete();
    return redirect('/produk');
    }

    
}
