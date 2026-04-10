@extends('layouts.app')

@section('title', $offre->titre . ' — Espace Entreprise')

@section('content')

{{-- ═══════════════════════════════════════
     HEADER SOMBRE
═══════════════════════════════════════ --}}
<div class="bg-gray-950 border-b border-white/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 pb-0">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-xs text-gray-500 mb-5">
            <a href="{{ route('entreprise.dashboard') }}" class="hover:text-yellow-400 transition font-semibold">Tableau de bord</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('entreprise.offres.index') }}" class="hover:text-yellow-400 transition font-semibold">Mes offres</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-gray-400 truncate max-w-xs">{{ $offre->titre }}</span>
        </nav>

        {{-- Titre + badges --}}
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 pb-6">
            <div>
                <div class="flex flex-wrap items-center gap-2 mb-3">
                    {{-- Badge type --}}
                    @if($offre->type_offre === 'emploi')
                        <span class="px-2.5 py-1 bg-indigo-500/20 text-indigo-300 text-xs font-extrabold rounded-lg uppercase tracking-wide">Emploi</span>
                    @elseif($offre->type_offre === 'stage_professionnel')
                        <span class="px-2.5 py-1 bg-green-500/20 text-green-300 text-xs font-extrabold rounded-lg uppercase tracking-wide">Stage Pro</span>
                    @else
                        <span class="px-2.5 py-1 bg-orange-500/20 text-orange-300 text-xs font-extrabold rounded-lg uppercase tracking-wide">Stage Académique</span>
                    @endif

                    {{-- Badge statut --}}
                    @if($offre->statut === 'active')
                        <span class="px-2.5 py-1 bg-green-500/15 text-green-400 text-xs font-extrabold rounded-lg flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 bg-green-400 rounded-full animate-pulse inline-block"></span>Active
                        </span>
                    @elseif($offre->statut === 'fermee')
                        <span class="px-2.5 py-1 bg-white/5 text-gray-400 text-xs font-extrabold rounded-lg flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 bg-gray-500 rounded-full inline-block"></span>Fermée
                        </span>
                    @else
                        <span class="px-2.5 py-1 bg-yellow-500/15 text-yellow-400 text-xs font-extrabold rounded-lg flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 bg-yellow-400 rounded-full inline-block"></span>Pourvue
                        </span>
                    @endif
                </div>

                <h1 class="text-white font-extrabold text-2xl sm:text-3xl mb-3" style="letter-spacing:-0.02em">
                    {{ $offre->titre }}
                </h1>

                <div class="flex flex-wrap gap-4 text-xs text-gray-400 font-semibold">
                    <span class="flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                        {{ $offre->ville ?? 'Non précisé' }}
                    </span>
                    <span class="flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-5 5a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 10V5a2 2 0 012-2z"/></svg>
                        {{ $offre->categorie->nom ?? 'Non catégorisé' }}
                    </span>
                    <span class="flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        {{ $offre->vues ?? 0 }} vue(s)
                    </span>
                    <span class="flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Publiée le {{ $offre->created_at->format('d/m/Y') }}
                    </span>
                </div>
            </div>

            {{-- Boutons d'action --}}
            <div class="flex items-center gap-2 flex-shrink-0">
                <a href="{{ route('entreprise.offres.edit', $offre->id) }}"
                   class="inline-flex items-center gap-2 px-4 py-2.5 bg-yellow-400 text-gray-900 font-extrabold text-xs rounded-xl hover:bg-yellow-300 transition-all">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    Modifier
                </a>

                @if($offre->statut === 'active')
                <form action="{{ route('entreprise.offres.change-status', $offre->id) }}" method="POST">
                    @csrf @method('PATCH')
                    <input type="hidden" name="statut" value="fermee">
                    <button type="submit"
                            class="inline-flex items-center gap-2 px-4 py-2.5 bg-white/5 border border-white/10 text-gray-300 font-extrabold text-xs rounded-xl hover:bg-white/10 transition-all">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
                        Fermer l'offre
                    </button>
                </form>
                @elseif($offre->statut === 'fermee')
                <form action="{{ route('entreprise.offres.change-status', $offre->id) }}" method="POST">
                    @csrf @method('PATCH')
                    <input type="hidden" name="statut" value="active">
                    <button type="submit"
                            class="inline-flex items-center gap-2 px-4 py-2.5 bg-green-500/15 border border-green-500/20 text-green-400 font-extrabold text-xs rounded-xl hover:bg-green-500/25 transition-all">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Réactiver
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════
     CONTENU
═══════════════════════════════════════ --}}
<div class="bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- Flash messages --}}
        @if(session('success'))
        <div class="mb-6 flex items-center gap-3 px-5 py-3.5 bg-green-50 border border-green-200 rounded-2xl text-green-700 text-sm font-semibold">
            <svg class="w-5 h-5 flex-shrink-0 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="mb-6 flex items-center gap-3 px-5 py-3.5 bg-red-50 border border-red-200 rounded-2xl text-red-700 text-sm font-semibold">
            <svg class="w-5 h-5 flex-shrink-0 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            {{ session('error') }}
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- ── COLONNE PRINCIPALE ── --}}
            <div class="lg:col-span-2 space-y-5">

                {{-- Stats rapides --}}
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    @foreach([
                        ['val' => $offre->candidatures->count(),                          'label' => 'Candidatures',  'color' => 'bg-indigo-50 text-indigo-600'],
                        ['val' => $offre->candidatures->where('statut','en_attente')->count(), 'label' => 'En attente', 'color' => 'bg-orange-50 text-orange-500'],
                        ['val' => $offre->candidatures->where('statut','retenue')->count(),    'label' => 'Retenues',   'color' => 'bg-green-50 text-green-600'],
                        ['val' => $offre->vues ?? 0,                                       'label' => 'Vues',          'color' => 'bg-yellow-50 text-yellow-600'],
                    ] as $s)
                    <div class="bg-white border border-gray-200 rounded-2xl p-4 hover:border-yellow-300 hover:shadow-sm transition-all">
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-gray-500 text-xs font-semibold">{{ $s['label'] }}</p>
                            <div class="w-7 h-7 rounded-lg flex items-center justify-center {{ $s['color'] }}">
                                <span class="text-xs font-extrabold">{{ $s['val'] }}</span>
                            </div>
                        </div>
                        <p class="text-gray-900 font-extrabold text-2xl" style="letter-spacing:-0.03em">{{ $s['val'] }}</p>
                    </div>
                    @endforeach
                </div>

                {{-- Description --}}
                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl bg-indigo-100 flex items-center justify-center">
                            <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <h2 class="text-gray-900 font-extrabold text-base">Description du poste</h2>
                    </div>
                    <div class="p-6">
                        <div class="text-gray-600 text-sm leading-relaxed">
                            {!! nl2br(e($offre->description)) !!}
                        </div>
                    </div>
                </div>

                {{-- Profil recherché --}}
                @if($offre->profil_recherche)
                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl bg-green-100 flex items-center justify-center">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </div>
                        <h2 class="text-gray-900 font-extrabold text-base">Profil recherché</h2>
                    </div>
                    <div class="p-6">
                        <div class="text-gray-600 text-sm leading-relaxed">
                            {!! nl2br(e($offre->profil_recherche)) !!}
                        </div>
                    </div>
                </div>
                @endif

                {{-- Candidatures reçues --}}
                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-xl bg-yellow-100 flex items-center justify-center">
                                <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <h2 class="text-gray-900 font-extrabold text-base">
                                Candidatures reçues
                                <span class="ml-2 px-2 py-0.5 bg-yellow-50 text-yellow-600 text-xs font-extrabold rounded-lg">
                                    {{ $offre->candidatures->count() }}
                                </span>
                            </h2>
                        </div>
                        @if($offre->candidatures->count() > 0)
                        <a href="{{ route('entreprise.candidatures.offre', $offre->id) }}"
                           class="text-xs font-extrabold text-gray-500 hover:text-yellow-500 transition-colors">
                            Voir toutes →
                        </a>
                        @endif
                    </div>

                    @if($offre->candidatures->count() === 0)
                    <div class="px-6 py-14 text-center">
                        <div class="w-14 h-14 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <svg class="w-7 h-7 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                        </div>
                        <p class="text-gray-900 font-extrabold text-sm mb-1">Aucune candidature reçue</p>
                        <p class="text-gray-400 text-xs">Les candidatures apparaîtront ici dès qu'un candidat postulera.</p>
                    </div>
                    @else
                    <div class="divide-y divide-gray-50">
                        @foreach($offre->candidatures->take(5) as $candidature)
                        <div class="px-6 py-4 hover:bg-gray-50 transition-colors group">
                            <div class="flex items-center justify-between gap-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-gray-900 flex items-center justify-center text-white font-extrabold text-sm flex-shrink-0">
                                        {{ strtoupper(substr($candidature->candidat->name ?? 'C', 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="text-gray-900 font-bold text-sm">{{ $candidature->candidat->name ?? 'Candidat inconnu' }}</p>
                                        <p class="text-gray-400 text-xs">{{ $candidature->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    @php
                                    $cfg = [
                                        'en_attente' => ['bg'=>'bg-orange-50','text'=>'text-orange-600','label'=>'En attente'],
                                        'vue'        => ['bg'=>'bg-blue-50',  'text'=>'text-blue-600',  'label'=>'Vue'],
                                        'retenue'    => ['bg'=>'bg-green-50', 'text'=>'text-green-600', 'label'=>'Retenue'],
                                        'rejetee'    => ['bg'=>'bg-red-50',   'text'=>'text-red-500',   'label'=>'Rejetée'],
                                    ][$candidature->statut] ?? ['bg'=>'bg-gray-100','text'=>'text-gray-600','label'=>ucfirst($candidature->statut)];
                                    @endphp
                                    <span class="px-2.5 py-1 text-xs font-extrabold rounded-lg {{ $cfg['bg'] }} {{ $cfg['text'] }}">
                                        {{ $cfg['label'] }}
                                    </span>
                                    <a href="{{ route('entreprise.candidatures.show', $candidature->id) }}"
                                       class="opacity-0 group-hover:opacity-100 transition-all px-3 py-1.5 bg-gray-900 text-white text-xs font-extrabold rounded-lg hover:bg-yellow-400 hover:text-gray-900">
                                        Voir
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>

            </div>

            {{-- ── COLONNE LATÉRALE ── --}}
            <div class="space-y-5">

                {{-- Informations clés --}}
                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl bg-gray-900 flex items-center justify-center">
                            <svg class="w-4 h-4 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        </div>
                        <h2 class="text-gray-900 font-extrabold text-base">Informations clés</h2>
                    </div>
                    <div class="p-6 space-y-3">

                        @if($offre->type_contrat)
                        <div class="flex items-center justify-between py-2 border-b border-gray-50">
                            <span class="text-xs font-semibold text-gray-500">Type de contrat</span>
                            <span class="text-xs font-extrabold text-gray-900 px-2.5 py-1 bg-gray-100 rounded-lg">{{ strtoupper($offre->type_contrat) }}</span>
                        </div>
                        @endif

                        @if($offre->ville)
                        <div class="flex items-center justify-between py-2 border-b border-gray-50">
                            <span class="text-xs font-semibold text-gray-500">Localisation</span>
                            <span class="text-xs font-extrabold text-gray-900">{{ $offre->ville }}</span>
                        </div>
                        @endif

                        @if($offre->salaire_min || $offre->salaire_max)
                        <div class="flex items-center justify-between py-2 border-b border-gray-50">
                            <span class="text-xs font-semibold text-gray-500">Salaire</span>
                            <span class="text-xs font-extrabold text-gray-900">
                                @if($offre->salaire_min && $offre->salaire_max)
                                    {{ number_format($offre->salaire_min, 0, ',', ' ') }} – {{ number_format($offre->salaire_max, 0, ',', ' ') }} FCFA
                                @elseif($offre->salaire_min)
                                    À partir de {{ number_format($offre->salaire_min, 0, ',', ' ') }} FCFA
                                @else
                                    Jusqu'à {{ number_format($offre->salaire_max, 0, ',', ' ') }} FCFA
                                @endif
                            </span>
                        </div>
                        @endif

                        @if($offre->annees_experience !== null)
                        <div class="flex items-center justify-between py-2 border-b border-gray-50">
                            <span class="text-xs font-semibold text-gray-500">Expérience</span>
                            <span class="text-xs font-extrabold text-gray-900">
                                {{ $offre->annees_experience == 0 ? 'Débutant accepté' : $offre->annees_experience . ' an(s) min.' }}
                            </span>
                        </div>
                        @endif

                        @if($offre->niveau_etude)
                        <div class="flex items-center justify-between py-2 border-b border-gray-50">
                            <span class="text-xs font-semibold text-gray-500">Niveau d'étude</span>
                            <span class="text-xs font-extrabold text-gray-900">{{ $offre->niveau_etude }}</span>
                        </div>
                        @endif

                        @if($offre->date_limite)
                        <div class="flex items-center justify-between py-2">
                            <span class="text-xs font-semibold text-gray-500">Date limite</span>
                            <span class="text-xs font-extrabold {{ $offre->date_limite->isPast() ? 'text-red-500' : 'text-gray-900' }}">
                                {{ $offre->date_limite->format('d/m/Y') }}
                                @if($offre->date_limite->isPast())
                                    <span class="text-xs text-red-400">(expirée)</span>
                                @endif
                            </span>
                        </div>
                        @endif

                    </div>
                </div>

                {{-- Actions rapides --}}
                <div class="bg-white border border-gray-200 rounded-2xl p-5 space-y-2">
                    <p class="text-xs font-extrabold text-gray-500 uppercase tracking-widest mb-3">Actions</p>

                    <a href="{{ route('entreprise.offres.edit', $offre->id) }}"
                       class="w-full flex items-center gap-3 px-4 py-3 rounded-xl border border-gray-200 text-gray-700 font-extrabold text-sm hover:border-yellow-400 hover:text-yellow-500 transition-all group">
                        <svg class="w-4 h-4 group-hover:text-yellow-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        Modifier l'offre
                    </a>

                    @if($offre->candidatures->count() > 0)
                    <a href="{{ route('entreprise.candidatures.offre', $offre->id) }}"
                       class="w-full flex items-center gap-3 px-4 py-3 rounded-xl border border-gray-200 text-gray-700 font-extrabold text-sm hover:border-yellow-400 hover:text-yellow-500 transition-all group">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        Voir toutes les candidatures
                        <span class="ml-auto px-2 py-0.5 bg-gray-100 text-gray-600 text-xs font-extrabold rounded-lg">{{ $offre->candidatures->count() }}</span>
                    </a>
                    @endif

                    @if($offre->statut === 'active')
                    <form action="{{ route('entreprise.offres.change-status', $offre->id) }}" method="POST">
                        @csrf @method('PATCH')
                        <input type="hidden" name="statut" value="fermee">
                        <button type="submit"
                                class="w-full flex items-center gap-3 px-4 py-3 rounded-xl border border-gray-200 text-gray-500 font-extrabold text-sm hover:border-gray-400 hover:text-gray-700 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
                            Fermer l'offre
                        </button>
                    </form>
                    @elseif($offre->statut === 'fermee')
                    <form action="{{ route('entreprise.offres.change-status', $offre->id) }}" method="POST">
                        @csrf @method('PATCH')
                        <input type="hidden" name="statut" value="active">
                        <button type="submit"
                                class="w-full flex items-center gap-3 px-4 py-3 rounded-xl border border-green-200 text-green-600 font-extrabold text-sm hover:bg-green-50 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Réactiver l'offre
                        </button>
                    </form>
                    @endif
                </div>

                {{-- Zone danger --}}
                <div class="bg-white border border-red-100 rounded-2xl p-5">
                    <!-- <p class="text-xs font-extrabold text-gray-500 uppercase tracking-widest mb-1">Zone de danger</p> -->
                    <!-- <p class="text-xs text-gray-400 mb-4 leading-relaxed">La suppression est irréversible. Les offres avec candidatures ne peuvent pas être supprimées.</p> -->
                    <form action="{{ route('entreprise.offres.destroy', $offre->id) }}" method="POST"
                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette offre ? Cette action est irréversible.')">
                        @csrf @method('DELETE')
                        <button type="submit"
                                class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-red-50 text-red-500 font-extrabold text-sm rounded-xl border border-red-200 hover:bg-red-100 hover:text-red-600 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            Supprimer l'offre
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection