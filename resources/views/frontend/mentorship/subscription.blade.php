@extends('frontend.layout')

@section('pageHeading')
  Abonnement Mentorat — Cycles 4 semaines
@endsection

@section('metaDescription')
  Accédez au module de mentorat Junspro. Choisissez votre cycle d'abonnement de 4 semaines et rejoignez un pod guidé par un mentor expert.
@endsection

@section('style')
<style>
  :root {
    --mt-purple: #7C3AED;
    --mt-purple-light: #EDE9FE;
    --mt-green: #10B981;
    --mt-gradient: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
    --mt-shadow: 0 4px 24px rgba(124,58,237,.12);
    --mt-shadow-hover: 0 12px 40px rgba(124,58,237,.22);
  }

  .mt-page { background: linear-gradient(160deg,#f5f3ff 0%,#ede9fe 50%,#ddd6fe 100%); min-height: 100vh; padding: 0 0 4rem; }

  /* HERO */
  .mt-hero { text-align: center; padding: 5rem 1.5rem 3rem; }
  .mt-hero__eyebrow { display: inline-block; background: var(--mt-purple-light); color: var(--mt-purple); font-size: .78rem; font-weight: 700; letter-spacing: .08em; text-transform: uppercase; border-radius: 999px; padding: .3rem 1rem; margin-bottom: 1.25rem; }
  .mt-hero__title { font-size: clamp(2rem, 5vw, 3rem); font-weight: 800; color: #1e1b4b; line-height: 1.2; margin-bottom: 1rem; }
  .mt-hero__title span { background: var(--mt-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
  .mt-hero__sub { font-size: 1.1rem; color: #6b7280; max-width: 560px; margin: 0 auto 1.5rem; line-height: 1.6; }
  .mt-hero__badge { display: inline-flex; align-items: center; gap: .4rem; background: #fff; border: 1.5px solid #c4b5fd; color: var(--mt-purple); font-size: .82rem; font-weight: 600; border-radius: 999px; padding: .35rem 1rem; box-shadow: 0 2px 8px rgba(124,58,237,.08); }

  /* ALERT ACTIVE SUB */
  .mt-active-alert { max-width: 700px; margin: 0 auto 2rem; background: #ecfdf5; border: 1.5px solid #6ee7b7; border-radius: 14px; padding: 1rem 1.5rem; display: flex; align-items: center; gap: .75rem; color: #065f46; font-weight: 600; font-size: .95rem; }
  .mt-active-alert i { font-size: 1.3rem; color: var(--mt-green); }

  /* PLANS GRID */
  .mt-plans { max-width: 1050px; margin: 0 auto; padding: 0 1.5rem; }
  .mt-plans__grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem; }

  .mt-card { background: #fff; border-radius: 20px; padding: 2rem 1.75rem; box-shadow: var(--mt-shadow); border: 2px solid transparent; transition: box-shadow .3s, transform .3s, border-color .3s; position: relative; overflow: hidden; display: flex; flex-direction: column; }
  .mt-card:hover { box-shadow: var(--mt-shadow-hover); transform: translateY(-4px); border-color: #c4b5fd; }
  .mt-card--popular { border-color: var(--mt-purple); box-shadow: var(--mt-shadow-hover); }

  .mt-card__popular { position: absolute; top: 0; right: 0; background: var(--mt-gradient); color: #fff; font-size: .72rem; font-weight: 700; letter-spacing: .06em; text-transform: uppercase; padding: .4rem 1rem; border-bottom-left-radius: 12px; }
  .mt-card__savings { display: inline-block; background: #fef3c7; color: #92400e; font-size: .75rem; font-weight: 700; border-radius: 999px; padding: .2rem .75rem; margin-bottom: .75rem; }

  .mt-card__name { font-size: 1.3rem; font-weight: 800; color: #1e1b4b; margin-bottom: .25rem; }
  .mt-card__desc { font-size: .88rem; color: #6b7280; margin-bottom: 1.5rem; line-height: 1.4; }

  .mt-card__price-block { margin-bottom: 1.5rem; }
  .mt-card__price { font-size: 2.8rem; font-weight: 800; color: var(--mt-purple); line-height: 1; }
  .mt-card__price sup { font-size: 1.2rem; vertical-align: super; }
  .mt-card__price-period { font-size: .88rem; color: #9ca3af; display: block; margin-top: .2rem; }
  .mt-card__per-week { font-size: .82rem; color: var(--mt-green); font-weight: 600; margin-top: .3rem; }

  .mt-card__features { list-style: none; padding: 0; margin: 0 0 2rem; flex: 1; }
  .mt-card__features li { display: flex; align-items: flex-start; gap: .5rem; font-size: .88rem; color: #374151; padding: .35rem 0; border-bottom: 1px solid #f3f4f6; }
  .mt-card__features li:last-child { border-bottom: none; }
  .mt-card__features li i { color: var(--mt-green); font-size: .9rem; margin-top: .15rem; flex-shrink: 0; }

  .mt-card__cta { display: block; width: 100%; text-align: center; padding: .85rem 1.5rem; border-radius: 12px; font-weight: 700; font-size: .95rem; transition: all .2s; cursor: pointer; border: none; }
  .mt-card__cta--primary { background: var(--mt-gradient); color: #fff; box-shadow: 0 4px 14px rgba(124,58,237,.35); }
  .mt-card__cta--primary:hover { opacity: .92; transform: translateY(-1px); box-shadow: 0 6px 20px rgba(124,58,237,.45); }
  .mt-card__cta--secondary { background: var(--mt-purple-light); color: var(--mt-purple); }
  .mt-card__cta--secondary:hover { background: #ddd6fe; }
  .mt-card__cta--login { background: #f3f4f6; color: #374151; text-decoration: none; }
  .mt-card__cta--login:hover { background: #e5e7eb; }

  /* HOW IT WORKS */
  .mt-how { max-width: 900px; margin: 4rem auto 0; padding: 0 1.5rem; }
  .mt-how__title { text-align: center; font-size: 1.6rem; font-weight: 800; color: #1e1b4b; margin-bottom: 2rem; }
  .mt-how__steps { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.25rem; }
  .mt-how__step { background: #fff; border-radius: 16px; padding: 1.5rem; text-align: center; box-shadow: 0 2px 12px rgba(124,58,237,.07); }
  .mt-how__step-num { width: 2.5rem; height: 2.5rem; background: var(--mt-gradient); color: #fff; border-radius: 50%; font-weight: 800; font-size: 1rem; display: flex; align-items: center; justify-content: center; margin: 0 auto .75rem; }
  .mt-how__step h4 { font-size: .95rem; font-weight: 700; color: #1e1b4b; margin-bottom: .4rem; }
  .mt-how__step p { font-size: .82rem; color: #6b7280; line-height: 1.4; }

  /* CANCEL FORM */
  .mt-cancel-section { max-width: 700px; margin: 3rem auto 0; padding: 0 1.5rem; text-align: center; }
  .mt-cancel-section p { font-size: .85rem; color: #9ca3af; }
  .mt-cancel-btn { background: none; border: none; color: #dc2626; font-size: .8rem; font-weight: 600; cursor: pointer; text-decoration: underline; padding: 0; }
</style>
@endsection

@section('content')
<div class="mt-page">

  {{-- HERO --}}
  <div class="mt-hero">
    <span class="mt-hero__eyebrow"><i class="fas fa-graduation-cap"></i> Module Mentorat Junspro</span>
    <h1 class="mt-hero__title">Accélérez votre parcours<br><span>avec un mentor expert</span></h1>
    <p class="mt-hero__sub">Rejoignez un pod de mentorat structuré : missions, jalons, check-ins hebdomadaires et certificat de validation — le tout en cycles de 4 semaines.</p>
    <div class="mt-hero__badge"><i class="fas fa-sync-alt"></i> Renouvellement automatique · Sans engagement minimum</div>
  </div>

  {{-- FLASH MESSAGES --}}
  @if(session('success'))
    <div style="max-width:700px;margin:0 auto 1.5rem;padding:0 1.5rem;"><div class="mt-active-alert"><i class="fas fa-check-circle"></i>{{ session('success') }}</div></div>
  @endif
  @if(session('info'))
    <div style="max-width:700px;margin:0 auto 1.5rem;padding:0 1.5rem;"><div class="mt-active-alert" style="background:#eff6ff;border-color:#93c5fd;color:#1e40af;"><i class="fas fa-info-circle" style="color:#3b82f6;"></i>{{ session('info') }}</div></div>
  @endif
  @if($errors->any())
    <div style="max-width:700px;margin:0 auto 1.5rem;padding:0 1.5rem;"><div class="mt-active-alert" style="background:#fef2f2;border-color:#fca5a5;color:#991b1b;"><i class="fas fa-exclamation-circle" style="color:#ef4444;"></i>{{ $errors->first('error') }}</div></div>
  @endif

  {{-- ABONNEMENT ACTIF --}}
  @if($activeSubscription)
    <div style="max-width:700px;margin:0 auto 2rem;padding:0 1.5rem;">
      <div class="mt-active-alert">
        <i class="fas fa-check-circle"></i>
        <div>
          <strong>Abonnement actif — {{ $activeSubscription->planLabel() }}</strong><br>
          <span style="font-weight:400;font-size:.88rem;">Cycle en cours jusqu'au {{ optional($activeSubscription->current_cycle_end)->format('d/m/Y') ?? '—' }} · Prochain renouvellement le {{ optional($activeSubscription->next_billing_at)->format('d/m/Y') ?? '—' }}</span>
        </div>
        <div style="margin-left:auto;display:flex;gap:.5rem;">
          <a href="{{ route('mentorship.dashboard.mentor') }}" class="mt-card__cta mt-card__cta--primary" style="width:auto;padding:.5rem 1rem;font-size:.82rem;">Tableau de bord</a>
        </div>
      </div>
    </div>
  @endif

  {{-- PLANS --}}
  <div class="mt-plans">
    <div class="mt-plans__grid">
      @foreach($plans as $plan)
        <div class="mt-card {{ $plan['popular'] ? 'mt-card--popular' : '' }}">
          @if($plan['popular'])<div class="mt-card__popular">⭐ Le plus choisi</div>@endif

          @if($plan['savings'] > 0)
            <span class="mt-card__savings">Économisez {{ $plan['savings'] }} %</span>
          @else
            <span class="mt-card__savings" style="background:#f1f5f9;color:#64748b;">1 cycle</span>
          @endif

          <div class="mt-card__name">{{ $plan['name'] }}</div>
          <div class="mt-card__desc">{{ $plan['description'] }}</div>

          <div class="mt-card__price-block">
            <div class="mt-card__price"><sup>€</sup>{{ $plan['price'] }}</div>
            <span class="mt-card__price-period">
              pour {{ $plan['cycles'] }} cycle{{ $plan['cycles'] > 1 ? 's' : '' }} de 4 semaines
              @if($plan['cycles'] > 1)·
                <strong style="color:#1e1b4b;">{{ number_format($plan['price'] / $plan['cycles'], 0) }} €/cycle</strong>
              @endif
            </span>
            <div class="mt-card__per-week">≈ {{ number_format($plan['price'] / ($plan['cycles'] * 4), 2, ',', '') }} €/semaine</div>
          </div>

          <ul class="mt-card__features">
            @foreach($plan['features'] as $feature)
              <li><i class="fas fa-check-circle"></i> {{ $feature }}</li>
            @endforeach
          </ul>

          @if($activeSubscription && $activeSubscription->plan_key === $plan['key'])
            <div class="mt-card__cta" style="background:#d1fae5;color:#065f46;font-weight:700;cursor:default;">✓ Votre plan actuel</div>
          @elseif(auth('web')->check())
            <form method="POST" action="{{ route('mentorship.subscription.subscribe') }}">
              @csrf
              <input type="hidden" name="plan_key" value="{{ $plan['key'] }}">
              <button type="submit" class="mt-card__cta {{ $plan['popular'] ? 'mt-card__cta--primary' : 'mt-card__cta--secondary' }}">
                Choisir {{ $plan['name'] }}
              </button>
            </form>
          @else
            <a href="{{ route('user.login') }}?redirect={{ urlencode(route('mentorship.subscription.index')) }}" class="mt-card__cta mt-card__cta--login">
              <i class="fas fa-sign-in-alt"></i> Connexion pour souscrire
            </a>
          @endif
        </div>
      @endforeach
    </div>
  </div>

  {{-- COMMENT ÇA MARCHE --}}
  <div class="mt-how">
    <h2 class="mt-how__title">Comment ça fonctionne ?</h2>
    <div class="mt-how__steps">
      <div class="mt-how__step">
        <div class="mt-how__step-num">1</div>
        <h4>Souscrivez</h4>
        <p>Choisissez votre cycle, paiement sécurisé via Stripe. Renouvellement automatique toutes les 4 semaines.</p>
      </div>
      <div class="mt-how__step">
        <div class="mt-how__step-num">2</div>
        <h4>Rejoignez un pod</h4>
        <p>Candidatez à un pod de 3–8 stagiaires animé par un mentor expert de la plateforme.</p>
      </div>
      <div class="mt-how__step">
        <div class="mt-how__step-num">3</div>
        <h4>Avancez</h4>
        <p>Missions hebdomadaires, jalons à soumettre, check-ins de suivi avec votre mentor.</p>
      </div>
      <div class="mt-how__step">
        <div class="mt-how__step-num">4</div>
        <h4>Obtenez votre certificat</h4>
        <p>À la fin du parcours : certificat de validation Junspro affiché sur votre profil freelance.</p>
      </div>
    </div>
  </div>

  {{-- ANNULER L'ABONNEMENT --}}
  @if($activeSubscription)
    <div class="mt-cancel-section">
      <p>Vous pouvez annuler à tout moment. L'accès reste actif jusqu'à la fin du cycle en cours.</p>
      <form method="POST" action="{{ route('mentorship.subscription.cancel_active') }}" onsubmit="return confirm('Confirmer l\'annulation de votre abonnement mentorat ?')">
        @csrf
        <button type="submit" class="mt-cancel-btn">Annuler mon abonnement</button>
      </form>
    </div>
  @endif

</div>
@endsection
