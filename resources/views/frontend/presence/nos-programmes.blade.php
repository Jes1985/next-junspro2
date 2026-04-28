@extends('frontend.layout')

@section('pageHeading')
  Nos Programmes · Tarifs & Accès | {{ $websiteInfo->website_title }}
@endsection

@section('metaDescription')
  Découvrez tous les programmes Pause Souffle : 3 parcours de transformation personnelle, 2 formations professionnelles et des expériences immersives. Paiement unique ou en 4 cycles de 4 semaines.
@endsection

@section('style')
<style>
  /* ============================================
     PAGE NOS PROGRAMMES — PAUSE SOUFFLE
     ============================================ */

  :root {
    --np-gold:       #D4A853;
    --np-gold-dark:  #B8893A;
    --np-gold-light: #ECC97A;
    --np-dark:       #0D0D1A;
    --np-dark-2:     #111127;
    --np-dark-3:     #16162E;
    --np-text:       #1F2937;
    --np-text-soft:  #6B7280;
    --np-bg:         #FFFFFF;
    --np-bg-warm:    #FDFAF5;
    --np-border:     rgba(255,255,255,0.08);
    --np-border-gold: rgba(212,168,83,0.35);
  }

  .np-page { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; color: var(--np-text); background: var(--np-bg); -webkit-font-smoothing: antialiased; }

  /* ─── HERO ─── */
  .np-hero { position: relative; min-height: 72vh; display: flex; align-items: center; justify-content: center; background: var(--np-dark); overflow: hidden; text-align: center; padding: 130px 24px 100px; }
  .np-hero-bg { position: absolute; inset: 0; background: radial-gradient(ellipse 80% 50% at 50% 0%, rgba(212,168,83,0.10) 0%, transparent 55%), radial-gradient(ellipse 50% 40% at 15% 85%, rgba(37,99,235,0.06) 0%, transparent 50%), radial-gradient(ellipse 60% 40% at 85% 70%, rgba(212,168,83,0.07) 0%, transparent 50%); pointer-events: none; }
  .np-hero-particles { position: absolute; inset: 0; background-image: radial-gradient(1px 1px at 12% 18%, rgba(212,168,83,0.5) 0%, transparent 100%), radial-gradient(1px 1px at 28% 42%, rgba(255,255,255,0.15) 0%, transparent 100%), radial-gradient(1.5px 1.5px at 62% 22%, rgba(212,168,83,0.4) 0%, transparent 100%), radial-gradient(1px 1px at 75% 65%, rgba(255,255,255,0.12) 0%, transparent 100%), radial-gradient(2px 2px at 45% 55%, rgba(212,168,83,0.3) 0%, transparent 100%), radial-gradient(1px 1px at 88% 35%, rgba(255,255,255,0.18) 0%, transparent 100%); pointer-events: none; }
  .np-hero-label { display: inline-block; padding: 5px 20px; border: 1px solid var(--np-border-gold); border-radius: 40px; font-size: 0.7875rem; letter-spacing: 0.18em; text-transform: uppercase; color: var(--np-gold); margin-bottom: 2rem; position: relative; z-index: 1; }
  .np-hero-title { font-size: clamp(2.2rem, 5.5vw, 4rem); font-weight: 300; color: #fff; line-height: 1.15; letter-spacing: -0.03em; margin-bottom: 1.25rem; position: relative; z-index: 1; }
  .np-hero-title em { font-style: italic; color: var(--np-gold-light); }
  .np-hero-sub { font-size: clamp(1rem, 1.8vw, 1.2rem); color: rgba(255,255,255,0.55); line-height: 1.75; max-width: 560px; margin: 0 auto 3rem; position: relative; z-index: 1; }

  /* ─── TOGGLE PAIEMENT ─── */
  .np-toggle-wrap { position: relative; z-index: 1; display: flex; align-items: center; justify-content: center; }
  .np-toggle { display: inline-flex; background: rgba(255,255,255,0.06); border: 1px solid var(--np-border); border-radius: 50px; padding: 5px; gap: 4px; }
  .np-toggle-btn { padding: 10px 28px; border-radius: 40px; font-size: 0.9375rem; cursor: pointer; transition: all 0.3s; border: none; background: transparent; color: rgba(255,255,255,0.5); letter-spacing: 0.02em; }
  .np-toggle-btn.active { background: var(--np-gold); color: #fff; font-weight: 500; box-shadow: 0 4px 16px rgba(212,168,83,0.4); }
  .np-toggle-btn:hover:not(.active) { color: rgba(255,255,255,0.85); }

  /* ─── SECTION TITLES ─── */
  .np-section { padding: 100px 24px; }
  .np-section-dark { background: var(--np-dark); }
  .np-section-dark2 { background: var(--np-dark-2); }
  .np-section-warm { background: var(--np-bg-warm); }
  .np-section-white { background: #fff; }
  .np-section-header { text-align: center; margin-bottom: 64px; }
  .np-section-badge { display: inline-block; padding: 4px 16px; border: 1px solid var(--np-border-gold); border-radius: 40px; font-size: 0.7rem; letter-spacing: 0.18em; text-transform: uppercase; color: var(--np-gold); margin-bottom: 1.25rem; }
  .np-section-title-light { font-size: clamp(1.7rem, 3vw, 2.5rem); font-weight: 300; color: #fff; letter-spacing: -0.02em; line-height: 1.2; margin-bottom: 0.75rem; }
  .np-section-title-dark { font-size: clamp(1.7rem, 3vw, 2.5rem); font-weight: 300; color: var(--np-text); letter-spacing: -0.02em; line-height: 1.2; margin-bottom: 0.75rem; }
  .np-section-desc-light { font-size: 1rem; color: rgba(255,255,255,0.45); line-height: 1.7; max-width: 520px; margin: 0 auto; }
  .np-section-desc-dark { font-size: 1rem; color: var(--np-text-soft); line-height: 1.7; max-width: 520px; margin: 0 auto; }

  /* ─── CARDS PARCOURS ─── */
  .np-parcours-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; max-width: 1140px; margin: 0 auto; }
  @media (max-width: 900px) { .np-parcours-grid { grid-template-columns: 1fr; max-width: 480px; } }

  .np-card { background: rgba(255,255,255,0.03); border: 1px solid var(--np-border); border-radius: 20px; overflow: hidden; display: flex; flex-direction: column; transition: transform 0.3s, box-shadow 0.3s, border-color 0.3s; }
  .np-card:hover { transform: translateY(-6px); box-shadow: 0 24px 60px rgba(0,0,0,0.4); border-color: var(--np-border-gold); }
  .np-card.featured { border-color: var(--np-border-gold); box-shadow: 0 0 0 1px rgba(212,168,83,0.2), 0 16px 48px rgba(0,0,0,0.3); }

  .np-card-top { padding: 36px 32px 28px; flex: 1; }
  .np-card-label { font-size: 0.6875rem; letter-spacing: 0.18em; text-transform: uppercase; color: var(--np-gold); margin-bottom: 0.5rem; }
  .np-card-badge { display: inline-block; font-size: 0.6875rem; padding: 3px 12px; border-radius: 20px; background: rgba(212,168,83,0.12); color: var(--np-gold); border: 1px solid rgba(212,168,83,0.2); margin-bottom: 1.25rem; }
  .np-card-badge.highlight { background: rgba(212,168,83,0.2); border-color: rgba(212,168,83,0.4); }
  .np-card-title { font-size: 1.375rem; font-weight: 300; color: #fff; letter-spacing: -0.02em; line-height: 1.3; margin-bottom: 0.5rem; }
  .np-card-sub { font-size: 0.875rem; color: rgba(255,255,255,0.45); margin-bottom: 1.5rem; line-height: 1.5; }
  .np-card-cert { display: inline-flex; align-items: center; gap: 6px; font-size: 0.8125rem; color: var(--np-gold); margin-bottom: 1.75rem; }
  .np-card-cert svg { width: 14px; height: 14px; stroke: var(--np-gold); }

  .np-features { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 10px; }
  .np-features li { display: flex; align-items: flex-start; gap: 10px; font-size: 0.875rem; color: rgba(255,255,255,0.65); line-height: 1.5; }
  .np-features li::before { content: ''; display: block; width: 16px; height: 16px; border-radius: 50%; background: rgba(212,168,83,0.15); border: 1px solid rgba(212,168,83,0.3); flex-shrink: 0; margin-top: 2px; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='none'%3E%3Cpath d='M4 8.5l2.5 2.5 5.5-5.5' stroke='%23D4A853' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E"); background-size: 100%; }

  .np-card-footer { padding: 24px 32px; border-top: 1px solid var(--np-border); }
  .np-price-wrap { margin-bottom: 16px; }
  .np-price-label { font-size: 0.75rem; letter-spacing: 0.1em; text-transform: uppercase; color: rgba(255,255,255,0.35); margin-bottom: 4px; }
  .np-price-once { display: flex; align-items: baseline; gap: 4px; }
  .np-price-once .amount { font-size: 2.125rem; font-weight: 300; color: #fff; letter-spacing: -0.03em; }
  .np-price-once .currency { font-size: 1.125rem; color: rgba(255,255,255,0.5); }
  .np-price-installment { display: none; flex-direction: column; gap: 2px; }
  .np-price-installment .amount { font-size: 1.875rem; font-weight: 300; color: #fff; letter-spacing: -0.02em; }
  .np-price-installment .detail { font-size: 0.8125rem; color: rgba(255,255,255,0.4); }
  .np-price-installment .total { font-size: 0.8125rem; color: var(--np-gold); }

  .np-cta-primary { display: block; text-align: center; padding: 14px 24px; background: linear-gradient(135deg, #D4A853 0%, #B8893A 100%); color: #fff; border-radius: 50px; font-size: 0.9375rem; font-weight: 500; text-decoration: none; transition: all 0.3s; border: none; cursor: pointer; width: 100%; box-shadow: 0 6px 20px rgba(212,168,83,0.3); }
  .np-cta-primary:hover { transform: translateY(-2px); box-shadow: 0 10px 28px rgba(212,168,83,0.45); color: #fff; text-decoration: none; }
  .np-cta-secondary { display: block; text-align: center; padding: 14px 24px; background: transparent; color: rgba(255,255,255,0.65); border-radius: 50px; font-size: 0.9375rem; text-decoration: none; transition: all 0.3s; border: 1px solid rgba(255,255,255,0.15); cursor: pointer; width: 100%; margin-top: 10px; }
  .np-cta-secondary:hover { border-color: var(--np-gold); color: var(--np-gold); text-decoration: none; }

  /* mode installment — géré par JS */
  .np-price-installment { display: none; }
  .np-cta-cycle { display: none; }

  /* ─── PACK INTEGRAL BANNER ─── */
  .np-pack-banner { max-width: 900px; margin: 56px auto 0; padding: 40px 48px; background: linear-gradient(135deg, rgba(212,168,83,0.08) 0%, rgba(212,168,83,0.03) 100%); border: 1px solid var(--np-border-gold); border-radius: 20px; display: flex; align-items: center; gap: 32px; }
  @media (max-width: 720px) { .np-pack-banner { flex-direction: column; padding: 32px 24px; text-align: center; } }
  .np-pack-badge { display: inline-block; padding: 5px 14px; background: var(--np-gold); color: #fff; border-radius: 20px; font-size: 0.6875rem; letter-spacing: 0.12em; text-transform: uppercase; font-weight: 600; white-space: nowrap; }
  .np-pack-text { flex: 1; }
  .np-pack-text h3 { font-size: 1.25rem; font-weight: 400; color: #fff; margin-bottom: 6px; }
  .np-pack-text p { font-size: 0.9rem; color: rgba(255,255,255,0.5); margin: 0; line-height: 1.6; }
  .np-pack-price-col { text-align: right; flex-shrink: 0; }
  .np-pack-price-col .pack-once .amount { font-size: 1.75rem; font-weight: 300; color: var(--np-gold); }
  .np-pack-price-col .pack-once .old { font-size: 0.875rem; color: rgba(255,255,255,0.3); text-decoration: line-through; display: block; margin-bottom: 2px; }
  .np-pack-price-col .pack-installment { display: none; }
  .np-pack-price-col .pack-installment .amount { font-size: 1.5rem; font-weight: 300; color: var(--np-gold); }
  .np-pack-price-col .pack-installment .detail { font-size: 0.8125rem; color: rgba(255,255,255,0.4); }
  /* Toggle pack — géré par JS */
  .pack-installment { display: none; }
  .np-pack-cta { margin-top: 12px; }
  @media (max-width: 720px) { .np-pack-price-col { text-align: center; } }

  /* ─── FORMATIONS PRO ─── */
  .np-pro-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem; max-width: 900px; margin: 0 auto; }
  @media (max-width: 680px) { .np-pro-grid { grid-template-columns: 1fr; max-width: 480px; } }

  .np-pro-card { background: rgba(255,255,255,0.035); border: 1px solid rgba(255,255,255,0.07); border-radius: 20px; overflow: hidden; transition: all 0.3s; }
  .np-pro-card:hover { border-color: var(--np-border-gold); transform: translateY(-4px); box-shadow: 0 20px 48px rgba(0,0,0,0.35); }
  .np-pro-card-inner { padding: 36px; }
  .np-pro-tag { font-size: 0.6875rem; letter-spacing: 0.18em; text-transform: uppercase; color: var(--np-gold); margin-bottom: 1rem; }
  .np-pro-card-title { font-size: 1.3125rem; font-weight: 300; color: #fff; letter-spacing: -0.02em; margin-bottom: 0.5rem; line-height: 1.3; }
  .np-pro-card-sub { font-size: 0.875rem; color: rgba(255,255,255,0.45); line-height: 1.6; margin-bottom: 1.5rem; }
  .np-pro-features { list-style: none; padding: 0; margin: 0 0 2rem; display: flex; flex-direction: column; gap: 9px; }
  .np-pro-features li { font-size: 0.875rem; color: rgba(255,255,255,0.6); display: flex; gap: 9px; align-items: flex-start; }
  .np-pro-features li::before { content: '◆'; font-size: 0.5rem; color: var(--np-gold); flex-shrink: 0; margin-top: 5px; }
  .np-pro-price-wrap { border-top: 1px solid rgba(255,255,255,0.07); padding-top: 24px; display: flex; align-items: flex-end; justify-content: space-between; gap: 16px; flex-wrap: wrap; }
  .np-pro-price .label { font-size: 0.75rem; letter-spacing: 0.08em; text-transform: uppercase; color: rgba(255,255,255,0.3); margin-bottom: 4px; }
  .np-pro-price .amount { font-size: 1.875rem; font-weight: 300; color: #fff; letter-spacing: -0.02em; }
  .np-pro-price .amount span { font-size: 1rem; }
  /* Toggle pros — géré par JS */
  .np-pro-price-installment { display: none; }
  .np-pro-cta-cycle { display: none; }

  /* ─── CARTES EXPÉRIENCES (petits programmes) ─── */
  .np-exp-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem; max-width: 900px; margin: 0 auto; }
  @media (max-width: 680px) { .np-exp-grid { grid-template-columns: 1fr; max-width: 480px; } }

  .np-exp-card { background: #fff; border: 1px solid #E5E7EB; border-radius: 20px; padding: 36px; transition: all 0.3s; }
  .np-exp-card:hover { border-color: #D4A853; transform: translateY(-4px); box-shadow: 0 16px 40px rgba(0,0,0,0.08); }
  .np-exp-tag { font-size: 0.6875rem; letter-spacing: 0.18em; text-transform: uppercase; color: var(--np-gold-dark); margin-bottom: 1rem; }
  .np-exp-title { font-size: 1.25rem; font-weight: 400; color: var(--np-text); letter-spacing: -0.02em; margin-bottom: 0.5rem; }
  .np-exp-desc { font-size: 0.9rem; color: var(--np-text-soft); line-height: 1.65; margin-bottom: 1.75rem; }
  .np-exp-price .amount { font-size: 2rem; font-weight: 300; color: var(--np-text); letter-spacing: -0.03em; }
  .np-exp-price .sub { font-size: 0.875rem; color: var(--np-text-soft); margin-top: 3px; }
  .np-exp-cta { display: inline-flex; align-items: center; gap: 8px; padding: 12px 24px; background: linear-gradient(135deg, #D4A853, #B8893A); color: #fff; border-radius: 50px; font-size: 0.875rem; font-weight: 500; text-decoration: none; transition: all 0.3s; margin-top: 20px; }
  .np-exp-cta:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(212,168,83,0.35); color: #fff; text-decoration: none; }
  .np-exp-cta-outline { display: inline-flex; align-items: center; gap: 8px; padding: 12px 24px; border: 1.5px solid #D4A853; color: #B8893A; border-radius: 50px; font-size: 0.875rem; text-decoration: none; transition: all 0.3s; margin-top: 20px; }
  .np-exp-cta-outline:hover { background: #D4A853; color: #fff; text-decoration: none; }

  /* Toggle prix exp-cards */
  .np-exp-price-install { display: none; }
  body.installment-mode .np-exp-price-once { display: none; }
  body.installment-mode .np-exp-price-install { display: block; }
  .np-exp-price-install .amount { font-size: 1.875rem; font-weight: 300; color: var(--np-text); letter-spacing: -0.03em; }
  .np-exp-price-install .detail { font-size: 0.875rem; color: var(--np-text-soft); margin-top: 3px; }
  .np-exp-price-install .total { font-size: 0.8125rem; color: var(--np-gold-dark); margin-top: 2px; }

  /* ─── GARANTIE & CONFIANCE ─── */
  .np-trust { padding: 80px 24px; background: var(--np-dark); border-top: 1px solid rgba(212,168,83,0.1); }
  .np-trust-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1px; max-width: 900px; margin: 0 auto; background: rgba(255,255,255,0.06); border-radius: 16px; overflow: hidden; }
  @media (max-width: 680px) { .np-trust-grid { grid-template-columns: 1fr; } }
  .np-trust-item { background: var(--np-dark-2); padding: 36px 28px; text-align: center; }
  .np-trust-icon { font-size: 1.75rem; margin-bottom: 1rem; }
  .np-trust-title { font-size: 0.9375rem; font-weight: 500; color: #fff; margin-bottom: 0.5rem; }
  .np-trust-desc { font-size: 0.875rem; color: rgba(255,255,255,0.45); line-height: 1.6; }

  /* ─── FAQ ─── */
  .np-faq { padding: 100px 24px; background: var(--np-bg-warm); }
  .np-faq-list { max-width: 720px; margin: 0 auto; display: flex; flex-direction: column; gap: 1px; background: #E5E7EB; border-radius: 16px; overflow: hidden; }
  .np-faq-item { background: #fff; }
  .np-faq-q { padding: 22px 28px; cursor: pointer; display: flex; justify-content: space-between; align-items: center; font-size: 0.9375rem; color: var(--np-text); font-weight: 500; transition: color 0.2s; list-style: none; user-select: none; }
  .np-faq-q:hover { color: var(--np-gold-dark); }
  .np-faq-q svg { width: 18px; height: 18px; stroke: currentColor; transition: transform 0.3s; flex-shrink: 0; }
  .np-faq-item.open .np-faq-q svg { transform: rotate(180deg); }
  .np-faq-a { max-height: 0; overflow: hidden; transition: max-height 0.4s ease, padding 0.3s ease; }
  .np-faq-item.open .np-faq-a { max-height: 300px; }
  .np-faq-a-inner { padding: 0 28px 22px; font-size: 0.9rem; color: var(--np-text-soft); line-height: 1.75; }

  /* ─── CTA FINAL ─── */
  .np-final-cta { padding: 120px 24px; background: var(--np-dark); text-align: center; }
  .np-final-cta-inner { max-width: 640px; margin: 0 auto; }
  .np-final-cta h2 { font-size: clamp(1.75rem, 3.5vw, 2.75rem); font-weight: 300; color: #fff; letter-spacing: -0.03em; margin-bottom: 1rem; line-height: 1.2; }
  .np-final-cta h2 em { font-style: italic; color: var(--np-gold-light); }
  .np-final-cta p { font-size: 1rem; color: rgba(255,255,255,0.45); line-height: 1.7; margin-bottom: 2.5rem; }
  .np-final-cta-btns { display: flex; flex-wrap: wrap; gap: 1rem; justify-content: center; }
  .np-btn-gold { display: inline-flex; align-items: center; gap: 8px; padding: 1rem 2.5rem; background: linear-gradient(135deg, #D4A853 0%, #B8893A 100%); color: #fff; border-radius: 50px; font-size: 1rem; font-weight: 500; text-decoration: none; transition: all 0.3s; box-shadow: 0 8px 24px rgba(212,168,83,0.3); }
  .np-btn-gold:hover { transform: translateY(-3px); box-shadow: 0 14px 36px rgba(212,168,83,0.45); color: #fff; text-decoration: none; }
  .np-btn-outline { display: inline-flex; align-items: center; gap: 8px; padding: 1rem 2.5rem; border: 1px solid rgba(255,255,255,0.2); color: rgba(255,255,255,0.7); border-radius: 50px; font-size: 1rem; text-decoration: none; transition: all 0.3s; }
  .np-btn-outline:hover { border-color: var(--np-gold); color: var(--np-gold); text-decoration: none; }
</style>
@endsection

@section('content')
<div class="np-page">

  {{-- ═══════════════════════════════════ HERO ═══════════════════════════════════ --}}
  <section class="np-hero">
    <div class="np-hero-bg"></div>
    <div class="np-hero-particles"></div>
    <div style="position:relative;z-index:1;width:100%;max-width:760px;margin:0 auto;">
      <div class="np-hero-label">Programmes & Tarifs</div>
      <h1 class="np-hero-title">
        Chaque programme<br><em>est une décision</em>
      </h1>
      <p class="np-hero-sub">
        Trois parcours de transformation, deux formations professionnelles, des expériences immersives.<br>
        Un seul fil conducteur : revenir à soi, construire quelque chose de durable.
      </p>
      {{-- TOGGLE --}}
      <div class="np-toggle-wrap">
        <div class="np-toggle" id="npPayToggle">
          <button class="np-toggle-btn active" data-mode="once" type="button">Paiement unique</button>
          <button class="np-toggle-btn" data-mode="installment" type="button">4 cycles · 4 semaines</button>
        </div>
      </div>
    </div>
  </section>

  {{-- ═══════════════════════════════ 3 PARCOURS ════════════════════════════════ --}}
  <section class="np-section np-section-dark">
    <div class="np-section-header">
      <div class="np-section-badge">Le Parcours</div>
      <h2 class="np-section-title-light">Transformation personnelle<br><em style="font-style:italic;color:rgba(212,168,83,0.85)">en trois étapes progressives</em></h2>
      <p class="np-section-desc-light">Chaque étape s'appuie sur la précédente. Vous pouvez commencer par la première, ou rejoindre directement l'étape qui correspond à votre niveau.</p>
    </div>

    <div class="np-parcours-grid">

      {{-- PARCOURS 1 --}}
      <div class="np-card">
        <div class="np-card-top">
          <div class="np-card-label">Étape 1</div>
          <div class="np-card-badge">Certification Niveau 1 · Éveil</div>
          <h3 class="np-card-title">Se Retrouver</h3>
          <p class="np-card-sub">Présence &amp; Souffle · 10 modules</p>
          <div class="np-card-cert">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="1.5" stroke-linecap="round">
              <circle cx="12" cy="8" r="6"/><path d="M8 14l-2 8 6-3 6 3-2-8"/>
            </svg>
            Attestation de fin de parcours délivrée
          </div>
          <ul class="np-features">
            <li>10 modules en accès illimité</li>
            <li>Rituels corps complet guidés par audio</li>
            <li>Espace membre personnel sécurisé</li>
            <li>Suivi de progression pas à pas</li>
            <li>Attestation Pause Souffle Niveau 1</li>
          </ul>
        </div>
        <div class="np-card-footer">
          <div class="np-price-wrap">
            <p class="np-price-label">À partir de</p>
            <div class="np-price-once">
              <span class="amount">2&nbsp;190</span>
              <span class="currency">€</span>
            </div>
            <div class="np-price-installment">
              <span class="amount">547,50 <span style="font-size:1.1rem">€</span></span>
              <span class="detail">par cycle · 4 versements × 4 semaines</span>
              <span class="total">Total : 2 190 €</span>
            </div>
          </div>
          @auth
            <form method="POST" action="{{ route('parcours.checkout.niveau1') }}" class="np-cta-once">
              @csrf
              <button type="submit" class="np-cta-primary">Commencer le Parcours 1</button>
            </form>
            <form method="POST" action="{{ route('parcours.checkout.niveau1.installment') }}" class="np-cta-cycle" style="display:none">
              @csrf
              <button type="submit" class="np-cta-primary">4 × 547,50 € · cycle de 4 semaines</button>
            </form>
          @else
            <a href="{{ route('login') }}?redirect={{ urlencode(route('presence.nos-programmes')) }}" class="np-cta-primary np-cta-once">Commencer le Parcours 1</a>
            <a href="{{ route('login') }}?redirect={{ urlencode(route('presence.nos-programmes')) }}" class="np-cta-primary np-cta-cycle" style="display:none">4 × 547,50 € · cycle de 4 semaines</a>
          @endauth
          <a href="{{ route('presence.parcours') }}" class="np-cta-secondary">En savoir plus →</a>
        </div>
      </div>

      {{-- PARCOURS 2 --}}
      <div class="np-card featured">
        <div class="np-card-top">
          <div class="np-card-label">Étape 2</div>
          <div class="np-card-badge highlight">Certification Niveau 2 · Ancrage</div>
          <h3 class="np-card-title">Se Construire</h3>
          <p class="np-card-sub">Corps, Énergie &amp; Discipline · 13 modules</p>
          <div class="np-card-cert">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="1.5" stroke-linecap="round">
              <circle cx="12" cy="8" r="6"/><path d="M8 14l-2 8 6-3 6 3-2-8"/>
            </svg>
            Attestation de fin de parcours délivrée
          </div>
          <ul class="np-features">
            <li>13 modules en accès illimité</li>
            <li>Approfondissement corps &amp; énergie</li>
            <li>Rituel personnel approfondi</li>
            <li>Espace membre personnel sécurisé</li>
            <li>Attestation Pause Souffle Niveau 2</li>
          </ul>
        </div>
        <div class="np-card-footer">
          <div class="np-price-wrap">
            <p class="np-price-label">À partir de</p>
            <div class="np-price-once">
              <span class="amount">2&nbsp;490</span>
              <span class="currency">€</span>
            </div>
            <div class="np-price-installment">
              <span class="amount">622,50 <span style="font-size:1.1rem">€</span></span>
              <span class="detail">par cycle · 4 versements × 4 semaines</span>
              <span class="total">Total : 2 490 €</span>
            </div>
          </div>
          @auth
            <form method="POST" action="{{ route('parcours.checkout.niveau2') }}" class="np-cta-once">
              @csrf
              <button type="submit" class="np-cta-primary">Commencer le Parcours 2</button>
            </form>
            <form method="POST" action="{{ route('parcours.checkout.niveau2.installment') }}" class="np-cta-cycle" style="display:none">
              @csrf
              <button type="submit" class="np-cta-primary">4 × 622,50 € · cycle de 4 semaines</button>
            </form>
          @else
            <a href="{{ route('login') }}?redirect={{ urlencode(route('presence.nos-programmes')) }}" class="np-cta-primary np-cta-once">Commencer le Parcours 2</a>
            <a href="{{ route('login') }}?redirect={{ urlencode(route('presence.nos-programmes')) }}" class="np-cta-primary np-cta-cycle" style="display:none">4 × 622,50 € · cycle de 4 semaines</a>
          @endauth
          <a href="{{ route('presence.parcours') }}" class="np-cta-secondary">En savoir plus →</a>
        </div>
      </div>

      {{-- PARCOURS 3 --}}
      <div class="np-card">
        <div class="np-card-top">
          <div class="np-card-label">Étape 3</div>
          <div class="np-card-badge">Certification Niveau 3 · Maîtrise</div>
          <h3 class="np-card-title">S'Ouvrir</h3>
          <p class="np-card-sub">Relations, Sens &amp; Rayonnement · 16 modules</p>
          <div class="np-card-cert">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="1.5" stroke-linecap="round">
              <circle cx="12" cy="8" r="6"/><path d="M8 14l-2 8 6-3 6 3-2-8"/>
            </svg>
            Attestation de fin de parcours délivrée
          </div>
          <ul class="np-features">
            <li>16 modules en accès illimité</li>
            <li>Relations, présence &amp; rayonnement</li>
            <li>Module intégration identitaire</li>
            <li>Espace membre personnel sécurisé</li>
            <li>Attestation Pause Souffle Niveau 3</li>
          </ul>
        </div>
        <div class="np-card-footer">
          <div class="np-price-wrap">
            <p class="np-price-label">À partir de</p>
            <div class="np-price-once">
              <span class="amount">2&nbsp;990</span>
              <span class="currency">€</span>
            </div>
            <div class="np-price-installment">
              <span class="amount">747,50 <span style="font-size:1.1rem">€</span></span>
              <span class="detail">par cycle · 4 versements × 4 semaines</span>
              <span class="total">Total : 2 990 €</span>
            </div>
          </div>
          @auth
            <form method="POST" action="{{ route('parcours.checkout.niveau3') }}" class="np-cta-once">
              @csrf
              <button type="submit" class="np-cta-primary">Commencer le Parcours 3</button>
            </form>
            <form method="POST" action="{{ route('parcours.checkout.niveau3.installment') }}" class="np-cta-cycle" style="display:none">
              @csrf
              <button type="submit" class="np-cta-primary">4 × 747,50 € · cycle de 4 semaines</button>
            </form>
          @else
            <a href="{{ route('login') }}?redirect={{ urlencode(route('presence.nos-programmes')) }}" class="np-cta-primary np-cta-once">Commencer le Parcours 3</a>
            <a href="{{ route('login') }}?redirect={{ urlencode(route('presence.nos-programmes')) }}" class="np-cta-primary np-cta-cycle" style="display:none">4 × 747,50 € · cycle de 4 semaines</a>
          @endauth
          <a href="{{ route('presence.parcours') }}" class="np-cta-secondary">En savoir plus →</a>
        </div>
      </div>

    </div>

    {{-- PACK INTÉGRAL --}}
    <div class="np-pack-banner">
      <div class="np-pack-badge">Meilleure valeur</div>
      <div class="np-pack-text">
        <h3>Pack Intégral · Les 3 Étapes</h3>
        <p>Accès immédiat aux 3 parcours complets (39 modules) · Certifications Niveaux 1, 2 &amp; 3 · Remise exclusive</p>
      </div>
      <div class="np-pack-price-col">
        <div class="pack-once">
          <span class="old">7 670 €</span>
          <span class="amount">6&nbsp;390 <span style="font-size:1rem;color:rgba(212,168,83,0.7)">€</span></span>
        </div>
        <div class="pack-installment">
          <span class="amount">1&nbsp;597,50 <span style="font-size:1rem;color:rgba(212,168,83,0.7)">€</span></span>
          <div class="detail">× 4 cycles de 4 semaines · Total 6 390 €</div>
        </div>
        <div class="np-pack-cta">
          @auth
            <form method="POST" action="{{ route('parcours.checkout.pack-integral') }}" style="margin-bottom:8px" class="np-cta-pack-once">
              @csrf
              <button type="submit" class="np-cta-primary" style="white-space:nowrap">Accéder au Pack Intégral</button>
            </form>
            <form method="POST" action="{{ route('parcours.checkout.pack-integral.installment') }}" class="np-cta-pack-cycle" style="display:none">
              @csrf
              <button type="submit" class="np-cta-secondary" style="white-space:nowrap;margin-top:0;border-color:rgba(212,168,83,0.35)">4 × 1 597,50 € · cycle de 4 semaines</button>
            </form>
          @else
            <a href="{{ route('login') }}?redirect={{ urlencode(route('presence.nos-programmes')) }}" class="np-cta-primary np-cta-pack-once" style="display:block;text-align:center;padding:12px 24px;white-space:nowrap">Accéder au Pack Intégral</a>
            <a href="{{ route('login') }}?redirect={{ urlencode(route('presence.nos-programmes')) }}" class="np-cta-secondary np-cta-pack-cycle" style="display:none;text-align:center;margin-top:8px;white-space:nowrap">4 × 1 597,50 € · cycle de 4 semaines</a>
          @endauth
        </div>
      </div>
    </div>

  </section>

    {{-- ═══════════════════════════ FORMATIONS PRO ════════════════════════════════ --}}
  <section class="np-section np-section-dark2">
    <div class="np-section-header">
      <div class="np-section-badge">Formations Professionnelles</div>
      <h2 class="np-section-title-light">Transmettez ce que vous avez vécu</h2>
      <p class="np-section-desc-light">Pour celles et ceux qui souhaitent intégrer les outils Pause Souffle dans leur pratique professionnelle ou humaine.</p>
    </div>

    <div class="np-parcours-grid" style="grid-template-columns:repeat(2,1fr);max-width:760px;">

      {{-- PRATICIEN --}}
      <div class="np-card">
        <div class="np-card-top">
          <div class="np-card-label">Formation Certifiante</div>
          <div class="np-card-badge">Praticien · Niveau Avancé</div>
          <h3 class="np-card-title">Formation Praticien<br>Pause Souffle</h3>
          <p class="np-card-sub">Modules en ligne + Week-end immersif 3 jours</p>
          <div class="np-card-cert">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="1.5" stroke-linecap="round">
              <circle cx="12" cy="8" r="6"/><path d="M8 14l-2 8 6-3 6 3-2-8"/>
            </svg>
            Attestation Junspro délivrée
          </div>
          <ul class="np-features">
            <li>Modules en ligne + Week-end immersif 3 jours</li>
            <li>Techniques d'animation groupe &amp; individuel</li>
            <li>Attestation Junspro délivrée</li>
            <li>Accès aux outils pédagogiques officiels</li>
            <li>Prérequis : avoir suivi Le Parcours</li>
          </ul>
        </div>
        <div class="np-card-footer">
          <div class="np-price-wrap">
            <p class="np-price-label">Formation complète</p>
            <div class="np-price-once">
              <span class="amount">3&nbsp;490</span>
              <span class="currency">€</span>
            </div>
            <div class="np-price-installment">
              <span class="amount">872,50 <span style="font-size:1.1rem">€</span></span>
              <span class="detail">par cycle · 4 versements × 4 semaines</span>
              <span class="total">Total : 3 490 €</span>
            </div>
          </div>
          @auth
            <form method="POST" action="{{ route('presence.formation.checkout') }}" class="np-cta-once">
              @csrf
              <input type="hidden" name="product_type" value="pause_freelance">
              <button type="submit" class="np-cta-primary">Accéder à la formation</button>
            </form>
            <form method="POST" action="{{ route('presence.formation.checkout.installment') }}" class="np-cta-cycle" style="display:none">
              @csrf
              <input type="hidden" name="product_type" value="pause_freelance">
              <button type="submit" class="np-cta-primary">4 × 872,50 € · cycle de 4 semaines</button>
            </form>
          @else
            <a href="{{ route('login') }}?redirect={{ urlencode(route('presence.nos-programmes')) }}" class="np-cta-primary np-cta-once">Accéder à la formation</a>
            <a href="{{ route('login') }}?redirect={{ urlencode(route('presence.nos-programmes')) }}" class="np-cta-primary np-cta-cycle" style="display:none">4 × 872,50 € · cycle de 4 semaines</a>
          @endauth
        </div>
      </div>

      {{-- MENTORS --}}
      <div class="np-card">
        <div class="np-card-top">
          <div class="np-card-label">Transmission · Formation</div>
          <div class="np-card-badge">Mentors · Habilitation Formateur</div>
          <h3 class="np-card-title">Formation<br>des Mentors</h3>
          <p class="np-card-sub">Former et accompagner d'autres praticiens · habilitation officielle délivrée</p>
          <div class="np-card-cert">
            <svg viewBox="0 0 24 24" fill="none" stroke-width="1.5" stroke-linecap="round">
              <circle cx="12" cy="8" r="6"/><path d="M8 14l-2 8 6-3 6 3-2-8"/>
            </svg>
            Habilitation Formateur officielle
          </div>
          <ul class="np-features">
            <li>Former et accompagner d'autres praticiens</li>
            <li>Animer des groupes Pause Souffle</li>
            <li>Habilitation Formateur officielle</li>
            <li>Accès aux ressources Mentor officielles</li>
            <li>Prérequis : Formation Praticien validée</li>
          </ul>
        </div>
        <div class="np-card-footer">
          <div class="np-price-wrap">
            <p class="np-price-label">Formation complète</p>
            <div class="np-price-once">
              <span class="amount">3&nbsp;500</span>
              <span class="currency">€</span>
            </div>
            <div class="np-price-installment">
              <span class="amount">875 <span style="font-size:1.1rem">€</span></span>
              <span class="detail">par cycle · 4 versements × 4 semaines</span>
              <span class="total">Total : 3 500 €</span>
            </div>
          </div>
          @auth
            <form method="POST" action="{{ route('presence.mentors.checkout') }}" class="np-cta-once">
              @csrf
              <button type="submit" class="np-cta-primary">S'inscrire à la formation</button>
            </form>
            <form method="POST" action="{{ route('presence.mentors.checkout.installment') }}" class="np-cta-cycle" style="display:none">
              @csrf
              <button type="submit" class="np-cta-primary">4 × 875 € · cycle de 4 semaines</button>
            </form>
          @else
            <a href="{{ route('login') }}?redirect={{ urlencode(route('presence.nos-programmes')) }}" class="np-cta-primary np-cta-once">S'inscrire à la formation</a>
            <a href="{{ route('login') }}?redirect={{ urlencode(route('presence.nos-programmes')) }}" class="np-cta-primary np-cta-cycle" style="display:none">4 × 875 € · cycle de 4 semaines</a>
          @endauth
        </div>
      </div>

    </div>
  </section>

  {{-- ═══════════════════════════ EXPÉRIENCES ════════════════════════════════ --}}
  <section class="np-section np-section-dark2">
    <div class="np-section-header">
      <div class="np-section-badge">Expériences</div>
      <h2 class="np-section-title-light">Une entrée en douceur,<br><em style="font-style:italic;color:rgba(212,168,83,0.85)">ou un plongeon complet</em></h2>
      <p class="np-section-desc-light">Des formats courts et immersifs pour vous permettre de vivre l'expérience Pause Souffle à votre rythme.</p>
    </div>

    <div class="np-parcours-grid" style="grid-template-columns:repeat(2,1fr);max-width:760px;">

      {{-- MA PAUSE SOUFFLE --}}
      <div class="np-card">
        <div class="np-card-top">
          <div class="np-card-label">Indépendant · Votre univers</div>
          <div class="np-card-badge">Programme court · 5 modules</div>
          <h3 class="np-card-title">Ma Pause Souffle<br><span style="font-weight:300;font-size:0.95rem">dans votre univers</span></h3>
          <p class="np-card-sub">Intégrez le 5-5-5 dans votre métier · potier, prof de yoga, manager, éducateur</p>
          <ul class="np-features">
            <li>5 modules en ligne en accès illimité</li>
            <li>Intégrer les rituels corps dans votre pratique</li>
            <li>Adaptable à tout métier ou environnement</li>
            <li>Espace membre personnel sécurisé</li>
            <li>Attestation Ma Pause Souffle délivrée</li>
          </ul>
        </div>
        <div class="np-card-footer">
          <div class="np-price-wrap">
            <p class="np-price-label">À partir de</p>
            <div class="np-price-once">
              <span class="amount">999</span>
              <span class="currency">€</span>
            </div>
            <div class="np-price-installment">
              <span class="amount">249,75 <span style="font-size:1.1rem">€</span></span>
              <span class="detail">par cycle · 4 versements × 4 semaines</span>
              <span class="total">Total : 999 €</span>
            </div>
          </div>
          @auth
            <form method="POST" action="{{ route('presence.ma-pause-souffle.checkout') }}" class="np-cta-once">
              @csrf
              <button type="submit" class="np-cta-primary">Accéder au programme</button>
            </form>
            <form method="POST" action="{{ route('presence.ma-pause-souffle.checkout.installment') }}" class="np-cta-cycle" style="display:none">
              @csrf
              <button type="submit" class="np-cta-primary">4 × 249,75 € · cycle de 4 semaines</button>
            </form>
          @else
            <a href="{{ route('login') }}?redirect={{ urlencode(route('presence.nos-programmes')) }}" class="np-cta-primary np-cta-once">Accéder au programme</a>
            <a href="{{ route('login') }}?redirect={{ urlencode(route('presence.nos-programmes')) }}" class="np-cta-primary np-cta-cycle" style="display:none">4 × 249,75 € · cycle de 4 semaines</a>
          @endauth
        </div>
      </div>

      {{-- LA RETRAITE --}}
      <div class="np-card">
        <div class="np-card-top">
          <div class="np-card-label">Option · Immersion physique</div>
          <div class="np-card-badge">7 jours · 12 places · Méditerranée</div>
          <h3 class="np-card-title">La Retraite<br><span style="font-weight:300;font-size:0.95rem">Pause Souffle</span></h3>
          <p class="np-card-sub">7 jours en Méditerranée · Destination surprise · 12 places maximum</p>
          <ul class="np-features">
            <li>7 jours de retraite immersive en Méditerranée</li>
            <li>Destination surprise · 12 places maximum</li>
            <li>Hébergement inclus dans le tarif</li>
            <li>Rituels corps complet en nature</li>
            <li>Dates sur demande</li>
          </ul>
        </div>
        <div class="np-card-footer">
          <div class="np-price-wrap">
            <p class="np-price-label">À partir de</p>
            <div class="np-price-once">
              <span class="amount" style="font-size:1.75rem">4 800 – 5 500</span>
              <span class="currency">€</span>
            </div>
            <div class="np-price-installment">
              <span class="amount">1 200 – 1 375 <span style="font-size:1rem">€</span></span>
              <span class="detail">par cycle · 4 versements × 4 semaines</span>
              <span class="total">Total selon formule choisie</span>
            </div>
          </div>
          <a href="{{ route('presence.retraite') }}" class="np-cta-primary np-cta-once">Voir les dates · paiement intégral</a>
          <a href="{{ route('presence.retraite') }}" class="np-cta-primary np-cta-cycle" style="display:none">Voir les dates · 4 cycles de 4 semaines</a>
        </div>
      </div>

    </div>
  </section>
{{-- ════════════════════════════ CONFIANCE ═════════════════════════════════ --}}
  <section class="np-trust">
    <div class="np-trust-grid">
      <div class="np-trust-item">
        <div class="np-trust-icon">🔒</div>
        <div class="np-trust-title">Paiement 100 % sécurisé</div>
        <div class="np-trust-desc">Traitement via Stripe. Vos données bancaires ne transitent jamais sur nos serveurs.</div>
      </div>
      <div class="np-trust-item">
        <div class="np-trust-icon">⚡</div>
        <div class="np-trust-title">Accès immédiat</div>
        <div class="np-trust-desc">Dès confirmation du paiement, votre espace est activé. Pas d'attente, pas de délai.</div>
      </div>
      <div class="np-trust-item">
        <div class="np-trust-icon">🎓</div>
        <div class="np-trust-title">Certification officielle</div>
        <div class="np-trust-desc">Chaque parcours délivre une attestation Pause Souffle reconnue par la communauté.</div>
      </div>
    </div>
  </section>

  {{-- ════════════════════════════ FAQ ═══════════════════════════════════════ --}}
  <section class="np-faq">
    <div class="np-section-header">
      <div class="np-section-badge" style="color:var(--np-gold-dark);border-color:rgba(184,137,58,0.4)">Questions fréquentes</div>
      <h2 class="np-section-title-dark">Tout ce que vous avez besoin de savoir</h2>
    </div>
    <div class="np-faq-list">
      <div class="np-faq-item">
        <div class="np-faq-q" onclick="this.closest('.np-faq-item').classList.toggle('open')">
          Dois-je suivre les étapes dans l'ordre ?
          <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round"><path d="M6 9l6 6 6-6"/></svg>
        </div>
        <div class="np-faq-a"><div class="np-faq-a-inner">Chaque étape s'appuie sur la précédente. Nous recommandons de commencer par l'Étape 1 si vous débutez. Toutefois, si vous avez déjà un niveau de pratique avancé, prenez contact avec nous pour évaluer ensemble le bon point d'entrée.</div></div>
      </div>
      <div class="np-faq-item">
        <div class="np-faq-q" onclick="this.closest('.np-faq-item').classList.toggle('open')">
          Comment fonctionnent les 4 cycles de 4 semaines ?
          <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round"><path d="M6 9l6 6 6-6"/></svg>
        </div>
        <div class="np-faq-a"><div class="np-faq-a-inner">Le paiement par cycle de 4 semaines est traité automatiquement par Stripe. Vous obtenez un accès complet dès le premier versement. 4 prélèvements espacés de 4 semaines, soit 16 semaines au total. L'abonnement s'arrête automatiquement après le 4e versement — aucune démarche de résiliation à effectuer.</div></div>
      </div>
      <div class="np-faq-item">
        <div class="np-faq-q" onclick="this.closest('.np-faq-item').classList.toggle('open')">
          Les programmes sont-ils accessibles à l'international ?
          <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round"><path d="M6 9l6 6 6-6"/></svg>
        </div>
        <div class="np-faq-a"><div class="np-faq-a-inner">Oui. Les parcours en ligne sont accessibles depuis n'importe quel pays. Les contenus audio sont disponibles en français et en anglais. Pour les retraites et sessions en présentiel, des informations logistiques vous seront communiquées séparément.</div></div>
      </div>
      <div class="np-faq-item">
        <div class="np-faq-q" onclick="this.closest('.np-faq-item').classList.toggle('open')">
          Puis-je passer d'un parcours individuel au Pack Intégral après coup ?
          <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round"><path d="M6 9l6 6 6-6"/></svg>
        </div>
        <div class="np-faq-a"><div class="np-faq-a-inner">Oui. Si vous avez déjà acquis une étape, contactez-nous pour bénéficier d'une mise à niveau vers le Pack Intégral au tarif ajusté. Aucun contenu ne sera facturé deux fois.</div></div>
      </div>
      <div class="np-faq-item">
        <div class="np-faq-q" onclick="this.closest('.np-faq-item').classList.toggle('open')">
          Quelle est la durée d'accès aux modules ?
          <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round"><path d="M6 9l6 6 6-6"/></svg>
        </div>
        <div class="np-faq-a"><div class="np-faq-a-inner">L'accès est illimité dans le temps. Une fois inscrit, les modules et toutes les mises à jour futures restent accessibles depuis votre espace personnel, sans limite de durée.</div></div>
      </div>
    </div>
  </section>

  {{-- ════════════════════════════ CTA FINAL ═════════════════════════════════ --}}
  <section class="np-final-cta">
    <div class="np-final-cta-inner">
      <h2>Prêt·e à <em>commencer&nbsp;?</em></h2>
      <p>Choisissez l'étape qui vous correspond. Votre espace sera actif dans la minute qui suit votre paiement.</p>
      <div class="np-final-cta-btns">
        <a href="{{ route('presence.parcours') }}" class="np-btn-gold">Voir le détail du Parcours</a>
        <a href="{{ route('presence.pause-souffle') }}" class="np-btn-outline">Découvrir Pause Souffle</a>
      </div>
    </div>
  </section>

</div>
@endsection

@section('script')
<script>
(function() {
  var toggle = document.getElementById('npPayToggle');
  var body   = document.body;

  // Tous les sélecteurs "une fois / cycle" présents sur la page
  var ONCE_SELECTORS   = ['.np-price-once', '.np-pro-price-once', '.np-exp-price-once',
                          '.np-pack-price-col .pack-once', '.np-cta-once', '.np-cta-pack-once', '.np-pro-cta-once'];
  var CYCLE_SELECTORS  = ['.np-price-installment', '.np-pro-price-installment', '.np-exp-price-install',
                          '.np-pack-price-col .pack-installment', '.np-cta-cycle', '.np-cta-pack-cycle', '.np-pro-cta-cycle'];

  // Quel display utiliser par sélecteur en mode "visible"
  function getDisplay(el) {
    // Liens et boutons CTA → inline-flex, blocs prix → block
    var tag = el.tagName.toLowerCase();
    if (tag === 'a' || tag === 'button') return 'inline-flex';
    if (el.classList.contains('np-cta-primary') || el.classList.contains('np-cta-secondary')) return 'inline-flex';
    return 'block';
  }

  function applyMode(mode) {
    var isInstallment = (mode === 'installment');

    // Toggle actif sur les boutons du switch
    if (toggle) {
      toggle.querySelectorAll('.np-toggle-btn').forEach(function(b) {
        b.classList.toggle('active', b.dataset.mode === mode);
      });
    }

    // Masquer / afficher les blocs "paiement unique"
    ONCE_SELECTORS.forEach(function(sel) {
      document.querySelectorAll(sel).forEach(function(el) {
        el.style.display = isInstallment ? 'none' : getDisplay(el);
      });
    });

    // Masquer / afficher les blocs "cycle 4 semaines"
    CYCLE_SELECTORS.forEach(function(sel) {
      document.querySelectorAll(sel).forEach(function(el) {
        el.style.display = isInstallment ? getDisplay(el) : 'none';
      });
    });

    // Forcer les formulaires (form) à ne pas avoir display inline
    document.querySelectorAll('form.np-cta-once, form.np-cta-cycle, form.np-cta-pack-once, form.np-cta-pack-cycle, form.np-pro-cta-once, form.np-pro-cta-cycle').forEach(function(f) {
      var shouldShow = f.classList.contains('np-cta-once')     && !isInstallment ||
                       f.classList.contains('np-cta-cycle')    &&  isInstallment ||
                       f.classList.contains('np-cta-pack-once')  && !isInstallment ||
                       f.classList.contains('np-cta-pack-cycle') &&  isInstallment ||
                       f.classList.contains('np-pro-cta-once')   && !isInstallment ||
                       f.classList.contains('np-pro-cta-cycle')  &&  isInstallment;
      f.style.display = shouldShow ? 'block' : 'none';
    });
  }

  // Initialisation
  applyMode('once');

  if (toggle) {
    toggle.addEventListener('click', function(e) {
      var btn = e.target.closest('.np-toggle-btn');
      if (btn) applyMode(btn.dataset.mode);
    });
  }

  // Smooth scroll depuis ancre externe
  if (window.location.hash === '#parcours') {
    setTimeout(function() {
      var el = document.querySelector('.np-parcours-grid');
      if (el) el.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }, 300);
  }
})();
</script>
@endsection
