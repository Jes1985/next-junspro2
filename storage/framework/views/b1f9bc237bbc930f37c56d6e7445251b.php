

<?php $__env->startSection('pageHeading'); ?>
  Échanges de logement | <?php echo e($websiteInfo->website_title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('metaDescription'); ?>
  Voyager autrement, en toute confiance. Court, moyen ou long : trouvez le bon échange, dans la bonne ville, au bon moment.
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/front/css/services-pages.css')); ?>">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<style>
  /* ============================================
     PAGE PREPLY STYLE - ADAPTÉE JUNSPRO
     ============================================ */
  
  /* Variables couleurs Homeswap - Dégradé rose bleu royal */
  :root {
    --preply-primary: #EC4899; /* Pink-500 - Rose */
    --preply-primary-dark: #DB2777; /* Pink-600 - Rose foncé */
    --preply-primary-light: #2563EB; /* Blue-600 - Bleu royal */
    --preply-pink: #F472B6; /* Pink-400 - Rose clair */
    --preply-pink-light: #3B82F6; /* Blue-500 - Bleu */
    --preply-text: #1F2937;
    --preply-text-light: #6B7280;
    --preply-bg: #FFFFFF;
    --preply-border: #E5E7EB;
    --preply-hover: #F9FAFB;
  }

  /* Hero Homeswap - Dégradé rose bleu royal */
  .services-hero {
    background: linear-gradient(
      135deg,
      #FCE7F3 0%,
      #FBCFE8 20%,
      #F9A8D4 40%,
      #F472B6 60%,
      #EC4899 80%,
      #2563EB 100%
    ) !important;
    box-shadow: 
      0 20px 60px rgba(236, 72, 153, 0.25),
      0 0 0 1px rgba(255, 255, 255, 0.1) inset;
  }

  .services-hero__placeholder {
    background: linear-gradient(
      135deg,
      #FCE7F3 0%,
      #FBCFE8 20%,
      #F9A8D4 40%,
      #F472B6 60%,
      #EC4899 80%,
      #2563EB 100%
    ) !important;
  }

  .services-hero__placeholder::after {
    background: linear-gradient(
      135deg,
      rgba(255, 255, 255, 0.1) 0%,
      transparent 50%,
      rgba(236, 72, 153, 0.1) 100%
    );
  }

  /* Boutons hero Homeswap - Adaptation rose */
  .services-hero__btn--primary {
    color: white !important;
    background: linear-gradient(90deg, #EC4899 0%, #A855F7 50%, #3B82F6 100%) !important;
    border-radius: 9999px !important;
    box-shadow: 0 4px 16px rgba(236, 72, 153, 0.25) !important;
    transition: all 0.3s ease !important;
  }

  .services-hero__btn--primary:hover {
    transform: translateY(-2px) !important;
    box-shadow: 0 8px 24px rgba(236, 72, 153, 0.4) !important;
    color: white !important;
  }

  .services-hero__btn--secondary {
    border-color: rgba(255, 255, 255, 0.5) !important;
  }

  .services-hero__btn--secondary:hover {
    border-color: rgba(255, 255, 255, 0.7) !important;
    background: rgba(255, 255, 255, 0.3) !important;
  }


  /* Hero Premium HomeSwap */
  .homeswap-hero-premium {
    background: white;
    padding: 80px 0 60px;
    border-bottom: 1px solid var(--preply-border);
  }

  .homeswap-hero-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
  }

  .homeswap-hero-content {
    text-align: center;
    max-width: 800px;
    margin: 0 auto;
  }

  .homeswap-hero-title {
    font-size: 3rem;
    font-weight: 700;
    color: var(--preply-text);
    margin-bottom: 16px;
    line-height: 1.2;
  }

  .homeswap-hero-subtitle {
    font-size: 1.5rem;
    color: var(--preply-text-light);
    margin-bottom: 32px;
    font-weight: 400;
  }

  .homeswap-hero-badges {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 16px;
    margin-bottom: 40px;
  }

  .homeswap-hero-badge {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 12px 20px;
    background: #f9fafb;
    border: 1px solid var(--preply-border);
    border-radius: 12px;
    font-size: 0.9375rem;
    color: var(--preply-text);
    font-weight: 500;
  }

  .homeswap-hero-badge-icon {
    width: 20px;
    height: 20px;
    color: var(--preply-primary);
    flex-shrink: 0;
  }

  .homeswap-hero-cta {
    display: flex;
    gap: 16px;
    justify-content: center;
    margin-bottom: 24px;
    flex-wrap: wrap;
  }

  /* Classes compatibles avec le design system */
  .homeswap-hero-btn-primary {
    display: inline-block;
    padding: 14px 32px;
    border-radius: 9999px;
    font-weight: 600;
    font-size: 1rem;
    text-align: center;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    background: linear-gradient(90deg, #F472B6 0%, #C084FC 50%, #60A5FA 100%);
    color: white;
    box-shadow: 0 2px 8px rgba(244, 114, 182, 0.15);
    letter-spacing: 0.01em;
  }

  .homeswap-hero-btn-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(244, 114, 182, 0.2);
    background: linear-gradient(90deg, #EC4899 0%, #A855F7 50%, #3B82F6 100%);
  }

  .homeswap-hero-btn-secondary {
    display: inline-block;
    padding: 14px 32px;
    border-radius: 9999px;
    font-weight: 600;
    font-size: 1rem;
    text-align: center;
    text-decoration: none;
    border: 1.5px solid var(--preply-primary);
    cursor: pointer;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    background: white;
    color: var(--preply-primary);
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    letter-spacing: 0.01em;
  }

  .homeswap-hero-btn-secondary:hover {
    background: rgba(236, 72, 153, 0.03);
    transform: translateY(-1px);
    box-shadow: 0 2px 6px rgba(236, 72, 153, 0.1);
    border-color: var(--preply-primary-dark);
  }

  .homeswap-hero-disclaimer {
    font-size: 0.9375rem;
    color: var(--preply-text-light);
    font-style: italic;
    margin-top: 24px;
  }

  /* ============================================
     DESIGN SYSTEM BOUTONS RAFFINÉS & PREMIUM
     ============================================ */
  
  /* Base commune (tous les boutons) - Style sobre et élégant */
  .btn,
  .btn-primary,
  .btn-outline,
  .btn-secondary {
    display: inline-block;
    padding: 12px 24px;
    border-radius: 9999px;
    font-weight: 600;
    font-size: 0.9375rem;
    text-align: center;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    white-space: nowrap;
    line-height: 1.5;
    letter-spacing: 0.01em;
  }

  .btn:focus-visible,
  .btn-primary:focus-visible,
  .btn-outline:focus-visible,
  .btn-secondary:focus-visible {
    outline: none;
    box-shadow: 0 0 0 3px rgba(236, 72, 153, 0.2);
  }

  .btn:disabled,
  .btn-primary:disabled,
  .btn-outline:disabled,
  .btn-secondary:disabled {
    opacity: 0.5;
    cursor: not-allowed;
    pointer-events: none;
  }

  .btn:active,
  .btn-primary:active,
  .btn-outline:active,
  .btn-secondary:active {
    transform: translateY(0.5px);
    transition-duration: 0.1s;
  }

  /* PRIMARY (gradient raffiné et doux) */
  .btn-primary {
    background: linear-gradient(90deg, #F472B6 0%, #C084FC 50%, #60A5FA 100%);
    color: white;
    box-shadow: 0 2px 8px rgba(244, 114, 182, 0.15);
  }

  .btn-primary:hover:not(:disabled) {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(244, 114, 182, 0.2);
    background: linear-gradient(90deg, #EC4899 0%, #A855F7 50%, #3B82F6 100%);
  }

  /* OUTLINE premium (sobre et élégant) */
  .btn-outline {
    background: white;
    color: var(--preply-primary);
    border: 1.5px solid var(--preply-primary);
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
  }

  .btn-outline:hover:not(:disabled) {
    background: rgba(236, 72, 153, 0.03);
    transform: translateY(-1px);
    box-shadow: 0 2px 6px rgba(236, 72, 153, 0.1);
    border-color: var(--preply-primary-dark);
  }

  /* SECONDARY (sobre) */
  .btn-secondary {
    background: #FAFAFA;
    color: var(--preply-text);
    border: 1px solid #E5E7EB;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
  }

  .btn-secondary:hover:not(:disabled) {
    background: #F5F5F5;
    border-color: #D1D5DB;
    transform: translateY(-0.5px);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.06);
  }

  /* Variantes de taille */
  .btn-sm {
    padding: 10px 20px;
    font-size: 0.875rem;
  }

  .btn-lg {
    padding: 14px 32px;
    font-size: 1rem;
  }

  .btn-full {
    width: 100%;
    display: block;
  }

  /* Section "Trois façons d'échanger" Premium */
  .homeswap-exchange-types {
    background: white;
    padding: 40px 0;
    border-bottom: 1px solid var(--preply-border);
  }

  .homeswap-exchange-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
  }

  .homeswap-exchange-header {
    text-align: center;
    margin-bottom: 32px;
  }

  .homeswap-exchange-title {
    font-size: 2.25rem;
    font-weight: 700;
    color: var(--preply-text);
    margin-bottom: 12px;
  }

  .homeswap-exchange-subtitle {
    font-size: 1rem;
    color: var(--preply-text-light);
    max-width: 700px;
    margin: 0 auto;
    line-height: 1.5;
  }

  .homeswap-exchange-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    align-items: start;
  }

  .homeswap-exchange-card-base {
    background: white;
    border: 1px solid var(--preply-border);
    border-radius: 16px;
    padding: 24px;
    text-align: left;
    cursor: pointer;
    transition: all 0.2s;
    display: flex;
    flex-direction: column;
    align-self: start;
    width: 100%;
  }

  .homeswap-exchange-card {
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
  }

  .homeswap-exchange-card:hover {
    border-color: var(--preply-primary);
    box-shadow: 0 4px 16px rgba(236, 72, 153, 0.1);
  }

  .homeswap-exchange-card-active {
    border: 2px solid var(--preply-primary);
    box-shadow: 0 8px 24px rgba(236, 72, 153, 0.15);
  }

  .homeswap-exchange-card-header-flex {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 12px;
  }

  .homeswap-exchange-badges-wrapper {
    display: flex;
    align-items: center;
    gap: 6px;
    flex-shrink: 0;
    margin-bottom: 12px;
  }

  .homeswap-exchange-card-title {
    font-size: 1.375rem;
    font-weight: 700;
    color: var(--preply-text);
    margin-bottom: 6px;
  }

  .homeswap-exchange-card-description {
    font-size: 0.9375rem;
    color: var(--preply-text-light);
    margin-bottom: 16px;
    line-height: 1.5;
  }

  .homeswap-exchange-badge {
    display: inline-flex;
    align-items: center;
    padding: 4px 10px;
    background: linear-gradient(135deg, #EC4899 0%, #2563EB 100%);
    color: white;
    border-radius: 10px;
    font-size: 0.6875rem;
    font-weight: 600;
    white-space: nowrap;
    flex-shrink: 0;
  }

  .homeswap-exchange-badge-selected {
    display: inline-flex;
    align-items: center;
    padding: 4px 10px;
    background: linear-gradient(90deg, #EC4899 0%, #A855F7 50%, #3B82F6 100%);
    color: white;
    border-radius: 10px;
    font-size: 0.6875rem;
    font-weight: 600;
    white-space: nowrap;
    flex-shrink: 0;
  }

  .homeswap-exchange-card-features {
    list-style: none !important;
    padding: 0 !important;
    margin: 0 !important;
    display: flex;
    flex-direction: column;
    gap: 8px;
  }

  .homeswap-exchange-card-features li {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 0.875rem;
    color: var(--preply-text);
    padding: 0 !important;
    margin: 0 !important;
    list-style: none !important;
  }

  .homeswap-exchange-check {
    color: #10b981;
    font-weight: 700;
    font-size: 0.9375rem;
    flex-shrink: 0;
  }

  /* Panneau de détails séparé (premium) */
  .homeswap-exchange-details-panel {
    margin-top: 32px;
    background: white;
    border: 2px solid var(--preply-primary);
    border-radius: 16px;
    padding: 32px;
    box-shadow: 0 8px 24px rgba(236, 72, 153, 0.15);
  }

  .homeswap-exchange-details-content {
    max-width: 900px;
    margin: 0 auto;
  }

  /* Ligne de confirmation premium */
  .homeswap-exchange-details-confirmation {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 12px 16px;
    background: linear-gradient(135deg, #FCE7F3 0%, #E0E7FF 100%);
    border-radius: 10px;
    margin-bottom: 24px;
    flex-wrap: wrap;
  }

  .homeswap-exchange-details-confirmation-label {
    font-size: 0.875rem;
    color: var(--preply-text-light);
    font-weight: 500;
  }

  .homeswap-exchange-details-confirmation-value {
    font-size: 0.9375rem;
    color: var(--preply-primary);
    font-weight: 700;
  }

  .homeswap-exchange-details-confirmation-note {
    font-size: 0.8125rem;
    color: var(--preply-text-light);
    font-style: italic;
    margin-left: auto;
  }

  .homeswap-exchange-details-header {
    margin-bottom: 24px;
    padding-bottom: 16px;
    border-bottom: 1px solid var(--preply-border);
  }

  .homeswap-exchange-details-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--preply-text);
    margin-bottom: 8px;
  }

  .homeswap-exchange-details-subtitle {
    font-size: 0.9375rem;
    color: var(--preply-text-light);
  }

  .homeswap-exchange-details-body {
    margin-bottom: 24px;
  }

  .homeswap-exchange-details-section {
    margin-bottom: 20px;
  }

  .homeswap-exchange-details-section:last-child {
    margin-bottom: 0;
  }

  /* Wrapper CTA avec micro-note */
  .homeswap-exchange-details-cta-wrapper {
    margin-top: 32px;
    padding-top: 24px;
    border-top: 1px solid var(--preply-border);
  }

  .homeswap-exchange-cta-note {
    font-size: 0.75rem;
    color: var(--preply-text-light);
    text-align: center;
    margin-top: 12px;
    font-style: italic;
  }

  .homeswap-exchange-card-detail {
    font-size: 0.8125rem;
    color: var(--preply-text-light);
    margin-bottom: 8px;
    line-height: 1.5;
  }

  .homeswap-exchange-card-detail strong {
    color: var(--preply-text);
    font-weight: 600;
  }

  .homeswap-exchange-card-cta {
    display: block;
    width: 100%;
    padding: 12px 24px;
    border-radius: 9999px;
    font-weight: 600;
    font-size: 0.9375rem;
    text-align: center;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    background: linear-gradient(90deg, #F472B6 0%, #C084FC 50%, #60A5FA 100%);
    color: white;
    box-shadow: 0 2px 8px rgba(244, 114, 182, 0.15);
    margin-top: 0;
    letter-spacing: 0.01em;
  }

  .homeswap-exchange-card-cta:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(244, 114, 182, 0.2);
    background: linear-gradient(90deg, #EC4899 0%, #A855F7 50%, #3B82F6 100%);
  }

  .homeswap-exchange-card-cta:active {
    transform: translateY(0.5px);
    transition-duration: 0.1s;
  }

  .homeswap-exchange-card-cta:focus-visible {
    outline: none;
    box-shadow: 0 0 0 3px rgba(236, 72, 153, 0.2);
  }

  .homeswap-exchange-points-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 12px;
    margin-bottom: 16px;
  }

  .homeswap-exchange-points-card {
    background: #f9fafb;
    border: 1px solid var(--preply-border);
    border-radius: 10px;
    padding: 12px;
  }

  .homeswap-exchange-points-label {
    font-size: 0.6875rem;
    color: var(--preply-text-light);
    margin-bottom: 6px;
  }

  .homeswap-exchange-points-title {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--preply-text);
    margin-bottom: 6px;
  }

  .homeswap-exchange-points-text {
    font-size: 0.8125rem;
    color: var(--preply-text-light);
    line-height: 1.4;
  }

  .homeswap-exchange-example {
    background: #f9fafb;
    border-radius: 10px;
    padding: 14px;
    margin-bottom: 16px;
  }

  .homeswap-exchange-example-title {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--preply-text);
    margin-bottom: 8px;
  }

  .homeswap-exchange-example-text {
    font-size: 0.8125rem;
    color: var(--preply-text);
    line-height: 1.5;
    margin-bottom: 6px;
  }

  .homeswap-exchange-example-note {
    font-size: 0.6875rem;
    color: var(--preply-text-light);
    line-height: 1.4;
  }

  @media (max-width: 768px) {
    .homeswap-exchange-types {
      padding: 32px 0;
    }

    .homeswap-exchange-header {
      margin-bottom: 24px;
    }

    .homeswap-exchange-title {
      font-size: 1.875rem;
      margin-bottom: 8px;
    }

    .homeswap-exchange-subtitle {
      font-size: 0.9375rem;
    }

    .homeswap-exchange-grid {
      grid-template-columns: 1fr;
      gap: 16px;
    }

    .homeswap-exchange-card-base {
      padding: 20px;
    }

    .homeswap-exchange-details-panel {
      padding: 24px;
      margin-top: 24px;
    }

    .homeswap-exchange-details-confirmation {
      flex-direction: column;
      align-items: flex-start;
      gap: 6px;
    }

    .homeswap-exchange-details-confirmation-note {
      margin-left: 0;
      width: 100%;
    }

    .homeswap-exchange-details-title {
      font-size: 1.25rem;
    }

    .homeswap-exchange-points-grid {
      grid-template-columns: 1fr;
      gap: 10px;
    }
  }

  /* Section "Comment ça marche" */
  .homeswap-how-it-works {
    background: #f9fafb;
    padding: 60px 0;
    border-bottom: 1px solid var(--preply-border);
  }

  .homeswap-how-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
  }

  .homeswap-how-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--preply-text);
    text-align: center;
    margin-bottom: 48px;
  }

  .homeswap-how-steps {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 32px;
  }

  .homeswap-how-step {
    background: white;
    padding: 32px;
    border-radius: 16px;
    border: 1px solid var(--preply-border);
    text-align: center;
  }

  .homeswap-how-step-number {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #EC4899 0%, #2563EB 100%);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    font-weight: 700;
    margin: 0 auto 20px;
  }

  .homeswap-how-step-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--preply-text);
    margin-bottom: 12px;
  }

  .homeswap-how-step-description {
    font-size: 1rem;
    color: var(--preply-text-light);
    line-height: 1.6;
  }

  /* Blocs Premium HomeSwap */
  .homeswap-premium-section {
    background: white;
    padding: 60px 0;
    border-bottom: 1px solid var(--preply-border);
  }

  .homeswap-premium-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
  }

  .homeswap-premium-card {
    background: white;
    border-radius: 24px;
    padding: 40px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    border: 1px solid var(--preply-border);
  }

  .homeswap-premium-header {
    text-align: center;
    margin-bottom: 32px;
  }

  .homeswap-premium-title {
    font-size: 2rem;
    font-weight: 700;
    color: var(--preply-text);
    margin-bottom: 8px;
  }

  .homeswap-premium-subtitle {
    font-size: 1.125rem;
    color: var(--preply-text-light);
  }

  .homeswap-premium-features {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 24px;
    margin-bottom: 32px;
  }

  .homeswap-premium-feature {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 16px;
    background: #f9fafb;
    border-radius: 12px;
  }

  .homeswap-premium-icon {
    width: 24px;
    height: 24px;
    color: var(--preply-primary);
    flex-shrink: 0;
  }

  .homeswap-premium-feature span {
    font-size: 1rem;
    font-weight: 500;
    color: var(--preply-text);
  }

  .homeswap-premium-cta {
    text-align: center;
  }

  .homeswap-premium-btn {
    display: inline-block;
    padding: 14px 32px;
    border-radius: 9999px;
    font-weight: 600;
    font-size: 1rem;
    text-align: center;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    background: linear-gradient(90deg, #F472B6 0%, #C084FC 50%, #60A5FA 100%);
    color: white;
    box-shadow: 0 2px 8px rgba(244, 114, 182, 0.15);
    letter-spacing: 0.01em;
  }

  .homeswap-premium-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(244, 114, 182, 0.2);
    background: linear-gradient(90deg, #EC4899 0%, #A855F7 50%, #3B82F6 100%);
  }

  .homeswap-premium-btn:active {
    transform: translateY(0.5px);
    transition-duration: 0.1s;
  }

  .homeswap-premium-btn:focus-visible {
    outline: none;
    box-shadow: 0 0 0 3px rgba(236, 72, 153, 0.2);
  }

  .homeswap-premium-status {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 12px;
  }

  .homeswap-premium-status-badge {
    display: inline-block;
    background: #10b981;
    color: white;
    font-weight: 600;
    padding: 8px 16px;
    border-radius: 8px;
    font-size: 0.875rem;
  }

  .homeswap-premium-link {
    color: var(--preply-primary);
    text-decoration: underline;
    font-size: 0.9375rem;
  }

  .homeswap-premium-link:hover {
    color: var(--preply-primary-dark);
  }

  /* Options d'accompagnement */
  .homeswap-options-section {
    background: #f9fafb;
    padding: 60px 0;
    border-bottom: 1px solid var(--preply-border);
  }

  .homeswap-options-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
  }

  .homeswap-options-header {
    text-align: center;
    margin-bottom: 48px;
  }

  .homeswap-options-title {
    font-size: 2rem;
    font-weight: 700;
    color: var(--preply-text);
    margin-bottom: 8px;
  }

  .homeswap-options-subtitle {
    font-size: 1.125rem;
    color: var(--preply-text-light);
  }

  .homeswap-options-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 24px;
    margin-bottom: 40px;
  }

  .homeswap-option-card {
    background: white;
    border: 2px solid var(--preply-border);
    border-radius: 16px;
    padding: 32px;
    transition: all 0.2s;
  }

  .homeswap-option-card:hover {
    border-color: var(--preply-primary);
    box-shadow: 0 8px 24px rgba(236, 72, 153, 0.1);
  }

  .homeswap-option-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
  }

  .homeswap-option-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--preply-text);
  }

  .homeswap-option-price {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--preply-primary);
  }

  .homeswap-option-description {
    font-size: 1rem;
    color: var(--preply-text-light);
    margin-bottom: 20px;
    line-height: 1.6;
  }

  .homeswap-option-features {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .homeswap-option-features li {
    padding: 8px 0;
    font-size: 0.9375rem;
    color: var(--preply-text);
    position: relative;
    padding-left: 24px;
  }

  .homeswap-option-features li::before {
    content: "✓";
    position: absolute;
    left: 0;
    color: var(--preply-primary);
    font-weight: 700;
  }

  .homeswap-options-cta {
    text-align: center;
  }

  .homeswap-options-btn {
    display: inline-block;
    padding: 14px 32px;
    border-radius: 9999px;
    font-weight: 600;
    font-size: 1rem;
    text-align: center;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    background: linear-gradient(90deg, #F472B6 0%, #C084FC 50%, #60A5FA 100%);
    color: white;
    box-shadow: 0 2px 8px rgba(244, 114, 182, 0.15);
    letter-spacing: 0.01em;
  }

  .homeswap-options-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(244, 114, 182, 0.2);
    background: linear-gradient(90deg, #EC4899 0%, #A855F7 50%, #3B82F6 100%);
  }

  .homeswap-options-btn:active {
    transform: translateY(0.5px);
    transition-duration: 0.1s;
  }

  .homeswap-options-btn:focus-visible {
    outline: none;
    box-shadow: 0 0 0 3px rgba(236, 72, 153, 0.2);
  }

  /* Encarts Transparence */
  .homeswap-transparency {
    background: white;
    padding: 60px 0;
    border-bottom: 1px solid var(--preply-border);
  }

  .homeswap-transparency-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 32px;
  }

  .homeswap-transparency-card {
    background: #f9fafb;
    padding: 32px;
    border-radius: 16px;
    border: 1px solid var(--preply-border);
  }

  /* Bloc alerte premium "Confiance & prudence" */
  .homeswap-alert-callout {
    background: linear-gradient(to right, rgba(251, 191, 36, 0.08) 0%, rgba(249, 250, 251, 0.5) 100%);
    border-left: 4px solid #F59E0B;
    border-radius: 20px;
    padding: 28px 32px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    display: flex;
    gap: 20px;
    align-items: flex-start;
    position: relative;
    overflow: hidden;
    animation: homeswap-alert-fade-in 0.6s cubic-bezier(0.4, 0, 0.2, 1);
  }

  @media (prefers-reduced-motion: reduce) {
    .homeswap-alert-callout {
      animation: none;
    }
  }

  @keyframes homeswap-alert-fade-in {
    from {
      opacity: 0;
      transform: translateY(8px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .homeswap-alert-icon-wrapper {
    flex-shrink: 0;
    width: 48px;
    height: 48px;
    background: rgba(251, 191, 36, 0.12);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    animation: homeswap-alert-icon-pulse 2s ease-in-out 0.3s 2;
  }

  @media (prefers-reduced-motion: reduce) {
    .homeswap-alert-icon-wrapper {
      animation: none;
    }
  }

  @keyframes homeswap-alert-icon-pulse {
    0%, 100% {
      transform: scale(1);
      opacity: 1;
    }
    50% {
      transform: scale(1.05);
      opacity: 0.9;
    }
  }

  .homeswap-alert-icon {
    width: 24px;
    height: 24px;
    color: #F59E0B;
    stroke-width: 2.5;
  }

  .homeswap-alert-content {
    flex: 1;
    min-width: 0;
  }

  .homeswap-transparency-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #1F2937;
    margin-bottom: 12px;
    letter-spacing: -0.01em;
  }

  .homeswap-transparency-text {
    font-size: 0.9375rem;
    color: #4B5563;
    line-height: 1.7;
    max-width: none;
  }

  .homeswap-transparency-text strong {
    color: #1F2937;
    font-weight: 600;
  }

  @media (max-width: 768px) {
    .homeswap-alert-callout {
      flex-direction: column;
      gap: 16px;
      padding: 24px;
    }

    .homeswap-alert-icon-wrapper {
      align-self: flex-start;
    }
  }

  /* Badges HomeSwap Scoring Premium */
  .homeswap-scoring-badges {
    display: flex;
    flex-direction: column;
    gap: 6px;
    margin-top: 8px;
    margin-bottom: 8px;
  }

  .homeswap-score-badge {
    display: inline-flex;
    align-items: center;
    padding: 4px 10px;
    border-radius: 8px;
    font-size: 0.75rem;
    font-weight: 600;
    background: white;
    border: 1px solid #E2E8F0;
    color: #475569;
    cursor: help;
    width: fit-content;
  }

  .homeswap-points-text {
    font-size: 0.8125rem;
    color: #64748B;
    font-weight: 400;
  }

  @media (max-width: 768px) {
    .homeswap-hero-title {
      font-size: 2rem;
    }

    .homeswap-hero-subtitle {
      font-size: 1.25rem;
    }

    .homeswap-hero-badges {
      flex-direction: column;
      align-items: center;
    }

    .homeswap-hero-cta {
      flex-direction: column;
    }

    .homeswap-hero-btn-primary,
    .homeswap-hero-btn-secondary {
      width: 100%;
    }

    .homeswap-transparency-container {
      grid-template-columns: 1fr;
    }
  }

  /* Carte blanche (design capture 2 / Projets) */
  .homeswap-search-filter-section {
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(250, 248, 255, 0.95) 100%);
    border-radius: 32px;
    padding: 2.5rem;
    margin-bottom: 2rem;
    max-width: 1200px;
    margin-left: auto;
    margin-right: auto;
    box-shadow: 0 20px 60px rgba(236, 72, 153, 0.15), 0 8px 24px rgba(236, 72, 153, 0.1), inset 0 1px 0 rgba(255, 255, 255, 0.9);
    border: 1.5px solid rgba(244, 114, 182, 0.2);
    backdrop-filter: blur(30px);
  }

  /* Barre principale une ligne (style Projets) */
  .homeswap-search-filter-section .homeswap-filter-row-main,
  .homeswap-search-filter-section .filter-row-main {
    display: grid;
    grid-template-columns: 1fr 1fr 1.5fr auto;
    gap: 1rem;
    margin-bottom: 1.5rem;
  }
  .homeswap-search-filter-section .filter-input-group {
    position: relative;
    display: flex;
    align-items: center;
  }
  .homeswap-search-filter-section .filter-input-icon {
    position: absolute;
    left: 1.25rem;
    color: #EC4899;
    font-size: 1.1rem;
    z-index: 2;
    pointer-events: none;
  }
  .homeswap-search-filter-section .filter-input,
  .homeswap-search-filter-section .filter-select-homeswap {
    width: 100%;
    padding: 1rem 1rem 1rem 3.5rem;
    border: 2px solid rgba(244, 114, 182, 0.3);
    border-radius: 16px;
    font-size: 1rem;
    background: #ffffff;
    transition: all 0.3s ease;
    color: #1a202c;
    appearance: auto;
  }
  /* Assistant post-sélection : icônes + bouton info (apparaît après sélection) */
  .homeswap-search-filter-section .filter-input-group {
    position: relative;
  }
  .homeswap-city-assistant {
    position: absolute;
    right: 0.75rem;
    top: 50%;
    transform: translateY(-50%);
    display: flex;
    align-items: center;
    gap: 0.5rem;
    pointer-events: none;
    z-index: 3;
  }
  .homeswap-city-assistant > * {
    pointer-events: auto;
  }
  .homeswap-city-icons {
    display: flex;
    align-items: center;
    gap: 0.35rem;
  }
  .homeswap-city-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 18px;
    height: 18px;
    color: #94a3b8;
    opacity: 0.7;
  }
  .homeswap-city-icon svg {
    width: 100%;
    height: 100%;
  }
  .homeswap-city-icon-popular {
    color: #6b7280;
    opacity: 0.75;
  }
  .homeswap-city-info-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 18px;
    height: 18px;
    padding: 0;
    border: none;
    background: none;
    color: #94a3b8;
    cursor: pointer;
    opacity: 0.6;
    transition: all 0.2s ease;
  }
  .homeswap-city-info-btn:hover {
    opacity: 1;
    color: #EC4899;
  }
  .homeswap-city-info-btn:focus-visible {
    outline: 2px solid #EC4899;
    outline-offset: 2px;
    border-radius: 3px;
  }
  .homeswap-city-info-btn svg {
    width: 100%;
    height: 100%;
  }
  /* Popover informations ville (ultra-premium, discret) */
  .homeswap-city-popover {
    position: fixed;
    z-index: 10000;
    background: #ffffff;
    border: 1px solid rgba(0, 0, 0, 0.08);
    border-radius: 12px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12), 0 2px 8px rgba(0, 0, 0, 0.08);
    min-width: 240px;
    max-width: 320px;
    animation: homeswapPopoverFadeIn 0.2s ease;
  }
  @keyframes homeswapPopoverFadeIn {
    from {
      opacity: 0;
      transform: translateY(-4px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
  .homeswap-city-popover-content {
    padding: 1rem;
  }
  .homeswap-city-popover-content p + p {
    margin-top: 0.5rem;
  }
  .homeswap-city-popover-section {
    margin-bottom: 0.75rem;
  }
  .homeswap-city-popover-section:last-child {
    margin-bottom: 0;
  }
  .homeswap-city-popover-title {
    font-size: 0.8125rem;
    font-weight: 600;
    color: #1e293b;
    margin: 0 0 0.35rem 0;
  }
  .homeswap-city-popover-text {
    font-size: 0.75rem;
    color: #64748b;
    line-height: 1.5;
    margin: 0;
  }
  .homeswap-city-popover-badge {
    color: #6b7280;
    font-weight: 500;
  }
  .homeswap-search-filter-section .filter-input:focus,
  .homeswap-search-filter-section .filter-select-homeswap:focus {
    outline: none;
    border-color: #EC4899;
    box-shadow: 0 0 0 4px rgba(236, 72, 153, 0.1);
  }
  .homeswap-search-filter-section .filter-input::placeholder {
    color: #9ca3af;
  }
  /* Micro-badges villes : style discret dans les options (via JS) */
  .homeswap-search-filter-section .filter-select-homeswap option {
    font-size: 1rem;
  }
  /* Tooltip personnalisé pour badges villes (affiché au survol du select) */
  .homeswap-city-tooltip {
    position: absolute;
    bottom: 100%;
    left: 50%;
    transform: translateX(-50%);
    margin-bottom: 8px;
    background: #1e293b;
    color: #f8fafc;
    font-size: 0.75rem;
    padding: 0.5rem 0.75rem;
    border-radius: 8px;
    white-space: nowrap;
    z-index: 1000;
    pointer-events: none;
    opacity: 0;
    transition: opacity 0.2s ease;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
  }
  .homeswap-city-tooltip::after {
    content: '';
    position: absolute;
    top: 100%;
    left: 50%;
    transform: translateX(-50%);
    border: 5px solid transparent;
    border-top-color: #1e293b;
  }
  .homeswap-search-filter-section .filter-input-group:hover .homeswap-city-tooltip {
    opacity: 1;
  }
  .homeswap-search-filter-section .filter-submit-btn {
    padding: 1rem 2.5rem;
    background: linear-gradient(135deg, #EC4899 0%, #F472B6 50%, #2563EB 100%);
    color: #ffffff;
    border: none;
    border-radius: 16px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    white-space: nowrap;
    box-shadow: 0 4px 12px rgba(236, 72, 153, 0.3);
  }
  .homeswap-search-filter-section .filter-submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(236, 72, 153, 0.4);
  }
  .homeswap-search-filter-section .homeswap-date-picker-wrapper {
    position: relative;
  }
  .homeswap-search-filter-section .homeswap-date-picker-wrapper .homeswap-date-display {
    padding-right: 2.75rem;
  }
  .homeswap-search-filter-section .homeswap-date-icon-right {
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: #EC4899;
    pointer-events: none;
    font-size: 1rem;
  }
  .homeswap-search-filter-section .filter-advanced-toggle {
    text-align: center;
    margin: 1.5rem 0;
  }
  .homeswap-search-filter-section .filter-advanced-btn {
    background: none;
    border: none;
    color: #EC4899;
    font-size: 0.95rem;
    font-weight: 600;
    cursor: pointer;
    padding: 0.5rem 1rem;
    display: inline-flex;
    align-items: center;
    transition: all 0.3s ease;
  }
  .homeswap-search-filter-section .filter-advanced-btn:hover {
    color: #2563EB;
  }

  /* Onglets Rechercher un Rituel / Déposer un projet (comme page Projet) */
  .homeswap-search-filter-section .filter-tabs-container {
    margin-bottom: 1.5rem;
  }
  .homeswap-search-filter-section .filter-tabs {
    display: flex;
    gap: 1rem;
    border-bottom: 2px solid rgba(244, 114, 182, 0.2);
    padding-bottom: 0.5rem;
  }
  .homeswap-search-filter-section .filter-tab {
    background: none;
    border: none;
    padding: 0.875rem 1.75rem;
    font-size: 1rem;
    font-weight: 600;
    color: #6b7280;
    cursor: pointer;
    transition: all 0.3s ease;
    border-radius: 12px 12px 0 0;
    position: relative;
    display: flex;
    align-items: center;
  }
  .homeswap-search-filter-section .filter-tab:hover {
    color: #EC4899;
    background: rgba(236, 72, 153, 0.05);
  }
  .homeswap-search-filter-section .filter-tab.active {
    color: #EC4899;
    background: rgba(236, 72, 153, 0.1);
  }
  .homeswap-search-filter-section .filter-tab.active::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(135deg, #EC4899 0%, #F472B6 50%, #2563EB 100%);
    border-radius: 2px 2px 0 0;
  }
  .homeswap-search-filter-section .filter-content {
    display: none;
  }
  .homeswap-search-filter-section .filter-content.active {
    display: block;
  }
  .homeswap-search-filter-section .submit-project-cta {
    text-align: center;
    padding: 3rem 2rem;
  }
  .homeswap-search-filter-section .submit-project-content {
    max-width: 600px;
    margin: 0 auto;
  }
  .homeswap-search-filter-section .submit-project-title {
    font-size: 1.75rem;
    font-weight: 700;
    color: #1a202c;
    margin-bottom: 1rem;
  }
  .homeswap-search-filter-section .submit-project-text {
    font-size: 1.1rem;
    color: #6b7280;
    margin-bottom: 2rem;
    line-height: 1.6;
  }
  .homeswap-search-filter-section .submit-project-btn {
    display: inline-flex;
    align-items: center;
    padding: 1rem 2.5rem;
    background: linear-gradient(135deg, #EC4899 0%, #F472B6 50%, #2563EB 100%);
    color: #ffffff;
    text-decoration: none;
    border-radius: 16px;
    font-size: 1.1rem;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(236, 72, 153, 0.3);
  }
  .homeswap-search-filter-section .submit-project-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(236, 72, 153, 0.4);
  }

  /* ============================================
     FILTRES HOMESWAP - Structure en 3 blocs premium
     ============================================ */
  
  .homeswap-filters-form {
    margin-bottom: 40px;
  }

  /* Bloc opportunité : ville en devenir (aucun résultat + ville sélectionnée) */
  .homeswap-opportunity-block {
    text-align: center;
    max-width: 560px;
    margin: 0 auto;
    padding: 3rem 2rem;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(250, 248, 255, 0.95) 100%);
    border-radius: 24px;
    border: 1px solid rgba(244, 114, 182, 0.15);
    box-shadow: 0 8px 32px rgba(236, 72, 153, 0.08);
  }
  .homeswap-opportunity-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1e293b;
    margin: 0 0 1rem 0;
    line-height: 1.3;
  }
  .homeswap-opportunity-text {
    font-size: 1.0625rem;
    color: #475569;
    line-height: 1.6;
    margin: 0 0 0.75rem 0;
  }
  .homeswap-opportunity-text-secondary {
    font-size: 0.9375rem;
    color: #64748b;
    line-height: 1.6;
    margin: 0 0 1.75rem 0;
  }
  .homeswap-opportunity-cta {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 1rem 2rem;
    background: linear-gradient(135deg, #EC4899 0%, #F472B6 50%, #2563EB 100%);
    color: #ffffff;
    text-decoration: none;
    border-radius: 16px;
    font-size: 1rem;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(236, 72, 153, 0.3);
  }
  .homeswap-opportunity-cta:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(236, 72, 153, 0.4);
    color: #ffffff;
  }

  /* Panneau Filtres avancés : 2 niveaux, pas de cadre (comme capture 3 / Projets) */
  .homeswap-filters-form .homeswap-filters-advanced-panel {
    background: transparent;
    border-radius: 0;
    padding-top: 1.5rem;
    padding-bottom: 2rem;
    padding-left: 0;
    padding-right: 0;
    box-shadow: none;
    margin-top: 0;
    border-top: 1px solid rgba(244, 114, 182, 0.2);
  }

  .homeswap-filters-block {
    margin-bottom: 40px;
    padding-bottom: 32px;
    border-bottom: 1px solid var(--preply-border);
  }

  .homeswap-filters-block:last-of-type {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
  }

  .homeswap-filters-block-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--preply-text);
    margin-bottom: 24px;
    display: flex;
    align-items: center;
  }

  .homeswap-filters-block-title i {
    color: var(--preply-primary);
    margin-right: 8px;
  }

  .homeswap-filters-block-content {
    display: flex;
    flex-direction: column;
    gap: 24px;
  }

  .homeswap-filter-group {
    display: flex;
    flex-direction: column;
    gap: 12px;
  }

  .homeswap-filter-label {
    font-size: 0.9375rem;
    font-weight: 500;
    color: var(--preply-text);
    display: flex;
    align-items: center;
  }

  .homeswap-filter-label i {
    color: var(--preply-primary-light);
    margin-right: 8px;
  }

  .homeswap-filter-input,
  .homeswap-filter-select {
    width: 100%;
    padding: 12px 16px;
    border: 1px solid var(--preply-border);
    border-radius: 10px;
    font-size: 0.9375rem;
    background: white;
    color: var(--preply-text);
    transition: all 0.2s ease;
  }

  .homeswap-filter-input:focus,
  .homeswap-filter-select:focus {
    outline: none;
    border-color: var(--preply-primary);
    box-shadow: 0 0 0 3px rgba(236, 72, 153, 0.1);
  }

  .homeswap-filter-input:hover,
  .homeswap-filter-select:hover {
    border-color: var(--preply-primary-light);
  }

  /* Dates du séjour (barre principale + panneau) */
  .homeswap-date-picker-wrapper {
    position: relative;
  }
  .homeswap-date-input-with-icon {
    position: relative;
    display: flex;
    align-items: center;
  }
  .homeswap-date-input-with-icon .homeswap-date-display {
    padding-right: 40px;
  }
  .homeswap-date-icon {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--preply-text-light);
    pointer-events: none;
    font-size: 0.9375rem;
  }
  .homeswap-date-range-wrapper {
    display: flex;
    flex-direction: column;
    gap: 12px;
  }

  .homeswap-date-inputs {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
  }

  .homeswap-date-input-group {
    display: flex;
    flex-direction: column;
    gap: 6px;
  }

  .homeswap-date-label {
    font-size: 0.8125rem;
    color: var(--preply-text-light);
    font-weight: 400;
  }

  .homeswap-date-input {
    width: 100%;
  }

  .homeswap-date-text-input {
    width: 100%;
  }

  .homeswap-date-options-group {
    margin-bottom: 2rem;
  }
  .homeswap-date-options {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
  }

  /* Checkboxes */
  .homeswap-checkboxes-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 16px;
  }

  .homeswap-checkbox-label {
    display: flex;
    align-items: center;
    cursor: pointer;
    user-select: none;
  }

  .homeswap-checkbox-input {
    display: none;
  }

  .homeswap-checkbox-custom {
    width: 20px;
    height: 20px;
    border: 2px solid var(--preply-border);
    border-radius: 4px;
    margin-right: 10px;
    position: relative;
    flex-shrink: 0;
    transition: all 0.2s ease;
  }

  .homeswap-checkbox-input:checked + .homeswap-checkbox-custom {
    background: var(--preply-primary);
    border-color: var(--preply-primary);
  }

  .homeswap-checkbox-input:checked + .homeswap-checkbox-custom::after {
    content: '✓';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: white;
    font-size: 12px;
    font-weight: bold;
  }

  .homeswap-checkbox-text {
    font-size: 0.9375rem;
    color: var(--preply-text);
  }

  /* Caractéristiques du logement */
  .homeswap-characteristics-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
    gap: 16px;
  }

  .homeswap-characteristic-item {
    display: flex;
    flex-direction: column;
    gap: 8px;
  }

  .homeswap-characteristic-label {
    font-size: 0.8125rem;
    color: var(--preply-text-light);
    font-weight: 400;
  }

  /* Bouton Réinitialiser */
  .homeswap-filters-actions {
    margin-top: 32px;
    padding-top: 24px;
    border-top: 1px solid var(--preply-border);
    display: flex;
    justify-content: center;
  }

  .homeswap-reset-btn {
    padding: 10px 20px;
    background: transparent;
    border: 1px solid var(--preply-border);
    border-radius: 8px;
    color: var(--preply-text-light);
    font-size: 0.9375rem;
    cursor: pointer;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
  }

  .homeswap-reset-btn:hover {
    border-color: var(--preply-primary);
    color: var(--preply-primary);
    background: rgba(236, 72, 153, 0.05);
  }

  /* Input conditionnel */
  .homeswap-conditional-input {
    width: 100%;
  }

  /* Barre de recherche principale (style Projet) */
  .homeswap-search-main {
    background: white;
    border-radius: 16px;
    padding: 24px 32px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    margin-bottom: 0;
  }
  .homeswap-search-main-inner {
    display: flex;
    flex-wrap: wrap;
    align-items: flex-end;
    gap: 16px 24px;
  }
  .homeswap-search-field {
    flex: 1;
    min-width: 180px;
    display: flex;
    flex-direction: column;
    gap: 8px;
  }
  .homeswap-search-label {
    font-size: 0.9375rem;
    font-weight: 500;
    color: var(--preply-text);
    display: flex;
    align-items: center;
  }
  .homeswap-search-label i {
    color: var(--preply-primary-light);
    margin-right: 8px;
  }
  .homeswap-search-submit {
    flex-shrink: 0;
  }
  .homeswap-search-btn {
    display: inline-flex;
    align-items: center;
    padding: 12px 24px;
    border-radius: 12px;
    font-weight: 600;
    font-size: 0.9375rem;
    border: none;
    cursor: pointer;
    transition: all 0.25s ease;
    background: linear-gradient(90deg, var(--preply-primary) 0%, var(--preply-primary-light) 100%);
    color: white;
    box-shadow: 0 2px 8px rgba(236, 72, 153, 0.25);
  }
  .homeswap-search-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(236, 72, 153, 0.35);
  }

  /* Bouton Filtres avancés (identique univers Projet) */
  .homeswap-filters-advanced-toggle {
    text-align: center;
    margin: 1.5rem 0;
  }
  .homeswap-filters-advanced-btn {
    background: none;
    border: none;
    color: var(--preply-primary);
    font-size: 0.95rem;
    font-weight: 600;
    cursor: pointer;
    padding: 0.5rem 1rem;
    display: inline-flex;
    align-items: center;
    transition: all 0.3s ease;
    border-radius: 8px;
  }
  .homeswap-filters-advanced-btn:hover {
    color: var(--preply-primary-light);
    background: rgba(236, 72, 153, 0.06);
  }
  .homeswap-filters-advanced-btn:focus-visible {
    outline: none;
    box-shadow: 0 0 0 3px rgba(236, 72, 153, 0.2);
  }
  .homeswap-filters-advanced-chevron {
    font-size: 0.75rem;
    transition: transform 0.3s ease;
  }
  .homeswap-filters-advanced-btn[aria-expanded="true"] .homeswap-filters-advanced-chevron {
    transform: rotate(180deg);
  }

  /* Panneau Filtres avancés (état ouvert/fermé via .is-open, pas seulement display) */
  .homeswap-filters-advanced-panel {
    display: none;
    padding-top: 1.5rem;
    padding-bottom: 0;
    border-top: 1px solid rgba(236, 72, 153, 0.15);
    overflow: hidden;
    transition: opacity 0.3s ease;
  }
  .homeswap-filters-advanced-panel.is-open {
    display: block !important;
  }

  /* Responsive */
  @media (max-width: 768px) {
    .homeswap-search-filter-section {
      padding: 1.5rem;
      border-radius: 24px;
    }
    .homeswap-search-filter-section .filter-tabs {
      flex-direction: column;
      gap: 0.5rem;
    }
    .homeswap-search-filter-section .filter-tab {
      width: 100%;
      justify-content: center;
    }
    .homeswap-search-filter-section .homeswap-filter-row-main,
    .homeswap-search-filter-section .filter-row-main {
      grid-template-columns: 1fr;
    }
    .homeswap-search-filter-section .filter-submit-btn {
      width: 100%;
      justify-content: center;
    }
    .homeswap-search-field {
      min-width: 0;
    }
    .homeswap-search-submit {
      width: 100%;
    }
    .homeswap-search-btn {
      width: 100%;
      justify-content: center;
    }
    .homeswap-filters-form .homeswap-filters-advanced-panel {
      padding-top: 1.5rem;
      padding-bottom: 1.5rem;
    }

    .homeswap-filters-block {
      margin-bottom: 32px;
      padding-bottom: 24px;
    }

    .homeswap-date-inputs {
      grid-template-columns: 1fr;
    }

    .homeswap-checkboxes-grid {
      grid-template-columns: 1fr;
    }

    .homeswap-characteristics-grid {
      grid-template-columns: 1fr;
    }
  }

  /* Barre de filtres horizontaux Preply */
  .preply-filters-section {
    background: var(--preply-bg);
    padding: 24px 0;
    border-bottom: 1px solid var(--preply-border);
    position: sticky;
    top: 0;
    z-index: 100;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
  }

  .preply-filters-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
  }

  .preply-filters-row {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    align-items: center;
    margin-bottom: 16px;
  }

  .preply-filter-group {
    position: relative;
    min-width: 200px;
    flex: 1;
  }

  .preply-filter-label {
    font-size: 0.875rem;
    color: var(--preply-text-light);
    margin-bottom: 4px;
    display: block;
  }

  .preply-filter-select,
  .preply-filter-input {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid var(--preply-border);
    border-radius: 8px;
    font-size: 0.9375rem;
    background: var(--preply-bg);
    color: var(--preply-text);
    cursor: pointer;
    transition: all 0.2s;
  }

  .preply-filter-select:hover,
  .preply-filter-input:hover {
    border-color: var(--preply-primary);
  }

  /* DROPDOWNS PREMIUM HOMESWAP — Styles complets (copie depuis Projects) */
  
  /* Dropdown Domaine */
  .domain-dropdown-wrapper {
    position: relative;
  }

  .domain-dropdown-trigger {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid var(--preply-border);
    border-radius: 8px;
    font-size: 0.9375rem;
    background: rgba(255, 255, 255, 0.98);
    color: var(--preply-text);
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 2px 8px rgba(15, 23, 42, 0.08);
  }

  .domain-dropdown-trigger:hover {
    border-color: rgba(236, 72, 153, 0.3);
    box-shadow: 0 4px 12px rgba(15, 23, 42, 0.12);
    transform: translateY(-1px);
  }

  .domain-dropdown-trigger.active {
    border-color: var(--preply-primary);
    box-shadow: 0 4px 12px rgba(236, 72, 153, 0.2);
  }

  .domain-selected-text {
    flex: 1;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }

  .domain-arrow {
    font-size: 0.75rem;
    color: var(--preply-text-light);
    transition: transform 0.2s;
    transform: rotate(0deg);
  }

  .domain-dropdown-trigger.active .domain-arrow {
    transform: rotate(180deg);
  }

  .domain-dropdown-menu {
    position: absolute;
    bottom: calc(100% + 8px);
    left: 0;
    right: 0;
    background: var(--preply-bg);
    border: 1px solid var(--preply-border);
    border-radius: 12px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    z-index: 10000 !important;
    max-height: 400px;
    overflow-y: auto;
  }

  .domain-option {
    padding: 10px 16px;
    cursor: pointer;
    transition: background-color 0.2s;
    color: var(--preply-text);
    font-size: 0.9375rem;
  }

  .domain-option:hover {
    background-color: var(--preply-hover);
  }

  .domain-option.selected {
    background-color: rgba(236, 72, 153, 0.1);
    color: var(--preply-primary);
    font-weight: 500;
  }

  .domain-option .domain-option-label {
    display: block;
    font-weight: 500;
  }

  .domain-option .domain-option-desc {
    display: block;
    font-size: 0.8125rem;
    color: var(--preply-text-light);
    font-weight: 400;
    margin-top: 2px;
  }

  /* Micro-description premium sous le filtre Domaine */
  .domain-premium-desc {
    margin-top: 8px;
    padding: 10px 12px;
    background: rgba(249, 250, 251, 0.95);
    border: 1px solid rgba(229, 231, 235, 0.8);
    border-radius: 8px;
    font-size: 0.8125rem;
    line-height: 1.45;
    color: var(--preply-text-light);
    transition: opacity 0.2s ease;
  }
  
  .domain-premium-desc-icon {
    color: rgba(236, 72, 153, 0.6);
    margin-right: 6px;
    font-size: 0.7rem;
  }

  /* Container et z-index */
  .filters-level, .filters-level-inner, .preply-filter-advanced, .preply-filter-group {
    position: relative;
  }
  
  .container-filters-premium {
    position: relative;
    z-index: 1;
  }
  
  .domain-dropdown-menu {
    z-index: 10000 !important;
  }

  /* Loading state */
  .preply-results-section.is-loading {
    position: relative;
  }

  .preply-results-section.is-loading::before {
    content: '';
    position: absolute;
    inset: 0;
    background: rgba(255, 255, 255, 0.7);
    z-index: 10;
    pointer-events: none;
  }

  .preply-results-section.is-loading::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 32px;
    height: 32px;
    border: 3px solid rgba(236, 72, 153, 0.2);
    border-top-color: var(--preply-primary);
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
    z-index: 11;
  }

  @keyframes spin {
    to { transform: translate(-50%, -50%) rotate(360deg); }
  }

  .preply-filter-select:focus,
  .preply-filter-input:focus {
    outline: none;
    border-color: var(--preply-primary);
    box-shadow: 0 0 0 3px rgba(236, 72, 153, 0.1);
  }

  /* Interface de sélection de disponibilité */
  .preply-availability-group {
    position: relative;
  }

  .preply-availability-trigger {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid var(--preply-border);
    border-radius: 8px;
    font-size: 0.9375rem;
    background: var(--preply-bg);
    color: var(--preply-text);
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: all 0.2s;
  }

  .preply-availability-trigger:hover {
    border-color: var(--preply-primary);
  }

  .preply-availability-trigger i {
    font-size: 0.75rem;
    transition: transform 0.2s;
  }

  .preply-availability-trigger.active i {
    transform: rotate(180deg);
  }

  .preply-availability-panel {
    position: absolute;
    top: calc(100% + 8px);
    left: 0;
    right: 0;
    background: var(--preply-bg);
    border: 1px solid var(--preply-border);
    border-radius: 12px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    padding: 20px;
    z-index: 1000;
    display: none;
    max-height: 500px;
    overflow-y: auto;
  }

  .preply-availability-panel.active {
    display: block;
  }

  .availability-section {
    margin-bottom: 24px;
  }

  .availability-section:last-of-type {
    margin-bottom: 0;
  }

  .availability-section-title {
    font-size: 1rem;
    font-weight: 600;
    color: var(--preply-text);
    margin-bottom: 12px;
  }

  .availability-time-group {
    margin-bottom: 16px;
  }

  .availability-time-label {
    font-size: 0.875rem;
    color: var(--preply-text-light);
    margin-bottom: 8px;
    font-weight: 500;
  }

  .availability-time-slots {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
  }

  .availability-time-btn {
    padding: 10px 16px;
    border: 1px solid var(--preply-border);
    border-radius: 8px;
    background: var(--preply-bg);
    color: var(--preply-text);
    cursor: pointer;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 4px;
    font-size: 0.875rem;
    transition: all 0.2s;
    min-width: 70px;
  }

  .availability-time-btn:hover {
    border-color: var(--preply-primary);
    background: var(--preply-hover);
  }

  .availability-time-btn.selected {
    background: linear-gradient(135deg, var(--preply-primary-dark) 0%, var(--preply-primary) 50%, var(--preply-primary-light) 100%);
    color: white;
    border-color: var(--preply-primary);
  }

  .availability-time-btn i {
    font-size: 1rem;
  }

  .availability-days {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
  }

  .availability-day-btn {
    flex: 1;
    min-width: 50px;
    padding: 10px 12px;
    border: 1px solid var(--preply-border);
    border-radius: 8px;
    background: var(--preply-bg);
    color: var(--preply-text);
    cursor: pointer;
    font-size: 0.875rem;
    font-weight: 500;
    transition: all 0.2s;
    text-align: center;
  }

  .availability-day-btn:hover {
    border-color: var(--preply-primary);
    background: var(--preply-hover);
  }

  .availability-day-btn.selected {
    background: linear-gradient(135deg, var(--preply-primary-dark) 0%, var(--preply-primary) 50%, var(--preply-primary-light) 100%);
    color: white;
    border-color: var(--preply-primary);
  }

  .availability-actions {
    display: flex;
    gap: 8px;
    margin-top: 20px;
    padding-top: 16px;
    border-top: 1px solid var(--preply-border);
  }

  .availability-clear-btn,
  .availability-apply-btn {
    flex: 1;
    padding: 10px 16px;
    border-radius: 8px;
    font-size: 0.875rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    border: none;
  }

  .availability-clear-btn {
    background: var(--preply-bg);
    color: var(--preply-text);
    border: 1px solid var(--preply-border);
  }

  .availability-clear-btn:hover {
    background: var(--preply-hover);
  }

  .availability-apply-btn {
    padding: 12px 24px;
    border-radius: 9999px;
    font-weight: 600;
    font-size: 0.9375rem;
    text-align: center;
    border: none;
    cursor: pointer;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    background: linear-gradient(90deg, #F472B6 0%, #C084FC 50%, #60A5FA 100%);
    color: white;
    box-shadow: 0 2px 8px rgba(244, 114, 182, 0.15);
    letter-spacing: 0.01em;
  }

  .availability-apply-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(244, 114, 182, 0.2);
    background: linear-gradient(90deg, #EC4899 0%, #A855F7 50%, #3B82F6 100%);
  }

  .availability-apply-btn:active {
    transform: translateY(0.5px);
    transition-duration: 0.1s;
  }

  .availability-apply-btn:focus-visible {
    outline: none;
    box-shadow: 0 0 0 3px rgba(236, 72, 153, 0.2);
  }

  .preply-filters-advanced {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    margin-top: 12px;
  }

  .preply-filter-advanced {
    min-width: 150px;
    flex: 0 1 auto;
  }

  .preply-search-input {
    flex: 1;
    min-width: 200px;
  }

  /* Résultats et tri */
  .preply-results-section {
    background: var(--preply-bg);
    padding: 32px 0;
    overflow: visible; /* Permettre à la vidéo de dépasser */
  }

  .preply-results-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
    overflow: visible; /* Permettre à la vidéo de dépasser */
    position: relative;
  }

  .preply-results-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
    flex-wrap: wrap;
    gap: 16px;
  }

  .preply-results-count {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--preply-text);
  }

  .preply-sort-select {
    padding: 8px 12px;
    border: 1px solid var(--preply-border);
    border-radius: 8px;
    font-size: 0.9375rem;
    background: var(--preply-bg);
    color: var(--preply-text);
    cursor: pointer;
  }

  /* ============================================
     CARTES PROFESSEURS PREPLY - Duplication exacte
     Mesures contractuelles strictes
     ============================================ */
  
  .preply-teachers-list {
    display: flex;
    flex-direction: column;
    gap: 16px; /* Espacement réduit entre cartes pour effet compact */
    max-width: 808px; /* Largeur réduite de 2cm (75px) : 883px - 75px */
    margin: 0 auto;
    padding: 0;
  }

  /* Wrapper pour chaque carte */
  .preply-teacher-card-wrapper {
    position: relative;
    width: 100%;
    max-width: 980px;
    margin: 0 auto;
  }

  /* Carte principale - Duplication exacte Preply (compacte + premium) */
  .preply-teacher-card {
    background: var(--preply-bg);
    border: 1px solid rgba(0, 0, 0, 0.08); /* Border subtile comme Preply */
    border-radius: 12px;
    padding: 18px; /* Padding réduit pour carte compacte */
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06), 0 1px 2px rgba(0, 0, 0, 0.04); /* Ombre douce Preply */
    display: grid;
    grid-template-columns: 135px 1fr 240px; /* Col A (photo fixe agrandie de 0.5cm) | Col B (infos) | Col C (prix/CTA) */
    gap: 16px; /* Gap réduit pour compacité */
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); /* Transition premium fluide */
    position: relative;
    width: 100%;
    min-height: auto;
  }

  /* Effet premium au hover - Élévation subtile comme Preply */
  .preply-teacher-card:hover {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08), 0 2px 4px rgba(0, 0, 0, 0.04); /* Ombre plus prononcée */
    transform: translateY(-2px); /* Légère élévation premium */
    border-color: rgba(0, 0, 0, 0.12); /* Border légèrement plus visible */
  }

  /* ============================================
     COLONNE PHOTO - ESPACE FIXE OBLIGATOIRE (compacte)
     Jamais de collapse, toujours 100px
     ============================================ */
  .preply-teacher-photo {
    width: 135px; /* Colonne photo agrandie pour accommoder l'avatar de 115px + espace */
    flex-shrink: 0; /* Interdit le rétrécissement */
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  /* Conteneur avatar - Photo carrée Preply (pas ronde) - AGRANDIE de 0.5cm */
  .preply-teacher-photo-avatar {
    width: 115px; /* Taille agrandie de 0.5cm (19px) : 96px + 19px */
    height: 115px; /* Photo carrée agrandie */
    border-radius: 8px; /* Coins arrondis subtils */
    overflow: visible !important; /* IMPORTANT: permettre aux badges de dépasser */
    position: relative !important; /* IMPORTANT: pour le positionnement absolu des badges */
    flex-shrink: 0;
    background: #f3f4f6; /* Fond placeholder */
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); /* Ombre subtile sur photo */
  }
  
  .preply-teacher-photo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    display: block;
    border-radius: 8px;
  }

  /* Placeholder si pas d'image - Même taille, pas de collapse */
  .preply-teacher-photo-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #EC4899 0%, #F472B6 50%, #2563EB 100%);
    color: white;
    font-size: 1.75rem; /* Taille réduite pour carte compacte */
    font-weight: 600;
    border-radius: 8px;
  }

  .preply-teacher-badge {
    position: absolute;
    bottom: -2px;
    right: -2px;
    background: var(--preply-primary);
    color: white;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
    border: 2px solid white;
    z-index: 2;
  }

  /* Badge "En ligne" vert en angle droit */
  .preply-teacher-online-badge {
    position: absolute;
    top: -2px;
    right: -2px;
    background: #10b981; /* Vert */
    color: white;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 0.6875rem; /* 11px */
    font-weight: 600;
    white-space: nowrap;
    border: 2px solid white;
    z-index: 10 !important; /* Z-index élevé pour être visible */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
    display: block !important; /* Forcer l'affichage */
  }

  /* Badge gris "Dernière connexion" avec tooltip - Petit point */
  .preply-teacher-last-seen-badge {
    position: absolute;
    top: -2px;
    right: -2px;
    width: 8px;
    height: 8px;
    background: #6b7280; /* Gris */
    border-radius: 50%;
    border: 2px solid white;
    z-index: 10 !important; /* Z-index élevé pour être visible */
    cursor: pointer;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
    display: block !important; /* Forcer l'affichage */
  }

  /* Tooltip pour dernière connexion - CACHÉ par défaut */
  .preply-teacher-last-seen-tooltip {
    position: absolute;
    bottom: calc(100% + 8px);
    right: 0;
    background: #1f2937; /* Gris foncé */
    color: white;
    padding: 8px 12px;
    border-radius: 6px;
    font-size: 0.75rem; /* 12px */
    white-space: nowrap;
    opacity: 0 !important; /* Forcer à être caché */
    visibility: hidden !important; /* Forcer à être caché */
    pointer-events: none;
    transition: opacity 0.2s, visibility 0.2s;
    z-index: 10;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
    display: none !important; /* Cacher complètement par défaut */
  }

  /* Flèche du tooltip */
  .preply-teacher-last-seen-tooltip::after {
    content: '';
    position: absolute;
    top: 100%;
    right: 12px;
    width: 0;
    height: 0;
    border-left: 6px solid transparent;
    border-right: 6px solid transparent;
    border-top: 6px solid #1f2937;
  }

  /* Afficher le tooltip UNIQUEMENT au survol */
  .preply-teacher-last-seen-badge:hover .preply-teacher-last-seen-tooltip {
    opacity: 1 !important;
    visibility: visible !important;
    display: block !important; /* Afficher uniquement au survol */
  }

  /* Informations professeur - Style Preply exact */
  .preply-teacher-info {
    flex: 1;
    min-width: 0;
  }

  .preply-teacher-name {
    font-size: 1rem; /* Taille réduite pour compacité */
    font-weight: 600;
    color: var(--preply-text);
    margin-bottom: 2px; /* Espacement réduit */
    display: flex;
    align-items: center;
    gap: 6px;
    line-height: 1.3;
  }
  
  /* Masquer tout texte "Dernière connexion" visible sur la carte */
  .preply-teacher-info *:not(.preply-teacher-last-seen-tooltip) {
    /* S'assurer qu'aucun texte "Dernière connexion" n'est visible */
  }
  
  /* Masquer spécifiquement les éléments contenant "Dernière connexion" */
  .preply-teacher-info [data-last-seen]::before,
  .preply-teacher-info [data-last-seen]::after {
    display: none !important;
  }

  .preply-teacher-name a {
    color: var(--preply-text);
    text-decoration: none;
  }

  .preply-teacher-name a:hover {
    color: var(--preply-primary);
  }

  .preply-teacher-verified {
    color: var(--preply-primary);
    font-size: 0.875rem;
  }

  .preply-teacher-country {
    font-size: 0.8125rem; /* Taille réduite */
    color: var(--preply-text-light);
    margin-bottom: 4px; /* Espacement réduit */
  }

  .preply-teacher-subject {
    font-size: 0.8125rem; /* Taille réduite */
    color: var(--preply-text);
    margin-bottom: 4px; /* Espacement réduit */
    font-weight: 500;
  }

  .preply-teacher-languages {
    font-size: 0.8125rem; /* Taille réduite */
    color: var(--preply-text-light);
    margin-bottom: 8px; /* Espacement réduit */
  }

  .preply-teacher-bio {
    font-size: 0.875rem; /* Taille réduite */
    color: var(--preply-text);
    line-height: 1.5;
    margin-bottom: 8px; /* Espacement réduit */
  }

  .preply-teacher-learn-more {
    color: var(--preply-primary);
    font-size: 0.8125rem; /* Taille réduite */
    font-weight: 600;
    text-decoration: none;
    display: inline-block;
    margin-bottom: 6px; /* Espacement réduit */
    transition: color 0.2s;
  }

  .preply-teacher-learn-more:hover {
    text-decoration: underline;
    color: var(--preply-primary-dark);
  }

  .preply-teacher-popularity {
    font-size: 0.8125rem; /* Taille réduite */
    color: var(--preply-text-light);
    margin-bottom: 0; /* Pas de marge en bas */
  }

  /* Prix et CTA - Colonne actions Preply (compacte) */
  .preply-teacher-pricing {
    width: 240px; /* Colonne actions Preply */
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 6px; /* Gap réduit */
  }

  .preply-teacher-price {
    font-size: 1.375rem; /* Taille réduite */
    font-weight: 700;
    color: var(--preply-text);
    text-align: right;
    line-height: 1.2;
  }

  .preply-teacher-price-label {
    font-size: 0.8125rem; /* Taille réduite */
    color: var(--preply-text-light);
  }

  .preply-teacher-rating {
    display: flex;
    align-items: center;
    gap: 4px;
    margin-bottom: 2px; /* Espacement réduit */
  }

  .preply-teacher-rating-score {
    font-size: 1rem; /* Taille réduite */
    font-weight: 600;
    color: var(--preply-text);
  }

  .preply-teacher-rating-count {
    font-size: 0.8125rem; /* Taille réduite */
    color: var(--preply-text-light);
  }

  .preply-teacher-stats {
    font-size: 0.8125rem; /* Taille réduite */
    color: var(--preply-text-light);
    margin-bottom: 12px; /* Espacement réduit */
    line-height: 1.4;
  }

  .preply-teacher-btn {
    padding: 10px 16px; /* Padding réduit */
    border-radius: 8px;
    font-size: 0.875rem; /* Taille réduite */
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1); /* Transition premium */
    text-decoration: none;
    display: inline-block;
    text-align: center;
    width: 100%;
  }

  .preply-teacher-btn-primary {
    background: linear-gradient(135deg, var(--preply-primary-dark) 0%, var(--preply-primary) 50%, var(--preply-primary-light) 100%);
    color: white;
    border: none;
    margin-bottom: 6px; /* Espacement réduit */
    box-shadow: 0 2px 4px rgba(236, 72, 153, 0.2); /* Ombre subtile */
  }

  /* Effet premium au hover */
  .preply-teacher-btn-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(236, 72, 153, 0.35), 0 2px 4px rgba(236, 72, 153, 0.2); /* Ombre plus prononcée */
  }

  .preply-teacher-btn-secondary {
    background: var(--preply-bg);
    color: var(--preply-text);
    border: 1px solid var(--preply-border);
  }

  .preply-teacher-btn-secondary:hover {
    background: var(--preply-hover);
    border-color: var(--preply-primary);
  }

  /* ============================================
     POPOVER VIDÉO PREPLY - Duplication exacte
     Portal (position: fixed) + Hoverable + Flèche toggle
     ============================================ */
  
  /* Popover vidéo unique (portal au niveau body) */
  #preply-video-popover {
    position: fixed;
    width: 320px; /* 300-340px comme spécifié */
    background: var(--preply-bg);
    border-radius: 12px;
    border: 1px solid rgba(0, 0, 0, 0.10);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
    padding: 0;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.1s ease-out, 
                visibility 0.1s ease-out; /* Open: 80-120ms */
    z-index: 9999;
    pointer-events: none;
    overflow: hidden;
  }

  #preply-video-popover.is-visible {
    opacity: 1;
    visibility: visible;
    pointer-events: all;
  }

  /* Flèche pour toggle gauche/droite */
  .preply-popover-arrow {
    position: absolute;
    top: 12px;
    width: 28px;
    height: 28px;
    background: rgba(255, 255, 255, 0.9);
    border: 1px solid rgba(0, 0, 0, 0.1);
    border-radius: 6px;
    display: none; /* Masqué par défaut, affiché par JS selon le côté */
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s;
    z-index: 10;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  .preply-popover-arrow:hover {
    background: rgba(255, 255, 255, 1);
    border-color: rgba(0, 0, 0, 0.2);
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
  }

  .preply-popover-arrow.arrow-left {
    left: 8px;
  }

  .preply-popover-arrow.arrow-right {
    right: 8px;
  }

  .preply-popover-arrow i {
    font-size: 0.75rem;
    color: var(--preply-text);
  }

  /* Vidéo thumbnail - Bloc vidéo rectangle */
  .preply-popover-video-thumbnail {
    width: 100%;
    height: 200px;
    border-radius: 12px 12px 0 0;
    overflow: hidden;
    position: relative;
    background: #000;
  }

  .preply-popover-video-thumbnail img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
  }

  /* Bouton play rond rose bleu royal Homeswap */
  .preply-popover-play-btn {
    position: absolute;
    bottom: 12px;
    right: 12px;
    width: 52px;
    height: 52px;
    background: linear-gradient(135deg, #EC4899 0%, #F472B6 50%, #2563EB 100%); /* Rose bleu royal */
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.25rem;
    cursor: pointer;
    transition: all 0.2s;
    border: none;
    z-index: 5;
    box-shadow: 0 4px 12px rgba(236, 72, 153, 0.4);
  }

  .preply-popover-play-btn:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 16px rgba(236, 72, 153, 0.5);
  }

  .preply-popover-play-btn i {
    margin-left: 2px;
  }

  /* Actions vidéo - 2 boutons pleine largeur */
  .preply-popover-actions {
    display: flex;
    flex-direction: column;
    gap: 8px;
    padding: 12px;
  }

  .preply-popover-action-btn {
    padding: 10px 16px;
    background: var(--preply-bg);
    border: 1px solid var(--preply-border);
    border-radius: 8px;
    font-size: 0.875rem;
    color: var(--preply-text);
    text-decoration: none;
    text-align: center;
    transition: all 0.2s;
    width: 100%;
  }

  .preply-popover-action-btn:hover {
    background: var(--preply-hover);
    border-color: var(--preply-primary);
  }

  /* Responsive */
  @media (max-width: 1024px) {
    .preply-teacher-card {
      grid-template-columns: 72px 1fr;
      gap: 12px;
    }

    .preply-teacher-pricing {
      grid-column: 1 / -1;
      width: 100%;
      align-items: flex-start;
      margin-top: 12px;
    }

    .preply-teacher-card {
      grid-template-columns: 96px 1fr;
      gap: 16px;
    }

    .preply-teacher-photo {
      width: 115px; /* Taille agrandie de 0.5cm sur tablette aussi */
    }

    .preply-teacher-pricing {
      grid-column: 1 / -1;
      width: 100%;
      align-items: flex-start;
      margin-top: 12px;
    }

    /* Sur mobile/tablette : masquer popover vidéo hover */
    #preply-video-popover {
      display: none !important;
    }

    .preply-teacher-card-mobile-video-btn {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 8px 12px;
      background: var(--preply-bg);
      border: 1px solid var(--preply-border);
      border-radius: 8px;
      font-size: 0.875rem;
      color: var(--preply-text);
      text-decoration: none;
      margin-top: 8px;
    }
  }

  @media (max-width: 768px) {
    .preply-filters-row {
      flex-direction: column;
    }

    .preply-filter-group {
      width: 100%;
    }

    .preply-teachers-list {
      max-width: 100%;
      padding: 0 16px;
    }

    .preply-teacher-card-wrapper {
      max-width: 100%;
    }

    .preply-teacher-card {
      padding: 16px;
      border-width: 1px;
    }
  }

  /* Desktop: bouton mobile vidéo masqué */
  .preply-teacher-card-mobile-video-btn {
    display: none;
  }

  /* Dropdown Premium Pays de naissance */
  .country-dropdown-wrapper {
    position: relative;
  }

  .country-dropdown-trigger {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid var(--preply-border);
    border-radius: 8px;
    font-size: 0.9375rem;
    background: rgba(255, 255, 255, 0.98);
    color: var(--preply-text);
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 2px 8px rgba(15, 23, 42, 0.08);
  }

  .country-dropdown-trigger:hover {
    border-color: rgba(139, 92, 246, 0.3);
    box-shadow: 0 4px 12px rgba(15, 23, 42, 0.12);
    transform: translateY(-1px);
  }

  .country-dropdown-trigger.active {
    border-color: var(--preply-primary);
    box-shadow: 0 4px 12px rgba(139, 92, 246, 0.2);
  }

  .country-selected-text {
    flex: 1;
  }

  .country-arrow {
    font-size: 0.75rem;
    color: var(--preply-text-light);
    transition: transform 0.2s;
    transform: rotate(0deg);
  }

  .country-dropdown-trigger.active .country-arrow {
    transform: rotate(180deg);
  }

  .country-dropdown-menu {
    position: absolute;
    top: calc(100% + 8px);
    left: 0;
    right: 0;
    background: var(--preply-bg);
    border: 1px solid var(--preply-border);
    border-radius: 12px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    z-index: 1001;
    max-height: 400px;
    overflow-y: auto;
    padding: 8px;
  }

  .country-search-wrapper {
    position: relative;
    margin-bottom: 12px;
  }

  .country-search-icon {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--preply-text-light);
    font-size: 0.875rem;
    pointer-events: none;
  }

  .country-search-input {
    width: 100%;
    padding: 10px 12px 10px 36px;
    border: 1px solid var(--preply-border);
    border-radius: 8px;
    font-size: 0.875rem;
    background: rgba(255, 255, 255, 0.98);
    color: var(--preply-text);
    outline: none;
    transition: all 0.2s;
  }

  .country-search-input:focus {
    border-color: var(--preply-primary);
    box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
  }

  .country-popular-header {
    font-weight: 600;
    font-size: 0.875rem;
    color: var(--preply-text);
    margin-bottom: 8px;
    padding: 0 4px;
  }

  .country-list {
    display: flex;
    flex-direction: column;
    gap: 2px;
  }

  .country-option {
    display: flex;
    align-items: center;
    padding: 10px 12px;
    cursor: pointer;
    border-radius: 8px;
    transition: background-color 0.2s;
    gap: 12px;
  }

  .country-option:hover {
    background-color: var(--preply-hover);
  }

  .country-option.selected {
    background-color: rgba(139, 92, 246, 0.1);
  }

  .country-flag {
    width: 24px;
    height: 24px;
    border-radius: 4px;
    flex-shrink: 0;
    object-fit: cover;
    font-size: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .country-name {
    flex: 1;
    font-size: 0.875rem;
    color: var(--preply-text);
  }

  .country-option.selected .country-name {
    color: var(--preply-primary);
    font-weight: 500;
  }

  .country-checkbox {
    width: 18px;
    height: 18px;
    border: 2px solid var(--preply-border);
    border-radius: 4px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
  }

  .country-option.selected .country-checkbox {
    background-color: var(--preply-primary);
    border-color: var(--preply-primary);
  }

  .country-option.selected .country-checkbox::after {
    content: '✓';
    color: white;
    font-size: 12px;
    font-weight: bold;
  }

  .country-no-results {
    padding: 16px;
    text-align: center;
    color: var(--preply-text-light);
    font-size: 0.875rem;
  }

  .country-all-section {
    margin-top: 12px;
    padding-top: 12px;
    border-top: 1px solid var(--preply-border);
  }

  /* Dropdown Premium "Je parle" */
  .language-dropdown-wrapper {
    position: relative;
  }

  .language-dropdown-trigger {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid var(--preply-border);
    border-radius: 8px;
    font-size: 0.9375rem;
    background: rgba(255, 255, 255, 0.98);
    color: var(--preply-text);
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 2px 8px rgba(15, 23, 42, 0.08);
  }

  .language-dropdown-trigger:hover {
    border-color: rgba(139, 92, 246, 0.3);
    box-shadow: 0 4px 12px rgba(15, 23, 42, 0.12);
    transform: translateY(-1px);
  }

  .language-dropdown-trigger.active {
    border-color: var(--preply-primary);
    box-shadow: 0 4px 12px rgba(139, 92, 246, 0.2);
  }

  .language-selected-text {
    flex: 1;
  }

  .language-arrow {
    font-size: 0.75rem;
    color: var(--preply-text-light);
    transition: transform 0.2s;
    transform: rotate(0deg);
  }

  .language-dropdown-trigger.active .language-arrow {
    transform: rotate(180deg);
  }

  .language-dropdown-menu {
    position: absolute;
    top: calc(100% + 8px);
    left: 0;
    right: 0;
    background: var(--preply-bg);
    border: 1px solid var(--preply-border);
    border-radius: 12px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    z-index: 1001;
    max-height: 400px;
    overflow-y: auto;
    padding: 8px;
  }

  .language-search-wrapper {
    position: relative;
    margin-bottom: 12px;
  }

  .language-search-icon {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--preply-text-light);
    font-size: 0.875rem;
    pointer-events: none;
  }

  .language-search-input {
    width: 100%;
    padding: 10px 12px 10px 36px;
    border: 1px solid var(--preply-border);
    border-radius: 8px;
    font-size: 0.875rem;
    background: rgba(255, 255, 255, 0.98);
    color: var(--preply-text);
    outline: none;
    transition: all 0.2s;
  }

  .language-search-input:focus {
    border-color: var(--preply-primary);
    box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
  }

  .language-popular-header {
    font-weight: 600;
    font-size: 0.875rem;
    color: var(--preply-text);
    margin-bottom: 8px;
    padding: 0 4px;
  }

  .language-list {
    display: flex;
    flex-direction: column;
    gap: 2px;
  }

  .language-option {
    display: flex;
    align-items: center;
    padding: 10px 12px;
    cursor: pointer;
    border-radius: 8px;
    transition: background-color 0.2s;
    gap: 12px;
  }

  .language-option:hover {
    background-color: var(--preply-hover);
  }

  .language-option.selected {
    background-color: rgba(139, 92, 246, 0.1);
  }

  .language-name {
    flex: 1;
    font-size: 0.875rem;
    color: var(--preply-text);
  }

  .language-option.selected .language-name {
    color: var(--preply-primary);
    font-weight: 500;
  }

  .language-checkbox {
    width: 18px;
    height: 18px;
    border: 2px solid var(--preply-border);
    border-radius: 4px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
  }

  .language-option.selected .language-checkbox {
    background-color: var(--preply-primary);
    border-color: var(--preply-primary);
  }

  .language-option.selected .language-checkbox::after {
    content: '✓';
    color: white;
    font-size: 12px;
    font-weight: bold;
  }

  .language-no-results {
    padding: 16px;
    text-align: center;
    color: var(--preply-text-light);
    font-size: 0.875rem;
  }

  .language-all-section {
    margin-top: 12px;
    padding-top: 12px;
    border-top: 1px solid var(--preply-border);
  }

  .language-reset-option {
    margin-top: 12px;
    padding-top: 12px;
    border-top: 1px solid var(--preply-border);
  }

  .language-reset-option .language-name {
    font-weight: 600;
  }

  /* Popover Premium "Langue maternelle" - Freelances natifs uniquement */
  .native-only-wrapper {
    position: relative;
  }

  .native-only-trigger {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid var(--preply-border);
    border-radius: 8px;
    font-size: 0.9375rem;
    background: rgba(255, 255, 255, 0.98);
    color: var(--preply-text);
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 2px 8px rgba(15, 23, 42, 0.08);
  }

  .native-only-trigger:hover {
    border-color: rgba(139, 92, 246, 0.3);
    box-shadow: 0 4px 12px rgba(15, 23, 42, 0.12);
    transform: translateY(-1px);
  }

  .native-only-trigger.active {
    border-color: var(--preply-primary);
    box-shadow: 0 4px 12px rgba(139, 92, 246, 0.2);
  }

  .native-only-text {
    flex: 1;
  }

  .native-only-arrow {
    font-size: 0.75rem;
    color: var(--preply-text-light);
    transition: transform 0.2s;
    transform: rotate(0deg);
  }

  .native-only-trigger.active .native-only-arrow {
    transform: rotate(180deg);
  }

  .native-only-popover {
    position: absolute;
    top: calc(100% + 8px);
    left: 0;
    right: 0;
    background: var(--preply-bg);
    border: 1px solid var(--preply-border);
    border-radius: 12px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    z-index: 1001;
    padding: 20px;
    min-width: 280px;
  }

  .native-only-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
  }

  .native-only-title {
    font-weight: 600;
    font-size: 0.9375rem;
    color: var(--preply-text);
    flex: 1;
  }

  .native-only-toggle-wrapper {
    position: relative;
    display: inline-block;
    width: 44px;
    height: 24px;
    flex-shrink: 0;
    margin-left: 16px;
  }

  .native-only-toggle-input {
    opacity: 0;
    width: 0;
    height: 0;
  }

  .native-only-toggle-slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #e0e0e0;
    transition: 0.3s;
    border-radius: 24px;
  }

  .native-only-toggle-slider:before {
    position: absolute;
    content: "";
    height: 18px;
    width: 18px;
    left: 3px;
    bottom: 3px;
    background-color: white;
    transition: 0.3s;
    border-radius: 50%;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
  }

  .native-only-toggle-input:checked + .native-only-toggle-slider {
    background-color: var(--preply-primary);
  }

  .native-only-toggle-input:checked + .native-only-toggle-slider:before {
    transform: translateX(20px);
  }

  .native-only-description {
    font-size: 0.875rem;
    color: var(--preply-text-light);
    line-height: 1.5;
    margin: 0;
  }

  /* Panel Premium "Catégories de freelances" */
  .category-filter-wrapper {
    position: relative;
  }

  .category-filter-trigger {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid var(--preply-border);
    border-radius: 8px;
    font-size: 0.9375rem;
    background: rgba(255, 255, 255, 0.98);
    color: var(--preply-text);
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 2px 8px rgba(15, 23, 42, 0.08);
  }

  .category-filter-trigger:hover {
    border-color: rgba(139, 92, 246, 0.3);
    box-shadow: 0 4px 12px rgba(15, 23, 42, 0.12);
    transform: translateY(-1px);
  }

  .category-filter-trigger.active {
    border-color: var(--preply-primary);
    box-shadow: 0 4px 12px rgba(139, 92, 246, 0.2);
  }

  .category-filter-text {
    flex: 1;
  }

  .category-filter-arrow {
    font-size: 0.75rem;
    color: var(--preply-text-light);
    transition: transform 0.2s;
    transform: rotate(0deg);
  }

  .category-filter-trigger.active .category-filter-arrow {
    transform: rotate(180deg);
  }

  .category-filter-panel {
    position: absolute;
    top: calc(100% + 8px);
    left: 0;
    right: 0;
    background: var(--preply-bg);
    border: 1px solid var(--preply-border);
    border-radius: 16px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    z-index: 1001;
    padding: 20px;
    min-width: 320px;
  }

  .category-filter-card {
    display: flex;
    gap: 16px;
    align-items: flex-start;
  }

  .category-filter-card-icon {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    font-size: 20px;
  }

  .category-filter-card-icon.super-icon {
    background: linear-gradient(135deg, #EDE9FE 0%, #DDD6FE 100%);
    color: var(--preply-primary);
  }

  .category-filter-card-icon.qualified-icon {
    background: linear-gradient(135deg, #DBEAFE 0%, #BFDBFE 100%);
    color: var(--preply-primary-light);
  }

  .category-filter-card-content {
    flex: 1;
  }

  .category-filter-card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 8px;
  }

  .category-filter-card-title {
    font-weight: 600;
    font-size: 0.9375rem;
    color: var(--preply-text);
    flex: 1;
  }

  .category-filter-card-description {
    font-size: 0.875rem;
    color: var(--preply-text-light);
    line-height: 1.5;
    margin: 0;
  }

  .category-filter-toggle-wrapper {
    position: relative;
    display: inline-block;
    width: 44px;
    height: 24px;
    flex-shrink: 0;
    margin-left: 16px;
  }

  .category-filter-toggle-input {
    opacity: 0;
    width: 0;
    height: 0;
  }

  .category-filter-toggle-slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #e0e0e0;
    transition: 0.3s;
    border-radius: 24px;
  }

  .category-filter-toggle-slider:before {
    position: absolute;
    content: "";
    height: 18px;
    width: 18px;
    left: 3px;
    bottom: 3px;
    background-color: white;
    transition: 0.3s;
    border-radius: 50%;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
  }

  .category-filter-toggle-input:checked + .category-filter-toggle-slider {
    background-color: var(--preply-primary);
  }

  .category-filter-toggle-input:checked + .category-filter-toggle-slider:before {
    transform: translateX(20px);
  }

  .category-filter-separator {
    height: 1px;
    background: var(--preply-border);
    margin: 16px 0;
  }

  /* Modèle de recherche premium (style capsule) */
  .search-box-modern {
    background: rgba(255, 255, 255, 0.98);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border-radius: 999px;
    padding: 3px;
    box-shadow: 0 4px 12px rgba(15, 23, 42, 0.15);
    width: 100%;
    border: 1px solid rgba(255, 255, 255, 0.4);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    height: 48px;
    display: flex;
    align-items: center;
  }

  .search-box-modern:hover {
    box-shadow: 0 6px 16px rgba(15, 23, 42, 0.2);
    transform: translateY(-1px);
  }

  .search-box-modern input {
    border: none;
    height: 42px;
    padding: 0 20px;
    font-size: 0.9375rem;
    background: transparent;
    color: #1a202c;
    font-weight: 400;
    flex: 1;
  }

  .search-box-modern input::placeholder {
    color: #9CA3AF;
    font-weight: 400;
    font-size: 0.9375rem;
  }

  .search-box-modern input:focus {
    outline: none;
    box-shadow: none;
  }

  /* Bouton loupe rond intégré (style premium) */
  .search-box-modern .btn-search {
    background: linear-gradient(90deg, #EC4899 0%, #A855F7 50%, #3B82F6 100%);
    color: white;
    border: none;
    width: 42px;
    height: 42px;
    border-radius: 50%;
    font-weight: 500;
    font-size: 1rem;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 4px 16px rgba(236, 72, 153, 0.25);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    padding: 0;
    margin-right: 3px;
    cursor: pointer;
  }

  .search-box-modern .btn-search i {
    font-size: 1rem;
    margin: 0;
  }

  .search-box-modern .btn-search:hover {
    transform: scale(1.05) translateY(-2px);
    box-shadow: 0 8px 24px rgba(236, 72, 153, 0.4);
    filter: brightness(1.05);
  }

  .search-box-modern .btn-search:active {
    transform: scale(1.0) translateY(0);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
  }

  .search-box-modern .btn-search:focus-visible {
    outline: none;
    ring: 2px;
    ring-color: rgba(236, 72, 153, 0.5);
    ring-offset: 2px;
  }

  /* ============================================
     CARTES FREELANCES PREMIUM - Style Projects
     ============================================ */
  .freelancers-list-wrapper {
    overflow: visible !important;
    z-index: 1;
  }

  .freelancer-card-premium-v2 {
    background: #FFFFFF;
    border-radius: 24px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04), 0 1px 3px rgba(0, 0, 0, 0.02);
    border: 1px solid #E5E7EB;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    overflow: visible !important;
    position: relative;
    z-index: 1;
    width: 100%;
    padding: 0.5rem 1.75rem;
    min-height: 200px;
    max-width: 100%;
    box-sizing: border-box;
    display: flex;
    align-items: stretch;
  }

  @media (min-width: 1200px) {
    .freelancer-card-premium-v2 {
      max-width: 68%;
      margin-right: auto;
    }
  }

  .freelancer-card__content {
    display: flex;
    align-items: stretch;
    width: 100%;
    max-width: 100%;
    margin-right: 0;
    flex: 1;
    min-width: 0;
    position: relative;
  }

  .freelancer-card-premium-v2 .freelancer-quick-view-v2 {
    left: calc(100% + 1.5rem) !important;
  }

  .freelancer-card-premium-v2:hover {
    box-shadow: 0 12px 32px rgba(0, 0, 0, 0.12), 0 6px 16px rgba(0, 0, 0, 0.08);
    transform: translateY(-3px);
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
  }

  .freelancer-card-content {
    display: grid;
    grid-template-columns: auto 1fr auto;
    gap: 10px;
    align-items: flex-start;
    padding: 0;
    width: 100%;
  }

  .freelancer-photo-section {
    position: relative;
    flex-shrink: 0;
    display: flex;
    gap: 10px;
    align-items: flex-start;
    width: auto;
    min-width: 260px;
    max-width: 300px;
    padding-bottom: 8px;
  }

  .freelancer-identity-block {
    flex: 1;
    min-width: 0;
    display: flex;
    flex-direction: column;
    gap: 4px;
  }

  .freelancer-photo-container {
    position: relative;
    width: 138px;
    height: 138px;
    flex-shrink: 0;
    overflow: visible;
    margin-bottom: 0;
  }

  .freelancer-status-dot-wrapper {
    position: absolute;
    bottom: 4px;
    right: 4px;
    z-index: 10;
    cursor: pointer;
  }

  .freelancer-status-dot-wrapper .status-dot {
    width: 14px;
    height: 14px;
    border-radius: 50%;
    border: 2px solid white;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
    display: block;
    transition: transform 0.2s;
  }

  .freelancer-status-dot-wrapper .status-dot.status-online {
    background: #10B981;
    animation: pulse-online 2s ease-in-out infinite;
  }

  .freelancer-status-dot-wrapper .status-dot.status-offline {
    background: #9CA3AF;
  }

  .freelancer-status-text-wrapper {
    position: absolute;
    bottom: -28px;
    left: 0;
    right: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 4px;
    font-size: 11px;
    font-weight: 500;
    color: #6B7280;
    white-space: nowrap !important;
    max-width: 100%;
    overflow: hidden;
    text-overflow: ellipsis;
    opacity: 0 !important;
    visibility: hidden !important;
    transition: opacity 0.2s ease, visibility 0.2s ease;
    z-index: 5;
    pointer-events: none;
    padding: 0 4px;
    box-sizing: border-box;
    flex-wrap: nowrap !important;
    line-height: 1.2;
  }

  .freelancer-status-dot-wrapper:hover ~ .freelancer-status-text-wrapper,
  .freelancer-photo-container:hover .freelancer-status-dot-wrapper:hover ~ .freelancer-status-text-wrapper {
    opacity: 1 !important;
    visibility: visible !important;
  }

  .status-dot-inline {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    display: inline-block;
    flex-shrink: 0;
  }

  .status-dot-inline.status-online {
    background: #10B981;
  }

  .status-dot-inline.status-offline {
    background: #9CA3AF;
  }

  .status-text-inline {
    color: #6B7280;
    font-weight: 500;
    max-width: 100%;
    overflow: hidden;
    text-overflow: ellipsis;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 2px;
    line-height: 1.3;
  }

  .status-line-1,
  .status-line-2 {
    display: block;
    width: 100%;
    text-align: center;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .status-line-2 {
    font-size: 10px;
    color: #9CA3AF;
  }

  .freelancer-job-line {
    font-size: 14px;
    font-weight: 500;
    color: #374151;
    margin-top: 4px;
    line-height: 1.4;
  }

  .freelancer-headline {
    font-size: 14px;
    font-weight: 500;
    color: #374151;
    line-height: 1.4;
    margin: 4px 0 2px 0;
  }

  .freelancer-photo-img {
    width: 100%;
    height: 100%;
    border-radius: 20px;
    object-fit: cover;
    object-position: center center;
    border: 2px solid rgba(255, 255, 255, 0.95);
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1), 0 2px 8px rgba(0, 0, 0, 0.06), inset 0 0 0 1px rgba(255, 255, 255, 0.4);
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    background: #F9FAFB;
    display: block;
  }

  .freelancer-photo-placeholder {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #6366F1 0%, #8B5CF6 50%, #7C3AED 100%);
    border: 2px solid rgba(255, 255, 255, 0.95);
    box-shadow: 0 4px 16px rgba(99, 102, 241, 0.2), 0 2px 8px rgba(124, 58, 237, 0.15), inset 0 0 0 1px rgba(255, 255, 255, 0.4);
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
  }

  .photo-initial {
    font-size: 58px;
    font-weight: 700;
    color: white;
    text-shadow: 0 2px 8px rgba(0, 0, 0, 0.25), 0 1px 4px rgba(0, 0, 0, 0.15);
    letter-spacing: -1px;
    line-height: 1;
  }

  .freelancer-badge-overlay {
    position: absolute;
    top: -6px;
    right: -6px;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 3px solid white;
    box-shadow: 0 3px 12px rgba(0, 0, 0, 0.15), 0 1px 4px rgba(0, 0, 0, 0.1);
    z-index: 15;
    background: white;
    transition: transform 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    pointer-events: none;
  }

  .freelancer-badge-overlay.badge-verified {
    background: linear-gradient(135deg, #10B981 0%, #059669 100%);
    border-color: white;
  }

  .freelancer-badge-overlay.badge-verified i {
    color: white;
    font-size: 16px;
  }

  .freelancer-badge-overlay.badge-top {
    background: linear-gradient(135deg, #FCD34D 0%, #F59E0B 100%);
    border-color: white;
  }

  .freelancer-badge-overlay.badge-top i {
    color: white;
    font-size: 14px;
  }

  .freelancer-info-section {
    flex: 1;
    min-width: 0;
    max-width: 100%;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    padding: 0 8px;
    margin-right: 0.5rem;
  }

  .freelancer-name-v2 {
    font-size: 22px;
    font-weight: 600;
    color: #111827;
    margin: 0 0 4px 0;
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
  }

  .freelancer-name-v2 a {
    color: inherit;
    text-decoration: none;
    transition: color 0.2s;
  }

  .freelancer-name-v2 a:hover {
    color: var(--preply-primary);
  }

  .verified-icon-v2 {
    color: #10B981;
    font-size: 18px;
  }

  .freelancer-bio-wrapper {
    margin: 0 0 4px 0;
  }

  .freelancer-bio-v2 {
    font-size: 14px;
    line-height: 1.5;
    color: #4B5563;
    margin: 0;
    font-weight: 400;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  .freelancer-learn-more-v2 {
    font-size: 14px;
    font-weight: 500;
    color: var(--preply-primary);
    text-decoration: none;
    display: inline-block;
    margin-bottom: 6px;
    transition: color 0.2s;
  }

  .freelancer-learn-more-v2:hover {
    color: var(--preply-primary-dark);
    text-decoration: underline;
  }

  .freelancer-popularity-v2 {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    color: #6B7280;
    margin-top: 4px;
  }

  .freelancer-popularity-v2 i {
    color: #10B981;
  }

  .freelancer-pricing-section {
    flex-shrink: 0;
    width: 200px;
    min-width: 200px;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 12px;
    border-left: 1px solid #E5E7EB;
    padding-left: 10px;
    position: relative;
  }

  .freelancer-favorite-btn {
    position: absolute;
    top: 0;
    right: 0;
    background: none;
    border: none;
    color: #9CA3AF;
    font-size: 20px;
    cursor: pointer;
    padding: 4px;
    transition: all 0.2s;
    z-index: 5;
    width: 28px;
    height: 28px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .freelancer-favorite-btn:hover {
    color: #EF4444;
    transform: scale(1.1);
  }

  .freelancer-favorite-btn.active {
    color: #EF4444;
  }

  .freelancer-price-v2 {
    text-align: right;
    position: relative;
    margin-right: 28px;
    padding-top: 4px;
  }

  .price-amount {
    font-size: 28px;
    font-weight: 700;
    color: #111827;
    line-height: 1;
  }

  .price-label {
    font-size: 13px;
    color: #6B7280;
    margin-top: 4px;
  }

  .freelancer-rating-v2 {
    display: flex;
    align-items: center;
    gap: 6px;
    margin-top: 8px;
  }

  .rating-number {
    font-size: 20px;
    font-weight: 700;
    color: #111827;
  }

  .rating-stars-v2 {
    color: #FCD34D;
    font-size: 16px;
  }

  .rating-count {
    font-size: 13px;
    color: #6B7280;
  }

  .freelancer-stats-v2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 8px;
    width: 100%;
    margin-top: 4px;
  }

  .stat-item-v2 {
    background: #F9FAFB;
    border-radius: 8px;
    padding: 12px;
    text-align: center;
  }

  .stat-number {
    display: block;
    font-size: 20px;
    font-weight: 700;
    color: #111827;
    line-height: 1;
  }

  .stat-label-v2 {
    display: block;
    font-size: 11px;
    color: #6B7280;
    margin-top: 4px;
    font-weight: 500;
  }

  .freelancer-cta-v2 {
    display: flex;
    flex-direction: column;
    gap: 6px;
    width: 100%;
    margin-top: 4px;
  }

  .cta-primary-v2 {
    padding: 12px 24px;
    border-radius: 9999px;
    font-weight: 600;
    font-size: 0.9375rem;
    text-align: center;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    background: linear-gradient(90deg, #F472B6 0%, #C084FC 50%, #60A5FA 100%);
    color: white;
    box-shadow: 0 2px 8px rgba(244, 114, 182, 0.15);
    letter-spacing: 0.01em;
  }

  .cta-primary-v2:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(244, 114, 182, 0.2);
    background: linear-gradient(90deg, #EC4899 0%, #A855F7 50%, #3B82F6 100%);
    color: white;
  }

  .cta-primary-v2:active {
    transform: translateY(0.5px);
    transition-duration: 0.1s;
  }

  .cta-primary-v2:focus-visible {
    outline: none;
    box-shadow: 0 0 0 3px rgba(236, 72, 153, 0.2);
  }

  .cta-secondary-v2 {
    padding: 12px 24px;
    border-radius: 9999px;
    font-weight: 600;
    font-size: 0.9375rem;
    text-align: center;
    text-decoration: none;
    border: 1px solid #E5E7EB;
    cursor: pointer;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    background: #FAFAFA;
    color: var(--preply-text);
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
    letter-spacing: 0.01em;
  }

  .cta-secondary-v2:hover {
    background: #F5F5F5;
    border-color: #D1D5DB;
    color: var(--preply-text);
    transform: translateY(-0.5px);
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.06);
  }

  .cta-secondary-v2:active {
    transform: translateY(0.5px);
    transition-duration: 0.1s;
  }

  .cta-secondary-v2:focus-visible {
    outline: none;
    box-shadow: 0 0 0 3px rgba(236, 72, 153, 0.2);
  }

  .freelancer-card-premium-v2 .freelancer-quick-view-v2,
  .freelancers-list-wrapper .freelancer-quick-view-v2 {
    position: absolute !important;
    top: 0 !important;
    transform: translateX(-10px) !important;
    left: calc(100% + 1.5rem) !important;
    right: auto !important;
    width: 340px !important;
    max-width: 340px !important;
    height: 100% !important;
    min-height: auto;
    max-height: none;
    background: #FFFFFF;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15), 0 4px 16px rgba(0, 0, 0, 0.1);
    padding: 0;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1), visibility 0.3s cubic-bezier(0.4, 0, 0.2, 1), transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    z-index: 100 !important;
    pointer-events: none;
    overflow: hidden;
    display: flex;
    flex-direction: column;
  }

  .freelancer-card-premium-v2:hover .freelancer-quick-view-v2,
  .freelancers-list-wrapper .freelancer-card-premium-v2:hover .freelancer-quick-view-v2,
  .freelancers-list-wrapper .freelancer-card-wrapper-premium:hover .freelancer-quick-view-v2 {
    opacity: 1 !important;
    visibility: visible !important;
    transform: translateX(0) !important;
    pointer-events: all !important;
  }

  @media (max-width: 1024px) {
    .freelancer-card-premium-v2 {
      flex-direction: column;
    }
    
    .freelancer-card__content {
      max-width: 100% !important;
      margin-right: 0 !important;
      flex-direction: column;
    }
    
    .freelancer-card-content {
      grid-template-columns: 1fr;
      gap: 16px;
    }
    
    .freelancers-list-wrapper .freelancer-quick-view-v2 {
      position: static !important;
      transform: none !important;
      width: 100% !important;
      max-width: 100% !important;
      margin: 1rem 0 0 0 !important;
      top: auto !important;
      left: auto !important;
      right: auto !important;
    }
  }

  @media (max-width: 768px) {
    .freelancer-quick-view-v2 {
      display: none !important;
    }
  }

  .quick-view-content-v2 {
    display: flex;
    flex-direction: column;
  }

  .quick-view-video-section {
    position: relative;
    width: 100%;
    height: 45%;
    min-height: 169px;
    max-height: 219px;
    overflow: hidden;
    border-radius: 16px 16px 0 0;
    background: #1F2937;
    box-shadow: inset 0 2px 8px rgba(0, 0, 0, 0.1);
    flex-shrink: 0;
  }

  .video-thumbnail-wrapper {
    position: relative;
    width: 100%;
    height: 100%;
    overflow: hidden;
  }

  .video-thumbnail-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    transition: transform 0.3s ease;
    display: block;
    background: #1F2937;
  }

  .video-play-btn-v2 {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 56px;
    height: 56px;
    background: rgba(255, 255, 255, 0.12);
    backdrop-filter: blur(12px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
    z-index: 10;
  }

  .video-play-btn-v2:hover {
    background: rgba(255, 255, 255, 0.18);
    border-color: rgba(255, 255, 255, 0.3);
    transform: translate(-50%, -50%) scale(1.08);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
  }

  .video-play-btn-v2 svg {
    filter: drop-shadow(0 1px 3px rgba(0, 0, 0, 0.2));
  }

  .quick-view-actions-v2 {
    padding: 16px 20px 20px;
    display: flex;
    flex-direction: column;
    gap: 10px;
    flex: 1;
    justify-content: flex-end;
  }

  .quick-view-btn-primary-v2,
  .quick-view-btn-secondary-v2 {
    padding: 10px 16px;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 600;
    text-align: center;
    text-decoration: none;
    transition: all 0.2s;
  }

  .quick-view-btn-primary-v2 {
    padding: 19px 16px;
    background: linear-gradient(135deg, var(--preply-primary-dark) 0%, var(--preply-primary) 100%);
    color: white;
    box-shadow: 0 2px 8px rgba(236, 72, 153, 0.3);
  }

  .quick-view-btn-primary-v2:hover {
    background: linear-gradient(135deg, #DB2777 0%, #EC4899 100%);
    box-shadow: 0 4px 12px rgba(236, 72, 153, 0.4);
    transform: translateY(-1px);
    color: white;
  }

  .quick-view-btn-secondary-v2 {
    background: white;
    color: #111827;
    border: 1px solid #D1D5DB;
  }

  .quick-view-btn-secondary-v2:hover {
    background: #F9FAFB;
    border-color: #9CA3AF;
    color: #111827;
  }

  @keyframes pulse-online {
    0%, 100% {
      opacity: 1;
      transform: scale(1);
    }
    50% {
      opacity: 0.7;
      transform: scale(1.1);
    }
  }

  /* Modale vidéo */
  .video-modal-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.85);
    z-index: 9999;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(5px);
  }

  .video-modal-overlay.active {
    display: flex;
  }

  .video-modal-container {
    position: relative;
    width: 90%;
    max-width: 900px;
    max-height: 90vh;
    background: #000;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
  }

  .video-modal-close {
    position: absolute;
    top: 15px;
    right: 15px;
    width: 40px;
    height: 40px;
    background: rgba(255, 255, 255, 0.2);
    border: none;
    border-radius: 50%;
    color: white;
    font-size: 24px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 10000;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
  }

  .video-modal-close:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: scale(1.1);
  }

  .video-modal-content {
    width: 100%;
    height: 100%;
    padding: 0;
  }

  .video-modal-content iframe,
  .video-modal-content video {
    width: 100%;
    height: 100%;
    border: none;
  }

  /* ========== DESIGN SYSTEM PREMIUM (scopé .page-homeswap) ========== */
  /* Fond de page (sous filtre et cartes) : dégradé violet lavande /services + jet de lumière — sans toucher au hero */
  .services-page-wrapper.page-homeswap {
    min-height: 100vh; position: relative; overflow: hidden;
    background-color: #FAFAFC;
    background-image: linear-gradient(180deg, #FAFAFC 0%, #F8F7FC 40%, #F5F3FF 100%), url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='g'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.8' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23g)'/%3E%3C/svg%3E");
    background-blend-mode: normal, overlay; background-size: 100% 100%, 200px 200px; background-position: 0 0, 0 0;
  }
  .services-page-wrapper.page-homeswap::before { content: ''; position: fixed; top: -20%; left: -10%; width: 60%; height: 60%; background: radial-gradient(circle at 30% 30%, rgba(196, 181, 253, 0.06) 0%, transparent 55%); pointer-events: none; z-index: 0; }
  .services-page-wrapper.page-homeswap::after { content: ''; position: fixed; bottom: -20%; right: -10%; width: 55%; height: 55%; background: radial-gradient(circle at 70% 70%, rgba(196, 181, 253, 0.05) 0%, transparent 55%); pointer-events: none; z-index: 0; }
  .services-page-wrapper.page-homeswap > * { position: relative; z-index: 1; }
  .services-page-wrapper.page-homeswap .preply-filters-section, .services-page-wrapper.page-homeswap .preply-results-section { background: transparent; }
  .page-homeswap .homeswap-hero-premium { position: relative; border-radius: 0 0 32px 32px; box-shadow: 0 12px 40px rgba(236, 72, 153, 0.18), 0 0 0 1px rgba(255, 255, 255, 0.08) inset; }
  .page-homeswap .homeswap-hero-premium::before { content: ''; position: absolute; inset: 0; background: linear-gradient(to bottom, rgba(255,255,255,0.12) 0%, transparent 50%); pointer-events: none; z-index: 1; }
  .page-homeswap .homeswap-hero-premium::after { content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 160px; background: linear-gradient(to top, rgba(255,255,255,1) 0%, rgba(255,255,255,0.5) 50%, transparent 100%); pointer-events: none; z-index: 2; }
  .page-homeswap .preply-filters-section { border-bottom: 1px solid var(--preply-border); box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04); }
  .page-homeswap .preply-filter-select, .page-homeswap .preply-filter-input { border: 1px solid var(--preply-border); border-radius: 12px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05); }
  .page-homeswap .preply-filter-select:focus, .page-homeswap .preply-filter-input:focus { box-shadow: 0 0 0 3px rgba(var(--preply-primary-rgb), 0.12); }
  .page-homeswap .preply-results-header { border-bottom: 1px solid var(--preply-border); padding-bottom: 1rem; margin-bottom: 1rem; }
  .page-homeswap .freelancer-card-premium-v2 { border: 1px solid rgba(229, 231, 235, 0.9); border-radius: 20px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06); transition: transform 0.25s ease-out, box-shadow 0.25s ease-out; }
  .page-homeswap .freelancer-card-premium-v2:hover { transform: translateY(-3px); box-shadow: 0 12px 40px rgba(0, 0, 0, 0.08); }
  .page-homeswap .homeswap-premium-btn, .page-homeswap .premium-modal-btn { transition: transform 0.2s ease-out, box-shadow 0.2s ease-out; }
  .page-homeswap .homeswap-premium-btn:hover, .page-homeswap .premium-modal-btn:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(var(--preply-primary-rgb), 0.25); }

  /* Flatpickr - thème HomeSwap (z-index au-dessus du panneau) */
  .flatpickr-calendar { z-index: 1060 !important; }
  .flatpickr-day.selected, .flatpickr-day.startRange, .flatpickr-day.endRange { background: var(--preply-primary); border-color: var(--preply-primary); }
  .flatpickr-day.inRange { background: rgba(236, 72, 153, 0.15); box-shadow: none; }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="services-page-wrapper page-homeswap">
  
  <section class="homeswap-hero-premium">
    <div class="homeswap-hero-container">
      <div class="homeswap-hero-content">
        <h1 class="homeswap-hero-title">Échanges de logement</h1>
        <p class="homeswap-hero-subtitle">Vivez comme les locaux, sans payer le logement</p>
        
        <div class="homeswap-hero-badges">
          <div class="homeswap-hero-badge">
            <svg class="homeswap-hero-badge-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <span>Échange simultané / non simultané / points</span>
    </div>
          <div class="homeswap-hero-badge">
            <svg class="homeswap-hero-badge-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
            </svg>
            <span>Visio + messagerie sécurisée</span>
  </div>
          <div class="homeswap-hero-badge">
            <svg class="homeswap-hero-badge-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
            </svg>
            <span>Cadre & vérifications Junspro</span>
          </div>
          </div>

        <div class="homeswap-hero-cta">
          <a href="#results" class="homeswap-hero-btn-primary">Voir les logements</a>
          <a href="#abonnement" class="homeswap-hero-btn-secondary">Débloquer HomeSwap (99€/an)</a>
          </div>

        <p class="homeswap-hero-disclaimer">
          Vous pouvez explorer librement. L'abonnement est requis pour contacter et organiser un échange.
        </p>
              </div>
                </div>
  </section>

  
  <div class="container" style="position:relative;z-index:10;">
    <div class="homeswap-search-filter-section" id="homeswapSearchFilter">
      <div class="filter-tabs-container">
        <div class="filter-tabs">
          <button type="button" class="filter-tab active" data-tab="search" id="homeswapTabSearch">
            <i class="fas fa-search me-2"></i>
            <?php echo e(__('Rechercher un Rituel')); ?>

          </button>
          <button type="button" class="filter-tab" data-tab="submit" id="homeswapTabSubmit">
            <i class="fas fa-paper-plane me-2"></i>
            <?php echo e(__('Déposer un projet')); ?>

          </button>
        </div>
      </div>
      <div class="filter-content active" id="homeswapContentSearch">
        <?php if (isset($component)) { $__componentOriginalca6b3136a228fa756afff7c93391daa3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalca6b3136a228fa756afff7c93391daa3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.services.filters.homeswap-filters','data' => ['formId' => 'preplyFiltersForm','formAction' => route('services.homeswap')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('services.filters.homeswap-filters'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['formId' => 'preplyFiltersForm','formAction' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('services.homeswap'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalca6b3136a228fa756afff7c93391daa3)): ?>
<?php $attributes = $__attributesOriginalca6b3136a228fa756afff7c93391daa3; ?>
<?php unset($__attributesOriginalca6b3136a228fa756afff7c93391daa3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalca6b3136a228fa756afff7c93391daa3)): ?>
<?php $component = $__componentOriginalca6b3136a228fa756afff7c93391daa3; ?>
<?php unset($__componentOriginalca6b3136a228fa756afff7c93391daa3); ?>
<?php endif; ?>
      </div>
      <div class="filter-content" id="homeswapContentSubmit" style="display: none;">
        <div class="submit-project-cta">
          <div class="submit-project-content">
            <h3 class="submit-project-title"><?php echo e(__('Déposez votre projet et trouvez le freelance idéal')); ?></h3>
            <p class="submit-project-text"><?php echo e(__('Décrivez votre besoin, définissez votre budget et recevez des propositions de freelances qualifiés.')); ?></p>
            <a href="<?php echo e(route('deposer-projet')); ?>" class="submit-project-btn">
              <i class="fas fa-paper-plane me-2"></i>
              <?php echo e(__('Déposer mon projet')); ?>

            </a>
          </div>
        </div>
      </div>
    </div>
                  </div>

  
  <div class="container">
    <?php echo $__env->make('frontend.components.pause-souffle.inline-with-bullets-premium', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  </div>

  
  <section class="homeswap-how-it-works">
    <div class="homeswap-how-container">
      <h2 class="homeswap-how-title">Comment ça marche</h2>
      <div class="homeswap-how-steps">
        <div class="homeswap-how-step">
          <div class="homeswap-how-step-number">1</div>
          <h3 class="homeswap-how-step-title">Explorer & filtrer</h3>
          <p class="homeswap-how-step-description">Parcourez les logements disponibles, filtrez par ville, type de bien et durée. <strong>Gratuit.</strong></p>
                </div>
        <div class="homeswap-how-step">
          <div class="homeswap-how-step-number">2</div>
          <h3 class="homeswap-how-step-title">Débloquer l'accès</h3>
          <p class="homeswap-how-step-description">Abonnement 99€/an pour débloquer messages, visio et organisation d'échange.</p>
                  </div>
        <div class="homeswap-how-step">
          <div class="homeswap-how-step-number">3</div>
          <h3 class="homeswap-how-step-title">Choisir une option Junspro</h3>
          <p class="homeswap-how-step-description">Optionnel : matching personnalisé ou accompagnement complet pour sécuriser votre échange.</p>
                </div>
                </div>
              </div>
  </section>

  
  <section class="homeswap-exchange-types" x-data="{ selected: 'simultane' }">
    <div class="homeswap-exchange-container">
      <header class="homeswap-exchange-header">
        <h2 class="homeswap-exchange-title">Trois façons d'échanger</h2>
        <p class="homeswap-exchange-subtitle">
          Choisissez le cadre qui vous correspond. Junspro sécurise la mise en relation et clarifie les règles avant le premier message.
        </p>
      </header>

      <div class="homeswap-exchange-grid" role="radiogroup" aria-label="Choisir un mode d'échange">
        <!-- Échange simultané -->
        <button type="button"
          role="radio"
          :aria-checked="selected === 'simultane'"
          :aria-expanded="selected === 'simultane'"
          @click="selected = 'simultane'"
          :class="selected === 'simultane' ? 'homeswap-exchange-card-active' : 'homeswap-exchange-card'"
          class="homeswap-exchange-card-base">
          <div class="homeswap-exchange-card-header-flex">
            <div>
              <h3 class="homeswap-exchange-card-title">Échange simultané</h3>
              <p class="homeswap-exchange-card-description">Même dates. Échange miroir, simple et direct.</p>
            </div>
            <span x-show="selected === 'simultane'" x-transition class="homeswap-exchange-badge-selected">Sélectionné</span>
          </div>

          <ul class="homeswap-exchange-card-features">
            <li><span class="homeswap-exchange-check">✓</span> Dates alignées</li>
            <li><span class="homeswap-exchange-check">✓</span> Règles confirmées</li>
            <li><span class="homeswap-exchange-check">✓</span> Check-in/out synchronisés</li>
          </ul>
            </button>

        <!-- Échange non simultané -->
        <button type="button"
          role="radio"
          :aria-checked="selected === 'non_simultane'"
          :aria-expanded="selected === 'non_simultane'"
          @click="selected = 'non_simultane'"
          :class="selected === 'non_simultane' ? 'homeswap-exchange-card-active' : 'homeswap-exchange-card'"
          class="homeswap-exchange-card-base">
          <div class="homeswap-exchange-card-header-flex">
            <div>
              <h3 class="homeswap-exchange-card-title">Échange non simultané</h3>
              <p class="homeswap-exchange-card-description">Dates différentes, même partenaire. Plus souple.</p>
                  </div>
            <span x-show="selected === 'non_simultane'" x-transition class="homeswap-exchange-badge-selected">Sélectionné</span>
                </div>
                
          <ul class="homeswap-exchange-card-features">
            <li><span class="homeswap-exchange-check">✓</span> Plus flexible sur le calendrier</li>
            <li><span class="homeswap-exchange-check">✓</span> Convient aux familles / longues périodes</li>
            <li><span class="homeswap-exchange-check">✓</span> Cadre écrit recommandé</li>
          </ul>
                    </button>

        <!-- Système à points -->
        <button type="button"
          role="radio"
          :aria-checked="selected === 'points'"
          :aria-expanded="selected === 'points'"
          @click="selected = 'points'"
          :class="selected === 'points' ? 'homeswap-exchange-card-active' : 'homeswap-exchange-card'"
          class="homeswap-exchange-card-base">
          <div class="homeswap-exchange-card-header-flex">
            <div>
              <h3 class="homeswap-exchange-card-title">Système à points</h3>
              <p class="homeswap-exchange-card-description">Hébergez quand vous voulez. Voyagez quand vous voulez.</p>
            </div>
            <div class="homeswap-exchange-badges-wrapper">
              <span x-show="selected === 'points'" x-transition class="homeswap-exchange-badge-selected">Sélectionné</span>
              <span class="homeswap-exchange-badge">Le plus flexible</span>
                  </div>
                </div>
                
          <ul class="homeswap-exchange-card-features">
            <li><span class="homeswap-exchange-check">✓</span> Plus de liberté</li>
            <li><span class="homeswap-exchange-check">✓</span> Pas d'échange "face à face"</li>
            <li><span class="homeswap-exchange-check">✓</span> Équité via un indice de qualité</li>
          </ul>
                    </button>
                  </div>

      
      <div x-show="selected" x-transition class="homeswap-exchange-details-panel">
        <div class="homeswap-exchange-details-content">
          
          <div x-show="selected === 'simultane'" x-transition>
            <div class="homeswap-exchange-details-confirmation">
              <span class="homeswap-exchange-details-confirmation-label">Mode sélectionné :</span>
              <span class="homeswap-exchange-details-confirmation-value">Échange simultané</span>
              <span class="homeswap-exchange-details-confirmation-note">Même dates. Échange miroir, simple et direct.</span>
            </div>
            <div class="homeswap-exchange-details-header">
              <h3 class="homeswap-exchange-details-title">Échange simultané</h3>
              <p class="homeswap-exchange-details-subtitle">Même dates. Échange miroir, simple et direct.</p>
            </div>
            <div class="homeswap-exchange-details-body">
              <div class="homeswap-exchange-details-section">
                <p class="homeswap-exchange-card-detail"><strong>Idéal pour :</strong> séjours courts, couples, échanges miroir.</p>
                <p class="homeswap-exchange-card-detail"><strong>À savoir :</strong> règles et attentes validées avant accord.</p>
              </div>
            </div>
            <div class="homeswap-exchange-details-cta-wrapper">
              <a href="<?php echo e(route('mission.form')); ?>?univers=echange-logement" class="homeswap-exchange-card-cta">
                Continuer — Échange simultané
              </a>
              <p class="homeswap-exchange-cta-note">Vous pourrez modifier ce choix plus tard.</p>
                </div>
              </div>
              
          
          <div x-show="selected === 'non_simultane'" x-transition>
            <div class="homeswap-exchange-details-confirmation">
              <span class="homeswap-exchange-details-confirmation-label">Mode sélectionné :</span>
              <span class="homeswap-exchange-details-confirmation-value">Échange non simultané</span>
              <span class="homeswap-exchange-details-confirmation-note">Dates différentes, même partenaire. Plus souple.</span>
            </div>
            <div class="homeswap-exchange-details-header">
              <h3 class="homeswap-exchange-details-title">Échange non simultané</h3>
              <p class="homeswap-exchange-details-subtitle">Dates différentes, même partenaire. Plus souple.</p>
            </div>
            <div class="homeswap-exchange-details-body">
              <div class="homeswap-exchange-details-section">
                <p class="homeswap-exchange-card-detail"><strong>Idéal pour :</strong> vacances scolaires, projets longs, familles.</p>
                <p class="homeswap-exchange-card-detail"><strong>À savoir :</strong> un accord clair rend l'échange fluide et premium.</p>
              </div>
            </div>
            <div class="homeswap-exchange-details-cta-wrapper">
              <a href="<?php echo e(route('mission.form')); ?>?univers=echange-logement" class="homeswap-exchange-card-cta">
                Continuer — Échange non simultané
              </a>
              <p class="homeswap-exchange-cta-note">Vous pourrez modifier ce choix plus tard.</p>
                </div>
              </div>
              
          
          <div x-show="selected === 'points'" x-transition>
            <div class="homeswap-exchange-details-confirmation">
              <span class="homeswap-exchange-details-confirmation-label">Mode sélectionné :</span>
              <span class="homeswap-exchange-details-confirmation-value">Système à points</span>
              <span class="homeswap-exchange-details-confirmation-note">Hébergez quand vous voulez. Voyagez quand vous voulez.</span>
              </div>
            <div class="homeswap-exchange-details-header">
              <h3 class="homeswap-exchange-details-title">Système à points</h3>
              <p class="homeswap-exchange-details-subtitle">Hébergez quand vous voulez. Voyagez quand vous voulez.</p>
            </div>
            <div class="homeswap-exchange-details-body">
              <div class="homeswap-exchange-details-section">
                <p class="homeswap-exchange-card-detail"><strong>Idéal pour :</strong> flexibilité maximale, échanges sans contraintes de dates.</p>
                <p class="homeswap-exchange-card-detail"><strong>À savoir :</strong> équité garantie via un indice de qualité calculé pour chaque logement.</p>
          </div>

              <div class="homeswap-exchange-details-section">
                <div class="homeswap-exchange-points-grid">
                  <div class="homeswap-exchange-points-card">
                    <p class="homeswap-exchange-points-label">Indice (0–100)</p>
                    <p class="homeswap-exchange-points-title">Qualité du logement</p>
                    <p class="homeswap-exchange-points-text">Basé sur le type, couchages, confort intérieur/extérieur, équipements, etc.</p>
        </div>

                  <div class="homeswap-exchange-points-card">
                    <p class="homeswap-exchange-points-label">Conversion</p>
                    <p class="homeswap-exchange-points-title">Points / nuit (estimés)</p>
                    <p class="homeswap-exchange-points-text">25 + (Indice × 0,75) → arrondi (min 25, max 100).</p>
          </div>

                  <div class="homeswap-exchange-points-card">
                    <p class="homeswap-exchange-points-label">Logique</p>
                    <p class="homeswap-exchange-points-title">Vous gagnez / vous dépensez</p>
                    <p class="homeswap-exchange-points-text">Héberger crédite des points. Séjourner débite des points.</p>
                  </div>
                </div>
              </div>

              <div class="homeswap-exchange-details-section">
                <div class="homeswap-exchange-example">
                  <p class="homeswap-exchange-example-title">Exemple concret</p>
                  <p class="homeswap-exchange-example-text">
                    Indice 60/100 → ~70 points/nuit. 14 nuits hébergées → ~980 points.
                    Un logement à 55 points/nuit coûte 55 points par nuit.
                  </p>
                  <p class="homeswap-exchange-example-note">
                    Ce système évite la confusion "14 nuits = 14 points" et rend l'échange réellement premium et équitable.
                  </p>
                </div>
              </div>
            </div>
            <div class="homeswap-exchange-details-cta-wrapper">
              <a href="<?php echo e(route('mission.form')); ?>?univers=echange-logement" class="homeswap-exchange-card-cta">
                Continuer — Système à points
              </a>
              <p class="homeswap-exchange-cta-note">Vous pourrez modifier ce choix plus tard.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  
  <section class="homeswap-premium-section" id="abonnement">
    <div class="homeswap-premium-container">
      <div class="homeswap-premium-card">
        <div class="homeswap-premium-header">
          <h2 class="homeswap-premium-title">Accès HomeSwap — 99€ / an</h2>
          <p class="homeswap-premium-subtitle">Débloquez l'accès complet à la plateforme d'échange</p>
        </div>
        <div class="homeswap-premium-features">
          <div class="homeswap-premium-feature">
            <svg class="homeswap-premium-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
            </svg>
            <span>Messagerie</span>
          </div>
          <div class="homeswap-premium-feature">
            <svg class="homeswap-premium-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
            </svg>
            <span>Visio</span>
          </div>
          <div class="homeswap-premium-feature">
            <svg class="homeswap-premium-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
            </svg>
            <span>Organisation d'échange</span>
          </div>
          <div class="homeswap-premium-feature">
            <svg class="homeswap-premium-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span>Accès au système de points</span>
          </div>
        </div>
        <div class="homeswap-premium-cta">
          <?php if($isAuthenticated): ?>
            <?php if($hasHomeSwapSubscription): ?>
              <div class="homeswap-premium-status">
                <span class="homeswap-premium-status-badge">✓ Abonnement actif</span>
                <a href="<?php echo e(route('user.settings.subscription')); ?>" class="homeswap-premium-link">Gérer mon abonnement</a>
              </div>
            <?php else: ?>
              <a href="<?php echo e(route('user.settings.subscription')); ?>#homeswap" class="homeswap-premium-btn">
                S'abonner
              </a>
            <?php endif; ?>
          <?php else: ?>
            <a href="<?php echo e(route('user.login', ['redirect' => route('services.homeswap')])); ?>" class="homeswap-premium-btn">
              Se connecter pour s'abonner
            </a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>

  
  <section class="homeswap-options-section" id="homeswapOptions">
    <div class="homeswap-options-container">
      <div class="homeswap-options-header">
        <h2 class="homeswap-options-title">Options d'accompagnement Junspro</h2>
        <p class="homeswap-options-subtitle">Choisissez le niveau d'accompagnement adapté à votre projet d'échange</p>
        </div>
      <div class="homeswap-options-grid">
        <div class="homeswap-option-card">
          <div class="homeswap-option-header">
            <h3 class="homeswap-option-title">Accompagnement complet</h3>
            <div class="homeswap-option-price">99€</div>
          </div>
          <p class="homeswap-option-description">
            Cadrage, checklist, contrat moral, sécurisation, suivi : nous vous accompagnons de A à Z pour un échange serein.
          </p>
          <ul class="homeswap-option-features">
            <li>Cadrage du projet d'échange</li>
            <li>Checklist sécurité & confiance</li>
            <li>Contrat moral & règles maison</li>
            <li>Sécurisation & suivi</li>
          </ul>
        </div>
        <div class="homeswap-option-card">
          <div class="homeswap-option-header">
            <h3 class="homeswap-option-title">Mise en relation simple</h3>
            <div class="homeswap-option-price">9,99€</div>
          </div>
          <p class="homeswap-option-description">
            Nous vous proposons 1 à 3 logements/profils pertinents selon vos critères (ville, dates, type de logement, objectif).
          </p>
          <ul class="homeswap-option-features">
            <li>Matching personnalisé</li>
            <li>1–3 logements/profils sélectionnés</li>
            <li>Contact direct facilité</li>
          </ul>
        </div>
        <div class="homeswap-option-card">
          <div class="homeswap-option-header">
            <h3 class="homeswap-option-title">Aucune option</h3>
            <div class="homeswap-option-price">Gratuit</div>
          </div>
          <p class="homeswap-option-description">
            Autonomie totale : explorez les logements, publiez votre annonce, contactez directement.
          </p>
          <ul class="homeswap-option-features">
            <li>Accès à tous les logements</li>
            <li>Publication d'annonce gratuite</li>
            <li>Contact direct (avec abonnement)</li>
          </ul>
        </div>
      </div>
      <div class="homeswap-options-cta">
        <a href="<?php echo e(route('mission.form')); ?>?univers=echange-logement&offre=Mise_en_relation" class="homeswap-options-btn">
          Soumettre ma demande HomeSwap
        </a>
      </div>
    </div>
  </section>

  
  <section class="homeswap-transparency">
    <div class="homeswap-transparency-container">
      <div class="homeswap-transparency-card homeswap-alert-callout">
        <div class="homeswap-alert-icon-wrapper">
          <svg class="homeswap-alert-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
          </svg>
        </div>
        <div class="homeswap-alert-content">
          <h3 class="homeswap-transparency-title">Confiance & prudence</h3>
          <p class="homeswap-transparency-text">
            <strong>Junspro ne remplace pas la prudence :</strong> identité, règles maison, check-in/out — nous vous guidons, mais la vigilance reste de mise. Vérifiez toujours l'identité de votre partenaire d'échange et établissez clairement les règles avant l'échange.
          </p>
        </div>
      </div>
    </div>
  </section>

  
  <section id="results" class="preply-results-section" style="overflow: visible;">
    <div class="preply-results-container" style="overflow: visible;">
      <div class="preply-results-header">
        <h2 class="preply-results-count"><?php echo e($freelancers->total() ?? 0); ?> logements disponibles</h2>
        <select class="preply-sort-select" id="sortSelect" name="sort">
          <option value="favorites">Trier par : Nos préférés</option>
          <option value="price_asc">Prix croissant</option>
          <option value="price_desc">Prix décroissant</option>
          <option value="rating">Meilleure note</option>
        </select>
      </div>

      <div class="freelancers-list-wrapper">
        <div class="freelancers-grid-premium" style="display: flex; flex-direction: column; gap: 20px;">
          <?php if($freelancers->isEmpty()): ?>
            <?php if(request('city')): ?>
              
              <div class="homeswap-opportunity-block">
                <h3 class="homeswap-opportunity-title">Cette ville est en devenir sur Junspro ✨</h3>
                <p class="homeswap-opportunity-text">
                  Junspro n'est pas encore actif dans cette ville.<br>
                  Et si vous deveniez l'un de ses premiers ambassadeurs ?
                </p>
                <p class="homeswap-opportunity-text-secondary">
                  Développez les activités Junspro dans votre région,<br>
                  créez un complément de revenus<br>
                  et contribuez à faire une vraie différence localement.
                </p>
                <a href="<?php echo e(route('referral.index')); ?>" class="homeswap-opportunity-cta">
                  Devenir apporteur d'affaires
                </a>
              </div>
            <?php else: ?>
            <div style="text-align: center; padding: 60px 20px;">
              <p style="font-size: 1.125rem; color: var(--preply-text-light);">Aucun logement trouvé pour le moment.</p>
            </div>
            <?php endif; ?>
          <?php else: ?>
            <?php $__currentLoopData = $freelancers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $freelancer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php
            $user = $freelancer->user;
                  
                  // Calculer les initiales (première lettre du prénom + première lettre du nom)
                  // IMPORTANT : Ne jamais afficher "Freelance" comme nom - utiliser les vraies données
                  $name = trim($user->name ?? '');
                  
                  // Si le nom est vide ou contient "Freelance", essayer d'autres sources
                  if (empty($name) || strtolower($name) === 'freelance') {
                    // Essayer first_name et last_name si disponibles
                    $firstName = trim($user->first_name ?? '');
                    $lastName = trim($user->last_name ?? '');
                    
                    if (!empty($firstName) || !empty($lastName)) {
                      $name = trim($firstName . ' ' . $lastName);
                    }
                  }
                  
                  $nameParts = array_filter(explode(' ', $name), function($part) {
                    return strlen(trim($part)) > 0 && strtolower(trim($part)) !== 'freelance';
                  });
                  $nameParts = array_values($nameParts); // Réindexer le tableau
                  
                  if (count($nameParts) >= 2) {
                    // Si on a prénom et nom : prendre la première lettre de chaque
                    $firstName = ucfirst(strtolower(trim($nameParts[0])));
                    $lastName = ucfirst(strtolower(trim($nameParts[count($nameParts) - 1])));
                    $initial = strtoupper(substr($firstName, 0, 1) . substr($lastName, 0, 1));
                    // Format "Prénom N." pour l'affichage (comme Preply : "Maxence B.")
                    $displayName = $firstName . ' ' . strtoupper(substr($lastName, 0, 1)) . '.';
                  } else if (count($nameParts) == 1 && strlen(trim($nameParts[0])) > 2) {
                    // Si un seul mot mais plus de 2 caractères, utiliser ce mot
                    $singleName = ucfirst(strtolower(trim($nameParts[0])));
                    $initial = strtoupper(substr($singleName, 0, min(2, strlen($singleName))));
                    $displayName = $singleName;
                } else {
                    // Dernier recours : utiliser les initiales du nom d'utilisateur ou générer un nom
                    $username = trim($user->username ?? '');
                    if (!empty($username) && strtolower($username) !== 'freelance') {
                      $displayName = ucfirst($username);
                      $initial = strtoupper(substr($displayName, 0, min(2, strlen($displayName))));
                    } else {
                      // Générer un nom à partir de l'ID si vraiment rien n'est disponible
                      $displayName = 'Propriétaire ' . substr($user->id ?? 'P', 0, 3);
                      $initial = 'P' . substr($user->id ?? '1', 0, 1);
                    }
                  }
                  
                  $avatarColor = '#' . substr(md5($user->name ?? 'F'), 0, 6);
                  $skills = is_array($freelancer->skills) ? $freelancer->skills : [];
                  
                  // Badge
                  $badge = null;
                  if ($user->is_super_freelancer ?? false) {
                    $badge = 'top';
                  } elseif ($freelancer->is_verified || ($user->is_verified_freelancer ?? false)) {
                    $badge = 'verified';
                  }
                  
                  // Statut de présence (simulé pour l'instant - à remplacer par vraies données si disponibles)
                  // Utiliser updated_at comme approximation de la dernière activité
                  $lastSeenAt = $user->updated_at ?? null;
                  $isOnline = false; // Par défaut hors ligne - à remplacer par vraie logique si disponible
                  
                  // Calculer "vu il y a X" si hors ligne (avec protection contre les valeurs négatives)
                  $lastSeenText = '';
                  if (!$isOnline && $lastSeenAt) {
              try {
                      // S'assurer que lastSeenAt est une date valide et dans le passé
                      $lastSeen = \Carbon\Carbon::parse($lastSeenAt);
                      $now = now();
                      
                      // Si la date est dans le futur, utiliser maintenant comme référence
                      if ($lastSeen->isFuture()) {
                        $lastSeen = $now;
                      }
                      
                      $diffInMinutes = abs($now->diffInMinutes($lastSeen));
                      
                      // Limiter à un maximum raisonnable (éviter les valeurs absurdes)
                      if ($diffInMinutes > 525600) { // Plus d'un an
                        $lastSeenText = 'vu il y a longtemps';
                      } elseif ($diffInMinutes < 60) {
                        $lastSeenText = 'vu il y a ' . $diffInMinutes . ' min';
                      } elseif ($diffInMinutes < 1440) {
                        $diffInHours = floor($diffInMinutes / 60);
                        $lastSeenText = 'vu il y a ' . $diffInHours . ' h';
                      } else {
                        $diffInDays = floor($diffInMinutes / 1440);
                        $lastSeenText = 'vu il y a ' . $diffInDays . ' j';
                      }
              } catch (\Exception $e) {
                      // En cas d'erreur, ne pas afficher de texte
                      $lastSeenText = '';
              }
            }
            ?>
                <div class="freelancer-card-wrapper-premium" data-freelancer-id="<?php echo e($freelancer->id); ?>">
                  <!-- Carte principale - Style Preply avec wrapper pour réserver l'espace vidéo -->
                  <div class="freelancer-card-premium-v2 preply-teacher-card" data-freelancer-id="<?php echo e($freelancer->id); ?>" data-hourly-rate="<?php echo e($freelancer->hourly_rate ?? 0); ?>" data-ritual-rate="<?php echo e($freelancer->hourly_rate ?? 0); ?>">
                    <!-- Wrapper du contenu pour limiter la largeur et réserver l'espace pour la vidéo -->
                    <div class="freelancer-card__content">
                      <!-- Contenu principal de la carte (avatar + infos + prix) -->
                      <div class="freelancer-card-content">
                      
                      <!-- ============================================
                           COLONNE GAUCHE : IDENTITÉ (Style Preply)
                           ============================================ -->
                      <div class="freelancer-photo-section">
                        <div class="freelancer-photo-container">
                          <?php if($user->image): ?>
                            <img src="<?php echo e(asset('assets/img/users/' . $user->image)); ?>" 
                                 alt="<?php echo e($user->name); ?>" 
                                 class="freelancer-photo-img"
                                 onerror="this.style.display='none'; this.parentElement.querySelector('.freelancer-photo-placeholder').style.display='flex';">
                          <?php endif; ?>
                          
                          <!-- Fallback avec dégradé violet et initiales si pas de photo -->
                          <div class="freelancer-photo-placeholder" style="display: <?php echo e($user->image ? 'none' : 'flex'); ?>;">
                            <span class="photo-initial"><?php echo e($initial); ?></span>
                    </div>
                          
                          <!-- Badge qualité (coin supérieur droit) -->
                          <?php if($badge): ?>
                            <div class="freelancer-badge-overlay badge-<?php echo e($badge); ?>">
                              <?php if($badge == 'top'): ?>
                                <i class="fas fa-crown"></i>
                              <?php elseif($badge == 'verified'): ?>
                                <i class="fas fa-check-circle"></i>
                  <?php endif; ?>
                    </div>
                  <?php endif; ?>
                  
                          <!-- Statut en ligne/hors ligne (point en bas à droite de la photo) -->
                          <!-- SUPPRESSION du title pour éviter le tooltip encadré du navigateur -->
                          <div class="freelancer-status-dot-wrapper">
                            <span class="status-dot <?php echo e($isOnline ? 'status-online' : 'status-offline'); ?>"></span>
                          </div>
                          
                          <!-- Texte du statut en ligne/hors ligne (sous la photo) - Visible uniquement au survol -->
                          <div class="freelancer-status-text-wrapper">
                            <span class="status-dot-inline <?php echo e($isOnline ? 'status-online' : 'status-offline'); ?>"></span>
                            <span class="status-text-inline">
                              <?php if($isOnline): ?>
                      En ligne
                              <?php else: ?>
                                <span class="status-line-1">Hors ligne</span>
                                <?php if($lastSeenText): ?>
                                  <span class="status-line-2"><?php echo e($lastSeenText); ?></span>
                  <?php endif; ?>
                  <?php endif; ?>
                            </span>
                </div>
              </div>

                        <!-- Nom + Initiale + Drapeau + Badge vérifié (à droite de la photo) -->
                        <div class="freelancer-identity-block">
                          <h3 class="freelancer-name-v2">
                            <a href="<?php echo e(route('freelance.show', $freelancer->id)); ?>" target="_self"
                               <?php if(!$isAuthenticated || !$hasHomeSwapSubscription): ?>
                                 onclick="event.preventDefault(); showPremiumModal('profil'); return false;"
                               <?php endif; ?>>
                              <?php echo e($displayName); ?>

                            </a>
                            <?php
                              // Récupérer le code pays pour l'afficher après le nom
                              $countryCodeForName = strtoupper(trim($user->country_code ?? 'FR'));
                              if (empty($countryCodeForName) || strlen($countryCodeForName) < 2) {
                                $countryCodeForName = 'FR';
                              }
                            ?>
                            <span style="font-weight: 400; color: #6B7280; margin-left: 4px;"><?php echo e($countryCodeForName); ?></span>
                            <?php if($badge == 'verified' || ($user->is_verified_freelancer ?? false)): ?>
                              <span class="verified-icon-v2">
                      <i class="fas fa-check-circle"></i>
                    </span>
                  <?php endif; ?>
                </h3>
                          
                          <!-- Badges HomeSwap Scoring -->
                          <?php
                            try {
                              $hs = \App\Services\HomeswapScoring::computeHomeswapScore($freelancer);
                              $hasScore = $hs['score'] > 0 || $hs['points_per_night'] > 0;
                              $breakdownText = 'Logement: ' . $hs['breakdown']['logement'] . '/15 • ' .
                                             'Chambres: ' . $hs['breakdown']['chambres'] . '/20 • ' .
                                             'Couchage: ' . $hs['breakdown']['couchage'] . '/20 • ' .
                                             'Extérieur: ' . $hs['breakdown']['exterieur'] . '/10 • ' .
                                             'Stationnement: ' . $hs['breakdown']['stationnement'] . '/5 • ' .
                                             'Piscine: ' . $hs['breakdown']['piscine'] . '/5 • ' .
                                             'Confort: ' . $hs['breakdown']['confort'] . '/25';
                            } catch (\Exception $e) {
                              $hs = ['score' => null, 'points_per_night' => null];
                              $hasScore = false;
                              $breakdownText = '';
                            }
                          ?>
                          <div class="homeswap-scoring-badges">
                            <span class="homeswap-score-badge" title="<?php echo e($breakdownText); ?>">
                              Indice <?php echo e($hasScore ? $hs['score'] : '—'); ?>/100
                            </span>
                            <span class="homeswap-points-text">
                              ≈ <?php echo e($hasScore ? $hs['points_per_night'] : '—'); ?> pts/nuit
                            </span>
                          </div>
                          
                          <!-- Langues parlées -->
                          <?php
                            // Mapping des codes de langues vers leurs noms français
                            $languageNames = [
                              'fr' => 'Français',
                              'ar' => 'Arabe',
                              'es' => 'Espagnol',
                              'ru' => 'Russe',
                              'en' => 'Anglais',
                              'de' => 'Allemand',
                              'it' => 'Italien',
                              'pt' => 'Portugais',
                              'zh' => 'Chinois',
                              'ja' => 'Japonais',
                              'ko' => 'Coréen',
                            ];
                            
                            // Récupérer les langues du freelancer
                            $languages = $freelancer->languages ?? [];
                            $langDisplay = '';
                            
                            if (is_array($languages) && count($languages) > 0) {
                              // Prendre la première langue
                              $firstLang = $languages[0];
                              if (is_array($firstLang)) {
                                $langCode = strtolower($firstLang['code'] ?? $firstLang['name'] ?? 'en');
                                $langName = $languageNames[$langCode] ?? ucfirst($firstLang['name'] ?? 'Anglais');
                                $level = $firstLang['level'] ?? 'Natif';
                                // Capitaliser "Natif" si nécessaire
                                if (strtolower($level) === 'native' || strtolower($level) === 'natif') {
                                  $level = 'Natif';
                                }
                                $langDisplay = $langName . ' (' . $level . ')';
                              } else {
                                // Si c'est une chaîne simple, essayer de la mapper
                                $langCode = strtolower($firstLang);
                                $langDisplay = $languageNames[$langCode] ?? ucfirst($firstLang);
                                $langDisplay .= ' (Natif)';
                              }
                            }
                            
                            // Valeur par défaut si aucune langue trouvée
                            if (empty($langDisplay)) {
                              $langDisplay = 'Anglais (Natif)';
                            }
                          ?>
                          <div class="freelancer-job-line" style="white-space: nowrap;">
                            🗣️ Le propriétaire parle <?php echo e($langDisplay); ?>

                </div>
                          
                          <!-- Phrase d'accroche (headline) -->
                          <?php
                            $headline = $freelancer->headline ?? 'Propriétaire expérimenté pour vos échanges.';
                          ?>
                          <p class="freelancer-headline">
                            <?php echo e($headline); ?>

                          </p>
                          
                          <!-- Description courte : on limite l'aperçu sur la carte à quelques lignes.
                               Le texte complet sera lu sur la page profil via « En savoir plus ». -->
                          <?php
                            // Bio complète (utilisée sur la page profil)
                            $fullBio = $freelancer->bio ?? $freelancer->about ?? 'Propriétaire expérimenté prêt à échanger son logement.';
                            // Si la bio est trop courte, utiliser un texte par défaut réduit
                            if (empty($fullBio) || strlen($fullBio) < 30) {
                              $fullBio = 'Propriétaire expérimenté prêt à échanger son logement.';
                            }

                            // Aperçu pour la carte : on tronque à ~220 caractères max
                            // pour rester visuellement autour de 2–3 lignes.
                            $shortBio = \Illuminate\Support\Str::limit(strip_tags($fullBio), 220, '…');
                          ?>
                          
                          <!-- Sur la carte : on affiche uniquement l'aperçu $shortBio -->
                          <div class="freelancer-bio-wrapper">
                            <p class="freelancer-bio-v2">
                              <?php echo e($shortBio); ?>

                            </p>
              </div>

                          <!-- Popularité -->
                          <div class="freelancer-popularity-v2">
                            <i class="fas fa-chart-line"></i>
                            <span style="white-space: nowrap;">Très populaire. <?php echo e(rand(10, 50)); ?> réservations récentes</span>
                </div>
                          
                          <!-- Lien "En savoir plus" (aligné à gauche) -->
                          <a href="<?php echo e(route('freelance.show', $freelancer->id)); ?>" 
                             class="freelancer-learn-more-v2" target="_self"
                             <?php if(!$isAuthenticated || !$hasHomeSwapSubscription): ?>
                               onclick="event.preventDefault(); showPremiumModal('profil'); return false;"
                             <?php endif; ?>>
                            En savoir plus
                          </a>
                </div>
                      </div>

                      <!-- ============================================
                           COLONNE CENTRE : VIDÉE (Le contenu a été déplacé dans la colonne gauche)
                           ============================================ -->
                      <div class="freelancer-info-section">
                        <!-- La description a été déplacée dans la colonne gauche -->
                        <!-- Cette colonne peut être utilisée pour d'autres informations si nécessaire -->

              </div>

                      <!-- ============================================
                           COLONNE DROITE : TARIF / STATS / CTA
                           ============================================ -->
                      <div class="freelancer-pricing-section">
                        <!-- Icône Favoris (en haut à droite) -->
                        <button class="freelancer-favorite-btn" data-freelancer-id="<?php echo e($freelancer->id); ?>" aria-label="Ajouter aux favoris">
                          <i class="far fa-heart"></i>
                        </button>

                        <!-- Prix mis en avant -->
                        <div class="freelancer-price-v2">
                          <div class="price-amount"><?php echo e(number_format($freelancer->hourly_rate, 0, ',', ' ')); ?> €</div>
                          <div class="price-label">Échange disponible</div>
                </div>

                        <!-- Note + Avis sur une ligne -->
                        <div class="freelancer-rating-v2">
                          <div class="rating-number"><?php echo e(number_format($freelancer->reliability_score / 20 ?? 4.5, 1)); ?></div>
                          <div class="rating-stars-v2">
                            <i class="fas fa-star"></i>
                </div>
                          <div class="rating-count"><?php echo e(rand(10, 100)); ?> avis</div>
                        </div>

                        <!-- Stats échanges : 2 colonnes alignées -->
                        <div class="freelancer-stats-v2">
                          <div class="stat-item-v2">
                            <span class="stat-number"><?php echo e($freelancer->subscriptions()->count() ?? 0); ?></span>
                            <span class="stat-label-v2">échanges réalisés</span>
                          </div>
                          <div class="stat-item-v2">
                            <span class="stat-number"><?php echo e($freelancer->subscriptions()->where('status', 'active')->count() ?? 0); ?></span>
                            <span class="stat-label-v2">échanges récurrents</span>
                          </div>
                        </div>

                        <!-- CTA Buttons -->
                        <div class="freelancer-cta-v2">
                          <a href="<?php echo e(route('freelance.show', $freelancer->id)); ?>#agenda" 
                             class="cta-primary-v2"
                             <?php if(!$isAuthenticated || !$hasHomeSwapSubscription): ?>
                               onclick="event.preventDefault(); showPremiumModal('logement'); return false;"
                             <?php endif; ?>>
                  Voir le logement
                </a>
                          <button type="button" class="cta-secondary-v2" 
                                  <?php if(!$isAuthenticated || !$hasHomeSwapSubscription): ?>
                                    onclick="showPremiumModal('message')"
                                  <?php else: ?>
                                    data-bs-toggle="modal" data-bs-target="#contactModal<?php echo e($freelancer->id); ?>" data-freelancer-id="<?php echo e($freelancer->id); ?>"
                                  <?php endif; ?>>
                  Envoyer un message
                          </button>
              </div>
                      </div>
                      <!-- Fin du contenu principal -->
                    </div>
                    <!-- Fin du wrapper de contenu (réserve l'espace pour la vidéo) -->
            </div>

                    <!-- Quick View - Vidéo de présentation (positionnée à droite, en dehors du wrapper de contenu) -->
                    <div class="freelancer-quick-view-v2" data-freelancer-id="<?php echo e($freelancer->id); ?>">
                      <div class="quick-view-content-v2">
                        <!-- Vidéo de présentation avec miniature réelle -->
                        <div class="quick-view-video-section">
                          <div class="video-thumbnail-wrapper">
                            <?php
                              // Récupérer l'URL de la miniature vidéo (PRIORITÉ : vraie miniature, pas de gradient)
                              $thumbnailUrl = null;
                              $hasThumbnail = false;
                              
                              // Essayer plusieurs sources pour la miniature vidéo
                              $possibleThumbnailSources = [
                                $freelancer->video_thumbnail_url ?? null,
                                $freelancer->video_thumbnail ?? null,
                                $user->video_thumbnail_url ?? null,
                                $user->video_thumbnail ?? null,
                              ];
                              
                              foreach ($possibleThumbnailSources as $source) {
                                if (empty($source)) continue;
                                
                                // Vérifier si c'est une URL complète
                                if (filter_var($source, FILTER_VALIDATE_URL)) {
                                  $thumbnailUrl = $source;
                                  $hasThumbnail = true;
                                  break;
                                }
                                
                                // Vérifier si c'est un chemin relatif qui existe
                                $relativePath = ltrim($source, '/');
                                if (file_exists(public_path($relativePath))) {
                                  $thumbnailUrl = asset($relativePath);
                                  $hasThumbnail = true;
                                  break;
                                }
                                
                                // Essayer avec le préfixe assets/img/
                                if (file_exists(public_path('assets/img/' . $relativePath))) {
                                  $thumbnailUrl = asset('assets/img/' . $relativePath);
                                  $hasThumbnail = true;
                                  break;
                                }
                              }
                              
                              // Dernier recours : utiliser l'image placeholder si elle existe
                              if (!$hasThumbnail) {
                                $placeholderPaths = [
                                  'assets/img/video-placeholder.jpg',
                                  'assets/img/video-placeholder.png',
                                  'assets/front/img/video-placeholder.jpg',
                                ];
                                
                                foreach ($placeholderPaths as $path) {
                                  if (file_exists(public_path($path))) {
                                    $thumbnailUrl = asset($path);
                                    $hasThumbnail = true;
                                    break;
                                  }
                                }
                              }
                              
                              // Récupérer l'URL de la vidéo
                              $videoUrl = $freelancer->video_url ?? $user->video_url ?? null;
                            ?>
                            
                            <?php if($hasThumbnail && !empty($thumbnailUrl)): ?>
                              <!-- VRAIE MINIATURE VIDÉO (pas de gradient) -->
                              <img src="<?php echo e($thumbnailUrl); ?>" 
                                   alt="Vidéo de présentation - <?php echo e($displayName); ?>" 
                                   class="video-thumbnail-img"
                                   loading="lazy"
                                   onerror="this.onerror=null; this.style.display='none'; this.parentElement.querySelector('.video-placeholder-fallback').style.display='flex';">
            <?php endif; ?>
                            
                            <!-- Fallback élégant avec dégradé violet UNIQUEMENT si aucune miniature n'est disponible -->
                            <div class="video-placeholder-fallback" style="display: <?php echo e(($hasThumbnail && !empty($thumbnailUrl)) ? 'none' : 'flex'); ?>; flex-direction: column; align-items: center; justify-content: center; width: 100%; height: 100%; background: linear-gradient(135deg, #6366F1 0%, #8B5CF6 50%, #7C3AED 100%); color: white; text-align: center; position: absolute; top: 0; left: 0; right: 0; bottom: 0; z-index: 1;">
                              <div style="position: relative; z-index: 2; display: flex; flex-direction: column; align-items: center; gap: 16px;">
                                <div style="width: 80px; height: 80px; background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(10px); border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 2px solid rgba(255, 255, 255, 0.3);">
                                  <i class="fas fa-video" style="font-size: 36px; opacity: 0.95;"></i>
          </div>
          </div>
                              <!-- Overlay subtil pour plus de profondeur -->
                              <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: radial-gradient(circle at 30% 40%, rgba(255, 255, 255, 0.1) 0%, transparent 60%); pointer-events: none; z-index: 1;"></div>
                            </div>
                            
                            <!-- Bouton Play centré (toujours visible) -->
                            <button class="video-play-btn-v2" data-freelancer-id="<?php echo e($freelancer->id); ?>" data-video-url="<?php echo e($videoUrl ?? ''); ?>" aria-label="Lire la vidéo de présentation" style="z-index: 10;">
                              <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="rgba(255, 255, 255, 0.9)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <polygon points="6 4 18 12 6 20 6 4" fill="rgba(255, 255, 255, 0.15)"></polygon>
                              </svg>
                            </button>
                            
                          </div>
                        </div>

                        <!-- Boutons d'action -->
                        <div class="quick-view-actions-v2">
                          <a href="<?php echo e(route('freelance.show', $freelancer->id)); ?>" 
                             class="quick-view-btn-primary-v2"
                             <?php if(!$isAuthenticated || !$hasHomeSwapSubscription): ?>
                               onclick="event.preventDefault(); showPremiumModal('profil'); return false;"
                             <?php endif; ?>>
                            Voir le profil de <?php echo e($displayName); ?>

                          </a>
                          <a href="<?php echo e(route('freelance.show', $freelancer->id)); ?>#agenda" 
                             class="quick-view-btn-secondary-v2"
                             <?php if(!$isAuthenticated || !$hasHomeSwapSubscription): ?>
                               onclick="event.preventDefault(); showPremiumModal('agenda'); return false;"
                             <?php endif; ?>>
                            Voir tout l'agenda
                          </a>
                        </div>
                      </div>
                    </div>
                    <!-- Fin de la carte vidéo (positionnée à droite, en dehors du wrapper de contenu) -->
                  </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
      </div>

      
      <?php if($freelancers->hasPages()): ?>
        <div style="margin-top: 40px; display: flex; justify-content: center;">
          <?php echo e($freelancers->links()); ?>

        </div>
      <?php endif; ?>
    </div>
  </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/fr.js"></script>
<script>

  function openPersonalizeModal() {
    // TODO: Implémenter modal de personnalisation
    alert('Fonctionnalité de personnalisation à venir');
  }

  function sortTeachers(value) {
    // TODO: Implémenter le tri
    console.log('Tri:', value);
  }

  // Gestion de l'interface de disponibilité
  let selectedTimes = [];
  let selectedDays = [];

  function toggleAvailabilityPanel() {
    const panel = document.getElementById('availabilityPanel');
    const trigger = document.querySelector('.preply-availability-trigger');
    
    if (panel.classList.contains('active')) {
      panel.classList.remove('active');
      trigger.classList.remove('active');
    } else {
      panel.classList.add('active');
      trigger.classList.add('active');
    }
  }

  // Initialiser les boutons de temps et jours
  document.addEventListener('DOMContentLoaded', function() {
    // Restaurer les sélections depuis la requête
    <?php
      $savedTimes = request('availability_times', []);
      $savedDays = request('availability_days', []);
    ?>
    selectedTimes = <?php echo json_encode($savedTimes, 15, 512) ?>;
    selectedDays = <?php echo json_encode($savedDays, 15, 512) ?>;
    
    const timeButtons = document.querySelectorAll('.availability-time-btn');
    const dayButtons = document.querySelectorAll('.availability-day-btn');
    
    // Restaurer les sélections visuelles
    timeButtons.forEach(function(btn) {
      const time = btn.getAttribute('data-time');
      if (selectedTimes.includes(time)) {
        btn.classList.add('selected');
      }
    });
    
    dayButtons.forEach(function(btn) {
      const day = btn.getAttribute('data-day');
      if (selectedDays.includes(day)) {
        btn.classList.add('selected');
      }
    });
    
    updateAvailabilityText();
    
    // Gestion des sélections de temps
    timeButtons.forEach(function(btn) {
      btn.addEventListener('click', function() {
        const time = this.getAttribute('data-time');
        if (this.classList.contains('selected')) {
          this.classList.remove('selected');
          selectedTimes = selectedTimes.filter(t => t !== time);
        } else {
          this.classList.add('selected');
          selectedTimes.push(time);
        }
        updateAvailabilityText();
      });
    });
    
    // Gestion des sélections de jours
    dayButtons.forEach(function(btn) {
      btn.addEventListener('click', function() {
        const day = this.getAttribute('data-day');
        if (this.classList.contains('selected')) {
          this.classList.remove('selected');
          selectedDays = selectedDays.filter(d => d !== day);
        } else {
          this.classList.add('selected');
          selectedDays.push(day);
        }
        updateAvailabilityText();
      });
    });
    
    // Fermer le panneau en cliquant en dehors
    document.addEventListener('click', function(e) {
      const panel = document.getElementById('availabilityPanel');
      const trigger = document.querySelector('.preply-availability-trigger');
      if (panel && trigger && !panel.contains(e.target) && !trigger.contains(e.target)) {
        panel.classList.remove('active');
        trigger.classList.remove('active');
      }
    });
  });

  function updateAvailabilityText() {
    const textElement = document.querySelector('.availability-selected-text');
    if (!textElement) return;
    
    if (selectedTimes.length === 0 && selectedDays.length === 0) {
      textElement.textContent = 'Toutes les heures';
    } else {
      const parts = [];
      if (selectedTimes.length > 0) {
        parts.push(selectedTimes.length + ' créneau' + (selectedTimes.length > 1 ? 'x' : ''));
      }
      if (selectedDays.length > 0) {
        parts.push(selectedDays.length + ' jour' + (selectedDays.length > 1 ? 's' : ''));
      }
      textElement.textContent = parts.join(' • ') || 'Toutes les heures';
    }
  }

  function clearAvailabilitySelection() {
    selectedTimes = [];
    selectedDays = [];
    
    document.querySelectorAll('.availability-time-btn.selected').forEach(function(btn) {
      btn.classList.remove('selected');
    });
    
    document.querySelectorAll('.availability-day-btn.selected').forEach(function(btn) {
      btn.classList.remove('selected');
    });
    
    updateAvailabilityText();
  }

  function applyAvailabilityFilter() {
    const form = document.getElementById('preplyFiltersForm');
    if (!form) return;
    
    // Créer des champs cachés pour les disponibilités sélectionnées
    // Supprimer les anciens champs
    document.querySelectorAll('input[name="availability_times[]"], input[name="availability_days[]"]').forEach(function(input) {
      input.remove();
    });
    
    // Ajouter les nouveaux champs
    selectedTimes.forEach(function(time) {
      const input = document.createElement('input');
      input.type = 'hidden';
      input.name = 'availability_times[]';
      input.value = time;
      form.appendChild(input);
    });
    
    selectedDays.forEach(function(day) {
      const input = document.createElement('input');
      input.type = 'hidden';
      input.name = 'availability_days[]';
      input.value = day;
      form.appendChild(input);
    });
    
    // Fermer le panneau
    toggleAvailabilityPanel();
    
    // Appliquer via AJAX
    if (typeof applyFiltersAjax === 'function') {
      applyFiltersAjax({});
    } else {
    form.submit();
    }
  }

  // Variable pour gérer l'annulation des requêtes AJAX
  let currentAbortController = null;

  // Fonction AJAX pour appliquer les filtres sans rechargement de page
  function applyFiltersAjax(params) {
    const resultsSection = document.getElementById('results');
    const resultsContainer = document.querySelector('.preply-results-container');
    
    if (!resultsSection || !resultsContainer) {
      console.warn('Results section or container not found');
      return;
    }
    
    // Annuler la requête précédente si elle existe
    if (currentAbortController) {
      currentAbortController.abort();
    }
    currentAbortController = new AbortController();
    
    // Ajouter loading state
    resultsSection.classList.add('is-loading');
    resultsContainer.style.opacity = '0.5';
    resultsContainer.style.pointerEvents = 'none';
    
    // Construire la query string
    const form = document.getElementById('preplyFiltersForm');
    const formData = new FormData(form);
    const searchParams = new URLSearchParams();
    
    // Ajouter tous les paramètres du formulaire
    for (const [key, value] of formData.entries()) {
      if (value) {
        searchParams.append(key, value);
      }
    }
    
    // Ajouter les paramètres spécifiques si fournis
    if (params) {
      Object.keys(params).forEach(key => {
        const value = params[key];
        searchParams.delete(key);
        
        if (value !== null && value !== undefined && value !== '') {
          if (Array.isArray(value) && value.length > 0) {
            value.forEach(v => {
              searchParams.append(key + '[]', v);
            });
          } else if (!Array.isArray(value)) {
            searchParams.set(key, value);
          }
        }
      });
    }
    
    const queryString = searchParams.toString();
    const url = form.action + (queryString ? '?' + queryString : '');
    
    // Mettre à jour l'URL sans rechargement
    window.history.replaceState({}, '', url);
    
    // Fetch AJAX
    fetch(url, {
      method: 'GET',
      headers: {
        'Accept': 'text/html',
        'X-Requested-With': 'XMLHttpRequest'
      },
      signal: currentAbortController.signal
    })
    .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.text();
    })
    .then(html => {
      const parser = new DOMParser();
      const doc = parser.parseFromString(html, 'text/html');
      const newResultsSection = doc.querySelector('.preply-results-section');
      
      if (newResultsSection) {
        resultsSection.innerHTML = newResultsSection.innerHTML;
        
        // Réinitialiser les listeners après le remplacement du DOM
        const newSortSelect = document.getElementById('sortSelect');
        if (newSortSelect) {
          newSortSelect.addEventListener('change', function(e) {
            e.preventDefault();
            e.stopPropagation();
            sortTeachers(this.value);
          }, true);
        }
      }
      
      // Retirer loading state
      resultsSection.classList.remove('is-loading');
      if (resultsContainer) {
        resultsContainer.style.opacity = '1';
        resultsContainer.style.pointerEvents = 'auto';
      }
    })
    .catch(error => {
      if (error.name === 'AbortError') {
        return;
      }
      
      console.error('Error applying filters:', error);
      
      resultsSection.classList.remove('is-loading');
      if (resultsContainer) {
        resultsContainer.style.opacity = '1';
        resultsContainer.style.pointerEvents = 'auto';
      }
    });
  }

  function sortTeachers(value) {
    if (typeof applyFiltersAjax === 'function') {
      applyFiltersAjax({
        sort: value
      });
    }
  }
  
  // Gérer le changement du select de tri
  const sortSelect = document.getElementById('sortSelect');
  if (sortSelect) {
    sortSelect.addEventListener('change', function(e) {
      e.preventDefault();
      e.stopPropagation();
      sortTeachers(this.value);
    }, true);
  }

  // Gestion du dropdown des domaines (copie depuis Projects)
  document.addEventListener('DOMContentLoaded', function() {
    const domainTrigger = document.getElementById('domainDropdownTrigger');
    const domainMenu = document.getElementById('domainDropdownMenu');
    const domainArrow = document.getElementById('domainArrow');
    
    if (domainTrigger && domainMenu) {
      // Ouvrir/fermer le menu principal
      domainTrigger.addEventListener('click', function(e) {
        e.stopPropagation();
        const isOpen = domainMenu.style.display === 'block';
        domainMenu.style.display = isOpen ? 'none' : 'block';
        domainTrigger.classList.toggle('active', !isOpen);
        if (domainArrow) {
          domainArrow.style.transform = isOpen ? 'rotate(0deg)' : 'rotate(180deg)';
        }
      });

      // Fermer le menu en cliquant en dehors
      document.addEventListener('click', function(e) {
        if (!domainMenu.contains(e.target) && !domainTrigger.contains(e.target)) {
          domainMenu.style.display = 'none';
          domainTrigger.classList.remove('active');
          if (domainArrow) {
            domainArrow.style.transform = 'rotate(0deg)';
          }
        }
      });

      // Gestion des domaines V1 (liste simple)
      document.querySelectorAll('.domain-dropdown-menu .domain-option[data-value]').forEach(function(opt) {
        if (opt.getAttribute('data-value') === '') return;
        opt.addEventListener('click', function(e) {
          e.stopPropagation();
          var value = this.getAttribute('data-value');
          var labelEl = this.querySelector('.domain-option-label') || this.querySelector('span');
          var text = labelEl ? labelEl.textContent.trim() : value;
          var domainInput = document.getElementById('domainInput');
          var domainSelectedText = document.getElementById('domainSelectedText');
          if (domainInput) domainInput.value = value;
          if (domainSelectedText) domainSelectedText.textContent = text;
          document.querySelectorAll('.domain-option, .domain-option-main').forEach(function(o) { o.classList.remove('selected'); });
          this.classList.add('selected');
          domainMenu.style.display = 'none';
          domainTrigger.classList.remove('active');
          if (domainArrow) domainArrow.style.transform = 'rotate(0deg)';
          var d = document.getElementById('domainPremiumDesc'); var txt = document.getElementById('domainPremiumDescText');
          var map = window.__domainLongDescriptions;
          if (d && txt && map && map[value]) { txt.textContent = map[value]; d.style.display = 'block'; } else if (d) d.style.display = 'none';
          var spMap = window.__domainSpecializations; var opts = (spMap && spMap[value]) ? spMap[value] : [];
          var w = document.getElementById('specializationFilterWrapper'); var s = document.getElementById('specializationSelect');
          if (w && s) { if (opts.length) { w.style.display = ''; s.innerHTML = '<option value="">Spécialisation</option>'; opts.forEach(function(o) { var opt = document.createElement('option'); opt.value = o[0]; opt.textContent = o[1]; s.appendChild(opt); }); s.value = ''; } else { w.style.display = 'none'; s.value = ''; s.innerHTML = '<option value="">Spécialisation</option>'; } }
          if (typeof applyFiltersAjax === 'function') applyFiltersAjax({ category: value });
        });
      });

      // Gestion de "Tous les domaines"
      const allDomainsOption = document.querySelector('.domain-option[data-value=""]');
      if (allDomainsOption) {
        allDomainsOption.addEventListener('click', function(e) {
          e.stopPropagation();
          document.getElementById('domainInput').value = '';
          document.getElementById('domainSelectedText').textContent = 'Tous les domaines';
          var d = document.getElementById('domainPremiumDesc'); if (d) d.style.display = 'none';
          var w = document.getElementById('specializationFilterWrapper'); var s = document.getElementById('specializationSelect');
          if (w) w.style.display = 'none'; if (s) s.value = '';
          document.querySelectorAll('.domain-option, .domain-option-main').forEach(function(o) { o.classList.remove('selected'); });
          this.classList.add('selected');
          domainMenu.style.display = 'none';
          domainTrigger.classList.remove('active');
          if (domainArrow) domainArrow.style.transform = 'rotate(0deg)';
          if (typeof applyFiltersAjax === 'function') applyFiltersAjax({ category: '' });
        });
      }

      // Restaurer la sélection actuelle
      const currentDomain = document.getElementById('domainInput')?.value || '';
      if (currentDomain) {
        const selectedOption = document.querySelector('[data-value="' + currentDomain + '"]');
        if (selectedOption) {
          selectedOption.classList.add('selected');
          const selectedText = selectedOption.querySelector('span')?.textContent;
          if (selectedText) {
            document.getElementById('domainSelectedText').textContent = selectedText;
          }
        }
      }
      var d = document.getElementById('domainPremiumDesc'); var map = window.__domainLongDescriptions;
      if (d && map && currentDomain && map[currentDomain]) {
        var txt = document.getElementById('domainPremiumDescText'); if (txt) txt.textContent = map[currentDomain];
        d.style.display = 'block';
      } else if (d) d.style.display = 'none';
    }

    // Gestion du filtre spécialisation
    const specializationSelect = document.getElementById('specializationSelect');
    if (specializationSelect) {
      specializationSelect.addEventListener('change', function() {
        if (typeof applyFiltersAjax === 'function') {
          applyFiltersAjax({
            specialization: this.value
          });
        }
      });
    }
  });

  // Auto-submit form on filter change (remplacé par AJAX)
  document.querySelectorAll('.preply-filter-select, .preply-filter-input').forEach(el => {
    el.addEventListener('change', function() {
      if (typeof applyFiltersAjax === 'function') {
        applyFiltersAjax({});
      } else {
        const form = document.getElementById('preplyFiltersForm');
        if (form) form.submit();
    });
  });

  // ============================================
  // POPOVER VIDÉO PREPLY - Reset + Fix Total
  // Portal + Positionnement Intelligent + Flèche Toggle
  // ============================================

  (function() {
    'use strict';
    
    // Constantes
    const POPOVER_WIDTH = 320;
    const GAP = 16; // Gap entre carte et popover
    const VIEWPORT_PADDING = 8; // Padding viewport pour clamp
    const OPEN_DELAY = 100; // Délai ouverture: 80-120ms
    const CLOSE_DELAY = 250; // Délai fermeture: 200-300ms (anti-flicker)
    
    // État global
    let currentCard = null;
    let currentCardId = null;
    let openTimeout = null;
    let closeTimeout = null;
    let popover = null;
    let forcedSide = null; // 'left' | 'right' | null (auto)
    let isArrowClicking = false; // Flag pour empêcher fermeture lors du clic sur flèche
    
    // Créer le portal popover au niveau body
    function createPopoverPortal() {
      if (document.getElementById('preply-video-popover')) {
        popover = document.getElementById('preply-video-popover');
        return;
      }
      
      popover = document.createElement('div');
      popover.id = 'preply-video-popover';
      popover.innerHTML = `
        <button class="preply-popover-arrow arrow-left" id="popover-arrow-left" aria-label="Afficher à gauche" title="Afficher à gauche">
          <i class="fas fa-chevron-left"></i>
        </button>
        <button class="preply-popover-arrow arrow-right" id="popover-arrow-right" aria-label="Afficher à droite" title="Afficher à droite">
          <i class="fas fa-chevron-right"></i>
        </button>
        <div class="preply-popover-video-thumbnail">
          <img id="popover-thumbnail" src="" alt="Vidéo de présentation" loading="lazy" style="display: none;">
          <div id="popover-placeholder" style="width: 100%; height: 100%; background: linear-gradient(135deg, #EC4899 0%, #F472B6 50%, #2563EB 100%); display: flex; align-items: center; justify-content: center; color: white;">
            <i class="fas fa-video" style="font-size: 2.5rem; opacity: 0.8;"></i>
          </div>
          <button class="preply-popover-play-btn" id="popover-play-btn" aria-label="Lire la vidéo">
            <i class="fas fa-play"></i>
          </button>
        </div>
        <div class="preply-popover-actions">
          <a href="#" class="preply-popover-action-btn" id="popover-agenda-btn" 
             <?php if(!$isAuthenticated || !$hasHomeSwapSubscription): ?>
               onclick="event.preventDefault(); showPremiumModal('agenda'); return false;"
             <?php endif; ?>>Voir tout l'agenda</a>
          <a href="#" class="preply-popover-action-btn" id="popover-profile-btn">Voir le profil</a>
        </div>
      `;
      document.body.appendChild(popover);
      
      // Event listeners sur la popover (pour hover stable)
      popover.addEventListener('mouseenter', cancelClose);
      popover.addEventListener('mouseleave', function() {
        // Ne pas fermer si on vient de cliquer sur une flèche
        if (!isArrowClicking) {
          scheduleClose();
        }
      });
      
      // Flèches pour forcer le côté
      popover.querySelector('#popover-arrow-left').addEventListener('click', function(e) {
        e.stopPropagation();
        e.preventDefault();
        isArrowClicking = true; // Empêcher fermeture
        cancelClose(); // Annuler toute fermeture en cours
        forcedSide = 'left';
        if (currentCard) {
          updatePopoverPosition(currentCard);
        }
        // Réinitialiser le flag après un court délai
        setTimeout(function() {
          isArrowClicking = false;
        }, 300);
      });
      
      popover.querySelector('#popover-arrow-right').addEventListener('click', function(e) {
        e.stopPropagation();
        e.preventDefault();
        isArrowClicking = true; // Empêcher fermeture
        cancelClose(); // Annuler toute fermeture en cours
        forcedSide = 'right';
        if (currentCard) {
          updatePopoverPosition(currentCard);
        }
        // Réinitialiser le flag après un court délai
        setTimeout(function() {
          isArrowClicking = false;
        }, 300);
      });
    }
    
    // Calculer position intelligente avec gap garanti + flèche toggle
    function calculatePosition(cardRect) {
      const viewportWidth = window.innerWidth;
      const viewportHeight = window.innerHeight;
      const popoverHeight = popover.offsetHeight || 280;
      
      // Si côté forcé manuellement, l'utiliser
      let side = forcedSide;
      
      if (!side) {
        // Auto-détection
        const spaceRight = viewportWidth - cardRect.right - GAP;
        const spaceLeft = cardRect.left - GAP;
        
        if (spaceRight >= POPOVER_WIDTH) {
          side = 'right';
        } else if (spaceLeft >= POPOVER_WIDTH) {
          side = 'left';
        } else {
          // Choisir le meilleur côté
          side = spaceRight > spaceLeft ? 'right' : 'left';
        }
      }
      
      let left = 0;
      let top = 0;
      
      // Calculer position selon le côté
      if (side === 'right') {
        left = cardRect.right + GAP;
        // Clamp si dépasse viewport
        if (left + POPOVER_WIDTH > viewportWidth - VIEWPORT_PADDING) {
          left = Math.max(VIEWPORT_PADDING, viewportWidth - POPOVER_WIDTH - VIEWPORT_PADDING);
        }
      } else {
        left = cardRect.left - POPOVER_WIDTH - GAP;
        // Clamp si dépasse viewport
        if (left < VIEWPORT_PADDING) {
          left = VIEWPORT_PADDING;
        }
      }
      
      // Position verticale: aligner avec le haut de la carte (même hauteur)
      // Calculer la hauteur de la carte
      const cardHeight = cardRect.height;
      
      // Aligner le haut de la popover avec le haut de la carte
      // Cela garantit que la carte vidéo commence à la même hauteur que la carte freelance
      top = Math.max(
        VIEWPORT_PADDING,
        Math.min(
          cardRect.top, // Alignement exact avec le haut de la carte
          viewportHeight - popoverHeight - VIEWPORT_PADDING
        )
      );
      
      return { left, top, side };
    }
    
    // Mettre à jour la position de la popover
    function updatePopoverPosition(card) {
      if (!card || !popover) return;
      const cardRect = card.getBoundingClientRect();
      const position = calculatePosition(cardRect);
      
      popover.style.left = position.left + 'px';
      popover.style.top = position.top + 'px';
      
      // Afficher/masquer les flèches selon le côté
      const arrowLeft = popover.querySelector('#popover-arrow-left');
      const arrowRight = popover.querySelector('#popover-arrow-right');
      
      if (position.side === 'right') {
        arrowLeft.style.display = 'flex';
        arrowRight.style.display = 'none';
      } else {
        arrowLeft.style.display = 'none';
        arrowRight.style.display = 'flex';
      }
    }
    
    // Ouvrir popover (avec délai)
    function scheduleOpen(card) {
      if (!card) return;
      
      // Vérifier que la carte a bien une vidéo
      const hasVideo = card.getAttribute('data-has-video') === 'true';
      if (!hasVideo) return;
      
      // Annuler toute fermeture en cours
      cancelClose();
      
      // Vérifier si c'est une nouvelle carte
      const cardId = card.getAttribute('data-freelancer-id');
      if (cardId === currentCardId && popover && popover.classList.contains('is-visible')) {
        // C'est la même carte déjà affichée, ne rien faire
        return;
      }
      
      // Annuler ouverture précédente si elle existe
      if (openTimeout) {
        clearTimeout(openTimeout);
        openTimeout = null;
      }
      
      // Programmer l'ouverture
      openTimeout = setTimeout(function() {
        if (card && card.getAttribute('data-has-video') === 'true') {
          openPopover(card);
        }
        openTimeout = null;
      }, OPEN_DELAY);
    }
    
    // Ouvrir popover immédiatement
    function openPopover(card) {
      // Annuler fermeture en cours
      cancelClose();
      
      // Récupérer les données
      const hasVideo = card.getAttribute('data-has-video') === 'true';
      if (!hasVideo) return;
      
      const cardId = card.getAttribute('data-freelancer-id');
      const thumbnail = card.getAttribute('data-video-thumbnail') || '';
      const videoUrl = card.getAttribute('data-video-url') || '';
      const teacherName = card.getAttribute('data-teacher-name') || '';
      const firstName = card.getAttribute('data-teacher-first-name') || '';
      const profileUrl = card.getAttribute('data-teacher-profile-url') || '#';
      
      // Réinitialiser le côté forcé si nouvelle carte
      if (cardId !== currentCardId) {
        forcedSide = null;
      }
      
      // Mettre à jour le contenu
      const thumbnailImg = popover.querySelector('#popover-thumbnail');
      const placeholder = popover.querySelector('#popover-placeholder');
      
      if (thumbnail) {
        thumbnailImg.src = thumbnail;
        thumbnailImg.style.display = 'block';
        placeholder.style.display = 'none';
      } else {
        thumbnailImg.style.display = 'none';
        placeholder.style.display = 'flex';
      }
      
      // Mettre à jour les liens
      const profileBtn = popover.querySelector('#popover-profile-btn');
      profileBtn.href = profileUrl;
      profileBtn.textContent = 'Voir le profil de ' + firstName;
      // Ajouter gating premium pour le profil
      <?php if(!$isAuthenticated || !$hasHomeSwapSubscription): ?>
      profileBtn.addEventListener('click', function(e) {
        e.preventDefault();
        showPremiumModal('profil');
        return false;
      });
      <?php endif; ?>
      
      // Bouton play
      const playBtn = popover.querySelector('#popover-play-btn');
      playBtn.onclick = function() {
        if (videoUrl && videoUrl !== '#') {
          window.open(videoUrl, '_blank');
        }
      };
      
      // Afficher d'abord pour calculer la hauteur réelle
      popover.classList.add('is-visible');
      
      // Calculer et appliquer position après affichage (pour avoir la vraie hauteur)
      // Petit délai pour que le navigateur calcule la hauteur réelle
      setTimeout(function() {
        updatePopoverPosition(card);
      }, 10);
      
      // Recalculer aussi immédiatement
      updatePopoverPosition(card);
      
      currentCard = card;
      currentCardId = cardId;
    }
    
    // Fermer popover
    function closePopover() {
      if (popover) {
        popover.classList.remove('is-visible');
      }
      currentCard = null;
      currentCardId = null;
      forcedSide = null; // Réinitialiser le côté forcé
    }
    
    // Programmer fermeture (avec délai anti-flicker: 200-300ms)
    function scheduleClose() {
      if (openTimeout) {
        clearTimeout(openTimeout);
        openTimeout = null;
      }
      closeTimeout = setTimeout(closePopover, CLOSE_DELAY);
    }
    
    // Annuler fermeture
    function cancelClose() {
      if (closeTimeout) {
        clearTimeout(closeTimeout);
        closeTimeout = null;
      }
      if (openTimeout) {
        clearTimeout(openTimeout);
        openTimeout = null;
      }
    }
    
      // Event delegation sur les cartes
      function init() {
        createPopoverPortal();
        
      // Event delegation sur le conteneur - CORRIGÉ pour fonctionner sur TOUS les profils
      const teachersList = document.querySelector('.preply-teachers-list');
      if (!teachersList) return;
      
      // Fonction pour initialiser les listeners sur une carte
      function initCardListeners(card) {
        if (!card || card.getAttribute('data-has-video') !== 'true') return;
        
        // Ne pas ajouter plusieurs fois les mêmes listeners
        if (card.hasAttribute('data-listeners-initialized')) return;
        card.setAttribute('data-listeners-initialized', 'true');
        
        // Mouseenter sur la carte elle-même
        card.addEventListener('mouseenter', function() {
          scheduleOpen(card);
        }, { passive: true });
        
        // Mouseenter sur le wrapper parent
        const wrapper = card.closest('.preply-teacher-card-wrapper');
        if (wrapper && !wrapper.hasAttribute('data-listeners-initialized')) {
          wrapper.setAttribute('data-listeners-initialized', 'true');
          wrapper.addEventListener('mouseenter', function() {
            scheduleOpen(card);
          }, { passive: true });
        }
      }
      
      // Initialiser les listeners sur toutes les cartes existantes
      const allCards = teachersList.querySelectorAll('.preply-teacher-card[data-has-video="true"]');
      allCards.forEach(function(card) {
        initCardListeners(card);
      });
      
      // Observer pour les nouvelles cartes ajoutées dynamiquement
      const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
          mutation.addedNodes.forEach(function(node) {
            if (node.nodeType === 1) { // Element node
              const newCards = node.querySelectorAll ? node.querySelectorAll('.preply-teacher-card[data-has-video="true"]') : [];
              newCards.forEach(function(card) {
                initCardListeners(card);
              });
              // Vérifier aussi si le node lui-même est une carte
              if (node.classList && node.classList.contains('preply-teacher-card') && node.getAttribute('data-has-video') === 'true') {
                initCardListeners(node);
              }
            }
          });
        });
      });
      
      observer.observe(teachersList, { childList: true, subtree: true });
      
      // Délégation d'événements principale - CORRIGÉ pour fonctionner sur TOUS les profils
      teachersList.addEventListener('mouseenter', function(e) {
        // Ignorer si on survole la popover elle-même
        if (e.target.closest('#preply-video-popover')) return;
        
        // Chercher directement la carte avec vidéo
        const card = e.target.closest('.preply-teacher-card[data-has-video="true"]');
        
        // Si on survole directement la carte, l'ouvrir
        if (card) {
          scheduleOpen(card);
          return;
        }
        
        // Sinon, chercher le wrapper et la carte à l'intérieur
        const wrapper = e.target.closest('.preply-teacher-card-wrapper');
        if (wrapper) {
          const cardInWrapper = wrapper.querySelector('.preply-teacher-card[data-has-video="true"]');
          if (cardInWrapper) {
            scheduleOpen(cardInWrapper);
          }
        }
      }, true);
      
      // Mouseover supplémentaire pour capturer tous les mouvements
      teachersList.addEventListener('mouseover', function(e) {
        // Ignorer si on survole la popover elle-même
        if (e.target.closest('#preply-video-popover')) return;
        
        // Chercher directement la carte avec vidéo
        const card = e.target.closest('.preply-teacher-card[data-has-video="true"]');
        
        // Si on survole directement la carte, l'ouvrir
        if (card) {
          const cardId = card.getAttribute('data-freelancer-id');
          if (cardId !== currentCardId) {
            scheduleOpen(card);
          }
          return;
        }
        
        // Sinon, chercher le wrapper et la carte à l'intérieur
        const wrapper = e.target.closest('.preply-teacher-card-wrapper');
        if (wrapper) {
          const cardInWrapper = wrapper.querySelector('.preply-teacher-card[data-has-video="true"]');
          if (cardInWrapper) {
            const cardId = cardInWrapper.getAttribute('data-freelancer-id');
            if (cardId !== currentCardId) {
              scheduleOpen(cardInWrapper);
            }
          }
        }
      }, true);
      
      // Mouseout: programmer fermeture (si on quitte le wrapper ou la carte)
      teachersList.addEventListener('mouseout', function(e) {
        const wrapper = e.target.closest('.preply-teacher-card-wrapper');
        const card = wrapper ? wrapper.querySelector('.preply-teacher-card[data-has-video="true"]') : null;
        const popoverEl = e.relatedTarget && e.relatedTarget.closest('#preply-video-popover');
        const stillInWrapper = wrapper && wrapper.contains(e.relatedTarget);
        
        // Si on quitte complètement le wrapper ET qu'on ne va pas vers la popover
        if (card && card === currentCard && !stillInWrapper && !popoverEl) {
          scheduleClose();
        }
      }, true);
      
      // Fermer avec ESC
      document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && popover && popover.classList.contains('is-visible')) {
          closePopover();
        }
      });
      
      // Recalculer position au scroll/resize
      let resizeTimeout;
      window.addEventListener('resize', function() {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(function() {
          if (currentCard && popover.classList.contains('is-visible')) {
            updatePopoverPosition(currentCard);
          }
        }, 100);
      });
      
      window.addEventListener('scroll', function() {
        if (currentCard && popover.classList.contains('is-visible')) {
          updatePopoverPosition(currentCard);
        }
      }, true);
    }
    
    // Initialiser au chargement
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', init);
    } else {
      init();
    }
  })();

  // Fonction pour ouvrir la vidéo en modal sur mobile
  // Fonction pour convertir une URL vidéo en URL embed
  function convertToEmbedUrl(url) {
    if (!url) return null;
    
    // YouTube
    const youtubeRegex = /(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/;
    const youtubeMatch = url.match(youtubeRegex);
    if (youtubeMatch) {
      return 'https://www.youtube.com/embed/' + youtubeMatch[1];
    }
    
    // Vimeo
    const vimeoRegex = /(?:vimeo\.com\/)(\d+)/;
    const vimeoMatch = url.match(vimeoRegex);
    if (vimeoMatch) {
      return 'https://player.vimeo.com/video/' + vimeoMatch[1];
    }
    
    // Si c'est déjà une URL embed, la retourner telle quelle
    if (url.includes('youtube.com/embed') || url.includes('player.vimeo.com')) {
      return url;
    }
    
    // Si c'est une URL de vidéo directe (.mp4, .webm, etc.), la retourner telle quelle
    if (url.match(/\.(mp4|webm|ogg|mov)(\?.*)?$/i)) {
      return url;
    }
    
    // Par défaut, retourner l'URL originale
    return url;
  }

  // Gestionnaire pour le bouton play de la carte vidéo
  document.addEventListener('DOMContentLoaded', function() {
    const videoModal = document.getElementById('videoModal');
    const videoModalContent = document.getElementById('videoModalContent');
    const videoModalClose = document.getElementById('videoModalClose');
    
    // Fonction pour ouvrir la modale vidéo
    function openVideoModal(videoUrl) {
      const embedUrl = convertToEmbedUrl(videoUrl);
      
      if (embedUrl.includes('youtube.com/embed') || embedUrl.includes('player.vimeo.com')) {
        // Vidéo YouTube ou Vimeo - utiliser iframe
        videoModalContent.innerHTML = '<iframe src="' + embedUrl + '?autoplay=1" allow="autoplay; fullscreen" allowfullscreen></iframe>';
      } else if (embedUrl.match(/\.(mp4|webm|ogg|mov)(\?.*)?$/i)) {
        // Vidéo directe - utiliser balise video
        videoModalContent.innerHTML = '<video controls autoplay style="width: 100%; height: 100%;"><source src="' + embedUrl + '" type="video/mp4">Votre navigateur ne supporte pas la lecture de vidéos.</video>';
      } else {
        // Fallback - rediriger vers l'URL originale
        window.open(videoUrl, '_blank');
        return;
      }
      
      videoModal.classList.add('active');
      document.body.style.overflow = 'hidden';
    }
    
    // Fonction pour fermer la modale vidéo
    function closeVideoModal() {
      videoModal.classList.remove('active');
      videoModalContent.innerHTML = '';
      document.body.style.overflow = '';
    }
    
    // Fermer la modale au clic sur le bouton fermer
    if (videoModalClose) {
      videoModalClose.addEventListener('click', closeVideoModal);
    }
    
    // Fermer la modale au clic sur l'overlay (mais pas sur le conteneur)
    if (videoModal) {
      videoModal.addEventListener('click', function(e) {
        if (e.target === videoModal) {
          closeVideoModal();
        }
      });
    }
    
    // Fermer la modale avec la touche ESC
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape' && videoModal.classList.contains('active')) {
        closeVideoModal();
      }
    });
    
    // Gestionnaire pour les boutons play
    document.querySelectorAll('.video-play-btn-v2').forEach(function(btn) {
      btn.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        const videoUrl = this.getAttribute('data-video-url');
        if (videoUrl && videoUrl !== '') {
          openVideoModal(videoUrl);
        } else {
          // Si pas d'URL vidéo, rediriger vers le profil
          const freelancerId = this.getAttribute('data-freelancer-id');
          if (freelancerId) {
            window.location.href = '/freelance/' + freelancerId + '#video';
          }
        }
      });
    });
  });

  // Dropdown Premium Pays de naissance
  (function initCountryDropdown() {
    const countriesData = [
      { code: 'GB', name: 'Royaume-Uni', flag: '🇬🇧', popular: true },
      { code: 'FR', name: 'France', flag: '🇫🇷', popular: true },
      { code: 'US', name: 'États-Unis d\'Amérique', flag: '🇺🇸', popular: true },
      { code: 'CA', name: 'Canada', flag: '🇨🇦', popular: true },
      { code: 'ZA', name: 'Afrique du Sud', flag: '🇿🇦', popular: true },
      { code: 'ES', name: 'Espagne', flag: '🇪🇸', popular: false },
      { code: 'DE', name: 'Allemagne', flag: '🇩🇪', popular: false },
      { code: 'IT', name: 'Italie', flag: '🇮🇹', popular: false },
      { code: 'PT', name: 'Portugal', flag: '🇵🇹', popular: false },
      { code: 'BE', name: 'Belgique', flag: '🇧🇪', popular: false },
      { code: 'CH', name: 'Suisse', flag: '🇨🇭', popular: false },
      { code: 'NL', name: 'Pays-Bas', flag: '🇳🇱', popular: false },
      { code: 'AT', name: 'Autriche', flag: '🇦🇹', popular: false },
      { code: 'SE', name: 'Suède', flag: '🇸🇪', popular: false },
      { code: 'NO', name: 'Norvège', flag: '🇳🇴', popular: false },
      { code: 'DK', name: 'Danemark', flag: '🇩🇰', popular: false },
      { code: 'FI', name: 'Finlande', flag: '🇫🇮', popular: false },
      { code: 'PL', name: 'Pologne', flag: '🇵🇱', popular: false },
      { code: 'GR', name: 'Grèce', flag: '🇬🇷', popular: false },
      { code: 'IE', name: 'Irlande', flag: '🇮🇪', popular: false },
      { code: 'AU', name: 'Australie', flag: '🇦🇺', popular: false },
      { code: 'NZ', name: 'Nouvelle-Zélande', flag: '🇳🇿', popular: false },
      { code: 'BR', name: 'Brésil', flag: '🇧🇷', popular: false },
      { code: 'MX', name: 'Mexique', flag: '🇲🇽', popular: false },
      { code: 'AR', name: 'Argentine', flag: '🇦🇷', popular: false },
      { code: 'CL', name: 'Chili', flag: '🇨🇱', popular: false },
      { code: 'CO', name: 'Colombie', flag: '🇨🇴', popular: false },
      { code: 'PE', name: 'Pérou', flag: '🇵🇪', popular: false },
      { code: 'VE', name: 'Venezuela', flag: '🇻🇪', popular: false },
      { code: 'JP', name: 'Japon', flag: '🇯🇵', popular: false },
      { code: 'CN', name: 'Chine', flag: '🇨🇳', popular: false },
      { code: 'KR', name: 'Corée du Sud', flag: '🇰🇷', popular: false },
      { code: 'IN', name: 'Inde', flag: '🇮🇳', popular: false },
      { code: 'TH', name: 'Thaïlande', flag: '🇹🇭', popular: false },
      { code: 'VN', name: 'Vietnam', flag: '🇻🇳', popular: false },
      { code: 'ID', name: 'Indonésie', flag: '🇮🇩', popular: false },
      { code: 'MY', name: 'Malaisie', flag: '🇲🇾', popular: false },
      { code: 'SG', name: 'Singapour', flag: '🇸🇬', popular: false },
      { code: 'PH', name: 'Philippines', flag: '🇵🇭', popular: false },
      { code: 'AE', name: 'Émirats arabes unis', flag: '🇦🇪', popular: false },
      { code: 'SA', name: 'Arabie saoudite', flag: '🇸🇦', popular: false },
      { code: 'IL', name: 'Israël', flag: '🇮🇱', popular: false },
      { code: 'TR', name: 'Turquie', flag: '🇹🇷', popular: false },
      { code: 'EG', name: 'Égypte', flag: '🇪🇬', popular: false },
      { code: 'MA', name: 'Maroc', flag: '🇲🇦', popular: false },
      { code: 'TN', name: 'Tunisie', flag: '🇹🇳', popular: false },
      { code: 'DZ', name: 'Algérie', flag: '🇩🇿', popular: false },
      { code: 'SN', name: 'Sénégal', flag: '🇸🇳', popular: false },
      { code: 'CI', name: 'Côte d\'Ivoire', flag: '🇨🇮', popular: false },
      { code: 'CM', name: 'Cameroun', flag: '🇨🇲', popular: false },
      { code: 'KE', name: 'Kenya', flag: '🇰🇪', popular: false },
      { code: 'NG', name: 'Nigeria', flag: '🇳🇬', popular: false },
      { code: 'GH', name: 'Ghana', flag: '🇬🇭', popular: false },
      { code: 'RU', name: 'Russie', flag: '🇷🇺', popular: false },
      { code: 'UA', name: 'Ukraine', flag: '🇺🇦', popular: false },
      { code: 'RO', name: 'Roumanie', flag: '🇷🇴', popular: false },
      { code: 'CZ', name: 'République tchèque', flag: '🇨🇿', popular: false },
      { code: 'HU', name: 'Hongrie', flag: '🇭🇺', popular: false },
    ];

    const countryTrigger = document.getElementById('countryDropdownTrigger');
    const countryMenu = document.getElementById('countryDropdownMenu');
    const countrySelectedText = document.getElementById('countrySelectedText');
    const countryInput = document.getElementById('countryInput');
    const countrySearchInput = document.getElementById('countrySearchInput');
    const countryPopularList = document.getElementById('countryPopularList');
    const countryAllList = document.getElementById('countryAllList');
    const countryAllSection = document.getElementById('countryAllSection');
    const countryNoResults = document.getElementById('countryNoResults');

    if (!countryTrigger || !countryMenu || !countrySelectedText || !countryInput) return;

    let selectedCountryCode = countryInput.value || '';
    let searchDebounceTimer = null;

    function updateSelectedText() {
      if (selectedCountryCode) {
        const country = countriesData.find(c => c.code === selectedCountryCode);
        countrySelectedText.textContent = country ? country.name : 'Tous les pays';
      } else {
        countrySelectedText.textContent = 'Tous les pays';
      }
    }

    function createCountryOption(country) {
      const option = document.createElement('div');
      option.className = 'country-option';
      option.setAttribute('data-code', country.code);
      if (selectedCountryCode === country.code) option.classList.add('selected');
      option.innerHTML = '<span class="country-flag">' + country.flag + '</span><span class="country-name">' + country.name + '</span><span class="country-checkbox"></span>';
      option.addEventListener('click', function(e) { e.stopPropagation(); selectCountry(country.code); });
      return option;
    }

    function renderPopularCountries() {
      if (!countryPopularList) return;
      countryPopularList.innerHTML = '';
      countriesData.filter(c => c.popular).forEach(country => countryPopularList.appendChild(createCountryOption(country)));
    }

    function renderFilteredCountries(searchTerm = '') {
      if (!countryAllList) return;
      const normalizedSearch = searchTerm.toLowerCase().trim();
      let filteredCountries = [];
      if (normalizedSearch === '') {
        filteredCountries = countriesData.filter(c => !c.popular);
        countryAllSection.style.display = filteredCountries.length > 0 ? 'block' : 'none';
        countryNoResults.style.display = 'none';
      } else {
        filteredCountries = countriesData.filter(country => country.name.toLowerCase().includes(normalizedSearch));
        countryAllSection.style.display = filteredCountries.length > 0 ? 'block' : 'none';
        countryNoResults.style.display = filteredCountries.length === 0 ? 'block' : 'none';
        const popularSection = document.querySelector('.country-popular-section');
        if (popularSection) popularSection.style.display = 'none';
      }
      countryAllList.innerHTML = '';
      filteredCountries.forEach(country => countryAllList.appendChild(createCountryOption(country)));
    }

    function selectCountry(code) {
      selectedCountryCode = code;
      countryInput.value = code;
      updateSelectedText();
      updateSelectedState();
      closeDropdown();
      const form = document.getElementById('preplyFiltersForm');
      if (form) form.submit();
    }

    function updateSelectedState() {
      countryMenu.querySelectorAll('.country-option').forEach(opt => {
        const code = opt.getAttribute('data-code');
        if (code === selectedCountryCode) opt.classList.add('selected');
        else opt.classList.remove('selected');
      });
    }

    function openDropdown() {
      countryMenu.style.display = 'block';
      countryTrigger.classList.add('active');
      if (!countrySearchInput.value.trim()) {
        const popularSection = document.querySelector('.country-popular-section');
        if (popularSection) popularSection.style.display = 'block';
      }
      setTimeout(() => { if (countrySearchInput) countrySearchInput.focus(); }, 100);
    }

    function closeDropdown() {
      countryMenu.style.display = 'none';
      countryTrigger.classList.remove('active');
      if (countrySearchInput) countrySearchInput.value = '';
      const popularSection = document.querySelector('.country-popular-section');
      if (popularSection) popularSection.style.display = 'block';
      countryAllSection.style.display = 'none';
      countryNoResults.style.display = 'none';
    }

    countryTrigger.addEventListener('click', function(e) {
      e.stopPropagation();
      if (countryMenu.style.display === 'none' || !countryMenu.style.display) openDropdown();
      else closeDropdown();
    });

    if (countrySearchInput) {
      countrySearchInput.addEventListener('input', function(e) {
        const searchTerm = e.target.value;
        if (searchDebounceTimer) clearTimeout(searchDebounceTimer);
        searchDebounceTimer = setTimeout(() => {
          if (searchTerm.trim() === '') {
            const popularSection = document.querySelector('.country-popular-section');
            if (popularSection) popularSection.style.display = 'block';
            renderFilteredCountries('');
          } else {
            const popularSection = document.querySelector('.country-popular-section');
            if (popularSection) popularSection.style.display = 'none';
            renderFilteredCountries(searchTerm);
          }
        }, 200);
      });
    }

    document.addEventListener('click', function(e) {
      if (!countryTrigger.contains(e.target) && !countryMenu.contains(e.target)) closeDropdown();
    });

    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape' && countryMenu.style.display === 'block') closeDropdown();
    });

    const allCountriesOption = document.createElement('div');
    allCountriesOption.className = 'country-option';
    allCountriesOption.setAttribute('data-code', '');
    if (!selectedCountryCode) allCountriesOption.classList.add('selected');
    allCountriesOption.innerHTML = `<span class="country-flag">🌍</span><span class="country-name">Tous les pays</span><span class="country-checkbox"></span>`;
    allCountriesOption.addEventListener('click', function(e) { e.stopPropagation(); selectCountry(''); });
    if (countryPopularList) countryPopularList.insertBefore(allCountriesOption, countryPopularList.firstChild);

    updateSelectedText();
    renderPopularCountries();
    renderFilteredCountries('');

    const urlParams = new URLSearchParams(window.location.search);
    const urlCountry = urlParams.get('country');
    if (urlCountry) {
      selectedCountryCode = urlCountry;
      countryInput.value = urlCountry;
      updateSelectedText();
      updateSelectedState();
    }
  })();

  // Filtres HomeSwap : chargés via homeswap-filters.js (évite erreurs Blade/JS)
</script>
<script src="<?php echo e(asset('assets/front/js/homeswap-filters.js')); ?>"></script>

<!-- Modale vidéo -->
<div id="videoModal" class="video-modal-overlay">
  <div class="video-modal-container">
    <button class="video-modal-close" id="videoModalClose" aria-label="Fermer la vidéo">&times;</button>
    <div class="video-modal-content" id="videoModalContent">
      <!-- Le contenu vidéo sera injecté ici -->
    </div>
  </div>
</div>

<!-- Modale Premium HomeSwap -->
<div id="premiumModal" class="premium-modal-overlay" style="display: none;">
  <div class="premium-modal-container">
    <button class="premium-modal-close" onclick="closePremiumModal()" aria-label="Fermer">&times;</button>
    <div class="premium-modal-content">
      <div class="premium-modal-icon">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 64px; height: 64px; color: #EC4899;">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
        </svg>
      </div>
      <h2 class="premium-modal-title">Abonnement HomeSwap requis</h2>
      <p class="premium-modal-message" id="premiumModalMessage">
        Pour contacter les propriétaires et organiser une visio, l'abonnement HomeSwap est requis.
      </p>
      <div class="premium-modal-features">
        <div class="premium-modal-feature">
          <svg class="premium-modal-feature-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
          </svg>
          <span>Messages illimités</span>
        </div>
        <div class="premium-modal-feature">
          <svg class="premium-modal-feature-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
          </svg>
          <span>Visio sécurisée</span>
        </div>
        <div class="premium-modal-feature">
          <svg class="premium-modal-feature-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
          </svg>
          <span>Accès au système de points</span>
        </div>
      </div>
      <div class="premium-modal-cta">
        <?php if($isAuthenticated): ?>
          <form action="<?php echo e(route('mission.homeswap.checkout')); ?>" method="POST" style="margin: 0;">
            <?php echo csrf_field(); ?>
            <button type="submit" class="premium-modal-btn">
              S'abonner (99€/an)
            </button>
          </form>
        <?php else: ?>
          <a href="<?php echo e(route('user.login', ['redirect' => route('services.homeswap')])); ?>" class="premium-modal-btn">
            Se connecter pour s'abonner
          </a>
        <?php endif; ?>
        <a href="#homeswapSubscription" class="premium-modal-link" onclick="closePremiumModal(); setTimeout(() => document.getElementById('homeswapSubscription').scrollIntoView({behavior: 'smooth'}), 100);">
          En savoir plus sur l'abonnement
        </a>
      </div>
    </div>
  </div>
</div>

<script>
  // Gating Premium HomeSwap
  function showPremiumModal(action) {
    const modal = document.getElementById('premiumModal');
    const messageEl = document.getElementById('premiumModalMessage');
    
    let message = 'Pour contacter les propriétaires et organiser une visio, l\'abonnement HomeSwap est requis.';
    if (action === 'message') {
      message = 'Pour envoyer un message, l\'abonnement HomeSwap est requis.';
    } else if (action === 'agenda') {
      message = 'Pour voir l\'agenda complet et organiser une visio, l\'abonnement HomeSwap est requis.';
    } else if (action === 'profil') {
      message = 'Pour voir le profil complet, l\'abonnement HomeSwap est requis.';
    } else if (action === 'logement') {
      message = 'Pour voir le logement en détail, l\'abonnement HomeSwap est requis.';
    }
    
    if (messageEl) {
      messageEl.textContent = message;
    }
    
    if (modal) {
      modal.style.display = 'flex';
      document.body.style.overflow = 'hidden';
    }
  }
  
  function closePremiumModal() {
    const modal = document.getElementById('premiumModal');
    if (modal) {
      modal.style.display = 'none';
      document.body.style.overflow = '';
    }
  }
  
  // Fermer la modale en cliquant sur l'overlay
  document.getElementById('premiumModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
      closePremiumModal();
    }
  });
  
  // Fermer avec Escape
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
      closePremiumModal();
    }
  });
</script>

<style>
  /* Modale Premium */
  .premium-modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.6);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 10000;
    backdrop-filter: blur(4px);
  }
  
  .premium-modal-container {
    position: relative;
    background: white;
    border-radius: 24px;
    padding: 40px;
    max-width: 500px;
    width: 90%;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    animation: premiumModalSlideIn 0.3s ease-out;
  }
  
  @keyframes premiumModalSlideIn {
    from {
      opacity: 0;
      transform: translateY(-20px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
  
  .premium-modal-close {
    position: absolute;
    top: 16px;
    right: 16px;
    width: 32px;
    height: 32px;
    background: #f3f4f6;
    border: none;
    border-radius: 50%;
    color: #6b7280;
    font-size: 20px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
  }
  
  .premium-modal-close:hover {
    background: #e5e7eb;
    color: #374151;
  }
  
  .premium-modal-content {
    text-align: center;
  }
  
  .premium-modal-icon {
    margin-bottom: 20px;
  }
  
  .premium-modal-title {
    font-size: 1.75rem;
    font-weight: 700;
    color: var(--preply-text);
    margin-bottom: 12px;
  }
  
  .premium-modal-message {
    font-size: 1rem;
    color: var(--preply-text-light);
    margin-bottom: 24px;
    line-height: 1.6;
  }
  
  .premium-modal-features {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-bottom: 32px;
    padding: 20px;
    background: #f9fafb;
    border-radius: 12px;
  }
  
  .premium-modal-feature {
    display: flex;
    align-items: center;
    gap: 12px;
    justify-content: center;
  }
  
  .premium-modal-feature-icon {
    width: 20px;
    height: 20px;
    color: var(--preply-primary);
  }
  
  .premium-modal-feature span {
    font-size: 0.9375rem;
    color: var(--preply-text);
  }
  
  .premium-modal-cta {
    display: flex;
    flex-direction: column;
    gap: 12px;
  }
  
  .premium-modal-btn {
    display: block;
    width: 100%;
    padding: 12px 24px;
    border-radius: 9999px;
    font-weight: 600;
    font-size: 0.9375rem;
    text-align: center;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    background: linear-gradient(90deg, #F472B6 0%, #C084FC 50%, #60A5FA 100%);
    color: white;
    box-shadow: 0 2px 8px rgba(244, 114, 182, 0.15);
    letter-spacing: 0.01em;
  }
  
  .premium-modal-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(244, 114, 182, 0.2);
    background: linear-gradient(90deg, #EC4899 0%, #A855F7 50%, #3B82F6 100%);
  }

  .premium-modal-btn:active {
    transform: translateY(0.5px);
    transition-duration: 0.1s;
  }

  .premium-modal-btn:focus-visible {
    outline: none;
    box-shadow: 0 0 0 3px rgba(236, 72, 153, 0.2);
  }
  
  .premium-modal-link {
    color: var(--preply-primary);
    text-decoration: underline;
    font-size: 0.875rem;
  }
  
  .premium-modal-link:hover {
    color: var(--preply-primary-dark);
  }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\services\homeswap.blade.php ENDPATH**/ ?>