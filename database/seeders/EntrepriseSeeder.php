<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Entreprise;
use Illuminate\Database\Seeder;

class EntrepriseSeeder extends Seeder
{
    public function run(): void
    {
        $userEntreprises = User::where('role', 'entreprise')->get();

        $entreprisesData = [
            // 0 - TechSolutions Bénin
            [
                'nom_entreprise' => 'TechSolutions Bénin',
                'description' => 'Entreprise spécialisée dans le développement de solutions digitales pour les entreprises béninoises.',
                'secteur_activite' => 'Informatique et Technologies',
                'site_web' => 'https://www.techsolutions.bj',
                'adresse' => 'Rue 123, Akpakpa',
                'ville' => 'Cotonou',
                'telephone_entreprise' => '+229 21 30 45 67',
                'effectif' => 25,
                'annee_creation' => 2018,
                'statut' => 'validee',
            ],
            // 1 - Cabinet Expertise Comptable
            [
                'nom_entreprise' => 'Cabinet Expertise Comptable & Audit',
                'description' => 'Cabinet d\'expertise comptable offrant des services de comptabilité, audit et conseil fiscal.',
                'secteur_activite' => 'Finance et Comptabilité',
                'site_web' => 'https://www.expertise-compta.bj',
                'adresse' => 'Avenue Steinmetz, Quartier des Affaires',
                'ville' => 'Cotonou',
                'telephone_entreprise' => '+229 21 31 52 89',
                'effectif' => 15,
                'annee_creation' => 2015,
                'statut' => 'validee',
            ],
            // 2 - AgriVert Bénin
            [
                'nom_entreprise' => 'AgriVert Bénin SARL',
                'description' => 'Entreprise agricole moderne spécialisée dans la production de fruits et légumes bio.',
                'secteur_activite' => 'Agriculture et Environnement',
                'site_web' => null,
                'adresse' => 'Zone Agricole, BP 456',
                'ville' => 'Parakou',
                'telephone_entreprise' => '+229 97 45 23 18',
                'effectif' => 50,
                'annee_creation' => 2019,
                'statut' => 'validee',
            ],
            // 3 - Orange Bénin
            [
                'nom_entreprise' => 'Orange Bénin SA',
                'description' => 'Opérateur télécom leader au Bénin, offrant des services mobiles, internet et solutions digitales aux particuliers et entreprises.',
                'secteur_activite' => 'Télécommunications',
                'site_web' => 'https://www.orange.bj',
                'adresse' => 'Boulevard Saint-Michel, Haie Vive',
                'ville' => 'Cotonou',
                'telephone_entreprise' => '+229 21 36 00 00',
                'effectif' => 500,
                'annee_creation' => 2000,
                'statut' => 'validee',
            ],
            // 4 - MTN Bénin
            [
                'nom_entreprise' => 'MTN Bénin',
                'description' => 'Opérateur de téléphonie mobile proposant des services voix, data et mobile money à travers tout le Bénin.',
                'secteur_activite' => 'Télécommunications',
                'site_web' => 'https://www.mtn.bj',
                'adresse' => 'Avenue Jean-Paul II',
                'ville' => 'Cotonou',
                'telephone_entreprise' => '+229 21 37 00 00',
                'effectif' => 400,
                'annee_creation' => 2000,
                'statut' => 'validee',
            ],
            // 5 - BSIC Bénin
            [
                'nom_entreprise' => 'BSIC Bénin',
                'description' => 'Banque offrant des solutions financières innovantes pour les particuliers et les PME au Bénin.',
                'secteur_activite' => 'Banque et Assurance',
                'site_web' => 'https://www.bsic.bj',
                'adresse' => 'Avenue Clozel',
                'ville' => 'Cotonou',
                'telephone_entreprise' => '+229 21 31 20 00',
                'effectif' => 120,
                'annee_creation' => 2005,
                'statut' => 'validee',
            ],
            // 6 - Orabank Bénin
            [
                'nom_entreprise' => 'Orabank Bénin',
                'description' => 'Institution financière panafricaine proposant des solutions bancaires adaptées aux besoins des entreprises et particuliers.',
                'secteur_activite' => 'Banque et Assurance',
                'site_web' => 'https://www.orabank.bj',
                'adresse' => 'Place des Martyrs',
                'ville' => 'Cotonou',
                'telephone_entreprise' => '+229 21 31 30 00',
                'effectif' => 200,
                'annee_creation' => 2010,
                'statut' => 'validee',
            ],
            // 7 - Ecobank Bénin
            [
                'nom_entreprise' => 'Ecobank Bénin',
                'description' => 'Banque panafricaine présente dans 36 pays, offrant des services bancaires complets au Bénin.',
                'secteur_activite' => 'Banque et Assurance',
                'site_web' => 'https://www.ecobank.bj',
                'adresse' => 'Avenue Boufflers, Ganhi',
                'ville' => 'Cotonou',
                'telephone_entreprise' => '+229 21 31 40 00',
                'effectif' => 250,
                'annee_creation' => 1999,
                'statut' => 'validee',
            ],
            // 8 - Cabinet Juridique Akpovi
            [
                'nom_entreprise' => 'Cabinet Juridique Akpovi & Associés',
                'description' => 'Cabinet d\'avocats spécialisé en droit des affaires, droit du travail et contentieux commercial.',
                'secteur_activite' => 'Juridique et Droit',
                'site_web' => null,
                'adresse' => 'Rue du Commerce, Ganhi',
                'ville' => 'Cotonou',
                'telephone_entreprise' => '+229 97 12 34 56',
                'effectif' => 10,
                'annee_creation' => 2012,
                'statut' => 'validee',
            ],
            // 9 - Clinique Sainte Marie
            [
                'nom_entreprise' => 'Clinique Sainte Marie',
                'description' => 'Établissement de santé privé proposant des soins médicaux de qualité en médecine générale, chirurgie et pédiatrie.',
                'secteur_activite' => 'Santé et Médical',
                'site_web' => 'https://www.clinique-saintemarie.bj',
                'adresse' => 'Carrefour Vèdoko',
                'ville' => 'Cotonou',
                'telephone_entreprise' => '+229 21 32 10 00',
                'effectif' => 80,
                'annee_creation' => 2008,
                'statut' => 'validee',
            ],
            // 10 - Groupe Scolaire Excellence
            [
                'nom_entreprise' => 'Groupe Scolaire Excellence',
                'description' => 'Établissement d\'enseignement privé de la maternelle au lycée, axé sur l\'excellence académique et le développement personnel.',
                'secteur_activite' => 'Éducation et Formation',
                'site_web' => 'https://www.excellence.bj',
                'adresse' => 'Quartier Cadjehoun',
                'ville' => 'Cotonou',
                'telephone_entreprise' => '+229 97 55 66 77',
                'effectif' => 60,
                'annee_creation' => 2005,
                'statut' => 'validee',
            ],
            // 11 - BTP Construct Bénin
            [
                'nom_entreprise' => 'BTP Construct Bénin',
                'description' => 'Entreprise de construction spécialisée dans le bâtiment, les travaux publics et l\'aménagement urbain.',
                'secteur_activite' => 'Ingénierie et BTP',
                'site_web' => null,
                'adresse' => 'Zone Industrielle, Glo-Djigbé',
                'ville' => 'Cotonou',
                'telephone_entreprise' => '+229 96 44 55 66',
                'effectif' => 150,
                'annee_creation' => 2010,
                'statut' => 'validee',
            ],
            // 12 - LogisTrans Bénin
            [
                'nom_entreprise' => 'LogisTrans Bénin',
                'description' => 'Entreprise de logistique et transport offrant des solutions de livraison et gestion de stock pour les entreprises.',
                'secteur_activite' => 'Transport et Logistique',
                'site_web' => 'https://www.logistrans.bj',
                'adresse' => 'Port de Cotonou, Zone Franche',
                'ville' => 'Cotonou',
                'telephone_entreprise' => '+229 97 33 44 55',
                'effectif' => 75,
                'annee_creation' => 2014,
                'statut' => 'validee',
            ],
            // 13 - Hôtel Azalaï
            [
                'nom_entreprise' => 'Hôtel Azalaï Cotonou',
                'description' => 'Hôtel 5 étoiles offrant hébergement de luxe, restauration gastronomique et salles de conférences pour les voyageurs d\'affaires.',
                'secteur_activite' => 'Hôtellerie et Restauration',
                'site_web' => 'https://www.azalaihotels.com',
                'adresse' => 'Avenue Clozel, Centre-ville',
                'ville' => 'Cotonou',
                'telephone_entreprise' => '+229 21 30 10 00',
                'effectif' => 200,
                'annee_creation' => 2003,
                'statut' => 'validee',
            ],
            // 14 - Agence Digitale BeninWeb
            [
                'nom_entreprise' => 'BeninWeb Digital Agency',
                'description' => 'Agence digitale spécialisée en création de sites web, marketing digital et stratégies de communication online.',
                'secteur_activite' => 'Marketing et Communication',
                'site_web' => 'https://www.beninweb.bj',
                'adresse' => 'Quartier Haie Vive',
                'ville' => 'Cotonou',
                'telephone_entreprise' => '+229 96 78 90 12',
                'effectif' => 20,
                'annee_creation' => 2017,
                'statut' => 'validee',
            ],
            // 15 - SONEB
            [
                'nom_entreprise' => 'SONEB - Société Nationale des Eaux',
                'description' => 'Société nationale assurant la production et la distribution d\'eau potable sur l\'ensemble du territoire béninois.',
                'secteur_activite' => 'Services Publics',
                'site_web' => 'https://www.soneb.bj',
                'adresse' => 'Boulevard Saint-Michel',
                'ville' => 'Cotonou',
                'telephone_entreprise' => '+229 21 31 00 00',
                'effectif' => 800,
                'annee_creation' => 1990,
                'statut' => 'validee',
            ],
            // 16 - SBEE
            [
                'nom_entreprise' => 'SBEE - Société Béninoise d\'Énergie',
                'description' => 'Société d\'état responsable de la production, du transport et de la distribution de l\'énergie électrique au Bénin.',
                'secteur_activite' => 'Énergie',
                'site_web' => 'https://www.sbee.bj',
                'adresse' => 'Avenue Mgr Steinmetz',
                'ville' => 'Cotonou',
                'telephone_entreprise' => '+229 21 31 11 00',
                'effectif' => 1200,
                'annee_creation' => 1982,
                'statut' => 'validee',
            ],
            // 17 - Pharmacie Centrale
            [
                'nom_entreprise' => 'Pharmacie Centrale du Bénin',
                'description' => 'Centrale d\'approvisionnement en médicaments et produits pharmaceutiques pour les structures sanitaires du Bénin.',
                'secteur_activite' => 'Santé et Médical',
                'site_web' => null,
                'adresse' => 'Avenue Jean-Paul II',
                'ville' => 'Cotonou',
                'telephone_entreprise' => '+229 21 31 22 00',
                'effectif' => 45,
                'annee_creation' => 1995,
                'statut' => 'validee',
            ],
            // 18 - Studio Voodoo
            [
                'nom_entreprise' => 'Studio Créatif Voodoo',
                'description' => 'Studio de création visuelle spécialisé en design graphique, photographie, vidéo et production artistique.',
                'secteur_activite' => 'Art et Design',
                'site_web' => 'https://www.voodoo-studio.bj',
                'adresse' => 'Quartier Zogbohouè',
                'ville' => 'Cotonou',
                'telephone_entreprise' => '+229 96 11 22 33',
                'effectif' => 12,
                'annee_creation' => 2016,
                'statut' => 'validee',
            ],
            // 19 - AssuriBénin
            [
                'nom_entreprise' => 'AssuriBénin',
                'description' => 'Compagnie d\'assurance proposant des produits vie, auto, habitation et santé adaptés au marché béninois.',
                'secteur_activite' => 'Banque et Assurance',
                'site_web' => 'https://www.assuribenin.bj',
                'adresse' => 'Rue du Gouverneur Bayol',
                'ville' => 'Cotonou',
                'telephone_entreprise' => '+229 21 31 55 00',
                'effectif' => 90,
                'annee_creation' => 2007,
                'statut' => 'validee',
            ],
            // 20 - FoodTech Bénin
            [
                'nom_entreprise' => 'FoodTech Bénin',
                'description' => 'Startup spécialisée dans la livraison de repas et la mise en relation entre restaurants et consommateurs via une application mobile.',
                'secteur_activite' => 'Restauration et Tech',
                'site_web' => 'https://www.foodtech.bj',
                'adresse' => 'Quartier Ouando',
                'ville' => 'Porto-Novo',
                'telephone_entreprise' => '+229 97 99 88 77',
                'effectif' => 30,
                'annee_creation' => 2020,
                'statut' => 'validee',
            ],
            // 21 - EnergieSolaire BJ
            [
                'nom_entreprise' => 'EnergieSolaire Bénin',
                'description' => 'Entreprise spécialisée dans l\'installation de panneaux solaires et solutions d\'énergie renouvelable pour particuliers et entreprises.',
                'secteur_activite' => 'Énergie Renouvelable',
                'site_web' => 'https://www.energiesolaire.bj',
                'adresse' => 'Zone Industrielle Parakou',
                'ville' => 'Parakou',
                'telephone_entreprise' => '+229 96 55 44 33',
                'effectif' => 35,
                'annee_creation' => 2018,
                'statut' => 'validee',
            ],
            // 22 - MicroFinance Alafia
            [
                'nom_entreprise' => 'MicroFinance Alafia',
                'description' => 'Institution de microfinance soutenant les petits entrepreneurs et artisans béninois par des crédits adaptés à leurs besoins.',
                'secteur_activite' => 'Microfinance',
                'site_web' => null,
                'adresse' => 'Carrefour Godomey',
                'ville' => 'Abomey-Calavi',
                'telephone_entreprise' => '+229 21 32 20 00',
                'effectif' => 55,
                'annee_creation' => 2011,
                'statut' => 'validee',
            ],
        ];

        foreach ($userEntreprises as $index => $user) {
            if (isset($entreprisesData[$index])) {
                $data = $entreprisesData[$index];
                Entreprise::create(array_merge($data, ['user_id' => $user->id]));
            }
        }
    }
}