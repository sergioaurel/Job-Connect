@extends('layouts.app')

@section('title', 'Postuler - ' . $offre->titre)

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- Bouton retour -->
    <div class="mb-6">
        <a href="{{ route('offres.show', $offre->slug) }}" class="text-sm text-gray-600 hover:text-gray-900">
            ← Retour à l'offre
        </a>
    </div>

    <!-- En-tête -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Postuler à cette offre</h1>
        <p class="text-gray-600">{{ $offre->titre }} - {{ $offre->entreprise->nom_entreprise }}</p>
    </div>

    <!-- Alerte profil incomplet -->
    @if(!auth()->user()->profilComplete())
        <div class="mb-8 bg-white border border-gray-900 rounded p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-2">
                Complétez votre profil avant de postuler
            </h3>
            <p class="text-sm text-gray-600 mb-4">
                Un profil complet (avec expériences, formations et compétences) augmente vos chances d'être retenu.
            </p>
            <a href="{{ route('candidat.profil') }}" 
               class="inline-block px-4 py-2 bg-gray-900 text-white text-sm font-medium rounded hover:bg-gray-800">
                Compléter mon profil
            </a>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Formulaire -->
        <div class="lg:col-span-2">
            <div class="bg-white border border-gray-200 rounded p-8">
                <form action="{{ route('candidat.candidatures.store', $offre->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Lettre de motivation -->
                    <div class="mb-6">
                        <label for="lettre_motivation" class="block text-sm font-medium text-gray-900 mb-2">
                            Lettre de motivation *
                        </label>
                        <p class="text-sm text-gray-600 mb-3">
                            Expliquez pourquoi vous êtes le candidat idéal pour ce poste (minimum 100 caractères).
                        </p>
                        <textarea 
                            id="lettre_motivation" 
                            name="lettre_motivation" 
                            rows="12"
                            required
                            placeholder="Madame, Monsieur,

Je me permets de vous adresser ma candidature pour le poste de..."
                            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-gray-900 @error('lettre_motivation') border-red-500 @enderror"
                        >{{ old('lettre_motivation') }}</textarea>
                        @error('lettre_motivation')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-2 text-xs text-gray-500">
                            <span id="char-count">0</span> caractères
                        </p>
                    </div>

                    <!-- CV -->
                    <div class="mb-6">
                        <label for="cv" class="block text-sm font-medium text-gray-900 mb-2">
                            CV (optionnel)
                        </label>
                        <p class="text-sm text-gray-600 mb-3">
                            Vous pouvez joindre votre CV au format PDF (max 2 Mo).
                        </p>
                        <input 
                            type="file" 
                            id="cv" 
                            name="cv" 
                            accept=".pdf"
                            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-gray-900 @error('cv') border-red-500 @enderror"
                        >
                        @error('cv')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-gray-500">
                            Format accepté : PDF uniquement (max 2 Mo)
                        </p>
                    </div>

                    <!-- Informations partagées -->
                    <div class="mb-6 p-4 bg-gray-50 border border-gray-200 rounded">
                        <h4 class="text-sm font-semibold text-gray-900 mb-3">
                            Informations qui seront partagées avec l'entreprise
                        </h4>
                        <ul class="space-y-2 text-sm text-gray-600">
                            <li>• Votre nom : <span class="font-medium text-gray-900">{{ auth()->user()->name }}</span></li>
                            <li>• Votre email : <span class="font-medium text-gray-900">{{ auth()->user()->email }}</span></li>
                            <li>• Votre téléphone : <span class="font-medium text-gray-900">{{ auth()->user()->telephone ?? 'Non renseigné' }}</span></li>
                            <li>• Votre localisation : <span class="font-medium text-gray-900">{{ auth()->user()->localisation ?? 'Non renseignée' }}</span></li>
                            <li>• Vos expériences professionnelles</li>
                            <li>• Vos formations</li>
                            <li>• Vos compétences</li>
                            <li>• Votre lettre de motivation</li>
                            @if(request()->hasFile('cv'))
                                <li>• Votre CV</li>
                            @endif
                        </ul>
                    </div>

                    <!-- Boutons -->
                    <div class="flex gap-3">
                        <button 
                            type="submit" 
                            class="px-6 py-3 bg-gray-900 text-white font-medium rounded hover:bg-gray-800"
                        >
                            Envoyer ma candidature
                        </button>
                        <a 
                            href="{{ route('offres.show', $offre->slug) }}" 
                            class="px-6 py-3 border border-gray-300 text-gray-900 font-medium rounded hover:bg-gray-50"
                        >
                            Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white border border-gray-200 rounded p-6 sticky top-4">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Détails de l'offre</h3>
                
                <div class="space-y-3 text-sm">
                    <div>
                        <div class="text-gray-600 mb-1">Poste</div>
                        <div class="font-medium text-gray-900">{{ $offre->titre }}</div>
                    </div>
                    
                    <div>
                        <div class="text-gray-600 mb-1">Entreprise</div>
                        <div class="font-medium text-gray-900">{{ $offre->entreprise->nom_entreprise }}</div>
                    </div>
                    
                    <div>
                        <div class="text-gray-600 mb-1">Localisation</div>
                        <div class="font-medium text-gray-900">{{ $offre->ville }}</div>
                    </div>
                    
                    <div>
                        <div class="text-gray-600 mb-1">Type</div>
                        <div class="font-medium text-gray-900">
                            @if($offre->type_offre === 'emploi')
                                Emploi - {{ $offre->type_contrat }}
                            @elseif($offre->type_offre === 'stage_professionnel')
                                Stage professionnel
                            @else
                                Stage académique
                            @endif
                        </div>
                    </div>
                    
                    @if($offre->date_limite)
                        <div>
                            <div class="text-gray-600 mb-1">Date limite</div>
                            <div class="font-medium text-gray-900">{{ $offre->date_limite->format('d/m/Y') }}</div>
                        </div>
                    @endif
                </div>

                <div class="mt-6 pt-6 border-t border-gray-200">
                    <h4 class="text-sm font-semibold text-gray-900 mb-3">Conseils</h4>
                    <ul class="space-y-2 text-sm text-gray-600">
                        <li>• Relisez attentivement votre lettre</li>
                        <li>• Personnalisez votre candidature</li>
                        <li>• Mettez en avant vos compétences</li>
                        <li>• Soyez concis et clair</li>
                        <li>• Vérifiez votre profil avant d'envoyer</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Compteur de caractères
    const textarea = document.getElementById('lettre_motivation');
    const charCount = document.getElementById('char-count');
    
    textarea.addEventListener('input', function() {
        charCount.textContent = this.value.length;
    });
    
    // Initial count
    charCount.textContent = textarea.value.length;
</script>
@endpush
@endsection