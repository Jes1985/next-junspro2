@extends('frontend.layout')

@section('pageHeading', __('Programme Apporteurs d\'Affaires'))

@section('style')
  <link rel="stylesheet" href="{{ asset('assets/front/css/affiliate-premium.css') }}?v={{ time() }}">
@endsection

@section('content')
<div class="aff-landing-container">

  {{-- ─── FLASH messages (post-inscription) ──────────────────── --}}
  @if(session('success') || session('info'))
    <div style="max-width:1200px;margin:0 auto;padding:16px 24px 0">
      @if(session('success'))
        <div style="display:flex;align-items:center;gap:10px;padding:14px 20px;background:#d1fae5;color:#065f46;border-left:4px solid #10b981;border-radius:12px;font-size:14px;font-weight:500;margin-bottom:8px">
          <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
          {{ session('success') }}
        </div>
      @endif
      @if(session('info'))
        <div style="display:flex;align-items:center;gap:10px;padding:14px 20px;background:#dbeafe;color:#1e3a8a;border-left:4px solid #3b82f6;border-radius:12px;font-size:14px;font-weight:500;margin-bottom:8px">
          <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
          {{ session('info') }}
        </div>
      @endif
    </div>
  @endif

  {{-- ─── HERO ───────────────────────────────────────────────── --}}
  <section class="aff-landing-hero">
    <div class="aff-landing-hero__container">

      {{-- Gauche --}}
      <div>
        <div class="aff-landing-hero__eyebrow">
          💼 Programme Apporteurs d'Affaires
        </div>
        <h1 class="aff-landing-hero__title">
          Gagnez jusqu'à <span>10%</span> de commission<br>en recommandant JunsPro
        </h1>
        <p class="aff-landing-hero__text">
          Rejoignez le programme d'apporteurs d'affaires JunsPro et touchez une commission récurrente sur chaque transaction générée par vos recommandations — pendant jusqu'à 24 mois par filleul.
        </p>

        <div class="aff-landing-hero__cta-group">
          @auth
            @php $affiliateUser = \App\Models\Affiliate::where('user_id', Auth::id())->first(); @endphp
            @if($affiliateUser)
              <a href="{{ route('affiliate.dashboard') }}" class="aff-cta-primary">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                Accéder à mon espace
              </a>
            @else
              <form method="POST" action="{{ route('affiliate.register') }}" style="display:inline">
                @csrf
                <button type="submit" class="aff-cta-primary">
                  <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
                  Rejoindre gratuitement
                </button>
              </form>
            @endif
          @else
            <a href="{{ route('user.signup') }}" class="aff-cta-primary">
              <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
              Créer un compte & rejoindre
            </a>
            <a href="{{ route('user.login') }}" class="aff-cta-secondary">
              Déjà membre ? Se connecter
            </a>
          @endauth
        </div>

        <p class="aff-landing-hero__micro">
          <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
          Inscription gratuite · Sans engagement · Paiement mensuel par virement
        </p>
      </div>

      {{-- Droite — métriques --}}
      <div class="aff-landing-hero__right">
        <div class="aff-metric-card">
          <div class="aff-metric-card__icon">💰</div>
          <div>
            <div class="aff-metric-card__label">Commission maximale</div>
            <div class="aff-metric-card__value">10%</div>
            <div class="aff-metric-card__sub">palier JunsPro Club</div>
          </div>
        </div>
        <div class="aff-metric-card">
          <div class="aff-metric-card__icon">🗓️</div>
          <div>
            <div class="aff-metric-card__label">Durée max par filleul</div>
            <div class="aff-metric-card__value">24 mois</div>
            <div class="aff-metric-card__sub">commissions récurrentes</div>
          </div>
        </div>
        <div class="aff-metric-card">
          <div class="aff-metric-card__icon">⚡</div>
          <div>
            <div class="aff-metric-card__label">Validation</div>
            <div class="aff-metric-card__value">J+7</div>
            <div class="aff-metric-card__sub">sécurisation anti-fraude</div>
          </div>
        </div>
      </div>

    </div>
  </section>

  {{-- ─── PALIERS ─────────────────────────────────────────────── --}}
  <div class="aff-tiers-section">
    <div class="aff-section-center">
      <div class="aff-section-eyebrow">Les paliers de commission</div>
      <h2 class="aff-section-title">Plus vous apportez, plus vous gagnez</h2>
      <p class="aff-section-subtitle" style="max-width:560px;margin:0 auto">
        Trois niveaux progressifs — votre palier évolue automatiquement au fil de vos conversions validées.
      </p>
    </div>

    <div class="aff-tiers-grid">

      {{-- AMBASSADEUR --}}
      <div class="aff-tier-card aff-tier-card--ambassador">
        <div class="aff-tier-card__icon-wrap">⭐</div>
        <div>
          <div class="aff-tier-card__name">Ambassadeur</div>
          <div style="display:flex;align-items:flex-end;gap:4px;line-height:1">
            <span class="aff-tier-card__rate">5</span>
            <span class="aff-tier-card__rate-unit" style="margin-bottom:8px">%</span>
          </div>
          <p class="aff-tier-card__desc">
            Le palier d'entrée, accessible dès votre inscription. Commission sur 6 mois par filleul.
          </p>
        </div>
        <ul class="aff-tier-card__perks">
          <li class="aff-tier-card__perk">
            <span class="aff-tier-card__perk-icon">
              <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            </span>
            5% de commission sur chaque transaction
          </li>
          <li class="aff-tier-card__perk">
            <span class="aff-tier-card__perk-icon">
              <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            </span>
            6 mois de commission par filleul
          </li>
          <li class="aff-tier-card__perk">
            <span class="aff-tier-card__perk-icon">
              <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            </span>
            Lien de tracking personnalisé
          </li>
          <li class="aff-tier-card__perk">
            <span class="aff-tier-card__perk-icon">
              <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            </span>
            Dashboard temps réel
          </li>
        </ul>
        <div class="aff-tier-card__footer">
          <div class="aff-tier-card__condition">Dès 0 conversion — palier par défaut</div>
        </div>
      </div>

      {{-- PARTENAIRE ÉLITE --}}
      <div class="aff-tier-card aff-tier-card--elite">
        <div class="aff-tier-card__icon-wrap">⭐⭐</div>
        <div>
          <div class="aff-tier-card__name">Partenaire Élite</div>
          <div style="display:flex;align-items:flex-end;gap:4px;line-height:1">
            <span class="aff-tier-card__rate">7</span>
            <span class="aff-tier-card__rate-unit" style="margin-bottom:8px">%</span>
          </div>
          <p class="aff-tier-card__desc">
            Débloqué après 3 conversions validées. Commission étendue à 12 mois par filleul.
          </p>
        </div>
        <ul class="aff-tier-card__perks">
          <li class="aff-tier-card__perk">
            <span class="aff-tier-card__perk-icon">
              <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            </span>
            7% de commission sur chaque transaction
          </li>
          <li class="aff-tier-card__perk">
            <span class="aff-tier-card__perk-icon">
              <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            </span>
            12 mois de commission par filleul
          </li>
          <li class="aff-tier-card__perk">
            <span class="aff-tier-card__perk-icon">
              <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            </span>
            Slug de lien personnalisable
          </li>
          <li class="aff-tier-card__perk">
            <span class="aff-tier-card__perk-icon">
              <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            </span>
            Support prioritaire
          </li>
        </ul>
        <div class="aff-tier-card__footer">
          <div class="aff-tier-card__condition">Dès 3 conversions validées</div>
        </div>
      </div>

      {{-- JUNSPRO CLUB --}}
      <div class="aff-tier-card aff-tier-card--club">
        <div class="aff-tier-card__recommended">⭐ Premium</div>
        <div class="aff-tier-card__icon-wrap">👑</div>
        <div>
          <div class="aff-tier-card__name">JunsPro Club</div>
          <div style="display:flex;align-items:flex-end;gap:4px;line-height:1">
            <span class="aff-tier-card__rate">10</span>
            <span class="aff-tier-card__rate-unit" style="margin-bottom:8px">%</span>
          </div>
          <p class="aff-tier-card__desc">
            Le sommet du programme. Commission maximale sur 24 mois — le palier des vrais partenaires JunsPro.
          </p>
        </div>
        <ul class="aff-tier-card__perks">
          <li class="aff-tier-card__perk">
            <span class="aff-tier-card__perk-icon">
              <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            </span>
            10% de commission sur chaque transaction
          </li>
          <li class="aff-tier-card__perk">
            <span class="aff-tier-card__perk-icon">
              <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            </span>
            24 mois de commission par filleul
          </li>
          <li class="aff-tier-card__perk">
            <span class="aff-tier-card__perk-icon">
              <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            </span>
            Badge Club sur votre profil public
          </li>
          <li class="aff-tier-card__perk">
            <span class="aff-tier-card__perk-icon">
              <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
            </span>
            Accès anticipé aux nouvelles fonctions
          </li>
        </ul>
        <div class="aff-tier-card__footer">
          <div class="aff-tier-card__condition">Dès 10 conversions validées</div>
        </div>
      </div>

    </div>
  </div>

  {{-- ─── COMMENT ÇA MARCHE ──────────────────────────────────── --}}
  <section class="aff-how-section">
    <div class="aff-how-section__inner">
      <div class="aff-section-center">
        <div class="aff-section-eyebrow">3 étapes simples</div>
        <h2 class="aff-section-title">Comment ça marche</h2>
      </div>
      <div class="aff-steps-grid">
        <div class="aff-step-card">
          <div class="aff-step-number">1</div>
          <h3 class="aff-step-title">Rejoignez le programme</h3>
          <p class="aff-step-text">
            Inscrivez-vous gratuitement en un clic. Votre lien de tracking unique est généré instantanément — vous pouvez commencer à partager dans la minute.
          </p>
        </div>
        <div class="aff-step-card">
          <div class="aff-step-number">2</div>
          <h3 class="aff-step-title">Partagez votre lien</h3>
          <p class="aff-step-text">
            Recommandez JunsPro à vos contacts, réseaux professionnels, ou clients. Toute inscription via votre lien est traçable pendant 30 jours (cookie).
          </p>
        </div>
        <div class="aff-step-card">
          <div class="aff-step-number">3</div>
          <h3 class="aff-step-title">Touchez vos commissions</h3>
          <p class="aff-step-text">
            Dès qu'un filleul réalise une transaction, une commission vous est créditée. Elle est validée à J+7 et versée par virement mensuel sur votre IBAN.
          </p>
        </div>
      </div>
    </div>
  </section>

  {{-- ─── CHIFFRES CLÉS ──────────────────────────────────────── --}}
  <div class="aff-trust-section">
    <div class="aff-section-center">
      <div class="aff-section-eyebrow">JunsPro en chiffres</div>
      <h2 class="aff-section-title">Une plateforme qui performe</h2>
    </div>
    <div class="aff-trust-grid">
      <div class="aff-trust-card">
        <div class="aff-trust-card__number">6</div>
        <div class="aff-trust-card__label">Univers de services</div>
      </div>
      <div class="aff-trust-card">
        <div class="aff-trust-card__number">24<span style="font-size:22px">m</span></div>
        <div class="aff-trust-card__label">Commissionnement maximum</div>
      </div>
      <div class="aff-trust-card">
        <div class="aff-trust-card__number">3</div>
        <div class="aff-trust-card__label">Paliers progressifs</div>
      </div>
      <div class="aff-trust-card">
        <div class="aff-trust-card__number">0€</div>
        <div class="aff-trust-card__label">Pour rejoindre le programme</div>
      </div>
    </div>
  </div>

  {{-- ─── FAQ ─────────────────────────────────────────────────── --}}
  <section class="aff-faq-section"
    x-data="{
      open: null,
      toggle(i) { this.open = this.open === i ? null : i; }
    }">
    <div class="aff-faq-section__inner">
      <div class="aff-section-center">
        <div class="aff-section-eyebrow">Questions fréquentes</div>
        <h2 class="aff-section-title">Tout ce que vous devez savoir</h2>
      </div>
      <div class="aff-faq-list">

        @php
        $faqs = [
          [
            'q' => 'Qui peut rejoindre le programme Apporteurs d\'Affaires ?',
            'a' => 'Tout membre JunsPro avec un compte actif peut rejoindre gratuitement. Il n\'y a pas de sélection ni de conditions préalables. Vous rejoignez automatiquement au palier Ambassadeur.',
          ],
          [
            'q' => 'Comment mes commissions sont-elles calculées ?',
            'a' => 'Votre commission est calculée sur le montant HT de chaque transaction réalisée par un filleul inscrit via votre lien, dans la limite de la durée de votre palier (6, 12 ou 24 mois). Le taux est celui de votre palier au moment de la transaction.',
          ],
          [
            'q' => 'Quand est-ce que je reçois mon argent ?',
            'a' => 'Les commissions sont validées à J+7 après la transaction (délai anti-fraude). Le paiement est effectué par virement SEPA mensuel, dès lors que vous avez renseigné votre IBAN dans votre dashboard.',
          ],
          [
            'q' => 'Que se passe-t-il si un filleul annule une transaction ?',
            'a' => 'En cas de remboursement validé par Stripe, la commission associée est automatiquement annulée et déduite de votre solde en attente. Seules les transactions définitivement confirmées génèrent des commissions.',
          ],
          [
            'q' => 'Comment progresser vers un palier supérieur ?',
            'a' => 'La progression est automatique. Dès que vous atteignez 3 conversions validées vous passez Partenaire Élite (7%), et dès 10 conversions vous accédez au JunsPro Club (10%). Le changement de palier s\'applique immédiatement aux nouvelles commissions.',
          ],
          [
            'q' => 'Mon lien de tracking est-il limité dans le temps ?',
            'a' => 'Non, votre lien est permanent tant que vous êtes membre actif. Le cookie de tracking sur le navigateur du visiteur est valide 30 jours après son premier clic.',
          ],
        ];
        @endphp

        @foreach($faqs as $i => $faq)
          <div class="aff-faq-item">
            <button
              class="aff-faq-item__trigger"
              type="button"
              @click="toggle({{ $i }})"
            >
              {{ $faq['q'] }}
              <svg class="aff-faq-item__chevron" :class="open === {{ $i }} ? 'aff-faq-item__chevron--open' : ''"
                width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <polyline points="6 9 12 15 18 9"/>
              </svg>
            </button>
            <div
              class="aff-faq-item__body"
              x-show="open === {{ $i }}"
              x-transition:enter="transition ease-out duration-200"
              x-transition:enter-start="opacity-0 -translate-y-1"
              x-transition:enter-end="opacity-100 translate-y-0"
              x-cloak
            >
              {{ $faq['a'] }}
            </div>
          </div>
        @endforeach

      </div>
    </div>
  </section>

  {{-- ─── CROSS-SELL : Formation Praticien Pause Souffle ─── --}}
  <section style="background: #f8f5ff; padding: 70px 0; border-top: 1px solid #e9e0ff;">
    <div class="container">
      <div class="row align-items-center g-4">
        <div class="col-lg-2 text-center" data-aos="fade-right">
          <div style="width: 90px; height: 90px; margin: 0 auto; border-radius: 50%; background: linear-gradient(135deg, #1a0533, #7c3aed); display: flex; align-items: center; justify-content: center;">
            <i class="fas fa-wind" style="font-size: 2rem; color: #d4af37;"></i>
          </div>
        </div>
        <div class="col-lg-7" data-aos="fade-up">
          <p style="color: #7c3aed; font-size: 0.8rem; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; margin-bottom: 0.5rem;">Formation certifiante</p>
          <h3 style="color: #1a1a2e; font-size: 1.55rem; font-weight: 800; margin-bottom: 0.75rem; line-height: 1.3;">Vous accompagnez des professionnels ?<br>Devenez Praticien Pause Souffle certifié.</h3>
          <p style="color: #555; font-size: 1rem; line-height: 1.75; margin: 0;">
            Intégrez le Rituel Pause Souffle à votre offre professionnelle. Certifiez-vous en 6 modules, obtenez votre attestation Junspro et proposez une expérience reconnue à vos clients.
          </p>
        </div>
        <div class="col-lg-3 text-center" data-aos="fade-left">
          <a href="{{ route('presence.formation-praticien') }}" style="display: inline-block; background: linear-gradient(135deg, #1a0533 0%, #7c3aed 100%); color: #fff; font-weight: 700; font-size: 1rem; padding: 15px 30px; border-radius: 12px; text-decoration: none; box-shadow: 0 4px 20px rgba(124,58,237,0.3); transition: opacity 0.2s;" onmouseover="this.style.opacity='0.88'" onmouseout="this.style.opacity='1'">
            Voir la formation <i class="fas fa-arrow-right ms-1"></i>
          </a>
          <p style="color: #999; font-size: 0.8rem; margin-top: 0.8rem; margin-bottom: 0;">Formation · 1 490 € · <strong style="color: #7c3aed;">Commission 30% → 447 €</strong></p>
          <a href="{{ route('presence.retraite') }}" style="display: inline-flex; align-items: center; gap: 6px; margin-top: 1rem; color: #D4A853; font-size: 0.875rem; font-weight: 600; text-decoration: none; border: 1px solid rgba(212,168,83,0.35); padding: 8px 18px; border-radius: 50px; transition: background 0.2s;" onmouseover="this.style.background='rgba(212,168,83,0.08)'" onmouseout="this.style.background='transparent'">
            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 21 12 17.77 5.82 21 7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
            La Retraite · 7 jours en Méditerranée
          </a>
          <p style="color: #999; font-size: 0.75rem; margin-top: 0.5rem; margin-bottom: 0;">Retraite · 4 800–5 500 € · <strong style="color: #D4A853;">Commission 10% → 480–550 €</strong></p>
        </div>
      </div>
    </div>
  </section>

  {{-- ─── CTA FINAL ───────────────────────────────────────────── --}}
  <section class="aff-cta-banner">
    <div class="aff-cta-banner__content">
      <h2 class="aff-cta-banner__title">Prêt à rejoindre le programme ?</h2>
      <p class="aff-cta-banner__text">
        Inscription gratuite. Pas d'engagement. Commencez à partager votre lien aujourd'hui et touchez vos premières commissions dès la première transaction de vos filleuls.
      </p>
      @auth
        @php $affiliateBanner = \App\Models\Affiliate::where('user_id', Auth::id())->first(); @endphp
        @if($affiliateBanner)
          <a href="{{ route('affiliate.dashboard') }}" class="aff-cta-primary" style="margin:0 auto">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            Accéder à mon dashboard
          </a>
        @else
          <form method="POST" action="{{ route('affiliate.register') }}" style="display:inline-block">
            @csrf
            <button type="submit" class="aff-cta-primary" style="font-size:17px;padding:18px 44px">
              <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
              Rejoindre maintenant — c'est gratuit
            </button>
          </form>
        @endif
      @else
        <a href="{{ route('user.signup') }}" class="aff-cta-primary" style="font-size:17px;padding:18px 44px;margin:0 auto">
          <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
          Créer un compte et rejoindre
        </a>
      @endauth
    </div>
  </section>

</div>{{-- /aff-landing-container --}}
@endsection

@section('script')
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection
