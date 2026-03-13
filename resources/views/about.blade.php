@extends('layouts.app')

@section('title', 'À propos — JobConnect Bénin')

@section('content')

{{-- ═══════════════════════════════════════
     HERO À PROPOS
═══════════════════════════════════════ --}}
<section class="relative bg-gray-950 overflow-hidden">
    {{-- Grille décorative --}}
    <div class="absolute inset-0 pointer-events-none"
         style="background-image:linear-gradient(rgba(255,255,255,0.03) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,0.03) 1px,transparent 1px);background-size:60px 60px"></div>
    {{-- Halo doré --}}
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[600px] h-[300px] pointer-events-none"
         style="background:radial-gradient(ellipse,rgba(250,204,21,0.12) 0%,transparent 70%)"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-28 text-center">
        <div class="inline-flex items-center gap-2 mb-6 px-4 py-2 rounded-full"
             style="background:rgba(250,204,21,0.1);border:1px solid rgba(250,204,21,0.25)">
            <span class="w-1.5 h-1.5 rounded-full bg-yellow-400 animate-pulse inline-block"></span>
            <span class="text-yellow-400 text-xs font-extrabold tracking-widest uppercase">Notre histoire</span>
        </div>

        <h1 class="text-white font-extrabold mb-6 leading-tight"
            style="font-size:clamp(2.2rem,5vw,4rem);letter-spacing:-0.025em">
            Construire l'avenir de<br>l'emploi au <span class="text-yellow-400">Bénin</span>
        </h1>

        <p class="text-gray-400 text-lg leading-relaxed max-w-2xl mx-auto mb-12">
            JobConnect est né d'une conviction simple : chaque talent béninois mérite une chance équitable d'accéder aux meilleures opportunités professionnelles, sans barrières ni intermédiaires.
        </p>

        {{-- Stats hero --}}
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 max-w-3xl mx-auto">
            @foreach([
                ['num' => '2024', 'label' => 'Année de création'],
                ['num' => '100%', 'label' => 'Gratuit pour les candidats'],
                ['num' => '3',    'label' => 'Types d\'opportunités'],
                ['num' => '🇧🇯',  'label' => 'Fait au Bénin'],
            ] as $s)
            <div class="rounded-2xl py-5 px-4"
                 style="background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.08)">
                <p class="text-yellow-400 font-extrabold text-2xl">{{ $s['num'] }}</p>
                <p class="text-gray-500 text-xs mt-1 leading-snug">{{ $s['label'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     MISSION
═══════════════════════════════════════ --}}
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

            <div>
                <p class="text-yellow-500 text-xs font-extrabold tracking-widest uppercase mb-4">Notre mission</p>
                <h2 class="text-gray-900 font-extrabold text-4xl mb-6 leading-tight" style="letter-spacing:-0.02em">
                    Digitaliser l'accès à<br>l'emploi pour tous
                </h2>
                <p class="text-gray-500 leading-relaxed mb-6">
                    Au Bénin, la recherche d'emploi reste un parcours semé d'obstacles : informations dispersées, processus opaques, inégalités d'accès. JobConnect a été conçu pour briser ces barrières.
                </p>
                <p class="text-gray-500 leading-relaxed mb-8">
                    Nous mettons en relation directe les talents avec les entreprises qui recrutent, grâce à une plateforme moderne, transparente et entièrement gratuite pour les candidats — inspirée de l'initiative gouvernementale <span class="font-semibold text-gray-700">PSIE</span> du Bénin.
                </p>

                <div class="flex items-start gap-4 p-5 bg-yellow-50 border border-yellow-200 rounded-2xl">
                    <div class="w-10 h-10 bg-yellow-400 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-900 font-bold text-sm mb-1">Notre engagement</p>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            JobConnect reste gratuit pour tous les candidats, pour toujours. L'accès à l'emploi ne devrait jamais être une question de moyens financiers.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Visuel mission --}}
            <div class="relative">
                <div class="bg-gray-950 rounded-3xl p-10 relative overflow-hidden">
                    <div class="absolute -top-12 -right-12 w-48 h-48 rounded-full pointer-events-none"
                         style="background:radial-gradient(circle,rgba(250,204,21,0.15),transparent 70%)"></div>
                    <div class="relative z-10 space-y-5">
                        @foreach([
                            ['icone' => '🎯', 'titre' => 'Matching intelligent', 'desc' => 'Les offres correspondent réellement aux profils des candidats grâce à notre système de filtres avancés.'],
                            ['icone' => '🔍', 'titre' => 'Transparence totale', 'desc' => 'Chaque offre affiche clairement le salaire, le type de contrat et les exigences du poste.'],
                            ['icone' => '⚡', 'titre' => 'Processus simplifié', 'desc' => 'De la candidature au retour recruteur, tout se passe sur une seule plateforme en quelques clics.'],
                        ] as $item)
                        <div class="flex items-start gap-4 p-4 rounded-xl"
                             style="background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.08)">
                            <span class="text-2xl flex-shrink-0">{{ $item['icone'] }}</span>
                            <div>
                                <p class="text-white font-bold text-sm mb-1">{{ $item['titre'] }}</p>
                                <p class="text-gray-500 text-xs leading-relaxed">{{ $item['desc'] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                {{-- Badge flottant --}}
                <div class="absolute -bottom-4 -left-4 px-4 py-3 bg-yellow-400 rounded-2xl shadow-lg">
                    <p class="text-gray-900 font-extrabold text-sm">Inspiré du PSIE</p>
                    <p class="text-gray-700 text-xs">Initiative gov. Bénin</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     VALEURS
═══════════════════════════════════════ --}}
<section class="py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <p class="text-yellow-500 text-xs font-extrabold tracking-widest uppercase mb-3">Ce qui nous guide</p>
            <h2 class="text-gray-900 font-extrabold text-4xl" style="letter-spacing:-0.02em">
                Nos valeurs fondamentales
            </h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            @foreach([
                ['icone' => '🤝', 'titre' => 'Accessibilité', 'desc' => 'Une plateforme 100% gratuite pour les candidats. L\'emploi est un droit, pas un privilège.', 'couleur' => 'yellow'],
                ['icone' => '🔎', 'titre' => 'Transparence', 'desc' => 'Des processus clairs et honnêtes. Chaque entreprise est vérifiée avant de publier.', 'couleur' => 'blue'],
                ['icone' => '💡', 'titre' => 'Innovation', 'desc' => 'Une approche digitale moderne du marché de l\'emploi béninois, pensée localement.', 'couleur' => 'green'],
                ['icone' => '🛡️', 'titre' => 'Responsabilité', 'desc' => 'Nous prenons au sérieux notre rôle dans l\'insertion professionnelle de la jeunesse béninoise.', 'couleur' => 'red'],
            ] as $v)
            <div class="bg-white border border-gray-200 rounded-2xl p-7 hover:-translate-y-1 hover:shadow-lg hover:border-yellow-300 transition-all duration-300 group">
                <div class="text-4xl mb-5">{{ $v['icone'] }}</div>
                <h3 class="text-gray-900 font-extrabold text-lg mb-3">{{ $v['titre'] }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed">{{ $v['desc'] }}</p>
                <div class="mt-5 h-0.5 bg-gray-100 rounded-full">
                    <div class="h-full bg-yellow-400 w-0 group-hover:w-full transition-all duration-500 rounded-full"></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     SERVICES
═══════════════════════════════════════ --}}
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <p class="text-yellow-500 text-xs font-extrabold tracking-widest uppercase mb-3">Ce que nous offrons</p>
            <h2 class="text-gray-900 font-extrabold text-4xl" style="letter-spacing:-0.02em">
                Une plateforme complète<br>pour chaque acteur
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- Candidats --}}
            <div class="bg-gray-950 rounded-3xl p-10 relative overflow-hidden">
                <div class="absolute -top-16 -right-16 w-56 h-56 rounded-full pointer-events-none"
                     style="background:radial-gradient(circle,rgba(250,204,21,0.1),transparent 70%)"></div>
                <div class="relative z-10">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 bg-yellow-400 rounded-2xl flex items-center justify-center text-2xl">👨‍💼</div>
                        <div>
                            <p class="text-yellow-400 text-xs font-extrabold tracking-widest uppercase">Espace candidat</p>
                            <h3 class="text-white font-extrabold text-xl">Pour les chercheurs d'emploi</h3>
                        </div>
                    </div>
                    <div class="space-y-3">
                        @foreach([
                            ['✓', 'Recherche avancée d\'offres par secteur, ville et type'],
                            ['✓', 'Profil professionnel en ligne avec CV intégré'],
                            ['✓', 'Candidature en 1 clic avec suivi en temps réel'],
                            ['✓', 'Historique complet de toutes vos candidatures'],
                            ['✓', 'Notifications dès qu\'une entreprise consulte votre dossier'],
                            ['✓', 'Accès aux stages académiques et professionnels'],
                        ] as $item)
                        <div class="flex items-start gap-3">
                            <span class="text-yellow-400 font-extrabold text-sm flex-shrink-0 mt-0.5">{{ $item[0] }}</span>
                            <p class="text-gray-300 text-sm leading-relaxed">{{ $item[1] }}</p>
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-8">
                        @guest
                        <a href="{{ route('register') }}"
                           class="inline-flex items-center gap-2 px-6 py-3 bg-yellow-400 text-gray-900 font-extrabold rounded-xl text-sm hover:bg-yellow-300 transition-colors">
                            Créer mon profil — Gratuit
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                        @endguest
                    </div>
                </div>
            </div>

            {{-- Entreprises --}}
            <div class="bg-yellow-50 border-2 border-yellow-200 rounded-3xl p-10 relative overflow-hidden">
                <div class="absolute -top-16 -right-16 w-56 h-56 rounded-full bg-yellow-400/20 pointer-events-none"></div>
                <div class="relative z-10">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 bg-gray-900 rounded-2xl flex items-center justify-center text-2xl">🏢</div>
                        <div>
                            <p class="text-yellow-600 text-xs font-extrabold tracking-widest uppercase">Espace entreprise</p>
                            <h3 class="text-gray-900 font-extrabold text-xl">Pour les recruteurs</h3>
                        </div>
                    </div>
                    <div class="space-y-3">
                        @foreach([
                            ['✓', 'Publication d\'offres d\'emploi et de stages illimitées'],
                            ['✓', 'Gestion centralisée de toutes vos candidatures'],
                            ['✓', 'Consultation des profils et CV des candidats'],
                            ['✓', 'Système de notes et de suivi par candidature'],
                            ['✓', 'Tableau de bord avec statistiques de recrutement'],
                            ['✓', 'Validation et crédibilité via notre processus de vérification'],
                        ] as $item)
                        <div class="flex items-start gap-3">
                            <span class="text-yellow-600 font-extrabold text-sm flex-shrink-0 mt-0.5">{{ $item[0] }}</span>
                            <p class="text-gray-600 text-sm leading-relaxed">{{ $item[1] }}</p>
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-8">
                        @guest
                        <a href="{{ route('register') }}"
                           class="inline-flex items-center gap-2 px-6 py-3 bg-gray-900 text-white font-extrabold rounded-xl text-sm hover:bg-yellow-400 hover:text-gray-900 transition-all">
                            Commencer à recruter
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     POURQUOI NOUS FAIRE CONFIANCE
═══════════════════════════════════════ --}}
<section class="py-24 bg-gray-950">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <p class="text-yellow-400 text-xs font-extrabold tracking-widest uppercase mb-3">Sérieux & Responsabilité</p>
            <h2 class="text-white font-extrabold text-4xl" style="letter-spacing:-0.02em">
                Pourquoi nous faire<br><span class="text-yellow-400">confiance ?</span>
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach([
                ['icone' => '🏛️', 'titre' => 'Inspiré du gouvernement', 'desc' => 'JobConnect s\'inscrit dans la continuité de l\'initiative PSIE du gouvernement béninois, visant à moderniser l\'insertion professionnelle des jeunes.'],
                ['icone' => '✅', 'titre' => 'Entreprises vérifiées', 'desc' => 'Chaque entreprise passe par un processus de validation manuel avant de pouvoir publier des offres. Votre sécurité et votre temps sont notre priorité.'],
                ['icone' => '🔐', 'titre' => 'Données protégées', 'desc' => 'Vos informations personnelles et professionnelles sont sécurisées et ne sont jamais partagées sans votre consentement explicite.'],
                ['icone' => '🎓', 'titre' => 'Projet académique sérieux', 'desc' => 'Développé dans le cadre d\'un mémoire de fin d\'études à EIG Bénin, JobConnect est le fruit d\'une recherche approfondie sur les besoins réels du marché.'],
                ['icone' => '🌍', 'titre' => '100% Local', 'desc' => 'Conçu par des Béninois pour les Béninois. Nous comprenons les réalités du marché local, les attentes des recruteurs et les besoins des candidats.'],
                ['icone' => '📈', 'titre' => 'En constante amélioration', 'desc' => 'La plateforme évolue continuellement en intégrant les retours des utilisateurs pour offrir toujours plus de valeur à la communauté professionnelle béninoise.'],
            ] as $raison)
            <div class="rounded-2xl p-7 group hover:border-yellow-400/50 transition-all duration-300"
                 style="background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.08)">
                <div class="text-4xl mb-4">{{ $raison['icone'] }}</div>
                <h3 class="text-white font-extrabold text-base mb-3">{{ $raison['titre'] }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed">{{ $raison['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     ÉQUIPE / VISION
═══════════════════════════════════════ --}}
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div>
                <p class="text-yellow-500 text-xs font-extrabold tracking-widest uppercase mb-4">Notre vision</p>
                <h2 class="text-gray-900 font-extrabold text-4xl mb-6 leading-tight" style="letter-spacing:-0.02em">
                    Devenir le LinkedIn<br>de l'Afrique de l'Ouest
                </h2>
                <p class="text-gray-500 leading-relaxed mb-6">
                    Notre ambition va au-delà du Bénin. Nous construisons aujourd'hui les fondations d'une plateforme qui demain connectera les talents et les entreprises à travers toute l'Afrique de l'Ouest.
                </p>
                <p class="text-gray-500 leading-relaxed mb-8">
                    Chaque offre publiée, chaque candidature déposée, chaque recrutement réussi sur JobConnect contribue à bâtir un écosystème professionnel plus fort, plus juste et plus connecté pour notre région.
                </p>
                <a href="{{ route('contact') }}"
                   class="inline-flex items-center gap-2 px-6 py-3 bg-gray-900 text-white font-extrabold rounded-xl text-sm hover:bg-yellow-400 hover:text-gray-900 transition-all">
                    Nous contacter
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>

            {{-- Timeline --}}
            <div class="space-y-0">
                <p class="text-gray-900 text-xs font-extrabold tracking-widest uppercase mb-8">Feuille de route</p>
                @foreach([
                    ['annee' => '2024', 'titre' => 'Lancement de JobConnect', 'desc' => 'Création de la plateforme avec les espaces candidat, entreprise et administration.', 'done' => true],
                    ['annee' => '2025', 'titre' => 'Expansion nationale', 'desc' => 'Déploiement sur toutes les villes du Bénin et intégration d\'alertes emploi par SMS.', 'done' => false],
                    ['annee' => '2026', 'titre' => 'Région Afrique de l\'Ouest', 'desc' => 'Ouverture à d\'autres pays francophones : Togo, Niger, Burkina Faso, Côte d\'Ivoire.', 'done' => false],
                ] as $i => $step)
                <div class="flex gap-6 {{ $i < 2 ? 'pb-8' : '' }} relative">
                    {{-- Ligne verticale --}}
                    @if($i < 2)
                    <div class="absolute left-5 top-10 bottom-0 w-0.5 {{ $step['done'] ? 'bg-yellow-400' : 'bg-gray-200' }}"></div>
                    @endif

                    {{-- Point --}}
                    <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 relative z-10
                                {{ $step['done'] ? 'bg-yellow-400' : 'bg-gray-100 border-2 border-gray-200' }}">
                        @if($step['done'])
                        <svg class="w-5 h-5 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                        </svg>
                        @else
                        <div class="w-2 h-2 rounded-full bg-gray-400"></div>
                        @endif
                    </div>

                    <div class="pt-1.5">
                        <div class="flex items-center gap-3 mb-1">
                            <span class="text-xs font-extrabold {{ $step['done'] ? 'text-yellow-500' : 'text-gray-400' }} tracking-widest">{{ $step['annee'] }}</span>
                            @if($step['done'])
                            <span class="px-2 py-0.5 bg-yellow-50 text-yellow-600 text-xs font-bold rounded-full">Réalisé</span>
                            @else
                            <span class="px-2 py-0.5 bg-gray-100 text-gray-400 text-xs font-bold rounded-full">À venir</span>
                            @endif
                        </div>
                        <h4 class="text-gray-900 font-bold text-base mb-1">{{ $step['titre'] }}</h4>
                        <p class="text-gray-500 text-sm leading-relaxed">{{ $step['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     CTA FINAL
═══════════════════════════════════════ --}}
<section class="py-24 bg-yellow-400">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-gray-900 font-extrabold text-4xl md:text-5xl mb-6 leading-tight" style="letter-spacing:-0.02em">
            Prêt à rejoindre<br>l'aventure JobConnect ?
        </h2>
        <p class="text-gray-700 text-lg leading-relaxed mb-10 max-w-xl mx-auto">
            Que vous soyez un candidat en recherche d'opportunités ou une entreprise en quête de talents, votre place est ici.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            @guest
            <a href="{{ route('register') }}"
               class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-gray-900 text-white font-extrabold rounded-xl hover:bg-gray-800 transition-colors text-sm">
                Créer un compte gratuit
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
            @endguest
            <a href="{{ route('offres.index') }}"
               class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-white text-gray-900 font-extrabold rounded-xl hover:bg-gray-100 transition-colors text-sm">
                Explorer les offres
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </a>
            <a href="{{ route('contact') }}"
               class="inline-flex items-center justify-center gap-2 px-8 py-4 border-2 border-gray-900/30 text-gray-900 font-extrabold rounded-xl hover:border-gray-900 transition-colors text-sm">
                Nous contacter
            </a>
        </div>
    </div>
</section>

@endsection