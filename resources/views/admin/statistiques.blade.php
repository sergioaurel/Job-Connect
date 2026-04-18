@extends('layouts.app')

@section('title', 'Statistiques — Administration')

@section('content')

{{-- ═══════════════════════════════════════
     HEADER SOMBRE
═══════════════════════════════════════ --}}
<div class="bg-gray-950 border-b border-white/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 pb-0">
        <div class="mb-6">
            <p class="text-yellow-400 text-xs font-extrabold tracking-widest uppercase mb-1">Administration</p>
            <h1 class="text-white font-extrabold text-2xl sm:text-3xl" style="letter-spacing:-0.02em">Statistiques</h1>
            <p class="text-gray-500 text-sm mt-1">Vue analytique de la plateforme</p>
        </div>
        <nav class="flex gap-1 overflow-x-auto scrollbar-hide">
            @foreach([
                ['label' => 'Tableau de bord', 'route' => 'admin.dashboard',         'active' => false],
                ['label' => 'Entreprises',      'route' => 'admin.entreprises.index', 'active' => false],
                ['label' => 'Statistiques',     'route' => 'admin.statistiques',     'active' => true],
            ] as $tab)
            <a href="{{ route($tab['route']) }}"
               class="flex items-center px-4 py-3 text-xs font-extrabold whitespace-nowrap rounded-t-xl transition-all border-b-2
                      {{ $tab['active'] ? 'bg-white/5 text-yellow-400 border-yellow-400' : 'text-gray-500 border-transparent hover:text-gray-300 hover:bg-white/5' }}">
                {{ $tab['label'] }}
            </a>
            @endforeach
        </nav>
    </div>
</div>

<div class="bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- ── KPIs ── --}}
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-8">
            @foreach([
                ['val' => $stats['total_utilisateurs'],         'label' => 'Utilisateurs',  'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z', 'color' => 'bg-gray-900 text-yellow-400'],
                ['val' => $stats['total_candidats'],            'label' => 'Candidats',      'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',                                            'color' => 'bg-indigo-50 text-indigo-600'],
                ['val' => $stats['total_entreprises_validees'], 'label' => 'Entreprises',    'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5',                                           'color' => 'bg-green-50 text-green-600'],
                ['val' => $stats['total_offres_actives'],       'label' => 'Offres actives', 'icon' => 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'color' => 'bg-yellow-50 text-yellow-600'],
                ['val' => $stats['total_candidatures'],         'label' => 'Candidatures',   'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', 'color' => 'bg-orange-50 text-orange-500'],
                ['val' => $stats['taux_reussite'] . '%',        'label' => 'Taux réussite',  'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',                                                                  'color' => 'bg-emerald-50 text-emerald-600'],
            ] as $kpi)
            <div class="bg-white border border-gray-200 rounded-2xl p-5 hover:border-yellow-300 hover:shadow-sm transition-all">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-gray-500 text-xs font-semibold">{{ $kpi['label'] }}</p>
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center {{ $kpi['color'] }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $kpi['icon'] }}"/>
                        </svg>
                    </div>
                </div>
                <p class="text-gray-900 font-extrabold text-3xl" style="letter-spacing:-0.03em">{{ $kpi['val'] }}</p>
            </div>
            @endforeach
        </div>

        {{-- ── Grille graphiques ── --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 mb-5">

            {{-- Offres par catégorie --}}
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-xl bg-indigo-100 flex items-center justify-center">
                        <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-5 5a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 10V5a2 2 0 012-2z"/></svg>
                    </div>
                    <h2 class="text-gray-900 font-extrabold text-base">Offres actives par catégorie</h2>
                </div>
                <div class="p-6">
                    @if($offresParCategorie->count() > 0)
                    @php $maxOffres = $offresParCategorie->max('offres_count'); @endphp
                    <div class="space-y-4">
                        @foreach($offresParCategorie as $cat)
                        @php $pct = $maxOffres > 0 ? round(($cat->offres_count / $maxOffres) * 100) : 0; @endphp
                        <div>
                            <div class="flex justify-between items-center mb-1.5">
                                <span class="text-sm text-gray-700 font-semibold truncate pr-4">{{ $cat->nom }}</span>
                                <span class="text-sm font-extrabold text-gray-900 flex-shrink-0">{{ $cat->offres_count }}</span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-2">
                                <div class="bg-gray-900 h-2 rounded-full transition-all" style="width:{{ $pct }}%"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <p class="text-sm text-gray-400 text-center py-8">Aucune donnée disponible.</p>
                    @endif
                </div>
            </div>

            {{-- Répartition par type d'offre --}}
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-xl bg-yellow-100 flex items-center justify-center">
                        <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                    <h2 class="text-gray-900 font-extrabold text-base">Répartition par type d'offre</h2>
                </div>
                <div class="p-6">
                    @if($offresParType->count() > 0)
                    @php
                        $totalOffresType = $offresParType->sum('total');
                        $typeLabels = ['emploi'=>'Emploi','stage_professionnel'=>'Stage professionnel','stage_academique'=>'Stage académique'];
                        $typeColors = ['emploi'=>'bg-indigo-500','stage_professionnel'=>'bg-green-500','stage_academique'=>'bg-orange-400'];
                        $typeBadge  = ['emploi'=>'bg-indigo-50 text-indigo-600','stage_professionnel'=>'bg-green-50 text-green-600','stage_academique'=>'bg-orange-50 text-orange-500'];
                    @endphp
                    <div class="space-y-4 mb-5">
                        @foreach($offresParType as $type)
                        @php $pct = $totalOffresType > 0 ? round(($type->total / $totalOffresType) * 100) : 0; @endphp
                        <div>
                            <div class="flex justify-between items-center mb-1.5">
                                <span class="text-sm font-semibold text-gray-700">{{ $typeLabels[$type->type_offre] ?? ucfirst($type->type_offre) }}</span>
                                <span class="text-sm font-extrabold text-gray-900">{{ $type->total }} <span class="text-gray-400 font-normal text-xs">({{ $pct }}%)</span></span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-3">
                                <div class="{{ $typeColors[$type->type_offre] ?? 'bg-gray-400' }} h-3 rounded-full transition-all" style="width:{{ $pct }}%"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="flex flex-wrap gap-2 pt-4 border-t border-gray-100">
                        @foreach($offresParType as $type)
                        <span class="px-2.5 py-1 text-xs font-extrabold rounded-lg {{ $typeBadge[$type->type_offre] ?? 'bg-gray-100 text-gray-600' }}">
                            {{ $typeLabels[$type->type_offre] ?? ucfirst($type->type_offre) }} · {{ $type->total }}
                        </span>
                        @endforeach
                    </div>
                    @else
                    <p class="text-sm text-gray-400 text-center py-8">Aucune donnée disponible.</p>
                    @endif
                </div>
            </div>

            {{-- Candidatures par statut --}}
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-xl bg-green-100 flex items-center justify-center">
                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <h2 class="text-gray-900 font-extrabold text-base">Candidatures par statut</h2>
                </div>
                <div class="p-6">
                    @if($candidaturesParStatut->count() > 0)
                    @php
                        $totalCandidaturesStatut = $candidaturesParStatut->sum('total');
                        $statutLabels = ['en_attente'=>'En attente','vue'=>'Vue','retenue'=>'Retenue','rejetee'=>'Rejetée'];
                        $statutColors = ['en_attente'=>'bg-orange-400','vue'=>'bg-blue-400','retenue'=>'bg-green-500','rejetee'=>'bg-red-400'];
                    @endphp
                    <div class="grid grid-cols-2 gap-3 mb-5">
                        @foreach($candidaturesParStatut as $item)
                        <div class="rounded-xl border border-gray-100 p-4 text-center hover:border-yellow-300 transition-all">
                            <p class="text-2xl font-extrabold text-gray-900" style="letter-spacing:-0.03em">{{ $item->total }}</p>
                            <p class="text-xs text-gray-500 mt-1 font-semibold">{{ $statutLabels[$item->statut] ?? ucfirst($item->statut) }}</p>
                        </div>
                        @endforeach
                    </div>
                    <div class="space-y-3 pt-4 border-t border-gray-100">
                        @foreach($candidaturesParStatut as $item)
                        @php $pct = $totalCandidaturesStatut > 0 ? round(($item->total / $totalCandidaturesStatut) * 100) : 0; @endphp
                        <div class="flex items-center gap-3">
                            <div class="w-2.5 h-2.5 rounded-full flex-shrink-0 {{ $statutColors[$item->statut] ?? 'bg-gray-400' }}"></div>
                            <span class="text-sm text-gray-700 flex-1 font-semibold">{{ $statutLabels[$item->statut] ?? ucfirst($item->statut) }}</span>
                            <div class="w-24 bg-gray-100 rounded-full h-1.5">
                                <div class="{{ $statutColors[$item->statut] ?? 'bg-gray-400' }} h-1.5 rounded-full" style="width:{{ $pct }}%"></div>
                            </div>
                            <span class="text-xs font-extrabold text-gray-500 w-8 text-right">{{ $pct }}%</span>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <p class="text-sm text-gray-400 text-center py-8">Aucune donnée disponible.</p>
                    @endif
                </div>
            </div>

            {{-- Top villes --}}
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-xl bg-orange-100 flex items-center justify-center">
                        <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <h2 class="text-gray-900 font-extrabold text-base">Top 5 des villes</h2>
                </div>
                <div class="p-6">
                    @if($topVilles->count() > 0)
                    @php $maxVille = $topVilles->max('total'); @endphp
                    <div class="space-y-4">
                        @foreach($topVilles as $index => $ville)
                        @php $pct = $maxVille > 0 ? round(($ville->total / $maxVille) * 100) : 0; @endphp
                        <div class="flex items-center gap-3">
                            <div class="w-7 h-7 rounded-lg flex items-center justify-center flex-shrink-0 text-xs font-extrabold
                                {{ $index === 0 ? 'bg-yellow-400 text-gray-900' : 'bg-gray-100 text-gray-500' }}">
                                {{ $index + 1 }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex justify-between items-center mb-1.5">
                                    <span class="text-sm font-extrabold text-gray-900 truncate">{{ $ville->ville ?: 'Non précisé' }}</span>
                                    <span class="text-xs text-gray-400 font-semibold ml-2 flex-shrink-0">{{ $ville->total }} offre(s)</span>
                                </div>
                                <div class="w-full bg-gray-100 rounded-full h-2">
                                    <div class="{{ $index === 0 ? 'bg-yellow-400' : 'bg-gray-400' }} h-2 rounded-full transition-all"
                                         style="width:{{ $pct }}%"></div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <p class="text-sm text-gray-400 text-center py-8">Aucune donnée disponible.</p>
                    @endif
                </div>
            </div>
        </div>

        {{-- ── Évolution inscriptions ── --}}
        <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                <div class="w-8 h-8 rounded-xl bg-gray-900 flex items-center justify-center">
                    <svg class="w-4 h-4 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                </div>
                <h2 class="text-gray-900 font-extrabold text-base">Évolution des inscriptions — 6 derniers mois</h2>
            </div>
            <div class="p-6">
                @if($inscriptionsParMois->count() > 0)
                @php $maxInscriptions = $inscriptionsParMois->max('total'); @endphp
                <div class="flex items-end gap-3 h-44">
                    @foreach($inscriptionsParMois as $mois)
                    @php
                        $hauteur = $maxInscriptions > 0 ? round(($mois->total / $maxInscriptions) * 100) : 0;
                        $label   = \Carbon\Carbon::createFromFormat('Y-m', $mois->mois)->translatedFormat('M Y');
                    @endphp
                    <div class="flex-1 flex flex-col items-center gap-2 group cursor-default">
                        <span class="text-xs font-extrabold text-yellow-500 opacity-0 group-hover:opacity-100 transition-opacity">
                            {{ $mois->total }}
                        </span>
                        <div class="w-full rounded-t-xl transition-all duration-300 group-hover:opacity-80 relative overflow-hidden"
                             style="height:{{ max($hauteur, 6) }}%;background:linear-gradient(to top,#111827,#374151)">
                            <div class="absolute top-0 left-0 right-0 h-0.5 bg-yellow-400/60"></div>
                        </div>
                        <span class="text-xs text-gray-400 font-semibold text-center whitespace-nowrap">{{ $label }}</span>
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-sm text-gray-400 text-center py-8">Aucune donnée disponible pour les 6 derniers mois.</p>
                @endif
            </div>
        </div>

    </div>
</div>

@endsection