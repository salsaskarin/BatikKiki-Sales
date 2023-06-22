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
use PDF;

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
        ->orderBy('date','desc')
        ->paginate(15);
        $now = Carbon::now()->toDateString();
        return view('report.home', compact('data','now'));
    }

    public function reportReport()
    {
        if (request()->start_date) {
            $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
            if(!empty(request()->end_date)){
                $end_date = Carbon::parse(request()->end_date)->toDateTimeString();
            }else{
                $end_date = Carbon::now();
            }
            
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
            ->paginate();
        } else {
            $data = report::latest()->get();
        }
        $now = Carbon::now()->toDateString();
        return view('report.home', compact('data','now'));
    }

    public function cetakPdf()
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
 
    	$pdf = PDF::loadview('report.cetak',['data'=>$data]);
    	return $pdf->download('laporan-keuangan.pdf');
    }

    public function cetakPdfFiltered()
    {
    	if (request()->start_date) {
            $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
            if(!empty(request()->end_date)){
                $end_date = Carbon::parse(request()->end_date)->toDateTimeString();
            }else{
                $end_date = Carbon::now();
            }
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
        }
 
    	$pdf = PDF::loadview('report.cetak',[
            'data'=>$data,
            'start_date'=>$start_date,
            'end_date'=>$end_date,
        ]);
    	return $pdf->download('laporan-keuangan.pdf');
    }
    
}
