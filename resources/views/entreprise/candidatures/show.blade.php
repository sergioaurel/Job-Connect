@extends('layouts.app')

@section('title', 'Candidature de ' . $candidature->candidat->name)

@section('content')

{{-- ═══════════════════════════════════════
     HEADER SOMBRE
═══════════════════════════════════════ --}}
<div class="bg-gray-950 border-b border-white/10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 pb-6">

        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-xs text-gray-500 mb-5">
            <a href="{{ route('entreprise.dashboard') }}" class="hover:text-yellow-400 transition font-semibold">Tableau de bord</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('entreprise.candidatures.index') }}" class="hover:text-yellow-400 transition font-semibold">Candidatures</a>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-gray-400">{{ $candidature->candidat->name }}</span>
        </nav>

        {{-- Identité candidat --}}
        <div class="flex items-start gap-5">
            <div class="w-16 h-16 rounded-2xl bg-yellow-400 flex items-center justify-center text-gray-900 font-extrabold text-2xl flex-shrink-0">
                {{ strtoupper(substr($candidature->candidat->name, 0, 1)) }}
            </div>
            <div class="flex-1 min-w-0">
                <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-3">
                    <div>
                        <h1 class="text-white font-extrabold text-xl sm:text-2xl" style="letter-spacing:-0.02em">
                            {{ $candidature->candidat->name }}
                        </h1>
                        <p class="text-gray-400 text-sm mt-0.5">{{ $candidature->candidat->email }}</p>
                        @if($candidature->candidat->telephone)
                        <p class="text-gray-400 text-sm">{{ $candidature->candidat->telephone }}</p>
                        @endif
                    </div>
                    {{-- Badge statut --}}
                    @php
                    $statutCfg = [
                        'en_attente' => ['bg' => 'bg-orange-500/15', 'text' => 'text-orange-400', 'border' => 'border-orange-500/20', 'label' => 'En attente'],
                        'vue'        => ['bg' => 'bg-blue-500/15',   'text' => 'text-blue-400',   'border' => 'border-blue-500/20',   'label' => 'Vue'],
                        'retenue'    => ['bg' => 'bg-green-500/15',  'text' => 'text-green-400',  'border' => 'border-green-500/20',  'label' => 'Retenue'],
                        'rejetee'    => ['bg' => 'bg-red-500/15',    'text' => 'text-red-400',    'border' => 'border-red-500/20',    'label' => 'Rejetée'],
                    ];
                    $cfg = $statutCfg[$candidature->statut] ?? ['bg'=>'bg-white/10','text'=>'text-gray-300','border'=>'border-white/10','label'=>ucfirst($candidature->statut)];
                    @endphp
                    <span class="self-start px-3 py-1.5 text-xs font-extrabold rounded-xl border whitespace-nowrap {{ $cfg['bg'] }} {{ $cfg['text'] }} {{ $cfg['border'] }}">
                        {{ $cfg['label'] }}
                    </span>
                </div>

                {{-- Méta --}}
                <div class="flex flex-wrap gap-4 mt-3 text-xs text-gray-500 font-semibold">
                    <span class="flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        Postulé pour : <span class="text-gray-300 ml-0.5">{{ $candidature->offre->titre }}</span>
                    </span>
                    <span class="flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        {{ $candidature->created_at->format('d/m/Y à H:i') }}
                    </span>
                    @if($candidature->vue_le)
                    <span class="flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        Vue le {{ $candidature->vue_le->format('d/m/Y') }}
                    </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════
     CONTENU
═══════════════════════════════════════ --}}
<div class="bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- Flash messages --}}
        @if(session('success'))
        <div class="mb-6 flex items-center gap-3 px-5 py-3.5 bg-green-50 border border-green-200 rounded-2xl text-green-700 text-sm font-semibold">
            <svg class="w-5 h-5 flex-shrink-0 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="mb-6 flex items-center gap-3 px-5 py-3.5 bg-red-50 border border-red-200 rounded-2xl text-red-700 text-sm font-semibold">
            <svg class="w-5 h-5 flex-shrink-0 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            {{ session('error') }}
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- ── COLONNE PRINCIPALE ── --}}
            <div class="lg:col-span-2 space-y-5">

                {{-- Lettre de motivation --}}
                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl bg-yellow-100 flex items-center justify-center">
                            <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <h2 class="text-gray-900 font-extrabold text-base">Lettre de motivation</h2>
                    </div>
                    <div class="p-6">
                        <div class="bg-gray-50 border border-gray-100 rounded-xl p-5 text-gray-700 text-sm leading-relaxed">
                            {!! nl2br(e($candidature->lettre_motivation)) !!}
                        </div>
                    </div>
                </div>

                {{-- Expériences professionnelles --}}
                @if($candidature->candidat->experiences && $candidature->candidat->experiences->count() > 0)
                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl bg-indigo-100 flex items-center justify-center">
                            <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <h2 class="text-gray-900 font-extrabold text-base">
                            Expériences professionnelles
                            <span class="ml-2 px-2 py-0.5 bg-indigo-50 text-indigo-600 text-xs font-extrabold rounded-lg">
                                {{ $candidature->candidat->experiences->count() }}
                            </span>
                        </h2>
                    </div>
                    <div class="p-6 space-y-5">
                        @foreach($candidature->candidat->experiences->sortByDesc('date_debut') as $exp)
                        <div class="relative pl-5 border-l-2 border-indigo-100">
                            <div class="absolute -left-1.5 top-1.5 w-3 h-3 rounded-full bg-indigo-400"></div>
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <p class="text-gray-900 font-extrabold text-sm">{{ $exp->poste }}</p>
                                    <p class="text-gray-600 text-sm">{{ $exp->entreprise }}</p>
                                    @if($exp->description)
                                    <p class="text-gray-400 text-xs mt-1 leading-relaxed">{{ $exp->description }}</p>
                                    @endif
                                </div>
                                <div class="text-right flex-shrink-0">
                                    <p class="text-xs text-gray-400 whitespace-nowrap">
                                        {{ \Carbon\Carbon::parse($exp->date_debut)->format('m/Y') }}
                                        —
                                        {{ $exp->date_fin ? \Carbon\Carbon::parse($exp->date_fin)->format('m/Y') : 'Présent' }}
                                    </p>
                                    @if($exp->ville)
                                    <p class="text-xs text-gray-400 mt-0.5">{{ $exp->ville }}</p>
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
                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl bg-green-100 flex items-center justify-center">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                        </div>
                        <h2 class="text-gray-900 font-extrabold text-base">
                            Formations académiques
                            <span class="ml-2 px-2 py-0.5 bg-green-50 text-green-600 text-xs font-extrabold rounded-lg">
                                {{ $candidature->candidat->formations->count() }}
                            </span>
                        </h2>
                    </div>
                    <div class="p-6 space-y-5">
                        @foreach($candidature->candidat->formations->sortByDesc('annee_obtention') as $formation)
                        <div class="relative pl-5 border-l-2 border-green-100">
                            <div class="absolute -left-1.5 top-1.5 w-3 h-3 rounded-full bg-green-400"></div>
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <p class="text-gray-900 font-extrabold text-sm">{{ $formation->diplome }}</p>
                                    <p class="text-gray-600 text-sm">{{ $formation->etablissement }}</p>
                                    @if($formation->domaine)
                                    <p class="text-gray-400 text-xs mt-0.5">{{ $formation->domaine }}</p>
                                    @endif
                                </div>
                                @if($formation->annee_obtention)
                                <span class="flex-shrink-0 px-2.5 py-1 bg-green-50 text-green-700 text-xs font-extrabold rounded-lg border border-green-100">
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
                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl bg-orange-100 flex items-center justify-center">
                            <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        <h2 class="text-gray-900 font-extrabold text-base">Compétences</h2>
                    </div>
                    <div class="p-6">
                        <div class="flex flex-wrap gap-2">
                            @foreach($candidature->candidat->competences as $competence)
                            @php
                            $nc = [
                                'debutant'      => ['bg'=>'bg-gray-100',  'text'=>'text-gray-600',  'dot'=>'bg-gray-400'],
                                'intermediaire' => ['bg'=>'bg-blue-50',   'text'=>'text-blue-600',  'dot'=>'bg-blue-400'],
                                'avance'        => ['bg'=>'bg-indigo-50', 'text'=>'text-indigo-600','dot'=>'bg-indigo-400'],
                                'expert'        => ['bg'=>'bg-yellow-50', 'text'=>'text-yellow-600','dot'=>'bg-yellow-400'],
                            ][$competence->pivot->niveau ?? 'debutant'] ?? ['bg'=>'bg-gray-100','text'=>'text-gray-600','dot'=>'bg-gray-400'];
                            $niveauLabels = ['debutant'=>'Débutant','intermediaire'=>'Intermédiaire','avance'=>'Avancé','expert'=>'Expert'];
                            $niveau = $competence->pivot->niveau ?? 'debutant';
                            @endphp
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-extrabold {{ $nc['bg'] }} {{ $nc['text'] }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $nc['dot'] }} inline-block"></span>
                                {{ $competence->nom }}
                                <span class="opacity-60">· {{ $niveauLabels[$niveau] ?? ucfirst($niveau) }}</span>
                            </span>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                {{-- Notes du recruteur --}}
                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl bg-gray-900 flex items-center justify-center">
                            <svg class="w-4 h-4 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </div>
                        <div>
                            <h2 class="text-gray-900 font-extrabold text-base">Notes du recruteur</h2>
                            <p class="text-gray-400 text-xs mt-0.5">Visibles uniquement par vous — le candidat ne les voit jamais</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <form action="{{ route('entreprise.candidatures.change-status', $candidature->id) }}" method="POST">
                            @csrf @method('PATCH')
                            <input type="hidden" name="statut" value="{{ $candidature->statut }}">
                            <textarea name="note_recruteur" rows="4"
                                placeholder="Ajoutez vos notes internes sur ce candidat..."
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-sm text-gray-700 focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 outline-none transition-all resize-none">{{ $candidature->note_recruteur }}</textarea>
                            <button type="submit"
                                    class="mt-3 px-5 py-2.5 bg-gray-900 text-white font-extrabold text-xs rounded-xl hover:bg-yellow-400 hover:text-gray-900 transition-all">
                                Enregistrer les notes
                            </button>
                        </form>
                    </div>
                </div>

            </div>

            {{-- ── COLONNE LATÉRALE ── --}}
            <div class="space-y-5">

                {{-- CV --}}
                @if($candidature->cv_path)
                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl bg-red-100 flex items-center justify-center">
                            <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <h2 class="text-gray-900 font-extrabold text-base">Curriculum Vitae</h2>
                    </div>
                    <div class="p-5">
                        <div class="flex items-center gap-3 p-4 bg-red-50 rounded-xl border border-red-100 mb-4">
                            <div class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-bold text-gray-900 truncate">CV_{{ $candidature->candidat->name }}</p>
                                <p class="text-xs text-gray-400">Fichier PDF</p>
                            </div>
                        </div>
                        <a href="{{ route('entreprise.candidatures.download-cv', $candidature->id) }}"
                           class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-gray-900 text-white font-extrabold text-sm rounded-xl hover:bg-yellow-400 hover:text-gray-900 transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                            Télécharger le CV
                        </a>
                    </div>
                </div>
                @else
                <div class="bg-white border border-gray-200 rounded-2xl p-6 text-center">
                    <div class="w-12 h-12 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <p class="text-gray-500 font-extrabold text-sm mb-0.5">Pas de CV</p>
                    <p class="text-gray-400 text-xs">Aucun CV joint à cette candidature.</p>
                </div>
                @endif

                {{-- Changer le statut --}}
                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl bg-gray-900 flex items-center justify-center">
                            <svg class="w-4 h-4 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <h2 class="text-gray-900 font-extrabold text-base">Changer le statut</h2>
                    </div>
                    <div class="p-5 space-y-2">
                        @foreach([
                            ['statut' => 'retenue',    'label' => 'Retenir le candidat',   'bg' => 'bg-green-50',  'text' => 'text-green-700',  'border' => 'border-green-200',  'hover' => 'hover:bg-green-100'],
                            ['statut' => 'rejetee',    'label' => 'Rejeter la candidature', 'bg' => 'bg-red-50',    'text' => 'text-red-600',    'border' => 'border-red-200',    'hover' => 'hover:bg-red-100'],
                            ['statut' => 'en_attente', 'label' => 'Remettre en attente',   'bg' => 'bg-orange-50', 'text' => 'text-orange-600', 'border' => 'border-orange-200', 'hover' => 'hover:bg-orange-100'],
                        ] as $action)
                        @if($candidature->statut !== $action['statut'])
                        <form action="{{ route('entreprise.candidatures.change-status', $candidature->id) }}" method="POST">
                            @csrf @method('PATCH')
                            <input type="hidden" name="statut" value="{{ $action['statut'] }}">
                            <button type="submit"
                                    class="w-full flex items-center justify-center gap-2 px-4 py-3 rounded-xl border font-extrabold text-sm transition-all {{ $action['bg'] }} {{ $action['text'] }} {{ $action['border'] }} {{ $action['hover'] }}">
                                {{ $action['label'] }}
                            </button>
                        </form>
                        @endif
                        @endforeach
                    </div>
                </div>

                {{-- Offre concernée --}}
                <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-xl bg-indigo-100 flex items-center justify-center">
                            <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <h2 class="text-gray-900 font-extrabold text-base">Offre concernée</h2>
                    </div>
                    <div class="p-5">
                        <p class="text-gray-900 font-extrabold text-sm mb-1">{{ $candidature->offre->titre }}</p>
                        @if($candidature->offre->ville)
                        <p class="text-gray-500 text-xs flex items-center gap-1.5 mb-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                            {{ $candidature->offre->ville }}
                        </p>
                        @endif
                        <p class="text-gray-400 text-xs mb-4">Postulé le {{ $candidature->created_at->format('d/m/Y') }}</p>
                        <a href="{{ route('entreprise.offres.show', $candidature->offre->id) }}"
                           class="w-full flex items-center justify-center gap-2 px-4 py-2.5 border border-gray-200 text-gray-700 font-extrabold text-xs rounded-xl hover:border-yellow-400 hover:text-yellow-500 transition-all">
                            Voir l'offre →
                        </a>
                    </div>
                </div>

                {{-- Navigation --}}
                <div class="flex gap-3">
                    <a href="{{ route('entreprise.candidatures.index') }}"
                       class="flex-1 flex items-center justify-center gap-2 px-4 py-2.5 bg-white border border-gray-200 text-gray-700 font-extrabold text-xs rounded-xl hover:border-gray-400 transition-all">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        Retour
                    </a>
                    <a href="{{ route('entreprise.candidatures.offre', $candidature->offre->id) }}"
                       class="flex-1 flex items-center justify-center px-4 py-2.5 bg-white border border-gray-200 text-gray-700 font-extrabold text-xs rounded-xl hover:border-gray-400 transition-all">
                        Autres candidatures
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection