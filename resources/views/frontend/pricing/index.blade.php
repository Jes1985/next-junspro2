@extends('frontend.layout')

@section('pageHeading')
  {{ __('Formules & Tarifs') }}
@endsection

@section('metaDescription')
  {{ __("Découvrez les formules d'abonnement Junspro  de 1 à 22 Rituels par semaine. Transparent, flexible, sans engagement.") }}
@endsection

@section('content')

  {{-- 
       HERO
   --}}
  <section class="jp-pricing-hero">
    <div class="jp-pricing-hero__inner">
      <span class="jp-pricing-hero__eyebrow">Formules &amp; Tarifs</span>
      <h1 class="jp-pricing-hero__title">
        Choisissez votre<br>
        <span class="jp-pricing-hero__accent">cadence de Rituels</span>
      </h1>
      <p class="jp-pricing-hero__sub">
        1 Rituel = 50 min focus + 10 min restitution &amp; rapport.<br>
        Cycles de 4 semaines  Top-up possible  Sans engagement de durée.
      </p>
      @if(isset($selectedFreelancer) && $selectedFreelancer)
        <div class="jp-pricing-hero__freelancer">
          <img src="{{ $selectedFreelancer->user->profile_photo_path ? asset('storage/'.$selectedFreelancer->user->profile_photo_path) : asset('assets/img/noimage.jpg') }}"
               alt="{{ $selectedFreelancer->user->name ?? '' }}" class="jp-pricing-hero__freelancer-img">
          <span>{{ $selectedFreelancer->user->name ?? 'Freelance sélectionné' }}</span>
          <strong> {{ number_format($selectedFreelancer->hourly_rate ?? 0, 0, ',', ' ') }} €/h</strong>
        </div>
      @endif
    </div>
    <div class="jp-pricing-hero__orb jp-pricing-hero__orb--1"></div>
    <div class="jp-pricing-hero__orb jp-pricing-hero__orb--2"></div>
  </section>

  {{-- 
       TOGGLE UNIVERS
   --}}
  <section class="jp-universe-section">
    <div class="jp-universe-section__inner">

      <div class="jp-universe-explainer">
        <div class="jp-universe-explainer__card jp-universe-explainer__card--a">
          <span class="jp-universe-explainer__badge jp-universe-explainer__badge--a">Univers A</span>
          <h3 class="jp-universe-explainer__title">Cours, Bien-être &amp; Corporate</h3>
          <p class="jp-universe-explainer__desc">Lessons  WellnessLive  Corporate  Paliers 4 à 32 Rituels/cycle  Top-up jusqu'à 100 % du palier</p>
        </div>
        <div class="jp-universe-explainer__card jp-universe-explainer__card--b">
          <span class="jp-universe-explainer__badge jp-universe-explainer__badge--b">Univers B</span>
          <h3 class="jp-universe-explainer__title">Projets &amp; À domicile</h3>
          <p class="jp-universe-explainer__desc">Projects  At-home  Paliers 4 à 88 Rituels/cycle  Top-up plafonné à 32 Rituels</p>
        </div>
      </div>

      <div class="jp-tabs" id="jpUniverseTabs">
        <button class="jp-tabs__btn jp-tabs__btn--active" data-tab="universeA">
          <i class="fas fa-graduation-cap"></i> Cours, Bien-être &amp; Corporate
        </button>
        <button class="jp-tabs__btn" data-tab="universeB">
          <i class="fas fa-folder-open"></i> Projets &amp; À domicile
        </button>
      </div>

      {{-- Plans Univers A --}}
      <div class="jp-plans-grid" id="universeA">
        @foreach($plansA as $plan)
          @php
            $isCurrent = $currentPalier === $plan['hours_per_cycle'] && in_array($currentUniverse ?? '', ['lessons','wellnesslive','corporate']);
            $price = isset($selectedFreelancer) && $selectedFreelancer ? $selectedFreelancer->hourly_rate * $plan['hours_per_cycle'] : null;
          @endphp
          <div class="jp-plan-card {{ $plan['popular'] ? 'jp-plan-card--popular' : '' }} {{ $isCurrent ? 'jp-plan-card--current' : '' }}">
            @if($plan['popular'])<div class="jp-plan-card__popular-badge"> Le plus populaire</div>@endif
            @if($isCurrent)<div class="jp-plan-card__current-badge"> Votre formule</div>@endif
            <div class="jp-plan-card__header">
              <div class="jp-plan-card__icon-wrap"><i class="{{ $plan['icon'] }}"></i></div>
              <h3 class="jp-plan-card__name">{{ $plan['name'] }}</h3>
              <p class="jp-plan-card__desc">{{ $plan['description'] }}</p>
            </div>
            <div class="jp-plan-card__body">
              <div class="jp-plan-card__volume">
                <span class="jp-plan-card__volume-main">{{ $plan['hours_per_cycle'] }}</span>
                <span class="jp-plan-card__volume-unit">Rituels<br><small>/cycle 4s</small></span>
              </div>
              <div class="jp-plan-card__rhythm">{{ $plan['hours_per_week'] }}h par semaine</div>
              @if($price !== null)
                <div class="jp-plan-card__price">
                  <span class="jp-plan-card__price-amount">{{ number_format($price, 0, ',', ' ') }} €</span>
                  <span class="jp-plan-card__price-period">/cycle</span>
                </div>
              @endif
              <div class="jp-plan-card__topup">
                <div class="jp-plan-card__topup-row">
                  <span class="jp-plan-card__topup-label">Top-up max</span>
                  <span class="jp-plan-card__topup-val">+{{ $plan['topup_max'] }} Rituels</span>
                </div>
                <div class="jp-plan-card__topup-row jp-plan-card__topup-row--total">
                  <span class="jp-plan-card__topup-label">Max cycle</span>
                  <span class="jp-plan-card__topup-val">{{ $plan['cycle_max_total'] }} Rituels</span>
                </div>
              </div>
            </div>
            <div class="jp-plan-card__footer">
              @if(isset($selectedFreelancer) && $selectedFreelancer)
                <form method="POST" action="{{ route('pricing.subscribe') }}">
                  @csrf
                  <input type="hidden" name="freelancer_id" value="{{ $selectedFreelancer->id }}">
                  <input type="hidden" name="weekly_hours" value="{{ $plan['hours_per_week'] }}">
                  <button type="submit" class="jp-plan-card__cta {{ $plan['popular'] ? 'jp-plan-card__cta--primary' : '' }}">Choisir {{ $plan['name'] }}</button>
                </form>
              @else
                <a href="{{ route('explore') }}" class="jp-plan-card__cta {{ $plan['popular'] ? 'jp-plan-card__cta--primary' : '' }}">Choisir {{ $plan['name'] }}</a>
              @endif
            </div>
          </div>
        @endforeach
      </div>

      {{-- Plans Univers B --}}
      <div class="jp-plans-grid" id="universeB" style="display:none;">
        @foreach($plansB as $plan)
          @php
            $isCurrent = $currentPalier === $plan['hours_per_cycle'] && in_array($currentUniverse ?? '', ['projects','at-home']);
            $price = isset($selectedFreelancer) && $selectedFreelancer ? $selectedFreelancer->hourly_rate * $plan['hours_per_cycle'] : null;
          @endphp
          <div class="jp-plan-card {{ $plan['popular'] ? 'jp-plan-card--popular' : '' }} {{ $isCurrent ? 'jp-plan-card--current' : '' }}">
            @if($plan['popular'])<div class="jp-plan-card__popular-badge"> Le plus populaire</div>@endif
            @if($isCurrent)<div class="jp-plan-card__current-badge"> Votre formule</div>@endif
            <div class="jp-plan-card__header">
              <div class="jp-plan-card__icon-wrap"><i class="{{ $plan['icon'] }}"></i></div>
              <h3 class="jp-plan-card__name">{{ $plan['name'] }}</h3>
              <p class="jp-plan-card__desc">{{ $plan['description'] }}</p>
            </div>
            <div class="jp-plan-card__body">
              <div class="jp-plan-card__volume">
                <span class="jp-plan-card__volume-main">{{ $plan['hours_per_cycle'] }}</span>
                <span class="jp-plan-card__volume-unit">Rituels<br><small>/cycle 4s</small></span>
              </div>
              <div class="jp-plan-card__rhythm">{{ $plan['hours_per_week'] }}h par semaine</div>
              @if($price !== null)
                <div class="jp-plan-card__price">
                  <span class="jp-plan-card__price-amount">{{ number_format($price, 0, ',', ' ') }} €</span>
                  <span class="jp-plan-card__price-period">/cycle</span>
                </div>
              @endif
              <div class="jp-plan-card__topup">
                <div class="jp-plan-card__topup-row">
                  <span class="jp-plan-card__topup-label">Top-up max</span>
                  <span class="jp-plan-card__topup-val">+{{ $plan['topup_max'] }} Rituels</span>
                </div>
                <div class="jp-plan-card__topup-row jp-plan-card__topup-row--total">
                  <span class="jp-plan-card__topup-label">Max cycle</span>
                  <span class="jp-plan-card__topup-val">{{ $plan['cycle_max_total'] }} Rituels</span>
                </div>
              </div>
            </div>
            <div class="jp-plan-card__footer">
              @if(isset($selectedFreelancer) && $selectedFreelancer)
                <form method="POST" action="{{ route('pricing.subscribe') }}">
                  @csrf
                  <input type="hidden" name="freelancer_id" value="{{ $selectedFreelancer->id }}">
                  <input type="hidden" name="weekly_hours" value="{{ $plan['hours_per_week'] }}">
                  <button type="submit" class="jp-plan-card__cta {{ $plan['popular'] ? 'jp-plan-card__cta--primary' : '' }}">Choisir {{ $plan['name'] }}</button>
                </form>
              @else
                <a href="{{ route('explore') }}" class="jp-plan-card__cta {{ $plan['popular'] ? 'jp-plan-card__cta--primary' : '' }}">Choisir {{ $plan['name'] }}</a>
              @endif
            </div>
          </div>
        @endforeach
      </div>

    </div>
  </section>

  {{-- TOP-UP EXPLAINER --}}
  <section class="jp-topup-section">
    <div class="jp-topup-section__inner">
      <div class="jp-topup-section__text">
        <h2 class="jp-topup-section__title">Comment fonctionne le Top-up ?</h2>
        <p class="jp-topup-section__sub">Votre cycle de 4 semaines se remplit plus vite que prévu ? Ajoutez des Rituels à la volée, sans changer de formule.</p>
        <ul class="jp-topup-points">
          <li><i class="fas fa-check-circle"></i> Disponible à tout moment depuis votre tableau de bord</li>
          <li><i class="fas fa-check-circle"></i> Fenêtre rolling de 28 jours  le quota se renouvelle automatiquement</li>
          <li><i class="fas fa-check-circle"></i> Plafond = 100 % de votre palier (Univers A) ou 32 Rituels max (Univers B)</li>
          <li><i class="fas fa-check-circle"></i> Si vous top-uppez régulièrement, une formule supérieure sera suggérée</li>
        </ul>
      </div>
      <div class="jp-topup-section__visual">
        <div class="jp-topup-visual">
          <div class="jp-topup-visual__row">
            <span class="jp-topup-visual__label">Palier abonnement</span>
            <div class="jp-topup-visual__bar"><div class="jp-topup-visual__fill jp-topup-visual__fill--base" style="width:50%"></div><span class="jp-topup-visual__bar-label">16 Rituels</span></div>
          </div>
          <div class="jp-topup-visual__row">
            <span class="jp-topup-visual__label">+ Top-up</span>
            <div class="jp-topup-visual__bar"><div class="jp-topup-visual__fill jp-topup-visual__fill--topup" style="width:100%"></div><span class="jp-topup-visual__bar-label">+16 Rituels</span></div>
          </div>
          <div class="jp-topup-visual__row">
            <span class="jp-topup-visual__label">Total max cycle</span>
            <div class="jp-topup-visual__bar"><div class="jp-topup-visual__fill jp-topup-visual__fill--total" style="width:100%"></div><span class="jp-topup-visual__bar-label">= 32 Rituels</span></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- GARANTIES --}}
  <section class="jp-guarantees">
    <div class="jp-guarantees__inner">
      <h2 class="jp-guarantees__title">Inclus dans chaque formule</h2>
      <div class="jp-guarantees__grid">
        @foreach($guarantees as $g)
          <div class="jp-guarantee-item">
            <div class="jp-guarantee-item__icon"><i class="{{ $g['icon'] }}"></i></div>
            <h4 class="jp-guarantee-item__title">{{ $g['title'] }}</h4>
            <p class="jp-guarantee-item__desc">{{ $g['description'] }}</p>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  {{-- CTA FINAL --}}
  <section class="jp-cta-final">
    <div class="jp-cta-final__inner">
      <h2 class="jp-cta-final__title">Pas encore de freelance en tête ?</h2>
      <p class="jp-cta-final__sub">Explorez notre catalogue, déclenchez une séance d'essai de 1h, puis choisissez votre formule.</p>
      <div class="jp-cta-final__btns">
        <a href="{{ route('explore') }}" class="jp-btn jp-btn--primary">Trouver un freelance</a>
        @auth
          <a href="{{ route('user.settings.subscription') }}" class="jp-btn jp-btn--ghost">Mon abonnement</a>
        @endauth
      </div>
      <p class="jp-cta-final__signature">{{ $ritualSignature }}</p>
    </div>
  </section>

  <style>
    :root {
      --jp-indigo: #4F46E5;
      --jp-violet: #7C3AED;
      --jp-gradient: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);
      --jp-gradient-r: linear-gradient(135deg, #7C3AED 0%, #4F46E5 100%);
      --jp-card-radius: 20px;
      --jp-shadow: 0 4px 24px rgba(79,70,229,.08);
      --jp-shadow-hover: 0 12px 40px rgba(79,70,229,.18);
    }
    .jp-pricing-hero {
      background: linear-gradient(135deg, #0F172A 0%, #1E1B4B 50%, #3B0764 100%);
      position: relative; overflow: hidden;
      padding: 130px 24px 90px; text-align: center; color: #fff;
    }
    .jp-pricing-hero__inner { position: relative; z-index: 2; max-width: 760px; margin: 0 auto; }
    .jp-pricing-hero__eyebrow {
      display: inline-block; padding: 4px 18px;
      border: 1px solid rgba(167,139,250,.4); border-radius: 999px;
      font-size: .75rem; font-weight: 600; letter-spacing: .1em; text-transform: uppercase;
      color: #a78bfa; margin-bottom: 1.5rem;
    }
    .jp-pricing-hero__title { font-size: clamp(2.2rem,5vw,3.6rem); font-weight: 700; line-height: 1.15; margin-bottom: 1.25rem; color: #fff; }
    .jp-pricing-hero__accent { background: linear-gradient(90deg,#818CF8 0%,#C084FC 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
    .jp-pricing-hero__sub { font-size: 1rem; color: rgba(255,255,255,.72); line-height: 1.7; margin-bottom: 2rem; }
    .jp-pricing-hero__freelancer {
      display: inline-flex; align-items: center; gap: .6rem;
      background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.15);
      padding: 8px 20px; border-radius: 999px; font-size: .9rem; color: #e0e7ff;
    }
    .jp-pricing-hero__freelancer-img { width: 32px; height: 32px; border-radius: 50%; object-fit: cover; }
    .jp-pricing-hero__orb { position: absolute; border-radius: 50%; filter: blur(80px); opacity: .35; pointer-events: none; }
    .jp-pricing-hero__orb--1 { width: 400px; height: 400px; background: #4F46E5; top: -120px; left: -100px; }
    .jp-pricing-hero__orb--2 { width: 350px; height: 350px; background: #7C3AED; bottom: -100px; right: -80px; }

    .jp-universe-section { background: #F8F7FF; padding: 60px 24px 80px; }
    .jp-universe-section__inner { max-width: 1280px; margin: 0 auto; }
    .jp-universe-explainer { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 2.5rem; }
    .jp-universe-explainer__card { padding: 1.25rem 1.5rem; border-radius: 14px; border: 1.5px solid transparent; background: #fff; }
    .jp-universe-explainer__card--a { border-color: #818CF8; }
    .jp-universe-explainer__card--b { border-color: #C084FC; }
    .jp-universe-explainer__badge { display: inline-block; padding: 2px 12px; border-radius: 999px; font-size: .7rem; font-weight: 700; letter-spacing: .08em; text-transform: uppercase; margin-bottom: .5rem; }
    .jp-universe-explainer__badge--a { background: #EEF2FF; color: #4F46E5; }
    .jp-universe-explainer__badge--b { background: #F5F3FF; color: #7C3AED; }
    .jp-universe-explainer__title { font-size: 1rem; font-weight: 700; color: #1E1B4B; margin-bottom: .25rem; }
    .jp-universe-explainer__desc { font-size: .8125rem; color: #6B7280; line-height: 1.5; margin: 0; }

    .jp-tabs { display: flex; gap: .5rem; background: rgba(79,70,229,.06); border-radius: 14px; padding: 5px; width: fit-content; margin: 0 auto 2.5rem; }
    .jp-tabs__btn { padding: .625rem 1.5rem; border-radius: 10px; border: none; background: transparent; font-size: .9rem; font-weight: 500; color: #6B7280; cursor: pointer; transition: all .2s; display: flex; align-items: center; gap: .4rem; }
    .jp-tabs__btn--active { background: var(--jp-gradient); color: #fff; box-shadow: 0 4px 14px rgba(79,70,229,.3); }
    .jp-tabs__btn:not(.jp-tabs__btn--active):hover { background: rgba(79,70,229,.08); color: #4F46E5; }

    .jp-plans-grid { display: grid; grid-template-columns: repeat(auto-fill,minmax(230px,1fr)); gap: 1.25rem; }

    .jp-plan-card { background: #fff; border-radius: var(--jp-card-radius); border: 1.5px solid #E5E7EB; box-shadow: var(--jp-shadow); display: flex; flex-direction: column; transition: transform .25s, box-shadow .25s, border-color .25s; position: relative; overflow: hidden; }
    .jp-plan-card:hover { transform: translateY(-6px); box-shadow: var(--jp-shadow-hover); border-color: #818CF8; }
    .jp-plan-card--popular { border-color: #4F46E5; box-shadow: 0 8px 32px rgba(79,70,229,.2); }
    .jp-plan-card--popular::before { content: ''; position: absolute; inset: 0; border-radius: var(--jp-card-radius); background: linear-gradient(160deg,rgba(79,70,229,.04) 0%,rgba(124,58,237,.06) 100%); pointer-events: none; }
    .jp-plan-card--current { border-color: #10B981; box-shadow: 0 8px 28px rgba(16,185,129,.15); }
    .jp-plan-card__popular-badge { position: absolute; top: 0; left: 0; right: 0; background: var(--jp-gradient); color: #fff; font-size: .72rem; font-weight: 700; text-align: center; padding: 5px 0; letter-spacing: .04em; }
    .jp-plan-card--popular .jp-plan-card__header { padding-top: 2.5rem; }
    .jp-plan-card__current-badge { position: absolute; top: 0; left: 0; right: 0; background: #10B981; color: #fff; font-size: .72rem; font-weight: 700; text-align: center; padding: 5px 0; }
    .jp-plan-card--current .jp-plan-card__header { padding-top: 2.5rem; }
    .jp-plan-card__header { padding: 1.5rem 1.5rem 1rem; text-align: center; }
    .jp-plan-card__icon-wrap { width: 52px; height: 52px; border-radius: 14px; background: linear-gradient(135deg,#EEF2FF 0%,#F5F3FF 100%); display: flex; align-items: center; justify-content: center; margin: 0 auto .875rem; font-size: 1.25rem; color: #4F46E5; }
    .jp-plan-card--popular .jp-plan-card__icon-wrap { background: var(--jp-gradient); color: #fff; }
    .jp-plan-card__name { font-size: 1.1rem; font-weight: 700; color: #111827; margin-bottom: .25rem; }
    .jp-plan-card__desc { font-size: .78rem; color: #6B7280; line-height: 1.4; margin: 0; }
    .jp-plan-card__body { padding: 0 1.5rem 1rem; flex: 1; }
    .jp-plan-card__volume { display: flex; align-items: baseline; gap: .35rem; margin-bottom: .25rem; }
    .jp-plan-card__volume-main { font-size: 2.8rem; font-weight: 800; color: #111827; line-height: 1; }
    .jp-plan-card__volume-unit { font-size: .75rem; color: #6B7280; line-height: 1.3; }
    .jp-plan-card__rhythm { font-size: .8125rem; color: #9CA3AF; margin-bottom: .875rem; }
    .jp-plan-card__price { margin-bottom: .875rem; }
    .jp-plan-card__price-amount { font-size: 1.25rem; font-weight: 700; color: #4F46E5; }
    .jp-plan-card__price-period { font-size: .78rem; color: #9CA3AF; }
    .jp-plan-card__topup { background: #F9FAFB; border-radius: 10px; padding: .625rem .875rem; display: flex; flex-direction: column; gap: .3rem; }
    .jp-plan-card__topup-row { display: flex; justify-content: space-between; font-size: .78rem; color: #6B7280; }
    .jp-plan-card__topup-row--total .jp-plan-card__topup-val { font-weight: 700; color: #111827; }
    .jp-plan-card__footer { padding: 1rem 1.5rem 1.5rem; }
    .jp-plan-card__cta { display: block; width: 100%; padding: .625rem 1rem; border-radius: 10px; border: 1.5px solid #D1D5DB; background: #fff; color: #374151; font-size: .875rem; font-weight: 600; text-align: center; text-decoration: none; cursor: pointer; transition: all .2s; }
    .jp-plan-card__cta:hover { border-color: #4F46E5; color: #4F46E5; background: #EEF2FF; }
    .jp-plan-card__cta--primary { background: var(--jp-gradient); border-color: transparent; color: #fff; box-shadow: 0 4px 14px rgba(79,70,229,.3); }
    .jp-plan-card__cta--primary:hover { background: var(--jp-gradient-r); color: #fff; box-shadow: 0 6px 20px rgba(79,70,229,.4); }

    .jp-topup-section { background: #fff; padding: 80px 24px; }
    .jp-topup-section__inner { max-width: 1100px; margin: 0 auto; display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: center; }
    .jp-topup-section__title { font-size: 1.75rem; font-weight: 700; color: #111827; margin-bottom: .75rem; }
    .jp-topup-section__sub { font-size: .95rem; color: #6B7280; line-height: 1.6; margin-bottom: 1.5rem; }
    .jp-topup-points { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: .625rem; }
    .jp-topup-points li { display: flex; align-items: flex-start; gap: .6rem; font-size: .875rem; color: #374151; line-height: 1.5; }
    .jp-topup-points li i { color: #10B981; flex-shrink: 0; margin-top: 2px; }
    .jp-topup-visual { display: flex; flex-direction: column; gap: 1rem; }
    .jp-topup-visual__row { display: flex; align-items: center; gap: .75rem; }
    .jp-topup-visual__label { font-size: .78rem; color: #6B7280; width: 120px; flex-shrink: 0; text-align: right; }
    .jp-topup-visual__bar { flex: 1; background: #F3F4F6; border-radius: 6px; height: 28px; position: relative; overflow: hidden; }
    .jp-topup-visual__fill { height: 100%; border-radius: 6px; }
    .jp-topup-visual__fill--base { background: linear-gradient(90deg,#818CF8,#A78BFA); }
    .jp-topup-visual__fill--topup { background: linear-gradient(90deg,#A78BFA,#C084FC); }
    .jp-topup-visual__fill--total { background: var(--jp-gradient); }
    .jp-topup-visual__bar-label { position: absolute; right: 8px; top: 50%; transform: translateY(-50%); font-size: .72rem; font-weight: 700; color: #fff; }

    .jp-guarantees { background: #F8F7FF; padding: 80px 24px; }
    .jp-guarantees__inner { max-width: 1100px; margin: 0 auto; }
    .jp-guarantees__title { font-size: 1.75rem; font-weight: 700; color: #111827; text-align: center; margin-bottom: 2.5rem; }
    .jp-guarantees__grid { display: grid; grid-template-columns: repeat(auto-fill,minmax(280px,1fr)); gap: 1.25rem; }
    .jp-guarantee-item { background: #fff; border-radius: 16px; padding: 1.5rem; border: 1px solid #E5E7EB; transition: box-shadow .2s, transform .2s; }
    .jp-guarantee-item:hover { transform: translateY(-4px); box-shadow: var(--jp-shadow-hover); }
    .jp-guarantee-item__icon { width: 44px; height: 44px; border-radius: 12px; background: var(--jp-gradient); display: flex; align-items: center; justify-content: center; font-size: 1.1rem; color: #fff; margin-bottom: .875rem; }
    .jp-guarantee-item__title { font-size: .95rem; font-weight: 700; color: #111827; margin-bottom: .375rem; }
    .jp-guarantee-item__desc { font-size: .8125rem; color: #6B7280; line-height: 1.5; margin: 0; }

    .jp-cta-final { background: linear-gradient(135deg,#0F172A 0%,#1E1B4B 60%,#3B0764 100%); padding: 90px 24px; text-align: center; color: #fff; }
    .jp-cta-final__inner { max-width: 640px; margin: 0 auto; }
    .jp-cta-final__title { font-size: clamp(1.75rem,4vw,2.5rem); font-weight: 700; margin-bottom: .75rem; }
    .jp-cta-final__sub { font-size: 1rem; color: rgba(255,255,255,.72); margin-bottom: 2rem; line-height: 1.6; }
    .jp-cta-final__btns { display: flex; gap: .75rem; justify-content: center; flex-wrap: wrap; margin-bottom: 1.5rem; }
    .jp-cta-final__signature { font-size: .78rem; color: rgba(255,255,255,.4); font-style: italic; margin: 0; }
    .jp-btn { display: inline-flex; align-items: center; gap: .4rem; padding: .75rem 2rem; border-radius: 12px; font-size: .9375rem; font-weight: 600; text-decoration: none; cursor: pointer; transition: all .2s; border: none; }
    .jp-btn--primary { background: var(--jp-gradient); color: #fff; box-shadow: 0 4px 18px rgba(79,70,229,.35); }
    .jp-btn--primary:hover { background: var(--jp-gradient-r); box-shadow: 0 8px 28px rgba(79,70,229,.45); transform: translateY(-2px); color: #fff; }
    .jp-btn--ghost { background: rgba(255,255,255,.1); border: 1.5px solid rgba(255,255,255,.25); color: #fff; }
    .jp-btn--ghost:hover { background: rgba(255,255,255,.18); color: #fff; }

    @media (max-width: 900px) {
      .jp-topup-section__inner { grid-template-columns: 1fr; gap: 2.5rem; }
      .jp-universe-explainer { grid-template-columns: 1fr; }
    }
    @media (max-width: 640px) {
      .jp-tabs { flex-direction: column; width: 100%; }
      .jp-plans-grid { grid-template-columns: 1fr; }
    }
  </style>

  <script>
  (function() {
    document.addEventListener('DOMContentLoaded', function() {
      var tabs = document.querySelectorAll('#jpUniverseTabs .jp-tabs__btn');
      tabs.forEach(function(btn) {
        btn.addEventListener('click', function() {
          tabs.forEach(function(b) { b.classList.remove('jp-tabs__btn--active'); });
          btn.classList.add('jp-tabs__btn--active');
          var target = btn.getAttribute('data-tab');
          document.getElementById('universeA').style.display = (target === 'universeA') ? 'grid' : 'none';
          document.getElementById('universeB').style.display = (target === 'universeB') ? 'grid' : 'none';
        });
      });
      @if(isset($currentUniverse) && in_array($currentUniverse, ['projects','at-home']))
        document.querySelector('[data-tab="universeB"]').click();
      @endif
    });
  })();
  </script>

@endsection
