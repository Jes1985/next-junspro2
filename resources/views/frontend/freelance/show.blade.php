@extends('frontend.layout')

@section('pageHeading')
  {{ $user->name ?? __('Freelance') }}
@endsection

@section('metaDescription')
  {{ Str::limit($freelancer->bio ?? '', 150) }}
@endsection

@section('content')
  <section class="pt-60 pb-40">
    <div class="container">
      <div class="row mb-30">
        <div class="col-lg-8">
          <div class="d-flex align-items-center mb-3">
            <div class="me-3">
              <div class="rounded-circle bg-light d-flex align-items-center justify-content-center"
                style="width: 64px; height: 64px;">
                <span class="fw-bold fs-4">
                  {{ strtoupper(substr($user->name ?? 'F', 0, 1)) }}
                </span>
              </div>
            </div>
            <div>
              <h1 class="h4 mb-1">{{ $user->name }}</h1>
              <div class="d-flex align-items-center gap-2">
                <span class="badge bg-secondary-subtle text-secondary">
                  {{ $user->country_code ?? '–' }}
                </span>
                @if($user->is_super_freelancer ?? false)
                  <span class="badge bg-primary">{{ __('Super Freelance') }}</span>
                @endif
                @if($freelancer->is_verified)
                  <span class="badge bg-success">{{ __('Vérifié') }}</span>
                @endif
              </div>
            </div>
          </div>
          <p class="mb-2">
            <strong>{{ __('Tarif horaire') }} :</strong>
            {{ number_format($freelancer->hourly_rate, 2, ',', ' ') }} € / h
          </p>
          <p class="mb-2">
            <strong>{{ __('Score fiabilité') }} :</strong>
            {{ $freelancer->reliability_score }} / 100
          </p>
          @if($freelancer->bio)
            <div class="mt-3">
              <h5>{{ __('À propos') }}</h5>
              <p class="mb-0">{{ $freelancer->bio }}</p>
            </div>
          @endif

          @if(!empty($freelancer->skills))
            <div class="mt-3">
              <h5>{{ __('Compétences principales') }}</h5>
              @foreach($freelancer->skills as $skill)
                <span class="badge bg-light text-dark mb-1">{{ $skill }}</span>
              @endforeach
            </div>
          @endif

          @if(!empty($freelancer->languages))
            <div class="mt-3">
              <h5>{{ __('Langues') }}</h5>
              @foreach($freelancer->languages as $lang)
                <span class="badge bg-light text-dark mb-1">
                  {{ $lang['code'] ?? '' }} @if(!empty($lang['level'])) – {{ $lang['level'] }} @endif
                </span>
              @endforeach
            </div>
          @endif
        </div>

        <div class="col-lg-4">
          <div class="card border-0 shadow-sm mb-3 sticky-top" style="top: 20px;">
            <div class="card-body">
              <h5 class="card-title mb-3">{{ __('Abonnement Junspro') }}</h5>

              <!-- Module Séance d'essai -->
              <div class="mb-4">
                <h6 class="mb-2">{{ __('Séance d'essai (1h)') }}</h6>
                <p class="small text-muted mb-2">
                  {{ __('50 min de travail + 10 min de rapport détaillé sur l'avancement.') }}
                </p>
                <form method="POST" action="{{ route('freelance.trial', $freelancer->id) }}">
                  @csrf
                  <button type="submit" class="btn btn-outline-primary w-100">
                    {{ __('Réserver une séance d'essai') }} - {{ number_format($freelancer->hourly_rate, 2, ',', ' ') }} €
                  </button>
                </form>
              </div>

              <hr>

              <!-- Module Abonnement hebdomadaire -->
              <div>
                <h6 class="mb-3">{{ __('Passer à l'abonnement') }}</h6>
                <p class="small text-muted mb-3">
                  {{ __('Choisissez votre formule hebdomadaire (1 à 24h/semaine)') }}
                </p>

                <form method="POST" action="{{ route('freelance.subscribe', $freelancer->id) }}" id="subscriptionForm">
                  @csrf
                  
                  <!-- Choix heures/semaine -->
                  <div class="mb-3">
                    <label class="form-label small">{{ __('Heures par semaine') }}</label>
                    <div class="btn-group w-100" role="group">
                      @foreach([1, 2, 4, 8, 12, 16, 20, 24] as $hours)
                        <input type="radio" class="btn-check" name="weekly_hours" id="hours_{{ $hours }}" 
                          value="{{ $hours }}" {{ $loop->first ? 'checked' : '' }} required>
                        <label class="btn btn-outline-primary" for="hours_{{ $hours }}">{{ $hours }}h</label>
                      @endforeach
                    </div>
                  </div>

                  <!-- Options Express -->
                  <div class="mb-3">
                    <label class="form-label small">{{ __('Options Express (optionnel)') }}</label>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="express_24h" id="express_24h" value="1">
                      <label class="form-check-label" for="express_24h">
                        {{ __('Express 24h') }} <small class="text-muted">(+30%)</small>
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="express_48h" id="express_48h" value="1">
                      <label class="form-check-label" for="express_48h">
                        {{ __('Express 48h') }} <small class="text-muted">(+20%)</small>
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="express_72h" id="express_72h" value="1">
                      <label class="form-check-label" for="express_72h">
                        {{ __('Express 72h') }} <small class="text-muted">(+10%)</small>
                      </label>
                    </div>
                  </div>

                  <!-- Calcul automatique du total -->
                  <div class="alert alert-info mb-3">
                    <div class="d-flex justify-content-between align-items-center">
                      <span><strong>{{ __('Total sur 4 semaines') }} :</strong></span>
                      <span class="h5 mb-0" id="total_4_weeks">
                        {{ number_format($freelancer->hourly_rate * 1 * 4, 2, ',', ' ') }} €
                      </span>
                    </div>
                    <small class="text-muted d-block mt-1" id="calculation_details">
                      {{ __('1h/semaine × :price €/h × 4 semaines', ['price' => number_format($freelancer->hourly_rate, 2, ',', ' ')]) }}
                    </small>
                  </div>

                  <button type="submit" class="btn btn-primary w-100">
                    {{ __('Souscrire à l'abonnement') }}
                  </button>
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
      document.addEventListener('DOMContentLoaded', function() {
        const hourlyRate = {{ $freelancer->hourly_rate }};
        const form = document.getElementById('subscriptionForm');
        if (!form) return;
        
        const totalElement = document.getElementById('total_4_weeks');
        const detailsElement = document.getElementById('calculation_details');
        
        function calculateTotal() {
          const weeklyHours = parseInt(document.querySelector('input[name="weekly_hours"]:checked')?.value || 1);
          const express24h = document.getElementById('express_24h').checked;
          const express48h = document.getElementById('express_48h').checked;
          const express72h = document.getElementById('express_72h').checked;
          
          let baseTotal = weeklyHours * hourlyRate * 4;
          let multiplier = 1;
          let expressText = '';
          
          if (express24h) {
            multiplier = 1.30;
            expressText = ' (+30% Express 24h)';
          } else if (express48h) {
            multiplier = 1.20;
            expressText = ' (+20% Express 48h)';
          } else if (express72h) {
            multiplier = 1.10;
            expressText = ' (+10% Express 72h)';
          }
          
          const finalTotal = baseTotal * multiplier;
          
          if (totalElement) {
            totalElement.textContent = finalTotal.toFixed(2).replace('.', ',') + ' €';
          }
          if (detailsElement) {
            detailsElement.textContent = `${weeklyHours}h/semaine × ${hourlyRate.toFixed(2).replace('.', ',')} €/h × 4 semaines${expressText}`;
          }
        }
        
        // Écouter les changements
        form.querySelectorAll('input[type="radio"], input[type="checkbox"]').forEach(input => {
          input.addEventListener('change', calculateTotal);
        });
        
        // Calcul initial
        calculateTotal();
      });
    </script>
  @endsection
@endsection




