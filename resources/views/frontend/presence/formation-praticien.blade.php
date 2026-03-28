@extends('frontend.layout')

@section('pageHeading')
  La Formation Freelance · Certification Pause Souffle | {{ $websiteInfo->website_title }}
@endsection

@section('metaDescription')
  Devenez Freelance certifié Pause Souffle. Après Le Parcours, apprenez à animer les Rituels Corps Complet et proposez-les en tant que service. Certification délivrée par Junspro.
@endsection

@section('style')
<style>
  /* ============================================
     PAGE LA FORMATION FREELANCE
     ============================================ */

  :root {
    --fp-gold:      #D4A853;
    --fp-gold-dark: #B8893A;
    --fp-green:     #84CC16;
    --fp-blue:      #2563EB;
    --fp-dark:      #0D0D1A;
    --fp-text:      #1F2937;
    --fp-text-soft: #6B7280;
    --fp-bg:        #FFFFFF;
    --fp-bg-warm:   #FDFAF5;
    --fp-bg-dark:   #0D0D1A;
    --fp-border:    #E5E7EB;
  }

  .fp-page { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; color: var(--fp-text); background: var(--fp-bg); -webkit-font-smoothing: antialiased; }

  /* HERO */
  .fp-hero { position: relative; min-height: 100vh; display: flex; align-items: center; justify-content: center; background: var(--fp-bg-dark); overflow: hidden; text-align: center; padding: 100px 24px 80px; }
  .fp-hero-bg { position: absolute; inset: 0; background: radial-gradient(ellipse 80% 50% at 50% 0%, rgba(37,99,235,0.12) 0%, transparent 60%), radial-gradient(ellipse 60% 40% at 20% 80%, rgba(212,168,83,0.10) 0%, transparent 50%), radial-gradient(ellipse 50% 40% at 80% 70%, rgba(132,204,22,0.06) 0%, transparent 50%); pointer-events: none; }
  .fp-stars { position: absolute; inset: 0; background-image: radial-gradient(1px 1px at 10% 15%, rgba(212,168,83,0.4) 0%, transparent 100%), radial-gradient(1px 1px at 30% 45%, rgba(255,255,255,0.2) 0%, transparent 100%), radial-gradient(1px 1px at 55% 20%, rgba(212,168,83,0.3) 0%, transparent 100%), radial-gradient(1px 1px at 70% 60%, rgba(255,255,255,0.15) 0%, transparent 100%), radial-gradient(1.5px 1.5px at 63% 50%, rgba(212,168,83,0.5) 0%, transparent 100%); pointer-events: none; }
  .fp-hero-content { position: relative; z-index: 1; max-width: 820px; margin: 0 auto; }
  .fp-hero-label { display: inline-block; padding: 6px 18px; border: 1px solid rgba(212,168,83,0.4); border-radius: 40px; font-size: 0.75rem; letter-spacing: 0.15em; text-transform: uppercase; color: var(--fp-gold); margin-bottom: 2rem; }
  .fp-hero-title { font-size: clamp(2rem,5vw,3.5rem); font-weight: 300; color: #fff; line-height: 1.2; letter-spacing: -0.02em; margin-bottom: 1.5rem; }
  .fp-hero-title em { font-style: italic; color: var(--fp-gold); }
  .fp-hero-subtitle { font-size: clamp(1rem,2vw,1.25rem); color: rgba(255,255,255,0.65); line-height: 1.7; max-width: 600px; margin: 0 auto 3rem; }
  .fp-hero-ctas { display: flex; flex-wrap: wrap; gap: 1rem; justify-content: center; }
  .fp-hero-scroll-hint { position: absolute; bottom: 32px; left: 50%; transform: translateX(-50%); color: rgba(255,255,255,0.3); font-size: 0.75rem; letter-spacing: 0.1em; text-transform: uppercase; display: flex; flex-direction: column; align-items: center; gap: 8px; animation: bounce 2s infinite; }
  @keyframes bounce { 0%,100% { transform: translateX(-50%) translateY(0); } 50% { transform: translateX(-50%) translateY(6px); } }

  /* BOUTONS */
  .fp-btn-gold { display: inline-flex; align-items: center; gap: 8px; padding: 1rem 2.5rem; background: linear-gradient(135deg,#D4A853 0%,#B8893A 100%); color: #fff; border-radius: 50px; font-size: 1rem; font-weight: 500; text-decoration: none; transition: all 0.3s; border: none; cursor: pointer; box-shadow: 0 8px 24px rgba(212,168,83,0.3); }
  .fp-btn-gold:hover { transform: translateY(-3px); box-shadow: 0 12px 32px rgba(212,168,83,0.45); color: #fff; text-decoration: none; }
  .fp-btn-outline { display: inline-flex; align-items: center; gap: 8px; padding: 1rem 2.5rem; border: 1px solid rgba(255,255,255,0.25); color: rgba(255,255,255,0.8); border-radius: 50px; font-size: 1rem; text-decoration: none; transition: all 0.3s; background: transparent; }
  .fp-btn-outline:hover { border-color: var(--fp-gold); color: var(--fp-gold); text-decoration: none; }
  .fp-btn-white { display: inline-flex; align-items: center; gap: 8px; padding: 1rem 2.5rem; background: #fff; color: var(--fp-gold-dark); border-radius: 50px; font-size: 1rem; font-weight: 600; text-decoration: none; transition: all 0.3s; box-shadow: 0 8px 24px rgba(0,0,0,0.2); }
  .fp-btn-white:hover { transform: translateY(-3px); box-shadow: 0 12px 32px rgba(0,0,0,0.3); color: var(--fp-gold-dark); text-decoration: none; }
  .fp-btn-outline-white { display: inline-flex; align-items: center; gap: 8px; padding: 1rem 2.5rem; border: 1.5px solid rgba(255,255,255,0.5); color: rgba(255,255,255,0.85); border-radius: 50px; font-size: 1rem; text-decoration: none; transition: all 0.3s; }
  .fp-btn-outline-white:hover { border-color: #fff; color: #fff; text-decoration: none; }

  /* PRÉREQUIS BANNER */
  .fp-prereq { padding: 60px 24px; background: var(--fp-bg-warm); }
  .fp-prereq-inner { max-width: 820px; margin: 0 auto; display: flex; gap: 2rem; align-items: center; padding: 2.5rem 3rem; background: #fff; border-radius: 20px; border: 1px solid rgba(212,168,83,0.25); box-shadow: 0 8px 32px rgba(0,0,0,0.06); }
  .fp-prereq-icon { width: 64px; height: 64px; border-radius: 50%; background: linear-gradient(135deg,#D4A853,#B8893A); display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
  .fp-prereq-icon svg { width: 28px; height: 28px; stroke: #fff; }
  .fp-prereq-text h3 { font-size: 1.0625rem; font-weight: 600; color: var(--fp-text); margin-bottom: 0.35rem; }
  .fp-prereq-text p { font-size: 0.9375rem; color: var(--fp-text-soft); margin: 0; line-height: 1.6; }
  .fp-prereq-text a { color: var(--fp-gold-dark); font-weight: 500; text-decoration: underline; }
  @media (max-width: 640px) { .fp-prereq-inner { flex-direction: column; padding: 2rem; } .fp-prereq-icon { width: 48px; height: 48px; } }

  /* CHIFFRES CLÉS */
  .fp-keydata { padding: 80px 24px; background: #fff; }
  .fp-keydata-grid { display: grid; grid-template-columns: repeat(auto-fit,minmax(160px,1fr)); gap: 2px; max-width: 900px; margin: 0 auto; background: var(--fp-border); }
  .fp-keydata-item { background: var(--fp-bg); padding: 2.5rem 2rem; text-align: center; }
  .fp-keydata-number { font-size: 2.5rem; font-weight: 300; color: var(--fp-gold-dark); line-height: 1; margin-bottom: 0.5rem; }
  .fp-keydata-label { font-size: 0.875rem; color: var(--fp-text-soft); line-height: 1.4; }

  /* POUR QUI */
  .fp-forqui { padding: 100px 24px; background: var(--fp-bg-dark); color: #fff; }
  .fp-section-title { font-size: clamp(1.75rem,3vw,2.5rem); font-weight: 300; letter-spacing: -0.02em; margin-bottom: 0.75rem; line-height: 1.2; }
  .fp-section-title.light { color: #fff; }
  .fp-section-title.dark  { color: var(--fp-text); }
  .fp-section-sub { font-size: 1rem; color: rgba(255,255,255,0.5); margin-bottom: 4rem; }
  .fp-section-sub.dark { color: var(--fp-text-soft); }
  .fp-forqui-grid { display: grid; grid-template-columns: repeat(auto-fit,minmax(240px,1fr)); gap: 1.5rem; max-width: 1100px; margin: 0 auto; }
  .fp-forqui-card { padding: 2rem; border: 1px solid rgba(212,168,83,0.2); border-radius: 16px; background: rgba(212,168,83,0.04); transition: all 0.3s; }
  .fp-forqui-card:hover { border-color: rgba(212,168,83,0.5); background: rgba(212,168,83,0.07); transform: translateY(-4px); }
  .fp-forqui-icon { font-size: 2rem; margin-bottom: 1rem; display: block; }
  .fp-forqui-card h4 { font-size: 1.0625rem; font-weight: 500; color: #fff; margin-bottom: 0.5rem; }
  .fp-forqui-card p { font-size: 0.875rem; color: rgba(255,255,255,0.5); line-height: 1.6; margin: 0; }

  /* MODULES / PROGRAMME */
  .fp-modules { padding: 100px 24px; background: var(--fp-bg-warm); }
  .fp-modules-header { text-align: center; max-width: 720px; margin: 0 auto 5rem; }
  .fp-module-list { max-width: 860px; margin: 0 auto; display: flex; flex-direction: column; }
  .fp-module-item { display: grid; grid-template-columns: 80px 1fr; gap: 0; border-bottom: 1px solid var(--fp-border); padding: 2rem 0; transition: all 0.3s; }
  .fp-module-item:first-child { border-top: 1px solid var(--fp-border); }
  .fp-module-item:hover .fp-module-body { padding-left: 8px; }
  .fp-module-num { padding-top: 4px; font-size: 0.75rem; color: var(--fp-gold-dark); font-weight: 500; letter-spacing: 0.1em; }
  .fp-module-body { transition: padding 0.3s; }
  .fp-module-body h3 { font-size: 1.1875rem; font-weight: 500; color: var(--fp-text); margin-bottom: 0.25rem; }
  .fp-module-week { font-size: 0.75rem; color: var(--fp-gold-dark); letter-spacing: 0.08em; text-transform: uppercase; margin-bottom: 0.75rem; }
  .fp-module-body p { font-size: 0.9375rem; color: var(--fp-text-soft); line-height: 1.6; margin-bottom: 0.75rem; }
  .fp-module-activities { display: flex; flex-wrap: wrap; gap: 0.5rem; }
  .fp-activity-tag { display: inline-flex; align-items: center; gap: 5px; padding: 4px 12px; background: #fff; border: 1px solid var(--fp-border); border-radius: 20px; font-size: 0.8125rem; color: var(--fp-text); }
  .fp-activity-tag svg { width: 12px; height: 12px; flex-shrink: 0; color: var(--fp-gold-dark); }

  /* PÉDAGOGIE */
  .fp-pedagogy { padding: 100px 24px; background: #fff; }
  .fp-pedagogy-inner { max-width: 1100px; margin: 0 auto; }
  .fp-pedagogy-header { text-align: center; margin-bottom: 5rem; }
  .fp-pedagogy-split { display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: center; }
  @media (max-width: 768px) { .fp-pedagogy-split { grid-template-columns: 1fr; } .fp-forqui-grid { grid-template-columns: 1fr 1fr; } }
  .fp-pedagogy-visual { background: var(--fp-bg-warm); border-radius: 20px; padding: 2.5rem; border: 1px solid var(--fp-border); }
  .fp-pedagogy-list { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 1.25rem; }
  .fp-pedagogy-list li { display: flex; gap: 1rem; align-items: flex-start; font-size: 0.9375rem; color: var(--fp-text-soft); line-height: 1.6; }
  .fp-pedagogy-list li .fp-check { width: 22px; height: 22px; border-radius: 50%; background: linear-gradient(135deg,var(--fp-gold-dark),var(--fp-gold)); display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-top: 1px; }
  .fp-pedagogy-list li .fp-check svg { width: 12px; height: 12px; stroke: #fff; }

  /* CERTIFICATION */
  .fp-certification { padding: 100px 24px; background: var(--fp-bg-warm); }
  .fp-cert-inner { max-width: 900px; margin: 0 auto; text-align: center; }
  .fp-cert-badge { width: 120px; height: 120px; border-radius: 50%; background: linear-gradient(135deg,#D4A853 0%,#B8893A 100%); margin: 0 auto 3rem; display: flex; align-items: center; justify-content: center; box-shadow: 0 16px 48px rgba(212,168,83,0.3); }
  .fp-cert-badge svg { width: 52px; height: 52px; stroke: #fff; }
  .fp-cert-title { font-size: clamp(1.5rem,3vw,2rem); font-weight: 300; color: var(--fp-text); margin-bottom: 1rem; letter-spacing: -0.01em; }
  .fp-cert-text { font-size: 1rem; color: var(--fp-text-soft); line-height: 1.8; max-width: 640px; margin: 0 auto 2.5rem; }
  .fp-cert-warning { display: inline-flex; align-items: center; gap: 10px; padding: 1rem 1.75rem; border-radius: 12px; font-size: 0.9375rem; }

  /* TARIF */
  .fp-pricing { padding: 100px 24px; background: #fff; }
  .fp-pricing-inner { max-width: 900px; margin: 0 auto; text-align: center; }
  .fp-pricing-card { display: inline-block; padding: 3rem 4rem; border-radius: 24px; background: var(--fp-bg-dark); border: 1px solid rgba(212,168,83,0.3); box-shadow: 0 32px 80px rgba(0,0,0,0.15); text-align: center; margin-top: 3rem; position: relative; overflow: hidden; }
  .fp-pricing-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px; background: linear-gradient(90deg,#D4A853,#84CC16,#2563EB); }
  .fp-price-label { font-size: 0.75rem; letter-spacing: 0.15em; text-transform: uppercase; color: var(--fp-gold); margin-bottom: 1.5rem; }
  .fp-price-main { font-size: 3.5rem; font-weight: 300; color: #fff; line-height: 1; margin-bottom: 0.25rem; }
  .fp-price-main span { font-size: 1.5rem; vertical-align: super; color: var(--fp-gold); }
  .fp-price-period { font-size: 0.875rem; color: rgba(255,255,255,0.4); margin-bottom: 2rem; }
  .fp-price-includes { list-style: none; padding: 0; margin: 0 0 2.5rem; text-align: left; display: flex; flex-direction: column; gap: 0.75rem; }
  .fp-price-includes li { display: flex; gap: 0.75rem; font-size: 0.9375rem; color: rgba(255,255,255,0.7); }
  .fp-price-includes li::before { content: '✓'; color: var(--fp-green); font-weight: 600; flex-shrink: 0; }

  /* PROMESSE */
  .fp-promise { padding: 100px 24px; background: var(--fp-bg-dark); text-align: center; }
  .fp-promise-inner { max-width: 680px; margin: 0 auto; }
  .fp-promise blockquote { font-size: clamp(1.25rem,2.5vw,1.75rem); font-weight: 300; font-style: italic; color: rgba(255,255,255,0.75); line-height: 1.8; border: none; padding: 0; margin: 0 0 1.5rem; }
  .fp-promise blockquote em { color: var(--fp-gold); font-style: normal; }
  .fp-promise-ref { font-size: 0.875rem; color: rgba(255,255,255,0.3); letter-spacing: 0.05em; }

  /* CTA FINAL */
  .fp-cta-section { padding: 100px 24px; background: linear-gradient(135deg,#1a1a2e 0%,#16213e 50%,#0d0d1a 100%); text-align: center; position: relative; overflow: hidden; }
  .fp-cta-section::before { content:''; position:absolute; inset:0; background:radial-gradient(ellipse 80% 50% at 50% 0%, rgba(37,99,235,0.15) 0%, transparent 60%); pointer-events:none; }
  .fp-cta-inner { position: relative; max-width: 680px; margin: 0 auto; }
  .fp-cta-inner h2 { font-size: clamp(1.75rem,3.5vw,2.5rem); font-weight: 300; color: #fff; margin-bottom: 1rem; line-height: 1.3; letter-spacing: -0.01em; }
  .fp-cta-inner p { font-size: 1.0625rem; color: rgba(255,255,255,0.75); margin-bottom: 2.5rem; line-height: 1.6; }
  .fp-cta-pair { display: flex; flex-wrap: wrap; gap: 1rem; justify-content: center; }

  @media (max-width: 600px) { .fp-forqui-grid { grid-template-columns: 1fr; } .fp-pricing-card { padding: 2rem 1.5rem; } }
</style>
@endsection

@section('content')
<div class="fp-page">

  {{-- ══════════════════════════════════════════════════════ --}}
  {{-- HERO                                                   --}}
  {{-- ══════════════════════════════════════════════════════ --}}
  <section class="fp-hero">
    <div class="fp-hero-bg"></div>
    <div class="fp-stars"></div>
    <div class="fp-hero-content">
      <div class="fp-hero-label">La Formation Freelance · Certification Pause Souffle</div>
      <h1 class="fp-hero-title">
        Vous avez traversé le Parcours.<br>
        Il est temps d'apprendre à le <em>transmettre</em>.
      </h1>
      <p class="fp-hero-subtitle">
        La Formation Freelance vous donne le cadre, les outils et la certification<br>
        pour animer le Rituel Pause Souffle et l'intégrer à votre activité professionnelle.
      </p>
      <div class="fp-hero-ctas">
        @auth
          <form method="POST" action="{{ route('presence.formation.checkout') }}" style="display:inline">
            @csrf
            <input type="hidden" name="product_type" value="pause_freelance">
            <button type="submit" class="fp-btn-gold">
              <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12l5 5L20 7"/></svg>
              Rejoindre la formation
            </button>
          </form>
        @else
          <a href="{{ route('user.login') }}?redirect={{ urlencode(route('presence.formation-praticien')) }}" class="fp-btn-gold">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12l5 5L20 7"/></svg>
            Rejoindre la formation
          </a>
        @endauth
        <a href="{{ route('presence.parcours') }}" class="fp-btn-outline">
          Découvrir Le Parcours d'abord
        </a>
      </div>
    </div>
    <div class="fp-hero-scroll-hint">
      <span>Découvrir</span>
      <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 5v14M5 12l7 7 7-7"/></svg>
    </div>
  </section>

  {{-- ══════════════════════════════════════════════════════ --}}
  {{-- PRÉREQUIS                                              --}}
  {{-- ══════════════════════════════════════════════════════ --}}
  <section class="fp-prereq">
    <div class="fp-prereq-inner" style="max-width:820px; margin:0 auto;">
      <div class="fp-prereq-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
          <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
        </svg>
      </div>
      <div class="fp-prereq-text">
        <h3>Prérequis : votre Attestation Retour à Soi</h3>
        <p>
          La Formation Freelance est réservée aux personnes ayant <strong>complété Le Parcours Pause Souffle</strong> et obtenu leur Attestation Retour à Soi. On ne transmet que ce qu'on a d'abord traversé.
          <br><br>
          Pas encore fait le Parcours ? <a href="{{ route('presence.parcours') }}">Commencez par Le Parcours — 3 490 €</a>.
        </p>
      </div>
    </div>
  </section>

  {{-- ══════════════════════════════════════════════════════ --}}
  {{-- CHIFFRES CLÉS                                          --}}
  {{-- ══════════════════════════════════════════════════════ --}}
  <section class="fp-keydata">
    <div class="fp-keydata-grid">
      <div class="fp-keydata-item">
        <div class="fp-keydata-number">9</div>
        <div class="fp-keydata-label">Modules<br>de Formation</div>
      </div>
      <div class="fp-keydata-item">
        <div class="fp-keydata-number">00→08</div>
        <div class="fp-keydata-label">Progression<br>structurée</div>
      </div>
      <div class="fp-keydata-item">
        <div class="fp-keydata-number">6</div>
        <div class="fp-keydata-label">Modules socle<br>incarnation personnelle</div>
      </div>
      <div class="fp-keydata-item">
        <div class="fp-keydata-number">3</div>
        <div class="fp-keydata-label">Modules pro<br>transmission & maitrise</div>
      </div>
      <div class="fp-keydata-item">
        <div class="fp-keydata-number">3 490</div>
        <div class="fp-keydata-label">Euros<br>paiement unique</div>
      </div>
    </div>
  </section>

  {{-- ══════════════════════════════════════════════════════ --}}
  {{-- POUR QUI                                               --}}
  {{-- ══════════════════════════════════════════════════════ --}}
  <section class="fp-forqui">
    <div style="max-width:1100px; margin:0 auto;">
      <div style="text-align:center; margin-bottom:4rem;">
        <h2 class="fp-section-title light">Pour qui est cette formation</h2>
        <p class="fp-section-sub">Pour toute personne ayant complété Le Parcours — et qui veut maintenant transmettre.</p>
      </div>
      <div class="fp-forqui-grid">
        <div class="fp-forqui-card">
          <span class="fp-forqui-icon">🌿</span>
          <h4>Coach souhaitant élargir ses services</h4>
          <p>Intégrez le Rituel Corps Complet à vos offres. Un outil puissant et complémentaire à votre pratique de coaching.</p>
        </div>
        <div class="fp-forqui-card">
          <span class="fp-forqui-icon">✨</span>
          <h4>Professionnel en reconversion active</h4>
          <p>Vous avez vécu votre transformation grâce au Parcours. Maintenant créez votre activité autour de cette pratique.</p>
        </div>
        <div class="fp-forqui-card">
          <span class="fp-forqui-icon">🎯</span>
          <h4>Thérapeute ou praticien bien-être</h4>
          <p>Enrichissez votre pratique existante avec un Rituel structuré, physiologique et ancré. Une offre complémentaire rare.</p>
        </div>
        <div class="fp-forqui-card">
          <span class="fp-forqui-icon">🕊️</span>
          <h4>Accompagnateur spirituel</h4>
          <p>Le Rituel Pause Souffle s'intègre parfaitement à un accompagnement de discernement, retraite ou direction spirituelle.</p>
        </div>
        <div class="fp-forqui-card">
          <span class="fp-forqui-icon">💼</span>
          <h4>Créateur d'activité indépendante</h4>
          <p>Votre profil Junspro activé vous connecte à des clients dès la certification. Une activité à créer ou développer.</p>
        </div>
        <div class="fp-forqui-card">
          <span class="fp-forqui-icon">🌱</span>
          <h4>Sans formation académique préalable</h4>
          <p>Ce qui compte c'est votre transformation vécue. Le Parcours vous l'a donné. La Formation vous donne le reste.</p>
        </div>
      </div>
    </div>
  </section>

  {{-- ══════════════════════════════════════════════════════ --}}
  {{-- LES RITUELS QUE VOUS ANIMEREZ                          --}}
  {{-- ══════════════════════════════════════════════════════ --}}
  <section style="background:#fff; padding:100px 24px;" id="rituels">
    <div style="max-width:1000px; margin:0 auto;">
      <div style="text-align:center; margin-bottom:4rem;">
        <div style="font-size:.72rem; letter-spacing:.2em; text-transform:uppercase; color:#B8893A; margin-bottom:.75rem;">Ce que vous proposerez à vos clients</div>
        <h2 style="font-size:clamp(1.5rem,2.5vw,2rem); font-weight:300; color:#1F2937; letter-spacing:-.02em; margin-bottom:1rem;">Exemple de Rituel Corps Complet <em style="font-style:italic; color:#B8893A;">Pause Souffle</em></h2>
        <p style="font-size:.9375rem; color:#6B7280; max-width:600px; margin:0 auto;">Do In → Tai Chi → Pilates → Stretching → Méditation → Câlin signature.<br>L'ordre est physiologique : éveiller, fluidifier, tonifier, libérer, transformer, sceller.</p>
      </div>
      <div style="display:grid; grid-template-columns:1fr 1fr; gap:2rem;">

        <div style="border:1px solid #E5E7EB; border-radius:16px; overflow:hidden;">
          <div style="background:#0D0D1A; padding:1.5rem 2rem;">
            <div style="font-size:.72rem; letter-spacing:.15em; text-transform:uppercase; color:#D4A853;">Format</div>
            <div style="font-size:1.25rem; font-weight:300; color:#fff; margin-top:.25rem;">45 minutes</div>
          </div>
          <div style="padding:1.5rem 2rem;">
            <table style="width:100%; border-collapse:collapse; font-size:.875rem;">
              <tr style="border-bottom:1px solid #F3F4F6;"><td style="padding:.6rem 0; color:#B8893A; font-weight:600; width:50px;">3 min</td><td style="padding:.6rem 0; color:#1F2937;">Accueil · Installation · Respiration 5-5-5</td></tr>
              <tr style="border-bottom:1px solid #F3F4F6;"><td style="padding:.6rem 0; color:#B8893A; font-weight:600;">6 min</td><td style="padding:.6rem 0; color:#1F2937;"><strong>Do In</strong> — visage, nuque, avant-bras, pieds</td></tr>
              <tr style="border-bottom:1px solid #F3F4F6;"><td style="padding:.6rem 0; color:#B8893A; font-weight:600;">7 min</td><td style="padding:.6rem 0; color:#1F2937;"><strong>Tai Chi</strong> — 3 formes lentes</td></tr>
              <tr style="border-bottom:1px solid #F3F4F6;"><td style="padding:.6rem 0; color:#B8893A; font-weight:600;">8 min</td><td style="padding:.6rem 0; color:#1F2937;"><strong>Pilates</strong> fonctionnel au sol</td></tr>
              <tr style="border-bottom:1px solid #F3F4F6;"><td style="padding:.6rem 0; color:#B8893A; font-weight:600;">6 min</td><td style="padding:.6rem 0; color:#1F2937;"><strong>Stretching</strong> — colonne, hanches, épaules</td></tr>
              <tr style="border-bottom:1px solid #F3F4F6;"><td style="padding:.6rem 0; color:#B8893A; font-weight:600;">10 min</td><td style="padding:.6rem 0; color:#1F2937;"><strong>Méditation guidée</strong> Pause Souffle</td></tr>
              <tr><td style="padding:.6rem 0; color:#B8893A; font-weight:600;">5 min</td><td style="padding:.6rem 0; color:#1F2937;">Silence · <strong>Câlin de clôture</strong> ✦</td></tr>
            </table>
          </div>
        </div>

        <div style="border:1px solid rgba(212,168,83,.3); border-radius:16px; overflow:hidden;">
          <div style="background:linear-gradient(135deg,#0D0D1A,#1a0d00); padding:1.5rem 2rem;">
            <div style="font-size:.72rem; letter-spacing:.15em; text-transform:uppercase; color:#D4A853;">Format</div>
            <div style="font-size:1.25rem; font-weight:300; color:#fff; margin-top:.25rem;">60 minutes</div>
          </div>
          <div style="padding:1.5rem 2rem;">
            <table style="width:100%; border-collapse:collapse; font-size:.875rem;">
              <tr style="border-bottom:1px solid #F3F4F6;"><td style="padding:.6rem 0; color:#B8893A; font-weight:600; width:50px;">3 min</td><td style="padding:.6rem 0; color:#1F2937;">Accueil · Respiration consciente</td></tr>
              <tr style="border-bottom:1px solid #F3F4F6;"><td style="padding:.6rem 0; color:#B8893A; font-weight:600;">8 min</td><td style="padding:.6rem 0; color:#1F2937;"><strong>Do In</strong> — corps complet</td></tr>
              <tr style="border-bottom:1px solid #F3F4F6;"><td style="padding:.6rem 0; color:#B8893A; font-weight:600;">10 min</td><td style="padding:.6rem 0; color:#1F2937;"><strong>Tai Chi</strong> — séquence complète</td></tr>
              <tr style="border-bottom:1px solid #F3F4F6;"><td style="padding:.6rem 0; color:#B8893A; font-weight:600;">10 min</td><td style="padding:.6rem 0; color:#1F2937;"><strong>Pilates</strong> fonctionnel + gainage doux</td></tr>
              <tr style="border-bottom:1px solid #F3F4F6;"><td style="padding:.6rem 0; color:#B8893A; font-weight:600;">8 min</td><td style="padding:.6rem 0; color:#1F2937;"><strong>Stretching</strong> — chaîne post., psoas, épaules</td></tr>
              <tr style="border-bottom:1px solid #F3F4F6;"><td style="padding:.6rem 0; color:#B8893A; font-weight:600;">16 min</td><td style="padding:.6rem 0; color:#1F2937;"><strong>Méditation guidée</strong> Pause Souffle</td></tr>
              <tr><td style="padding:.6rem 0; color:#B8893A; font-weight:600;">5 min</td><td style="padding:.6rem 0; color:#1F2937;"><strong>Câlin de clôture</strong> + mot de fin ✦</td></tr>
            </table>
          </div>
        </div>

      </div>
      <p style="text-align:center; margin-top:2rem; font-size:.8rem; color:#9CA3AF;">✦ Le câlin de clôture est la signature Junspro — enseigné en formation, encadré, sincère. Jamais obligatoire pour le client, toujours proposé par le freelance.</p>
    </div>
  </section>

  {{-- ══════════════════════════════════════════════════════ --}}
  {{-- PROGRAMME DE LA FORMATION                              --}}
  {{-- ══════════════════════════════════════════════════════ --}}
  <section class="fp-modules" id="programme">
    <div style="max-width:860px; margin:0 auto;">
      <div class="fp-modules-header">
        <h2 class="fp-section-title dark">Programme de la Formation</h2>
        <p class="fp-section-sub dark">9 modules (00 à 08) pour passer de l'intégration personnelle à la transmission professionnelle.</p>
      </div>
      <div class="fp-module-list">

        <div class="fp-module-item">
          <div class="fp-module-num">00</div>
          <div class="fp-module-body">
            <div class="fp-module-week">Module 00</div>
            <h3>Comprendre le Corps — Anatomie & Physiologie</h3>
            <p>Fondations physiologiques du protocole Pause Souffle, lecture corporelle et sécurité de pratique.</p>
            <div class="fp-module-activities">
              <span class="fp-activity-tag"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18"/></svg> 8 territoires corporels</span>
              <span class="fp-activity-tag"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z"/></svg> Systèmes clés & sécurité</span>
              <span class="fp-activity-tag"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg> Protocoles d'observation</span>
            </div>
          </div>
        </div>

        <div class="fp-module-item">
          <div class="fp-module-num">01</div>
          <div class="fp-module-body">
            <div class="fp-module-week">Module 01</div>
            <h3>Je me rencontre</h3>
            <p>Auto-observation, écoute de soi et ancrage corporel pour installer une présence praticienne stable.</p>
            <div class="fp-module-activities">
              <span class="fp-activity-tag"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M14 9V5a3 3 0 00-3-3l-4 9v11h11.28a2 2 0 002-1.7l1.38-9a2 2 0 00-2-2.3H14z"/></svg> Scan corporel guidé</span>
              <span class="fp-activity-tag"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/></svg> Journal corporel</span>
              <span class="fp-activity-tag"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg> Posture d'écoute</span>
            </div>
          </div>
        </div>

        <div class="fp-module-item">
          <div class="fp-module-num">02</div>
          <div class="fp-module-body">
            <div class="fp-module-week">Module 02</div>
            <h3>Je reconnais mes blessures</h3>
            <p>Comprendre les mémoires corporelles, les armures et le cadre d'accompagnement sécurisé.</p>
            <div class="fp-module-activities">
              <span class="fp-activity-tag"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></svg> Cartographie émotionnelle</span>
              <span class="fp-activity-tag"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z"/></svg> Lecture des tensions</span>
              <span class="fp-activity-tag"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg> Cadre éthique</span>
            </div>
          </div>
        </div>

        <div class="fp-module-item">
          <div class="fp-module-num">03</div>
          <div class="fp-module-body">
            <div class="fp-module-week">Module 03</div>
            <h3>Je décris mon bonheur</h3>
            <p>Clarifier la boussole personnelle pour guider sans projection et transmettre avec congruence.</p>
            <div class="fp-module-activities">
              <span class="fp-activity-tag"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg> Vision de vie alignée</span>
              <span class="fp-activity-tag"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg> Questions de discernement</span>
              <span class="fp-activity-tag"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg> Intégration narrative</span>
            </div>
          </div>
        </div>

        <div class="fp-module-item">
          <div class="fp-module-num">04</div>
          <div class="fp-module-body">
            <div class="fp-module-week">Module 04</div>
            <h3>J'écoute mon souffle intérieur</h3>
            <p>Respiration consciente, régulation émotionnelle et qualité de présence en séance.</p>
            <div class="fp-module-activities">
              <span class="fp-activity-tag"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg> Pratiques respiratoires</span>
              <span class="fp-activity-tag"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/></svg> Protocoles 5-5-5</span>
              <span class="fp-activity-tag"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18"/></svg> Adaptation client</span>
            </div>
          </div>
        </div>

        <div class="fp-module-item">
          <div class="fp-module-num">05</div>
          <div class="fp-module-body">
            <div class="fp-module-week">Module 05</div>
            <h3>Je découvre ma mission unique</h3>
            <p>Positionnement, posture d'accompagnant et articulation entre vocation personnelle et offre professionnelle.</p>
          </div>
        </div>

        <div class="fp-module-item">
          <div class="fp-module-num">06</div>
          <div class="fp-module-body">
            <div class="fp-module-week">Module 06</div>
            <h3>J'incarne ma Vision — Clarté, Courage & Discipline</h3>
            <p>Stabiliser sa vision dans des preuves concrètes, installer la discipline de transmission et la tenue dans le temps.</p>
          </div>
        </div>

        <div class="fp-module-item">
          <div class="fp-module-num">07</div>
          <div class="fp-module-body">
            <div class="fp-module-week">Module 07</div>
            <h3>Je transmets le Rituel Pause Souffle</h3>
            <p>Architecture complète d'une séance, cadre relationnel, sécurité et pédagogie d'accompagnement.</p>
          </div>
        </div>

        <div class="fp-module-item">
          <div class="fp-module-num">08</div>
          <div class="fp-module-body">
            <div class="fp-module-week">Module 08</div>
            <h3>Je maîtrise la Vision — Pratique Avancée</h3>
            <p>Consolidation avancée, ancrage professionnel et continuité de pratique pour une transmission durable.</p>
          </div>
        </div>

      </div>
    </div>
  </section>

  {{-- ══════════════════════════════════════════════════════ --}}
  {{-- PÉDAGOGIE                                              --}}
  {{-- ══════════════════════════════════════════════════════ --}}
  <section class="fp-pedagogy">
    <div class="fp-pedagogy-inner">
      <div class="fp-pedagogy-header">
        <h2 class="fp-section-title dark">Une formation conçue pour la pratique réelle</h2>
        <p class="fp-section-sub dark">Pas de théorie abstraite. Chaque module est tourné vers l'action, le feedback et la maîtrise.</p>
      </div>
      <div class="fp-pedagogy-split">
        <div class="fp-pedagogy-visual">
          <div style="font-size: 0.875rem; font-weight:600; color: var(--fp-text); margin-bottom: 1.75rem;">Ce que vous obtenez</div>
          <div style="display: flex; flex-direction: column; gap: 1rem;">
            <div style="display: flex; gap: 1rem; align-items: center; padding: 1rem; background: white; border-radius: 12px; border: 1px solid var(--fp-border);">
              <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #D4A853, #B8893A); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <svg width="18" height="18" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg>
              </div>
              <div>
                <div style="font-weight: 600; font-size: .9375rem; color: var(--fp-text);">Certification Freelance Pause Souffle</div>
                <div style="font-size: .8rem; color: var(--fp-text-soft);">Délivrée par Junspro · reconnue dans le réseau</div>
              </div>
            </div>
            <div style="display: flex; gap: 1rem; align-items: center; padding: 1rem; background: white; border-radius: 12px; border: 1px solid var(--fp-border);">
              <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #2563EB, #1d4ed8); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <svg width="18" height="18" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
              </div>
              <div>
                <div style="font-weight: 600; font-size: .9375rem; color: var(--fp-text);">Profil Freelance activé sur Junspro.com</div>
                <div style="font-size: .8rem; color: var(--fp-text-soft);">Visible par les clients dès la certification</div>
              </div>
            </div>
            <div style="display: flex; gap: 1rem; align-items: center; padding: 1rem; background: white; border-radius: 12px; border: 1px solid var(--fp-border);">
              <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #84CC16, #65a30d); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <svg width="18" height="18" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
              </div>
              <div>
                <div style="font-weight: 600; font-size: .9375rem; color: var(--fp-text);">Kit de démarrage Freelance</div>
                <div style="font-size: .8rem; color: var(--fp-text-soft);">Fiches Rituels, templates, supports clients</div>
              </div>
            </div>
          </div>
        </div>
        <ul class="fp-pedagogy-list">
          <li><div class="fp-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6L9 17l-5-5"/></svg></div><span>Sessions live en visio avec les formateurs et votre groupe de promotion</span></li>
          <li><div class="fp-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6L9 17l-5-5"/></svg></div><span>Pratique en binôme et en groupe — feedback immédiat, progression partagée</span></li>
          <li><div class="fp-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6L9 17l-5-5"/></svg></div><span>Accès à la bibliothèque Junspro — scripts méditation, vidéos de référence, tutoriels</span></li>
          <li><div class="fp-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6L9 17l-5-5"/></svg></div><span>Communauté des Freelances Pause Souffle certifiés — réseau actif et bienveillant</span></li>
          <li><div class="fp-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6L9 17l-5-5"/></svg></div><span>Accompagnement pour définir vos tarifs, créer votre offre et commencer à trouver des clients</span></li>
          <li><div class="fp-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6L9 17l-5-5"/></svg></div><span>Langue : français — contenu accessible à vie, à votre rythme</span></li>
        </ul>
      </div>
    </div>
  </section>

  {{-- ══════════════════════════════════════════════════════ --}}
  {{-- CERTIFICATION FREELANCE                                --}}
  {{-- ══════════════════════════════════════════════════════ --}}
  <section class="fp-certification" id="certification">
    <div class="fp-cert-inner">
      <div class="fp-cert-badge">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
          <path d="M12 15l-2 5L7 9l11 4-5 2z"/>
          <path d="M14.5 4.5a9 9 0 11-9 9"/>
        </svg>
      </div>
      <h2 class="fp-cert-title">La Certification Freelance Pause Souffle</h2>
      <p class="fp-cert-text">
        Après la séance test et l'évaluation, vous recevez votre <strong>Certification Freelance Pause Souffle</strong> — délivrée par Junspro.<br><br>
        Elle vous autorise à proposer officiellement le Rituel Pause Souffle à vos clients, à utiliser la marque et les visuels certifiés, et à activer votre <strong>profil Freelance sur Junspro.com</strong>.<br><br>
        Chaque année, un module de mise à niveau vous maintient au courant des évolutions du Rituel et de la pratique.
      </p>
      <div class="fp-cert-warning" style="background:rgba(37,99,235,.07); border:1px solid rgba(37,99,235,.25); color:rgba(37,99,235,.9);">
        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <circle cx="12" cy="12" r="10"/>
          <path d="M12 8v4"/>
          <path d="M12 16h.01"/>
        </svg>
        Prérequis obligatoire : Attestation Retour à Soi (Le Parcours Pause Souffle complété).
      </div>
    </div>
  </section>

  {{-- ══════════════════════════════════════════════════════ --}}
  {{-- TARIF                                                  --}}
  {{-- ══════════════════════════════════════════════════════ --}}
  <section class="fp-pricing">
    <div class="fp-pricing-inner">
      <h2 class="fp-section-title dark" style="text-align:center;">Investissement</h2>
      <p class="fp-section-sub dark" style="text-align:center;">Programme complet · Certification Freelance · Profil Junspro activé.</p>
      <div style="text-align:center;">
        <div class="fp-pricing-card">
          <div class="fp-price-label">La Formation Freelance · Certification Pause Souffle</div>
          <div class="fp-price-main"><span>€</span>3 490</div>
          <div class="fp-price-period">paiement unique · ou 3× 1 164 €/mois</div>
          <ul class="fp-price-includes">
            <li>9 modules de formation (00 à 08) — accès à vie, contenu mis à jour</li>
            <li>Sessions live avec formateurs en visio (feedback direct)</li>
            <li>Pratique filmée + évaluation par les pairs et l'équipe</li>
            <li>Certification Freelance Pause Souffle délivrée par Junspro</li>
            <li>Profil Freelance activé sur Junspro.com — visible des clients</li>
            <li>Kit de démarrage : fiches Rituels, templates, supports clients</li>
            <li>Accès à la communauté des Freelances Pause Souffle certifiés</li>
          </ul>
          @auth
            <form method="POST" action="{{ route('presence.formation.checkout') }}" style="display:inline; width:100%">
              @csrf
              <input type="hidden" name="product_type" value="pause_freelance">
              <button type="submit" class="fp-btn-gold" style="width:100%; justify-content:center;">Rejoindre la formation — 3 490 €</button>
            </form>
          @else
            <a href="{{ route('user.login') }}?redirect={{ urlencode(route('presence.formation-praticien')) }}" class="fp-btn-gold" style="width:100%; justify-content:center;">Rejoindre la formation — 3 490 €</a>
          @endauth
          @auth
            <form method="POST" action="{{ route('presence.formation.checkout.installment') }}" style="display:inline; width:100%; margin-top:.6rem;">
              @csrf
              <input type="hidden" name="product_type" value="pause_freelance">
              <button type="submit" class="fp-btn-outline" style="width:100%; justify-content:center; margin-top:.6rem; color:rgba(232,224,208,.7); border-color:rgba(201,168,76,.4);">Payer en 3× 1 164 € / mois</button>
            </form>
          @else
            <a href="{{ route('user.login') }}?redirect={{ urlencode(route('presence.formation-praticien')) }}" class="fp-btn-outline" style="width:100%; justify-content:center; margin-top:.6rem; color:rgba(232,224,208,.7); border-color:rgba(201,168,76,.4); text-align:center; display:block;">Payer en 3× 1 164 € / mois</a>
          @endauth
          <p style="font-size:0.75rem; color:rgba(255,255,255,0.3); margin-top:1rem;">
            Prérequis : Attestation Retour à Soi (Le Parcours complété) obligatoire avant l'accès.
          </p>
        </div>
      </div>
    </div>
  </section>

  {{-- ══════════════════════════════════════════════════════ --}}
  {{-- PROMESSE                                               --}}
  {{-- ══════════════════════════════════════════════════════ --}}
  <section class="fp-promise">
    <div class="fp-promise-inner">
      <blockquote>
        "On ne transmet pas<br>
        ce qu'on a appris dans les livres.<br>
        On transmet<br>
        ce qu'on a <em>vécu et traversé</em>."
      </blockquote>
      <div class="fp-promise-ref">— Fondement de la Formation Freelance · Pause Souffle</div>
    </div>
  </section>

  {{-- ══════════════════════════════════════════════════════ --}}
  {{-- CTA FINAL                                              --}}
  {{-- ══════════════════════════════════════════════════════ --}}
  <section class="fp-cta-section">
    <div class="fp-cta-inner">
      <h2>Prêt·e à transmettre le Rituel ?</h2>
      <p>Vous l'avez vécu. Il est temps d'apprendre à l'animer.<br>La certification, le profil Junspro et la communauté vous attendent.</p>
      <div class="fp-cta-pair">
        @auth
          <form method="POST" action="{{ route('presence.formation.checkout') }}" style="display:inline">
            @csrf
            <input type="hidden" name="product_type" value="pause_freelance">
            <button type="submit" class="fp-btn-white">
              <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 12l5 5L20 7"/></svg>
              Rejoindre la formation
            </button>
          </form>
        @else
          <a href="{{ route('user.login') }}?redirect={{ urlencode(route('presence.formation-praticien')) }}" class="fp-btn-white">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 12l5 5L20 7"/></svg>
            Rejoindre la formation
          </a>
        @endauth
        <a href="{{ route('presence.parcours') }}" class="fp-btn-outline-white">
          D'abord faire Le Parcours
        </a>
      </div>
    </div>
  </section>

</div>
@endsection
