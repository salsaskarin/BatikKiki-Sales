<x-app-layout>
    <x-slot name="header">
    @section('title','Tambah Pegawai | Batik Kiki Sales')
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h4 class="font-semibold text-gray-800 leading-tight">
            {{ __('Tambah Pegawai') }}
        </h4>
        <p class="mt-1 text-sm text-gray-600">
            {{ __("Isi form berikut untuk menambah data pegawai.") }}
        </p>
        <p class="mt-1 text-sm text-gray-600">
            {{ __("(Semua wajib diisi)") }}
        </p>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <form method="POST" action="{{ route('simpanUser') }}" enctype="multipart/form-data">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nama')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <p class="mt-1 text-sm text-gray-600">
            {{ __("Jika tidak memiliki email isi dengan ('nama'@mail.com)") }}
        </p>
        <p class=" text-sm text-gray-600">
            {{ __("Contoh : karin@mail.com") }}
        </p>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Address -->
        <div class="mt-4">
            <x-input-label for="address" :value="__('Alamat')" />
            <textarea name="address" id="address" class="form-control block mt-1 w-full rounded" rows="5">{{old('address')}}</textarea>
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <!-- Phone -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Nomor HP')" />
            <x-text-input id="phone" class="col-md-4 col-sm-12 block mt-1 w-full" type="number" name="phone" :value="old('phone')" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

                <!-- Birth -->
        <div class="mt-4">
            <x-input-label for="birth" :value="__('Tanggal lahir')" />
            <x-text-input id="birth" class="col-md-3 col-sm-12 block mt-1 w-full" type="date" name="birth" :value="old('birth')" />
            <x-input-error :messages="$errors->get('birth')" class="mt-2" />
        </div>

        <!-- Gender -->
        <div class="mt-4">
            <x-input-label for="gender" :value="__('Jenis Kelamin')" />
            <div class="col-md-3 col-sm-12 block mt-1 w-full">
            <select name="gender" class="form-control" id="gender" value="{{old('gender')}}">
                                <option value="0">Laki-Laki</option>
                                <option value="1" >Perempuan</option>
                            </select>
            </div>
            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Pasang Kata Sandi')" />

            <x-text-input id="password" class="col-md-4 col-sm-12 block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Kata Sandi')" />

            <x-text-input id="password_confirmation" class="col-md-4 col-sm-12 block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
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
