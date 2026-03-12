@extends('layouts.app')

@section('title', 'Mon espace entreprise')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- En-tête -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Espace Entreprise</h1>
        @if($entreprise)
            <p class="text-gray-600">{{ $entreprise->nom_entreprise }}</p>
        @endif
    </div>

    <!-- Menu de navigation -->
    <div class="mb-8 border-b border-gray-200">
        <nav class="flex space-x-8">
            <a href="{{ route('entreprise.dashboard') }}" class="pb-4 border-b-2 border-gray-900 text-sm font-medium text-gray-900">
                Tableau de bord
            </a>
            <a href="{{ route('entreprise.profil.edit') }}" class="pb-4 border-b-2 border-transparent text-sm font-medium text-gray-600 hover:text-gray-900 hover:border-gray-300">
                Mon profil
            </a>
            <a href="{{ route('entreprise.offres.index') }}" class="pb-4 border-b-2 border-transparent text-sm font-medium text-gray-600 hover:text-gray-900 hover:border-gray-300">
                Mes offres
            </a>
            <a href="{{ route('entreprise.candidatures.index') }}" class="pb-4 border-b-2 border-transparent text-sm font-medium text-gray-600 hover:text-gray-900 hover:border-gray-300">
                Candidatures
            </a>
        </nav>
    </div>

    @if($entreprise)
        <!-- Statut de validation -->
        @if($entreprise->statut === 'en_attente')
            <div class="mb-8 bg-white border border-gray-900 rounded p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">
                    Votre profil est en cours de validation
                </h3>
                <p class="text-sm text-gray-600">
                    Un administrateur vérifiera votre profil sous peu. Vous pourrez publier des offres dès validation.
                </p>
            </div>
        @elseif($entreprise->statut === 'rejetee')
            <div class="mb-8 bg-white border border-gray-900 rounded p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">
                    Votre profil a été rejeté
                </h3>
                <p class="text-sm text-gray-600">
                    Veuillez contacter l'administrateur pour plus d'informations.
                </p>
            </div>
        @endif

        <!-- Statistiques -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white border border-gray-200 rounded p-6">
                <div class="text-sm text-gray-600 mb-2">Total offres</div>
                <div class="text-3xl font-bold text-gray-900">{{ $stats['total_offres'] }}</div>
            </div>
            <div class="bg-white border border-gray-200 rounded p-6">
                <div class="text-sm text-gray-600 mb-2">Offres actives</div>
                <div class="text-3xl font-bold text-gray-900">{{ $stats['offres_actives'] }}</div>
            </div>
            <div class="bg-white border border-gray-200 rounded p-6">
                <div class="text-sm text-gray-600 mb-2">Total candidatures</div>
                <div class="text-3xl font-bold text-gray-900">{{ $stats['total_candidatures'] }}</div>
            </div>
            <div class="bg-white border border-gray-200 rounded p-6">
                <div class="text-sm text-gray-600 mb-2">En attente</div>
                <div class="text-3xl font-bold text-gray-900">{{ $stats['candidatures_en_attente'] }}</div>
            </div>
        </div>

        <!-- Actions rapides -->
        @if($entreprise->isValidee())
            <div class="mb-8">
                <a href="{{ route('entreprise.offres.create') }}" 
                   class="inline-block px-6 py-3 bg-gray-900 text-white font-medium rounded hover:bg-gray-800">
                    + Publier une nouvelle offre
                </a>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            
            <!-- Mes dernières offres -->
            <div class="bg-white border border-gray-200 rounded">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex justify-between items-center">
                        <h2 class="text-lg font-semibold text-gray-900">Mes dernières offres</h2>
                        <a href="{{ route('entreprise.offres.index') }}" class="text-sm text-gray-900 hover:underline">
                            Voir tout →
                        </a>
                    </div>
                </div>
                <div class="divide-y divide-gray-200">
                    @forelse($offres as $offre)
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="font-semibold text-gray-900">
                                    {{ $offre->titre }}
                                </h3>
                                <span class="px-2 py-1 text-xs font-medium rounded
                                    @if($offre->statut === 'active') bg-gray-900 text-white
                                    @elseif($offre->statut === 'fermee') bg-gray-200 text-gray-700
                                    @else bg-gray-300 text-gray-800
                                    @endif">
                                    {{ ucfirst($offre->statut) }}
                                </span>
                            </div>
                            <div class="text-sm text-gray-600 mb-2">
                                {{ $offre->candidatures_count }} candidature(s)
                            </div>
                            <div class="text-xs text-gray-500 mb-3">
                                Publié {{ $offre->created_at->diffForHumans() }}
                            </div>
                            <a href="{{ route('entreprise.offres.show', $offre->id) }}" 
                               class="text-sm text-gray-900 font-medium hover:underline">
                                Voir les détails →
                            </a>
                        </div>
                    @empty
                        <div class="p-6 text-center text-gray-600">
                            <p class="mb-4">Aucune offre publiée pour le moment.</p>
                            @if($entreprise->isValidee())
                                <a href="{{ route('entreprise.offres.create') }}" 
                                   class="text-sm text-gray-900 font-medium hover:underline">
                                    Publier une offre →
                                </a>
                            @endif
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Dernières candidatures -->
            <div class="bg-white border border-gray-200 rounded">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex justify-between items-center">
                        <h2 class="text-lg font-semibold text-gray-900">Dernières candidatures</h2>
                        <a href="{{ route('entreprise.candidatures.index') }}" class="text-sm text-gray-900 hover:underline">
                            Voir tout →
                        </a>
                    </div>
                </div>
                <div class="divide-y divide-gray-200">
                    @forelse($candidatures as $candidature)
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="font-semibold text-gray-900">
                                    {{ $candidature->candidat->name }}
                                </h3>
                                <span class="px-2 py-1 text-xs font-medium rounded
                                    @if($candidature->statut === 'en_attente') bg-gray-100 text-gray-800
                                    @elseif($candidature->statut === 'vue') bg-gray-200 text-gray-900
                                    @elseif($candidature->statut === 'retenue') bg-gray-900 text-white
                                    @else bg-gray-300 text-gray-700
                                    @endif">
                                    {{ ucfirst(str_replace('_', ' ', $candidature->statut)) }}
                                </span>
                            </div>
                            <div class="text-sm text-gray-600 mb-2">
                                Pour: {{ $candidature->offre->titre }}
                            </div>
                            <div class="text-xs text-gray-500 mb-3">
                                Reçu {{ $candidature->created_at->diffForHumans() }}
                            </div>
                            <a href="{{ route('entreprise.candidatures.show', $candidature->id) }}" 
                               class="text-sm text-gray-900 font-medium hover:underline">
                                Voir le profil →
                            </a>
                        </div>
                    @empty
                        <div class="p-6 text-center text-gray-600">
                            Aucune candidature reçue pour le moment.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    @endif
</div>
@endsection