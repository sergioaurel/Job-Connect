@extends('layouts.app')

@section('title', $entreprise->nom_entreprise)

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-sm text-gray-500 mb-6">
        <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-600 transition">Administration</a>
        <span>/</span>
        <a href="{{ route('admin.entreprises.index') }}" class="hover:text-blue-600 transition">Entreprises</a>
        <span>/</span>
        <span class="text-gray-800 font-medium">{{ $entreprise->nom_entreprise }}</span>
    </nav>

    {{-- Messages flash --}}
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700">{{ session('success') }}</div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Colonne principale --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- Infos entreprise --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-start justify-between gap-4 mb-6">
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <h1 class="text-xl font-bold text-gray-900">{{ $entreprise->nom_entreprise }}</h1>
                            @if($entreprise->statut === 'en_attente')
                                <span class="px-2.5 py-1 bg-yellow-100 text-yellow-700 text-xs font-semibold rounded-full">En attente</span>
                            @elseif($entreprise->statut === 'validee')
                                <span class="px-2.5 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">Validée</span>
                            @else
                                <span class="px-2.5 py-1 bg-red-100 text-red-700 text-xs font-semibold rounded-full">Rejetée</span>
                            @endif
                        </div>
                        <p class="text-gray-500 text-sm">{{ $entreprise->secteur_activite }}</p>
                    </div>
                    @if($entreprise->logo)
                        <img src="{{ str_starts_with($entreprise->logo, 'http') ? $entreprise->logo : asset('storage/' . $entreprise->logo) }}" alt="Logo" class="w-16 h-16 rounded-xl object-cover border border-gray-100">
                    @endif
                </div>

                <dl class="grid grid-cols-2 gap-4 text-sm">
                    @if($entreprise->ville)
                    <div>
                        <dt class="text-gray-400 text-xs uppercase tracking-wide mb-1">Ville</dt>
                        <dd class="text-gray-900 font-medium">{{ $entreprise->ville }}</dd>
                    </div>
                    @endif
                    @if($entreprise->adresse)
                    <div>
                        <dt class="text-gray-400 text-xs uppercase tracking-wide mb-1">Adresse</dt>
                        <dd class="text-gray-900 font-medium">{{ $entreprise->adresse }}</dd>
                    </div>
                    @endif
                    @if($entreprise->telephone_entreprise)
                    <div>
                        <dt class="text-gray-400 text-xs uppercase tracking-wide mb-1">Téléphone</dt>
                        <dd class="text-gray-900 font-medium">{{ $entreprise->telephone_entreprise }}</dd>
                    </div>
                    @endif
                    @if($entreprise->site_web)
                    <div>
                        <dt class="text-gray-400 text-xs uppercase tracking-wide mb-1">Site web</dt>
                        <dd><a href="{{ $entreprise->site_web }}" target="_blank" class="text-blue-600 hover:underline font-medium">{{ $entreprise->site_web }}</a></dd>
                    </div>
                    @endif
                    @if($entreprise->effectif)
                    <div>
                        <dt class="text-gray-400 text-xs uppercase tracking-wide mb-1">Effectif</dt>
                        <dd class="text-gray-900 font-medium">{{ $entreprise->effectif }} employé(s)</dd>
                    </div>
                    @endif
                    @if($entreprise->annee_creation)
                    <div>
                        <dt class="text-gray-400 text-xs uppercase tracking-wide mb-1">Année de création</dt>
                        <dd class="text-gray-900 font-medium">{{ $entreprise->annee_creation }}</dd>
                    </div>
                    @endif
                    <div>
                        <dt class="text-gray-400 text-xs uppercase tracking-wide mb-1">Inscrite le</dt>
                        <dd class="text-gray-900 font-medium">{{ $entreprise->created_at->format('d/m/Y') }}</dd>
                    </div>
                </dl>

                @if($entreprise->description)
                <div class="mt-5 pt-5 border-t border-gray-100">
                    <p class="text-gray-400 text-xs uppercase tracking-wide mb-2">Description</p>
                    <p class="text-gray-700 text-sm leading-relaxed">{{ $entreprise->description }}</p>
                </div>
                @endif
            </div>

            {{-- Offres publiées --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-base font-semibold text-gray-900 mb-4 flex items-center gap-2">
                    Offres publiées
                    <span class="px-2 py-0.5 bg-blue-100 text-blue-700 text-xs font-bold rounded-full">{{ $entreprise->offres->count() }}</span>
                </h2>
                @if($entreprise->offres->count() > 0)
                    <div class="space-y-3">
                        @foreach($entreprise->offres as $offre)
                        <div class="flex items-center justify-between p-3 rounded-xl border border-gray-100 hover:bg-gray-50">
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $offre->titre }}</p>
                                <p class="text-xs text-gray-400 mt-0.5">{{ $offre->created_at->format('d/m/Y') }} · {{ $offre->ville }}</p>
                            </div>
                            @if($offre->statut === 'active')
                                <span class="px-2.5 py-1 bg-green-100 text-green-700 text-xs font-medium rounded-full">Active</span>
                            @elseif($offre->statut === 'fermee')
                                <span class="px-2.5 py-1 bg-gray-100 text-gray-600 text-xs font-medium rounded-full">Fermée</span>
                            @else
                                <span class="px-2.5 py-1 bg-yellow-100 text-yellow-700 text-xs font-medium rounded-full">Pourvue</span>
                            @endif
                        </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-gray-400 text-center py-4">Aucune offre publiée.</p>
                @endif
            </div>
        </div>

        {{-- Colonne latérale --}}
        <div class="space-y-6">

            {{-- Compte utilisateur --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-base font-semibold text-gray-900 mb-4">Compte utilisateur</h2>
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white font-bold text-sm">
                        {{ strtoupper(substr($entreprise->user->name ?? 'U', 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-900">{{ $entreprise->user->name ?? '—' }}</p>
                        <p class="text-xs text-gray-400">{{ $entreprise->user->email ?? '—' }}</p>
                    </div>
                </div>
                @if($entreprise->user)
                    <p class="text-xs text-gray-400">Inscrit le {{ $entreprise->user->created_at->format('d/m/Y') }}</p>
                @endif
            </div>

            {{-- Actions --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-base font-semibold text-gray-900 mb-4">Actions</h2>
                <div class="space-y-2">
                    @if($entreprise->statut === 'en_attente')
                        <form action="{{ route('admin.entreprises.valider', $entreprise->id) }}" method="POST">
                            @csrf @method('PATCH')
                            <button type="submit" class="w-full px-4 py-2.5 bg-green-600 text-white text-sm font-medium rounded-xl hover:bg-green-700 transition">
                                ✅ Valider l'entreprise
                            </button>
                        </form>
                        <form action="{{ route('admin.entreprises.rejeter', $entreprise->id) }}" method="POST"
                              onsubmit="return confirm('Rejeter cette entreprise ?')">
                            @csrf @method('PATCH')
                            <button type="submit" class="w-full px-4 py-2.5 bg-red-50 text-red-700 text-sm font-medium rounded-xl border border-red-200 hover:bg-red-100 transition">
                                ❌ Rejeter l'entreprise
                            </button>
                        </form>
                    @elseif($entreprise->statut === 'validee')
                        <form action="{{ route('admin.entreprises.suspendre', $entreprise->id) }}" method="POST"
                              onsubmit="return confirm('Suspendre cette entreprise ?')">
                            @csrf @method('PATCH')
                            <button type="submit" class="w-full px-4 py-2.5 bg-gray-100 text-gray-700 text-sm font-medium rounded-xl hover:bg-gray-200 transition">
                                ⏸ Suspendre le compte
                            </button>
                        </form>
                    @else
                        <form action="{{ route('admin.entreprises.reactiver', $entreprise->id) }}" method="POST">
                            @csrf @method('PATCH')
                            <button type="submit" class="w-full px-4 py-2.5 bg-blue-50 text-blue-700 text-sm font-medium rounded-xl border border-blue-200 hover:bg-blue-100 transition">
                                ▶ Réactiver le compte
                            </button>
                        </form>
                    @endif

                    <a href="{{ route('admin.entreprises.index') }}"
                       class="block w-full text-center px-4 py-2.5 border border-gray-200 text-gray-700 text-sm font-medium rounded-xl hover:bg-gray-50 transition">
                        ← Retour à la liste
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection