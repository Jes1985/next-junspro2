@extends('frontend.layout')

@section('pageHeading')
  Devenir Mentor — Junspro
@endsection

@section('metaDescription')
  Transmettez votre expertise. Guidez la prochaine génération de freelances. Rejoignez Junspro en tant que mentor certifié et créez un revenu complémentaire inspirant.
@endsection

@section('style')
<style>
  :root {
    --bm-gold: #F59E0B;
    --bm-gold-light: #FEF3C7;
    --bm-purple: #4F46E5;
    --bm-purple-light: #EEF2FF;
    --bm-dark: #0f0c29;
    --bm-gradient: linear-gradient(135deg, #0f0c29 0%, #302b63 50%, #24243e 100%);
    --bm-gradient-gold: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    --bm-gradient-purple: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
    --bm-shadow: 0 4px 24px rgba(79,70,229,.1);
    --bm-shadow-hover: 0 16px 48px rgba(79,70,229,.2);
  }

  /* ─── BASE ─────────────────────────────────────────────── */
  .bm-page { background: #f8f7ff; min-height: 100vh; }

  /* ─── HERO ─────────────────────────────────────────────── */
  .bm-hero {
    background: var(--bm-gradient);
    padding: 5rem 1.5rem 6rem;
    text-align: center;
    position: relative;
    overflow: hidden;
  }
  .bm-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    pointer-events: none;
  }
  .bm-hero__eyebrow {
    display: inline-flex; align-items: center; gap: .5rem;
    background: rgba(245,158,11,.15); color: var(--bm-gold); border: 1px solid rgba(245,158,11,.3);
    font-size: .75rem; font-weight: 700; letter-spacing: .1em; text-transform: uppercase;
    border-radius: 999px; padding: .35rem 1.1rem; margin-bottom: 1.5rem;
  }
  .bm-hero__title {
    font-size: clamp(2.2rem, 6vw, 3.8rem); font-weight: 900; line-height: 1.1;
    color: #fff; margin-bottom: 1.25rem; max-width: 780px; margin-left: auto; margin-right: auto;
  }
  .bm-hero__title .accent { background: var(--bm-gradient-gold); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
  .bm-hero__sub {
    font-size: 1.15rem; color: rgba(255,255,255,.75); max-width: 560px;
    margin: 0 auto 2.5rem; line-height: 1.65;
  }

  .bm-hero__cta-group { display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; }
  .bm-btn-gold {
    display: inline-flex; align-items: center; gap: .5rem;
    background: var(--bm-gradient-gold); color: #1c1400;
    font-size: 1rem; font-weight: 800; padding: .85rem 2rem;
    border-radius: 12px; text-decoration: none; transition: transform .2s, box-shadow .2s;
    box-shadow: 0 4px 20px rgba(245,158,11,.4);
  }
  .bm-btn-gold:hover { transform: translateY(-2px); box-shadow: 0 8px 32px rgba(245,158,11,.5); color: #1c1400; }
  .bm-btn-ghost {
    display: inline-flex; align-items: center; gap: .5rem;
    background: rgba(255,255,255,.08); color: rgba(255,255,255,.9);
    border: 1px solid rgba(255,255,255,.2); font-size: .95rem; font-weight: 600;
    padding: .85rem 2rem; border-radius: 12px; text-decoration: none; transition: background .2s;
  }
  .bm-btn-ghost:hover { background: rgba(255,255,255,.14); color: #fff; }

  .bm-hero__stats {
    display: flex; justify-content: center; gap: 3rem; flex-wrap: wrap;
    margin-top: 3.5rem; padding-top: 3rem; border-top: 1px solid rgba(255,255,255,.1);
  }
  .bm-hero__stat-val { font-size: 2.2rem; font-weight: 900; color: var(--bm-gold); display: block; }
  .bm-hero__stat-lbl { font-size: .8rem; color: rgba(255,255,255,.55); text-transform: uppercase; letter-spacing: .08em; }

  /* ─── SECTION COMMUNE ────────────────────────────────── */
  .bm-section { padding: 5rem 1.5rem; }
  .bm-section-inner { max-width: 1100px; margin: 0 auto; }
  .bm-section-label {
    display: inline-block; font-size: .72rem; font-weight: 700; letter-spacing: .12em;
    text-transform: uppercase; color: var(--bm-purple); background: var(--bm-purple-light);
    border-radius: 999px; padding: .28rem .9rem; margin-bottom: 1rem;
  }
  .bm-section-title { font-size: clamp(1.6rem, 3vw, 2.5rem); font-weight: 800; color: #1a1363; margin-bottom: .75rem; line-height: 1.2; }
  .bm-section-sub { font-size: 1rem; color: #6b7280; max-width: 560px; line-height: 1.65; }

  /* ─── COMPENSATION TABLE ─────────────────────────────── */
  .bm-comp { background: #fff; border-radius: 24px; box-shadow: var(--bm-shadow); overflow: hidden; }
  .bm-comp__header { background: var(--bm-gradient); padding: 2rem 2.5rem; color: #fff; }
  .bm-comp__header h3 { font-size: 1.4rem; font-weight: 800; margin: 0; }
  .bm-comp__header p { font-size: .9rem; color: rgba(255,255,255,.7); margin: .4rem 0 0; }

  .bm-comp-grid { display: grid; grid-template-columns: repeat(3, 1fr); }
  .bm-comp-col { padding: 1.75rem; border-right: 1px solid #f3f4f6; text-align: center; }
  .bm-comp-col:last-child { border-right: none; }
  .bm-comp-col--featured { background: linear-gradient(160deg, #f5f3ff, #ede9fe); }

  .bm-diff-badge {
    display: inline-block; font-size: .7rem; font-weight: 700; text-transform: uppercase;
    letter-spacing: .08em; border-radius: 999px; padding: .25rem .75rem; margin-bottom: 1rem;
  }
  .bm-diff-badge--beginner     { background: #d1fae5; color: #065f46; }
  .bm-diff-badge--intermediate { background: #dbeafe; color: #1e40af; }
  .bm-diff-badge--advanced     { background: #fce7f3; color: #9d174d; }

  .bm-comp-col__title { font-size: 1rem; font-weight: 700; color: #1a1363; margin-bottom: .5rem; }
  .bm-comp-col__share {
    font-size: 3rem; font-weight: 900; line-height: 1;
    background: var(--bm-gradient-purple); -webkit-background-clip: text;
    -webkit-text-fill-color: transparent; background-clip: text;
    margin-bottom: .25rem;
  }
  .bm-comp-col__share-lbl { font-size: .75rem; color: #9ca3af; font-weight: 500; margin-bottom: 1rem; }

  .bm-bar { height: 8px; border-radius: 999px; background: #f3f4f6; overflow: hidden; margin: .75rem 0; }
  .bm-bar__fill { height: 100%; border-radius: 999px; background: var(--bm-gradient-purple); transition: width .6s cubic-bezier(.4,0,.2,1); }
  .bm-bar__fill--gold { background: var(--bm-gradient-gold); }

  .bm-comp-col__roles { text-align: left; margin-top: 1rem; }
  .bm-comp-col__role { display: flex; align-items: flex-start; gap: .5rem; font-size: .82rem; color: #4b5563; margin-bottom: .4rem; }
  .bm-comp-col__role-icon { color: var(--bm-purple); margin-top: 1px; }
  .bm-comp-col__examples { margin-top: .75rem; }
  .bm-comp-col__example { font-size: .75rem; background: #f9fafb; color: #6b7280; border-radius: 6px; padding: .2rem .6rem; display: inline-block; margin: 2px; }

  .bm-comp-note {
    padding: 1.25rem 2rem; background: #fffbeb; border-top: 1px solid #fde68a;
    font-size: .85rem; color: #92400e; display: flex; align-items: center; gap: .6rem;
  }

  /* ─── COMMENT ÇA MARCHE ──────────────────────────────── */
  .bm-how { background: linear-gradient(160deg, #f5f3ff, #ede9fe); }
  .bm-steps { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.5rem; margin-top: 3rem; }
  .bm-step {
    background: #fff; border-radius: 20px; padding: 2rem 1.5rem;
    box-shadow: var(--bm-shadow); position: relative; text-align: center;
    transition: transform .3s, box-shadow .3s;
  }
  .bm-step:hover { transform: translateY(-4px); box-shadow: var(--bm-shadow-hover); }
  .bm-step__num {
    width: 48px; height: 48px; border-radius: 50%;
    background: var(--bm-gradient-purple); color: #fff;
    font-size: 1.2rem; font-weight: 900; display: flex; align-items: center; justify-content: center;
    margin: 0 auto 1.25rem;
  }
  .bm-step__title { font-size: 1rem; font-weight: 700; color: #1a1363; margin-bottom: .5rem; }
  .bm-step__desc { font-size: .88rem; color: #6b7280; line-height: 1.55; }

  /* ─── CONDITIONS ─────────────────────────────────────── */
  .bm-conditions { background: #fff; }
  .bm-checks { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1rem; margin-top: 2.5rem; }
  .bm-check {
    display: flex; align-items: flex-start; gap: 1rem; padding: 1.25rem 1.5rem;
    border-radius: 14px; border: 1.5px solid;
  }
  .bm-check--pass { background: #ecfdf5; border-color: #6ee7b7; }
  .bm-check--fail { background: #fef2f2; border-color: #fca5a5; }
  .bm-check--neutral { background: #f9fafb; border-color: #e5e7eb; }
  .bm-check__icon { font-size: 1.3rem; margin-top: 2px; flex-shrink: 0; }
  .bm-check--pass .bm-check__icon  { color: #10b981; }
  .bm-check--fail .bm-check__icon  { color: #ef4444; }
  .bm-check--neutral .bm-check__icon { color: #9ca3af; }
  .bm-check__label { font-size: .9rem; font-weight: 600; color: #111827; }
  .bm-check__tip   { font-size: .8rem; color: #6b7280; margin-top: .2rem; line-height: 1.4; }

  /* ─── FORMULAIRE ─────────────────────────────────────── */
  .bm-form-section { background: var(--bm-gradient); padding: 5rem 1.5rem; }
  .bm-form-inner { max-width: 800px; margin: 0 auto; }
  .bm-form-header { text-align: center; color: #fff; margin-bottom: 3rem; }
  .bm-form-header h2 { font-size: 2rem; font-weight: 800; margin-bottom: .5rem; }
  .bm-form-header p { font-size: 1rem; color: rgba(255,255,255,.7); }

  .bm-form-card {
    background: #fff; border-radius: 24px; padding: 2.5rem;
    box-shadow: 0 24px 64px rgba(0,0,0,.25);
  }

  .bm-form-group { margin-bottom: 1.75rem; }
  .bm-form-label { display: block; font-size: .85rem; font-weight: 700; color: #374151; margin-bottom: .5rem; }
  .bm-form-label span { color: #ef4444; }
  .bm-form-hint { font-size: .78rem; color: #9ca3af; margin-top: .3rem; }

  .bm-form-input, .bm-form-textarea {
    width: 100%; padding: .75rem 1rem; font-size: .95rem;
    border: 1.5px solid #e5e7eb; border-radius: 12px;
    background: #f9fafb; color: #111827;
    transition: border-color .2s, box-shadow .2s;
    font-family: inherit;
  }
  .bm-form-input:focus, .bm-form-textarea:focus {
    outline: none; border-color: var(--bm-purple);
    box-shadow: 0 0 0 3px rgba(79,70,229,.1); background: #fff;
  }
  .bm-form-textarea { resize: vertical; min-height: 120px; }

  .bm-domain-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(170px, 1fr)); gap: .6rem; margin-top: .5rem; }
  .bm-domain-item { display: none; }
  .bm-domain-label {
    display: flex; align-items: center; gap: .5rem;
    padding: .6rem .9rem; border-radius: 10px;
    border: 1.5px solid #e5e7eb; background: #f9fafb;
    font-size: .83rem; font-weight: 500; color: #4b5563;
    cursor: pointer; transition: all .2s; user-select: none;
  }
  .bm-domain-label:hover { border-color: var(--bm-purple); color: var(--bm-purple); background: var(--bm-purple-light); }
  .bm-domain-item:checked + .bm-domain-label {
    border-color: var(--bm-purple); background: var(--bm-purple-light); color: var(--bm-purple); font-weight: 700;
  }
  .bm-domain-icon { font-size: 1rem; }

  .bm-capacity-group { display: flex; gap: .6rem; flex-wrap: wrap; margin-top: .5rem; }
  .bm-capacity-item { display: none; }
  .bm-capacity-label {
    width: 44px; height: 44px; display: flex; align-items: center; justify-content: center;
    border-radius: 10px; border: 1.5px solid #e5e7eb; background: #f9fafb;
    font-size: .9rem; font-weight: 700; color: #6b7280; cursor: pointer; transition: all .2s;
  }
  .bm-capacity-label:hover { border-color: var(--bm-purple); color: var(--bm-purple); }
  .bm-capacity-item:checked + .bm-capacity-label {
    border-color: var(--bm-purple); background: var(--bm-gradient-purple); color: #fff;
  }

  .bm-form-submit {
    width: 100%; padding: 1rem 2rem; font-size: 1.05rem; font-weight: 800;
    background: var(--bm-gradient-gold); color: #1c1400; border: none;
    border-radius: 14px; cursor: pointer; transition: transform .2s, box-shadow .2s;
    box-shadow: 0 4px 20px rgba(245,158,11,.3);
    display: flex; align-items: center; justify-content: center; gap: .6rem;
  }
  .bm-form-submit:hover:not(:disabled) { transform: translateY(-2px); box-shadow: 0 8px 32px rgba(245,158,11,.45); }
  .bm-form-submit:disabled { opacity: .5; cursor: not-allowed; }

  .bm-form-login-prompt {
    text-align: center; background: rgba(255,255,255,.05); border: 1px solid rgba(255,255,255,.15);
    border-radius: 16px; padding: 2.5rem 2rem; color: rgba(255,255,255,.9);
  }
  .bm-form-login-prompt h3 { font-size: 1.3rem; font-weight: 700; margin-bottom: .5rem; }

  /* responsive */
  @media (max-width: 640px) {
    .bm-comp-grid { grid-template-columns: 1fr; }
    .bm-hero__stats { gap: 1.5rem; }
    .bm-form-card { padding: 1.5rem; }
    .bm-comp-col { border-right: none; border-bottom: 1px solid #f3f4f6; }
    .bm-comp-col:last-child { border-bottom: none; }
  }
</style>
@endsection

@section('content')
<div class="bm-page">

  {{-- ═══════════════════════════════════════════════════════
       HERO
  ═══════════════════════════════════════════════════════ --}}
  <section class="bm-hero">
    <div class="bm-hero__eyebrow">
      <i class="fa fa-star"></i> Programme Mentor Junspro
    </div>
    <h1 class="bm-hero__title">
      Transformez votre expertise<br>en <span class="accent">impact durable</span>
    </h1>
    <p class="bm-hero__sub">
      Guidez la prochaine génération de freelances. Créez un revenu complémentaire
      en partageant ce que vous savez — et faites grandir votre réputation.
    </p>
    <div class="bm-hero__cta-group">
      <a href="#formulaire" class="bm-btn-gold">
        <i class="fa fa-rocket"></i> Candidater maintenant
      </a>
      <a href="#comment-ca-marche" class="bm-btn-ghost">
        <i class="fa fa-play-circle"></i> Comment ça marche
      </a>
    </div>

    <div class="bm-hero__stats">
      <div>
        <span class="bm-hero__stat-val">80 %</span>
        <span class="bm-hero__stat-lbl">Part mentor, missions guidées</span>
      </div>
      <div>
        <span class="bm-hero__stat-val">4 sem.</span>
        <span class="bm-hero__stat-lbl">Cycles structurés</span>
      </div>
      <div>
        <span class="bm-hero__stat-val">8 max</span>
        <span class="bm-hero__stat-lbl">Stagiaires par mentor</span>
      </div>
      <div>
        <span class="bm-hero__stat-val">48h</span>
        <span class="bm-hero__stat-lbl">Délai de validation</span>
      </div>
    </div>
  </section>

  {{-- ═══════════════════════════════════════════════════════
       MODÈLE DE RÉMUNÉRATION
  ═══════════════════════════════════════════════════════ --}}
  <section class="bm-section" id="remuneration">
    <div class="bm-section-inner">
      <div style="text-align:center; margin-bottom:3rem;">
        <span class="bm-section-label">Rémunération transparente</span>
        <h2 class="bm-section-title">Combien gagne un mentor ?</h2>
        <p class="bm-section-sub" style="margin:0 auto;">
          Votre part est calculée automatiquement selon la complexité du projet.
          Plus la mission est simple, plus votre encadrement est intensif — votre part en reflète l’implication.
        </p>
      </div>

      <div class="bm-comp">
        <div class="bm-comp__header">
          <h3>Répartition mentor / stagiaire par niveau de mission</h3>
          <p>Commission Junspro prélevée en premier — puis le net est partagé selon le tableau ci-dessous</p>
        </div>

        <div class="bm-comp-grid">

          {{-- BEGINNER --}}
          <div class="bm-comp-col">
            <span class="bm-diff-badge bm-diff-badge--beginner">Débutant</span>
            <div class="bm-comp-col__title">Mission simple</div>
            <div class="bm-comp-col__share">80 %</div>
            <div class="bm-comp-col__share-lbl">Part mentor</div>
            <div class="bm-bar"><div class="bm-bar__fill" style="width:80%"></div></div>
            <div style="font-size:.75rem; color:#6b7280; text-align:right;">20 % stagiaire</div>
            <div class="bm-comp-col__roles">
              <div class="bm-comp-col__role">
                <i class="fa fa-compass bm-comp-col__role-icon"></i>
                <span><strong>Mentor :</strong> guide, oriente, débloque</span>
              </div>
              <div class="bm-comp-col__role">
                <i class="fa fa-code bm-comp-col__role-icon"></i>
                <span><strong>Stagiaire :</strong> exécute 20 % du travail</span>
              </div>
            </div>
            <div class="bm-comp-col__examples">
              <span class="bm-comp-col__example">Landing page</span>
              <span class="bm-comp-col__example">Refonte UI</span>
              <span class="bm-comp-col__example">Script simple</span>
            </div>
          </div>

          {{-- INTERMEDIATE --}}
          <div class="bm-comp-col bm-comp-col--featured">
            <span class="bm-diff-badge bm-diff-badge--intermediate">Intermédiaire</span>
            <div class="bm-comp-col__title">Mission structurée</div>
            <div class="bm-comp-col__share">70 %</div>
            <div class="bm-comp-col__share-lbl">Part mentor</div>
            <div class="bm-bar"><div class="bm-bar__fill" style="width:70%"></div></div>
            <div style="font-size:.75rem; color:#6b7280; text-align:right;">30 % stagiaire</div>
            <div class="bm-comp-col__roles">
              <div class="bm-comp-col__role">
                <i class="fa fa-handshake bm-comp-col__role-icon"></i>
                <span><strong>Mentor :</strong> co-conçoit, valide chaque étape</span>
              </div>
              <div class="bm-comp-col__role">
                <i class="fa fa-laptop-code bm-comp-col__role-icon"></i>
                <span><strong>Stagiaire :</strong> binôme actif en développement</span>
              </div>
            </div>
            <div class="bm-comp-col__examples">
              <span class="bm-comp-col__example">App CRUD</span>
              <span class="bm-comp-col__example">Campagne multi-canal</span>
              <span class="bm-comp-col__example">API tierce</span>
            </div>
          </div>

          {{-- ADVANCED --}}
          <div class="bm-comp-col">
            <span class="bm-diff-badge bm-diff-badge--advanced">Avancé</span>
            <div class="bm-comp-col__title">Mission complexe</div>
            <div class="bm-comp-col__share">60 %</div>
            <div class="bm-comp-col__share-lbl">Part mentor</div>
            <div class="bm-bar"><div class="bm-bar__fill bm-bar__fill--gold" style="width:60%"></div></div>
            <div style="font-size:.75rem; color:#6b7280; text-align:right;">40 % stagiaire</div>
            <div class="bm-comp-col__roles">
              <div class="bm-comp-col__role">
                <i class="fa fa-chess-queen bm-comp-col__role-icon"></i>
                <span><strong>Mentor :</strong> architecture + responsabilité client</span>
              </div>
              <div class="bm-comp-col__role">
                <i class="fa fa-tools bm-comp-col__role-icon"></i>
                <span><strong>Stagiaire :</strong> implémente sous supervision</span>
              </div>
            </div>
            <div class="bm-comp-col__examples">
              <span class="bm-comp-col__example">Microservices</span>
              <span class="bm-comp-col__example">Stratégie B2B</span>
              <span class="bm-comp-col__example">Système temps réel</span>
            </div>
          </div>

        </div>
        <div class="bm-comp-note">
          <i class="fa fa-info-circle"></i>
          <span>Exemple : mission à <strong>500 € brut</strong>, difficulté intermédiaire, commission Junspro 20 % (100 €) →
            <strong>Mentor = 280 €</strong>, Stagiaire = 120 €. Les versements se font via Stripe Connect directement sur votre compte.</span>
        </div>
      </div>

      {{-- Flux abonnement --}}
      <div style="margin-top:2rem; padding:1.75rem 2rem; background:#fff; border-radius:18px; box-shadow:var(--bm-shadow); border-left:4px solid var(--bm-gold);">
        <h4 style="font-size:1rem; font-weight:700; color:#1a1363; margin:0 0 .5rem;">
          <i class="fa fa-coins" style="color:var(--bm-gold); margin-right:.4rem;"></i>
          Revenus d'abonnement (bonus mensuel)
        </h4>
        <p style="font-size:.88rem; color:#4b5563; margin:0; line-height:1.65;">
          Chaque stagiaire qui s'abonne à votre pod (49€ / 89€ / 159€ selon le plan) contribue
          à une <strong>cagnotte reversée aux mentors actifs</strong> à la fin du cycle — proportionnellement
          au nombre de stagiaires suivis. Ce revenu vient s'ajouter à votre part sur les projets réalisés.
        </p>
      </div>
    </div>
  </section>

  {{-- ═══════════════════════════════════════════════════════
       COMMENT ÇA MARCHE
  ═══════════════════════════════════════════════════════ --}}
  <section class="bm-section bm-how" id="comment-ca-marche">
    <div class="bm-section-inner">
      <div style="text-align:center; margin-bottom:.5rem;">
        <span class="bm-section-label">Processus</span>
        <h2 class="bm-section-title">Votre parcours mentor en 4 étapes</h2>
      </div>

      <div class="bm-steps">
        <div class="bm-step">
          <div class="bm-step__num">1</div>
          <div class="bm-step__title">Candidature</div>
          <div class="bm-step__desc">Remplissez le formulaire ci-dessous. Notre équipe examine votre profil en 48h.</div>
        </div>
        <div class="bm-step">
          <div class="bm-step__num">2</div>
          <div class="bm-step__title">Activation</div>
          <div class="bm-step__desc">Une fois validé, vous créez votre <strong>pod de mentorat</strong> — définissez le secteur, la capacité et la description.</div>
        </div>
        <div class="bm-step">
          <div class="bm-step__num">3</div>
          <div class="bm-step__title">Mentorat en cycle</div>
          <div class="bm-step__desc">Cycle de 4 semaines : missions, jalons, check-ins hebdomadaires. Votre tableau de bord centralise tout.</div>
        </div>
        <div class="bm-step">
          <div class="bm-step__num">4</div>
          <div class="bm-step__title">Paiement automatique</div>
          <div class="bm-step__desc">Stripe Connect verse votre part directement sur votre compte à la validation du jalon.</div>
        </div>
      </div>
    </div>
  </section>

  {{-- ═══════════════════════════════════════════════════════
       CONDITIONS D'ÉLIGIBILITÉ
  ═══════════════════════════════════════════════════════ --}}
  <section class="bm-section bm-conditions" id="conditions">
    <div class="bm-section-inner">
      <div style="text-align:center; margin-bottom:.5rem;">
        <span class="bm-section-label">Conditions</span>
        <h2 class="bm-section-title">Êtes-vous éligible ?</h2>
        <p class="bm-section-sub" style="margin:0 auto 2rem;">
          Voici les critères requis pour rejoindre le programme mentor Junspro.
          @if($eligibility['is_logged_in'])
            Votre statut est vérifié en temps réel.
          @else
            Connectez-vous pour connaître votre statut exact.
          @endif
        </p>
      </div>

      @if($eligibility['is_logged_in'])
        <div class="bm-checks">
          @foreach($eligibility['checks'] as $key => $check)
            @php
              $cls = $check['passed'] ? 'bm-check--pass' : 'bm-check--fail';
              $icon = $check['passed'] ? 'fa-check-circle' : 'fa-times-circle';
            @endphp
            <div class="bm-check {{ $cls }}">
              <i class="fa {{ $icon }} bm-check__icon"></i>
              <div>
                <div class="bm-check__label">{{ $check['label'] }}</div>
                @if(!$check['passed'])
                  <div class="bm-check__tip">{{ $check['tip'] }}</div>
                @endif
              </div>
            </div>
          @endforeach
        </div>

        @if($eligibility['can_apply'])
          <div style="text-align:center; margin-top:2rem;">
            <div style="display:inline-flex; align-items:center; gap:.75rem; background:#ecfdf5; border:1.5px solid #6ee7b7; border-radius:14px; padding:1rem 2rem; color:#065f46; font-weight:700;">
              <i class="fa fa-check-circle" style="font-size:1.4rem; color:#10b981;"></i>
              Vous remplissez toutes les conditions — <a href="#formulaire" style="color:#065f46; text-decoration:underline;">candidatez maintenant !</a>
            </div>
          </div>
        @endif

      @else
        {{-- Non connecté : liste statique --}}
        <div class="bm-checks">
          @foreach([
            'Être inscrit en tant que freelance sur Junspro',
            'Profil vérifié par notre équipe',
            'Taux horaire défini dans votre profil',
            'Compte Stripe Connect actif (pour recevoir vos paiements)',
          ] as $cond)
            <div class="bm-check bm-check--neutral">
              <i class="fa fa-circle bm-check__icon"></i>
              <div>
                <div class="bm-check__label">{{ $cond }}</div>
              </div>
            </div>
          @endforeach
        </div>
        <div style="text-align:center; margin-top:2rem;">
          <a href="{{ route('login') }}" class="bm-btn-gold" style="display:inline-flex;">
            <i class="fa fa-sign-in-alt"></i> Connectez-vous pour vérifier votre éligibilité
          </a>
        </div>
      @endif
    </div>
  </section>

  {{-- ═══════════════════════════════════════════════════════
       FORMULAIRE DE CANDIDATURE
  ═══════════════════════════════════════════════════════ --}}
  <section class="bm-form-section" id="formulaire">
    <div class="bm-form-inner">

      <div class="bm-form-header">
        <span class="bm-section-label" style="background:rgba(245,158,11,.15); color:var(--bm-gold); border:1px solid rgba(245,158,11,.3);">Candidature</span>
        <h2>Rejoignez le programme mentor</h2>
        <p>Réponse garantie sous 48 heures ouvrées.</p>
      </div>

      @if(session('success'))
        <div style="background:#ecfdf5; border:2px solid #6ee7b7; border-radius:16px; padding:1.5rem 2rem; text-align:center; color:#065f46; font-weight:700; font-size:1rem; margin-bottom:2rem;">
          <i class="fa fa-check-circle" style="font-size:1.5rem; margin-right:.5rem;"></i>
          {{ session('success') }}
        </div>
      @endif

      @if(session('error') || $errors->any())
        <div style="background:#fef2f2; border:2px solid #fca5a5; border-radius:16px; padding:1.5rem 2rem; text-align:center; color:#991b1b; font-weight:600; margin-bottom:2rem;">
          <i class="fa fa-exclamation-triangle" style="margin-right:.5rem;"></i>
          {{ session('error') ?? $errors->first() }}
        </div>
      @endif

      @if(!$eligibility['is_logged_in'])
        {{-- Pas connecté --}}
        <div class="bm-form-login-prompt">
          <h3><i class="fa fa-lock" style="margin-right:.5rem;"></i>Connexion requise</h3>
          <p style="color:rgba(255,255,255,.6); margin-bottom:1.5rem;">Vous devez être connecté avec un compte freelance pour candidater au programme mentor.</p>
          <a href="{{ route('login') }}" class="bm-btn-gold">
            <i class="fa fa-sign-in-alt"></i> Se connecter
          </a>
        </div>

      @elseif(!$eligibility['can_apply'])
        {{-- Conditions non remplies --}}
        <div class="bm-form-login-prompt">
          <h3><i class="fa fa-exclamation-circle" style="margin-right:.5rem;"></i>Conditions non remplies</h3>
          <p style="color:rgba(255,255,255,.6); margin-bottom:1.5rem;">
            Vérifiez les points ci-dessus (section <em>Conditions</em>) pour comprendre ce qui vous manque.
          </p>
          <a href="#conditions" class="bm-btn-ghost">
            <i class="fa fa-arrow-up"></i> Voir les conditions
          </a>
        </div>

      @elseif($profile && $profile->mentor_status === 'pending')
        {{-- Candidature en attente --}}
        <div class="bm-form-login-prompt" style="background:rgba(245,158,11,.1); border:1px solid rgba(245,158,11,.4);">
          <i class="fa fa-hourglass-half" style="font-size:2.5rem; color:var(--bm-gold); margin-bottom:1rem;"></i>
          <h3 style="color:var(--bm-gold);">Candidature en cours d'examen</h3>
          <p style="color:rgba(255,255,255,.7); margin:0;">Notre équipe examine votre dossier. Vous recevrez une réponse par e-mail sous 48h.</p>
        </div>

      @elseif($profile && $profile->mentor_status === 'active')
        {{-- Déjà mentor actif --}}
        <div class="bm-form-login-prompt" style="background:rgba(16,185,129,.1); border:1px solid rgba(16,185,129,.4);">
          <i class="fa fa-check-circle" style="font-size:2.5rem; color:#10b981; margin-bottom:1rem;"></i>
          <h3 style="color:#10b981;">Vous êtes déjà mentor actif !</h3>
          <p style="color:rgba(255,255,255,.7); margin-bottom:1.5rem;">Accédez à votre espace mentor pour gérer vos pods et vos stagiaires.</p>
          <a href="{{ route('mentorship.dashboard.mentor') }}" class="bm-btn-gold">
            <i class="fa fa-tachometer-alt"></i> Mon espace mentor
          </a>
        </div>

      @else
        {{-- Formulaire de candidature --}}
        <div class="bm-form-card">
          <form method="POST" action="{{ route('mentor.onboarding.submit') }}">
            @csrf

            {{-- Bio mentor --}}
            <div class="bm-form-group">
              <label class="bm-form-label" for="mentor_bio">
                Votre pitch en tant que mentor <span>*</span>
              </label>
              <textarea
                class="bm-form-textarea"
                id="mentor_bio"
                name="mentor_bio"
                rows="4"
                placeholder="Décrivez votre parcours, ce que vous transmettez, votre approche de l'enseignement... (80–1000 caractères)"
                required
                minlength="80"
                maxlength="1000"
              >{{ old('mentor_bio', $profile->mentor_bio ?? '') }}</textarea>
              <div class="bm-form-hint"><span id="bio-count">0</span> / 1000 caractères</div>
            </div>

            {{-- Motivation --}}
            <div class="bm-form-group">
              <label class="bm-form-label" for="mentor_motivation">
                Pourquoi voulez-vous devenir mentor ? <span>*</span>
              </label>
              <textarea
                class="bm-form-textarea"
                id="mentor_motivation"
                name="mentor_motivation"
                rows="3"
                placeholder="Votre motivation profonde — ce que ça vous apporte personnellement et professionnellement. (60–800 caractères)"
                required
                minlength="60"
                maxlength="800"
              >{{ old('mentor_motivation', $profile->mentor_motivation ?? '') }}</textarea>
              <div class="bm-form-hint"><span id="motiv-count">0</span> / 800 caractères</div>
            </div>

            {{-- Expérience & LinkedIn --}}
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
              <div class="bm-form-group" style="margin-bottom:0;">
                <label class="bm-form-label" for="mentor_years_experience">
                  Années d'expérience <span>*</span>
                </label>
                <input
                  type="number"
                  class="bm-form-input"
                  id="mentor_years_experience"
                  name="mentor_years_experience"
                  min="1" max="40"
                  value="{{ old('mentor_years_experience', $profile->mentor_years_experience ?? '') }}"
                  placeholder="ex: 5"
                  required
                >
              </div>
              <div class="bm-form-group" style="margin-bottom:0;">
                <label class="bm-form-label" for="mentor_linkedin_url">
                  LinkedIn (optionnel)
                </label>
                <input
                  type="url"
                  class="bm-form-input"
                  id="mentor_linkedin_url"
                  name="mentor_linkedin_url"
                  value="{{ old('mentor_linkedin_url', $profile->mentor_linkedin_url ?? '') }}"
                  placeholder="https://linkedin.com/in/..."
                >
              </div>
            </div>

            {{-- Domaines --}}
            <div class="bm-form-group" style="margin-top:1.75rem;">
              <label class="bm-form-label">
                Domaines de mentorat <span>*</span>
                <span style="font-weight:400; color:#9ca3af;"> (1 à 5 max)</span>
              </label>
              @php
                $selectedDomains = old('mentor_domains', $profile->mentor_domains ?? []);
              @endphp
              <div class="bm-domain-grid">
                @foreach($domains as $key => $label)
                  <div>
                    <input
                      type="checkbox"
                      class="bm-domain-item"
                      id="domain_{{ $key }}"
                      name="mentor_domains[]"
                      value="{{ $key }}"
                      {{ in_array($key, (array)$selectedDomains) ? 'checked' : '' }}
                    >
                    <label class="bm-domain-label" for="domain_{{ $key }}">
                      <span class="bm-domain-icon">{{ $domainIcons[$key] ?? '💡' }}</span>
                      {{ $label }}
                    </label>
                  </div>
                @endforeach
              </div>
              <div class="bm-form-hint"><span id="domain-count">0</span> domaine(s) sélectionné(s)</div>
            </div>

            {{-- Capacité --}}
            <div class="bm-form-group">
              <label class="bm-form-label">
                Nombre de stagiaires max <span>*</span>
              </label>
              @php $selectedCapacity = old('mentor_capacity', $profile->mentor_capacity ?? 3); @endphp
              <div class="bm-capacity-group">
                @for($i = 1; $i <= 8; $i++)
                  <input type="radio" class="bm-capacity-item" id="cap_{{ $i }}" name="mentor_capacity" value="{{ $i }}" {{ (int)$selectedCapacity === $i ? 'checked' : '' }}>
                  <label class="bm-capacity-label" for="cap_{{ $i }}">{{ $i }}</label>
                @endfor
              </div>
              <div class="bm-form-hint">Combien de stagiaires suivre simultanément — commencez doucement !</div>
            </div>

            <button type="submit" class="bm-form-submit" id="submit-btn">
              <i class="fa fa-paper-plane"></i> Envoyer ma candidature
            </button>
          </form>
        </div>
      @endif

    </div>
  </section>

</div>
@endsection

@section('script')
<script>
// Compteurs de caractères
function updateCounter(textareaId, countId) {
  const el = document.getElementById(textareaId);
  const cnt = document.getElementById(countId);
  if (!el || !cnt) return;
  const update = () => { cnt.textContent = el.value.length; };
  update();
  el.addEventListener('input', update);
}
updateCounter('mentor_bio', 'bio-count');
updateCounter('mentor_motivation', 'motiv-count');

// Compteur domaines
const domainCheckboxes = document.querySelectorAll('input[name="mentor_domains[]"]');
const domainCount = document.getElementById('domain-count');
function updateDomainCount() {
  if (!domainCount) return;
  const checked = [...domainCheckboxes].filter(c => c.checked).length;
  domainCount.textContent = checked;
  // max 5
  domainCheckboxes.forEach(cb => {
    if (!cb.checked && checked >= 5) cb.disabled = true;
    else cb.disabled = false;
  });
}
domainCheckboxes.forEach(cb => cb.addEventListener('change', updateDomainCount));
updateDomainCount();

// Smooth scroll
document.querySelectorAll('a[href^="#"]').forEach(a => {
  a.addEventListener('click', e => {
    const target = document.querySelector(a.getAttribute('href'));
    if (target) { e.preventDefault(); target.scrollIntoView({ behavior: 'smooth', block: 'start' }); }
  });
});
</script>
@endsection
