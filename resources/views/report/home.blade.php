<x-app-layout>
    <x-slot name="header">
    <meta charset="utf-8">
    @section('title','Laporan Keuangan | Batik Kiki Sales')
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h4 class="font-semibold text-gray-800 leading-tight">
            {{ __('Laporan Keuangan') }}
        </h4>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <div class="row justify-content-between">
                    <div class="col-3">
                    @if(Route::is('laporanKeuangan'))
                     <a href="/laporan/cetakpdf" class="btn btn-outline-primary mb-4">Cetak Pdf</a>
                    @else    
                        <a href="/laporan/cetakpdffilter?start_date={{app('request')->input('start_date')}}&end_date={{app('request')->input('end_date')}}" class="btn btn-outline-primary mb-4">Cetak PDF</a>
                    @endif
                    </div>
                    <div class="col-6">
                    <form action="{{ route('filterLaporan') }}" method="GET">
                        <small class="font-semibold text-gray-800 leading-tight">Filter tanggal laporan keuangan : </small>
                        <div class="input-group mt-1 mb-4">
                            <small class="font-semibold text-gray-800 mt-2 mr-2 leading-tight">Dari :  </small>
                            <input type="date" class="form-control" placeholder="Dari" name="start_date" required>
                            <small class="font-semibold text-gray-800 mt-2 ml-2 mr-2 leading-tight">Sampai : </small>
                            <input type="date" class="form-control" placeholder="Sampai" name="end_date" value="{{$now}}">
                            <button class="btn btn-outline-secondary" type="submit">Cari</button>
                            <a class="btn btn-outline-danger" href="/laporan">Reset filter</a>
                        </div>
                        </form>
                    </div>
                </div>
                
                <div class="table-responsive">
                <table class="table table-bordered table-hover text-center">
                                <thead class="border-success">
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Deskripsi</th>
                                        <th>Pemasukkan</th>
                                        <th>Pengeluaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php
                                $tmasuk = 0;
                                $tkeluar = 0;
                                @endphp
                                @foreach ($data as $key => $dt)
                                
                                @php
                                    $tmasuk += $dt->pemasukan;
                                $tkeluar += $dt->pengeluaran;
                                @endphp
                                @if($loop->last)
                                        <tr class=" border-black border-top border-start border-end">
                                    @else
                                    <tr>
                                    @endif
                                        <th class="border-end border-black">{{++$key}}</th>
                                        <th>{{date(" d F Y",strtotime($dt->date))}}</th>
                                        <th>{{$dt->type}}</th>
                                        <th>Rp{{number_format($dt->pemasukan,0,'','.')}}</th>
                                        <th class="border-start border-black">Rp{{number_format($dt->pengeluaran,0,'','.')}}</th>
                                    </tr>
                                @endforeach
                                <tr class=" border-black">
                                       
                                        <td colspan="3" class="font-semibold">Jumlah</td>
                                        <td colspan="1"class="font-semibold">Rp{{number_format($tmasuk,0,'','.')}}</td>
                                        <td colspan="1"class="font-semibold">Rp{{number_format($tkeluar,0,'','.')}}</td>
                                    </tr>
                                    @php
                                $pendapatan = 0;
                                $pendapatan = ($tmasuk-$tkeluar);
                                @endphp
                                    <tr class=" border-black">
                                        <td colspan="3" class="font-semibold">Pendapatan</td>
                                        <td colspan="2"class="font-semibold">Rp{{number_format($pendapatan,0,'','.')}}</td>
                                    </tr>
                                </tbody>
                            </table>
                            {!! $data->withQueryString()->links('pagination::bootstrap-5') !!}
                            </div>
                            <!-- Option 1: Bootstrap Bundle with Popper -->
                        </div>
            </div>
        </div>
    </div>
</x-app-layout>

