<x-app-layout>
    <x-slot name="header">
    @section('title','Produk | Batik Kiki Sales')  
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h4 class="font-semibold text-gray-800 leading-tight">
            {{ __('Detail Produk') }}
        </h4>
            @foreach($product as $product)
            <div class="text-end">
            <a href="/produk/editProduk/{{$product->id}}" class="btn btn-outline-success">Edit Produk</a>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900 container">
                <div class="row">
                    <div class="col-4">
                    <img src="/images/product/{{ $product->image }}">
                    </div>
                    <div class="col-8">
                    <h4 class="font-semibold text-gray-800 leading-tight mb-4">{{$product->name}}</h4>
                    <h5 class="font-semibold text-gray-800 leading-tight mt-4">Ukuran :</h5>
                    <h6 class="text-gray-800 leading-tight mt-1">{{$product->size}}</h6>
                    <h5 class="font-semibold text-gray-800 leading-tight mt-4">Jumlah Produk :</h6>
                    <h6 class="text-gray-800 leading-tight mt-1">{{$product->stock}}</h6>
                    <h5 class="font-semibold text-gray-800 leading-tight mt-4">Harga Tertinggi :</h5>
                    <h6 class="text-gray-800 leading-tight mt-1">Rp{{number_format($product->highest_price,0,'','.')}}</h6>
                    <h5 class="font-semibold text-gray-800 leading-tight mt-4">Harga Terendah :</h5>
                    <h6 class="text-gray-800 leading-tight mt-1">Rp{{number_format($product->lowest_price,0,'','.')}}</h6>
                    <h5 class="font-semibold text-gray-800 leading-tight mt-4">Deskripsi Produk :</h5>
                    <h6 class="text-gray-800 leading-tight mt-1">{!! nl2br(e($product->details)) !!}</h6>
                    </div>
                </div>
                    <small class="text-gray-500">Update terakhir : {{$product->updated_at}}</small>
                            @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
