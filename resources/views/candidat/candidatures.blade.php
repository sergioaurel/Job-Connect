@extends('layouts.app')

@section('title', 'Mes candidatures')

@section('content')

{{-- ═══════════════════════════════════════
     HEADER ESPACE CANDIDAT
═══════════════════════════════════════ --}}
<div class="bg-gray-950 border-b border-white/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 pb-0">
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-6">
            <div>
                <p class="text-yellow-400 text-xs font-extrabold tracking-widest uppercase mb-1">Espace Candidat</p>
                <h1 class="text-white font-extrabold text-2xl sm:text-3xl" style="letter-spacing:-0.02em">
                    Mes candidatures
                </h1>
                <p class="text-gray-500 text-sm mt-1">{{ $candidatures->total() }} candidature(s) envoyée(s)</p>
            </div>
        </div>
        {{-- Navigation tabs --}}
        <nav class="flex gap-1 overflow-x-auto scrollbar-hide">
            @php
            $tabs = [
                ['route' => 'candidat.dashboard',     'label' => 'Tableau de bord', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                ['route' => 'candidat.profil',        'label' => 'Mon profil',       'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'],
                ['route' => 'candidat.candidatures',  'label' => 'Candidatures',     'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
                ['route' => 'candidat.favoris',       'label' => 'Favoris',          'icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z'],
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

{{-- ═══════════════════════════════════════
     CONTENU
═══════════════════════════════════════ --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    @forelse($candidatures as $candidature)
    @php
    $statutConfig = [
        'en_attente' => ['bg' => 'bg-orange-50',  'text' => 'text-orange-600',  'border' => 'border-orange-200', 'label' => '⏳ En attente'],
        'vue'        => ['bg' => 'bg-blue-50',    'text' => 'text-blue-600',    'border' => 'border-blue-200',   'label' => '👁 Vue'],
        'retenue'    => ['bg' => 'bg-green-50',   'text' => 'text-green-600',   'border' => 'border-green-200',  'label' => '✓ Retenue'],
        'refusee'    => ['bg' => 'bg-red-50',     'text' => 'text-red-500',     'border' => 'border-red-200',    'label' => '✕ Refusée'],
    ];
    $cfg = $statutConfig[$candidature->statut] ?? ['bg'=>'bg-gray-100','text'=>'text-gray-600','border'=>'border-gray-200','label'=>ucfirst($candidature->statut)];
    @endphp
    <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden mb-4 hover:border-yellow-300 hover:shadow-sm transition-all">

        {{-- Desktop --}}
        <div class="hidden md:flex items-start gap-5 p-6">
            {{-- Initiale entreprise --}}
            <div class="w-12 h-12 rounded-xl bg-gray-100 flex items-center justify-center flex-shrink-0 text-gray-900 font-extrabold text-base">
                {{ strtoupper(substr($candidature->offre->entreprise->nom_entreprise, 0, 1)) }}
            </div>
            <div class="flex-1 min-w-0">
                <div class="flex items-start justify-between gap-4 mb-2">
                    <div>
                        <a href="{{ route('offres.show', $candidature->offre->slug) }}"
                           class="text-gray-900 font-extrabold text-base hover:text-yellow-500 transition-colors">
                            {{ $candidature->offre->titre }}
                        </a>
                        <p class="text-gray-500 text-sm mt-0.5">{{ $candidature->offre->entreprise->nom_entreprise }}</p>
                    </div>
                    <span class="flex-shrink-0 px-3 py-1.5 text-xs font-extrabold rounded-xl border {{ $cfg['bg'] }} {{ $cfg['text'] }} {{ $cfg['border'] }}">
                        {{ $cfg['label'] }}
                    </span>
                </div>
                <div class="flex flex-wrap items-center gap-x-5 gap-y-1 text-xs text-gray-400">
                    <span class="flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                        {{ $candidature->offre->ville ?? 'Bénin' }}
                    </span>
                    <span class="flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Postulé le {{ $candidature->created_at->format('d/m/Y') }}
                    </span>
                    @if($candidature->vue_le)
                    <span class="flex items-center gap-1 text-blue-500">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        Vue le {{ $candidature->vue_le->format('d/m/Y') }}
                    </span>
                    @endif
                </div>
                @if($candidature->note_recruteur)
                <div class="mt-4 p-4 bg-gray-50 rounded-xl border border-gray-100">
                    <p class="text-gray-900 font-bold text-xs mb-1">💬 Note du recruteur</p>
                    <p class="text-gray-600 text-sm">{{ $candidature->note_recruteur }}</p>
                </div>
                @endif
            </div>
        </div>

        {{-- Mobile --}}
        <div class="md:hidden p-5">
            <div class="flex items-start justify-between gap-3 mb-3">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center flex-shrink-0 text-gray-900 font-extrabold text-sm">
                        {{ strtoupper(substr($candidature->offre->entreprise->nom_entreprise, 0, 1)) }}
                    </div>
                    <div>
                        <a href="{{ route('offres.show', $candidature->offre->slug) }}"
                           class="text-gray-900 font-extrabold text-sm leading-snug hover:text-yellow-500 transition-colors block">
                            {{ $candidature->offre->titre }}
                        </a>
                        <p class="text-gray-500 text-xs">{{ $candidature->offre->entreprise->nom_entreprise }}</p>
                    </div>
                </div>
                <span class="flex-shrink-0 px-2.5 py-1 text-xs font-extrabold rounded-lg border {{ $cfg['bg'] }} {{ $cfg['text'] }} {{ $cfg['border'] }}">
                    {{ $cfg['label'] }}
                </span>
            </div>
            <div class="flex flex-wrap gap-x-4 gap-y-1 text-xs text-gray-400 pl-13">
                <span>📍 {{ $candidature->offre->ville ?? 'Bénin' }}</span>
                <span>📅 {{ $candidature->created_at->format('d/m/Y') }}</span>
            </div>
            @if($candidature->note_recruteur)
            <div class="mt-3 p-3 bg-gray-50 rounded-xl border border-gray-100">
                <p class="text-gray-900 font-bold text-xs mb-1">💬 Note du recruteur</p>
                <p class="text-gray-600 text-xs">{{ $candidature->note_recruteur }}</p>
            </div>
            @endif
        </div>
    </div>
    @empty
    <div class="bg-white border border-gray-200 rounded-2xl py-20 text-center">
        <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
        </div>
        <p class="text-gray-900 font-extrabold text-lg mb-2">Aucune candidature envoyée</p>
        <p class="text-gray-500 text-sm mb-6 max-w-xs mx-auto">Parcourez les offres disponibles et postulez en un clic</p>
        <a href="{{ route('offres.index') }}"
           class="inline-flex items-center gap-2 px-6 py-3 bg-gray-900 text-white font-extrabold text-sm rounded-xl hover:bg-yellow-400 hover:text-gray-900 transition-all">
            Voir les offres
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
        </a>
    </div>
    @endforelse

    {{-- Pagination --}}
    @if($candidatures->hasPages())
    <div class="mt-8">
        {{ $candidatures->links() }}
    </div>
    @endif

</div>
@endsection