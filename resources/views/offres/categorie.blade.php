@extends('layouts.app')

@section('title', $categorie->nom . ' — Offres JobConnect Bénin')

@section('content')

{{-- ═══════════════════════════════════════
     HERO
═══════════════════════════════════════ --}}
<section class="relative bg-gray-950 overflow-hidden">
    <div class="absolute inset-0 pointer-events-none"
         style="background-image:linear-gradient(rgba(255,255,255,0.03) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,0.03) 1px,transparent 1px);background-size:60px 60px"></div>
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[500px] h-[200px] pointer-events-none"
         style="background:radial-gradient(ellipse,rgba(250,204,21,0.1) 0%,transparent 70%)"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

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
            <span class="text-gray-400">Catégorie</span>
            <svg class="w-4 h-4 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="text-yellow-400 font-semibold">{{ $categorie->nom }}</span>
        </nav>

        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-6">
            <div>
                <div class="inline-flex items-center gap-2 mb-4 px-3 py-1.5 rounded-full"
                     style="background:rgba(250,204,21,0.1);border:1px solid rgba(250,204,21,0.25)">
                    <svg class="w-3.5 h-3.5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                    <span class="text-yellow-400 text-xs font-extrabold tracking-widest uppercase">
                        {{ $offres->total() }} offre(s)
                    </span>
                </div>
                <h1 class="text-white font-extrabold leading-tight"
                    style="font-size:clamp(1.8rem,4vw,3rem);letter-spacing:-0.02em">
                    {{ $categorie->nom }}
                </h1>
                @if($categorie->description)
                <p class="text-gray-400 text-base mt-3 max-w-xl">{{ $categorie->description }}</p>
                @endif
            </div>

            <a href="{{ route('offres.index', ['categorie' => $categorie->id]) }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 border border-white/15 text-gray-300 text-sm font-bold rounded-xl hover:border-yellow-400/40 hover:text-white transition-all flex-shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                </svg>
                Filtrer cette catégorie
            </a>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     LISTE DES OFFRES
═══════════════════════════════════════ --}}
<div class="bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <div class="space-y-4">
            @forelse($offres as $offre)
            <a href="{{ route('offres.show', $offre->slug) }}"
               class="block bg-white border border-gray-200 rounded-2xl p-6 hover:border-yellow-400 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 group">

                <div class="flex items-start justify-between gap-4">
                    <div class="flex-1 min-w-0">

                        {{-- Badges --}}
                        <div class="flex flex-wrap items-center gap-2 mb-3">
                            @if($offre->type_offre === 'emploi')
                                <span class="px-2.5 py-1 bg-indigo-50 text-indigo-600 text-xs font-extrabold rounded-lg uppercase tracking-wide">Emploi</span>
                            @elseif($offre->type_offre === 'stage_professionnel')
                                <span class="px-2.5 py-1 bg-green-50 text-green-600 text-xs font-extrabold rounded-lg uppercase tracking-wide">Stage Pro</span>
                            @else
                                <span class="px-2.5 py-1 bg-orange-50 text-orange-500 text-xs font-extrabold rounded-lg uppercase tracking-wide">Stage Acad.</span>
                            @endif

                            @if($offre->type_contrat)
                            <span class="px-2.5 py-1 bg-gray-100 text-gray-600 text-xs font-bold rounded-lg">{{ $offre->type_contrat }}</span>
                            @endif

                            @if($offre->date_limite && $offre->date_limite->diffInDays(now()) <= 7 && $offre->date_limite->isFuture())
                            <span class="px-2.5 py-1 bg-red-50 text-red-500 text-xs font-bold rounded-lg">⏰ Expire bientôt</span>
                            @endif
                        </div>

                        {{-- Titre --}}
                        <h3 class="text-gray-900 font-extrabold text-lg mb-1 leading-snug group-hover:text-yellow-500 transition-colors">
                            {{ $offre->titre }}
                        </h3>

                        {{-- Entreprise + ville --}}
                        <div class="flex items-center gap-3 mb-3 text-sm">
                            <span class="font-semibold text-gray-700">{{ $offre->entreprise->nom_entreprise }}</span>
                            <span class="text-gray-300">•</span>
                            <span class="flex items-center gap-1 text-gray-500">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                </svg>
                                {{ $offre->ville ?? 'Bénin' }}
                            </span>
                        </div>

                        {{-- Description --}}
                        <p class="text-gray-500 text-sm leading-relaxed mb-4 line-clamp-2">
                            {{ Str::limit(strip_tags($offre->description), 150) }}
                        </p>

                        {{-- Meta --}}
                        <div class="flex flex-wrap items-center gap-x-5 gap-y-1">
                            @if($offre->salaire_min)
                            <span class="flex items-center gap-1.5 text-xs text-gray-500 font-medium">
                                <svg class="w-3.5 h-3.5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ number_format($offre->salaire_min, 0, ',', ' ') }} FCFA+
                            </span>
                            @endif
                            <span class="flex items-center gap-1.5 text-xs text-gray-400">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $offre->created_at->diffForHumans() }}
                            </span>
                            @if($offre->date_limite)
                            <span class="flex items-center gap-1.5 text-xs {{ $offre->date_limite->isPast() ? 'text-red-400' : 'text-gray-400' }}">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Limite : {{ $offre->date_limite->format('d/m/Y') }}
                            </span>
                            @endif
                        </div>
                    </div>

                    {{-- Logo ou initiale --}}
                    <div class="flex flex-col items-end gap-3 flex-shrink-0">
                        @if($offre->entreprise->logo)
                        <img src="{{ asset('storage/' . $offre->entreprise->logo) }}"
                             alt="{{ $offre->entreprise->nom_entreprise }}"
                             class="w-14 h-14 object-contain border border-gray-200 rounded-xl bg-white p-1">
                        @else
                        <div class="w-14 h-14 rounded-xl bg-gray-900 flex items-center justify-center text-white font-extrabold text-lg">
                            {{ strtoupper(substr($offre->entreprise->nom_entreprise, 0, 1)) }}
                        </div>
                        @endif
                        <span class="text-xs font-extrabold text-yellow-500 group-hover:translate-x-1 transition-transform duration-200 inline-flex items-center gap-1 whitespace-nowrap">
                            Voir
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </span>
                    </div>
                </div>
            </a>
            @empty
            <div class="bg-white border border-gray-200 rounded-2xl p-16 text-center">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <p class="text-gray-900 font-bold text-lg mb-2">Aucune offre dans cette catégorie</p>
                <p class="text-gray-400 text-sm mb-6">Il n'y a pas encore d'offres actives pour la catégorie "{{ $categorie->nom }}".</p>
                <a href="{{ route('offres.index') }}"
                   class="inline-flex items-center gap-2 px-5 py-2.5 bg-gray-900 text-white font-bold rounded-xl text-sm hover:bg-yellow-400 hover:text-gray-900 transition-all">
                    Voir toutes les offres
                </a>
            </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($offres->hasPages())
        <div class="mt-8">
            {{ $offres->withQueryString()->links() }}
        </div>
        @endif

    </div>
</div>

@endsection