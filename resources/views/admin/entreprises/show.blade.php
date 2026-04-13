@extends('layouts.app')

@section('title', $entreprise->nom_entreprise . ' — Administration')

@section('content')

{{-- ═══════════════════════════════════════
     HEADER SOMBRE
═══════════════════════════════════════ --}}
<div class="bg-gray-950 border-b border-white/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 pb-6">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-xs text-gray-500 mb-5">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-yellow-400 transition font-semibold">Administration</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('admin.entreprises.index') }}" class="hover:text-yellow-400 transition font-semibold">Entreprises</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-gray-400">{{ $entreprise->nom_entreprise }}</span>
        </nav>

        {{-- Titre + statut --}}
        <div class="flex items-start justify-between gap-4">
            <div class="flex items-start gap-4">
                {{-- Logo ou initiale --}}
                @if($entreprise->logo)
                <img src="{{ str_starts_with($entreprise->logo, 'http') ? $entreprise->logo : asset('storage/' . $entreprise->logo) }}"
                     alt="Logo"
                     class="w-14 h-14 rounded-2xl object-cover border border-white/10 flex-shrink-0">
                @else
                <div class="w-14 h-14 rounded-2xl bg-yellow-400 flex items-center justify-center text-gray-900 font-extrabold text-xl flex-shrink-0">
                    {{ strtoupper(substr($entreprise->nom_entreprise, 0, 1)) }}
                </div>
                @endif
                <div>
                    <div class="flex items-center gap-3 mb-1">
                        <h1 class="text-white font-extrabold text-2xl" style="letter-spacing:-0.02em">
                            {{ $entreprise->nom_entreprise }}
                        </h1>
                        @if($entreprise->statut === 'en_attente')
                        <span class="px-2.5 py-1 bg-orange-500/15 text-orange-400 text-xs font-extrabold rounded-lg border border-orange-500/20">En attente</span>
                        @elseif($entreprise->statut === 'validee')
                        <span class="px-2.5 py-1 bg-green-500/15 text-green-400 text-xs font-extrabold rounded-lg border border-green-500/20 flex items-center gap-1.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-400 animate-pulse inline-block"></span>Validée
                        </span>
                        @else
                        <span class="px-2.5 py-1 bg-red-500/15 text-red-400 text-xs font-extrabold rounded-lg border border-red-500/20">Rejetée</span>
                        @endif
                    </div>
                    <p class="text-gray-400 text-sm">{{ $entreprise->secteur_activite }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════
     CONTENU
═══════════════════════════════════════ --}}
<div class="bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- Flash --}}
        @if(session('success'))
        <div class="mb-6 flex items-center gap-3 px-5 py-3.5 bg-green-50 border border-green-200 rounded-2xl text-green-700 text-sm font-semibold">
            <svg class="w-5 h-5 flex-shrink-0 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- ── COLONNE PRINCIPALE ── --}}
            <div class="lg:col-span-2 space-y-5">

                {{-- Informations de l'entreprise --}}
                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl bg-yellow-400 flex items-center justify-center">
                            <svg class="w-4 h-4 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </div>
                        <h2 class="text-gray-900 font-extrabold text-base">Informations de l'entreprise</h2>
                    </div>
                    <div class="p-6">
                        <dl class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            @if($entreprise->ville)
                            <div>
                                <dt class="text-xs font-extrabold text-gray-400 uppercase tracking-widest mb-1">Ville</dt>
                                <dd class="text-gray-900 text-sm font-semibold">{{ $entreprise->ville }}</dd>
                            </div>
                            @endif
                            @if($entreprise->adresse)
                            <div>
                                <dt class="text-xs font-extrabold text-gray-400 uppercase tracking-widest mb-1">Adresse</dt>
                                <dd class="text-gray-900 text-sm font-semibold">{{ $entreprise->adresse }}</dd>
                            </div>
                            @endif
                            @if($entreprise->telephone_entreprise)
                            <div>
                                <dt class="text-xs font-extrabold text-gray-400 uppercase tracking-widest mb-1">Téléphone</dt>
                                <dd class="text-gray-900 text-sm font-semibold">{{ $entreprise->telephone_entreprise }}</dd>
                            </div>
                            @endif
                            @if($entreprise->site_web)
                            <div>
                                <dt class="text-xs font-extrabold text-gray-400 uppercase tracking-widest mb-1">Site web</dt>
                                <dd>
                                    <a href="{{ $entreprise->site_web }}" target="_blank"
                                       class="text-yellow-500 hover:text-yellow-400 text-sm font-semibold transition-colors">
                                        {{ $entreprise->site_web }}
                                    </a>
                                </dd>
                            </div>
                            @endif
                            @if($entreprise->effectif)
                            <div>
                                <dt class="text-xs font-extrabold text-gray-400 uppercase tracking-widest mb-1">Effectif</dt>
                                <dd class="text-gray-900 text-sm font-semibold">{{ $entreprise->effectif }} employé(s)</dd>
                            </div>
                            @endif
                            @if($entreprise->annee_creation)
                            <div>
                                <dt class="text-xs font-extrabold text-gray-400 uppercase tracking-widests mb-1">Année de création</dt>
                                <dd class="text-gray-900 text-sm font-semibold">{{ $entreprise->annee_creation }}</dd>
                            </div>
                            @endif
                            <div>
                                <dt class="text-xs font-extrabold text-gray-400 uppercase tracking-widests mb-1">Inscrite le</dt>
                                <dd class="text-gray-900 text-sm font-semibold">{{ $entreprise->created_at->format('d/m/Y') }}</dd>
                            </div>
                        </dl>

                        @if($entreprise->description)
                        <div class="mt-6 pt-5 border-t border-gray-100">
                            <p class="text-xs font-extrabold text-gray-400 uppercase tracking-widest mb-3">Description</p>
                            <p class="text-gray-600 text-sm leading-relaxed">{{ $entreprise->description }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Offres publiées --}}
                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl bg-indigo-100 flex items-center justify-center">
                            <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <h2 class="text-gray-900 font-extrabold text-base">
                            Offres publiées
                            <span class="ml-2 px-2 py-0.5 bg-indigo-50 text-indigo-600 text-xs font-extrabold rounded-lg">
                                {{ $entreprise->offres->count() }}
                            </span>
                        </h2>
                    </div>

                    @if($entreprise->offres->count() > 0)
                    <div class="divide-y divide-gray-50">
                        @foreach($entreprise->offres as $offre)
                        <div class="px-6 py-4 flex items-center justify-between gap-4 hover:bg-gray-50 transition-colors">
                            <div class="flex-1 min-w-0">
                                <p class="text-gray-900 font-bold text-sm truncate">{{ $offre->titre }}</p>
                                <p class="text-gray-400 text-xs mt-0.5">{{ $offre->created_at->format('d/m/Y') }} · {{ $offre->ville }}</p>
                            </div>
                            @if($offre->statut === 'active')
                            <span class="flex-shrink-0 px-2.5 py-1 bg-green-50 text-green-700 text-xs font-extrabold rounded-lg border border-green-100">Active</span>
                            @elseif($offre->statut === 'fermee')
                            <span class="flex-shrink-0 px-2.5 py-1 bg-gray-100 text-gray-500 text-xs font-extrabold rounded-lg">Fermée</span>
                            @else
                            <span class="flex-shrink-0 px-2.5 py-1 bg-yellow-50 text-yellow-600 text-xs font-extrabold rounded-lg border border-yellow-100">Pourvue</span>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="px-6 py-12 text-center">
                        <div class="w-12 h-12 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <p class="text-gray-500 text-sm font-semibold">Aucune offre publiée</p>
                    </div>
                    @endif
                </div>

            </div>

            {{-- ── COLONNE LATÉRALE ── --}}
            <div class="space-y-5">

                {{-- Compte utilisateur --}}
                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl bg-gray-900 flex items-center justify-center">
                            <svg class="w-4 h-4 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </div>
                        <h2 class="text-gray-900 font-extrabold text-base">Compte utilisateur</h2>
                    </div>
                    <div class="p-5">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-11 h-11 rounded-xl bg-gray-900 flex items-center justify-center text-white font-extrabold text-base flex-shrink-0">
                                {{ strtoupper(substr($entreprise->user->name ?? 'U', 0, 1)) }}
                            </div>
                            <div>
                                <p class="text-gray-900 font-extrabold text-sm">{{ $entreprise->user->name ?? '—' }}</p>
                                <p class="text-gray-400 text-xs">{{ $entreprise->user->email ?? '—' }}</p>
                            </div>
                        </div>
                        @if($entreprise->user)
                        <p class="text-gray-400 text-xs">
                            Inscrit le {{ $entreprise->user->created_at->format('d/m/Y') }}
                        </p>
                        @endif
                    </div>
                </div>

                {{-- Actions --}}
                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl bg-gray-900 flex items-center justify-center">
                            <svg class="w-4 h-4 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <h2 class="text-gray-900 font-extrabold text-base">Actions</h2>
                    </div>
                    <div class="p-5 space-y-2">

                        @if($entreprise->statut === 'en_attente')
                        <form action="{{ route('admin.entreprises.valider', $entreprise->id) }}" method="POST">
                            @csrf @method('PATCH')
                            <button type="submit"
                                    class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-green-50 text-green-700 font-extrabold text-sm rounded-xl border border-green-200 hover:bg-green-100 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Valider l'entreprise
                            </button>
                        </form>
                        <form action="{{ route('admin.entreprises.rejeter', $entreprise->id) }}" method="POST"
                              onsubmit="return confirm('Rejeter cette entreprise ?')">
                            @csrf @method('PATCH')
                            <button type="submit"
                                    class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-red-50 text-red-600 font-extrabold text-sm rounded-xl border border-red-200 hover:bg-red-100 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Rejeter l'entreprise
                            </button>
                        </form>

                        @elseif($entreprise->statut === 'validee')
                        <form action="{{ route('admin.entreprises.suspendre', $entreprise->id) }}" method="POST"
                              onsubmit="return confirm('Suspendre cette entreprise ?')">
                            @csrf @method('PATCH')
                            <button type="submit"
                                    class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-gray-100 text-gray-700 font-extrabold text-sm rounded-xl border border-gray-200 hover:bg-gray-200 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Suspendre le compte
                            </button>
                        </form>

                        @else
                        <form action="{{ route('admin.entreprises.reactiver', $entreprise->id) }}" method="POST">
                            @csrf @method('PATCH')
                            <button type="submit"
                                    class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-yellow-50 text-yellow-700 font-extrabold text-sm rounded-xl border border-yellow-200 hover:bg-yellow-100 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Réactiver le compte
                            </button>
                        </form>
                        @endif

                        <a href="{{ route('admin.entreprises.index') }}"
                           class="w-full flex items-center justify-center gap-2 px-4 py-3 border border-gray-200 text-gray-600 font-extrabold text-sm rounded-xl hover:border-gray-400 hover:text-gray-800 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                            Retour à la liste
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection