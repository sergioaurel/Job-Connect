@extends('layouts.app')

@section('title', 'Administration')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- En-tête -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Administration</h1>
        <p class="text-gray-600">Vue d'ensemble de la plateforme</p>
    </div>

    <!-- Menu de navigation -->
    <div class="mb-8 border-b border-gray-200">
        <nav class="flex space-x-8">
            <a href="{{ route('admin.dashboard') }}" class="pb-4 border-b-2 border-gray-900 text-sm font-medium text-gray-900">
                Tableau de bord
            </a>
            <a href="{{ route('admin.entreprises.index') }}" class="pb-4 border-b-2 border-transparent text-sm font-medium text-gray-600 hover:text-gray-900 hover:border-gray-300">
                Entreprises
            </a>
            <a href="{{ route('admin.statistiques') }}" class="pb-4 border-b-2 border-transparent text-sm font-medium text-gray-600 hover:text-gray-900 hover:border-gray-300">
                Statistiques
            </a>
        </nav>
    </div>

    <!-- Statistiques globales -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white border border-gray-200 rounded p-6">
            <div class="text-sm text-gray-600 mb-2">Total utilisateurs</div>
            <div class="text-3xl font-bold text-gray-900">{{ $stats['total_utilisateurs'] }}</div>
            <div class="text-xs text-gray-500 mt-1">
                {{ $stats['total_candidats'] }} candidats
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded p-6">
            <div class="text-sm text-gray-600 mb-2">Entreprises</div>
            <div class="text-3xl font-bold text-gray-900">{{ $stats['total_entreprises'] }}</div>
            @if($stats['entreprises_en_attente'] > 0)
                <div class="text-xs text-gray-900 mt-1 font-medium">
                    {{ $stats['entreprises_en_attente'] }} en attente
                </div>
            @else
                <div class="text-xs text-gray-500 mt-1">
                    Toutes validées
                </div>
            @endif
        </div>

        <div class="bg-white border border-gray-200 rounded p-6">
            <div class="text-sm text-gray-600 mb-2">Offres actives</div>
            <div class="text-3xl font-bold text-gray-900">{{ $stats['offres_actives'] }}</div>
            <div class="text-xs text-gray-500 mt-1">
                {{ $stats['total_offres'] }} au total
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded p-6">
            <div class="text-sm text-gray-600 mb-2">Candidatures</div>
            <div class="text-3xl font-bold text-gray-900">{{ $stats['total_candidatures'] }}</div>
            <div class="text-xs text-gray-500 mt-1">
                {{ $stats['candidatures_mois'] }} ce mois
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        <!-- Entreprises en attente de validation -->
        <div class="bg-white border border-gray-200 rounded">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-900">
                        Entreprises en attente
                        @if($stats['entreprises_en_attente'] > 0)
                            <span class="ml-2 px-2 py-1 bg-gray-900 text-white text-xs rounded">
                                {{ $stats['entreprises_en_attente'] }}
                            </span>
                        @endif
                    </h2>
                    <a href="{{ route('admin.entreprises.index', ['statut' => 'en_attente']) }}" 
                       class="text-sm text-gray-900 hover:underline">
                        Voir tout →
                    </a>
                </div>
            </div>
            <div class="divide-y divide-gray-200">
                @forelse($entreprisesEnAttente as $entreprise)
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-3">
                            <div class="flex-1">
                                <h3 class="font-semibold text-gray-900 mb-1">
                                    {{ $entreprise->nom_entreprise }}
                                </h3>
                                <p class="text-sm text-gray-600 mb-1">
                                    {{ $entreprise->secteur_activite }}
                                </p>
                                <p class="text-xs text-gray-500">
                                    Inscrit {{ $entreprise->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <form action="{{ route('admin.entreprises.valider', $entreprise->id) }}" 
                                  method="POST" 
                                  class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" 
                                        class="px-3 py-1 bg-gray-900 text-white text-sm rounded hover:bg-gray-800">
                                    Valider
                                </button>
                            </form>
                            <form action="{{ route('admin.entreprises.rejeter', $entreprise->id) }}" 
                                  method="POST" 
                                  class="inline"
                                  onsubmit="return confirm('Rejeter cette entreprise ?')">
                                @csrf
                                @method('PATCH')
                                <button type="submit" 
                                        class="px-3 py-1 border border-gray-300 text-gray-900 text-sm rounded hover:bg-gray-50">
                                    Rejeter
                                </button>
                            </form>
                            <a href="{{ route('admin.entreprises.show', $entreprise->id) }}" 
                               class="px-3 py-1 border border-gray-300 text-gray-900 text-sm rounded hover:bg-gray-50">
                                Détails
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="p-6 text-center text-gray-600">
                        Aucune entreprise en attente de validation.
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Dernières offres publiées -->
        <div class="bg-white border border-gray-200 rounded">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Dernières offres publiées</h2>
            </div>
            <div class="divide-y divide-gray-200">
                @forelse($dernieresOffres as $offre)
                    <div class="p-6">
                        <h3 class="font-semibold text-gray-900 mb-1">
                            {{ $offre->titre }}
                        </h3>
                        <p class="text-sm text-gray-600 mb-2">
                            {{ $offre->entreprise->nom_entreprise }} • {{ $offre->ville }}
                        </p>
                        <div class="flex items-center gap-2 text-xs text-gray-500">
                            <span class="px-2 py-1 bg-gray-100 rounded">
                                @if($offre->type_offre === 'emploi')
                                    Emploi
                                @elseif($offre->type_offre === 'stage_professionnel')
                                    Stage pro
                                @else
                                    Stage académique
                                @endif
                            </span>
                            <span>{{ $offre->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                @empty
                    <div class="p-6 text-center text-gray-600">
                        Aucune offre publiée récemment.
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Dernières inscriptions -->
        <div class="bg-white border border-gray-200 rounded">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Dernières inscriptions</h2>
            </div>
            <div class="divide-y divide-gray-200">
                @forelse($derniersUtilisateurs as $utilisateur)
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">
                                    {{ $utilisateur->name }}
                                </h3>
                                <p class="text-sm text-gray-600 mb-1">
                                    {{ $utilisateur->email }}
                                </p>
                                <div class="flex items-center gap-2">
                                    <span class="px-2 py-1 bg-gray-100 text-xs rounded">
                                        {{ ucfirst($utilisateur->role) }}
                                    </span>
                                    <span class="text-xs text-gray-500">
                                        {{ $utilisateur->created_at->diffForHumans() }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-6 text-center text-gray-600">
                        Aucune inscription récente.
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Actions rapides -->
        <div class="bg-white border border-gray-200 rounded">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Actions rapides</h2>
            </div>
            <div class="p-6 space-y-3">
                <a href="{{ route('admin.entreprises.index', ['statut' => 'en_attente']) }}" 
                   class="flex items-center justify-between p-3 border border-gray-200 rounded hover:border-gray-900 transition">
                    <span class="text-sm font-medium text-gray-900">Valider les entreprises</span>
                    @if($stats['entreprises_en_attente'] > 0)
                        <span class="px-2 py-1 bg-gray-900 text-white text-xs rounded">
                            {{ $stats['entreprises_en_attente'] }}
                        </span>
                    @endif
                </a>
                
                <a href="{{ route('admin.entreprises.index') }}" 
                   class="flex items-center justify-between p-3 border border-gray-200 rounded hover:border-gray-900 transition">
                    <span class="text-sm font-medium text-gray-900">Gérer les entreprises</span>
                    <span class="text-sm text-gray-600">→</span>
                </a>
                
                <a href="{{ route('admin.statistiques') }}" 
                   class="flex items-center justify-between p-3 border border-gray-200 rounded hover:border-gray-900 transition">
                    <span class="text-sm font-medium text-gray-900">Voir les statistiques</span>
                    <span class="text-sm text-gray-600">→</span>
                </a>
                
                <a href="{{ route('offres.index') }}" 
                   class="flex items-center justify-between p-3 border border-gray-200 rounded hover:border-gray-900 transition">
                    <span class="text-sm font-medium text-gray-900">Voir toutes les offres</span>
                    <span class="text-sm text-gray-600">→</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection