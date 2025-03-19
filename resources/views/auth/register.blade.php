<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <center>
            <h1 class="text-3xl font-semibold align-middle lg:inline">Daftar</h1>
            <p class="text-sm text-gray-600 mx-1">Masukkan email dan password anda di sini!</p>
        </center>

        <!-- Email Address -->
        <div class="mt-7">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block text-sm mt-1 w-full" type="email" name="email"
                placeholder="Masukkan email anda!" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block text-sm mt-1 w-full" type="password" name="password"
                placeholder="Masukkan password anda!" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block text-sm mt-1 w-full" type="password"
                name="password_confirmation" placeholder="Konfirmasi password anda!" required
                autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="block mt-4">
            <x-primary-button class="w-full">
                {{ __('Daftar') }}
            </x-primary-button>
        </div>
        <center>
            <div class="justify-between mt-4">
                <a class="text-sm">Apakah anda sudah </a>
                <a class="underline text-sm text-blue-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('login') }}">
                    {{ __('punya akun?') }}
                </a>
            </div>
        </center>
    </form>
</x-guest-layout>
