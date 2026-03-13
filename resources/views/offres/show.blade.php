@extends('layouts.app')

@section('title', $offre->titre . ' — ' . $offre->entreprise->nom_entreprise)

@section('content')

{{-- ═══════════════════════════════════════
     HERO OFFRE
═══════════════════════════════════════ --}}
<section class="relative bg-gray-950 overflow-hidden">
    <div class="absolute inset-0 pointer-events-none"
         style="background-image:linear-gradient(rgba(255,255,255,0.03) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,0.03) 1px,transparent 1px);background-size:60px 60px"></div>
    <div class="absolute top-0 right-0 w-96 h-96 pointer-events-none"
         style="background:radial-gradient(circle,rgba(250,204,21,0.07),transparent 70%)"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-sm text-gray-500 mb-8">
            <a href="{{ route('offres.index') }}" class="hover:text-yellow-400 transition-colors flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/>
                </svg>
                Toutes les offres
            </a>
            <svg class="w-4 h-4 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-gray-400 truncate max-w-xs">{{ $offre->titre }}</span>
        </nav>

        <div class="flex flex-col lg:flex-row lg:items-start justify-between gap-8">
            <div class="flex items-start gap-5">
                {{-- Logo ou initiale --}}
                @if($offre->entreprise->logo)
                <img src="{{ asset('storage/' . $offre->entreprise->logo) }}"
                     alt="{{ $offre->entreprise->nom_entreprise }}"
                     class="w-20 h-20 object-contain rounded-2xl border border-white/10 bg-white/5 p-2 flex-shrink-0">
                @else
                <div class="w-20 h-20 rounded-2xl bg-yellow-400 flex items-center justify-center text-gray-900 font-extrabold text-3xl flex-shrink-0">
                    {{ strtoupper(substr($offre->entreprise->nom_entreprise, 0, 1)) }}
                </div>
                @endif

                <div>
                    {{-- Badges --}}
                    <div class="flex flex-wrap items-center gap-2 mb-3">
                        @if($offre->type_offre === 'emploi')
                            <span class="px-3 py-1 bg-indigo-500/15 text-indigo-300 text-xs font-extrabold rounded-full uppercase tracking-wide border border-indigo-500/20">Emploi</span>
                        @elseif($offre->type_offre === 'stage_professionnel')
                            <span class="px-3 py-1 bg-green-500/15 text-green-300 text-xs font-extrabold rounded-full uppercase tracking-wide border border-green-500/20">Stage Pro</span>
                        @else
                            <span class="px-3 py-1 bg-orange-500/15 text-orange-300 text-xs font-extrabold rounded-full uppercase tracking-wide border border-orange-500/20">Stage Acad.</span>
                        @endif
                        @if($offre->type_contrat)
                        <span class="px-3 py-1 bg-white/8 text-gray-300 text-xs font-bold rounded-full border border-white/10">{{ $offre->type_contrat }}</span>
                        @endif
                        @if($offre->date_limite && $offre->date_limite->diffInDays(now()) <= 7 && $offre->date_limite->isFuture())
                        <span class="px-3 py-1 bg-red-500/15 text-red-300 text-xs font-bold rounded-full border border-red-500/20">⏰ Expire bientôt</span>
                        @endif
                    </div>

                    <h1 class="text-white font-extrabold leading-tight mb-3"
                        style="font-size:clamp(1.6rem,3vw,2.5rem);letter-spacing:-0.02em">
                        {{ $offre->titre }}
                    </h1>

                    <div class="flex flex-wrap items-center gap-4 text-sm">
                        <span class="text-yellow-400 font-bold">{{ $offre->entreprise->nom_entreprise }}</span>
                        <span class="flex items-center gap-1.5 text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                            {{ $offre->ville ?? 'Bénin' }}
                        </span>
                        <span class="flex items-center gap-1.5 text-gray-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            {{ $offre->vues }} vue(s)
                        </span>
                        <span class="flex items-center gap-1.5 text-gray-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Publié {{ $offre->created_at->diffForHumans() }}
                        </span>
                        @if($offre->date_limite)
                        <span class="flex items-center gap-1.5 {{ $offre->date_limite->isPast() ? 'text-red-400' : 'text-gray-500' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            Limite : {{ $offre->date_limite->format('d/m/Y') }}
                        </span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- CTA hero (desktop) --}}
            <div class="hidden lg:flex flex-col items-end gap-3 flex-shrink-0">
                @auth
                    @if(auth()->user()->isCandidat())
                        @if($aPostule)
                        <div class="px-6 py-3 bg-green-500/15 border border-green-500/30 text-green-300 font-bold rounded-xl text-sm flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            Candidature envoyée
                        </div>
                        @else
                        <a href="{{ route('candidat.candidatures.create', $offre->id) }}"
                           class="px-8 py-3.5 bg-yellow-400 text-gray-900 font-extrabold rounded-xl text-sm hover:bg-yellow-300 transition-colors flex items-center gap-2">
                            Postuler maintenant
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                        @endif
                        <button onclick="toggleFavori({{ $offre->id }})" id="favori-btn-hero"
                                class="px-5 py-2.5 border border-white/15 text-gray-300 font-semibold rounded-xl text-sm hover:border-yellow-400/50 hover:text-yellow-400 transition-all flex items-center gap-2">
                            @if($estFavori)
                            <span id="favori-icon-hero">★</span> Retirer des favoris
                            @else
                            <span id="favori-icon-hero">☆</span> Ajouter aux favoris
                            @endif
                        </button>
                    @endif
                @else
                <a href="{{ route('login') }}"
                   class="px-8 py-3.5 bg-yellow-400 text-gray-900 font-extrabold rounded-xl text-sm hover:bg-yellow-300 transition-colors">
                    Se connecter pour postuler
                </a>
                @endauth
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     CONTENU
═══════════════════════════════════════ --}}
<div class="bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- ── CONTENU PRINCIPAL ── --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Description --}}
                <div class="bg-white border border-gray-200 rounded-2xl p-8">
                    <h2 class="text-gray-900 font-extrabold text-xl mb-5 flex items-center gap-3">
                        <span class="w-8 h-8 bg-yellow-400/15 rounded-lg flex items-center justify-center text-yellow-500 flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </span>
                        Description du poste
                    </h2>
                    <div class="text-gray-600 text-sm leading-relaxed prose prose-sm max-w-none">
                        {!! nl2br(e($offre->description)) !!}
                    </div>
                </div>

                {{-- Missions --}}
                @if($offre->missions)
                <div class="bg-white border border-gray-200 rounded-2xl p-8">
                    <h2 class="text-gray-900 font-extrabold text-xl mb-5 flex items-center gap-3">
                        <span class="w-8 h-8 bg-indigo-50 rounded-lg flex items-center justify-center text-indigo-500 flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                        </span>
                        Missions principales
                    </h2>
                    <div class="text-gray-600 text-sm leading-relaxed prose prose-sm max-w-none">
                        {!! nl2br(e($offre->missions)) !!}
                    </div>
                </div>
                @endif

                {{-- Profil recherché --}}
                @if($offre->profil_recherche)
                <div class="bg-white border border-gray-200 rounded-2xl p-8">
                    <h2 class="text-gray-900 font-extrabold text-xl mb-5 flex items-center gap-3">
                        <span class="w-8 h-8 bg-green-50 rounded-lg flex items-center justify-center text-green-500 flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </span>
                        Profil recherché
                    </h2>
                    <div class="text-gray-600 text-sm leading-relaxed prose prose-sm max-w-none">
                        {!! nl2br(e($offre->profil_recherche)) !!}
                    </div>
                </div>
                @endif

                {{-- Compétences --}}
                @if($offre->competences_requises)
                <div class="bg-white border border-gray-200 rounded-2xl p-8">
                    <h2 class="text-gray-900 font-extrabold text-xl mb-5 flex items-center gap-3">
                        <span class="w-8 h-8 bg-orange-50 rounded-lg flex items-center justify-center text-orange-500 flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                        </span>
                        Compétences requises
                    </h2>
                    <div class="flex flex-wrap gap-2">
                        @foreach(explode(',', $offre->competences_requises) as $competence)
                        <span class="px-3 py-1.5 bg-gray-900 text-white text-xs font-bold rounded-lg">
                            {{ trim($competence) }}
                        </span>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Infos complémentaires --}}
                <div class="bg-white border border-gray-200 rounded-2xl p-8">
                    <h2 class="text-gray-900 font-extrabold text-xl mb-6 flex items-center gap-3">
                        <span class="w-8 h-8 bg-yellow-50 rounded-lg flex items-center justify-center text-yellow-500 flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </span>
                        Informations complémentaires
                    </h2>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                        @foreach([
                            ['label' => 'Niveau d\'études',  'value' => $offre->niveau_etude ?? 'Non précisé', 'icon' => '🎓'],
                            ['label' => 'Expérience',        'value' => $offre->annees_experience == 0 ? 'Débutant accepté' : $offre->annees_experience.' an(s)', 'icon' => '💼'],
                            ['label' => 'Postes ouverts',    'value' => $offre->nombre_postes ?? '1', 'icon' => '👥'],
                            ['label' => 'Salaire',
                             'value' => $offre->salaire_a_negocier ? 'À négocier' : (($offre->salaire_min || $offre->salaire_max) ? number_format($offre->salaire_min, 0, ',', ' ').' – '.number_format($offre->salaire_max, 0, ',', ' ').' FCFA' : 'Non précisé'),
                             'icon' => '💰'],
                        ] as $info)
                        <div class="bg-gray-50 rounded-xl p-4 text-center">
                            <div class="text-2xl mb-2">{{ $info['icon'] }}</div>
                            <p class="text-xs text-gray-400 font-semibold uppercase tracking-wide mb-1">{{ $info['label'] }}</p>
                            <p class="text-gray-900 font-bold text-sm">{{ $info['value'] }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- CTA mobile --}}
                <div class="lg:hidden bg-white border border-gray-200 rounded-2xl p-6">
                    @auth
                        @if(auth()->user()->isCandidat())
                            @if($aPostule)
                            <div class="flex items-center justify-center gap-2 w-full py-3.5 bg-green-50 border border-green-200 text-green-700 font-bold rounded-xl text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                Candidature déjà envoyée
                            </div>
                            @else
                            <a href="{{ route('candidat.candidatures.create', $offre->id) }}"
                               class="flex items-center justify-center gap-2 w-full py-3.5 bg-yellow-400 text-gray-900 font-extrabold rounded-xl text-sm hover:bg-yellow-300 transition-colors mb-3">
                                Postuler maintenant
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </a>
                            @endif
                            <button onclick="toggleFavori({{ $offre->id }})" id="favori-btn"
                                    class="w-full py-3 border-2 border-gray-200 text-gray-700 font-bold rounded-xl text-sm hover:border-yellow-400 hover:text-yellow-500 transition-all">
                                @if($estFavori) ★ Retirer des favoris @else ☆ Ajouter aux favoris @endif
                            </button>
                        @endif
                    @else
                    <p class="text-gray-500 text-sm text-center mb-4">Connectez-vous pour postuler à cette offre</p>
                    <a href="{{ route('login') }}"
                       class="flex items-center justify-center gap-2 w-full py-3.5 bg-gray-900 text-white font-extrabold rounded-xl text-sm hover:bg-yellow-400 hover:text-gray-900 transition-all">
                        Se connecter
                    </a>
                    @endauth
                </div>

                {{-- Offres similaires --}}
                @if($offresSimilaires->count() > 0)
                <div>
                    <h2 class="text-gray-900 font-extrabold text-xl mb-4">Offres similaires</h2>
                    <div class="space-y-3">
                        @foreach($offresSimilaires as $sim)
                        <a href="{{ route('offres.show', $sim->slug) }}"
                           class="flex items-center justify-between gap-4 bg-white border border-gray-200 rounded-2xl p-5 hover:border-yellow-400 hover:shadow-sm hover:-translate-y-0.5 transition-all duration-200 group">
                            <div class="min-w-0">
                                <h3 class="text-gray-900 font-bold text-sm truncate group-hover:text-yellow-500 transition-colors">{{ $sim->titre }}</h3>
                                <p class="text-gray-400 text-xs mt-1">{{ $sim->entreprise->nom_entreprise }} • {{ $sim->ville }}</p>
                            </div>
                            <svg class="w-4 h-4 text-gray-400 group-hover:text-yellow-400 flex-shrink-0 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            {{-- ── SIDEBAR ── --}}
            <div class="lg:col-span-1 space-y-5">

                {{-- CTA sticky desktop --}}
                <div class="hidden lg:block bg-white border border-gray-200 rounded-2xl p-6 sticky top-4">

                    @auth
                        @if(auth()->user()->isCandidat())
                            @if($aPostule)
                            <div class="flex items-center justify-center gap-2 w-full py-3.5 bg-green-50 border border-green-200 text-green-700 font-bold rounded-xl text-sm mb-3">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                Candidature déjà envoyée
                            </div>
                            @else
                            <a href="{{ route('candidat.candidatures.create', $offre->id) }}"
                               class="flex items-center justify-center gap-2 w-full py-3.5 bg-yellow-400 text-gray-900 font-extrabold rounded-xl text-sm hover:bg-yellow-300 transition-colors mb-3">
                                Postuler maintenant
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </a>
                            @endif
                            <button onclick="toggleFavori({{ $offre->id }})" id="favori-btn"
                                    class="w-full py-2.5 border-2 border-gray-200 text-gray-700 font-bold rounded-xl text-sm hover:border-yellow-400 hover:text-yellow-500 transition-all">
                                @if($estFavori) ★ Retirer des favoris @else ☆ Ajouter aux favoris @endif
                            </button>
                        @elseif(auth()->user()->isEntreprise() || auth()->user()->isAdmin())
                        <p class="text-gray-400 text-xs text-center">Espace réservé aux candidats</p>
                        @endif
                    @else
                    <p class="text-gray-500 text-sm text-center mb-4">Connectez-vous pour postuler</p>
                    <a href="{{ route('login') }}"
                       class="flex items-center justify-center gap-2 w-full py-3.5 bg-gray-900 text-white font-extrabold rounded-xl text-sm hover:bg-yellow-400 hover:text-gray-900 transition-all mb-3">
                        Se connecter
                    </a>
                    <a href="{{ route('register') }}"
                       class="flex items-center justify-center w-full py-2.5 border-2 border-gray-200 text-gray-700 font-bold rounded-xl text-sm hover:border-yellow-400 hover:text-yellow-500 transition-all">
                        Créer un compte gratuit
                    </a>
                    @endauth

                    {{-- Infos clés --}}
                    <div class="mt-5 pt-5 border-t border-gray-100 space-y-3">
                        @foreach([
                            ['label' => 'Type',      'value' => ucfirst(str_replace('_', ' ', $offre->type_offre))],
                            ['label' => 'Contrat',   'value' => $offre->type_contrat ?? 'Non précisé'],
                            ['label' => 'Ville',     'value' => $offre->ville ?? 'Bénin'],
                            ['label' => 'Expérience','value' => $offre->annees_experience == 0 ? 'Débutant' : $offre->annees_experience.' an(s)'],
                        ] as $info)
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-400 font-medium">{{ $info['label'] }}</span>
                            <span class="text-gray-900 font-bold">{{ $info['value'] }}</span>
                        </div>
                        @endforeach
                        @if(!$offre->salaire_a_negocier && $offre->salaire_min)
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-400 font-medium">Salaire</span>
                            <span class="text-yellow-500 font-extrabold">{{ number_format($offre->salaire_min, 0, ',', ' ') }} FCFA+</span>
                        </div>
                        @elseif($offre->salaire_a_negocier)
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-400 font-medium">Salaire</span>
                            <span class="text-gray-900 font-bold">À négocier</span>
                        </div>
                        @endif
                        @if($offre->date_limite)
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-400 font-medium">Date limite</span>
                            <span class="font-bold {{ $offre->date_limite->isPast() ? 'text-red-500' : 'text-gray-900' }}">
                                {{ $offre->date_limite->format('d/m/Y') }}
                            </span>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- À propos de l'entreprise --}}
                <div class="bg-white border border-gray-200 rounded-2xl p-6">
                    <h3 class="text-gray-900 font-extrabold text-sm uppercase tracking-widest mb-5">À propos de l'entreprise</h3>

                    <div class="flex items-center gap-3 mb-4">
                        @if($offre->entreprise->logo)
                        <img src="{{ asset('storage/' . $offre->entreprise->logo) }}"
                             alt="{{ $offre->entreprise->nom_entreprise }}"
                             class="w-12 h-12 object-contain rounded-xl border border-gray-200 bg-white p-1">
                        @else
                        <div class="w-12 h-12 rounded-xl bg-gray-900 flex items-center justify-center text-white font-extrabold text-lg">
                            {{ strtoupper(substr($offre->entreprise->nom_entreprise, 0, 1)) }}
                        </div>
                        @endif
                        <div>
                            <p class="text-gray-900 font-bold text-sm">{{ $offre->entreprise->nom_entreprise }}</p>
                            @if($offre->entreprise->secteur_activite)
                            <p class="text-gray-400 text-xs">{{ $offre->entreprise->secteur_activite }}</p>
                            @endif
                        </div>
                    </div>

                    @if($offre->entreprise->description)
                    <p class="text-gray-500 text-sm leading-relaxed mb-4">
                        {{ Str::limit($offre->entreprise->description, 180) }}
                    </p>
                    @endif

                    <div class="space-y-2">
                        @if($offre->entreprise->effectif)
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-gray-400">Effectif</span>
                            <span class="text-gray-700 font-semibold">{{ $offre->entreprise->effectif }} employés</span>
                        </div>
                        @endif
                        @if($offre->entreprise->site_web)
                        <a href="{{ $offre->entreprise->site_web }}" target="_blank"
                           class="flex items-center gap-2 text-xs text-yellow-500 font-bold hover:text-yellow-400 transition-colors mt-3">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            Visiter le site web
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@auth
    @if(auth()->user()->isCandidat())
    @push('scripts')
    <script>
    (function () {
        function toggleFavori(offreId) {
            fetch(`/candidat/favoris/toggle/${offreId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                }
            })
            .then(r => r.json())
            .then(data => {
                ['favori-btn', 'favori-btn-hero'].forEach(id => {
                    const btn = document.getElementById(id);
                    if (btn) {
                        btn.innerHTML = data.estFavori
                            ? '<span>★</span> Retirer des favoris'
                            : '<span>☆</span> Ajouter aux favoris';
                    }
                });
            })
            .catch(e => console.error(e));
        }
        window.toggleFavori = toggleFavori;
    })();
    </script>
    @endpush
    @endif
@endauth

@endsection