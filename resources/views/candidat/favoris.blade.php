@extends('layouts.app')

@section('title', 'Mes favoris')

@section('content')

{{-- ═══════════════════════════════════════
     HEADER ESPACE CANDIDAT
═══════════════════════════════════════ --}}
<div class="bg-gray-950 border-b border-white/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 pb-0">
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-6">
            <div>
                <p class="text-yellow-400 text-xs font-extrabold tracking-widest uppercase mb-1">Espace Candidat</p>
                <h1 class="text-white font-extrabold text-2xl sm:text-3xl" style="letter-spacing:-0.02em">
                    Mes offres favorites
                </h1>
                <p class="text-gray-500 text-sm mt-1">{{ $favoris->total() }} offre(s) sauvegardée(s)</p>
            </div>
        </div>
        {{-- Navigation tabs --}}
        <nav class="flex gap-1 overflow-x-auto scrollbar-hide">
            @php
            $tabs = [
                ['route' => 'candidat.dashboard',     'label' => 'Tableau de bord', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                ['route' => 'candidat.profil',        'label' => 'Mon profil',       'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'],
                ['route' => 'candidat.candidatures',  'label' => 'Candidatures',     'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
                ['route' => 'candidat.favoris',       'label' => 'Favoris',          'icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z'],
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

{{-- ═══════════════════════════════════════
     CONTENU
═══════════════════════════════════════ --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
        @forelse($favoris as $offre)
        <div class="bg-white border border-gray-200 rounded-2xl p-6 flex flex-col gap-3 hover:border-yellow-300 hover:shadow-sm transition-all group">

            {{-- Type badge + action retirer --}}
            <div class="flex items-start justify-between">
                @if($offre->type_offre === 'emploi')
                    <span class="px-2.5 py-1 bg-indigo-50 text-indigo-600 text-xs font-extrabold rounded-lg uppercase tracking-wide">Emploi</span>
                @elseif($offre->type_offre === 'stage_professionnel')
                    <span class="px-2.5 py-1 bg-green-50 text-green-600 text-xs font-extrabold rounded-lg uppercase tracking-wide">Stage Pro</span>
                @else
                    <span class="px-2.5 py-1 bg-orange-50 text-orange-500 text-xs font-extrabold rounded-lg uppercase tracking-wide">Stage Acad.</span>
                @endif

                <button onclick="toggleFavori({{ $offre->id }}, this)"
                        class="w-8 h-8 rounded-lg flex items-center justify-center bg-red-50 text-red-400 hover:bg-red-100 hover:text-red-600 transition-all"
                        title="Retirer des favoris">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </button>
            </div>

            {{-- Titre --}}
            <a href="{{ route('offres.show', $offre->slug) }}"
               class="text-gray-900 font-extrabold text-base leading-snug hover:text-yellow-500 transition-colors">
                {{ $offre->titre }}
            </a>

            {{-- Entreprise --}}
            <p class="text-gray-500 text-sm font-semibold">{{ $offre->entreprise->nom_entreprise }}</p>

            {{-- Infos --}}
            <div class="flex flex-wrap gap-x-4 gap-y-1">
                <span class="flex items-center gap-1 text-xs text-gray-400">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                    {{ $offre->ville ?? 'Bénin' }}
                </span>
                @if($offre->type_contrat)
                <span class="flex items-center gap-1 text-xs text-gray-400">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    {{ $offre->type_contrat }}
                </span>
                @endif
                @if($offre->salaire_min)
                <span class="flex items-center gap-1 text-xs text-gray-400">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ number_format($offre->salaire_min, 0, ',', ' ') }} FCFA+
                </span>
                @endif
            </div>

            {{-- CTA --}}
            <div class="mt-auto pt-4 border-t border-gray-100">
                <a href="{{ route('candidat.candidatures.create', $offre->id) }}"
                   class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-gray-900 text-white font-extrabold text-sm rounded-xl hover:bg-yellow-400 hover:text-gray-900 transition-all">
                    Postuler maintenant
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-3 bg-white border border-gray-200 rounded-2xl py-20 text-center">
            <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
            </div>
            <p class="text-gray-900 font-extrabold text-lg mb-2">Aucune offre sauvegardée</p>
            <p class="text-gray-500 text-sm mb-6 max-w-xs mx-auto">
                Cliquez sur le ❤ d'une offre pour la retrouver ici plus facilement
            </p>
            <a href="{{ route('offres.index') }}"
               class="inline-flex items-center gap-2 px-6 py-3 bg-gray-900 text-white font-extrabold text-sm rounded-xl hover:bg-yellow-400 hover:text-gray-900 transition-all">
                Parcourir les offres
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($favoris->hasPages())
    <div class="mt-8">
        {{ $favoris->links() }}
    </div>
    @endif

</div>

@push('scripts')
<script>
function toggleFavori(offreId, btn) {
    fetch(`/candidat/favoris/toggle/${offreId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
        }
    })
    .then(r => r.json())
    .then(data => {
        if (!data.estFavori) {
            // Supprimer la card avec animation
            var card = btn.closest('.rounded-2xl');
            card.style.transition = 'opacity 0.3s, transform 0.3s';
            card.style.opacity = '0';
            card.style.transform = 'scale(0.95)';
            setTimeout(() => card.remove(), 300);
        }
    })
    .catch(err => console.error(err));
}
</script>
@endpush

@endsection