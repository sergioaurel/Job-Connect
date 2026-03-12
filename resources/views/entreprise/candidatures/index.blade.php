@extends('layouts.app')

@section('title', 'Candidatures reçues')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Candidatures reçues</h1>
        <p class="text-gray-600">{{ $candidatures->total() }} candidature(s)</p>
    </div>

    <!-- Menu de navigation -->
    <div class="mb-8 border-b border-gray-200">
        <nav class="flex space-x-8">
            <a href="{{ route('entreprise.dashboard') }}" class="pb-4 border-b-2 border-transparent text-sm font-medium text-gray-600 hover:text-gray-900 hover:border-gray-300">
                Tableau de bord
            </a>
            <a href="{{ route('entreprise.profil.edit') }}" class="pb-4 border-b-2 border-transparent text-sm font-medium text-gray-600 hover:text-gray-900 hover:border-gray-300">
                Mon profil
            </a>
            <a href="{{ route('entreprise.offres.index') }}" class="pb-4 border-b-2 border-transparent text-sm font-medium text-gray-600 hover:text-gray-900 hover:border-gray-300">
                Mes offres
            </a>
            <a href="{{ route('entreprise.candidatures.index') }}" class="pb-4 border-b-2 border-gray-900 text-sm font-medium text-gray-900">
                Candidatures
            </a>
        </nav>
    </div>

    <!-- Filtres -->
    <div class="mb-6 flex gap-4">
        <form action="{{ route('entreprise.candidatures.index') }}" method="GET" class="flex gap-4">
            <select name="statut" class="px-3 py-2 border border-gray-300 rounded text-sm focus:outline-none focus:border-gray-900">
                <option value="">Tous les statuts</option>
                <option value="en_attente" {{ request('statut') == 'en_attente' ? 'selected' : '' }}>En attente</option>
                <option value="vue" {{ request('statut') == 'vue' ? 'selected' : '' }}>Vue</option>
                <option value="retenue" {{ request('statut') == 'retenue' ? 'selected' : '' }}>Retenue</option>
                <option value="rejetee" {{ request('statut') == 'rejetee' ? 'selected' : '' }}>Rejetée</option>
            </select>

            <select name="offre_id" class="px-3 py-2 border border-gray-300 rounded text-sm focus:outline-none focus:border-gray-900">
                <option value="">Toutes les offres</option>
                @foreach($offres as $offre)
                    <option value="{{ $offre->id }}" {{ request('offre_id') == $offre->id ? 'selected' : '' }}>
                        {{ $offre->titre }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="px-4 py-2 bg-gray-900 text-white text-sm font-medium rounded hover:bg-gray-800">
                Filtrer
            </button>
        </form>
    </div>

    <!-- Liste des candidatures -->
    @if($candidatures->count() > 0)
        <div class="bg-white border border-gray-200 rounded divide-y divide-gray-200">
            @foreach($candidatures as $candidature)
                <div class="p-6 hover:bg-gray-50 transition">
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 mb-1">
                                {{ $candidature->candidat->name }}
                            </h3>
                            <p class="text-sm text-gray-600 mb-2">
                                Pour : {{ $candidature->offre->titre }}
                            </p>
                            <div class="flex items-center gap-4 text-sm text-gray-500">
                                <span>{{ $candidature->created_at->format('d/m/Y') }}</span>
                                @if($candidature->vue_le)
                                    <span>•</span>
                                    <span>Vue le {{ $candidature->vue_le->format('d/m/Y') }}</span>
                                @endif
                            </div>
                        </div>
                        <span class="px-3 py-1 text-xs font-medium rounded
                            @if($candidature->statut === 'en_attente') bg-gray-100 text-gray-800
                            @elseif($candidature->statut === 'vue') bg-gray-200 text-gray-900
                            @elseif($candidature->statut === 'retenue') bg-gray-900 text-white
                            @else bg-gray-300 text-gray-700
                            @endif">
                            {{ ucfirst(str_replace('_', ' ', $candidature->statut)) }}
                        </span>
                    </div>
                    
                    <a href="{{ route('entreprise.candidatures.show', $candidature->id) }}" 
                       class="text-sm text-gray-900 font-medium hover:underline">
                        Voir le profil et la candidature →
                    </a>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $candidatures->links() }}
        </div>
    @else
        <div class="bg-white border border-gray-200 rounded p-12 text-center">
            <p class="text-gray-600">Aucune candidature reçue pour le moment.</p>
        </div>
    @endif
</div>
@endsection