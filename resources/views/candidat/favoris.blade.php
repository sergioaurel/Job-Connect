@extends('layouts.app')

@section('title', 'Mes favoris')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Mes offres favorites</h1>
        <p class="text-gray-600">{{ $favoris->total() }} offre(s) sauvegardée(s)</p>
    </div>

    <!-- Menu de navigation -->
    <div class="mb-8 border-b border-gray-200">
        <nav class="flex space-x-8">
            <a href="{{ route('candidat.dashboard') }}" class="pb-4 border-b-2 border-transparent text-sm font-medium text-gray-600 hover:text-gray-900 hover:border-gray-300">
                Tableau de bord
            </a>
            <a href="{{ route('candidat.profil') }}" class="pb-4 border-b-2 border-transparent text-sm font-medium text-gray-600 hover:text-gray-900 hover:border-gray-300">
                Mon profil
            </a>
            <a href="{{ route('candidat.candidatures') }}" class="pb-4 border-b-2 border-transparent text-sm font-medium text-gray-600 hover:text-gray-900 hover:border-gray-300">
                Mes candidatures
            </a>
            <a href="{{ route('candidat.favoris') }}" class="pb-4 border-b-2 border-gray-900 text-sm font-medium text-gray-900">
                Mes favoris
            </a>
        </nav>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($favoris as $offre)
            <div class="bg-white border border-gray-200 rounded p-6 hover:border-gray-900 transition">
                <div class="text-xs font-medium text-gray-600 mb-2 uppercase">
                    @if($offre->type_offre === 'emploi')
                        EMPLOI
                    @elseif($offre->type_offre === 'stage_professionnel')
                        STAGE PROFESSIONNEL
                    @else
                        STAGE ACADÉMIQUE
                    @endif
                </div>

                <h3 class="text-lg font-semibold text-gray-900 mb-2">
                    <a href="{{ route('offres.show', $offre->slug) }}" class="hover:underline">
                        {{ $offre->titre }}
                    </a>
                </h3>

                <div class="text-sm text-gray-600 mb-4">
                    {{ $offre->entreprise->nom_entreprise }}
                </div>

                <div class="flex items-center text-xs text-gray-500 space-x-4 mb-4">
                    <span>{{ $offre->ville }}</span>
                    <span>•</span>
                    <span>{{ $offre->type_contrat ?? 'Stage' }}</span>
                </div>

                <div class="flex gap-2">
                    <a href="{{ route('candidat.candidatures.create', $offre->id) }}" 
                       class="flex-1 px-4 py-2 bg-gray-900 text-white text-sm font-medium text-center rounded hover:bg-gray-800">
                        Postuler
                    </a>
                    <button 
                        onclick="toggleFavori({{ $offre->id }})"
                        class="px-4 py-2 border border-gray-300 text-gray-900 text-sm font-medium rounded hover:bg-gray-50">
                        Retirer
                    </button>
                </div>
            </div>
        @empty
            <div class="col-span-3 bg-white border border-gray-200 rounded p-12 text-center">
                <p class="text-gray-600 mb-4">Aucune offre favorite pour le moment.</p>
                <a href="{{ route('offres.index') }}" class="inline-block px-6 py-3 bg-gray-900 text-white font-medium rounded hover:bg-gray-800">
                    Parcourir les offres
                </a>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($favoris->hasPages())
        <div class="mt-8">
            {{ $favoris->links() }}
        </div>
    @endif
</div>

@push('scripts')
<script>
    function toggleFavori(offreId) {
        fetch(`/candidat/favoris/toggle/${offreId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (!data.estFavori) {
                location.reload();
            }
        })
        .catch(error => console.error('Erreur:', error));
    }
</script>
@endpush
@endsection