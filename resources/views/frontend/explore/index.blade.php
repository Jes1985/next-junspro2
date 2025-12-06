@extends('frontend.layout')

@section('pageHeading')
  {{ __('Explorer les freelances') }}
@endsection

@section('metaKeywords')
  {{ __('freelance, projet, abonnement, junspro') }}
@endsection

@section('metaDescription')
  {{ __('Trouvez un freelance expert pour votre projet avec abonnements hebdomadaires flexibles.') }}
@endsection

@section('content')
  <section class="pt-60 pb-40">
    <div class="container">
      <div class="row mb-30">
        <div class="col-12">
          <h1 class="h3 mb-10">{{ __('Trouvez le freelance parfait pour votre projet') }}</h1>
          <p class="text-muted mb-0">
            {{ __('Filtrez par prix horaire, langues, pays et découvrez les profils les plus adaptés à votre besoin.') }}
          </p>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-3 mb-4">
          <form method="GET" action="{{ route('explore') }}" class="card border-0 shadow-sm p-3">
            <h6 class="mb-3">{{ __('Filtres') }}</h6>

            <div class="mb-3">
              <label class="form-label">{{ __('Recherche') }}</label>
              <input type="text" name="search" value="{{ $filters['search'] ?? '' }}" class="form-control"
                placeholder="{{ __('Mot-clé, compétence, type de projet...') }}">
            </div>

            <div class="mb-3">
              <label class="form-label">{{ __('Tarif horaire (€ / h)') }}</label>
              <div class="d-flex gap-2">
                <input type="number" name="price_min" class="form-control" min="10" max="299"
                  value="{{ $filters['price_min'] ?? 10 }}">
                <input type="number" name="price_max" class="form-control" min="10" max="299"
                  value="{{ $filters['price_max'] ?? 299 }}">
              </div>
              <small class="text-muted d-block mt-1">{{ __('Entre 10€ et 299€ / heure') }}</small>
            </div>

            <div class="mb-3">
              <label class="form-label">{{ __('Langues') }}</label>
              <select name="languages[]" class="form-select" multiple>
                @foreach ($allLanguages as $language)
                  <option value="{{ $language->code }}"
                    @selected(in_array($language->code, $filters['languages'] ?? []))>
                    {{ $language->name }}
                  </option>
                @endforeach
              </select>
              <small class="text-muted d-block mt-1">
                {{ __('Maintenez Ctrl (Windows) ou Cmd (Mac) pour sélectionner plusieurs langues.') }}
              </small>
            </div>

            <div class="mb-3">
              <label class="form-label">{{ __('Pays') }}</label>
              <input type="text" name="country" class="form-control" value="{{ $filters['country'] ?? '' }}"
                placeholder="{{ __('Code pays (ex : FR, BE, CH)') }}">
            </div>

            <div class="mb-3">
              <label class="form-label">{{ __('Tri') }}</label>
              <select name="sort" class="form-select">
                <option value="best_match" @selected(($filters['sort'] ?? 'best_match') === 'best_match')>
                  {{ __('Meilleure correspondance') }}
                </option>
                <option value="lowest_price" @selected(($filters['sort'] ?? '') === 'lowest_price')>
                  {{ __('Prix le plus bas') }}
                </option>
                <option value="highest_price" @selected(($filters['sort'] ?? '') === 'highest_price')>
                  {{ __('Prix le plus élevé') }}
                </option>
                <option value="best_rating" @selected(($filters['sort'] ?? '') === 'best_rating')>
                  {{ __('Meilleure note') }}
                </option>
              </select>
            </div>

            <div class="form-check mb-3">
              <input class="form-check-input" type="checkbox" name="is_premium" value="1"
                id="is_premium" @checked(request()->boolean('is_premium'))>
              <label class="form-check-label" for="is_premium">
                {{ __('Freelances vérifiés / premium') }}
              </label>
            </div>

            <button type="submit" class="btn btn-primary w-100">
              {{ __('Appliquer les filtres') }}
            </button>
          </form>
        </div>

        <div class="col-lg-9">
          @if ($freelancers->isEmpty())
            <p class="text-muted mt-3">{{ __('Aucun freelance trouvé pour ces critères pour le moment.') }}</p>
          @else
            <div class="row g-3">
              @foreach ($freelancers as $freelancer)
                @php
                  $user = $freelancer->user;
                @endphp
                <div class="col-md-6 col-xl-4">
                  <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                      <div class="d-flex align-items-center mb-3">
                        <div class="me-3">
                          <div class="rounded-circle bg-light d-flex align-items-center justify-content-center"
                            style="width: 44px; height: 44px;">
                            <span class="fw-semibold">
                              {{ strtoupper(substr($user->name ?? 'F', 0, 1)) }}
                            </span>
                          </div>
                        </div>
                        <div class="flex-grow-1">
                          <h6 class="mb-0">{{ $user->name }}</h6>
                          <small class="text-muted">
                            {{ $user->country_code ?? '—' }}
                          </small>
                        </div>
                        @if($user->is_super_freelancer ?? false)
                          <span class="badge bg-primary ms-2">{{ __('Super Freelance') }}</span>
                        @endif
                      </div>

                      <p class="mb-2">
                        <strong>{{ __('Tarif') }} :</strong>
                        {{ number_format($freelancer->hourly_rate, 2, ',', ' ') }} € / h
                      </p>
                      <p class="mb-2">
                        <strong>{{ __('Score fiabilité') }} :</strong>
                        {{ $freelancer->reliability_score }} / 100
                      </p>

                      @if (!empty($freelancer->skills))
                        <div class="mb-2">
                          @foreach (array_slice($freelancer->skills, 0, 4) as $skill)
                            <span class="badge bg-light text-dark mb-1">{{ $skill }}</span>
                          @endforeach
                        </div>
                      @endif

                      <a href="#" class="btn btn-sm btn-outline-primary w-100 mt-2">
                        {{ __('Voir le profil') }}
                      </a>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>

            <div class="mt-4">
              {{ $freelancers->links() }}
            </div>
          @endif
        </div>
      </div>
    </div>
  </section>
@endsection




