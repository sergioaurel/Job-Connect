@extends('layouts.app')

@section('title', $offre->titre . ' - ' . $offre->entreprise->nom_entreprise)

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- Bouton retour -->
    <div class="mb-6">
        <a href="{{ route('offres.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
            ← Retour aux offres
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Contenu principal -->
        <div class="lg:col-span-2">
            <div class="bg-white border border-gray-200 rounded p-8">
                
                <!-- En-tête -->
                <div class="mb-8">
                    <!-- Type -->
                    <div class="text-xs font-medium text-gray-600 uppercase mb-3">
                        @if($offre->type_offre === 'emploi')
                            Emploi
                        @elseif($offre->type_offre === 'stage_professionnel')
                            Stage professionnel
                        @else
                            Stage académique
                        @endif
                        @if($offre->type_contrat)
                            • {{ $offre->type_contrat }}
                        @endif
                    </div>

                    <!-- Titre -->
                    <h1 class="text-3xl font-bold text-gray-900 mb-4">
                        {{ $offre->titre }}
                    </h1>

                    <!-- Entreprise -->
                    <div class="flex items-center gap-4 mb-6">
                        @if($offre->entreprise->logo)
                            <img 
                                src="{{ asset('storage/' . $offre->entreprise->logo) }}" 
                                alt="{{ $offre->entreprise->nom_entreprise }}"
                                class="w-16 h-16 object-contain border border-gray-200 rounded"
                            >
                        @endif
                        <div>
                            <div class="text-lg font-semibold text-gray-900">
                                {{ $offre->entreprise->nom_entreprise }}
                            </div>
                            <div class="text-sm text-gray-600">
                                {{ $offre->ville }}
                            </div>
                        </div>
                    </div>

                    <!-- Statistiques -->
                    <div class="flex items-center gap-4 text-sm text-gray-500 pb-6 border-b border-gray-200">
                        <span>{{ $offre->vues }} vues</span>
                        <span>•</span>
                        <span>Publié {{ $offre->created_at->diffForHumans() }}</span>
                        @if($offre->date_limite)
                            <span>•</span>
                            <span>Candidatez avant le {{ $offre->date_limite->format('d/m/Y') }}</span>
                        @endif
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Description du poste</h2>
                    <div class="prose prose-sm max-w-none text-gray-600">
                        {!! nl2br(e($offre->description)) !!}
                    </div>
                </div>

                <!-- Missions -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Missions principales</h2>
                    <div class="prose prose-sm max-w-none text-gray-600">
                        {!! nl2br(e($offre->missions)) !!}
                    </div>
                </div>

                <!-- Profil recherché -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Profil recherché</h2>
                    <div class="prose prose-sm max-w-none text-gray-600">
                        {!! nl2br(e($offre->profil_recherche)) !!}
                    </div>
                </div>

                <!-- Compétences requises -->
                @if($offre->competences_requises)
                    <div class="mb-8">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">Compétences requises</h2>
                        <div class="flex flex-wrap gap-2">
                            @foreach(explode(',', $offre->competences_requises) as $competence)
                                <span class="px-3 py-1 bg-gray-100 text-gray-900 text-sm rounded">
                                    {{ trim($competence) }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Informations complémentaires -->
                <div class="border-t border-gray-200 pt-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Informations complémentaires</h2>
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <div class="text-gray-600 mb-1">Niveau d'études</div>
                            <div class="font-medium text-gray-900">{{ $offre->niveau_etude }}</div>
                        </div>
                        <div>
                            <div class="text-gray-600 mb-1">Expérience requise</div>
                            <div class="font-medium text-gray-900">
                                @if($offre->annees_experience == 0)
                                    Débutant accepté
                                @else
                                    {{ $offre->annees_experience }} an(s)
                                @endif
                            </div>
                        </div>
                        @if($offre->salaire_min || $offre->salaire_max)
                            <div>
                                <div class="text-gray-600 mb-1">Salaire</div>
                                <div class="font-medium text-gray-900">
                                    @if($offre->salaire_a_negocier)
                                        À négocier
                                    @else
                                        {{ number_format($offre->salaire_min, 0, ',', ' ') }} - {{ number_format($offre->salaire_max, 0, ',', ' ') }} FCFA
                                    @endif
                                </div>
                            </div>
                        @endif
                        <div>
                            <div class="text-gray-600 mb-1">Nombre de postes</div>
                            <div class="font-medium text-gray-900">{{ $offre->nombre_postes }}</div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Offres similaires -->
            @if($offresSimilaires->count() > 0)
                <div class="mt-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Offres similaires</h2>
                    <div class="space-y-4">
                        @foreach($offresSimilaires as $offreSimilaire)
                            <div class="bg-white border border-gray-200 rounded p-4 hover:border-gray-900 transition">
                                <h3 class="font-semibold text-gray-900 mb-1">
                                    <a href="{{ route('offres.show', $offreSimilaire->slug) }}" class="hover:underline">
                                        {{ $offreSimilaire->titre }}
                                    </a>
                                </h3>
                                <div class="text-sm text-gray-600">
                                    {{ $offreSimilaire->entreprise->nom_entreprise }} • {{ $offreSimilaire->ville }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white border border-gray-200 rounded p-6 sticky top-4">
                
                @auth
                    @if(auth()->user()->isCandidat())
                        @if($aPostule)
                            <!-- Déjà postulé -->
                            <div class="mb-4 p-3 bg-gray-100 border border-gray-300 rounded text-center">
                                <p class="text-sm font-medium text-gray-900">Vous avez déjà postulé à cette offre</p>
                            </div>
                        @else
                            <!-- Bouton postuler -->
                            <a 
                                href="{{ route('candidat.candidatures.create', $offre->id) }}" 
                                class="block w-full px-4 py-3 bg-gray-900 text-white text-center font-medium rounded hover:bg-gray-800 mb-4"
                            >
                                Postuler maintenant
                            </a>
                        @endif

                        <!-- Bouton favoris -->
                        <button 
                            onclick="toggleFavori({{ $offre->id }})"
                            id="favori-btn"
                            class="block w-full px-4 py-2 border border-gray-300 text-gray-900 text-center font-medium rounded hover:bg-gray-50"
                        >
                            @if($estFavori)
                                ★ Retirer des favoris
                            @else
                                ☆ Ajouter aux favoris
                            @endif
                        </button>
                    @endif
                @else
                    <!-- Non connecté -->
                    <div class="mb-4 p-3 bg-gray-50 border border-gray-200 rounded">
                        <p class="text-sm text-gray-600 mb-3">Connectez-vous pour postuler à cette offre</p>
                        <a 
                            href="{{ route('login') }}" 
                            class="block w-full px-4 py-2 bg-gray-900 text-white text-center font-medium rounded hover:bg-gray-800"
                        >
                            Se connecter
                        </a>
                    </div>
                @endauth

                <!-- Informations entreprise -->
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <h3 class="font-semibold text-gray-900 mb-4">À propos de l'entreprise</h3>
                    
                    @if($offre->entreprise->description)
                        <p class="text-sm text-gray-600 mb-4">
                            {{ Str::limit($offre->entreprise->description, 200) }}
                        </p>
                    @endif

                    <div class="space-y-2 text-sm">
                        @if($offre->entreprise->secteur_activite)
                            <div>
                                <span class="text-gray-600">Secteur:</span>
                                <span class="font-medium text-gray-900 ml-1">{{ $offre->entreprise->secteur_activite }}</span>
                            </div>
                        @endif
                        @if($offre->entreprise->effectif)
                            <div>
                                <span class="text-gray-600">Effectif:</span>
                                <span class="font-medium text-gray-900 ml-1">{{ $offre->entreprise->effectif }} employés</span>
                            </div>
                        @endif
                        @if($offre->entreprise->site_web)
                            <div>
                                <a href="{{ $offre->entreprise->site_web }}" target="_blank" class="text-gray-900 hover:underline">
                                    Visiter le site web →
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@auth
    @if(auth()->user()->isCandidat())
        @push('scripts')
        <script>
            function toggleFavori(offreId) {
                fetch(`/candidat/favoris/toggle/${offreId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    const btn = document.getElementById('favori-btn');
                    if (data.estFavori) {
                        btn.textContent = '★ Retirer des favoris';
                    } else {
                        btn.textContent = '☆ Ajouter aux favoris';
                    }
                })
                .catch(error => console.error('Erreur:', error));
            }
        </script>
        @endpush
    @endif
@endauth
@endsection