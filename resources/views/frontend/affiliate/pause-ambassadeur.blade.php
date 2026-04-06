@extends('frontend.layout')

@section('pageHeading', __('Réseau des Ambassadeurs Pause Souffle'))

@section('content')
@php
  $isLoggedIn   = $isLoggedIn ?? auth()->check();
  $hasAffiliate = $hasAffiliate ?? ($ambassadeur && $ambassadeur->status === 'active');
@endphp

{{-- ══════════════════════════════════════════════════════════
     STYLES INLINE — PAUSE AMBASSADEUR PAGE
═══════════════════════════════════════════════════════════════ --}}
<style>
  :root {
    --ps-gold:        #C9A84C;
    --ps-gold-light:  #E8C96A;
    --ps-gold-dim:    rgba(201,168,76,0.15);
    --ps-gold-border: rgba(201,168,76,0.30);
    --ps-bg:          #070712;
    --ps-bg-card:     #0D0D20;
    --ps-bg-card2:    #111126;
    --ps-text:        rgba(228,220,208,0.88);
    --ps-text-dim:    rgba(228,220,208,0.45);
    --ps-purple:      #7C3AED;
    --ps-green:       #84CC16;
  }

  [x-cloak] { display: none !important; }

  .psa-wrap { background: var(--ps-bg); color: var(--ps-text); overflow-x: hidden; }

  /* ─── Forcer couleurs lisibles sur fond sombre — override thème global ─── */
  .psa-wrap, .psa-wrap * {
    color: inherit;
  }
  .psa-wrap p, .psa-wrap span, .psa-wrap li, .psa-wrap label, .psa-wrap small {
    color: var(--ps-text) !important;
  }
  .psa-wrap h1, .psa-wrap h2, .psa-wrap h3, .psa-wrap h4, .psa-wrap h5 {
    color: #fff !important;
  }
  .psa-wrap a:not([class]) {
    color: var(--ps-gold) !important;
  }
  /* Empêcher le fond blanc du thème de percer sous le wrap */
  .psa-wrap::before {
    content: '';
    position: fixed;
    inset: 0;
    background: var(--ps-bg);
    z-index: -1;
    pointer-events: none;
  }

  .psa-hero__overline { color: var(--ps-gold) !important; }
  .psa-hero__title { color: #fff !important; }
  .psa-hero__subtitle { color: var(--ps-text) !important; }
  .psa-hero__micro { color: var(--ps-text-dim) !important; }
  .psa-section-title, .psa-metric__label, .psa-metric__sub { color: var(--ps-text-dim) !important; }
  .psa-metric__value { color: #fff !important; }
  .psa-tier__label { color: #fff !important; }
  .psa-tier__desc { color: var(--ps-text-dim) !important; }
  .psa-dash__greeting { color: #fff !important; }
  .psa-dash__stat-value { color: var(--ps-gold-light) !important; }
  .psa-dash__stat-label { color: var(--ps-text-dim) !important; }
  .psa-dash__link-input { color: var(--ps-gold-light) !important; }
  .psa-dash__progress-labels span { color: var(--ps-text-dim) !important; }
  .psa-flash { max-width: 980px; margin: 0 auto; padding: 20px 24px 0; }
  .psa-flash__inner { display: flex; align-items: center; gap: 10px; padding: 13px 18px; border-radius: 10px; font-size: 14px; font-weight: 500; }
  .psa-flash__inner--success { background: rgba(16,185,129,0.1); color: #6ee7b7; border-left: 3px solid #10b981; }

  /* ─── FIX COMPLET COULEURS TEXTE (anti-surcharge thème) ─── */
  .psa-wrap .psa-section__eyebrow { color: var(--ps-gold) !important; }
  .psa-wrap .psa-section__title { color: #fff !important; }
  .psa-wrap .psa-section__title strong { color: #fff !important; font-weight: 600 !important; }
  .psa-wrap .psa-section__title em { color: var(--ps-gold) !important; }
  .psa-wrap .psa-section__subtitle { color: rgba(228,220,208,0.65) !important; }

  /* Cartes produits */
  .psa-wrap .psa-product-card__step { opacity: 1 !important; }
  .psa-wrap .psa-product-card__name { color: #fff !important; }
  .psa-wrap .psa-product-card__desc { color: rgba(228,220,208,0.6) !important; }
  .psa-wrap .psa-product-card__price { color: rgba(228,220,208,0.5) !important; }
  .psa-wrap .psa-product-card__rate { color: var(--ps-gold) !important; }
  .psa-wrap .psa-product-card--freelance .psa-product-card__rate { color: #a78bfa !important; }
  .psa-wrap .psa-product-card--formateur .psa-product-card__rate { color: #60a5fa !important; }
  .psa-wrap .psa-product-card--pause-souffle .psa-product-card__rate { color: #fb923c !important; }
  .psa-wrap .psa-product-card--retraite  .psa-product-card__rate { color: var(--ps-green) !important; }
  .psa-wrap .psa-product-card__earn { color: rgba(228,220,208,0.7) !important; }

  /* Journey */
  .psa-wrap .psa-journey__product-name { color: #fff !important; }
  .psa-wrap .psa-journey__product-price { color: rgba(228,220,208,0.5) !important; }
  .psa-wrap .psa-journey__node { color: var(--ps-gold) !important; }
  .psa-wrap .psa-journey__earn { color: var(--ps-gold) !important; }
  .psa-wrap .psa-journey__earn-label { color: rgba(228,220,208,0.5) !important; }
  .psa-wrap .psa-journey__total-label { color: var(--ps-gold) !important; }
  .psa-wrap .psa-journey__total-value { color: #fff !important; }
  .psa-wrap .psa-journey__total-value span { color: var(--ps-gold) !important; }
  .psa-wrap .psa-journey__total-sub { color: rgba(228,220,208,0.5) !important; }

  /* Niveaux / tiers */
  .psa-wrap .psa-tier__badge { opacity: 1 !important; }
  .psa-wrap .psa-tier__name { color: #fff !important; }
  .psa-wrap .psa-tier__condition { color: rgba(228,220,208,0.55) !important; }
  .psa-wrap .psa-tier__benefit { color: rgba(228,220,208,0.75) !important; }
  .psa-wrap .psa-tier__benefit::before { color: var(--ps-gold) !important; }
  .psa-wrap .psa-tier-card--ambassadeur .psa-tier__benefit::before { color: var(--ps-gold-light) !important; }

  /* Steps */
  .psa-wrap .psa-step__title { color: #fff !important; }
  .psa-wrap .psa-step__desc { color: rgba(228,220,208,0.55) !important; }

  /* Tech grid */
  .psa-wrap .psa-tech-item__label { color: rgba(228,220,208,0.5) !important; }
  .psa-wrap .psa-tech-item__value { color: #fff !important; }

  /* Philosophie */
  .psa-wrap .psa-philosophy blockquote { color: rgba(228,220,208,0.9) !important; }
  .psa-wrap .psa-philosophy blockquote em { color: var(--ps-gold) !important; }

  /* Valeurs */
  .psa-wrap .psa-value__name { color: #fff !important; }
  .psa-wrap .psa-value__desc { color: rgba(228,220,208,0.55) !important; }

  /* Métriques hero */
  .psa-wrap .psa-metric__value { color: var(--ps-gold) !important; }
  .psa-wrap .psa-metric__label { color: rgba(228,220,208,0.5) !important; }

  /* CTAs */
  .psa-wrap .psa-cta-primary { color: #0a0a1a !important; }
  .psa-wrap .psa-cta-secondary { color: var(--ps-gold) !important; }
  .psa-wrap .psa-hero__micro { color: rgba(228,220,208,0.45) !important; }

  /* CTA section finale */
  .psa-wrap .psa-cta-section .psa-section__title { color: #fff !important; }
  .psa-wrap .psa-cta-section .psa-section__subtitle { color: rgba(228,220,208,0.65) !important; }
  .psa-wrap .psa-cta-section .psa-hero__micro { color: rgba(228,220,208,0.4) !important; }

  /* ─── HERO ─────────────────────────────────────────────── */
  .psa-hero {
    position: relative;
    min-height: 100vh;
    display: flex;
    align-items: center;
    overflow: hidden;
    padding: 120px 24px 80px;
  }
  .psa-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
      radial-gradient(ellipse 80% 60% at 50% -10%, rgba(201,168,76,0.12) 0%, transparent 65%),
      radial-gradient(ellipse 60% 50% at 80% 50%,  rgba(124,58,237,0.08) 0%, transparent 60%),
      radial-gradient(ellipse 50% 60% at 10% 80%,  rgba(201,168,76,0.06) 0%, transparent 60%);
    pointer-events: none;
  }
  .psa-hero__grid {
    position: absolute; inset: 0; opacity: .04;
    background-image:
      linear-gradient(rgba(201,168,76,0.6) 1px, transparent 1px),
      linear-gradient(90deg, rgba(201,168,76,0.6) 1px, transparent 1px);
    background-size: 80px 80px;
    pointer-events: none;
  }
  .psa-hero__container {
    position: relative;
    max-width: 1100px;
    margin: 0 auto;
    text-align: center;
  }
  .psa-hero__overline {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 0.7rem;
    letter-spacing: 0.25em;
    text-transform: uppercase;
    color: var(--ps-gold);
    border: 1px solid var(--ps-gold-border);
    padding: 6px 20px;
    border-radius: 50px;
    margin-bottom: 2rem;
    background: rgba(201,168,76,0.06);
  }
  .psa-hero__title {
    font-size: clamp(2.8rem, 6vw, 5.5rem);
    font-weight: 200;
    line-height: 1.08;
    letter-spacing: -0.03em;
    color: #fff;
    margin-bottom: 1.75rem;
  }
  .psa-hero__title em {
    font-style: italic;
    background: linear-gradient(135deg, var(--ps-gold) 0%, var(--ps-gold-light) 50%, var(--ps-gold) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }
  .psa-hero__subtitle {
    font-size: clamp(1rem, 2vw, 1.2rem);
    color: var(--ps-text-dim);
    line-height: 1.8;
    max-width: 660px;
    margin: 0 auto 3rem;
    font-weight: 300;
  }

  /* Metrics bar */
  .psa-metrics {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 1px;
    margin-bottom: 3rem;
    border: 1px solid var(--ps-gold-border);
    border-radius: 16px;
    overflow: hidden;
    background: var(--ps-gold-border);
    max-width: 820px;
    margin-left: auto;
    margin-right: auto;
    margin-bottom: 3rem;
  }
  .psa-metric {
    flex: 1; min-width: 160px;
    background: var(--ps-bg-card);
    padding: 1.5rem 1rem;
    text-align: center;
  }
  .psa-metric__value {
    font-size: 2.2rem;
    font-weight: 600;
    color: var(--ps-gold);
    line-height: 1;
    margin-bottom: 0.3rem;
  }
  .psa-metric__label { font-size: 0.72rem; letter-spacing: 0.1em; text-transform: uppercase; color: var(--ps-text-dim); }

  /* Hero CTA */
  .psa-hero__ctas { display: flex; justify-content: center; flex-wrap: wrap; gap: 1rem; }
  .psa-cta-primary {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 1rem 2.5rem;
    background: linear-gradient(135deg, #b8893a 0%, var(--ps-gold) 40%, var(--ps-gold-light) 100%);
    color: #0a0a1a;
    font-weight: 700; font-size: 1rem;
    border-radius: 50px;
    text-decoration: none;
    transition: all 0.3s;
    box-shadow: 0 8px 32px rgba(201,168,76,0.35);
    cursor: pointer; border: none;
  }
  .psa-cta-primary:hover { transform: translateY(-3px); box-shadow: 0 14px 48px rgba(201,168,76,0.5); }
  .psa-cta-secondary {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 1rem 2rem;
    border: 1px solid var(--ps-gold-border);
    color: var(--ps-gold);
    font-size: 0.95rem; font-weight: 500;
    border-radius: 50px;
    text-decoration: none;
    transition: all 0.3s;
    background: transparent;
  }
  .psa-cta-secondary:hover { background: var(--ps-gold-dim); }
  .psa-hero__micro {
    margin-top: 1.5rem;
    font-size: 0.78rem;
    color: var(--ps-text-dim);
    letter-spacing: 0.05em;
  }

  /* ─── SECTION COMMUNE ──────────────────────────────────── */
  .psa-section { padding: 100px 24px; max-width: 1100px; margin: 0 auto; }
  .psa-section--wide { max-width: 1300px; }
  .psa-section__eyebrow {
    font-size: 0.68rem; letter-spacing: 0.22em; text-transform: uppercase;
    color: var(--ps-gold); margin-bottom: 1rem;
  }
  .psa-section__title {
    font-size: clamp(1.8rem, 4vw, 3rem);
    font-weight: 200; line-height: 1.15;
    letter-spacing: -0.025em;
    color: #fff; margin-bottom: 1rem;
  }
  .psa-section__title strong { font-weight: 600; }
  .psa-section__subtitle {
    font-size: 1.05rem; color: var(--ps-text-dim);
    line-height: 1.8; max-width: 640px; font-weight: 300;
    margin-bottom: 3.5rem;
  }
  .psa-divider {
    width: 100%; height: 1px;
    background: linear-gradient(90deg, transparent, var(--ps-gold-border), transparent);
    margin: 0;
  }

  /* ─── CARDS PRODUITS ────────────────────────────────────── */
  .psa-products { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px,1fr)); gap: 1.5px; }
  .psa-product-card {
    background: var(--ps-bg-card);
    padding: 2.25rem 2rem;
    position: relative;
    overflow: hidden;
    transition: background 0.3s;
  }
  .psa-product-card:hover { background: var(--ps-bg-card2); }
  .psa-product-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; height: 3px;
  }
  .psa-product-card--parcours::before { background: linear-gradient(90deg, var(--ps-gold), var(--ps-gold-light)); }
  .psa-product-card--freelance::before { background: linear-gradient(90deg,#7c3aed, #a78bfa); }
  .psa-product-card--formateur::before { background: linear-gradient(90deg, #2563eb, #60a5fa); }
  .psa-product-card--pause-souffle::before { background: linear-gradient(90deg, #fb923c, #fbbf24); }
  .psa-product-card--retraite::before { background: linear-gradient(90deg,#84cc16, var(--ps-gold)); }
  .psa-product-card__step {
    font-size: 0.62rem; letter-spacing: 0.18em; text-transform: uppercase;
    margin-bottom: 0.75rem;
  }
  .psa-product-card--parcours .psa-product-card__step  { color: var(--ps-gold); }
  .psa-product-card--freelance .psa-product-card__step { color: #a78bfa; }
  .psa-product-card--formateur .psa-product-card__step { color: #60a5fa; }
  .psa-product-card--pause-souffle .psa-product-card__step { color: #fb923c; }
  .psa-product-card--retraite .psa-product-card__step  { color: var(--ps-green); }
  .psa-product-card__name {
    font-size: 1.1rem; font-weight: 600; color: #fff;
    margin-bottom: 0.5rem; line-height: 1.3;
  }
  .psa-product-card__desc {
    font-size: 0.84rem; color: var(--ps-text-dim);
    line-height: 1.6; margin-bottom: 1.75rem;
  }
  .psa-product-card__price {
    font-size: 0.75rem; color: var(--ps-text-dim);
    letter-spacing: 0.05em; margin-bottom: 0.25rem;
  }
  .psa-product-card__rate {
    font-size: 2.6rem; font-weight: 700; line-height: 1;
    color: var(--ps-gold); margin-bottom: 0.5rem;
  }
  .psa-product-card--freelance .psa-product-card__rate { color: #a78bfa; }
  .psa-product-card--formateur .psa-product-card__rate { color: #60a5fa; }
  .psa-product-card--pause-souffle .psa-product-card__rate { color: #fb923c; }
  .psa-product-card--retraite  .psa-product-card__rate { color: var(--ps-green); }
  .psa-product-card__earn {
    display: inline-block;
    font-size: 0.88rem; font-weight: 600;
    padding: 5px 14px;
    border-radius: 50px;
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.08);
    color: rgba(228,220,208,0.7);
  }

  /* ─── JOURNEY TIMELINE ──────────────────────────────────── */
  .psa-journey { position: relative; }
  .psa-journey__steps { display: flex; flex-direction: column; gap: 0; }
  .psa-journey__step {
    display: grid;
    grid-template-columns: 1fr auto 1fr;
    align-items: center;
    gap: 2rem;
    padding: 2.25rem 0;
    border-bottom: 1px solid rgba(255,255,255,0.05);
  }
  .psa-journey__step:last-child { border-bottom: none; }
  .psa-journey__left { text-align: right; }
  .psa-journey__right { text-align: left; }
  .psa-journey__product-name { font-size: 1rem; font-weight: 600; color: #fff; margin-bottom: 0.2rem; }
  .psa-journey__product-price { font-size: 0.82rem; color: var(--ps-text-dim); }
  .psa-journey__node {
    width: 56px; height: 56px; border-radius: 50%;
    border: 2px solid var(--ps-gold-border);
    background: var(--ps-bg-card);
    display: flex; align-items: center; justify-content: center;
    font-size: 0.7rem; font-weight: 700; color: var(--ps-gold);
    letter-spacing: 0.05em;
    position: relative; flex-shrink: 0;
  }
  .psa-journey__node::before {
    content: '';
    position: absolute;
    top: 100%; left: 50%;
    transform: translateX(-50%);
    width: 1px; height: calc(100% + 2rem);
    background: linear-gradient(to bottom, var(--ps-gold-border), transparent);
  }
  .psa-journey__step:last-child .psa-journey__node::before { display: none; }
  .psa-journey__earn { font-size: 1.5rem; font-weight: 700; color: var(--ps-gold); }
  .psa-journey__earn-label { font-size: 0.78rem; color: var(--ps-text-dim); }

  .psa-journey__total {
    margin-top: 3.5rem;
    background: linear-gradient(135deg, rgba(201,168,76,0.08) 0%, rgba(201,168,76,0.03) 100%);
    border: 1px solid var(--ps-gold-border);
    border-radius: 20px;
    padding: 2.5rem 2rem;
    text-align: center;
  }
  .psa-journey__total-label { font-size: 0.72rem; letter-spacing: 0.18em; text-transform: uppercase; color: var(--ps-gold); margin-bottom: 0.5rem; }
  .psa-journey__total-value { font-size: 4rem; font-weight: 200; color: #fff; letter-spacing: -0.04em; }
  .psa-journey__total-value span { color: var(--ps-gold); font-weight: 600; }
  .psa-journey__total-sub { font-size: 0.88rem; color: var(--ps-text-dim); margin-top: 0.5rem; }

  /* ─── NIVEAUX AMBASSADEUR ───────────────────────────────── */
  .psa-tiers { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px,1fr)); gap: 24px; }
  .psa-tier-card {
    border-radius: 20px;
    padding: 2.5rem 2rem;
    position: relative;
    overflow: hidden;
    border: 1px solid rgba(255,255,255,0.06);
    background: var(--ps-bg-card);
    transition: transform 0.3s;
  }
  .psa-tier-card:hover { transform: translateY(-4px); }
  .psa-tier-card--partenaire {
    border-color: var(--ps-gold-border);
    background: linear-gradient(160deg, rgba(201,168,76,0.06) 0%, var(--ps-bg-card) 60%);
  }
  .psa-tier-card--ambassadeur {
    border-color: rgba(201,168,76,0.5);
    background: linear-gradient(160deg, rgba(201,168,76,0.10) 0%, rgba(124,58,237,0.08) 100%);
  }
  .psa-tier-card--ambassadeur::before {
    content: '';
    position: absolute; inset: 0;
    background: radial-gradient(ellipse at top center, rgba(201,168,76,0.08) 0%, transparent 60%);
    pointer-events: none;
  }
  .psa-tier__badge {
    display: inline-block;
    font-size: 0.65rem; letter-spacing: 0.18em; text-transform: uppercase;
    padding: 4px 14px; border-radius: 50px; margin-bottom: 1.5rem;
    border: 1px solid;
  }
  .psa-tier-card--standard .psa-tier__badge  { color: rgba(228,220,208,0.5); border-color: rgba(255,255,255,0.1); background: rgba(255,255,255,0.03); }
  .psa-tier-card--partenaire .psa-tier__badge { color: var(--ps-gold); border-color: var(--ps-gold-border); background: var(--ps-gold-dim); }
  .psa-tier-card--ambassadeur .psa-tier__badge{ color: #fff; border-color: var(--ps-gold); background: linear-gradient(135deg, rgba(201,168,76,0.2), rgba(124,58,237,0.15)); }
  .psa-tier__icon { font-size: 2.5rem; margin-bottom: 1rem; display: block; }
  .psa-tier__name { font-size: 1.4rem; font-weight: 600; color: #fff; margin-bottom: 0.4rem; }
  .psa-tier__condition { font-size: 0.8rem; color: var(--ps-text-dim); margin-bottom: 1.5rem; }
  .psa-tier__benefits { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 0.6rem; }
  .psa-tier__benefit {
    display: flex; align-items: flex-start; gap: 10px;
    font-size: 0.88rem; color: var(--ps-text);
    line-height: 1.4;
  }
  .psa-tier__benefit::before {
    content: '✓';
    color: var(--ps-gold); font-size: 0.8rem;
    margin-top: 2px; flex-shrink: 0;
  }
  .psa-tier-card--ambassadeur .psa-tier__benefit::before { color: var(--ps-gold-light); }

  /* ─── HOW IT WORKS ──────────────────────────────────────── */
  .psa-steps { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px,1fr)); gap: 2px; }
  .psa-step {
    background: var(--ps-bg-card);
    padding: 2.25rem 1.75rem;
    position: relative;
  }
  .psa-step__number {
    font-size: 3.5rem; font-weight: 700;
    color: rgba(201,168,76,0.12);
    line-height: 1; margin-bottom: 1rem;
  }
  .psa-step__title { font-size: 1rem; font-weight: 600; color: #fff; margin-bottom: 0.6rem; }
  .psa-step__desc { font-size: 0.86rem; color: var(--ps-text-dim); line-height: 1.7; }

  .psa-tech-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px,1fr));
    gap: 16px;
    margin-top: 3rem;
  }
  .psa-tech-item {
    background: var(--ps-bg-card);
    border: 1px solid rgba(255,255,255,0.06);
    border-radius: 14px;
    padding: 1.5rem;
    display: flex; flex-direction: column; gap: 0.4rem;
  }
  .psa-tech-item__icon { font-size: 1.3rem; }
  .psa-tech-item__label { font-size: 0.68rem; letter-spacing: 0.12em; text-transform: uppercase; color: var(--ps-text-dim); }
  .psa-tech-item__value { font-size: 1rem; font-weight: 600; color: #fff; }

  /* ─── PHILOSOPHY ────────────────────────────────────────── */
  .psa-philosophy {
    max-width: 860px; margin: 0 auto;
    text-align: center; padding: 100px 24px;
  }
  .psa-philosophy blockquote {
    font-size: clamp(1.4rem, 3vw, 2.2rem);
    font-weight: 200;
    font-style: italic;
    line-height: 1.5;
    color: rgba(228,220,208,0.9);
    border-left: none;
    padding: 0;
    margin: 0 0 2.5rem;
  }
  .psa-philosophy blockquote em { color: var(--ps-gold); font-style: normal; }

  /* ─── VALEURS ───────────────────────────────────────────── */
  .psa-values { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px,1fr)); gap: 1.5px; }
  .psa-value {
    background: var(--ps-bg-card);
    padding: 2.5rem 2rem;
    text-align: center;
  }
  .psa-value__icon { font-size: 1.75rem; margin-bottom: 1rem; display: block; }
  .psa-value__name { font-size: 0.9rem; font-weight: 700; color: #fff; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 0.5rem; }
  .psa-value__desc { font-size: 0.82rem; color: var(--ps-text-dim); line-height: 1.6; }

  /* ─── DASHBOARD INLINE (si connecté et ambassadeur) ────── */
  .psa-dash {
    max-width: 1100px; margin: 0 auto;
    border: 1px solid var(--ps-gold-border);
    border-radius: 24px;
    overflow: hidden;
    background: var(--ps-bg-card);
  }
  .psa-dash__header {
    padding: 2.5rem 2.5rem 2rem;
    background: linear-gradient(135deg, rgba(201,168,76,0.08) 0%, transparent 60%);
    border-bottom: 1px solid var(--ps-gold-border);
    display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem;
  }
  .psa-dash__tier-badge {
    display: inline-flex; align-items: center; gap: 6px;
    font-size: 0.7rem; letter-spacing: 0.14em; text-transform: uppercase;
    color: var(--ps-gold); border: 1px solid var(--ps-gold-border);
    padding: 5px 16px; border-radius: 50px;
    background: var(--ps-gold-dim);
  }
  .psa-dash__greeting { font-size: 1.5rem; font-weight: 300; color: #fff; margin-top: 0.5rem; }
  .psa-dash__stats { display: flex; flex-wrap: wrap; gap: 1.5rem; padding: 2rem 2.5rem; }
  .psa-dash__stat { flex: 1; min-width: 140px; }
  .psa-dash__stat-value { font-size: 2rem; font-weight: 600; color: var(--ps-gold); line-height: 1; }
  .psa-dash__stat-label { font-size: 0.72rem; color: var(--ps-text-dim); text-transform: uppercase; letter-spacing: 0.08em; margin-top: 4px; }
  .psa-dash__link-box {
    margin: 0 2.5rem 2rem;
    display: flex; gap: 0;
    border: 1px solid var(--ps-gold-border); border-radius: 12px; overflow: hidden;
  }
  .psa-dash__link-input {
    flex: 1; background: transparent; border: none; outline: none;
    padding: 0.9rem 1.1rem; color: var(--ps-gold); font-size: 0.85rem;
    font-family: 'Courier New', monospace;
  }
  .psa-dash__link-btn {
    padding: 0 1.5rem;
    background: var(--ps-gold);
    color: #0a0a1a; font-weight: 700; font-size: 0.82rem;
    border: none; cursor: pointer; transition: all 0.2s; white-space: nowrap;
    letter-spacing: 0.05em;
  }
  .psa-dash__link-btn:hover { background: var(--ps-gold-light); }
  .psa-dash__progress-wrap { padding: 0 2.5rem 2.5rem; }
  .psa-dash__progress-labels { display: flex; justify-content: space-between; font-size: 0.78rem; color: var(--ps-text-dim); margin-bottom: 0.5rem; }
  .psa-dash__progress-bar { height: 6px; background: rgba(255,255,255,0.06); border-radius: 3px; overflow: hidden; }
  .psa-dash__progress-fill { height: 100%; background: linear-gradient(90deg, var(--ps-gold), var(--ps-gold-light)); border-radius: 3px; transition: width 0.8s; }

  /* ─── CTA FINAL ─────────────────────────────────────────── */
  .psa-cta-section {
    padding: 120px 24px;
    text-align: center;
    position: relative;
    overflow: hidden;
  }
  .psa-cta-section::before {
    content: '';
    position: absolute; inset: 0;
    background:
      radial-gradient(ellipse 80% 60% at 50% 100%, rgba(201,168,76,0.1) 0%, transparent 60%),
      radial-gradient(ellipse 60% 40% at 50% 0%,   rgba(201,168,76,0.05) 0%, transparent 60%);
    pointer-events: none;
  }
  .psa-cta-section__content { position: relative; max-width: 680px; margin: 0 auto; }
  .psa-cta-section__title {
    font-size: clamp(2rem, 4.5vw, 3.5rem);
    font-weight: 200; line-height: 1.1;
    letter-spacing: -0.03em;
    color: #fff; margin-bottom: 1rem;
  }
  .psa-cta-section__title em {
    font-style: italic;
    background: linear-gradient(135deg, var(--ps-gold), var(--ps-gold-light));
    -webkit-background-clip: text; -webkit-text-fill-color: transparent;
    background-clip: text;
  }
  .psa-cta-section__sub { font-size: 1rem; color: var(--ps-text-dim); line-height: 1.7; margin-bottom: 2.5rem; font-weight: 300; }
  .psa-cta-section__micro { font-size: 0.78rem; color: var(--ps-text-dim); margin-top: 1.25rem; letter-spacing: 0.05em; }
  .psa-cta-section__micro span { color: rgba(201,168,76,0.6); margin: 0 4px; }

  @media (max-width: 768px) {
    .psa-hero { padding: 100px 20px 60px; }
    .psa-journey__step { grid-template-columns: 1fr auto; }
    .psa-journey__left { display: none; }
    .psa-journey__right { text-align: left; }
    .psa-section { padding: 70px 20px; }
    .psa-dash__header { flex-direction: column; }
    .psa-dash__stats { gap: 1rem; }
    .psa-dash__link-box, .psa-dash__stats, .psa-dash__progress-wrap { margin-left: 1.25rem; margin-right: 1.25rem; }
  }
</style>

<div class="psa-wrap">

  {{-- ─── Flash ─────────────────────────────────────────────── --}}
  @if(session('success'))
    <div class="psa-flash">
      <div class="psa-flash__inner psa-flash__inner--success">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
        {{ session('success') }}
      </div>
    </div>
  @endif
  @if(session('error'))
    <div class="psa-flash">
      <div class="psa-flash__inner" style="background:rgba(239,68,68,0.1);color:#fca5a5;border-left:3px solid #ef4444;">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        {{ session('error') }}
      </div>
    </div>
  @endif

  {{-- ══════════════════════════════════════════════════════════
       SECTION 1 — HERO
  ══════════════════════════════════════════════════════════════ --}}
  <section class="psa-hero">
    <div class="psa-hero__grid"></div>
    <div class="psa-hero__container">

      <div class="psa-hero__overline">
        <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
        Réseau des Ambassadeurs · Pause Souffle
      </div>

      <h1 class="psa-hero__title">
        Transmettre<br>ce qui <em>transforme.</em>
      </h1>

      <p class="psa-hero__subtitle">
        Le réseau des Ambassadeurs Pause Souffle rassemble celles et ceux qui ont vécu l'expérience
        et souhaitent la partager naturellement autour d'eux.<br>
        <strong style="color: rgba(228,220,208,0.7);">Ce n'est pas de la vente. C'est du témoignage.</strong>
      </p>

      <div class="psa-metrics">
        <div class="psa-metric">
          <div class="psa-metric__value">25%</div>
          <div class="psa-metric__label">Commission max</div>
        </div>
        <div class="psa-metric">
          <div class="psa-metric__value">90j</div>
          <div class="psa-metric__label">Cookie tracking</div>
        </div>
        <div class="psa-metric">
          <div class="psa-metric__value">7</div>
          <div class="psa-metric__label">Programmes PS</div>
        </div>
        <div class="psa-metric">
          <div class="psa-metric__value">3 339€</div>
          <div class="psa-metric__label">Par filleul complet</div>
        </div>
      </div>

      <div class="psa-hero__ctas">
        @if($hasAffiliate)
          <a href="{{ route('presence.ambassadeurs') }}" class="psa-cta-primary">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            Mon espace ambassadeur
          </a>
        @elseif($isLoggedIn)
          <button type="button" class="psa-cta-primary" @click="$dispatch('open-register-modal')">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
            Rejoindre le réseau
          </button>
        @else
          <a href="{{ route('user.signup') }}" class="psa-cta-primary">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
            Créer un compte & rejoindre
          </a>
          <a href="{{ route('user.login') }}" class="psa-cta-secondary">
            Déjà membre ? Se connecter
          </a>
        @endif
      </div>

      <p class="psa-hero__micro">Inscription gratuite · Sans engagement · Commissions versées par virement SEPA</p>
    </div>
  </section>

  <div class="psa-divider"></div>

  {{-- ══════════════════════════════════════════════════════════
       SECTION — LA VISION
  ══════════════════════════════════════════════════════════════ --}}
  <div style="background: var(--ps-bg-card);">
    <div class="psa-section" style="max-width: 860px; text-align: center;">
      <div class="psa-section__eyebrow" style="display:block; margin-bottom: 1.5rem;">La vision</div>
      <h2 class="psa-section__title" style="margin-bottom: 2rem;">Une transformation<br>qui se <strong>transmet.</strong></h2>
      <p style="font-size: 1.1rem; color: rgba(228,220,208,0.75); line-height: 2; font-weight: 300; margin-bottom: 2rem;">
        Pause Souffle est né d'une conviction simple : lorsque nous retrouvons un espace de présence
        et de respiration dans nos vies, une nouvelle qualité d'attention apparaît.
      </p>
      <p style="font-size: 1.05rem; color: rgba(228,220,208,0.6); line-height: 2; font-weight: 300;">
        Le réseau des ambassadeurs permet à celles et ceux qui ont été touchés par cette expérience
        de la faire découvrir à d'autres, naturellement.
      </p>
    </div>
  </div>

  <div class="psa-divider"></div>

  {{-- ══════════════════════════════════════════════════════════
       DASHBOARD INLINE — si ambassadeur actif connecté
  ══════════════════════════════════════════════════════════════ --}}
  @if($hasAffiliate && $psStats)
  <div style="padding: 60px 24px;" x-data="{
    copied: false,
    copyLink() {
      const link = {{ json_encode($psStats['tracking_link']) }};
      navigator.clipboard.writeText(link).then(() => {
        this.copied = true; setTimeout(() => this.copied = false, 2500);
      });
    }
  }">
    <div class="psa-dash">
      <div class="psa-dash__header">
        <div>
          <div class="psa-dash__tier-badge">
            {{ $psStats['tier_icon'] }} {{ $psStats['tier_label'] }}
          </div>
          <div class="psa-dash__greeting">
            Bonjour, {{ $user->first_name ?? explode(' ', $user->name ?? 'Ambassadeur')[0] }} ✦
          </div>
        </div>
        <a href="{{ route('presence.ambassadeurs') }}" style="font-size:.82rem; color: var(--ps-gold); text-decoration:none; border: 1px solid var(--ps-gold-border); padding: 8px 20px; border-radius: 50px; transition: background 0.2s;" onmouseover="this.style.background='rgba(201,168,76,0.1)'" onmouseout="this.style.background='transparent'">
          Tableau de bord complet →
        </a>
        <a href="{{ route('ps.ressources') }}" style="font-size:.82rem; color: var(--ps-text-dim); text-decoration:none; border: 1px solid rgba(228,220,208,0.15); padding: 8px 20px; border-radius: 50px; transition: background 0.2s; margin-left: 8px;" onmouseover="this.style.background='rgba(228,220,208,0.05)'" onmouseout="this.style.background='transparent'">
          Ressources →
        </a>
      </div>

      <div class="psa-dash__stats">
        <div class="psa-dash__stat">
          <div class="psa-dash__stat-value">{{ $psStats['clicks_count'] }}</div>
          <div class="psa-dash__stat-label">Clics sur votre lien</div>
        </div>
        <div class="psa-dash__stat">
          <div class="psa-dash__stat-value">{{ $psStats['sales_count'] }}</div>
          <div class="psa-dash__stat-label">Ventes validées</div>
        </div>
        <div class="psa-dash__stat">
          <div class="psa-dash__stat-value">{{ number_format($psStats['validated_amt'], 0, ',', ' ') }} €</div>
          <div class="psa-dash__stat-label">Commissions validées</div>
        </div>
        <div class="psa-dash__stat">
          <div class="psa-dash__stat-value">{{ $psStats['conversion_rate'] }} %</div>
          <div class="psa-dash__stat-label">Taux de conversion</div>
        </div>
        <div class="psa-dash__stat">
          <div class="psa-dash__stat-value">{{ number_format($psStats['pending_amt'], 0, ',', ' ') }} €</div>
          <div class="psa-dash__stat-label">En attente (30j)</div>
        </div>
      </div>

      <div class="psa-dash__link-box">
        <input class="psa-dash__link-input" type="text" value="{{ $psStats['tracking_link'] }}" readonly aria-label="Lien ambassadeur Pause Souffle">
        <button type="button" class="psa-dash__link-btn" @click="copyLink()" x-text="copied ? '✓ Copié !' : 'Copier'">Copier</button>
      </div>

      @if($psStats['next_tier'])
      <div class="psa-dash__progress-wrap">
        <div class="psa-dash__progress-labels">
          <span>{{ $psStats['tier_label'] }}</span>
          <span>{{ $psStats['sales_count'] }} / {{ $psStats['next_min'] }} ventes → {{ $psStats['next_tier_label'] }}</span>
        </div>
        <div class="psa-dash__progress-bar">
          <div class="psa-dash__progress-fill" style="width: {{ $psStats['progress'] }}%"></div>
        </div>
      </div>
      @else
      <div style="padding: 0 2.5rem 2rem; font-size: 0.85rem; color: var(--ps-gold);">
        ✦✦✦ Vous avez atteint le niveau maximum — Ambassadeur Pause Souffle
      </div>
      @endif
    </div>
  </div>
  <div class="psa-divider"></div>
  @endif

  {{-- ══════════════════════════════════════════════════════════
       SECTION 2 — LES PROGRAMMES & COMMISSIONS
  ══════════════════════════════════════════════════════════════ --}}
  <div style="background: var(--ps-bg);">
    <div class="psa-section" style="padding-bottom: 0;">
      <div class="psa-section__eyebrow">Commissions · Structure inversée</div>
      <h2 class="psa-section__title">Les <strong>7 programmes</strong><br>et leurs commissions</h2>
      <p class="psa-section__subtitle">
        Plus le produit est digital et scalable, plus la commission est haute.
        Plus il implique des coûts physiques, plus elle est prudente.
        C'est la logique des programmes premium durables.
      </p>
    </div>

    <div style="max-width: 1100px; margin: 0 auto; border: 1px solid var(--ps-gold-border);">
      <div class="psa-products">
        {{-- Étape 1 --}}
        <div class="psa-product-card psa-product-card--parcours">
          <div class="psa-product-card__step">Étape 1 · Transformation · Éveil</div>
          <div class="psa-product-card__name">Se Retrouver<br><span style="font-size:0.8em;opacity:0.65;">Parcours Pause Souffle</span></div>
          <div class="psa-product-card__desc">10 modules en ligne · Présence & Souffle · Certification Niveau 1 · Éveil</div>
          <div class="psa-product-card__price">2 190 €</div>
          <div class="psa-product-card__rate">25%</div>
          <div class="psa-product-card__earn">Vous gagnez ≈ 547 €</div>
        </div>
        {{-- Étape 2 --}}
        <div class="psa-product-card psa-product-card--parcours">
          <div class="psa-product-card__step">Étape 2 · Transformation · Ancrage</div>
          <div class="psa-product-card__name">Se Construire<br><span style="font-size:0.8em;opacity:0.65;">Parcours Pause Souffle</span></div>
          <div class="psa-product-card__desc">13 modules en ligne · Corps, Énergie & Discipline · Certification Niveau 2 · Ancrage</div>
          <div class="psa-product-card__price">2 490 €</div>
          <div class="psa-product-card__rate">25%</div>
          <div class="psa-product-card__earn">Vous gagnez ≈ 622 €</div>
        </div>
        {{-- Étape 3 --}}
        <div class="psa-product-card psa-product-card--parcours">
          <div class="psa-product-card__step">Étape 3 · Transformation · Maîtrise</div>
          <div class="psa-product-card__name">S’Ouvrir<br><span style="font-size:0.8em;opacity:0.65;">Parcours Pause Souffle</span></div>
          <div class="psa-product-card__desc">16 modules en ligne · Relations, Sens & Rayonnement · Certification Niveau 3 · Maîtrise</div>
          <div class="psa-product-card__price">2 990 €</div>
          <div class="psa-product-card__rate">25%</div>
          <div class="psa-product-card__earn">Vous gagnez ≈ 747 €</div>
        </div>
        {{-- Formation Praticien --}}
        <div class="psa-product-card psa-product-card--freelance">
          <div class="psa-product-card__step">Professionnel · Accompagnement</div>
          <div class="psa-product-card__name">Formation<br>Praticien PS</div>
          <div class="psa-product-card__desc">Maîtriser et animer les Rituels · Exercer en cabinet ou entreprise · Certification Praticien</div>
          <div class="psa-product-card__price">3 490 €</div>
          <div class="psa-product-card__rate" style="color: #a78bfa;">20%</div>
          <div class="psa-product-card__earn">Vous gagnez ≈ 698 €</div>
        </div>
        {{-- Mentors --}}
        <div class="psa-product-card psa-product-card--formateur">
          <div class="psa-product-card__step">Transmission · Formation</div>
          <div class="psa-product-card__name">Formation<br>des Mentors</div>
          <div class="psa-product-card__desc">Former et accompagner d'autres praticiens · Animer des groupes · Habilitation Formateur</div>
          <div class="psa-product-card__price">3 500 €</div>
          <div class="psa-product-card__rate" style="color: #60a5fa;">15%</div>
          <div class="psa-product-card__earn">Vous gagnez ≈ 525 €</div>
        </div>
        {{-- Ma Pause Souffle dans votre univers --}}
        <div class="psa-product-card" style="border-top: 3px solid #fb923c;">
          <div class="psa-product-card__step" style="color: #fb923c;">Indépendant · Votre univers</div>
          <div class="psa-product-card__name">Ma Pause Souffle<br><span style="font-size:0.8em;opacity:0.65;">dans votre univers</span></div>
          <div class="psa-product-card__desc">Intégrer le 5-5-5 dans votre métier · Potier, prof de yoga, manager, éducateur · 5 modules en ligne</div>
          <div class="psa-product-card__price">999 €</div>
          <div class="psa-product-card__rate" style="color: #fb923c;">20%</div>
          <div class="psa-product-card__earn">Vous gagnez ≈ 200 €</div>
        </div>
        {{-- Retraite --}}
        <div class="psa-product-card psa-product-card--retraite">
          <div class="psa-product-card__step">Option · Immersion physique</div>
          <div class="psa-product-card__name">La Retraite<br>Pause Souffle</div>
          <div class="psa-product-card__desc">7 jours en Méditerranée · Destination surprise · 12 places · Immersion complète en nature</div>
          <div class="psa-product-card__price">4 800 – 5 500 €</div>
          <div class="psa-product-card__rate" style="color: #84cc16;">10%</div>
          <div class="psa-product-card__earn">Vous gagnez ≈ 480 – 550 €</div>
        </div>
      </div>
    </div>
    <div style="height: 80px;"></div>
  </div>

  <div class="psa-divider"></div>

  {{-- ══════════════════════════════════════════════════════════
       SECTION 3 — PARCOURS D'UN FILLEUL
  ══════════════════════════════════════════════════════════════ --}}
  <div style="background: var(--ps-bg-card);">
    <div class="psa-section">
      <div style="display: grid; grid-template-columns: 1fr 1.2fr; gap: 5rem; align-items: start;">
        <div>
          <div class="psa-section__eyebrow">Potentiel par filleul</div>
          <h2 class="psa-section__title">Le parcours<br>d'un filleul —<br><strong>votre gain total</strong></h2>
          <p class="psa-section__subtitle" style="margin-bottom: 0;">
            Lorsqu'un filleul traverse l'écosystème complet Pause Souffle,
            vous percevez une commission à chaque étape de son chemin.
          </p>
        </div>
        <div class="psa-journey">
          <div class="psa-journey__steps">
            <div class="psa-journey__step">
              <div class="psa-journey__left">
                <div class="psa-journey__earn">547 €</div>
                <div class="psa-journey__earn-label">commission ambassadeur</div>
              </div>
              <div class="psa-journey__node">1</div>
              <div class="psa-journey__right">
                <div class="psa-journey__product-name">Étape 1 — Se Retrouver</div>
                <div class="psa-journey__product-price">2 190 € · 25%</div>
              </div>
            </div>
            <div class="psa-journey__step">
              <div class="psa-journey__left">
                <div class="psa-journey__earn">622 €</div>
                <div class="psa-journey__earn-label">commission ambassadeur</div>
              </div>
              <div class="psa-journey__node">2</div>
              <div class="psa-journey__right">
                <div class="psa-journey__product-name">Étape 2 — Se Construire</div>
                <div class="psa-journey__product-price">2 490 € · 25%</div>
              </div>
            </div>
            <div class="psa-journey__step">
              <div class="psa-journey__left">
                <div class="psa-journey__earn">747 €</div>
                <div class="psa-journey__earn-label">commission ambassadeur</div>
              </div>
              <div class="psa-journey__node">3</div>
              <div class="psa-journey__right">
                <div class="psa-journey__product-name">Étape 3 — S’Ouvrir</div>
                <div class="psa-journey__product-price">2 990 € · 25%</div>
              </div>
            </div>
            <div class="psa-journey__step">
              <div class="psa-journey__left">
                <div class="psa-journey__earn" style="color: #84cc16;">500 €</div>
                <div class="psa-journey__earn-label">commission ambassadeur</div>
              </div>
              <div class="psa-journey__node">+</div>
              <div class="psa-journey__right">
                <div class="psa-journey__product-name">La Retraite 7 jours</div>
                <div class="psa-journey__product-price">~5 000 € · 10% · option</div>
              </div>
            </div>
            <div class="psa-journey__step">
              <div class="psa-journey__left">
                <div class="psa-journey__earn" style="color: #a78bfa;">698 €</div>
                <div class="psa-journey__earn-label">commission ambassadeur</div>
              </div>
              <div class="psa-journey__node">4</div>
              <div class="psa-journey__right">
                <div class="psa-journey__product-name">Formation Praticien PS</div>
                <div class="psa-journey__product-price">3 490 € · 20%</div>
              </div>
            </div>
            <div class="psa-journey__step">
              <div class="psa-journey__left">
                <div class="psa-journey__earn" style="color: #60a5fa;">525 €</div>
                <div class="psa-journey__earn-label">commission ambassadeur</div>
              </div>
              <div class="psa-journey__node">5</div>
              <div class="psa-journey__right">
                <div class="psa-journey__product-name">Formation des Mentors</div>
                <div class="psa-journey__product-price">3 500 € · 15%</div>
              </div>
            </div>
            <div class="psa-journey__step">
              <div class="psa-journey__left">
                <div class="psa-journey__earn" style="color: #fb923c;">200 €</div>
                <div class="psa-journey__earn-label">commission ambassadeur</div>
              </div>
              <div class="psa-journey__node">+</div>
              <div class="psa-journey__right">
                <div class="psa-journey__product-name">Ma Pause Souffle dans votre univers</div>
                <div class="psa-journey__product-price">999 € · 20% · option</div>
              </div>
            </div>
          </div>
          <div class="psa-journey__total">
            <div class="psa-journey__total-label">Total possible pour un seul filleul</div>
            <div class="psa-journey__total-value">≈ <span>3 339 €</span></div>
            <div class="psa-journey__total-sub">En recommandant l’écosystème complet (hors Retraite)</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="psa-divider"></div>

  {{-- ══════════════════════════════════════════════════════════
       SECTION 4 — LES 3 NIVEAUX
  ══════════════════════════════════════════════════════════════ --}}
  <div style="background: var(--ps-bg);">
    <div class="psa-section">
      <div class="psa-section__eyebrow">Progression · 3 niveaux</div>
      <h2 class="psa-section__title">Les <strong>niveaux<br>d'Ambassadeur</strong></h2>
      <p class="psa-section__subtitle">
        Plus vous recommandez, plus votre statut évolue — et plus vous accédez à des avantages exclusifs.
        Le palier se calcule sur les ventes Pause Souffle validées.
      </p>

      <div class="psa-tiers">
        {{-- Standard --}}
        <div class="psa-tier-card psa-tier-card--standard">
          <div class="psa-tier__badge">Standard · 0 à 4 ventes</div>
          <span class="psa-tier__icon">✦</span>
          <div class="psa-tier__name">Ambassadeur Standard</div>
          <div class="psa-tier__condition">Dès l'inscription au programme</div>
          <ul class="psa-tier__benefits">
            <li class="psa-tier__benefit">Lien ambassadeur personnel (format /ps/{code})</li>
            <li class="psa-tier__benefit">Cookie tracking 90 jours</li>
            <li class="psa-tier__benefit">Commissions sur les 7 programmes Pause Souffle</li>
            <li class="psa-tier__benefit">Tableau de bord complet avec suivi en temps réel</li>
            <li class="psa-tier__benefit">Paiement mensuel par virement SEPA</li>
          </ul>
        </div>

        {{-- Partenaire --}}
        <div class="psa-tier-card psa-tier-card--partenaire">
          <div class="psa-tier__badge">Partenaire · 5 à 14 ventes</div>
          <span class="psa-tier__icon">✦✦</span>
          <div class="psa-tier__name">Ambassadeur Partenaire</div>
          <div class="psa-tier__condition">À partir de 5 ventes PS validées</div>
          <ul class="psa-tier__benefits">
            <li class="psa-tier__benefit">Tout le niveau Standard</li>
            <li class="psa-tier__benefit">Visibilité dans l'annuaire des Ambassadeurs PS</li>
            <li class="psa-tier__benefit">Invitations aux événements privés Pause Souffle</li>
            <li class="psa-tier__benefit">Badge Partenaire visible sur votre profil JunsPro</li>
            <li class="psa-tier__benefit">Ressources de partage premium (visuels, textes)</li>
          </ul>
        </div>

        {{-- Ambassadeur --}}
        <div class="psa-tier-card psa-tier-card--ambassadeur">
          <div class="psa-tier__badge">Ambassadeur · 15+ ventes</div>
          <span class="psa-tier__icon">✦✦✦</span>
          <div class="psa-tier__name">Ambassadeur</div>
          <div class="psa-tier__condition">À partir de 15 ventes PS validées</div>
          <ul class="psa-tier__benefits">
            <li class="psa-tier__benefit">Tout le niveau Partenaire</li>
            <li class="psa-tier__benefit">Accès prioritaire à la Retraite Pause Souffle</li>
            <li class="psa-tier__benefit">Cercle privé des Ambassadeurs (15 personnes max)</li>
            <li class="psa-tier__benefit">Appel mensuel direct avec l'équipe Pause Souffle</li>
            <li class="psa-tier__benefit">Co-branding possible pour vos interventions</li>
            <li class="psa-tier__benefit">Présentation dans les communications officielles PS</li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <div class="psa-divider"></div>

  {{-- ══════════════════════════════════════════════════════════
       SECTION 5 — COMMENT ÇA FONCTIONNE
  ══════════════════════════════════════════════════════════════ --}}
  <div style="background: var(--ps-bg-card);">
    <div class="psa-section">
      <div class="psa-section__eyebrow">Fonctionnement · 3 étapes</div>
      <h2 class="psa-section__title">Comment<br><strong>ça fonctionne</strong></h2>

      <div class="psa-steps" style="border: 1px solid rgba(255,255,255,0.04);">
        <div class="psa-step">
          <div class="psa-step__number">01</div>
          <div class="psa-step__title">Partagez votre lien</div>
          <div class="psa-step__desc">Vous recevez un lien personnel unique au format <code style="font-size:.8em; color: var(--ps-gold);">junspro.com/ps/{code}</code>. Partagez-le naturellement — sur vos réseaux, par email, ou en conversation.</div>
        </div>
        <div class="psa-step">
          <div class="psa-step__number">02</div>
          <div class="psa-step__title">Votre filleul découvre</div>
          <div class="psa-step__desc">Dès le clic sur votre lien, un cookie de 90 jours est posé. Si votre filleul achète l'un des programmes Pause Souffle dans les 90 jours, la commission vous est attribuée automatiquement.</div>
        </div>
        <div class="psa-step">
          <div class="psa-step__number">03</div>
          <div class="psa-step__title">Vous percevez la commission</div>
          <div class="psa-step__desc">La commission est validée après 30 jours (anti-fraude). Chaque premier du mois, les commissions validées sont versées par virement SEPA sur votre IBAN.</div>
        </div>
      </div>

      <div class="psa-tech-grid">
        <div class="psa-tech-item">
          <div class="psa-tech-item__icon">🍪</div>
          <div class="psa-tech-item__label">Durée du cookie</div>
          <div class="psa-tech-item__value">90 jours</div>
        </div>
        <div class="psa-tech-item">
          <div class="psa-tech-item__icon">🎯</div>
          <div class="psa-tech-item__label">Attribution</div>
          <div class="psa-tech-item__value">Dernier clic</div>
        </div>
        <div class="psa-tech-item">
          <div class="psa-tech-item__icon">⏱</div>
          <div class="psa-tech-item__label">Délai de validation</div>
          <div class="psa-tech-item__value">30 jours</div>
        </div>
        <div class="psa-tech-item">
          <div class="psa-tech-item__icon">🏦</div>
          <div class="psa-tech-item__label">Paiement</div>
          <div class="psa-tech-item__value">Virement SEPA</div>
        </div>
        <div class="psa-tech-item">
          <div class="psa-tech-item__icon">📊</div>
          <div class="psa-tech-item__label">Suivi</div>
          <div class="psa-tech-item__value">Dashboard temps réel</div>
        </div>
        <div class="psa-tech-item">
          <div class="psa-tech-item__icon">🔒</div>
          <div class="psa-tech-item__label">Anti-auto-commission</div>
          <div class="psa-tech-item__value">Activé</div>
        </div>
      </div>
    </div>
  </div>

  <div class="psa-divider"></div>

  {{-- ══════════════════════════════════════════════════════════
       SECTION 6 — PHILOSOPHIE
  ══════════════════════════════════════════════════════════════ --}}
  <section class="psa-philosophy">
    <div class="psa-section__eyebrow" style="text-align:center; display:block; margin-bottom: 2rem;">L'affiliation transformationnelle</div>

    <blockquote>
      « Vous ne vendez pas un produit.<br>
      Vous partagez une expérience<br>
      que vous avez <em>vécue</em>. »
    </blockquote>

    <p style="font-size: 1rem; color: var(--ps-text-dim); line-height:1.9; font-weight:300; max-width:580px; margin: 0 auto 3rem;">
      Les programmes les plus puissants au monde — Mindvalley, Tony Robbins,
      les grandes écoles de coaching internationales — partagent un principe :
      les ambassadeurs qui recommandent ce qu'ils ont vécu génèrent
      5 à 10 fois plus de résultats que les affiliés classiques.
    </p>

    <div style="display: flex; justify-content: center; flex-wrap: wrap; gap: 1.5px; max-width: 720px; margin: 0 auto; border: 1px solid rgba(255,255,255,0.05); border-radius: 16px; overflow: hidden;">
      <div style="flex: 1; min-width: 200px; padding: 2rem 1.5rem; background: var(--ps-bg-card); text-align: center;">
        <div style="font-size: 1.5rem; margin-bottom: .75rem;">✦</div>
        <div style="font-size: .88rem; font-weight: 600; color: #fff; margin-bottom: .4rem;">Le témoignage</div>
        <div style="font-size: .8rem; color: var(--ps-text-dim); line-height: 1.6;">Vous racontez votre chemin, pas un produit. Les gens font confiance aux personnes, pas aux publicités.</div>
      </div>
      <div style="flex: 1; min-width: 200px; padding: 2rem 1.5rem; background: var(--ps-bg-card); text-align: center;">
        <div style="font-size: 1.5rem; margin-bottom: .75rem;">✦✦</div>
        <div style="font-size: .88rem; font-weight: 600; color: #fff; margin-bottom: .4rem;">L'authenticité</div>
        <div style="font-size: .8rem; color: var(--ps-text-dim); line-height: 1.6;">Pas besoin de script. Votre transformation vécue est le message le plus puissant qui soit.</div>
      </div>
      <div style="flex: 1; min-width: 200px; padding: 2rem 1.5rem; background: var(--ps-bg-card); text-align: center;">
        <div style="font-size: 1.5rem; margin-bottom: .75rem;">✦✦✦</div>
        <div style="font-size: .88rem; font-weight: 600; color: #fff; margin-bottom: .4rem;">Le cercle vertueux</div>
        <div style="font-size: .8rem; color: var(--ps-text-dim); line-height: 1.6;">Vos filleuls deviennent parfois ambassadeurs à leur tour. L'écosystème se renforce naturellement.</div>
      </div>
    </div>
  </section>

  <div class="psa-divider"></div>

  {{-- ══════════════════════════════════════════════════════════
       SECTION 7 — VALEURS DU RÉSEAU
  ══════════════════════════════════════════════════════════════ --}}
  <div style="background: var(--ps-bg-card);">
    <div class="psa-section" style="padding-bottom: 0;">
      <div class="psa-section__eyebrow" style="text-align:center; display:block;">Les valeurs du réseau</div>
      <h2 class="psa-section__title" style="text-align:center; max-width:500px; margin: 0 auto 3.5rem;">Ce qui nous <strong>réunit</strong></h2>
    </div>
    <div class="psa-values" style="max-width: 1300px; margin: 0 auto; border-top: 1px solid rgba(255,255,255,0.04); border-bottom: 1px solid rgba(255,255,255,0.04);">
      <div class="psa-value">
        <span class="psa-value__icon">✦</span>
        <div class="psa-value__name">Authenticité</div>
        <div class="psa-value__desc">Nous ne recommandons que ce que nous avons vécu. Aucun script, aucune pression. Juste un témoignage sincère.</div>
      </div>
      <div class="psa-value">
        <span class="psa-value__icon">⟳</span>
        <div class="psa-value__name">Transformation</div>
        <div class="psa-value__desc">Chaque programme Pause Souffle vise une transformation réelle. Nous transmettons ce qui change les choses en profondeur.</div>
      </div>
      <div class="psa-value">
        <span class="psa-value__icon">◎</span>
        <div class="psa-value__name">Transmission</div>
        <div class="psa-value__desc">Les ambassadeurs sont des passeurs, pas des vendeurs. Transmettre une expérience est un acte de générosité.</div>
      </div>
      <div class="psa-value">
        <span class="psa-value__icon">○</span>
        <div class="psa-value__name">Respect</div>
        <div class="psa-value__desc">Respect des personnes référées. Aucune pression commerciale. Le choix appartient toujours à celui qui découvre.</div>
      </div>
    </div>
    <div style="height: 80px;"></div>
  </div>

  <div class="psa-divider"></div>

  {{-- ══════════════════════════════════════════════════════════
       SECTION — QUI PEUT DEVENIR AMBASSADEUR
  ══════════════════════════════════════════════════════════════ --}}
  <div style="background: var(--ps-bg-card);">
    <div class="psa-section">
      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 5rem; align-items: center;">
        <div>
          <div class="psa-section__eyebrow">Profils · Engagement</div>
          <h2 class="psa-section__title">Un réseau ouvert<br>aux personnes <strong>engagées</strong></h2>
          <p class="psa-section__subtitle">
            Le réseau accueille celles et ceux qui ont vécu une transformation
            et souhaitent la partager avec sincérité — pas des commerciaux,
            des témoins.
          </p>
          @if(!$hasAffiliate)
            @if($isLoggedIn)
              <button type="button" class="psa-cta-primary" @click="$dispatch('open-register-modal')">
                Rejoindre le réseau
              </button>
            @else
              <a href="{{ route('user.signup') }}" class="psa-cta-primary">Rejoindre le réseau</a>
            @endif
          @endif
        </div>
        <div style="display: flex; flex-direction: column; gap: 1px; border: 1px solid rgba(255,255,255,0.06); border-radius: 16px; overflow: hidden;">
          @foreach([
            ['◎', 'Participants du Parcours Pause Souffle', 'Vous avez traversé le Parcours — votre témoignage est la recommandation la plus naturelle.'],
            ['⟳', 'Coachs & thérapeutes', 'Vous accompagnez des personnes en transformation. Pause Souffle élargit naturellement votre univers.'],
            ['✦', 'Enseignants & formateurs', 'Vous transmettez. Le réseau Pause Souffle est une extension de votre mission.'],
            ['○', 'Professionnels de l\'accompagnement', 'Consultants, RH, managers : vous avez vécu la puissance de la présence dans votre travail.'],
            ['◇', 'Personnes inspirées par la démarche', 'Vous n\'êtes pas encore praticien mais la philosophie Pause Souffle vous touche profondément.'],
          ] as [$icon, $title, $desc])
          <div style="background: var(--ps-bg); padding: 1.5rem 1.75rem; display: flex; gap: 1.25rem; align-items: flex-start; transition: background 0.2s;" onmouseover="this.style.background='rgba(201,168,76,0.04)'" onmouseout="this.style.background='var(--ps-bg)'">
            <span style="color: var(--ps-gold); font-size: 1.1rem; margin-top: 2px; flex-shrink: 0;">{{ $icon }}</span>
            <div>
              <div style="font-size: 0.9rem; font-weight: 600; color: #fff; margin-bottom: 0.3rem;">{{ $title }}</div>
              <div style="font-size: 0.82rem; color: rgba(228,220,208,0.55); line-height: 1.6;">{{ $desc }}</div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>

  <div class="psa-divider"></div>

  {{-- ══════════════════════════════════════════════════════════
       SECTION — RESSOURCES AMBASSADEURS
  ══════════════════════════════════════════════════════════════ --}}
  <div style="background: var(--ps-bg);">
    <div class="psa-section" style="text-align: center; max-width: 980px;">
      <div class="psa-section__eyebrow" style="display:block; margin-bottom: 1.5rem;">Ressources · Kit ambassadeur</div>
      <h2 class="psa-section__title" style="margin: 0 auto 1rem;">Tout ce qu'il vous faut<br>pour <strong>partager</strong></h2>
      <p class="psa-section__subtitle" style="margin: 0 auto 3rem;">
        Dès votre inscription, vous accédez à votre espace personnel et à un kit complet
        pour partager l'expérience Pause Souffle avec clarté et authenticité.
      </p>
      <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px,1fr)); gap: 1.5px; border: 1px solid var(--ps-gold-border); border-radius: 20px; overflow: hidden; max-width: 880px; margin: 0 auto 2.5rem;">
        @foreach([
          ['🔗', 'Votre page personnelle', 'Un lien dédié à votre image, partageable en un clic.'],
          ['📎', 'Lien affilié traçable', 'Format /ps/{code} · Cookie 90 jours · Attribution automatique.'],
          ['🖼️', 'Kit de présentation', 'Visuels réseaux sociaux, textes prêts à l\'emploi, stories.'],
          ['📊', 'Tableau de bord', 'Suivi en temps réel de vos clics, ventes et commissions.'],
        ] as [$icon, $label, $desc])
        <div style="background: var(--ps-bg-card); padding: 2rem 1.5rem;">
          <div style="font-size: 1.5rem; margin-bottom: 0.75rem;">{{ $icon }}</div>
          <div style="font-size: 0.88rem; font-weight: 600; color: #fff; margin-bottom: 0.4rem;">{{ $label }}</div>
          <div style="font-size: 0.78rem; color: rgba(228,220,208,0.5); line-height: 1.6;">{{ $desc }}</div>
        </div>
        @endforeach
      </div>
      @if($hasAffiliate)
        <a href="{{ route('ps.ressources') }}" class="psa-cta-secondary" style="display:inline-flex;">
          <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
          Accéder à mes ressources →
        </a>
      @endif
    </div>
  </div>

  <div class="psa-divider"></div>

  {{-- ══════════════════════════════════════════════════════════
       SECTION — LA COMMUNAUTÉ
  ══════════════════════════════════════════════════════════════ --}}
  <div style="background: var(--ps-bg-card);">
    <div class="psa-section" style="max-width: 980px;">
      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 5rem; align-items: center;">
        <div>
          <div class="psa-section__eyebrow">Communauté · Réseau vivant</div>
          <h2 class="psa-section__title">Une communauté<br><strong>vivante</strong></h2>
          <p class="psa-section__subtitle">
            Les ambassadeurs ne sont pas seuls. Ils font partie d'une communauté
            engagée qui se retrouve, partage et grandit ensemble.
          </p>
          <p style="font-size: 0.9rem; color: rgba(228,220,208,0.55); line-height: 1.8;">
            Faire partie du réseau, c'est rejoindre un cercle de personnes
            qui ont toutes traversé une transformation similaire. Cette expérience partagée
            crée des liens authentiques et durables.
          </p>
        </div>
        <div style="display: flex; flex-direction: column; gap: 16px;">
          @foreach([
            ['◎', 'Rencontres ambassadeurs', 'Des temps d\'échange réguliers entre membres du réseau, en ligne et en présentiel.'],
            ['✦', 'Événements Pause Souffle', 'Accès prioritaire aux événements, ateliers et journées spéciales organisés par Pause Souffle.'],
            ['○', 'Retraites Pause Souffle', 'Les Ambassadeurs Partenaires et Ambassadeurs bénéficient d\'un accès prioritaire aux places de retraite.'],
            ['⟳', 'Cercle privé', 'Les 15 meilleurs ambassadeurs intègrent un cercle privé avec appel mensuel direct avec l\'équipe PS.'],
          ] as [$icon, $title, $desc])
          <div style="background: var(--ps-bg); border: 1px solid rgba(255,255,255,0.05); border-radius: 14px; padding: 1.5rem; display: flex; gap: 1.25rem; align-items: flex-start;">
            <span style="color: var(--ps-gold); font-size: 1.1rem; flex-shrink: 0; margin-top: 2px;">{{ $icon }}</span>
            <div>
              <div style="font-size: 0.9rem; font-weight: 600; color: #fff; margin-bottom: 0.3rem;">{{ $title }}</div>
              <div style="font-size: 0.8rem; color: rgba(228,220,208,0.5); line-height: 1.6;">{{ $desc }}</div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>

  {{-- ══════════════════════════════════════════════════════════
       SECTION — TÉMOIGNAGES
       Affichée uniquement si des témoignages publiés existent en base (Nova admin)
  ══════════════════════════════════════════════════════════════ --}}
  @if(isset($testimonials) && $testimonials->count() > 0)
  <div class="psa-divider"></div>
  <div style="background: rgba(201,168,76,0.02); border-top: 1px solid rgba(201,168,76,0.08); border-bottom: 1px solid rgba(201,168,76,0.08);">
    <div class="psa-section" style="text-align: center;">
      <div class="psa-section__eyebrow">Témoignages · Ambassadeurs Pause Souffle</div>
      <h2 class="psa-section__title" style="margin-bottom: .75rem;">
        Ce qu'ils <strong>vivent</strong>
      </h2>
      <p class="psa-section__subtitle" style="max-width: 520px; margin: 0 auto 3rem;">
        Des personnes qui partagent Pause Souffle parce qu'elles l'ont traversé.
      </p>

      <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.5rem; text-align: left;">
        @foreach($testimonials as $testi)
        <div style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.07); border-radius: 18px; padding: 28px 26px; position: relative;
          {{ $testi->highlight === 'featured' ? 'border-color: rgba(201,168,76,0.3); background: rgba(201,168,76,0.04);' : '' }}">
          <!-- Guillemet décoratif -->
          <div style="position: absolute; top: 20px; right: 22px; font-size: 3.5rem; line-height:1; color: rgba(201,168,76,0.15); font-family: Georgia, serif;">"</div>

          <p style="font-size: .92rem; color: rgba(228,220,208,0.8); line-height: 1.8; font-style: italic; margin: 0 0 20px; position: relative; z-index:1;">
            {{ $testi->content }}
          </p>

          <div style="display: flex; align-items: center; gap: 12px;">
            <!-- Avatar initiale -->
            <div style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, rgba(201,168,76,0.3), rgba(201,168,76,0.1)); border: 1px solid rgba(201,168,76,0.3); display: flex; align-items: center; justify-content: center; font-size: .9rem; font-weight: 600; color: #C9A84C; flex-shrink: 0;">
              {{ strtoupper(substr($testi->avatar_initial ?: $testi->author_name, 0, 1)) }}
            </div>
            <div>
              <div style="font-size: .85rem; font-weight: 600; color: #fff;">{{ $testi->author_name }}</div>
              @if($testi->author_role)
              <div style="font-size: .78rem; color: rgba(228,220,208,0.4);">{{ $testi->author_role }}</div>
              @endif
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
  @endif

  {{-- ══════════════════════════════════════════════════════════
       SECTION — LEADERBOARD (Top ambassadeurs du mois)
       Visible uniquement quand des ambassadeurs ont des gains validés
  ══════════════════════════════════════════════════════════════ --}}
  @if(isset($leaderboard) && $leaderboard->count() > 0)
  <div class="psa-divider"></div>
  <div style="background: rgba(255,255,255,0.01);">
    <div class="psa-section" style="text-align: center; max-width: 800px;">
      <div class="psa-section__eyebrow">Réseau · Reconnaissance</div>
      <h2 class="psa-section__title" style="margin-bottom: .75rem;">
        Ambassadeurs <strong>en lumière</strong>
      </h2>
      <p class="psa-section__subtitle" style="max-width: 480px; margin: 0 auto 3rem;">
        Les ambassadeurs qui transmettent le plus. Leur engagement fait grandir le réseau.
      </p>

      <div style="display: flex; flex-direction: column; gap: .75rem; max-width: 560px; margin: 0 auto;">
        @foreach($leaderboard as $i => $amb)
        @php
          $firstName = explode(' ', $amb->user?->name ?? 'Ambassadeur')[0];
          $tierIcons = ['standard' => '✦', 'partenaire' => '✦✦', 'ambassadeur' => '✦✦✦'];
          $tierIcon  = $tierIcons[$amb->tier] ?? '✦';
          $rankColors = ['#E8C96A', 'rgba(228,220,208,0.7)', 'rgba(228,220,208,0.5)'];
          $rankColor  = $rankColors[$i] ?? 'rgba(228,220,208,0.35)';
        @endphp
        <div style="display: flex; align-items: center; gap: 16px; background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.06); border-radius: 14px; padding: 16px 20px;
          {{ $i === 0 ? 'border-color: rgba(201,168,76,0.25); background: rgba(201,168,76,0.04);' : '' }}">
          <!-- Rang -->
          <div style="font-size: 1.1rem; font-weight: 700; color: {{ $rankColor }}; width: 28px; text-align: center; flex-shrink: 0;">
            {{ $i + 1 }}
          </div>
          <!-- Avatar -->
          <div style="width: 38px; height: 38px; border-radius: 50%; background: rgba(201,168,76,0.15); border: 1px solid rgba(201,168,76,0.2); display: flex; align-items: center; justify-content: center; font-size: .85rem; font-weight:600; color: #C9A84C; flex-shrink: 0;">
            {{ strtoupper(substr($firstName, 0, 1)) }}
          </div>
          <!-- Nom + tier -->
          <div style="flex: 1; text-align: left;">
            <div style="font-size: .88rem; font-weight: 600; color: #fff;">{{ $firstName }}</div>
            <div style="font-size: .75rem; color: rgba(228,220,208,0.4);">{{ $tierIcon }} {{ $amb->tier_label }}</div>
          </div>
          <!-- Total gagné -->
          <div style="text-align: right;">
            <div style="font-size: .95rem; font-weight: 600; color: #E8C96A;">{{ number_format($amb->total_earned, 0, ',', ' ') }} €</div>
            <div style="font-size: .72rem; color: rgba(228,220,208,0.35);">commissions validées</div>
          </div>
        </div>
        @endforeach
      </div>

      <p style="margin-top: 2rem; font-size: .8rem; color: rgba(228,220,208,0.3); font-style: italic;">
        Classement basé sur les commissions validées · Prénoms uniquement affichés
      </p>
    </div>
  </div>
  @endif

  <div class="psa-divider"></div>

  {{-- ══════════════════════════════════════════════════════════
       SECTION 8 — CTA FINAL
  ══════════════════════════════════════════════════════════════ --}}
  <section class="psa-cta-section">
    <div class="psa-cta-section__content">
      <div class="psa-section__eyebrow" style="display:block; text-align:center; margin-bottom: 1.5rem;">Réseau des Ambassadeurs</div>
      <h2 class="psa-cta-section__title">
        Rejoindre le réseau<br>
        des <em>Ambassadeurs<br>Pause Souffle</em>
      </h2>
      <p class="psa-cta-section__sub">
        Si l'expérience Pause Souffle vous parle et que vous souhaitez
        contribuer à la faire découvrir autour de vous, nous serons heureux
        de vous accueillir dans le réseau.
      </p>

      @if($hasAffiliate)
        <a href="{{ route('ps.ressources') }}" class="psa-cta-primary" style="font-size: 1.05rem; padding: 1.1rem 3rem;">
          <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
          Accéder à mon espace ambassadeur
        </a>
      @elseif($isLoggedIn)
        <button type="button" class="psa-cta-primary" style="font-size: 1.05rem; padding: 1.1rem 3rem;" @click="$dispatch('open-register-modal')">
          <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
          Rejoindre le réseau — c'est gratuit
        </button>
      @else
        <div style="display:flex; flex-direction:column; align-items:center; gap: 1rem;">
          <a href="{{ route('user.signup') }}" class="psa-cta-primary" style="font-size: 1.05rem; padding: 1.1rem 3rem;">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
            Créer un compte & rejoindre le réseau
          </a>
          <a href="{{ route('user.login') }}" class="psa-cta-secondary">Déjà membre ? Se connecter</a>
        </div>
      @endif

      <p class="psa-cta-section__micro">
        Inscription gratuite <span>·</span>
        Sans engagement <span>·</span>
        Commissions versées par virement SEPA <span>·</span>
        Cookie tracking 90 jours
      </p>
    </div>
  </section>

  {{-- Cross links --}}
  <div style="background: var(--ps-bg-card); padding: 40px 24px; border-top: 1px solid rgba(255,255,255,0.04);">
    <div style="max-width: 980px; margin: 0 auto; display: flex; justify-content: center; flex-wrap: wrap; gap: 1.5rem; font-size: 0.82rem; color: var(--ps-text-dim);">
      <a href="{{ route('presence.parcours') }}" style="color: var(--ps-gold); text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#e8c96a'" onmouseout="this.style.color='#C9A84C'">Le Parcours Pause Souffle →</a>
      <a href="{{ route('presence.formation-praticien') }}" style="color: rgba(228,220,208,0.45); text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#a78bfa'" onmouseout="this.style.color='rgba(228,220,208,0.45)'">Devenir Freelance Pause Souffle →</a>
      <a href="{{ route('presence.retraite') }}" style="color: rgba(228,220,208,0.45); text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#84cc16'" onmouseout="this.style.color='rgba(228,220,208,0.45)'">La Retraite Pause Souffle →</a>
      <a href="{{ route('affiliate.landing') }}" style="color: rgba(228,220,208,0.35); text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='rgba(228,220,208,0.6)'" onmouseout="this.style.color='rgba(228,220,208,0.35)'">Programme Apporteurs JunsPro →</a>
    </div>
  </div>

</div>

{{-- ════════════════════════════════════════════════════════════
     MODAL D'INSCRIPTION — Formulaire complet ambassadeur
     Alpine.js : s'ouvre sur event 'open-register-modal'
════════════════════════════════════════════════════════════════ --}}
@if($isLoggedIn && !$hasAffiliate)
<div
  x-data="{ open: false }"
  @open-register-modal.window="open = true"
  x-show="open"
  x-cloak
  style="position:fixed; inset:0; z-index:9999; display:flex; align-items:center; justify-content:center; padding:20px;"
>
  <!-- Backdrop -->
  <div
    @click="open = false"
    x-show="open"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    style="position:fixed; inset:0; background:rgba(0,0,0,0.75); backdrop-filter:blur(4px);"
  ></div>

  <!-- Modal card -->
  <div
    x-show="open"
    x-transition:enter="transition ease-out duration-250"
    x-transition:enter-start="opacity-0 scale-95"
    x-transition:enter-end="opacity-100 scale-100"
    style="position:relative; z-index:1; width:100%; max-width:560px; background:linear-gradient(160deg, rgba(201,168,76,0.06) 0%, #0D0D20 60%); border:1.5px solid rgba(201,168,76,0.3); border-radius:24px; padding:44px 40px;"
  >
    <!-- Fermer -->
    <button
      @click="open = false"
      type="button"
      style="position:absolute; top:18px; right:20px; background:none; border:none; color:rgba(228,220,208,0.4); cursor:pointer; font-size:1.3rem; line-height:1;"
      aria-label="Fermer"
    >×</button>

    <!-- En-tête modal -->
    <div style="text-align:center; margin-bottom:32px;">
      <div style="font-size:11px; letter-spacing:.22em; text-transform:uppercase; color:#C9A84C; margin-bottom:12px;">Réseau des Ambassadeurs</div>
      <h3 style="font-size:1.5rem; font-weight:300; color:#fff; line-height:1.4; margin:0 0 10px;">Rejoindre le réseau<br><em style="color:#C9A84C;">Pause Souffle</em></h3>
      <p style="font-size:.88rem; color:rgba(228,220,208,0.5); margin:0;">Inscription gratuite · Sans engagement · Votre lien activé immédiatement</p>
    </div>

    <form method="POST" action="{{ route('ps.register') }}">
      @csrf

      <div style="display:flex; flex-direction:column; gap:1rem;">

        <!-- Téléphone -->
        <div>
          <label style="display:block; font-size:.8rem; letter-spacing:.12em; text-transform:uppercase; color:rgba(228,220,208,0.5); margin-bottom:7px;">Téléphone <span style="color:rgba(228,220,208,0.25); font-size:.75rem;">(facultatif)</span></label>
          <input
            type="tel"
            name="phone"
            placeholder="+33 6 12 34 56 78"
            style="width:100%; background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.1); border-radius:12px; padding:12px 16px; color:#fff; font-size:.95rem; outline:none; box-sizing:border-box;"
            onfocus="this.style.borderColor='rgba(201,168,76,0.5)'"
            onblur="this.style.borderColor='rgba(255,255,255,0.1)'"
          >
        </div>

        <!-- Motivation -->
        <div>
          <label style="display:block; font-size:.8rem; letter-spacing:.12em; text-transform:uppercase; color:rgba(228,220,208,0.5); margin-bottom:7px;">
            Pourquoi souhaitez-vous devenir ambassadeur ?
            <span style="color:rgba(228,220,208,0.25); font-size:.75rem;">(facultatif)</span>
          </label>
          <textarea
            name="motivation"
            placeholder="Partagez en quelques mots ce qui vous motive…"
            rows="4"
            style="width:100%; background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.1); border-radius:12px; padding:12px 16px; color:#fff; font-size:.93rem; outline:none; resize:vertical; box-sizing:border-box; font-family:inherit;"
            onfocus="this.style.borderColor='rgba(201,168,76,0.5)'"
            onblur="this.style.borderColor='rgba(255,255,255,0.1)'"
          ></textarea>
        </div>

        <!-- Note phénoménologie -->
        <div style="background:rgba(255,255,255,0.03); border-left:3px solid rgba(201,168,76,0.4); border-radius:0 10px 10px 0; padding:12px 16px;">
          <p style="font-size:.82rem; color:rgba(228,220,208,0.5); line-height:1.7; margin:0; font-style:italic;">
            La condition fondamentale : avoir suivi ou être en cours de Parcours Pause Souffle.
            On ne partage que ce qu'on a vécu.
          </p>
        </div>

        <!-- Submit -->
        <button
          type="submit"
          style="width:100%; background:linear-gradient(135deg,#b8893a 0%,#C9A84C 40%,#E8C96A 100%); color:#070712; font-weight:700; font-size:1rem; padding:14px 24px; border-radius:50px; border:none; cursor:pointer; letter-spacing:.04em; margin-top:4px;"
        >
          &#x2726; Rejoindre le réseau des Ambassadeurs
        </button>

      </div>
    </form>

  </div>
</div>
@endif

@endsection
