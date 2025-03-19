<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />
<br>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        
        <center>
            <h1 class="text-3xl  font-semibold  align-middle lg:inline ">Masuk</h1>
            <p class="text-sm text-gray-600 ">Masukkan email dan password anda di sini!</p>
        </center>



        <div class="mt-7">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block text-sm mt-1 w-full" type="email" name="email" placeholder="Masukkan email anda!" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block text-sm mt-1 w-full" type="password" placeholder="Masukkan password anda!" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex mt-2 px-3 ">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Ingat saya') }}</span>
            </label>
             <div class="mx-7"></div>
            @if (Route::has('password.request'))
                <a class="underline text-sm text-blue-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('password.request') }}">
                    {{ __('Lupa password?') }}
                </a>
            @endif
        </div>

        <div class="block mt-4">
            <x-primary-button>
                {{ __('Masuk') }}
            </x-primary-button>
        </div>
<center>
        <div class="justify-between mt-4">
            <a class="text-sm">Apakah anda tidak</a>
            <a class="underline text-sm text-blue-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('register') }}">
                {{ __('punya akun?') }}
            </a>
        </div></center>
    </form>
</x-guest-layout>
