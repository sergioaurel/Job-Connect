@extends('layouts.app')

@section('title', 'Mon espace candidat')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- En-tête -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Bonjour, {{ auth()->user()->name }}</h1>
        <p class="text-gray-600">Bienvenue sur votre espace candidat</p>
    </div>

    <!-- Menu de navigation -->
    <div class="mb-8 border-b border-gray-200">
        <nav class="flex space-x-8">
            <a href="{{ route('candidat.dashboard') }}" class="pb-4 border-b-2 border-gray-900 text-sm font-medium text-gray-900">
                Tableau de bord
            </a>
            <a href="{{ route('candidat.profil') }}" class="pb-4 border-b-2 border-transparent text-sm font-medium text-gray-600 hover:text-gray-900 hover:border-gray-300">
                Mon profil
            </a>
            <a href="{{ route('candidat.candidatures') }}" class="pb-4 border-b-2 border-transparent text-sm font-medium text-gray-600 hover:text-gray-900 hover:border-gray-300">
                Mes candidatures
            </a>
            <a href="{{ route('candidat.favoris') }}" class="pb-4 border-b-2 border-transparent text-sm font-medium text-gray-600 hover:text-gray-900 hover:border-gray-300">
                Mes favoris
            </a>
        </nav>
    </div>

    <!-- Statistiques -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white border border-gray-200 rounded p-6">
            <div class="text-sm text-gray-600 mb-2">Total candidatures</div>
            <div class="text-3xl font-bold text-gray-900">{{ $stats['total_candidatures'] }}</div>
        </div>
        <div class="bg-white border border-gray-200 rounded p-6">
            <div class="text-sm text-gray-600 mb-2">En attente</div>
            <div class="text-3xl font-bold text-gray-900">{{ $stats['candidatures_en_attente'] }}</div>
        </div>
        <div class="bg-white border border-gray-200 rounded p-6">
            <div class="text-sm text-gray-600 mb-2">Retenues</div>
            <div class="text-3xl font-bold text-gray-900">{{ $stats['candidatures_retenues'] }}</div>
        </div>
        <div class="bg-white border border-gray-200 rounded p-6">
            <div class="text-sm text-gray-600 mb-2">Profil complet</div>
            <div class="text-3xl font-bold text-gray-900">{{ $stats['profil_complet'] }}</div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        <!-- Dernières candidatures -->
        <div class="bg-white border border-gray-200 rounded">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-900">Mes dernières candidatures</h2>
                    <a href="{{ route('candidat.candidatures') }}" class="text-sm text-gray-900 hover:underline">
                        Voir tout →
                    </a>
                </div>
            </div>
            <div class="divide-y divide-gray-200">
                @forelse($candidatures as $candidature)
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="font-semibold text-gray-900">
                                <a href="{{ route('offres.show', $candidature->offre->slug) }}" class="hover:underline">
                                    {{ $candidature->offre->titre }}
                                </a>
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
                        <div class="text-sm text-gray-600 mb-1">
                            {{ $candidature->offre->entreprise->nom_entreprise }}
                        </div>
                        <div class="text-xs text-gray-500">
                            Postulé {{ $candidature->created_at->diffForHumans() }}
                        </div>
                    </div>
                @empty
                    <div class="p-6 text-center text-gray-600">
                        <p class="mb-4">Vous n'avez encore postulé à aucune offre.</p>
                        <a href="{{ route('offres.index') }}" class="text-sm text-gray-900 font-medium hover:underline">
                            Découvrir les offres →
                        </a>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Offres favorites -->
        <div class="bg-white border border-gray-200 rounded">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-900">Mes offres favorites</h2>
                    <a href="{{ route('candidat.favoris') }}" class="text-sm text-gray-900 hover:underline">
                        Voir tout →
                    </a>
                </div>
            </div>
            <div class="divide-y divide-gray-200">
                @forelse($favoris as $offre)
                    <div class="p-6">
                        <h3 class="font-semibold text-gray-900 mb-2">
                            <a href="{{ route('offres.show', $offre->slug) }}" class="hover:underline">
                                {{ $offre->titre }}
                            </a>
                        </h3>
                        <div class="text-sm text-gray-600 mb-1">
                            {{ $offre->entreprise->nom_entreprise }}
                        </div>
                        <div class="text-sm text-gray-600 mb-2">
                            {{ $offre->ville }}
                        </div>
                        <a href="{{ route('candidat.candidatures.create', $offre->id) }}" 
                           class="text-sm text-gray-900 font-medium hover:underline">
                            Postuler →
                        </a>
                    </div>
                @empty
                    <div class="p-6 text-center text-gray-600">
                        <p class="mb-4">Aucune offre favorite pour le moment.</p>
                        <a href="{{ route('offres.index') }}" class="text-sm text-gray-900 font-medium hover:underline">
                            Parcourir les offres →
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Alerte profil incomplet -->
    @if(!auth()->user()->profilComplete())
        <div class="mt-8 bg-white border border-gray-900 rounded p-6">
            <div class="flex items-start">
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">
                        Complétez votre profil
                    </h3>
                    <p class="text-sm text-gray-600 mb-4">
                        Un profil complet augmente vos chances d'être remarqué par les recruteurs. 
                        Ajoutez vos expériences, formations et compétences.
                    </p>
                    <a href="{{ route('candidat.profil') }}" 
                       class="inline-block px-4 py-2 bg-gray-900 text-white text-sm font-medium rounded hover:bg-gray-800">
                        Compléter mon profil
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection