<?php

namespace Database\Seeders;

use App\Models\Competence;
use Illuminate\Database\Seeder;

class CompetenceSeeder extends Seeder
{
    public function run(): void
    {
        // ==============================
        // COMPETENCES TECHNIQUES
        // ==============================

        $competencesTechniques = [

            // ===== Développement Web =====
            'PHP','Laravel','JavaScript','React','Vue.js','Node.js',
            'HTML/CSS','Tailwind CSS','Bootstrap',
            'MySQL','PostgreSQL','Git','API REST','WordPress',

            // ===== Programmation / IT =====
            'Python','Java','C#','.NET','Android','iOS','Flutter',
            'Cybersécurité','Réseaux','Cloud (AWS/Azure)',
            'Docker','Linux','Windows Server',

            // ===== Design =====
            'Photoshop','Illustrator','InDesign','Figma',
            'Adobe XD','After Effects','Canva','Montage vidéo',

            // ===== Marketing =====
            'Google Ads','Facebook Ads','SEO','SEA',
            'Google Analytics','Social Media Marketing',
            'Email Marketing',

            // ===== Bureautique =====
            'Pack Office','Excel','Excel avancé',
            'Word','PowerPoint','Google Workspace',
            'Sage','SAP','ERP',

            // ===== Finance =====
            'Comptabilité générale',
            'Comptabilité analytique',
            'Audit',
            'Fiscalité',
            'Contrôle de gestion',

            // ===== BTP =====
            'Maçonnerie',
            'Plomberie',
            'Électricité bâtiment',
            'Peinture bâtiment',
            'Menuiserie',
            'Carrelage',
            'Soudure',
            'Lecture de plans',
            'Topographie',
            'Conduite d’engins',
            'Génie civil',
            'Architecture',
            'AutoCAD',
            'Revit',
            'SketchUp',

            // ===== Transport =====
            'Conduite automobile',
            'Conduite poids lourd',
            'Logistique',
            'Gestion de stock',
            'Livraison',
            'Maintenance mécanique',
            'Mécanique automobile',
            'Électricité automobile',

            // ===== Industrie =====
            'Maintenance industrielle',
            'Électromécanique',
            'Automatisme',
            'Hydraulique',
            'Pneumatique',
            'Production industrielle',

            // ===== Santé =====
            'Soins infirmiers',
            'Aide-soignant',
            'Pharmacie',
            'Laboratoire',
            'Hygiène hospitalière',

            // ===== Sécurité =====
            'Sécurité privée',
            'Surveillance',
            'Gardiennage',
            'Sécurité incendie',
            'Contrôle d’accès',

            // ===== Commerce =====
            'Vente',
            'Gestion de caisse',
            'Prospection',
            'Négociation commerciale',
            'Relation client',
            'Merchandising',

            // ===== Administration =====
            'Secrétariat',
            'Saisie informatique',
            'Archivage',
            'Gestion administrative',
            'Accueil',
            'Rédaction',
        ];

        foreach ($competencesTechniques as $nom) {
            Competence::create([
                'nom' => $nom,
                'type' => 'technique',
            ]);
        }


        // ==============================
        // COMPETENCES TRANSVERSALES
        // ==============================

        $competencesTransversales = [

            'Communication orale',
            'Communication écrite',
            'Travail en équipe',
            'Leadership',
            'Gestion du temps',
            'Résolution de problèmes',
            'Pensée critique',
            'Créativité',
            'Adaptabilité',
            'Gestion du stress',
            'Négociation',
            'Service client',
            'Organisation',
            'Prise de décision',
            'Esprit d\'initiative',
            'Rigueur',
            'Autonomie',
            'Gestion de projet',
            'Animation de réunion',
            'Sens commercial',
            'Ponctualité',
            'Sens des responsabilités',
            'Respect des consignes',
            'Respect des règles',
            'Respect des délais',
            'Sérieux',
            'Fiabilité',
            'Motivation',
            'Discipline',
            'Assiduité',
            'Polyvalence',
            'Travail sous pression',
            'Capacité d’apprentissage',
            'Sens du détail',
            'Respect de la hiérarchie',
            'Professionnalisme',
            'Loyauté',
            'Esprit d’équipe',
            'Gestion des priorités',
            'Patience',
            'Dynamisme',
            'Réactivité',
            'Implication',
            'Sens du service',
            'Adaptation rapide',
            'Esprit d’analyse',
            'Concentration',
            'Autocontrôle',
            'Respect du matériel',
            'Respect des normes',
            'Sécurité au travail',
            'Esprit d’amélioration',
            'Persévérance',
            'Travail autonome',
            'Capacité à suivre des instructions',
            'Capacité à atteindre les objectifs',
            'Bonne présentation',
            'Bonne attitude',

        ];

        foreach ($competencesTransversales as $nom) {
            Competence::create([
                'nom' => $nom,
                'type' => 'transversale',
            ]);
        }
    }
}