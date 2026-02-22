<?php $__env->startSection('style'); ?>
  <link rel="stylesheet" href="<?php echo e(asset('assets/css/summernote-content.css')); ?>">
  <style>
    :root {
      --junspro-purple: #7C3AED;
      --junspro-blue: #1e40af;
      --junspro-gradient: linear-gradient(135deg, #1e40af 0%, #4c1d95 50%, #7c3aed 100%);
    }

    /* Page onboarding freelance */
    .onboarding-page {
      min-height: 100vh;
      background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
      padding: 2rem 0 4rem;
    }

    .onboarding-container {
      max-width: 1100px;
      margin: 0 auto;
      padding: 0 1.5rem;
    }

    /* Barre de progression */
    .onboarding-progress {
      background: white;
      border-radius: 16px;
      padding: 2rem;
      margin-bottom: 2rem;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .progress-steps {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 0.5rem;
      flex-wrap: wrap;
    }

    .progress-step {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      flex: 1;
      min-width: 0;
    }

    .progress-step-number {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 600;
      font-size: 0.875rem;
      flex-shrink: 0;
      transition: all 0.3s ease;
    }

    .progress-step.completed .progress-step-number {
      background: var(--junspro-gradient);
      color: white;
    }

    .progress-step.active .progress-step-number {
      background: var(--junspro-gradient);
      color: white;
      box-shadow: 0 0 0 4px rgba(124, 58, 237, 0.1);
    }

    .progress-step.pending .progress-step-number {
      background: #e5e7eb;
      color: #6b7280;
    }

    .progress-step-label {
      font-size: 0.875rem;
      font-weight: 500;
      color: #374151;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .progress-step.completed .progress-step-label {
      color: var(--junspro-purple);
    }

    .progress-step.active .progress-step-label {
      color: var(--junspro-purple);
      font-weight: 600;
    }

    .progress-chevron {
      color: #d1d5db;
      font-size: 1.25rem;
      flex-shrink: 0;
      margin: 0 0.5rem;
    }

    /* Contenu principal */
    .onboarding-content {
      background: white;
      border-radius: 24px;
      padding: 3rem;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }

    .onboarding-header {
      margin-bottom: 2.5rem;
    }

    .onboarding-title {
      font-size: 2.25rem;
      font-weight: 800;
      color: #1a202c;
      margin-bottom: 1.5rem;
      letter-spacing: -0.02em;
      background: linear-gradient(135deg, #1a202c 0%, #4c1d95 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .onboarding-description {
      font-size: 1rem;
      color: #6b7280;
      line-height: 1.6;
    }

    /* Formulaire */
    .onboarding-form {
      display: flex;
      flex-direction: column;
      gap: 2rem;
    }

    .form-group {
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
    }

    .form-label {
      font-size: 0.95rem;
      font-weight: 600;
      color: #374151;
    }

    .form-input,
    .form-select {
      padding: 0.875rem 1rem;
      border: 2px solid #e5e7eb;
      border-radius: 12px;
      font-size: 1rem;
      transition: all 0.2s ease;
      background: white;
    }

    .form-input:focus,
    .form-select:focus {
      outline: none;
      border-color: var(--junspro-purple);
      box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.1);
    }

    .form-error {
      color: #ef4444;
      font-size: 0.875rem;
      margin-top: 0.25rem;
    }

    /* Identité premium (recto/verso) */
    .identity-grid {
      display: grid;
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: 1rem;
    }

    .identity-card {
      border: 1px solid #e5e7eb;
      border-radius: 14px;
      background: #f8fafc;
      padding: 1rem;
      transition: all 0.2s ease;
    }

    .identity-card:hover {
      border-color: rgba(124, 58, 237, 0.35);
      box-shadow: 0 8px 24px rgba(15, 23, 42, 0.06);
    }

    .identity-title {
      font-size: 0.9rem;
      font-weight: 700;
      color: #111827;
      margin-bottom: 0.25rem;
    }

    .identity-subtitle {
      font-size: 0.8rem;
      color: #6b7280;
      margin-bottom: 0.75rem;
    }

    .identity-input {
      width: 100%;
      padding: 0.7rem;
      border: 2px dashed #818cf8;
      border-radius: 10px;
      background: #fff;
      cursor: pointer;
    }

    .identity-preview {
      margin-top: 0.75rem;
      display: none;
    }

    .identity-preview.show {
      display: block;
    }

    .identity-preview-inner {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      padding: 0.75rem;
      background: #eef2ff;
      border: 1px solid #c7d2fe;
      border-radius: 10px;
    }

    /* Langues premium (Step 1) */
    .onboarding-languages-premium {
      border: 1px solid #e5e7eb;
      border-radius: 14px;
      background: #f8fafc;
      padding: 1rem;
    }

    .onboarding-language-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 0.75rem;
    }

    .onboarding-language-card {
      background: #fff;
      border: 1px solid #e5e7eb;
      border-radius: 12px;
      padding: 0.75rem;
      min-width: 0;
    }

    .onboarding-language-card-title {
      font-size: 0.9rem;
      font-weight: 700;
      color: #111827;
      margin-bottom: 0.5rem;
    }

    .onboarding-language-helper {
      margin-top: 0.35rem;
      font-size: 0.78rem;
      color: #6b7280;
    }

    .onboarding-language-chips {
      margin-top: 0.6rem;
      display: flex;
      flex-wrap: wrap;
      gap: 0.5rem;
      min-height: 36px;
    }

    .onboarding-language-empty {
      font-size: 0.82rem;
      color: #6b7280;
      padding: 0.5rem 0;
    }

    .onboarding-language-chip {
      display: inline-flex;
      align-items: center;
      gap: 0.45rem;
      background: #eef2ff;
      border: 1px solid #c7d2fe;
      border-radius: 999px;
      padding: 0.35rem 0.55rem;
      color: #312e81;
      font-size: 0.78rem;
      line-height: 1;
      font-weight: 600;
    }

    .onboarding-language-chip button {
      border: none;
      background: transparent;
      color: #4338ca;
      cursor: pointer;
      font-size: 0.85rem;
      line-height: 1;
      padding: 0;
      font-weight: 700;
    }

    .onboarding-add-language-btn {
      margin-top: 0.5rem;
      width: 100%;
      border: 1px dashed #a5b4fc;
      background: #fff;
      color: #4338ca;
      border-radius: 10px;
      font-size: 0.86rem;
      font-weight: 600;
      padding: 0.55rem 0.7rem;
      cursor: pointer;
      transition: all 0.2s ease;
    }

    .onboarding-add-language-btn:hover {
      border-color: #6366f1;
      background: #eef2ff;
    }

    .onboarding-add-language-btn:disabled {
      opacity: 0.55;
      cursor: not-allowed;
    }

    .onboarding-language-popover {
      margin-top: 0.65rem;
      border: 1px solid #e5e7eb;
      border-radius: 12px;
      background: #fff;
      box-shadow: 0 12px 28px rgba(15, 23, 42, 0.12);
      overflow: hidden;
      display: none;
    }

    .onboarding-language-popover.is-open {
      display: block;
    }

    .onboarding-language-table {
      max-height: 280px;
      overflow: auto;
    }

    .onboarding-language-table-head,
    .onboarding-language-table-row {
      display: grid;
      grid-template-columns: minmax(120px, 1fr) minmax(240px, 2fr);
      align-items: center;
      gap: 0.5rem;
      padding: 0.6rem 0.75rem;
    }

    .onboarding-language-table-head {
      background: #f9fafb;
      border-bottom: 1px solid #e5e7eb;
      font-size: 0.74rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.02em;
      color: #6b7280;
      position: sticky;
      top: 0;
      z-index: 1;
    }

    .onboarding-language-table-row + .onboarding-language-table-row {
      border-top: 1px solid #f3f4f6;
    }

    .onboarding-language-name {
      font-size: 0.86rem;
      font-weight: 600;
      color: #111827;
    }

    .onboarding-cecrl-pills {
      display: flex;
      flex-wrap: wrap;
      gap: 0.35rem;
      justify-content: flex-start;
    }

    .onboarding-cecrl-pill {
      border: 1px solid #d1d5db;
      border-radius: 999px;
      background: #fff;
      color: #374151;
      font-size: 0.73rem;
      font-weight: 700;
      padding: 0.2rem 0.55rem;
      cursor: pointer;
      transition: all 0.2s ease;
    }

    .onboarding-cecrl-pill:hover {
      border-color: #6366f1;
      color: #4338ca;
    }

    .onboarding-cecrl-pill.is-active {
      background: #4338ca;
      color: #fff;
      border-color: #4338ca;
    }

    /* Scope miroir premium (services) */
    .onboarding-scope-premium {
      border: 1px solid #e5e7eb;
      border-radius: 14px;
      background: #f8fafc;
      padding: 1rem;
    }

    .onboarding-scope-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 0.75rem;
    }

    .onboarding-scope-col {
      min-width: 0;
    }

    .onboarding-scope-label {
      display: block;
      margin-bottom: 0.45rem;
      font-size: 0.86rem;
      font-weight: 700;
      color: #111827;
    }

    .onboarding-scope-trigger {
      width: 100%;
      height: 46px;
      border: 1px solid #dbe0f0;
      background: #fff;
      border-radius: 11px;
      padding: 0 0.8rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
      color: #374151;
      font-size: 0.9rem;
      cursor: pointer;
    }

    .onboarding-scope-trigger:disabled {
      background: #f3f4f6;
      color: #9ca3af;
      cursor: not-allowed;
    }

    .onboarding-scope-menu {
      display: none;
      margin-top: 0.35rem;
      background: #fff;
      border: 1px solid #e5e7eb;
      border-radius: 11px;
      box-shadow: 0 12px 28px rgba(15, 23, 42, 0.12);
      max-height: 260px;
      overflow: auto;
      z-index: 8;
      position: relative;
    }

    .onboarding-scope-menu.is-open {
      display: block;
    }

    .onboarding-scope-option {
      display: flex;
      align-items: center;
      gap: 0.55rem;
      padding: 0.55rem 0.7rem;
      border-bottom: 1px solid #f3f4f6;
      font-size: 0.86rem;
      color: #111827;
      cursor: pointer;
    }

    .onboarding-scope-option:last-child {
      border-bottom: none;
    }

    .onboarding-scope-option small {
      color: #6b7280;
      font-size: 0.74rem;
      display: block;
      margin-left: 1.4rem;
    }

    .onboarding-scope-chips {
      display: flex;
      flex-wrap: wrap;
      gap: 0.45rem;
      margin-top: 0.5rem;
      min-height: 30px;
    }

    .onboarding-scope-chip {
      display: inline-flex;
      align-items: center;
      gap: 0.35rem;
      background: #eef2ff;
      border: 1px solid #c7d2fe;
      color: #312e81;
      border-radius: 999px;
      padding: 0.2rem 0.55rem;
      font-size: 0.76rem;
      font-weight: 600;
    }

    .onboarding-scope-chip button {
      border: none;
      background: transparent;
      color: #4338ca;
      font-size: 0.85rem;
      font-weight: 700;
      line-height: 1;
      cursor: pointer;
      padding: 0;
    }

    .onboarding-scope-helper {
      margin-top: 0.4rem;
      color: #6b7280;
      font-size: 0.76rem;
    }
    .onboarding-specialization-feedback {
      margin-top: 0.45rem;
      font-size: 0.76rem;
      color: #2563eb;
      background: #eff6ff;
      border: 1px solid #bfdbfe;
      border-radius: 8px;
      padding: 0.35rem 0.5rem;
    }
    .onboarding-specialization-search {
      padding: 0.5rem 0.65rem;
      border-bottom: 1px solid #f3f4f6;
      position: sticky;
      top: 0;
      background: #fff;
      z-index: 1;
    }
    .onboarding-specialization-search input {
      width: 100%;
      border: 1px solid #d1d5db;
      border-radius: 8px;
      padding: 0.45rem 0.55rem;
      font-size: 0.82rem;
    }
    .onboarding-specialization-group {
      border-bottom: 1px solid #f3f4f6;
      padding: 0.4rem 0;
    }
    .onboarding-specialization-group:last-child { border-bottom: none; }
    .onboarding-specialization-group-title {
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 0.8rem;
      font-weight: 700;
      color: #374151;
      padding: 0 0.7rem 0.25rem;
    }

    .onboarding-mode-segment {
      display: inline-flex;
      background: #eef2ff;
      border: 1px solid #c7d2fe;
      border-radius: 12px;
      padding: 3px;
      gap: 4px;
    }

    .onboarding-mode-btn {
      border: none;
      background: transparent;
      color: #4338ca;
      border-radius: 9px;
      font-size: 0.82rem;
      font-weight: 700;
      padding: 0.45rem 0.75rem;
      cursor: pointer;
      transition: all 0.2s ease;
    }

    .onboarding-mode-btn.is-active {
      background: linear-gradient(90deg, #7C3AED 0%, #2563EB 100%);
      color: #fff;
      box-shadow: 0 4px 14px rgba(124, 58, 237, 0.24);
    }

    .onboarding-scope-preview {
      margin-top: 0.9rem;
      background: #fff;
      border: 1px solid #e5e7eb;
      border-radius: 10px;
      padding: 0.6rem 0.75rem;
      color: #374151;
      font-size: 0.82rem;
      line-height: 1.45;
    }

    /* Miroir filtres services (scope onboarding uniquement) */
    .onboarding-mirror-filters .filters-level {
      border: 1px solid #e5e7eb;
      border-radius: 12px;
      background: #fff;
      padding: .7rem;
      margin-bottom: .6rem;
    }
    .onboarding-mirror-filters .filters-level-title {
      margin: 0 0 .55rem 0;
      font-size: 1.05rem;
      font-weight: 800;
      color: #111827;
    }
    .onboarding-mirror-filters .filters-level-inner {
      display: flex;
      flex-wrap: wrap;
      gap: .6rem;
      align-items: flex-start;
    }
    .onboarding-mirror-filters .preply-filter-group,
    .onboarding-mirror-filters .preply-filter-advanced {
      min-width: 210px;
      flex: 1 1 240px;
    }
    .onboarding-mirror-filters .preply-filter-label {
      display: block;
      font-size: .84rem;
      color: #6b7280;
      margin-bottom: .25rem;
      font-weight: 600;
    }
    .onboarding-mirror-filters .preply-filter-label-icon { color: #374151; font-weight: 700; }
    .onboarding-mirror-filters .preply-filter-select,
    .onboarding-mirror-filters .preply-filter-input,
    .onboarding-mirror-filters .domain-dropdown-trigger,
    .onboarding-mirror-filters .experience-dropdown-trigger,
    .onboarding-mirror-filters .sector-dropdown-trigger,
    .onboarding-mirror-filters .preply-availability-trigger {
      width: 100%;
      border: 1px solid #d1d5db;
      border-radius: 10px;
      background: #fff;
      padding: .6rem .7rem;
      font-size: .9rem;
      color: #111827;
      cursor: pointer;
    }
    .onboarding-mirror-filters .domain-dropdown-wrapper,
    .onboarding-mirror-filters .experience-dropdown-wrapper,
    .onboarding-mirror-filters .sector-dropdown-wrapper { position: relative; }
    .onboarding-mirror-filters .domain-dropdown-menu,
    .onboarding-mirror-filters .experience-dropdown-menu,
    .onboarding-mirror-filters .sector-dropdown-menu {
      position: absolute;
      z-index: 80;
      left: 0;
      right: 0;
      margin-top: .35rem;
      border: 1px solid #e5e7eb;
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 12px 30px rgba(2, 6, 23, .12);
      max-height: 260px;
      overflow: auto;
      display: none;
    }
    .onboarding-mirror-filters .domain-option,
    .onboarding-mirror-filters .experience-option,
    .onboarding-mirror-filters .sector-reset-option {
      padding: .55rem .7rem;
      cursor: pointer;
      border-bottom: 1px solid #f3f4f6;
    }
    .onboarding-mirror-filters .domain-option:hover,
    .onboarding-mirror-filters .experience-option:hover { background: #f9fafb; }
    .onboarding-mirror-filters .domain-option.selected,
    .onboarding-mirror-filters .experience-option.selected {
      background: #eef2ff;
      color: #4338ca;
      font-weight: 700;
    }
    .onboarding-mirror-filters .domain-option-desc {
      display: block;
      font-size: .76rem;
      color: #6b7280;
      margin-top: .2rem;
      line-height: 1.35;
    }
    .onboarding-mirror-filters .domain-premium-desc {
      margin-top: .4rem;
      font-size: .8rem;
      color: #4b5563;
      background: #f8fafc;
      border: 1px solid #e5e7eb;
      border-radius: 8px;
      padding: .45rem .55rem;
    }
    .onboarding-mirror-filters .preply-availability-panel {
      margin-top: .45rem;
      border: 1px solid #e5e7eb;
      border-radius: 10px;
      background: #fff;
      padding: .6rem;
      display: none;
    }
    .onboarding-mirror-filters .preply-availability-panel.active { display: block; }
    .onboarding-mirror-filters .availability-section-title {
      font-size: .9rem;
      font-weight: 800;
      color: #111827;
      margin: 0 0 .4rem 0;
    }
    .onboarding-mirror-filters .availability-time-slots,
    .onboarding-mirror-filters .availability-days {
      display: flex;
      flex-wrap: wrap;
      gap: .35rem;
      margin-bottom: .45rem;
    }
    .onboarding-mirror-filters .availability-time-btn,
    .onboarding-mirror-filters .availability-day-btn {
      border: 1px solid #d1d5db;
      background: #fff;
      border-radius: 999px;
      padding: .32rem .5rem;
      font-size: .78rem;
      cursor: pointer;
      color: #111827;
    }
    .onboarding-mirror-filters .availability-time-btn.active,
    .onboarding-mirror-filters .availability-day-btn.active {
      border-color: #4f46e5;
      background: #eef2ff;
      color: #3730a3;
      font-weight: 700;
    }
    .onboarding-mirror-filters .availability-actions {
      display: flex;
      justify-content: flex-end;
      gap: .45rem;
      margin-top: .45rem;
    }
    .onboarding-mirror-filters .availability-clear-btn,
    .onboarding-mirror-filters .availability-apply-btn {
      border: 1px solid #d1d5db;
      border-radius: 8px;
      background: #fff;
      padding: .4rem .6rem;
      font-size: .78rem;
      font-weight: 700;
    }
    .onboarding-mirror-filters .availability-apply-btn {
      border-color: #4f46e5;
      color: #fff;
      background: #4f46e5;
    }
    .onboarding-mirror-filters .lessons-affiner-tarif-link {
      display: inline-flex;
      align-items: center;
      color: #2563EB;
      font-size: .86rem;
      font-weight: 600;
      text-decoration: none;
    }
    .onboarding-mirror-filters .lessons-tarif-accordion {
      max-height: 0;
      overflow: hidden;
      transition: max-height .35s ease;
    }
    .onboarding-mirror-filters .lessons-tarif-accordion.is-open { max-height: 420px; }
    .onboarding-mirror-filters .besoin-rituel-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: .8rem;
      margin-bottom: .8rem;
    }
    .onboarding-mirror-filters .rituel-price-range-display {
      display: flex;
      align-items: center;
      gap: .5rem;
      margin-top: .55rem;
    }
    .onboarding-mirror-filters .rituel-price-input {
      width: 74px;
      padding: .45rem .5rem;
      border: 1px solid #d1d5db;
      border-radius: 8px;
    }
    .onboarding-mirror-filters .rituel-price-slider { margin-top: .45rem; }
    /* Services (catégories et sous-catégories) */
    .services-categories {
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
      max-height: 600px;
      overflow-y: auto;
      padding-right: 0.5rem;
    }

    .service-category {
      background: white;
      border: 1px solid #e5e7eb;
      border-radius: 12px;
      overflow: hidden;
      transition: all 0.2s ease;
    }
    
    .service-category .category-subcategories {
      overflow: visible;
    }

    .service-category:hover {
      border-color: var(--junspro-purple);
      box-shadow: 0 2px 8px rgba(124, 58, 237, 0.1);
    }

    .category-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 1rem 1.25rem;
      cursor: pointer;
      user-select: none;
      transition: background 0.2s ease;
    }

    .category-header:hover {
      background: #f9fafb;
    }

    .category-header.active {
      background: #faf5ff;
    }

    .category-header.has-selection {
      border-left: 3px solid var(--junspro-purple);
    }

    .category-header.has-selection .category-name {
      color: var(--junspro-purple);
    }

    .category-info {
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }

    .category-icon {
      font-size: 1.5rem;
      width: 2rem;
      text-align: center;
    }

    .category-name {
      font-size: 0.95rem;
      font-weight: 600;
      color: #374151;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .category-arrow {
      font-size: 0.875rem;
      color: #6b7280;
      transition: transform 0.2s ease;
    }

    .category-header.active .category-arrow {
      transform: rotate(180deg);
      color: var(--junspro-purple);
    }

    .category-subcategories {
      display: none;
      padding: 0 1.25rem 1rem 1.25rem;
      padding-left: 3.75rem;
    }

    .category-header.active + .category-subcategories,
    .category-subcategories.show {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
      gap: 1.25rem 1rem;
      padding-top: 1.25rem;
      padding-bottom: 1.25rem;
      margin-top: 0.5rem;
    }

    .subcategory-checkbox {
      display: none;
    }

    .subcategory-label {
      display: flex;
      align-items: center;
      padding: 1rem 1.25rem;
      min-height: 3.5rem;
      border: 2px solid #e5e7eb;
      border-radius: 10px;
      cursor: pointer;
      transition: all 0.2s ease;
      font-size: 0.875rem;
      font-weight: 500;
      color: #374151;
      background: white;
      line-height: 1.6;
      word-wrap: break-word;
      overflow-wrap: break-word;
      text-align: center;
      justify-content: center;
      margin: 0;
    }

    .subcategory-label:hover {
      border-color: var(--junspro-purple);
      background: #faf5ff;
    }

    .subcategory-checkbox:checked + .subcategory-label {
      background: var(--junspro-gradient);
      color: white;
      border-color: var(--junspro-purple);
    }

    .services-categories::-webkit-scrollbar {
      width: 6px;
    }

    .services-categories::-webkit-scrollbar-track {
      background: #f1f5f9;
      border-radius: 3px;
    }

    .services-categories::-webkit-scrollbar-thumb {
      background: #cbd5e1;
      border-radius: 3px;
    }

    .services-categories::-webkit-scrollbar-thumb:hover {
      background: #94a3b8;
    }

    /* Actions */
    .onboarding-actions {
      display: flex;
      justify-content: space-between;
      gap: 1rem;
      margin-top: 2rem;
      padding-top: 2rem;
      border-top: 1px solid #e5e7eb;
    }

    .btn-back {
      padding: 0.875rem 2rem;
      background: white;
      border: 2px solid #e5e7eb;
      border-radius: 12px;
      color: #6b7280;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.2s ease;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
    }

    .btn-back:hover {
      border-color: #d1d5db;
      background: #f9fafb;
    }

    .btn-continue {
      padding: 0.875rem 2rem;
      background: var(--junspro-gradient);
      border: none;
      border-radius: 12px;
      color: white;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(124, 58, 237, 0.3);
    }

    .btn-continue:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(124, 58, 237, 0.4);
    }

    .btn-continue:active {
      transform: translateY(0);
    }

    /* Responsive */
    @media (max-width: 768px) {
      .onboarding-content {
        padding: 2rem 1.5rem;
      }

      .progress-steps {
        flex-direction: column;
        align-items: flex-start;
      }

      .progress-chevron {
        display: none;
      }

      .onboarding-language-row {
        grid-template-columns: 1fr;
      }

      .onboarding-scope-grid {
        grid-template-columns: 1fr;
      }

      .onboarding-language-table-head,
      .onboarding-language-table-row {
        grid-template-columns: 1fr;
      }

      .identity-grid {
        grid-template-columns: 1fr;
      }

      .services-categories {
        max-height: 400px;
      }

      .category-subcategories.show {
        grid-template-columns: 1fr;
      }

      .onboarding-actions {
        flex-direction: column-reverse;
      }

      .btn-back,
      .btn-continue {
        width: 100%;
        justify-content: center;
      }
    }
  </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <div class="onboarding-page">
    <div class="onboarding-container">
      <?php echo $__env->make('frontend.freelance.onboarding.partials.premium-stepper', ['routeStep' => 1], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
      <!-- Barre de progression -->
      <div class="onboarding-progress" style="display:none;">
        <div class="progress-steps">
          <div class="progress-step active">
            <div class="progress-step-number">1</div>
            <span class="progress-step-label">À propos</span>
          </div>
          <span class="progress-chevron">›</span>
          <div class="progress-step pending" style="pointer-events: none; opacity: 0.6;">
            <div class="progress-step-number">2</div>
            <span class="progress-step-label">Photo</span>
          </div>
          <span class="progress-chevron">›</span>
          <div class="progress-step pending">
            <div class="progress-step-number">3</div>
            <span class="progress-step-label">Certifications</span>
          </div>
          <span class="progress-chevron">›</span>
          <div class="progress-step pending">
            <div class="progress-step-number">4</div>
            <span class="progress-step-label">Formation</span>
          </div>
          <span class="progress-chevron">›</span>
          <div class="progress-step pending">
            <div class="progress-step-number">5</div>
            <span class="progress-step-label">Description</span>
          </div>
          <span class="progress-chevron">›</span>
          <div class="progress-step pending">
            <div class="progress-step-number">6</div>
            <span class="progress-step-label">Vidéo</span>
          </div>
          <span class="progress-chevron">›</span>
          <div class="progress-step pending">
            <div class="progress-step-number">7</div>
            <span class="progress-step-label">Disponibilité</span>
          </div>
          <span class="progress-chevron">›</span>
          <div class="progress-step pending">
            <div class="progress-step-number">8</div>
            <span class="progress-step-label">Tarif</span>
          </div>
        </div>
      </div>

      <!-- Contenu principal -->
      <div class="onboarding-content">
        <div class="onboarding-header">
          <h1 class="onboarding-title">À propos</h1>
          <p class="onboarding-description">
            Commencez à créer votre profil public en tant que freelance. Vos modifications seront automatiquement enregistrées à mesure que vous complétez chaque section. Vous pourrez y revenir à tout moment afin de finaliser votre inscription.
          </p>
        </div>

        <?php if(session('success')): ?>
          <div style="padding: 1rem; background: #f0fdf4; border: 1px solid #86efac; border-radius: 12px; color: #166534; margin-bottom: 1.5rem;">
            ✓ <?php echo e(session('success')); ?>

          </div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
          <div style="padding: 1rem; background: #fef2f2; border: 1px solid #fca5a5; border-radius: 12px; color: #991b1b; margin-bottom: 1.5rem;">
            <ul style="margin: 0; padding-left: 1.25rem;">
              <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
          </div>
        <?php endif; ?>

        <form action="<?php echo e(route('freelance.onboarding.step1.store')); ?>" method="POST" class="onboarding-form" enctype="multipart/form-data">
          <?php echo csrf_field(); ?>

          <!-- Prénom -->
          <div class="form-group">
            <label for="first_name" class="form-label">Prénom</label>
            <input 
              type="text" 
              id="first_name" 
              name="first_name" 
              class="form-input <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> form-input-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
              value="<?php echo e(old('first_name', $data['first_name'] ?? '')); ?>"
              required
            >
            <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              <span class="form-error"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>

          <!-- Nom -->
          <div class="form-group">
            <label for="last_name" class="form-label">Nom</label>
            <input 
              type="text" 
              id="last_name" 
              name="last_name" 
              class="form-input <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> form-input-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
              value="<?php echo e(old('last_name', $data['last_name'] ?? '')); ?>"
              required
            >
            <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              <span class="form-error"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>

          <div class="form-group">
            <div class="onboarding-scope-col">
              <label class="onboarding-scope-label">Mode d'intervention</label>
              <div class="onboarding-mode-segment" id="scopeModeSegment">
                <button type="button" class="onboarding-mode-btn" data-mode="online">En ligne</button>
                <button type="button" class="onboarding-mode-btn" data-mode="onsite">En présentiel</button>
                <button type="button" class="onboarding-mode-btn" data-mode="hybrid">Hybride</button>
              </div>
              <input type="hidden" name="intervention_mode" id="scopeModeInput" value="<?php echo e($selectedMode ?? 'online'); ?>">
            </div>

            <div class="onboarding-scope-grid" id="scopeLocationRow" style="margin-top: 0.85rem;">
              <div class="onboarding-scope-col">
                <label class="onboarding-scope-label">Pays</label>
                <select class="form-select" id="scopeCountrySelect" name="onsite_country">
                  <option value="">Pays</option>
                </select>
              </div>
              <div class="onboarding-scope-col">
                <label class="onboarding-scope-label">Ville</label>
                <select class="form-select" id="scopeCitySelect" name="onsite_city">
                  <option value="">Ville</option>
                </select>
              </div>
            </div>

            <div class="onboarding-scope-preview" id="scopeMirrorPreview"></div>
          </div>


          <!-- Votre périmètre (miroir des filtres clients) -->
          <div class="form-group">
            <label class="form-label">Votre périmètre (miroir des filtres clients)</label>
            <?php
              $scopeConfig = config('services_universes');
              $scopeUniverses = $scopeConfig['universes'] ?? [];
              $scopeDomainsByUniverse = $scopeConfig['domains_by_universe'] ?? [];
              $scopeData = old('service_scope', $data['service_scope'] ?? []);
              $selectedUniverses = old('universes', $scopeData['universes'] ?? []);
              $selectedDomains = old('domains', $scopeData['domains'] ?? []);
              $selectedSpecializationMain = old('specialization_main', $data['specialization_main'] ?? '');
              $selectedSpecializationAdditional = old('specialization_additional', $data['specialization_additional'] ?? []);
              $selectedMode = old('intervention_mode', $scopeData['intervention_mode'] ?? 'online');
              $selectedCountry = old('onsite_country', $scopeData['onsite_country'] ?? '');
              $selectedCity = old('onsite_city', $scopeData['onsite_city'] ?? '');
              $scopeCountries = [
                'FR' => 'France', 'BE' => 'Belgique', 'CH' => 'Suisse', 'CA' => 'Canada', 'US' => 'États-Unis',
                'GB' => 'Royaume-Uni', 'ES' => 'Espagne', 'DE' => 'Allemagne', 'IT' => 'Italie', 'PT' => 'Portugal',
                'NL' => 'Pays-Bas', 'MA' => 'Maroc', 'TN' => 'Tunisie', 'SN' => 'Sénégal', 'CI' => 'Côte d\'Ivoire'
              ];
              $scopeCitiesByCountry = [
                'FR' => ['Paris','Lyon','Marseille','Bordeaux','Nantes','Lille','Strasbourg','Rennes','Toulouse','Nice'],
                'BE' => ['Bruxelles','Anvers','Liège','Gand'],
                'CH' => ['Genève','Lausanne','Zurich','Bâle'],
                'CA' => ['Montréal','Toronto','Vancouver','Québec'],
                'US' => ['New York','Los Angeles','Chicago','Miami'],
                'GB' => ['Londres','Manchester','Birmingham','Édimbourg'],
                'ES' => ['Barcelone','Madrid','Valence','Séville'],
                'DE' => ['Berlin','Munich','Hambourg','Cologne'],
                'IT' => ['Rome','Milan','Naples','Turin'],
                'PT' => ['Lisbonne','Porto','Faro','Coimbra'],
                'NL' => ['Amsterdam','Rotterdam','La Haye'],
                'MA' => ['Casablanca','Rabat','Marrakech','Tanger'],
                'TN' => ['Tunis','Sfax','Sousse'],
                'SN' => ['Dakar','Thiès','Saint-Louis'],
                'CI' => ['Abidjan','Yamoussoukro','San Pedro'],
              ];
            ?>
            <div
              class="onboarding-scope-premium"
              id="onboardingScopePremium"
              data-universes='<?php echo json_encode($scopeUniverses, 15, 512) ?>'
              data-domains='<?php echo json_encode($scopeDomainsByUniverse, 15, 512) ?>'
              data-countries='<?php echo json_encode($scopeCountries, 15, 512) ?>'
              data-cities='<?php echo json_encode($scopeCitiesByCountry, 15, 512) ?>'
              data-selected-universes='<?php echo json_encode(array_values((array)$selectedUniverses), 15, 512) ?>'
              data-selected-domains='<?php echo json_encode(array_values((array)$selectedDomains), 15, 512) ?>'
              data-specializations='<?php echo json_encode($specializationsByDomain ?? [], 15, 512) ?>'
              data-selected-specialization-main="<?php echo e(is_string($selectedSpecializationMain) ? $selectedSpecializationMain : ''); ?>"
              data-selected-specialization-additional='<?php echo json_encode(array_values((array)$selectedSpecializationAdditional), 15, 512) ?>'
              data-selected-mode="<?php echo e($selectedMode); ?>"
              data-selected-country="<?php echo e($selectedCountry); ?>"
              data-selected-city="<?php echo e($selectedCity); ?>"
            >
              <div class="onboarding-scope-grid">
                <div class="onboarding-scope-col">
                  <label class="onboarding-scope-label">Univers</label>
                  <button type="button" class="onboarding-scope-trigger" id="scopeUniverseTrigger">
                    <span id="scopeUniverseTriggerText">Sélectionner un ou plusieurs univers</span>
                    <i class="fas fa-chevron-down"></i>
                  </button>
                  <div class="onboarding-scope-menu" id="scopeUniverseMenu"></div>
                  <div class="onboarding-scope-chips" id="scopeUniverseChips"></div>
                  <input type="hidden" id="scopeUniversesMirror">
          </div>

                <div class="onboarding-scope-col">
                  <label class="onboarding-scope-label">Domaines</label>
                  <button type="button" class="onboarding-scope-trigger" id="scopeDomainTrigger">
                    <span id="scopeDomainTriggerText">Commencez par choisir un univers</span>
                    <i class="fas fa-chevron-down"></i>
                  </button>
                  <div class="onboarding-scope-menu" id="scopeDomainMenu"></div>
                  <div class="onboarding-scope-helper" id="scopeDomainHelper">Commencez par choisir un univers.</div>
                  <div class="onboarding-scope-chips" id="scopeDomainChips"></div>
                  <input type="hidden" id="scopeDomainsMirror">
                </div>
          </div>

              <div class="onboarding-scope-grid" style="margin-top: 0.85rem;">
                <div class="onboarding-scope-col">
                  <label class="onboarding-scope-label">Spécialisation principale</label>
                  <select class="form-select" id="scopePrimarySpecialization" name="specialization_main" disabled>
                    <option value="">Sélectionner une spécialisation</option>
                  </select>
                  <div class="onboarding-scope-helper">Celle-ci sera mise en avant sur votre profil.</div>
                </div>
                <div class="onboarding-scope-col">
                  <label class="onboarding-scope-label">Spécialisations additionnelles (optionnel)</label>
                  <button type="button" class="onboarding-scope-trigger" id="scopeAdditionalSpecializationsTrigger" disabled>
                    <span id="scopeAdditionalSpecializationsTriggerText">Choisissez d'abord un ou plusieurs domaines.</span>
                    <i class="fas fa-chevron-down"></i>
                  </button>
                  <div class="onboarding-scope-menu" id="scopeAdditionalSpecializationsMenu"></div>
                  <div class="onboarding-scope-helper" id="scopeSpecializationHelper">Choisissez d'abord un ou plusieurs domaines.</div>
                  <div class="onboarding-scope-chips" id="scopeAdditionalSpecializationsChips"></div>
                  <div class="onboarding-specialization-feedback" id="scopeSpecializationFeedback" style="display:none;"></div>
                </div>
              </div>

              <div id="scopeHiddenInputs"></div>
            </div>
            <?php $__errorArgs = ['universes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              <span class="form-error"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <?php $__errorArgs = ['domains'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              <span class="form-error"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <?php $__errorArgs = ['intervention_mode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              <span class="form-error"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <?php $__errorArgs = ['onsite_country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              <span class="form-error"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <?php $__errorArgs = ['onsite_city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              <span class="form-error"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <?php $__errorArgs = ['specialization_main'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              <span class="form-error"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <?php $__errorArgs = ['specialization_additional'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              <span class="form-error"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>

          <div class="form-group">
            <label class="form-label">Affiner votre matching (optionnel)</label>
            <p style="font-size: 0.86rem; color: #6b7280; margin: 0 0 .45rem 0;">
              Ces réglages par univers reflètent les filtres côté client et améliorent votre visibilité.
            </p>
            <?php
              $matchingFilters = old('matching_filters', $data['matching_filters'] ?? []);
                      ?>
            <div class="onboarding-scope-premium onboarding-mirror-filters" id="onboardingUniverseMirrorRoot">
              <div id="matchingFiltersEmpty" class="onboarding-language-empty">Sélectionnez un univers pour afficher ses filtres.</div>
              <div id="matchingUniversePanels" style="display:flex; flex-direction:column; gap:.65rem;">
                <?php $__currentLoopData = ($scopeUniverses ?? []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $uSlug => $uLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php $m = is_array($matchingFilters[$uSlug] ?? null) ? $matchingFilters[$uSlug] : []; ?>
                  <?php $uf = (array)($onboardingUniverseFilters[$uSlug] ?? []); ?>
                  <details class="onboarding-matching-panel" data-universe-panel="<?php echo e($uSlug); ?>" data-onboarding-filters="<?php echo e($uSlug); ?>" data-matching-payload='<?php echo json_encode($m, 15, 512) ?>' style="display:none; border:1px solid #e5e7eb; border-radius:12px; background:#fff; padding:.7rem;">
                    <summary style="cursor:pointer; font-weight:700; color:#111827;"><?php echo e($uLabel); ?></summary>
                    <div class="onboarding-mirror-universe-inner" style="margin-top:.7rem;">
                      <?php if($uSlug === 'projects'): ?>
                        <?php echo $__env->make('frontend.freelance.onboarding.partials.matching.projects', ['m' => $m, 'uf' => $uf], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                      <?php elseif($uSlug === 'lessons'): ?>
                        <div class="filter-group filter-group-rituel lessons-engagement-block" data-onboarding-lessons-rituel>
                          <label class="filter-label"><i class="fas fa-coins me-2"></i>Engagement en Rituel (Budget / 4 semaines)</label>
                          <div class="engagement-select-wrapper">
                            <select name="price_range" class="filter-select budget-filter" data-lessons-budget>
                              <option value="" <?php echo e(empty($m['price_range'] ?? '') ? 'selected' : ''); ?>>Tous les engagements</option>
                              <option value="0-1000" <?php echo e(($m['price_range'] ?? '') == '0-1000' ? 'selected' : ''); ?>>0 – 1 000 € — Budget formation — Exploratoire</option>
                              <option value="1000-2500" <?php echo e(($m['price_range'] ?? '') == '1000-2500' ? 'selected' : ''); ?>>1 000 – 2 500 € — Budget formation — Standard</option>
                              <option value="2500-5000" <?php echo e(($m['price_range'] ?? '') == '2500-5000' ? 'selected' : ''); ?>>2 500 – 5 000 € — Budget formation — Intensif</option>
                              <option value="5000-10000" <?php echo e(($m['price_range'] ?? '') == '5000-10000' ? 'selected' : ''); ?>>5 000 – 10 000 € — Budget formation — Avancé</option>
                              <option value="10000-20000" <?php echo e(($m['price_range'] ?? '') == '10000-20000' ? 'selected' : ''); ?>>10 000 – 20 000 € — Budget formation — Partenariat</option>
                              <option value="20000-60000" <?php echo e(($m['price_range'] ?? '') == '20000-60000' ? 'selected' : ''); ?>>20 000 – 60 000 € — Budget formation — Long terme</option>
                              <option value="60000+" <?php echo e(($m['price_range'] ?? '') == '60000+' ? 'selected' : ''); ?>>60 000 € et + — Budget formation — Stratégique étendu</option>
                            </select>
                  </div>
                          <div class="budget-estimate" data-lessons-budget-estimate style="font-size: 12px; margin-top: 6px; color: #6B7280; opacity: 0.8; font-weight: 400;">
                            <span class="budget-estimate-volume">Sélectionnez un engagement pour afficher une estimation en rituels.</span>
                            <div class="budget-estimate-prices" style="display: none; font-size: 11px; color: #059669; margin-top: 4px;">
                              <span>Tarif journalier moyen (<span class="budget-estimate-base-hours">7</span>h) : <span data-express-target="engagement-daily-avg" data-base-value="0">0</span> €/jour <span class="budget-estimate-daily-range" style="display: none;">(fourchette : <span data-express-target="engagement-daily-min" data-base-value="0">0</span>–<span data-express-target="engagement-daily-max" data-base-value="0">0</span> €/jour)</span></span><br>
                              <span>Tarif horaire moyen : <span data-express-target="engagement-hourly-avg" data-base-value="0">0</span> €/h <span class="budget-estimate-hourly-range" style="display: none;">(fourchette : <span data-express-target="engagement-hourly-min" data-base-value="0">0</span>–<span data-express-target="engagement-hourly-max" data-base-value="0">0</span> €/h)</span></span>
                </div>
                            <div class="budget-estimate-express" style="display: none; font-size: 10px; color: #6B7280; margin-top: 6px;"></div>
              </div>
                          <div class="budget-recommandation-junspro" data-lessons-reco style="font-size: 11px; margin-top: 6px; color: #2563EB; font-weight: 500; display: none;"></div>
                          <?php if (isset($component)) { $__componentOriginal5cbed211e40342dd846196c4523ba0f1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5cbed211e40342dd846196c4523ba0f1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.subscription.express-options','data' => ['variant' => 'cards','showMicroLine' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('subscription.express-options'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'cards','showMicroLine' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5cbed211e40342dd846196c4523ba0f1)): ?>
<?php $attributes = $__attributesOriginal5cbed211e40342dd846196c4523ba0f1; ?>
<?php unset($__attributesOriginal5cbed211e40342dd846196c4523ba0f1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5cbed211e40342dd846196c4523ba0f1)): ?>
<?php $component = $__componentOriginal5cbed211e40342dd846196c4523ba0f1; ?>
<?php unset($__componentOriginal5cbed211e40342dd846196c4523ba0f1); ?>
<?php endif; ?>
                          <div class="engagement-base-toggle-row" style="display: flex; align-items: center; gap: 8px; margin-top: 8px; font-size: 11px; color: #6B7280;">
                            <span class="engagement-base-label" style="font-weight: 500;">Base journée :</span>
                            <div class="engagement-base-toggle" style="display: inline-flex; border: 1px solid #E5E7EB; border-radius: 8px; padding: 2px; background: #F9FAFB;">
                              <button type="button" class="engagement-base-btn is-active" data-base="7" style="padding: 4px 10px; border: none; background: transparent; color: #6B7280; font-size: 11px; cursor: pointer; border-radius: 6px;">7h</button>
                              <button type="button" class="engagement-base-btn" data-base="8" style="padding: 4px 10px; border: none; background: transparent; color: #6B7280; font-size: 11px; cursor: pointer; border-radius: 6px;">8h</button>
            </div>
          </div>
                          <a href="#" class="lessons-affiner-tarif-link" data-lessons-affiner-link style="display: block; margin-top: 12px;">
                            <i class="fas fa-sliders-h me-2"></i>Affiner par tarif horaire
                          </a>
                          <div class="lessons-tarif-accordion" data-lessons-tarif-accordion>
                            <div class="filter-group besoin-tarif-rituel">
                              <label class="filter-label"><i class="fas fa-coins me-2"></i>Tarif du rituel / h</label>
                              <div class="rituel-price-filter-wrapper">
                                <div class="rituel-price-slider" data-lessons-rituel-slider></div>
                                <div class="rituel-price-range-display">
                                  <input type="number" name="price_min" class="rituel-price-input" data-lessons-price-min min="10" max="299" value="<?php echo e($m['price_min'] ?? 10); ?>" step="1">
                                  <span class="rituel-price-separator">-</span>
                                  <input type="number" name="price_max" class="rituel-price-input" data-lessons-price-max min="10" max="299" value="<?php echo e($m['price_max'] ?? 50); ?>" step="1">
                                  <span class="rituel-price-unit">€</span>
                    </div>
                                <div class="rituel-price-summary" data-lessons-price-summary>
                                  <div><span class="rituel-summary-label">Tarif horaire :</span> <span><span data-express-target="slider-hourly-min" data-base-value="10">10</span>–<span data-express-target="slider-hourly-max" data-base-value="50">50</span></span> €/h</div>
                                  <div><span class="rituel-summary-label">Tarif journalier :</span> <span><span data-express-target="slider-daily-min" data-base-value="70">70</span>–<span data-express-target="slider-daily-max" data-base-value="350">350</span></span> €/jour</div>
                                  <div class="rituel-base-toggle-row" style="display: flex; align-items: center; gap: 8px; margin-top: 8px; font-size: 11px; color: #6B7280;">
                                    <span class="rituel-base-label" style="font-weight: 500;">Base journée :</span>
                                    <div class="rituel-base-toggle" style="display: inline-flex; border: 1px solid #E5E7EB; border-radius: 8px; padding: 2px; background: #F9FAFB;">
                                      <button type="button" class="rituel-base-btn is-active" data-base="7" style="padding: 4px 10px; border: none; background: transparent; color: #6B7280; font-size: 11px; cursor: pointer; border-radius: 6px;">7h</button>
                                      <button type="button" class="rituel-base-btn" data-base="8" style="padding: 4px 10px; border: none; background: transparent; color: #6B7280; font-size: 11px; cursor: pointer; border-radius: 6px;">8h</button>
                  </div>
                  </div>
                </div>
                              </div>
                            </div>
                          </div>
                          <div class="filter-group besoin-format-rituel">
                            <label class="filter-label"><i class="fas fa-clock me-2"></i>Format du rituel</label>
                            <div class="besoin-format-rituel-value">50 min focus · 10 min restitution</div>
                            <p class="besoin-format-rituel-micro">Un temps dédié à l'action, suivi d'un retour structuré et concret.</p>
                          </div>
                        </div>
                      <?php elseif($uSlug === 'at-home' || $uSlug === 'wellnesslive'): ?>
                        <div class="besoin-rituel-row" data-onboarding-rituel="<?php echo e($uSlug); ?>">
                          <div class="filter-group besoin-tarif-rituel">
                            <label class="filter-label"><i class="fas fa-coins me-2"></i>Tarif du rituel / h</label>
                            <div class="rituel-price-filter-wrapper">
                              <div class="rituel-price-slider" data-rituel-slider></div>
                              <div class="rituel-price-range-display">
                                <input type="number" name="price_min" class="rituel-price-input" data-rituel-price-min min="10" max="100" value="<?php echo e($m['price_min'] ?? 10); ?>" step="1">
                                <span class="rituel-price-separator">-</span>
                                <input type="number" name="price_max" class="rituel-price-input" data-rituel-price-max min="10" max="100" value="<?php echo e($m['price_max'] ?? 50); ?>" step="1">
                                <span class="rituel-price-unit">€</span>
                              </div>
                              <div class="rituel-price-summary" data-rituel-price-summary>
                                <div><span class="rituel-summary-label">Tarif horaire :</span> <span><span data-express-target="slider-hourly-min" data-base-value="10">10</span>–<span data-express-target="slider-hourly-max" data-base-value="50">50</span></span> €/h</div>
                                <div><span class="rituel-summary-label">Tarif journalier :</span> <span><span data-express-target="slider-daily-min" data-base-value="70">70</span>–<span data-express-target="slider-daily-max" data-base-value="350">350</span></span> €/jour</div>
                                <?php if (isset($component)) { $__componentOriginal5cbed211e40342dd846196c4523ba0f1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5cbed211e40342dd846196c4523ba0f1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.subscription.express-options','data' => ['variant' => 'cards','showMicroLine' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('subscription.express-options'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'cards','showMicroLine' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5cbed211e40342dd846196c4523ba0f1)): ?>
<?php $attributes = $__attributesOriginal5cbed211e40342dd846196c4523ba0f1; ?>
<?php unset($__attributesOriginal5cbed211e40342dd846196c4523ba0f1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5cbed211e40342dd846196c4523ba0f1)): ?>
<?php $component = $__componentOriginal5cbed211e40342dd846196c4523ba0f1; ?>
<?php unset($__componentOriginal5cbed211e40342dd846196c4523ba0f1); ?>
<?php endif; ?>
                                <div class="rituel-base-toggle-row" style="display: flex; align-items: center; gap: 8px; margin-top: 8px; font-size: 11px; color: #6B7280;">
                                  <span class="rituel-base-label" style="font-weight: 500;">Base journée :</span>
                                  <div class="rituel-base-toggle" style="display: inline-flex; border: 1px solid #E5E7EB; border-radius: 8px; padding: 2px; background: #F9FAFB;">
                                    <button type="button" class="rituel-base-btn is-active" data-base="7" style="padding: 4px 10px; border: none; background: transparent; color: #6B7280; font-size: 11px; cursor: pointer; border-radius: 6px;">7h</button>
                                    <button type="button" class="rituel-base-btn" data-base="8" style="padding: 4px 10px; border: none; background: transparent; color: #6B7280; font-size: 11px; cursor: pointer; border-radius: 6px;">8h</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="filter-group besoin-format-rituel">
                            <label class="filter-label"><i class="fas fa-clock me-2"></i>Format du rituel</label>
                            <div class="besoin-format-rituel-value">50 min focus · 10 min restitution</div>
                            <p class="besoin-format-rituel-micro">Un temps dédié à l'action, suivi d'un retour structuré et concret.</p>
                          </div>
                        </div>
                      <?php endif; ?>

                      <?php if($uSlug === 'homeswap'): ?>
                        <?php echo $__env->make('frontend.freelance.onboarding.partials.matching.homeswap', ['m' => $m, 'uf' => $uf], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                      <?php elseif($uSlug === 'corporate' || $uSlug === 'presence'): ?>
                        <?php echo $__env->make('frontend.freelance.onboarding.partials.matching.presence', ['m' => $m, 'uf' => $uf], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                      <?php elseif($uSlug === 'lessons' || $uSlug === 'at-home' || $uSlug === 'wellnesslive'): ?>
                        <?php echo $__env->make('frontend.freelance.onboarding.partials.matching.universal', ['m' => $m, 'uf' => $uf, 'uSlug' => $uSlug], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                      <?php endif; ?>
                      <div data-onboarding-matching-hidden></div>
                  </div>
                  </details>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            </div>
          </div>

          <!-- Numéro de téléphone (optionnel) -->
          <div class="form-group">
            <label for="phone" class="form-label">Numéro de téléphone (optionnel)</label>
            <div style="display: flex; gap: 0.5rem;">
              <select 
                id="phone_country_code" 
                name="phone_country_code" 
                class="form-select"
                style="flex: 0 0 120px;"
              >
                <option value="+33" <?php echo e(old('phone_country_code', $data['phone_country_code'] ?? '+33') === '+33' ? 'selected' : ''); ?>>🇫🇷 +33</option>
                <option value="+1" <?php echo e(old('phone_country_code', $data['phone_country_code'] ?? '') === '+1' ? 'selected' : ''); ?>>🇺🇸 +1</option>
                <option value="+44" <?php echo e(old('phone_country_code', $data['phone_country_code'] ?? '') === '+44' ? 'selected' : ''); ?>>🇬🇧 +44</option>
                <option value="+32" <?php echo e(old('phone_country_code', $data['phone_country_code'] ?? '') === '+32' ? 'selected' : ''); ?>>🇧🇪 +32</option>
                <option value="+41" <?php echo e(old('phone_country_code', $data['phone_country_code'] ?? '') === '+41' ? 'selected' : ''); ?>>🇨🇭 +41</option>
                <option value="+34" <?php echo e(old('phone_country_code', $data['phone_country_code'] ?? '') === '+34' ? 'selected' : ''); ?>>🇪🇸 +34</option>
                <option value="+39" <?php echo e(old('phone_country_code', $data['phone_country_code'] ?? '') === '+39' ? 'selected' : ''); ?>>🇮🇹 +39</option>
                <option value="+49" <?php echo e(old('phone_country_code', $data['phone_country_code'] ?? '') === '+49' ? 'selected' : ''); ?>>🇩🇪 +49</option>
                <option value="+351" <?php echo e(old('phone_country_code', $data['phone_country_code'] ?? '') === '+351' ? 'selected' : ''); ?>>🇵🇹 +351</option>
                <option value="+31" <?php echo e(old('phone_country_code', $data['phone_country_code'] ?? '') === '+31' ? 'selected' : ''); ?>>🇳🇱 +31</option>
                <option value="+212" <?php echo e(old('phone_country_code', $data['phone_country_code'] ?? '') === '+212' ? 'selected' : ''); ?>>🇲🇦 +212</option>
                <option value="+213" <?php echo e(old('phone_country_code', $data['phone_country_code'] ?? '') === '+213' ? 'selected' : ''); ?>>🇩🇿 +213</option>
                <option value="+216" <?php echo e(old('phone_country_code', $data['phone_country_code'] ?? '') === '+216' ? 'selected' : ''); ?>>🇹🇳 +216</option>
                <option value="+225" <?php echo e(old('phone_country_code', $data['phone_country_code'] ?? '') === '+225' ? 'selected' : ''); ?>>🇨🇮 +225</option>
                <option value="+221" <?php echo e(old('phone_country_code', $data['phone_country_code'] ?? '') === '+221' ? 'selected' : ''); ?>>🇸🇳 +221</option>
              </select>
              <input 
                type="tel" 
                id="phone" 
                name="phone" 
                class="form-input <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> form-input-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                value="<?php echo e(old('phone', $data['phone'] ?? '')); ?>"
                placeholder="6 12 34 56 78"
                style="flex: 1;"
              >
            </div>
            <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              <span class="form-error"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>

          <!-- Langues parlées -->
          <div class="form-group">
            <label class="form-label">Langues parlées</label>
            <?php
              $languageCatalog = [
                'fr' => 'Français',
                'en' => 'Anglais',
                'es' => 'Espagnol',
                'de' => 'Allemand',
                'it' => 'Italien',
                'pt' => 'Portugais',
                'nl' => 'Néerlandais',
                'ru' => 'Russe',
                'zh' => 'Chinois',
                'ar' => 'Arabe',
                'ja' => 'Japonais',
                'pl' => 'Polonais',
                'el' => 'Grec',
                'tr' => 'Turc',
                'sv' => 'Suédois',
                'ko' => 'Coréen',
                'hi' => 'Hindi',
              ];
              $cecrlLevels = ['A1', 'A2', 'B1', 'B2', 'C1', 'C2'];
              $legacyToCecrl = [
                'native' => 'C2',
                'fluent' => 'C1',
                'intermediate' => 'B1',
                'beginner' => 'A2',
              ];

              $rawLanguages = old('languages', $data['languages'] ?? []);
              $motherLanguageCode = old('mother_language');
              $otherLanguagesFromOld = old('other_languages');
              $normalizedOthers = [];
              $seenOtherCodes = [];

              if (is_string($otherLanguagesFromOld) && $otherLanguagesFromOld !== '') {
                $decodedOther = json_decode($otherLanguagesFromOld, true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decodedOther)) {
                  $otherLanguagesFromOld = $decodedOther;
                }
              }

              if (empty($rawLanguages) || !is_array($rawLanguages)) {
                $rawLanguages = [];
              }

              foreach ($rawLanguages as $idx => $entry) {
                $languageValue = is_array($entry) ? ($entry['code'] ?? ($entry['language'] ?? ($entry['name'] ?? ''))) : $entry;
                $code = null;
                if (is_string($languageValue) && isset($languageCatalog[$languageValue])) {
                  $code = $languageValue;
                } elseif (is_string($languageValue)) {
                  $foundCode = array_search($languageValue, $languageCatalog, true);
                  $code = $foundCode !== false ? $foundCode : null;
                }
                if (!$code) {
                  continue;
                }

                $rawLevel = is_array($entry) ? ($entry['level'] ?? ($entry['proficiency'] ?? null)) : null;
                $level = is_string($rawLevel) && isset($legacyToCecrl[$rawLevel]) ? $legacyToCecrl[$rawLevel] : $rawLevel;
                if (!in_array($level, $cecrlLevels, true)) {
                  $level = 'B1';
                }

                $role = is_array($entry) ? ($entry['role'] ?? null) : null;
                if (!$motherLanguageCode && ($role === 'mother' || $rawLevel === 'native' || $idx === 0)) {
                  $motherLanguageCode = $code;
                  continue;
                }

                if (!isset($seenOtherCodes[$code])) {
                  $seenOtherCodes[$code] = true;
                  $normalizedOthers[] = ['language' => $code, 'level' => $level];
                }
              }

              if (is_array($otherLanguagesFromOld)) {
                foreach ($otherLanguagesFromOld as $otherItem) {
                  $otherCodeValue = is_array($otherItem) ? ($otherItem['language'] ?? null) : null;
                  if (!is_string($otherCodeValue) || !isset($languageCatalog[$otherCodeValue])) {
                    continue;
                  }
                  $otherLevelValue = is_array($otherItem) ? ($otherItem['level'] ?? 'B1') : 'B1';
                  if (!in_array($otherLevelValue, $cecrlLevels, true)) {
                    $otherLevelValue = 'B1';
                  }
                  if (!isset($seenOtherCodes[$otherCodeValue])) {
                    $seenOtherCodes[$otherCodeValue] = true;
                    $normalizedOthers[] = ['language' => $otherCodeValue, 'level' => $otherLevelValue];
                  }
                }
              }

              if (!$motherLanguageCode || !isset($languageCatalog[$motherLanguageCode])) {
                $motherLanguageCode = 'fr';
              }

              $normalizedOthers = array_values(array_filter($normalizedOthers, fn ($item) => ($item['language'] ?? null) !== $motherLanguageCode));
              ?>

            <div
              class="onboarding-languages-premium"
              id="onboardingLanguagesPremium"
              data-mother-initial="<?php echo e($motherLanguageCode); ?>"
              data-other-initial='<?php echo json_encode($normalizedOthers, 15, 512) ?>'
            >
              <div class="onboarding-language-row">
                <div class="onboarding-language-card">
                  <div class="onboarding-language-card-title">Ma langue maternelle</div>
                  <select id="onboardingMotherLanguage" class="form-select">
                    <?php $__currentLoopData = $languageCatalog; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $langCode => $langLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($langCode); ?>" <?php echo e($motherLanguageCode === $langCode ? 'selected' : ''); ?>><?php echo e($langLabel); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                  <p class="onboarding-language-helper">Langue principale pour votre profil.</p>
                </div>

                <div class="onboarding-language-card" style="position: relative;">
                  <div class="onboarding-language-card-title">Autres langues parlées</div>
                  <div class="onboarding-language-chips" id="onboardingLanguageChips"></div>
                  <button type="button" class="onboarding-add-language-btn" id="onboardingAddLanguageBtn">+ Ajouter</button>

                  <div class="onboarding-language-popover" id="onboardingLanguagePopover">
                    <div class="onboarding-language-table">
                      <div class="onboarding-language-table-head">
                        <span>Langue</span>
                        <span>Niveau CECRL</span>
            </div>
                      <div id="onboardingLanguageTableRows"></div>
                    </div>
                  </div>
                </div>
              </div>

              <input type="hidden" name="mother_language" id="onboardingMotherLanguageInput" value="<?php echo e($motherLanguageCode); ?>">
              <input type="hidden" name="other_languages" id="onboardingOtherLanguagesInput" value='<?php echo json_encode($normalizedOthers, 15, 512) ?>'>
              <div id="onboardingLanguagesHiddenInputs"></div>
            </div>
            <?php $__errorArgs = ['languages'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              <span class="form-error"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <?php $__errorArgs = ['mother_language'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              <span class="form-error"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>


          <!-- Actions -->
          <div class="onboarding-actions">
            <a href="<?php echo e(route('user.dashboard')); ?>" class="btn-back">
              ← Retour
            </a>
            <button type="submit" class="btn-continue">
              Sauvegarder et continuer →
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    // Compat no-op handlers for shared filters inline onclick hooks.
    if (typeof window.toggleAvailabilityPanel !== 'function') window.toggleAvailabilityPanel = function() {};
    if (typeof window.clearAvailabilitySelection !== 'function') window.clearAvailabilitySelection = function() {};
    if (typeof window.applyAvailabilityFilter !== 'function') window.applyAvailabilityFilter = function() {};

    const ONBOARDING_LANGUAGE_CATALOG = {
      fr: 'Français',
      en: 'Anglais',
      es: 'Espagnol',
      de: 'Allemand',
      it: 'Italien',
      pt: 'Portugais',
      nl: 'Néerlandais',
      ru: 'Russe',
      zh: 'Chinois',
      ar: 'Arabe',
      ja: 'Japonais',
      pl: 'Polonais',
      el: 'Grec',
      tr: 'Turc',
      sv: 'Suédois',
      ko: 'Coréen',
      hi: 'Hindi'
    };
    const ONBOARDING_CECRL_LEVELS = ['A1', 'A2', 'B1', 'B2', 'C1', 'C2'];

    function initOnboardingLanguagePremium() {
      const root = document.getElementById('onboardingLanguagesPremium');
      const form = document.querySelector('form.onboarding-form');
      if (!root || !form) return;

      const motherSelect = document.getElementById('onboardingMotherLanguage');
      const motherInput = document.getElementById('onboardingMotherLanguageInput');
      const otherInput = document.getElementById('onboardingOtherLanguagesInput');
      const chipsContainer = document.getElementById('onboardingLanguageChips');
      const addBtn = document.getElementById('onboardingAddLanguageBtn');
      const popover = document.getElementById('onboardingLanguagePopover');
      const rowsContainer = document.getElementById('onboardingLanguageTableRows');
      const hiddenContainer = document.getElementById('onboardingLanguagesHiddenInputs');
      if (!motherSelect || !motherInput || !otherInput || !chipsContainer || !addBtn || !popover || !rowsContainer || !hiddenContainer) return;

      let state = {
        mother: root.getAttribute('data-mother-initial') || motherSelect.value || 'fr',
        others: []
      };

      try {
        const initialOthers = JSON.parse(root.getAttribute('data-other-initial') || '[]');
        if (Array.isArray(initialOthers)) {
          state.others = initialOthers
            .map(item => ({
              language: item && item.language ? String(item.language) : '',
              level: item && item.level ? String(item.level) : ''
            }))
            .filter(item => item.language && ONBOARDING_LANGUAGE_CATALOG[item.language] && ONBOARDING_CECRL_LEVELS.includes(item.level));
        }
      } catch (e) {
        state.others = [];
      }

      function dedupeOthers() {
        const seen = {};
        state.others = state.others.filter(item => {
          if (!item.language || item.language === state.mother) return false;
          if (seen[item.language]) return false;
          seen[item.language] = true;
          return true;
        });
      }

      function buildHiddenInputs() {
        hiddenContainer.innerHTML = '';
        motherInput.value = state.mother;
        otherInput.value = JSON.stringify(state.others);

        const merged = [{ language: state.mother, level: 'C2', role: 'mother' }].concat(
          state.others.map(item => ({ language: item.language, level: item.level, role: 'other' }))
        );

        merged.forEach((item, index) => {
          const label = ONBOARDING_LANGUAGE_CATALOG[item.language] || item.language;
          const fields = {
            [`languages[${index}][language]`]: label,
            [`languages[${index}][code]`]: item.language,
            [`languages[${index}][level]`]: item.level,
            [`languages[${index}][role]`]: item.role
          };
          Object.keys(fields).forEach(name => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = name;
            input.value = fields[name];
            hiddenContainer.appendChild(input);
          });
        });
      }

      function renderChips() {
        chipsContainer.innerHTML = '';
        if (!state.others.length) {
          const empty = document.createElement('p');
          empty.className = 'onboarding-language-empty';
          empty.textContent = 'Ajoutez vos autres langues avec leur niveau CECRL.';
          chipsContainer.appendChild(empty);
        } else {
          state.others.forEach(item => {
            const chip = document.createElement('div');
            chip.className = 'onboarding-language-chip';
            chip.innerHTML = `
              <span>${ONBOARDING_LANGUAGE_CATALOG[item.language]} (${item.level})</span>
              <button type="button" aria-label="Supprimer ${ONBOARDING_LANGUAGE_CATALOG[item.language]}" data-remove-language="${item.language}">×</button>
            `;
            chipsContainer.appendChild(chip);
          });
        }

        const motherLabel = ONBOARDING_LANGUAGE_CATALOG[state.mother] || state.mother;
        const availableCount = Object.keys(ONBOARDING_LANGUAGE_CATALOG).filter(code => code !== state.mother && !state.others.some(item => item.language === code)).length;
        addBtn.disabled = availableCount <= 0;
        addBtn.textContent = availableCount <= 0 ? 'Toutes les langues sont déjà ajoutées' : '+ Ajouter';
        addBtn.setAttribute('aria-label', `Ajouter une autre langue que ${motherLabel}`);
      }

      function renderPopoverRows() {
        rowsContainer.innerHTML = '';
        const availableCodes = Object.keys(ONBOARDING_LANGUAGE_CATALOG).filter(code => code !== state.mother);
        availableCodes.forEach(code => {
          const current = state.others.find(item => item.language === code);
          const row = document.createElement('div');
          row.className = 'onboarding-language-table-row';
          const pills = ONBOARDING_CECRL_LEVELS.map(level => {
            const activeClass = current && current.level === level ? 'is-active' : '';
            return `<button type="button" class="onboarding-cecrl-pill ${activeClass}" data-language="${code}" data-level="${level}">${level}</button>`;
          }).join('');
          row.innerHTML = `
            <span class="onboarding-language-name">${ONBOARDING_LANGUAGE_CATALOG[code]}</span>
            <div class="onboarding-cecrl-pills">${pills}</div>
          `;
          rowsContainer.appendChild(row);
        });
      }

      function syncUI() {
        dedupeOthers();
        buildHiddenInputs();
        renderChips();
        renderPopoverRows();
      }

      function setLevelForLanguage(code, level) {
        if (!ONBOARDING_LANGUAGE_CATALOG[code] || !ONBOARDING_CECRL_LEVELS.includes(level) || code === state.mother) return;
        const existing = state.others.find(item => item.language === code);
        if (existing) {
          existing.level = level;
        } else {
          state.others.push({ language: code, level: level });
        }
        syncUI();
      }

      function removeLanguage(code) {
        state.others = state.others.filter(item => item.language !== code);
        syncUI();
      }

      motherSelect.addEventListener('change', function() {
        const nextMother = this.value;
        if (!ONBOARDING_LANGUAGE_CATALOG[nextMother]) return;
        state.mother = nextMother;
        state.others = state.others.filter(item => item.language !== nextMother);
        syncUI();
      });

      addBtn.addEventListener('click', function() {
        popover.classList.toggle('is-open');
      });

      rowsContainer.addEventListener('click', function(event) {
        const target = event.target;
        if (!(target instanceof HTMLElement) || !target.classList.contains('onboarding-cecrl-pill')) return;
        setLevelForLanguage(target.getAttribute('data-language'), target.getAttribute('data-level'));
      });

      chipsContainer.addEventListener('click', function(event) {
        const target = event.target;
        if (!(target instanceof HTMLElement)) return;
        const removeBtn = target.closest('[data-remove-language]');
        if (removeBtn) {
          removeLanguage(removeBtn.getAttribute('data-remove-language'));
        }
      });

      document.addEventListener('click', function(event) {
        if (!root.contains(event.target)) {
          popover.classList.remove('is-open');
        }
      });

      form.addEventListener('submit', function(event) {
        if (!state.mother || !ONBOARDING_LANGUAGE_CATALOG[state.mother]) {
          event.preventDefault();
          motherSelect.focus();
          return;
        }
        buildHiddenInputs();
      });

      syncUI();
    }

    function initOnboardingScopePremium() {
      const root = document.getElementById('onboardingScopePremium');
      const form = document.querySelector('form.onboarding-form');
      if (!root || !form) return;

      const universesMap = JSON.parse(root.getAttribute('data-universes') || '{}');
      const domainsByUniverse = JSON.parse(root.getAttribute('data-domains') || '{}');
      const specializationsByDomain = JSON.parse(root.getAttribute('data-specializations') || '{}');
      const countriesMap = JSON.parse(root.getAttribute('data-countries') || '{}');
      const citiesByCountry = JSON.parse(root.getAttribute('data-cities') || '{}');

      const universeTrigger = document.getElementById('scopeUniverseTrigger');
      const universeTriggerText = document.getElementById('scopeUniverseTriggerText');
      const universeMenu = document.getElementById('scopeUniverseMenu');
      const universeChips = document.getElementById('scopeUniverseChips');
      const universeMirror = document.getElementById('scopeUniversesMirror');

      const domainTrigger = document.getElementById('scopeDomainTrigger');
      const domainTriggerText = document.getElementById('scopeDomainTriggerText');
      const domainMenu = document.getElementById('scopeDomainMenu');
      const domainHelper = document.getElementById('scopeDomainHelper');
      const domainChips = document.getElementById('scopeDomainChips');
      const domainMirror = document.getElementById('scopeDomainsMirror');
      const primarySpecializationSelect = document.getElementById('scopePrimarySpecialization');
      const additionalTrigger = document.getElementById('scopeAdditionalSpecializationsTrigger');
      const additionalTriggerText = document.getElementById('scopeAdditionalSpecializationsTriggerText');
      const additionalMenu = document.getElementById('scopeAdditionalSpecializationsMenu');
      const additionalChips = document.getElementById('scopeAdditionalSpecializationsChips');
      const specializationHelper = document.getElementById('scopeSpecializationHelper');
      const specializationFeedback = document.getElementById('scopeSpecializationFeedback');

      const modeInput = document.getElementById('scopeModeInput');
      const modeSegment = document.getElementById('scopeModeSegment');
      const locationRow = document.getElementById('scopeLocationRow');
      const countrySelect = document.getElementById('scopeCountrySelect');
      const citySelect = document.getElementById('scopeCitySelect');
      const preview = document.getElementById('scopeMirrorPreview');
      const hiddenInputs = document.getElementById('scopeHiddenInputs');

      if (!universeTrigger || !universeMenu || !domainTrigger || !domainMenu || !modeInput || !modeSegment || !countrySelect || !citySelect || !preview || !hiddenInputs || !primarySpecializationSelect || !additionalTrigger || !additionalMenu || !additionalChips) return;

      let state = {
        universes: [],
        domains: [],
        specializationMain: '',
        specializationAdditional: [],
        mode: (root.getAttribute('data-selected-mode') || 'online'),
        country: root.getAttribute('data-selected-country') || '',
        city: root.getAttribute('data-selected-city') || ''
      };
      try {
        const selectedUniverses = JSON.parse(root.getAttribute('data-selected-universes') || '[]');
        const selectedDomains = JSON.parse(root.getAttribute('data-selected-domains') || '[]');
        const selectedAdditional = JSON.parse(root.getAttribute('data-selected-specialization-additional') || '[]');
        const selectedMain = root.getAttribute('data-selected-specialization-main') || '';
        if (Array.isArray(selectedUniverses)) state.universes = selectedUniverses.filter(u => universesMap[u]);
        if (Array.isArray(selectedDomains)) state.domains = selectedDomains;
        if (typeof selectedMain === 'string') state.specializationMain = selectedMain;
        if (Array.isArray(selectedAdditional)) state.specializationAdditional = selectedAdditional.filter(v => typeof v === 'string' && v !== '');
      } catch (e) {}

      function getAllowedDomains() {
        const allowed = [];
        state.universes.forEach(u => {
          (domainsByUniverse[u] || []).forEach(row => {
            if (Array.isArray(row) && row[0] && row[1]) {
              if (!allowed.some(item => item.slug === row[0])) {
                allowed.push({ slug: row[0], label: row[1], universe: u });
              }
        }
      });
    });
        return allowed;
      }

      function buildHiddenInputs() {
        hiddenInputs.innerHTML = '';
        universeMirror.value = JSON.stringify(state.universes);
        domainMirror.value = JSON.stringify(state.domains);

        state.universes.forEach((slug, idx) => {
          const input = document.createElement('input');
          input.type = 'hidden';
          input.name = `universes[${idx}]`;
          input.value = slug;
          hiddenInputs.appendChild(input);
        });
        state.domains.forEach((slug, idx) => {
          const input = document.createElement('input');
          input.type = 'hidden';
          input.name = `domains[${idx}]`;
          input.value = slug;
          hiddenInputs.appendChild(input);
        });
        if (state.specializationMain) {
          const mainInput = document.createElement('input');
          mainInput.type = 'hidden';
          mainInput.name = 'specialization_main';
          mainInput.value = state.specializationMain;
          hiddenInputs.appendChild(mainInput);
        }
        state.specializationAdditional.forEach((slug, idx) => {
          const input = document.createElement('input');
          input.type = 'hidden';
          input.name = `specialization_additional[${idx}]`;
          input.value = slug;
          hiddenInputs.appendChild(input);
        });
      }

      function getAllowedSpecializationsByDomain() {
        const byDomain = {};
        state.domains.forEach(domainSlug => {
          const group = specializationsByDomain[domainSlug];
          if (!group || !Array.isArray(group.options)) return;
          byDomain[domainSlug] = {
            label: group.label || domainSlug,
            options: group.options.filter(row => Array.isArray(row) && row[0] && row[1]).map(row => ({ slug: row[0], label: row[1] })),
          };
        });
        return byDomain;
      }

      function getAllowedSpecializationSlugSet() {
        const set = new Set();
        const byDomain = getAllowedSpecializationsByDomain();
        Object.keys(byDomain).forEach(domainSlug => {
          byDomain[domainSlug].options.forEach(opt => set.add(opt.slug));
        });
        return set;
      }

      function renderUniverseMenu() {
        universeMenu.innerHTML = '';
        Object.keys(universesMap).forEach(slug => {
          const checked = state.universes.includes(slug) ? 'checked' : '';
          const row = document.createElement('label');
          row.className = 'onboarding-scope-option';
          row.innerHTML = `
            <input type="checkbox" value="${slug}" ${checked}>
            <span>${universesMap[slug]}</span>
          `;
          universeMenu.appendChild(row);
        });
      }

      function renderDomainMenu() {
        const allowed = getAllowedDomains();
        domainMenu.innerHTML = '';
        if (!allowed.length) {
          domainTrigger.disabled = true;
          domainHelper.style.display = 'block';
          domainHelper.textContent = 'Commencez par choisir un univers.';
          domainTriggerText.textContent = 'Commencez par choisir un univers';
          return;
        }
        domainTrigger.disabled = false;
        domainHelper.style.display = 'block';
        domainHelper.textContent = state.universes.length > 1
          ? 'Domaines combinés des univers sélectionnés.'
          : 'Choisissez les domaines de cet univers.';
        domainTriggerText.textContent = state.domains.length ? `${state.domains.length} domaine(s) sélectionné(s)` : 'Sélectionner un ou plusieurs domaines';

        allowed.forEach(item => {
          const checked = state.domains.includes(item.slug) ? 'checked' : '';
          const row = document.createElement('label');
          row.className = 'onboarding-scope-option';
          row.innerHTML = `
            <input type="checkbox" value="${item.slug}" ${checked}>
            <span>${item.label}</span>
            <small>${universesMap[item.universe] || ''}</small>
          `;
          domainMenu.appendChild(row);
        });
      }

      function renderChips() {
        universeChips.innerHTML = '';
        domainChips.innerHTML = '';
        additionalChips.innerHTML = '';

        if (state.universes.length) {
          state.universes.forEach(slug => {
            const chip = document.createElement('span');
            chip.className = 'onboarding-scope-chip';
            chip.innerHTML = `${universesMap[slug]} <button type="button" data-remove-universe="${slug}">×</button>`;
            universeChips.appendChild(chip);
          });
          universeTriggerText.textContent = `${state.universes.length} univers sélectionné(s)`;
        } else {
          universeTriggerText.textContent = 'Sélectionner un ou plusieurs univers';
        }

        const domainLookup = {};
        Object.keys(domainsByUniverse).forEach(u => {
          (domainsByUniverse[u] || []).forEach(row => {
            if (Array.isArray(row) && row[0] && row[1]) domainLookup[row[0]] = row[1];
          });
        });
        state.domains.forEach(slug => {
          const chip = document.createElement('span');
          chip.className = 'onboarding-scope-chip';
          chip.innerHTML = `${domainLookup[slug] || slug} <button type="button" data-remove-domain="${slug}">×</button>`;
          domainChips.appendChild(chip);
        });

        const allowedByDomain = getAllowedSpecializationsByDomain();
        const specLabelLookup = {};
        Object.keys(allowedByDomain).forEach(domainSlug => {
          allowedByDomain[domainSlug].options.forEach(opt => {
            specLabelLookup[opt.slug] = opt.label;
          });
        });
        const chipsToShow = state.specializationAdditional.slice(0, 6);
        chipsToShow.forEach(slug => {
          const chip = document.createElement('span');
          chip.className = 'onboarding-scope-chip';
          chip.innerHTML = `${specLabelLookup[slug] || slug} <button type="button" data-remove-additional-specialization="${slug}">×</button>`;
          additionalChips.appendChild(chip);
        });
        const extraCount = state.specializationAdditional.length - chipsToShow.length;
        if (extraCount > 0) {
          const more = document.createElement('span');
          more.className = 'onboarding-scope-chip';
          more.textContent = `+${extraCount}`;
          additionalChips.appendChild(more);
        }
      }

      function renderMode() {
        modeSegment.querySelectorAll('.onboarding-mode-btn').forEach(btn => {
          btn.classList.toggle('is-active', btn.getAttribute('data-mode') === state.mode);
        });
        modeInput.value = state.mode;
        const withLocation = state.mode === 'onsite' || state.mode === 'hybrid';
        locationRow.style.display = withLocation ? 'grid' : 'none';
        if (!withLocation) {
          state.country = '';
          state.city = '';
          countrySelect.value = '';
          citySelect.innerHTML = '<option value="">Ville</option>';
          citySelect.value = '';
        }
      }

      function renderCountries() {
        const current = state.country;
        countrySelect.innerHTML = '<option value="">Pays</option>';
        Object.keys(countriesMap).forEach(code => {
          const option = document.createElement('option');
          option.value = code;
          option.textContent = countriesMap[code];
          if (code === current) option.selected = true;
          countrySelect.appendChild(option);
        });
      }

      function renderCities() {
        const cities = citiesByCountry[state.country] || [];
        citySelect.innerHTML = '<option value="">Ville</option>';
        cities.forEach(city => {
          const option = document.createElement('option');
          option.value = city;
          option.textContent = city;
          if (city === state.city) option.selected = true;
          citySelect.appendChild(option);
        });
      }

      function renderPreview() {
        const selectedUniverseLabels = state.universes.map(u => universesMap[u]).join(' & ') || 'Aucun univers';
        const domainLookup = {};
        Object.keys(domainsByUniverse).forEach(u => {
          (domainsByUniverse[u] || []).forEach(row => {
            if (Array.isArray(row) && row[0] && row[1]) domainLookup[row[0]] = row[1];
          });
        });
        const domainLabels = state.domains.map(d => domainLookup[d] || d).join(', ') || 'Aucun domaine';
        const modeLabel = state.mode === 'onsite' ? 'En présentiel' : (state.mode === 'hybrid' ? 'Hybride' : 'En ligne');
        const locationLabel = (state.mode === 'onsite' || state.mode === 'hybrid')
          ? ((countriesMap[state.country] || 'Pays ?') + (state.city ? `, ${state.city}` : ', ville à préciser'))
          : 'Sans localisation présentielle';
        preview.textContent = `Vous apparaîtrez pour : ${selectedUniverseLabels} • ${domainLabels} • ${modeLabel} • ${locationLabel}`;
      }

      function sanitizeDomainSelection() {
        const allowedSlugs = getAllowedDomains().map(item => item.slug);
        state.domains = state.domains.filter(d => allowedSlugs.includes(d));
      }

      function sanitizeSpecializationSelection() {
        const allowedSet = getAllowedSpecializationSlugSet();
        const hadMain = state.specializationMain !== '';
        const beforeAdditional = state.specializationAdditional.length;
        if (!allowedSet.has(state.specializationMain)) {
          state.specializationMain = '';
        }
        state.specializationAdditional = state.specializationAdditional.filter(s => allowedSet.has(s));
        if (state.specializationMain) {
          state.specializationAdditional = state.specializationAdditional.filter(s => s !== state.specializationMain);
        }
        const removedCount = (hadMain ? 1 : 0) + beforeAdditional - ((state.specializationMain ? 1 : 0) + state.specializationAdditional.length);
        if (removedCount > 0 && specializationFeedback) {
          specializationFeedback.style.display = 'block';
          specializationFeedback.textContent = 'Certaines spécialisations ont été retirées car leur domaine n’est plus sélectionné.';
        } else if (specializationFeedback) {
          specializationFeedback.style.display = 'none';
        }
      }

      function renderPrimarySpecialization() {
        const allowedByDomain = getAllowedSpecializationsByDomain();
        const hasDomains = Object.keys(allowedByDomain).length > 0;
        primarySpecializationSelect.innerHTML = '<option value="">Sélectionner une spécialisation</option>';
        if (!hasDomains) {
          primarySpecializationSelect.disabled = true;
          return;
        }
        primarySpecializationSelect.disabled = false;
        Object.keys(allowedByDomain).forEach(domainSlug => {
          const group = allowedByDomain[domainSlug];
          const optgroup = document.createElement('optgroup');
          optgroup.label = group.label;
          group.options.forEach(opt => {
            const option = document.createElement('option');
            option.value = opt.slug;
            option.textContent = opt.label;
            if (opt.slug === state.specializationMain) option.selected = true;
            optgroup.appendChild(option);
          });
          primarySpecializationSelect.appendChild(optgroup);
        });
      }

      function renderAdditionalSpecializationsMenu() {
        const allowedByDomain = getAllowedSpecializationsByDomain();
        const hasDomains = Object.keys(allowedByDomain).length > 0;
        additionalMenu.innerHTML = '';
        additionalTrigger.disabled = !hasDomains;
        if (!hasDomains) {
          additionalTriggerText.textContent = 'Choisissez d’abord un ou plusieurs domaines.';
          specializationHelper.style.display = 'block';
          specializationHelper.textContent = 'Choisissez d’abord un ou plusieurs domaines.';
          return;
        }
        additionalTriggerText.textContent = state.specializationAdditional.length
          ? `${state.specializationAdditional.length} sélectionnée(s)`
          : 'Ajouter des spécialisations';
        specializationHelper.style.display = 'block';
        specializationHelper.textContent = 'Sélection multi pour enrichir votre matching.';

        const searchWrap = document.createElement('div');
        searchWrap.className = 'onboarding-specialization-search';
        const searchInput = document.createElement('input');
        searchInput.type = 'text';
        searchInput.placeholder = 'Rechercher une spécialisation';
        searchWrap.appendChild(searchInput);
        additionalMenu.appendChild(searchWrap);

        Object.keys(allowedByDomain).forEach(domainSlug => {
          const group = allowedByDomain[domainSlug];
          const selectedCount = group.options.filter(opt => state.specializationAdditional.includes(opt.slug)).length;
          const section = document.createElement('div');
          section.className = 'onboarding-specialization-group';
          section.setAttribute('data-domain-group', domainSlug);
          const title = document.createElement('div');
          title.className = 'onboarding-specialization-group-title';
          title.innerHTML = `<span>${group.label}</span><span>(${selectedCount})</span>`;
          section.appendChild(title);
          group.options.forEach(opt => {
            const row = document.createElement('label');
            row.className = 'onboarding-scope-option';
            row.setAttribute('data-spec-search', `${group.label} ${opt.label}`.toLowerCase());
            row.innerHTML = `<input type="checkbox" value="${opt.slug}" ${state.specializationAdditional.includes(opt.slug) ? 'checked' : ''}><span>${opt.label}</span>`;
            section.appendChild(row);
          });
          additionalMenu.appendChild(section);
        });

        searchInput.addEventListener('input', function() {
          const q = (searchInput.value || '').trim().toLowerCase();
          additionalMenu.querySelectorAll('.onboarding-specialization-group').forEach(group => {
            let visible = 0;
            group.querySelectorAll('.onboarding-scope-option').forEach(row => {
              const txt = row.getAttribute('data-spec-search') || '';
              const show = q === '' || txt.includes(q);
              row.style.display = show ? 'flex' : 'none';
              if (show) visible++;
            });
            group.style.display = visible ? 'block' : 'none';
          });
        });
      }

      function syncUI() {
        sanitizeDomainSelection();
        sanitizeSpecializationSelection();
        renderUniverseMenu();
        renderDomainMenu();
        renderPrimarySpecialization();
        renderAdditionalSpecializationsMenu();
        renderChips();
        renderMode();
        renderCountries();
        renderCities();
        renderPreview();
        buildHiddenInputs();
        window.__onboardingSelectedUniverses = state.universes.slice();
        document.dispatchEvent(new CustomEvent('onboarding:scopeChanged', { detail: { universes: state.universes.slice() } }));
      }

      universeTrigger.addEventListener('click', function() {
        universeMenu.classList.toggle('is-open');
      });
      domainTrigger.addEventListener('click', function() {
        if (domainTrigger.disabled) return;
        domainMenu.classList.toggle('is-open');
      });
      universeMenu.addEventListener('change', function(event) {
        const target = event.target;
        if (!(target instanceof HTMLInputElement)) return;
        const slug = target.value;
        if (target.checked) {
          if (!state.universes.includes(slug)) state.universes.push(slug);
        } else {
          state.universes = state.universes.filter(u => u !== slug);
        }
        syncUI();
      });
      domainMenu.addEventListener('change', function(event) {
        const target = event.target;
        if (!(target instanceof HTMLInputElement)) return;
        const slug = target.value;
        if (target.checked) {
          if (!state.domains.includes(slug)) state.domains.push(slug);
        } else {
          state.domains = state.domains.filter(d => d !== slug);
        }
        syncUI();
      });
      universeChips.addEventListener('click', function(event) {
        const target = event.target;
        if (!(target instanceof HTMLElement)) return;
        const btn = target.closest('[data-remove-universe]');
        if (!btn) return;
        const slug = btn.getAttribute('data-remove-universe');
        state.universes = state.universes.filter(u => u !== slug);
        syncUI();
      });
      domainChips.addEventListener('click', function(event) {
        const target = event.target;
        if (!(target instanceof HTMLElement)) return;
        const btn = target.closest('[data-remove-domain]');
        if (!btn) return;
        const slug = btn.getAttribute('data-remove-domain');
        state.domains = state.domains.filter(d => d !== slug);
        syncUI();
      });
      primarySpecializationSelect.addEventListener('change', function() {
        state.specializationMain = this.value || '';
        state.specializationAdditional = state.specializationAdditional.filter(s => s !== state.specializationMain);
        syncUI();
      });
      additionalTrigger.addEventListener('click', function() {
        if (additionalTrigger.disabled) return;
        additionalMenu.classList.toggle('is-open');
      });
      additionalMenu.addEventListener('change', function(event) {
        const target = event.target;
        if (!(target instanceof HTMLInputElement)) return;
        const slug = target.value;
        if (target.checked) {
          if (!state.specializationAdditional.includes(slug)) state.specializationAdditional.push(slug);
        } else {
          state.specializationAdditional = state.specializationAdditional.filter(s => s !== slug);
        }
        state.specializationAdditional = state.specializationAdditional.filter(s => s !== state.specializationMain);
        syncUI();
        additionalMenu.classList.add('is-open');
      });
      additionalChips.addEventListener('click', function(event) {
        const target = event.target;
        if (!(target instanceof HTMLElement)) return;
        const btn = target.closest('[data-remove-additional-specialization]');
        if (!btn) return;
        const slug = btn.getAttribute('data-remove-additional-specialization');
        state.specializationAdditional = state.specializationAdditional.filter(s => s !== slug);
        syncUI();
      });
      modeSegment.addEventListener('click', function(event) {
        const target = event.target;
        if (!(target instanceof HTMLElement)) return;
        const btn = target.closest('.onboarding-mode-btn');
        if (!btn) return;
        state.mode = btn.getAttribute('data-mode') || 'online';
        syncUI();
      });
      countrySelect.addEventListener('change', function() {
        state.country = this.value;
        state.city = '';
        syncUI();
      });
      citySelect.addEventListener('change', function() {
        state.city = this.value;
        syncUI();
      });
      document.addEventListener('click', function(event) {
        if (!root.contains(event.target)) {
          universeMenu.classList.remove('is-open');
          domainMenu.classList.remove('is-open');
          additionalMenu.classList.remove('is-open');
        }
      });
      form.addEventListener('submit', function() {
        buildHiddenInputs();
      });

      if (!['online', 'onsite', 'hybrid'].includes(state.mode)) state.mode = 'online';
      syncUI();
    }

    function initUniverseMatchingPanels() {
      const root = document.getElementById('onboardingUniverseMirrorRoot');
      if (!root) return;
      const empty = document.getElementById('matchingFiltersEmpty');
      const allPanels = Array.from(root.querySelectorAll('[data-universe-panel]'));
      const supportedFields = null; // Deprecated list kept for backward compat; dynamic collection is used below.

      function prefillPanel(panel) {
        const raw = panel.getAttribute('data-matching-payload');
        if (!raw) return;
        let payload = {};
        try { payload = JSON.parse(raw); } catch (e) { payload = {}; }
        if (!payload || typeof payload !== 'object') return;
        Object.keys(payload).forEach(key => {
          const value = payload[key];
          if (Array.isArray(value)) {
            value.forEach(v => {
              const option = panel.querySelector(`input[name="${key}[]"][value="${v}"]`);
              if (option) option.checked = true;
            });
          } else {
            const field = panel.querySelector(`[name="${key}"]`);
            if (!field) return;
            if (field instanceof HTMLInputElement && (field.type === 'checkbox' || field.type === 'radio')) {
              field.checked = String(field.value) === String(value);
            } else {
              field.value = value;
            }
          }
        });
      }

      function stripExpertFilter(panel) {
        const expertTrigger = panel.querySelector('#categoryFilterTrigger');
        if (!expertTrigger) return;
        const advanced = expertTrigger.closest('.preply-filter-advanced');
        if (advanced) advanced.remove();
      }

      function serializePanel(panel) {
        const universe = panel.getAttribute('data-onboarding-filters');
        if (!universe) return;
        const hiddenRoot = panel.querySelector('[data-onboarding-matching-hidden]');
        if (!hiddenRoot) return;
        hiddenRoot.innerHTML = '';

        const payload = {};
        const elements = panel.querySelectorAll('input[name], select[name], textarea[name]');
        elements.forEach(el => {
          if (el.disabled) return;
          const name = el.name || '';
          if (!name) return;
          const isArray = name.endsWith('[]');
          const key = isArray ? name.slice(0, -2) : name;
          const type = (el.type || '').toLowerCase();
          const isCheckbox = type === 'checkbox';
          const isRadio = type === 'radio';

          if ((isCheckbox || isRadio) && !el.checked) return;

          const value = el.value;
          if (value === '' && !(isCheckbox || isRadio)) return;

          if (isArray) {
            if (!Array.isArray(payload[key])) payload[key] = [];
            payload[key].push(value);
          } else {
            payload[key] = value;
          }
        });

        Object.keys(payload).forEach(key => {
          const value = payload[key];
          if (Array.isArray(value)) {
            value.filter(v => v !== '').forEach(v => {
              const input = document.createElement('input');
              input.type = 'hidden';
              input.name = `matching_filters[${universe}][${key}][]`;
              input.value = v;
              hiddenRoot.appendChild(input);
            });
            return;
          }
          if (value === '') return;
          const input = document.createElement('input');
          input.type = 'hidden';
          input.name = `matching_filters[${universe}][${key}]`;
          input.value = String(value);
          hiddenRoot.appendChild(input);
        });
      }

      function initPanelControls(panel) {
        function getExpressMultiplier(scope) {
          const input = scope.querySelector('[data-express-input]');
          const v = input ? (input.value || 'none') : 'none';
          return v === '24' ? 1.3 : (v === '48' ? 1.2 : (v === '72' ? 1.1 : 1));
        }
        function bindExpressOptions(scope, onChange) {
          const wrap = scope.querySelector('[data-express-options]');
          if (!wrap) return;
          const micro = wrap.querySelector('[data-express-micro]');
          const pricingInput = wrap.querySelector('[data-express-input]');
          const tags = wrap.querySelector('[data-express-tags]');
          const pct = { none: 0, '72': 10, '48': 20, '24': 30 };

          // Assure la présence de cases cachées pour basculer en multi même si le cache vue est ancien.
          function ensureCheckboxes() {
            const existing = wrap.querySelectorAll('[data-express-checkbox]');
            if (existing.length) return existing;
            const values = ['72', '48', '24'];
            values.forEach(function(val) {
              const cb = document.createElement('input');
              cb.type = 'checkbox';
              cb.name = 'express[]';
              cb.value = val;
              cb.setAttribute('data-express-checkbox', '');
              cb.style.display = 'none';
              wrap.appendChild(cb);
            });
            return wrap.querySelectorAll('[data-express-checkbox]');
          }

          const optionBtns = wrap.querySelectorAll('[data-express-option]');
          const noneBtn = wrap.querySelector('[data-express-none]');
          const checkboxes = ensureCheckboxes();

          const refresh = () => {
            const selected = Array.from(checkboxes)
              .filter(cb => cb.checked)
              .map(cb => cb.value);
            const selectedSet = new Set(selected);

            optionBtns.forEach(btn => {
              const val = btn.getAttribute('data-express') || '';
              const isActive = selectedSet.has(val);
              btn.classList.toggle('is-selected', isActive);
              btn.setAttribute('aria-pressed', isActive ? 'true' : 'false');
            });

            if (noneBtn) {
              const isNone = selected.length === 0;
              noneBtn.classList.toggle('is-selected', isNone);
              noneBtn.setAttribute('aria-pressed', isNone ? 'true' : 'false');
            }

            if (pricingInput) {
              const pricing = selectedSet.has('24') ? '24' : (selectedSet.has('48') ? '48' : (selectedSet.has('72') ? '72' : 'none'));
              pricingInput.value = pricing;
            }

            if (micro) {
              if (!selected.length) {
                micro.textContent = 'Standard : aucun supplément';
              } else {
                const labels = selected.map(v => `${v}h (+${pct[v] || 0}%)`);
                const maxPct = Math.max(...selected.map(v => pct[v] || 0));
                micro.textContent = `Options Express sélectionnées : ${labels.join(', ')} — supplément max : +${maxPct}%`;
              }
            }

            if (tags) {
              tags.innerHTML = '';
              if (!selected.length) {
                tags.style.display = 'none';
              } else {
                tags.style.display = 'flex';
                selected.forEach(function(val) {
                  const chip = document.createElement('span');
                  chip.setAttribute('data-express-chip', val);
                  chip.style.display = 'inline-flex';
                  chip.style.alignItems = 'center';
                  chip.style.gap = '4px';
                  chip.style.padding = '2px 8px';
                  chip.style.borderRadius = '999px';
                  chip.style.background = '#EEF2FF';
                  chip.style.color = '#4338CA';
                  chip.style.fontSize = '10px';
                  const label = document.createElement('span');
                  label.textContent = `${val}h (+${pct[val] || 0}%)`;
                  const close = document.createElement('button');
                  close.type = 'button';
                  close.textContent = 'x';
                  close.style.border = 'none';
                  close.style.background = 'transparent';
                  close.style.cursor = 'pointer';
                  close.style.color = '#4338CA';
                  close.style.fontSize = '10px';
                  close.addEventListener('click', function(e) {
                    e.preventDefault();
                    const cb = wrap.querySelector(`[data-express-checkbox][value="${val}"]`);
                    if (cb) cb.checked = false;
                    refresh();
                  });
                  chip.appendChild(label);
                  chip.appendChild(close);
                  tags.appendChild(chip);
                });
              }
            }

            if (typeof onChange === 'function') onChange();
          };

          if (noneBtn) {
            noneBtn.addEventListener('click', function(e) {
              e.preventDefault();
              checkboxes.forEach(cb => { cb.checked = false; });
              refresh();
            });
          }

          optionBtns.forEach(btn => {
            btn.addEventListener('click', function(e) {
              e.preventDefault();
              const val = btn.getAttribute('data-express') || '';
              const cb = wrap.querySelector(`[data-express-checkbox][value="${val}"]`);
              if (!cb) return;
              cb.checked = !cb.checked;
              refresh();
            });
          });

          refresh();
        }
        const domainTrigger = panel.querySelector('#domainDropdownTrigger');
        const domainMenu = panel.querySelector('#domainDropdownMenu');
        const domainInput = panel.querySelector('#domainInput');
        const domainText = panel.querySelector('#domainSelectedText');
        const domainDesc = panel.querySelector('#domainPremiumDesc');
        const specWrapper = panel.querySelector('#specializationFilterWrapper');
        const specSelect = panel.querySelector('#specializationSelect');
        const domainWrapper = panel.querySelector('.domain-dropdown-wrapper');

        const descriptionMap = domainDesc ? JSON.parse(domainDesc.getAttribute('data-domain-descriptions') || '{}') : {};
        const specializationMap = specWrapper ? JSON.parse(specWrapper.getAttribute('data-domain-specializations') || '{}') : {};

        function populateSpecs(domainSlug, keepValue) {
          if (!specWrapper || !specSelect) return;
          const options = Array.isArray(specializationMap[domainSlug]) ? specializationMap[domainSlug] : [];
          if (!options.length) {
            specWrapper.style.display = 'none';
            specSelect.innerHTML = '<option value="">Spécialisation</option>';
            return;
          }
          specWrapper.style.display = '';
          specSelect.innerHTML = '<option value="">Spécialisation</option>';
          options.forEach(function(opt) {
            const o = document.createElement('option');
            o.value = Array.isArray(opt) ? (opt[0] || '') : '';
            o.textContent = Array.isArray(opt) ? (opt[1] || opt[0] || '') : '';
            specSelect.appendChild(o);
          });
          if (keepValue) specSelect.value = keepValue;
        }

        function initDomainAsNativeSelect() {
          if (!domainWrapper || !domainMenu || !domainInput) return;
          if (domainWrapper.querySelector('[data-onboarding-domain-native]')) return;

          const native = document.createElement('select');
          native.className = 'preply-filter-select';
          native.setAttribute('data-onboarding-domain-native', '1');

          const options = domainMenu.querySelectorAll('.domain-option');
          options.forEach(function(option) {
            const value = option.getAttribute('data-value') || '';
            const labelNode = option.querySelector('.domain-option-label') || option.querySelector('span') || option;
            const text = (labelNode.textContent || 'Tous les domaines').trim();
            const opt = document.createElement('option');
            opt.value = value;
            opt.textContent = text || 'Tous les domaines';
            native.appendChild(opt);
          });

          native.value = domainInput.value || '';
          native.addEventListener('change', function() {
            const value = native.value || '';
            domainInput.value = value;
            if (domainText) {
              const current = native.options[native.selectedIndex];
              domainText.textContent = current ? current.textContent : 'Tous les domaines';
            }
            if (domainDesc) {
              const descText = descriptionMap[value];
              const textNode = panel.querySelector('#domainPremiumDescText');
              if (descText && textNode) {
                textNode.textContent = descText;
                domainDesc.style.display = 'block';
              } else {
                domainDesc.style.display = 'none';
              }
            }
            populateSpecs(value, '');
            serializePanel(panel);
          });

          if (domainTrigger) domainTrigger.style.display = 'none';
          domainMenu.style.display = 'none';
          domainMenu.style.visibility = 'hidden';
          domainMenu.style.pointerEvents = 'none';
          domainWrapper.appendChild(native);
        }

        initDomainAsNativeSelect();

        if (domainTrigger && domainMenu) {
          domainTrigger.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            const isOpen = domainMenu.style.display === 'block';
            domainMenu.style.display = isOpen ? 'none' : 'block';
            domainTrigger.classList.toggle('active', !isOpen);
          });
          domainMenu.querySelectorAll('.domain-option').forEach(function(option) {
            option.addEventListener('click', function(e) {
              e.preventDefault();
              e.stopPropagation();
              const value = option.getAttribute('data-value') || '';
              const labelNode = option.querySelector('.domain-option-label') || option.querySelector('span') || option;
              const text = (labelNode.textContent || 'Tous les domaines').trim();
              if (domainInput) domainInput.value = value;
              if (domainText) domainText.textContent = text || 'Tous les domaines';
              domainMenu.querySelectorAll('.domain-option').forEach(function(el) { el.classList.remove('selected'); });
              option.classList.add('selected');
              if (domainDesc) {
                const descText = descriptionMap[value];
                const textNode = panel.querySelector('#domainPremiumDescText');
                if (descText && textNode) {
                  textNode.textContent = descText;
                  domainDesc.style.display = 'block';
                } else {
                  domainDesc.style.display = 'none';
                }
              }
              populateSpecs(value, '');
              domainMenu.style.display = 'none';
              domainTrigger.classList.remove('active');
              serializePanel(panel);
            });
          });

          const existingDomain = domainInput ? (domainInput.value || '') : '';
          const existingSpec = specSelect ? (specSelect.value || '') : '';
          populateSpecs(existingDomain, existingSpec);
        }

        const expTrigger = panel.querySelector('#experienceDropdownTrigger');
        const expMenu = panel.querySelector('#experienceDropdownMenu');
        const expInput = panel.querySelector('#experienceLevelInput');
        const expText = panel.querySelector('#experienceSelectedText');
        if (expTrigger && expMenu && expInput) {
          expTrigger.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            expMenu.style.display = expMenu.style.display === 'block' ? 'none' : 'block';
          });
          expMenu.querySelectorAll('.experience-option').forEach(function(option) {
            option.addEventListener('click', function(e) {
              e.preventDefault();
              const value = option.getAttribute('data-value') || '';
              expInput.value = value;
              if (expText) expText.textContent = (option.textContent || '').trim();
              expMenu.style.display = 'none';
              serializePanel(panel);
            });
          });
        }

        const availabilityTrigger = panel.querySelector('.preply-availability-trigger');
        const availabilityPanel = panel.querySelector('#availabilityPanel');
        if (availabilityTrigger && availabilityPanel) {
          let hiddenInput = panel.querySelector('input[name="availability"]');
          if (!hiddenInput) {
            hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'availability';
            availabilityPanel.parentElement.appendChild(hiddenInput);
          }

          if (!hiddenInput.value) {
            try {
              const payload = JSON.parse(panel.getAttribute('data-matching-payload') || '{}');
              if (payload && typeof payload === 'object' && typeof payload.availability === 'string') {
                hiddenInput.value = payload.availability;
              }
            } catch (e) {}
          }

          function updateAvailabilityLabel() {
            const activeTimes = availabilityPanel.querySelectorAll('.availability-time-btn.active').length;
            const persistedTimes = (hiddenInput.value || '').split(',').map(v => v.trim()).filter(Boolean).length;
            const total = activeTimes || persistedTimes;
            const label = availabilityTrigger.querySelector('.availability-selected-text');
            if (!label) return;
            label.textContent = total ? `${total} créneau(x) sélectionné(s)` : 'Toutes les heures';
          }

          availabilityTrigger.addEventListener('click', function(e) {
            e.preventDefault();
            availabilityPanel.classList.toggle('active');
          });
          availabilityPanel.querySelectorAll('.availability-time-btn, .availability-day-btn').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
              e.preventDefault();
              btn.classList.toggle('active');
            });
          });
          const clearBtn = availabilityPanel.querySelector('.availability-clear-btn');
          if (clearBtn) {
            clearBtn.addEventListener('click', function(e) {
              e.preventDefault();
              availabilityPanel.querySelectorAll('.availability-time-btn.active, .availability-day-btn.active').forEach(function(el) {
                el.classList.remove('active');
              });
              hiddenInput.value = '';
              updateAvailabilityLabel();
              serializePanel(panel);
            });
          }
          const applyBtn = availabilityPanel.querySelector('.availability-apply-btn');
          if (applyBtn) {
            applyBtn.addEventListener('click', function(e) {
              e.preventDefault();
              const times = Array.from(availabilityPanel.querySelectorAll('.availability-time-btn.active')).map(function(el) {
                return el.getAttribute('data-time');
              }).filter(Boolean);
              hiddenInput.value = times.join(',');
              updateAvailabilityLabel();
              availabilityPanel.classList.remove('active');
              serializePanel(panel);
            });
          }
          updateAvailabilityLabel();
        }

        const projectsRituel = panel.querySelector('[data-onboarding-projects-rituel]');
        if (projectsRituel) {
          const budgetMap = {
            '0-1000': { min: 0, max: 1000 }, '1000-2500': { min: 1000, max: 2500 }, '2500-5000': { min: 2500, max: 5000 },
            '5000-10000': { min: 5000, max: 10000 }, '10000-20000': { min: 10000, max: 20000 }, '20000-60000': { min: 20000, max: 60000 }, '60000+': { min: 60000, max: 999999 }
          };
          const baseRates = { avg: 55, min: 46, max: 72 }; // fallback rates to mirror /services/projects display
          const budgetSelect = projectsRituel.querySelector('[data-projects-budget]');
          const estimate = projectsRituel.querySelector('[data-projects-budget-estimate]');
          const prices = estimate ? estimate.querySelector('.budget-estimate-prices') : null;
          const volume = estimate ? estimate.querySelector('.budget-estimate-volume') : null;
          const expressLine = estimate ? estimate.querySelector('.budget-estimate-express') : null;
          const dailyRange = estimate ? estimate.querySelector('.budget-estimate-daily-range') : null;
          const hourlyRange = estimate ? estimate.querySelector('.budget-estimate-hourly-range') : null;
          const baseHoursLabel = estimate ? estimate.querySelector('[data-projects-base-hours]') : null;
          const link1 = projectsRituel.querySelector('[data-engagement-link-level="1"]');
          const link2 = projectsRituel.querySelector('[data-engagement-link-level="2"]');
          const link3 = projectsRituel.querySelector('[data-engagement-link-level="3"]');
          const linkReset = projectsRituel.querySelector('[data-engagement-link-reset]');

          function setProgressiveLevel(level) {
            if (!budgetSelect) return;
            budgetSelect.querySelectorAll('.engagement-progressive').forEach(function(opt) {
              const l1 = opt.classList.contains('engagement-level-1');
              const l2 = opt.classList.contains('engagement-level-2');
              const l3 = opt.classList.contains('engagement-level-3');
              const show = (l1 && level >= 1) || (l2 && level >= 2) || (l3 && level >= 3);
              opt.style.display = show ? '' : 'none';
            });
          }

          function levelFromValue() {
            if (!budgetSelect) return 0;
            const v = budgetSelect.value || '';
            if (v === '60000+') return 3;
            if (v === '20000-60000') return 2;
            if (v === '10000-20000') return 1;
            return 0;
          }

          function updateLinks() {
            const level = levelFromValue();
            const progressiveLevel = Math.max(level, 0);
            setProgressiveLevel(progressiveLevel);
            if (link1) link1.style.display = progressiveLevel >= 1 ? 'none' : '';
            if (link2) link2.style.display = progressiveLevel >= 1 && progressiveLevel < 2 ? '' : 'none';
            if (link3) link3.style.display = progressiveLevel >= 2 && progressiveLevel < 3 ? '' : 'none';
            if (linkReset) linkReset.style.display = progressiveLevel > 0 ? '' : 'none';
          }

          function getBaseHours() {
            const active = projectsRituel.querySelector('.engagement-base-btn.is-active');
            return active ? (parseInt(active.getAttribute('data-base') || '7', 10) || 7) : 7;
          }

          function syncBaseUI(base) {
            projectsRituel.querySelectorAll('.engagement-base-btn').forEach(function(btn) {
              btn.classList.toggle('is-active', parseInt(btn.getAttribute('data-base') || '0', 10) === base);
            });
            if (baseHoursLabel) baseHoursLabel.textContent = String(base);
          }

          function applyExpress() {
            const mult = getExpressMultiplier(projectsRituel);
            projectsRituel.querySelectorAll('[data-express-target]').forEach(function(el) {
              const base = parseFloat(el.getAttribute('data-base-value') || '0') || 0;
              el.textContent = String(Math.round(base * mult));
            });
            if (expressLine) {
              expressLine.style.display = 'block';
              expressLine.textContent = mult > 1
                ? `Supplément Express appliqué : +${Math.round((mult - 1) * 100)}%`
                : 'Standard : aucun supplément';
            }
          }

          function updateEstimate() {
            if (!estimate || !budgetSelect) return;
            const v = budgetSelect.value || '';
            const config = budgetMap[v];
            if (!config) {
              if (volume) volume.textContent = 'Sélectionnez un engagement pour afficher une estimation en rituels.';
              if (prices) prices.style.display = 'none';
              if (expressLine) expressLine.style.display = 'none';
              return;
            }

            const baseHours = getBaseHours();
            const rateBase = baseRates.avg;
            const rateMinBase = baseRates.min;
            const rateMaxBase = baseRates.max;

            let rituelsMin = Math.max(1, Math.ceil(config.min / rateBase));
            let rituelsMax = config.max === 999999 ? null : Math.max(rituelsMin, Math.floor(config.max / rateBase));

            if (volume) {
              if (rituelsMax === null) {
                volume.textContent = `Volume estimé : ~${rituelsMin}+ rituels (≈ ${rituelsMin}+ h)`;
              } else {
                volume.textContent = `Volume estimé : ~${rituelsMin}–${rituelsMax} rituels (≈ ${rituelsMin}–${rituelsMax} h)`;
              }
            }

            if (prices) {
              prices.style.display = 'block';
              if (baseHoursLabel) baseHoursLabel.textContent = String(baseHours);
              const dailyAvg = Math.round(rateBase * baseHours);
              const dailyMin = Math.round(rateMinBase * baseHours);
              const dailyMax = Math.round(rateMaxBase * baseHours);
              const hourlyAvg = rateBase;
              const hourlyMin = rateMinBase;
              const hourlyMax = rateMaxBase;

              const showRange = rateMinBase !== rateMaxBase;
              if (dailyRange) dailyRange.style.display = showRange ? '' : 'none';
              if (hourlyRange) hourlyRange.style.display = showRange ? '' : 'none';

              const targets = {
                'projects-daily-avg': dailyAvg,
                'projects-daily-min': dailyMin,
                'projects-daily-max': dailyMax,
                'projects-hourly-avg': hourlyAvg,
                'projects-hourly-min': hourlyMin,
                'projects-hourly-max': hourlyMax
              };
              Object.keys(targets).forEach(function(key) {
                const el = projectsRituel.querySelector(`[data-express-target="${key}"]`);
                if (el) el.setAttribute('data-base-value', String(targets[key]));
              });
            }

            applyExpress();
          }

          if (link1) {
            link1.addEventListener('click', function(e) {
              e.preventDefault();
              setProgressiveLevel(1);
              updateLinks();
            });
          }
          if (link2) {
            link2.addEventListener('click', function(e) {
              e.preventDefault();
              setProgressiveLevel(2);
              updateLinks();
            });
          }
          if (link3) {
            link3.addEventListener('click', function(e) {
              e.preventDefault();
              setProgressiveLevel(3);
              updateLinks();
            });
          }
          if (linkReset) {
            linkReset.addEventListener('click', function(e) {
              e.preventDefault();
              if (budgetSelect) {
                const current = budgetSelect.value || '';
                if (current === '10000-20000' || current === '20000-60000' || current === '60000+') {
                  budgetSelect.value = '';
                }
              }
              setProgressiveLevel(0);
              updateLinks();
              updateEstimate();
              serializePanel(panel);
            });
          }

          if (budgetSelect) {
            budgetSelect.addEventListener('change', function() {
              const level = levelFromValue();
              setProgressiveLevel(level);
              updateLinks();
              updateEstimate();
              serializePanel(panel);
            });
          }

          projectsRituel.querySelectorAll('.engagement-base-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
              const base = parseInt(btn.getAttribute('data-base') || '7', 10) || 7;
              syncBaseUI(base);
              updateEstimate();
              serializePanel(panel);
            });
          });

          bindExpressOptions(projectsRituel, function() {
            updateEstimate();
            serializePanel(panel);
          });

          syncBaseUI(getBaseHours());
          setProgressiveLevel(levelFromValue());
          updateLinks();
          updateEstimate();
        }

        const presenceRituel = panel.querySelector('[data-onboarding-presence-rituel]');
        if (presenceRituel) {
          const budgetMap = {
            '0-1000': { min: 0, max: 1000 }, '1000-2500': { min: 1000, max: 2500 }, '2500-5000': { min: 2500, max: 5000 },
            '5000-10000': { min: 5000, max: 10000 }, '10000-20000': { min: 10000, max: 20000 }, '20000-60000': { min: 20000, max: 60000 }, '60000+': { min: 60000, max: 999999 }
          };
          const baseRates = { avg: 55, min: 46, max: 72 };
          const budgetSelect = presenceRituel.querySelector('[data-presence-budget]');
          const estimate = presenceRituel.querySelector('[data-presence-budget-estimate]');
          const prices = estimate ? estimate.querySelector('.budget-estimate-prices') : null;
          const volume = estimate ? estimate.querySelector('.budget-estimate-volume') : null;
          const expressLine = estimate ? estimate.querySelector('.budget-estimate-express') : null;
          const dailyRange = estimate ? estimate.querySelector('.budget-estimate-daily-range') : null;
          const hourlyRange = estimate ? estimate.querySelector('.budget-estimate-hourly-range') : null;
          const baseHoursLabel = estimate ? estimate.querySelector('[data-presence-base-hours]') : null;
          const link1 = presenceRituel.querySelector('[data-engagement-link-level="1"]');
          const link2 = presenceRituel.querySelector('[data-engagement-link-level="2"]');
          const link3 = presenceRituel.querySelector('[data-engagement-link-level="3"]');
          const linkReset = presenceRituel.querySelector('[data-engagement-link-reset]');

          function setProgressiveLevel(level) {
            if (!budgetSelect) return;
            budgetSelect.querySelectorAll('.engagement-progressive').forEach(function(opt) {
              const l1 = opt.classList.contains('engagement-level-1');
              const l2 = opt.classList.contains('engagement-level-2');
              const l3 = opt.classList.contains('engagement-level-3');
              const show = (l1 && level >= 1) || (l2 && level >= 2) || (l3 && level >= 3);
              opt.style.display = show ? '' : 'none';
            });
          }

          function levelFromValue() {
            if (!budgetSelect) return 0;
            const v = budgetSelect.value || '';
            if (v === '60000+') return 3;
            if (v === '20000-60000') return 2;
            if (v === '10000-20000') return 1;
            return 0;
          }

          function updateLinks() {
            const level = levelFromValue();
            const progressiveLevel = Math.max(level, 0);
            setProgressiveLevel(progressiveLevel);
            if (link1) link1.style.display = progressiveLevel >= 1 ? 'none' : '';
            if (link2) link2.style.display = progressiveLevel >= 1 && progressiveLevel < 2 ? '' : 'none';
            if (link3) link3.style.display = progressiveLevel >= 2 && progressiveLevel < 3 ? '' : 'none';
            if (linkReset) linkReset.style.display = progressiveLevel > 0 ? '' : 'none';
          }

          function getBaseHours() {
            const active = presenceRituel.querySelector('.engagement-base-btn.is-active');
            return active ? (parseInt(active.getAttribute('data-base') || '7', 10) || 7) : 7;
          }

          function syncBaseUI(base) {
            presenceRituel.querySelectorAll('.engagement-base-btn').forEach(function(btn) {
              btn.classList.toggle('is-active', parseInt(btn.getAttribute('data-base') || '0', 10) === base);
            });
            if (baseHoursLabel) baseHoursLabel.textContent = String(base);
          }

          function applyExpress() {
            const mult = getExpressMultiplier(presenceRituel);
            presenceRituel.querySelectorAll('[data-express-target]').forEach(function(el) {
              const base = parseFloat(el.getAttribute('data-base-value') || '0') || 0;
              el.textContent = String(Math.round(base * mult));
            });
            if (expressLine) {
              expressLine.style.display = 'block';
              expressLine.textContent = mult > 1
                ? `Supplément Express appliqué : +${Math.round((mult - 1) * 100)}%`
                : 'Standard : aucun supplément';
            }
          }

          function updateEstimate() {
            if (!estimate || !budgetSelect) return;
            const v = budgetSelect.value || '';
            const config = budgetMap[v];
            if (!config) {
              if (volume) volume.textContent = 'Sélectionnez un engagement pour afficher une estimation en rituels.';
              if (prices) prices.style.display = 'none';
              if (expressLine) expressLine.style.display = 'none';
              return;
            }

            const baseHours = getBaseHours();
            const rateBase = baseRates.avg;
            const rateMinBase = baseRates.min;
            const rateMaxBase = baseRates.max;

            let rituelsMin = Math.max(1, Math.ceil(config.min / rateBase));
            let rituelsMax = config.max === 999999 ? null : Math.max(rituelsMin, Math.floor(config.max / rateBase));

            if (volume) {
              if (rituelsMax === null) {
                volume.textContent = `Volume estimé : ~${rituelsMin}+ rituels (≈ ${rituelsMin}+ h)`;
              } else {
                volume.textContent = `Volume estimé : ~${rituelsMin}–${rituelsMax} rituels (≈ ${rituelsMin}–${rituelsMax} h)`;
              }
            }

            if (prices) {
              prices.style.display = 'block';
              if (baseHoursLabel) baseHoursLabel.textContent = String(baseHours);
              const dailyAvg = Math.round(rateBase * baseHours);
              const dailyMin = Math.round(rateMinBase * baseHours);
              const dailyMax = Math.round(rateMaxBase * baseHours);
              const hourlyAvg = rateBase;
              const hourlyMin = rateMinBase;
              const hourlyMax = rateMaxBase;

              const showRange = rateMinBase !== rateMaxBase;
              if (dailyRange) dailyRange.style.display = showRange ? '' : 'none';
              if (hourlyRange) hourlyRange.style.display = showRange ? '' : 'none';

              const targets = {
                'presence-daily-avg': dailyAvg,
                'presence-daily-min': dailyMin,
                'presence-daily-max': dailyMax,
                'presence-hourly-avg': hourlyAvg,
                'presence-hourly-min': hourlyMin,
                'presence-hourly-max': hourlyMax
              };
              Object.keys(targets).forEach(function(key) {
                const el = presenceRituel.querySelector(`[data-express-target="${key}"]`);
                if (el) el.setAttribute('data-base-value', String(targets[key]));
              });
            }

            applyExpress();
          }

          if (link1) {
            link1.addEventListener('click', function(e) {
              e.preventDefault();
              setProgressiveLevel(1);
              updateLinks();
            });
          }
          if (link2) {
            link2.addEventListener('click', function(e) {
              e.preventDefault();
              setProgressiveLevel(2);
              updateLinks();
            });
          }
          if (link3) {
            link3.addEventListener('click', function(e) {
              e.preventDefault();
              setProgressiveLevel(3);
              updateLinks();
            });
          }
          if (linkReset) {
            linkReset.addEventListener('click', function(e) {
              e.preventDefault();
              if (budgetSelect) {
                const current = budgetSelect.value || '';
                if (current === '10000-20000' || current === '20000-60000' || current === '60000+') {
                  budgetSelect.value = '';
                }
              }
              setProgressiveLevel(0);
              updateLinks();
              updateEstimate();
              serializePanel(panel);
            });
          }

          if (budgetSelect) {
            budgetSelect.addEventListener('change', function() {
              const level = levelFromValue();
              setProgressiveLevel(level);
              updateLinks();
              updateEstimate();
              serializePanel(panel);
            });
          }

          presenceRituel.querySelectorAll('.engagement-base-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
              const base = parseInt(btn.getAttribute('data-base') || '7', 10) || 7;
              syncBaseUI(base);
              updateEstimate();
              serializePanel(panel);
            });
          });

          bindExpressOptions(presenceRituel, function() {
            updateEstimate();
            serializePanel(panel);
          });

          syncBaseUI(getBaseHours());
          setProgressiveLevel(levelFromValue());
          updateLinks();
          updateEstimate();
        }

        const lessonsRituel = panel.querySelector('[data-onboarding-lessons-rituel]');
        if (lessonsRituel) {
          const budgetMap = {
            '0-1000': { min: 0, max: 1000 }, '1000-2500': { min: 1000, max: 2500 }, '2500-5000': { min: 2500, max: 5000 },
            '5000-10000': { min: 5000, max: 10000 }, '10000-20000': { min: 10000, max: 20000 }, '20000-60000': { min: 20000, max: 60000 }, '60000+': { min: 60000, max: 999999 }
          };
          const budgetSelect = lessonsRituel.querySelector('[data-lessons-budget]');
          const estimate = lessonsRituel.querySelector('[data-lessons-budget-estimate]');
          const reco = lessonsRituel.querySelector('[data-lessons-reco]');
          const minInput = lessonsRituel.querySelector('[data-lessons-price-min]');
          const maxInput = lessonsRituel.querySelector('[data-lessons-price-max]');
          const slider = lessonsRituel.querySelector('[data-lessons-rituel-slider]');
          const accordion = lessonsRituel.querySelector('[data-lessons-tarif-accordion]');
          const affinerLink = lessonsRituel.querySelector('[data-lessons-affiner-link]');
          const summary = lessonsRituel.querySelector('[data-lessons-price-summary]');

          function getBase() {
            const active = lessonsRituel.querySelector('.rituel-base-btn.is-active, .engagement-base-btn.is-active');
            return active ? (parseInt(active.getAttribute('data-base') || '7', 10) || 7) : 7;
          }
          function syncBase(base) {
            lessonsRituel.querySelectorAll('.rituel-base-btn, .engagement-base-btn').forEach(function(btn) {
              btn.classList.toggle('is-active', parseInt(btn.getAttribute('data-base') || '0', 10) === base);
            });
          }
          function applyExpress(scope) {
            const mult = getExpressMultiplier(scope);
            scope.querySelectorAll('[data-express-target]').forEach(function(el) {
              const base = parseFloat(el.getAttribute('data-base-value') || '0') || 0;
              el.textContent = String(Math.round(base * mult));
            });
          }
          function updateSummary() {
            if (!summary || !minInput || !maxInput) return;
            const mn = Math.max(10, Math.min(299, parseInt(minInput.value || '10', 10) || 10));
            const mx = Math.max(mn, Math.min(299, parseInt(maxInput.value || '50', 10) || 50));
            minInput.value = String(mn); maxInput.value = String(mx);
            const base = getBase();
            const dayMin = mn * base; const dayMax = mx * base;
            const hMin = summary.querySelector('[data-express-target="slider-hourly-min"]');
            const hMax = summary.querySelector('[data-express-target="slider-hourly-max"]');
            const dMin = summary.querySelector('[data-express-target="slider-daily-min"]');
            const dMax = summary.querySelector('[data-express-target="slider-daily-max"]');
            if (hMin) hMin.setAttribute('data-base-value', String(mn));
            if (hMax) hMax.setAttribute('data-base-value', String(mx));
            if (dMin) dMin.setAttribute('data-base-value', String(Math.round(dayMin)));
            if (dMax) dMax.setAttribute('data-base-value', String(Math.round(dayMax)));
            applyExpress(lessonsRituel);
          }
          function updateBudgetEstimate() {
            if (!budgetSelect || !estimate || !minInput || !maxInput) return;
            const v = budgetSelect.value || '';
            const vol = estimate.querySelector('.budget-estimate-volume');
            const prices = estimate.querySelector('.budget-estimate-prices');
            const exp = estimate.querySelector('.budget-estimate-express');
            const has = !!budgetMap[v];
            if (!has) {
              if (vol) vol.textContent = 'Sélectionnez un engagement pour afficher une estimation en rituels.';
              if (prices) prices.style.display = 'none';
              if (exp) exp.style.display = 'none';
              if (reco) reco.style.display = 'none';
              return;
            }
            const budget = budgetMap[v];
            const mn = parseInt(minInput.value || '10', 10) || 10;
            const mx = Math.max(mn, parseInt(maxInput.value || '50', 10) || 50);
            const rate = (mn + mx) / 2;
            const rMin = Math.ceil(budget.min / rate);
            const rMax = budget.max === 999999 ? null : Math.floor(budget.max / rate);
            if (vol) vol.textContent = `Volume estimé : ~${rMin}-${rMax || (rMin + 8)} rituels (~${rMin}-${rMax || (rMin + 8)} h)`;
            if (prices) prices.style.display = 'block';
            const dayAvg = Math.round(rate * getBase());
            const dayMin = Math.round(mn * getBase());
            const dayMax = Math.round(mx * getBase());
            const hAvg = prices.querySelector('[data-express-target="engagement-hourly-avg"]');
            const hMin = prices.querySelector('[data-express-target="engagement-hourly-min"]');
            const hMax = prices.querySelector('[data-express-target="engagement-hourly-max"]');
            const dAvg = prices.querySelector('[data-express-target="engagement-daily-avg"]');
            const dMin = prices.querySelector('[data-express-target="engagement-daily-min"]');
            const dMax = prices.querySelector('[data-express-target="engagement-daily-max"]');
            if (hAvg) hAvg.setAttribute('data-base-value', String(Math.round(rate)));
            if (hMin) hMin.setAttribute('data-base-value', String(mn));
            if (hMax) hMax.setAttribute('data-base-value', String(mx));
            if (dAvg) dAvg.setAttribute('data-base-value', String(dayAvg));
            if (dMin) dMin.setAttribute('data-base-value', String(dayMin));
            if (dMax) dMax.setAttribute('data-base-value', String(dayMax));
            if (exp) { exp.style.display = 'block'; exp.textContent = 'Standard : aucun supplément'; }
            applyExpress(lessonsRituel);
            if (reco) { reco.style.display = 'block'; reco.textContent = `Recommandation Junspro : ${Math.max(6, Math.round((budget.min / rate))) }h / 4 semaines`; }
          }

          if (affinerLink && accordion) {
            affinerLink.addEventListener('click', function(e) {
              e.preventDefault();
              accordion.classList.toggle('is-open');
            });
          }
          lessonsRituel.querySelectorAll('.rituel-base-btn, .engagement-base-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
              const b = parseInt(btn.getAttribute('data-base') || '7', 10) || 7;
              syncBase(b); updateSummary(); updateBudgetEstimate(); serializePanel(panel);
            });
          });
          if (budgetSelect) budgetSelect.addEventListener('change', function() { updateBudgetEstimate(); serializePanel(panel); });
          if (minInput) minInput.addEventListener('input', function() { updateSummary(); updateBudgetEstimate(); serializePanel(panel); });
          if (maxInput) maxInput.addEventListener('input', function() { updateSummary(); updateBudgetEstimate(); serializePanel(panel); });
          bindExpressOptions(lessonsRituel, function() { updateSummary(); updateBudgetEstimate(); serializePanel(panel); });

          if (slider && typeof jQuery !== 'undefined' && jQuery.ui && jQuery.ui.slider) {
            const mn = parseInt(minInput && minInput.value ? minInput.value : '10', 10) || 10;
            const mx = parseInt(maxInput && maxInput.value ? maxInput.value : '50', 10) || 50;
            jQuery(slider).slider({
              range: true, min: 10, max: 299, values: [Math.max(10, mn), Math.min(299, mx)],
              slide: function(_, ui) { if (minInput) minInput.value = ui.values[0]; if (maxInput) maxInput.value = ui.values[1]; updateSummary(); updateBudgetEstimate(); },
              change: function() { serializePanel(panel); }
            });
          }
          updateSummary(); updateBudgetEstimate();
        }

        const rituelGeneric = panel.querySelector('[data-onboarding-rituel]');
        if (rituelGeneric) {
          const minInput = rituelGeneric.querySelector('[data-rituel-price-min]');
          const maxInput = rituelGeneric.querySelector('[data-rituel-price-max]');
          const slider = rituelGeneric.querySelector('[data-rituel-slider]');
          const summary = rituelGeneric.querySelector('[data-rituel-price-summary]');
          function getBase() {
            const active = rituelGeneric.querySelector('.rituel-base-btn.is-active');
            return active ? (parseInt(active.getAttribute('data-base') || '7', 10) || 7) : 7;
          }
          function applySummary() {
            if (!summary || !minInput || !maxInput) return;
            const mn = Math.max(10, Math.min(100, parseInt(minInput.value || '10', 10) || 10));
            const mx = Math.max(mn, Math.min(100, parseInt(maxInput.value || '50', 10) || 50));
            minInput.value = String(mn); maxInput.value = String(mx);
            const base = getBase();
            const hMin = summary.querySelector('[data-express-target="slider-hourly-min"]');
            const hMax = summary.querySelector('[data-express-target="slider-hourly-max"]');
            const dMin = summary.querySelector('[data-express-target="slider-daily-min"]');
            const dMax = summary.querySelector('[data-express-target="slider-daily-max"]');
            if (hMin) hMin.setAttribute('data-base-value', String(mn));
            if (hMax) hMax.setAttribute('data-base-value', String(mx));
            if (dMin) dMin.setAttribute('data-base-value', String(Math.round(mn * base)));
            if (dMax) dMax.setAttribute('data-base-value', String(Math.round(mx * base)));
            const mult = getExpressMultiplier(rituelGeneric);
            summary.querySelectorAll('[data-express-target]').forEach(function(el) {
              const val = parseFloat(el.getAttribute('data-base-value') || '0') || 0;
              el.textContent = String(Math.round(val * mult));
            });
          }
          rituelGeneric.querySelectorAll('.rituel-base-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
              const b = parseInt(btn.getAttribute('data-base') || '7', 10) || 7;
              rituelGeneric.querySelectorAll('.rituel-base-btn').forEach(function(x) {
                x.classList.toggle('is-active', parseInt(x.getAttribute('data-base') || '0', 10) === b);
              });
              applySummary(); serializePanel(panel);
            });
          });
          bindExpressOptions(rituelGeneric, function() { applySummary(); serializePanel(panel); });
          if (minInput) minInput.addEventListener('input', function() { applySummary(); serializePanel(panel); });
          if (maxInput) maxInput.addEventListener('input', function() { applySummary(); serializePanel(panel); });
          if (slider && typeof jQuery !== 'undefined' && jQuery.ui && jQuery.ui.slider) {
            const mn = parseInt(minInput && minInput.value ? minInput.value : '10', 10) || 10;
            const mx = parseInt(maxInput && maxInput.value ? maxInput.value : '50', 10) || 50;
            jQuery(slider).slider({
              range: true, min: 10, max: 100, values: [Math.max(10, mn), Math.min(100, mx)],
              slide: function(_, ui) { if (minInput) minInput.value = ui.values[0]; if (maxInput) maxInput.value = ui.values[1]; applySummary(); },
              change: function() { serializePanel(panel); }
            });
          }
          applySummary();
        }

        document.addEventListener('click', function(e) {
          if (!panel.contains(e.target)) {
            if (domainMenu) domainMenu.style.display = 'none';
            if (expMenu) expMenu.style.display = 'none';
            if (availabilityPanel) availabilityPanel.classList.remove('active');
          }
        });
      }

      allPanels.forEach(panel => {
        prefillPanel(panel);
        stripExpertFilter(panel);
        initPanelControls(panel);
        panel.addEventListener('change', function() { serializePanel(panel); });
        panel.addEventListener('input', function() { serializePanel(panel); });
        serializePanel(panel);
      });

      function applyVisibility(universes) {
        const selected = Array.isArray(universes) ? universes : [];
        let visibleCount = 0;
        allPanels.forEach(panel => {
          const slug = panel.getAttribute('data-universe-panel');
          const isVisible = selected.includes(slug);
          panel.style.display = isVisible ? 'block' : 'none';
          if (isVisible) visibleCount++;
        });
        if (empty) empty.style.display = visibleCount === 0 ? 'block' : 'none';
      }

      document.addEventListener('onboarding:scopeChanged', function(e) {
        applyVisibility((e.detail && e.detail.universes) || []);
      });
      applyVisibility(window.__onboardingSelectedUniverses || []);

      const form = root.closest('form');
      if (form) {
        form.addEventListener('submit', function() {
          allPanels.forEach(serializePanel);
        });
      }
    }

    document.addEventListener('DOMContentLoaded', function() {
      initOnboardingLanguagePremium();
      initOnboardingScopePremium();
      initUniverseMatchingPanels();
    });
    
    // Nettoyer localStorage après inscription réussie (on est arrivé sur step1)
    document.addEventListener('DOMContentLoaded', function() {
      // Nettoyer toutes les clés de localStorage liées à l'inscription
      Object.keys(localStorage).forEach(key => {
        if (key.startsWith('signup_form_data')) {
          localStorage.removeItem(key);
        }
      });
    });
  </script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('frontend.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\younes\Downloads\junspro-main (1)\junspro-main3\resources\views\frontend\freelance\onboarding\step1.blade.php ENDPATH**/ ?>