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
use App\Models\Sells;



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

    public function search(Request $request)
    {
        $keyword = $request->search;
        $product = Product::where('name', 'like', "%" . $keyword . "%")->get();
        return view('product.home', compact('product'));
    }

    public function details($id)
    {
        $product = DB::table('product')->where('id',$id)->get();
        return view('product.detailsProduct',['product'=>$product]);
    }

    public function addProduct()
    {
        return view("product.addProduct");

    }
    
    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'size' => 'required|max:20',
            'stock' => 'required|gt:0|digits_between:1,10',
            'details' => 'required|max:255',
            'highest_price' => 'required|gt:0|digits_between:1,10',
            'lowest_price' => 'required|gt:0|digits_between:1,10',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
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

        return redirect()->to('/produk')
        ->with('success','Produk berhasil ditambahkan.');
    }

    public function editProduct($id)
    {

        $product = DB::table('product')->where('id',$id)->get();
        return view('product.editProduct',['product'=>$product]);

    }

    public function updateProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'size' => 'required|max:20',
            'stock' => 'required|gt:0|digits_between:1,10',
            'details' => 'required|max:255',
            'highest_price' => 'required|gt:0|digits_between:1,10',
            'lowest_price' => 'required|gt:0|digits_between:1,10',
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
                        ->with('success','Produk berhasil diperbarui.');
    }

    public function deleteProduct($id)
    {

        if(Sells::where('product_id',$id)->count('*') != 0){
            return redirect('/produk')->with('msg','Barang tidak dapat dihapus, karena terdapat data pada penjualan.');
        }else{
            DB::table('product')->where('id',$id)->delete();
        }
    
        return redirect()->to('/produk')
        ->with('success','Produk berhasil dihapus.');
    }

    
}
