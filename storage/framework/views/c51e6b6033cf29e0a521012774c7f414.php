<?php $__env->startSection('pageHeading'); ?>
  Comment on estime les tarifs
<?php $__env->stopSection(); ?>

<?php $__env->startSection('metaDescription'); ?>
  Deux baromètres internes Junspro, mis à jour automatiquement : slider instantané et engagement en rituels. Méthode transparente, unités claires (€/h, €/jour).
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<style>
  /* ============================================
     PAGE COMMENT ON ESTIME LES TARIFS — ULTRA PREMIUM JUNSPRO
     Scopé 100% .junspro-tarifs-explain — aucun impact ailleurs
     ============================================ */
  .junspro-tarifs-explain {
    background: #FFFFFF;
    color: #1F2937;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    line-height: 1.6;
    -webkit-font-smoothing: antialiased;
  }
  .junspro-tarifs-explain { --junspro-primary: #4F46E5; --junspro-primary-soft: rgba(79, 70, 229, 0.12); --junspro-gradient: linear-gradient(135deg, #4F46E5 0%, #6366F1 50%, #1E40AF 100%); }

  /* Progress bar (scroll) */
  .junspro-tarifs-explain .tarifs-progress-wrap {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: rgba(0,0,0,0.04);
    z-index: 1000;
  }
  .junspro-tarifs-explain .tarifs-progress-bar {
    height: 100%;
    background: var(--junspro-gradient);
    width: 0%;
    transition: width 0.25s ease;
  }

  /* Hero — compact */
  .junspro-tarifs-explain .tarifs-hero {
    padding: 40px 24px 28px;
    text-align: center;
    background: linear-gradient(180deg, #FAFAFC 0%, #FFFFFF 100%);
  }
  .junspro-tarifs-explain .tarifs-hero .hero-badge {
    display: inline-block;
    padding: 6px 14px;
    background: rgba(79, 70, 229, 0.08);
    color: #4F46E5;
    font-size: 0.625rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    border-radius: 999px;
    margin-bottom: 0.75rem;
  }
  .junspro-tarifs-explain .tarifs-hero h1 {
    font-size: clamp(1.75rem, 3.5vw, 2.25rem);
    font-weight: 600;
    color: #1F2937;
    margin-bottom: 0.5rem;
    letter-spacing: -0.02em;
  }
  .junspro-tarifs-explain .tarifs-hero .subtitle {
    font-size: 1rem;
    color: #6B7280;
    max-width: 500px;
    margin: 0 auto 0.75rem;
    line-height: 1.6;
  }
  .junspro-tarifs-explain .tarifs-hero .micro {
    font-size: 0.75rem;
    color: #9CA3AF;
    margin-bottom: 1rem;
    line-height: 1.5;
  }
  .junspro-tarifs-explain .tarifs-hero .cta-btn {
    display: inline-block;
    padding: 10px 20px;
    background: var(--junspro-gradient);
    color: white;
    font-weight: 600;
    font-size: 0.875rem;
    border-radius: 10px;
    text-decoration: none;
    transition: transform 0.2s, box-shadow 0.2s;
    border: none;
    cursor: pointer;
  }
  .junspro-tarifs-explain .tarifs-hero .cta-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 6px 16px rgba(79, 70, 229, 0.3);
    color: white;
  }

  /* Bloc "Les 2 baromètres en 10 secondes" — Malt-like */
  .junspro-tarifs-explain .barometres-10sec {
    padding: 2rem 0;
  }
  .junspro-tarifs-explain .barometres-10sec-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
    max-width: 1080px;
    margin: 0 auto;
    padding: 0 28px;
  }
  .junspro-tarifs-explain .barometres-10sec-card {
    background: #FFFFFF;
    border: 1px solid rgba(0,0,0,0.06);
    border-radius: 16px;
    padding: 1.75rem;
    box-shadow: 0 1px 3px rgba(0,0,0,0.04);
    transition: opacity 0.2s, transform 0.2s, box-shadow 0.2s;
  }
  .junspro-tarifs-explain .barometres-10sec-card:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.06);
    transform: translateY(-2px);
  }
  .junspro-tarifs-explain .barometres-10sec-card h3 {
    font-size: 1.125rem;
    font-weight: 600;
    color: #1F2937;
    margin-bottom: 0.5rem;
  }
  .junspro-tarifs-explain .barometres-10sec-card p {
    font-size: 0.875rem;
    color: #6B7280;
    line-height: 1.55;
    margin-bottom: 1rem;
  }
  .junspro-tarifs-explain .barometres-10sec-card ul {
    list-style: none;
    padding: 0;
    margin: 0 0 1rem;
    font-size: 0.8125rem;
    color: #6B7280;
  }
  .junspro-tarifs-explain .barometres-10sec-card li {
    padding: 0.25rem 0 0.25rem 1.25rem;
    position: relative;
  }
  .junspro-tarifs-explain .barometres-10sec-card li::before {
    content: '•';
    position: absolute;
    left: 0;
    color: #4F46E5;
  }
  .junspro-tarifs-explain .barometres-10sec-link {
    font-size: 0.8125rem;
    font-weight: 600;
    color: #4F46E5;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    transition: opacity 0.2s;
  }
  .junspro-tarifs-explain .barometres-10sec-link:hover { opacity: 0.85; color: #4F46E5; }

  /* Container */
  .junspro-tarifs-explain .tarifs-container {
    max-width: 1080px;
    margin: 0 auto;
    padding: 0 28px;
    position: relative;
  }
  .junspro-tarifs-explain .tarifs-container-with-stepper {
    padding-left: 56px;
  }

  /* Stepper — sticky left desktop, horizontal mobile */
  .junspro-tarifs-explain .tarifs-stepper {
    position: sticky;
    top: 100px;
    left: 0;
    width: 40px;
    display: flex;
    flex-direction: column;
    gap: 12px;
    align-items: center;
  }
  .junspro-tarifs-explain .tarifs-stepper-dot {
    position: relative;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: #E5E7EB;
    transition: all 0.2s ease;
    cursor: pointer;
  }
  .junspro-tarifs-explain .tarifs-stepper-dot.is-active {
    background: #4F46E5;
    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2);
  }
  .junspro-tarifs-explain .tarifs-stepper-dot:not(:last-child)::after {
    content: '';
    position: absolute;
    top: 18px;
    left: 50%;
    transform: translateX(-50%);
    width: 1px;
    height: 16px;
    background: #E5E7EB;
  }
  .junspro-tarifs-explain .tarifs-stepper-wrap {
    position: absolute;
    left: 28px;
    top: 2rem;
  }
  .junspro-tarifs-explain .tarifs-stepper-horizontal {
    display: none;
    justify-content: center;
    gap: 16px;
    margin-bottom: 1rem;
    padding: 0.5rem 0;
  }
  .junspro-tarifs-explain .tarifs-stepper-horizontal .tarifs-stepper-dot {
    width: 8px;
    height: 8px;
  }

  /* Cards */
  .junspro-tarifs-explain .tarifs-card {
    background: #FFFFFF;
    border: 1px solid rgba(0,0,0,0.06);
    border-radius: 16px;
    padding: 2rem;
    margin-bottom: 1.75rem;
    box-shadow: 0 1px 3px rgba(0,0,0,0.04);
    transition: opacity 0.18s ease, transform 0.18s ease, box-shadow 0.18s ease;
  }
  .junspro-tarifs-explain .tarifs-card:hover {
    border-color: rgba(0,0,0,0.08);
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    transform: translateY(-2px);
  }
  .junspro-tarifs-explain .tarifs-card.fade-in {
    opacity: 1;
    transform: translateY(0);
  }
  .junspro-tarifs-explain .tarifs-step-badge {
    font-size: 0.6875rem;
    font-weight: 600;
    color: #4F46E5;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    margin-bottom: 0.5rem;
  }
  .junspro-tarifs-explain .tarifs-card h2 {
    font-size: 1.25rem;
    font-weight: 600;
    color: #1F2937;
    margin-bottom: 0.75rem;
  }
  .junspro-tarifs-explain .tarifs-card p {
    color: #6B7280;
    font-size: 0.9375rem;
    margin-bottom: 1.25rem;
    line-height: 1.55;
  }

  /* Étape 1 — Lignes tarifaires en mini-tableau (3 colonnes) */
  .junspro-tarifs-explain .tarifs-summary-table {
    margin-top: 1rem;
    font-size: 0.875rem;
  }
  .junspro-tarifs-explain .tarifs-summary-row {
    display: grid;
    grid-template-columns: 1fr auto auto;
    gap: 16px 24px;
    align-items: baseline;
    padding: 6px 0;
    min-width: 280px;
  }
  .junspro-tarifs-explain .tarifs-summary-row .label {
    font-weight: 600;
    color: #374151;
  }
  .junspro-tarifs-explain .tarifs-summary-row .value {
    font-weight: 500;
    color: #4F46E5;
    text-align: right;
  }
  .junspro-tarifs-explain .tarifs-summary-row .unit {
    font-weight: 500;
    color: #6B7280;
    min-width: 36px;
  }

  /* Ordre affichage par univers */
  .junspro-tarifs-explain .tarifs-summary-table.tarifs-order-enterprise .tarifs-summary-row[data-row="journalier"] { order: 1; }
  .junspro-tarifs-explain .tarifs-summary-table.tarifs-order-enterprise .tarifs-summary-row[data-row="horaire"] { order: 2; }
  .junspro-tarifs-explain .tarifs-summary-table.tarifs-order-grand-public .tarifs-summary-row[data-row="horaire"] { order: 1; }
  .junspro-tarifs-explain .tarifs-summary-table.tarifs-order-grand-public .tarifs-summary-row[data-row="journalier"] { order: 2; }
  .junspro-tarifs-explain .tarifs-summary-table { display: flex; flex-direction: column; gap: 0; }
  .junspro-tarifs-explain .tarifs-summary-table .tarifs-base-row { order: 10; }
  .junspro-tarifs-explain .tarifs-summary-row { display: grid; grid-template-columns: 1fr auto auto; gap: 16px 24px; align-items: baseline; }

  /* Toggle Base journée 7h/8h */
  .junspro-tarifs-explain .tarifs-base-row {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-top: 0.5rem;
    font-size: 0.8125rem;
    color: #6B7280;
  }
  .junspro-tarifs-explain .tarifs-base-label {
    font-weight: 500;
    color: #374151;
  }
  .junspro-tarifs-explain .tarifs-base-tooltip {
    position: relative;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 16px;
    height: 16px;
    border-radius: 50%;
    background: #E5E7EB;
    color: #6B7280;
    font-size: 0.6875rem;
    font-weight: 600;
    cursor: help;
    transition: background 0.15s, color 0.15s;
  }
  .junspro-tarifs-explain .tarifs-base-tooltip:hover {
    background: #4F46E5;
    color: white;
  }
  .junspro-tarifs-explain .tarifs-base-tooltip:hover::after,
  .junspro-tarifs-explain .tarifs-base-tooltip:focus::after {
    content: attr(data-tooltip);
    position: absolute;
    left: 50%;
    bottom: calc(100% + 8px);
    transform: translateX(-50%);
    max-width: 260px;
    padding: 8px 12px;
    background: #1F2937;
    color: #fff;
    font-size: 0.75rem;
    font-weight: 400;
    line-height: 1.45;
    border-radius: 8px;
    white-space: normal;
    z-index: 100;
    pointer-events: none;
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
  }
  .junspro-tarifs-explain .tarifs-base-toggle {
    display: inline-flex;
    border: 1px solid #E5E7EB;
    border-radius: 8px;
    padding: 2px;
    background: #F9FAFB;
    gap: 0;
  }
  .junspro-tarifs-explain .tarifs-base-btn {
    padding: 4px 12px;
    border: none;
    background: transparent;
    color: #6B7280;
    font-size: 0.8125rem;
    font-weight: 500;
    cursor: pointer;
    border-radius: 6px;
    transition: all 0.18s ease;
  }
  .junspro-tarifs-explain .tarifs-base-btn:hover {
    color: #4F46E5;
    background: rgba(79, 70, 229, 0.08);
  }
  .junspro-tarifs-explain .tarifs-base-btn.is-active {
    background: #fff;
    color: #4F46E5;
    box-shadow: 0 1px 2px rgba(0,0,0,0.05);
  }

  /* Engagement — ordre par univers */
  .junspro-tarifs-explain .tarifs-engagement-summary.tarifs-order-enterprise .repère-line[data-line="journalier"] { order: 1; }
  .junspro-tarifs-explain .tarifs-engagement-summary.tarifs-order-enterprise .repère-line[data-line="horaire"] { order: 2; }
  .junspro-tarifs-explain .tarifs-engagement-summary.tarifs-order-enterprise .repère-line[data-line="volume"] { order: 0; }
  .junspro-tarifs-explain .tarifs-engagement-summary.tarifs-order-grand-public .repère-line[data-line="horaire"] { order: 1; }
  .junspro-tarifs-explain .tarifs-engagement-summary.tarifs-order-grand-public .repère-line[data-line="journalier"] { order: 2; }
  .junspro-tarifs-explain .tarifs-engagement-summary.tarifs-order-grand-public .repère-line[data-line="volume"] { order: 0; }
  .junspro-tarifs-explain .tarifs-engagement-summary { display: flex; flex-direction: column; }
  .junspro-tarifs-explain .tarifs-engagement-summary .repère-line { order: 999; }
  .junspro-tarifs-explain .tarifs-engagement-summary .tarifs-base-row { order: 10; margin-top: 0.75rem; }

  /* Étape 2 — Format référence (corporate) */
  .junspro-tarifs-explain .tarifs-engagement-summary {
    margin-top: 1.25rem;
    padding: 1rem 1.25rem;
    background: #FAFAFC;
    border-radius: 12px;
    font-size: 0.875rem;
    color: #374151;
  }
  .junspro-tarifs-explain .tarifs-engagement-summary .repère-line {
    margin-bottom: 8px;
    line-height: 1.55;
    transition: opacity 0.15s ease;
  }
  .junspro-tarifs-explain .tarifs-engagement-summary .repère-line:last-child { margin-bottom: 0; }

  /* à quoi ça sert — toggle */
  .junspro-tarifs-explain .tarifs-who-toggle {
    display: flex;
    gap: 8px;
    margin-bottom: 1rem;
    font-size: 0.8125rem;
    color: #6B7280;
  }
  .junspro-tarifs-explain .tarifs-who-toggle span {
    font-weight: 500;
    margin-right: 4px;
  }
  .junspro-tarifs-explain .tarifs-who-btn {
    padding: 4px 12px;
    border: 1px solid #E5E7EB;
    border-radius: 8px;
    background: #fff;
    color: #6B7280;
    cursor: pointer;
    font-size: 0.8125rem;
    transition: all 0.2s;
  }
  .junspro-tarifs-explain .tarifs-who-btn:hover {
    border-color: #4F46E5;
    color: #4F46E5;
    background: var(--junspro-primary-soft);
  }
  .junspro-tarifs-explain .tarifs-who-btn.is-active {
    border-color: #4F46E5;
    background: var(--junspro-primary-soft);
    color: #4F46E5;
  }
  .junspro-tarifs-explain .tarifs-col {
    transition: opacity 0.2s ease;
  }
  .junspro-tarifs-explain .tarifs-col.is-dimmed {
    opacity: 0.5;
  }
  .junspro-tarifs-explain .tarifs-col.is-emphasized {
    opacity: 1;
  }
  .junspro-tarifs-explain .tarifs-two-cols {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
    margin-top: 0.5rem;
  }
  .junspro-tarifs-explain .tarifs-col h3 {
    font-size: 1rem;
    font-weight: 600;
    color: #1F2937;
    margin-bottom: 0.75rem;
  }
  .junspro-tarifs-explain .tarifs-col ul {
    list-style: none;
    padding: 0;
    margin: 0;
  }
  .junspro-tarifs-explain .tarifs-col li {
    padding: 0.5rem 0 0.5rem 1.5rem;
    position: relative;
    color: #6B7280;
    font-size: 0.9375rem;
  }
  .junspro-tarifs-explain .tarifs-col li::before {
    content: '•';
    position: absolute;
    left: 0;
    color: #4F46E5;
    font-weight: 700;
  }

  /* Slider — Junspro colors */
  .junspro-tarifs-explain .tarifs-slider-demo { margin: 1.25rem 0; }
  .junspro-tarifs-explain .tarifs-slider-track {
    height: 6px;
    background: #E5E7EB;
    border-radius: 3px;
    margin-bottom: 14px;
    position: relative;
  }
  .junspro-tarifs-explain .tarifs-slider-track .ui-slider-range {
    background: var(--junspro-gradient);
    border-radius: 3px;
    height: 6px;
  }
  .junspro-tarifs-explain .tarifs-slider-track .ui-slider-handle {
    width: 18px;
    height: 18px;
    border-radius: 50%;
    background: #4F46E5;
    border: 2px solid #fff;
    box-shadow: 0 2px 6px rgba(79, 70, 229, 0.25);
    cursor: pointer;
    top: -6px;
    outline: none;
  }
  .junspro-tarifs-explain .tarifs-slider-inputs {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 12px;
  }
  .junspro-tarifs-explain .tarifs-slider-inputs input {
    width: 70px;
    padding: 8px 12px;
    border: 1px solid #E5E7EB;
    border-radius: 8px;
    font-size: 14px;
    text-align: center;
  }

  /* Engagement buttons */
  .junspro-tarifs-explain .tarifs-engagement-choices {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    margin: 1.25rem 0;
  }
  .junspro-tarifs-explain .tarifs-engagement-btn {
    flex: 1;
    min-width: 140px;
    padding: 1rem 1.25rem;
    border: 1px solid rgba(0,0,0,0.08);
    border-radius: 12px;
    background: #FAFAFA;
    color: #374151;
    font-size: 0.9375rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
    text-align: center;
  }
  .junspro-tarifs-explain .tarifs-engagement-btn:hover {
    border-color: rgba(79, 70, 229, 0.25);
    background: var(--junspro-primary-soft);
  }
  .junspro-tarifs-explain .tarifs-engagement-btn.active {
    border-color: #4F46E5;
    background: var(--junspro-primary-soft);
    color: #4F46E5;
  }

  /* Transparence */
  .junspro-tarifs-explain .tarifs-transparence {
    background: #FAFAFC;
    border-radius: 16px;
    padding: 1.75rem 2rem;
    margin: 1.75rem 0;
    border: 1px solid rgba(0,0,0,0.04);
  }
  .junspro-tarifs-explain .tarifs-transparence h2 {
    font-size: 1.125rem;
    font-weight: 600;
    color: #1F2937;
    margin-bottom: 0.75rem;
  }
  .junspro-tarifs-explain .tarifs-transparence ul {
    list-style: none;
    padding: 0;
    margin: 0;
  }
  .junspro-tarifs-explain .tarifs-transparence li {
    padding: 0.4rem 0 0.4rem 1.5rem;
    position: relative;
    color: #6B7280;
    font-size: 0.875rem;
  }
  .junspro-tarifs-explain .tarifs-transparence li::before {
    content: '✓';
    position: absolute;
    left: 0;
    color: #4F46E5;
    font-weight: 700;
  }
  .junspro-tarifs-explain .tarifs-transparence-micro {
    font-size: 0.8125rem;
    color: #6B7280;
    margin-bottom: 1rem;
    line-height: 1.55;
    font-style: italic;
  }

  /* FAQ */
  .junspro-tarifs-explain .tarifs-faq {
    margin: 2rem 0 4rem;
  }
  .junspro-tarifs-explain .tarifs-faq h2 {
    font-size: 1.25rem;
    font-weight: 600;
    color: #1F2937;
    margin-bottom: 0.25rem;
  }
  .junspro-tarifs-explain .tarifs-faq .faq-micro {
    font-size: 0.75rem;
    color: #9CA3AF;
    margin-bottom: 1.25rem;
  }
  .junspro-tarifs-explain .tarifs-faq-item {
    border-bottom: 1px solid rgba(0,0,0,0.06);
    margin-bottom: 1rem;
  }
  .junspro-tarifs-explain .tarifs-faq-item:last-child { border-bottom: none; margin-bottom: 0; }
  .junspro-tarifs-explain .tarifs-faq-question {
    padding: 1.25rem 0;
    font-weight: 600;
    color: #374151;
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
    font-size: 0.9375rem;
    transition: color 0.2s ease;
  }
  .junspro-tarifs-explain .tarifs-faq-question:hover { color: #4F46E5; }
  .junspro-tarifs-explain .tarifs-faq-question .icon {
    font-size: 0.625rem;
    transition: transform 0.18s ease;
    opacity: 0.6;
    flex-shrink: 0;
    align-self: center;
  }
  .junspro-tarifs-explain .tarifs-faq-item.open .tarifs-faq-question .icon {
    transform: rotate(180deg);
    opacity: 1;
  }
  .junspro-tarifs-explain .tarifs-faq-answer {
    max-height: 0;
    overflow: hidden;
    padding: 0;
    color: #6B7280;
    font-size: 0.875rem;
    line-height: 1.6;
    transition: max-height 0.18s ease;
  }
  .junspro-tarifs-explain .tarifs-faq-item.open .tarifs-faq-answer {
    max-height: 300px;
  }
  .junspro-tarifs-explain .tarifs-faq-answer-inner {
    padding: 0 0 1.25rem;
  }

  @media (max-width: 768px) {
    .junspro-tarifs-explain .tarifs-hero { padding: 32px 20px 24px; }
    .junspro-tarifs-explain .tarifs-hero .micro { margin-bottom: 0.75rem; }
    .junspro-tarifs-explain .barometres-10sec-grid { grid-template-columns: 1fr; padding: 0 20px; }
    .junspro-tarifs-explain .tarifs-container { padding: 0 20px; }
    .junspro-tarifs-explain .tarifs-container-with-stepper { padding-left: 20px; }
    .junspro-tarifs-explain .tarifs-stepper-wrap { display: none; }
    .junspro-tarifs-explain .tarifs-stepper-horizontal { display: flex; }
    .junspro-tarifs-explain .tarifs-two-cols { grid-template-columns: 1fr; }
    .junspro-tarifs-explain .tarifs-engagement-choices { flex-direction: column; }
  }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php
  $universe = $universe ?? 'lessons';
  $isEnterprise = in_array($universe, ['projects', 'corporate']);
?>
<main class="junspro-tarifs-explain <?php echo e($isEnterprise ? 'tarifs-universe-enterprise' : 'tarifs-universe-grand-public'); ?>" data-page="tarifs-explain" data-universe="<?php echo e($universe); ?>">
  <!-- Progress bar -->
  <div class="tarifs-progress-wrap">
    <div class="tarifs-progress-bar" id="tarifsProgressBar"></div>
  </div>

  <!-- Hero -->
  <section class="tarifs-hero">
    <div class="tarifs-container">
      <span class="hero-badge">Baromètre interne — temps réel</span>
      <h1>Comment on estime les tarifs</h1>
      <p class="subtitle">Deux baromètres internes, mis à jour automatiquement — pour vous guider sans vous enfermer.</p>
      <p class="micro">1 rituel = 1h (50 min focus + 10 min restitution) • Base journée = 7h ou 8h (réglable) • Affichage = intervalle + référence</p>
      <a href="#barometres-10sec" class="cta-btn" id="tarifsCtaBtn">Tester le baromètre</a>
    </div>
  </section>

  <!-- Bloc "Les 2 baromètres en 10 secondes" -->
  <section id="barometres-10sec" class="barometres-10sec">
    <div class="barometres-10sec-grid">
      <div class="barometres-10sec-card">
        <h3>Baromètre instantané</h3>
        <p>Choisissez une fourchette horaire. L'équivalent journalier (base 7h ou 8h) se met à jour instantanément.</p>
        <ul>
          <li>Lecture immédiate : €/h et €/jour</li>
          <li>Idéal pour cadrer un budget</li>
        </ul>
        <a href="#etape-1" class="barometres-10sec-link">Voir le baromètre instantané →</a>
      </div>
      <div class="barometres-10sec-card">
        <h3>Baromètre d'engagement</h3>
        <p>Choisissez un niveau d'engagement. Le volume estimé et les fourchettes s'ajustent automatiquement.</p>
        <ul>
          <li>Pensé pour les projets récurrents</li>
          <li>Comparaison simple : heure vs jour</li>
        </ul>
        <a href="#etape-2" class="barometres-10sec-link">Voir le baromètre d'engagement →</a>
      </div>
    </div>
  </section>

  <!-- Parcours 3 étapes -->
  <section id="parcours" class="tarifs-container tarifs-container-with-stepper" style="padding-top: 2rem;">
    <!-- Stepper desktop -->
    <div class="tarifs-stepper-wrap">
      <div class="tarifs-stepper">
        <div class="tarifs-stepper-dot" data-step="1" aria-label="Étape 1"></div>
        <div class="tarifs-stepper-dot" data-step="2" aria-label="Étape 2"></div>
        <div class="tarifs-stepper-dot" data-step="3" aria-label="Étape 3"></div>
      </div>
    </div>
    <!-- Stepper mobile -->
    <div class="tarifs-stepper-horizontal">
      <div class="tarifs-stepper-dot" data-step="1" aria-label="Étape 1"></div>
      <div class="tarifs-stepper-dot" data-step="2" aria-label="Étape 2"></div>
      <div class="tarifs-stepper-dot" data-step="3" aria-label="Étape 3"></div>
    </div>

    <!-- Étape 1 — Baromètre instantané -->
    <div class="tarifs-card fade-in" id="etape-1" data-step="1">
      <div class="tarifs-step-badge">Étape 1/3</div>
      <h2>Baromètre instantané (Slider)</h2>
      <p>Choisissez une fourchette horaire. L'équivalent journalier (base 7h ou 8h) se met à jour instantanément.</p>
      <div class="tarifs-slider-demo">
        <div id="tarifsDemoSlider" class="tarifs-slider-track"></div>
        <div class="tarifs-slider-inputs">
          <input type="number" id="tarifsDemoMin" value="10" min="10" max="100" step="1">
          <span>–</span>
          <input type="number" id="tarifsDemoMax" value="50" min="10" max="100" step="1">
          <span>€</span>
        </div>
        <div class="tarifs-summary-table <?php echo e($isEnterprise ? 'tarifs-order-enterprise' : 'tarifs-order-grand-public'); ?>">
          <div class="tarifs-summary-row" data-row="horaire">
            <span class="label">Tarif horaire :</span>
            <span class="value" id="tarifsHoraireVal">10–50</span>
            <span class="unit">€/h</span>
          </div>
          <div class="tarifs-summary-row" data-row="journalier">
            <span class="label">Tarif journalier :</span>
            <span class="value" id="tarifsJournalierVal">70–350</span>
            <span class="unit">€/jour</span>
          </div>
          <div class="tarifs-base-row">
            <span class="tarifs-base-label">Base journée :</span>
            <span class="tarifs-base-tooltip" data-tooltip="7h : référence 35h/semaine • 8h : journée standard selon organisation" title="7h : référence 35h/semaine • 8h : journée standard selon organisation" aria-label="Info base journée">i</span>
            <div class="tarifs-base-toggle">
              <button type="button" class="tarifs-base-btn is-active" data-base="7">7h</button>
              <button type="button" class="tarifs-base-btn" data-base="8">8h</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Étape 2 — Baromètre d'engagement -->
    <div class="tarifs-card fade-in" id="etape-2" data-step="2">
      <div class="tarifs-step-badge">Étape 2/3</div>
      <h2>Baromètre d'engagement (Rituels)</h2>
      <p>Choisissez un niveau d'engagement. Le volume estimé et les fourchettes s'ajustent automatiquement.</p>
      <div class="tarifs-engagement-choices">
        <button type="button" class="tarifs-engagement-btn" data-min="0" data-max="1000">Exploratoire</button>
        <button type="button" class="tarifs-engagement-btn active" data-min="1000" data-max="2500">Ciblé</button>
        <button type="button" class="tarifs-engagement-btn" data-min="2500" data-max="5000">Étendu</button>
      </div>
      <div class="tarifs-engagement-summary <?php echo e($isEnterprise ? 'tarifs-order-enterprise' : 'tarifs-order-grand-public'); ?>">
        <div class="repère-line" data-line="volume">Volume estimé : <span id="tarifsVolumeVal">20–50 rituels</span> <span id="tarifsHeuresVal">(20–50 h)</span></div>
        <div class="repère-line" data-line="journalier">Tarif journalier (référence) : <span id="tarifsTjmVal">350</span> €/jour — Intervalle : <span id="tarifsFourchetteJVal">280–455</span> €/jour</div>
        <div class="repère-line" data-line="horaire">Tarif horaire (référence) : <span id="tarifsRateVal">50</span> €/h — Intervalle : <span id="tarifsFourchetteHVal">40–65</span> €/h</div>
        <div class="tarifs-base-row tarifs-base-row-engagement">
          <span class="tarifs-base-label">Base journée :</span>
          <span class="tarifs-base-tooltip" data-tooltip="7h : référence 35h/semaine • 8h : journée standard selon organisation" title="7h : référence 35h/semaine • 8h : journée standard selon organisation" aria-label="Info base journée">i</span>
          <div class="tarifs-base-toggle tarifs-base-toggle-engagement">
            <button type="button" class="tarifs-base-btn is-active" data-base="7">7h</button>
            <button type="button" class="tarifs-base-btn" data-base="8">8h</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Étape 3 — À quoi ça sert -->
    <div class="tarifs-card fade-in" id="etape-3" data-step="3">
      <div class="tarifs-step-badge">Étape 3/3</div>
      <h2>À quoi ça sert ?</h2>
      <div class="tarifs-who-toggle">
        <span>Je suis :</span>
        <button type="button" class="tarifs-who-btn" data-who="all">Les deux</button>
        <button type="button" class="tarifs-who-btn" data-who="freelance">Freelance</button>
        <button type="button" class="tarifs-who-btn" data-who="client">Client</button>
      </div>
      <div class="tarifs-two-cols">
        <div class="tarifs-col" data-col="freelance">
          <h3>Pour les freelances</h3>
          <ul>
            <li>Se positionner par rapport au marché</li>
            <li>Adapter ses tarifs selon le type de mission</li>
            <li>Communiquer en €/h et €/jour de façon claire</li>
          </ul>
        </div>
        <div class="tarifs-col" data-col="client">
          <h3>Pour les clients</h3>
          <ul>
            <li>Comprendre les fourchettes avant de chercher</li>
            <li>Comparer les engagements (rituels, heures)</li>
            <li>Budgeter en connaissance de cause</li>
          </ul>
        </div>
      </div>
    </div>

    <!-- Transparence -->
    <div class="tarifs-transparence">
      <h2>Référence tarifaire</h2>
      <p class="tarifs-transparence-micro">Les montants indiqués sont des repères calculés automatiquement. Ils n'ont pas vocation à fixer un tarif.</p>
      <ul>
        <li>Rituel = 1h (50 min focus + 10 min restitution)</li>
        <li>Base journée = 7h ou 8h (selon organisation)</li>
        <li>Affichage = intervalle + référence</li>
        <li>Mise à jour automatique selon les données disponibles</li>
      </ul>
    </div>

    <!-- FAQ -->
    <div class="tarifs-faq">
      <h2>Questions fréquentes</h2>
      <p class="faq-micro">Réponses courtes, sans jargon.</p>
      <div class="tarifs-faq-item open">
        <div class="tarifs-faq-question">Pourquoi 7h ? <span class="icon">▼</span></div>
        <div class="tarifs-faq-answer"><div class="tarifs-faq-answer-inner">Convention du marché : 1 jour = 7h facturables (référence 35h/semaine). Vous pouvez passer à 8h (journée standard) via le réglage Base journée.</div></div>
      </div>
      <div class="tarifs-faq-item">
        <div class="tarifs-faq-question">Est-ce que ça fixe mon prix ? <span class="icon">▼</span></div>
        <div class="tarifs-faq-answer"><div class="tarifs-faq-answer-inner">Non. Indicatifs uniquement. Vos tarifs restent libres.</div></div>
      </div>
      <div class="tarifs-faq-item">
        <div class="tarifs-faq-question">Sur quelles données ? <span class="icon">▼</span></div>
        <div class="tarifs-faq-answer"><div class="tarifs-faq-answer-inner">Profils des freelances visibles (selon vos filtres). Plus vous affinez, plus c'est précis.</div></div>
      </div>
      <div class="tarifs-faq-item">
        <div class="tarifs-faq-question">Est-ce fiable ? <span class="icon">▼</span></div>
        <div class="tarifs-faq-answer"><div class="tarifs-faq-answer-inner">Indication basée sur les données du moment. Repère, pas engagement.</div></div>
      </div>
    </div>
  </section>
</main>

<script>
(function() {
  'use strict';
  var page = document.querySelector('.junspro-tarifs-explain');
  if (!page) return;

  var STORAGE_KEY = 'junspro_day_base_hours';

  function getBaseHours() {
    var v = parseInt(localStorage.getItem(STORAGE_KEY), 10);
    return (v === 7 || v === 8) ? v : 7;
  }
  function setBaseHours(v) {
    localStorage.setItem(STORAGE_KEY, String(v));
  }
  function syncToggleUI(base) {
    page.querySelectorAll('.tarifs-base-btn').forEach(function(btn) {
      if (parseInt(btn.getAttribute('data-base'), 10) === base) {
        btn.classList.add('is-active');
      } else {
        btn.classList.remove('is-active');
      }
    });
  }

  // CTA scroll
  document.getElementById('tarifsCtaBtn')?.addEventListener('click', function(e) {
    e.preventDefault();
    document.getElementById('barometres-10sec')?.scrollIntoView({ behavior: 'smooth' });
  });

  // Smooth scroll for anchor links within page
  page.addEventListener('click', function(e) {
    var a = e.target.closest('a[href^="#"]');
    if (!a) return;
    var id = a.getAttribute('href').slice(1);
    if (!id) return;
    var el = document.getElementById(id);
    if (el) { e.preventDefault(); el.scrollIntoView({ behavior: 'smooth' }); }
  });

  // Progress bar (scroll)
  function updateProgress() {
    var bar = document.getElementById('tarifsProgressBar');
    if (!bar) return;
    var cards = page.querySelectorAll('.tarifs-card[data-step]');
    var total = cards.length;
    if (total === 0) { bar.style.width = '33%'; return; }
    var viewport = window.innerHeight;
    var visible = 0;
    cards.forEach(function(card, i) {
      var r = card.getBoundingClientRect();
      if (r.top < viewport * 0.7) visible = Math.max(visible, i + 1);
    });
    bar.style.width = Math.round((visible / total) * 100) + '%';
  }
  window.addEventListener('scroll', updateProgress);
  updateProgress();

  // Slider demo (calcul horaire inchangé, journalier = horaire × baseJour)
  function initSliderDemo() {
    var minInput = document.getElementById('tarifsDemoMin');
    var maxInput = document.getElementById('tarifsDemoMax');
    var horaireEl = document.getElementById('tarifsHoraireVal');
    var journalierEl = document.getElementById('tarifsJournalierVal');
    if (!minInput || !maxInput || !horaireEl || !journalierEl) return;

    function updateSliderSummary() {
      var base = getBaseHours();
      var min = Math.round(parseInt(minInput.value, 10) || 10);
      var max = Math.round(parseInt(maxInput.value, 10) || 50);
      var minC = Math.max(10, Math.min(min, max));
      var maxC = Math.max(minC, Math.min(100, max));
      var jMin = Math.round(minC * base);
      var jMax = Math.round(maxC * base);
      horaireEl.textContent = minC + '–' + maxC;
      journalierEl.textContent = jMin + '–' + jMax;
    }

    minInput.addEventListener('input', updateSliderSummary);
    maxInput.addEventListener('change', updateSliderSummary);
    maxInput.addEventListener('input', updateSliderSummary);

    if (typeof jQuery !== 'undefined' && jQuery.ui && jQuery.ui.slider) {
      var $slider = jQuery('#tarifsDemoSlider');
      $slider.slider({
        range: true,
        min: 10,
        max: 100,
        values: [10, 50],
        slide: function(ev, ui) {
          minInput.value = ui.values[0];
          maxInput.value = ui.values[1];
          updateSliderSummary();
        },
        change: function(ev, ui) {
          minInput.value = ui.values[0];
          maxInput.value = ui.values[1];
          updateSliderSummary();
        }
      });
      minInput.addEventListener('change', function() {
        var v = Math.max(10, Math.min(parseInt(this.value, 10) || 10, parseInt(maxInput.value, 10) || 50));
        this.value = v;
        var vals = $slider.slider('values');
        $slider.slider('values', [v, vals[1]]);
        updateSliderSummary();
      });
      maxInput.addEventListener('change', function() {
        var v = Math.max(parseInt(minInput.value, 10) || 10, Math.min(100, parseInt(this.value, 10) || 50));
        this.value = v;
        var vals = $slider.slider('values');
        $slider.slider('values', [vals[0], v]);
        updateSliderSummary();
      });
    }
  }
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initSliderDemo);
  } else {
    initSliderDemo();
  }

  // Engagement demo (valeurs horaires stockées, journalier = horaire × baseJour)
  var engagementData = {
    '0-1000': { rituels: '0–20', heures: '0–20', rate: 50, fourchetteHMin: 40, fourchetteHMax: 65 },
    '1000-2500': { rituels: '20–50', heures: '20–50', rate: 50, fourchetteHMin: 40, fourchetteHMax: 65 },
    '2500-5000': { rituels: '50–100', heures: '50–100', rate: 50, fourchetteHMin: 45, fourchetteHMax: 70 }
  };
  var currentEngagementKey = '1000-2500';

  function updateEngagementDisplay() {
    var base = getBaseHours();
    var d = engagementData[currentEngagementKey] || engagementData['1000-2500'];
    var tjm = Math.round(d.rate * base);
    var fourchetteJMin = Math.round(d.fourchetteHMin * base);
    var fourchetteJMax = Math.round(d.fourchetteHMax * base);
    document.getElementById('tarifsVolumeVal').textContent = d.rituels + ' rituels';
    document.getElementById('tarifsHeuresVal').textContent = '(' + d.heures + ' h)';
    document.getElementById('tarifsRateVal').textContent = d.rate;
    document.getElementById('tarifsFourchetteHVal').textContent = d.fourchetteHMin + '–' + d.fourchetteHMax;
    document.getElementById('tarifsTjmVal').textContent = tjm;
    document.getElementById('tarifsFourchetteJVal').textContent = fourchetteJMin + '–' + fourchetteJMax;
  }

  page.querySelectorAll('.tarifs-engagement-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
      page.querySelectorAll('.tarifs-engagement-btn').forEach(function(b) { b.classList.remove('active'); });
      this.classList.add('active');
      currentEngagementKey = this.getAttribute('data-min') + '-' + this.getAttribute('data-max');
      updateEngagementDisplay();
    });
  });
  updateEngagementDisplay();

  // Toggle Base journée 7h/8h
  syncToggleUI(getBaseHours());
  page.querySelectorAll('.tarifs-base-btn').forEach(function(btn) {
    btn.addEventListener('click', function() {
      var base = parseInt(this.getAttribute('data-base'), 10);
      setBaseHours(base);
      syncToggleUI(base);
      var minInput = document.getElementById('tarifsDemoMin');
      if (minInput) minInput.dispatchEvent(new Event('input', { bubbles: true }));
      updateEngagementDisplay();
    });
  });

  // Stepper scroll (IntersectionObserver)
  var steps = page.querySelectorAll('.tarifs-card[data-step]');
  var dots = page.querySelectorAll('.tarifs-stepper-dot');
  function updateStepper() {
    var viewport = window.innerHeight;
    var active = 0;
    steps.forEach(function(step, i) {
      var r = step.getBoundingClientRect();
      if (r.top < viewport * 0.6) active = i + 1;
    });
    dots.forEach(function(dot, i) {
      if (i + 1 === active) dot.classList.add('is-active');
      else dot.classList.remove('is-active');
    });
  }
  function scrollToStep(stepNum) {
    var el = page.querySelector('.tarifs-card[data-step="' + stepNum + '"]');
    if (el) el.scrollIntoView({ behavior: 'smooth' });
  }
  window.addEventListener('scroll', updateStepper);
  updateStepper();
  dots.forEach(function(dot) {
    dot.addEventListener('click', function() {
      scrollToStep(this.getAttribute('data-step'));
    });
  });

  // Toggle Freelance/Client
  var whoBtns = page.querySelectorAll('.tarifs-who-btn');
  var cols = page.querySelectorAll('.tarifs-col');
  whoBtns.forEach(function(btn) {
    btn.addEventListener('click', function() {
      whoBtns.forEach(function(b) { b.classList.remove('is-active'); });
      this.classList.add('is-active');
      var who = this.getAttribute('data-who');
      cols.forEach(function(col) {
        col.classList.remove('is-dimmed', 'is-emphasized');
        if (who === 'all') {
          col.classList.add('is-emphasized');
        } else if (col.getAttribute('data-col') === who) {
          col.classList.add('is-emphasized');
        } else {
          col.classList.add('is-dimmed');
        }
      });
    });
  });
  page.querySelector('.tarifs-who-btn[data-who="all"]')?.classList.add('is-active');
  cols.forEach(function(c) { c.classList.add('is-emphasized'); });

  // FAQ accordéon
  page.querySelectorAll('.tarifs-faq-question').forEach(function(q) {
    q.addEventListener('click', function() {
      var item = this.closest('.tarifs-faq-item');
      item.classList.toggle('open');
    });
  });

  // Fade-in on scroll
  var observer = new IntersectionObserver(function(entries) {
    entries.forEach(function(entry) {
      if (entry.isIntersecting) entry.target.classList.add('fade-in');
    });
  }, { threshold: 0.1 });
  page.querySelectorAll('.tarifs-card').forEach(function(card) {
    card.style.opacity = '0.9';
    card.style.transform = 'translateY(12px)';
    observer.observe(card);
  });
})();
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\comment-on-estime-les-tarifs.blade.php ENDPATH**/ ?>