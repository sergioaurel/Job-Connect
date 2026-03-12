@extends('layouts.app')

@section('title', 'Contact')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <h1 class="text-4xl font-bold text-gray-900 mb-8">Contactez-nous</h1>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Informations de contact</h2>
            
            <div class="space-y-6">
                <div>
                    <h3 class="font-semibold text-gray-900 mb-2">Email</h3>
                    <p class="text-gray-600">contact@jobconnect.bj</p>
                </div>
                
                <div>
                    <h3 class="font-semibold text-gray-900 mb-2">Téléphone</h3>
                    <p class="text-gray-600">+229 XX XX XX XX</p>
                </div>
                
                <div>
                    <h3 class="font-semibold text-gray-900 mb-2">Adresse</h3>
                    <p class="text-gray-600">
                        Cotonou, Bénin<br>
                        Quartier des affaires
                    </p>
                </div>
                
                <div>
                    <h3 class="font-semibold text-gray-900 mb-2">Horaires</h3>
                    <p class="text-gray-600">
                        Lundi - Vendredi : 8h00 - 17h00<br>
                        Samedi : 9h00 - 13h00
                    </p>
                </div>
            </div>
        </div>
        
        <div>
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Envoyez-nous un message</h2>
            
            <form class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-900 mb-2">
                        Nom complet
                    </label>
                    <input 
                        type="text" 
                        required
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-gray-900"
                    >
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-900 mb-2">
                        Email
                    </label>
                    <input 
                        type="email" 
                        required
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-gray-900"
                    >
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-900 mb-2">
                        Sujet
                    </label>
                    <input 
                        type="text" 
                        required
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-gray-900"
                    >
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-900 mb-2">
                        Message
                    </label>
                    <textarea 
                        rows="6"
                        required
                        class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-gray-900"
                    ></textarea>
                </div>
                
                <button 
                    type="submit" 
                    class="w-full px-6 py-3 bg-gray-900 text-white font-medium rounded hover:bg-gray-800"
                >
                    Envoyer le message
                </button>
            </form>
        </div>
    </div>
</div>
@endsection