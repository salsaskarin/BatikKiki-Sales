<x-app-layout>
    <x-slot name="header">
        @section('title','Produk | Batik Kiki Sales')       
    </x-slot>
    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h4 class="font-semibold text-gray-800 leading-tight">
            {{ __('Daftar Produk') }}
        </h4> 
        @if(session()->has('msg'))
        <div class="alert alert-danger">
            {{ session()->get('msg') }}
        </div>
        @endif
        @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div> 
        @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <div class="row justify-content-between">
                    <div class="col-3">
                    <a href="/produk/tambahProduk" class="btn btn-outline-primary">Tambah Produk</a>
                    </div>
                    <div class="col-3">
                    <form class="form" method="get" action="{{ route('search') }}">
                        <div class="form-group w-100 mb-3">
                            <input type="text" name="search" class="form-control w-75 d-inline" id="search" placeholder="Nama Produk">
                            <button type="submit" class="btn btn-outline-secondary mb-1">Cari</button>
                        </div>
                    </form>
                    </div>
                </div>
                

                <div class="row">
                @foreach($product as $product)
                <div class="col-md-3 col-sm-12 mt-4 d-flex align-items-stretch">
                    <div class="card shadow sm:rounded-lg" style="width: 18rem;">
                        
                        <div class="card-body d-flex align-items-center">
                            <img src="/images/product/{{ $product->image }}" class="card-img-top" alt="gambar">
                        </div>
                        <div class="card-footer text-sm">
                        <h5 class="card-title">{{$product->name}}</h5>
                        <p class="card-text">Ukuran : {{$product->size}}</p>
                        <p class="card-text">Harga Tertinggi : Rp{{number_format($product->highest_price,0,'','.')}}</p>
                        <p class="card-text">Harga Terendah : Rp{{number_format($product->lowest_price,0,'','.')}}</p>
                        <p class="card-text">Stok : {{$product->stock}}</p>
                        <div class="form-group text-center">
                        <a href="/produk/detailProduk/{{$product->id}}" class="btn btn-info btn-sm">Detail</a>
                        <a href="/produk/editProduk/{{$product->id}}" class="btn btn-success btn-sm">Edit</a>
                        <a href="/produk/hapusProduk/{{$product->id}}" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin akan menghapus data ?');">Delete</a>
                        </div>
                        </div>
                    </div>       
                    </div>         
                 @endforeach
                 </div>
                 </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>