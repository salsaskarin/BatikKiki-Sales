<x-guest-layout>
<x-slot name="header">
    @section('title','Lupa Kata Sandi | Batik Kiki Sales')
        
    </x-slot>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Lupa kata sandi Anda? Tidak masalah. Beri tahu kami alamat email Anda dan kami akan mengirimi tautan untuk melakukan setel ulang kata sandi melalui email yang Anda masukkan.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Kirim email ganti kata sandi') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
