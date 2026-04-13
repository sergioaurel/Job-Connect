@extends('layouts.app')

@section('title', 'Espace Entreprise — JobConnect')

@section('content')

{{-- ══════════════════════════════════
     HEADER
══════════════════════════════════ --}}
<div class="bg-gray-950 border-b border-white/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex items-center justify-between gap-4 mb-6">
            <div>
                <p class="text-yellow-400 text-xs font-extrabold tracking-widest uppercase mb-1">Espace Entreprise</p>
                <h1 class="text-white font-extrabold text-2xl" style="letter-spacing:-0.02em">
                    {{ $entreprise->nom_entreprise ?? 'Mon espace' }}
                </h1>
            </div>
            @if($entreprise && $entreprise->isValidee())
            <a href="{{ route('entreprise.offres.create') }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 bg-yellow-400 text-gray-900 font-extrabold text-sm rounded-xl hover:bg-yellow-300 transition-colors flex-shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                </svg>
                <span class="hidden sm:inline">Nouvelle offre</span>
                <span class="sm:hidden">Publier</span>
            </a>
            @endif
        </div>

        {{-- Navigation tabs --}}
        <nav class="flex gap-1 overflow-x-auto pb-1">
            @foreach([
                ['label' => 'Tableau de bord', 'route' => 'entreprise.dashboard',        'active' => true],
                ['label' => 'Mon profil',       'route' => 'entreprise.profil.edit',      'active' => false],
                ['label' => 'Mes offres',        'route' => 'entreprise.offres.index',     'active' => false],
                ['label' => 'Candidatures',      'route' => 'entreprise.candidatures.index','active' => false],
            ] as $tab)
            <a href="{{ route($tab['route']) }}"
               class="whitespace-nowrap px-4 py-2 rounded-lg text-sm font-bold transition-colors flex-shrink-0
                      {{ $tab['active'] ? 'bg-yellow-400 text-gray-900' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                {{ $tab['label'] }}
            </a>
            @endforeach
        </nav>
    </div>
</div>

<div class="bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        @if($entreprise)

        {{-- ── BANNIÈRE STATUT ── --}}
        @if($entreprise->statut === 'en_attente')
        <div class="mb-6 bg-yellow-50 border border-yellow-200 rounded-2xl p-5">
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 bg-yellow-100 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-yellow-800 font-extrabold text-sm">⏳ Compte en attente de vérification</p>
                    <p class="text-yellow-700 text-xs mt-1">Votre profil est en cours d'examen par notre équipe. Vous serez notifié dès validation.</p>
                </div>
            </div>
        </div>

        @elseif($entreprise->statut === 'rejetee')
        <div class="mb-6 flex items-start gap-4 bg-red-50 border border-red-200 rounded-2xl p-5">
            <div class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-red-800 font-extrabold text-sm">❌ Profil rejeté</p>
                <p class="text-red-700 text-xs mt-1">Votre demande a été rejetée par notre équipe. Veuillez mettre à jour votre profil et resoumettre.</p>
            </div>
        </div>
        @endif

        {{-- ── STATS ── --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            @foreach([
                ['label' => 'Total offres',    'value' => $stats['total_offres'],            'icon' => 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'color' => 'text-blue-500',   'bg' => 'bg-blue-50'],
                ['label' => 'Offres actives',  'value' => $stats['offres_actives'],          'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',                                                                                                                                                                                                                                                   'color' => 'text-green-500',  'bg' => 'bg-green-50'],
                ['label' => 'Candidatures',    'value' => $stats['total_candidatures'],      'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z', 'color' => 'text-purple-500', 'bg' => 'bg-purple-50'],
                ['label' => 'En attente',      'value' => $stats['candidatures_en_attente'], 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',                                                                                                                                                                                                                                                   'color' => 'text-yellow-500', 'bg' => 'bg-yellow-50'],
            ] as $stat)
            <div class="bg-white border border-gray-200 rounded-2xl p-5">
                <div class="flex items-start justify-between gap-2 mb-3">
                    <p class="text-xs text-gray-500 font-semibold">{{ $stat['label'] }}</p>
                    <div class="w-8 h-8 {{ $stat['bg'] }} rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 {{ $stat['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $stat['icon'] }}"/>
                        </svg>
                    </div>
                </div>
                <p class="text-3xl font-extrabold text-gray-900" style="letter-spacing:-0.03em">{{ $stat['value'] }}</p>
            </div>
            @endforeach
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- ── MES DERNIÈRES OFFRES ── --}}
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                    <h2 class="text-sm font-extrabold text-gray-900">Mes dernières offres</h2>
                    <a href="{{ route('entreprise.offres.index') }}"
                       class="text-xs text-yellow-500 font-bold hover:text-yellow-400 transition-colors">
                        Voir tout →
                    </a>
                </div>
                <div class="divide-y divide-gray-100">
                    @forelse($offres as $offre)
                    <div class="p-5">
                        <div class="flex items-start justify-between gap-3 mb-2">
                            <p class="text-sm font-bold text-gray-900 leading-snug">{{ $offre->titre }}</p>
                            <span class="px-2 py-0.5 text-xs font-extrabold rounded-full flex-shrink-0
                                @if($offre->statut === 'active')  bg-green-50 text-green-700 border border-green-200
                                @elseif($offre->statut === 'fermee') bg-gray-100 text-gray-500 border border-gray-200
                                @else bg-yellow-50 text-yellow-700 border border-yellow-200
                                @endif">
                                {{ ucfirst($offre->statut) }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3 text-xs text-gray-400">
                                <span class="flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    {{ $offre->candidatures_count }} candidature(s)
                                </span>
                                <span>{{ $offre->created_at->diffForHumans() }}</span>
                            </div>
                            <a href="{{ route('entreprise.offres.show', $offre->id) }}"
                               class="text-xs font-extrabold text-yellow-500 hover:text-yellow-400 transition-colors flex items-center gap-1">
                                Voir
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    @empty
                    <div class="p-10 text-center">
                        <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <p class="text-sm font-semibold text-gray-900 mb-1">Aucune offre publiée</p>
                        @if($entreprise->isValidee())
                        <a href="{{ route('entreprise.offres.create') }}"
                           class="text-xs font-bold text-yellow-500 hover:text-yellow-400 transition-colors">
                            Publier votre première offre →
                        </a>
                        @endif
                    </div>
                    @endforelse
                </div>
            </div>

            {{-- ── DERNIÈRES CANDIDATURES ── --}}
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                    <h2 class="text-sm font-extrabold text-gray-900">Dernières candidatures</h2>
                    <a href="{{ route('entreprise.candidatures.index') }}"
                       class="text-xs text-yellow-500 font-bold hover:text-yellow-400 transition-colors">
                        Voir tout →
                    </a>
                </div>
                <div class="divide-y divide-gray-100">
                    @forelse($candidatures as $candidature)
                    <a href="{{ route('entreprise.candidatures.show', $candidature->id) }}"
                       class="flex items-center gap-3 p-5 hover:bg-gray-50 transition-colors group">
                        <div class="w-9 h-9 rounded-full bg-gray-900 flex items-center justify-center text-white font-extrabold text-sm flex-shrink-0">
                            {{ strtoupper(substr($candidature->candidat->name, 0, 1)) }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-bold text-gray-900 group-hover:text-yellow-500 transition-colors">{{ $candidature->candidat->name }}</p>
                            <p class="text-xs text-gray-400 truncate mt-0.5">{{ $candidature->offre->titre }}</p>
                        </div>
                        <div class="flex flex-col items-end gap-1 flex-shrink-0">
                            <span class="px-2 py-0.5 text-xs font-extrabold rounded-full
                                @if($candidature->statut === 'en_attente') bg-gray-100 text-gray-600
                                @elseif($candidature->statut === 'vue')      bg-blue-50 text-blue-600
                                @elseif($candidature->statut === 'retenue')  bg-green-50 text-green-700
                                @else bg-red-50 text-red-600
                                @endif">
                                {{ ucfirst(str_replace('_', ' ', $candidature->statut)) }}
                            </span>
                            <span class="text-xs text-gray-400">{{ $candidature->created_at->diffForHumans() }}</span>
                        </div>
                    </a>
                    @empty
                    <div class="p-10 text-center">
                        <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <p class="text-sm font-semibold text-gray-900">Aucune candidature reçue</p>
                    </div>
                    @endforelse
                </div>
            </div>

        </div>
        @endif
    </div>
</div>

@endsection