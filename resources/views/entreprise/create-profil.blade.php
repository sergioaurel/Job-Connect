@extends('layouts.app')

@section('title', 'Créer mon profil entreprise')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Créer mon profil entreprise</h1>
        <p class="text-gray-600">Complétez les informations de votre entreprise</p>
    </div>

    <div class="bg-white border border-gray-200 rounded p-8">
        <form action="{{ route('entreprise.profil.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Nom de l'entreprise -->
            <div class="mb-6">
                <label for="nom_entreprise" class="block text-sm font-medium text-gray-900 mb-2">
                    Nom de l'entreprise *
                </label>
                <input 
                    type="text" 
                    id="nom_entreprise" 
                    name="nom_entreprise" 
                    value="{{ old('nom_entreprise') }}"
                    required
                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-gray-900 @error('nom_entreprise') border-red-500 @enderror"
                >
                @error('nom_entreprise')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-900 mb-2">
                    Description de l'entreprise *
                </label>
                <textarea 
                    id="description" 
                    name="description" 
                    rows="6"
                    required
                    placeholder="Présentez votre entreprise, votre activité, vos valeurs..."
                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-gray-900 @error('description') border-red-500 @enderror"
                >{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-gray-500">Minimum 100 caractères</p>
            </div>

            <!-- Secteur et Site web -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <label for="secteur_activite" class="block text-sm font-medium text-gray-900 mb-2">
                        Secteur d'activité *
                    </label>
                    <input 
                        type="text" 
                        id="secteur_activite" 
                        name="secteur_activite" 
                        value="{{ old('secteur_activite') }}"
                        required
                        placeholder="Ex: Technologies, Finance, Santé..."
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-gray-900"
                    >
                </div>

                <div>
                    <label for="site_web" class="block text-sm font-medium text-gray-900 mb-2">
                        Site web
                    </label>
                    <input 
                        type="url" 
                        id="site_web" 
                        name="site_web" 
                        value="{{ old('site_web') }}"
                        placeholder="https://www.exemple.com"
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-gray-900"
                    >
                </div>
            </div>

            <!-- Adresse et Ville -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <label for="adresse" class="block text-sm font-medium text-gray-900 mb-2">
                        Adresse *
                    </label>
                    <input 
                        type="text" 
                        id="adresse" 
                        name="adresse" 
                        value="{{ old('adresse') }}"
                        required
                        placeholder="Rue, quartier..."
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-gray-900"
                    >
                </div>

                <div>
                    <label for="ville" class="block text-sm font-medium text-gray-900 mb-2">
                        Ville *
                    </label>
                    <input 
                        type="text" 
                        id="ville" 
                        name="ville" 
                        value="{{ old('ville', 'Cotonou') }}"
                        required
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-gray-900"
                    >
                </div>
            </div>

            <!-- Téléphone -->
            <div class="mb-6">
                <label for="telephone_entreprise" class="block text-sm font-medium text-gray-900 mb-2">
                    Téléphone de l'entreprise *
                </label>
                <input 
                    type="text" 
                    id="telephone_entreprise" 
                    name="telephone_entreprise" 
                    value="{{ old('telephone_entreprise') }}"
                    required
                    placeholder="+229 XX XX XX XX"
                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-gray-900"
                >
            </div>

            <!-- Effectif et Année de création -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <label for="effectif" class="block text-sm font-medium text-gray-900 mb-2">
                        Nombre d'employés
                    </label>
                    <input 
                        type="number" 
                        id="effectif" 
                        name="effectif" 
                        value="{{ old('effectif') }}"
                        min="1"
                        placeholder="Ex: 50"
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-gray-900"
                    >
                </div>

                <div>
                    <label for="annee_creation" class="block text-sm font-medium text-gray-900 mb-2">
                        Année de création
                    </label>
                    <input 
                        type="number" 
                        id="annee_creation" 
                        name="annee_creation" 
                        value="{{ old('annee_creation') }}"
                        min="1900"
                        max="{{ date('Y') }}"
                        placeholder="{{ date('Y') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-gray-900"
                    >
                </div>
            </div>

            <!-- Logo -->
            <div class="mb-6">
                <label for="logo" class="block text-sm font-medium text-gray-900 mb-2">
                    Logo de l'entreprise
                </label>
                <input 
                    type="file" 
                    id="logo" 
                    name="logo" 
                    accept=".jpg,.jpeg,.png"
                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-gray-900"
                >
                <p class="mt-1 text-xs text-gray-500">Formats acceptés : JPG, PNG (max 2 Mo)</p>
            </div>

            <!-- Boutons -->
            <div class="flex gap-3 pt-6 border-t border-gray-200">
                <button 
                    type="submit" 
                    class="px-6 py-3 bg-gray-900 text-white font-medium rounded hover:bg-gray-800"
                >
                    Créer mon profil
                </button>
            </div>
        </form>
    </div>
</div>
@endsection