@extends('frontend.layouts.master')

@section('title', 'Mission Soumise - Junspro')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm" style="border-top: 4px solid #4F46E5;">
                <div class="card-header text-white text-center" style="background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);">
                    <i class="fas fa-check-circle fa-3x mb-3"></i>
                    <h3 class="mb-0">Mission Soumise avec Succès !</h3>
                </div>
                <div class="card-body p-4 text-center">
                    <p class="lead">Merci {{ $mission->client_nom }} !</p>
                    <p>Votre mission a été enregistrée avec succès.</p>
                    
                    <div class="alert alert-info mt-4">
                        <h5>Détails de votre mission :</h5>
                        <ul class="list-unstyled text-start">
                            <li><strong>ID Mission :</strong> #{{ $mission->id_mission }}</li>
                            <li><strong>Statut :</strong> {{ ucfirst(str_replace('_', ' ', $mission->statut)) }}</li>
                            @if($mission->offre !== 'Aucune')
                                <li><strong>Offre :</strong> {{ ucfirst(str_replace('_', ' ', $mission->offre)) }}</li>
                            @endif
                            @if($mission->bonus !== 'Aucun')
                                <li><strong>Bonus :</strong> 
                                    @php
                                        $bonusLabels = [
                                            'Vitalite' => 'Vitalité',
                                            'Serenite' => 'Sérénité',
                                            'Equilibre' => 'Équilibre',
                                        ];
                                        echo $bonusLabels[$mission->bonus] ?? $mission->bonus;
                                    @endphp
                                </li>
                            @endif
                        </ul>
                    </div>

                    @if($mission->statut === 'Paiement_valide' && $mission->calendly_link)
                        <div class="alert alert-warning mt-3">
                            <h6><i class="fas fa-calendar me-2"></i>Prochaine étape :</h6>
                            <p>Veuillez réserver votre créneau via le lien Calendly ci-dessous.</p>
                            <a href="{{ $mission->calendly_link }}" target="_blank" class="btn btn-primary">
                                <i class="fas fa-calendar-check me-2"></i>Réserver un créneau
                            </a>
                        </div>
                    @endif

                    <div class="mt-4">
                        <a href="{{ route('index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-home me-2"></i>Retour à l'accueil
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


