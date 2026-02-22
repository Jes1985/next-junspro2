<?php $__env->startSection('style'); ?>
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/summernote-content.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/components/topup-modal.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/components/change-plan-modal.css')); ?>">
  <style>
    :root {
      --junspro-purple: #7C3AED;
      --junspro-blue: #1e40af;
      --junspro-gradient: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
      --card-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      --card-shadow-hover: 0 8px 30px rgba(30, 64, 175, 0.15);
    }

    /* Layout principal */
    .settings-container {
      max-width: 1280px;
      margin: 0 auto;
      padding: 2rem 1.5rem;
      padding-top: 3rem;
      background: linear-gradient(135deg, #f3e8ff 0%, #e9d5ff 50%, #ddd6fe 100%);
      min-height: calc(100vh - 200px);
    }

    /* Container principal en 2 colonnes */
    .settings-wrapper {
      display: grid;
      grid-template-columns: 25% 75%;
      gap: 2rem;
      margin-top: 2rem;
    }

    /* Menu vertical gauche */
    .settings-sidebar {
      background: white;
      border-radius: 20px;
      box-shadow: var(--card-shadow);
      padding: 1.5rem 0;
      height: fit-content;
      position: sticky;
      top: 2rem;
    }

    .settings-sidebar-title {
      padding: 0 1.5rem 1rem 1.5rem;
      font-size: 0.875rem;
      font-weight: 600;
      color: #6b7280;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      border-bottom: 1px solid #e5e7eb;
      margin-bottom: 0.5rem;
    }

    .settings-menu {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .settings-menu-item {
      margin: 0;
    }

    .settings-menu-item a {
      display: block;
      padding: 0.875rem 1.5rem;
      color: #374151;
      text-decoration: none;
      font-size: 0.95rem;
      font-weight: 500;
      transition: all 0.2s ease;
      border-left: 3px solid transparent;
      position: relative;
    }

    .settings-menu-item a:hover {
      background: #f9fafb;
      color: var(--junspro-purple);
    }

    .settings-menu-item a.active {
      background: #f3f4f6;
      color: var(--junspro-purple);
      font-weight: 600;
      border-left-color: var(--junspro-purple);
    }

    /* Contenu principal droite */
    .settings-content {
      background: white;
      border-radius: 20px;
      box-shadow: var(--card-shadow);
      padding: 2.5rem;
    }

    /* Header style Preply - Titre aligné à droite */
    .settings-header {
      margin-bottom: 2rem;
      text-align: right;
    }

    .settings-header h1 {
      font-size: 1.75rem;
      font-weight: 700;
      color: #1a202c;
      margin: 0;
    }

    /* Liste de cartes style Preply */
    .subscriptions-list {
      display: flex;
      flex-direction: column;
      gap: 1.25rem;
    }

    .subscription-card-preply {
      background: white;
      border: 1px solid #e5e7eb;
      border-radius: 12px;
      padding: 1.75rem;
      position: relative;
      transition: all 0.2s ease;
      margin-bottom: 1rem;
    }

    .subscription-card-preply:hover {
      border-color: #d1d5db;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .subscription-card-header {
      display: flex;
      align-items: flex-start;
      gap: 1rem;
      margin-bottom: 1rem;
    }

    .subscription-avatar {
      width: 80px;
      height: 80px;
      border-radius: 12px;
      object-fit: cover;
      flex-shrink: 0;
      border: 1px solid #e5e7eb;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .subscription-avatar-initials {
      width: 80px;
      height: 80px;
      border-radius: 12px;
      background: var(--junspro-gradient);
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 700;
      font-size: 2rem;
      flex-shrink: 0;
      border: 1px solid #e5e7eb;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .subscription-info {
      flex: 1;
      min-width: 0;
    }

    .subscription-name {
      font-size: 1.125rem;
      font-weight: 600;
      color: #1a202c;
      margin-bottom: 0.25rem;
    }

    .subscription-service {
      font-size: 0.9rem;
      color: #6b7280;
      margin-bottom: 0.5rem;
    }

    .subscription-details-line {
      font-size: 0.875rem;
      color: #6b7280;
      margin-bottom: 0.5rem;
    }

    /* ── Jauge d'utilisation du cycle jp- ─────────────────────────── */
    .jp-usage-gauge-wrap {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 0.6rem;
      margin: 1rem 0 0.5rem;
    }
    .jp-gauge-svg {
      width: 110px;
      height: 110px;
      overflow: visible;
    }
    .jp-gauge-track {
      fill: none;
      stroke: #e5e7eb;
      stroke-width: 8;
      stroke-linecap: round;
    }
    .jp-gauge-fill {
      fill: none;
      stroke-width: 8;
      stroke-linecap: round;
      transition: stroke-dashoffset 0.6s ease, stroke 0.4s ease;
    }
    .jp-gauge-pct {
      font-size: 18px;
      font-weight: 700;
      fill: #111827;
      text-anchor: middle;
      dominant-baseline: middle;
    }
    .jp-gauge-sub {
      font-size: 9px;
      fill: #6b7280;
      text-anchor: middle;
      dominant-baseline: middle;
    }
    .jp-gauge-legend {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 0.15rem;
    }
    .jp-gauge-legend-used {
      font-size: 0.8rem;
      font-weight: 600;
    }
    .jp-gauge-legend-left {
      font-size: 0.75rem;
      color: #6b7280;
    }
    .jp-gauge-legend-topup {
      font-size: 0.7rem;
      color: #9ca3af;
      font-style: italic;
    }
    /* ── fin jauge ─────────────────────────────────────────────────── */

    /* ── Nudge banner (inline dans la carte) ───────────────────────── */
    .jp-nudge-banner {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 0.5rem;
      margin-top: 0.75rem;
      padding: 0.6rem 0.8rem;
      border-radius: 8px;
      cursor: pointer;
      transition: opacity 0.15s;
      border: 1px solid transparent;
      user-select: none;
    }
    .jp-nudge-banner:hover { opacity: 0.85; }
    .jp-nudge-banner.jp-nudge-soft70    { background: #fffbeb; border-color: #fcd34d; }
    .jp-nudge-banner.jp-nudge-strong85,
    .jp-nudge-banner.jp-nudge-repeat    { background: #fff1f2; border-color: #fca5a5; }
    .jp-nudge-banner.jp-nudge-afterTopup { background: #eff6ff; border-color: #93c5fd; }
    .jp-nudge-content { display: flex; align-items: flex-start; gap: 0.4rem; flex: 1; min-width: 0; }
    .jp-nudge-icon { font-size: 1rem; flex-shrink: 0; line-height: 1.4; }
    .jp-nudge-text { font-size: 0.75rem; color: #374151; line-height: 1.4; }
    .jp-nudge-cta  { font-size: 0.7rem; font-weight: 600; color: #4f46e5; white-space: nowrap; flex-shrink: 0; }

    /* ── Bottom-sheet nudge upgrade ────────────────────────────────── */
    .jp-nudge-backdrop {
      position: fixed; inset: 0;
      background: rgba(0,0,0,0.45);
      z-index: 9990;
      display: flex; align-items: flex-end; justify-content: center;
      opacity: 0; pointer-events: none;
      transition: opacity 0.25s;
    }
    .jp-nudge-backdrop.active {
      opacity: 1; pointer-events: all;
    }
    .jp-nudge-sheet {
      width: 100%; max-width: 520px;
      background: #fff;
      border-radius: 20px 20px 0 0;
      padding-bottom: env(safe-area-inset-bottom, 0);
      transform: translateY(100%);
      transition: transform 0.3s cubic-bezier(0.33, 1, 0.68, 1);
    }
    .jp-nudge-backdrop.active .jp-nudge-sheet {
      transform: translateY(0);
    }
    .jp-sheet-handle-bar {
      width: 44px; height: 5px;
      background: #e5e7eb;
      border-radius: 3px;
      margin: 12px auto 0;
    }
    .jp-sheet-inner {
      padding: 0.75rem 1.5rem 2rem;
      position: relative;
      text-align: center;
    }
    .jp-sheet-close-btn {
      position: absolute; top: 0.25rem; right: 1rem;
      background: none; border: none;
      font-size: 1.1rem; color: #9ca3af;
      cursor: pointer; padding: 0.25rem; line-height: 1;
    }
    .jp-sheet-eyebrow {
      font-size: 0.65rem; text-transform: uppercase;
      letter-spacing: 0.08em; color: #6b7280;
      margin: 0.5rem 0 0.2rem;
    }
    .jp-sheet-title {
      font-size: 1.05rem; font-weight: 700; color: #111827;
      margin: 0 0 1rem;
    }
    .jp-sheet-compare {
      display: flex; align-items: center; justify-content: center;
      gap: 0.75rem; margin-bottom: 0.875rem;
    }
    .jp-sheet-plan {
      flex: 1; padding: 0.6rem 0.5rem;
      border-radius: 12px; border: 2px solid #e5e7eb;
      background: #f9fafb;
    }
    .jp-sheet-plan-next { border-color: #4f46e5; background: #eef2ff; }
    .jp-sheet-plan-label { font-size: 0.6rem; text-transform: uppercase; color: #9ca3af; margin: 0 0 0.2rem; }
    .jp-sheet-plan-hours { font-size: 1.6rem; font-weight: 800; color: #111827; margin: 0; line-height: 1.1; }
    .jp-sheet-plan-next .jp-sheet-plan-hours { color: #4f46e5; }
    .jp-sheet-plan-sub { font-size: 0.6rem; color: #6b7280; margin: 0.1rem 0 0; }
    .jp-sheet-arrow { font-size: 1.3rem; color: #9ca3af; flex-shrink: 0; }
    .jp-sheet-reason {
      font-size: 0.78rem; color: #4b5563;
      line-height: 1.5; margin-bottom: 1rem;
      background: #f3f4f6; border-radius: 8px;
      padding: 0.55rem 0.75rem; text-align: left;
    }
    .jp-sheet-upgrade-btn {
      display: block; width: 100%;
      padding: 0.8rem 1rem;
      background: linear-gradient(135deg, #4f46e5, #7c3aed);
      color: #fff; font-weight: 700; font-size: 0.875rem;
      border-radius: 10px; text-decoration: none;
      margin-bottom: 0.5rem;
      transition: opacity 0.15s;
      text-align: center;
    }
    .jp-sheet-upgrade-btn:hover { opacity: 0.9; color: #fff; }
    .jp-sheet-dismiss-btn {
      background: none; border: none;
      font-size: 0.78rem; color: #9ca3af;
      cursor: pointer; padding: 0.25rem;
    }
    /* ── fin bottom-sheet nudge ─────────────────────────────────────── */

    .subscription-status-badge {
      display: block;
      padding: 0.375rem 0.875rem;
      border-radius: 6px;
      font-size: 0.75rem;
      font-weight: 600;
      margin: 0.75rem auto 0 auto;
      text-align: center;
      width: fit-content;
    }

    .subscription-status-badge.active {
      background: #d1fae5;
      color: #065f46;
    }

    .subscription-status-badge.paused {
      background: #fef3c7;
      color: #92400e;
    }

    .subscription-status-badge.cancelled {
      background: #fee2e2;
      color: #991b1b;
    }

    .subscription-action-box {
      margin-top: 1rem;
      padding-top: 1rem;
      border-top: 1px solid #e5e7eb;
      text-align: center;
    }

    .subscription-action-box-button {
      display: inline-block;
      padding: 0.75rem 1.5rem;
      background: white;
      color: #1a202c;
      border: 1px solid #1a202c;
      border-radius: 8px;
      font-size: 0.9rem;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.2s ease;
      text-decoration: none;
      width: 100%;
      max-width: 300px;
      text-align: center;
    }

    .subscription-action-box-button:hover {
      background: #1a202c;
      color: white;
      text-decoration: none;
    }

    .subscription-action-box-button.primary {
      background: var(--junspro-gradient);
      color: white;
      border: none;
    }

    .subscription-action-box-button.primary:hover {
      background: var(--junspro-gradient);
      opacity: 0.9;
      color: white;
      text-decoration: none;
    }

    .subscription-action-box-button.danger {
      background: white;
      color: #dc2626;
      border-color: #dc2626;
    }

    .subscription-action-box-button.danger:hover {
      background: #fef2f2;
      color: #991b1b;
      border-color: #991b1b;
      text-decoration: none;
    }

    .subscription-action-button {
      margin-top: 1rem;
      padding: 0.75rem 1.5rem;
      background: white;
      color: #1a202c;
      border: 1px solid #1a202c;
      border-radius: 8px;
      font-size: 0.9rem;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.2s ease;
      text-decoration: none;
      display: inline-block;
      width: 100%;
      text-align: center;
    }

    .subscription-action-button:hover {
      background: #1a202c;
      color: white;
      text-decoration: none;
    }

    /* Menu kebab "…" style Preply */
    .subscription-menu {
      position: absolute;
      top: 1rem;
      right: 1rem;
    }

    .subscription-menu-btn {
      background: none;
      border: none;
      color: #6b7280;
      font-size: 1.25rem;
      cursor: pointer;
      padding: 0.5rem;
      border-radius: 6px;
      transition: all 0.2s ease;
      line-height: 1;
      width: 32px;
      height: 32px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .subscription-menu-btn:hover {
      background: #f3f4f6;
      color: #374151;
    }

    /* Amélioration visibilité du bouton kebab sur fond dégradé violet - Scoped uniquement sur la carte abonnement */
    .subscription-card-preply .jspro-subscription-kebab {
      width: 36px;
      height: 36px;
      background: rgba(255, 255, 255, 0.12);
      border: 1px solid rgba(255, 255, 255, 0.18);
      border-radius: 50%;
      color: #000000;
      font-size: 1.75rem;
      font-weight: 900;
      line-height: 1;
      padding: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.2s ease;
      backdrop-filter: blur(4px);
      -webkit-backdrop-filter: blur(4px);
      letter-spacing: -0.05em;
    }

    .subscription-card-preply .jspro-subscription-kebab:hover {
      background: rgba(255, 255, 255, 0.18);
      border-color: rgba(255, 255, 255, 0.25);
      color: #000000;
      transform: scale(1.05);
    }

    .subscription-card-preply .jspro-subscription-kebab:focus {
      outline: 2px solid rgba(255, 255, 255, 0.55);
      outline-offset: 2px;
      background: rgba(255, 255, 255, 0.18);
    }

    .subscription-card-preply .jspro-subscription-kebab:active {
      transform: scale(0.95);
    }

    .subscription-menu-dropdown {
      position: absolute;
      top: 100%;
      right: 0;
      margin-top: 0.5rem;
      background: white;
      border: 1px solid #e5e7eb;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
      min-width: 240px;
      z-index: 1000;
      display: none;
      overflow: hidden;
    }

    .subscription-menu-dropdown.show {
      display: block;
    }

    .subscription-menu-item {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      padding: 0.75rem 1rem;
      color: #374151;
      text-decoration: none;
      font-size: 0.9rem;
      transition: all 0.2s ease;
      border: none;
      background: none;
      width: 100%;
      text-align: left;
      cursor: pointer;
    }

    .subscription-menu-item:hover {
      background: #f9fafb;
      color: #1a202c;
    }

    .subscription-menu-item.danger {
      color: #dc2626;
    }

    .subscription-menu-item.danger:hover {
      background: #fef2f2;
      color: #991b1b;
    }

    .subscription-menu-separator {
      height: 1px;
      background: #e5e7eb;
      margin: 0.25rem 0;
    }

    .subscription-menu-icon {
      width: 18px;
      height: 18px;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    /* Section Fonctionnement de l'abonnement */
    .subscription-faq-section {
      margin-top: 3rem;
      padding-top: 2rem;
      border-top: 1px solid #e5e7eb;
    }

    .subscription-faq-title {
      font-size: 1.5rem;
      font-weight: 700;
      color: #1a202c;
      margin-bottom: 1.5rem;
    }

    .subscription-faq-list {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .subscription-faq-item {
      border-bottom: 1px solid #e5e7eb;
    }

    .subscription-faq-item:last-child {
      border-bottom: none;
    }

    .subscription-faq-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 1.25rem 0;
      cursor: pointer;
      transition: all 0.2s ease;
      user-select: none;
    }

    .subscription-faq-header:hover {
      color: var(--junspro-purple);
    }

    .subscription-faq-question {
      font-size: 0.95rem;
      font-weight: 500;
      color: #374151;
      flex: 1;
    }

    .subscription-faq-chevron {
      color: #9ca3af;
      font-size: 0.875rem;
      transition: transform 0.3s ease;
      flex-shrink: 0;
      margin-left: 1rem;
    }

    .subscription-faq-item.active .subscription-faq-chevron {
      transform: rotate(180deg);
      color: var(--junspro-purple);
    }

    .subscription-faq-content {
      max-height: 0;
      overflow: hidden;
      transition: max-height 0.3s ease, padding 0.3s ease;
      padding: 0 0 0 0;
    }

    .subscription-faq-item.active .subscription-faq-content {
      max-height: 500px;
      padding: 0 0 1.25rem 0;
    }

    .subscription-faq-answer {
      font-size: 0.9rem;
      color: #6b7280;
      line-height: 1.7;
      padding-top: 0.5rem;
    }

    .subscription-faq-answer p {
      margin-bottom: 0.75rem;
    }

    .subscription-faq-answer p:last-child {
      margin-bottom: 0;
    }

    .subscription-faq-answer strong {
      color: #374151;
      font-weight: 600;
    }

    .subscription-faq-answer ul {
      margin: 0.75rem 0;
      padding-left: 1.5rem;
    }

    .subscription-faq-answer li {
      margin-bottom: 0.5rem;
    }

    /* Empty state */
    .empty-state {
      text-align: center;
      padding: 4rem 2rem;
      color: #6b7280;
    }

    .empty-state-icon {
      font-size: 4rem;
      margin-bottom: 1.5rem;
      opacity: 0.5;
      color: var(--junspro-purple);
    }

    .empty-state-title {
      font-size: 1.5rem;
      font-weight: 600;
      color: #1a202c;
      margin-bottom: 0.75rem;
    }

    .empty-state-text {
      font-size: 1rem;
      margin-bottom: 2rem;
      max-width: 500px;
      margin-left: auto;
      margin-right: auto;
    }

    /* Alertes */
    .alert {
      padding: 1rem 1.5rem;
      border-radius: 12px;
      margin-bottom: 1.5rem;
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }

    .alert-success {
      background: #f0fdf4;
      color: #166534;
      border: 1px solid #86efac;
    }

    .alert-error {
      background: #fef2f2;
      color: #991b1b;
      border: 1px solid #fca5a5;
    }

    /* Responsive */
    @media (max-width: 968px) {
      .settings-wrapper {
        grid-template-columns: 1fr;
      }

      .settings-sidebar {
        position: relative;
        top: 0;
      }

      .settings-menu {
        display: flex;
        overflow-x: auto;
        padding: 0 1rem;
        -webkit-overflow-scrolling: touch;
      }

      .settings-menu-item {
        flex-shrink: 0;
      }

      .settings-menu-item a {
        white-space: nowrap;
        border-left: none;
        border-bottom: 3px solid transparent;
        padding: 0.875rem 1rem;
      }

      .settings-menu-item a.active {
        border-left: none;
        border-bottom-color: var(--junspro-purple);
      }

      .settings-header {
        text-align: left;
      }
    }

    @media (max-width: 640px) {
      .settings-container {
        padding: 1rem;
        padding-top: 2rem;
      }

      .settings-content {
        padding: 1.5rem;
      }

      .subscription-card-preply {
        padding: 1rem;
      }
    }
  </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <div class="settings-container">
    <?php echo $__env->make('frontend.client.partials.dashboard-nav', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="settings-wrapper">
      <!-- Menu vertical gauche -->
      <aside class="settings-sidebar">
        <div class="settings-sidebar-title"><?php echo e(__('Compte')); ?></div>
        <ul class="settings-menu">
          <li class="settings-menu-item">
            <a href="<?php echo e(route('user.settings.index')); ?>" class="<?php echo e(request()->routeIs('user.settings.index') ? 'active' : ''); ?>">
              <?php echo e(__('Compte')); ?>

            </a>
          </li>
          <li class="settings-menu-item">
            <a href="<?php echo e(route('user.settings.password')); ?>" class="<?php echo e(request()->routeIs('user.settings.password') ? 'active' : ''); ?>">
              <?php echo e(__('Mot de passe')); ?>

            </a>
          </li>
          <li class="settings-menu-item">
            <a href="<?php echo e(route('user.settings.email.edit')); ?>" class="<?php echo e(request()->routeIs('user.settings.email.*') ? 'active' : ''); ?>">
              <?php echo e(__('Adresse e-mail')); ?>

            </a>
          </li>
          <li class="settings-menu-item">
            <a href="<?php echo e(route('user.settings.payment_methods.index')); ?>" class="<?php echo e(request()->routeIs('user.settings.payment_methods.*') ? 'active' : ''); ?>">
              <?php echo e(__('Modes de paiement')); ?>

            </a>
          </li>
          <li class="settings-menu-item">
            <a href="<?php echo e(route('user.settings.subscription')); ?>" class="<?php echo e(request()->routeIs('user.settings.subscription') ? 'active' : ''); ?>">
              <?php echo e(__('Abonnement Junspro')); ?>

            </a>
          </li>
          <li class="settings-menu-item">
            <a href="<?php echo e(route('user.settings.billing_history')); ?>" class="<?php echo e(request()->routeIs('user.settings.billing_history.*') ? 'active' : ''); ?>">
              <?php echo e(__('Historique de paiement')); ?>

            </a>
          </li>
          <li class="settings-menu-item">
            <a href="<?php echo e(route('user.settings.auto_confirmation')); ?>" class="<?php echo e(request()->routeIs('user.settings.auto_confirmation*') ? 'active' : ''); ?>">
              <?php echo e(__('Confirmation automatique')); ?>

            </a>
          </li>
          <li class="settings-menu-item">
            <a href="<?php echo e(route('user.settings.agenda')); ?>" class="<?php echo e(request()->routeIs('user.settings.agenda*') ? 'active' : ''); ?>">
              <?php echo e(__('Agenda & fuseau horaire')); ?>

            </a>
          </li>
          <li class="settings-menu-item">
            <?php
              try {
                $notificationsUrl = route('user.settings.notifications');
              } catch (\Exception $e) {
                $notificationsUrl = url('/user/settings/notifications');
              }
            ?>
            <a href="<?php echo e($notificationsUrl); ?>" class="<?php echo e(request()->routeIs('user.settings.notifications*') ? 'active' : ''); ?>">
              <?php echo e(__('Notifications')); ?>

            </a>
          </li>
          <li class="settings-menu-item">
            <?php
              try {
                $connectionsUrl = route('user.settings.connections');
              } catch (\Exception $e) {
                $connectionsUrl = url('/user/settings/connections');
              }
            ?>
            <a href="<?php echo e($connectionsUrl); ?>" class="<?php echo e(request()->routeIs('user.settings.connections*') ? 'active' : ''); ?>">
              <?php echo e(__('Connexions & autorisations')); ?>

            </a>
          </li>
          <li class="settings-menu-item">
            <?php
              try {
                $deleteAccountUrl = route('user.settings.delete_account');
              } catch (\Exception $e) {
                $deleteAccountUrl = url('/user/settings/delete-account');
              }
            ?>
            <a href="<?php echo e($deleteAccountUrl); ?>" class="danger-link <?php echo e(request()->routeIs('user.settings.delete_account*') ? 'active' : ''); ?>" style="color: #dc2626;">
              <?php echo e(__('Supprimer le compte')); ?>

            </a>
          </li>
        </ul>
      </aside>

      <!-- Contenu principal droite -->
      <main class="settings-content">
        <!-- En-tête style Preply - Titre aligné à droite -->
        <div class="settings-header">
          <h1><?php echo e(__('Gérez vos abonnements')); ?></h1>
        </div>

        <?php if(session('status') === 'subscription-paused' || (session('success') && session('status') === 'subscription-paused')): ?>
          <div class="alert alert-success">
            ✅ <?php echo e(session('success', __('Votre abonnement a été mis en pause.'))); ?>

          </div>
        <?php endif; ?>

        <?php if(session('status') === 'subscription-resumed' || (session('success') && session('status') === 'subscription-resumed')): ?>
          <div class="alert alert-success">
            ✅ <?php echo e(session('success', __('Votre abonnement a été repris.'))); ?>

          </div>
        <?php endif; ?>

        <?php if(session('status') === 'subscription-cancelled' || (session('success') && session('status') === 'subscription-cancelled')): ?>
          <div class="alert alert-success">
            ✅ <?php echo e(session('success', __('Votre abonnement a été annulé.'))); ?>

          </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
          <div class="alert alert-error">
            ⚠️ <?php echo e(session('error')); ?>

          </div>
        <?php endif; ?>

        <?php if($subscriptions && $subscriptions->count() > 0): ?>
          <div class="subscriptions-list">
          <?php $__currentLoopData = $subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
              $freelancer = $subscription->freelancer->user ?? null;
                $freelancerName = $freelancer ? ($freelancer->first_name . ' ' . $freelancer->last_name) : 'Freelance';
              $nextBillingDate = $subscription->next_billing_at ? \Carbon\Carbon::parse($subscription->next_billing_at) : null;
                $daysUntilRenewal = $nextBillingDate ? now()->diffInDays($nextBillingDate, false) : null;
                $hoursRemaining = $subscription->calculated_hours_remaining ?? 0;

              // ── Données jauge cycle ──────────────────────────────
              $cycleUsageSvc  = app(\App\Services\Junspro\CycleUsageService::class);
              $universeType   = $cycleUsageSvc->universeType($subscription->universe ?? '');
              $hoursPerCycle  = ($subscription->hours_per_week ?? 0) * 4;
              $palier         = $cycleUsageSvc->snapToPalier($hoursPerCycle, $universeType);
              $cycleMax       = $cycleUsageSvc->cycleMaxTotal($hoursPerCycle, $universeType);
              $topupMax       = $cycleUsageSvc->topupCap($hoursPerCycle, $universeType);
              $usedHours      = max(0, $hoursPerCycle - (float)$hoursRemaining);
              $usageRatio     = $hoursPerCycle > 0 ? min(1, $usedHours / $hoursPerCycle) : 0;
              // Arc SVG : cercle r=44, circonférence = 2π×44 ≈ 276.5
              $svgR           = 44;
              $svgCirc        = round(2 * M_PI * $svgR, 2);
              $svgOffset      = round($svgCirc * (1 - $usageRatio), 2);
              // Couleur selon ratio
              $gaugeColor     = $usageRatio < 0.70 ? '#10B981' : ($usageRatio < 0.85 ? '#F59E0B' : '#EF4444');
              $nudge          = $cycleUsageSvc->shouldShowUpgradeNudge(
                $usageRatio,
                false, // topup utilisé — à brancher plus tard depuis la DB
                0
              );

              // ── Palier suivant (pour bottom-sheet nudge) ─────────
              $paliersArr       = $universeType === \App\Services\Junspro\CycleUsageService::UNIVERSE_B
                                    ? \App\Services\Junspro\CycleUsageService::PALIERS_B
                                    : \App\Services\Junspro\CycleUsageService::PALIERS_A;
              $currentPalierIdx = array_search($palier, $paliersArr);
              $nextPalierCycle  = ($currentPalierIdx !== false && isset($paliersArr[$currentPalierIdx + 1]))
                                    ? $paliersArr[$currentPalierIdx + 1]
                                    : $palier;
              $isAtMaxPalier    = ($nextPalierCycle === $palier);
            ?>

              <div class="subscription-card-preply">
                <!-- Menu kebab "…" -->
                <div class="subscription-menu">
                  <button class="subscription-menu-btn jspro-subscription-kebab" type="button" onclick="toggleMenu(<?php echo e($subscription->id); ?>)" aria-label="<?php echo e(__('Actions')); ?>">
                    ⋯
                  </button>
                  <div class="subscription-menu-dropdown" id="menu-<?php echo e($subscription->id); ?>">
                    <?php if($subscription->status === 'paused'): ?>
                      <form method="POST" action="<?php echo e(route('user.settings.subscription.resume', $subscription->id)); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="subscription-menu-item">
                          <span class="subscription-menu-icon"><i class="fas fa-play"></i></span>
                          <span><?php echo e(__('S\'abonner à nouveau')); ?></span>
                        </button>
                      </form>
                    <?php endif; ?>
                    
                    <button 
                      type="button"
                      class="subscription-menu-item"
                      onclick="openTopUpModal({
                        subscriptionId: <?php echo e($subscription->id); ?>,
                        tutorName: '<?php echo e(addslashes($freelancerName)); ?>',
                        avatarUrl: '<?php echo e($freelancer && $freelancer->image ? asset('assets/img/users/' . $freelancer->image) : ''); ?>',
                        unitPrice: <?php echo e($subscription->client_hourly_rate_snapshot ?? $subscription->base_hourly_rate_snapshot ?? 0); ?>,
                        scheduleUntil: '<?php echo e($nextBillingDate ? $nextBillingDate->format('d M Y') : ''); ?>',
                        postUrl: '<?php echo e(route('user.account.subscriptions.topup', $subscription->id)); ?>',
                        quotaUrl: '<?php echo e(route('user.account.subscriptions.topup-quota', $subscription->id)); ?>',
                        csrf: '<?php echo e(csrf_token()); ?>',
                        ritualSignature: '<?php echo e(addslashes($ritualSignature ?? '')); ?>',
                        upgradeDetails: '<?php echo e(__('Passez de')); ?> <?php echo e($subscription->hours_per_week); ?> <?php echo e(__('Rituels/semaine')); ?> <?php echo e(__('à')); ?> <?php echo e(min(24, $subscription->hours_per_week + 1)); ?> <?php echo e(__('Rituels/semaine')); ?>'
                      }); toggleMenu(<?php echo e($subscription->id); ?>);"
                    >
                      <span class="subscription-menu-icon"><i class="fas fa-plus-circle"></i></span>
                      <span><?php echo e(__('Ajouter des Rituels supplémentaires')); ?></span>
                    </button>
                    
                    <button 
                      type="button"
                      class="subscription-menu-item"
                      onclick="openChangePlanFlow({
                        subscriptionId: <?php echo e($subscription->id); ?>,
                        tutorName: '<?php echo e(addslashes($freelancerName)); ?>',
                        avatarUrl: '<?php echo e($freelancer && $freelancer->image ? asset('assets/img/users/' . $freelancer->image) : ''); ?>',
                        currentHours: <?php echo e($subscription->hours_per_week); ?>,
                        currentPrice: <?php echo e($subscription->price_base ?? 0); ?>,
                        unitPrice: <?php echo e($subscription->client_hourly_rate_snapshot ?? $subscription->base_hourly_rate_snapshot ?? 0); ?>,
                        nextBillingDate: '<?php echo e($nextBillingDate ? $nextBillingDate->format('Y-m-d H:i:s') : ''); ?>',
                        contextUrl: '<?php echo e(route('user.account.subscriptions.change-plan-context', $subscription->id)); ?>',
                        submitUrl: '<?php echo e(route('user.account.subscriptions.change-plan', $subscription->id)); ?>',
                        csrf: '<?php echo e(csrf_token()); ?>'
                      }); toggleMenu(<?php echo e($subscription->id); ?>);"
                    >
                      <span class="subscription-menu-icon"><i class="fas fa-exchange-alt"></i></span>
                      <span><?php echo e(__('Changer de formule')); ?></span>
                    </button>
                    
                    <button 
                      type="button"
                      class="subscription-menu-item"
                      onclick="openTransferEntryModal({
                        subscriptionId: <?php echo e($subscription->id); ?>,
                        tutorName: '<?php echo e(addslashes($freelancerName)); ?>',
                        avatarUrl: '<?php echo e($freelancer && $freelancer->image ? asset('assets/img/users/' . $freelancer->image) : ''); ?>',
                        credit: <?php echo e($subscription->hours_remaining ?? 0); ?>,
                        creditAmount: <?php echo e(($subscription->hours_remaining ?? 0) * ($subscription->client_hourly_rate_snapshot ?? $subscription->base_hourly_rate_snapshot ?? 0)); ?>

                      }); toggleMenu(<?php echo e($subscription->id); ?>);"
                    >
                      <span class="subscription-menu-icon"><i class="fas fa-share-alt"></i></span>
                      <span><?php echo e(__('Transférer le solde ou un abonnement')); ?></span>
                    </button>
                    
                    <div class="subscription-menu-separator"></div>
                    
                    <?php if($subscription->status === 'active'): ?>
                      <form method="POST" action="<?php echo e(route('user.settings.subscription.pause', $subscription->id)); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="subscription-menu-item">
                          <span class="subscription-menu-icon"><i class="fas fa-pause"></i></span>
                          <span><?php echo e(__('Mettre l\'abonnement en pause')); ?></span>
                        </button>
                      </form>
                    <?php elseif($subscription->status === 'paused'): ?>
                      <form method="POST" action="<?php echo e(route('user.settings.subscription.resume', $subscription->id)); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="subscription-menu-item">
                          <span class="subscription-menu-icon"><i class="fas fa-play"></i></span>
                          <span><?php echo e(__('Reprendre l\'abonnement')); ?></span>
                        </button>
                      </form>
                    <?php endif; ?>
                    
                    <div class="subscription-menu-separator"></div>
                    
                    <button 
                      type="button"
                      class="subscription-menu-item danger"
                      onclick="openSubscriptionCancelFlow({
                        subscriptionId: <?php echo e($subscription->id); ?>,
                        tutorName: '<?php echo e(addslashes($freelancerName)); ?>',
                        avatarUrl: '<?php echo e($freelancer && $freelancer->image ? asset('assets/img/users/' . $freelancer->image) : ''); ?>'
                      }); toggleMenu(<?php echo e($subscription->id); ?>);"
                    >
                        <span class="subscription-menu-icon"><i class="fas fa-times"></i></span>
                        <span><?php echo e(__('Annuler l\'abonnement')); ?></span>
                      </button>
                </div>
                </div>

                <!-- Contenu de la carte style Preply -->
                <div class="subscription-card-header">
                  <?php if($freelancer && $freelancer->image): ?>
                    <img src="<?php echo e(asset('assets/img/users/' . $freelancer->image)); ?>" 
                         alt="<?php echo e($freelancerName); ?>" 
                         class="subscription-avatar"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <div class="subscription-avatar-initials" style="display: none;">
                      <?php
                        $nameParts = explode(' ', $freelancerName);
                        $initials = count($nameParts) >= 2 
                          ? strtoupper(substr($nameParts[0], 0, 1) . substr($nameParts[count($nameParts) - 1], 0, 1))
                          : strtoupper(substr($freelancerName, 0, 2));
                      ?>
                      <?php echo e($initials); ?>

                </div>
                      <?php else: ?>
                    <div class="subscription-avatar-initials">
                      <?php
                        $nameParts = explode(' ', $freelancerName);
                        $initials = count($nameParts) >= 2 
                          ? strtoupper(substr($nameParts[0], 0, 1) . substr($nameParts[count($nameParts) - 1], 0, 1))
                          : strtoupper(substr($freelancerName, 0, 2));
                      ?>
                      <?php echo e($initials); ?>

                  </div>
                <?php endif; ?>

                  <div class="subscription-info">
                    <div class="subscription-name"><?php echo e($freelancerName); ?></div>
                    <?php
                      $freelancerProfile = $subscription->freelancer ?? null;
                      $serviceName = 'Service';
                      if ($freelancerProfile && isset($freelancerProfile->user)) {
                        $bio = $freelancerProfile->user->freelancerProfile->bio ?? null;
                        if ($bio) {
                          $serviceName = \Illuminate\Support\Str::limit($bio, 25);
                        } else {
                          $serviceName = 'Abonnement';
                        }
                      }
                      $priceBase = $subscription->price_base ?? 0;
                      $formattedPrice = number_format($priceBase, 2, ',', ' ');
                  ?>
                    <div class="subscription-service">
                      <?php echo e($serviceName); ?> | <?php echo e($subscription->hours_per_week); ?> <?php echo e(__('Rituels/semaine')); ?> (= <?php echo e($subscription->hours_per_week); ?>h) – <?php echo e($formattedPrice); ?> € <?php echo e(__('toutes les 4 semaines')); ?>

                    </div>
                    <?php if(!empty($ritualSignature)): ?>
                      <p class="subscription-ritual-signature" style="font-size: 0.75rem; color: #6b7280; margin: 0.25rem 0 0 0;"><?php echo e($ritualSignature); ?></p>
                    <?php endif; ?>
                    <div class="subscription-details-line">
                      <?php if($nextBillingDate): ?>
                        <?php
                          $months = ['janv.', 'févr.', 'mars', 'avr.', 'mai', 'juin', 'juil.', 'août', 'sept.', 'oct.', 'nov.', 'déc.'];
                          $monthIndex = (int)$nextBillingDate->format('n') - 1;
                          $formattedDate = $nextBillingDate->format('d') . ' ' . $months[$monthIndex] . ' ' . $nextBillingDate->format('Y');
                        ?>
                          Renouvellement le <?php echo e($formattedDate); ?> |
                      <?php endif; ?>
                      <?php echo e(number_format($hoursRemaining, 1)); ?> <?php echo e(__('Rituels restants')); ?> (= <?php echo e(number_format($hoursRemaining, 1)); ?>h)
                  </div>
                    
                    <div class="jp-usage-gauge-wrap" data-sub-id="<?php echo e($subscription->id); ?>">
                      <svg viewBox="0 0 100 100" class="jp-gauge-svg"
                           role="img" aria-label="<?php echo e(round($usageRatio * 100)); ?>% consommé">
                        
                        <circle cx="50" cy="50" r="<?php echo e($svgR); ?>"
                                class="jp-gauge-track"
                                stroke-dasharray="<?php echo e($svgCirc); ?>"
                                stroke-dashoffset="0"
                                transform="rotate(-90 50 50)"/>
                        
                        <circle cx="50" cy="50" r="<?php echo e($svgR); ?>"
                                class="jp-gauge-fill"
                                stroke="<?php echo e($gaugeColor); ?>"
                                stroke-dasharray="<?php echo e($svgCirc); ?>"
                                stroke-dashoffset="<?php echo e($svgOffset); ?>"
                                transform="rotate(-90 50 50)"/>
                        
                        <text x="50" y="46" class="jp-gauge-pct"><?php echo e(round($usageRatio * 100)); ?>%</text>
                        <text x="50" y="60" class="jp-gauge-sub">utilisé</text>
                      </svg>
                      <div class="jp-gauge-legend">
                        <span class="jp-gauge-legend-used" style="color:<?php echo e($gaugeColor); ?>">
                          <?php echo e(number_format($usedHours, 1)); ?> Rituels consommés
                        </span>
                        <span class="jp-gauge-legend-left">
                          <?php echo e(number_format($hoursRemaining, 1)); ?> restants / <?php echo e(number_format($hoursPerCycle, 0)); ?> ce cycle
                        </span>
                        <?php if($topupMax > 0): ?>
                          <span class="jp-gauge-legend-topup">
                            Top-up possible : +<?php echo e(number_format($topupMax, 0)); ?> Rituels max
                          </span>
                        <?php endif; ?>
                      </div>
                    </div>
                    

                    <?php if($nudge['show']): ?>
                      
                      <div class="jp-nudge-banner jp-nudge-<?php echo e($nudge['level']); ?>"
                           role="button" tabindex="0"
                           onclick="jpOpenNudgeSheet(<?php echo e($subscription->id); ?>, <?php echo e((int)($subscription->hours_per_week ?? 0)); ?>, '<?php echo e($universeType); ?>', <?php echo e($nextPalierCycle); ?>, '<?php echo e($nudge['level']); ?>', <?php echo e(json_encode($nudge['message'])); ?>)"
                           onkeydown="if(event.key==='Enter'||event.key===' ')this.click()"
                           aria-label="Voir les options de montée en palier">
                        <div class="jp-nudge-content">
                          <span class="jp-nudge-icon">
                            <?php if($nudge['level'] === 'strong85' || $nudge['level'] === 'repeat'): ?>🔴
                            <?php elseif($nudge['level'] === 'soft70'): ?>🟡
                            <?php else: ?>⚡
                            <?php endif; ?>
                          </span>
                          <span class="jp-nudge-text"><?php echo e($nudge['message']); ?></span>
                        </div>
                        <span class="jp-nudge-cta">Voir les options →</span>
                      </div>
                    <?php endif; ?>
                    <div style="display: flex; justify-content: center; margin-top: 0.75rem;">
                      <span class="subscription-status-badge <?php echo e($subscription->status === 'active' ? 'active' : ($subscription->status === 'paused' ? 'paused' : 'cancelled')); ?>">
                        <?php if($subscription->status === 'active'): ?>
                          <?php echo e(__('Actif')); ?>

                        <?php elseif($subscription->status === 'paused'): ?>
                          <?php echo e(__('En pause')); ?>

                        <?php else: ?>
                          <?php echo e(__('Abonnement annulé')); ?>

                <?php endif; ?>
                      </span>
              </div>
                  </div>
                  </div>

                <!-- Encadrement action selon la situation -->
                <div class="subscription-action-box">
                  <?php if($subscription->status === 'cancelled'): ?>
                    <a href="<?php echo e(route('client.subscriptions.show', $subscription->id)); ?>" class="subscription-action-box-button primary">
                      <?php echo e(__('S\'abonner')); ?>

                    </a>
                  <?php elseif($subscription->status === 'active' && $nextBillingDate && $daysUntilRenewal !== null): ?>
                    <?php
                      $daysRounded = round($daysUntilRenewal);
                    ?>
                    <?php if($daysRounded <= 7 && $daysRounded >= 0): ?>
                      <button type="button" class="subscription-action-box-button" data-renew-subscription="<?php echo e($subscription->id); ?>">
                        <?php echo e(__('Renouveler l\'abonnement')); ?>

                    </button>
                    <?php endif; ?>
                <?php elseif($subscription->status === 'paused'): ?>
                  <form method="POST" action="<?php echo e(route('user.settings.subscription.resume', $subscription->id)); ?>" style="display: inline;">
                    <?php echo csrf_field(); ?>
                      <button type="submit" class="subscription-action-box-button primary">
                        <?php echo e(__('Reprendre l\'abonnement')); ?>

                    </button>
                  </form>
                <?php endif; ?>
              </div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
          <div class="empty-state">
            <div class="empty-state-icon">
              <i class="far fa-calendar-check"></i>
            </div>
            <div class="empty-state-title"><?php echo e(__('Aucun abonnement actif')); ?></div>
            <div class="empty-state-text">
              <?php echo e(__("Vous n'avez pas encore d'abonnement actif. Découvrez nos freelances et trouvez celui qui correspond à vos projets.")); ?>

            </div>
            <a href="<?php echo e(route('explore') ?? '#'); ?>" class="subscription-action-button">
              <i class="fas fa-search"></i> <?php echo e(__('Découvrir les freelances')); ?>

            </a>
          </div>
        <?php endif; ?>

        <!-- Section Fonctionnement de l'abonnement -->
        <div class="subscription-faq-section">
          <h2 class="subscription-faq-title"><?php echo e(__('Fonctionnement de l\'abonnement')); ?></h2>
          <ul class="subscription-faq-list">
            <!-- Item 1: Rechargement du solde et facturation -->
            <li class="subscription-faq-item">
              <div class="subscription-faq-header" onclick="toggleFaqItem(this)">
                <span class="subscription-faq-question"><?php echo e(__('Rechargement du solde et facturation')); ?></span>
                <i class="fas fa-chevron-down subscription-faq-chevron"></i>
              </div>
              <div class="subscription-faq-content">
                <div class="subscription-faq-answer">
                  <p><strong><?php echo e(__('Facturation mensuelle')); ?></strong></p>
                  <p><?php echo e(__('Votre abonnement est facturé automatiquement toutes les 4 semaines. Le montant correspond à votre formule (Rituels par semaine × tarif × 4 semaines).')); ?></p>
                  <p><strong><?php echo e(__('Rituels restants')); ?></strong></p>
                  <p><?php echo e(__('Les Rituels non utilisés s\'accumulent dans votre solde. Vous pouvez les utiliser à tout moment, même après le renouvellement de votre abonnement.')); ?></p>
                  <p><strong><?php echo e(__('Ajout de Rituels supplémentaires')); ?></strong></p>
                  <p><?php echo e(__('Vous pouvez ajouter des Rituels supplémentaires à tout moment depuis la page de gestion de votre abonnement. Ils sont facturés au tarif Rituel de votre freelance.')); ?></p>
                </div>
              </div>
            </li>

            <!-- Item 2: Programmation des sessions -->
            <li class="subscription-faq-item">
              <div class="subscription-faq-header" onclick="toggleFaqItem(this)">
                <span class="subscription-faq-question"><?php echo e(__('Programmation des sessions')); ?></span>
                <i class="fas fa-chevron-down subscription-faq-chevron"></i>
              </div>
              <div class="subscription-faq-content">
                <div class="subscription-faq-answer">
                  <p><strong><?php echo e(__('Sessions de travail')); ?></strong></p>
                  <p><?php echo e(__('Chaque Rituel dure 50 minutes de travail effectif + 10 minutes de rapport détaillé. Un Rituel complet consomme 1 Rituel de votre abonnement.')); ?></p>
                  <p><strong><?php echo e(__('Planification')); ?></strong></p>
                  <p><?php echo e(__('Vous pouvez planifier vos sessions en fonction de la disponibilité de votre freelance. Les sessions peuvent être programmées à l\'avance selon le calendrier de votre freelance.')); ?></p>
                  <p><strong><?php echo e(__('Reprogrammation')); ?></strong></p>
                  <p><?php echo e(__('Vous pouvez reprogrammer une session une fois, sous réserve de disponibilité. La reprogrammation doit être effectuée au moins 24h avant la session prévue.')); ?></p>
                </div>
              </div>
            </li>

            <!-- Item 3: Annulation et remboursement -->
            <li class="subscription-faq-item">
              <div class="subscription-faq-header" onclick="toggleFaqItem(this)">
                <span class="subscription-faq-question"><?php echo e(__('Annulation et remboursement')); ?></span>
                <i class="fas fa-chevron-down subscription-faq-chevron"></i>
              </div>
              <div class="subscription-faq-content">
                <div class="subscription-faq-answer">
                  <p><strong><?php echo e(__('Annulation d\'abonnement')); ?></strong></p>
                  <p><?php echo e(__('Vous pouvez annuler votre abonnement à tout moment depuis cette page. L\'annulation prend effet à la fin de votre période de facturation en cours.')); ?></p>
                  <p><strong><?php echo e(__('Remboursement')); ?></strong></p>
                  <p><?php echo e(__('Les Rituels déjà payés et non utilisés peuvent être remboursés selon nos conditions générales. Les Rituels déjà consommés ne sont pas remboursables.')); ?></p>
                  <p><strong><?php echo e(__('Rituels restants après annulation')); ?></strong></p>
                  <p><?php echo e(__('Vos Rituels restants restent disponibles pendant 30 jours après l\'annulation. Passé ce délai, ils expirent.')); ?></p>
                </div>
              </div>
            </li>

            <!-- Item 4: Mettre en pause -->
            <li class="subscription-faq-item">
              <div class="subscription-faq-header" onclick="toggleFaqItem(this)">
                <span class="subscription-faq-question"><?php echo e(__('Mettre votre abonnement en pause')); ?></span>
                <i class="fas fa-chevron-down subscription-faq-chevron"></i>
              </div>
              <div class="subscription-faq-content">
                <div class="subscription-faq-answer">
                  <p><strong><?php echo e(__('Mise en pause')); ?></strong></p>
                  <p><?php echo e(__('Vous pouvez mettre votre abonnement en pause à tout moment. Pendant la pause, aucune nouvelle facturation n\'est effectuée et aucune nouvelle session ne peut être planifiée.')); ?></p>
                  <p><strong><?php echo e(__('Heures pendant la pause')); ?></strong></p>
                  <p><?php echo e(__('Vos Rituels restants sont conservés pendant la pause. Vous pouvez les utiliser dès la reprise de votre abonnement.')); ?></p>
                  <p><strong><?php echo e(__('Reprendre l\'abonnement')); ?></strong></p>
                  <p><?php echo e(__('Vous pouvez reprendre votre abonnement à tout moment. La facturation reprendra au prochain cycle de facturation.')); ?></p>
                </div>
              </div>
            </li>

            <!-- Item 5: Modifier la formule -->
            <li class="subscription-faq-item">
              <div class="subscription-faq-header" onclick="toggleFaqItem(this)">
                <span class="subscription-faq-question"><?php echo e(__('Diminuer ou augmenter le nombre d\'heures de l\'abonnement')); ?></span>
                <i class="fas fa-chevron-down subscription-faq-chevron"></i>
              </div>
              <div class="subscription-faq-content">
                <div class="subscription-faq-answer">
                  <p><strong><?php echo e(__('Changement de formule')); ?></strong></p>
                  <p><?php echo e(__('Vous pouvez modifier votre formule (Rituels par semaine) depuis la page de gestion de votre abonnement. Les formules disponibles sont : 1, 2, 4, 6, 8, 10, 12, 14, 16, 18, 20 ou 24 Rituels par semaine.')); ?></p>
                  <p><strong><?php echo e(__('Effet du changement')); ?></strong></p>
                  <p><?php echo e(__('Le changement de formule prend effet au prochain cycle de facturation. Votre facture sera ajustée en fonction de la nouvelle formule.')); ?></p>
                  <p><strong><?php echo e(__('Heures existantes')); ?></strong></p>
                  <p><?php echo e(__('Vos Rituels restants actuels sont conservés et s\'ajoutent aux nouveaux Rituels de votre nouvelle formule.')); ?></p>
                </div>
              </div>
            </li>

            <!-- Item 6: Transférer -->
            <li class="subscription-faq-item">
              <div class="subscription-faq-header" onclick="toggleFaqItem(this)">
                <span class="subscription-faq-question"><?php echo e(__('Transférer votre solde et votre abonnement à un nouveau freelance')); ?></span>
                <i class="fas fa-chevron-down subscription-faq-chevron"></i>
              </div>
              <div class="subscription-faq-content">
                <div class="subscription-faq-answer">
                  <p><strong><?php echo e(__('Transfert d\'abonnement')); ?></strong></p>
                  <p><?php echo e(__('Vous pouvez transférer votre solde d\'heures et votre abonnement vers un nouveau freelance si cette fonctionnalité est activée pour votre compte.')); ?></p>
                  <p><strong><?php echo e(__('Conditions')); ?></strong></p>
                  <p><?php echo e(__('Le transfert est possible uniquement si votre abonnement actuel le permet. Les Rituels restants sont transférés au nouveau freelance au tarif de ce dernier.')); ?></p>
                  <p><strong><?php echo e(__('Processus')); ?></strong></p>
                  <p><?php echo e(__('Contactez notre support pour initier un transfert. Le processus nécessite l\'accord des deux freelances concernés et peut prendre quelques jours.')); ?></p>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </main>
    </div>
  </div>

  <script>
    // Gestion du menu dropdown
    function toggleMenu(subscriptionId) {
      const menu = document.getElementById('menu-' + subscriptionId);
      const isOpen = menu.classList.contains('show');
      
      // Fermer tous les autres menus
      document.querySelectorAll('.subscription-menu-dropdown').forEach(m => {
        m.classList.remove('show');
      });
      
      // Ouvrir/fermer le menu cliqué
      if (!isOpen) {
        menu.classList.add('show');
      }
    }

    // Fermer le menu au clic dehors
    document.addEventListener('click', function(event) {
      if (!event.target.closest('.subscription-menu')) {
        document.querySelectorAll('.subscription-menu-dropdown').forEach(menu => {
          menu.classList.remove('show');
        });
      }
    });

    // Fermer le menu avec ESC
    document.addEventListener('keydown', function(event) {
      if (event.key === 'Escape') {
        document.querySelectorAll('.subscription-menu-dropdown').forEach(menu => {
          menu.classList.remove('show');
        });
      }
    });

    // Gestion des items FAQ expandables
    function toggleFaqItem(header) {
      const item = header.closest('.subscription-faq-item');
      const isActive = item.classList.contains('active');
      
      // Fermer tous les autres items
      document.querySelectorAll('.subscription-faq-item').forEach(faqItem => {
        faqItem.classList.remove('active');
      });
      
      // Ouvrir/fermer l'item cliqué
      if (!isActive) {
        item.classList.add('active');
      }
    }
  </script>

  
  <?php echo $__env->make('components.subscription-renew-modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  
  <script src="<?php echo e(asset('assets/js/subscription-renew-modal.js')); ?>"></script>

  
  <?php if (isset($component)) { $__componentOriginal776daedb7b269bef473f723a4de10415 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal776daedb7b269bef473f723a4de10415 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.subscription.topup-modal','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('subscription.topup-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal776daedb7b269bef473f723a4de10415)): ?>
<?php $attributes = $__attributesOriginal776daedb7b269bef473f723a4de10415; ?>
<?php unset($__attributesOriginal776daedb7b269bef473f723a4de10415); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal776daedb7b269bef473f723a4de10415)): ?>
<?php $component = $__componentOriginal776daedb7b269bef473f723a4de10415; ?>
<?php unset($__componentOriginal776daedb7b269bef473f723a4de10415); ?>
<?php endif; ?>

  
  <?php if (isset($component)) { $__componentOriginal6b13eb444594a1a36b459fb4f1c24cc8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6b13eb444594a1a36b459fb4f1c24cc8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.subscription.change-plan-root','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('subscription.change-plan-root'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6b13eb444594a1a36b459fb4f1c24cc8)): ?>
<?php $attributes = $__attributesOriginal6b13eb444594a1a36b459fb4f1c24cc8; ?>
<?php unset($__attributesOriginal6b13eb444594a1a36b459fb4f1c24cc8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6b13eb444594a1a36b459fb4f1c24cc8)): ?>
<?php $component = $__componentOriginal6b13eb444594a1a36b459fb4f1c24cc8; ?>
<?php unset($__componentOriginal6b13eb444594a1a36b459fb4f1c24cc8); ?>
<?php endif; ?>
  
  
  <?php if (isset($component)) { $__componentOriginale0dd94c3dbfb344b0fa31d64cabcafcf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale0dd94c3dbfb344b0fa31d64cabcafcf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.subscription.transfer.entry','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('subscription.transfer.entry'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale0dd94c3dbfb344b0fa31d64cabcafcf)): ?>
<?php $attributes = $__attributesOriginale0dd94c3dbfb344b0fa31d64cabcafcf; ?>
<?php unset($__attributesOriginale0dd94c3dbfb344b0fa31d64cabcafcf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale0dd94c3dbfb344b0fa31d64cabcafcf)): ?>
<?php $component = $__componentOriginale0dd94c3dbfb344b0fa31d64cabcafcf; ?>
<?php unset($__componentOriginale0dd94c3dbfb344b0fa31d64cabcafcf); ?>
<?php endif; ?>
  
  
  <?php if (isset($component)) { $__componentOriginale2cc258ddd95847580d79e67f567f2d6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale2cc258ddd95847580d79e67f567f2d6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.subscription.transfer.replace.step1-select-freelance','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('subscription.transfer.replace.step1-select-freelance'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale2cc258ddd95847580d79e67f567f2d6)): ?>
<?php $attributes = $__attributesOriginale2cc258ddd95847580d79e67f567f2d6; ?>
<?php unset($__attributesOriginale2cc258ddd95847580d79e67f567f2d6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale2cc258ddd95847580d79e67f567f2d6)): ?>
<?php $component = $__componentOriginale2cc258ddd95847580d79e67f567f2d6; ?>
<?php unset($__componentOriginale2cc258ddd95847580d79e67f567f2d6); ?>
<?php endif; ?>
  <?php if (isset($component)) { $__componentOriginal403ced390bf6de3ce6c4267bf9a0c210 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal403ced390bf6de3ce6c4267bf9a0c210 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.subscription.transfer.replace.step2-pick-plan','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('subscription.transfer.replace.step2-pick-plan'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal403ced390bf6de3ce6c4267bf9a0c210)): ?>
<?php $attributes = $__attributesOriginal403ced390bf6de3ce6c4267bf9a0c210; ?>
<?php unset($__attributesOriginal403ced390bf6de3ce6c4267bf9a0c210); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal403ced390bf6de3ce6c4267bf9a0c210)): ?>
<?php $component = $__componentOriginal403ced390bf6de3ce6c4267bf9a0c210; ?>
<?php unset($__componentOriginal403ced390bf6de3ce6c4267bf9a0c210); ?>
<?php endif; ?>
  <?php if (isset($component)) { $__componentOriginal084eabfe147c1d6e9a1b1c18866e9bab = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal084eabfe147c1d6e9a1b1c18866e9bab = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.subscription.transfer.replace.step3-confirm','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('subscription.transfer.replace.step3-confirm'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal084eabfe147c1d6e9a1b1c18866e9bab)): ?>
<?php $attributes = $__attributesOriginal084eabfe147c1d6e9a1b1c18866e9bab; ?>
<?php unset($__attributesOriginal084eabfe147c1d6e9a1b1c18866e9bab); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal084eabfe147c1d6e9a1b1c18866e9bab)): ?>
<?php $component = $__componentOriginal084eabfe147c1d6e9a1b1c18866e9bab; ?>
<?php unset($__componentOriginal084eabfe147c1d6e9a1b1c18866e9bab); ?>
<?php endif; ?>
  <?php if (isset($component)) { $__componentOriginal8ed5bb2aeb6cb2da514a42a652f59055 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8ed5bb2aeb6cb2da514a42a652f59055 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.subscription.transfer.replace.step4-payment','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('subscription.transfer.replace.step4-payment'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8ed5bb2aeb6cb2da514a42a652f59055)): ?>
<?php $attributes = $__attributesOriginal8ed5bb2aeb6cb2da514a42a652f59055; ?>
<?php unset($__attributesOriginal8ed5bb2aeb6cb2da514a42a652f59055); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8ed5bb2aeb6cb2da514a42a652f59055)): ?>
<?php $component = $__componentOriginal8ed5bb2aeb6cb2da514a42a652f59055; ?>
<?php unset($__componentOriginal8ed5bb2aeb6cb2da514a42a652f59055); ?>
<?php endif; ?>
  
  
  <?php if (isset($component)) { $__componentOriginal4d31095c86221e09156f439543e5bd1a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4d31095c86221e09156f439543e5bd1a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.subscription.transfer.add.step2-select-freelance','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('subscription.transfer.add.step2-select-freelance'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4d31095c86221e09156f439543e5bd1a)): ?>
<?php $attributes = $__attributesOriginal4d31095c86221e09156f439543e5bd1a; ?>
<?php unset($__attributesOriginal4d31095c86221e09156f439543e5bd1a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4d31095c86221e09156f439543e5bd1a)): ?>
<?php $component = $__componentOriginal4d31095c86221e09156f439543e5bd1a; ?>
<?php unset($__componentOriginal4d31095c86221e09156f439543e5bd1a); ?>
<?php endif; ?>
  <?php if (isset($component)) { $__componentOriginale3d4768d83e9d089c23fd44b0e3e8a4c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale3d4768d83e9d089c23fd44b0e3e8a4c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.subscription.transfer.add.step3-pick-qty','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('subscription.transfer.add.step3-pick-qty'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale3d4768d83e9d089c23fd44b0e3e8a4c)): ?>
<?php $attributes = $__attributesOriginale3d4768d83e9d089c23fd44b0e3e8a4c; ?>
<?php unset($__attributesOriginale3d4768d83e9d089c23fd44b0e3e8a4c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale3d4768d83e9d089c23fd44b0e3e8a4c)): ?>
<?php $component = $__componentOriginale3d4768d83e9d089c23fd44b0e3e8a4c; ?>
<?php unset($__componentOriginale3d4768d83e9d089c23fd44b0e3e8a4c); ?>
<?php endif; ?>
  <?php if (isset($component)) { $__componentOriginal6c9a9dd3bf40aad306c41fa934c24dbb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6c9a9dd3bf40aad306c41fa934c24dbb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.subscription.transfer.add.step4-pick-plan','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('subscription.transfer.add.step4-pick-plan'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6c9a9dd3bf40aad306c41fa934c24dbb)): ?>
<?php $attributes = $__attributesOriginal6c9a9dd3bf40aad306c41fa934c24dbb; ?>
<?php unset($__attributesOriginal6c9a9dd3bf40aad306c41fa934c24dbb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6c9a9dd3bf40aad306c41fa934c24dbb)): ?>
<?php $component = $__componentOriginal6c9a9dd3bf40aad306c41fa934c24dbb; ?>
<?php unset($__componentOriginal6c9a9dd3bf40aad306c41fa934c24dbb); ?>
<?php endif; ?>
  <?php if (isset($component)) { $__componentOriginal3d4e1210da2459149be9abd0134d7a36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3d4e1210da2459149be9abd0134d7a36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.subscription.transfer.add.step5-confirm','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('subscription.transfer.add.step5-confirm'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3d4e1210da2459149be9abd0134d7a36)): ?>
<?php $attributes = $__attributesOriginal3d4e1210da2459149be9abd0134d7a36; ?>
<?php unset($__attributesOriginal3d4e1210da2459149be9abd0134d7a36); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3d4e1210da2459149be9abd0134d7a36)): ?>
<?php $component = $__componentOriginal3d4e1210da2459149be9abd0134d7a36; ?>
<?php unset($__componentOriginal3d4e1210da2459149be9abd0134d7a36); ?>
<?php endif; ?>
  <?php if (isset($component)) { $__componentOriginaldb543001eed52214f9c0f02b3649f692 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldb543001eed52214f9c0f02b3649f692 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.subscription.transfer.add.step6-payment','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('subscription.transfer.add.step6-payment'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldb543001eed52214f9c0f02b3649f692)): ?>
<?php $attributes = $__attributesOriginaldb543001eed52214f9c0f02b3649f692; ?>
<?php unset($__attributesOriginaldb543001eed52214f9c0f02b3649f692); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldb543001eed52214f9c0f02b3649f692)): ?>
<?php $component = $__componentOriginaldb543001eed52214f9c0f02b3649f692; ?>
<?php unset($__componentOriginaldb543001eed52214f9c0f02b3649f692); ?>
<?php endif; ?>
  
  
  <?php if (isset($component)) { $__componentOriginal60bdb4bb153dee0196b9f77bcec1fc46 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal60bdb4bb153dee0196b9f77bcec1fc46 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.subscription.transfer.active.step2-select-freelance','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('subscription.transfer.active.step2-select-freelance'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal60bdb4bb153dee0196b9f77bcec1fc46)): ?>
<?php $attributes = $__attributesOriginal60bdb4bb153dee0196b9f77bcec1fc46; ?>
<?php unset($__attributesOriginal60bdb4bb153dee0196b9f77bcec1fc46); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal60bdb4bb153dee0196b9f77bcec1fc46)): ?>
<?php $component = $__componentOriginal60bdb4bb153dee0196b9f77bcec1fc46; ?>
<?php unset($__componentOriginal60bdb4bb153dee0196b9f77bcec1fc46); ?>
<?php endif; ?>
  <?php if (isset($component)) { $__componentOriginald434e7031c59888bb2cc5d9e4c2ee8bf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald434e7031c59888bb2cc5d9e4c2ee8bf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.subscription.transfer.active.step3-pick-qty','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('subscription.transfer.active.step3-pick-qty'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald434e7031c59888bb2cc5d9e4c2ee8bf)): ?>
<?php $attributes = $__attributesOriginald434e7031c59888bb2cc5d9e4c2ee8bf; ?>
<?php unset($__attributesOriginald434e7031c59888bb2cc5d9e4c2ee8bf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald434e7031c59888bb2cc5d9e4c2ee8bf)): ?>
<?php $component = $__componentOriginald434e7031c59888bb2cc5d9e4c2ee8bf; ?>
<?php unset($__componentOriginald434e7031c59888bb2cc5d9e4c2ee8bf); ?>
<?php endif; ?>
  <?php if (isset($component)) { $__componentOriginaldb7b27e9aee1a7290ddb410183a5a55d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldb7b27e9aee1a7290ddb410183a5a55d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.subscription.transfer.active.step4-confirm','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('subscription.transfer.active.step4-confirm'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldb7b27e9aee1a7290ddb410183a5a55d)): ?>
<?php $attributes = $__attributesOriginaldb7b27e9aee1a7290ddb410183a5a55d; ?>
<?php unset($__attributesOriginaldb7b27e9aee1a7290ddb410183a5a55d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldb7b27e9aee1a7290ddb410183a5a55d)): ?>
<?php $component = $__componentOriginaldb7b27e9aee1a7290ddb410183a5a55d; ?>
<?php unset($__componentOriginaldb7b27e9aee1a7290ddb410183a5a55d); ?>
<?php endif; ?>
  <?php if (isset($component)) { $__componentOriginal7e78b7aee119941458c7244c7099802c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7e78b7aee119941458c7244c7099802c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.subscription.transfer.active.step5-success','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('subscription.transfer.active.step5-success'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7e78b7aee119941458c7244c7099802c)): ?>
<?php $attributes = $__attributesOriginal7e78b7aee119941458c7244c7099802c; ?>
<?php unset($__attributesOriginal7e78b7aee119941458c7244c7099802c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7e78b7aee119941458c7244c7099802c)): ?>
<?php $component = $__componentOriginal7e78b7aee119941458c7244c7099802c; ?>
<?php unset($__componentOriginal7e78b7aee119941458c7244c7099802c); ?>
<?php endif; ?>
  
  
  <?php if (isset($component)) { $__componentOriginal8e43b4080f7d9752f0a058aa6884cf78 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8e43b4080f7d9752f0a058aa6884cf78 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.subscription.cancel.step1-prevention','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('subscription.cancel.step1-prevention'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8e43b4080f7d9752f0a058aa6884cf78)): ?>
<?php $attributes = $__attributesOriginal8e43b4080f7d9752f0a058aa6884cf78; ?>
<?php unset($__attributesOriginal8e43b4080f7d9752f0a058aa6884cf78); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e43b4080f7d9752f0a058aa6884cf78)): ?>
<?php $component = $__componentOriginal8e43b4080f7d9752f0a058aa6884cf78; ?>
<?php unset($__componentOriginal8e43b4080f7d9752f0a058aa6884cf78); ?>
<?php endif; ?>
  <?php if (isset($component)) { $__componentOriginalf6b073fdebcff5c031030b21a6ae87da = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf6b073fdebcff5c031030b21a6ae87da = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.subscription.cancel.step2-reason','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('subscription.cancel.step2-reason'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf6b073fdebcff5c031030b21a6ae87da)): ?>
<?php $attributes = $__attributesOriginalf6b073fdebcff5c031030b21a6ae87da; ?>
<?php unset($__attributesOriginalf6b073fdebcff5c031030b21a6ae87da); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf6b073fdebcff5c031030b21a6ae87da)): ?>
<?php $component = $__componentOriginalf6b073fdebcff5c031030b21a6ae87da; ?>
<?php unset($__componentOriginalf6b073fdebcff5c031030b21a6ae87da); ?>
<?php endif; ?>
  <?php if (isset($component)) { $__componentOriginal0ab08951f7b933625c90468284bda988 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0ab08951f7b933625c90468284bda988 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.subscription.cancel.step3-confirm','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('subscription.cancel.step3-confirm'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0ab08951f7b933625c90468284bda988)): ?>
<?php $attributes = $__attributesOriginal0ab08951f7b933625c90468284bda988; ?>
<?php unset($__attributesOriginal0ab08951f7b933625c90468284bda988); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0ab08951f7b933625c90468284bda988)): ?>
<?php $component = $__componentOriginal0ab08951f7b933625c90468284bda988; ?>
<?php unset($__componentOriginal0ab08951f7b933625c90468284bda988); ?>
<?php endif; ?>
  <?php if (isset($component)) { $__componentOriginale4df46bbdf47bcc10135d2d9d157df56 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale4df46bbdf47bcc10135d2d9d157df56 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.subscription.cancel.step4-alternative','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('subscription.cancel.step4-alternative'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale4df46bbdf47bcc10135d2d9d157df56)): ?>
<?php $attributes = $__attributesOriginale4df46bbdf47bcc10135d2d9d157df56; ?>
<?php unset($__attributesOriginale4df46bbdf47bcc10135d2d9d157df56); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale4df46bbdf47bcc10135d2d9d157df56)): ?>
<?php $component = $__componentOriginale4df46bbdf47bcc10135d2d9d157df56; ?>
<?php unset($__componentOriginale4df46bbdf47bcc10135d2d9d157df56); ?>
<?php endif; ?>

  
  <div id="jp-nudge-backdrop" class="jp-nudge-backdrop"
       role="dialog" aria-modal="true" aria-labelledby="jp-sheet-title"
       onclick="jpCloseNudgeSheet()">
    <div id="jp-nudge-sheet" class="jp-nudge-sheet" onclick="event.stopPropagation()">
      <div class="jp-sheet-handle-bar"></div>
      <div class="jp-sheet-inner">
        <button class="jp-sheet-close-btn" onclick="jpCloseNudgeSheet()" aria-label="Fermer">✕</button>
        <p class="jp-sheet-eyebrow">Optimisez votre rythme</p>
        <h3 class="jp-sheet-title" id="jp-sheet-title">Passez au palier supérieur</h3>
        <div class="jp-sheet-compare">
          <div class="jp-sheet-plan jp-sheet-plan-current">
            <p class="jp-sheet-plan-label">Formule actuelle</p>
            <p class="jp-sheet-plan-hours" id="jp-sheet-current-hrs">–</p>
            <p class="jp-sheet-plan-sub">Rituels/semaine</p>
          </div>
          <div class="jp-sheet-arrow">→</div>
          <div class="jp-sheet-plan jp-sheet-plan-next">
            <p class="jp-sheet-plan-label">Formule suivante</p>
            <p class="jp-sheet-plan-hours" id="jp-sheet-next-hrs">–</p>
            <p class="jp-sheet-plan-sub">Rituels/semaine</p>
          </div>
        </div>
        <p class="jp-sheet-reason" id="jp-sheet-reason"></p>
        <a id="jp-sheet-upgrade-btn" href="/pricing" class="jp-sheet-upgrade-btn">
          Voir la formule suivante
        </a>
        <button class="jp-sheet-dismiss-btn" onclick="jpCloseNudgeSheet()">Plus tard</button>
      </div>
    </div>
  </div>
  

  
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <script src="<?php echo e(asset('assets/js/subscriptions/topupModal.js')); ?>?v=<?php echo e(filemtime(public_path('assets/js/subscriptions/topupModal.js'))); ?>"></script>
  <script src="<?php echo e(asset('assets/js/subscriptions/changePlanFlow.js')); ?>?v=<?php echo e(filemtime(public_path('assets/js/subscriptions/changePlanFlow.js'))); ?>"></script>
  
  <script>
    // Fonction pour ouvrir la modal de transfert (nouvelle structure)
    function openTransferEntryModal(payload) {
      // Déclencher l'événement pour ouvrir la modal
      window.dispatchEvent(new CustomEvent('openTransferEntryModal', {
        detail: payload
      }));
    }
 
    // ── Nudge bottom-sheet ──────────────────────────────────────────
    function jpOpenNudgeSheet(subId, currentWeekly, universeType, nextPalierCycle, nudgeLevel, nudgeMsg) {
      var nextWeekly = Math.round(nextPalierCycle / 4);
      var atMax      = (nextWeekly === currentWeekly);
      document.getElementById('jp-sheet-current-hrs').textContent = currentWeekly;
      document.getElementById('jp-sheet-next-hrs').textContent    = atMax ? currentWeekly : nextWeekly;
      document.getElementById('jp-sheet-reason').textContent      = nudgeMsg || '';
      var btn = document.getElementById('jp-sheet-upgrade-btn');
      if (atMax) {
        btn.textContent           = 'Vous êtes à la formule maximum';
        btn.style.pointerEvents   = 'none';
        btn.style.background      = '#9ca3af';
        btn.removeAttribute('href');
      } else {
        btn.textContent           = 'Voir la formule ' + nextWeekly + ' Rituels/semaine';
        btn.style.pointerEvents   = '';
        btn.style.background      = '';
        btn.href = '/pricing?suggest=' + nextWeekly + '&from_subscription=' + subId;
      }
      document.getElementById('jp-nudge-backdrop').classList.add('active');
      document.body.style.overflow = 'hidden';
    }
    function jpCloseNudgeSheet() {
      document.getElementById('jp-nudge-backdrop').classList.remove('active');
      document.body.style.overflow = '';
    }
    // Fermeture au clavier (Echap)
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') jpCloseNudgeSheet();
    });
    // ── fin nudge bottom-sheet ──────────────────────────────────────

    // Fonction pour ouvrir le flow d'annulation
    function openSubscriptionCancelFlow(payload) {
      window.dispatchEvent(new CustomEvent('openSubscriptionCancelStep1', {
        detail: {
        subscriptionId: payload.subscriptionId,
          tutorName: payload.tutorName,
          tutorAvatar: payload.avatarUrl
        }
      }));
    }
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\client\settings\subscription.blade.php ENDPATH**/ ?>