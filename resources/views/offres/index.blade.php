@extends('layouts.app')

@section('title', 'Offres de stages au Bénin — JobConnect')

@section('content')

{{-- ═══════════════════════════════════════
     HERO
═══════════════════════════════════════ --}}
<section class="relative bg-gray-950 overflow-hidden">
    <div class="absolute inset-0 pointer-events-none"
         style="background-image:linear-gradient(rgba(255,255,255,0.03) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,0.03) 1px,transparent 1px);background-size:60px 60px"></div>
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[600px] h-[200px] pointer-events-none"
         style="background:radial-gradient(ellipse,rgba(250,204,21,0.1) 0%,transparent 70%)"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-6">
            <div>
                <h1 class="text-white font-extrabold leading-tight"
                    style="font-size:clamp(1.8rem,4vw,3rem);letter-spacing:-0.02em">
                    Offres de stages<br>au <span class="text-yellow-400">Bénin</span>
                </h1>
                <p class="text-gray-500 text-sm mt-2">Stage professionnel · Stage académique</p>
            </div>

            {{-- Barre recherche rapide --}}
            <form action="{{ route('offres.index') }}" method="GET"
                  class="flex gap-0 rounded-xl overflow-hidden w-full sm:w-auto sm:min-w-96"
                  style="border:1px solid rgba(255,255,255,0.1);background:rgba(255,255,255,0.05)">
                <div class="flex items-center gap-2 flex-1 px-4">
                    <svg class="w-4 h-4 text-gray-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Poste, compétence..."
                           class="bg-transparent text-white text-sm placeholder-gray-500 outline-none w-full py-3">
                </div>
                <button type="submit"
                        class="px-5 py-3 bg-yellow-400 text-gray-900 font-extrabold text-sm hover:bg-yellow-300 transition-colors whitespace-nowrap">
                    Rechercher
                </button>
            </form>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     CONTENU PRINCIPAL
═══════════════════════════════════════ --}}
<div class="bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

            {{-- ── SIDEBAR FILTRES ── --}}
            <div class="lg:col-span-1">
                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden sticky top-4">

                    <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                        <h2 class="text-sm font-extrabold text-gray-900 uppercase tracking-widest">Filtres</h2>
                        @if(request()->hasAny(['search','categorie','type_offre','ville']))
                        <a href="{{ route('offres.index') }}"
                           class="text-xs text-yellow-500 font-semibold hover:text-yellow-400 transition-colors">
                            Tout effacer
                        </a>
                        @endif
                    </div>

                    <form action="{{ route('offres.index') }}" method="GET" class="p-6 space-y-6">

                        {{-- Catégorie --}}
                        <div>
                            <label class="block text-xs font-extrabold text-gray-500 uppercase tracking-widest mb-3">Catégorie</label>
                            <select name="categorie"
                                    class="w-full px-3 py-2.5 text-sm rounded-xl border border-gray-200 bg-gray-50 text-gray-900 focus:outline-none focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 transition-all appearance-none">
                                <option value="">Toutes les catégories</option>
                                @foreach($categories as $categorie)
                                <option value="{{ $categorie->id }}" {{ request('categorie') == $categorie->id ? 'selected' : '' }}>
                                    {{ $categorie->nom }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Type de stage — uniquement pro et académique ── --}}
                        <div>
                            <label class="block text-xs font-extrabold text-gray-500 uppercase tracking-widest mb-3">Type de stage</label>
                            <div class="space-y-2">
                                @foreach([
                                    ['value' => '',                    'label' => 'Tous les stages'],
                                    ['value' => 'stage_professionnel', 'label' => 'Stage professionnel'],
                                    ['value' => 'stage_academique',    'label' => 'Stage académique'],
                                ] as $type)
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <input type="radio" name="type_offre" value="{{ $type['value'] }}"
                                           {{ request('type_offre', '') == $type['value'] ? 'checked' : '' }}
                                           class="w-4 h-4 text-yellow-400 border-gray-300 focus:ring-yellow-400 cursor-pointer">
                                    <span class="text-sm text-gray-600 group-hover:text-gray-900 transition-colors">{{ $type['label'] }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        {{-- Ville --}}
                        <div>
                            <label class="block text-xs font-extrabold text-gray-500 uppercase tracking-widest mb-3">Ville</label>
                            <select name="ville"
                                    class="w-full px-3 py-2.5 text-sm rounded-xl border border-gray-200 bg-gray-50 text-gray-900 focus:outline-none focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 transition-all appearance-none">
                                <option value="">Toutes les villes</option>
                                @foreach($villes as $ville)
                                <option value="{{ $ville }}" {{ request('ville') == $ville ? 'selected' : '' }}>
                                    {{ $ville }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Bouton filtrer --}}
                        <button type="submit"
                                class="w-full py-3 bg-gray-900 text-white font-extrabold text-sm rounded-xl hover:bg-yellow-400 hover:text-gray-900 transition-all duration-200">
                            Appliquer les filtres
                        </button>
                    </form>
                </div>
            </div>

            {{-- ── LISTE DES OFFRES ── --}}
            <div class="lg:col-span-3">

                {{-- Barre résultats + tri --}}
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-6">
                    <div class="flex items-center gap-2">
                        <span class="text-sm font-bold text-gray-900">{{ $offres->total() }} résultat(s)</span>
                        @if(request('search'))
                        <span class="px-2.5 py-1 bg-yellow-50 border border-yellow-200 text-yellow-700 text-xs font-bold rounded-full">
                            "{{ request('search') }}"
                        </span>
                        @endif
                        @if(request('type_offre'))
                        <span class="px-2.5 py-1 bg-green-50 border border-green-200 text-green-700 text-xs font-bold rounded-full">
                            {{ request('type_offre') === 'stage_professionnel' ? 'Stage pro' : 'Stage acad.' }}
                        </span>
                        @endif
                    </div>

                    <form action="{{ route('offres.index') }}" method="GET" class="inline-flex items-center gap-2">
                        <input type="hidden" name="search"     value="{{ request('search') }}">
                        <input type="hidden" name="categorie"  value="{{ request('categorie') }}">
                        <input type="hidden" name="type_offre" value="{{ request('type_offre') }}">
                        <input type="hidden" name="ville"      value="{{ request('ville') }}">
                        <label class="text-xs text-gray-500 font-semibold whitespace-nowrap">Trier par</label>
                        <select name="sort" onchange="this.form.submit()"
                                class="px-3 py-2 text-sm rounded-xl border border-gray-200 bg-white text-gray-900 focus:outline-none focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 transition-all">
                            <option value="recent"   {{ request('sort','recent') == 'recent'   ? 'selected' : '' }}>Plus récentes</option>
                            <option value="popular"  {{ request('sort') == 'popular'  ? 'selected' : '' }}>Plus populaires</option>
                            <option value="deadline" {{ request('sort') == 'deadline' ? 'selected' : '' }}>Date limite</option>
                        </select>
                    </form>
                </div>

                {{-- Cards offres --}}
                <div class="space-y-4">
                    @forelse($offres as $offre)
                    <a href="{{ route('offres.show', $offre->slug) }}"
                       class="block bg-white border border-gray-200 rounded-2xl p-6 hover:border-yellow-400 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 group">

                        <div class="flex items-start justify-between gap-4">
                            <div class="flex-1 min-w-0">

                                {{-- Badge type --}}
                                <div class="flex flex-wrap items-center gap-2 mb-3">
                                    @if($offre->type_offre === 'stage_professionnel')
                                        <span class="px-2.5 py-1 bg-green-50 text-green-600 text-xs font-extrabold rounded-lg uppercase tracking-wide">Stage Pro</span>
                                    @else
                                        <span class="px-2.5 py-1 bg-orange-50 text-orange-500 text-xs font-extrabold rounded-lg uppercase tracking-wide">Stage Acad.</span>
                                    @endif

                                    @if($offre->date_limite && $offre->date_limite->diffInDays(now()) <= 7 && $offre->date_limite->isFuture())
                                    <span class="px-2.5 py-1 bg-red-50 text-red-500 text-xs font-bold rounded-lg flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        Expire bientôt
                                    </span>
                                    @endif
                                </div>

                                {{-- Titre --}}
                                <h3 class="text-gray-900 font-extrabold text-lg mb-1 leading-snug group-hover:text-yellow-500 transition-colors">
                                    {{ $offre->titre }}
                                </h3>

                                {{-- Entreprise + ville --}}
                                <div class="flex items-center gap-3 mb-3 text-sm">
                                    <span class="font-semibold text-gray-700">{{ $offre->entreprise->nom_entreprise }}</span>
                                    <span class="text-gray-300">•</span>
                                    <span class="flex items-center gap-1 text-gray-500">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        </svg>
                                        {{ $offre->ville ?? 'Bénin' }}
                                    </span>
                                </div>

                                {{-- Description --}}
                                <p class="text-gray-500 text-sm leading-relaxed mb-4 line-clamp-2">
                                    {{ Str::limit(strip_tags($offre->description), 150) }}
                                </p>

                                {{-- Footer card --}}
                                <div class="flex flex-wrap items-center gap-x-5 gap-y-1">
                                    @if($offre->salaire_min)
                                    <span class="flex items-center gap-1.5 text-xs text-gray-500 font-medium">
                                        <svg class="w-3.5 h-3.5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ number_format($offre->salaire_min, 0, ',', ' ') }} FCFA+
                                    </span>
                                    @endif

                                    <span class="flex items-center gap-1.5 text-xs text-gray-400">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        {{ $offre->vues }} vue(s)
                                    </span>

                                    <span class="flex items-center gap-1.5 text-xs text-gray-400">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ $offre->created_at->diffForHumans() }}
                                    </span>

                                    @if($offre->date_limite)
                                    <span class="flex items-center gap-1.5 text-xs {{ $offre->date_limite->isPast() ? 'text-red-400' : 'text-gray-400' }}">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        Limite : {{ $offre->date_limite->format('d/m/Y') }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </a>
                    @empty
                    <div class="bg-white border border-gray-200 rounded-2xl p-16 text-center">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <p class="text-gray-900 font-bold text-lg mb-2">Aucune offre trouvée</p>
                        <p class="text-gray-400 text-sm mb-6">Aucune offre de stage ne correspond à vos critères.</p>
                        <a href="{{ route('offres.index') }}"
                           class="inline-flex items-center gap-2 px-5 py-2.5 bg-gray-900 text-white font-bold rounded-xl text-sm hover:bg-yellow-400 hover:text-gray-900 transition-all">
                            Réinitialiser les filtres
                        </a>
                    </div>
                    @endforelse
                </div>

                {{-- Pagination --}}
                @if($offres->hasPages())
                <div class="mt-8">
                    {{ $offres->withQueryString()->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection