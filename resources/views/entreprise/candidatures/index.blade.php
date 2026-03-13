@extends('layouts.app')

@section('title', 'Candidatures reçues — Espace Entreprise')

@section('content')

<div class="bg-gray-950 border-b border-white/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-6">
            <p class="text-yellow-400 text-xs font-extrabold tracking-widest uppercase mb-1">Espace Entreprise</p>
            <h1 class="text-white font-extrabold text-2xl" style="letter-spacing:-0.02em">Candidatures reçues</h1>
            <p class="text-gray-500 text-sm mt-1">{{ $candidatures->total() }} candidature(s)</p>
        </div>

        <nav class="flex gap-1 overflow-x-auto pb-1">
            @foreach([
                ['label' => 'Tableau de bord', 'route' => 'entreprise.dashboard',          'active' => false],
                ['label' => 'Mon profil',       'route' => 'entreprise.profil.edit',        'active' => false],
                ['label' => 'Mes offres',        'route' => 'entreprise.offres.index',       'active' => false],
                ['label' => 'Candidatures',      'route' => 'entreprise.candidatures.index', 'active' => true],
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

        {{-- ── FILTRES ── --}}
        <form action="{{ route('entreprise.candidatures.index') }}" method="GET"
              class="bg-white border border-gray-200 rounded-2xl p-4 mb-6 flex flex-col sm:flex-row gap-3">
            <select name="statut"
                    class="flex-1 py-2.5 px-3 text-sm rounded-xl border border-gray-200 bg-gray-50 text-gray-900 focus:outline-none focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 transition-all appearance-none">
                <option value="">Tous les statuts</option>
                <option value="en_attente" {{ request('statut') == 'en_attente' ? 'selected' : '' }}>En attente</option>
                <option value="vue"        {{ request('statut') == 'vue'        ? 'selected' : '' }}>Vue</option>
                <option value="retenue"    {{ request('statut') == 'retenue'    ? 'selected' : '' }}>Retenue</option>
                <option value="rejetee"    {{ request('statut') == 'rejetee'    ? 'selected' : '' }}>Rejetée</option>
            </select>

            <select name="offre_id"
                    class="flex-1 py-2.5 px-3 text-sm rounded-xl border border-gray-200 bg-gray-50 text-gray-900 focus:outline-none focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 transition-all appearance-none">
                <option value="">Toutes les offres</option>
                @foreach($offres as $offre)
                <option value="{{ $offre->id }}" {{ request('offre_id') == $offre->id ? 'selected' : '' }}>
                    {{ $offre->titre }}
                </option>
                @endforeach
            </select>

            <div class="flex gap-2">
                <button type="submit"
                        class="flex-1 sm:flex-none px-5 py-2.5 bg-gray-900 text-white text-sm font-extrabold rounded-xl hover:bg-yellow-400 hover:text-gray-900 transition-all">
                    Filtrer
                </button>
                @if(request('statut') || request('offre_id'))
                <a href="{{ route('entreprise.candidatures.index') }}"
                   class="px-4 py-2.5 border border-gray-200 text-gray-600 text-sm font-bold rounded-xl hover:border-gray-400 transition-all">
                    Effacer
                </a>
                @endif
            </div>
        </form>

        {{-- ── LISTE ── --}}
        @if($candidatures->count() > 0)

        <div class="space-y-3">
            @foreach($candidatures as $candidature)
            <a href="{{ route('entreprise.candidatures.show', $candidature->id) }}"
               class="block bg-white border border-gray-200 rounded-2xl p-5 hover:border-yellow-400 hover:shadow-sm transition-all group">

                <div class="flex items-start gap-4">
                    {{-- Avatar --}}
                    <div class="w-11 h-11 rounded-full bg-gray-900 flex items-center justify-center text-white font-extrabold text-base flex-shrink-0 group-hover:bg-yellow-400 group-hover:text-gray-900 transition-colors">
                        {{ strtoupper(substr($candidature->candidat->name, 0, 1)) }}
                    </div>

                    {{-- Infos principale --}}
                    <div class="min-w-0 flex-1">
                        <div class="flex items-start justify-between gap-3 mb-1">
                            <p class="text-sm font-extrabold text-gray-900 group-hover:text-yellow-500 transition-colors leading-snug">
                                {{ $candidature->candidat->name }}
                            </p>
                            {{-- Badge statut --}}
                            @php
                                $statutConfig = [
                                    'en_attente' => ['bg' => 'bg-gray-100',   'text' => 'text-gray-600',   'border' => 'border-gray-200',   'label' => 'En attente'],
                                    'vue'        => ['bg' => 'bg-blue-50',    'text' => 'text-blue-600',   'border' => 'border-blue-100',   'label' => 'Vue'],
                                    'retenue'    => ['bg' => 'bg-green-50',   'text' => 'text-green-700',  'border' => 'border-green-200',  'label' => 'Retenue'],
                                    'rejetee'    => ['bg' => 'bg-red-50',     'text' => 'text-red-600',    'border' => 'border-red-100',    'label' => 'Rejetée'],
                                ];
                                $sc = $statutConfig[$candidature->statut] ?? $statutConfig['en_attente'];
                            @endphp
                            <span class="px-2.5 py-0.5 {{ $sc['bg'] }} {{ $sc['text'] }} border {{ $sc['border'] }} text-xs font-extrabold rounded-full flex-shrink-0">
                                {{ $sc['label'] }}
                            </span>
                        </div>

                        {{-- Offre --}}
                        <p class="text-xs text-gray-500 mb-3 truncate">
                            <span class="text-gray-400">Pour :</span>
                            <span class="font-semibold text-gray-700">{{ $candidature->offre->titre }}</span>
                        </p>

                        {{-- Métas --}}
                        <div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-xs text-gray-400">
                            <span class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Reçue le {{ $candidature->created_at->format('d/m/Y') }}
                            </span>
                            @if($candidature->vue_le)
                            <span class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                Vue le {{ $candidature->vue_le->format('d/m/Y') }}
                            </span>
                            @endif
                        </div>
                    </div>

                    {{-- Flèche --}}
                    <svg class="w-4 h-4 text-gray-300 group-hover:text-yellow-400 flex-shrink-0 mt-1 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
            </a>
            @endforeach
        </div>

        @if($candidatures->hasPages())
        <div class="mt-6">{{ $candidatures->withQueryString()->links() }}</div>
        @endif

        @else
        <div class="bg-white border border-gray-200 rounded-2xl p-16 text-center">
            <div class="w-14 h-14 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-7 h-7 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <p class="text-gray-900 font-bold text-lg mb-2">Aucune candidature reçue</p>
            <p class="text-gray-400 text-sm">
                @if(request('statut') || request('offre_id'))
                    Aucune candidature ne correspond à vos filtres.
                @else
                    Les candidatures apparaîtront ici dès qu'un candidat postulera à l'une de vos offres.
                @endif
            </p>
            @if(request('statut') || request('offre_id'))
            <a href="{{ route('entreprise.candidatures.index') }}"
               class="inline-flex items-center gap-2 mt-6 px-5 py-2.5 bg-gray-900 text-white font-bold rounded-xl text-sm hover:bg-yellow-400 hover:text-gray-900 transition-all">
                Effacer les filtres
            </a>
            @endif
        </div>
        @endif

    </div>
</div>

@endsection