@extends('layouts.app')

@section('title', 'Mon profil')

@section('content')

<div class="bg-gray-950 border-b border-white/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 pb-0">
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-6">
            <div>
                <p class="text-yellow-400 text-xs font-extrabold tracking-widest uppercase mb-1">Espace Candidat</p>
                <h1 class="text-white font-extrabold text-2xl sm:text-3xl" style="letter-spacing:-0.02em">Mon profil</h1>
                <p class="text-gray-500 text-sm mt-1">Gérez vos informations professionnelles</p>
            </div>
        </div>
        <nav class="flex gap-1 overflow-x-auto scrollbar-hide">
            @php
            $tabs = [
                ['route' => 'candidat.dashboard',    'label' => 'Tableau de bord', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                ['route' => 'candidat.profil',       'label' => 'Mon profil',       'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'],
                ['route' => 'candidat.candidatures', 'label' => 'Candidatures',     'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
                ['route' => 'candidat.favoris',      'label' => 'Favoris',          'icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z'],
            ];
            @endphp
            @foreach($tabs as $tab)
            @php $isActive = request()->routeIs($tab['route']); @endphp
            <a href="{{ route($tab['route']) }}"
               class="flex items-center gap-2 px-4 py-3 text-xs font-extrabold whitespace-nowrap rounded-t-xl transition-all border-b-2 {{ $isActive ? 'bg-white/5 text-yellow-400 border-yellow-400' : 'text-gray-500 border-transparent hover:text-gray-300 hover:bg-white/5' }}">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $tab['icon'] }}"/>
                </svg>
                {{ $tab['label'] }}
            </a>
            @endforeach
        </nav>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    @php
        $completion = 0;
        if($user->telephone)           $completion += 20;
        if($user->localisation)        $completion += 20;
        if($experiences->count() > 0)  $completion += 20;
        if($formations->count() > 0)   $completion += 20;
        if($competences->count() > 0)  $completion += 20;
    @endphp

    @if(session('success'))
    <div class="mb-6 flex items-center gap-3 px-5 py-3.5 bg-green-50 border border-green-200 rounded-2xl text-green-700 text-sm font-semibold">
        <svg class="w-5 h-5 flex-shrink-0 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="mb-6 flex items-center gap-3 px-5 py-3.5 bg-red-50 border border-red-200 rounded-2xl text-red-700 text-sm font-semibold">
        <svg class="w-5 h-5 flex-shrink-0 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
        </svg>
        {{ session('error') }}
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- ─── SIDEBAR ─── --}}
        <div class="lg:col-span-1 space-y-5">

            {{-- Carte identité --}}
            <div class="bg-white border border-gray-200 rounded-2xl p-6">
                <div class="flex flex-col items-center text-center mb-6">
                    <div class="w-20 h-20 rounded-2xl bg-gray-900 flex items-center justify-center mb-4 text-white font-extrabold text-2xl">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <h2 class="text-gray-900 font-extrabold text-lg">{{ $user->name }}</h2>
                    <p class="text-gray-500 text-sm mt-0.5">{{ $user->email }}</p>
                </div>
                <div class="space-y-3 border-t border-gray-100 pt-5">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </div>
                        <div>
                            <p class="text-gray-400 text-xs">Téléphone</p>
                            <p class="text-gray-900 text-sm font-semibold">{{ $user->telephone ?? '—' }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                        </div>
                        <div>
                            <p class="text-gray-400 text-xs">Localisation</p>
                            <p class="text-gray-900 text-sm font-semibold">{{ $user->localisation ?? '—' }}</p>
                        </div>
                    </div>
                    @if($user->type_contrat_souhaite)
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-indigo-50 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <div>
                            <p class="text-gray-400 text-xs">Contrat souhaité</p>
                            <p class="text-gray-900 text-sm font-semibold">{{ $typesContrat[$user->type_contrat_souhaite] ?? $user->type_contrat_souhaite }}</p>
                        </div>
                    </div>
                    @endif
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <div>
                            <p class="text-gray-400 text-xs">Membre depuis</p>
                            <p class="text-gray-900 text-sm font-semibold">{{ $user->created_at->format('d/m/Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Progression --}}
            <div class="bg-white border border-gray-200 rounded-2xl p-6">
                <div class="flex items-center justify-between mb-4">
                    <p class="text-gray-900 font-extrabold text-sm">Profil complété</p>
                    <span class="text-yellow-500 font-extrabold text-sm">{{ $completion }}%</span>
                </div>
                <div class="w-full bg-gray-100 rounded-full h-2 mb-4">
                    <div class="h-2 rounded-full bg-yellow-400 transition-all duration-500" style="width:{{ $completion }}%"></div>
                </div>
                <div class="space-y-2">
                    @foreach([
                        ['done' => (bool)$user->telephone,         'label' => 'Téléphone renseigné'],
                        ['done' => (bool)$user->localisation,      'label' => 'Localisation renseignée'],
                        ['done' => $experiences->count() > 0,      'label' => 'Au moins 1 expérience'],
                        ['done' => $formations->count() > 0,       'label' => 'Au moins 1 formation'],
                        ['done' => $competences->count() > 0,      'label' => 'Au moins 1 compétence'],
                    ] as $step)
                    <div class="flex items-center gap-2.5">
                        @if($step['done'])
                        <div class="w-5 h-5 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-3 h-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <span class="text-gray-500 text-xs line-through">{{ $step['label'] }}</span>
                        @else
                        <div class="w-5 h-5 rounded-full bg-gray-100 flex items-center justify-center flex-shrink-0">
                            <span class="w-1.5 h-1.5 rounded-full bg-gray-300 inline-block"></span>
                        </div>
                        <span class="text-gray-700 text-xs font-semibold">{{ $step['label'] }}</span>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>

        </div>

        {{-- ─── CONTENU PRINCIPAL ─── --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- ══ 1. Informations personnelles ══ --}}
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-xl bg-yellow-400 flex items-center justify-center">
                        <svg class="w-4 h-4 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <h3 class="text-gray-900 font-extrabold text-base">Informations personnelles</h3>
                </div>
                <div class="p-6">
                    <form action="{{ route('candidat.profil.update-infos') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-5">

                            <div>
                                <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-widest mb-2">Nom complet *</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-sm text-gray-900 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 outline-none transition-all">
                                @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-widest mb-2">Téléphone *</label>
                                <input type="text" name="telephone" value="{{ old('telephone', $user->telephone) }}" required
                                    placeholder="+229 97 000 000"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-sm text-gray-900 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 outline-none transition-all">
                                @error('telephone')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                            {{-- Localisation — SELECT ville --}}
                            <div class="sm:col-span-2">
                                <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-widest mb-2">Localisation *</label>
                                <select name="localisation" required
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-sm text-gray-900 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 outline-none transition-all appearance-none">
                                    <option value="">Sélectionner votre ville...</option>
                                    @foreach($villes as $ville)
                                    <option value="{{ $ville }}" {{ old('localisation', $user->localisation) == $ville ? 'selected' : '' }}>
                                        {{ $ville }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('localisation')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>

                        </div>
                        <button type="submit"
                                class="px-6 py-2.5 bg-gray-900 text-white font-extrabold text-xs rounded-xl hover:bg-yellow-400 hover:text-gray-900 transition-all">
                            Enregistrer les modifications
                        </button>
                    </form>
                </div>
            </div>

            {{-- ══ 2. Expériences professionnelles ══ --}}
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl bg-indigo-100 flex items-center justify-center">
                            <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <h3 class="text-gray-900 font-extrabold text-base">Expériences professionnelles</h3>
                    </div>
                    <button onclick="toggleForm('experience-form')"
                            class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-gray-100 text-gray-700 font-extrabold text-xs rounded-xl hover:bg-gray-900 hover:text-white transition-all">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                        Ajouter
                    </button>
                </div>

                <div id="experience-form" class="hidden border-b border-gray-100 p-6" style="background:rgba(250,204,21,0.04)">
                    <p class="text-xs font-extrabold text-gray-500 uppercase tracking-widest mb-4">Nouvelle expérience</p>
                    <form action="{{ route('candidat.profil.add-experience') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-widest mb-2">Poste *</label>
                                <input type="text" name="poste" required class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white text-sm text-gray-900 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 outline-none transition-all">
                            </div>
                            <div>
                                <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-widest mb-2">Entreprise *</label>
                                <input type="text" name="entreprise" required class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white text-sm text-gray-900 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 outline-none transition-all">
                            </div>
                            <div>
                                <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-widest mb-2">Ville</label>
                                <input type="text" name="ville" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white text-sm text-gray-900 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 outline-none transition-all">
                            </div>
                            <div>
                                <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-widest mb-2">Date de début *</label>
                                <input type="date" name="date_debut" required class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white text-sm text-gray-900 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 outline-none transition-all">
                            </div>
                            <div>
                                <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-widest mb-2">Date de fin</label>
                                <input type="date" name="date_fin" id="date_fin" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white text-sm text-gray-900 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 outline-none transition-all">
                            </div>
                            <div class="flex items-center">
                                <label class="flex items-center gap-2 cursor-pointer select-none">
                                    <div class="relative">
                                        <input type="checkbox" name="en_cours" value="1" id="en_cours_check" onchange="toggleDateFin(this)" class="sr-only peer">
                                        <div class="w-10 h-5 bg-gray-200 rounded-full peer peer-checked:bg-yellow-400 transition-colors"></div>
                                        <div class="absolute top-0.5 left-0.5 w-4 h-4 bg-white rounded-full shadow transition-transform peer-checked:translate-x-5"></div>
                                    </div>
                                    <span class="text-sm font-semibold text-gray-700">Poste actuel</span>
                                </label>
                            </div>
                            <div class="sm:col-span-2">
                                <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-widest mb-2">Description</label>
                                <textarea name="description" rows="3" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white text-sm text-gray-900 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 outline-none transition-all resize-none"></textarea>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <button type="submit" class="px-5 py-2.5 bg-gray-900 text-white font-extrabold text-xs rounded-xl hover:bg-yellow-400 hover:text-gray-900 transition-all">Ajouter l'expérience</button>
                            <button type="button" onclick="toggleForm('experience-form')" class="px-5 py-2.5 border border-gray-200 text-gray-600 font-extrabold text-xs rounded-xl hover:bg-gray-50 transition-all">Annuler</button>
                        </div>
                    </form>
                </div>

                <div class="divide-y divide-gray-50">
                    @forelse($experiences as $exp)
                    <div class="p-6 hover:bg-gray-50 transition-colors group">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex gap-4">
                                <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                </div>
                                <div>
                                    <p class="text-gray-900 font-extrabold text-sm">{{ $exp->poste }}</p>
                                    <p class="text-gray-600 text-sm">{{ $exp->entreprise }}{{ $exp->ville ? ' · '.$exp->ville : '' }}</p>
                                    <p class="text-gray-400 text-xs mt-1">{{ $exp->periode() }}</p>
                                    @if($exp->description)<p class="text-gray-500 text-sm mt-2 leading-relaxed">{{ $exp->description }}</p>@endif
                                </div>
                            </div>
                            <form action="{{ route('candidat.profil.delete-experience', $exp->id) }}" method="POST" onsubmit="return confirm('Supprimer cette expérience ?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="opacity-0 group-hover:opacity-100 w-8 h-8 rounded-xl bg-red-50 text-red-400 hover:bg-red-100 hover:text-red-600 flex items-center justify-center transition-all flex-shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <div class="px-6 py-10 text-center">
                        <p class="text-gray-400 text-sm">Aucune expérience ajoutée.</p>
                        <button onclick="toggleForm('experience-form')" class="mt-2 text-yellow-500 font-extrabold text-xs hover:text-yellow-600 transition-colors">+ Ajouter ma première expérience</button>
                    </div>
                    @endforelse
                </div>
            </div>

            {{-- ══ 3. Formations + Type de contrat souhaité ══ --}}
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl bg-green-100 flex items-center justify-center">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                        </div>
                        <h3 class="text-gray-900 font-extrabold text-base">Formations</h3>
                    </div>
                    <button onclick="toggleForm('formation-form')"
                            class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-gray-100 text-gray-700 font-extrabold text-xs rounded-xl hover:bg-gray-900 hover:text-white transition-all">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                        Ajouter
                    </button>
                </div>

                {{-- ✦ Type de contrat souhaité — placé ici dans la section Formations --}}
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                    <form action="{{ route('candidat.profil.update-infos') }}" method="POST" class="flex flex-col sm:flex-row sm:items-center gap-3">
                        @csrf
                        @method('PUT')
                        {{-- Champs cachés pour ne pas écraser les autres valeurs --}}
                        <input type="hidden" name="name"         value="{{ $user->name }}">
                        <input type="hidden" name="telephone"    value="{{ $user->telephone }}">
                        <input type="hidden" name="localisation" value="{{ $user->localisation }}">

                        <div class="flex items-center gap-2 flex-shrink-0">
                            <div class="w-7 h-7 rounded-lg bg-indigo-100 flex items-center justify-center">
                                <svg class="w-3.5 h-3.5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                            <label class="text-xs font-extrabold text-gray-700 uppercase tracking-widest whitespace-nowrap">
                                Type de contrat souhaité
                            </label>
                        </div>

                        <select name="type_contrat_souhaite"
                            onchange="this.form.submit()"
                            class="flex-1 px-4 py-2.5 rounded-xl border border-gray-200 bg-white text-sm text-gray-900 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 outline-none transition-all appearance-none">
                            <option value="">Peu importe</option>
                            @foreach($typesContrat as $value => $label)
                            <option value="{{ $value }}" {{ $user->type_contrat_souhaite == $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                            @endforeach
                        </select>

                        <p class="text-gray-400 text-xs sm:hidden">Influence vos recommandations d'offres</p>
                    </form>
                    <p class="text-gray-400 text-xs mt-2 hidden sm:block">
                        Ce choix influence directement les offres recommandées sur votre tableau de bord.
                    </p>
                </div>

                {{-- Formulaire ajout formation --}}
                <div id="formation-form" class="hidden border-b border-gray-100 p-6" style="background:rgba(250,204,21,0.04)">
                    <p class="text-xs font-extrabold text-gray-500 uppercase tracking-widest mb-4">Nouvelle formation</p>
                    <form action="{{ route('candidat.profil.add-formation') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">

                            {{-- Diplôme SELECT --}}
                            <div>
                                <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-widest mb-2">Diplôme *</label>
                                <select name="diplome" required
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white text-sm text-gray-900 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 outline-none transition-all appearance-none">
                                    <option value="">Sélectionner un diplôme...</option>
                                    @foreach($diplomes as $diplome)
                                    <option value="{{ $diplome }}">{{ $diplome }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-widest mb-2">Établissement *</label>
                                <input type="text" name="etablissement" required placeholder="UAC, EPAC, EIG..."
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white text-sm text-gray-900 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 outline-none transition-all">
                            </div>

                            {{-- Domaine SELECT --}}
                            <div>
                                <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-widest mb-2">Domaine</label>
                                <select name="domaine"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white text-sm text-gray-900 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 outline-none transition-all appearance-none">
                                    <option value="">Sélectionner un domaine...</option>
                                    @foreach($domaines as $domaine)
                                    <option value="{{ $domaine }}">{{ $domaine }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-widest mb-2">Année d'obtention *</label>
                                <input type="number" name="annee_obtention" min="1950" max="{{ date('Y') + 5 }}" required
                                    placeholder="{{ date('Y') }}"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white text-sm text-gray-900 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 outline-none transition-all">
                            </div>

                            <div class="sm:col-span-2">
                                <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-widest mb-2">Description</label>
                                <textarea name="description" rows="2"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white text-sm text-gray-900 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 outline-none transition-all resize-none"></textarea>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <button type="submit" class="px-5 py-2.5 bg-gray-900 text-white font-extrabold text-xs rounded-xl hover:bg-yellow-400 hover:text-gray-900 transition-all">Ajouter la formation</button>
                            <button type="button" onclick="toggleForm('formation-form')" class="px-5 py-2.5 border border-gray-200 text-gray-600 font-extrabold text-xs rounded-xl hover:bg-gray-50 transition-all">Annuler</button>
                        </div>
                    </form>
                </div>

                {{-- Liste formations --}}
                <div class="divide-y divide-gray-50">
                    @forelse($formations as $formation)
                    <div class="p-6 hover:bg-gray-50 transition-colors group">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex gap-4">
                                <div class="w-10 h-10 rounded-xl bg-green-50 flex items-center justify-center flex-shrink-0 mt-0.5">
                                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                                </div>
                                <div>
                                    <p class="text-gray-900 font-extrabold text-sm">{{ $formation->diplome }}</p>
                                    <p class="text-gray-600 text-sm">{{ $formation->etablissement }}{{ $formation->domaine ? ' · '.$formation->domaine : '' }}</p>
                                    <p class="text-gray-400 text-xs mt-1">{{ $formation->annee_obtention }}</p>
                                    @if($formation->description)<p class="text-gray-500 text-sm mt-2 leading-relaxed">{{ $formation->description }}</p>@endif
                                </div>
                            </div>
                            <form action="{{ route('candidat.profil.delete-formation', $formation->id) }}" method="POST" onsubmit="return confirm('Supprimer cette formation ?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="opacity-0 group-hover:opacity-100 w-8 h-8 rounded-xl bg-red-50 text-red-400 hover:bg-red-100 hover:text-red-600 flex items-center justify-center transition-all flex-shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <div class="px-6 py-10 text-center">
                        <p class="text-gray-400 text-sm">Aucune formation ajoutée.</p>
                        <button onclick="toggleForm('formation-form')" class="mt-2 text-yellow-500 font-extrabold text-xs hover:text-yellow-600 transition-colors">+ Ajouter ma première formation</button>
                    </div>
                    @endforelse
                </div>
            </div>

            {{-- ══ 4. Compétences ══ --}}
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl bg-orange-100 flex items-center justify-center">
                            <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        <h3 class="text-gray-900 font-extrabold text-base">Compétences</h3>
                    </div>
                    <button onclick="toggleForm('competence-form')"
                            class="inline-flex items-center gap-1.5 px-3.5 py-2 bg-gray-100 text-gray-700 font-extrabold text-xs rounded-xl hover:bg-gray-900 hover:text-white transition-all">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                        Ajouter
                    </button>
                </div>

                <div id="competence-form" class="hidden border-b border-gray-100 p-6" style="background:rgba(250,204,21,0.04)">
                    <p class="text-xs font-extrabold text-gray-500 uppercase tracking-widest mb-4">Nouvelle compétence</p>
                    <form action="{{ route('candidat.profil.add-competence') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-widest mb-2">Compétence *</label>
                                <select name="competence_id" required
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white text-sm text-gray-900 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 outline-none transition-all">
                                    <option value="">Sélectionner...</option>
                                    @foreach($toutesCompetences as $comp)
                                    <option value="{{ $comp->id }}">{{ $comp->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-widest mb-2">Niveau *</label>
                                <select name="niveau" required
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white text-sm text-gray-900 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 outline-none transition-all">
                                    <option value="debutant">Débutant</option>
                                    <option value="intermediaire" selected>Intermédiaire</option>
                                    <option value="avance">Avancé</option>
                                    <option value="expert">Expert</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <button type="submit" class="px-5 py-2.5 bg-gray-900 text-white font-extrabold text-xs rounded-xl hover:bg-yellow-400 hover:text-gray-900 transition-all">Ajouter la compétence</button>
                            <button type="button" onclick="toggleForm('competence-form')" class="px-5 py-2.5 border border-gray-200 text-gray-600 font-extrabold text-xs rounded-xl hover:bg-gray-50 transition-all">Annuler</button>
                        </div>
                    </form>
                </div>

                <div class="p-6">
                    @forelse($competences as $competence)
                    @php
                    $nc = [
                        'debutant'      => ['bg'=>'bg-gray-100',  'text'=>'text-gray-600',  'dot'=>'bg-gray-400'],
                        'intermediaire' => ['bg'=>'bg-blue-50',   'text'=>'text-blue-600',  'dot'=>'bg-blue-400'],
                        'avance'        => ['bg'=>'bg-indigo-50', 'text'=>'text-indigo-600','dot'=>'bg-indigo-400'],
                        'expert'        => ['bg'=>'bg-yellow-50', 'text'=>'text-yellow-600','dot'=>'bg-yellow-400'],
                    ][$competence->pivot->niveau] ?? ['bg'=>'bg-gray-100','text'=>'text-gray-600','dot'=>'bg-gray-400'];
                    @endphp
                    <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl mr-2 mb-2 {{ $nc['bg'] }} {{ $nc['text'] }} text-xs font-extrabold">
                        <span class="w-1.5 h-1.5 rounded-full {{ $nc['dot'] }} inline-block"></span>
                        {{ $competence->nom }}
                        <span class="opacity-70 font-semibold">· {{ ucfirst($competence->pivot->niveau) }}</span>
                        <form action="{{ route('candidat.profil.delete-competence', $competence->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="hover:opacity-100 opacity-60 ml-0.5 leading-none font-bold text-sm">×</button>
                        </form>
                    </span>
                    @empty
                    <div class="text-center py-6">
                        <p class="text-gray-400 text-sm">Aucune compétence ajoutée.</p>
                        <button onclick="toggleForm('competence-form')" class="mt-2 text-yellow-500 font-extrabold text-xs hover:text-yellow-600 transition-colors">+ Ajouter ma première compétence</button>
                    </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</div>

@push('scripts')
<script>
function toggleForm(id) {
    var el = document.getElementById(id);
    el.classList.toggle('hidden');
    if (!el.classList.contains('hidden')) {
        el.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }
}
function toggleDateFin(checkbox) {
    var dateFin = document.getElementById('date_fin');
    dateFin.disabled = checkbox.checked;
    if (checkbox.checked) dateFin.value = '';
}
</script>
@endpush

@endsection