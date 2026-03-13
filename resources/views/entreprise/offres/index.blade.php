@extends('layouts.app')

@section('title', 'Mes offres — Espace Entreprise')

@section('content')

<div class="bg-gray-950 border-b border-white/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex items-center justify-between gap-4 mb-6">
            <div>
                <p class="text-yellow-400 text-xs font-extrabold tracking-widest uppercase mb-1">Espace Entreprise</p>
                <h1 class="text-white font-extrabold text-2xl" style="letter-spacing:-0.02em">Mes offres</h1>
            </div>
            @if($entreprise->isValidee())
            <a href="{{ route('entreprise.offres.create') }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 bg-yellow-400 text-gray-900 font-extrabold text-sm rounded-xl hover:bg-yellow-300 transition-colors flex-shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                </svg>
                <span class="hidden sm:inline">Nouvelle offre</span>
                <span class="sm:hidden">Publier</span>
            </a>
            @endif
        </div>

        <nav class="flex gap-1 overflow-x-auto pb-1">
            @foreach([
                ['label' => 'Tableau de bord', 'route' => 'entreprise.dashboard',          'active' => false],
                ['label' => 'Mon profil',       'route' => 'entreprise.profil.edit',        'active' => false],
                ['label' => 'Mes offres',        'route' => 'entreprise.offres.index',       'active' => true],
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
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        @if($entreprise->isValidee())

            @if($offres->count() > 0)

                {{-- ── TABLE DESKTOP (md+) ── --}}
                <div class="hidden md:block bg-white border border-gray-200 rounded-2xl overflow-hidden mb-6">
                    <table class="min-w-full">
                        <thead>
                            <tr class="border-b border-gray-100 bg-gray-50/50">
                                <th class="px-6 py-4 text-left text-xs font-extrabold text-gray-500 uppercase tracking-widest">Offre</th>
                                <th class="px-6 py-4 text-left text-xs font-extrabold text-gray-500 uppercase tracking-widest">Type</th>
                                <th class="px-6 py-4 text-left text-xs font-extrabold text-gray-500 uppercase tracking-widest">Statut</th>
                                <th class="px-6 py-4 text-left text-xs font-extrabold text-gray-500 uppercase tracking-widest">Candidatures</th>
                                <th class="px-6 py-4 text-left text-xs font-extrabold text-gray-500 uppercase tracking-widest">Date</th>
                                <th class="px-6 py-4 text-right text-xs font-extrabold text-gray-500 uppercase tracking-widest">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($offres as $offre)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <p class="text-sm font-bold text-gray-900">{{ $offre->titre }}</p>
                                    <p class="text-xs text-gray-400 mt-0.5">{{ $offre->ville }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    @if($offre->type_offre === 'emploi')
                                        <span class="px-2.5 py-1 bg-indigo-50 text-indigo-700 text-xs font-extrabold rounded-full border border-indigo-100">Emploi</span>
                                    @elseif($offre->type_offre === 'stage_professionnel')
                                        <span class="px-2.5 py-1 bg-green-50 text-green-700 text-xs font-extrabold rounded-full border border-green-100">Stage pro</span>
                                    @else
                                        <span class="px-2.5 py-1 bg-orange-50 text-orange-700 text-xs font-extrabold rounded-full border border-orange-100">Stage académique</span>
                                    @endif
                                    @if($offre->type_contrat)
                                    <p class="text-xs text-gray-400 mt-1">{{ $offre->type_contrat }}</p>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($offre->statut === 'active')
                                        <span class="px-2.5 py-1 bg-green-50 text-green-700 text-xs font-extrabold rounded-full border border-green-200">Active</span>
                                    @elseif($offre->statut === 'fermee')
                                        <span class="px-2.5 py-1 bg-gray-100 text-gray-500 text-xs font-extrabold rounded-full border border-gray-200">Fermée</span>
                                    @else
                                        <span class="px-2.5 py-1 bg-yellow-50 text-yellow-700 text-xs font-extrabold rounded-full border border-yellow-200">{{ ucfirst($offre->statut) }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('entreprise.candidatures.offre', $offre->id) }}"
                                       class="inline-flex items-center gap-1 text-sm font-extrabold text-yellow-500 hover:text-yellow-400 transition-colors">
                                        {{ $offre->candidatures_count }}
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-400">{{ $offre->created_at->format('d/m/Y') }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('offres.show', $offre->slug) }}" target="_blank"
                                           class="px-3 py-1.5 border border-gray-200 text-gray-600 text-xs font-bold rounded-lg hover:border-gray-400 transition-all">
                                            Voir
                                        </a>
                                        <a href="{{ route('entreprise.offres.edit', $offre->id) }}"
                                           class="px-3 py-1.5 border border-gray-200 text-gray-600 text-xs font-bold rounded-lg hover:border-gray-400 transition-all">
                                            Modifier
                                        </a>
                                        @if($offre->statut === 'active')
                                        <form action="{{ route('entreprise.offres.change-status', $offre->id) }}" method="POST" class="inline"
                                              onsubmit="return confirm('Fermer cette offre ?')">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="statut" value="fermee">
                                            <button class="px-3 py-1.5 bg-red-50 text-red-600 text-xs font-bold rounded-lg border border-red-100 hover:bg-red-100 transition-all">
                                                Fermer
                                            </button>
                                        </form>
                                        @else
                                        <form action="{{ route('entreprise.offres.change-status', $offre->id) }}" method="POST" class="inline">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="statut" value="active">
                                            <button class="px-3 py-1.5 bg-green-50 text-green-700 text-xs font-bold rounded-lg border border-green-100 hover:bg-green-100 transition-all">
                                                Réactiver
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- ── CARDS MOBILE (< md) ── --}}
                <div class="md:hidden space-y-3 mb-6">
                    @foreach($offres as $offre)
                    <div class="bg-white border border-gray-200 rounded-2xl p-5">

                        {{-- En-tête --}}
                        <div class="flex items-start justify-between gap-3 mb-3">
                            <div class="min-w-0 flex-1">
                                <p class="text-sm font-extrabold text-gray-900 leading-snug">{{ $offre->titre }}</p>
                                <p class="text-xs text-gray-400 mt-0.5">{{ $offre->ville }}</p>
                            </div>
                            @if($offre->statut === 'active')
                                <span class="px-2 py-0.5 bg-green-50 text-green-700 text-xs font-extrabold rounded-full border border-green-200 flex-shrink-0">Active</span>
                            @elseif($offre->statut === 'fermee')
                                <span class="px-2 py-0.5 bg-gray-100 text-gray-500 text-xs font-extrabold rounded-full border border-gray-200 flex-shrink-0">Fermée</span>
                            @else
                                <span class="px-2 py-0.5 bg-yellow-50 text-yellow-700 text-xs font-extrabold rounded-full border border-yellow-200 flex-shrink-0">{{ ucfirst($offre->statut) }}</span>
                            @endif
                        </div>

                        {{-- Infos --}}
                        <div class="grid grid-cols-3 gap-2 mb-4">
                            <div class="bg-gray-50 rounded-xl p-2.5 text-center">
                                <p class="text-xs text-gray-400 mb-0.5">Type</p>
                                @if($offre->type_offre === 'emploi')
                                    <p class="text-xs font-extrabold text-indigo-600">Emploi</p>
                                @elseif($offre->type_offre === 'stage_professionnel')
                                    <p class="text-xs font-extrabold text-green-600">Stage pro</p>
                                @else
                                    <p class="text-xs font-extrabold text-orange-600">Stage aca.</p>
                                @endif
                            </div>
                            <div class="bg-gray-50 rounded-xl p-2.5 text-center">
                                <p class="text-xs text-gray-400 mb-0.5">Candidatures</p>
                                <a href="{{ route('entreprise.candidatures.offre', $offre->id) }}"
                                   class="text-xs font-extrabold text-yellow-500">
                                    {{ $offre->candidatures_count }} →
                                </a>
                            </div>
                            <div class="bg-gray-50 rounded-xl p-2.5 text-center">
                                <p class="text-xs text-gray-400 mb-0.5">Date</p>
                                <p class="text-xs font-bold text-gray-900">{{ $offre->created_at->format('d/m/Y') }}</p>
                            </div>
                        </div>

                        {{-- Actions --}}
                        <div class="flex gap-2">
                            <a href="{{ route('offres.show', $offre->slug) }}" target="_blank"
                               class="px-3 py-2 border border-gray-200 text-gray-600 text-xs font-bold rounded-xl hover:border-gray-400 transition-all">
                                Voir
                            </a>
                            <a href="{{ route('entreprise.offres.edit', $offre->id) }}"
                               class="flex-1 py-2 text-center border border-gray-200 text-gray-700 text-xs font-bold rounded-xl hover:border-gray-400 transition-all">
                                Modifier
                            </a>
                            @if($offre->statut === 'active')
                            <form action="{{ route('entreprise.offres.change-status', $offre->id) }}" method="POST" class="flex-1"
                                  onsubmit="return confirm('Fermer cette offre ?')">
                                @csrf @method('PATCH')
                                <input type="hidden" name="statut" value="fermee">
                                <button class="w-full py-2 bg-red-50 text-red-600 text-xs font-bold rounded-xl border border-red-100 hover:bg-red-100 transition-all">
                                    Fermer
                                </button>
                            </form>
                            @else
                            <form action="{{ route('entreprise.offres.change-status', $offre->id) }}" method="POST" class="flex-1">
                                @csrf @method('PATCH')
                                <input type="hidden" name="statut" value="active">
                                <button class="w-full py-2 bg-green-50 text-green-700 text-xs font-bold rounded-xl border border-green-100 hover:bg-green-100 transition-all">
                                    Réactiver
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>

                @if($offres->hasPages())
                <div>{{ $offres->links() }}</div>
                @endif

            @else
            {{-- État vide --}}
            <div class="bg-white border border-gray-200 rounded-2xl p-16 text-center">
                <div class="w-14 h-14 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <p class="text-gray-900 font-bold text-lg mb-2">Aucune offre publiée</p>
                <p class="text-gray-400 text-sm mb-6">Commencez par publier votre première offre d'emploi ou de stage.</p>
                <a href="{{ route('entreprise.offres.create') }}"
                   class="inline-flex items-center gap-2 px-6 py-3 bg-gray-900 text-white font-extrabold text-sm rounded-xl hover:bg-yellow-400 hover:text-gray-900 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                    </svg>
                    Publier une offre
                </a>
            </div>
            @endif

        @else
        {{-- Entreprise non validée --}}
        <div class="bg-white border border-yellow-200 rounded-2xl p-10 text-center">
            <div class="w-14 h-14 bg-yellow-50 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-7 h-7 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <p class="text-gray-900 font-bold text-lg mb-2">Validation en attente</p>
            <p class="text-gray-500 text-sm">Un administrateur doit valider votre profil avant que vous puissiez publier des offres.</p>
        </div>
        @endif

    </div>
</div>

@endsection