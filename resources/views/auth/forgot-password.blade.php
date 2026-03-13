@extends('layouts.app')

@section('title', 'Mot de passe oublié — JobConnect Bénin')

@section('content')
<div class="min-h-screen flex bg-gray-950">

    {{-- ── Colonne gauche : visuelle ── --}}
    <div class="hidden lg:flex lg:w-1/2 relative flex-col items-center justify-center p-16 overflow-hidden"
         style="background:linear-gradient(135deg,#0A0A0A 0%,#111827 100%)">
        <div class="absolute -top-24 -left-24 w-96 h-96 rounded-full pointer-events-none"
             style="background:radial-gradient(circle,rgba(245,166,35,0.12),transparent 70%)"></div>
        <div class="absolute bottom-0 right-0 w-80 h-80 rounded-full pointer-events-none"
             style="background:radial-gradient(circle,rgba(245,166,35,0.08),transparent 70%)"></div>

        <div class="relative z-10 max-w-sm text-center">
            {{-- Logo --}}
            <div class="flex items-center justify-center gap-3 mb-12">
                <div class="w-12 h-12 bg-yellow-400 rounded-2xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-gray-900" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <span class="text-white font-extrabold text-2xl tracking-tight">Job<span class="text-yellow-400">Connect</span></span>
            </div>

            {{-- Illustration cadenas --}}
            <div class="w-24 h-24 bg-yellow-400/10 rounded-full flex items-center justify-center mx-auto mb-8"
                 style="border:2px solid rgba(250,204,21,0.2)">
                <svg class="w-10 h-10 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
            </div>

            <h2 class="text-white font-extrabold text-3xl mb-4 leading-tight" style="letter-spacing:-0.02em">
                Mot de passe<br><span class="text-yellow-400">oublié ?</span>
            </h2>
            <p class="text-gray-500 text-sm leading-relaxed mb-10">
                Pas de panique. Renseignez votre adresse email et nous vous enverrons un lien pour réinitialiser votre mot de passe.
            </p>

            {{-- Étapes --}}
            <div class="space-y-4 text-left">
                @foreach([
                    ['01', 'Entrez votre adresse email'],
                    ['02', 'Vérifiez votre boîte mail'],
                    ['03', 'Choisissez un nouveau mot de passe'],
                ] as $step)
                <div class="flex items-center gap-4">
                    <div class="w-8 h-8 rounded-full bg-yellow-400/15 flex items-center justify-center flex-shrink-0"
                         style="border:1px solid rgba(250,204,21,0.25)">
                        <span class="text-yellow-400 text-xs font-extrabold">{{ $step[0] }}</span>
                    </div>
                    <p class="text-gray-400 text-sm">{{ $step[1] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ── Colonne droite : formulaire ── --}}
    <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12 bg-white">
        <div class="w-full max-w-md">

            {{-- Logo mobile --}}
            <div class="lg:hidden flex items-center justify-center gap-2 mb-10">
                <div class="w-9 h-9 bg-yellow-400 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-gray-900" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <span class="text-gray-900 font-extrabold text-xl">Job<span class="text-yellow-500">Connect</span></span>
            </div>

            {{-- Icône cadenas desktop --}}
            <div class="w-14 h-14 bg-yellow-400/10 rounded-2xl flex items-center justify-center mb-6"
                 style="border:1px solid rgba(250,204,21,0.25)">
                <svg class="w-7 h-7 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
            </div>

            <h1 class="text-gray-900 font-extrabold text-3xl mb-2" style="letter-spacing:-0.02em">
                Réinitialiser le<br>mot de passe
            </h1>
            <p class="text-gray-500 text-sm mb-8 leading-relaxed">
                Entrez votre adresse email ci-dessous. Nous vous enverrons un lien de réinitialisation.
            </p>

            {{-- Status (lien envoyé) --}}
            @if(session('status'))
            <div class="mb-6 flex items-start gap-3 px-4 py-4 bg-green-50 border border-green-200 text-green-800 rounded-xl text-sm">
                <svg class="w-5 h-5 flex-shrink-0 text-green-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <div>
                    <p class="font-semibold text-green-800 mb-0.5">Email envoyé !</p>
                    <p class="text-green-700">{{ session('status') }}</p>
                </div>
            </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
                @csrf

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                        Adresse email
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </span>
                        <input id="email" type="email" name="email" value="{{ old('email') }}"
                               required autofocus placeholder="votre@email.com"
                               class="w-full pl-11 pr-4 py-3 text-sm rounded-xl border bg-gray-50 text-gray-900 placeholder-gray-400 focus:outline-none focus:bg-white focus:border-yellow-400 focus:ring-2 transition-all
                               @error('email') border-red-400 bg-red-50 focus:ring-red-200 @else border-gray-200 focus:ring-yellow-400/20 @enderror">
                    </div>
                    @error('email')
                    <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                {{-- Submit --}}
                <button type="submit"
                        class="w-full py-3.5 bg-gray-900 text-white font-extrabold rounded-xl text-sm flex items-center justify-center gap-2 hover:bg-yellow-400 hover:text-gray-900 transition-all duration-200">
                    Envoyer le lien de réinitialisation
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </button>
            </form>

            {{-- Retour connexion --}}
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-200"></div>
                </div>
                <div class="relative flex justify-center">
                    <span class="bg-white px-4 text-xs text-gray-400 uppercase tracking-widest">ou</span>
                </div>
            </div>

            <a href="{{ route('login') }}"
               class="w-full py-3.5 border-2 border-gray-200 text-gray-700 font-bold rounded-xl text-sm flex items-center justify-center gap-2 hover:border-yellow-400 hover:text-yellow-500 transition-all duration-200">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M7 16l-4-4m0 0l4-4m-4 4h18"/>
                </svg>
                Retour à la connexion
            </a>

        </div>
    </div>
</div>
@endsection