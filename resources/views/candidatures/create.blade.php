@extends('layouts.app')

@section('title', 'Postuler — ' . $offre->titre)

@section('content')

{{-- ═══════════════════════════════════════
     HEADER
═══════════════════════════════════════ --}}
<div class="bg-gray-950 border-b border-white/10">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 pb-6">

        {{-- Retour --}}
        <a href="{{ route('offres.show', $offre->slug) }}"
           class="inline-flex items-center gap-1.5 text-gray-500 hover:text-yellow-400 text-xs font-extrabold uppercase tracking-widest transition-colors mb-5">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
            </svg>
            Retour à l'offre
        </a>

        <div class="flex flex-col sm:flex-row sm:items-center gap-4">
            {{-- Initiale entreprise --}}
            <div class="w-14 h-14 rounded-2xl bg-yellow-400 flex items-center justify-center flex-shrink-0 text-gray-900 font-extrabold text-xl">
                {{ strtoupper(substr($offre->entreprise->nom_entreprise, 0, 1)) }}
            </div>
            <div>
                <p class="text-yellow-400 text-xs font-extrabold tracking-widest uppercase mb-0.5">Candidature</p>
                <h1 class="text-white font-extrabold text-xl sm:text-2xl leading-tight" style="letter-spacing:-0.02em">
                    {{ $offre->titre }}
                </h1>
                <p class="text-gray-400 text-sm mt-0.5">
                    {{ $offre->entreprise->nom_entreprise }}
                    @if($offre->ville) · {{ $offre->ville }} @endif
                </p>
            </div>
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════
     CONTENU
═══════════════════════════════════════ --}}
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- Alerte profil incomplet --}}
    @if(!auth()->user()->profilComplete())
    <div class="mb-8 rounded-2xl p-5 flex flex-col sm:flex-row items-start sm:items-center gap-4 border border-yellow-400/30"
         style="background:rgba(250,204,21,0.07)">
        <div class="w-10 h-10 rounded-xl bg-yellow-400 flex items-center justify-center flex-shrink-0">
            <svg class="w-5 h-5 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
        </div>
        <div class="flex-1 min-w-0">
            <p class="text-gray-900 font-extrabold text-sm">Profil incomplet — complétez-le pour maximiser vos chances</p>
            <p class="text-gray-600 text-xs mt-0.5">Ajoutez vos expériences, formations et compétences avant de postuler.</p>
        </div>
        <a href="{{ route('candidat.profil') }}"
           class="flex-shrink-0 px-4 py-2 bg-gray-900 text-white font-extrabold text-xs rounded-xl hover:bg-yellow-400 hover:text-gray-900 transition-all">
            Compléter mon profil →
        </a>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- ─── FORMULAIRE ─── --}}
        <div class="lg:col-span-2">
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">

                {{-- Titre section --}}
                <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-xl bg-yellow-400 flex items-center justify-center">
                        <svg class="w-4 h-4 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </div>
                    <h2 class="text-gray-900 font-extrabold text-base">Ma candidature</h2>
                </div>

                <form action="{{ route('candidat.candidatures.store', $offre->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="p-6 space-y-7">

                        {{-- Lettre de motivation --}}
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <label for="lettre_motivation"
                                       class="block text-xs font-extrabold text-gray-700 uppercase tracking-widest">
                                    Lettre de motivation *
                                </label>
                                <span id="char-count"
                                      class="text-xs font-bold px-2.5 py-1 rounded-lg bg-gray-100 text-gray-500 transition-colors">
                                    0 car.
                                </span>
                            </div>
                            <p class="text-gray-400 text-xs mb-3">Expliquez pourquoi vous êtes le candidat idéal pour ce poste (minimum 100 caractères).</p>
                            <textarea
                                id="lettre_motivation"
                                name="lettre_motivation"
                                rows="12"
                                required
                                placeholder="Madame, Monsieur,

Je me permets de vous adresser ma candidature pour le poste de {{ $offre->titre }} au sein de {{ $offre->entreprise->nom_entreprise }}..."
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-sm text-gray-900 leading-relaxed focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 outline-none transition-all resize-none @error('lettre_motivation') border-red-400 @enderror"
                            >{{ old('lettre_motivation') }}</textarea>
                            @error('lettre_motivation')
                            <p class="mt-1.5 text-red-500 text-xs font-semibold flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M12 4a8 8 0 100 16 8 8 0 000-16z"/></svg>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        {{-- Upload CV --}}
                        <div>
                            <label class="block text-xs font-extrabold text-gray-700 uppercase tracking-widest mb-2">
                                CV en PDF <span class="text-gray-400 font-semibold normal-case tracking-normal">(optionnel)</span>
                            </label>
                            <p class="text-gray-400 text-xs mb-3">Joignez votre CV au format PDF uniquement (max 2 Mo).</p>
                            <label for="cv"
                                   class="flex flex-col items-center justify-center gap-3 px-6 py-8 rounded-xl border-2 border-dashed border-gray-200 bg-gray-50 cursor-pointer hover:border-yellow-400 hover:bg-yellow-50/30 transition-all group">
                                <div class="w-10 h-10 rounded-xl bg-white border border-gray-200 flex items-center justify-center group-hover:border-yellow-300 transition-colors">
                                    <svg class="w-5 h-5 text-gray-400 group-hover:text-yellow-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                    </svg>
                                </div>
                                <div class="text-center">
                                    <p class="text-gray-700 font-bold text-sm" id="cv-label">Glissez votre CV ici ou <span class="text-yellow-500">cliquez pour parcourir</span></p>
                                    <p class="text-gray-400 text-xs mt-1">PDF uniquement · Max 2 Mo</p>
                                </div>
                                <input type="file" id="cv" name="cv" accept=".pdf" class="sr-only"
                                       onchange="updateCvLabel(this)">
                            </label>
                            @error('cv')
                            <p class="mt-1.5 text-red-500 text-xs font-semibold">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Récap infos partagées --}}
                        <div class="rounded-xl border border-gray-100 overflow-hidden"
                             style="background:rgba(3,7,18,0.02)">
                            <div class="px-5 py-3 border-b border-gray-100 bg-gray-50">
                                <p class="text-xs font-extrabold text-gray-600 uppercase tracking-widest">
                                    🔒 Informations transmises à l'entreprise
                                </p>
                            </div>
                            <div class="p-5 grid grid-cols-1 sm:grid-cols-2 gap-3">
                                @foreach([
                                    ['label'=>'Nom',          'val'=> auth()->user()->name],
                                    ['label'=>'Email',        'val'=> auth()->user()->email],
                                    ['label'=>'Téléphone',    'val'=> auth()->user()->telephone ?? '—'],
                                    ['label'=>'Localisation', 'val'=> auth()->user()->localisation ?? '—'],
                                ] as $info)
                                <div class="flex items-center gap-2.5">
                                    <span class="w-2 h-2 rounded-full bg-green-400 flex-shrink-0"></span>
                                    <span class="text-gray-500 text-xs">{{ $info['label'] }} :</span>
                                    <span class="text-gray-900 text-xs font-bold truncate">{{ $info['val'] }}</span>
                                </div>
                                @endforeach
                                @foreach(['Expériences professionnelles','Formations','Compétences','Lettre de motivation'] as $item)
                                <div class="flex items-center gap-2.5">
                                    <span class="w-2 h-2 rounded-full bg-green-400 flex-shrink-0"></span>
                                    <span class="text-gray-700 text-xs">{{ $item }}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Boutons --}}
                        <div class="flex flex-col sm:flex-row gap-3 pt-2">
                            <button type="submit"
                                    class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2.5 px-7 py-3.5 bg-gray-900 text-white font-extrabold text-sm rounded-xl hover:bg-yellow-400 hover:text-gray-900 transition-all"
                                    style="box-shadow:0 4px 20px rgba(0,0,0,0.12)">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                </svg>
                                Envoyer ma candidature
                            </button>
                            <a href="{{ route('offres.show', $offre->slug) }}"
                               class="flex-1 sm:flex-none inline-flex items-center justify-center px-6 py-3.5 border border-gray-200 text-gray-600 font-extrabold text-sm rounded-xl hover:bg-gray-50 transition-all">
                                Annuler
                            </a>
                        </div>

                    </div>
                </form>
            </div>
        </div>

        {{-- ─── SIDEBAR ─── --}}
        <div class="lg:col-span-1 space-y-5">

            {{-- Résumé de l'offre --}}
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden sticky top-4">
                <div class="px-5 py-4 border-b border-gray-100">
                    <p class="text-gray-900 font-extrabold text-sm">Détails de l'offre</p>
                </div>
                <div class="p-5 space-y-4">

                    {{-- Type badge --}}
                    <div>
                        @if($offre->type_offre === 'emploi')
                            <span class="px-2.5 py-1 bg-indigo-50 text-indigo-600 text-xs font-extrabold rounded-lg uppercase tracking-wide">Emploi</span>
                        @elseif($offre->type_offre === 'stage_professionnel')
                            <span class="px-2.5 py-1 bg-green-50 text-green-600 text-xs font-extrabold rounded-lg uppercase tracking-wide">Stage Pro</span>
                        @else
                            <span class="px-2.5 py-1 bg-orange-50 text-orange-500 text-xs font-extrabold rounded-lg uppercase tracking-wide">Stage Acad.</span>
                        @endif
                    </div>

                    {{-- Infos --}}
                    @foreach([
                        ['icon'=>'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4', 'label'=>'Entreprise', 'val'=>$offre->entreprise->nom_entreprise],
                        ['icon'=>'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z', 'label'=>'Localisation', 'val'=>$offre->ville ?? 'Bénin'],
                        ['icon'=>'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', 'label'=>'Contrat', 'val'=>$offre->type_offre === 'emploi' ? ($offre->type_contrat ?? 'CDI') : ucfirst(str_replace('_',' ',$offre->type_offre))],
                    ] as $detail)
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $detail['icon'] }}"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-400 text-xs">{{ $detail['label'] }}</p>
                            <p class="text-gray-900 text-sm font-bold">{{ $detail['val'] }}</p>
                        </div>
                    </div>
                    @endforeach

                    @if($offre->date_limite)
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-red-50 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-400 text-xs">Date limite</p>
                            <p class="text-red-500 text-sm font-extrabold">{{ $offre->date_limite->format('d/m/Y') }}</p>
                        </div>
                    </div>
                    @endif

                    @if($offre->salaire_min)
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-yellow-50 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-4 h-4 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-gray-400 text-xs">Rémunération</p>
                            <p class="text-gray-900 text-sm font-extrabold">
                                {{ number_format($offre->salaire_min, 0, ',', ' ') }}
                                @if($offre->salaire_max) – {{ number_format($offre->salaire_max, 0, ',', ' ') }} @endif
                                FCFA
                            </p>
                        </div>
                    </div>
                    @endif
                </div>

                {{-- Conseils --}}
                <div class="border-t border-gray-100 px-5 py-4 bg-gray-50/50">
                    <p class="text-xs font-extrabold text-gray-600 uppercase tracking-widest mb-3">💡 Conseils</p>
                    <ul class="space-y-2">
                        @foreach([
                            'Personnalisez votre lettre pour ce poste',
                            'Relisez attentivement avant d\'envoyer',
                            'Mettez en avant vos compétences clés',
                            'Soyez concis, précis et professionnel',
                            'Vérifiez que votre profil est à jour',
                        ] as $conseil)
                        <li class="flex items-start gap-2 text-xs text-gray-500">
                            <span class="w-1.5 h-1.5 rounded-full bg-yellow-400 flex-shrink-0 mt-1.5"></span>
                            {{ $conseil }}
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>

@push('scripts')
<script>
(function(){
    var textarea = document.getElementById('lettre_motivation');
    var counter  = document.getElementById('char-count');

    function updateCount(){
        var n = textarea.value.length;
        counter.textContent = n + ' car.';
        if(n >= 100){
            counter.className = 'text-xs font-bold px-2.5 py-1 rounded-lg bg-green-100 text-green-600 transition-colors';
        } else {
            counter.className = 'text-xs font-bold px-2.5 py-1 rounded-lg bg-orange-100 text-orange-500 transition-colors';
        }
    }

    textarea.addEventListener('input', updateCount);
    updateCount();
})();

function updateCvLabel(input){
    var label = document.getElementById('cv-label');
    if(input.files && input.files[0]){
        label.innerHTML = '✓ <span class="text-green-600 font-extrabold">' + input.files[0].name + '</span>';
    }
}
</script>
@endpush

@endsection