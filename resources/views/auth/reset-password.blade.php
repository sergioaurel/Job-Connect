@extends('layouts.app')

@section('title', 'Nouveau mot de passe — JobConnect Bénin')

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

            {{-- Illustration clé --}}
            <div class="w-24 h-24 bg-yellow-400/10 rounded-full flex items-center justify-center mx-auto mb-8"
                 style="border:2px solid rgba(250,204,21,0.2)">
                <svg class="w-10 h-10 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                </svg>
            </div>

            <h2 class="text-white font-extrabold text-3xl mb-4 leading-tight" style="letter-spacing:-0.02em">
                Choisissez un<br><span class="text-yellow-400">nouveau mot<br>de passe</span>
            </h2>
            <p class="text-gray-500 text-sm leading-relaxed mb-10">
                Votre nouveau mot de passe doit être différent de l'ancien et contenir au moins 8 caractères.
            </p>

            {{-- Conseils sécurité --}}
            <div class="space-y-3 text-left">
                @foreach([
                    ['🔡', 'Au moins 8 caractères'],
                    ['🔢', 'Mélangez lettres et chiffres'],
                    ['🔒', 'Utilisez un caractère spécial'],
                    ['🚫', 'N\'utilisez pas votre nom'],
                ] as $tip)
                <div class="flex items-center gap-3">
                    <span class="text-base">{{ $tip[0] }}</span>
                    <p class="text-gray-500 text-sm">{{ $tip[1] }}</p>
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

            {{-- Icône clé --}}
            <div class="w-14 h-14 bg-yellow-400/10 rounded-2xl flex items-center justify-center mb-6"
                 style="border:1px solid rgba(250,204,21,0.25)">
                <svg class="w-7 h-7 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                </svg>
            </div>

            <h1 class="text-gray-900 font-extrabold text-3xl mb-2" style="letter-spacing:-0.02em">
                Nouveau mot<br>de passe
            </h1>
            <p class="text-gray-500 text-sm mb-8 leading-relaxed">
                Choisissez un mot de passe sécurisé pour protéger votre compte JobConnect.
            </p>

            <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
                @csrf

                {{-- Token caché — obligatoire pour Laravel --}}
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                {{-- Email (pré-rempli, caché visuellement) --}}
                <input type="hidden" name="email" value="{{ old('email', $request->email) }}">

                {{-- Nouveau mot de passe --}}
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                        Nouveau mot de passe
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </span>
                        <input id="password" type="password" name="password"
                               required autofocus placeholder="Min. 8 caractères"
                               class="w-full pl-11 pr-12 py-3 text-sm rounded-xl border bg-gray-50 text-gray-900 placeholder-gray-400 focus:outline-none focus:bg-white focus:border-yellow-400 focus:ring-2 transition-all
                               @error('password') border-red-400 bg-red-50 focus:ring-red-200 @else border-gray-200 focus:ring-yellow-400/20 @enderror">
                        {{-- Toggle œil --}}
                        <button type="button" id="toggle-password" tabindex="-1"
                                class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-yellow-500 transition-colors focus:outline-none"
                                aria-label="Afficher/masquer le mot de passe">
                            <svg id="eye-open-1" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <svg id="eye-closed-1" class="w-4 h-4 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                            </svg>
                        </button>
                    </div>

                    {{-- Indicateur de force --}}
                    <div class="mt-2">
                        <div class="flex gap-1 mb-1">
                            <div id="strength-1" class="h-1 flex-1 rounded-full bg-gray-200 transition-all duration-300"></div>
                            <div id="strength-2" class="h-1 flex-1 rounded-full bg-gray-200 transition-all duration-300"></div>
                            <div id="strength-3" class="h-1 flex-1 rounded-full bg-gray-200 transition-all duration-300"></div>
                            <div id="strength-4" class="h-1 flex-1 rounded-full bg-gray-200 transition-all duration-300"></div>
                        </div>
                        <p id="strength-text" class="text-xs text-gray-400"></p>
                    </div>

                    @error('password')
                    <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                {{-- Confirmer le mot de passe --}}
                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                        Confirmer le nouveau mot de passe
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </span>
                        <input id="password_confirmation" type="password" name="password_confirmation"
                               required placeholder="Répéter le mot de passe"
                               class="w-full pl-11 pr-12 py-3 text-sm rounded-xl border border-gray-200 bg-gray-50 text-gray-900 placeholder-gray-400 focus:outline-none focus:bg-white focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 transition-all">
                        {{-- Toggle œil confirm --}}
                        <button type="button" id="toggle-confirm" tabindex="-1"
                                class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-yellow-500 transition-colors focus:outline-none"
                                aria-label="Afficher/masquer la confirmation">
                            <svg id="eye-open-2" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <svg id="eye-closed-2" class="w-4 h-4 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                            </svg>
                        </button>
                    </div>

                    {{-- Indicateur correspondance --}}
                    <p id="match-text" class="mt-1.5 text-xs hidden"></p>

                    @error('password_confirmation')
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
                        class="w-full py-3.5 mt-2 bg-gray-900 text-white font-extrabold rounded-xl text-sm flex items-center justify-center gap-2 hover:bg-yellow-400 hover:text-gray-900 transition-all duration-200">
                    Réinitialiser mon mot de passe
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

@push('scripts')
<script>
(function () {
    // ── Toggle œil mot de passe ──
    function togglePwd(btnId, inputId, openId, closedId) {
        const btn    = document.getElementById(btnId);
        const input  = document.getElementById(inputId);
        const open   = document.getElementById(openId);
        const closed = document.getElementById(closedId);
        if (!btn) return;
        btn.addEventListener('click', function () {
            const show = input.type === 'password';
            input.type = show ? 'text' : 'password';
            open.classList.toggle('hidden', show);
            closed.classList.toggle('hidden', !show);
        });
    }
    togglePwd('toggle-password', 'password',              'eye-open-1', 'eye-closed-1');
    togglePwd('toggle-confirm',  'password_confirmation', 'eye-open-2', 'eye-closed-2');

    // ── Indicateur de force ──
    const pwdInput = document.getElementById('password');
    const bars     = [1,2,3,4].map(i => document.getElementById('strength-' + i));
    const strengthText = document.getElementById('strength-text');

    const levels = [
        { color: 'bg-red-400',    label: 'Très faible',  textClass: 'text-red-400'    },
        { color: 'bg-orange-400', label: 'Faible',       textClass: 'text-orange-400' },
        { color: 'bg-yellow-400', label: 'Moyen',        textClass: 'text-yellow-500' },
        { color: 'bg-green-500',  label: 'Fort',         textClass: 'text-green-600'  },
    ];

    function getStrength(val) {
        let score = 0;
        if (val.length >= 8)                     score++;
        if (val.length >= 12)                    score++;
        if (/[A-Z]/.test(val) && /[a-z]/.test(val)) score++;
        if (/[0-9]/.test(val))                   score++;
        if (/[^A-Za-z0-9]/.test(val))            score++;
        return Math.min(Math.ceil(score * 4 / 5), 4);
    }

    pwdInput.addEventListener('input', function () {
        const val = this.value;
        if (!val) {
            bars.forEach(b => { b.className = 'h-1 flex-1 rounded-full bg-gray-200 transition-all duration-300'; });
            strengthText.textContent = '';
            return;
        }
        const score = getStrength(val); // 1-4
        const lvl   = levels[score - 1];
        bars.forEach((b, i) => {
            b.className = 'h-1 flex-1 rounded-full transition-all duration-300 ' + (i < score ? lvl.color : 'bg-gray-200');
        });
        strengthText.textContent  = 'Force : ' + lvl.label;
        strengthText.className    = 'text-xs ' + lvl.textClass;
    });

    // ── Indicateur correspondance ──
    const confirmInput = document.getElementById('password_confirmation');
    const matchText    = document.getElementById('match-text');

    confirmInput.addEventListener('input', function () {
        if (!this.value) { matchText.classList.add('hidden'); return; }
        const match = this.value === pwdInput.value;
        matchText.classList.remove('hidden');
        if (match) {
            matchText.textContent  = '✓ Les mots de passe correspondent';
            matchText.className    = 'mt-1.5 text-xs text-green-600 flex items-center gap-1';
        } else {
            matchText.textContent  = '✗ Les mots de passe ne correspondent pas';
            matchText.className    = 'mt-1.5 text-xs text-red-500 flex items-center gap-1';
        }
    });
})();
</script>
@endpush
@endsection