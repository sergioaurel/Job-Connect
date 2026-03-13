@extends('layouts.app')

@section('title', 'Contact — JobConnect Bénin')

@section('content')

{{-- ═══════════════════════════════════════
     HERO CONTACT
═══════════════════════════════════════ --}}
<section class="relative bg-gray-950 overflow-hidden">
    <div class="absolute inset-0 pointer-events-none"
         style="background-image:linear-gradient(rgba(255,255,255,0.03) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,0.03) 1px,transparent 1px);background-size:60px 60px"></div>
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[500px] h-[250px] pointer-events-none"
         style="background:radial-gradient(ellipse,rgba(250,204,21,0.1) 0%,transparent 70%)"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 text-center">
        <div class="inline-flex items-center gap-2 mb-6 px-4 py-2 rounded-full"
             style="background:rgba(250,204,21,0.1);border:1px solid rgba(250,204,21,0.25)">
            <span class="w-1.5 h-1.5 rounded-full bg-yellow-400 animate-pulse inline-block"></span>
            <span class="text-yellow-400 text-xs font-extrabold tracking-widest uppercase">On vous répond sous 24h</span>
        </div>

        <h1 class="text-white font-extrabold mb-4 leading-tight"
            style="font-size:clamp(2rem,4vw,3.5rem);letter-spacing:-0.025em">
            Une question ? <span class="text-yellow-400">Parlons-en.</span>
        </h1>
        <p class="text-gray-400 text-lg max-w-xl mx-auto">
            Notre équipe est disponible pour vous accompagner, que vous soyez candidat, entreprise ou partenaire.
        </p>
    </div>
</section>

{{-- ═══════════════════════════════════════
     CONTENU PRINCIPAL
═══════════════════════════════════════ --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-10">

            {{-- ── Colonne gauche : infos ── --}}
            <div class="lg:col-span-2 space-y-5">

                {{-- Carte infos contact --}}
                <div class="bg-gray-950 rounded-2xl p-8 relative overflow-hidden">
                    <div class="absolute -bottom-12 -right-12 w-40 h-40 rounded-full pointer-events-none"
                         style="background:radial-gradient(circle,rgba(250,204,21,0.1),transparent 70%)"></div>
                    <div class="relative z-10">
                        <p class="text-yellow-400 text-xs font-extrabold tracking-widest uppercase mb-5">Nos coordonnées</p>
                        <div class="space-y-5">
                            @foreach([
                                ['icone' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'label' => 'Email', 'valeur' => 'contact@jobconnect.bj'],
                                ['icone' => 'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z', 'label' => 'Téléphone', 'valeur' => '+229 XX XX XX XX'],
                                ['icone' => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z', 'label' => 'Adresse', 'valeur' => 'Cotonou, Bénin — Quartier des affaires'],
                            ] as $info)
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-xl bg-yellow-400/10 flex items-center justify-center flex-shrink-0"
                                     style="border:1px solid rgba(250,204,21,0.2)">
                                    <svg class="w-4 h-4 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $info['icone'] }}"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-gray-500 text-xs font-semibold uppercase tracking-wide mb-0.5">{{ $info['label'] }}</p>
                                    <p class="text-white text-sm font-medium">{{ $info['valeur'] }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Horaires --}}
                <div class="bg-white border border-gray-200 rounded-2xl p-6">
                    <p class="text-gray-900 text-xs font-extrabold tracking-widest uppercase mb-4">Horaires d'ouverture</p>
                    <div class="space-y-3">
                        @foreach([
                            ['jour' => 'Lundi — Vendredi', 'heure' => '8h00 – 17h00', 'ouvert' => true],
                            ['jour' => 'Samedi',           'heure' => '9h00 – 13h00', 'ouvert' => true],
                            ['jour' => 'Dimanche',          'heure' => 'Fermé',        'ouvert' => false],
                        ] as $h)
                        <div class="flex items-center justify-between py-2 border-b border-gray-100 last:border-0">
                            <span class="text-sm text-gray-600">{{ $h['jour'] }}</span>
                            <span class="text-sm font-bold {{ $h['ouvert'] ? 'text-gray-900' : 'text-gray-400' }}">{{ $h['heure'] }}</span>
                        </div>
                        @endforeach
                    </div>
                    <div class="mt-4 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-green-400 inline-block animate-pulse"></span>
                        <span class="text-xs text-green-600 font-semibold">Disponible maintenant en ligne 24h/24</span>
                    </div>
                </div>

                {{-- Réseaux sociaux --}}
                <div class="bg-white border border-gray-200 rounded-2xl p-6">
                    <p class="text-gray-900 text-xs font-extrabold tracking-widest uppercase mb-4">Suivez-nous</p>
                    <div class="flex gap-3">
                        @foreach([
                            ['label' => 'Facebook',  'color' => '#1877F2', 'bg' => '#E7F0FD', 'path' => 'M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z'],
                            ['label' => 'LinkedIn',  'color' => '#0A66C2', 'bg' => '#E8F0F9', 'path' => 'M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z M4 6a2 2 0 100-4 2 2 0 000 4z'],
                            ['label' => 'Twitter',   'color' => '#000000', 'bg' => '#E7E7E7', 'path' => 'M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z'],
                            ['label' => 'WhatsApp',  'color' => '#25D366', 'bg' => '#E3F9EC', 'path' => 'M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347'],
                        ] as $social)
                        <a href="#"
                        aria-label="{{ $social['label'] }}"
                        class="social-btn w-10 h-10 rounded-xl border border-gray-200 flex items-center justify-center transition-all duration-200"
                        style="color:#6B7280;background:#F9FAFB"
                        data-color="{{ $social['color'] }}"
                        data-bg="{{ $social['bg'] }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="{{ $social['path'] }}"/>
                            </svg>
                        </a>
                        @endforeach
                    </div>
                </div>

                @push('scripts')
                <script>
                document.querySelectorAll('.social-btn').forEach(btn => {
                    const color = btn.dataset.color;
                    const bg    = btn.dataset.bg;
                    btn.addEventListener('mouseenter', () => {
                        btn.style.color      = color;
                        btn.style.background = bg;
                        btn.style.borderColor = color;
                        btn.style.transform  = 'translateY(-2px)';
                    });
                    btn.addEventListener('mouseleave', () => {
                        btn.style.color      = '#6B7280';
                        btn.style.background = '#F9FAFB';
                        btn.style.borderColor = '#E5E7EB';
                        btn.style.transform  = 'translateY(0)';
                    });
                });
                </script>
                @endpush
            </div>

            {{-- ── Colonne droite : formulaire ── --}}
            <div class="lg:col-span-3">
                <div class="bg-white border border-gray-200 rounded-2xl p-8 sm:p-10">

                    <div class="mb-8">
                        <p class="text-yellow-500 text-xs font-extrabold tracking-widest uppercase mb-2">Formulaire de contact</p>
                        <h2 class="text-gray-900 font-extrabold text-2xl" style="letter-spacing:-0.02em">Envoyez-nous un message</h2>
                        <p class="text-gray-500 text-sm mt-1">Nous vous répondons dans les 24 heures ouvrables.</p>
                    </div>

                    @if(session('success'))
                    <div class="mb-6 flex items-start gap-3 px-4 py-4 bg-green-50 border border-green-200 text-green-800 rounded-xl text-sm">
                        <svg class="w-5 h-5 flex-shrink-0 text-green-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <div>
                            <p class="font-bold">Message envoyé !</p>
                            <p class="text-green-700 text-xs mt-0.5">{{ session('success') }}</p>
                        </div>
                    </div>
                    @endif

                    <form method="POST" action="{{ route('contact.send') }}" class="space-y-5">
                        @csrf

                        {{-- Nom + Email --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nom complet</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    </span>
                                    <input type="text" name="name" value="{{ old('name') }}" required
                                           placeholder="Jean Dupont"
                                           class="w-full pl-11 pr-4 py-3 text-sm rounded-xl border bg-gray-50 text-gray-900 placeholder-gray-400 focus:outline-none focus:bg-white focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 transition-all
                                           @error('name') border-red-400 bg-red-50 @else border-gray-200 @enderror">
                                </div>
                                @error('name')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Adresse email</label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                    </span>
                                    <input type="email" name="email" value="{{ old('email') }}" required
                                           placeholder="votre@email.com"
                                           class="w-full pl-11 pr-4 py-3 text-sm rounded-xl border bg-gray-50 text-gray-900 placeholder-gray-400 focus:outline-none focus:bg-white focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 transition-all
                                           @error('email') border-red-400 bg-red-50 @else border-gray-200 @enderror">
                                </div>
                                @error('email')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Sujet --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Sujet</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                </span>
                                {{-- Select sujet --}}
                                <select name="sujet"
                                        class="w-full pl-11 pr-4 py-3 text-sm rounded-xl border border-gray-200 bg-gray-50 text-gray-900 focus:outline-none focus:bg-white focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 transition-all appearance-none
                                        @error('sujet') border-red-400 bg-red-50 @enderror">
                                    <option value="">Choisissez un sujet...</option>
                                    <option value="candidat"    {{ old('sujet') == 'candidat'    ? 'selected' : '' }}>Question candidat</option>
                                    <option value="entreprise"  {{ old('sujet') == 'entreprise'  ? 'selected' : '' }}>Question entreprise</option>
                                    <option value="technique"   {{ old('sujet') == 'technique'   ? 'selected' : '' }}>Problème technique</option>
                                    <option value="partenariat" {{ old('sujet') == 'partenariat' ? 'selected' : '' }}>Partenariat</option>
                                    <option value="autre"       {{ old('sujet') == 'autre'       ? 'selected' : '' }}>Autre</option>
                                </select>
                                <span class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </span>
                            </div>
                            @error('sujet')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Message --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Message</label>
                            <textarea name="message" rows="6" required
                                      placeholder="Décrivez votre demande en détail..."
                                      class="w-full px-4 py-3 text-sm rounded-xl border bg-gray-50 text-gray-900 placeholder-gray-400 focus:outline-none focus:bg-white focus:border-yellow-400 focus:ring-2 focus:ring-yellow-400/20 transition-all resize-none
                                      @error('message') border-red-400 bg-red-50 @else border-gray-200 @enderror">{{ old('message') }}</textarea>
                            <div class="flex justify-between items-center mt-1">
                                @error('message')
                                <p class="text-xs text-red-500">{{ $message }}</p>
                                @else
                                <span></span>
                                @enderror
                                <span id="char-count" class="text-xs text-gray-400 ml-auto">0 / 1000</span>
                            </div>
                        </div>

                        {{-- Submit --}}
                        <button type="submit"
                                class="w-full py-3.5 bg-gray-900 text-white font-extrabold rounded-xl text-sm flex items-center justify-center gap-2 hover:bg-yellow-400 hover:text-gray-900 transition-all duration-200">
                            Envoyer le message
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     FAQ RAPIDE
═══════════════════════════════════════ --}}
<section class="py-20 bg-white">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <p class="text-yellow-500 text-xs font-extrabold tracking-widest uppercase mb-3">Questions fréquentes</p>
            <h2 class="text-gray-900 font-extrabold text-3xl" style="letter-spacing:-0.02em">
                On répond à vos questions
            </h2>
        </div>

        <div class="space-y-3" id="faq">
            @foreach([
                ['q' => 'JobConnect est-il vraiment gratuit pour les candidats ?',     'r' => 'Oui, totalement. La création de compte, la consultation des offres et les candidatures sont entièrement gratuites pour les candidats, sans limite.'],
                ['q' => 'Comment mon entreprise peut-elle publier une offre ?',         'r' => 'Créez un compte entreprise, complétez votre profil, et attendez la validation de notre équipe (sous 24-48h). Une fois validé, publiez vos offres librement.'],
                ['q' => 'Comment fonctionne la réinitialisation du mot de passe ?',    'r' => 'Cliquez sur "Mot de passe oublié" sur la page de connexion, entrez votre email et vous recevrez un lien de réinitialisation valable 60 minutes.'],
                ['q' => 'Mes données personnelles sont-elles en sécurité ?',            'r' => 'Oui. Toutes vos données sont chiffrées et ne sont jamais revendues à des tiers. Seules les entreprises validées peuvent consulter les profils candidats.'],
                ['q' => 'Combien de temps prend le traitement d\'une candidature ?',    'r' => 'Cela dépend entièrement de l\'entreprise. Vous recevez une notification dès qu\'elle consulte votre dossier ou met à jour le statut de votre candidature.'],
            ] as $i => $item)
            <div class="faq-item border border-gray-200 rounded-2xl overflow-hidden">
                <button type="button"
                        class="faq-btn w-full flex items-center justify-between px-6 py-4 text-left hover:bg-gray-50 transition-colors"
                        onclick="toggleFaq(this)">
                    <span class="text-sm font-bold text-gray-900 pr-4">{{ $item['q'] }}</span>
                    <svg class="faq-icon w-5 h-5 text-gray-400 flex-shrink-0 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div class="faq-content hidden px-6 pb-5">
                    <p class="text-sm text-gray-500 leading-relaxed border-t border-gray-100 pt-4">{{ $item['r'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@push('scripts')
<script>
    // Compteur caractères textarea
    const textarea  = document.querySelector('textarea[name="message"]');
    const charCount = document.getElementById('char-count');
    if (textarea && charCount) {
        textarea.addEventListener('input', function () {
            const len = this.value.length;
            charCount.textContent = len + ' / 1000';
            charCount.className = 'text-xs ml-auto ' + (len > 900 ? 'text-red-400' : len > 700 ? 'text-yellow-500' : 'text-gray-400');
            if (len > 1000) this.value = this.value.substring(0, 1000);
        });
    }

    // FAQ accordion
    function toggleFaq(btn) {
        const content = btn.nextElementSibling;
        const icon    = btn.querySelector('.faq-icon');
        const isOpen  = !content.classList.contains('hidden');

        // Ferme tous
        document.querySelectorAll('.faq-content').forEach(c => c.classList.add('hidden'));
        document.querySelectorAll('.faq-icon').forEach(i => i.style.transform = 'rotate(0deg)');

        // Ouvre celui-ci si c'était fermé
        if (!isOpen) {
            content.classList.remove('hidden');
            icon.style.transform = 'rotate(180deg)';
        }
    }
</script>
@endpush

@endsection