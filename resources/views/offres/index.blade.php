@extends('layouts.app')

@section('title', 'Offres d\'emploi et stages au Bénin')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- Titre et nombre de résultats -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Offres d'emploi et stages</h1>
        <p class="text-gray-600">{{ $offres->total() }} offre(s) disponible(s)</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        
        <!-- Filtres (Sidebar) -->
        <div class="lg:col-span-1">
            <div class="bg-white border border-gray-200 rounded p-6 sticky top-4">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Filtres</h2>
                
                <form action="{{ route('offres.index') }}" method="GET">
                    
                    <!-- Recherche -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-900 mb-2">
                            Recherche
                        </label>
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request('search') }}"
                            placeholder="Mots-clés..." 
                            class="w-full px-3 py-2 border border-gray-300 rounded text-sm focus:outline-none focus:border-gray-900"
                        >
                    </div>

                    <!-- Catégorie -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-900 mb-2">
                            Catégorie
                        </label>
                        <select 
                            name="categorie" 
                            class="w-full px-3 py-2 border border-gray-300 rounded text-sm focus:outline-none focus:border-gray-900"
                        >
                            <option value="">Toutes les catégories</option>
                            @foreach($categories as $categorie)
                                <option value="{{ $categorie->id }}" {{ request('categorie') == $categorie->id ? 'selected' : '' }}>
                                    {{ $categorie->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Type d'offre -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-900 mb-2">
                            Type d'offre
                        </label>
                        <select 
                            name="type_offre" 
                            class="w-full px-3 py-2 border border-gray-300 rounded text-sm focus:outline-none focus:border-gray-900"
                        >
                            <option value="">Tous les types</option>
                            <option value="emploi" {{ request('type_offre') == 'emploi' ? 'selected' : '' }}>Emploi</option>
                            <option value="stage_professionnel" {{ request('type_offre') == 'stage_professionnel' ? 'selected' : '' }}>Stage professionnel</option>
                            <option value="stage_academique" {{ request('type_offre') == 'stage_academique' ? 'selected' : '' }}>Stage académique</option>
                        </select>
                    </div>

                    <!-- Ville -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-900 mb-2">
                            Ville
                        </label>
                        <select 
                            name="ville" 
                            class="w-full px-3 py-2 border border-gray-300 rounded text-sm focus:outline-none focus:border-gray-900"
                        >
                            <option value="">Toutes les villes</option>
                            @foreach($villes as $ville)
                                <option value="{{ $ville }}" {{ request('ville') == $ville ? 'selected' : '' }}>
                                    {{ $ville }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Type de contrat -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-900 mb-2">
                            Type de contrat
                        </label>
                        <select 
                            name="type_contrat" 
                            class="w-full px-3 py-2 border border-gray-300 rounded text-sm focus:outline-none focus:border-gray-900"
                        >
                            <option value="">Tous</option>
                            <option value="CDI" {{ request('type_contrat') == 'CDI' ? 'selected' : '' }}>CDI</option>
                            <option value="CDD" {{ request('type_contrat') == 'CDD' ? 'selected' : '' }}>CDD</option>
                            <option value="temps_partiel" {{ request('type_contrat') == 'temps_partiel' ? 'selected' : '' }}>Temps partiel</option>
                            <option value="freelance" {{ request('type_contrat') == 'freelance' ? 'selected' : '' }}>Freelance</option>
                            <option value="stage" {{ request('type_contrat') == 'stage' ? 'selected' : '' }}>Stage</option>
                        </select>
                    </div>

                    <!-- Boutons -->
                    <div class="flex gap-2">
                        <button 
                            type="submit" 
                            class="flex-1 px-4 py-2 bg-gray-900 text-white text-sm font-medium rounded hover:bg-gray-800"
                        >
                            Filtrer
                        </button>
                        <a 
                            href="{{ route('offres.index') }}" 
                            class="px-4 py-2 border border-gray-300 text-gray-900 text-sm font-medium rounded hover:bg-gray-50"
                        >
                            Réinitialiser
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Liste des offres -->
        <div class="lg:col-span-3">
            
            <!-- Tri -->
            <div class="mb-6 flex justify-end">
                <form action="{{ route('offres.index') }}" method="GET" class="inline">
                    <!-- Garder les filtres existants -->
                    <input type="hidden" name="search" value="{{ request('search') }}">
                    <input type="hidden" name="categorie" value="{{ request('categorie') }}">
                    <input type="hidden" name="type_offre" value="{{ request('type_offre') }}">
                    <input type="hidden" name="ville" value="{{ request('ville') }}">
                    <input type="hidden" name="type_contrat" value="{{ request('type_contrat') }}">
                    
                    <select 
                        name="sort" 
                        onchange="this.form.submit()"
                        class="px-3 py-2 border border-gray-300 rounded text-sm focus:outline-none focus:border-gray-900"
                    >
                        <option value="recent" {{ request('sort') == 'recent' ? 'selected' : '' }}>Plus récentes</option>
                        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Plus populaires</option>
                        <option value="deadline" {{ request('sort') == 'deadline' ? 'selected' : '' }}>Date limite</option>
                    </select>
                </form>
            </div>

            <!-- Offres -->
            <div class="space-y-4">
                @forelse($offres as $offre)
                    <div class="bg-white border border-gray-200 rounded p-6 hover:border-gray-900 transition">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <!-- Type et statut -->
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="text-xs font-medium text-gray-600 uppercase">
                                        @if($offre->type_offre === 'emploi')
                                            Emploi
                                        @elseif($offre->type_offre === 'stage_professionnel')
                                            Stage professionnel
                                        @else
                                            Stage académique
                                        @endif
                                    </span>
                                    @if($offre->type_contrat)
                                        <span class="text-xs text-gray-500">•</span>
                                        <span class="text-xs text-gray-600">{{ $offre->type_contrat }}</span>
                                    @endif
                                </div>

                                <!-- Titre -->
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">
                                    <a href="{{ route('offres.show', $offre->slug) }}" class="hover:underline">
                                        {{ $offre->titre }}
                                    </a>
                                </h3>

                                <!-- Entreprise et localisation -->
                                <div class="text-sm text-gray-600 mb-3">
                                    <span class="font-medium">{{ $offre->entreprise->nom_entreprise }}</span>
                                    <span class="mx-2">•</span>
                                    <span>{{ $offre->ville }}</span>
                                </div>

                                <!-- Description courte -->
                                <p class="text-sm text-gray-600 mb-4">
                                    {{ Str::limit($offre->description, 150) }}
                                </p>

                                <!-- Infos supplémentaires -->
                                <div class="flex items-center gap-4 text-xs text-gray-500">
                                    <span>{{ $offre->vues }} vues</span>
                                    <span>•</span>
                                    <span>Publié {{ $offre->created_at->diffForHumans() }}</span>
                                    @if($offre->date_limite)
                                        <span>•</span>
                                        <span>Date limite: {{ $offre->date_limite->format('d/m/Y') }}</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Logo entreprise (optionnel) -->
                            @if($offre->entreprise->logo)
                                <div class="ml-4">
                                    <img 
                                        src="{{ asset('storage/' . $offre->entreprise->logo) }}" 
                                        alt="{{ $offre->entreprise->nom_entreprise }}"
                                        class="w-16 h-16 object-contain border border-gray-200 rounded"
                                    >
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="bg-white border border-gray-200 rounded p-12 text-center">
                        <p class="text-gray-600 mb-4">Aucune offre ne correspond à vos critères.</p>
                        <a href="{{ route('offres.index') }}" class="text-sm text-gray-900 font-medium hover:underline">
                            Réinitialiser les filtres
                        </a>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $offres->links() }}
            </div>
        </div>
    </div>
</div>
@endsection