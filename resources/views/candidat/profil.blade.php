@extends('layouts.app')

@section('title', 'Mon profil')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- En-tête -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Mon profil</h1>
        <p class="text-gray-600">Gérez vos informations professionnelles</p>
    </div>

    <!-- Menu de navigation -->
    <div class="mb-8 border-b border-gray-200">
        <nav class="flex space-x-8">
            <a href="{{ route('candidat.dashboard') }}" class="pb-4 border-b-2 border-transparent text-sm font-medium text-gray-600 hover:text-gray-900 hover:border-gray-300">
                Tableau de bord
            </a>
            <a href="{{ route('candidat.profil') }}" class="pb-4 border-b-2 border-gray-900 text-sm font-medium text-gray-900">
                Mon profil
            </a>
            <a href="{{ route('candidat.candidatures') }}" class="pb-4 border-b-2 border-transparent text-sm font-medium text-gray-600 hover:text-gray-900 hover:border-gray-300">
                Mes candidatures
            </a>
            <a href="{{ route('candidat.favoris') }}" class="pb-4 border-b-2 border-transparent text-sm font-medium text-gray-600 hover:text-gray-900 hover:border-gray-300">
                Mes favoris
            </a>
        </nav>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white border border-gray-200 rounded p-6 sticky top-4">
                <div class="text-center mb-6">
                    <div class="w-24 h-24 bg-gray-200 rounded-full mx-auto mb-4 flex items-center justify-center">
                        <span class="text-3xl font-bold text-gray-600">
                            {{ substr($user->name, 0, 1) }}
                        </span>
                    </div>
                    <h2 class="text-xl font-bold text-gray-900 mb-1">{{ $user->name }}</h2>
                    <p class="text-sm text-gray-600">{{ $user->email }}</p>
                </div>

                <div class="border-t border-gray-200 pt-6">
                    <div class="space-y-3 text-sm">
                        <div>
                            <span class="text-gray-600">Téléphone:</span>
                            <span class="font-medium text-gray-900 block">{{ $user->telephone ?? 'Non renseigné' }}</span>
                        </div>
                        <div>
                            <span class="text-gray-600">Localisation:</span>
                            <span class="font-medium text-gray-900 block">{{ $user->localisation ?? 'Non renseignée' }}</span>
                        </div>
                        <div>
                            <span class="text-gray-600">Membre depuis:</span>
                            <span class="font-medium text-gray-900 block">{{ $user->created_at->format('d/m/Y') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Progression du profil -->
                <div class="border-t border-gray-200 pt-6 mt-6">
                    <div class="mb-2 flex justify-between text-sm">
                        <span class="text-gray-600">Profil complété</span>
                        <span class="font-medium text-gray-900">
                            @php
                                $completion = 0;
                                if($user->telephone) $completion += 20;
                                if($user->localisation) $completion += 20;
                                if($experiences->count() > 0) $completion += 20;
                                if($formations->count() > 0) $completion += 20;
                                if($competences->count() > 0) $completion += 20;
                            @endphp
                            {{ $completion }}%
                        </span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-gray-900 h-2 rounded-full" style="width: {{ $completion }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contenu principal -->
        <div class="lg:col-span-2 space-y-8">
            
            <!-- Informations personnelles -->
            <div class="bg-white border border-gray-200 rounded">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Informations personnelles</h3>
                </div>
                <div class="p-6">
                    <form action="{{ route('candidat.profil.update-infos') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-900 mb-2">
                                    Nom complet *
                                </label>
                                <input 
                                    type="text" 
                                    name="name" 
                                    value="{{ old('name', $user->name) }}"
                                    required
                                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-gray-900"
                                >
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-900 mb-2">
                                    Téléphone *
                                </label>
                                <input 
                                    type="text" 
                                    name="telephone" 
                                    value="{{ old('telephone', $user->telephone) }}"
                                    required
                                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-gray-900"
                                >
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-900 mb-2">
                                    Localisation *
                                </label>
                                <input 
                                    type="text" 
                                    name="localisation" 
                                    value="{{ old('localisation', $user->localisation) }}"
                                    placeholder="Ville, Quartier"
                                    required
                                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-gray-900"
                                >
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="px-4 py-2 bg-gray-900 text-white text-sm font-medium rounded hover:bg-gray-800">
                                Enregistrer les modifications
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Expériences professionnelles -->
            <div class="bg-white border border-gray-200 rounded">
                <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-900">Expériences professionnelles</h3>
                    <button onclick="toggleForm('experience-form')" class="text-sm text-gray-900 font-medium hover:underline">
                        + Ajouter
                    </button>
                </div>

                <!-- Formulaire d'ajout (caché par défaut) -->
                <div id="experience-form" class="hidden border-b border-gray-200 p-6 bg-gray-50">
                    <form action="{{ route('candidat.profil.add-experience') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-900 mb-2">Poste *</label>
                                <input type="text" name="poste" required class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-gray-900">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-900 mb-2">Entreprise *</label>
                                <input type="text" name="entreprise" required class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-gray-900">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-900 mb-2">Ville</label>
                                <input type="text" name="ville" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-gray-900">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-900 mb-2">Date de début *</label>
                                <input type="date" name="date_debut" required class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-gray-900">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-900 mb-2">Date de fin</label>
                                <input type="date" name="date_fin" id="date_fin" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-gray-900">
                            </div>
                            <div class="flex items-center">
                                <label class="flex items-center cursor-pointer">
                                    <input type="checkbox" name="en_cours" value="1" onchange="toggleDateFin(this)" class="rounded border-gray-300">
                                    <span class="ml-2 text-sm text-gray-900">Poste actuel</span>
                                </label>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-900 mb-2">Description</label>
                                <textarea name="description" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-gray-900"></textarea>
                            </div>
                        </div>
                        <div class="mt-4 flex gap-2">
                            <button type="submit" class="px-4 py-2 bg-gray-900 text-white text-sm font-medium rounded hover:bg-gray-800">
                                Ajouter
                            </button>
                            <button type="button" onclick="toggleForm('experience-form')" class="px-4 py-2 border border-gray-300 text-gray-900 text-sm font-medium rounded hover:bg-gray-50">
                                Annuler
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Liste des expériences -->
                <div class="divide-y divide-gray-200">
                    @forelse($experiences as $experience)
                        <div class="p-6">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-900 mb-1">{{ $experience->poste }}</h4>
                                    <p class="text-sm text-gray-600 mb-1">{{ $experience->entreprise }}</p>
                                    @if($experience->ville)
                                        <p class="text-sm text-gray-500 mb-2">{{ $experience->ville }}</p>
                                    @endif
                                    <p class="text-xs text-gray-500 mb-2">{{ $experience->periode() }}</p>
                                    @if($experience->description)
                                        <p class="text-sm text-gray-600 mt-2">{{ $experience->description }}</p>
                                    @endif
                                </div>
                                <form action="{{ route('candidat.profil.delete-experience', $experience->id) }}" method="POST" onsubmit="return confirm('Supprimer cette expérience ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm text-gray-500 hover:text-gray-900">Supprimer</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="p-6 text-center text-gray-600">
                            Aucune expérience ajoutée. Cliquez sur "Ajouter" pour commencer.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Formations -->
            <div class="bg-white border border-gray-200 rounded">
                <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-900">Formations</h3>
                    <button onclick="toggleForm('formation-form')" class="text-sm text-gray-900 font-medium hover:underline">
                        + Ajouter
                    </button>
                </div>

                <!-- Formulaire d'ajout -->
                <div id="formation-form" class="hidden border-b border-gray-200 p-6 bg-gray-50">
                    <form action="{{ route('candidat.profil.add-formation') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-900 mb-2">Diplôme *</label>
                                <input type="text" name="diplome" required class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-gray-900">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-900 mb-2">Établissement *</label>
                                <input type="text" name="etablissement" required class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-gray-900">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-900 mb-2">Domaine</label>
                                <input type="text" name="domaine" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-gray-900">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-900 mb-2">Année d'obtention *</label>
                                <input type="number" name="annee_obtention" min="1950" max="{{ date('Y') + 5 }}" required class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-gray-900">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-900 mb-2">Description</label>
                                <textarea name="description" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-gray-900"></textarea>
                            </div>
                        </div>
                        <div class="mt-4 flex gap-2">
                            <button type="submit" class="px-4 py-2 bg-gray-900 text-white text-sm font-medium rounded hover:bg-gray-800">
                                Ajouter
                            </button>
                            <button type="button" onclick="toggleForm('formation-form')" class="px-4 py-2 border border-gray-300 text-gray-900 text-sm font-medium rounded hover:bg-gray-50">
                                Annuler
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Liste des formations -->
                <div class="divide-y divide-gray-200">
                    @forelse($formations as $formation)
                        <div class="p-6">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-900 mb-1">{{ $formation->diplome }}</h4>
                                    <p class="text-sm text-gray-600 mb-1">{{ $formation->etablissement }}</p>
                                    @if($formation->domaine)
                                        <p class="text-sm text-gray-500 mb-2">{{ $formation->domaine }}</p>
                                    @endif
                                    <p class="text-xs text-gray-500 mb-2">{{ $formation->annee_obtention }}</p>
                                    @if($formation->description)
                                        <p class="text-sm text-gray-600 mt-2">{{ $formation->description }}</p>
                                    @endif
                                </div>
                                <form action="{{ route('candidat.profil.delete-formation', $formation->id) }}" method="POST" onsubmit="return confirm('Supprimer cette formation ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm text-gray-500 hover:text-gray-900">Supprimer</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="p-6 text-center text-gray-600">
                            Aucune formation ajoutée. Cliquez sur "Ajouter" pour commencer.
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Compétences -->
            <div class="bg-white border border-gray-200 rounded">
                <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-900">Compétences</h3>
                    <button onclick="toggleForm('competence-form')" class="text-sm text-gray-900 font-medium hover:underline">
                        + Ajouter
                    </button>
                </div>

                <!-- Formulaire d'ajout -->
                <div id="competence-form" class="hidden border-b border-gray-200 p-6 bg-gray-50">
                    <form action="{{ route('candidat.profil.add-competence') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-900 mb-2">Compétence *</label>
                                <select name="competence_id" required class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-gray-900">
                                    <option value="">Sélectionner une compétence</option>
                                    @foreach($toutesCompetences as $competence)
                                        <option value="{{ $competence->id }}">{{ $competence->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-900 mb-2">Niveau *</label>
                                <select name="niveau" required class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-gray-900">
                                    <option value="debutant">Débutant</option>
                                    <option value="intermediaire" selected>Intermédiaire</option>
                                    <option value="avance">Avancé</option>
                                    <option value="expert">Expert</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-4 flex gap-2">
                            <button type="submit" class="px-4 py-2 bg-gray-900 text-white text-sm font-medium rounded hover:bg-gray-800">
                                Ajouter
                            </button>
                            <button type="button" onclick="toggleForm('competence-form')" class="px-4 py-2 border border-gray-300 text-gray-900 text-sm font-medium rounded hover:bg-gray-50">
                                Annuler
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Liste des compétences -->
                <div class="p-6">
                    @forelse($competences as $competence)
                        <div class="inline-flex items-center gap-2 px-3 py-2 bg-gray-100 rounded mr-2 mb-2">
                            <span class="text-sm font-medium text-gray-900">{{ $competence->nom }}</span>
                            <span class="text-xs text-gray-600">({{ ucfirst($competence->pivot->niveau) }})</span>
                            <form action="{{ route('candidat.profil.delete-competence', $competence->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-500 hover:text-gray-900">×</button>
                            </form>
                        </div>
                    @empty
                        <div class="text-center text-gray-600">
                            Aucune compétence ajoutée. Cliquez sur "Ajouter" pour commencer.
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</div>

@push('scripts')
<script>
    function toggleForm(formId) {
        const form = document.getElementById(formId);
        form.classList.toggle('hidden');
    }

    function toggleDateFin(checkbox) {
        const dateFin = document.getElementById('date_fin');
        if (checkbox.checked) {
            dateFin.value = '';
            dateFin.disabled = true;
        } else {
            dateFin.disabled = false;
        }
    }
</script>
@endpush
@endsection