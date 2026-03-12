@extends('layouts.app')

@section('title', 'Mes candidatures')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Mes candidatures</h1>
        <p class="text-gray-600">{{ $candidatures->total() }} candidature(s)</p>
    </div>

    <!-- Menu de navigation -->
    <div class="mb-8 border-b border-gray-200">
        <nav class="flex space-x-8">
            <a href="{{ route('candidat.dashboard') }}" class="pb-4 border-b-2 border-transparent text-sm font-medium text-gray-600 hover:text-gray-900 hover:border-gray-300">
                Tableau de bord
            </a>
            <a href="{{ route('candidat.profil') }}" class="pb-4 border-b-2 border-transparent text-sm font-medium text-gray-600 hover:text-gray-900 hover:border-gray-300">
                Mon profil
            </a>
            <a href="{{ route('candidat.candidatures') }}" class="pb-4 border-b-2 border-gray-900 text-sm font-medium text-gray-900">
                Mes candidatures
            </a>
            <a href="{{ route('candidat.favoris') }}" class="pb-4 border-b-2 border-transparent text-sm font-medium text-gray-600 hover:text-gray-900 hover:border-gray-300">
                Mes favoris
            </a>
        </nav>
    </div>

    <div class="space-y-4">
        @forelse($candidatures as $candidature)
            <div class="bg-white border border-gray-200 rounded p-6">
                <div class="flex justify-between items-start mb-4">
                    <div class="flex-1">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">
                            <a href="{{ route('offres.show', $candidature->offre->slug) }}" class="hover:underline">
                                {{ $candidature->offre->titre }}
                            </a>
                        </h3>
                        <p class="text-sm text-gray-600 mb-1">
                            {{ $candidature->offre->entreprise->nom_entreprise }}
                        </p>
                        <p class="text-sm text-gray-500">
                            {{ $candidature->offre->ville }}
                        </p>
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

                <div class="border-t border-gray-200 pt-4">
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="text-gray-600">Date de candidature :</span>
                            <span class="font-medium text-gray-900 ml-1">{{ $candidature->created_at->format('d/m/Y') }}</span>
                        </div>
                        @if($candidature->vue_le)
                            <div>
                                <span class="text-gray-600">Vue le :</span>
                                <span class="font-medium text-gray-900 ml-1">{{ $candidature->vue_le->format('d/m/Y') }}</span>
                            </div>
                        @endif
                    </div>

                    @if($candidature->note_recruteur)
                        <div class="mt-4 p-3 bg-gray-50 border border-gray-200 rounded">
                            <p class="text-sm font-medium text-gray-900 mb-1">Note du recruteur :</p>
                            <p class="text-sm text-gray-600">{{ $candidature->note_recruteur }}</p>
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="bg-white border border-gray-200 rounded p-12 text-center">
                <p class="text-gray-600 mb-4">Vous n'avez encore envoyé aucune candidature.</p>
                <a href="{{ route('offres.index') }}" class="inline-block px-6 py-3 bg-gray-900 text-white font-medium rounded hover:bg-gray-800">
                    Parcourir les offres
                </a>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($candidatures->hasPages())
        <div class="mt-8">
            {{ $candidatures->links() }}
        </div>
    @endif
</div>
@endsection