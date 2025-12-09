@extends('frontend.layout')

@section('pageHeading')
  {{ __('Tarification') }}
@endsection

@section('metaKeywords')
  {{ __('tarification, prix, abonnement, freelance, junspro') }}
@endsection

@section('metaDescription')
  {{ __('Découvrez nos formules d\'abonnement flexibles de 1 à 24h par semaine. Tarifs transparents et adaptés à tous les projets.') }}
@endsection

@section('content')
  {{-- Breadcrumb supprimé pour éviter la superposition avec le hero premium --}}
  <!-- Hero Pricing Premium - Style page d'accueil (raffiné et classe) -->
  <section class="pricing-hero-premium">
    <div class="pricing-hero-container">
      <div class="pricing-hero-content">
        <h1 class="pricing-hero-title">
          <span class="hero-title-line-1">{{ __('Tarification') }} <span class="highlight">{{ __('transparente') }}</span></span>
          <span class="hero-title-line-2">{{ __('et flexible') }}</span>
        </h1>
        @if(isset($selectedFreelancer) && $selectedFreelancer)
          <div class="pricing-hero-freelancer-info mb-4">
            <span class="hero-stat-text">{{ __('Freelance sélectionné') }} : {{ $selectedFreelancer->user->name ?? 'Freelance' }} ({{ number_format($selectedFreelancer->hourly_rate, 2, ',', ' ') }} €/h)</span>
          </div>
        @endif
        <p class="pricing-hero-subtitle">
          {{ __('Explorez nos freelances experts, puis choisissez la formule d\'abonnement qui correspond à vos besoins. De 1 à 24h par semaine, adaptez selon l\'évolution de votre projet.') }}
        </p>
        <div class="pricing-hero-stats">
          <span class="hero-stat-text">{{ __('+10 000 freelances vérifiés') }}</span>
        </div>
      </div>
    </div>
  </section>

  <!-- Pricing Plans Section -->
  <section class="pt-60 pb-80">
    <div class="container">
      <div class="row mb-50">
        <div class="col-12 text-center">
          <h2 class="h3 mb-10">{{ __('Nos formules d\'abonnement') }}</h2>
          <p class="text-muted">
            {{ __('Une fois que vous aurez trouvé le freelance qui vous convient, vous pourrez choisir votre formule d\'abonnement. Le prix dépend du tarif horaire du freelance choisi (entre 10€ et 299€/h)') }}
          </p>
        </div>
      </div>

      <div class="row g-4">
        @foreach($subscriptionPlans as $plan)
          <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
            <div class="card border-0 shadow-lg h-100 pricing-card position-relative overflow-hidden">
              @if($loop->index == 3 || $loop->index == 4)
                <div class="position-absolute top-0 end-0 text-white px-3 py-1" style="background: linear-gradient(135deg, #4169E1 0%, #7C3AED 100%); font-size: 11px; transform: rotate(15deg) translate(15px, 5px); border-radius: 4px;">
                  {{ __('Populaire') }}
                </div>
              @endif
              <div class="card-body p-4 text-center">
                <div class="mb-3">
                  <div class="d-inline-flex justify-content-center align-items-center rounded-circle bg-primary-soft mb-3" style="width: 60px; height: 60px;">
                    <i class="{{ $plan['icon'] }} fa-2x text-primary"></i>
                  </div>
                </div>
                <h4 class="h5 mb-2 fw-bold">{{ $plan['name'] }}</h4>
                <p class="text-muted small mb-3">{{ $plan['description'] }}</p>
                <div class="mb-3">
                  <span class="h3 text-primary fw-bold">{{ $plan['hours_per_week'] }}h</span>
                  <span class="text-muted">/semaine</span>
                </div>
                <div class="mb-3">
                  <small class="text-muted d-block">{{ $plan['hours_per_month'] }}h par mois</small>
                  <small class="text-muted">(4 semaines)</small>
                </div>
                @if(isset($selectedFreelancer) && $selectedFreelancer)
                  <div class="mb-3">
                    <small class="text-muted d-block">
                      <strong>{{ __('Prix total') }} :</strong>
                      <span class="text-primary fw-bold">
                        {{ number_format($selectedFreelancer->hourly_rate * $plan['hours_per_week'] * 4, 2, ',', ' ') }} €
                      </span>
                    </small>
                    <small class="text-muted">
                      ({{ $plan['hours_per_week'] }}h × {{ number_format($selectedFreelancer->hourly_rate, 2, ',', ' ') }} €/h × 4)
                    </small>
                  </div>
                @endif
                <div class="mt-auto pt-3">
                  @if(isset($selectedFreelancer) && $selectedFreelancer)
                    <form method="POST" action="{{ route('pricing.subscribe') }}" class="w-100">
                      @csrf
                      <input type="hidden" name="freelancer_id" value="{{ $selectedFreelancer->id }}">
                      <input type="hidden" name="weekly_hours" value="{{ $plan['hours_per_week'] }}">
                      <button type="submit" class="btn btn-primary btn-sm w-100">
                        {{ __('Choisir cet abonnement') }}
                      </button>
                    </form>
                  @else
                    <a href="{{ route('explore') }}" class="btn btn-primary btn-sm w-100">
                      {{ __('Choisir cet abonnement') }}
                    </a>
                  @endif
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      <div class="row mt-50">
        <div class="col-12 text-center">
          <p class="text-muted mb-0">
            <i class="fas fa-info-circle text-primary"></i>
            {{ __('Le prix final = (heures/semaine × tarif horaire du freelance × 4) + options Express si choisies') }}
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- Express Options Section -->
  <section class="pt-60 pb-80 bg-light">
    <div class="container">
      <div class="row mb-50">
        <div class="col-12 text-center">
          <h2 class="h3 mb-10">{{ __('Options Express (optionnelles)') }}</h2>
          <p class="text-muted">
            {{ __('Accélérez vos livraisons avec nos options Express') }}
          </p>
        </div>
      </div>

      <div class="row g-4 justify-content-center">
        @foreach($expressOptions as $option)
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
            <div class="card border-0 shadow-lg h-100 express-card">
              <div class="card-body p-4 text-center">
                <div class="mb-3">
                  <div class="d-inline-flex justify-content-center align-items-center rounded-circle mb-3" style="width: 60px; height: 60px; background: linear-gradient(135deg, rgba(65, 105, 225, 0.1) 0%, rgba(124, 58, 237, 0.1) 100%);">
                    <i class="fas fa-bolt fa-2x" style="color: #4169E1;"></i>
                  </div>
                </div>
                <h5 class="mb-2 fw-bold">{{ $option['name'] }}</h5>
                <div class="mb-3">
                  <span class="badge text-white fs-5 px-3 py-2" style="background: linear-gradient(135deg, #4169E1 0%, #7C3AED 100%);">{{ $option['percentage'] }}</span>
                </div>
                <p class="text-muted small mb-0">{{ $option['description'] }}</p>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- How It Works Section -->
  <section class="pt-60 pb-80">
    <div class="container">
      <div class="row mb-50">
        <div class="col-12 text-center">
          <h2 class="h3 mb-10">{{ __('Comment ça fonctionne ?') }}</h2>
        </div>
      </div>

      <div class="row g-4">
        <div class="col-md-4" data-aos="fade-up">
          <div class="text-center">
            <div class="mb-3">
              <span class="d-inline-flex justify-content-center align-items-center rounded-circle bg-primary text-white"
                style="width: 60px; height: 60px; font-size: 24px; font-weight: bold;">1</span>
            </div>
            <h5 class="mb-2">{{ __('1. Trouvez votre freelance') }}</h5>
            <p class="text-muted small">
              {{ __('Explorez notre catalogue et trouvez le freelance expert qui correspond à votre projet') }}
            </p>
          </div>
        </div>
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
          <div class="text-center">
            <div class="mb-3">
              <span class="d-inline-flex justify-content-center align-items-center rounded-circle bg-primary text-white"
                style="width: 60px; height: 60px; font-size: 24px; font-weight: bold;">2</span>
            </div>
            <h5 class="mb-2">{{ __('2. Séance d\'essai (1h)') }}</h5>
            <p class="text-muted small">
              {{ __('Testez le freelance avec une séance d\'essai de 1h (50 min travail + 10 min rapport)') }}
            </p>
          </div>
        </div>
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
          <div class="text-center">
            <div class="mb-3">
              <span class="d-inline-flex justify-content-center align-items-center rounded-circle bg-primary text-white"
                style="width: 60px; height: 60px; font-size: 24px; font-weight: bold;">3</span>
            </div>
            <h5 class="mb-2">{{ __('3. Choisissez votre abonnement') }}</h5>
            <p class="text-muted small">
              {{ __('Sur la page du freelance, choisissez votre formule (1-24h/semaine) et finalisez votre abonnement') }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Guarantees Section -->
  <section class="pt-60 pb-80 bg-light">
    <div class="container">
      <div class="row mb-50">
        <div class="col-12 text-center">
          <h2 class="h3 mb-10">{{ __('Nos garanties') }}</h2>
        </div>
      </div>

      <div class="row g-4">
        @foreach($guarantees as $guarantee)
          <div class="col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
            <div class="card border-0 shadow-sm h-100">
              <div class="card-body p-4">
                <div class="mb-3">
                  <i class="{{ $guarantee['icon'] }} fa-2x text-primary"></i>
                </div>
                <h5 class="mb-2">{{ $guarantee['title'] }}</h5>
                <p class="text-muted small mb-0">{{ $guarantee['description'] }}</p>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- CTA Section -->
  <section class="pt-60 pb-80">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 text-center" data-aos="fade-up">
          <h2 class="h3 mb-20">{{ __('Prêt à commencer ?') }}</h2>
          <p class="lead text-muted mb-30">
            {{ __('Explorez notre catalogue de freelances experts et trouvez celui qui correspond à votre projet.') }}
          </p>
          <div class="d-flex gap-3 justify-content-center flex-wrap">
            <a href="{{ route('explore') }}" class="btn btn-lg btn-primary">
              {{ __('Choisir cet abonnement') }}
            </a>
            <a href="{{ route('contact') }}" class="btn btn-lg btn-outline-primary">
              {{ __('Nous contacter') }}
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <style>
    :root {
      --royal-blue: #4169E1;
      --royal-blue-dark: #1E40AF;
      --purple: #7C3AED;
      --purple-light: #8B5CF6;
      --gradient-primary: linear-gradient(135deg, #4169E1 0%, #7C3AED 100%);
      --gradient-secondary: linear-gradient(135deg, #7C3AED 0%, #4169E1 100%);
    }

    /* Hero Pricing Premium - Style page d'accueil (raffiné et classe) */
    .pricing-hero-premium {
      background: linear-gradient(135deg, #020617 0%, #111827 30%, #1d2a6d 70%, #5b21b6 100%);
      position: relative;
      overflow: hidden;
      padding: 120px 0 90px;
      margin-top: 0;
      min-height: 60vh;
      display: flex;
      align-items: center;
      z-index: 1;
    }

    /* S'assurer que le header ne se superpose pas au hero */
    body .pricing-hero-premium {
      margin-top: 0 !important;
      padding-top: 120px !important;
    }

    /* Texture abstraite bleu/violet (comme le drapé doré de ComeUp) */
    .pricing-hero-premium::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: 
        radial-gradient(circle at 20% 50%, rgba(79, 70, 229, 0.15) 0%, transparent 50%),
        radial-gradient(circle at 80% 80%, rgba(124, 58, 237, 0.12) 0%, transparent 50%),
        linear-gradient(135deg, rgba(65, 105, 225, 0.08) 0%, transparent 50%);
      opacity: 0.6;
      z-index: 1;
    }

    /* Dégradé noir transparent sur la moitié gauche pour garantir la lisibilité */
    .pricing-hero-premium::after {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 55%;
      height: 100%;
      background: linear-gradient(to right, rgba(2, 6, 23, 0.4) 0%, transparent 100%);
      z-index: 1;
    }

    .pricing-hero-container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 24px;
      position: relative;
      z-index: 2;
    }

    .pricing-hero-content {
      text-align: center;
      color: white;
      max-width: 900px;
      margin: 0 auto;
      position: relative;
      z-index: 2;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }

    .pricing-hero-title {
      font-size: 3.8rem;
      font-weight: 400;
      color: #FFFFFF;
      line-height: 1.2;
      margin-bottom: 2rem;
      text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
      display: block;
      letter-spacing: -0.02em;
      max-width: 100%;
      width: 100%;
      text-align: center;
    }

    /* Style ComeUp : 2 lignes avec mot-clé en couleur accent */
    .pricing-hero-title .hero-title-line-1 {
      display: block !important;
      line-height: 1.2;
      font-weight: 400;
      color: #FFFFFF;
      margin-bottom: 0.75rem;
      white-space: nowrap;
      text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    .pricing-hero-title .hero-title-line-1 .highlight {
      font-weight: 600;
      background: linear-gradient(135deg, #60A5FA 0%, #A78BFA 50%, #C084FC 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      color: #60A5FA;
      display: inline-block;
    }

    .pricing-hero-title .hero-title-line-2 {
      display: block !important;
      line-height: 1.2;
      font-weight: 400;
      color: #FFFFFF;
      white-space: nowrap;
      text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    .pricing-hero-subtitle {
      font-size: 1.15rem;
      color: rgba(255, 255, 255, 0.85);
      margin-bottom: 2.5rem;
      text-shadow: 0 1px 4px rgba(0, 0, 0, 0.2);
      font-weight: 400;
      line-height: 1.6;
      max-width: 90%;
      margin-left: auto;
      margin-right: auto;
      text-align: center;
    }

    .pricing-hero-freelancer-info {
      margin-bottom: 1.5rem;
    }

    .pricing-hero-stats {
      margin-top: 1rem;
    }

    .hero-stat-text {
      display: inline-block;
      padding: 10px 24px;
      background: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      border-radius: 50px;
      font-size: 0.95rem;
      font-weight: 600;
      color: white;
      border: 1px solid rgba(124, 58, 237, 0.3);
      box-shadow: 0 4px 12px rgba(30, 64, 175, 0.3);
    }

    /* Responsive */
    @media (max-width: 1024px) {
      .pricing-hero-premium {
        padding: 130px 0 90px !important;
      }

      .pricing-hero-title {
        font-size: 2.8rem;
      }
    }

    @media (max-width: 768px) {
      .pricing-hero-premium {
        padding: 100px 0 70px !important;
      }

      .pricing-hero-title {
        font-size: 2rem;
      }

      .pricing-hero-subtitle {
        font-size: 1rem;
      }

      .hero-stat-text {
        font-size: 0.875rem;
        padding: 8px 18px;
      }
    }

    .pricing-card {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      border-radius: 12px;
      border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .pricing-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 15px 40px rgba(65, 105, 225, 0.2) !important;
      border-color: var(--royal-blue);
    }

    .pricing-card .card-body {
      display: flex;
      flex-direction: column;
      min-height: 300px;
    }

    .express-card {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      border-radius: 12px;
    }

    .express-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 30px rgba(124, 58, 237, 0.15) !important;
    }

    .bg-primary-soft {
      background: linear-gradient(135deg, rgba(65, 105, 225, 0.1) 0%, rgba(124, 58, 237, 0.1) 100%);
    }

    .bg-warning-soft {
      background: linear-gradient(135deg, rgba(65, 105, 225, 0.1) 0%, rgba(124, 58, 237, 0.1) 100%);
    }

    /* Remplacement de la couleur verte par bleu royal/violet */
    .btn-primary {
      background: var(--gradient-primary) !important;
      border: none !important;
      color: white !important;
    }

    .btn-primary:hover {
      background: var(--gradient-secondary) !important;
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(65, 105, 225, 0.3) !important;
    }

    .btn-primary:focus,
    .btn-primary:active {
      background: var(--gradient-primary) !important;
      box-shadow: 0 0 0 0.2rem rgba(65, 105, 225, 0.25) !important;
    }

    .text-primary {
      color: var(--royal-blue) !important;
    }

    .badge.bg-primary {
      background: var(--gradient-primary) !important;
    }

    @media (max-width: 768px) {
      .pricing-card .card-body {
        min-height: auto;
      }
    }

    /* Animation pour les garanties */
    .card {
      transition: all 0.3s ease;
    }

    .card:hover {
      transform: translateY(-3px);
    }
  </style>
@endsection

