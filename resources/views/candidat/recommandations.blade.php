@extends('layouts.app')

@section('title', 'Offres recommandées pour vous')

@section('content')

{{-- ═══════════════════════════════════════
     HEADER SOMBRE PERSONNALISÉ
═══════════════════════════════════════ --}}
<div class="bg-gray-950 border-b border-white/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 pb-8">

        {{-- Retour --}}
        <a href="{{ route('candidat.dashboard') }}"
           class="inline-flex items-center gap-1.5 text-gray-500 hover:text-yellow-400 text-xs font-extrabold uppercase tracking-widest transition-colors mb-6">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
            </svg>
            Retour au tableau de bord
        </a>

        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-6">
            <div>

                <h1 class="text-white font-extrabold leading-tight mb-3"
                    style="font-size:clamp(1.6rem,3vw,2.5rem);letter-spacing:-0.025em">
                    Offres recommandées<br>pour <span class="text-yellow-400">{{ auth()->user()->name }}</span>
                </h1>

                {{-- Critères actifs --}}
                <div class="flex flex-wrap gap-2">
                    @foreach($domaines as $domaine)
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold text-gray-300"
                          style="background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.1)">
                        <svg class="w-3 h-3 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/></svg>
                        {{ $domaine }}
                    </span>
                    @endforeach
                    @foreach($diplomes as $diplome)
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold text-gray-300"
                          style="background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.1)">
                        <svg class="w-3 h-3 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                        {{ $diplome }}
                    </span>
                    @endforeach
                    @if(auth()->user()->localisation)
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold text-gray-300"
                          style="background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.1)">
                        <svg class="w-3 h-3 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                        {{ explode(',', auth()->user()->localisation)[0] }}
                    </span>
                    @endif
                    @if(auth()->user()->type_contrat_souhaite)
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold text-gray-300"
                          style="background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.1)">
                        <svg class="w-3 h-3 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        {{ auth()->user()->type_contrat_souhaite }}
                    </span>
                    @endif
                </div>
            </div>

            <div class="flex flex-col items-start sm:items-end gap-2 flex-shrink-0">
                <div class="text-right">
                    <p class="text-white font-extrabold text-2xl" style="letter-spacing:-0.03em">{{ $recommandations->count() }}</p>
                    <p class="text-gray-500 text-xs">offre(s) correspondante(s)</p>
                </div>
                <a href="{{ route('candidat.profil') }}"
                   class="inline-flex items-center gap-2 px-4 py-2 border border-white/15 text-gray-400 text-xs font-extrabold rounded-xl hover:border-yellow-400/40 hover:text-yellow-400 transition-all">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Modifier mes critères
                </a>
            </div>
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════
     LISTE DES OFFRES RECOMMANDÉES
═══════════════════════════════════════ --}}
<div class="bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        @if($recommandations->count() > 0)

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($recommandations as $offre)
            <a href="{{ route('offres.show', $offre->slug) }}"
               class="bg-white border border-gray-200 rounded-2xl p-6 flex flex-col gap-3 hover:border-yellow-400 hover:shadow-lg hover:shadow-yellow-50 hover:-translate-y-1 transition-all duration-200 group">

                <div class="flex items-start justify-between">
                    <div class="flex flex-wrap gap-1.5">
                        @if($offre->type_offre === 'emploi')
                            <span class="px-2.5 py-1 bg-indigo-50 text-indigo-600 text-xs font-extrabold rounded-lg uppercase tracking-wide">Emploi</span>
                        @elseif($offre->type_offre === 'stage_professionnel')
                            <span class="px-2.5 py-1 bg-green-50 text-green-600 text-xs font-extrabold rounded-lg uppercase tracking-wide">Stage Pro</span>
                        @else
                            <span class="px-2.5 py-1 bg-orange-50 text-orange-500 text-xs font-extrabold rounded-lg uppercase tracking-wide">Stage Acad.</span>
                        @endif
                        {{-- Badge Match --}}
                        <span class="px-2.5 py-1 bg-yellow-50 text-yellow-600 text-xs font-extrabold rounded-lg flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            Match
                        </span>
                    </div>
                    <span class="text-xs text-gray-400 flex-shrink-0">{{ $offre->created_at->diffForHumans() }}</span>
                </div>

                <h3 class="text-gray-900 font-extrabold text-base leading-snug group-hover:text-yellow-500 transition-colors">
                    {{ $offre->titre }}
                </h3>

                <p class="text-gray-500 text-sm font-semibold">{{ $offre->entreprise->nom_entreprise }}</p>

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
                    <span class="text-sm font-extrabold text-yellow-500 group-hover:translate-x-1 transition-transform duration-200 inline-block">
                        Postuler →
                    </span>
                </div>
            </a>
            @endforeach
        </div>

        @else

        {{-- État vide --}}
        <div class="max-w-lg mx-auto text-center py-20">
            <div class="w-20 h-20 bg-white border border-gray-200 rounded-2xl flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            <h2 class="text-gray-900 font-extrabold text-xl mb-3">Aucune offre correspondante</h2>
            <p class="text-gray-500 text-sm leading-relaxed mb-8">
                Nous n'avons pas trouvé d'offres correspondant à votre profil pour le moment.
                Complétez vos formations avec un domaine ou modifiez votre type de contrat souhaité.
            </p>
            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <a href="{{ route('candidat.profil') }}"
                   class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-gray-900 text-white font-extrabold text-sm rounded-xl hover:bg-yellow-400 hover:text-gray-900 transition-all">
                    Mettre à jour mon profil
                </a>
                <a href="{{ route('offres.index') }}"
                   class="inline-flex items-center justify-center gap-2 px-6 py-3 border border-gray-200 text-gray-700 font-extrabold text-sm rounded-xl hover:border-gray-900 transition-all">
                    Voir toutes les offres
                </a>
            </div>
        </div>

        @endif

    </div>
</div>

@endsection