<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                
                    @foreach($product as $product)
                    <a href="/produk/editProduk/{{$product->id}}" class="btn btn-success">Edit</a>
                    <h4 class="font-semibold text-gray-800 leading-tight mb-4">{{$product->name}}</h4>
                    <h5 class="font-semibold text-gray-800 leading-tight mb-1">Foto Produk :</h5>
                    <img src="/images/product/{{ $product->image }}" width="50%">
                    <h5 class="font-semibold text-gray-800 leading-tight mt-4">Ukuran :</h5>
                    <h6 class="text-gray-800 leading-tight mt-1">{{$product->size}}</h6>
                    <h5 class="font-semibold text-gray-800 leading-tight mt-4">Jumlah Produk :</h6>
                    <h6 class="text-gray-800 leading-tight mt-1">{{$product->stock}}</h6>
                    <h5 class="font-semibold text-gray-800 leading-tight mt-4">Harga Tertinggi :</h5>
                    <h6 class="text-gray-800 leading-tight mt-1">{{$product->highest_price}}</h6>
                    <h5 class="font-semibold text-gray-800 leading-tight mt-4">Harga Terendah :</h5>
                    <h6 class="text-gray-800 leading-tight mt-1">{{$product->lowest_price}}</h6>
                    <h5 class="font-semibold text-gray-800 leading-tight mt-4">Deskripsi Produk :</h5>
                    <h6 class="text-gray-800 leading-tight mt-1">{{$product->details}}</h6>
                            @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
