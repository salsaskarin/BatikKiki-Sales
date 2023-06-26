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
        ->paginate(15);
        $now = Carbon::now()->toDateString();
        return view('expenses.home', [
            'expenses' => $expenses,
            'now' => $now
        ]);
    }

    public function expensesReport()
    {
        if (request()->start_date) {
            $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
            if(!empty(request()->end_date)){
                $end_date = Carbon::parse(request()->end_date)->toDateTimeString();
            }else{
                $end_date = Carbon::now();
            }
            $expenses = Expenses::whereBetween('date',[$start_date,$end_date])
            ->orderBy('date')
            ->select('expenses.*')
            ->paginate();

        } else {
            $expenses = Expenses::latest()->get();
        }
        $now = Carbon::now()->toDateString();
        return view('expenses.home', compact('expenses','now'));
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
            'quantity' => 'required|gt:0|digits_between:1,10',
            'price' => 'max:10',
            'pengeluaran' => 'required|gt:0|digits_between:1,10',
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
            'quantity' => 'required|gt:0|digits_between:1,10',
            'price' => 'max:10',
            'pengeluaran' => 'required|gt:0|digits_between:1,10',
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
