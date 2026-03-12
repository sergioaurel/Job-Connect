@extends('layouts.app')

@section('title', 'Gestion des entreprises')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Gestion des entreprises</h1>
        <p class="text-gray-600">{{ $entreprises->total() }} entreprise(s) au total</p>
    </div>

    {{-- Navigation --}}
    <div class="mb-8 border-b border-gray-200">
        <nav class="flex space-x-8">
            <a href="{{ route('admin.dashboard') }}" class="pb-4 border-b-2 border-transparent text-sm font-medium text-gray-600 hover:text-gray-900 hover:border-gray-300">
                Tableau de bord
            </a>
            <a href="{{ route('admin.entreprises.index') }}" class="pb-4 border-b-2 border-gray-900 text-sm font-medium text-gray-900">
                Entreprises
            </a>
            <a href="{{ route('admin.statistiques') }}" class="pb-4 border-b-2 border-transparent text-sm font-medium text-gray-600 hover:text-gray-900 hover:border-gray-300">
                Statistiques
            </a>
        </nav>
    </div>

    {{-- Messages flash --}}
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700">
            {{ session('success') }}
        </div>
    @endif

    {{-- Filtres --}}
    <div class="mb-6 flex flex-wrap gap-3">
        <form action="{{ route('admin.entreprises.index') }}" method="GET" class="flex flex-wrap gap-3">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Rechercher une entreprise..."
                class="px-3 py-2 border border-gray-300 rounded text-sm focus:outline-none focus:border-gray-900 w-64"
            >
            <select name="statut" class="px-3 py-2 border border-gray-300 rounded text-sm focus:outline-none focus:border-gray-900">
                <option value="">Tous les statuts</option>
                <option value="en_attente" {{ request('statut') == 'en_attente' ? 'selected' : '' }}>En attente</option>
                <option value="validee" {{ request('statut') == 'validee' ? 'selected' : '' }}>Validée</option>
                <option value="rejetee" {{ request('statut') == 'rejetee' ? 'selected' : '' }}>Rejetée</option>
            </select>
            <button type="submit" class="px-4 py-2 bg-gray-900 text-white text-sm font-medium rounded hover:bg-gray-800">
                Filtrer
            </button>
            @if(request('search') || request('statut'))
                <a href="{{ route('admin.entreprises.index') }}" class="px-4 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded hover:bg-gray-50">
                    Réinitialiser
                </a>
            @endif
        </form>
    </div>

    {{-- Tableau --}}
    @if($entreprises->count() > 0)
        <div class="bg-white border border-gray-200 rounded overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Entreprise</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Contact</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Secteur</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider w-32">Statut</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Inscription</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-700 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($entreprises as $entreprise)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-900 text-sm">{{ $entreprise->nom_entreprise }}</div>
                                <div class="text-xs text-gray-500">{{ $entreprise->ville }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">{{ $entreprise->user->name ?? '—' }}</div>
                                <div class="text-xs text-gray-500">{{ $entreprise->user->email ?? '—' }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-700">
                                {{ $entreprise->secteur_activite ?? '—' }}
                            </td>
                            <td class="px-6 py-4">
                                @if($entreprise->statut === 'en_attente')
                                    <span class="inline-block whitespace-nowrap px-2.5 py-1 bg-yellow-100 text-yellow-700 text-xs font-medium rounded-full">En attente</span>
                                @elseif($entreprise->statut === 'validee')
                                    <span class="inline-block whitespace-nowrap px-2.5 py-1 bg-green-100 text-green-700 text-xs font-medium rounded-full">Validée</span>
                                @else
                                    <span class="inline-block whitespace-nowrap px-2.5 py-1 bg-red-100 text-red-700 text-xs font-medium rounded-full">Rejetée</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $entreprise->created_at->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.entreprises.show', $entreprise->id) }}"
                                       class="px-3 py-1.5 border border-gray-300 text-gray-700 text-xs font-medium rounded hover:bg-gray-50">
                                        Détails
                                    </a>
                                    @if($entreprise->statut === 'en_attente')
                                        <form action="{{ route('admin.entreprises.valider', $entreprise->id) }}" method="POST" class="inline">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="px-3 py-1.5 bg-green-600 text-white text-xs font-medium rounded hover:bg-green-700">
                                                Valider
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.entreprises.rejeter', $entreprise->id) }}" method="POST" class="inline"
                                              onsubmit="return confirm('Rejeter cette entreprise ?')">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="px-3 py-1.5 bg-red-50 text-red-700 text-xs font-medium rounded border border-red-200 hover:bg-red-100">
                                                Rejeter
                                            </button>
                                        </form>
                                    @elseif($entreprise->statut === 'validee')
                                        <form action="{{ route('admin.entreprises.suspendre', $entreprise->id) }}" method="POST" class="inline"
                                              onsubmit="return confirm('Suspendre cette entreprise ?')">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="px-3 py-1.5 bg-gray-100 text-gray-700 text-xs font-medium rounded hover:bg-gray-200">
                                                Suspendre
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.entreprises.reactiver', $entreprise->id) }}" method="POST" class="inline">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="px-3 py-1.5 bg-blue-50 text-blue-700 text-xs font-medium rounded border border-blue-200 hover:bg-blue-100">
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
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $entreprises->withQueryString()->links() }}
            </div>
        </div>
    @else
        <div class="bg-white border border-gray-200 rounded p-12 text-center">
            <p class="text-gray-600">Aucune entreprise trouvée.</p>
        </div>
    @endif
</div>
@endsection