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
use App\Models\Sells;


class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        $p1 = DB::table('dailysells')
        ->select('date', 'type', 'pemasukan', 'pengeluaran')
        ->orderBy('date');

        $p2 = DB::table('expenses')
         ->select('date', 'type', 'pemasukan', 'pengeluaran')
         ->orderBy('date');

        $p = $p1->unionAll($p2);

        $data = DB::table(DB::raw("({$p->toSql()}) AS p"))
        ->mergeBindings($p)
        ->select('date', 'type', 'pemasukan', 'pengeluaran')
        ->orderBy('date')
        ->get();
        return view('report.home', ['data' => $data]);
    }

    public function reportReport()
    {
        if (request()->start_date || request()->end_date) {
            $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
            $end_date = Carbon::parse(request()->end_date)->toDateTimeString();
            $p1 = DB::table('dailysells')
            ->select('date', 'type', 'pemasukan','pengeluaran');

            $p2 = DB::table('expenses')
            ->select('date', 'type', 'pemasukan','pengeluaran');

            $p = $p1->unionAll($p2);

            $data = DB::table(DB::raw("({$p->toSql()}) AS p"))
            ->mergeBindings($p)
            ->select('date', 'type', 'pemasukan','pengeluaran')
            ->whereBetween('date',[$start_date,$end_date])
            ->orderBy('date')
            ->get();
        } else {
            $data = report::latest()->get();
        }
        
        return view('report.home', compact('data'));
    }

    public function addreport()
    {
        return view("report.addreport");

    }
    
    public function storereport(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'date' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'total' => 'required',
        ]);

        report::create([
            'type' => $request->type,
            'name' => $request->name,
            'date' => $request ->date,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'total' => $request->total,
        ]);
        return redirect()->to('/biaya');
    }

    public function editreport($id)
    {

        $report = DB::table('report')->where('id',$id)->get();
        return view('report.editreport',['report'=>$report]);

    }

    public function updatereport(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'date' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'total' => 'required',
        ]);

        report::where('id',$request->id)->update([
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

    public function deletereport($id)
    {
    DB::table('report')->where('id',$id)->delete();
    return redirect('/biaya');
    }
    
}
