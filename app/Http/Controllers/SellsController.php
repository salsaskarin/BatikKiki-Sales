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
use App\Models\Dailysells;


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
    ->select('sells.*', 'product.name as p_name','product.size as p_size')
    ->get();
    return view('sells.home', ['sells' => $sells]);
    }

    public function addSells()
    {
        return view("sells.addSells");

    }

    public function autocomplete(Request $request): JsonResponse
    {
        $data = Product::select(DB::raw("CONCAT(name,' (',size,') ') as name"))
                    ->where(DB::raw("CONCAT(name,' ',size)"), 'LIKE', '%'. $request->get('query'). '%')
                    ->get();
        return response()->json($data);
    }

    // cara storenya pas di controller ambil id dari hasil concat
    
    public function storeSells(Request $request)
    {

        $idTest = Product::select("id","stock",DB::raw("CONCAT(name,' (',size,') ') as name"))
        ->where(DB::raw("CONCAT(name,' (',size,') ')"), 'LIKE', '%'. $request->p_name. '%')
        ->first();

        $request->validate([
            'customer' => 'required',
            'date' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'total' => 'required',
        ]);

        if($idTest->stock>=$request->quantity){
            
            Sells::create([
                'product_id' => $idTest->id,
                'customer' => $request->customer,
                'date' => $request ->date,
                'quantity' => $request->quantity,
                'price' => $request->price,
                'total' => $request->total,
            ]);

            if(Dailysells::whereDate('date',$request->date)->exists()){
                $oldTotal = Dailysells::where('date',$request->date)->first();
                Dailysells::whereDate('date',$request->date)->update([
                    'total'=> $oldTotal->total + $request->total
                ]);
            }else{
                Dailysells::create([
                    'date' => $request ->date,
                    'total' => $request->total,
                ]);
            }
           

            Product::where("id",$idTest->id)->update([
                'stock'=>($idTest->stock - $request->quantity)
            ]);
            
        }else{
            return redirect()->back()->with('message', 'Stock '.$idTest->name.' hanya ada: '.$idTest->stock);
        }

        // dd($shop);

        return redirect()->to('/penjualan');
    }

    public function editSells($id, Request $request)
    {
        $sells = DB::table('sells')
            ->where('sells.id',$id)
            ->join('product','product.id','=','sells.product_id')
            ->select(DB::raw("CONCAT(name,' (',size,')') as p_name"),"sells.*" )
            ->get();

        return view('sells.editSells',
        ['sells'=>$sells,
    ]);
    }

    public function updateSells(Request $request)
    {
        $request->validate([
            'customer' => 'required',
            'date' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'total' => 'required',
        ]);

        $idTest = Product::select("id")
        ->where(DB::raw("CONCAT(name,' (',size,') ')"), 'LIKE', '%'. $request->p_name. '%')
        ->first();

        Sells::where('id',$request->id)->update([
            'product_id' => $idTest->id,
            'customer' => $request->customer,
            'date' => $request ->date,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'total' => $request->total,
        ]);
        // dd($shop);

        return redirect()->to('/penjualan');
    }

    public function deleteSells($id)
    {
    DB::table('sells')->where('id',$id)->delete();
    return redirect('/penjualan');
    }
    
}
