<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <form method="POST" action="{{ route('updateProduk') }}">
        @csrf
        {{ method_field('PUT') }}

        @foreach($product as $product)
        <input type="hidden" name="id" value="{{$product->id}}">

        <!-- Name Product -->
        <div>
            <x-input-label for="name" :value="__('Nama Produk')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $product->name)" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Size -->
        <div class="mt-4">
            <x-input-label for="size" :value="__('Ukuran')" />
            <x-text-input id="size" class="block mt-1 w-full" type="text" name="size" :value="old('size', $product->size)" />
            <x-input-error :messages="$errors->get('size')" class="mt-2" />
        </div>

        <!-- Stock -->
        <div class="mt-4">
            <x-input-label for="stock" :value="__('Jumlah Produk')" />
            <x-text-input id="stock" class="block mt-1 w-full" type="number" name="stock" :value="old('stock', $product->stock)" />
            <x-input-error :messages="$errors->get('stock')" class="mt-2" />
        </div>

        <!-- Highest Price -->
        <x-input-label for="highest_price" :value="__('Harga Tertinggi')" class="mt-4"/>
        <div class="input-group ">
          <span class="input-group-text" id="basic-addon1">Rp.</span>
          <input type="number" class="form-control" placeholder="" id="highest_price" name="highest_price" value="{{ $product->highest_price }}" >
          <x-input-error :messages="$errors->get('highest_price')" class="mt-2" />
        </div>

        <!-- Lowest Price -->
        <x-input-label for="lowest_price" :value="__('Harga Terendah')" class="mt-4"/>
        <div class="input-group ">
          <span class="input-group-text" id="basic-addon1">Rp.</span>
          <input type="number" class="form-control" placeholder="Harga" id="lowest_price" name="lowest_price" value="{{ $product->lowest_price }}">
          <x-input-error :messages="$errors->get('lowest_price')" class="mt-2" />
        </div>

        <!-- Details -->
        <div class="mt-4">
            <x-input-label for="details" :value="__('Deskripsi Produk')" />
            <x-text-input id="details" class="block mt-1 w-full" type="text" name="details" :value="old('details', $product->details)" />
            <x-input-error :messages="$errors->get('details')" class="mt-2" />
        </div>

        <!-- Image -->
        <div class="mt-4">
            <x-input-label for="image" :value="__('Upload Foto Produk')" />
            <x-text-input id="image" class="block mt-1 w-full" type="file" name="image" :value="old('image', $product->image)" />
            <x-input-error :messages="$errors->get('image')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-4">
                {{ __('Submit') }}
            </x-primary-button>
        </div>

    </form>
    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
