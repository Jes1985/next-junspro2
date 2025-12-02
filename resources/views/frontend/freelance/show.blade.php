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
          <div class="card border-0 shadow-sm mb-3">
            <div class="card-body">
              <h5 class="card-title mb-3">{{ __('Abonnement Junspro') }}</h5>

              <form method="POST" action="{{ route('freelance.trial', $freelancer->id) }}">
                @csrf
                <p class="small text-muted mb-2">
                  {{ __('Commencez par une séance d’essai de 1h (50 min travail + 10 min rapport).') }}
                </p>
                <p class="mb-1">
                  <strong>{{ __('Tarif estimé pour 4 semaines') }}</strong>
                </p>
                <ul class="list-unstyled small text-muted mb-3">
                  <li>{{ __('1h/semaine : :price', ['price' => number_format($freelancer->hourly_rate * 4, 2, ',', ' ') . ' €']) }}</li>
                  <li>{{ __('4h/semaine : :price', ['price' => number_format($freelancer->hourly_rate * 4 * 4, 2, ',', ' ') . ' €']) }}</li>
                  <li>{{ __('8h/semaine : :price', ['price' => number_format($freelancer->hourly_rate * 8 * 4, 2, ',', ' ') . ' €']) }}</li>
                </ul>

                <button type="submit" class="btn btn-primary w-100">
                  {{ __('Réserver une séance d’essai (1h)') }}
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection




