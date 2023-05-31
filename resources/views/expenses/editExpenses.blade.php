<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Form Edit Pengeluaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <form method="POST" action="{{ route('updateBiaya') }}">
        @csrf
        {{ method_field('PUT') }}

        @foreach($expenses as $expenses)
        <input type="hidden" name="id" value="{{$expenses->id}}">

        <!-- Tanggal -->
        <div class="mt-4">
            <x-input-label for="date" :value="__('Tanggal Pengeluaran')" />
            <x-text-input id="date" class="block mt-1 w-full" type="date" name="date" :value="old('date', $expenses->date)" />
            <x-input-error :messages="$errors->get('date')" class="mt-2" />
        </div>

        <!-- name -->
        <div class="mt-4">
            <x-input-label for="name" :value="__('Nama Pengeluaran')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $expenses->name)" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Type -->
        <div class="mt-4">
            <x-input-label for="type" :value="__('Tipe Pengeluaran')" />
            <x-text-input id="type" class="block mt-1 w-full" type="text" name="type" :value="old('type', $expenses->type)" />
            <x-input-error :messages="$errors->get('type')" class="mt-2" />
        </div>

        <!-- quantity -->
        <x-input-label for="quantity" :value="__('Jumlah')" class="mt-4"/>
        <div class="input-group ">
          <input type="number" class="form-control" placeholder="" id="quantity" name="quantity" onchange="getTotal()" value="{{ $expenses->quantity }}" >
          <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
        </div>

        <!-- Price -->
        <x-input-label for="price" :value="__('Harga')" class="mt-4"/>
        <div class="input-group ">
          <span class="input-group-text" id="basic-addon1">Rp.</span>
          <input type="number" class="form-control" placeholder="" id="price" name="price" onchange="getTotal()" value="{{ $expenses->price }}" >
          <x-input-error :messages="$errors->get('price')" class="mt-2" />
        </div>

        <!-- Total Harga -->
        <x-input-label for="total" :value="__('Total Harga')" class="mt-4"/>
        <div class="input-group ">
          <span class="input-group-text" id="basic-addon1">Rp.</span>
          <input type="number" class="form-control" placeholder="" id="total" name="total" value="{{ $expenses->total }}" readonly >
          <x-input-error :messages="$errors->get('total')" class="mt-2" />
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
<script>
    var price = 0
    function getTotal(event){
        var price = document.getElementById('price').value
        var quantity = document.getElementById('quantity').value
        var total = price * quantity
        document.getElementById('total').value = total
    }
</script>
