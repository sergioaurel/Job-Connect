@extends('layouts.app')

@section('title', 'JobConnect Bénin — Trouvez votre emploi, recrutez les meilleurs talents')

@section('content')

{{-- ═══════════════════════════════════════
     HERO
═══════════════════════════════════════ --}}
<section class="relative min-h-screen flex items-center overflow-hidden bg-gray-950">

    {{-- Image de fond --}}
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat"
         style="background-image:url('https://images.unsplash.com/photo-1497366216548-37526070297c?w=1920&q=80');opacity:0.25"></div>

    {{-- Overlay --}}
    <div class="absolute inset-0 bg-gradient-to-br from-gray-950 via-gray-950/80 to-transparent"></div>

    <div class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32">
        <div class="max-w-3xl">

            {{-- Badge --}}
            <div class="inline-flex items-center gap-2 mb-6 px-4 py-2 rounded-full"
                 style="background:rgba(250,204,21,0.12);border:1px solid rgba(250,204,21,0.3)">
                <span class="w-2 h-2 rounded-full bg-yellow-400 animate-pulse inline-block"></span>
                <span class="text-yellow-400 text-xs font-bold tracking-widest uppercase">
                    {{ $stats['total_offres'] }} offres disponibles maintenant au Bénin
                </span>
            </div>

            {{-- Titre --}}
            <h1 class="text-white font-extrabold mb-6 leading-tight"
                style="font-size:clamp(2.2rem,5vw,4rem);letter-spacing:-0.025em">
                Votre carrière<br>commence <span class="text-yellow-400">ici</span>,<br>
                au <span class="text-yellow-400">Bénin</span>.
            </h1>

            <p class="text-gray-400 text-lg mb-10 leading-relaxed max-w-lg">
                JobConnect connecte les meilleurs talents aux entreprises qui construisent l'avenir économique du Bénin.
            </p>

            {{-- Recherche --}}
            <form action="{{ route('offres.index') }}" method="GET">
                <div class="flex flex-col sm:flex-row rounded-2xl overflow-hidden border border-white/10"
                     style="background:rgba(255,255,255,0.05)">
                    <div class="flex items-center gap-3 flex-1 px-5 py-4 border-b sm:border-b-0 sm:border-r border-white/10">
                        <svg class="w-5 h-5 text-gray-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text" name="search" placeholder="Titre, compétence..."
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
                    @foreach(['Développeur', 'Marketing', 'Comptable', 'Stage RH', 'Commercial'] as $tag)
                    <a href="{{ route('offres.index', ['search' => $tag]) }}"
                       class="text-xs text-gray-400 px-3 py-1 rounded-full hover:text-yellow-400 transition-colors"
                       style="background:rgba(255,255,255,0.06);border:1px solid rgba(255,255,255,0.1)">
                        {{ $tag }}
                    </a>
                    @endforeach
                </div>
            </form>
        </div>

        {{-- Stats --}}
        <div class="hidden lg:flex absolute bottom-12 right-8 gap-3">
            @foreach([['val' => $stats['total_offres'], 'label' => 'Offres actives'], ['val' => $stats['total_entreprises'], 'label' => 'Entreprises'], ['val' => $stats['total_stages'], 'label' => 'Stages dispo']] as $s)
            <div class="text-center px-5 py-4 rounded-2xl"
                 style="background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.08)">
                <p class="text-white text-2xl font-bold">{{ $s['val'] }}+</p>
                <p class="text-gray-500 text-xs mt-1">{{ $s['label'] }}</p>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Scroll --}}
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
    @php
    $items = ['Emploi CDI', 'Stage Pro', 'Marketing Digital', 'Développeur Web', 'Finance', 'RH', 'Ingénierie BTP', 'Commerce', 'Stage Académique', 'Informatique', 'Transport'];
    @endphp
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
     FEATURES
═══════════════════════════════════════ --}}
<section class="py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <p class="text-yellow-500 text-xs font-extrabold tracking-widest uppercase mb-3">Pourquoi nous choisir</p>
            <h2 class="text-gray-900 font-extrabold text-4xl md:text-5xl" style="letter-spacing:-0.02em;line-height:1.1">
                La plateforme emploi<br>faite pour le <span class="text-yellow-500">Bénin</span>
            </h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach([
                ['icon'=>'🎯','title'=>'Offres 100% vérifiées','desc'=>'Toutes nos offres viennent d\'entreprises béninoises validées. Uniquement des opportunités réelles.','tag'=>'100% fiable'],
                ['icon'=>'⚡','title'=>'Candidature en 1 clic','desc'=>'Créez votre profil une fois, postulez partout. CV et lettre envoyés instantanément.','tag'=>'< 60 secondes'],
                ['icon'=>'📊','title'=>'Suivi en temps réel','desc'=>'Suivez chaque candidature depuis votre tableau de bord : en attente, vue, retenue.','tag'=>'Tableau de bord'],
                ['icon'=>'🏢','title'=>'Entreprises validées','desc'=>'Chaque entreprise est vérifiée manuellement avant de publier. Votre sécurité d\'abord.','tag'=>'Vérification manuelle'],
                ['icon'=>'🎓','title'=>'Stages & alternances','desc'=>'Étudiants, trouvez votre stage académique ou professionnel adapté à votre niveau.','tag'=>'3 types de stages'],
                ['icon'=>'🔖','title'=>'Favoris & alertes','desc'=>'Sauvegardez les offres qui vous intéressent et ne manquez aucune opportunité.','tag'=>'Personnalisé'],
            ] as $f)
            <div class="bg-white border border-gray-200 rounded-2xl p-8 hover:-translate-y-1 hover:shadow-lg hover:border-yellow-300 transition-all duration-300 group">
                <div class="text-4xl mb-4">{{ $f['icon'] }}</div>
                <h3 class="text-gray-900 font-bold text-lg mb-3">{{ $f['title'] }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed mb-4">{{ $f['desc'] }}</p>
                <span class="text-xs font-extrabold text-yellow-500 tracking-widest uppercase">{{ $f['tag'] }}</span>
                <div class="mt-4 h-0.5 bg-gray-100 rounded-full">
                    <div class="h-full bg-yellow-400 w-0 group-hover:w-full transition-all duration-500 rounded-full"></div>
                </div>
            </div>
            @endforeach
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
                Trouvez un emploi en <span class="text-yellow-400">3 étapes</span>
            </h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach([
                ['num'=>'01','title'=>'Créez votre profil','desc'=>'Inscrivez-vous gratuitement et complétez votre profil avec vos expériences, formations et compétences.','icon'=>'👤'],
                ['num'=>'02','title'=>'Explorez les offres','desc'=>'Parcourez des centaines d\'offres filtrées par secteur, ville et type de contrat.','icon'=>'🔍'],
                ['num'=>'03','title'=>'Postulez & décrochez','desc'=>'Envoyez votre candidature en un clic et suivez son évolution en temps réel.','icon'=>'🚀'],
            ] as $i => $step)
            <div class="text-center relative">
                @if($i < 2)
                <div class="hidden md:block absolute top-7 left-3/4 w-1/2 border-t-2 border-dashed border-gray-200"></div>
                @endif
                <div class="w-14 h-14 rounded-full bg-gray-900 text-white font-extrabold text-lg flex items-center justify-center mx-auto mb-5 relative z-10 ring-4 ring-yellow-400/20">{{ $step['num'] }}</div>
                <div class="text-3xl mb-4">{{ $step['icon'] }}</div>
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
     OFFRES
═══════════════════════════════════════ --}}
<section class="py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end mb-12 gap-4">
            <div>
                <p class="text-yellow-500 text-xs font-extrabold tracking-widest uppercase mb-2">Fraîchement publiées</p>
                <h2 class="text-gray-900 font-extrabold text-4xl" style="letter-spacing:-0.02em">Dernières opportunités</h2>
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
                    @if($offre->type_offre === 'emploi')
                        <span class="px-2.5 py-1 bg-indigo-50 text-indigo-600 text-xs font-bold rounded-lg uppercase tracking-wide">Emploi</span>
                    @elseif($offre->type_offre === 'stage_professionnel')
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
                    @if($offre->type_contrat)
                    <span class="flex items-center gap-1 text-xs text-gray-400">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        {{ $offre->type_contrat }}
                    </span>
                    @endif
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
     IMPACT — Fond sombre
═══════════════════════════════════════ --}}
<section class="py-24 bg-gray-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div>
                <p class="text-yellow-400 text-xs font-extrabold tracking-widest uppercase mb-4">Notre impact</p>
                <h2 class="text-white font-extrabold text-4xl md:text-5xl mb-6" style="letter-spacing:-0.02em;line-height:1.1">
                    Des chiffres qui<br>parlent d'eux-mêmes
                </h2>
                <p class="text-gray-400 text-base leading-relaxed mb-8">
                    JobConnect est la référence de l'emploi digital au Bénin. Chaque jour, des dizaines de candidats trouvent leur voie grâce à notre plateforme.
                </p>
                <a href="{{ route('offres.index') }}"
                   class="inline-flex items-center gap-3 px-6 py-3 bg-yellow-400 text-gray-900 font-bold rounded-xl hover:bg-yellow-300 transition-colors text-sm">
                    Explorer les offres
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
            <div class="grid grid-cols-2 gap-4">
                @foreach([
                    ['num'=>$stats['total_offres'].'+','label'=>'Offres publiées','sub'=>'emplois & stages'],
                    ['num'=>$stats['total_entreprises'].'+','label'=>'Entreprises','sub'=>'toutes vérifiées'],
                    ['num'=>$stats['total_stages'].'+','label'=>'Stages dispo','sub'=>'pro & académique'],
                    ['num'=>'100%','label'=>'Gratuit','sub'=>'pour les candidats'],
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
                    <span class="text-4xl block mb-4">👨‍💼</span>
                    <p class="text-yellow-400 text-xs font-extrabold tracking-widest uppercase mb-2">Pour les candidats</p>
                    <h3 class="text-white font-extrabold text-3xl mb-4 leading-tight">Lancez votre<br>carrière dès aujourd'hui</h3>
                    <p class="text-gray-400 text-sm leading-relaxed mb-8">
                        Créez votre profil gratuitement, postulez en un clic et suivez vos candidatures en temps réel.
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
                    <span class="text-4xl block mb-4">🏢</span>
                    <p class="text-yellow-600 text-xs font-extrabold tracking-widest uppercase mb-2">Pour les entreprises</p>
                    <h3 class="text-gray-900 font-extrabold text-3xl mb-4 leading-tight">Recrutez les<br>meilleurs talents</h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-8">
                        Publiez vos offres, gérez vos candidatures et trouvez les profils qui correspondent à vos besoins.
                    </p>
                    @guest
                    <a href="{{ route('register') }}"
                       class="inline-flex items-center gap-2 px-6 py-3 bg-gray-900 text-white font-bold rounded-xl hover:bg-yellow-400 hover:text-gray-900 transition-all text-sm">
                        Publier une offre
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