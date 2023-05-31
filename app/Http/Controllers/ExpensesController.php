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
use App\Models\Expenses;


class ExpensesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        $expenses = Expenses::all();
        return view('expenses.home', ['expenses' => $expenses]);
    }

    public function addExpenses()
    {
        return view("expenses.addExpenses");

    }
    
    public function storeExpenses(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'date' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'total' => 'required',
        ]);

        Expenses::create([
            'type' => $request->type,
            'name' => $request->name,
            'date' => $request ->date,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'total' => $request->total,
        ]);
        return redirect()->to('/biaya');
    }

    public function editExpenses($id)
    {

        $expenses = DB::table('expenses')->where('id',$id)->get();
        return view('expenses.editExpenses',['expenses'=>$expenses]);

    }

    public function updateExpenses(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'date' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'total' => 'required',
        ]);

        Expenses::where('id',$request->id)->update([
            'type' => $request->type,
            'name' => $request->name,
            'date' => $request ->date,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'total' => $request->total,
        ]);
        // dd($shop);

        return redirect()->to('/biaya');
    }

    public function deleteExpenses($id)
    {
    DB::table('expenses')->where('id',$id)->delete();
    return redirect('/biaya');
    }
    
}
