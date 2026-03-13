@extends('layouts.app')

@section('title', 'Gestion des entreprises — Admin')

@section('content')

{{-- ══════════════════════════════════
     HEADER ADMIN
══════════════════════════════════ --}}
<div class="bg-gray-950 border-b border-white/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-1">
            <p class="text-yellow-400 text-xs font-extrabold tracking-widest uppercase mb-1">Espace Admin</p>
            <h1 class="text-white font-extrabold text-2xl" style="letter-spacing:-0.02em">Gestion des entreprises</h1>
            <p class="text-gray-500 text-sm mt-1">{{ $entreprises->total() }} entreprise(s) au total</p>
        </div>
        <nav class="flex gap-1 mt-6 overflow-x-auto pb-1">
            @foreach([
                ['label' => 'Tableau de bord', 'route' => 'admin.dashboard',         'active' => false],
                ['label' => 'Entreprises',      'route' => 'admin.entreprises.index', 'active' => true],
                ['label' => 'Statistiques',     'route' => 'admin.statistiques',      'active' => false],
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

        @if(session('success'))
        <div class="mb-6 flex items-center gap-3 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl text-sm">
            <svg class="w-4 h-4 flex-shrink-0 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            {{ session('success') }}
        </div>
        @endif

        {{-- ── FILTRES ── --}}
        <form action="{{ route('admin.entreprises.index') }}" method="GET"
              class="bg-white border border-gray-200 rounded-2xl p-4 mb-6 flex flex-col sm:flex-row gap-3">
            <div class="relative flex-1">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </span>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Rechercher une entreprise..."
                       class="w-full pl-9 pr-4 py-2.5 text-sm rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 transition-all">
            </div>
            <select name="statut"
                    class="py-2.5 px-3 text-sm rounded-xl border border-gray-200 bg-gray-50 text-gray-900 focus:outline-none focus:border-yellow-400 appearance-none sm:w-44">
                <option value="">Tous les statuts</option>
                <option value="en_attente" {{ request('statut') == 'en_attente' ? 'selected' : '' }}>En attente</option>
                <option value="validee"    {{ request('statut') == 'validee'    ? 'selected' : '' }}>Validée</option>
                <option value="rejetee"    {{ request('statut') == 'rejetee'    ? 'selected' : '' }}>Rejetée</option>
            </select>
            <div class="flex gap-2">
                <button type="submit"
                        class="flex-1 sm:flex-none px-5 py-2.5 bg-gray-900 text-white text-sm font-extrabold rounded-xl hover:bg-yellow-400 hover:text-gray-900 transition-all">
                    Filtrer
                </button>
                @if(request('search') || request('statut'))
                <a href="{{ route('admin.entreprises.index') }}"
                   class="px-4 py-2.5 border border-gray-200 text-gray-600 text-sm font-bold rounded-xl hover:border-gray-400 transition-all">
                    Effacer
                </a>
                @endif
            </div>
        </form>

        @if($entreprises->count() > 0)

            {{-- ── TABLE DESKTOP (md+) ── --}}
            <div class="hidden md:block bg-white border border-gray-200 rounded-2xl overflow-hidden mb-6">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b border-gray-100 bg-gray-50/50">
                            <th class="px-6 py-4 text-left text-xs font-extrabold text-gray-500 uppercase tracking-widest">Entreprise</th>
                            <th class="px-6 py-4 text-left text-xs font-extrabold text-gray-500 uppercase tracking-widest">Contact</th>
                            <th class="px-6 py-4 text-left text-xs font-extrabold text-gray-500 uppercase tracking-widest">Secteur</th>
                            <th class="px-6 py-4 text-left text-xs font-extrabold text-gray-500 uppercase tracking-widest">Statut</th>
                            <th class="px-6 py-4 text-left text-xs font-extrabold text-gray-500 uppercase tracking-widest">Date</th>
                            <th class="px-6 py-4 text-right text-xs font-extrabold text-gray-500 uppercase tracking-widest">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($entreprises as $entreprise)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-xl bg-gray-900 flex items-center justify-center text-white font-extrabold text-sm flex-shrink-0">
                                        {{ strtoupper(substr($entreprise->nom_entreprise, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-gray-900">{{ $entreprise->nom_entreprise }}</p>
                                        <p class="text-xs text-gray-400">{{ $entreprise->ville ?? '—' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-900">{{ $entreprise->user->name ?? '—' }}</p>
                                <p class="text-xs text-gray-400">{{ $entreprise->user->email ?? '—' }}</p>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600 max-w-xs">
                                <span class="line-clamp-1">{{ $entreprise->secteur_activite ?? '—' }}</span>
                            </td>
                            <td class="px-6 py-4">
                                @if($entreprise->statut === 'en_attente')
                                    <span class="px-2.5 py-1 bg-yellow-50 text-yellow-700 text-xs font-extrabold rounded-full border border-yellow-200">En attente</span>
                                @elseif($entreprise->statut === 'validee')
                                    <span class="px-2.5 py-1 bg-green-50 text-green-700 text-xs font-extrabold rounded-full border border-green-200">Validée</span>
                                @else
                                    <span class="px-2.5 py-1 bg-red-50 text-red-700 text-xs font-extrabold rounded-full border border-red-200">Rejetée</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-400">{{ $entreprise->created_at->format('d/m/Y') }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.entreprises.show', $entreprise->id) }}"
                                       class="px-3 py-1.5 border border-gray-200 text-gray-600 text-xs font-bold rounded-lg hover:border-gray-400 transition-all">
                                        Détails
                                    </a>
                                    @if($entreprise->statut === 'en_attente')
                                    <form action="{{ route('admin.entreprises.valider', $entreprise->id) }}" method="POST" class="inline">
                                        @csrf @method('PATCH')
                                        <button class="px-3 py-1.5 bg-green-600 text-white text-xs font-bold rounded-lg hover:bg-green-700 transition-all">Valider</button>
                                    </form>
                                    <form action="{{ route('admin.entreprises.rejeter', $entreprise->id) }}" method="POST" class="inline"
                                          onsubmit="return confirm('Rejeter cette entreprise ?')">
                                        @csrf @method('PATCH')
                                        <button class="px-3 py-1.5 border border-red-200 text-red-600 text-xs font-bold rounded-lg hover:bg-red-50 transition-all">Rejeter</button>
                                    </form>
                                    @elseif($entreprise->statut === 'validee')
                                    <form action="{{ route('admin.entreprises.suspendre', $entreprise->id) }}" method="POST" class="inline"
                                          onsubmit="return confirm('Suspendre cette entreprise ?')">
                                        @csrf @method('PATCH')
                                        <button class="px-3 py-1.5 bg-gray-100 text-gray-700 text-xs font-bold rounded-lg hover:bg-gray-200 transition-all">Suspendre</button>
                                    </form>
                                    @else
                                    <form action="{{ route('admin.entreprises.reactiver', $entreprise->id) }}" method="POST" class="inline">
                                        @csrf @method('PATCH')
                                        <button class="px-3 py-1.5 bg-blue-50 text-blue-700 text-xs font-bold rounded-lg border border-blue-200 hover:bg-blue-100 transition-all">Réactiver</button>
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
                @foreach($entreprises as $entreprise)
                <div class="bg-white border border-gray-200 rounded-2xl p-5">
                    {{-- En-tête --}}
                    <div class="flex items-start gap-3 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-gray-900 flex items-center justify-center text-white font-extrabold flex-shrink-0">
                            {{ strtoupper(substr($entreprise->nom_entreprise, 0, 1)) }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="flex items-start justify-between gap-2">
                                <p class="text-sm font-extrabold text-gray-900 leading-tight">{{ $entreprise->nom_entreprise }}</p>
                                @if($entreprise->statut === 'en_attente')
                                    <span class="px-2 py-0.5 bg-yellow-50 text-yellow-700 text-xs font-extrabold rounded-full border border-yellow-200 flex-shrink-0">En attente</span>
                                @elseif($entreprise->statut === 'validee')
                                    <span class="px-2 py-0.5 bg-green-50 text-green-700 text-xs font-extrabold rounded-full border border-green-200 flex-shrink-0">Validée</span>
                                @else
                                    <span class="px-2 py-0.5 bg-red-50 text-red-700 text-xs font-extrabold rounded-full border border-red-200 flex-shrink-0">Rejetée</span>
                                @endif
                            </div>
                            <p class="text-xs text-gray-400 mt-0.5 truncate">{{ $entreprise->secteur_activite ?? '—' }}</p>
                        </div>
                    </div>

                    {{-- Infos --}}
                    <div class="grid grid-cols-2 gap-2 mb-4">
                        <div class="bg-gray-50 rounded-xl p-3">
                            <p class="text-xs text-gray-400 mb-0.5">Contact</p>
                            <p class="text-xs font-bold text-gray-900 truncate">{{ $entreprise->user->name ?? '—' }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-3">
                            <p class="text-xs text-gray-400 mb-0.5">Inscription</p>
                            <p class="text-xs font-bold text-gray-900">{{ $entreprise->created_at->format('d/m/Y') }}</p>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="flex gap-2">
                        <a href="{{ route('admin.entreprises.show', $entreprise->id) }}"
                           class="px-3 py-2 border border-gray-200 text-gray-600 text-xs font-bold rounded-xl hover:border-gray-400 transition-all flex-shrink-0">
                            Détails
                        </a>
                        @if($entreprise->statut === 'en_attente')
                        <form action="{{ route('admin.entreprises.valider', $entreprise->id) }}" method="POST" class="flex-1">
                            @csrf @method('PATCH')
                            <button class="w-full py-2 bg-gray-900 text-white text-xs font-extrabold rounded-xl hover:bg-yellow-400 hover:text-gray-900 transition-all">✓ Valider</button>
                        </form>
                        <form action="{{ route('admin.entreprises.rejeter', $entreprise->id) }}" method="POST" class="flex-1"
                              onsubmit="return confirm('Rejeter cette entreprise ?')">
                            @csrf @method('PATCH')
                            <button class="w-full py-2 border border-red-200 text-red-600 text-xs font-extrabold rounded-xl hover:bg-red-50 transition-all">✗ Rejeter</button>
                        </form>
                        @elseif($entreprise->statut === 'validee')
                        <form action="{{ route('admin.entreprises.suspendre', $entreprise->id) }}" method="POST" class="flex-1"
                              onsubmit="return confirm('Suspendre ?')">
                            @csrf @method('PATCH')
                            <button class="w-full py-2 bg-gray-100 text-gray-700 text-xs font-bold rounded-xl hover:bg-gray-200 transition-all">Suspendre</button>
                        </form>
                        @else
                        <form action="{{ route('admin.entreprises.reactiver', $entreprise->id) }}" method="POST" class="flex-1">
                            @csrf @method('PATCH')
                            <button class="w-full py-2 bg-blue-50 text-blue-700 text-xs font-bold rounded-xl border border-blue-200 hover:bg-blue-100 transition-all">Réactiver</button>
                        </form>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

            @if($entreprises->hasPages())
            <div>{{ $entreprises->withQueryString()->links() }}</div>
            @endif

        @else
        <div class="bg-white border border-gray-200 rounded-2xl p-16 text-center">
            <div class="w-14 h-14 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-7 h-7 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
            <p class="text-gray-900 font-bold text-lg mb-2">Aucune entreprise trouvée</p>
            <a href="{{ route('admin.entreprises.index') }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-gray-900 text-white font-bold rounded-xl text-sm hover:bg-yellow-400 hover:text-gray-900 transition-all">
                Réinitialiser les filtres
            </a>
        </div>
        @endif
    </div>
</div>

@endsection