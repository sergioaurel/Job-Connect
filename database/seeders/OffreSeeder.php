<?php

namespace Database\Seeders;

use App\Models\Offre;
use App\Models\Entreprise;
use App\Models\Categorie;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class OffreSeeder extends Seeder
{
    public function run(): void
    {
        // Récupérer toutes les entreprises et catégories
        $tech        = Entreprise::where('nom_entreprise', 'LIKE', '%TechSolutions%')->first();
        $compta      = Entreprise::where('nom_entreprise', 'LIKE', '%Expertise Comptable%')->first();
        $agri        = Entreprise::where('nom_entreprise', 'LIKE', '%AgriVert%')->first();
        $orange      = Entreprise::where('nom_entreprise', 'LIKE', '%Orange%')->first();
        $mtn         = Entreprise::where('nom_entreprise', 'LIKE', '%MTN%')->first();
        $bsic        = Entreprise::where('nom_entreprise', 'LIKE', '%BSIC%')->first();
        $orabank     = Entreprise::where('nom_entreprise', 'LIKE', '%Orabank%')->first();
        $ecobank     = Entreprise::where('nom_entreprise', 'LIKE', '%Ecobank%')->first();
        $juridique   = Entreprise::where('nom_entreprise', 'LIKE', '%Akpovi%')->first();
        $clinique    = Entreprise::where('nom_entreprise', 'LIKE', '%Sainte Marie%')->first();
        $ecole       = Entreprise::where('nom_entreprise', 'LIKE', '%Excellence%')->first();
        $btp         = Entreprise::where('nom_entreprise', 'LIKE', '%BTP Construct%')->first();
        $logis       = Entreprise::where('nom_entreprise', 'LIKE', '%LogisTrans%')->first();
        $hotel       = Entreprise::where('nom_entreprise', 'LIKE', '%Azalaï%')->first();
        $digital     = Entreprise::where('nom_entreprise', 'LIKE', '%BeninWeb%')->first();
        $soneb       = Entreprise::where('nom_entreprise', 'LIKE', '%SONEB%')->first();
        $studio      = Entreprise::where('nom_entreprise', 'LIKE', '%Voodoo%')->first();
        $assurance   = Entreprise::where('nom_entreprise', 'LIKE', '%Assuri%')->first();
        $foodtech    = Entreprise::where('nom_entreprise', 'LIKE', '%FoodTech%')->first();
        $energie     = Entreprise::where('nom_entreprise', 'LIKE', '%EnergieSolaire%')->first();
        $microfinance = Entreprise::where('nom_entreprise', 'LIKE', '%Alafia%')->first();

        $catIT       = Categorie::where('nom', 'Informatique et Technologies')->first();
        $catCompta   = Categorie::where('nom', 'Finance et Comptabilité')->first();
        $catAgri     = Categorie::where('nom', 'Agriculture et Environnement')->first();
        $catMarketing = Categorie::where('nom', 'Marketing et Communication')->first();
        $catBanque   = Categorie::where('nom', 'Banque et Assurance')->first();
        $catSante    = Categorie::where('nom', 'Santé et Médical')->first();
        $catEdu      = Categorie::where('nom', 'Éducation et Formation')->first();
        $catBTP      = Categorie::where('nom', 'Ingénierie et BTP')->first();
        $catTransport = Categorie::where('nom', 'Transport et Logistique')->first();
        $catHotel    = Categorie::where('nom', 'Hôtellerie et Restauration')->first();
        $catRH       = Categorie::where('nom', 'Ressources Humaines')->first();
        $catJuridique = Categorie::where('nom', 'Juridique et Droit')->first();
        $catCommerce = Categorie::where('nom', 'Commerce et Vente')->first();
        $catArt      = Categorie::where('nom', 'Art et Design')->first();
        $catAdmin    = Categorie::where('nom', 'Administration et Secrétariat')->first();

        $offres = [
            // ── OFFRES D'EMPLOI ──────────────────────────────────────────
            [
                'entreprise' => $tech, 'categorie' => $catIT,
                'titre' => 'Développeur Laravel Senior',
                'type_offre' => 'emploi', 'type_contrat' => 'CDI',
                'description' => 'Nous recherchons un développeur Laravel expérimenté pour rejoindre notre équipe.',
                'missions' => "- Développer des applications web avec Laravel\n- Participer à la conception technique\n- Assurer la maintenance des projets existants\n- Former les développeurs juniors",
                'profil_recherche' => "- Minimum 3 ans d'expérience en Laravel\n- Maîtrise de PHP, MySQL, JavaScript\n- Connaissance de Git",
                'competences_requises' => 'Laravel, PHP, MySQL, JavaScript, Git',
                'niveau_etude' => 'Licence/Master en Informatique',
                'annees_experience' => 3, 'ville' => 'Cotonou',
                'salaire_min' => '250000', 'salaire_max' => '400000', 'salaire_a_negocier' => false,
                'nombre_postes' => 2, 'date_limite' => Carbon::now()->addDays(30),
                'statut' => 'active', 'vues' => 45,
            ],
            [
                'entreprise' => $orange, 'categorie' => $catIT,
                'titre' => 'Ingénieur Réseau et Télécoms',
                'type_offre' => 'emploi', 'type_contrat' => 'CDI',
                'description' => 'Orange Bénin recrute un ingénieur réseau pour renforcer son équipe technique.',
                'missions' => "- Gérer et optimiser le réseau mobile\n- Déployer les nouvelles infrastructures\n- Assurer la supervision et la maintenance",
                'profil_recherche' => "- Diplôme ingénieur en télécoms\n- 2 ans d'expérience minimum\n- Maîtrise des protocoles réseau",
                'competences_requises' => 'Réseaux IP, 4G/5G, Cisco, supervision réseau',
                'niveau_etude' => 'Master en Télécommunications',
                'annees_experience' => 2, 'ville' => 'Cotonou',
                'salaire_min' => '400000', 'salaire_max' => '600000', 'salaire_a_negocier' => true,
                'nombre_postes' => 1, 'date_limite' => Carbon::now()->addDays(45),
                'statut' => 'active', 'vues' => 89,
            ],
            [
                'entreprise' => $compta, 'categorie' => $catCompta,
                'titre' => 'Comptable Confirmé',
                'type_offre' => 'emploi', 'type_contrat' => 'CDI',
                'description' => 'Notre cabinet recrute un comptable confirmé pour renforcer notre équipe.',
                'missions' => "- Tenir la comptabilité générale\n- Établir les déclarations fiscales\n- Préparer les bilans et comptes de résultat",
                'profil_recherche' => "- Diplôme en comptabilité\n- 2 ans d'expérience minimum\n- Maîtrise de Sage",
                'competences_requises' => 'Comptabilité générale, Sage, Excel, Fiscalité',
                'niveau_etude' => 'Licence/Master en Comptabilité',
                'annees_experience' => 2, 'ville' => 'Cotonou',
                'salaire_min' => '200000', 'salaire_max' => '300000', 'salaire_a_negocier' => true,
                'nombre_postes' => 1, 'date_limite' => Carbon::now()->addDays(25),
                'statut' => 'active', 'vues' => 62,
            ],
            [
                'entreprise' => $ecobank, 'categorie' => $catBanque,
                'titre' => 'Chargé de Clientèle Particuliers',
                'type_offre' => 'emploi', 'type_contrat' => 'CDI',
                'description' => 'Ecobank Bénin recherche un chargé de clientèle dynamique pour sa direction commerciale.',
                'missions' => "- Gérer et développer un portefeuille clients\n- Proposer des produits bancaires adaptés\n- Atteindre les objectifs commerciaux",
                'profil_recherche' => "- Formation en banque/finance\n- Bon relationnel\n- Orienté résultats",
                'competences_requises' => 'Relation client, Produits bancaires, Négociation',
                'niveau_etude' => 'Licence en Finance ou Commerce',
                'annees_experience' => 1, 'ville' => 'Cotonou',
                'salaire_min' => '180000', 'salaire_max' => '280000', 'salaire_a_negocier' => false,
                'nombre_postes' => 3, 'date_limite' => Carbon::now()->addDays(20),
                'statut' => 'active', 'vues' => 112,
            ],
            [
                'entreprise' => $clinique, 'categorie' => $catSante,
                'titre' => 'Médecin Généraliste',
                'type_offre' => 'emploi', 'type_contrat' => 'CDI',
                'description' => 'La Clinique Sainte Marie recrute un médecin généraliste pour renforcer son équipe médicale.',
                'missions' => "- Assurer les consultations médicales\n- Suivre les patients hospitalisés\n- Participer aux gardes de nuit",
                'profil_recherche' => "- Docteur en médecine\n- Inscrit à l'Ordre des Médecins du Bénin\n- Expérience souhaitée",
                'competences_requises' => 'Médecine générale, Urgences, Pédiatrie',
                'niveau_etude' => 'Doctorat en Médecine',
                'annees_experience' => 0, 'ville' => 'Cotonou',
                'salaire_min' => '500000', 'salaire_max' => '800000', 'salaire_a_negocier' => true,
                'nombre_postes' => 2, 'date_limite' => Carbon::now()->addDays(60),
                'statut' => 'active', 'vues' => 78,
            ],
            [
                'entreprise' => $btp, 'categorie' => $catBTP,
                'titre' => 'Ingénieur Génie Civil',
                'type_offre' => 'emploi', 'type_contrat' => 'CDI',
                'description' => 'BTP Construct recrute un ingénieur génie civil pour ses projets de construction.',
                'missions' => "- Superviser les chantiers de construction\n- Vérifier la conformité des travaux\n- Gérer les équipes sur le terrain",
                'profil_recherche' => "- Ingénieur génie civil\n- 3 ans d'expérience chantier\n- Maîtrise des logiciels BTP",
                'competences_requises' => 'Génie civil, AutoCAD, Management chantier',
                'niveau_etude' => 'Master en Génie Civil',
                'annees_experience' => 3, 'ville' => 'Cotonou',
                'salaire_min' => '350000', 'salaire_max' => '500000', 'salaire_a_negocier' => true,
                'nombre_postes' => 2, 'date_limite' => Carbon::now()->addDays(35),
                'statut' => 'active', 'vues' => 55,
            ],
            [
                'entreprise' => $digital, 'categorie' => $catMarketing,
                'titre' => 'Community Manager Senior',
                'type_offre' => 'emploi', 'type_contrat' => 'CDI',
                'description' => 'BeninWeb Digital Agency cherche un community manager expérimenté pour gérer les réseaux sociaux de ses clients.',
                'missions' => "- Créer et planifier du contenu pour les réseaux sociaux\n- Animer les communautés en ligne\n- Analyser les performances et faire des rapports",
                'profil_recherche' => "- 2 ans d'expérience en community management\n- Créativité et sens du storytelling\n- Maîtrise des outils de scheduling",
                'competences_requises' => 'Réseaux sociaux, Canva, Meta Ads, Analytics',
                'niveau_etude' => 'Licence en Marketing/Communication',
                'annees_experience' => 2, 'ville' => 'Cotonou',
                'salaire_min' => '150000', 'salaire_max' => '250000', 'salaire_a_negocier' => false,
                'nombre_postes' => 1, 'date_limite' => Carbon::now()->addDays(15),
                'statut' => 'active', 'vues' => 143,
            ],
            [
                'entreprise' => $logis, 'categorie' => $catTransport,
                'titre' => 'Responsable Logistique',
                'type_offre' => 'emploi', 'type_contrat' => 'CDI',
                'description' => 'LogisTrans Bénin recrute un responsable logistique pour optimiser sa chaîne d\'approvisionnement.',
                'missions' => "- Gérer les flux de marchandises\n- Optimiser les coûts logistiques\n- Superviser l'équipe entrepôt",
                'profil_recherche' => "- Formation en logistique/supply chain\n- 3 ans d'expérience\n- Sens de l'organisation",
                'competences_requises' => 'Supply chain, WMS, Excel, Management',
                'niveau_etude' => 'Licence en Logistique',
                'annees_experience' => 3, 'ville' => 'Cotonou',
                'salaire_min' => '280000', 'salaire_max' => '380000', 'salaire_a_negocier' => false,
                'nombre_postes' => 1, 'date_limite' => Carbon::now()->addDays(28),
                'statut' => 'active', 'vues' => 67,
            ],
            [
                'entreprise' => $hotel, 'categorie' => $catHotel,
                'titre' => 'Réceptionniste Bilingue',
                'type_offre' => 'emploi', 'type_contrat' => 'CDI',
                'description' => 'L\'Hôtel Azalaï recrute une réceptionniste bilingue français/anglais pour son service d\'accueil.',
                'missions' => "- Accueillir les clients à leur arrivée\n- Gérer les réservations et le check-in/out\n- Répondre aux demandes des clients",
                'profil_recherche' => "- Formation hôtellerie ou équivalent\n- Bilingue français/anglais\n- Excellente présentation",
                'competences_requises' => 'Accueil, Anglais courant, Logiciel hôtelier',
                'niveau_etude' => 'BTS Hôtellerie ou équivalent',
                'annees_experience' => 1, 'ville' => 'Cotonou',
                'salaire_min' => '120000', 'salaire_max' => '180000', 'salaire_a_negocier' => false,
                'nombre_postes' => 2, 'date_limite' => Carbon::now()->addDays(20),
                'statut' => 'active', 'vues' => 95,
            ],
            [
                'entreprise' => $studio, 'categorie' => $catArt,
                'titre' => 'Graphiste UI/UX Designer',
                'type_offre' => 'emploi', 'type_contrat' => 'CDI',
                'description' => 'Studio Créatif Voodoo recherche un graphiste UI/UX pour concevoir des interfaces web et mobiles attractives.',
                'missions' => "- Concevoir des interfaces utilisateur\n- Créer des maquettes et prototypes\n- Collaborer avec les développeurs",
                'profil_recherche' => "- Portfolio solide\n- Maîtrise de Figma et Adobe Suite\n- Sensibilité esthétique",
                'competences_requises' => 'Figma, Adobe Illustrator, Photoshop, UI/UX',
                'niveau_etude' => 'Licence en Design ou équivalent',
                'annees_experience' => 2, 'ville' => 'Cotonou',
                'salaire_min' => '200000', 'salaire_max' => '320000', 'salaire_a_negocier' => true,
                'nombre_postes' => 1, 'date_limite' => Carbon::now()->addDays(25),
                'statut' => 'active', 'vues' => 187,
            ],

            // ── STAGES PROFESSIONNELS ─────────────────────────────────────
            [
                'entreprise' => $tech, 'categorie' => $catIT,
                'titre' => 'Stage Pro - Développeur Web Junior',
                'type_offre' => 'stage_professionnel', 'type_contrat' => 'stage',
                'description' => 'Stage rémunéré de 6 mois pour développeurs web débutants.',
                'missions' => "- Participer au développement de sites web\n- Corriger les bugs et effectuer les tests\n- Travailler en équipe avec des seniors",
                'profil_recherche' => "- Formation en développement web\n- Connaissances de base en HTML, CSS, JavaScript\n- Motivation et envie d'apprendre",
                'competences_requises' => 'HTML/CSS, JavaScript, bases PHP',
                'niveau_etude' => 'BTS/Licence en cours ou obtenu',
                'annees_experience' => 0, 'ville' => 'Cotonou',
                'salaire_min' => '75000', 'salaire_max' => '75000', 'salaire_a_negocier' => false,
                'nombre_postes' => 3, 'date_limite' => Carbon::now()->addDays(20),
                'statut' => 'active', 'vues' => 78,
            ],
            [
                'entreprise' => $orabank, 'categorie' => $catBanque,
                'titre' => 'Stage Pro - Assistant Analyste Crédit',
                'type_offre' => 'stage_professionnel', 'type_contrat' => 'stage',
                'description' => 'Stage de 6 mois au sein de la direction des engagements d\'Orabank.',
                'missions' => "- Analyser les dossiers de crédit\n- Préparer les comités de crédit\n- Rédiger les notes d'analyse",
                'profil_recherche' => "- Formation en finance/banque\n- Capacité d'analyse\n- Rigueur",
                'competences_requises' => 'Analyse financière, Excel, Rédaction',
                'niveau_etude' => 'Licence/Master Finance en cours',
                'annees_experience' => 0, 'ville' => 'Cotonou',
                'salaire_min' => '60000', 'salaire_max' => '80000', 'salaire_a_negocier' => false,
                'nombre_postes' => 2, 'date_limite' => Carbon::now()->addDays(30),
                'statut' => 'active', 'vues' => 134,
            ],
            [
                'entreprise' => $mtn, 'categorie' => $catMarketing,
                'titre' => 'Stage Pro - Chargé Marketing Digital',
                'type_offre' => 'stage_professionnel', 'type_contrat' => 'stage',
                'description' => 'Stage de 4 mois au sein de l\'équipe marketing de MTN Bénin.',
                'missions' => "- Assister dans la gestion des campagnes digitales\n- Analyser les performances des actions marketing\n- Créer du contenu pour les réseaux sociaux",
                'profil_recherche' => "- Formation en marketing digital\n- Bonne maîtrise des réseaux sociaux\n- Créativité",
                'competences_requises' => 'Marketing digital, Canva, Google Analytics',
                'niveau_etude' => 'Licence Marketing en cours ou obtenu',
                'annees_experience' => 0, 'ville' => 'Cotonou',
                'salaire_min' => '70000', 'salaire_max' => '70000', 'salaire_a_negocier' => false,
                'nombre_postes' => 2, 'date_limite' => Carbon::now()->addDays(18),
                'statut' => 'active', 'vues' => 201,
            ],
            [
                'entreprise' => $agri, 'categorie' => $catAgri,
                'titre' => 'Stage Pro - Technicien Agricole',
                'type_offre' => 'stage_professionnel', 'type_contrat' => 'stage',
                'description' => 'Stage de terrain de 6 mois en production maraîchère biologique.',
                'missions' => "- Participer aux activités de production\n- Apprendre les techniques bio\n- Suivre les cultures",
                'profil_recherche' => "- Formation en agronomie\n- Intérêt pour l'agriculture bio\n- Résistance physique",
                'competences_requises' => 'Agriculture, Botanique, Terrain',
                'niveau_etude' => 'BTS/Licence Agronomie',
                'annees_experience' => 0, 'ville' => 'Parakou',
                'salaire_min' => '50000', 'salaire_max' => '60000', 'salaire_a_negocier' => false,
                'nombre_postes' => 2, 'date_limite' => Carbon::now()->addDays(22),
                'statut' => 'active', 'vues' => 44,
            ],
            [
                'entreprise' => $soneb, 'categorie' => $catBTP,
                'titre' => 'Stage Pro - Technicien Génie Hydraulique',
                'type_offre' => 'stage_professionnel', 'type_contrat' => 'stage',
                'description' => 'Stage de 6 mois à la direction technique de la SONEB.',
                'missions' => "- Participer à la supervision des réseaux d'eau\n- Assister aux inspections terrain\n- Rédiger des rapports techniques",
                'profil_recherche' => "- Formation en génie hydraulique ou génie civil\n- Rigueur et sens du terrain",
                'competences_requises' => 'Hydraulique, AutoCAD, Rapports techniques',
                'niveau_etude' => 'Licence en Génie Hydraulique',
                'annees_experience' => 0, 'ville' => 'Cotonou',
                'salaire_min' => '65000', 'salaire_max' => '65000', 'salaire_a_negocier' => false,
                'nombre_postes' => 3, 'date_limite' => Carbon::now()->addDays(40),
                'statut' => 'active', 'vues' => 58,
            ],

            // ── STAGES ACADÉMIQUES ────────────────────────────────────────
            [
                'entreprise' => $tech, 'categorie' => $catMarketing,
                'titre' => 'Stage Académique - Assistant Marketing Digital',
                'type_offre' => 'stage_academique', 'type_contrat' => 'stage',
                'description' => 'Stage académique de 3 mois pour étudiant en Marketing.',
                'missions' => "- Assister dans les campagnes digitales\n- Gérer les réseaux sociaux\n- Créer du contenu avec Canva",
                'profil_recherche' => "- Étudiant en Licence/Master Marketing\n- Créativité\n- Disponibilité 3 à 6 mois",
                'competences_requises' => 'Réseaux sociaux, Canva, Communication',
                'niveau_etude' => 'Licence en cours - Marketing',
                'annees_experience' => 0, 'ville' => 'Cotonou',
                'salaire_min' => null, 'salaire_max' => null, 'salaire_a_negocier' => false,
                'nombre_postes' => 2, 'date_limite' => Carbon::now()->addDays(15),
                'statut' => 'active', 'vues' => 134,
            ],
            [
                'entreprise' => $juridique, 'categorie' => $catJuridique,
                'titre' => 'Stage Académique - Assistant Juridique',
                'type_offre' => 'stage_academique', 'type_contrat' => 'stage',
                'description' => 'Stage de fin d\'études en droit des affaires au sein du cabinet Akpovi.',
                'missions' => "- Assister à la rédaction de contrats\n- Effectuer des recherches juridiques\n- Préparer des plaidoiries",
                'profil_recherche' => "- Étudiant en Master Droit\n- Excellentes capacités rédactionnelles",
                'competences_requises' => 'Droit des affaires, Rédaction juridique, Recherche',
                'niveau_etude' => 'Master Droit en cours',
                'annees_experience' => 0, 'ville' => 'Cotonou',
                'salaire_min' => null, 'salaire_max' => null, 'salaire_a_negocier' => false,
                'nombre_postes' => 1, 'date_limite' => Carbon::now()->addDays(30),
                'statut' => 'active', 'vues' => 76,
            ],
            [
                'entreprise' => $foodtech, 'categorie' => $catIT,
                'titre' => 'Stage Académique - Développeur Mobile React Native',
                'type_offre' => 'stage_academique', 'type_contrat' => 'stage',
                'description' => 'Stage de fin de cycle pour développer des fonctionnalités sur l\'application FoodTech.',
                'missions' => "- Développer des fonctionnalités React Native\n- Intégrer les APIs backend\n- Tester et corriger les bugs",
                'profil_recherche' => "- Étudiant en informatique\n- Connaissances React Native ou React\n- Curieux et autonome",
                'competences_requises' => 'React Native, JavaScript, API REST',
                'niveau_etude' => 'Licence/Master Informatique en cours',
                'annees_experience' => 0, 'ville' => 'Porto-Novo',
                'salaire_min' => null, 'salaire_max' => null, 'salaire_a_negocier' => false,
                'nombre_postes' => 2, 'date_limite' => Carbon::now()->addDays(25),
                'statut' => 'active', 'vues' => 223,
            ],
            [
                'entreprise' => $assurance, 'categorie' => $catBanque,
                'titre' => 'Stage Académique - Assistant Actuariat',
                'type_offre' => 'stage_academique', 'type_contrat' => 'stage',
                'description' => 'Stage de 3 mois au sein du département actuariat d\'AssuriBénin.',
                'missions' => "- Participer aux calculs actuariels\n- Analyser les données sinistres\n- Contribuer aux rapports de risque",
                'profil_recherche' => "- Étudiant en mathématiques ou statistiques\n- Maîtrise d'Excel et R\n- Rigueur analytique",
                'competences_requises' => 'Statistiques, Excel, R, Modélisation',
                'niveau_etude' => 'Master Mathématiques/Statistiques en cours',
                'annees_experience' => 0, 'ville' => 'Cotonou',
                'salaire_min' => null, 'salaire_max' => null, 'salaire_a_negocier' => false,
                'nombre_postes' => 1, 'date_limite' => Carbon::now()->addDays(35),
                'statut' => 'active', 'vues' => 89,
            ],
            [
                'entreprise' => $energie, 'categorie' => $catBTP,
                'titre' => 'Stage Académique - Assistant Technicien Énergie Solaire',
                'type_offre' => 'stage_academique', 'type_contrat' => 'stage',
                'description' => 'Stage de 3 mois pour étudiant en énergie ou électrotechnique.',
                'missions' => "- Assister à l'installation de panneaux solaires\n- Effectuer des audits énergétiques\n- Rédiger des rapports d'intervention",
                'profil_recherche' => "- Étudiant en génie électrique ou énergétique\n- Intérêt pour les énergies renouvelables",
                'competences_requises' => 'Électrotechnique, Énergie solaire, Terrain',
                'niveau_etude' => 'Licence Génie Électrique en cours',
                'annees_experience' => 0, 'ville' => 'Parakou',
                'salaire_min' => null, 'salaire_max' => null, 'salaire_a_negocier' => false,
                'nombre_postes' => 2, 'date_limite' => Carbon::now()->addDays(20),
                'statut' => 'active', 'vues' => 51,
            ],

            // ── OFFRE POURVUE (pour test) ─────────────────────────────────
            [
                'entreprise' => $compta, 'categorie' => $catCompta,
                'titre' => 'Assistant Comptable (Poste Pourvu)',
                'type_offre' => 'emploi', 'type_contrat' => 'CDD',
                'description' => 'Poste d\'assistant comptable - Recrutement terminé.',
                'missions' => 'Saisie comptable, classement documents, déclarations',
                'profil_recherche' => 'BTS Comptabilité minimum',
                'niveau_etude' => 'BTS',
                'annees_experience' => 0, 'ville' => 'Cotonou',
                'salaire_min' => '100000', 'salaire_max' => '120000', 'salaire_a_negocier' => false,
                'nombre_postes' => 1, 'date_limite' => Carbon::now()->subDays(5),
                'statut' => 'pourvue', 'vues' => 156,
            ],
        ];

        foreach ($offres as $offre) {
            $entreprise = $offre['entreprise'];
            $categorie  = $offre['categorie'];

            if (!$entreprise || !$categorie) continue;

            Offre::create([
                'entreprise_id'        => $entreprise->id,
                'categorie_id'         => $categorie->id,
                'titre'                => $offre['titre'],
                'type_offre'           => $offre['type_offre'],
                'type_contrat'         => $offre['type_contrat'],
                'description'          => $offre['description'],
                'missions'             => $offre['missions'],
                'profil_recherche'     => $offre['profil_recherche'],
                'competences_requises' => $offre['competences_requises'] ?? null,
                'niveau_etude'         => $offre['niveau_etude'],
                'annees_experience'    => $offre['annees_experience'],
                'ville'                => $offre['ville'],
                'salaire_min'          => $offre['salaire_min'] ?? null,
                'salaire_max'          => $offre['salaire_max'] ?? null,
                'salaire_a_negocier'   => $offre['salaire_a_negocier'],
                'nombre_postes'        => $offre['nombre_postes'],
                'date_limite'          => $offre['date_limite'],
                'statut'               => $offre['statut'],
                'vues'                 => $offre['vues'],
            ]);
        }
    }
}