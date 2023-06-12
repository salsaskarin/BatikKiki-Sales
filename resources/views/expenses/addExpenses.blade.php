<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
<x-app-layout>
    <x-slot name="header">
    @section('title','Tambah Penjualan | Batik Kiki Sales')
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h4 class="font-semibold text-gray-800 leading-tight">
            {{ __(' Tambah Pengeluaran Biaya') }}
        </h4>
        <p class="mt-1 text-sm text-gray-600">
            {{ __("Isi form berikut untuk menambah data pengeluaran.") }}
        </p>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <form method="POST" action="{{ route('simpanBiaya') }}">
        @csrf

        <!-- Tanggal -->
        <div class="mt-4">
            <x-input-label for="date" :value="__('Tanggal Pengeluaran')" />
            <p class="mt-1 text-sm text-gray-600">
            {{ __("(Wajib diisi)") }}
            </p>
            <x-text-input id="date" class="col-md-3 col-sm-12 block mt-1 w-full" type="date" name="date" :value="old('date')" />
            <x-input-error :messages="$errors->get('date')" class="mt-2" />
        </div>

        <!-- Type -->
        <div class="mt-4">
            <x-input-label for="type" :value="__('Kategori Pengeluaran')" />
            <p class="mt-1 text-sm text-gray-600">
            {{ __("(Wajib diisi)") }}
        </p>
            <x-text-input id="type" class="block mt-1 w-full" type="text" name="type" :value="old('type')" />
            <x-input-error :messages="$errors->get('type')" class="mt-2" />
        </div>

        <!-- name -->
        <div class="mt-4">
            <x-input-label for="name" :value="__('Catatan Pengeluaran')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- quantity -->
        <x-input-label for="quantity" :value="__('Jumlah')" class="mt-4"/>
        <p class="mt-1 text-sm text-gray-600">
            {{ __("(Wajib diisi)") }}
        </p>         
                <x-text-input type="number" class="col-md-2 col-sm-12 block mt-1 w-full" placeholder="" id="quantity" name="quantity" onchange="getTotal()" :value="old('quantity')" />
            
          <x-input-error :messages="$errors->get('quantity')" class="mt-2" />

        <!-- Price -->
        <x-input-label for="price" :value="__('Harga')" class="mt-4"/>
        <div class=" col-md-3 col-sm-12">
            <div class="input-group col-md-3 col-sm-12">
                <span class="input-group-text" id="basic-addon1">Rp.</span>
                <input type="number" class="form-control" placeholder="" id="price" name="price" onchange="getTotal()" value="{{old('price')}}" >
            </div>
            <x-input-error :messages="$errors->get('price')" class="mt-2" />
        </div>

        <!-- Total Harga -->
        <div class="mt-4 "><small class="btn btn-secondary btn-sm">Hitung total harga</small></div>
        
        <x-input-label for="pengeluaran" :value="__('Total Harga')" class="mt-4 "/>
        <p class="mt-1 text-sm text-gray-600">
            {{ __("(Wajib diisi)") }}
        </p>
        <div class=" col-md-3 col-sm-12">
            <div class="input-group col-md-3 col-sm-12">
                <span class="input-group-text" id="basic-addon1">Rp.</span>
                <input type="number" class="form-control" placeholder="" id="pengeluaran" name="pengeluaran" value="{{old('pengeluaran')}}" >
            </div>
          <x-input-error :messages="$errors->get('pengeluaran')" class="mt-2" />
        </div>

        <!-- Hidden -->
        <div class="mt-4">
        <input type="hidden" class="form-control" placeholder="" id="pemasukan" name="pemasukan" value=0>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-4">
                {{ __('Simpan') }}
            </x-primary-button>
        </div>

    </form>
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
        document.getElementById('pengeluaran').value = total
    }
</script>
