@extends('layouts.app')

@section('title', 'À propos')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <h1 class="text-4xl font-bold text-gray-900 mb-8">À propos de JobConnect Bénin</h1>
    
    <div class="prose prose-lg max-w-none">
        <p class="text-xl text-gray-600 mb-8">
            JobConnect Bénin est la plateforme de référence pour la promotion de l'emploi et des stages au Bénin.
        </p>

        <h2 class="text-2xl font-bold text-gray-900 mb-4">Notre mission</h2>
        <p class="text-gray-600 mb-6">
            Faciliter l'insertion professionnelle des jeunes béninois en digitalisant et simplifiant le processus 
            de recherche d'emploi et de recrutement. Nous mettons en relation les talents avec les opportunités 
            professionnelles à travers une plateforme moderne, accessible et efficace.
        </p>

        <h2 class="text-2xl font-bold text-gray-900 mb-4">Nos valeurs</h2>
        <ul class="list-disc pl-6 text-gray-600 mb-6 space-y-2">
            <li>Accessibilité : Une plateforme gratuite et accessible à tous</li>
            <li>Transparence : Des processus clairs et équitables</li>
            <li>Efficacité : Des outils modernes pour un matching optimal</li>
            <li>Innovation : Une approche digitale du marché de l'emploi</li>
        </ul>

        <h2 class="text-2xl font-bold text-gray-900 mb-4">Nos services</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="border border-gray-200 rounded p-6">
                <h3 class="font-semibold text-gray-900 mb-2">Pour les candidats</h3>
                <ul class="text-sm text-gray-600 space-y-1">
                    <li>• Recherche avancée d'offres</li>
                    <li>• CV en ligne</li>
                    <li>• Candidature simplifiée</li>
                    <li>• Suivi des candidatures</li>
                </ul>
            </div>
            <div class="border border-gray-200 rounded p-6">
                <h3 class="font-semibold text-gray-900 mb-2">Pour les entreprises</h3>
                <ul class="text-sm text-gray-600 space-y-1">
                    <li>• Publication d'offres</li>
                    <li>• Gestion des candidatures</li>
                    <li>• Accès à la CVthèque</li>
                    <li>• Statistiques détaillées</li>
                </ul>
            </div>
        </div>

        <h2 class="text-2xl font-bold text-gray-900 mb-4">Contact</h2>
        <p class="text-gray-600">
            Pour toute question ou suggestion, n'hésitez pas à nous contacter via notre 
            <a href="{{ route('contact') }}" class="text-gray-900 font-medium hover:underline">page de contact</a>.
        </p>
    </div>
</div>
@endsection