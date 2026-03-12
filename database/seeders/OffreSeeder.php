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
        // Récupérer les entreprises et catégories
        $techSolutions = Entreprise::where('nom_entreprise', 'TechSolutions Bénin')->first();
        $cabinetCompta = Entreprise::where('nom_entreprise', 'LIKE', '%Expertise Comptable%')->first();
        $agriVert = Entreprise::where('nom_entreprise', 'LIKE', '%AgriVert%')->first();

        $catIT = Categorie::where('nom', 'Informatique et Technologies')->first();
        $catCompta = Categorie::where('nom', 'Finance et Comptabilité')->first();
        $catAgri = Categorie::where('nom', 'Agriculture et Environnement')->first();
        $catMarketing = Categorie::where('nom', 'Marketing et Communication')->first();

        // Offre 1: Développeur Laravel (Emploi)
        if ($techSolutions && $catIT) {
            Offre::create([
                'entreprise_id' => $techSolutions->id,
                'categorie_id' => $catIT->id,
                'titre' => 'Développeur Laravel Senior',
                'type_offre' => 'emploi',
                'type_contrat' => 'CDI',
                'description' => 'Nous recherchons un développeur Laravel expérimenté pour rejoindre notre équipe de développement.',
                'missions' => "- Développer des applications web avec Laravel\n- Participer à la conception technique\n- Assurer la maintenance des projets existants\n- Former les développeurs juniors\n- Contribuer à l'amélioration des processus de développement",
                'profil_recherche' => "- Minimum 3 ans d'expérience en développement Laravel\n- Maîtrise de PHP, MySQL, JavaScript\n- Connaissance de Git et des méthodologies Agile\n- Capacité à travailler en équipe\n- Bon niveau de français",
                'competences_requises' => 'Laravel, PHP, MySQL, JavaScript, Git, API REST',
                'niveau_etude' => 'Licence/Master en Informatique',
                'annees_experience' => 3,
                'ville' => 'Cotonou',
                'salaire_min' => '250000',
                'salaire_max' => '400000',
                'salaire_a_negocier' => false,
                'nombre_postes' => 2,
                'date_limite' => Carbon::now()->addDays(30),
                'statut' => 'active',
                'vues' => 45,
            ]);
        }

        // Offre 2: Stage Professionnel - Développeur Web
        if ($techSolutions && $catIT) {
            Offre::create([
                'entreprise_id' => $techSolutions->id,
                'categorie_id' => $catIT->id,
                'titre' => 'Stage Professionnel - Développeur Web Junior',
                'type_offre' => 'stage_professionnel',
                'type_contrat' => 'stage',
                'description' => 'Stage rémunéré de 6 mois pour développeurs web débutants souhaitant acquérir une expérience professionnelle solide.',
                'missions' => "- Participer au développement de sites web\n- Corriger les bugs et effectuer les tests\n- Apprendre les bonnes pratiques de développement\n- Travailler en équipe avec des développeurs seniors",
                'profil_recherche' => "- Formation en développement web (BTS, Licence)\n- Connaissances de base en HTML, CSS, JavaScript\n- Motivation et envie d'apprendre\n- Capacité d'adaptation",
                'competences_requises' => 'HTML/CSS, JavaScript, bases PHP',
                'niveau_etude' => 'BTS/Licence en cours ou obtenu',
                'annees_experience' => 0,
                'ville' => 'Cotonou',
                'salaire_min' => '75000',
                'salaire_max' => '75000',
                'salaire_a_negocier' => false,
                'nombre_postes' => 3,
                'date_limite' => Carbon::now()->addDays(20),
                'statut' => 'active',
                'vues' => 78,
            ]);
        }

        // Offre 3: Comptable (Emploi)
        if ($cabinetCompta && $catCompta) {
            Offre::create([
                'entreprise_id' => $cabinetCompta->id,
                'categorie_id' => $catCompta->id,
                'titre' => 'Comptable Confirmé',
                'type_offre' => 'emploi',
                'type_contrat' => 'CDI',
                'description' => 'Notre cabinet recrute un comptable confirmé pour renforcer notre équipe.',
                'missions' => "- Tenir la comptabilité générale des clients\n- Établir les déclarations fiscales et sociales\n- Préparer les bilans et comptes de résultat\n- Conseiller les clients sur leur gestion\n- Assurer le suivi de la trésorerie",
                'profil_recherche' => "- Diplôme en comptabilité (minimum Licence)\n- 2 ans d'expérience minimum en cabinet ou entreprise\n- Maîtrise des logiciels comptables (Sage, Ciel)\n- Excellente maîtrise d'Excel\n- Rigueur et sens de l'organisation",
                'competences_requises' => 'Comptabilité générale, Sage, Excel, Fiscalité',
                'niveau_etude' => 'Licence/Master en Comptabilité',
                'annees_experience' => 2,
                'ville' => 'Cotonou',
                'salaire_min' => '200000',
                'salaire_max' => '300000',
                'salaire_a_negocier' => true,
                'nombre_postes' => 1,
                'date_limite' => Carbon::now()->addDays(25),
                'statut' => 'active',
                'vues' => 62,
            ]);
        }

        // Offre 4: Stage Académique - Assistant Marketing
        if ($techSolutions && $catMarketing) {
            Offre::create([
                'entreprise_id' => $techSolutions->id,
                'categorie_id' => $catMarketing->id,
                'titre' => 'Stage Académique - Assistant Marketing Digital',
                'type_offre' => 'stage_academique',
                'type_contrat' => 'stage',
                'description' => 'Stage académique de 3 mois pour étudiant en Marketing souhaitant compléter sa formation universitaire.',
                'missions' => "- Assister l'équipe marketing dans les campagnes digitales\n- Gérer les réseaux sociaux de l'entreprise\n- Créer du contenu visuel avec Canva\n- Participer aux études de marché\n- Rédiger des rapports d'activité",
                'profil_recherche' => "- Étudiant en Licence/Master Marketing\n- Bonnes connaissances des réseaux sociaux\n- Créativité et sens de la communication\n- Maîtrise de Canva ou outils similaires\n- Disponibilité de 3 à 6 mois",
                'competences_requises' => 'Réseaux sociaux, Canva, Communication',
                'niveau_etude' => 'Licence en cours - Marketing',
                'annees_experience' => 0,
                'ville' => 'Cotonou',
                'salaire_min' => null,
                'salaire_max' => null,
                'salaire_a_negocier' => false,
                'nombre_postes' => 2,
                'date_limite' => Carbon::now()->addDays(15),
                'statut' => 'active',
                'vues' => 134,
            ]);
        }

        // Offre 5: Technicien Agricole
        if ($agriVert && $catAgri) {
            Offre::create([
                'entreprise_id' => $agriVert->id,
                'categorie_id' => $catAgri->id,
                'titre' => 'Technicien Agricole - Production Maraîchère',
                'type_offre' => 'emploi',
                'type_contrat' => 'CDD',
                'description' => 'Nous recherchons un technicien agricole pour superviser notre production de légumes biologiques.',
                'missions' => "- Superviser les activités de production maraîchère\n- Former et encadrer les ouvriers agricoles\n- Assurer le suivi technique des cultures\n- Gérer les intrants et le planning cultural\n- Veiller au respect des normes bio",
                'profil_recherche' => "- Formation en agriculture/agronomie\n- Expérience en production maraîchère\n- Connaissance des techniques bio\n- Sens du leadership\n- Disponibilité immédiate",
                'competences_requises' => 'Techniques culturales, Agriculture bio, Management',
                'niveau_etude' => 'BTS/Licence Agricole',
                'annees_experience' => 1,
                'ville' => 'Parakou',
                'salaire_min' => '150000',
                'salaire_max' => '200000',
                'salaire_a_negocier' => false,
                'nombre_postes' => 1,
                'date_limite' => Carbon::now()->addDays(10),
                'statut' => 'active',
                'vues' => 23,
            ]);
        }

        // Offre 6: Offre fermée (pour test)
        if ($cabinetCompta && $catCompta) {
            Offre::create([
                'entreprise_id' => $cabinetCompta->id,
                'categorie_id' => $catCompta->id,
                'titre' => 'Assistant Comptable (Poste Pourvu)',
                'type_offre' => 'emploi',
                'type_contrat' => 'CDD',
                'description' => 'Poste d\'assistant comptable - Recrutement terminé',
                'missions' => 'Saisie comptable, classement documents, déclarations',
                'profil_recherche' => 'BTS Comptabilité minimum',
                'niveau_etude' => 'BTS',
                'annees_experience' => 0,
                'ville' => 'Cotonou',
                'salaire_min' => '100000',
                'salaire_max' => '120000',
                'nombre_postes' => 1,
                'date_limite' => Carbon::now()->subDays(5),
                'statut' => 'pourvue',
                'vues' => 156,
            ]);
        }
    }
}