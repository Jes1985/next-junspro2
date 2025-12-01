@extends('frontend.layouts.master')

@section('title', 'Soumettre une Mission - Junspro')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0"><i class="fas fa-paper-plane me-2"></i>Soumettre une Mission</h3>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('mission.submit') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Informations Client -->
                        <div class="mb-4">
                            <h5 class="border-bottom pb-2 mb-3">Informations Personnelles</h5>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="client_nom" class="form-label">Nom complet <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('client_nom') is-invalid @enderror" 
                                           id="client_nom" name="client_nom" value="{{ old('client_nom') }}" required>
                                    @error('client_nom')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="client_email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('client_email') is-invalid @enderror" 
                                           id="client_email" name="client_email" value="{{ old('client_email') }}" required>
                                    @error('client_email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="client_telephone" class="form-label">Téléphone</label>
                                <input type="tel" class="form-control @error('client_telephone') is-invalid @enderror" 
                                       id="client_telephone" name="client_telephone" value="{{ old('client_telephone') }}">
                                    @error('client_telephone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                            </div>
                        </div>

                        <!-- Description Mission -->
                        <div class="mb-4">
                            <h5 class="border-bottom pb-2 mb-3">Description de la Mission</h5>
                            
                            <div class="mb-3">
                                <label for="description_mission" class="form-label">Décrivez votre projet <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('description_mission') is-invalid @enderror" 
                                          id="description_mission" name="description_mission" rows="6" required>{{ old('description_mission') }}</textarea>
                                @error('description_mission')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Décrivez en détail votre mission, vos besoins et vos attentes.</small>
                            </div>

                            <div class="mb-3">
                                <label for="budget" class="form-label">Budget estimé (€) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('budget') is-invalid @enderror" 
                                       id="budget" name="budget" value="{{ old('budget') }}" 
                                       min="0" step="0.01" required>
                                @error('budget')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">
                                    <span id="bonus-indicator" class="text-success d-none"></span>
                                </small>
                            </div>

                            <div class="mb-3">
                                <label for="fichier_joint" class="form-label">Fichier joint (optionnel)</label>
                                <input type="file" class="form-control @error('fichier_joint') is-invalid @enderror" 
                                       id="fichier_joint" name="fichier_joint" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                                @error('fichier_joint')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Taille max : 10MB</small>
                            </div>
                        </div>

                        <!-- Offres -->
                        <div class="mb-4">
                            <h5 class="border-bottom pb-2 mb-3">Choisissez votre Option</h5>
                            
                            <div class="form-check mb-3 p-3 border rounded">
                                <input class="form-check-input" type="radio" name="offre" id="offre_accompagnement" 
                                       value="Accompagnement" {{ old('offre') === 'Accompagnement' ? 'checked' : '' }}>
                                <label class="form-check-label w-100" for="offre_accompagnement">
                                    <strong>Accompagnement complet - 99€</strong>
                                    <ul class="small mt-2 mb-0 text-muted">
                                        <li>Gestion par l'équipe Junspro</li>
                                        <li>Envoi de 3 freelances pré-qualifiés</li>
                                        <li>RDV visio via Zoom</li>
                                        <li>Suivi personnalisé</li>
                                    </ul>
                                </label>
                            </div>

                            <div class="form-check mb-3 p-3 border rounded">
                                <input class="form-check-input" type="radio" name="offre" id="offre_mise_relation" 
                                       value="Mise_en_relation" {{ old('offre') === 'Mise_en_relation' ? 'checked' : '' }}>
                                <label class="form-check-label w-100" for="offre_mise_relation">
                                    <strong>Mise en relation simple - 9,99€</strong>
                                    <ul class="small mt-2 mb-0 text-muted">
                                        <li>Mise en relation avec un ou plusieurs freelances</li>
                                        <li>Sans visio ni suivi</li>
                                    </ul>
                                </label>
                            </div>

                            <div class="form-check mb-3 p-3 border rounded">
                                <input class="form-check-input" type="radio" name="offre" id="offre_aucune" 
                                       value="Aucune" {{ old('offre') === 'Aucune' || !old('offre') ? 'checked' : '' }}>
                                <label class="form-check-label w-100" for="offre_aucune">
                                    <strong>Aucune option</strong>
                                    <ul class="small mt-2 mb-0 text-muted">
                                        <li>Postez votre mission sans accompagnement</li>
                                        <li>Gratuit</li>
                                    </ul>
                                </label>
                            </div>

                            @error('offre')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Information sur les frais -->
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Note :</strong> 20% de frais de protection Junspro seront appliqués sur chaque paiement. 
                            Ces frais couvrent l'assistance, la sécurité, les outils techniques et la modération.
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-paper-plane me-2"></i>Soumettre la Mission
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const budgetInput = document.getElementById('budget');
    const bonusIndicator = document.getElementById('bonus-indicator');
    
    budgetInput.addEventListener('input', function() {
        const budget = parseFloat(this.value) || 0;
        let bonusText = '';
        
        if (budget >= 5000) {
            bonusText = '🎉 Bonus Équilibre disponible !';
        } else if (budget >= 2500) {
            bonusText = '🎉 Bonus Sérénité disponible !';
        } else if (budget >= 500) {
            bonusText = '🎉 Bonus Vitalité disponible !';
        }
        
        if (bonusText) {
            bonusIndicator.textContent = bonusText;
            bonusIndicator.classList.remove('d-none');
        } else {
            bonusIndicator.classList.add('d-none');
        }
    });
});
</script>
@endsection


