<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Pegawai') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <form method="POST" action="{{ route('updateUser') }}" enctype="multipart/form-data">
        @csrf
        {{ method_field('PUT') }}

        @foreach($user as $user)
        <input type="hidden" name="id" value="{{$user->id}}">

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nama')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $user->name)" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $user->email)" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Address -->
        <div class="mt-4">
            <x-input-label for="address" :value="__('Alamat')" />
            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address', $user->address)" />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <!-- Phone -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Nomor HP')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="number" name="phone" :value="old('phone', $user->phone)" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

                <!-- Birth -->
                <div>
            <x-input-label for="birth" :value="__('Tanggal lahir')" />
            <x-text-input id="birth" class="block mt-1 w-full" type="date" name="birth" :value="old('birth', $user->birth)"/>
            <x-input-error :messages="$errors->get('birth')" class="mt-2" />
        </div>

        <!-- Gender -->
        <div class="mt-4">
            <x-input-label for="gender" :value="__('Jenis Kelamin')" />
            <select name="gender" class="form-control" id="gender" value="{{ $user->gender }}">
                                <option value="0">Laki-Laki</option>
                                <option value="1" >Perempuan</option>
                            </select>
            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
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
