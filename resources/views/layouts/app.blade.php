<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'JobConnect Bénin')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-white text-gray-900">

    {{-- ══════════════════════════════════
         NAVBAR
    ══════════════════════════════════ --}}
    <nav class="bg-gray-950 border-b border-white/10 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">

                {{-- Logo --}}
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-yellow-400 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-gray-900" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <span class="text-white font-bold text-lg tracking-tight">
                            Job<span class="text-yellow-400">Connect</span>
                        </span>
                    </a>
                </div>

                {{-- Navigation principale desktop --}}
                <div class="hidden md:flex items-center gap-1">
                    <a href="{{ route('home') }}"
                       class="px-4 py-2 text-sm font-medium rounded-lg transition-colors
                              {{ request()->routeIs('home') ? 'text-yellow-400 bg-yellow-400/10' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                        Accueil
                    </a>
                    <a href="{{ route('offres.index') }}"
                       class="px-4 py-2 text-sm font-medium rounded-lg transition-colors
                              {{ request()->routeIs('offres.*') ? 'text-yellow-400 bg-yellow-400/10' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                        Offres
                    </a>
                    <a href="{{ route('about') }}"
                       class="px-4 py-2 text-sm font-medium rounded-lg transition-colors
                              {{ request()->routeIs('about') ? 'text-yellow-400 bg-yellow-400/10' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                        À propos
                    </a>
                    <a href="{{ route('contact') }}"
                       class="px-4 py-2 text-sm font-medium rounded-lg transition-colors
                              {{ request()->routeIs('contact') ? 'text-yellow-400 bg-yellow-400/10' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                        Contact
                    </a>

                    @auth
                        {{-- Badge rôle --}}
                        <span class="px-2.5 py-1 rounded-full text-xs font-bold ml-2
                            @if(auth()->user()->isAdmin()) bg-red-500/15 text-red-400
                            @elseif(auth()->user()->isEntreprise()) bg-blue-500/15 text-blue-400
                            @else bg-green-500/15 text-green-400
                            @endif">
                            @if(auth()->user()->isAdmin()) Admin
                            @elseif(auth()->user()->isEntreprise()) Entreprise
                            @else Candidat
                            @endif
                        </span>

                        {{-- Mon espace selon le rôle --}}
                        @if(auth()->user()->isCandidat())
                            <a href="{{ route('candidat.dashboard') }}"
                               class="px-4 py-2 text-sm font-bold text-gray-900 bg-yellow-400 hover:bg-yellow-300 rounded-lg transition-colors ml-1">
                                Mon espace
                            </a>
                        @elseif(auth()->user()->isEntreprise())
                            <a href="{{ route('entreprise.dashboard') }}"
                               class="px-4 py-2 text-sm font-bold text-gray-900 bg-yellow-400 hover:bg-yellow-300 rounded-lg transition-colors ml-1">
                                Mon espace
                            </a>
                        @elseif(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}"
                               class="px-4 py-2 text-sm font-bold text-white bg-red-600 hover:bg-red-500 rounded-lg transition-colors ml-1">
                                Administration
                            </a>
                        @endif

                        {{-- Déconnexion --}}
                        <form method="POST" action="{{ route('logout') }}" class="inline ml-1">
                            @csrf
                            <button type="submit"
                                    class="px-3 py-2 text-sm font-medium text-gray-500 hover:text-white hover:bg-white/5 rounded-lg transition-colors">
                                Déconnexion
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                           class="px-4 py-2 text-sm font-medium text-gray-300 hover:text-white hover:bg-white/5 rounded-lg transition-colors ml-2">
                            Connexion
                        </a>
                        <a href="{{ route('register') }}"
                           class="px-4 py-2 text-sm font-bold text-gray-900 bg-yellow-400 hover:bg-yellow-300 rounded-lg transition-colors">
                            S'inscrire
                        </a>
                    @endauth
                </div>

                {{-- Burger mobile --}}
                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-button"
                            class="text-gray-400 hover:text-white p-2 rounded-lg hover:bg-white/5 transition-colors">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Menu mobile dropdown --}}
        <div id="mobile-menu" class="hidden md:hidden border-t border-white/10 bg-gray-950">
            <div class="px-4 py-4 space-y-1">
                <a href="{{ route('home') }}"
                   class="block px-4 py-2.5 text-sm font-medium rounded-lg transition-colors
                          {{ request()->routeIs('home') ? 'text-yellow-400 bg-yellow-400/10' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                    Accueil
                </a>
                <a href="{{ route('offres.index') }}"
                   class="block px-4 py-2.5 text-sm font-medium rounded-lg transition-colors
                          {{ request()->routeIs('offres.*') ? 'text-yellow-400 bg-yellow-400/10' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                    Offres
                </a>
                <a href="{{ route('about') }}"
                   class="block px-4 py-2.5 text-sm font-medium rounded-lg text-gray-400 hover:text-white hover:bg-white/5 transition-colors">
                    À propos
                </a>
                <a href="{{ route('contact') }}"
                   class="block px-4 py-2.5 text-sm font-medium rounded-lg text-gray-400 hover:text-white hover:bg-white/5 transition-colors">
                    Contact
                </a>

                <div class="border-t border-white/10 my-3"></div>

                @auth
                    @if(auth()->user()->isCandidat())
                        <a href="{{ route('candidat.dashboard') }}"
                           class="block px-4 py-2.5 text-sm font-bold text-gray-900 bg-yellow-400 rounded-lg text-center">
                            Mon espace candidat
                        </a>
                    @elseif(auth()->user()->isEntreprise())
                        <a href="{{ route('entreprise.dashboard') }}"
                           class="block px-4 py-2.5 text-sm font-bold text-gray-900 bg-yellow-400 rounded-lg text-center">
                            Mon espace entreprise
                        </a>
                    @elseif(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}"
                           class="block px-4 py-2.5 text-sm font-bold text-white bg-red-600 rounded-lg text-center">
                            Administration
                        </a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="block w-full text-left px-4 py-2.5 text-sm font-medium text-gray-500 hover:text-white hover:bg-white/5 rounded-lg transition-colors">
                            Déconnexion
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                       class="block px-4 py-2.5 text-sm font-medium text-gray-300 hover:text-white hover:bg-white/5 rounded-lg text-center transition-colors">
                        Connexion
                    </a>
                    <a href="{{ route('register') }}"
                       class="block px-4 py-2.5 text-sm font-bold text-gray-900 bg-yellow-400 hover:bg-yellow-300 rounded-lg text-center transition-colors">
                        S'inscrire
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- ══════════════════════════════════
         MESSAGES FLASH
    ══════════════════════════════════ --}}
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="flex items-center gap-3 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl text-sm">
                <svg class="w-4 h-4 flex-shrink-0 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="flex items-center gap-3 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl text-sm">
                <svg class="w-4 h-4 flex-shrink-0 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                {{ session('error') }}
            </div>
        </div>
    @endif

    @if(session('info'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="flex items-center gap-3 bg-blue-50 border border-blue-200 text-blue-800 px-4 py-3 rounded-xl text-sm">
                <svg class="w-4 h-4 flex-shrink-0 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                </svg>
                {{ session('info') }}
            </div>
        </div>
    @endif

    {{-- Contenu principal --}}
    <main>
        @yield('content')
    </main>

    {{-- ══════════════════════════════════
         FOOTER
    ══════════════════════════════════ --}}
    <footer class="bg-gray-950 border-t border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mb-10">

                {{-- Brand --}}
                <div>
                    <a href="{{ route('home') }}" class="flex items-center gap-2 mb-4">
                        <div class="w-8 h-8 bg-yellow-400 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-gray-900" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <span class="text-white font-bold text-lg tracking-tight">
                            Job<span class="text-yellow-400">Connect</span>
                        </span>
                    </a>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Plateforme de promotion de l'emploi et des stages au Bénin.
                    </p>
                </div>

                {{-- Liens rapides --}}
                <div>
                    <h3 class="text-white text-xs font-extrabold tracking-widest uppercase mb-5">Liens rapides</h3>
                    <ul class="space-y-3 text-sm">
                        <li>
                            <a href="{{ route('offres.index') }}"
                               class="text-gray-500 hover:text-yellow-400 transition-colors">
                                Offres d'emploi
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('about') }}"
                               class="text-gray-500 hover:text-yellow-400 transition-colors">
                                À propos
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('contact') }}"
                               class="text-gray-500 hover:text-yellow-400 transition-colors">
                                Contact
                            </a>
                        </li>
                    </ul>
                </div>

                {{-- Contact --}}
                <div>
                    <h3 class="text-white text-xs font-extrabold tracking-widest uppercase mb-5">Contact</h3>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-2 text-gray-500 text-sm">
                            <svg class="w-4 h-4 text-yellow-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            contact@jobconnect.bj
                        </li>
                        <li class="flex items-center gap-2 text-gray-500 text-sm">
                            <svg class="w-4 h-4 text-yellow-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            +229 XX XX XX XX
                        </li>
                        <li class="flex items-center gap-2 text-gray-500 text-sm">
                            <svg class="w-4 h-4 text-yellow-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            </svg>
                            Cotonou, Bénin
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Bas du footer --}}
            <div class="border-t border-white/10 pt-8 text-center">
                <p class="text-gray-600 text-sm">
                    &copy; {{ date('Y') }} JobConnect Bénin. Tous droits réservés.
                </p>
            </div>
        </div>
    </footer>

    {{-- Script menu mobile --}}
    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>

    @stack('scripts')
</body>
</html>