@extends('layouts.app')

@section('title', 'Statistiques')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Statistiques</h1>
        <p class="text-gray-600">Vue analytique de la plateforme</p>
    </div>

    {{-- Navigation --}}
    <div class="mb-8 border-b border-gray-200">
        <nav class="flex space-x-8">
            <a href="{{ route('admin.dashboard') }}" class="pb-4 border-b-2 border-transparent text-sm font-medium text-gray-600 hover:text-gray-900 hover:border-gray-300">
                Tableau de bord
            </a>
            <a href="{{ route('admin.entreprises.index') }}" class="pb-4 border-b-2 border-transparent text-sm font-medium text-gray-600 hover:text-gray-900 hover:border-gray-300">
                Entreprises
            </a>
            <a href="{{ route('admin.statistiques') }}" class="pb-4 border-b-2 border-gray-900 text-sm font-medium text-gray-900">
                Statistiques
            </a>
        </nav>
    </div>

    {{-- KPIs principaux --}}
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-8">
        <div class="bg-white border border-gray-200 rounded-xl p-5 text-center">
            <p class="text-2xl font-bold text-gray-900">{{ $stats['total_utilisateurs'] }}</p>
            <p class="text-xs text-gray-500 mt-1">Utilisateurs</p>
        </div>
        <div class="bg-white border border-gray-200 rounded-xl p-5 text-center">
            <p class="text-2xl font-bold text-gray-900">{{ $stats['total_candidats'] }}</p>
            <p class="text-xs text-gray-500 mt-1">Candidats</p>
        </div>
        <div class="bg-white border border-gray-200 rounded-xl p-5 text-center">
            <p class="text-2xl font-bold text-gray-900">{{ $stats['total_entreprises_validees'] }}</p>
            <p class="text-xs text-gray-500 mt-1">Entreprises</p>
        </div>
        <div class="bg-white border border-gray-200 rounded-xl p-5 text-center">
            <p class="text-2xl font-bold text-gray-900">{{ $stats['total_offres_actives'] }}</p>
            <p class="text-xs text-gray-500 mt-1">Offres actives</p>
        </div>
        <div class="bg-white border border-gray-200 rounded-xl p-5 text-center">
            <p class="text-2xl font-bold text-gray-900">{{ $stats['total_candidatures'] }}</p>
            <p class="text-xs text-gray-500 mt-1">Candidatures</p>
        </div>
        <div class="bg-white border border-gray-200 rounded-xl p-5 text-center">
            <p class="text-2xl font-bold text-blue-600">{{ $stats['taux_reussite'] }}%</p>
            <p class="text-xs text-gray-500 mt-1">Taux réussite</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

        {{-- Offres par catégorie --}}
        <div class="bg-white border border-gray-200 rounded-xl p-6">
            <h2 class="text-base font-semibold text-gray-900 mb-5">Offres actives par catégorie</h2>
            @if($offresParCategorie->count() > 0)
                @php $maxOffres = $offresParCategorie->max('offres_count'); @endphp
                <div class="space-y-3">
                    @foreach($offresParCategorie as $cat)
                    <div>
                        <div class="flex justify-between items-center mb-1">
                            <span class="text-sm text-gray-700 truncate pr-4">{{ $cat->nom }}</span>
                            <span class="text-sm font-semibold text-gray-900 flex-shrink-0">{{ $cat->offres_count }}</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-2">
                            <div class="bg-gray-900 h-2 rounded-full transition-all"
                                 style="width: {{ $maxOffres > 0 ? round(($cat->offres_count / $maxOffres) * 100) : 0 }}%">
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <p class="text-sm text-gray-400 text-center py-8">Aucune donnée disponible.</p>
            @endif
        </div>

        {{-- Offres par type --}}
        <div class="bg-white border border-gray-200 rounded-xl p-6">
            <h2 class="text-base font-semibold text-gray-900 mb-5">Répartition par type d'offre</h2>
            @if($offresParType->count() > 0)
                @php
                    $totalOffresType = $offresParType->sum('total');
                    $typeLabels = [
                        'emploi' => 'Emploi',
                        'stage_professionnel' => 'Stage professionnel',
                        'stage_academique' => 'Stage académique',
                    ];
                    $typeColors = [
                        'emploi' => 'bg-blue-500',
                        'stage_professionnel' => 'bg-purple-500',
                        'stage_academique' => 'bg-orange-400',
                    ];
                @endphp
                <div class="space-y-4">
                    @foreach($offresParType as $type)
                    @php $pct = $totalOffresType > 0 ? round(($type->total / $totalOffresType) * 100) : 0; @endphp
                    <div>
                        <div class="flex justify-between items-center mb-1">
                            <span class="text-sm text-gray-700">{{ $typeLabels[$type->type_offre] ?? ucfirst($type->type_offre) }}</span>
                            <span class="text-sm font-semibold text-gray-900">{{ $type->total }} <span class="text-gray-400 font-normal">({{ $pct }}%)</span></span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-3">
                            <div class="{{ $typeColors[$type->type_offre] ?? 'bg-gray-400' }} h-3 rounded-full"
                                 style="width: {{ $pct }}%">
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <p class="text-sm text-gray-400 text-center py-8">Aucune donnée disponible.</p>
            @endif
        </div>

        {{-- Candidatures par statut --}}
        <div class="bg-white border border-gray-200 rounded-xl p-6">
            <h2 class="text-base font-semibold text-gray-900 mb-5">Candidatures par statut</h2>
            @if($candidaturesParStatut->count() > 0)
                @php
                    $totalCandidaturesStatut = $candidaturesParStatut->sum('total');
                    $statutLabels = [
                        'en_attente' => 'En attente',
                        'vue'        => 'Vue',
                        'retenue'    => 'Retenue',
                        'rejetee'    => 'Rejetée',
                    ];
                    $statutColors = [
                        'en_attente' => 'bg-yellow-400',
                        'vue'        => 'bg-blue-400',
                        'retenue'    => 'bg-green-500',
                        'rejetee'    => 'bg-red-400',
                    ];
                @endphp
                <div class="grid grid-cols-2 gap-4 mb-5">
                    @foreach($candidaturesParStatut as $item)
                    <div class="p-4 rounded-xl border border-gray-100 text-center">
                        <p class="text-2xl font-bold text-gray-900">{{ $item->total }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ $statutLabels[$item->statut] ?? ucfirst($item->statut) }}</p>
                    </div>
                    @endforeach
                </div>
                <div class="space-y-2">
                    @foreach($candidaturesParStatut as $item)
                    @php $pct = $totalCandidaturesStatut > 0 ? round(($item->total / $totalCandidaturesStatut) * 100) : 0; @endphp
                    <div class="flex items-center gap-3">
                        <div class="w-3 h-3 rounded-full flex-shrink-0 {{ $statutColors[$item->statut] ?? 'bg-gray-400' }}"></div>
                        <span class="text-sm text-gray-700 flex-1">{{ $statutLabels[$item->statut] ?? ucfirst($item->statut) }}</span>
                        <span class="text-sm font-medium text-gray-900">{{ $pct }}%</span>
                    </div>
                    @endforeach
                </div>
            @else
                <p class="text-sm text-gray-400 text-center py-8">Aucune donnée disponible.</p>
            @endif
        </div>

        {{-- Top villes --}}
        <div class="bg-white border border-gray-200 rounded-xl p-6">
            <h2 class="text-base font-semibold text-gray-900 mb-5">Top 5 des villes</h2>
            @if($topVilles->count() > 0)
                @php $maxVille = $topVilles->max('total'); @endphp
                <div class="space-y-4">
                    @foreach($topVilles as $index => $ville)
                    <div class="flex items-center gap-3">
                        <span class="w-6 h-6 rounded-full bg-gray-100 text-gray-600 text-xs font-bold flex items-center justify-center flex-shrink-0">
                            {{ $index + 1 }}
                        </span>
                        <div class="flex-1">
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-sm font-medium text-gray-900">{{ $ville->ville ?: 'Non précisé' }}</span>
                                <span class="text-sm text-gray-500">{{ $ville->total }} offre(s)</span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-2">
                                <div class="bg-blue-500 h-2 rounded-full"
                                     style="width: {{ $maxVille > 0 ? round(($ville->total / $maxVille) * 100) : 0 }}%">
                                </div>
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

    {{-- Évolution des inscriptions --}}
    <div class="bg-white border border-gray-200 rounded-xl p-6">
        <h2 class="text-base font-semibold text-gray-900 mb-5">Évolution des inscriptions (6 derniers mois)</h2>
        @if($inscriptionsParMois->count() > 0)
            @php $maxInscriptions = $inscriptionsParMois->max('total'); @endphp
            <div class="flex items-end gap-3 h-40">
                @foreach($inscriptionsParMois as $mois)
                @php
                    $hauteur = $maxInscriptions > 0 ? round(($mois->total / $maxInscriptions) * 100) : 0;
                    $label = \Carbon\Carbon::createFromFormat('Y-m', $mois->mois)->translatedFormat('M Y');
                @endphp
                <div class="flex-1 flex flex-col items-center gap-2">
                    <span class="text-xs font-semibold text-gray-700">{{ $mois->total }}</span>
                    <div class="w-full bg-gray-900 rounded-t-md transition-all" style="height: {{ max($hauteur, 4) }}%"></div>
                    <span class="text-xs text-gray-400 text-center">{{ $label }}</span>
                </div>
                @endforeach
            </div>
        @else
            <p class="text-sm text-gray-400 text-center py-8">Aucune donnée disponible pour les 6 derniers mois.</p>
        @endif
    </div>

</div>
@endsection