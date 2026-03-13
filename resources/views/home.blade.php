@extends('layouts.app')

@section('title', 'JobConnect Bénin — Trouvez votre emploi, recrutez les meilleurs talents')

@section('content')

{{-- ═══════════════════════════════════════
     HERO
═══════════════════════════════════════ --}}
<section class="relative min-h-screen flex items-center overflow-hidden bg-gray-950">
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat"
         style="background-image:url('https://images.unsplash.com/photo-1497366216548-37526070297c?w=1920&q=80');opacity:0.25"></div>
    <div class="absolute inset-0 bg-gradient-to-br from-gray-950 via-gray-950/80 to-transparent"></div>
    <div class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32">
        <div class="max-w-3xl">
            <div class="inline-flex items-center gap-2 mb-6 px-4 py-2 rounded-full"
                 style="background:rgba(250,204,21,0.12);border:1px solid rgba(250,204,21,0.3)">
                <span class="w-2 h-2 rounded-full bg-yellow-400 animate-pulse inline-block"></span>
                <span class="text-yellow-400 text-xs font-bold tracking-widest uppercase">
                    {{ $stats['total_offres'] }} offres disponibles maintenant au Bénin
                </span>
            </div>
            <h1 class="text-white font-extrabold mb-6 leading-tight"
                style="font-size:clamp(2.2rem,5vw,4rem);letter-spacing:-0.025em">
                Votre carrière<br>commence <span class="text-yellow-400">ici</span>,<br>
                au <span class="text-yellow-400">Bénin</span>.
            </h1>
            <p class="text-gray-400 text-lg mb-10 leading-relaxed max-w-lg">
                JobConnect connecte les meilleurs talents aux entreprises qui construisent l'avenir économique du Bénin.
            </p>
            <form action="{{ route('offres.index') }}" method="GET">
                <div class="flex flex-col sm:flex-row rounded-2xl overflow-hidden border border-white/10"
                     style="background:rgba(255,255,255,0.05)">
                    <div class="flex items-center gap-3 flex-1 px-5 py-4 border-b sm:border-b-0 sm:border-r border-white/10">
                        <svg class="w-5 h-5 text-gray-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text" name="search" placeholder="Titre, compétence..."
                               class="bg-transparent text-white text-sm outline-none w-full placeholder-gray-500">
                    </div>
                    <div class="flex items-center gap-3 px-5 py-4 sm:w-44 border-b sm:border-b-0 sm:border-r border-white/10">
                        <svg class="w-4 h-4 text-gray-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        </svg>
                        <input type="text" name="ville" placeholder="Cotonou..."
                               class="bg-transparent text-white text-sm outline-none w-full placeholder-gray-500">
                    </div>
                    <button type="submit"
                            class="px-7 py-4 bg-yellow-400 text-gray-900 font-extrabold text-sm hover:bg-yellow-300 transition-colors whitespace-nowrap">
                        Rechercher
                    </button>
                </div>
                <div class="flex flex-wrap items-center gap-2 mt-4">
                    <span class="text-gray-600 text-xs">Populaire :</span>
                    @foreach(['Développeur', 'Marketing', 'Comptable', 'Stage RH', 'Commercial'] as $tag)
                    <a href="{{ route('offres.index', ['search' => $tag]) }}"
                       class="text-xs text-gray-400 px-3 py-1 rounded-full hover:text-yellow-400 transition-colors"
                       style="background:rgba(255,255,255,0.06);border:1px solid rgba(255,255,255,0.1)">
                        {{ $tag }}
                    </a>
                    @endforeach
                </div>
            </form>
        </div>
        <div class="hidden lg:flex absolute bottom-12 right-8 gap-3">
            @foreach([['val' => $stats['total_offres'], 'label' => 'Offres actives'], ['val' => $stats['total_entreprises'], 'label' => 'Entreprises'], ['val' => $stats['total_stages'], 'label' => 'Stages dispo']] as $s)
            <div class="text-center px-5 py-4 rounded-2xl"
                 style="background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.08)">
                <p class="text-white text-2xl font-bold">{{ $s['val'] }}+</p>
                <p class="text-gray-500 text-xs mt-1">{{ $s['label'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-1 animate-bounce">
        <span class="text-gray-600 text-xs tracking-widest uppercase">Découvrir</span>
        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </div>
</section>

{{-- ═══════════════════════════════════════
     TICKER
═══════════════════════════════════════ --}}
<div class="bg-yellow-400 py-3 overflow-hidden">
    @php $items = ['Emploi CDI', 'Stage Pro', 'Marketing Digital', 'Développeur Web', 'Finance', 'RH', 'Ingénierie BTP', 'Commerce', 'Stage Académique', 'Informatique', 'Transport']; @endphp
    <div class="flex gap-12" style="animation: jobTicker 28s linear infinite; width: max-content; white-space: nowrap;">
        @foreach(array_merge($items, $items, $items) as $item)
        <span class="text-xs font-extrabold text-gray-900 tracking-widest uppercase inline-flex items-center gap-3">
            <span class="w-1.5 h-1.5 rounded-full bg-gray-900/25 inline-block flex-shrink-0"></span>{{ $item }}
        </span>
        @endforeach
    </div>
</div>
<style>@keyframes jobTicker { from { transform: translateX(0); } to { transform: translateX(-33.333%); } }</style>

{{-- ═══════════════════════════════════════
     BENTO GRID — IMPACT VISUEL
═══════════════════════════════════════ --}}
<section class="py-20 bg-gray-950 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="mb-12 max-w-xl">
            <p class="text-yellow-400 text-xs font-extrabold tracking-widest uppercase mb-3">Des vraies opportunités</p>
            <h2 class="text-white font-extrabold leading-tight" style="font-size:clamp(1.8rem,3.5vw,3rem);letter-spacing:-0.025em">
                Des carrières qui<br>prennent forme <span class="text-yellow-400">chaque jour</span>
            </h2>
        </div>

        {{-- Ligne 1 : grande gauche + 2 petites droite --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-3">

            {{-- 1 GRANDE PHOTO --}}
            <div class="col-span-2 md:row-span-2 relative rounded-2xl overflow-hidden group"
                 style="min-height:360px">

                <img
                    src="{{ asset('images/fda.avif') }}"
                    class="absolute inset-0 w-full h-full object-cover object-center transition-transform duration-700 group-hover:scale-105"
                >

                <div class="absolute inset-0 bg-gradient-to-t from-gray-950 via-gray-950/40 to-transparent"></div>

                <div class="absolute bottom-0 left-0 p-7">

                    <span class="inline-block px-3 py-1 bg-yellow-400 text-gray-900 text-xs font-extrabold rounded-full mb-3 uppercase tracking-wide">
                        Entretien réussi
                    </span>

                    <p class="text-white font-extrabold text-xl leading-snug">
                        « J'ai décroché mon CDI en 3 semaines »
                    </p>

                    <p class="text-gray-400 text-xs mt-2">
                        Ingénieure, Cotonou — recrutée via JobConnect
                    </p>

                </div>
            </div>

            
            {{-- [2] Carte chiffre — offres --}}
            <div class="col-span-1 rounded-2xl p-6 flex flex-col justify-between"
                 style="background:rgba(250,204,21,0.12);border:1px solid rgba(250,204,21,0.2);min-height:170px">
                <svg class="w-8 h-8 text-yellow-400 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <div>
                    <p class="text-yellow-400 font-extrabold" style="font-size:2.5rem;letter-spacing:-0.04em;line-height:1">{{ $stats['total_offres'] }}+</p>
                    <p class="text-gray-300 text-sm font-semibold mt-1">offres actives</p>
                    <p class="text-gray-500 text-xs mt-0.5">emplois & stages au Bénin</p>
                </div>
            </div>

            {{-- [3] Photo bureau --}}
            <div class="col-span-1 rounded-2xl overflow-hidden relative group" style="min-height:170px">
                <img src="https://images.unsplash.com/photo-1497366811353-6870744d04b2?w=600&q=80"
                     alt="Bureau entreprise"
                     class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                <div class="absolute inset-0" style="background:linear-gradient(135deg,rgba(3,7,18,0.55),transparent)"></div>
                <div class="absolute top-4 left-4">
                    <span class="px-2.5 py-1 bg-white/10 backdrop-blur-sm text-white text-xs font-bold rounded-lg border border-white/15">🏢 Entreprises vérifiées</span>
                </div>
            </div>

            {{-- [4] Carte stages --}}
            <div class="col-span-1 rounded-2xl p-6 flex flex-col justify-between"
                 style="background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.08);min-height:170px">
                <div class="w-10 h-10 rounded-xl bg-yellow-400 flex items-center justify-center">
                    <svg class="w-5 h-5 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-white font-extrabold text-2xl" style="letter-spacing:-0.03em">{{ $stats['total_stages'] }}+</p>
                    <p class="text-gray-300 text-sm font-semibold">stages disponibles</p>
                    <p class="text-gray-500 text-xs mt-1">Pro & académique</p>
                </div>
            </div>

            {{-- [5] Photo équipe — large --}}
            <div class="col-span-1 rounded-2xl overflow-hidden relative group" style="min-height:170px">
                <img src="{{ asset('images/ada.avif') }}"
                     alt="Équipe au travail"
                     class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-r from-gray-950/80 via-gray-950/30 to-transparent"></div>
                <div class="absolute inset-0 flex items-center px-6">
                    <div>
                        <p class="text-white font-extrabold text-sm leading-snug mb-3">Recrutez les talents<br>qui feront la différence</p>
                        <a href="{{ route('register') }}"
                           class="inline-flex items-center gap-1.5 px-4 py-2 bg-yellow-400 text-gray-900 font-extrabold text-xs rounded-xl hover:bg-yellow-300 transition-colors uppercase tracking-wide">
                            Publier une offre
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

        </div>

        {{-- Ligne 2 : bande basse --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">

            {{-- [6] Entreprises stat --}}
            <div class="col-span-1 rounded-2xl p-6 flex flex-col justify-between"
                 style="background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.08);min-height:150px">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background:rgba(250,204,21,0.15);border:1px solid rgba(250,204,21,0.2)">
                    <svg class="w-4.5 h-4.5 text-yellow-400 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <div>
                    <p class="text-white font-extrabold text-2xl" style="letter-spacing:-0.03em">{{ $stats['total_entreprises'] }}+</p>
                    <p class="text-gray-300 text-sm font-semibold">entreprises</p>
                    <p class="text-gray-500 text-xs mt-0.5">toutes vérifiées</p>
                </div>
            </div>

            {{-- [7] Photo candidat souriant --}}
            <div class="col-span-1 rounded-2xl overflow-hidden relative group" style="min-height:150px">
                <img src="{{ asset('images/asa.webp') }}"
                     alt="Candidat satisfait"
                     class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                <div class="absolute inset-0 bg-gradient-to-t from-gray-950/70 to-transparent"></div>
                <div class="absolute bottom-4 left-4 right-4">
                    <span class="inline-block px-2.5 py-1 bg-yellow-400/90 text-gray-900 text-xs font-extrabold rounded-lg">100% gratuit candidats</span>
                </div>
            </div>

            {{-- [8] Carte CTA voir offres --}}
            <div class="col-span-2 rounded-2xl p-7 flex items-center justify-between gap-6 relative overflow-hidden"
                 style="background:rgba(250,204,21,0.08);border:1px solid rgba(250,204,21,0.15)">
                <div class="absolute -right-8 -top-8 w-32 h-32 rounded-full" style="background:rgba(250,204,21,0.08)"></div>
                <div>
                    <p class="text-white font-extrabold text-lg leading-snug">Prêt à trouver<br>votre prochain poste ?</p>
                    <p class="text-gray-400 text-xs mt-1">Des centaines d'offres vous attendent</p>
                </div>
                <a href="{{ route('offres.index') }}"
                   class="flex-shrink-0 inline-flex items-center gap-2 px-6 py-3 bg-yellow-400 text-gray-900 font-extrabold text-sm rounded-xl hover:bg-yellow-300 transition-colors whitespace-nowrap">
                    Voir les offres
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>

        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     ✦ SECTION VIDÉO SPLIT — "Votre avenir commence ici"
═══════════════════════════════════════ --}}
<!-- <section class="relative overflow-hidden bg-gray-950" id="section-video">

    {{-- Grain texture overlay --}}
    <div class="absolute inset-0 pointer-events-none z-10 opacity-30"
         style="background-image:url('data:image/svg+xml,%3Csvg viewBox=%220 0 256 256%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cfilter id=%22noise%22%3E%3CfeTurbulence type=%22fractalNoise%22 baseFrequency=%220.9%22 numOctaves=%224%22 stitchTiles=%22stitch%22/%3E%3C/filter%3E%3Crect width=%22100%25%22 height=%22100%25%22 filter=%22url(%23noise)%22 opacity=%220.4%22/%3E%3C/svg%3E');background-size:200px"></div>

    <div class="relative z-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-0 lg:gap-16 items-center">

            {{-- ── CÔTÉ VIDÉO ── --}}
            <div class="relative order-2 lg:order-1 mt-12 lg:mt-0" id="video-block">

                {{-- Halo décoratif derrière --}}
                <div class="absolute -inset-4 rounded-3xl pointer-events-none"
                     style="background:radial-gradient(ellipse at 40% 50%, rgba(250,204,21,0.12) 0%, transparent 70%)"></div>

                {{-- Conteneur vidéo avec border jaune animée --}}
                <div class="relative rounded-2xl overflow-hidden group"
                     style="border:1px solid rgba(250,204,21,0.25);box-shadow:0 0 60px rgba(250,204,21,0.08)">

                    {{-- Ratio 16/9 --}}
                    <div class="relative w-full" style="padding-top:56.25%">
                        <video
                            id="jobvideo"
                            class="absolute inset-0 w-full h-full object-cover"
                            src="https://videos.pexels.com/video-files/3252174/3252174-hd_1920_1080_25fps.mp4"
                            autoplay
                            muted
                            loop
                            playsinline
                            poster="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=1200&q=80">
                        </video>

                        {{-- Overlay léger --}}
                        <div class="absolute inset-0 pointer-events-none"
                             style="background:linear-gradient(135deg, rgba(3,7,18,0.35) 0%, rgba(3,7,18,0.0) 60%, rgba(3,7,18,0.5) 100%)"></div>

                        {{-- Badge Live flottant --}}
                        <div class="absolute top-4 left-4 flex items-center gap-2 px-3 py-1.5 rounded-full"
                             style="background:rgba(3,7,18,0.75);border:1px solid rgba(255,255,255,0.12);backdrop-filter:blur(8px)">
                            <span class="w-2 h-2 rounded-full bg-green-400 inline-block animate-pulse flex-shrink-0"></span>
                            <span class="text-white text-xs font-bold tracking-wide">Bénin · En direct</span>
                        </div>

                        {{-- Bouton play/pause overlay centré --}}
                        <button onclick="toggleVideo()"
                                id="playbtn"
                                class="absolute bottom-4 right-4 w-11 h-11 rounded-full flex items-center justify-center transition-all duration-200 hover:scale-110"
                                style="background:rgba(250,204,21,0.9);color:#111827"
                                aria-label="Pause">
                            {{-- Icône pause (état initial : vidéo joue) --}}
                            <svg id="icon-pause" class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/>
                            </svg>
                            <svg id="icon-play" class="w-4 h-4 hidden" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z"/>
                            </svg>
                        </button>
                    </div>

                    {{-- Barre de progression vidéo --}}
                    <div class="h-0.5 bg-gray-800 w-full">
                        <div id="videoprogress"
                             class="h-full bg-yellow-400 transition-none"
                             style="width:0%;transition:width 0.5s linear"></div>
                    </div>
                </div>

                {{-- Petite stat flottante sous la vidéo --}}
                <div class="flex items-center gap-4 mt-5">
                    @foreach([['★★★★★','4.9/5 satisfaction candidats'],['⚡','Réponse entreprise < 48h'],['🔒','Données sécurisées']] as $item)
                    <div class="flex items-center gap-1.5">
                        <span class="text-yellow-400 text-xs font-bold">{{ $item[0] }}</span>
                        <span class="text-gray-500 text-xs">{{ $item[1] }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- ── CÔTÉ TEXTE ── --}}
            <div class="order-1 lg:order-2" id="text-block">

                {{-- Label --}}
                <div class="inline-flex items-center gap-2 mb-6 px-3.5 py-1.5 rounded-full"
                     style="background:rgba(250,204,21,0.1);border:1px solid rgba(250,204,21,0.2)">
                    <span class="w-1.5 h-1.5 rounded-full bg-yellow-400 inline-block"></span>
                    <span class="text-yellow-400 text-xs font-extrabold tracking-widest uppercase">Pourquoi JobConnect ?</span>
                </div>

                {{-- Titre principal --}}
                <h2 class="text-white font-extrabold mb-6 leading-none"
                    style="font-size:clamp(2rem,4vw,3.25rem);letter-spacing:-0.03em;line-height:1.05">
                    Une plateforme<br>
                    <span class="text-yellow-400">pensée pour vous</span>,<br>
                    construite pour le<br>
                    <span style="position:relative;display:inline-block">
                        Bénin
                        <span class="absolute -bottom-1 left-0 right-0 h-0.5 bg-yellow-400 rounded-full opacity-60"></span>
                    </span>.
                </h2>

                <p class="text-gray-400 text-base leading-relaxed mb-10 max-w-lg">
                    Chaque jour, des dizaines de candidats béninois trouvent leur emploi ou leur stage grâce à JobConnect. Des offres vérifiées, un suivi transparent, zéro arnaque.
                </p>

                {{-- Points forts --}}
                <div class="space-y-5 mb-10">
                    @foreach([
                        ['icone'=>'01','titre'=>'Offres 100% vérifiées','desc'=>'Chaque offre est publiée par une entreprise vérifiée manuellement. Vous ne candidatez qu\'à des opportunités réelles.'],
                        ['icone'=>'02','titre'=>'Suivi en temps réel','desc'=>'Votre candidature acceptée ? Refusée ? Vous êtes notifié immédiatement depuis votre tableau de bord.'],
                        ['icone'=>'03','titre'=>'Gratuit pour toujours','desc'=>'Créer un profil, postuler, sauvegarder des offres — tout est gratuit pour les candidats, sans limite.'],
                    ] as $point)
                    <div class="flex items-start gap-4 group" style="opacity:0;transform:translateY(16px);transition:opacity 0.5s ease, transform 0.5s ease" data-reveal>
                        <div class="flex-shrink-0 w-9 h-9 rounded-xl flex items-center justify-center text-xs font-extrabold text-gray-900 bg-yellow-400 group-hover:scale-110 transition-transform">
                            {{ $point['icone'] }}
                        </div>
                        <div>
                            <p class="text-white font-bold text-sm mb-1">{{ $point['titre'] }}</p>
                            <p class="text-gray-500 text-sm leading-relaxed">{{ $point['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- CTA --}}
                <div class="flex flex-wrap gap-3">
                    @guest
                    <a href="{{ route('register') }}"
                       class="inline-flex items-center gap-2.5 px-7 py-3.5 bg-yellow-400 text-gray-900 font-extrabold text-sm rounded-xl hover:bg-yellow-300 transition-all hover:-translate-y-0.5 hover:shadow-lg"
                       style="box-shadow:0 4px 24px rgba(250,204,21,0.25)">
                        Créer mon compte gratuit
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                    <a href="{{ route('offres.index') }}"
                       class="inline-flex items-center gap-2 px-7 py-3.5 text-gray-400 font-bold text-sm rounded-xl transition-all hover:text-white"
                       style="border:1px solid rgba(255,255,255,0.12)">
                        Voir les offres
                    </a>
                    @else
                    <a href="{{ route('offres.index') }}"
                       class="inline-flex items-center gap-2.5 px-7 py-3.5 bg-yellow-400 text-gray-900 font-extrabold text-sm rounded-xl hover:bg-yellow-300 transition-all">
                        Explorer les offres
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                    @endguest
                </div>
            </div>

        </div>
    </div>
</section>

{{-- Script section vidéo --}}
<script>
(function(){
    var video = document.getElementById('jobvideo');
    var progress = document.getElementById('videoprogress');
    var iconPause = document.getElementById('icon-pause');
    var iconPlay = document.getElementById('icon-play');

    if(video){
        video.addEventListener('timeupdate', function(){
            if(video.duration){
                progress.style.width = ((video.currentTime / video.duration) * 100) + '%';
            }
        });
    }

    window.toggleVideo = function(){
        if(!video) return;
        if(video.paused){
            video.play();
            iconPause.classList.remove('hidden');
            iconPlay.classList.add('hidden');
        } else {
            video.pause();
            iconPause.classList.add('hidden');
            iconPlay.classList.remove('hidden');
        }
    };

    var reveals = document.querySelectorAll('[data-reveal]');
    if('IntersectionObserver' in window && reveals.length){
        var obs = new IntersectionObserver(function(entries){
            entries.forEach(function(e, i){
                if(e.isIntersecting){
                    setTimeout(function(){
                        e.target.style.opacity = '1';
                        e.target.style.transform = 'translateY(0)';
                    }, i * 150);
                    obs.unobserve(e.target);
                }
            });
        }, {threshold: 0.2});
        reveals.forEach(function(el){ obs.observe(el); });
    } else {
        reveals.forEach(function(el){
            el.style.opacity = '1';
            el.style.transform = 'translateY(0)';
        });
    }
})();
</script> -->

{{-- ═══════════════════════════════════════
     FEATURES
═══════════════════════════════════════ --}}
<section class="py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <p class="text-yellow-500 text-xs font-extrabold tracking-widest uppercase mb-3">Pourquoi nous choisir</p>
            <h2 class="text-gray-900 font-extrabold text-4xl md:text-5xl" style="letter-spacing:-0.02em;line-height:1.1">
                La plateforme emploi<br>faite pour le <span class="text-yellow-500">Bénin</span>
            </h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach([
                ['icon'=>'🎯','title'=>'Offres 100% vérifiées','desc'=>'Toutes nos offres viennent d\'entreprises béninoises validées. Uniquement des opportunités réelles.','tag'=>'100% fiable'],
                ['icon'=>'⚡','title'=>'Candidature en 1 clic','desc'=>'Créez votre profil une fois, postulez partout. CV et lettre envoyés instantanément.','tag'=>'< 60 secondes'],
                ['icon'=>'📊','title'=>'Suivi en temps réel','desc'=>'Suivez chaque candidature depuis votre tableau de bord : en attente, vue, retenue.','tag'=>'Tableau de bord'],
                ['icon'=>'🏢','title'=>'Entreprises validées','desc'=>'Chaque entreprise est vérifiée manuellement avant de publier. Votre sécurité d\'abord.','tag'=>'Vérification manuelle'],
                ['icon'=>'🎓','title'=>'Stages & alternances','desc'=>'Étudiants, trouvez votre stage académique ou professionnel adapté à votre niveau.','tag'=>'3 types de stages'],
                ['icon'=>'🔖','title'=>'Favoris & alertes','desc'=>'Sauvegardez les offres qui vous intéressent et ne manquez aucune opportunité.','tag'=>'Personnalisé'],
            ] as $f)
            <div class="bg-white border border-gray-200 rounded-2xl p-8 hover:-translate-y-1 hover:shadow-lg hover:border-yellow-300 transition-all duration-300 group">
                <div class="text-4xl mb-4">{{ $f['icon'] }}</div>
                <h3 class="text-gray-900 font-bold text-lg mb-3">{{ $f['title'] }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed mb-4">{{ $f['desc'] }}</p>
                <span class="text-xs font-extrabold text-yellow-500 tracking-widest uppercase">{{ $f['tag'] }}</span>
                <div class="mt-4 h-0.5 bg-gray-100 rounded-full">
                    <div class="h-full bg-yellow-400 w-0 group-hover:w-full transition-all duration-500 rounded-full"></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     3 ÉTAPES
═══════════════════════════════════════ --}}
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <p class="text-yellow-500 text-xs font-extrabold tracking-widest uppercase mb-3">Simple & Rapide</p>
            <h2 class="text-gray-900 font-extrabold text-4xl md:text-5xl" style="letter-spacing:-0.02em">
                Trouvez un emploi en <span class="text-yellow-400">3 étapes</span>
            </h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach([
                ['num'=>'01','title'=>'Créez votre profil','desc'=>'Inscrivez-vous gratuitement et complétez votre profil avec vos expériences, formations et compétences.','icon'=>'👤'],
                ['num'=>'02','title'=>'Explorez les offres','desc'=>'Parcourez des centaines d\'offres filtrées par secteur, ville et type de contrat.','icon'=>'🔍'],
                ['num'=>'03','title'=>'Postulez & décrochez','desc'=>'Envoyez votre candidature en un clic et suivez son évolution en temps réel.','icon'=>'🚀'],
            ] as $i => $step)
            <div class="text-center relative">
                @if($i < 2)
                <div class="hidden md:block absolute top-7 left-3/4 w-1/2 border-t-2 border-dashed border-gray-200"></div>
                @endif
                <div class="w-14 h-14 rounded-full bg-gray-900 text-white font-extrabold text-lg flex items-center justify-center mx-auto mb-5 relative z-10 ring-4 ring-yellow-400/20">{{ $step['num'] }}</div>
                <div class="text-3xl mb-4">{{ $step['icon'] }}</div>
                <h3 class="text-gray-900 font-bold text-xl mb-3">{{ $step['title'] }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed">{{ $step['desc'] }}</p>
            </div>
            @endforeach
        </div>
        @guest
        <div class="text-center mt-12">
            <a href="{{ route('register') }}"
               class="inline-flex items-center gap-3 px-8 py-4 bg-gray-900 text-white font-bold rounded-xl hover:bg-yellow-400 hover:text-gray-900 transition-all duration-300 text-sm">
                Commencer gratuitement
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
        @endguest
    </div>
</section>

{{-- ═══════════════════════════════════════
     OFFRES
═══════════════════════════════════════ --}}
<section class="py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end mb-12 gap-4">
            <div>
                <p class="text-yellow-500 text-xs font-extrabold tracking-widest uppercase mb-2">Fraîchement publiées</p>
                <h2 class="text-gray-900 font-extrabold text-4xl" style="letter-spacing:-0.02em">Dernières opportunités</h2>
            </div>
            <a href="{{ route('offres.index') }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 border-2 border-gray-900 text-gray-900 font-bold rounded-xl text-sm hover:bg-gray-900 hover:text-white transition-all">
                Voir tout
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @forelse($dernieresOffres as $offre)
            <a href="{{ route('offres.show', $offre->slug) }}"
               class="bg-white border border-gray-200 rounded-2xl p-6 flex flex-col gap-3 hover:border-yellow-400 hover:shadow-md hover:-translate-y-1 transition-all duration-300 group">
                <div class="flex items-start justify-between">
                    @if($offre->type_offre === 'emploi')
                        <span class="px-2.5 py-1 bg-indigo-50 text-indigo-600 text-xs font-bold rounded-lg uppercase tracking-wide">Emploi</span>
                    @elseif($offre->type_offre === 'stage_professionnel')
                        <span class="px-2.5 py-1 bg-green-50 text-green-600 text-xs font-bold rounded-lg uppercase tracking-wide">Stage Pro</span>
                    @else
                        <span class="px-2.5 py-1 bg-orange-50 text-orange-500 text-xs font-bold rounded-lg uppercase tracking-wide">Stage Acad.</span>
                    @endif
                    <span class="text-xs text-gray-400">{{ $offre->created_at->diffForHumans() }}</span>
                </div>
                <h3 class="text-gray-900 font-bold text-base leading-snug">{{ $offre->titre }}</h3>
                <p class="text-gray-500 text-sm font-medium">{{ $offre->entreprise->nom_entreprise }}</p>
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
                <div class="pt-3 border-t border-gray-100 flex items-center justify-between">
                    <span class="text-xs text-gray-400">{{ $offre->categorie->nom ?? '' }}</span>
                    <span class="text-sm font-bold text-yellow-500 group-hover:translate-x-1 transition-transform duration-200 inline-block">Postuler →</span>
                </div>
            </a>
            @empty
            <div class="col-span-3 text-center py-16 text-gray-400">Aucune offre disponible pour le moment.</div>
            @endforelse
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     CATÉGORIES
═══════════════════════════════════════ --}}
@if($categories->count() > 0)
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <p class="text-yellow-500 text-xs font-extrabold tracking-widest uppercase mb-3">Secteurs d'activité</p>
            <h2 class="text-gray-900 font-extrabold text-4xl" style="letter-spacing:-0.02em">Explorez par domaine</h2>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
            @php $icons = ['💻','🛒','📣','💰','👥','🏦','🏥','📚','⚙️','⚖️','🚚','🍽️','🌱','🎨','📋']; @endphp
            @foreach($categories as $i => $categorie)
            <a href="{{ route('offres.categorie', $categorie->slug) }}"
               class="flex items-center gap-3 p-4 bg-white border border-gray-200 rounded-xl hover:bg-gray-900 hover:border-gray-900 transition-all duration-200 group">
                <span class="text-2xl">{{ $icons[$i % count($icons)] }}</span>
                <div>
                    <p class="text-sm font-semibold text-gray-900 group-hover:text-white transition-colors">{{ $categorie->nom }}</p>
                    <p class="text-xs text-gray-400 group-hover:text-yellow-400 mt-0.5 transition-colors">{{ $categorie->offres_count }} offre(s)</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ═══════════════════════════════════════
     IMPACT
═══════════════════════════════════════ --}}
<section class="py-24 bg-gray-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div>
                <p class="text-yellow-400 text-xs font-extrabold tracking-widest uppercase mb-4">Notre impact</p>
                <h2 class="text-white font-extrabold text-4xl md:text-5xl mb-6" style="letter-spacing:-0.02em;line-height:1.1">
                    Des chiffres qui<br>parlent d'eux-mêmes
                </h2>
                <p class="text-gray-400 text-base leading-relaxed mb-8">
                    JobConnect est la référence de l'emploi digital au Bénin. Chaque jour, des dizaines de candidats trouvent leur voie grâce à notre plateforme.
                </p>
                <a href="{{ route('offres.index') }}"
                   class="inline-flex items-center gap-3 px-6 py-3 bg-yellow-400 text-gray-900 font-bold rounded-xl hover:bg-yellow-300 transition-colors text-sm">
                    Explorer les offres
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
            <div class="grid grid-cols-2 gap-4">
                @foreach([
                    ['num'=>$stats['total_offres'].'+','label'=>'Offres publiées','sub'=>'emplois & stages'],
                    ['num'=>$stats['total_entreprises'].'+','label'=>'Entreprises','sub'=>'toutes vérifiées'],
                    ['num'=>$stats['total_stages'].'+','label'=>'Stages dispo','sub'=>'pro & académique'],
                    ['num'=>'100%','label'=>'Gratuit','sub'=>'pour les candidats'],
                ] as $impact)
                <div class="rounded-2xl p-6" style="background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.08)">
                    <p class="text-yellow-400 font-extrabold text-3xl mb-2">{{ $impact['num'] }}</p>
                    <p class="text-white font-semibold text-sm">{{ $impact['label'] }}</p>
                    <p class="text-gray-500 text-xs mt-1">{{ $impact['sub'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     CTA DOUBLE
═══════════════════════════════════════ --}}
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-gray-950 rounded-2xl p-10 relative overflow-hidden">
                <div class="absolute -top-10 -right-10 w-48 h-48 rounded-full" style="background:rgba(250,204,21,0.1)"></div>
                <div class="absolute -bottom-16 -left-5 w-36 h-36 rounded-full" style="background:rgba(250,204,21,0.05)"></div>
                <div class="relative z-10">
                    <span class="text-4xl block mb-4">👨‍💼</span>
                    <p class="text-yellow-400 text-xs font-extrabold tracking-widest uppercase mb-2">Pour les candidats</p>
                    <h3 class="text-white font-extrabold text-3xl mb-4 leading-tight">Lancez votre<br>carrière dès aujourd'hui</h3>
                    <p class="text-gray-400 text-sm leading-relaxed mb-8">
                        Créez votre profil gratuitement, postulez en un clic et suivez vos candidatures en temps réel.
                    </p>
                    @guest
                    <a href="{{ route('register') }}"
                       class="inline-flex items-center gap-2 px-6 py-3 bg-yellow-400 text-gray-900 font-bold rounded-xl hover:bg-yellow-300 transition-colors text-sm">
                        Créer mon profil — Gratuit
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                    @else
                    <a href="{{ route('candidat.dashboard') }}"
                       class="inline-flex items-center gap-2 px-6 py-3 bg-yellow-400 text-gray-900 font-bold rounded-xl hover:bg-yellow-300 transition-colors text-sm">
                        Mon tableau de bord →
                    </a>
                    @endguest
                </div>
            </div>
            <div class="rounded-2xl p-10 relative overflow-hidden border-2 border-yellow-200 bg-yellow-50">
                <div class="absolute -top-10 -right-10 w-48 h-48 rounded-full bg-yellow-400/20"></div>
                <div class="relative z-10">
                    <span class="text-4xl block mb-4">🏢</span>
                    <p class="text-yellow-600 text-xs font-extrabold tracking-widest uppercase mb-2">Pour les entreprises</p>
                    <h3 class="text-gray-900 font-extrabold text-3xl mb-4 leading-tight">Recrutez les<br>meilleurs talents</h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-8">
                        Publiez vos offres, gérez vos candidatures et trouvez les profils qui correspondent à vos besoins.
                    </p>
                    @guest
                    <a href="{{ route('register') }}"
                       class="inline-flex items-center gap-2 px-6 py-3 bg-gray-900 text-white font-bold rounded-xl hover:bg-yellow-400 hover:text-gray-900 transition-all text-sm">
                        Publier une offre
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                    @else
                    <a href="{{ route('entreprise.dashboard') }}"
                       class="inline-flex items-center gap-2 px-6 py-3 bg-gray-900 text-white font-bold rounded-xl hover:bg-yellow-400 hover:text-gray-900 transition-all text-sm">
                        Mon espace entreprise →
                    </a>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</section>

@endsection