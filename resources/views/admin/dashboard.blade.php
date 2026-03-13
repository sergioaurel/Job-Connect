@extends('layouts.app')

@section('title', 'Administration — JobConnect')

@section('content')

{{-- ══════════════════════════════════
     HEADER ADMIN
══════════════════════════════════ --}}
<div class="bg-gray-950 border-b border-white/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex items-center justify-between gap-4">
            <div>
                <p class="text-yellow-400 text-xs font-extrabold tracking-widest uppercase mb-1">Espace Admin</p>
                <h1 class="text-white font-extrabold text-2xl" style="letter-spacing:-0.02em">Tableau de bord</h1>
            </div>
            @if($stats['entreprises_en_attente'] > 0)
            <div class="flex items-center gap-2 px-3 py-2 rounded-xl bg-yellow-400/10 border border-yellow-400/25">
                <span class="w-2 h-2 rounded-full bg-yellow-400 animate-pulse inline-block"></span>
                <span class="text-yellow-400 text-xs font-extrabold">{{ $stats['entreprises_en_attente'] }} en attente</span>
            </div>
            @endif
        </div>

        {{-- Navigation tabs --}}
        <nav class="flex gap-1 mt-6 overflow-x-auto pb-1">
            @foreach([
                ['label' => 'Tableau de bord', 'route' => 'admin.dashboard',     'active' => true],
                ['label' => 'Entreprises',      'route' => 'admin.entreprises.index', 'active' => false],
                ['label' => 'Statistiques',     'route' => 'admin.statistiques',  'active' => false],
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

        {{-- ── STATS ── --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            @foreach([
                ['label' => 'Utilisateurs',  'value' => $stats['total_utilisateurs'], 'sub' => $stats['total_candidats'].' candidats',    'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z', 'color' => 'text-blue-500',   'bg' => 'bg-blue-50'],
                ['label' => 'Entreprises',   'value' => $stats['total_entreprises'],  'sub' => $stats['entreprises_en_attente'] > 0 ? $stats['entreprises_en_attente'].' en attente' : 'Toutes validées', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4', 'color' => 'text-purple-500', 'bg' => 'bg-purple-50'],
                ['label' => 'Offres actives','value' => $stats['offres_actives'],     'sub' => $stats['total_offres'].' au total',         'icon' => 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'color' => 'text-green-500',  'bg' => 'bg-green-50'],
                ['label' => 'Candidatures',  'value' => $stats['total_candidatures'],'sub' => $stats['candidatures_mois'].' ce mois',     'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', 'color' => 'text-yellow-500',  'bg' => 'bg-yellow-50'],
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
                <p class="text-xs text-gray-400 mt-1">{{ $stat['sub'] }}</p>
            </div>
            @endforeach
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- ── ENTREPRISES EN ATTENTE ── --}}
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <h2 class="text-sm font-extrabold text-gray-900">Entreprises en attente</h2>
                        @if($stats['entreprises_en_attente'] > 0)
                        <span class="px-2 py-0.5 bg-yellow-400 text-gray-900 text-xs font-extrabold rounded-full">
                            {{ $stats['entreprises_en_attente'] }}
                        </span>
                        @endif
                    </div>
                    <a href="{{ route('admin.entreprises.index', ['statut' => 'en_attente']) }}"
                       class="text-xs text-yellow-500 font-bold hover:text-yellow-400 transition-colors">
                        Voir tout →
                    </a>
                </div>
                <div class="divide-y divide-gray-100">
                    @forelse($entreprisesEnAttente as $entreprise)
                    <div class="p-5">
                        <div class="flex items-start gap-3 mb-3">
                            <div class="w-9 h-9 rounded-xl bg-gray-900 flex items-center justify-center text-white font-extrabold text-sm flex-shrink-0">
                                {{ strtoupper(substr($entreprise->nom_entreprise, 0, 1)) }}
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-sm font-bold text-gray-900 truncate">{{ $entreprise->nom_entreprise }}</p>
                                <p class="text-xs text-gray-400 mt-0.5">{{ $entreprise->secteur_activite ?? '—' }} • {{ $entreprise->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <form action="{{ route('admin.entreprises.valider', $entreprise->id) }}" method="POST" class="flex-1">
                                @csrf @method('PATCH')
                                <button type="submit"
                                        class="w-full py-2 bg-gray-900 text-white text-xs font-extrabold rounded-lg hover:bg-yellow-400 hover:text-gray-900 transition-all">
                                    ✓ Valider
                                </button>
                            </form>
                            <form action="{{ route('admin.entreprises.rejeter', $entreprise->id) }}" method="POST" class="flex-1"
                                  onsubmit="return confirm('Rejeter cette entreprise ?')">
                                @csrf @method('PATCH')
                                <button type="submit"
                                        class="w-full py-2 border border-red-200 text-red-600 text-xs font-extrabold rounded-lg hover:bg-red-50 transition-all">
                                    ✗ Rejeter
                                </button>
                            </form>
                            <a href="{{ route('admin.entreprises.show', $entreprise->id) }}"
                               class="px-3 py-2 border border-gray-200 text-gray-500 text-xs font-bold rounded-lg hover:border-gray-400 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    @empty
                    <div class="p-10 text-center">
                        <div class="w-12 h-12 bg-green-50 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <p class="text-sm font-semibold text-gray-900">Tout est à jour !</p>
                        <p class="text-xs text-gray-400 mt-1">Aucune entreprise en attente.</p>
                    </div>
                    @endforelse
                </div>
            </div>

            {{-- ── DERNIÈRES OFFRES ── --}}
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h2 class="text-sm font-extrabold text-gray-900">Dernières offres publiées</h2>
                </div>
                <div class="divide-y divide-gray-100">
                    @forelse($dernieresOffres as $offre)
                    <a href="{{ route('offres.show', $offre->slug) }}"
                       class="flex items-center gap-3 p-5 hover:bg-gray-50 transition-colors group">
                        <div class="w-9 h-9 rounded-xl bg-gray-100 flex items-center justify-center flex-shrink-0">
                            @if($offre->type_offre === 'emploi')
                                <span class="text-indigo-500 text-xs font-extrabold">EMP</span>
                            @elseif($offre->type_offre === 'stage_professionnel')
                                <span class="text-green-500 text-xs font-extrabold">PRO</span>
                            @else
                                <span class="text-orange-500 text-xs font-extrabold">ACA</span>
                            @endif
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-bold text-gray-900 truncate group-hover:text-yellow-500 transition-colors">{{ $offre->titre }}</p>
                            <p class="text-xs text-gray-400 mt-0.5 truncate">{{ $offre->entreprise->nom_entreprise }} • {{ $offre->created_at->diffForHumans() }}</p>
                        </div>
                        <svg class="w-4 h-4 text-gray-300 group-hover:text-yellow-400 flex-shrink-0 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                    @empty
                    <div class="p-10 text-center text-gray-400 text-sm">Aucune offre récente.</div>
                    @endforelse
                </div>
            </div>

            {{-- ── DERNIÈRES INSCRIPTIONS ── --}}
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h2 class="text-sm font-extrabold text-gray-900">Dernières inscriptions</h2>
                </div>
                <div class="divide-y divide-gray-100">
                    @forelse($derniersUtilisateurs as $user)
                    <div class="flex items-center gap-3 p-5">
                        <div class="w-9 h-9 rounded-full bg-gray-900 flex items-center justify-center text-white font-extrabold text-sm flex-shrink-0">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-bold text-gray-900 truncate">{{ $user->name }}</p>
                            <p class="text-xs text-gray-400 truncate">{{ $user->email }}</p>
                        </div>
                        <div class="flex flex-col items-end gap-1 flex-shrink-0">
                            <span class="px-2 py-0.5 text-xs font-bold rounded-full
                                @if($user->role === 'admin') bg-red-50 text-red-600
                                @elseif($user->role === 'entreprise') bg-blue-50 text-blue-600
                                @else bg-green-50 text-green-600 @endif">
                                {{ ucfirst($user->role) }}
                            </span>
                            <span class="text-xs text-gray-400">{{ $user->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    @empty
                    <div class="p-10 text-center text-gray-400 text-sm">Aucune inscription récente.</div>
                    @endforelse
                </div>
            </div>

            {{-- ── ACTIONS RAPIDES ── --}}
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h2 class="text-sm font-extrabold text-gray-900">Actions rapides</h2>
                </div>
                <div class="p-4 grid grid-cols-1 gap-3">
                    @foreach([
                        ['label' => 'Valider les entreprises', 'route' => 'admin.entreprises.index', 'params' => ['statut' => 'en_attente'], 'badge' => $stats['entreprises_en_attente'] > 0 ? $stats['entreprises_en_attente'] : null, 'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                        ['label' => 'Gérer les entreprises',   'route' => 'admin.entreprises.index', 'params' => [],                         'badge' => null, 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
                        ['label' => 'Voir les statistiques',   'route' => 'admin.statistiques',      'params' => [],                         'badge' => null, 'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z'],
                        ['label' => 'Voir toutes les offres',  'route' => 'offres.index',             'params' => [],                         'badge' => null, 'icon' => 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],
                    ] as $action)
                    <a href="{{ route($action['route'], $action['params']) }}"
                       class="flex items-center gap-3 p-4 border border-gray-200 rounded-xl hover:border-yellow-400 hover:bg-yellow-50/50 transition-all group">
                        <div class="w-8 h-8 bg-gray-100 group-hover:bg-yellow-400 rounded-lg flex items-center justify-center flex-shrink-0 transition-colors">
                            <svg class="w-4 h-4 text-gray-500 group-hover:text-gray-900 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $action['icon'] }}"/>
                            </svg>
                        </div>
                        <span class="text-sm font-bold text-gray-900 flex-1">{{ $action['label'] }}</span>
                        @if($action['badge'])
                        <span class="px-2 py-0.5 bg-yellow-400 text-gray-900 text-xs font-extrabold rounded-full">{{ $action['badge'] }}</span>
                        @else
                        <svg class="w-4 h-4 text-gray-400 group-hover:text-yellow-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                        @endif
                    </a>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>

@endsection