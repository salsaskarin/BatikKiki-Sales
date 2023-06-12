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
use Carbon\Carbon;

use App\Models\User;
use App\Models\Expenses;


class ExpensesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        $expenses = DB::table('expenses')
        ->orderBy('date','desc')
        ->get();
        $total=Expenses::sum('pengeluaran');
        return view('expenses.home', [
            'expenses' => $expenses,
            'total' => $total
        ]);
    }

    public function expensesReport()
    {
        if (request()->start_date || request()->end_date) {
            $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
            $end_date = Carbon::parse(request()->end_date)->toDateTimeString();
            $expenses = Expenses::whereBetween('date',[$start_date,$end_date])
            ->orderBy('date')
    ->select('expenses.*')
    ->get();

    $total=Expenses::whereBetween('date',[$start_date,$end_date])->sum('pengeluaran');
        } else {
            $expenses = Expenses::latest()->get();
        }
        
        return view('expenses.home', compact('expenses','total'));
    }

    public function addExpenses()
    {
        return view("expenses.addExpenses");

    }
    
    public function storeExpenses(Request $request)
    {
        $request->validate([
            'type' => 'required|max:50',
            'name' => 'max:50',
            'date' => 'required',
            'quantity' => 'required|gt:0|max:10',
            'price' => 'gt:0|max:10',
            'pengeluaran' => 'required|max:10',
        ]);

        Expenses::create([
            'type' => $request->type,
            'name' => $request->name,
            'date' => $request ->date,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'pengeluaran' => $request->pengeluaran,
            'pemasukan' =>$request->pemasukan,
        ]);
        return redirect()->to('/biaya')
        ->with('success','Data pengeluaran berhasil ditambahkan.');
    }

    public function editExpenses($id)
    {

        $expenses = DB::table('expenses')->where('id',$id)->get();
        return view('expenses.editExpenses',['expenses'=>$expenses]);

    }

    public function updateExpenses(Request $request)
    {
        $request->validate([
            'type' => 'required|max:50',
            'name' => 'max:50',
            'date' => 'required',
            'quantity' => 'required|gt:0|max:10',
            'price' => 'gt:0|max:10',
            'pengeluaran' => 'required|gt:0|max:10',
        ]);

        Expenses::where('id',$request->id)->update([
            'type' => $request->type,
            'name' => $request->name,
            'date' => $request ->date,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'pengeluaran' => $request->pengeluaran,
            'pemasukan' =>$request->pemasukan,
        ]);
        // dd($shop);

        return redirect()->to('/biaya')
        ->with('success','Data pengeluaran berhasil diperbarui.');
    }

    public function deleteExpenses($id)
    {
    DB::table('expenses')->where('id',$id)->delete();
    return redirect('/biaya')
    ->with('success','Data pengeluaran berhasil dihapus.');
    }
    
}
