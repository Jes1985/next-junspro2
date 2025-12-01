@extends('backend.layouts.master')

@section('title', 'Détails Mission #' . $mission->id_mission)

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2><i class="fas fa-eye me-2"></i>Mission #{{ $mission->id_mission }}</h2>
                <a href="{{ route('admin.missions.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Retour
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <!-- Informations Client -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-user me-2"></i>Informations Client</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Nom :</strong> {{ $mission->client_nom }}</p>
                            <p><strong>Email :</strong> {{ $mission->client_email }}</p>
                            <p><strong>Téléphone :</strong> {{ $mission->client_telephone ?? 'Non renseigné' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Date de soumission :</strong> {{ $mission->date_soumission->format('d/m/Y à H:i') }}</p>
                            <p><strong>Statut :</strong> 
                                <span class="badge bg-{{ $mission->statut === 'Termine' ? 'success' : 'warning' }}">
                                    {{ ucfirst(str_replace('_', ' ', $mission->statut)) }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description Mission -->
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-file-alt me-2"></i>Description de la Mission</h5>
                </div>
                <div class="card-body">
                    <p>{{ $mission->description_mission }}</p>
                    <p><strong>Budget :</strong> {{ number_format($mission->budget, 2, ',', ' ') }} €</p>
                </div>
            </div>

            <!-- Fichier joint -->
            @if($mission->fichier_joint)
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-paperclip me-2"></i>Fichier Joint</h5>
                </div>
                <div class="card-body">
                    <a href="{{ Storage::url($mission->fichier_joint) }}" target="_blank" class="btn btn-outline-primary">
                        <i class="fas fa-download me-1"></i>Télécharger le fichier
                    </a>
                </div>
            </div>
            @endif
        </div>

        <div class="col-md-4">
            <!-- Options et Bonus -->
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-gift me-2"></i>Options & Bonus</h5>
                </div>
                <div class="card-body">
                    <p><strong>Offre choisie :</strong></p>
                    <span class="badge bg-primary mb-2">
                        {{ ucfirst(str_replace('_', ' ', $mission->offre)) }}
                    </span>
                    
                    <p class="mt-3"><strong>Bonus bien-être :</strong></p>
                    @if($mission->bonus !== 'Aucun')
                        @php
                            $bonusLabels = [
                                'Vitalite' => 'Vitalité',
                                'Serenite' => 'Sérénité',
                                'Equilibre' => 'Équilibre',
                            ];
                        @endphp
                        <span class="badge bg-success">
                            {{ $bonusLabels[$mission->bonus] ?? $mission->bonus }}
                        </span>
                    @else
                        <span class="badge bg-secondary">Aucun</span>
                    @endif
                </div>
            </div>

            <!-- Liens et RDV -->
            <div class="card mb-4">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="fas fa-link me-2"></i>Liens & Rendez-vous</h5>
                </div>
                <div class="card-body">
                    @if($mission->calendly_link)
                        <p><strong>Lien Calendly :</strong></p>
                        <a href="{{ $mission->calendly_link }}" target="_blank" class="btn btn-sm btn-outline-primary mb-2">
                            <i class="fas fa-calendar me-1"></i>Voir Calendly
                        </a>
                    @endif

                    @if($mission->zoom_link)
                        <p class="mt-3"><strong>Lien Zoom :</strong></p>
                        <a href="{{ $mission->zoom_link }}" target="_blank" class="btn btn-sm btn-outline-primary mb-2">
                            <i class="fas fa-video me-1"></i>Rejoindre Zoom
                        </a>
                        @if($mission->zoom_meeting_id)
                            <p><small>ID Réunion : {{ $mission->zoom_meeting_id }}</small></p>
                        @endif
                    @endif

                    @if($mission->date_rdv)
                        <p class="mt-3"><strong>Date du RDV :</strong></p>
                        <p>{{ $mission->date_rdv->format('d/m/Y à H:i') }}</p>
                    @endif
                </div>
            </div>

            <!-- Paiement -->
            @if($mission->stripe_payment_id)
            <div class="card mb-4">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0"><i class="fas fa-credit-card me-2"></i>Paiement</h5>
                </div>
                <div class="card-body">
                    <p><strong>ID Paiement Stripe :</strong></p>
                    <p><small>{{ $mission->stripe_payment_id }}</small></p>
                </div>
            </div>
            @endif

            <!-- Freelances proposés -->
            @if($mission->freelance_propose)
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-users me-2"></i>Freelances Proposés</h5>
                </div>
                <div class="card-body">
                    @if(is_array($mission->freelance_propose))
                        <ul>
                            @foreach($mission->freelance_propose as $freelance)
                                <li>{{ is_array($freelance) ? ($freelance['name'] ?? 'N/A') : $freelance }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p>{{ $mission->freelance_propose }}</p>
                    @endif
                </div>
            </div>
            @endif

            <!-- Mettre à jour le statut -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Mettre à jour</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.missions.update-status', $mission->id_mission) }}">
                        @csrf
                        @method('PUT')
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif
                        <div class="mb-3">
                            <label class="form-label">Statut</label>
                            <select name="statut" class="form-select">
                                <option value="En_attente" {{ $mission->statut === 'En_attente' ? 'selected' : '' }}>En attente</option>
                                <option value="Paiement_valide" {{ $mission->statut === 'Paiement_valide' ? 'selected' : '' }}>Paiement validé</option>
                                <option value="RDV_planifie" {{ $mission->statut === 'RDV_planifie' ? 'selected' : '' }}>RDV planifié</option>
                                <option value="Termine" {{ $mission->statut === 'Termine' ? 'selected' : '' }}>Terminé</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-save me-1"></i>Mettre à jour
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

