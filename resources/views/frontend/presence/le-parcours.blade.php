@extends('frontend.layout')

@section('pageHeading')
  Le Parcours Pause Souffle · Retour à Soi | {{ $websiteInfo->website_title }}
@endsection

@section('metaDescription')
  Le Parcours Pause Souffle — 6 modules en ligne pour votre propre transformation. Pas une formation professionnelle : un chemin intérieur, pour vous. Attestation Retour à Soi incluse.
@endsection

@section('style')
<style>
  /* ============================================
     PAGE LE PARCOURS · RETOUR À SOI
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
  .fp-hero-bg { position: absolute; inset: 0; background: radial-gradient(ellipse 80% 50% at 50% 0%, rgba(212,168,83,0.15) 0%, transparent 60%), radial-gradient(ellipse 60% 40% at 20% 80%, rgba(184,137,58,0.08) 0%, transparent 50%), radial-gradient(ellipse 50% 40% at 80% 70%, rgba(212,168,83,0.06) 0%, transparent 50%); pointer-events: none; }
  .fp-stars { position: absolute; inset: 0; background-image: radial-gradient(1px 1px at 10% 15%, rgba(212,168,83,0.4) 0%, transparent 100%), radial-gradient(1px 1px at 30% 45%, rgba(255,255,255,0.2) 0%, transparent 100%), radial-gradient(1px 1px at 55% 20%, rgba(212,168,83,0.3) 0%, transparent 100%), radial-gradient(1px 1px at 70% 60%, rgba(255,255,255,0.15) 0%, transparent 100%), radial-gradient(1.5px 1.5px at 63% 50%, rgba(212,168,83,0.5) 0%, transparent 100%); pointer-events: none; }
  .fp-hero-content { position: relative; z-index: 1; max-width: 820px; margin: 0 auto; }
  .fp-hero-label { display: inline-block; padding: 6px 18px; border: 1px solid rgba(212,168,83,0.4); border-radius: 40px; font-size: 0.75rem; letter-spacing: 0.15em; text-transform: uppercase; color: var(--fp-gold); margin-bottom: 2rem; }
  .fp-hero-title { font-size: clamp(2rem,5vw,3.5rem); font-weight: 300; color: #fff; line-height: 1.2; letter-spacing: -0.02em; margin-bottom: 1.5rem; }
  .fp-hero-title em { font-style: italic; color: var(--fp-gold); }
  .fp-hero-verse { font-size: 0.9375rem; color: rgba(255,255,255,0.45); font-style: italic; margin-bottom: 2rem; line-height: 1.6; }
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

  /* MANIFESTE */
  .fp-manifesto { background: var(--fp-bg-warm); padding: 100px 24px; text-align: center; }
  .fp-manifesto-inner { max-width: 720px; margin: 0 auto; }
  .fp-manifesto-eyebrow { font-size: 0.75rem; letter-spacing: 0.15em; text-transform: uppercase; color: var(--fp-gold-dark); margin-bottom: 2rem; }
  .fp-manifesto blockquote { font-size: clamp(1.25rem,2.5vw,1.75rem); font-weight: 300; line-height: 1.8; color: var(--fp-text); border: none; padding: 0; margin: 0 0 2.5rem; font-style: italic; }
  .fp-manifesto blockquote strong { font-weight: 600; color: var(--fp-text); font-style: normal; }
  .fp-manifesto-note { font-size: 0.9375rem; color: var(--fp-text-soft); line-height: 1.7; }

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

  /* MODULES */
  .fp-modules { padding: 100px 24px; background: var(--fp-bg-warm); }
  .fp-modules-header { text-align: center; max-width: 720px; margin: 0 auto 5rem; }
  .fp-module-list { max-width: 860px; margin: 0 auto; display: flex; flex-direction: column; gap: 0; }
  .fp-module-item { display: grid; grid-template-columns: 80px 1fr; gap: 0; border-bottom: 1px solid var(--fp-border); padding: 2rem 0; transition: all 0.3s; cursor: default; }
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
  .fp-pace-bar { margin-bottom: 2rem; }
  .fp-pace-bar-label { display: flex; justify-content: space-between; font-size: 0.875rem; margin-bottom: 0.5rem; color: var(--fp-text); }
  .fp-pace-track { height: 8px; background: var(--fp-border); border-radius: 4px; overflow: hidden; }
  .fp-pace-fill { height: 100%; border-radius: 4px; background: linear-gradient(90deg,var(--fp-gold-dark),var(--fp-gold)); }
  .fp-pedagogy-list { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 1.25rem; }
  .fp-pedagogy-list li { display: flex; gap: 1rem; align-items: flex-start; font-size: 0.9375rem; color: var(--fp-text-soft); line-height: 1.6; }
  .fp-pedagogy-list li .fp-check { width: 22px; height: 22px; border-radius: 50%; background: linear-gradient(135deg,var(--fp-gold-dark),var(--fp-gold)); display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-top: 1px; }
  .fp-pedagogy-list li .fp-check svg { width: 12px; height: 12px; stroke: #fff; }

  /* CERTIFICATION / ATTESTATION */
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
  .fp-pricing-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px; background: linear-gradient(90deg,#D4A853,#B8893A); }
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
  .fp-cta-section { padding: 100px 24px; background: linear-gradient(135deg,#D4A853 0%,#B8893A 50%,#1a1a2e 100%); text-align: center; position: relative; overflow: hidden; }
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
      <div class="fp-hero-label">Le Parcours · Retour à Soi</div>
      <h1 class="fp-hero-title">
        Je suis une personne ordinaire,<br>
        appelée à faire des choses <em>extraordinaires</em>
      </h1>
      <p class="fp-hero-verse">
        « L'Éternel lui dit : Va avec la force que tu as… C'est moi qui t'envoie. »<br>
        — Juges 6:14
      </p>
      <p class="fp-hero-subtitle">
        Avant d'accompagner les autres à trouver leur souffle,<br>
        commencez par trouver le vôtre.
      </p>
      <div class="fp-hero-ctas">
        @auth
          <form method="POST" action="{{ route('presence.formation.checkout') }}" style="display:inline">
            @csrf
            <input type="hidden" name="product_type" value="pause_parcours">
            <button type="submit" class="fp-btn-gold">
              <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12l5 5L20 7"/></svg>
              Démarrer mon parcours
            </button>
          </form>
        @else
          <a href="{{ route('user.login') }}?redirect={{ urlencode(route('presence.parcours')) }}" class="fp-btn-gold">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12l5 5L20 7"/></svg>
            Démarrer mon parcours
          </a>
        @endauth
        <a href="{{ route('presence.pause-souffle') }}" class="fp-btn-outline">
          Découvrir le Rituel Pause Souffle
        </a>
      </div>
    </div>
    <div class="fp-hero-scroll-hint">
      <span>Découvrir</span>
      <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 5v14M5 12l7 7 7-7"/></svg>
    </div>
  </section>

  {{-- ══════════════════════════════════════════════════════ --}}
  {{-- MANIFESTE                                              --}}
  {{-- ══════════════════════════════════════════════════════ --}}
  <section class="fp-manifesto" id="manifeste">
    <div class="fp-manifesto-inner">
      <div class="fp-manifesto-eyebrow">Notre conviction</div>
      <blockquote>
        "Beaucoup de personnes proposent de l'aide aux autres,<br>
        <strong>alors qu'elles ont elles-mêmes besoin d'aide.</strong><br>
        On doit d'abord soigner ses blessures,<br>
        définir ses priorités,<br>
        <strong>se changer soi</strong> avant d'accompagner les autres à le faire."
      </blockquote>
      <p class="fp-manifesto-note">
        Ce Parcours n'est pas une formation ordinaire.<br>
        C'est avant tout <em>votre</em> propre transformation — profonde, réelle, incarnée.<br>
        Certains s'arrêtent là. Et c'est déjà immense.<br>
        D'autres continuent vers la certification Freelance — parce qu'on ne transmet que ce qu'on a traversé.
      </p>
    </div>
  </section>

  {{-- ══════════════════════════════════════════════════════ --}}
  {{-- CHIFFRES CLÉS                                          --}}
  {{-- ══════════════════════════════════════════════════════ --}}
  <section class="fp-keydata">
    <div class="fp-keydata-grid">
      <div class="fp-keydata-item">
        <div class="fp-keydata-number">8</div>
        <div class="fp-keydata-label">Semaines<br>en ligne</div>
      </div>
      <div class="fp-keydata-item">
        <div class="fp-keydata-number">6</div>
        <div class="fp-keydata-label">Modules<br>de transformation</div>
      </div>
      <div class="fp-keydata-item">
        <div class="fp-keydata-number">80%</div>
        <div class="fp-keydata-label">En ligne<br>à votre rythme</div>
      </div>
      <div class="fp-keydata-item">
        <div class="fp-keydata-number">20%</div>
        <div class="fp-keydata-label">En visio<br>2h groupe + 1h Q/R</div>
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
        <h2 class="fp-section-title light">À qui s'adresse ce parcours</h2>
        <p class="fp-section-sub">Pas de profil type. Pas de diplôme requis. Juste une envie sincère de vous retrouver — et d'abord vous-même.</p>
      </div>
      <div class="fp-forqui-grid">
        <div class="fp-forqui-card">
          <span class="fp-forqui-icon">🌿</span>
          <h4>Coach de vie, business, santé</h4>
          <p>Vos outils existants s'enrichissent d'une profondeur nouvelle. Le Rituel vient compléter votre pratique de l'intérieur.</p>
        </div>
        <div class="fp-forqui-card">
          <span class="fp-forqui-icon">🕊️</span>
          <h4>Accompagnateur spirituel ou pastoral</h4>
          <p>Le cadre laïco-spirituel du Rituel ouvre un espace de discernement rare, entre foi et développement personnel.</p>
        </div>
        <div class="fp-forqui-card">
          <span class="fp-forqui-icon">💼</span>
          <h4>Professionnel en reconversion</h4>
          <p>Vous traversez vous-même une transition. Le Parcours vous permet de transformer votre vécu en ressource unique.</p>
        </div>
        <div class="fp-forqui-card">
          <span class="fp-forqui-icon">🌱</span>
          <h4>Personne sans formation préalable</h4>
          <p>L'expérience de vie est un atout. Aucun diplôme requis. Votre authenticité et votre transformation sont la clé.</p>
        </div>
        <div class="fp-forqui-card">
          <span class="fp-forqui-icon">🎯</span>
          <h4>Thérapeute, Psychologue, Médecin</h4>
          <p>Vous ajoutez une dimension de clarté et de discernement holistique à votre accompagnement déjà structuré.</p>
        </div>
        <div class="fp-forqui-card">
          <span class="fp-forqui-icon">✨</span>
          <h4>Simplement vous, tel que vous êtes</h4>
          <p>Pas encore prêt·e à accompagner les autres ? Faites le Parcours pour vous. C'est déjà extraordinaire.</p>
        </div>
      </div>
    </div>
  </section>

  {{-- ══════════════════════════════════════════════════════ --}}
  {{-- MODULES EN LIGNE                                       --}}
  {{-- ══════════════════════════════════════════════════════ --}}
  <section class="fp-modules" id="programme">
    <div style="max-width:860px; margin:0 auto;">
      <div class="fp-modules-header">
        <h2 class="fp-section-title dark">Le parcours en ligne</h2>
        <p class="fp-section-sub dark">6 modules × 1 semaine — à votre rythme, profond et sans se presser.</p>
      </div>
      <div class="fp-module-list">

        <div class="fp-module-item">
          <div class="fp-module-num">01</div>
          <div class="fp-module-body">
            <div class="fp-module-week">Semaine 1</div>
            <h3>Je me rencontre</h3>
            <p>Qui êtes-vous vraiment, au-delà des rôles que vous jouez ? Déposer les masques, toucher le vrai.</p>
            <div class="fp-module-activities">
              <span class="fp-activity-tag"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18"/></svg> Tableau de visualisation (Vision Board)</span>
              <span class="fp-activity-tag"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z"/></svg> Lettre à moi-même dans 5 ans</span>
              <span class="fp-activity-tag"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg> Cartographie de mes valeurs</span>
            </div>
          </div>
        </div>

        <div class="fp-module-item">
          <div class="fp-module-num">02</div>
          <div class="fp-module-body">
            <div class="fp-module-week">Semaine 2</div>
            <h3>Je reconnais mes blessures</h3>
            <p>Ne pas les fuir, mais les regarder en face. Ce que vous avez traversé est votre ressource la plus précieuse.</p>
            <div class="fp-module-activities">
              <span class="fp-activity-tag"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg> Mon histoire à la 3ème personne</span>
              <span class="fp-activity-tag"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z"/></svg> Lettres de pardon (non envoyées)</span>
              <span class="fp-activity-tag"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></svg> Méditation guidée : Déposer les fardeaux</span>
            </div>
          </div>
        </div>

        <div class="fp-module-item">
          <div class="fp-module-num">03</div>
          <div class="fp-module-body">
            <div class="fp-module-week">Semaine 3</div>
            <h3>Je décris mon bonheur</h3>
            <p>Le vrai bonheur — pas celui des autres, pas celui des réseaux sociaux. Le vôtre, celui qui vous ressemble.</p>
            <div class="fp-module-activities">
              <span class="fp-activity-tag"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M14 9V5a3 3 0 00-3-3l-4 9v11h11.28a2 2 0 002-1.7l1.38-9a2 2 0 00-2-2.3H14z"/></svg> 100 choses qui me font du bien</span>
              <span class="fp-activity-tag"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg> Ma journée idéale minute par minute</span>
              <span class="fp-activity-tag"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 2a10 10 0 00-7.07 17.07M12 12l4-4"/></svg> La carte du bonheur (mind map)</span>
            </div>
          </div>
        </div>

        <div class="fp-module-item">
          <div class="fp-module-num">04</div>
          <div class="fp-module-body">
            <div class="fp-module-week">Semaine 4–5</div>
            <h3>J'écoute mon souffle intérieur</h3>
            <p>La respiration comme porte d'entrée vers soi. Apprendre à s'arrêter pour vraiment entendre.</p>
            <div class="fp-module-activities">
              <span class="fp-activity-tag"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></svg> Bain sonore guidé (Sound Bath) en ligne</span>
              <span class="fp-activity-tag"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg> Défi méditation du silence : 21 jours</span>
              <span class="fp-activity-tag"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 013 3L7 19l-4 1 1-4L16.5 3.5z"/></svg> Journal de bord hebdomadaire</span>
            </div>
          </div>
        </div>

        <div class="fp-module-item">
          <div class="fp-module-num">05</div>
          <div class="fp-module-body">
            <div class="fp-module-week">Semaine 6</div>
            <h3>Je découvre ma mission unique</h3>
            <p>À la croisée de votre histoire, de vos dons et du besoin du monde. Votre signature dans le monde.</p>
            <div class="fp-module-activities">
              <span class="fp-activity-tag"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg> "Tu es fait·e pour cela" — lecture guidée</span>
              <span class="fp-activity-tag"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg> Mon manifeste personnel (1 page)</span>
              <span class="fp-activity-tag"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18"/></svg> Ma vision board définitive</span>
            </div>
          </div>
        </div>

        <div class="fp-module-item">
          <div class="fp-module-num">06</div>
          <div class="fp-module-body">
            <div class="fp-module-week">Semaine 7–8</div>
            <h3>Je vis mon premier Rituel Pause Souffle</h3>
            <p>Expérimenter de l'intérieur. Ressentir avant de transmettre. Comprendre le Rituel en le vivant pleinement.</p>
            <div class="fp-module-activities">
              <span class="fp-activity-tag"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg> Session Pause Souffle vécue en groupe</span>
              <span class="fp-activity-tag"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></svg> Bénéficier d'une méditation guidée complète</span>
              <span class="fp-activity-tag"><svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg> Lettre de clôture à soi-même</span>
            </div>
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
        <h2 class="fp-section-title dark">Un parcours pensé pour votre transformation</h2>
        <p class="fp-section-sub dark">Pas de cours magistraux. De l'expérience vécue, du vivant, du concret.</p>
      </div>
      <div class="fp-pedagogy-split">
        <div class="fp-pedagogy-visual">
          <div style="font-size:0.75rem; letter-spacing:0.12em; text-transform:uppercase; color:var(--fp-text-soft); margin-bottom:1.75rem;">Répartition du temps</div>
          <div class="fp-pace-bar">
            <div class="fp-pace-bar-label"><span>En ligne — à votre rythme</span><span style="color:var(--fp-gold-dark)">80%</span></div>
            <div class="fp-pace-track"><div class="fp-pace-fill" style="width:80%"></div></div>
          </div>
          <div class="fp-pace-bar">
            <div class="fp-pace-bar-label"><span>En visio — 2h groupe + 1h clinique Q/R</span><span style="color:var(--fp-gold-dark)">20%</span></div>
            <div class="fp-pace-track"><div class="fp-pace-fill" style="width:20%"></div></div>
          </div>
          <div style="margin-top:2rem; padding-top:2rem; border-top:1px solid var(--fp-border);">
            <div style="font-size:0.875rem; color:var(--fp-text-soft); line-height:1.6;">
              Durée totale estimée :<br>
              <strong style="color:var(--fp-text);">8 semaines en ligne + 3h visio (2h groupe + 1h clinique Q/R)</strong>
            </div>
          </div>
        </div>
        <ul class="fp-pedagogy-list">
          <li><div class="fp-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6L9 17l-5-5"/></svg></div><span>Activités pratiques à réaliser sur soi — pas des exercices académiques</span></li>
          <li><div class="fp-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6L9 17l-5-5"/></svg></div><span>Méditations guidées audio incluses (bain sonore, méditation du silence, lâcher-prise)</span></li>
          <li><div class="fp-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6L9 17l-5-5"/></svg></div><span>Journaling hebdomadaire avec prompts profonds et bienveillants</span></li>
          <li><div class="fp-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6L9 17l-5-5"/></svg></div><span>Accès à la communauté Pause Souffle — un espace d'échange et de soutien partagé</span></li>
          <li><div class="fp-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6L9 17l-5-5"/></svg></div><span>Dimension spirituelle proposée, jamais imposée — chaque parcours est unique</span></li>
          <li><div class="fp-check"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6L9 17l-5-5"/></svg></div><span>Langue : français — sous-titrage possible selon les groupes</span></li>
        </ul>
      </div>
    </div>
  </section>

  {{-- ══════════════════════════════════════════════════════ --}}
  {{-- ATTESTATION RETOUR À SOI                              --}}
  {{-- ══════════════════════════════════════════════════════ --}}
  <section class="fp-certification" id="certification">
    <div class="fp-cert-inner">
      <div class="fp-cert-badge">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
          <circle cx="12" cy="8" r="7"/>
          <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/>
        </svg>
      </div>
      <h2 class="fp-cert-title">L'Attestation Retour à Soi</h2>
      <p class="fp-cert-text">
        À l'issue des 6 modules, vous recevez votre <strong>Attestation Retour à Soi</strong> — délivrée par Junspro.<br><br>
        Elle atteste que vous avez traversé le parcours dans sa profondeur :<br>
        présence aux sessions live, pratiques hebdomadaires, journaling complété.<br><br>
        Ce n'est pas un diplôme. C'est une reconnaissance de votre engagement envers vous-même.<br>
        Le début visible d'une transformation intérieure réelle.
      </p>
      <div class="fp-cert-warning" style="background:rgba(212,168,83,.08); border:1px solid rgba(212,168,83,.3); color:rgba(212,168,83,.9);">
        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
        </svg>
        Votre Attestation est le passeport vers la Retraite 7 jours et la Formation Freelance Pause Souffle.
      </div>
    </div>
  </section>

  {{-- ══════════════════════════════════════════════════════ --}}
  {{-- TARIF                                                  --}}
  {{-- ══════════════════════════════════════════════════════ --}}
  <section class="fp-pricing">
    <div class="fp-pricing-inner">
      <h2 class="fp-section-title dark" style="text-align:center;">Investissement</h2>
      <p class="fp-section-sub dark" style="text-align:center;">6 modules en ligne · Sessions live en groupe · Attestation Retour à Soi incluse.</p>
      <div style="text-align:center;">
        <div class="fp-pricing-card">
          <div class="fp-price-label">Le Parcours · Retour à Soi</div>
          <div class="fp-price-main"><span>€</span>3 490</div>
          <div class="fp-price-period">paiement unique · ou 3× 1 164 €/mois</div>
          <ul class="fp-price-includes">
            <li>6 modules en ligne — accès à vie, à votre rythme</li>
            <li>20% en visio : 2h en groupe + 1h clinique Q/R</li>
            <li>Méditations audio guidées, journaling, vision board</li>
            <li>Attestation Retour à Soi délivrée par Junspro</li>
            <li>Accès à la communauté Pause Souffle</li>
            <li>Passeport vers la Retraite 7 jours et la Formation Freelance</li>
          </ul>
          @auth
            <form method="POST" action="{{ route('presence.formation.checkout') }}" style="display:inline; width:100%">
              @csrf
              <input type="hidden" name="product_type" value="pause_parcours">
              <button type="submit" class="fp-btn-gold" style="width:100%; justify-content:center;">Payer en une fois — 3 490 €</button>
            </form>
          @else
            <a href="{{ route('user.login') }}?redirect={{ urlencode(route('presence.parcours')) }}" class="fp-btn-gold" style="width:100%; justify-content:center;">Payer en une fois — 3 490 €</a>
          @endauth
          @auth
            <form method="POST" action="{{ route('presence.formation.checkout.installment') }}" style="display:inline; width:100%; margin-top:.6rem;">
              @csrf
              <button type="submit" class="fp-btn-outline" style="width:100%; justify-content:center; margin-top:.6rem; color:rgba(232,224,208,.7); border-color:rgba(201,168,76,.4);">Payer en 3× 1 164 € / mois</button>
            </form>
          @else
            <a href="{{ route('user.login') }}?redirect={{ urlencode(route('presence.parcours')) }}" class="fp-btn-outline" style="width:100%; justify-content:center; margin-top:.6rem; color:rgba(232,224,208,.7); border-color:rgba(201,168,76,.4); text-align:center; display:block;">Payer en 3× 1 164 € / mois</a>
          @endauth
          <div style="margin-top:2rem; padding:1.25rem 1.5rem; background:rgba(212,168,83,.07); border:1px solid rgba(212,168,83,.2); border-radius:12px; text-align:left;">
            <div style="font-size:.72rem; letter-spacing:.15em; text-transform:uppercase; color:#D4A853; margin-bottom:.5rem;">Étape suivante · Après le Parcours</div>
            <div style="font-size:.9375rem; color:rgba(255,255,255,.7);">Formation Freelance Pause Souffle — <strong style="color:#fff;">3 490 €</strong> · 3× 1 164 €/mois</div>
            <div style="font-size:.8rem; color:rgba(255,255,255,.35); margin-top:.35rem;">Certification pour animer les Rituels · Accessible après obtention de l'Attestation</div>
            <a href="{{ route('presence.formation-praticien') }}" style="display:inline-block; margin-top:.75rem; font-size:.8rem; color:#D4A853; text-decoration:none;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">Découvrir la Formation Freelance →</a>
          </div>
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
        "Vous n'êtes pas ordinaire<br>
        parce que vous avez tout réussi.<br>
        Vous êtes extraordinaire<br>
        parce que <em>malgré tout</em>,<br>
        vous êtes encore là, debout,<br>
        avec l'envie d'aider."
      </blockquote>
      <div class="fp-promise-ref">— Fondement du Parcours · Pause Souffle</div>
    </div>
  </section>

  {{-- ══════════════════════════════════════════════════════ --}}
  {{-- CTA FINAL                                              --}}
  {{-- ══════════════════════════════════════════════════════ --}}
  <section class="fp-cta-section">
    <div class="fp-cta-inner">
      <h2>Prêt·e à commencer votre propre transformation ?</h2>
      <p>8 semaines. 6 modules. Une attestation qui ouvre toutes les portes.<br>Commencez par vous. Le reste vient après.</p>
      <div class="fp-cta-pair">
        @auth
          <form method="POST" action="{{ route('presence.formation.checkout') }}" style="display:inline">
            @csrf
            <input type="hidden" name="product_type" value="pause_parcours">
            <button type="submit" class="fp-btn-white">
              <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 12l5 5L20 7"/></svg>
              Démarrer mon parcours
            </button>
          </form>
        @else
          <a href="{{ route('user.login') }}?redirect={{ urlencode(route('presence.parcours')) }}" class="fp-btn-white">
            <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 12l5 5L20 7"/></svg>
            Démarrer mon parcours
          </a>
        @endauth
        <a href="{{ route('presence.pause-souffle') }}" class="fp-btn-outline-white">
          Découvrir le Rituel d'abord
        </a>
      </div>
    </div>
  </section>

</div>
@endsection
