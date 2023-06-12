<x-app-layout>
    <x-slot name="header">
    @section('title','Tambah Produk | Batik Kiki Sales')
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h4 class="font-semibold text-gray-800 leading-tight">
                    {{ __('Tambah Produk') }}
                </h4>
                <p class="mt-1 text-sm text-gray-600">
            {{ __("Isi form berikut untuk menambah data produk baru.") }}
        </p>
        <p class="mt-1 text-sm text-gray-600">
            {{ __("(semua wajib diisi)") }}
        </p>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                
                <form method="POST" action="{{ route('simpanProduk') }}" enctype="multipart/form-data">
        @csrf

        <!-- Name Product -->
        <div>
            <x-input-label for="name" :value="__('Nama Produk')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Size -->
        <div class="mt-4">
            <x-input-label for="size" :value="__('Ukuran')" />
            <x-text-input id="size" class="col-md-3 col-sm-12 block mt-1 w-full" type="text" name="size" :value="old('size')" />
            <x-input-error :messages="$errors->get('size')" class="mt-2" />
        </div>

        <!-- Stock -->
        <div class="mt-4">
            <x-input-label for="stock" :value="__('Jumlah Produk')" />
            <x-text-input id="stock" class="col-md-2 col-sm-12  block mt-1 w-full" type="number" name="stock" :value="old('stock')" />
            <x-input-error :messages="$errors->get('stock')" class="mt-2" />
        </div>

        <!-- Highest Price -->
        <x-input-label for="highest_price" :value="__('Harga Jual Tertinggi')" class="mt-4"/>
        <div class=" col-md-3 col-sm-12">
          <div class="input-group col-md-3 col-sm-12">
            <span class="input-group-text" id="basic-addon1">Rp.</span>
          <input type="number" class="form-control" placeholder="" id="highest_price" name="highest_price" value="{{old('highest_price')}}" >
          </div>
          <x-input-error :messages="$errors->get('highest_price')" class="mt-2" />
        </div>

        <!-- Lowest Price -->
        <x-input-label for="lowest_price" :value="__('Harga Jual Terendah')" class="mt-4"/>
        <div class=" col-md-3 col-sm-12">
          <div class="input-group col-md-3 col-sm-12">
            <span class="input-group-text" id="basic-addon1">Rp.</span>
          <input type="number" class="form-control" placeholder="" id="lowest_price" name="lowest_price" value="{{old('lowest_price')}}">
          </div>
          <x-input-error :messages="$errors->get('lowest_price')" class="mt-2" />
        </div>

        <!-- Details -->
        <div class="mt-4">
            <x-input-label for="details" :value="__('Deskripsi Produk')" />
            <small class="text-gray-500">Detail ukuran (size chart), detail barang, dan lain-lain.</small>
            <textarea name="details" id="details" class="form-control block mt-1 w-full rounded" rows="5">{{old('details')}}</textarea>
            <x-input-error :messages="$errors->get('details')" class="mt-2" />
        </div>

        <!-- Image -->
        <div class="col-md-3 col-sm-12 mt-4">
            <x-input-label for="image" :value="__('Upload Foto Produk')" />
          <input type="file" accept="image/*" name="image" class="form-control" value="{{old('image')}}">
          <small class="text-gray-500">File dalam .jpeg, .png, .jpg, .svg</small>
            <x-input-error :messages="$errors->get('image')" class="mt-2" />
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
