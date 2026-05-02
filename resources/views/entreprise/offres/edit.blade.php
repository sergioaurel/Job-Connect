@extends('layouts.app')

@section('title', 'Modifier l\'offre de stage — Espace Entreprise')

@section('content')

<div class="bg-gray-950 border-b border-white/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <a href="{{ route('entreprise.offres.index') }}"
           class="inline-flex items-center gap-2 text-gray-400 hover:text-yellow-400 text-xs font-bold mb-4 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
            </svg>
            Retour à mes offres
        </a>
        <p class="text-yellow-400 text-xs font-extrabold tracking-widest uppercase mb-1">Espace Entreprise</p>
        <h1 class="text-white font-extrabold text-2xl" style="letter-spacing:-0.02em">Modifier l'offre de stage</h1>
        <p class="text-gray-400 text-sm mt-1">{{ $offre->titre }}</p>
    </div>
</div>

<div class="bg-gray-50 min-h-screen">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- ✦ Bannière de blocage — affichée uniquement si des candidatures existent ── --}}
        @if($offre->candidatures_count > 0)
        <div class="mb-6 flex items-start gap-4 px-5 py-5 bg-orange-50 border border-orange-200 rounded-2xl">
            <div class="w-10 h-10 rounded-xl bg-orange-100 flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <div>
                <p class="text-orange-700 font-extrabold text-sm mb-1">Modification des termes impossible</p>
                <p class="text-orange-600 text-sm leading-relaxed">
                    <span class="font-bold">{{ $offre->candidatures_count }} candidat(s)</span> ont déjà postulé sur cette offre.
                    Les termes (titre, description, missions, gratification…) ne peuvent plus être modifiés pour protéger les candidats qui ont postulé sur la base de ces informations.
                </p>
                <p class="text-orange-500 text-xs mt-2 font-semibold">
                    Vous pouvez uniquement changer le statut de l'offre (fermer ou marquer comme pourvue) depuis la page de l'offre.
                </p>
            </div>
        </div>
        @endif

        <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden {{ $offre->candidatures_count > 0 ? 'opacity-60 pointer-events-none select-none' : '' }}">
            <form action="{{ route('entreprise.offres.update', $offre->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- ── TYPE DE STAGE ── --}}
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                    <p class="text-xs font-extrabold text-gray-500 uppercase tracking-widest">Type de stage</p>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach([
                            ['value'=>'stage_professionnel','label'=>'Stage professionnel','desc'=>'Stage en entreprise avec gratification possible','icon'=>'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z'],
                            ['value'=>'stage_academique',  'label'=>'Stage académique',  'desc'=>'Stage de fin d\'études ou de formation académique','icon'=>'M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222'],
                        ] as $type)
                        <label class="relative cursor-pointer">
                            <input type="radio" name="type_offre" value="{{ $type['value'] }}"
                                   class="peer sr-only"
                                   {{ old('type_offre', $offre->type_offre) == $type['value'] ? 'checked' : '' }}
                                   required>
                            <div class="border-2 border-gray-200 rounded-xl p-5 peer-checked:border-yellow-400 peer-checked:bg-yellow-50 hover:border-gray-300 transition-all">
                                <svg class="w-6 h-6 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $type['icon'] }}"/>
                                </svg>
                                <p class="text-sm font-extrabold text-gray-900 mb-1">{{ $type['label'] }}</p>
                                <p class="text-xs text-gray-500">{{ $type['desc'] }}</p>
                            </div>
                        </label>
                        @endforeach
                    </div>
                    @error('type_offre') <p class="mt-2 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                {{-- ── INFORMATIONS GÉNÉRALES ── --}}
                <div class="px-6 py-4 border-y border-gray-100 bg-gray-50/50">
                    <p class="text-xs font-extrabold text-gray-500 uppercase tracking-widest">Informations générales</p>
                </div>
                <div class="p-6 space-y-5">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="titre" class="block text-sm font-semibold text-gray-700 mb-2">Titre du stage <span class="text-red-400">*</span></label>
                            <input type="text" id="titre" name="titre" value="{{ old('titre', $offre->titre) }}" required
                                   class="w-full px-4 py-3 text-sm rounded-xl border bg-gray-50 focus:outline-none focus:bg-white focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 transition-all @error('titre') border-red-400 bg-red-50 @else border-gray-200 @enderror">
                            @error('titre') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="categorie_id" class="block text-sm font-semibold text-gray-700 mb-2">Catégorie <span class="text-red-400">*</span></label>
                            <select id="categorie_id" name="categorie_id" required
                                    class="w-full px-4 py-3 text-sm rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:bg-white focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 transition-all appearance-none">
                                <option value="">Sélectionner une catégorie</option>
                                @foreach($categories as $categorie)
                                <option value="{{ $categorie->id }}" {{ old('categorie_id', $offre->categorie_id) == $categorie->id ? 'selected' : '' }}>{{ $categorie->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="ville" class="block text-sm font-semibold text-gray-700 mb-2">Ville <span class="text-red-400">*</span></label>
                            <input type="text" id="ville" name="ville" value="{{ old('ville', $offre->ville) }}" required
                                   class="w-full px-4 py-3 text-sm rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:bg-white focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 transition-all">
                        </div>
                        <div>
                            <label for="nombre_postes" class="block text-sm font-semibold text-gray-700 mb-2">Nombre de postes <span class="text-red-400">*</span></label>
                            <input type="number" id="nombre_postes" name="nombre_postes" value="{{ old('nombre_postes', $offre->nombre_postes ?? 1) }}" min="1" required
                                   class="w-full px-4 py-3 text-sm rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:bg-white focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 transition-all">
                        </div>
                    </div>
                    <div>
                        <label for="date_limite" class="block text-sm font-semibold text-gray-700 mb-2">Date limite de candidature</label>
                        <input type="date" id="date_limite" name="date_limite"
                               value="{{ old('date_limite', $offre->date_limite ? $offre->date_limite->format('Y-m-d') : '') }}"
                               min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                               class="w-full px-4 py-3 text-sm rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:bg-white focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 transition-all">
                    </div>
                </div>

                {{-- ── CONTENU ── --}}
                <div class="px-6 py-4 border-y border-gray-100 bg-gray-50/50">
                    <p class="text-xs font-extrabold text-gray-500 uppercase tracking-widest">Contenu de l'offre</p>
                </div>
                <div class="p-6 space-y-5">
                    @foreach([
                        ['id'=>'description',    'label'=>'Description du stage', 'val'=>$offre->description],
                        ['id'=>'missions',        'label'=>'Missions principales', 'val'=>$offre->missions],
                        ['id'=>'profil_recherche','label'=>'Profil recherché',     'val'=>$offre->profil_recherche],
                    ] as $field)
                    <div>
                        <label for="{{ $field['id'] }}" class="block text-sm font-semibold text-gray-700 mb-2">{{ $field['label'] }} <span class="text-red-400">*</span></label>
                        <textarea id="{{ $field['id'] }}" name="{{ $field['id'] }}" rows="5" required
                                  class="w-full px-4 py-3 text-sm rounded-xl border bg-gray-50 focus:outline-none focus:bg-white focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 transition-all resize-none @error($field['id']) border-red-400 bg-red-50 @else border-gray-200 @enderror">{{ old($field['id'], $field['val']) }}</textarea>
                        @error($field['id']) <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    @endforeach
                    <div>
                        <label for="competences_requises" class="block text-sm font-semibold text-gray-700 mb-2">Compétences requises</label>
                        <input type="text" id="competences_requises" name="competences_requises"
                               value="{{ old('competences_requises', $offre->competences_requises) }}"
                               placeholder="Ex: PHP, Laravel, JavaScript"
                               class="w-full px-4 py-3 text-sm rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:bg-white focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 transition-all">
                        <p class="text-xs text-gray-400 mt-1">Séparez par des virgules</p>
                    </div>
                </div>

                {{-- ── EXIGENCES ── --}}
                <div class="px-6 py-4 border-y border-gray-100 bg-gray-50/50">
                    <p class="text-xs font-extrabold text-gray-500 uppercase tracking-widest">Exigences</p>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="niveau_etude" class="block text-sm font-semibold text-gray-700 mb-2">Niveau d'études <span class="text-red-400">*</span></label>
                            <input type="text" id="niveau_etude" name="niveau_etude"
                                   value="{{ old('niveau_etude', $offre->niveau_etude) }}" required
                                   placeholder="Ex: Bac+2, Licence, Master"
                                   class="w-full px-4 py-3 text-sm rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:bg-white focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 transition-all">
                        </div>
                        <div>
                            <label for="annees_experience" class="block text-sm font-semibold text-gray-700 mb-2">Années d'expérience</label>
                            <input type="number" id="annees_experience" name="annees_experience"
                                   value="{{ old('annees_experience', $offre->annees_experience ?? 0) }}" min="0"
                                   class="w-full px-4 py-3 text-sm rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:bg-white focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 transition-all">
                        </div>
                    </div>
                </div>

                {{-- ── GRATIFICATION ── --}}
                <div class="px-6 py-4 border-y border-gray-100 bg-gray-50/50">
                    <p class="text-xs font-extrabold text-gray-500 uppercase tracking-widest">Gratification</p>
                </div>
                <div class="p-6 space-y-4">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <div class="relative">
                            <input type="checkbox" id="salaire_a_negocier" name="salaire_a_negocier" value="1"
                                   {{ old('salaire_a_negocier', $offre->salaire_a_negocier ?? false) ? 'checked' : '' }}
                                   onchange="toggleSalaire(this)" class="sr-only peer">
                            <div class="w-10 h-6 bg-gray-200 rounded-full peer-checked:bg-gray-900 transition-colors"></div>
                            <div class="absolute top-0.5 left-0.5 w-5 h-5 bg-white rounded-full shadow transition-transform peer-checked:translate-x-4"></div>
                        </div>
                        <span class="text-sm font-semibold text-gray-700">Non rémunéré / à définir</span>
                    </label>
                    <div id="salaire_fields" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="salaire_min" class="block text-sm font-semibold text-gray-700 mb-2">Gratification minimum (FCFA)</label>
                            <input type="number" id="salaire_min" name="salaire_min" value="{{ old('salaire_min', $offre->salaire_min) }}"
                                   class="w-full px-4 py-3 text-sm rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:bg-white focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 transition-all">
                        </div>
                        <div>
                            <label for="salaire_max" class="block text-sm font-semibold text-gray-700 mb-2">Gratification maximum (FCFA)</label>
                            <input type="number" id="salaire_max" name="salaire_max" value="{{ old('salaire_max', $offre->salaire_max) }}"
                                   class="w-full px-4 py-3 text-sm rounded-xl border border-gray-200 bg-gray-50 focus:outline-none focus:bg-white focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 transition-all">
                        </div>
                    </div>
                </div>

                {{-- ── BOUTONS ── --}}
                <div class="px-6 py-5 bg-gray-50/50 border-t border-gray-100 flex flex-col sm:flex-row gap-3">
                    <button type="submit"
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-3 bg-gray-900 text-white font-extrabold text-sm rounded-xl hover:bg-yellow-400 hover:text-gray-900 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        Enregistrer les modifications
                    </button>
                    <a href="{{ route('entreprise.offres.show', $offre->id) }}"
                       class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 border border-gray-200 text-gray-700 font-bold text-sm rounded-xl hover:border-gray-400 transition-all">
                        Annuler
                    </a>
                </div>

            </form>
        </div>

        {{-- Lien vers la gestion du statut si offre bloquée --}}
        @if($offre->candidatures_count > 0)
        <div class="mt-5 text-center">
            <a href="{{ route('entreprise.offres.show', $offre->id) }}"
               class="inline-flex items-center gap-2 px-6 py-3 bg-gray-900 text-white font-extrabold text-sm rounded-xl hover:bg-yellow-400 hover:text-gray-900 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Gérer le statut de l'offre
            </a>
        </div>
        @endif

    </div>
</div>

@push('scripts')
<script>
function toggleSalaire(checkbox) {
    const fields = document.getElementById('salaire_fields');
    fields.style.display = checkbox.checked ? 'none' : 'grid';
    if (checkbox.checked) {
        document.getElementById('salaire_min').value = '';
        document.getElementById('salaire_max').value = '';
    }
}
const cb = document.getElementById('salaire_a_negocier');
if (cb && cb.checked) toggleSalaire(cb);
</script>
@endpush

@endsection