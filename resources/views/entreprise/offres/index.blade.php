@extends('layouts.app')

@section('title', 'Mes offres')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- En-tête -->
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Mes offres</h1>
            <p class="text-gray-600">Gérez vos offres d'emploi et de stages</p>
        </div>
        @if($entreprise->isValidee())
            <a href="{{ route('entreprise.offres.create') }}" 
               class="px-6 py-3 bg-gray-900 text-white font-medium rounded hover:bg-gray-800">
                + Nouvelle offre
            </a>
        @endif
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
            <a href="{{ route('entreprise.offres.index') }}" class="pb-4 border-b-2 border-gray-900 text-sm font-medium text-gray-900">
                Mes offres
            </a>
            <a href="{{ route('entreprise.candidatures.index') }}" class="pb-4 border-b-2 border-transparent text-sm font-medium text-gray-600 hover:text-gray-900 hover:border-gray-300">
                Candidatures
            </a>
        </nav>
    </div>

    @if($entreprise->isValidee())
        <!-- Liste des offres -->
        @if($offres->count() > 0)
            <div class="bg-white border border-gray-200 rounded">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    Titre
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    Type
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    Statut
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    Candidatures
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    Date
                                </th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($offres as $offre)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $offre->titre }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $offre->ville }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">
                                            @if($offre->type_offre === 'emploi')
                                                Emploi
                                            @elseif($offre->type_offre === 'stage_professionnel')
                                                Stage pro
                                            @else
                                                Stage académique
                                            @endif
                                        </div>
                                        @if($offre->type_contrat)
                                            <div class="text-sm text-gray-500">{{ $offre->type_contrat }}</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 text-xs font-medium rounded
                                            @if($offre->statut === 'active') bg-gray-900 text-white
                                            @elseif($offre->statut === 'fermee') bg-gray-200 text-gray-700
                                            @else bg-gray-300 text-gray-800
                                            @endif">
                                            {{ ucfirst($offre->statut) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('entreprise.candidatures.offre', $offre->id) }}" 
                                           class="text-sm font-medium text-gray-900 hover:underline">
                                            {{ $offre->candidatures_count }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{ $offre->created_at->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-right text-sm space-x-2">
                                        <a href="{{ route('offres.show', $offre->slug) }}" 
                                           target="_blank"
                                           class="text-gray-600 hover:text-gray-900">
                                            Voir
                                        </a>
                                        <a href="{{ route('entreprise.offres.edit', $offre->id) }}" 
                                           class="text-gray-600 hover:text-gray-900">
                                            Modifier
                                        </a>
                                        
                                        @if($offre->statut === 'active')
                                            <form action="{{ route('entreprise.offres.change-status', $offre->id) }}" 
                                                  method="POST" 
                                                  class="inline"
                                                  onsubmit="return confirm('Fermer cette offre ?')">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="statut" value="fermee">
                                                <button type="submit" class="text-gray-600 hover:text-gray-900">
                                                    Fermer
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('entreprise.offres.change-status', $offre->id) }}" 
                                                  method="POST" 
                                                  class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="statut" value="active">
                                                <button type="submit" class="text-gray-600 hover:text-gray-900">
                                                    Réactiver
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $offres->links() }}
                </div>
            </div>
        @else
            <!-- Aucune offre -->
            <div class="bg-white border border-gray-200 rounded p-12 text-center">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">
                    Aucune offre publiée
                </h3>
                <p class="text-gray-600 mb-6">
                    Commencez par publier votre première offre d'emploi ou de stage.
                </p>
                <a href="{{ route('entreprise.offres.create') }}" 
                   class="inline-block px-6 py-3 bg-gray-900 text-white font-medium rounded hover:bg-gray-800">
                    + Publier une offre
                </a>
            </div>
        @endif
    @else
        <!-- Entreprise non validée -->
        <div class="bg-white border border-gray-900 rounded p-8 text-center">
            <h3 class="text-lg font-semibold text-gray-900 mb-2">
                Votre entreprise doit être validée
            </h3>
            <p class="text-gray-600">
                Un administrateur doit valider votre profil avant que vous puissiez publier des offres.
            </p>
        </div>
    @endif
</div>
@endsection