<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Pengeluaran Biaya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <a href="/biaya/tambahBiaya" class="btn btn-primary mb-4">Tambah Pengeluaran</a>
                <table class="table table-bordered table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Nama</th>
                                        <th>Tipe Pengeluaran</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Total Harga</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($expenses as $expenses)
                                    <tr>
                                        <th>{{$loop->index+1}}</th>
                                        <th>{{$expenses->date}}</th>
                                        <th>{{$expenses->name}}</th>
                                        <th>{{$expenses->type}}</th>
                                        <th>{{$expenses->quantity}}</th>
                                        <th>{{$expenses->price}}</th>
                                        <th>{{$expenses->total}}</th>
                                        <th><a href="/biaya/editBiaya/{{$expenses->id}}" class="btn btn-success">Edit</a> | <a href="/biaya/hapusBiaya/{{$expenses->id}}" class="btn btn-danger">Delete</a></th>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
