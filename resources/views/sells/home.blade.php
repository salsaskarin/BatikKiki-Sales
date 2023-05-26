<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Penjualan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <a href="/penjualan/tambahPenjualan" class="btn btn-primary mb-4">Tambah Penjualan</a>
                <table class="table table-bordered table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tanggal</th>
                                        <th>Nama Pembeli</th>
                                        <th>Produk</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Total Harga</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($sells as $sells)
                                    <tr>
                                        <th>{{$sells->id}}</th>
                                        <th>{{$sells->date}}</th>
                                        <th>{{$sells->name}}</th>
                                        <th>{{$sells->p_name}}</th>
                                        <th>{{$sells->quantity}}</th>
                                        <th>{{$sells->price}}</th>
                                        <th>{{$sells->total}}</th>
                                        <th><a href="/penjualan/editPenjualan/{{$sells->id}}" class="btn btn-success">Edit</a> | <a href="/penjualan/hapusPenjualan/{{$sells->id}}" class="btn btn-danger">Delete</a></th>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
