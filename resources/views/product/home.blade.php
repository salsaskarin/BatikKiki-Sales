<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <a href="/produk/tambahProduk" class="btn btn-primary">Tambah Produk</a>
                <table class="table table-bordered table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Foto Produk</th>
                                        <th>Nama Produk</th>
                                        <th>Ukuran</th>
                                        <th>Harga tertinggi</th>
                                        <th>Harga terendah</th>
                                        <th>Stock</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($product as $product)
                                    <tr>
                                        <th>{{$loop->index+1}}</th>
                                        <th><img src="/images/product/{{ $product->image }}" width="100px"></th>
                                        <th>{{$product->name}}</th>
                                        <th>{{$product->size}}</th>
                                        <th>{{$product->highest_price}}</th>
                                        <th>{{$product->lowest_price}}</th>
                                        <th>{{$product->stock}}</th>
                                        <th><a href="/produk/detailProduk/{{$product->id}}" class="btn btn-info">Detail</a>
                                         | <a href="/produk/editProduk/{{$product->id}}" class="btn btn-success">Edit</a>
                                          | <a href="/produk/hapusProduk/{{$product->id}}" class="btn btn-danger">Delete</a>
                                    </th>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
