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
      <!-- Header du profil -->
      <div class="row mb-30">
        <div class="col-lg-8">
          <div class="d-flex align-items-center mb-4">
            <div class="me-3">
              @if($user->image)
                <img src="{{ asset('assets/img/users/' . $user->image) }}" 
                     alt="{{ $user->name }}" 
                     class="rounded-circle" 
                     style="width: 80px; height: 80px; object-fit: cover;">
              @else
                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center"
                     style="width: 80px; height: 80px; background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);">
                  <span class="fw-bold fs-3 text-white">
                    {{ strtoupper(substr($user->name ?? 'F', 0, 1)) }}
                  </span>
                </div>
              @endif
            </div>
            <div class="flex-grow-1">
              <h1 class="h3 mb-2">{{ $user->name }}</h1>
              <div class="d-flex align-items-center gap-2 mb-2">
                <span class="badge bg-secondary-subtle text-secondary">
                  <i class="fas fa-map-marker-alt me-1"></i>{{ $user->country_code ?? '–' }}
                </span>
                @if($user->is_super_freelancer ?? false)
                  <span class="badge bg-warning text-dark">
                    <i class="fas fa-crown me-1"></i>{{ __('Super Freelance') }}
                  </span>
                @endif
                @if($freelancer->is_verified || ($user->is_verified_freelancer ?? false))
                  <span class="badge" style="background: rgba(79, 70, 229, 0.12); color: #4F46E5;">
                    <i class="fas fa-check-circle me-1"></i>{{ __('Vérifié') }}
                  </span>
                @endif
              </div>
              <div class="d-flex align-items-center gap-3">
                <div>
                  <strong>{{ __('Tarif horaire') }} :</strong>
                  <span class="text-primary fw-bold">{{ number_format($freelancer->hourly_rate, 2, ',', ' ') }} € / h</span>
                </div>
                @if(isset($averageRating))
                  <div>
                    <strong>{{ __('Note moyenne') }} :</strong>
                    <span class="text-warning">
                      @for($i = 0; $i < 5; $i++)
                        <i class="fas fa-star {{ $i < floor($averageRating) ? '' : 'far' }}"></i>
                      @endfor
                      <span class="ms-1">({{ $averageRating }})</span>
                    </span>
                  </div>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <!-- Colonne principale -->
        <div class="col-lg-8">
          <!-- À propos -->
          @if($freelancer->bio)
            <div class="card mb-4">
              <div class="card-body">
                <h5 class="card-title mb-3">{{ __('À propos') }}</h5>
                <p class="mb-0">{{ $freelancer->bio }}</p>
              </div>
            </div>
          @endif

          <!-- Compétences -->
          @if(!empty($freelancer->skills))
            <div class="card mb-4">
              <div class="card-body">
                <h5 class="card-title mb-3">{{ __('Compétences principales') }}</h5>
                <div class="d-flex flex-wrap gap-2">
                  @foreach($freelancer->skills as $skill)
                    <span class="badge bg-light text-dark border">{{ $skill }}</span>
                  @endforeach
                </div>
              </div>
            </div>
          @endif

          <!-- Langues -->
          @if(!empty($freelancer->languages))
            <div class="card mb-4">
              <div class="card-body">
                <h5 class="card-title mb-3">{{ __('Langues') }}</h5>
                <div class="d-flex flex-wrap gap-2">
                  @foreach($freelancer->languages as $lang)
                    <span class="badge bg-light text-dark border">
                      {{ $lang['code'] ?? '' }} @if(!empty($lang['level'])) – {{ $lang['level'] }} @endif
                    </span>
                  @endforeach
                </div>
              </div>
            </div>
          @endif

          <!-- Disponibilités -->
          @if(!empty($availability))
            <div class="card mb-4">
              <div class="card-body">
                <h5 class="card-title mb-3">{{ __('Disponibilités') }}</h5>
                <p class="text-muted mb-0">
                  @if(is_array($availability) && isset($availability['hours_per_week']))
                    {{ __('Disponible') }} : {{ $availability['hours_per_week'] }}h / {{ __('semaine') }}
                  @else
                    {{ __('Disponibilités à confirmer') }}
                  @endif
                </p>
              </div>
            </div>
          @endif

          <!-- Portfolio -->
          <div class="card mb-4">
            <div class="card-body">
              <h5 class="card-title mb-3">{{ __('Portfolio') }}</h5>
              <p class="text-muted mb-0">{{ __('Portfolio en cours de construction...') }}</p>
              <!-- TODO: Ajouter grid d'images/vidéos du portfolio -->
            </div>
          </div>

          <!-- Services proposés -->
          @if($services->isNotEmpty())
            <div class="card mb-4">
              <div class="card-body">
                <h5 class="card-title mb-3">{{ __('Services proposés') }}</h5>
                <div class="row g-3">
                  @foreach($services as $service)
                    @php
                      $content = $service->content->first();
                    @endphp
                    @if($content)
                      <div class="col-md-6">
                        <div class="border rounded p-3">
                          <h6 class="mb-2">
                            <a href="{{ route('service_details', ['slug' => $content->slug, 'id' => $service->id]) }}" 
                               class="text-decoration-none">
                              {{ $content->title }}
                            </a>
                          </h6>
                          @if($service->average_rating > 0)
                            <div class="mb-2">
                              @for($i = 0; $i < 5; $i++)
                                <i class="fas fa-star {{ $i < floor($service->average_rating) ? 'text-warning' : 'text-muted' }}"></i>
                              @endfor
                              <small class="text-muted ms-1">({{ $service->average_rating }})</small>
                            </div>
                          @endif
                        </div>
                      </div>
                    @endif
                  @endforeach
                </div>
              </div>
            </div>
          @endif

          <!-- Avis (Reviews) -->
          @if($reviews->isNotEmpty())
            <div class="card mb-4">
              <div class="card-body">
                <h5 class="card-title mb-3">{{ __('Avis clients') }}</h5>
                @foreach($reviews as $review)
                  <div class="border-bottom pb-3 mb-3">
                    <div class="d-flex align-items-center mb-2">
                      <div class="me-2">
                        @if($review->user->image)
                          <img src="{{ asset('assets/img/users/' . $review->user->image) }}" 
                               alt="{{ $review->user->name }}" 
                               class="rounded-circle" 
                               style="width: 40px; height: 40px; object-fit: cover;">
                        @else
                          <div class="rounded-circle bg-light d-flex align-items-center justify-content-center"
                               style="width: 40px; height: 40px;">
                            <span class="fw-bold">{{ strtoupper(substr($review->user->name ?? 'U', 0, 1)) }}</span>
                          </div>
                        @endif
                      </div>
                      <div class="flex-grow-1">
                        <strong>{{ $review->user->name ?? __('Utilisateur') }}</strong>
                        <div>
                          @for($i = 0; $i < 5; $i++)
                            <i class="fas fa-star {{ $i < $review->rating ? 'text-warning' : 'text-muted' }}"></i>
                          @endfor
                          <small class="text-muted ms-2">{{ $review->created_at->format('d/m/Y') }}</small>
                        </div>
                      </div>
                    </div>
                    @if($review->comment)
                      <p class="mb-0">{{ $review->comment }}</p>
                    @endif
                  </div>
                @endforeach
              </div>
            </div>
          @endif
        </div>

        <!-- Colonne latérale - Module Abonnement -->
        <div class="col-lg-4">
          <div class="card border-0 shadow-sm mb-3 sticky-top" style="top: 20px;">
            <div class="card-body">
              <h5 class="card-title mb-3">
                <i class="fas fa-calendar-check me-2 text-primary"></i>
                {{ __('Abonnement Junspro') }}
              </h5>

              <!-- Module Séance d'essai -->
              <div class="mb-4 pb-4 border-bottom">
                <h6 class="mb-2">{{ __('Séance d\'essai (1h)') }}</h6>
                <p class="small text-muted mb-3">
                  {{ __('50 min de travail + 10 min de rapport détaillé sur l\'avancement.') }}
                </p>
                @auth('web')
                  <form method="POST" action="{{ route('freelance.trial', $freelancer->id) }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-primary w-100">
                      <i class="fas fa-play-circle me-2"></i>
                      {{ __('Réserver une séance d\'essai') }}
                    </button>
                  </form>
                @else
                  <a href="{{ route('user.login') }}" class="btn btn-outline-primary w-100">
                    <i class="fas fa-sign-in-alt me-2"></i>
                    {{ __('Se connecter pour réserver') }}
                  </a>
                @endauth
                <p class="small text-center text-muted mt-2 mb-0">
                  {{ number_format($freelancer->hourly_rate, 2, ',', ' ') }} €
                </p>
              </div>

              <!-- Module Abonnement hebdomadaire -->
              <div>
                <h6 class="mb-3">{{ __('Passer à l\'abonnement') }}</h6>
                <p class="small text-muted mb-3">
                  {{ __('Choisissez votre formule hebdomadaire :') }}
                </p>

                @auth('web')
                  <form method="POST" action="{{ route('freelance.subscribe', $freelancer->id) }}" id="subscriptionForm">
                    @csrf

                    <!-- Choix formules (1h, 2h, 4h, 8h, 12h, 16h) -->
                    <div class="mb-3">
                      <label class="form-label small fw-bold">{{ __('Heures par semaine') }}</label>
                      <div class="btn-group-vertical w-100" role="group">
                        @foreach([1, 2, 4, 8, 12, 16] as $hours)
                          <input type="radio" 
                                 class="btn-check" 
                                 name="weekly_hours" 
                                 id="hours_{{ $hours }}" 
                                 value="{{ $hours }}"
                                 {{ $loop->first ? 'checked' : '' }}>
                          <label class="btn btn-outline-primary" for="hours_{{ $hours }}">
                            {{ $hours }}h / {{ __('semaine') }}
                          </label>
                        @endforeach
                      </div>
                    </div>

                    <!-- Options Express -->
                    <div class="mb-3">
                      <label class="form-label small fw-bold">{{ __('Délai de livraison') }}</label>
                      <div class="form-check mb-2">
                        <input class="form-check-input" 
                               type="radio" 
                               name="delivery_mode" 
                               id="delivery_standard" 
                               value="standard"
                               checked>
                        <label class="form-check-label" for="delivery_standard">
                          {{ __('Standard') }} <small class="text-muted">({{ __('Livraison hebdomadaire') }})</small>
                        </label>
                      </div>
                      <div class="form-check mb-2">
                        <input class="form-check-input" 
                               type="radio" 
                               name="delivery_mode" 
                               id="delivery_express_72h" 
                               value="express_72h">
                        <label class="form-check-label" for="delivery_express_72h">
                          {{ __('Express 72h') }} <small class="text-muted">(+10%)</small>
                        </label>
                      </div>
                      <div class="form-check mb-2">
                        <input class="form-check-input" 
                               type="radio" 
                               name="delivery_mode" 
                               id="delivery_express_48h" 
                               value="express_48h">
                        <label class="form-check-label" for="delivery_express_48h">
                          {{ __('Express 48h') }} <small class="text-muted">(+20%)</small>
                        </label>
                      </div>
                      <div class="form-check mb-2">
                        <input class="form-check-input" 
                               type="radio" 
                               name="delivery_mode" 
                               id="delivery_express_24h" 
                               value="express_24h">
                        <label class="form-check-label" for="delivery_express_24h">
                          {{ __('Express 24h') }} <small class="text-muted">(+30%)</small>
                        </label>
                      </div>
                    </div>

                    <!-- Calcul automatique du total sur 4 semaines -->
                    <div class="alert alert-info mb-3">
                      <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="small">{{ __('Total sur 4 semaines') }} :</span>
                        <strong class="fs-5 text-primary" id="total_4_weeks">0,00 €</strong>
                      </div>
                      <small class="text-muted" id="calculation_details"></small>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                      <i class="fas fa-check-circle me-2"></i>
                      {{ __('S\'abonner') }}
                    </button>
                  </form>
                @else
                  <a href="{{ route('user.login') }}" class="btn btn-primary w-100">
                    <i class="fas fa-sign-in-alt me-2"></i>
                    {{ __('Se connecter pour s\'abonner') }}
                  </a>
                @endauth
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
          const deliveryMode = document.querySelector('input[name="delivery_mode"]:checked')?.value || 'standard';
          
          let baseTotal = weeklyHours * hourlyRate * 4;
          let multiplier = 1;
          let expressText = '';
          
          if (deliveryMode === 'express_24h') {
            multiplier = 1.30;
            expressText = ' (+30% Express 24h)';
          } else if (deliveryMode === 'express_48h') {
            multiplier = 1.20;
            expressText = ' (+20% Express 48h)';
          } else if (deliveryMode === 'express_72h') {
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
        form.querySelectorAll('input[type="radio"]').forEach(input => {
          input.addEventListener('change', calculateTotal);
        });
        
        // Calcul initial
        calculateTotal();
      });
    </script>
  @endsection
@endsection
