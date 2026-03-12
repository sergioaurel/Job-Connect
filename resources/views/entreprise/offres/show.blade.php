@extends('layouts.app')

@section('title', $offre->titre . ' — Espace Entreprise')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-sm text-gray-500 mb-6">
            <a href="{{ route('entreprise.dashboard') }}" class="hover:text-blue-600 transition">Tableau de bord</a>
            <span>/</span>
            <a href="{{ route('entreprise.offres.index') }}" class="hover:text-blue-600 transition">Mes offres</a>
            <span>/</span>
            <span class="text-gray-800 font-medium">{{ $offre->titre }}</span>
        </nav>

        {{-- Messages flash --}}
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700 flex items-center gap-3">
                <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-red-700 flex items-center gap-3">
                <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Colonne principale --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- En-tête offre --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex-1">
                            <div class="flex flex-wrap items-center gap-2 mb-3">
                                {{-- Badge type --}}
                                @if($offre->type_offre === 'emploi')
                                    <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full uppercase tracking-wide">Emploi</span>
                                @elseif($offre->type_offre === 'stage_pro')
                                    <span class="px-3 py-1 bg-purple-100 text-purple-700 text-xs font-semibold rounded-full uppercase tracking-wide">Stage Pro</span>
                                @else
                                    <span class="px-3 py-1 bg-orange-100 text-orange-700 text-xs font-semibold rounded-full uppercase tracking-wide">Stage Académique</span>
                                @endif

                                {{-- Badge statut --}}
                                @if($offre->statut === 'active')
                                    <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full flex items-center gap-1">
                                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> Active
                                    </span>
                                @elseif($offre->statut === 'fermee')
                                    <span class="px-3 py-1 bg-gray-100 text-gray-600 text-xs font-semibold rounded-full flex items-center gap-1">
                                        <span class="w-1.5 h-1.5 bg-gray-400 rounded-full"></span> Fermée
                                    </span>
                                @else
                                    <span class="px-3 py-1 bg-yellow-100 text-yellow-700 text-xs font-semibold rounded-full flex items-center gap-1">
                                        <span class="w-1.5 h-1.5 bg-yellow-500 rounded-full"></span> Pourvue
                                    </span>
                                @endif
                            </div>

                            <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $offre->titre }}</h1>

                            <div class="flex flex-wrap gap-4 text-sm text-gray-500">
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    {{ $offre->ville ?? 'Non précisé' }}
                                </span>
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-5 5a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 10V5a2 2 0 012-2z"/>
                                    </svg>
                                    {{ $offre->categorie->nom ?? 'Non catégorisé' }}
                                </span>
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    {{ $offre->vues ?? 0 }} vue(s)
                                </span>
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    Publiée le {{ $offre->created_at->format('d/m/Y') }}
                                </span>
                            </div>
                        </div>

                        {{-- Actions --}}
                        <div class="flex flex-col gap-2 flex-shrink-0">
                            <a href="{{ route('entreprise.offres.edit', $offre->id) }}"
                               class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-xl hover:bg-blue-700 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Modifier
                            </a>

                            {{-- Changer le statut --}}
                            @if($offre->statut === 'active')
                                <form action="{{ route('entreprise.offres.change-status', $offre->id) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="statut" value="fermee">
                                    <button type="submit"
                                            class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-xl hover:bg-gray-200 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                                        </svg>
                                        Fermer
                                    </button>
                                </form>
                            @elseif($offre->statut === 'fermee')
                                <form action="{{ route('entreprise.offres.change-status', $offre->id) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="statut" value="active">
                                    <button type="submit"
                                            class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 bg-green-100 text-green-700 text-sm font-medium rounded-xl hover:bg-green-200 transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        Réactiver
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Description --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Description du poste
                    </h2>
                    <div class="prose prose-gray max-w-none text-gray-600 leading-relaxed">
                        {!! nl2br(e($offre->description)) !!}
                    </div>
                </div>

                {{-- Profil recherché --}}
                @if($offre->profil_recherche)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Profil recherché
                    </h2>
                    <div class="text-gray-600 leading-relaxed">
                        {!! nl2br(e($offre->profil_recherche)) !!}
                    </div>
                </div>
                @endif

                {{-- Candidatures reçues --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <div class="flex items-center justify-between mb-5">
                        <h2 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Candidatures reçues
                            <span class="ml-1 px-2.5 py-0.5 bg-blue-100 text-blue-700 text-sm font-bold rounded-full">
                                {{ $offre->candidatures->count() }}
                            </span>
                        </h2>
                        @if($offre->candidatures->count() > 0)
                            <a href="{{ route('entreprise.candidatures.offre', $offre->id) }}"
                               class="text-sm text-blue-600 hover:text-blue-700 font-medium transition">
                                Voir toutes →
                            </a>
                        @endif
                    </div>

                    @if($offre->candidatures->count() === 0)
                        <div class="text-center py-10 text-gray-400">
                            <svg class="w-12 h-12 mx-auto mb-3 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                            </svg>
                            <p class="font-medium">Aucune candidature reçue pour l'instant</p>
                            <p class="text-sm mt-1">Les candidatures apparaîtront ici dès qu'un candidat postulera.</p>
                        </div>
                    @else
                        <div class="space-y-3">
                            @foreach($offre->candidatures->take(5) as $candidature)
                            <div class="flex items-center justify-between p-4 rounded-xl border border-gray-100 hover:border-blue-200 hover:bg-blue-50/30 transition group">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                                        {{ strtoupper(substr($candidature->candidat->name ?? 'C', 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900 text-sm">{{ $candidature->candidat->name ?? 'Candidat inconnu' }}</p>
                                        <p class="text-xs text-gray-400">{{ $candidature->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    {{-- Badge statut candidature --}}
                                    @if($candidature->statut === 'en_attente')
                                        <span class="px-2.5 py-1 bg-yellow-100 text-yellow-700 text-xs font-medium rounded-full">En attente</span>
                                    @elseif($candidature->statut === 'vue')
                                        <span class="px-2.5 py-1 bg-blue-100 text-blue-700 text-xs font-medium rounded-full">Vue</span>
                                    @elseif($candidature->statut === 'retenue')
                                        <span class="px-2.5 py-1 bg-green-100 text-green-700 text-xs font-medium rounded-full">Retenue</span>
                                    @elseif($candidature->statut === 'rejetee')
                                        <span class="px-2.5 py-1 bg-red-100 text-red-700 text-xs font-medium rounded-full">Rejetée</span>
                                    @endif

                                    <a href="{{ route('entreprise.candidatures.show', $candidature->id) }}"
                                       class="opacity-0 group-hover:opacity-100 transition px-3 py-1.5 bg-blue-600 text-white text-xs font-medium rounded-lg">
                                        Voir
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>

            </div>

            {{-- Colonne latérale --}}
            <div class="space-y-6">

                {{-- Informations clés --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-base font-semibold text-gray-900 mb-4">Informations clés</h2>
                    <dl class="space-y-3">

                        @if($offre->contrat)
                        <div class="flex justify-between items-center py-2 border-b border-gray-50">
                            <dt class="text-sm text-gray-500">Type de contrat</dt>
                            <dd class="text-sm font-medium text-gray-900">{{ strtoupper($offre->contrat) }}</dd>
                        </div>
                        @endif

                        @if($offre->ville)
                        <div class="flex justify-between items-center py-2 border-b border-gray-50">
                            <dt class="text-sm text-gray-500">Localisation</dt>
                            <dd class="text-sm font-medium text-gray-900">{{ $offre->ville }}</dd>
                        </div>
                        @endif

                        @if($offre->salaire_min || $offre->salaire_max)
                        <div class="flex justify-between items-center py-2 border-b border-gray-50">
                            <dt class="text-sm text-gray-500">Salaire</dt>
                            <dd class="text-sm font-medium text-gray-900">
                                @if($offre->salaire_min && $offre->salaire_max)
                                    {{ number_format($offre->salaire_min, 0, ',', ' ') }} – {{ number_format($offre->salaire_max, 0, ',', ' ') }} FCFA
                                @elseif($offre->salaire_min)
                                    À partir de {{ number_format($offre->salaire_min, 0, ',', ' ') }} FCFA
                                @else
                                    Jusqu'à {{ number_format($offre->salaire_max, 0, ',', ' ') }} FCFA
                                @endif
                            </dd>
                        </div>
                        @endif

                        @if($offre->experience_requise !== null)
                        <div class="flex justify-between items-center py-2 border-b border-gray-50">
                            <dt class="text-sm text-gray-500">Expérience</dt>
                            <dd class="text-sm font-medium text-gray-900">
                                {{ $offre->experience_requise == 0 ? 'Débutant accepté' : $offre->experience_requise . ' an(s) min.' }}
                            </dd>
                        </div>
                        @endif

                        @if($offre->niveau_etude)
                        <div class="flex justify-between items-center py-2 border-b border-gray-50">
                            <dt class="text-sm text-gray-500">Niveau d'étude</dt>
                            <dd class="text-sm font-medium text-gray-900">{{ $offre->niveau_etude }}</dd>
                        </div>
                        @endif

                        @if($offre->date_limite)
                        <div class="flex justify-between items-center py-2">
                            <dt class="text-sm text-gray-500">Date limite</dt>
                            <dd class="text-sm font-medium {{ $offre->date_limite->isPast() ? 'text-red-600' : 'text-gray-900' }}">
                                {{ $offre->date_limite->format('d/m/Y') }}
                                @if($offre->date_limite->isPast())
                                    <span class="text-xs text-red-500">(expirée)</span>
                                @endif
                            </dd>
                        </div>
                        @endif

                    </dl>
                </div>

                {{-- Statistiques rapides --}}
                <div class="bg-gradient-to-br from-blue-600 to-blue-700 rounded-2xl p-6 text-white">
                    <h2 class="text-base font-semibold mb-4 opacity-90">Statistiques</h2>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-white/10 rounded-xl p-3 text-center">
                            <p class="text-2xl font-bold">{{ $offre->candidatures->count() }}</p>
                            <p class="text-xs opacity-75 mt-0.5">Candidature(s)</p>
                        </div>
                        <div class="bg-white/10 rounded-xl p-3 text-center">
                            <p class="text-2xl font-bold">{{ $offre->vues ?? 0 }}</p>
                            <p class="text-xs opacity-75 mt-0.5">Vue(s)</p>
                        </div>
                        <div class="bg-white/10 rounded-xl p-3 text-center">
                            <p class="text-2xl font-bold">
                                {{ $offre->candidatures->where('statut', 'retenue')->count() }}
                            </p>
                            <p class="text-xs opacity-75 mt-0.5">Retenue(s)</p>
                        </div>
                        <div class="bg-white/10 rounded-xl p-3 text-center">
                            <p class="text-2xl font-bold">
                                {{ $offre->candidatures->where('statut', 'en_attente')->count() }}
                            </p>
                            <p class="text-xs opacity-75 mt-0.5">En attente</p>
                        </div>
                    </div>
                </div>

                {{-- Actions danger --}}
                <div class="bg-white rounded-2xl shadow-sm border border-red-100 p-6">
                    <h2 class="text-base font-semibold text-gray-900 mb-3">Zone de danger</h2>
                    <p class="text-xs text-gray-400 mb-4">La suppression est irréversible. Les offres avec candidatures ne peuvent pas être supprimées.</p>
                    <form action="{{ route('entreprise.offres.destroy', $offre->id) }}" method="POST"
                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette offre ? Cette action est irréversible.')">
                        @csrf @method('DELETE')
                        <button type="submit"
                                class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-red-50 text-red-600 text-sm font-medium rounded-xl border border-red-200 hover:bg-red-100 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Supprimer l'offre
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection