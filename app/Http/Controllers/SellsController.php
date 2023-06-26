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
use Carbon\Carbon;

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
    ->orderBy('date','desc')
    ->paginate(15);
    $now = Carbon::now()->toDateString();
    return view('sells.home', [
        'sells' => $sells,
        'now' => $now
]);
    }

    public function sellsReport()
    {
        if (request()->start_date) {
            $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
            if(!empty(request()->end_date)){
                $end_date = Carbon::parse(request()->end_date)->toDateTimeString();
            }else{
                $end_date = Carbon::now();
            }
            $sells = Sells::whereBetween('date',[$start_date,$end_date])
            ->orderBy('date')
            ->join('product','product.id','=','sells.product_id')
            ->select('sells.*', 'product.name as p_name','product.size as p_size')
            ->paginate();
        } else {
            $sells = Sells::latest()->get();
        }
        $now = Carbon::now()->toDateString();
        return view('sells.home', compact('sells','now'));
    }

    public function addSells()
    {
        return view("sells.addSells");

    }

    public function autocomplete(Request $request): JsonResponse
    {
        $data = Product::select(DB::raw("CONCAT(name,' (',size,')',', Stok: ',stock) as name"))
                    ->where(DB::raw("CONCAT(name,' ',size,' ',stock)"), 'LIKE', '%'. $request->get('query'). '%')
                    ->get();
        return response()->json($data);
    }

    // cara storenya pas di controller ambil id dari hasil concat
    
    public function storeSells(Request $request)
    {

        $idTest = Product::select("id","stock",DB::raw("CONCAT(name,' (',size,')',', Stok: ',stock) as name"))
        ->where(DB::raw("CONCAT(name,' (',size,')',', Stok: ',stock)"), 'LIKE', '%'. $request->p_name. '%')
        ->first();

        $request->validate([
            'customer' => 'max:50',
            'p_name' => 'required|',
            'date' => 'required',
            'quantity' => 'required|gt:0|digits_between:1,10',
            'price' => 'max:10',
            'total' => 'required|gt:0|digits_between:1,10',
        ]);

        if(!empty($idTest)){
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
                        'pemasukan'=> $oldTotal->pemasukan + $request->total,
                        'type' => $request->type,
                        'pengeluaran' => $request->pengeluaran
                    ]);
                }else{
                    Dailysells::create([
                        'date' => $request ->date,
                        'pemasukan' => $request->total,
                        'type' => $request->type,
                        'pengeluaran' => $request->pengeluaran
                    ]);
                }
                Product::where("id",$idTest->id)->update([
                    'stock'=>($idTest->stock - $request->quantity)
                ]);
            
            }else{
                return redirect()->back()->with('message', 'Stock '.$idTest->name.' hanya ada: '.$idTest->stock);
            }

        }else{
            return redirect()->back()->with('message', 'Barang '.$request->p_name.' tidak ada dalam data produk. Pilih yang muncul pada bawah kolom.');
        }

        return redirect()->to('/penjualan')
        ->with('success','Data penjualan berhasil ditambahkan.');
    }

    public function editSells($id, Request $request)
    {
        $sells = DB::table('sells')
            ->where('sells.id',$id)
            ->join('product','product.id','=','sells.product_id')
            ->select(DB::raw("CONCAT(name,' (',size,')',', Stok: ',stock) as p_name"),"sells.*" )
            ->get();

        return view('sells.editSells',
        ['sells'=>$sells,
    ]);
    }

    public function updateSells(Request $request)
    {
        $request->validate([
            'customer' => 'max:50',
            'p_name' => 'required',
            'date' => 'required',
            'quantity' => 'required|gt:0|digits_between:1,10',
            'price' => 'max:10',
            'total' => 'required|gt:0|digits_between:1,10',
        ]);


        $idTest = Product::select("id",'stock')
        ->where(DB::raw("CONCAT(name,' (',size,')',', Stok: ',stock)"), 'LIKE', '%'. $request->p_name. '%')
        ->first();

        $prevtotal = Sells::where('id', $request->id)
        ->select("total", "quantity")->first();

        if(!empty($idTest)){
            $selisih = $request->total - $prevtotal->total;

            $totalstock = $idTest->stock + $prevtotal->quantity;

            if(($idTest->stock+$prevtotal->quantity)>=$request->quantity){ //Mengecek stock yang ada

                Product::where("id",$idTest->id)->update([
                    'stock'=>($totalstock - $request->quantity)
                ]);

                Sells::where('id',$request->id)->update([ 
                    'product_id' => $idTest->id,
                    'customer' => $request->customer,
                    'date' => $request ->date,
                    'quantity' => $request->quantity,
                    'price' => $request->price,
                    'total' => $request->total,
                ]);

                    if(Dailysells::whereDate('date',$request->date)->exists()){ //Membuat data pada dailysells jika belum ada
                        $oldTotal = Dailysells::where('date',$request->date)->first();
                        Dailysells::whereDate('date',$request->date)->update([
                            'pemasukan'=> $oldTotal->pemasukan + $selisih,
                            'type' => $request->type,
                            'pengeluaran' => $request->pengeluaran
                        ]);
                    }else{ //Mengubah data pada dailysells jika sudah ada
                        Dailysells::create([
                            'date' => $request ->date,
                            'pemasukan' => $request->total,
                            'type' => $request->type,
                            'pengeluaran' => $request->pengeluaran
                        ]);
                    }

                    $check=Dailysells::where('date',$request->date)->first();
                    if($check->pemasukan == 0){ //Menghapus jika total pemasukan pada tanggal tersebut = 0
                        Dailysells::where('date',$request->date)->delete();
                    }
                return redirect()->to('/penjualan')
                ->with('success','Data penjualan berhasil diperbarui.');
            }else{
            return redirect()->back()->with('message', 'Stock '.$idTest->name.' hanya ada: '.$idTest->stock);
            }
        }else{
            return redirect()->back()->with('message', 'Barang '.$request->p_name.' tidak ada dalam data produk. Pilih yang muncul pada bawah kolom.');
        }        
    }

    public function deleteSells($id)
    {


    $val = Sells::where('id', $id)
    ->select('date', 'total', 'quantity','product_id')
    ->first();

    $product = Product::where("id",$val->product_id)->select("stock")->first();

    Product::where("id",$val->product_id)->update([
        'stock'=>($product->stock + $val->quantity)
    ]);

    $oldTotal = Dailysells::where('date',$val->date)->select("id", "date", "pemasukan")->first();

    Dailysells::whereDate('date',$val->date)->update([
        'pemasukan'=> $oldTotal->pemasukan - $val->total,
    ]);

    

    $check=Dailysells::where('date',$val->date)->first();
    if($check->pemasukan == 0){
        Dailysells::where('date',$val->date)->delete();
    }
    DB::table('sells')->where('id',$id)->delete();
    return redirect()->to('/penjualan')
        ->with('success','Data penjualan berhasil dihapus.');
    }
    
}
