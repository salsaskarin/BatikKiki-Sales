<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
<x-app-layout>
    <x-slot name="header">
    @section('title','Edit Penjualan | Batik Kiki Sales')
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @foreach($sells as $sells)
        <small class="text-gray-500">Update terakhir : {{$sells->updated_at}}</small>
           <h4 class="font-semibold text-gray-800 leading-tight">
            {{ __('Edit Penjualan') }}
        </h4>
        <p class="mt-1 text-sm text-gray-600">
            {{ __("Isi form berikut untuk mengubah data penjualan.") }}
        </p>
        @if(session()->has('message'))
            <div class="alert alert-warning">
                {{ session()->get('message') }}
            </div>
        @endif 
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <form method="POST" action="{{ route('updatePenjualan') }}">
        @csrf
        {{ method_field('PUT') }}

        <input type="hidden" name="id" value="{{$sells->id}}">

        <!-- Tanggal -->
        <div class="mt-4">
            <x-input-label for="date" :value="__('Tanggal Penjualan')" />
            <p class="mt-1 text-sm text-gray-600">
                {{ __("(Wajib diisi)") }}
            </p>
            <x-text-input id="date" class="col-md-3 col-sm-12 block mt-1 w-full" type="date" name="date" :value="old('date', $sells->date)" />
            <x-input-error :messages="$errors->get('date')" class="mt-2" />
        </div>

        <!-- Customer's name -->
        <div class="mt-4">
            <x-input-label for="customer" :value="__('Nama Pembeli')" />
            <x-text-input id="customer" class="block mt-1 w-full" type="text" name="customer" :value="old('customer', $sells->customer)" />
            <x-input-error :messages="$errors->get('customer')" class="mt-2" />
        </div>

        <!-- Name Product -->
        <div>
            <x-input-label for="p_name" :value="__('Nama Produk')" class="mt-4"/>
            <p class="mt-1 text-sm text-gray-600">
                {{ __("(Wajib diisi)") }}
            </p>
        <div class="form-group">
            <input type="text" id="search" name="p_name" autocomplete="off" placeholder="" class="form-control typeahead" value="{{old('p_name', $sells->p_name)}}"/>
        </div>
    <script type="text/javascript">
    var path = "{{ route('autocomplete') }}";
  
    $('#search').typeahead({
            source: function (query, process) {
                return $.get(path, {
                    query: query
                }, function (data) {
                    return process(data);
                });
            }
        });
  
        </script>
            <x-input-error :messages="$errors->get('p_name')" class="mt-2" />
        </div>

        <!-- quantity -->
        <x-input-label for="quantity" :value="__('Jumlah')" class="mt-4"/>
        <p class="mt-1 text-sm text-gray-600">
            {{ __("(Wajib diisi)") }}
        </p>
          <x-text-input type="number" class="col-md-2 col-sm-12 block mt-1 w-full" placeholder="" id="quantity" name="quantity" onchange="getTotal()" :value="old('quantity', $sells->quantity)" />
          <x-input-error :messages="$errors->get('quantity')" class="mt-2" />

        <!-- Price -->
        <x-input-label for="price" :value="__('Harga')" class="mt-4"/>
        <p class="mt-1 text-sm text-gray-600">
            {{ __("(Wajib diisi)") }}
        </p>
        <div class=" col-md-3 col-sm-12">
            <div class="input-group col-md-3 col-sm-12">
                <span class="input-group-text" id="basic-addon1">Rp.</span>
                <input type="number" class="form-control" placeholder="" id="price" name="price" onchange="getTotal()" value="{{old('price', $sells->price)}}" >
            </div>
            <x-input-error :messages="$errors->get('price')" class="mt-2" />
        </div>

        <!-- Total Harga -->
        <div class="mt-4 "><small class="btn btn-secondary btn-sm">Hitung total harga</small></div>

        <x-input-label for="total" :value="__('Total Harga')" class="mt-4"/>
        <p class="mt-1 text-sm text-gray-600">
            {{ __("(Wajib diisi)") }}
        </p>
        <div class=" col-md-3 col-sm-12">
        <div class="input-group col-md-3 col-sm-12">
          <span class="input-group-text" id="basic-addon1">Rp.</span>
          <input type="number" class="form-control" placeholder="" id="total" name="total" value="{{old('total', $sells->total)}}">
        </div>  
        <x-input-error :messages="$errors->get('total')" class="mt-2" />
        </div>

        <div class="mt-4">
        <input type="hidden" class="form-control" placeholder="" id="type" name="type" value="Penjualan Harian">
        </div>

        <div class="mt-4">
        <input type="hidden" class="form-control" placeholder="" id="pengeluaran" name="pengeluaran" value=0>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-4">
                {{ __('Simpan') }}
            </x-primary-button>
        </div>

    </form>
    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    var price = 0
    function getTotal(event){
        var price = document.getElementById('price').value
        var quantity = document.getElementById('quantity').value
        var total = price * quantity
        document.getElementById('total').value = total
    }
</script>
