@extends('layouts.app')

@section('title', 'Connexion — JobConnect Bénin')

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
            <div class="flex items-center justify-center gap-3 mb-12">
                <div class="w-12 h-12 bg-yellow-400 rounded-2xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-gray-900" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <span class="text-white font-extrabold text-2xl tracking-tight">Job<span class="text-yellow-400">Connect</span></span>
            </div>
            <h2 class="text-white font-extrabold text-3xl mb-4 leading-tight" style="letter-spacing:-0.02em">
                Bienvenue sur<br>la plateforme emploi<br><span class="text-yellow-400">n°1 au Bénin</span>
            </h2>
            <p class="text-gray-500 text-sm leading-relaxed mb-10">
                Des centaines d'offres d'emploi et de stages vous attendent. Connectez-vous et décrochez votre prochaine opportunité.
            </p>
            <!-- <div class="grid grid-cols-3 gap-3">
                @foreach([['4+','Offres actives'],['4+','Entreprises'],['1+','Stages']] as $s)
                <div class="rounded-2xl p-4" style="background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.08)">
                    <p class="text-yellow-400 font-extrabold text-xl">{{ $s[0] }}</p>
                    <p class="text-gray-500 text-xs mt-0.5">{{ $s[1] }}</p>
                </div>
                @endforeach
            </div> -->
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

            <h1 class="text-gray-900 font-extrabold text-3xl mb-1" style="letter-spacing:-0.02em">Se connecter</h1>
            <p class="text-gray-500 text-sm mb-8">
                Pas encore de compte ?
                <a href="{{ route('register') }}" class="text-yellow-500 font-semibold hover:text-yellow-400 transition-colors">Créer un compte</a>
            </p>

            @if(session('status'))
            <div class="mb-5 flex items-center gap-3 px-4 py-3 bg-green-50 border border-green-200 text-green-800 rounded-xl text-sm">
                <svg class="w-4 h-4 flex-shrink-0 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                {{ session('status') }}
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Adresse email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </span>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                               placeholder="votre@email.com"
                               class="w-full pl-11 pr-4 py-3 text-sm rounded-xl border bg-gray-50 text-gray-900 placeholder-gray-400 focus:outline-none focus:bg-white focus:border-yellow-400 focus:ring-2 transition-all
                               @error('email') border-red-400 bg-red-50 focus:ring-red-200 @else border-gray-200 focus:ring-yellow-400/20 @enderror">
                    </div>
                    @error('email')
                    <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                {{-- Mot de passe + toggle œil --}}
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Mot de passe</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </span>
                        <input id="password" type="password" name="password" required
                               placeholder="••••••••"
                               class="w-full pl-11 pr-12 py-3 text-sm rounded-xl border bg-gray-50 text-gray-900 placeholder-gray-400 focus:outline-none focus:bg-white focus:border-yellow-400 focus:ring-2 transition-all
                               @error('password') border-red-400 bg-red-50 focus:ring-red-200 @else border-gray-200 focus:ring-yellow-400/20 @enderror">
                        {{-- Bouton œil --}}
                        <button type="button" id="toggle-password"
                                class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-yellow-500 transition-colors focus:outline-none"
                                tabindex="-1" aria-label="Afficher/masquer le mot de passe">
                            <svg id="eye-open" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            <svg id="eye-closed" class="w-4 h-4 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                    <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                {{-- Remember + oublié --}}
                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 cursor-pointer select-none">
                        <input type="checkbox" name="remember"
                               class="w-4 h-4 rounded border-gray-300 text-yellow-400 focus:ring-yellow-400 cursor-pointer">
                        <span class="text-sm text-gray-600">Se souvenir de moi</span>
                    </label>
                    @if(Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-yellow-500 font-medium hover:text-yellow-400 transition-colors">
                        Mot de passe oublié ?
                    </a>
                    @endif
                </div>

                {{-- Submit --}}
                <button type="submit"
                        class="w-full py-3.5 mt-2 bg-gray-900 text-white font-extrabold rounded-xl text-sm flex items-center justify-center gap-2 hover:bg-yellow-400 hover:text-gray-900 transition-all duration-200">
                    Se connecter
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </button>
            </form>

            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-gray-200"></div></div>
                <div class="relative flex justify-center">
                    <span class="bg-white px-4 text-xs text-gray-400 uppercase tracking-widest">Nouveau sur JobConnect ?</span>
                </div>
            </div>

            <a href="{{ route('register') }}"
               class="w-full py-3.5 border-2 border-gray-200 text-gray-700 font-bold rounded-xl text-sm flex items-center justify-center gap-2 hover:border-yellow-400 hover:text-yellow-500 transition-all duration-200">
                Créer un compte gratuit
            </a>
        </div>
    </div>
</div>

@push('scripts')
<script>
    (function () {
        const btn = document.getElementById('toggle-password');
        const input = document.getElementById('password');
        const eyeOpen = document.getElementById('eye-open');
        const eyeClosed = document.getElementById('eye-closed');
        btn.addEventListener('click', function () {
            const show = input.type === 'password';
            input.type = show ? 'text' : 'password';
            eyeOpen.classList.toggle('hidden', show);
            eyeClosed.classList.toggle('hidden', !show);
        });
    })();
</script>
@endpush
@endsection