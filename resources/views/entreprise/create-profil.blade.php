@extends('layouts.app')

@section('title', 'Créer mon profil entreprise')

@section('content')

<div class="bg-gray-950 border-b border-white/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <p class="text-yellow-400 text-xs font-extrabold tracking-widest uppercase mb-1">Espace Entreprise</p>
        <h1 class="text-white font-extrabold text-2xl" style="letter-spacing:-0.02em">Créer mon profil entreprise</h1>
    </div>
</div>

<div class="bg-gray-50 min-h-screen">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        {{-- Intro --}}
        <div class="bg-white border border-gray-200 rounded-2xl p-6 mb-6 flex items-start gap-4">
            <div class="w-10 h-10 bg-yellow-50 rounded-xl flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-sm font-extrabold text-gray-900 mb-0.5">Bienvenue sur JobConnect !</p>
                <p class="text-xs text-gray-500 leading-relaxed">Complétez votre profil entreprise pour être validé par notre équipe. Une fois validé, vous pourrez publier des offres d'emploi et de stages.</p>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
            <form action="{{ route('entreprise.profil.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- ── IDENTITÉ ── --}}
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                    <p class="text-xs font-extrabold text-gray-500 uppercase tracking-widest">Identité de l'entreprise</p>
                </div>
                <div class="p-6 space-y-5">

                    <div>
                        <label for="nom_entreprise" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nom de l'entreprise <span class="text-red-400">*</span>
                        </label>
                        <input type="text" id="nom_entreprise" name="nom_entreprise"
                               value="{{ old('nom_entreprise') }}" required
                               placeholder="Ex: Société Nationale de Bénin"
                               class="w-full px-4 py-3 text-sm rounded-xl border bg-gray-50 text-gray-900 placeholder-gray-400 focus:outline-none focus:bg-white focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 transition-all
                               @error('nom_entreprise') border-red-400 bg-red-50 @else border-gray-200 @enderror">
                        @error('nom_entreprise') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                            Description <span class="text-red-400">*</span>
                        </label>
                        <textarea id="description" name="description" rows="5" required
                                  placeholder="Présentez votre entreprise, votre activité, vos valeurs..."
                                  class="w-full px-4 py-3 text-sm rounded-xl border bg-gray-50 text-gray-900 placeholder-gray-400 focus:outline-none focus:bg-white focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 transition-all resize-none
                                  @error('description') border-red-400 bg-red-50 @else border-gray-200 @enderror">{{ old('description') }}</textarea>
                        <p class="text-xs text-gray-400 mt-1">Minimum 100 caractères</p>
                        @error('description') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                        {{-- ✦ Secteur d'activité — SELECT --}}
                        <div>
                            <label for="secteur_activite" class="block text-sm font-semibold text-gray-700 mb-2">
                                Secteur d'activité <span class="text-red-400">*</span>
                            </label>
                            <select id="secteur_activite" name="secteur_activite" required
                                class="w-full px-4 py-3 text-sm rounded-xl border bg-gray-50 text-gray-900 focus:outline-none focus:bg-white focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 transition-all appearance-none
                                @error('secteur_activite') border-red-400 bg-red-50 @else border-gray-200 @enderror">
                                <option value="">Sélectionner un secteur...</option>
                                @foreach($secteurs as $secteur)
                                <option value="{{ $secteur }}" {{ old('secteur_activite') == $secteur ? 'selected' : '' }}>
                                    {{ $secteur }}
                                </option>
                                @endforeach
                            </select>
                            @error('secteur_activite') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="site_web" class="block text-sm font-semibold text-gray-700 mb-2">Site web</label>
                            <input type="url" id="site_web" name="site_web"
                                   value="{{ old('site_web') }}"
                                   placeholder="https://www.exemple.com"
                                   class="w-full px-4 py-3 text-sm rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:bg-white focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 transition-all">
                        </div>
                    </div>

                    <div>
                        <label for="logo" class="block text-sm font-semibold text-gray-700 mb-2">Logo de l'entreprise</label>
                        <input type="file" id="logo" name="logo" accept=".jpg,.jpeg,.png"
                               class="w-full px-4 py-3 text-sm rounded-xl border border-gray-200 bg-gray-50 text-gray-500 file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-gray-900 file:text-white hover:file:bg-yellow-400 hover:file:text-gray-900 transition-all cursor-pointer">
                        <p class="text-xs text-gray-400 mt-1">JPG, PNG — max 2 Mo</p>
                    </div>
                </div>

                {{-- ── COORDONNÉES ── --}}
                <div class="px-6 py-4 border-y border-gray-100 bg-gray-50/50">
                    <p class="text-xs font-extrabold text-gray-500 uppercase tracking-widest">Coordonnées</p>
                </div>
                <div class="p-6 space-y-5">

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="adresse" class="block text-sm font-semibold text-gray-700 mb-2">
                                Adresse <span class="text-red-400">*</span>
                            </label>
                            <input type="text" id="adresse" name="adresse"
                                   value="{{ old('adresse') }}" required
                                   placeholder="Rue, quartier..."
                                   class="w-full px-4 py-3 text-sm rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:bg-white focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 transition-all">
                        </div>
                        <div>
                            <label for="ville" class="block text-sm font-semibold text-gray-700 mb-2">
                                Ville <span class="text-red-400">*</span>
                            </label>
                            <input type="text" id="ville" name="ville"
                                   value="{{ old('ville', 'Cotonou') }}" required
                                   class="w-full px-4 py-3 text-sm rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:bg-white focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 transition-all">
                        </div>
                    </div>

                    <div>
                        <label for="telephone_entreprise" class="block text-sm font-semibold text-gray-700 mb-2">
                            Téléphone <span class="text-red-400">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </span>
                            <input type="text" id="telephone_entreprise" name="telephone_entreprise"
                                   value="{{ old('telephone_entreprise') }}" required
                                   placeholder="+229 XX XX XX XX"
                                   class="w-full pl-11 pr-4 py-3 text-sm rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:bg-white focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 transition-all">
                        </div>
                    </div>
                </div>

                {{-- ── INFOS COMPLÉMENTAIRES ── --}}
                <div class="px-6 py-4 border-y border-gray-100 bg-gray-50/50">
                    <p class="text-xs font-extrabold text-gray-500 uppercase tracking-widest">Informations complémentaires</p>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="effectif" class="block text-sm font-semibold text-gray-700 mb-2">Nombre d'employés</label>
                            <input type="number" id="effectif" name="effectif" min="1"
                                   value="{{ old('effectif') }}" placeholder="Ex: 50"
                                   class="w-full px-4 py-3 text-sm rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:bg-white focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 transition-all">
                        </div>
                        <div>
                            <label for="annee_creation" class="block text-sm font-semibold text-gray-700 mb-2">Année de création</label>
                            <input type="number" id="annee_creation" name="annee_creation"
                                   min="1900" max="{{ date('Y') }}"
                                   value="{{ old('annee_creation') }}" placeholder="{{ date('Y') }}"
                                   class="w-full px-4 py-3 text-sm rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:bg-white focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 transition-all">
                        </div>
                    </div>
                </div>

                {{-- ── BOUTON ── --}}
                <div class="px-6 py-5 bg-gray-50/50 border-t border-gray-100">
                    <button type="submit"
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-3 bg-gray-900 text-white font-extrabold text-sm rounded-xl hover:bg-yellow-400 hover:text-gray-900 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                        Créer mon profil
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection