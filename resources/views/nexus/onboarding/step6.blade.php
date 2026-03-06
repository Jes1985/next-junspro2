@extends('frontend.layout')

@section('style')
@include('nexus.onboarding._layout')
<style>
  .nx-activate-cta {
    background: var(--nx-gradient);
    border-radius: 20px;
    padding: 2rem;
    text-align: center;
    margin-bottom: 1.5rem;
    position: relative;
    overflow: hidden;
  }

  .nx-activate-cta::before {
    content:'';
    position:absolute; inset:0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Ccircle cx='30' cy='30' r='28'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
  }

  .nx-activate-cta > * { position: relative; z-index: 1; }

  .nx-activate-cta h2 {
    color: #fff;
    font-size: 1.5rem;
    font-weight: 800;
    margin-bottom: .5rem;
  }

  .nx-activate-cta p { color: rgba(255,255,255,.85); font-size:.95rem; margin: 0; }
</style>
@endsection

@section('content')
<div class="nx-ob-page">
  <div class="nx-ob-wrap">

    <div class="nx-badge"><span>✦</span> Onboarding NEXUS</div>
    @include('nexus.onboarding._stepper', ['current' => 6])

    @if(session('info'))
      <div class="nx-alert nx-alert-info mb-3"><span>ℹ️</span> {{ session('info') }}</div>
    @endif

    @if($errors->any())
      <div class="nx-alert nx-alert-error mb-3">
        <span>⚠️</span>
        <div>@foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach</div>
      </div>
    @endif

    <div class="nx-card">
      <h1 class="nx-title">Récap & Activation</h1>
      <p class="nx-subtitle">Vérifiez vos informations avant d'activer votre profil NEXUS. Vous pourrez modifier tout cela depuis votre espace membre.</p>

      {{-- CTA Activation --}}
      <div class="nx-activate-cta mb-4">
        <h2>✦ Votre profil NEXUS est prêt !</h2>
        <p>Lisez le récapitulatif ci-dessous, acceptez la charte et activez votre accès premium.</p>
      </div>

      {{-- Bloc 1 : Identité --}}
      <div class="nx-recap-block">
        <div class="nx-recap-title">
          <span>👤</span> Étape 1 — Mon identité
          <a href="{{ route('nexus.onboarding.step1') }}" class="nx-recap-edit">Modifier</a>
        </div>
        <div class="nx-recap-row"><strong>Prénom :</strong> {{ $saved['first_name'] ?? '—' }} {{ $saved['last_name'] ?? '' }}</div>
        <div class="nx-recap-row"><strong>Lieu :</strong> {{ $saved['city'] ?? '—' }}, {{ $saved['country'] ?? '' }}</div>
        @if(!empty($saved['bio']))
          <div class="nx-recap-row" style="display:block"><strong>Présentation :</strong>
            <span style="color:#6b7280;font-size:.875rem">{{ \Illuminate\Support\Str::limit($saved['bio'], 120) }}</span>
          </div>
        @endif
      </div>

      {{-- Bloc 2 : Bien d'échange --}}
      <div class="nx-recap-block">
        <div class="nx-recap-title">
          <span>🏠</span> Étape 2 — Mon bien
          <a href="{{ route('nexus.onboarding.step2') }}" class="nx-recap-edit">Modifier</a>
        </div>
        <div class="nx-recap-row"><strong>Type :</strong> {{ $saved['property_type'] ?? '—' }}</div>
        <div class="nx-recap-row"><strong>Titre :</strong> {{ $saved['property_title'] ?? '—' }}</div>
        @if(!empty($saved['property_capacity']))
          <div class="nx-recap-row"><strong>Capacité :</strong> {{ $saved['property_capacity'] }} personne(s)</div>
        @endif
        @if(!empty($saved['video_url']))
          <div class="nx-recap-row">
            <strong>Vidéo :</strong>
            <a href="{{ $saved['video_url'] }}" target="_blank" rel="noopener" style="color:var(--nx-purple);font-size:.875rem;word-break:break-all">▶ Voir la vidéo</a>
          </div>
        @endif
        @if(!empty($saved['property_features']))
          <div class="nx-recap-row" style="display:block">
            <strong>Équipements :</strong>
            <span style="color:#6b7280;font-size:.875rem">{{ implode(', ', array_slice($saved['property_features'], 0, 6)) }}</span>
          </div>
        @endif
      </div>

      {{-- Bloc 3 : Langues --}}
      <div class="nx-recap-block">
        <div class="nx-recap-title">
          <span>🌐</span> Étape 3 — Langues & destinations
          <a href="{{ route('nexus.onboarding.step3') }}" class="nx-recap-edit">Modifier</a>
        </div>
        @if(!empty($saved['languages']))
          <div class="nx-recap-row" style="display:block">
            <strong>Langues :</strong>
            <span style="color:#6b7280;font-size:.875rem">
              @foreach($saved['languages'] as $l)
                {{ $l['language'] }} ({{ $l['level'] }})@if(!$loop->last), @endif
              @endforeach
            </span>
          </div>
        @endif
        @if(!empty($saved['target_countries']))
          <div class="nx-recap-row"><strong>Destinations :</strong>
            <span style="color:#6b7280;font-size:.875rem">{{ implode(', ', array_slice($saved['target_countries'], 0, 5)) }}</span>
          </div>
        @endif
        @if(!empty($saved['open_worldwide']))
          <div class="nx-recap-row">🌍 Ouvert au monde entier</div>
        @endif
      </div>

      {{-- Bloc 4 : Disponibilités --}}
      <div class="nx-recap-block">
        <div class="nx-recap-title">
          <span>📅</span> Étape 4 — Disponibilités
          <a href="{{ route('nexus.onboarding.step4') }}" class="nx-recap-edit">Modifier</a>
        </div>
        <div class="nx-recap-row"><strong>Durée :</strong> {{ $saved['stay_duration'] ?? '—' }}</div>
        <div class="nx-recap-row"><strong>Flexibilité :</strong> {{ $saved['flexibility'] ?? '—' }}</div>
        <div class="nx-recap-row"><strong>Récurrence :</strong> {{ $saved['recurrence'] ?? '—' }}</div>
        @if(!empty($saved['date_from']))
          <div class="nx-recap-row">
            <strong>Période :</strong>
            Du {{ \Carbon\Carbon::parse($saved['date_from'])->format('d/m/Y') }}
            @if(!empty($saved['date_to'])) au {{ \Carbon\Carbon::parse($saved['date_to'])->format('d/m/Y') }} @endif
          </div>
        @endif
        <div class="nx-recap-row"><strong>Préavis :</strong> {{ $saved['min_notice_days'] ?? 0 }} jour(s)</div>
      </div>

      {{-- Bloc 5 : Critères --}}
      <div class="nx-recap-block" style="margin-bottom:1.75rem">
        <div class="nx-recap-title">
          <span>🤝</span> Étape 5 — Critères
          <a href="{{ route('nexus.onboarding.step5') }}" class="nx-recap-edit">Modifier</a>
        </div>
        @if(!empty($saved['offer_skills']))
          <div class="nx-recap-row" style="display:block">
            <strong>J'offre :</strong>
            <span style="color:#6b7280;font-size:.875rem">{{ implode(', ', $saved['offer_skills']) }}</span>
          </div>
        @endif
        @if(!empty($saved['seek_skills']))
          <div class="nx-recap-row" style="display:block">
            <strong>Je cherche :</strong>
            <span style="color:#6b7280;font-size:.875rem">{{ implode(', ', $saved['seek_skills']) }}</span>
          </div>
        @endif
        <div class="nx-recap-row"><strong>Contact :</strong> {{ $saved['preferred_contact'] ?? 'message' }}</div>
      </div>

      {{-- Activation --}}
      <form action="{{ route('nexus.onboarding.step6.store') }}" method="POST">
        @csrf

        <div class="nx-field">
          <div class="nx-check-wrap">
            <input type="checkbox" id="accept_terms" name="accept_terms" value="1">
            <label for="accept_terms" class="nx-check-label">
              J'accepte la <strong>Charte NEXUS</strong> — j'engage ma responsabilité sur l'exactitude des informations renseignées et je m'engage à respecter les règles de la communauté d'échanges NEXUS.
            </label>
          </div>
          @error('accept_terms')<div class="nx-error">⚠ {{ $message }}</div>@enderror
        </div>

        <div class="nx-form-footer">
          <a href="{{ route('nexus.onboarding.step5') }}" class="nx-btn nx-btn-ghost">← Retour</a>
          <button type="submit" class="nx-btn nx-btn-primary" style="padding:.95rem 2.5rem;font-size:1.05rem">
            ✦ Activer mon profil NEXUS
          </button>
        </div>

      </form>
    </div>

  </div>
</div>
@endsection
