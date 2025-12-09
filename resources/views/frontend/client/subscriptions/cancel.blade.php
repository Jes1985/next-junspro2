@extends('frontend.layout')

@section('pageHeading')
  {{ __('Annuler mon abonnement') }}
@endsection

@section('content')
  @includeIf('frontend.partials.breadcrumb', ['breadcrumb' => $breadcrumb, 'title' => __('Annuler mon abonnement')])

  <section class="user-dashboard pt-100 pb-60">
    <div class="container">
      <div class="row">
        @includeIf('frontend.user.side-navbar')

        <div class="col-lg-9">
          <div class="user-profile-details mb-30">
            <!-- Étape 1 : Alternatives proposées -->
            <div class="card mb-4" id="step1">
              <div class="card-body">
                <h4 class="card-title mb-4">
                  <i class="fas fa-exclamation-triangle text-warning me-2"></i>
                  {{ __('Votre projet est important. Voyons si on peut adapter votre abonnement.') }}
                </h4>
                <p class="text-muted mb-4">
                  {{ __('Avant d\'annuler, nous vous proposons plusieurs alternatives :') }}
                </p>

                <form method="POST" action="{{ route('client.subscriptions.cancel.submit', $subscription->id) }}">
                  @csrf
                  <input type="hidden" name="action" value="alternative">

                  <div class="row g-3">
                    <div class="col-md-6">
                      <button type="submit" name="alternative" value="pause" class="btn btn-outline-warning w-100 p-4 h-100">
                        <i class="fas fa-pause fa-2x mb-2"></i>
                        <div class="fw-bold">{{ __('Mettre en pause') }}</div>
                        <small class="text-muted">{{ __('Gel temporaire de votre abonnement') }}</small>
                      </button>
                    </div>
                    <div class="col-md-6">
                      <button type="submit" name="alternative" value="change_freelancer" class="btn btn-outline-info w-100 p-4 h-100">
                        <i class="fas fa-exchange-alt fa-2x mb-2"></i>
                        <div class="fw-bold">{{ __('Changer de freelance') }}</div>
                        <small class="text-muted">{{ __('Transférer vers un autre freelance') }}</small>
                      </button>
                    </div>
                    <div class="col-md-6">
                      <button type="submit" name="alternative" value="modify_formula" class="btn btn-outline-primary w-100 p-4 h-100">
                        <i class="fas fa-edit fa-2x mb-2"></i>
                        <div class="fw-bold">{{ __('Modifier la formule') }}</div>
                        <small class="text-muted">{{ __('Ajuster les heures par semaine') }}</small>
                      </button>
                    </div>
                    <div class="col-md-6">
                      <button type="button" onclick="showStep2()" class="btn btn-outline-danger w-100 p-4 h-100">
                        <i class="fas fa-times-circle fa-2x mb-2"></i>
                        <div class="fw-bold">{{ __('Continuer l\'annulation') }}</div>
                        <small class="text-muted">{{ __('Procéder à l\'annulation définitive') }}</small>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>

            <!-- Étape 2 : Choix de la raison -->
            <div class="card mb-4" id="step2" style="display: none;">
              <div class="card-body">
                <h4 class="card-title mb-4">{{ __('Pourquoi souhaitez-vous annuler ?') }}</h4>
                <p class="text-muted mb-4">{{ __('Votre avis nous aide à améliorer notre service.') }}</p>

                <form method="POST" action="{{ route('client.subscriptions.cancel.submit', $subscription->id) }}">
                  @csrf
                  <input type="hidden" name="action" value="confirm_cancel">

                  <div class="mb-3">
                    <div class="form-check mb-2">
                      <input class="form-check-input" type="radio" name="reason" id="reason_price" value="trop_cher" required>
                      <label class="form-check-label" for="reason_price">
                        {{ __('Trop cher') }}
                      </label>
                    </div>
                    <div class="form-check mb-2">
                      <input class="form-check-input" type="radio" name="reason" id="reason_hours" value="trop_heures_non_utilisees">
                      <label class="form-check-label" for="reason_hours">
                        {{ __('Trop d\'heures non utilisées') }}
                      </label>
                    </div>
                    <div class="form-check mb-2">
                      <input class="form-check-input" type="radio" name="reason" id="reason_freelancer" value="probleme_freelance">
                      <label class="form-check-label" for="reason_freelancer">
                        {{ __('Problème avec le freelance') }}
                      </label>
                    </div>
                    <div class="form-check mb-2">
                      <input class="form-check-input" type="radio" name="reason" id="reason_quality" value="qualite_insuffisante">
                      <label class="form-check-label" for="reason_quality">
                        {{ __('Qualité insuffisante') }}
                      </label>
                    </div>
                    <div class="form-check mb-2">
                      <input class="form-check-input" type="radio" name="reason" id="reason_project" value="projet_termine">
                      <label class="form-check-label" for="reason_project">
                        {{ __('Projet terminé') }}
                      </label>
                    </div>
                    <div class="form-check mb-2">
                      <input class="form-check-input" type="radio" name="reason" id="reason_other" value="autre">
                      <label class="form-check-label" for="reason_other">
                        {{ __('Autre') }}
                      </label>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label for="reason_details" class="form-label">{{ __('Détails (optionnel)') }}</label>
                    <textarea name="reason_details" id="reason_details" class="form-control" rows="3" placeholder="{{ __('Précisez votre raison si vous le souhaitez...') }}"></textarea>
                  </div>

                  <div class="d-flex gap-2">
                    <button type="button" onclick="showStep1()" class="btn btn-secondary">
                      <i class="fas fa-arrow-left me-1"></i>{{ __('Retour') }}
                    </button>
                    <button type="submit" class="btn btn-danger">
                      {{ __('Continuer') }}<i class="fas fa-arrow-right ms-1"></i>
                    </button>
                  </div>
                </form>
              </div>
            </div>

            <!-- Étape 3 : Confirmation -->
            <div class="card mb-4" id="step3" style="display: none;">
              <div class="card-body">
                <h4 class="card-title mb-4 text-danger">
                  <i class="fas fa-exclamation-circle me-2"></i>
                  {{ __('Confirmation d\'annulation') }}
                </h4>
                <div class="alert alert-warning">
                  <strong>{{ __('Attention') }} :</strong>
                  {{ __('Votre abonnement sera arrêté. Plus aucun débit ni nouvelle livraison programmée.') }}
                </div>
                <p class="mb-4">
                  <strong>{{ __('Abonnement avec') }} :</strong> {{ $subscription->freelancer->user->name ?? 'N/A' }}<br>
                  <strong>{{ __('Heures/semaine') }} :</strong> {{ $subscription->hours_per_week }}h<br>
                  <strong>{{ __('Prix 4 semaines') }} :</strong> {{ number_format($subscription->final_price, 2, ',', ' ') }} €
                </p>
              </div>
            </div>

            <!-- Étape 4 : Dernière offre -->
            <div class="card mb-4" id="step4" style="display: none;">
              <div class="card-body text-center">
                <h4 class="card-title mb-4">{{ __('Dernière offre avant de partir') }}</h4>
                <p class="text-muted mb-4">{{ __('Nous pouvons vous aider à trouver une solution adaptée :') }}</p>

                <form method="POST" action="{{ route('client.subscriptions.cancel.submit', $subscription->id) }}">
                  @csrf
                  <input type="hidden" name="action" value="final_offer">
                  <input type="hidden" name="reason" id="final_reason" value="">

                  <div class="row g-3 mb-4">
                    <div class="col-md-4">
                      <button type="submit" name="final_action" value="find_freelancer" class="btn btn-primary w-100 p-3">
                        <i class="fas fa-search me-2"></i>{{ __('Trouver un autre freelance') }}
                      </button>
                    </div>
                    <div class="col-md-4">
                      <button type="submit" name="final_action" value="keep" class="btn btn-success w-100 p-3">
                        <i class="fas fa-check me-2"></i>{{ __('Garder mon abonnement') }}
                      </button>
                    </div>
                    <div class="col-md-4">
                      <button type="submit" name="final_action" value="cancel" class="btn btn-danger w-100 p-3">
                        <i class="fas fa-times me-2"></i>{{ __('Pas maintenant') }}
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  @section('script')
    <script>
      function showStep1() {
        document.getElementById('step1').style.display = 'block';
        document.getElementById('step2').style.display = 'none';
        document.getElementById('step3').style.display = 'none';
        document.getElementById('step4').style.display = 'none';
      }

      function showStep2() {
        document.getElementById('step1').style.display = 'none';
        document.getElementById('step2').style.display = 'block';
        document.getElementById('step3').style.display = 'none';
        document.getElementById('step4').style.display = 'none';
      }

      function showStep3() {
        document.getElementById('step1').style.display = 'none';
        document.getElementById('step2').style.display = 'none';
        document.getElementById('step3').style.display = 'block';
        document.getElementById('step4').style.display = 'none';
      }

      function showStep4(reason) {
        document.getElementById('step1').style.display = 'none';
        document.getElementById('step2').style.display = 'none';
        document.getElementById('step3').style.display = 'none';
        document.getElementById('step4').style.display = 'block';
        document.getElementById('final_reason').value = reason;
      }

      // Gérer la soumission du formulaire de l'étape 2
      document.querySelector('form[action*="confirm_cancel"]')?.addEventListener('submit', function(e) {
        const reason = document.querySelector('input[name="reason"]:checked')?.value;
        if (reason) {
          e.preventDefault();
          showStep4(reason);
        }
      });
    </script>
  @endsection
@endsection
