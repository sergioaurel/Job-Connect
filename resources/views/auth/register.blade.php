@extends('layouts.app')

@section('title', 'Inscription — JobConnect Bénin')

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
                Rejoignez des milliers<br>de talents et d'entreprises<br><span class="text-yellow-400">au Bénin</span>
            </h2>
            <p class="text-gray-500 text-sm leading-relaxed mb-10">
                Inscription gratuite en moins de 2 minutes. Créez votre profil et accédez à toutes les opportunités d'emploi.
            </p>

            {{-- Avantages --}}
            <div class="space-y-3 text-left">
                @foreach(['Accès à toutes les offres d\'emploi et stages','Candidature en 1 clic','Suivi de vos candidatures en temps réel','Profil visible par les recruteurs'] as $avantage)
                <div class="flex items-center gap-3">
                    <div class="w-5 h-5 rounded-full bg-yellow-400/20 flex items-center justify-center flex-shrink-0">
                        <svg class="w-3 h-3 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <p class="text-gray-400 text-sm">{{ $avantage }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ── Colonne droite : formulaire ── --}}
    <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12 bg-white overflow-y-auto">
        <div class="w-full max-w-md py-8">

            {{-- Logo mobile --}}
            <div class="lg:hidden flex items-center justify-center gap-2 mb-10">
                <div class="w-9 h-9 bg-yellow-400 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-gray-900" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <span class="text-gray-900 font-extrabold text-xl">Job<span class="text-yellow-500">Connect</span></span>
            </div>

            <h1 class="text-gray-900 font-extrabold text-3xl mb-1" style="letter-spacing:-0.02em">Créer un compte</h1>
            <p class="text-gray-500 text-sm mb-8">
                Déjà inscrit ?
                <a href="{{ route('login') }}" class="text-yellow-500 font-semibold hover:text-yellow-400 transition-colors">Se connecter</a>
            </p>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                {{-- Choix du rôle --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Je m'inscris en tant que</label>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="relative cursor-pointer">
                            <input type="radio" name="role" value="candidat" class="peer sr-only"
                                   {{ old('role', 'candidat') == 'candidat' ? 'checked' : '' }} required>
                            <div class="border-2 rounded-xl p-4 text-center transition-all duration-200
                                        border-gray-200 hover:border-gray-300
                                        peer-checked:border-yellow-400 peer-checked:bg-yellow-50">
                                <div class="text-2xl mb-2">👨‍💼</div>
                                <p class="font-bold text-gray-900 text-sm">Candidat</p>
                                <p class="text-xs text-gray-500 mt-0.5">Je cherche un emploi</p>
                            </div>
                        </label>
                        <label class="relative cursor-pointer">
                            <input type="radio" name="role" value="entreprise" class="peer sr-only"
                                   {{ old('role') == 'entreprise' ? 'checked' : '' }}>
                            <div class="border-2 rounded-xl p-4 text-center transition-all duration-200
                                        border-gray-200 hover:border-gray-300
                                        peer-checked:border-yellow-400 peer-checked:bg-yellow-50">
                                <div class="text-2xl mb-2">🏢</div>
                                <p class="font-bold text-gray-900 text-sm">Entreprise</p>
                                <p class="text-xs text-gray-500 mt-0.5">Je recrute</p>
                            </div>
                        </label>
                    </div>
                    @error('role')
                    <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                {{-- Nom complet --}}
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nom complet</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </span>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                               placeholder="Jean Dupont"
                               class="w-full pl-11 pr-4 py-3 text-sm rounded-xl border bg-gray-50 text-gray-900 placeholder-gray-400 focus:outline-none focus:bg-white focus:border-yellow-400 focus:ring-2 transition-all
                               @error('name') border-red-400 bg-red-50 focus:ring-red-200 @else border-gray-200 focus:ring-yellow-400/20 @enderror">
                    </div>
                    @error('name')
                    <p class="mt-1.5 text-xs text-red-500 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Adresse email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </span>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
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

                {{-- Mot de passe + toggle --}}
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Mot de passe</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </span>
                        <input id="password" type="password" name="password" required
                               placeholder="Min. 8 caractères"
                               class="w-full pl-11 pr-12 py-3 text-sm rounded-xl border bg-gray-50 text-gray-900 placeholder-gray-400 focus:outline-none focus:bg-white focus:border-yellow-400 focus:ring-2 transition-all
                               @error('password') border-red-400 bg-red-50 focus:ring-red-200 @else border-gray-200 focus:ring-yellow-400/20 @enderror">
                        <button type="button" id="toggle-password" tabindex="-1"
                                class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-yellow-500 transition-colors focus:outline-none"
                                aria-label="Afficher/masquer le mot de passe">
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

                {{-- Confirmation mot de passe + toggle --}}
                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Confirmer le mot de passe</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </span>
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                               placeholder="Répéter le mot de passe"
                               class="w-full pl-11 pr-12 py-3 text-sm rounded-xl border border-gray-200 bg-gray-50 text-gray-900 placeholder-gray-400 focus:outline-none focus:bg-white focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 transition-all">
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
                </div>

                {{-- Submit --}}
                <button type="submit"
                        class="w-full py-3.5 mt-2 bg-gray-900 text-white font-extrabold rounded-xl text-sm flex items-center justify-center gap-2 hover:bg-yellow-400 hover:text-gray-900 transition-all duration-200">
                    Créer mon compte — Gratuit
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </button>

                <p class="text-center text-xs text-gray-400 mt-2">
                    En vous inscrivant, vous acceptez nos
                    <a href="#" class="text-yellow-500 hover:text-yellow-400">conditions d'utilisation</a>.
                </p>
            </form>

            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-gray-200"></div></div>
                <div class="relative flex justify-center">
                    <span class="bg-white px-4 text-xs text-gray-400 uppercase tracking-widest">Déjà un compte ?</span>
                </div>
            </div>

            <a href="{{ route('login') }}"
               class="w-full py-3.5 border-2 border-gray-200 text-gray-700 font-bold rounded-xl text-sm flex items-center justify-center gap-2 hover:border-yellow-400 hover:text-yellow-500 transition-all duration-200">
                Me connecter
            </a>
        </div>
    </div>
</div>

@push('scripts')
<script>
    (function () {
        function togglePwd(btnId, inputId, openId, closedId) {
            const btn = document.getElementById(btnId);
            const input = document.getElementById(inputId);
            const open = document.getElementById(openId);
            const closed = document.getElementById(closedId);
            btn.addEventListener('click', function () {
                const show = input.type === 'password';
                input.type = show ? 'text' : 'password';
                open.classList.toggle('hidden', show);
                closed.classList.toggle('hidden', !show);
            });
        }
        togglePwd('toggle-password', 'password', 'eye-open', 'eye-closed');
        togglePwd('toggle-confirm', 'password_confirmation', 'eye-open-2', 'eye-closed-2');
    })();
</script>
@endpush
@endsection