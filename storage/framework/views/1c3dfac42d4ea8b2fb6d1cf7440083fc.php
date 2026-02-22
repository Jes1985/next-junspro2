<style>
  /* ===== MENU CONTEXTUEL SECTION PROCHAINEMENT (CLIENT) ===== */
  .client-upcoming-item-actions-wrapper {
    position: relative;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }

  /* Bouton kebab "..." (style Preply exact) */
  .client-upcoming-item-kebab-btn {
    background: none;
    border: none;
    color: #9ca3af;
    cursor: pointer;
    padding: 0.5rem;
    border-radius: 50%;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    line-height: 1;
    width: 32px;
    height: 32px;
  }

  .client-upcoming-item-kebab-btn:hover {
    background: #f3f4f6;
    color: #1f2937;
  }

  .client-upcoming-item-kebab-btn:focus-visible {
    outline: 2px solid #7C3AED;
    outline-offset: 2px;
  }

  .client-upcoming-item-kebab-btn[aria-expanded="true"] {
    background: #f3f4f6;
    color: #1f2937;
  }

  .client-upcoming-item-kebab-btn svg {
    width: 20px;
    height: 20px;
  }

  /* Menu dropdown (style Preply exact) */
  .client-upcoming-item-actions-menu {
    position: absolute;
    top: calc(100% + 8px);
    right: 0;
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12), 0 2px 4px rgba(0, 0, 0, 0.08);
    min-width: 200px;
    opacity: 0;
    visibility: hidden;
    transform: scale(0.95) translateY(-4px);
    transform-origin: top right;
    transition: all 0.15s ease;
    z-index: 1000;
    overflow: hidden;
    border: 1px solid #e5e7eb;
  }

  .client-upcoming-item-actions-menu.active {
    opacity: 1;
    visibility: visible;
    transform: scale(1) translateY(0);
  }

  .client-upcoming-item-actions-menu-inner {
    padding: 0.5rem 0;
  }

  /* Actions du menu */
  .client-upcoming-item-action {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    width: 100%;
    padding: 0.75rem 1rem;
    background: none;
    border: none;
    text-align: left;
    color: #1f2937;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.15s ease;
    text-decoration: none;
    font-weight: 400;
  }

  .client-upcoming-item-action:hover {
    background: #f9fafb;
  }

  .client-upcoming-item-action:focus-visible {
    outline: 2px solid #7C3AED;
    outline-offset: -2px;
  }

  .client-upcoming-item-action svg {
    width: 18px;
    height: 18px;
    color: #6b7280;
    flex-shrink: 0;
  }

  .client-upcoming-item-action:hover svg {
    color: #7C3AED;
  }

  .client-upcoming-item-action span {
    flex: 1;
  }

  /* Action danger (Annuler) */
  .client-upcoming-item-action-danger {
    color: #dc2626;
  }

  .client-upcoming-item-action-danger:hover {
    background: #fef2f2;
    color: #dc2626;
  }

  .client-upcoming-item-action-danger svg {
    color: #dc2626;
  }

  .client-upcoming-item-action-danger:hover svg {
    color: #dc2626;
  }

  /* Séparateur */
  .client-upcoming-item-action-separator {
    height: 1px;
    background: #e5e7eb;
    margin: 0.25rem 0;
  }

  /* Overlay */
  .client-upcoming-item-actions-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: transparent;
    z-index: 999;
    opacity: 0;
    visibility: hidden;
    transition: all 0.15s ease;
  }

  .client-upcoming-item-actions-overlay.active {
    opacity: 1;
    visibility: visible;
  }

  /* Position gauche si nécessaire (anti-overflow) */
  .client-upcoming-item-actions-menu.position-left {
    right: auto;
    left: 0;
    transform-origin: top left;
  }

  .client-upcoming-item-actions-menu.position-left.active {
    transform: scale(1) translateY(0);
  }

  /* Responsive mobile */
  @media (max-width: 768px) {
    .client-upcoming-item-actions-menu {
      min-width: 200px;
      right: 0;
      left: auto;
    }

    .client-upcoming-item-actions-menu.position-left {
      left: 0;
      right: auto;
    }

    .client-upcoming-item-action {
      padding: 0.875rem 1.25rem;
      font-size: 1rem;
    }
  }

  /* Toast pour "Lien copié" */
  .client-upcoming-actions-toast {
    position: fixed;
    bottom: 2rem;
    right: 2rem;
    background: #1f2937;
    color: white;
    padding: 1rem 1.5rem;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    z-index: 10000;
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.3s ease;
    font-size: 0.95rem;
    font-weight: 500;
  }

  .client-upcoming-actions-toast.show {
    opacity: 1;
    transform: translateY(0);
  }

  @media (max-width: 768px) {
    .client-upcoming-actions-toast {
      bottom: 1rem;
      right: 1rem;
      left: 1rem;
      text-align: center;
    }
  }
</style>

<?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\components\client-upcoming-actions-menu-styles.blade.php ENDPATH**/ ?>