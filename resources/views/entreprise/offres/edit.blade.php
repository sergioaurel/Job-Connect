@extends('layouts.app')

@section('title', 'Modifier l\'offre')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- Bouton retour -->
    <div class="mb-6">
        <a href="{{ route('entreprise.offres.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
            ← Retour à mes offres
        </a>
    </div>

    <!-- En-tête -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Modifier l'offre</h1>
        <p class="text-gray-600">{{ $offre->titre }}</p>
    </div>

    <div class="bg-white border border-gray-200 rounded p-8">
        <form action="{{ route('entreprise.offres.update', $offre->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Type d'offre -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-900 mb-3">
                    Type d'offre *
                </label>
                <div class="grid grid-cols-3 gap-4">
                    <label class="relative cursor-pointer">
                        <input 
                            type="radio" 
                            name="type_offre" 
                            value="emploi" 
                            class="peer sr-only"
                            {{ old('type_offre', $offre->type_offre) == 'emploi' ? 'checked' : '' }}
                            required
                            onchange="toggleTypeContrat()"
                        >
                        <div class="border-2 border-gray-300 rounded p-4 text-center peer-checked:border-gray-900 peer-checked:bg-gray-50 hover:border-gray-400 transition">
                            <div class="font-medium text-gray-900">Emploi</div>
                        </div>
                    </label>

                    <label class="relative cursor-pointer">
                        <input 
                            type="radio" 
                            name="type_offre" 
                            value="stage_professionnel" 
                            class="peer sr-only"
                            {{ old('type_offre', $offre->type_offre) == 'stage_professionnel' ? 'checked' : '' }}
                            onchange="toggleTypeContrat()"
                        >
                        <div class="border-2 border-gray-300 rounded p-4 text-center peer-checked:border-gray-900 peer-checked:bg-gray-50 hover:border-gray-400 transition">
                            <div class="font-medium text-gray-900">Stage professionnel</div>
                        </div>
                    </label>

                    <label class="relative cursor-pointer">
                        <input 
                            type="radio" 
                            name="type_offre" 
                            value="stage_academique" 
                            class="peer sr-only"
                            {{ old('type_offre', $offre->type_offre) == 'stage_academique' ? 'checked' : '' }}
                            onchange="toggleTypeContrat()"
                        >
                        <div class="border-2 border-gray-300 rounded p-4 text-center peer-checked:border-gray-900 peer-checked:bg-gray-50 hover:border-gray-400 transition">
                            <div class="font-medium text-gray-900">Stage académique</div>
                        </div>
                    </label>
                </div>
                @error('type_offre')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Titre et catégorie -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <label for="titre" class="block text-sm font-medium text-gray-900 mb-2">
                        Titre du poste *
                    </label>
                    <input 
                        type="text" 
                        id="titre" 
                        name="titre" 
                        value="{{ old('titre', $offre->titre) }}"
                        required
                        placeholder="Ex: Développeur Web Senior"
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-gray-900 @error('titre') border-red-500 @enderror"
                    >
                    @error('titre')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="categorie_id" class="block text-sm font-medium text-gray-900 mb-2">
                        Catégorie *
                    </label>
                    <select 
                        id="categorie_id" 
                        name="categorie_id" 
                        required
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-gray-900 @error('categorie_id') border-red-500 @enderror"
                    >
                        <option value="">Sélectionner une catégorie</option>
                        @foreach($categories as $categorie)
                            <option value="{{ $categorie->id }}" 
                                {{ old('categorie_id', $offre->categorie_id) == $categorie->id ? 'selected' : '' }}>
                                {{ $categorie->nom }}
                            </option>
                        @endforeach
                    </select>
                    @error('categorie_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Type de contrat -->
            <div id="type_contrat_div" class="mb-6">
                <label for="type_contrat" class="block text-sm font-medium text-gray-900 mb-2">
                    Type de contrat *
                </label>
                <select 
                    id="type_contrat" 
                    name="type_contrat"
                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-gray-900"
                >
                    <option value="">Sélectionner un type</option>
                    <option value="CDI" {{ old('type_contrat', $offre->type_contrat) == 'CDI' ? 'selected' : '' }}>CDI</option>
                    <option value="CDD" {{ old('type_contrat', $offre->type_contrat) == 'CDD' ? 'selected' : '' }}>CDD</option>
                    <option value="temps_partiel" {{ old('type_contrat', $offre->type_contrat) == 'temps_partiel' ? 'selected' : '' }}>Temps partiel</option>
                    <option value="freelance" {{ old('type_contrat', $offre->type_contrat) == 'freelance' ? 'selected' : '' }}>Freelance</option>
                </select>
            </div>

            <!-- Description -->
            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-900 mb-2">
                    Description du poste *
                </label>
                <textarea 
                    id="description" 
                    name="description" 
                    rows="6"
                    required
                    placeholder="Décrivez le poste, le contexte, l'environnement de travail..."
                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-gray-900 @error('description') border-red-500 @enderror"
                >{{ old('description', $offre->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Missions -->
            <div class="mb-6">
                <label for="missions" class="block text-sm font-medium text-gray-900 mb-2">
                    Missions principales *
                </label>
                <textarea 
                    id="missions" 
                    name="missions" 
                    rows="6"
                    required
                    placeholder="- Mission 1&#10;- Mission 2&#10;- Mission 3"
                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-gray-900 @error('missions') border-red-500 @enderror"
                >{{ old('missions', $offre->missions) }}</textarea>
                @error('missions')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Profil recherché -->
            <div class="mb-6">
                <label for="profil_recherche" class="block text-sm font-medium text-gray-900 mb-2">
                    Profil recherché *
                </label>
                <textarea 
                    id="profil_recherche" 
                    name="profil_recherche" 
                    rows="6"
                    required
                    placeholder="- Diplôme requis&#10;- Qualités recherchées&#10;- Savoir-être attendu"
                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-gray-900 @error('profil_recherche') border-red-500 @enderror"
                >{{ old('profil_recherche', $offre->profil_recherche) }}</textarea>
                @error('profil_recherche')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Compétences requises -->
            <div class="mb-6">
                <label for="competences_requises" class="block text-sm font-medium text-gray-900 mb-2">
                    Compétences requises
                </label>
                <input 
                    type="text" 
                    id="competences_requises" 
                    name="competences_requises" 
                    value="{{ old('competences_requises', $offre->competences_requises) }}"
                    placeholder="Ex: PHP, Laravel, JavaScript, MySQL (séparées par des virgules)"
                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-gray-900"
                >
                <p class="mt-1 text-xs text-gray-500">Séparez les compétences par des virgules</p>
            </div>

            <!-- Niveau d'étude et expérience -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <label for="niveau_etude" class="block text-sm font-medium text-gray-900 mb-2">
                        Niveau d'études requis *
                    </label>
                    <input 
                        type="text" 
                        id="niveau_etude" 
                        name="niveau_etude" 
                        value="{{ old('niveau_etude', $offre->niveau_etude) }}"
                        required
                        placeholder="Ex: Bac+3, Licence, Master"
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-gray-900"
                    >
                </div>

                <div>
                    <label for="annees_experience" class="block text-sm font-medium text-gray-900 mb-2">
                        Années d'expérience requises *
                    </label>
                    <input 
                        type="number" 
                        id="annees_experience" 
                        name="annees_experience" 
                        value="{{ old('annees_experience', $offre->annees_experience ?? $offre->experience_requise ?? 0) }}"
                        min="0"
                        required
                        placeholder="0 pour débutant"
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-gray-900"
                    >
                </div>
            </div>

            <!-- Ville -->
            <div class="mb-6">
                <label for="ville" class="block text-sm font-medium text-gray-900 mb-2">
                    Ville *
                </label>
                <input 
                    type="text" 
                    id="ville" 
                    name="ville" 
                    value="{{ old('ville', $offre->ville) }}"
                    required
                    placeholder="Ex: Cotonou, Porto-Novo, Parakou"
                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-gray-900"
                >
            </div>

            <!-- Salaire -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-900 mb-3">
                    Rémunération
                </label>
                <div class="flex items-center mb-3">
                    <input 
                        type="checkbox" 
                        id="salaire_a_negocier" 
                        name="salaire_a_negocier" 
                        value="1"
                        {{ old('salaire_a_negocier', $offre->salaire_a_negocier ?? false) ? 'checked' : '' }}
                        onchange="toggleSalaire(this)"
                        class="rounded border-gray-300"
                    >
                    <label for="salaire_a_negocier" class="ml-2 text-sm text-gray-900">
                        À négocier
                    </label>
                </div>
                <div id="salaire_fields" class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="salaire_min" class="block text-sm text-gray-700 mb-2">
                            Salaire minimum (FCFA)
                        </label>
                        <input 
                            type="number" 
                            id="salaire_min" 
                            name="salaire_min" 
                            value="{{ old('salaire_min', $offre->salaire_min) }}"
                            placeholder="150000"
                            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-gray-900"
                        >
                    </div>
                    <div>
                        <label for="salaire_max" class="block text-sm text-gray-700 mb-2">
                            Salaire maximum (FCFA)
                        </label>
                        <input 
                            type="number" 
                            id="salaire_max" 
                            name="salaire_max" 
                            value="{{ old('salaire_max', $offre->salaire_max) }}"
                            placeholder="250000"
                            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-gray-900"
                        >
                    </div>
                </div>
            </div>

            <!-- Nombre de postes et date limite -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <label for="nombre_postes" class="block text-sm font-medium text-gray-900 mb-2">
                        Nombre de postes *
                    </label>
                    <input 
                        type="number" 
                        id="nombre_postes" 
                        name="nombre_postes" 
                        value="{{ old('nombre_postes', $offre->nombre_postes ?? 1) }}"
                        min="1"
                        required
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-gray-900"
                    >
                </div>

                <div>
                    <label for="date_limite" class="block text-sm font-medium text-gray-900 mb-2">
                        Date limite de candidature
                    </label>
                    <input 
                        type="date" 
                        id="date_limite" 
                        name="date_limite" 
                        value="{{ old('date_limite', $offre->date_limite ? $offre->date_limite->format('Y-m-d') : '') }}"
                        min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-gray-900"
                    >
                </div>
            </div>

            <!-- Boutons -->
            <div class="flex gap-3 pt-6 border-t border-gray-200">
                <button 
                    type="submit" 
                    class="px-6 py-3 bg-gray-900 text-white font-medium rounded hover:bg-gray-800"
                >
                    Enregistrer les modifications
                </button>
                <a 
                    href="{{ route('entreprise.offres.show', $offre->id) }}" 
                    class="px-6 py-3 border border-gray-300 text-gray-900 font-medium rounded hover:bg-gray-50"
                >
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function toggleTypeContrat() {
        const typeOffre = document.querySelector('input[name="type_offre"]:checked').value;
        const typeContratDiv = document.getElementById('type_contrat_div');
        const typeContratSelect = document.getElementById('type_contrat');
        
        if (typeOffre === 'emploi') {
            typeContratDiv.style.display = 'block';
            typeContratSelect.required = true;
        } else {
            typeContratDiv.style.display = 'none';
            typeContratSelect.required = false;
            typeContratSelect.value = '';
        }
    }

    function toggleSalaire(checkbox) {
        const salaireFields = document.getElementById('salaire_fields');
        const salaireMin = document.getElementById('salaire_min');
        const salaireMax = document.getElementById('salaire_max');
        
        if (checkbox.checked) {
            salaireFields.style.display = 'none';
            salaireMin.value = '';
            salaireMax.value = '';
        } else {
            salaireFields.style.display = 'grid';
        }
    }

    // État initial
    toggleTypeContrat();
    
    const salaireNegocier = document.getElementById('salaire_a_negocier');
    if (salaireNegocier.checked) {
        toggleSalaire(salaireNegocier);
    }
</script>
@endpush
@endsection