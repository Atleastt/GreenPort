@extends('layouts.auth')

@section('content')
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-emerald-700">
    <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white shadow-xl overflow-hidden sm:rounded-lg">
        <div class="flex flex-col items-center mb-8">
            <svg class="h-16 w-16 text-emerald-600 mb-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z" />
        </svg>
            <h1 class="text-3xl font-bold text-emerald-700">Lupa Password</h1>
            <p class="text-gray-600 mt-1 text-center px-4">Masukkan alamat email Anda dan kami akan mengirimkan instruksi untuk mereset password Anda.</p>
        </div>

        <!-- Session Status -->
        {{-- <x-auth-session-status class="mb-4" :status="session('status')" /> --}}
        <div class="mb-4 text-sm text-green-600">
            {{-- Placeholder for session status message --}}
        </div>

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
                <input id="email" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-emerald-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50" type="email" name="email" :value="old('email')" required autofocus placeholder="contoh@email.com" />
                {{-- <x-input-error :messages="$errors->get('email')" class="mt-2" /> --}}
            </div>

            <div class="flex items-center justify-end mt-6">
                <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-emerald-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-emerald-500 focus:bg-emerald-500 active:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Kirim Instruksi Reset Password
                </button>
            </div>

            <div class="mt-6 text-center">
                <a href="{{ route('login.page') }}" class="text-sm text-gray-600 hover:text-emerald-500 underline">
                    Kembali ke Sign In
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
