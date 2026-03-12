@extends('layouts.app')

@section('title', 'Candidature de ' . $candidature->candidat->name)

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-sm text-gray-500 mb-6">
            <a href="{{ route('entreprise.dashboard') }}" class="hover:text-blue-600 transition">Tableau de bord</a>
            <span>/</span>
            <a href="{{ route('entreprise.candidatures.index') }}" class="hover:text-blue-600 transition">Candidatures</a>
            <span>/</span>
            <span class="text-gray-800 font-medium">{{ $candidature->candidat->name }}</span>
        </nav>

        {{-- Messages flash --}}
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700 flex items-center gap-3">
                <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-red-700 flex items-center gap-3">
                <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Colonne principale --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- En-tête candidat --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <div class="flex items-start gap-5">
                        {{-- Avatar --}}
                        <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center text-white font-bold text-2xl flex-shrink-0">
                            {{ strtoupper(substr($candidature->candidat->name, 0, 1)) }}
                        </div>
                        <div class="flex-1">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <h1 class="text-xl font-bold text-gray-900">{{ $candidature->candidat->name }}</h1>
                                    <p class="text-gray-500 text-sm mt-0.5">{{ $candidature->candidat->email }}</p>
                                    @if($candidature->candidat->telephone)
                                        <p class="text-gray-500 text-sm">{{ $candidature->candidat->telephone }}</p>
                                    @endif
                                </div>
                                {{-- Badge statut --}}
                                @php
                                    $statutColors = [
                                        'en_attente' => 'bg-yellow-100 text-yellow-700',
                                        'vue'        => 'bg-blue-100 text-blue-700',
                                        'retenue'    => 'bg-green-100 text-green-700',
                                        'rejetee'    => 'bg-red-100 text-red-700',
                                    ];
                                    $statutLabels = [
                                        'en_attente' => 'En attente',
                                        'vue'        => 'Vue',
                                        'retenue'    => 'Retenue',
                                        'rejetee'    => 'Rejetée',
                                    ];
                                @endphp
                                <span class="px-3 py-1 text-sm font-semibold rounded-full {{ $statutColors[$candidature->statut] ?? 'bg-gray-100 text-gray-700' }}">
                                    {{ $statutLabels[$candidature->statut] ?? ucfirst($candidature->statut) }}
                                </span>
                            </div>

                            <div class="flex flex-wrap gap-3 mt-3 text-sm text-gray-500">
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    Postulé pour : <span class="font-medium text-gray-800">{{ $candidature->offre->titre }}</span>
                                </span>
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    {{ $candidature->created_at->format('d/m/Y à H:i') }}
                                </span>
                                @if($candidature->vue_le)
                                    <span class="flex items-center gap-1.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        Vue le {{ $candidature->vue_le->format('d/m/Y') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Lettre de motivation --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-base font-semibold text-gray-900 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Lettre de motivation
                    </h2>
                    <div class="bg-gray-50 rounded-xl p-5 text-gray-700 text-sm leading-relaxed border border-gray-100">
                        {!! nl2br(e($candidature->lettre_motivation)) !!}
                    </div>
                </div>

                {{-- Expériences professionnelles --}}
                @if($candidature->candidat->experiences && $candidature->candidat->experiences->count() > 0)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-base font-semibold text-gray-900 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Expériences professionnelles
                        <span class="ml-1 px-2 py-0.5 bg-purple-100 text-purple-700 text-xs font-bold rounded-full">
                            {{ $candidature->candidat->experiences->count() }}
                        </span>
                    </h2>
                    <div class="space-y-4">
                        @foreach($candidature->candidat->experiences->sortByDesc('date_debut') as $exp)
                        <div class="relative pl-5 border-l-2 border-purple-200">
                            <div class="absolute -left-1.5 top-1.5 w-3 h-3 rounded-full bg-purple-400"></div>
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <h3 class="font-semibold text-gray-900 text-sm">{{ $exp->poste }}</h3>
                                    <p class="text-sm text-gray-600">{{ $exp->entreprise }}</p>
                                    @if($exp->description)
                                        <p class="text-xs text-gray-500 mt-1">{{ $exp->description }}</p>
                                    @endif
                                </div>
                                <div class="text-right flex-shrink-0">
                                    <p class="text-xs text-gray-500 whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($exp->date_debut)->format('m/Y') }}
                                        —
                                        {{ $exp->date_fin ? \Carbon\Carbon::parse($exp->date_fin)->format('m/Y') : 'Présent' }}
                                    </p>
                                    @if($exp->ville)
                                        <p class="text-xs text-gray-400">{{ $exp->ville }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Formations --}}
                @if($candidature->candidat->formations && $candidature->candidat->formations->count() > 0)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-base font-semibold text-gray-900 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M12 14l9-5-9-5-9 5 9 5z"/>
                            <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                        </svg>
                        Formations académiques
                        <span class="ml-1 px-2 py-0.5 bg-green-100 text-green-700 text-xs font-bold rounded-full">
                            {{ $candidature->candidat->formations->count() }}
                        </span>
                    </h2>
                    <div class="space-y-4">
                        @foreach($candidature->candidat->formations->sortByDesc('annee_obtention') as $formation)
                        <div class="relative pl-5 border-l-2 border-green-200">
                            <div class="absolute -left-1.5 top-1.5 w-3 h-3 rounded-full bg-green-400"></div>
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <h3 class="font-semibold text-gray-900 text-sm">{{ $formation->diplome }}</h3>
                                    <p class="text-sm text-gray-600">{{ $formation->etablissement }}</p>
                                    @if($formation->domaine)
                                        <p class="text-xs text-gray-500 mt-0.5">{{ $formation->domaine }}</p>
                                    @endif
                                </div>
                                @if($formation->annee_obtention)
                                    <span class="flex-shrink-0 px-2.5 py-1 bg-green-50 text-green-700 text-xs font-medium rounded-full border border-green-100">
                                        {{ $formation->annee_obtention }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Compétences --}}
                @if($candidature->candidat->competences && $candidature->candidat->competences->count() > 0)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-base font-semibold text-gray-900 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                        Compétences
                    </h2>
                    <div class="flex flex-wrap gap-2">
                        @foreach($candidature->candidat->competences as $competence)
                            @php
                                $niveauColors = [
                                    'debutant'   => 'bg-gray-100 text-gray-600 border-gray-200',
                                    'intermediaire' => 'bg-blue-50 text-blue-700 border-blue-200',
                                    'avance'     => 'bg-purple-50 text-purple-700 border-purple-200',
                                    'expert'     => 'bg-orange-50 text-orange-700 border-orange-200',
                                ];
                                $niveauLabels = [
                                    'debutant'      => 'Débutant',
                                    'intermediaire' => 'Intermédiaire',
                                    'avance'        => 'Avancé',
                                    'expert'        => 'Expert',
                                ];
                                $niveau = $competence->pivot->niveau ?? 'debutant';
                            @endphp
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg border text-sm font-medium {{ $niveauColors[$niveau] ?? 'bg-gray-100 text-gray-600 border-gray-200' }}">
                                {{ $competence->nom }}
                                <span class="text-xs opacity-70">· {{ $niveauLabels[$niveau] ?? ucfirst($niveau) }}</span>
                            </span>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Notes du recruteur --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-base font-semibold text-gray-900 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Notes du recruteur
                    </h2>
                    <form action="{{ route('entreprise.candidatures.change-status', $candidature->id) }}" method="POST">
                        @csrf @method('PATCH')
                        <input type="hidden" name="statut" value="{{ $candidature->statut }}">
                        <textarea
                            name="notes_recruteur"
                            rows="4"
                            placeholder="Ajoutez vos notes internes sur ce candidat..."
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                        >{{ $candidature->notes_recruteur }}</textarea>
                        <button type="submit"
                                class="mt-3 px-4 py-2 bg-gray-900 text-white text-sm font-medium rounded-xl hover:bg-gray-700 transition">
                            Enregistrer les notes
                        </button>
                    </form>
                </div>

            </div>

            {{-- Colonne latérale --}}
            <div class="space-y-6">

                {{-- CV --}}
                @if($candidature->cv_path)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-base font-semibold text-gray-900 mb-4">Curriculum Vitae</h2>
                    <div class="flex items-center gap-3 p-4 bg-red-50 rounded-xl border border-red-100">
                        <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">CV_{{ $candidature->candidat->name }}</p>
                            <p class="text-xs text-gray-400">Fichier PDF</p>
                        </div>
                    </div>
                    <a href="{{ route('entreprise.candidatures.download-cv', $candidature->id) }}"
                       class="mt-3 w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-xl hover:bg-blue-700 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        Télécharger le CV
                    </a>
                </div>
                @else
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-base font-semibold text-gray-900 mb-3">Curriculum Vitae</h2>
                    <p class="text-sm text-gray-400 text-center py-4">Aucun CV joint à cette candidature.</p>
                </div>
                @endif

                {{-- Changer le statut --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-base font-semibold text-gray-900 mb-4">Changer le statut</h2>
                    <div class="space-y-2">
                        @foreach([
                            ['statut' => 'retenue',    'label' => '✅ Retenir le candidat',   'class' => 'bg-green-50 text-green-700 border-green-200 hover:bg-green-100'],
                            ['statut' => 'rejetee',    'label' => '❌ Rejeter la candidature', 'class' => 'bg-red-50 text-red-700 border-red-200 hover:bg-red-100'],
                            ['statut' => 'en_attente', 'label' => '⏳ Remettre en attente',   'class' => 'bg-yellow-50 text-yellow-700 border-yellow-200 hover:bg-yellow-100'],
                        ] as $action)
                            @if($candidature->statut !== $action['statut'])
                            <form action="{{ route('entreprise.candidatures.change-status', $candidature->id) }}" method="POST">
                                @csrf @method('PATCH')
                                <input type="hidden" name="statut" value="{{ $action['statut'] }}">
                                <button type="submit"
                                        class="w-full px-4 py-2.5 rounded-xl border text-sm font-medium transition {{ $action['class'] }}">
                                    {{ $action['label'] }}
                                </button>
                            </form>
                            @endif
                        @endforeach
                    </div>
                </div>

                {{-- Infos sur l'offre --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-base font-semibold text-gray-900 mb-4">Offre concernée</h2>
                    <div class="space-y-2 text-sm">
                        <p class="font-medium text-gray-900">{{ $candidature->offre->titre }}</p>
                        @if($candidature->offre->ville)
                            <p class="text-gray-500 flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                </svg>
                                {{ $candidature->offre->ville }}
                            </p>
                        @endif
                        <p class="text-gray-400 text-xs">Postulé le {{ $candidature->created_at->format('d/m/Y') }}</p>
                    </div>
                    <a href="{{ route('entreprise.offres.show', $candidature->offre->id) }}"
                       class="mt-4 block text-center px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-xl hover:bg-gray-200 transition">
                        Voir l'offre →
                    </a>
                </div>

                {{-- Navigation --}}
                <div class="flex gap-3">
                    <a href="{{ route('entreprise.candidatures.index') }}"
                       class="flex-1 flex items-center justify-center gap-2 px-4 py-2.5 bg-white text-gray-700 text-sm font-medium rounded-xl border border-gray-200 hover:bg-gray-50 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Retour
                    </a>
                    <a href="{{ route('entreprise.candidatures.offre', $candidature->offre->id) }}"
                       class="flex-1 flex items-center justify-center gap-2 px-4 py-2.5 bg-white text-gray-700 text-sm font-medium rounded-xl border border-gray-200 hover:bg-gray-50 transition">
                        Autres candidatures
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection