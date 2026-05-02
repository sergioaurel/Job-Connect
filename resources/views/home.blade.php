@extends('layouts.app')

@section('title', 'JobConnect Bénin — Trouvez votre stage, recrutez les meilleurs stagiaires')

@section('content')

{{-- ═══════════════════════════════════════
     HERO
═══════════════════════════════════════ --}}
<section class="relative min-h-screen flex items-center overflow-hidden bg-gray-950">
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat"
         style="background-image:url('https://images.unsplash.com/photo-1497366216548-37526070297c?w=1920&q=80');opacity:0.25"></div>
    <div class="absolute inset-0 bg-gradient-to-br from-gray-950 via-gray-950/80 to-transparent"></div>
    <div class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32">
        <div class="max-w-3xl">
            <h1 class="text-white font-extrabold mb-6 leading-tight"
                style="font-size:clamp(2.2rem,5vw,4rem);letter-spacing:-0.025em">
                Votre stage <br>commence<span class="text-yellow-400"> ici</span>,<br>
                au <span class="text-yellow-400">Bénin</span>.
            </h1>
            <p class="text-gray-400 text-lg mb-10 leading-relaxed max-w-lg">
                JobConnect met en relation les étudiants et jeunes diplômés béninois avec les entreprises qui cherchent des stagiaires sérieux.
            </p>
            <form action="{{ route('offres.index') }}" method="GET">
                <div class="flex flex-col sm:flex-row rounded-2xl overflow-hidden border border-white/10"
                     style="background:rgba(255,255,255,0.05)">
                    <div class="flex items-center gap-3 flex-1 px-5 py-4 border-b sm:border-b-0 sm:border-r border-white/10">
                        <svg class="w-5 h-5 text-gray-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text" name="search" placeholder="Poste, domaine, compétence..."
                               class="bg-transparent text-white text-sm outline-none w-full placeholder-gray-500">
                    </div>
                    <div class="flex items-center gap-3 px-5 py-4 sm:w-44 border-b sm:border-b-0 sm:border-r border-white/10">
                        <svg class="w-4 h-4 text-gray-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        </svg>
                        <input type="text" name="ville" placeholder="Cotonou..."
                               class="bg-transparent text-white text-sm outline-none w-full placeholder-gray-500">
                    </div>
                    <button type="submit"
                            class="px-7 py-4 bg-yellow-400 text-gray-900 font-extrabold text-sm hover:bg-yellow-300 transition-colors whitespace-nowrap">
                        Rechercher
                    </button>
                </div>
                <div class="flex flex-wrap items-center gap-2 mt-4">
                    <span class="text-gray-600 text-xs">Populaire :</span>
                    @foreach(['Développeur', 'Marketing', 'Comptabilité', 'Stage RH', 'Commercial', 'Informatique'] as $tag)
                    <a href="{{ route('offres.index', ['search' => $tag]) }}"
                       class="text-xs text-gray-400 px-3 py-1 rounded-full hover:text-yellow-400 transition-colors"
                       style="background:rgba(255,255,255,0.06);border:1px solid rgba(255,255,255,0.1)">
                        {{ $tag }}
                    </a>
                    @endforeach
                </div>
            </form>
        </div>
        <div class="hidden lg:flex absolute bottom-12 right-8 gap-3">
            @foreach([
                ['val' => $stats['total_offres'],      'label' => 'Offres de stages'],
                ['val' => $stats['total_entreprises'], 'label' => 'Entreprises'],
                ['val' => $stats['total_stages'],      'label' => 'Stages dispo'],
            ] as $s)
            <div class="text-center px-5 py-4 rounded-2xl"
                 style="background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.08)">
                <p class="text-white text-2xl font-bold">{{ $s['val'] }}+</p>
                <p class="text-gray-500 text-xs mt-1">{{ $s['label'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-1 animate-bounce">
        <span class="text-gray-600 text-xs tracking-widest uppercase">Découvrir</span>
        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </div>
</section>

{{-- ═══════════════════════════════════════
     TICKER
═══════════════════════════════════════ --}}
<div class="bg-yellow-400 py-3 overflow-hidden">
    @php $items = ['Stage Pro', 'Stage Académique', 'Marketing Digital', 'Développeur Web', 'Finance', 'Ressources Humaines', 'Ingénierie BTP', 'Commerce', 'Informatique', 'Transport', 'Comptabilité']; @endphp
    <div class="flex gap-12" style="animation: jobTicker 28s linear infinite; width: max-content; white-space: nowrap;">
        @foreach(array_merge($items, $items, $items) as $item)
        <span class="text-xs font-extrabold text-gray-900 tracking-widest uppercase inline-flex items-center gap-3">
            <span class="w-1.5 h-1.5 rounded-full bg-gray-900/25 inline-block flex-shrink-0"></span>{{ $item }}
        </span>
        @endforeach
    </div>
</div>
<style>@keyframes jobTicker { from { transform: translateX(0); } to { transform: translateX(-33.333%); } }</style>

{{-- ═══════════════════════════════════════
     BENTO GRID
═══════════════════════════════════════ --}}
<section class="py-20 bg-gray-950 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="mb-12 max-w-xl">
            <p class="text-yellow-400 text-xs font-extrabold tracking-widest uppercase mb-3">Des vraies opportunités</p>
            <h2 class="text-white font-extrabold leading-tight" style="font-size:clamp(1.8rem,3.5vw,3rem);letter-spacing:-0.025em">
                Des stages qui<br>changent un parcours <span class="text-yellow-400">chaque semaine</span>
            </h2>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-3">

            <div class="col-span-2 md:row-span-2 relative rounded-2xl overflow-hidden group" style="min-height:360px">
                <img src="{{ asset('images/fda.avif') }}"
                     class="absolute inset-0 w-full h-full object-cover object-center transition-transform duration-700 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-gray-950 via-gray-950/40 to-transparent"></div>
                <div class="absolute bottom-0 left-0 p-7">
                    <span class="inline-block px-3 py-1 bg-yellow-400 text-gray-900 text-xs font-extrabold rounded-full mb-3 uppercase tracking-wide">
                        Stage réussi
                    </span>
                    <p class="text-white font-extrabold text-xl leading-snug">
                        « Mon stage m'a ouvert les portes du secteur »
                    </p>
                    <p class="text-gray-400 text-xs mt-2">
                        Étudiante en gestion, Cotonou — recrutée via JobConnect
                    </p>
                </div>
            </div>

            <div class="col-span-1 rounded-2xl p-6 flex flex-col justify-between"
                 style="background:rgba(250,204,21,0.12);border:1px solid rgba(250,204,21,0.2);min-height:170px">
                <svg class="w-8 h-8 text-yellow-400 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                </svg>
                <div>
                    <p class="text-yellow-400 font-extrabold" style="font-size:2.5rem;letter-spacing:-0.04em;line-height:1">{{ $stats['total_offres'] }}+</p>
                    <p class="text-gray-300 text-sm font-semibold mt-1">offres de stages</p>
                    <p class="text-gray-500 text-xs mt-0.5">pro & académique au Bénin</p>
                </div>
            </div>

            <div class="col-span-1 rounded-2xl overflow-hidden relative group" style="min-height:170px">
                <img src="https://images.unsplash.com/photo-1497366811353-6870744d04b2?w=600&q=80"
                     alt="Bureau entreprise"
                     class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                <div class="absolute inset-0" style="background:linear-gradient(135deg,rgba(3,7,18,0.55),transparent)"></div>
                <div class="absolute top-4 left-4">
                    <span class="px-2.5 py-1 bg-white/10 backdrop-blur-sm text-white text-xs font-bold rounded-lg border border-white/15">Entreprises vérifiées</span>
                </div>
            </div>

            <div class="col-span-1 rounded-2xl p-6 flex flex-col justify-between"
                 style="background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.08);min-height:170px">
                <div class="w-10 h-10 rounded-xl bg-yellow-400 flex items-center justify-center">
                    <svg class="w-5 h-5 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-white font-extrabold text-2xl" style="letter-spacing:-0.03em">{{ $stats['total_stages'] }}+</p>
                    <p class="text-gray-300 text-sm font-semibold">stages disponibles</p>
                    <p class="text-gray-500 text-xs mt-1">Pro & académique</p>
                </div>
            </div>

            <div class="col-span-1 rounded-2xl overflow-hidden relative group" style="min-height:170px">
                <img src="{{ asset('images/ada.avif') }}"
                     alt="Équipe au travail"
                     class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-r from-gray-950/80 via-gray-950/30 to-transparent"></div>
                <div class="absolute inset-0 flex items-center px-6">
                    <div>
                        <p class="text-white font-extrabold text-sm leading-snug mb-3">Accueillez des stagiaires<br>qui font la différence</p>
                        <a href="{{ route('register') }}"
                           class="inline-flex items-center gap-1.5 px-4 py-2 bg-yellow-400 text-gray-900 font-extrabold text-xs rounded-xl hover:bg-yellow-300 transition-colors uppercase tracking-wide">
                            Publier une offre
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">

            <div class="col-span-1 rounded-2xl p-6 flex flex-col justify-between"
                 style="background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.08);min-height:150px">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background:rgba(250,204,21,0.15);border:1px solid rgba(250,204,21,0.2)">
                    <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <div>
                    <p class="text-white font-extrabold text-2xl" style="letter-spacing:-0.03em">{{ $stats['total_entreprises'] }}+</p>
                    <p class="text-gray-300 text-sm font-semibold">entreprises</p>
                    <p class="text-gray-500 text-xs mt-0.5">toutes vérifiées</p>
                </div>
            </div>

            <div class="col-span-1 rounded-2xl overflow-hidden relative group" style="min-height:150px">
                <img src="{{ asset('images/asa.webp') }}"
                     alt="Candidat satisfait"
                     class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-gray-950/70 to-transparent"></div>
                <div class="absolute bottom-4 left-4 right-4">
                    <span class="inline-block px-2.5 py-1 bg-yellow-400/90 text-gray-900 text-xs font-extrabold rounded-lg">100% gratuit pour les candidats</span>
                </div>
            </div>

            <div class="col-span-2 rounded-2xl p-7 flex items-center justify-between gap-6 relative overflow-hidden"
                 style="background:rgba(250,204,21,0.08);border:1px solid rgba(250,204,21,0.15)">
                <div class="absolute -right-8 -top-8 w-32 h-32 rounded-full" style="background:rgba(250,204,21,0.08)"></div>
                <div>
                    <p class="text-white font-extrabold text-lg leading-snug">Prêt à trouver<br>votre prochain stage ?</p>
                    <p class="text-gray-400 text-xs mt-1">Des dizaines d'offres vous attendent</p>
                </div>
                <a href="{{ route('offres.index') }}"
                   class="flex-shrink-0 inline-flex items-center gap-2 px-6 py-3 bg-yellow-400 text-gray-900 font-extrabold text-sm rounded-xl hover:bg-yellow-300 transition-colors whitespace-nowrap">
                    Voir les stages
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>

        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     FEATURES
═══════════════════════════════════════ --}}
<section class="py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6 mb-16">
            <div>
                <p class="text-yellow-500 text-xs font-extrabold tracking-widest uppercase mb-3">Pourquoi nous choisir</p>
                <h2 class="text-gray-900 font-extrabold leading-tight"
                    style="font-size:clamp(2rem,4vw,3rem);letter-spacing:-0.03em;line-height:1.05">
                    La plateforme de stages<br>faite pour le <span class="text-yellow-500">Bénin</span>
                </h2>
            </div>
            <p class="text-gray-400 text-sm leading-relaxed max-w-xs lg:text-right">
                Tout ce qu'il faut pour trouver ou publier une offre de stage, au même endroit.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

            <div class="bg-white border border-gray-100 rounded-2xl p-7 hover:-translate-y-1.5 hover:shadow-xl hover:shadow-gray-100/80 hover:border-yellow-200 transition-all duration-300 group cursor-default">
                <div class="w-11 h-11 rounded-xl bg-gray-900 flex items-center justify-center mb-6 group-hover:bg-yellow-400 transition-colors duration-300">
                    <svg class="w-5 h-5 text-yellow-400 group-hover:text-gray-900 transition-colors duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <h3 class="text-gray-900 font-extrabold text-base mb-2">Offres vérifiées</h3>
                <p class="text-gray-400 text-sm leading-relaxed mb-5">Chaque offre vient d'une entreprise béninoise validée manuellement. Pas de fausses annonces.</p>
                <span class="inline-flex items-center gap-1.5 text-xs font-extrabold text-gray-400 tracking-widest uppercase">
                    <span class="w-1.5 h-1.5 rounded-full bg-yellow-400 inline-block"></span>
                    100% fiable
                </span>
                <div class="mt-5 h-px bg-gray-100 rounded-full">
                    <div class="h-full bg-yellow-400 w-0 group-hover:w-full transition-all duration-700 rounded-full"></div>
                </div>
            </div>

            <div class="bg-white border border-gray-100 rounded-2xl p-7 hover:-translate-y-1.5 hover:shadow-xl hover:shadow-gray-100/80 hover:border-yellow-200 transition-all duration-300 group cursor-default">
                <div class="w-11 h-11 rounded-xl bg-gray-900 flex items-center justify-center mb-6 group-hover:bg-yellow-400 transition-colors duration-300">
                    <svg class="w-5 h-5 text-yellow-400 group-hover:text-gray-900 transition-colors duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <h3 class="text-gray-900 font-extrabold text-base mb-2">Candidature en 1 clic</h3>
                <p class="text-gray-400 text-sm leading-relaxed mb-5">Créez votre profil une fois, postulez partout. CV et lettre de motivation envoyés en quelques secondes.</p>
                <span class="inline-flex items-center gap-1.5 text-xs font-extrabold text-gray-400 tracking-widest uppercase">
                    <span class="w-1.5 h-1.5 rounded-full bg-yellow-400 inline-block"></span>
                    &lt; 60 secondes
                </span>
                <div class="mt-5 h-px bg-gray-100 rounded-full">
                    <div class="h-full bg-yellow-400 w-0 group-hover:w-full transition-all duration-700 rounded-full"></div>
                </div>
            </div>

            <div class="bg-white border border-gray-100 rounded-2xl p-7 hover:-translate-y-1.5 hover:shadow-xl hover:shadow-gray-100/80 hover:border-yellow-200 transition-all duration-300 group cursor-default">
                <div class="w-11 h-11 rounded-xl bg-gray-900 flex items-center justify-center mb-6 group-hover:bg-yellow-400 transition-colors duration-300">
                    <svg class="w-5 h-5 text-yellow-400 group-hover:text-gray-900 transition-colors duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <h3 class="text-gray-900 font-extrabold text-base mb-2">Suivi en temps réel</h3>
                <p class="text-gray-400 text-sm leading-relaxed mb-5">Votre candidature est en attente, vue, retenue ? Vous le savez depuis votre tableau de bord.</p>
                <span class="inline-flex items-center gap-1.5 text-xs font-extrabold text-gray-400 tracking-widest uppercase">
                    <span class="w-1.5 h-1.5 rounded-full bg-yellow-400 inline-block"></span>
                    Tableau de bord
                </span>
                <div class="mt-5 h-px bg-gray-100 rounded-full">
                    <div class="h-full bg-yellow-400 w-0 group-hover:w-full transition-all duration-700 rounded-full"></div>
                </div>
            </div>

            <div class="bg-white border border-gray-100 rounded-2xl p-7 hover:-translate-y-1.5 hover:shadow-xl hover:shadow-gray-100/80 hover:border-yellow-200 transition-all duration-300 group cursor-default">
                <div class="w-11 h-11 rounded-xl bg-gray-900 flex items-center justify-center mb-6 group-hover:bg-yellow-400 transition-colors duration-300">
                    <svg class="w-5 h-5 text-yellow-400 group-hover:text-gray-900 transition-colors duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <h3 class="text-gray-900 font-extrabold text-base mb-2">Entreprises validées</h3>
                <p class="text-gray-400 text-sm leading-relaxed mb-5">Chaque entreprise passe par une vérification manuelle avant de publier sa première offre.</p>
                <span class="inline-flex items-center gap-1.5 text-xs font-extrabold text-gray-400 tracking-widest uppercase">
                    <span class="w-1.5 h-1.5 rounded-full bg-yellow-400 inline-block"></span>
                    Vérif. manuelle
                </span>
                <div class="mt-5 h-px bg-gray-100 rounded-full">
                    <div class="h-full bg-yellow-400 w-0 group-hover:w-full transition-all duration-700 rounded-full"></div>
                </div>
            </div>

            <div class="bg-white border border-gray-100 rounded-2xl p-7 hover:-translate-y-1.5 hover:shadow-xl hover:shadow-gray-100/80 hover:border-yellow-200 transition-all duration-300 group cursor-default">
                <div class="w-11 h-11 rounded-xl bg-gray-900 flex items-center justify-center mb-6 group-hover:bg-yellow-400 transition-colors duration-300">
                    <svg class="w-5 h-5 text-yellow-400 group-hover:text-gray-900 transition-colors duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                    </svg>
                </div>
                <h3 class="text-gray-900 font-extrabold text-base mb-2">Stage pro ou académique</h3>
                <p class="text-gray-400 text-sm leading-relaxed mb-5">Fin d'études, découverte professionnelle, stage de licence ou master — il y a une offre pour chaque situation.</p>
                <span class="inline-flex items-center gap-1.5 text-xs font-extrabold text-gray-400 tracking-widest uppercase">
                    <span class="w-1.5 h-1.5 rounded-full bg-yellow-400 inline-block"></span>
                    2 types de stages
                </span>
                <div class="mt-5 h-px bg-gray-100 rounded-full">
                    <div class="h-full bg-yellow-400 w-0 group-hover:w-full transition-all duration-700 rounded-full"></div>
                </div>
            </div>

            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-7 hover:-translate-y-1.5 hover:shadow-xl hover:border-yellow-400/30 transition-all duration-300 group cursor-default">
                <div class="w-11 h-11 rounded-xl bg-yellow-400 flex items-center justify-center mb-6">
                    <svg class="w-5 h-5 text-gray-900" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                    </svg>
                </div>
                <h3 class="text-white font-extrabold text-base mb-2">Favoris & alertes</h3>
                <p class="text-gray-500 text-sm leading-relaxed mb-5">Sauvegardez les offres qui vous intéressent. Ne ratez aucune opportunité.</p>
                <span class="inline-flex items-center gap-1.5 text-xs font-extrabold text-gray-500 tracking-widest uppercase">
                    <span class="w-1.5 h-1.5 rounded-full bg-yellow-400 inline-block"></span>
                    Personnalisé
                </span>
                <div class="mt-5 h-px bg-white/5 rounded-full">
                    <div class="h-full bg-yellow-400 w-0 group-hover:w-full transition-all duration-700 rounded-full"></div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     3 ÉTAPES
═══════════════════════════════════════ --}}
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <p class="text-yellow-500 text-xs font-extrabold tracking-widest uppercase mb-3">Simple & Rapide</p>
            <h2 class="text-gray-900 font-extrabold text-4xl md:text-5xl" style="letter-spacing:-0.02em">
                Trouvez votre stage en <span class="text-yellow-400">3 étapes</span>
            </h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach([
                ['num'=>'01','title'=>'Créez votre profil','desc'=>'Inscrivez-vous gratuitement et renseignez vos formations, expériences et compétences. Ça prend moins de 5 minutes.'],
                ['num'=>'02','title'=>'Parcourez les offres','desc'=>'Filtrez par domaine, ville et type de stage. Trouvez ce qui correspond à votre parcours académique.'],
                ['num'=>'03','title'=>'Postulez & suivez','desc'=>'Envoyez votre candidature en un clic. Suivez chaque réponse depuis votre tableau de bord.'],
            ] as $i => $step)
            <div class="text-center relative">
                @if($i < 2)
                <div class="hidden md:block absolute top-7 left-3/4 w-1/2 border-t-2 border-dashed border-gray-200"></div>
                @endif
                <div class="w-14 h-14 rounded-full bg-gray-900 text-white font-extrabold text-lg flex items-center justify-center mx-auto mb-5 relative z-10 ring-4 ring-yellow-400/20">{{ $step['num'] }}</div>
                <h3 class="text-gray-900 font-bold text-xl mb-3">{{ $step['title'] }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed">{{ $step['desc'] }}</p>
            </div>
            @endforeach
        </div>
        @guest
        <div class="text-center mt-12">
            <a href="{{ route('register') }}"
               class="inline-flex items-center gap-3 px-8 py-4 bg-gray-900 text-white font-bold rounded-xl hover:bg-yellow-400 hover:text-gray-900 transition-all duration-300 text-sm">
                Commencer gratuitement
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
        @endguest
    </div>
</section>

{{-- ═══════════════════════════════════════
     OFFRES RÉCENTES
═══════════════════════════════════════ --}}
<section class="py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end mb-12 gap-4">
            <div>
                <p class="text-yellow-500 text-xs font-extrabold tracking-widets uppercase mb-2">Fraîchement publiées</p>
                <h2 class="text-gray-900 font-extrabold text-4xl" style="letter-spacing:-0.02em">Derniers stages disponibles</h2>
            </div>
            <a href="{{ route('offres.index') }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 border-2 border-gray-900 text-gray-900 font-bold rounded-xl text-sm hover:bg-gray-900 hover:text-white transition-all">
                Voir tout
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @forelse($dernieresOffres as $offre)
            <a href="{{ route('offres.show', $offre->slug) }}"
               class="bg-white border border-gray-200 rounded-2xl p-6 flex flex-col gap-3 hover:border-yellow-400 hover:shadow-md hover:-translate-y-1 transition-all duration-300 group">
                <div class="flex items-start justify-between">
                    @if($offre->type_offre === 'stage_professionnel')
                        <span class="px-2.5 py-1 bg-green-50 text-green-600 text-xs font-bold rounded-lg uppercase tracking-wide">Stage Pro</span>
                    @else
                        <span class="px-2.5 py-1 bg-orange-50 text-orange-500 text-xs font-bold rounded-lg uppercase tracking-wide">Stage Acad.</span>
                    @endif
                    <span class="text-xs text-gray-400">{{ $offre->created_at->diffForHumans() }}</span>
                </div>
                <h3 class="text-gray-900 font-bold text-base leading-snug">{{ $offre->titre }}</h3>
                <p class="text-gray-500 text-sm font-medium">{{ $offre->entreprise->nom_entreprise }}</p>
                <div class="flex flex-wrap gap-x-4 gap-y-1">
                    <span class="flex items-center gap-1 text-xs text-gray-400">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                        {{ $offre->ville ?? 'Bénin' }}
                    </span>
                    @if($offre->salaire_min)
                    <span class="flex items-center gap-1 text-xs text-gray-400">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ number_format($offre->salaire_min, 0, ',', ' ') }} FCFA+
                    </span>
                    @endif
                </div>
                <div class="pt-3 border-t border-gray-100 flex items-center justify-between">
                    <span class="text-xs text-gray-400">{{ $offre->categorie->nom ?? '' }}</span>
                    <span class="text-sm font-bold text-yellow-500 group-hover:translate-x-1 transition-transform duration-200 inline-block">Postuler →</span>
                </div>
            </a>
            @empty
            <div class="col-span-3 text-center py-16 text-gray-400">Aucune offre disponible pour le moment.</div>
            @endforelse
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     CATÉGORIES
═══════════════════════════════════════ --}}
@if($categories->count() > 0)
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <p class="text-yellow-500 text-xs font-extrabold tracking-widest uppercase mb-3">Secteurs d'activité</p>
            <h2 class="text-gray-900 font-extrabold text-4xl" style="letter-spacing:-0.02em">Explorez par domaine</h2>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
            @php $icons = ['💻','🛒','📣','💰','👥','🏦','🏥','📚','⚙️','⚖️','🚚','🍽️','🌱','🎨','📋']; @endphp
            @foreach($categories as $i => $categorie)
            <a href="{{ route('offres.categorie', $categorie->slug) }}"
               class="flex items-center gap-3 p-4 bg-white border border-gray-200 rounded-xl hover:bg-gray-900 hover:border-gray-900 transition-all duration-200 group">
                <span class="text-2xl">{{ $icons[$i % count($icons)] }}</span>
                <div>
                    <p class="text-sm font-semibold text-gray-900 group-hover:text-white transition-colors">{{ $categorie->nom }}</p>
                    <p class="text-xs text-gray-400 group-hover:text-yellow-400 mt-0.5 transition-colors">{{ $categorie->offres_count }} offre(s)</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ═══════════════════════════════════════
     IMPACT
═══════════════════════════════════════ --}}
<section class="py-24 bg-gray-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div>
                <p class="text-yellow-400 text-xs font-extrabold tracking-widest uppercase mb-4">En chiffres</p>
                <h2 class="text-white font-extrabold text-4xl md:text-5xl mb-6" style="letter-spacing:-0.02em;line-height:1.1">
                    La plateforme de stages<br>qui monte au Bénin
                </h2>
                <p class="text-gray-400 text-base leading-relaxed mb-8">
                    Chaque semaine, des étudiants béninois décrochent leur stage via JobConnect. Des offres vérifiées, un suivi transparent, sans arnaque.
                </p>
                <a href="{{ route('offres.index') }}"
                   class="inline-flex items-center gap-3 px-6 py-3 bg-yellow-400 text-gray-900 font-bold rounded-xl hover:bg-yellow-300 transition-colors text-sm">
                    Voir les stages disponibles
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
            <div class="grid grid-cols-2 gap-4">
                @foreach([
                    ['num'=>$stats['total_offres'].'+',      'label'=>'Offres publiées',   'sub'=>'stages au Bénin'],
                    ['num'=>$stats['total_entreprises'].'+', 'label'=>'Entreprises',        'sub'=>'toutes vérifiées'],
                    ['num'=>$stats['total_stages'].'+',      'label'=>'Stages actifs',      'sub'=>'pro & académique'],
                    ['num'=>'100%',                          'label'=>'Gratuit',            'sub'=>'pour les candidats'],
                ] as $impact)
                <div class="rounded-2xl p-6" style="background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.08)">
                    <p class="text-yellow-400 font-extrabold text-3xl mb-2">{{ $impact['num'] }}</p>
                    <p class="text-white font-semibold text-sm">{{ $impact['label'] }}</p>
                    <p class="text-gray-500 text-xs mt-1">{{ $impact['sub'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     CTA DOUBLE
═══════════════════════════════════════ --}}
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-gray-950 rounded-2xl p-10 relative overflow-hidden">
                <div class="absolute -top-10 -right-10 w-48 h-48 rounded-full" style="background:rgba(250,204,21,0.1)"></div>
                <div class="absolute -bottom-16 -left-5 w-36 h-36 rounded-full" style="background:rgba(250,204,21,0.05)"></div>
                <div class="relative z-10">
                    <div class="w-12 h-12 rounded-xl bg-yellow-400 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-gray-900" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <p class="text-yellow-400 text-xs font-extrabold tracking-widest uppercase mb-2">Pour les candidats</p>
                    <h3 class="text-white font-extrabold text-3xl mb-4 leading-tight">Décrochez votre<br>stage dès maintenant</h3>
                    <p class="text-gray-400 text-sm leading-relaxed mb-8">
                        Créez votre profil gratuitement, postulez en un clic et suivez vos candidatures depuis votre tableau de bord.
                    </p>
                    @guest
                    <a href="{{ route('register') }}"
                       class="inline-flex items-center gap-2 px-6 py-3 bg-yellow-400 text-gray-900 font-bold rounded-xl hover:bg-yellow-300 transition-colors text-sm">
                        Créer mon profil — Gratuit
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                    @else
                    <a href="{{ route('candidat.dashboard') }}"
                       class="inline-flex items-center gap-2 px-6 py-3 bg-yellow-400 text-gray-900 font-bold rounded-xl hover:bg-yellow-300 transition-colors text-sm">
                        Mon tableau de bord →
                    </a>
                    @endguest
                </div>
            </div>
            <div class="rounded-2xl p-10 relative overflow-hidden border-2 border-yellow-200 bg-yellow-50">
                <div class="absolute -top-10 -right-10 w-48 h-48 rounded-full bg-yellow-400/20"></div>
                <div class="relative z-10">
                    <div class="w-12 h-12 rounded-xl bg-gray-900 border border-yellow-400/20 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <p class="text-yellow-600 text-xs font-extrabold tracking-widest uppercase mb-2">Pour les entreprises</p>
                    <h3 class="text-gray-900 font-extrabold text-3xl mb-4 leading-tight">Accueillez les<br>bons stagiaires</h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-8">
                        Publiez vos offres de stage, gérez les candidatures et trouvez les profils adaptés à vos besoins.
                    </p>
                    @guest
                    <a href="{{ route('register') }}"
                       class="inline-flex items-center gap-2 px-6 py-3 bg-gray-900 text-white font-bold rounded-xl hover:bg-yellow-400 hover:text-gray-900 transition-all text-sm">
                        Publier une offre de stage
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                    @else
                    <a href="{{ route('entreprise.dashboard') }}"
                       class="inline-flex items-center gap-2 px-6 py-3 bg-gray-900 text-white font-bold rounded-xl hover:bg-yellow-400 hover:text-gray-900 transition-all text-sm">
                        Mon espace entreprise →
                    </a>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</section>

@endsection