@extends('layouts.app')

@section('title', 'Candidatures — ' . $offre->titre)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-sm text-gray-500 mb-8">
        <a href="{{ route('entreprise.dashboard') }}" class="hover:text-gray-900 transition-colors">Tableau de bord</a>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <a href="{{ route('entreprise.offres.index') }}" class="hover:text-gray-900 transition-colors">Mes offres</a>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <a href="{{ route('entreprise.offres.show', $offre->id) }}" class="hover:text-gray-900 transition-colors truncate max-w-xs">{{ $offre->titre }}</a>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="text-gray-900 font-medium">Candidatures</span>
    </nav>

    {{-- En-tête offre --}}
    <div class="bg-white border border-gray-200 rounded-2xl p-6 mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-xl bg-gray-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <div class="flex items-center gap-2 flex-wrap mb-1">
                        <h1 class="text-xl font-bold text-gray-900">{{ $offre->titre }}</h1>
                        @if($offre->statut === 'active')
                            <span class="px-2.5 py-0.5 bg-green-50 text-green-600 text-xs font-bold rounded-full">Active</span>
                        @elseif($offre->statut === 'fermee')
                            <span class="px-2.5 py-0.5 bg-gray-100 text-gray-500 text-xs font-bold rounded-full">Fermée</span>
                        @else
                            <span class="px-2.5 py-0.5 bg-yellow-50 text-yellow-600 text-xs font-bold rounded-full">{{ ucfirst($offre->statut) }}</span>
                        @endif
                    </div>
                    <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500">
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                            {{ $offre->ville ?? 'Bénin' }}
                        </span>
                        @if($offre->type_contrat)
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            {{ $offre->type_contrat }}
                        </span>
                        @endif
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            Publiée {{ $offre->created_at->diffForHumans() }}
                        </span>
                    </div>
                </div>
            </div>
            <a href="{{ route('entreprise.offres.show', $offre->id) }}"
               class="flex items-center gap-2 px-4 py-2 border border-gray-200 text-gray-700 text-sm font-medium rounded-xl hover:bg-gray-50 transition-colors whitespace-nowrap">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                Voir l'offre
            </a>
        </div>
    </div>

    {{-- Stats rapides --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8">
        @php
        $total      = $candidatures->total();
        $enAttente  = $offre->candidatures->where('statut', 'en_attente')->count();
        $retenues   = $offre->candidatures->where('statut', 'retenue')->count();
        $rejetees   = $offre->candidatures->where('statut', 'rejetee')->count();
        @endphp
        @foreach([
            ['label' => 'Total', 'count' => $total, 'color' => 'text-gray-900', 'bg' => 'bg-gray-50', 'border' => 'border-gray-200'],
            ['label' => 'En attente', 'count' => $enAttente, 'color' => 'text-yellow-600', 'bg' => 'bg-yellow-50', 'border' => 'border-yellow-200'],
            ['label' => 'Retenues', 'count' => $retenues, 'color' => 'text-green-600', 'bg' => 'bg-green-50', 'border' => 'border-green-200'],
            ['label' => 'Rejetées', 'count' => $rejetees, 'color' => 'text-red-500', 'bg' => 'bg-red-50', 'border' => 'border-red-200'],
        ] as $stat)
        <div class="rounded-2xl border {{ $stat['border'] }} {{ $stat['bg'] }} p-5 text-center">
            <p class="text-3xl font-extrabold {{ $stat['color'] }}">{{ $stat['count'] }}</p>
            <p class="text-xs text-gray-500 mt-1 font-medium">{{ $stat['label'] }}</p>
        </div>
        @endforeach
    </div>

    {{-- Liste des candidatures --}}
    <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <h2 class="text-base font-bold text-gray-900">
                Liste des candidatures
                <span class="ml-2 px-2 py-0.5 bg-gray-100 text-gray-600 text-xs font-semibold rounded-full">{{ $candidatures->total() }}</span>
            </h2>
        </div>

        @if($candidatures->isEmpty())
        <div class="text-center py-20">
            <svg class="w-12 h-12 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <p class="text-gray-900 font-semibold mb-1">Aucune candidature reçue</p>
            <p class="text-gray-400 text-sm">Les candidatures s'afficheront ici dès que des candidats postuleront.</p>
        </div>
        @else
        <div class="divide-y divide-gray-100">
            @foreach($candidatures as $candidature)
            <div class="px-6 py-5 hover:bg-gray-50 transition-colors">
                <div class="flex items-center justify-between gap-4">
                    <div class="flex items-center gap-4 min-w-0">
                        {{-- Avatar initiale --}}
                        <div class="w-10 h-10 rounded-full bg-gray-900 text-white flex items-center justify-center flex-shrink-0 text-sm font-bold">
                            {{ strtoupper(substr($candidature->candidat->name ?? 'C', 0, 1)) }}
                        </div>

                        {{-- Infos candidat --}}
                        <div class="min-w-0">
                            <p class="text-sm font-bold text-gray-900 truncate">{{ $candidature->candidat->name ?? 'Candidat inconnu' }}</p>
                            <p class="text-xs text-gray-500 truncate">{{ $candidature->candidat->email ?? '' }}</p>
                            <p class="text-xs text-gray-400 mt-0.5">Postulé {{ $candidature->created_at->diffForHumans() }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 flex-shrink-0">
                        {{-- Badge statut --}}
                        @if($candidature->statut === 'en_attente')
                            <span class="px-2.5 py-1 bg-yellow-50 text-yellow-600 text-xs font-bold rounded-full whitespace-nowrap">En attente</span>
                        @elseif($candidature->statut === 'vue')
                            <span class="px-2.5 py-1 bg-blue-50 text-blue-600 text-xs font-bold rounded-full whitespace-nowrap">Vue</span>
                        @elseif($candidature->statut === 'retenue')
                            <span class="px-2.5 py-1 bg-green-50 text-green-600 text-xs font-bold rounded-full whitespace-nowrap">Retenue</span>
                        @elseif($candidature->statut === 'rejetee')
                            <span class="px-2.5 py-1 bg-red-50 text-red-500 text-xs font-bold rounded-full whitespace-nowrap">Rejetée</span>
                        @else
                            <span class="px-2.5 py-1 bg-gray-100 text-gray-500 text-xs font-bold rounded-full whitespace-nowrap">{{ ucfirst($candidature->statut) }}</span>
                        @endif

                        {{-- Bouton voir --}}
                        <a href="{{ route('entreprise.candidatures.show', $candidature->id) }}"
                           class="flex items-center gap-1.5 px-4 py-2 bg-gray-900 text-white text-xs font-bold rounded-xl hover:bg-yellow-400 hover:text-gray-900 transition-all whitespace-nowrap">
                            Voir le dossier
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($candidatures->hasPages())
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $candidatures->withQueryString()->links() }}
        </div>
        @endif
        @endif
    </div>

</div>
@endsection