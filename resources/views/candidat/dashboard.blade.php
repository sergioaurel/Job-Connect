@extends('layouts.app')

@section('title', 'Mon espace candidat')

@section('content')

<div class="bg-gray-950 border-b border-white/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 pb-0">
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-6">
            <div>
                <p class="text-yellow-400 text-xs font-extrabold tracking-widest uppercase mb-1">Espace Candidat</p>
                <h1 class="text-white font-extrabold text-2xl sm:text-3xl" style="letter-spacing:-0.02em">
                    Bonjour, {{ auth()->user()->name }}
                </h1>
                <p class="text-gray-500 text-sm mt-1">Bienvenue sur votre tableau de bord</p>
            </div>
            <!-- <a href="{{ route('offres.index') }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-yellow-400 text-gray-900 font-extrabold text-xs rounded-xl hover:bg-yellow-300 transition-all self-start sm:self-auto">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                Toutes les offres
            </a> -->
        </div>
        <nav class="flex gap-1 overflow-x-auto pb-0 scrollbar-hide">
            @php
            $tabs = [
                ['route' => 'candidat.dashboard',    'label' => 'Tableau de bord', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                ['route' => 'candidat.profil',       'label' => 'Mon profil',       'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'],
                ['route' => 'candidat.candidatures', 'label' => 'Candidatures',     'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
                ['route' => 'candidat.favoris',      'label' => 'Favoris',          'icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z'],
            ];
            @endphp
            @foreach($tabs as $tab)
            @php $isActive = request()->routeIs($tab['route']); @endphp
            <a href="{{ route($tab['route']) }}"
               class="flex items-center gap-2 px-4 py-3 text-xs font-extrabold whitespace-nowrap rounded-t-xl transition-all border-b-2 {{ $isActive ? 'bg-white/5 text-yellow-400 border-yellow-400' : 'text-gray-500 border-transparent hover:text-gray-300 hover:bg-white/5' }}">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $tab['icon'] }}"/>
                </svg>
                {{ $tab['label'] }}
            </a>
            @endforeach
        </nav>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- Alerte profil incomplet --}}
    @if(!auth()->user()->profilComplete())
    <div class="mb-8 rounded-2xl p-5 flex items-center gap-4 border border-yellow-400/30" style="background:rgba(250,204,21,0.07)">
        <div class="w-10 h-10 rounded-xl bg-yellow-400 flex items-center justify-center flex-shrink-0">
            <svg class="w-5 h-5 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
        </div>
        <div class="flex-1 min-w-0">
            <p class="text-gray-900 font-bold text-sm">Votre profil est incomplet</p>
            <p class="text-gray-600 text-xs mt-0.5">Complétez votre profil pour activer les recommandations personnalisées.</p>
        </div>
        <a href="{{ route('candidat.profil') }}" class="flex-shrink-0 px-4 py-2 bg-gray-900 text-white font-extrabold text-xs rounded-xl hover:bg-yellow-400 hover:text-gray-900 transition-all">
            Compléter →
        </a>
    </div>
    @endif

    {{-- Stats --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8">
        @foreach([
            ['val' => $stats['total_candidatures'],      'label' => 'Candidatures',  'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', 'color' => 'bg-indigo-50 text-indigo-600'],
            ['val' => $stats['candidatures_en_attente'], 'label' => 'En attente',    'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',                                                                               'color' => 'bg-orange-50 text-orange-500'],
            ['val' => $stats['candidatures_retenues'],   'label' => 'Retenues',      'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',                                                                             'color' => 'bg-green-50 text-green-600'],
            ['val' => $stats['profil_complet'],          'label' => 'Profil complet','icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',                                                     'color' => 'bg-yellow-50 text-yellow-600'],
        ] as $stat)
        <div class="bg-white border border-gray-200 rounded-2xl p-5 hover:border-yellow-300 hover:shadow-sm transition-all">
            <div class="flex items-center justify-between mb-3">
                <p class="text-gray-500 text-xs font-semibold">{{ $stat['label'] }}</p>
                <div class="w-8 h-8 rounded-lg flex items-center justify-center {{ $stat['color'] }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $stat['icon'] }}"/>
                    </svg>
                </div>
            </div>
            <p class="text-gray-900 font-extrabold text-3xl" style="letter-spacing:-0.03em">{{ $stat['val'] }}</p>
        </div>
        @endforeach
    </div>

    {{-- ✦ SECTION RECOMMANDATIONS ─────────────────── --}}
    @if($recommandations->count() > 0)
    <div class="mb-8">

        {{-- Header section --}}
        <div class="flex items-center justify-between mb-5">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-yellow-400 flex items-center justify-center">
                    <svg class="w-5 h-5 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-gray-900 font-extrabold text-base">Recommandées pour vous</h2>
                    <p class="text-gray-400 text-xs mt-0.5">
                        Basé sur votre profil
                        @if(auth()->user()->formations->count() > 0)
                            · {{ auth()->user()->formations->first()->domaine ?? auth()->user()->formations->first()->diplome }}
                        @endif
                        <!-- @if(auth()->user()->localisation)
                            · {{ explode(',', auth()->user()->localisation)[0] }}
                        @endif
                        @if(auth()->user()->type_contrat_souhaite)
                            · {{ auth()->user()->type_contrat_souhaite }}
                        @endif -->
                    </p>
                </div>
            </div>
            {{-- Bouton "Voir tout" → page dédiée --}}
            <a href="{{ route('candidat.recommandations') }}"
               class="inline-flex items-center gap-1.5 px-4 py-2 bg-gray-900 text-white font-extrabold text-xs rounded-xl hover:bg-yellow-400 hover:text-gray-900 transition-all">
                Voir tout
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>

        {{-- Cards recommandées --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($recommandations as $offre)
            <a href="{{ route('offres.show', $offre->slug) }}"
               class="bg-white border border-gray-200 rounded-2xl p-5 flex flex-col gap-3 hover:border-yellow-400 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 group">
                <div class="flex items-start justify-between">
                    @if($offre->type_offre === 'emploi')
                        <span class="px-2.5 py-1 bg-indigo-50 text-indigo-600 text-xs font-extrabold rounded-lg uppercase tracking-wide">Emploi</span>
                    @elseif($offre->type_offre === 'stage_professionnel')
                        <span class="px-2.5 py-1 bg-green-50 text-green-600 text-xs font-extrabold rounded-lg uppercase tracking-wide">Stage Pro</span>
                    @else
                        <span class="px-2.5 py-1 bg-orange-50 text-orange-500 text-xs font-extrabold rounded-lg uppercase tracking-wide">Stage Acad.</span>
                    @endif
                    <span class="inline-flex items-center gap-1 px-2 py-1 bg-yellow-50 text-yellow-600 text-xs font-extrabold rounded-lg">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        Match
                    </span>
                </div>
                <h3 class="text-gray-900 font-extrabold text-sm leading-snug group-hover:text-yellow-500 transition-colors">
                    {{ $offre->titre }}
                </h3>
                <p class="text-gray-500 text-xs font-semibold">{{ $offre->entreprise->nom_entreprise }}</p>
                <div class="flex flex-wrap gap-x-3 gap-y-1">
                    <span class="flex items-center gap-1 text-xs text-gray-400">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                        {{ $offre->ville ?? 'Bénin' }}
                    </span>
                    @if($offre->type_contrat)
                    <span class="text-xs text-gray-400">· {{ $offre->type_contrat }}</span>
                    @endif
                </div>
                <div class="pt-2 border-t border-gray-100 flex items-center justify-between">
                    <span class="text-xs text-gray-400">{{ $offre->created_at->diffForHumans() }}</span>
                    <span class="text-xs font-extrabold text-yellow-500 group-hover:translate-x-1 transition-transform duration-200 inline-block">Postuler →</span>
                </div>
            </a>
            @endforeach
        </div>

    </div>
    @else
    {{-- Pas encore de recommandations --}}
    <div class="mb-8 rounded-2xl p-6 border border-dashed border-gray-200 text-center bg-white">
        <div class="w-12 h-12 bg-yellow-50 rounded-2xl flex items-center justify-center mx-auto mb-3">
            <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
            </svg>
        </div>
        <p class="text-gray-900 font-extrabold text-sm mb-1">Activez vos recommandations</p>
        <p class="text-gray-400 text-xs mb-4 max-w-xs mx-auto">
            Ajoutez une formation avec son domaine pour voir des offres adaptées à votre profil.
        </p>
        <a href="{{ route('candidat.profil') }}"
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-gray-900 text-white font-extrabold text-xs rounded-xl hover:bg-yellow-400 hover:text-gray-900 transition-all">
            Compléter mon profil →
        </a>
    </div>
    @endif

    {{-- Grille candidatures + favoris --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Dernières candidatures --}}
        <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h2 class="text-gray-900 font-extrabold text-base">Dernières candidatures</h2>
                <a href="{{ route('candidat.candidatures') }}" class="text-xs font-extrabold text-gray-500 hover:text-yellow-500 transition-colors">Voir tout →</a>
            </div>
            <div class="divide-y divide-gray-50">
                @forelse($candidatures as $candidature)
                @php
                $cfg = [
                    'en_attente' => ['bg'=>'bg-orange-50','text'=>'text-orange-600','label'=>'En attente'],
                    'vue'        => ['bg'=>'bg-blue-50',  'text'=>'text-blue-600',  'label'=>'Vue'],
                    'retenue'    => ['bg'=>'bg-green-50', 'text'=>'text-green-600', 'label'=>'Retenue'],
                    'refusee'    => ['bg'=>'bg-red-50',   'text'=>'text-red-500',   'label'=>'Refusée'],
                ][$candidature->statut] ?? ['bg'=>'bg-gray-100','text'=>'text-gray-600','label'=>ucfirst($candidature->statut)];
                @endphp
                <div class="px-6 py-4 hover:bg-gray-50 transition-colors">
                    <div class="flex items-start justify-between gap-3">
                        <div class="flex-1 min-w-0">
                            <a href="{{ route('offres.show', $candidature->offre->slug) }}" class="text-gray-900 font-bold text-sm hover:text-yellow-500 transition-colors block truncate">{{ $candidature->offre->titre }}</a>
                            <p class="text-gray-500 text-xs mt-0.5">{{ $candidature->offre->entreprise->nom_entreprise }}</p>
                            <p class="text-gray-400 text-xs mt-1">{{ $candidature->created_at->diffForHumans() }}</p>
                        </div>
                        <span class="flex-shrink-0 px-2.5 py-1 text-xs font-extrabold rounded-lg {{ $cfg['bg'] }} {{ $cfg['text'] }}">{{ $cfg['label'] }}</span>
                    </div>
                </div>
                @empty
                <div class="px-6 py-12 text-center">
                    <div class="w-12 h-12 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <p class="text-gray-500 text-sm font-semibold mb-1">Aucune candidature</p>
                    <a href="{{ route('offres.index') }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-gray-900 text-white font-extrabold text-xs rounded-xl hover:bg-yellow-400 hover:text-gray-900 transition-all mt-3">Découvrir les offres</a>
                </div>
                @endforelse
            </div>
        </div>

        {{-- Offres favorites --}}
        <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h2 class="text-gray-900 font-extrabold text-base">Offres favorites</h2>
                <a href="{{ route('candidat.favoris') }}" class="text-xs font-extrabold text-gray-500 hover:text-yellow-500 transition-colors">Voir tout →</a>
            </div>
            <div class="divide-y divide-gray-50">
                @forelse($favoris as $offre)
                <div class="px-6 py-4 hover:bg-gray-50 transition-colors group">
                    <div class="flex items-start justify-between gap-3">
                        <div class="flex-1 min-w-0">
                            <a href="{{ route('offres.show', $offre->slug) }}" class="text-gray-900 font-bold text-sm hover:text-yellow-500 transition-colors block truncate">{{ $offre->titre }}</a>
                            <p class="text-gray-500 text-xs mt-0.5">{{ $offre->entreprise->nom_entreprise }}</p>
                            <p class="text-gray-400 text-xs mt-1">{{ $offre->ville }}</p>
                        </div>
                        <a href="{{ route('candidat.candidatures.create', $offre->id) }}" class="flex-shrink-0 px-3 py-1.5 bg-gray-100 text-gray-700 font-extrabold text-xs rounded-lg hover:bg-yellow-400 hover:text-gray-900 transition-all">Postuler</a>
                    </div>
                </div>
                @empty
                <div class="px-6 py-12 text-center">
                    <div class="w-12 h-12 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    </div>
                    <p class="text-gray-500 text-sm font-semibold mb-1">Aucun favori</p>
                    <a href="{{ route('offres.index') }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-gray-900 text-white font-extrabold text-xs rounded-xl hover:bg-yellow-400 hover:text-gray-900 transition-all mt-3">Parcourir les offres</a>
                </div>
                @endforelse
            </div>
        </div>

    </div>
</div>

@endsection