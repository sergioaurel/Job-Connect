@extends('layouts.app')

@section('title', 'Modifier mon profil entreprise')

@section('content')

<div class="bg-gray-950 border-b border-white/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <p class="text-yellow-400 text-xs font-extrabold tracking-widest uppercase mb-1">Espace Entreprise</p>
        <h1 class="text-white font-extrabold text-2xl" style="letter-spacing:-0.02em">Modifier mon profil</h1>

        <nav class="flex gap-1 mt-6 overflow-x-auto pb-1">
            @foreach([
                ['label' => 'Tableau de bord', 'route' => 'entreprise.dashboard',          'active' => false],
                ['label' => 'Mon profil',       'route' => 'entreprise.profil.edit',        'active' => true],
                ['label' => 'Mes offres',        'route' => 'entreprise.offres.index',       'active' => false],
                ['label' => 'Candidatures',      'route' => 'entreprise.candidatures.index', 'active' => false],
            ] as $tab)
            <a href="{{ route($tab['route']) }}"
               class="whitespace-nowrap px-4 py-2 rounded-lg text-sm font-bold transition-colors flex-shrink-0
                      {{ $tab['active'] ? 'bg-yellow-400 text-gray-900' : 'text-gray-400 hover:text-white hover:bg-white/5' }}">
                {{ $tab['label'] }}
            </a>
            @endforeach
        </nav>
    </div>
</div>

<div class="bg-gray-50 min-h-screen">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
            <form action="{{ route('entreprise.profil.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- ── IDENTITÉ ── --}}
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                    <p class="text-xs font-extrabold text-gray-500 uppercase tracking-widest">Identité de l'entreprise</p>
                </div>
                <div class="p-6 space-y-5">

                    {{-- Logo actuel --}}
                    @if($entreprise->logo)
                    <div>
                        <label class="block text-xs font-extrabold text-gray-500 uppercase tracking-widest mb-3">Logo actuel</label>
                        <div class="flex items-center gap-4">
                            <img src="{{ asset('storage/' . $entreprise->logo) }}"
                                 alt="{{ $entreprise->nom_entreprise }}"
                                 class="w-16 h-16 object-contain border border-gray-200 rounded-xl bg-white p-1">
                            <p class="text-xs text-gray-400">Téléchargez un nouveau fichier pour remplacer ce logo.</p>
                        </div>
                    </div>
                    @endif

                    <div>
                        <label for="nom_entreprise" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nom de l'entreprise <span class="text-red-400">*</span>
                        </label>
                        <input type="text" id="nom_entreprise" name="nom_entreprise"
                               value="{{ old('nom_entreprise', $entreprise->nom_entreprise) }}" required
                               class="w-full px-4 py-3 text-sm rounded-xl border bg-gray-50 text-gray-900 focus:outline-none focus:bg-white focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 transition-all
                               @error('nom_entreprise') border-red-400 bg-red-50 @else border-gray-200 @enderror">
                        @error('nom_entreprise') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                            Description <span class="text-red-400">*</span>
                        </label>
                        <textarea id="description" name="description" rows="5" required
                                  class="w-full px-4 py-3 text-sm rounded-xl border bg-gray-50 text-gray-900 focus:outline-none focus:bg-white focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 transition-all resize-none
                                  @error('description') border-red-400 bg-red-50 @else border-gray-200 @enderror">{{ old('description', $entreprise->description) }}</textarea>
                        @error('description') <p class="text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="secteur_activite" class="block text-sm font-semibold text-gray-700 mb-2">
                                Secteur d'activité <span class="text-red-400">*</span>
                            </label>
                            <input type="text" id="secteur_activite" name="secteur_activite"
                                   value="{{ old('secteur_activite', $entreprise->secteur_activite) }}" required
                                   class="w-full px-4 py-3 text-sm rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:bg-white focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 transition-all">
                        </div>
                        <div>
                            <label for="site_web" class="block text-sm font-semibold text-gray-700 mb-2">Site web</label>
                            <input type="url" id="site_web" name="site_web"
                                   value="{{ old('site_web', $entreprise->site_web) }}"
                                   placeholder="https://www.exemple.com"
                                   class="w-full px-4 py-3 text-sm rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:bg-white focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 transition-all">
                        </div>
                    </div>

                    <div>
                        <label for="logo" class="block text-sm font-semibold text-gray-700 mb-2">Changer le logo</label>
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
                                   value="{{ old('adresse', $entreprise->adresse) }}" required
                                   class="w-full px-4 py-3 text-sm rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:bg-white focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 transition-all">
                        </div>
                        <div>
                            <label for="ville" class="block text-sm font-semibold text-gray-700 mb-2">
                                Ville <span class="text-red-400">*</span>
                            </label>
                            <input type="text" id="ville" name="ville"
                                   value="{{ old('ville', $entreprise->ville) }}" required
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
                                   value="{{ old('telephone_entreprise', $entreprise->telephone_entreprise) }}" required
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
                                   value="{{ old('effectif', $entreprise->effectif) }}"
                                   class="w-full px-4 py-3 text-sm rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:bg-white focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 transition-all">
                        </div>
                        <div>
                            <label for="annee_creation" class="block text-sm font-semibold text-gray-700 mb-2">Année de création</label>
                            <input type="number" id="annee_creation" name="annee_creation"
                                   min="1900" max="{{ date('Y') }}"
                                   value="{{ old('annee_creation', $entreprise->annee_creation) }}"
                                   class="w-full px-4 py-3 text-sm rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:bg-white focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 transition-all">
                        </div>
                    </div>
                </div>

                {{-- ── BOUTONS ── --}}
                <div class="px-6 py-5 bg-gray-50/50 border-t border-gray-100 flex flex-col sm:flex-row gap-3">
                    <button type="submit"
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-3 bg-gray-900 text-white font-extrabold text-sm rounded-xl hover:bg-yellow-400 hover:text-gray-900 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                        Enregistrer les modifications
                    </button>
                    <a href="{{ route('entreprise.dashboard') }}"
                       class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 border border-gray-200 text-gray-700 font-bold text-sm rounded-xl hover:border-gray-400 transition-all">
                        Annuler
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection