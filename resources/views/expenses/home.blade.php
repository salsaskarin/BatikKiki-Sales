<x-app-layout>
    <x-slot name="header">
    <meta charset="utf-8">
    @section('title','Pengeluaran | Batik Kiki Sales')   
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h4 class="font-semibold text-gray-800 leading-tight">
            {{ __('Daftar Pengeluaran Biaya') }}
        </h4>
        @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div> 
        @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <div class="row justify-content-between">
                    <div class="col-3">
                        <a href="/biaya/tambahBiaya" class="btn btn-primary mb-4">Tambah Pengeluaran</a>
                    </div>
                    <div class="col-6">
                    <form action="{{ route('filterBiaya') }}" method="GET">
                        <small class="font-semibold text-gray-800 leading-tight">Filter tanggal : </small>
                        <div class="input-group mt-1 mb-4">
                            <small class="font-semibold text-gray-800 mt-2 mr-2 leading-tight">Dari : </small>
                            <input type="date" class="form-control" placeholder="Dari" name="start_date" required>
                            <small class="font-semibold text-gray-800 mt-2 ml-2 mr-2 leading-tight">Sampai : </small>
                            <input type="date" class="form-control" placeholder="Sampai" name="end_date">
                            <button class="btn btn-outline-secondary" type="submit">Cari</button>
                            <a class="btn btn-outline-danger" href="/biaya">Reset filter</a>
                        </div>
                        </form>
                    </div>
                </div>
                
                <div class="table-responsive">
                <table class="table table-bordered table-hover text-center" >
                                <thead class="border-success">
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Kategori</th>
                                        <th>Catatan</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Total Harga</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($expenses as $key => $expenses)
                                    @if($loop->last)
                                        <tr class=" border-black border-top border-start border-end">
                                    @else
                                    <tr>
                                    @endif
                                        <th class="border-end border-black">{{++$key}}</th>
                                        <th>{{date(" d F Y",strtotime($expenses->date))}}</th>
                                        <th>{{$expenses->type}}</th>
                                        <th>{{$expenses->name}}</th>
                                        <th>{{$expenses->quantity}}</th>
                                        <th>Rp{{number_format($expenses->price,0,'','.')}}</th>
                                        <th>Rp{{number_format($expenses->pengeluaran,0,'','.')}}</th>
                                        <th class="border-start border-black"><a href="/biaya/editBiaya/{{$expenses->id}}" class="btn btn-success btn-sm">Edit</a>
                                        <a href="/biaya/hapusBiaya/{{$expenses->id}}" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin akan menghapus data pengeluaran ini?');">Delete</a></th>
                                    </tr>
                                @endforeach
                                <tr class=" border-black">
                                       
                                        <td colspan="6" class="font-semibold">Total Pengeluaran</td>
                                        <td colspan="2"class="font-semibold">Rp{{number_format($total,0,'','.')}}</td>
                                       
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
