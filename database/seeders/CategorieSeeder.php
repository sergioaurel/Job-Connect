<?php

namespace Database\Seeders;

use App\Models\Categorie;
use Illuminate\Database\Seeder;

class CategorieSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'nom' => 'Informatique et Technologies',
                'description' => 'Développement web, mobile, cybersécurité, réseaux, IA, etc.',
                'is_active' => true,
            ],
            [
                'nom' => 'Commerce et Vente',
                'description' => 'Commercial, vendeur, technico-commercial, chargé de clientèle',
                'is_active' => true,
            ],
            [
                'nom' => 'Marketing et Communication',
                'description' => 'Marketing digital, community manager, communication, publicité',
                'is_active' => true,
            ],
            [
                'nom' => 'Finance et Comptabilité',
                'description' => 'Comptable, contrôleur de gestion, auditeur, analyste financier',
                'is_active' => true,
            ],
            [
                'nom' => 'Ressources Humaines',
                'description' => 'RH, recrutement, gestion du personnel, formation',
                'is_active' => true,
            ],
            [
                'nom' => 'Banque et Assurance',
                'description' => 'Conseiller bancaire, chargé de clientèle, assureur',
                'is_active' => true,
            ],
            [
                'nom' => 'Santé et Médical',
                'description' => 'Médecin, infirmier, pharmacien, aide-soignant',
                'is_active' => true,
            ],
            [
                'nom' => 'Éducation et Formation',
                'description' => 'Enseignant, formateur, professeur, éducateur',
                'is_active' => true,
            ],
            [
                'nom' => 'Ingénierie et BTP',
                'description' => 'Ingénieur civil, architecte, chef de chantier, technicien',
                'is_active' => true,
            ],
            [
                'nom' => 'Juridique et Droit',
                'description' => 'Avocat, juriste, notaire, assistant juridique',
                'is_active' => true,
            ],
            [
                'nom' => 'Transport et Logistique',
                'description' => 'Chauffeur, logisticien, gestionnaire de stock, dispatcher',
                'is_active' => true,
            ],
            [
                'nom' => 'Hôtellerie et Restauration',
                'description' => 'Cuisinier, serveur, réceptionniste, chef de cuisine',
                'is_active' => true,
            ],
            [
                'nom' => 'Agriculture et Environnement',
                'description' => 'Agronome, technicien agricole, environnementaliste',
                'is_active' => true,
            ],
            [
                'nom' => 'Art et Design',
                'description' => 'Graphiste, designer, photographe, vidéaste',
                'is_active' => true,
            ],
            [
                'nom' => 'Administration et Secrétariat',
                'description' => 'Secrétaire, assistant administratif, office manager',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $categorie) {
            Categorie::create($categorie);
        }
    }
}