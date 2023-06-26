<!DOCTYPE html>
<html>
<head>
	<title>Laporan Keuangan Toko Batik Kiki</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h4>Laporan Keuangan</h4>
		<h5>Toko Batik Kiki Cirebon</h5>
        @if(Route::is('cetakPdfFiltered'))
        <h6>Tanggal {{date('d M Y',strtotime($start_date))}} - {{date('d M Y',strtotime($end_date))}}</h6>
        @endif
	</center>
 
	<table class='table table-bordered'>
                                <thead class="border-success">
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Deskripsi</th>
                                        <th>Pemasukan</th>
                                        <th>Pengeluaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php
                                $tmasuk = 0;
                                $tkeluar = 0;
                                @endphp
                                @foreach ($data as $key => $data)
                                
                                @php
                                    $tmasuk += $data->pemasukan;
                                $tkeluar += $data->pengeluaran;
                                @endphp
                                @if($loop->last)
                                        <tr class=" border-black border-top border-start border-end">
                                    @else
                                    <tr>
                                    @endif
                                        <th class="border-end border-black">{{++$key}}</th>
                                        <th>{{$data->date}}</th>
                                        <th>{{$data->type}}</th>
                                        @if($data->pemasukan=="0")
                                        <th></th>
                                        <th class="border-start border-black">Rp{{number_format($data->pengeluaran,0,'','.')}}</th>
                                        @else
                                        <th>Rp{{number_format($data->pemasukan,0,'','.')}}</th>
                                        <th></th>
                                        @endif
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
                            </div>
</body>
</html>

                