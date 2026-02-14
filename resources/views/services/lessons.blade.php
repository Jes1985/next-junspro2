@extends('frontend.layout')

@section('pageHeading')
  Cours | {{ $websiteInfo->website_title }}
@endsection

@section('metaDescription')
  Trouvez un freelance pour progresser. Rituel d'essai, objectifs clairs, suivi régulier.
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('assets/front/css/services-pages.css') }}">
<style>
  /* ============================================
     PAGE PREPLY STYLE - ADAPTÉE JUNSPRO
     ============================================ */
  
  /* Variables couleurs Lessons - Dégradé bleu cyan bleu royal */
  .page-lessons {
    --preply-primary: #06B6D4;
    --preply-primary-rgb: 6, 182, 212;
    --preply-primary-dark: #2563EB;
    --preply-primary-light: #22D3EE;
    --preply-pink: #0EA5E9;
    --preply-pink-light: #38BDF8;
    --preply-text: #1F2937;
    --preply-text-light: #6B7280;
    --preply-bg: #FFFFFF;
    --preply-border: #E5E7EB;
    --preply-hover: #F9FAFB;
  }

  /* Hero Lessons - Dégradé bleu cyan bleu royal */
  .services-hero {
    background: linear-gradient(
      135deg,
      #67E8F9 0%,
      #22D3EE 20%,
      #06B6D4 40%,
      #0891B2 60%,
      #2563EB 80%,
      #1E40AF 100%
    ) !important;
    box-shadow: 
      0 20px 60px rgba(6, 182, 212, 0.25),
      0 0 0 1px rgba(255, 255, 255, 0.1) inset;
  }

  .services-hero__placeholder {
    background: linear-gradient(
      135deg,
      #67E8F9 0%,
      #22D3EE 20%,
      #06B6D4 40%,
      #0891B2 60%,
      #2563EB 80%,
      #1E40AF 100%
    ) !important;
  }

  .services-hero__placeholder::after {
    background: linear-gradient(
      135deg,
      rgba(255, 255, 255, 0.1) 0%,
      transparent 50%,
      rgba(6, 182, 212, 0.1) 100%
    );
  }

  /* Boutons hero Lessons - Adaptation bleu cyan */
  .services-hero__btn--primary {
    color: #2563EB !important;
  }

  .services-hero__btn--primary:hover {
    color: #1E40AF !important;
  }

  .services-hero__btn--secondary {
    border-color: rgba(255, 255, 255, 0.5) !important;
  }

  .services-hero__btn--secondary:hover {
    border-color: rgba(255, 255, 255, 0.7) !important;
    background: rgba(255, 255, 255, 0.3) !important;
  }

  /* Section titre et description Preply */
  .preply-intro-section {
    background: var(--preply-bg);
    padding: 40px 0;
    border-bottom: 1px solid var(--preply-border);
  }

  .preply-intro-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
  }

  .preply-intro-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--preply-text);
    margin-bottom: 16px;
    line-height: 1.2;
  }

  .preply-intro-description {
    font-size: 1.125rem;
    color: var(--preply-text-light);
    line-height: 1.6;
    margin-bottom: 24px;
  }

  .preply-intro-description.collapsed {
    max-height: 120px;
    overflow: hidden;
  }

  .preply-intro-description.expanded {
    max-height: none;
  }

  .preply-intro-toggle {
    color: var(--preply-primary);
    background: none;
    border: none;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    padding: 0;
    margin-top: 8px;
  }

  .preply-intro-toggle:hover {
    text-decoration: underline;
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

  /* Ajustement des largeurs : Domaine +0.25cm, Budget -1cm, Disponibilités +0.75cm */
  .domain-filter-group {
    min-width: calc(200px + 0.25cm);
    flex: 1 1 calc(200px + 0.25cm);
  }

  .budget-filter-group {
    min-width: calc(200px - 1cm);
    flex: 1 1 calc(200px - 1cm);
    max-width: calc(200px - 1cm);
  }

  .preply-availability-group {
    min-width: calc(200px + 0.75cm);
    flex: 1 1 calc(200px + 0.75cm);
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

  .preply-filter-select:focus,
  .preply-filter-input:focus {
    outline: none;
    border-color: var(--preply-primary);
    box-shadow: 0 0 0 3px rgba(6, 182, 212, 0.1);
  }

  /* Dropdown Domaine + Spécialisation (modèle premium identique Projets) */
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
    border-color: rgba(6, 182, 212, 0.3);
    box-shadow: 0 4px 12px rgba(15, 23, 42, 0.12);
    transform: translateY(-1px);
  }

  .domain-dropdown-trigger.active {
    border-color: var(--preply-primary);
    box-shadow: 0 4px 12px rgba(6, 182, 212, 0.2);
  }

  .domain-selected-text {
    flex: 1;
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
    top: calc(100% + 8px);
    left: 0;
    right: 0;
    background: var(--preply-bg);
    border: 1px solid var(--preply-border);
    border-radius: 12px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    z-index: 1000;
    max-height: 400px;
    overflow-y: auto;
    overflow-x: hidden;
    isolation: isolate;
  }

  .domain-option {
    padding: 10px 16px;
    cursor: pointer;
    transition: background-color 0.2s;
    color: var(--preply-text);
    font-size: 0.9375rem;
    overflow: hidden;
  }

  .domain-option:hover {
    background-color: var(--preply-hover);
  }

  .domain-option.selected {
    background-color: rgba(6, 182, 212, 0.1);
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
    background: linear-gradient(135deg, var(--preply-primary-dark) 0%, var(--preply-primary) 50%, var(--preply-primary-light) 100%);
    color: white;
  }

  .availability-apply-btn:hover {
    box-shadow: 0 4px 12px rgba(6, 182, 212, 0.3);
  }

  .preply-filters-advanced {
    display: flex;
    flex-wrap: nowrap;
    gap: 12px;
    margin-top: 12px;
    align-items: flex-start;
  }

  /* Micro-description premium sous le filtre Domaine (affichée lorsqu'un domaine est sélectionné) — copie Projects */
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
    color: rgba(139, 92, 246, 0.6);
    margin-right: 6px;
    font-size: 0.7rem;
  }
  .domain-premium-desc #domainPremiumDescText {
    vertical-align: baseline;
  }
  @media (max-width: 768px) {
    .domain-premium-desc { font-size: 0.8125rem; padding: 8px 10px; margin-top: 6px; }
  }

  .preply-filter-advanced {
    min-width: 150px;
    flex: 0 1 auto;
  }

  /* Dropdown Univers d'activité — copie conforme Projects */
  .sector-dropdown-wrapper { position: relative; }
  .page-lessons .sector-filter-container { min-width: 320px; }

  /* Filtre Mes disponibilités : +2 cm dans Critères avancés (page Lessons) */
  .page-lessons .filters-level-3 .preply-availability-group {
    min-width: calc(200px + 4cm);
    max-width: calc(350px + 10cm);
  }

  /* Espacement section Critères avancés (page Lessons) */
  .page-lessons .filters-level-3 {
    padding: 1.25rem 0;
    margin-bottom: 2rem;
  }
  .page-lessons .filters-level-3 .filters-level-title {
    margin-bottom: 1rem;
  }
  .page-lessons .filters-level-3 .filters-level-inner {
    gap: 1.5rem 2rem;
  }

  /* Dropdown Mon expérience (Critères avancés) — copie Projects */
  .experience-dropdown-wrapper { position: relative; }
  .experience-dropdown-trigger {
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
  .experience-dropdown-trigger:hover {
    border-color: rgba(139, 92, 246, 0.3);
    box-shadow: 0 4px 12px rgba(15, 23, 42, 0.12);
    transform: translateY(-1px);
  }
  .experience-dropdown-trigger.active {
    border-color: var(--preply-primary);
    box-shadow: 0 4px 12px rgba(139, 92, 246, 0.2);
  }
  .experience-selected-text { flex: 1; }
  .experience-arrow { font-size: 0.75rem; color: var(--preply-text-light); transition: transform 0.2s; }
  .experience-dropdown-trigger.active .experience-arrow { transform: rotate(180deg); }
  .experience-dropdown-menu {
    position: absolute;
    bottom: calc(100% + 8px);
    left: 0;
    right: 0;
    background: var(--preply-bg);
    border: 1px solid var(--preply-border);
    border-radius: 12px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    z-index: 1000;
    max-height: 280px;
    overflow-y: auto;
  }
  .experience-option {
    padding: 10px 16px;
    cursor: pointer;
    transition: background-color 0.2s;
    color: var(--preply-text);
    font-size: 0.9375rem;
  }
  .experience-option:hover { background-color: var(--preply-hover); }
  .experience-option.selected {
    background-color: rgba(139, 92, 246, 0.1);
    color: var(--preply-primary);
    font-weight: 500;
  }
  .sector-filter-container { min-width: 200px; }
  .sector-dropdown-trigger {
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
  .sector-dropdown-trigger:hover {
    border-color: rgba(139, 92, 246, 0.3);
    box-shadow: 0 4px 12px rgba(15, 23, 42, 0.12);
    transform: translateY(-1px);
  }
  .sector-dropdown-trigger.active {
    border-color: var(--preply-primary);
    box-shadow: 0 4px 12px rgba(139, 92, 246, 0.2);
  }
  .sector-selected-text { flex: 1; }
  .sector-arrow { font-size: 0.75rem; color: var(--preply-text-light); transition: transform 0.2s; transform: rotate(0deg); }
  .sector-dropdown-trigger.active .sector-arrow { transform: rotate(180deg); }
  .sector-dropdown-menu {
    position: absolute;
    bottom: calc(100% + 8px);
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
  .sector-search-wrapper { position: relative; margin-bottom: 12px; }
  .sector-search-icon {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--preply-text-light);
    font-size: 0.875rem;
    pointer-events: none;
  }
  .sector-search-input {
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
  .sector-search-input:focus {
    border-color: var(--preply-primary);
    box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
  }
  .sector-list { display: flex; flex-direction: column; gap: 2px; }
  .sector-option {
    display: flex;
    align-items: center;
    padding: 10px 12px;
    cursor: pointer;
    border-radius: 8px;
    transition: background-color 0.2s;
    gap: 12px;
  }
  .sector-option:hover { background-color: var(--preply-hover); }
  .sector-option.selected { background-color: rgba(139, 92, 246, 0.1); }
  .sector-name { flex: 1; font-size: 0.875rem; color: var(--preply-text); }
  .sector-option.selected .sector-name { color: var(--preply-primary); font-weight: 500; }
  .sector-checkbox {
    width: 18px; height: 18px;
    border: 2px solid var(--preply-border);
    border-radius: 4px;
    flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
    transition: all 0.2s;
  }
  .sector-option.selected .sector-checkbox {
    background-color: var(--preply-primary);
    border-color: var(--preply-primary);
  }
  .sector-option.selected .sector-checkbox::after {
    content: '✓'; color: white; font-size: 12px; font-weight: bold;
  }
  .sector-no-results {
    padding: 16px;
    text-align: center;
    color: var(--preply-text-light);
    font-size: 0.875rem;
  }
  .sector-all-section { margin-top: 12px; padding-top: 12px; border-top: 1px solid var(--preply-border); }
  .sector-reset-option {
    margin-top: 12px;
    padding: 10px 12px;
    border-radius: 8px;
    background: rgba(139, 92, 246, 0.06);
    border: 1px solid rgba(139, 92, 246, 0.15);
    font-size: 0.875rem;
    font-weight: 500;
    color: var(--preply-primary);
    cursor: pointer;
    text-align: center;
    transition: background-color 0.2s;
  }
  .sector-reset-option:hover { background: rgba(139, 92, 246, 0.1); }

  .preply-search-input {
    flex: 1;
    min-width: 200px;
    margin-left: auto;
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
     CARTES FREELANCES PREMIUM - STYLE PREPLY (depuis explore)
     ============================================ */
  .freelancers-list-wrapper {
    width: 100%;
    overflow: visible;
  }
  
  .freelancers-grid-premium {
    display: flex;
    flex-direction: column;
    gap: 20px;
  }

  .freelancer-card-wrapper-premium {
    position: relative !important;
    margin-bottom: 24px;
    width: 100%;
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
    background: linear-gradient(135deg, #06B6D4 0%, #22D3EE 50%, #2563EB 100%);
    border: 2px solid rgba(255, 255, 255, 0.95);
    box-shadow: 0 4px 16px rgba(6, 182, 212, 0.2), 0 2px 8px rgba(37, 99, 235, 0.15), inset 0 0 0 1px rgba(255, 255, 255, 0.4);
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

  .freelancer-languages-v2 {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    color: #374151;
    margin-bottom: 4px;
    line-height: 1.5;
  }

  .skill-icon {
    color: #6B7280;
    font-size: 16px;
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
    padding: 9px 11px;
    background: linear-gradient(135deg, var(--preply-primary-dark) 0%, var(--preply-primary) 50%, var(--preply-primary-light) 100%);
    color: white;
    border-radius: 9999px;
    font-size: 15px;
    font-weight: 600;
    text-align: center;
    text-decoration: none;
    transition: all 0.2s;
    box-shadow: 0 2px 8px rgba(6, 182, 212, 0.25);
  }

  .cta-primary-v2:hover {
    background: linear-gradient(135deg, #0891B2 0%, #2563EB 100%);
    box-shadow: 0 4px 12px rgba(6, 182, 212, 0.4);
    transform: translateY(-1px);
    color: white;
  }

  .cta-secondary-v2 {
    padding: 12px 20px;
    background: white;
    color: #111827;
    border: 1px solid #D1D5DB;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 500;
    text-align: center;
    text-decoration: none;
    transition: all 0.2s;
  }

  .cta-secondary-v2:hover {
    background: #F9FAFB;
    border-color: #9CA3AF;
    color: #111827;
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

  .video-label-v2 {
    position: absolute;
    bottom: 12px;
    left: 12px;
    background: rgba(0, 0, 0, 0.75);
    backdrop-filter: blur(8px);
    color: white;
    padding: 6px 12px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 500;
    z-index: 5;
    pointer-events: none;
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
    box-shadow: 0 2px 8px rgba(6, 182, 212, 0.3);
  }

  .quick-view-btn-primary-v2:hover {
    background: linear-gradient(135deg, #0891B2 0%, #2563EB 100%);
    box-shadow: 0 4px 12px rgba(6, 182, 212, 0.4);
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
    height: 0;
    padding-bottom: 56.25%;
    position: relative;
  }

  .video-modal-content iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
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
    background: linear-gradient(135deg, #2563EB 0%, #06B6D4 50%, #22D3EE 100%);
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
    box-shadow: 0 2px 4px rgba(6, 182, 212, 0.2); /* Ombre subtile */
  }

  /* Effet premium au hover */
  .preply-teacher-btn-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(6, 182, 212, 0.35), 0 2px 4px rgba(6, 182, 212, 0.2); /* Ombre plus prononcée */
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

  /* Bouton play rond rose (comme capture Preply) */
  .preply-popover-play-btn {
    position: absolute;
    bottom: 12px;
    right: 12px;
    width: 52px;
    height: 52px;
    background: linear-gradient(135deg, #EC4899 0%, #F472B6 100%); /* Rose Preply */
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
    background: linear-gradient(135deg, var(--preply-primary-dark) 0%, var(--preply-primary) 100%);
    color: white;
    border: none;
    width: 42px;
    height: 42px;
    border-radius: 50%;
    font-weight: 500;
    font-size: 1rem;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 2px 8px rgba(6, 182, 212, 0.3);
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
    background: linear-gradient(135deg, #0891B2 0%, var(--preply-primary) 100%);
    transform: scale(1.05);
    box-shadow: 0 4px 12px rgba(6, 182, 212, 0.4);
  }

  /* ========== DESIGN SYSTEM PREMIUM (scopé .page-lessons) ========== */
  /* Fond de page (sous filtre et cartes) : dégradé violet lavande /services + jet de lumière — sans toucher au hero */
  .services-page-wrapper.page-lessons {
    min-height: 100vh; position: relative; overflow: hidden;
    background-color: #FAFAFC;
    background-image: linear-gradient(180deg, #FAFAFC 0%, #F8F7FC 40%, #F5F3FF 100%), url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='g'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.8' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23g)'/%3E%3C/svg%3E");
    background-blend-mode: normal, overlay; background-size: 100% 100%, 200px 200px; background-position: 0 0, 0 0;
  }
  .services-page-wrapper.page-lessons::before { content: ''; position: fixed; top: -20%; left: -10%; width: 60%; height: 60%; background: radial-gradient(circle at 30% 30%, rgba(196, 181, 253, 0.06) 0%, transparent 55%); pointer-events: none; z-index: 0; }
  .services-page-wrapper.page-lessons::after { content: ''; position: fixed; bottom: -20%; right: -10%; width: 55%; height: 55%; background: radial-gradient(circle at 70% 70%, rgba(196, 181, 253, 0.05) 0%, transparent 55%); pointer-events: none; z-index: 0; }
  .services-page-wrapper.page-lessons > * { position: relative; z-index: 1; }
  .services-page-wrapper.page-lessons .preply-filters-section, .services-page-wrapper.page-lessons .preply-results-section { background: transparent; }
  {F9E1D1AC-55A0-4B9C-BD82-B825BC2D07AA}.png  .page-lessons .services-hero { position: relative; border-radius: 0 0 32px 32px; box-shadow: 0 12px 40px rgba(6, 182, 212, 0.18), 0 0 0 1px rgba(255, 255, 255, 0.08) inset; }
  .page-lessons .services-hero::before { content: ''; position: absolute; inset: 0; background: linear-gradient(to bottom, rgba(255,255,255,0.12) 0%, transparent 50%); pointer-events: none; z-index: 1; }
  .page-lessons .services-hero::after { content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 160px; background: linear-gradient(to top, rgba(255,255,255,1) 0%, rgba(255,255,255,0.5) 50%, transparent 100%); pointer-events: none; z-index: 2; }
  .page-lessons .preply-filters-section { border-bottom: 1px solid var(--preply-border); box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04); }
  .page-lessons .preply-filter-select, .page-lessons .preply-filter-input { border: 1px solid var(--preply-border); border-radius: 12px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05); }
  .page-lessons .preply-filter-select:focus, .page-lessons .preply-filter-input:focus { box-shadow: 0 0 0 3px rgba(var(--preply-primary-rgb), 0.12); }
  .page-lessons .preply-results-header { border-bottom: 1px solid var(--preply-border); padding-bottom: 1rem; margin-bottom: 1rem; }
  .page-lessons .freelancer-card-premium-v2 { border: 1px solid rgba(229, 231, 235, 0.9); border-radius: 20px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06); transition: transform 0.25s ease-out, box-shadow 0.25s ease-out; }
  .page-lessons .freelancer-card-premium-v2:hover { transform: translateY(-3px); box-shadow: 0 12px 40px rgba(0, 0, 0, 0.08); }
  .page-lessons .services-hero__btn--primary { transition: transform 0.2s ease-out, box-shadow 0.2s ease-out; }
  .page-lessons .services-hero__btn--primary:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(var(--preply-primary-rgb), 0.25); }

  /* ---------- Bloc search-filter Lessons : onglets + Filtres avancés + Rechercher en dégradé bleu / bleu royal (Cours & Tutorat) ---------- */
  .page-lessons .home-search-filter-section .filter-tabs { border-bottom-color: rgba(6, 182, 212, 0.25); }
  .page-lessons .home-search-filter-section .filter-tab:hover { color: #2563EB; background: rgba(6, 182, 212, 0.1); }
  .page-lessons .home-search-filter-section .filter-tab.active { color: #2563EB; background: rgba(6, 182, 212, 0.12); }
  .page-lessons .home-search-filter-section .filter-tab.active::after { background: linear-gradient(135deg, #06B6D4 0%, #0891B2 50%, #2563EB 80%, #1E40AF 100%); }
  .page-lessons .home-search-filter-section .filter-advanced-btn { color: #06B6D4; }
  .page-lessons .home-search-filter-section .filter-advanced-btn:hover { color: #2563EB; }
  .page-lessons .home-search-filter-section .filter-submit-btn { background: linear-gradient(135deg, #06B6D4 0%, #0891B2 40%, #2563EB 80%, #1E40AF 100%); box-shadow: 0 4px 12px rgba(6, 182, 212, 0.35); }
  .page-lessons .home-search-filter-section .filter-submit-btn:hover { box-shadow: 0 8px 24px rgba(6, 182, 212, 0.45), 0 4px 12px rgba(37, 99, 235, 0.25); }

  /* Hero Pays + Ville — micro-indicateurs (identique HomeSwap) : assistant + popover */
  #lessonsCityWrapper { position: relative; }
  .lessons-city-assistant {
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
  .lessons-city-assistant > * { pointer-events: auto; }
  .lessons-city-icons { display: flex; align-items: center; gap: 0.35rem; }
  .lessons-city-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 18px;
    height: 18px;
    color: #94a3b8;
    opacity: 0.7;
  }
  .lessons-city-icon svg { width: 100%; height: 100%; }
  .lessons-city-icon-popular { color: #6b7280; opacity: 0.75; }
  .lessons-city-info-btn {
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
  .lessons-city-info-btn:hover { opacity: 1; color: #06B6D4; }
  .lessons-city-info-btn:focus-visible { outline: 2px solid #06B6D4; outline-offset: 2px; border-radius: 3px; }
  .lessons-city-info-btn svg { width: 100%; height: 100%; }
  .lessons-city-popover {
    position: fixed;
    z-index: 10000;
    background: #ffffff;
    border: 1px solid rgba(0, 0, 0, 0.08);
    border-radius: 12px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12), 0 2px 8px rgba(0, 0, 0, 0.08);
    min-width: 240px;
    max-width: 320px;
    animation: lessonsPopoverFadeIn 0.2s ease;
  }
  @keyframes lessonsPopoverFadeIn {
    from { opacity: 0; transform: translateY(-4px); }
    to { opacity: 1; transform: translateY(0); }
  }
  .lessons-city-popover-content { padding: 1rem; }
  .lessons-city-popover-content p + p { margin-top: 0.5rem; }
  .lessons-city-popover-text { font-size: 0.75rem; color: #64748b; line-height: 1.5; margin: 0; }
  .lessons-city-popover-badge { color: #6b7280; font-weight: 500; }

  /* Engagement Rituel + Tarif accordéon — Lessons uniquement */
  .page-lessons .lessons-affiner-tarif-link {
    display: inline-flex; align-items: center; margin-top: 12px; font-size: 0.875rem; color: #2563EB;
    text-decoration: none; font-weight: 500; transition: color 0.2s;
  }
  .page-lessons .lessons-affiner-tarif-link:hover { color: #1E40AF; text-decoration: underline; }
  .page-lessons .lessons-tarif-accordion {
    max-height: 0; overflow: hidden; transition: max-height 0.35s ease;
  }
  .page-lessons .lessons-tarif-accordion.is-open { max-height: 400px; }
  .page-lessons .lessons-engagement-block .engagement-base-btn.is-active { background: #fff !important; color: #2563EB !important; box-shadow: 0 1px 2px rgba(0,0,0,0.05); }
  .page-lessons .lessons-engagement-block .engagement-base-btn:hover { color: #2563EB; background: rgba(37, 99, 235, 0.08); }
</style>
@endsection

@section('content')
<div class="services-page-wrapper page-lessons">
  {{-- Hero conservé --}}
  <x-services.hero
    title="Cours et Tutorat"
    subtitle="Des progrès qui se voient."
    micro="Séance d'essai, objectifs clairs, suivi régulier. Vous avancez sereinement. Nous vous offrons le meilleur pour développer vos compétences."
    :cta="['text' => 'Réserver un essai', 'url' => '#results', 'variant' => 'primary']"
  />

  {{-- Filtre de recherche type /home (sur le hero) — bloc filtres premium Projects dupliqué dans Filtres avancés, formId=preplyFiltersForm pour JS --}}
  <div class="container" style="position:relative;z-index:10;">
    <x-home.search-filter formId="preplyFiltersForm" :formAction="route('services.lessons')" universe="lessons" keywordPlaceholder="Essayez 'Anglais', 'Maths', 'Excel'..." locationPlaceholder="Lieu (ex: Paris, Lyon...)" :categories="$categories" :categoryDescriptions="$categoryDescriptions ?? []" :lessonGoals="$lessonGoals ?? []" />
    </div>

  {{-- Module Pause Souffle Inline avec badge + titre (juste sous filtres, avant résultats) --}}
  <div class="container">
    @include('frontend.components.pause-souffle.inline-premium-projects')
  </div>

  {{-- Résultats --}}
  <section id="results" class="preply-results-section" style="overflow: visible;">
    <div id="resultsContainer" class="preply-results-container" style="overflow: visible;">
      <div class="preply-results-header">
        <h2 class="preply-results-count">{{ $freelancers->total() ?? 0 }} freelances disponibles</h2>
        <x-ritual-signature />
        <select class="preply-sort-select" id="sortSelect" name="sort">
          <option value="favorites">Trier par : Nos préférés</option>
          <option value="price_asc">Prix croissant</option>
          <option value="price_desc">Prix décroissant</option>
          <option value="rating">Meilleure note</option>
        </select>
      </div>

      <div class="freelancers-list-wrapper">
        <div class="freelancers-grid-premium" style="display: flex; flex-direction: column; gap: 20px;">
          @if($freelancers->isEmpty())
            <div style="text-align: center; padding: 60px 20px;">
              <p style="font-size: 1.125rem; color: var(--preply-text-light);">Aucun profil ne correspond à cette combinaison. Ajustez un filtre.</p>
            </div>
          @else
            @foreach ($freelancers as $freelancer)
          @php
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
                      $displayName = 'Freelance ' . substr($user->id ?? 'F', 0, 3);
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
            @endphp
                <div class="freelancer-card-wrapper-premium" data-freelancer-id="{{ $freelancer->id }}">
                  <!-- Carte principale - Style Preply avec wrapper pour réserver l'espace vidéo -->
                  <div class="freelancer-card-premium-v2 preply-teacher-card" data-freelancer-id="{{ $freelancer->id }}" data-hourly-rate="{{ $freelancer->hourly_rate ?? 0 }}" data-ritual-rate="{{ $freelancer->hourly_rate ?? 0 }}">
                    <!-- Wrapper du contenu pour limiter la largeur et réserver l'espace pour la vidéo -->
                    <div class="freelancer-card__content">
                      <!-- Contenu principal de la carte (avatar + infos + prix) -->
                      <div class="freelancer-card-content">
                      
                      <!-- ============================================
                           COLONNE GAUCHE : IDENTITÉ (Style Preply)
                           ============================================ -->
                      <div class="freelancer-photo-section">
                        <div class="freelancer-photo-container">
                          @if ($user->image)
                            <img src="{{ asset('assets/img/users/' . $user->image) }}" 
                                 alt="{{ $user->name }}" 
                                 class="freelancer-photo-img"
                                 onerror="this.style.display='none'; this.parentElement.querySelector('.freelancer-photo-placeholder').style.display='flex';">
                          @endif
                          
                          <!-- Fallback avec dégradé violet et initiales si pas de photo -->
                          <div class="freelancer-photo-placeholder" style="display: {{ $user->image ? 'none' : 'flex' }};">
                            <span class="photo-initial">{{ $initial }}</span>
                    </div>
                          
                          <!-- Badge qualité (coin supérieur droit) -->
                          @if ($badge)
                            <div class="freelancer-badge-overlay badge-{{ $badge }}">
                              @if ($badge == 'top')
                                <i class="fas fa-crown"></i>
                              @elseif ($badge == 'verified')
                                <i class="fas fa-check-circle"></i>
                  @endif
                    </div>
                  @endif
                  
                          <!-- Statut en ligne/hors ligne (point en bas à droite de la photo) -->
                          <!-- SUPPRESSION du title pour éviter le tooltip encadré du navigateur -->
                          <div class="freelancer-status-dot-wrapper">
                            <span class="status-dot {{ $isOnline ? 'status-online' : 'status-offline' }}"></span>
                          </div>
                          
                          <!-- Texte du statut en ligne/hors ligne (sous la photo) - Visible uniquement au survol -->
                          <div class="freelancer-status-text-wrapper">
                            <span class="status-dot-inline {{ $isOnline ? 'status-online' : 'status-offline' }}"></span>
                            <span class="status-text-inline">
                              @if ($isOnline)
                      En ligne
                              @else
                                <span class="status-line-1">Hors ligne</span>
                                @if ($lastSeenText)
                                  <span class="status-line-2">{{ $lastSeenText }}</span>
                  @endif
                  @endif
                            </span>
                </div>
              </div>

                        <!-- Nom + Initiale + Drapeau + Badge vérifié (à droite de la photo) -->
                        <div class="freelancer-identity-block">
                          <h3 class="freelancer-name-v2">
                            <a href="{{ route('freelance.show', $freelancer->id) }}" target="_self">
                              {{ $displayName }}
                            </a>
                            @php
                              // Récupérer le code pays pour l'afficher après le nom
                              $countryCodeForName = strtoupper(trim($user->country_code ?? 'FR'));
                              if (empty($countryCodeForName) || strlen($countryCodeForName) < 2) {
                                $countryCodeForName = 'FR';
                              }
                            @endphp
                            <span style="font-weight: 400; color: #6B7280; margin-left: 4px;">{{ $countryCodeForName }}</span>
                            @if ($badge == 'verified' || ($user->is_verified_freelancer ?? false))
                              <span class="verified-icon-v2">
                      <i class="fas fa-check-circle"></i>
                    </span>
                  @endif
                </h3>
                          
                          <!-- Langues parlées -->
                          @php
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
                          @endphp
                          <div class="freelancer-job-line" style="white-space: nowrap;">
                            🗣️ Le freelance parle {{ $langDisplay }}
                </div>
                          
                          <!-- Phrase d'accroche (headline) -->
                          @php
                            $headline = $freelancer->headline ?? 'Freelance expérimenté pour vos Rituels.';
                          @endphp
                          <p class="freelancer-headline">
                            {{ $headline }}
                          </p>
                          
                          <!-- Description courte : on limite l'aperçu sur la carte à quelques lignes.
                               Le texte complet sera lu sur la page profil via « En savoir plus ». -->
                          @php
                            // Bio complète (utilisée sur la page profil)
                            $fullBio = $freelancer->bio ?? $freelancer->about ?? 'Freelance expérimenté prêt à vous aider à progresser dans vos Rituels.';
                            // Si la bio est trop courte, utiliser un texte par défaut réduit
                            if (empty($fullBio) || strlen($fullBio) < 30) {
                              $fullBio = 'Freelance expérimenté prêt à vous aider à progresser dans vos Rituels.';
                            }

                            // Aperçu pour la carte : on tronque à ~220 caractères max
                            // pour rester visuellement autour de 2–3 lignes.
                            $shortBio = \Illuminate\Support\Str::limit(strip_tags($fullBio), 220, '…');
                          @endphp
                          
                          <!-- Sur la carte : on affiche uniquement l'aperçu $shortBio -->
                          <div class="freelancer-bio-wrapper">
                            <p class="freelancer-bio-v2">
                              {{ $shortBio }}
                            </p>
              </div>

                          <!-- Popularité -->
                          <div class="freelancer-popularity-v2">
                            <i class="fas fa-chart-line"></i>
                            <span style="white-space: nowrap;">Très populaire. {{ rand(10, 50) }} réservations récentes</span>
                </div>
                          
                          <!-- Lien "En savoir plus" (aligné à gauche) -->
                          <a href="{{ route('freelance.show', $freelancer->id) }}" 
                             class="freelancer-learn-more-v2" target="_self">
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
                        <button class="freelancer-favorite-btn" data-freelancer-id="{{ $freelancer->id }}" aria-label="Ajouter aux favoris">
                          <i class="far fa-heart"></i>
                        </button>

                        <!-- Prix mis en avant -->
                        <div class="freelancer-price-v2">
                          <div class="price-amount">{{ number_format($freelancer->hourly_rate, 0, ',', ' ') }} €</div>
                          <div class="price-label">{{ __('par Rituel') }} <span style="font-size: 0.7em; opacity: 0.85;">(= 1h)</span></div>
                </div>

                        <!-- Note + Avis sur une ligne -->
                        <div class="freelancer-rating-v2">
                          <div class="rating-number">{{ number_format($freelancer->reliability_score / 20 ?? 4.5, 1) }}</div>
                          <div class="rating-stars-v2">
                            <i class="fas fa-star"></i>
                </div>
                          <div class="rating-count">{{ rand(10, 100) }} avis</div>
                        </div>

                        <!-- Stats cours : 2 colonnes alignées -->
                        <div class="freelancer-stats-v2">
                          <div class="stat-item-v2">
                            <span class="stat-number">{{ $freelancer->subscriptions()->count() ?? 0 }}</span>
                            <span class="stat-label-v2">cours donnés</span>
                          </div>
                          <div class="stat-item-v2">
                            <span class="stat-number">{{ $freelancer->subscriptions()->where('status', 'active')->count() ?? 0 }}</span>
                            <span class="stat-label-v2">élèves récurrents</span>
                          </div>
                        </div>

                        <!-- CTA Buttons -->
                        <div class="freelancer-cta-v2">
                          <a href="{{ route('freelance.show', $freelancer->id) }}#agenda" 
                             class="cta-primary-v2">
                  Réserver un cour d'essai
                </a>
                          <button type="button" class="cta-secondary-v2" data-bs-toggle="modal" data-bs-target="#contactModal{{ $freelancer->id }}" data-freelancer-id="{{ $freelancer->id }}">
                  Envoyer un message
                          </button>
              </div>
                      </div>
                      <!-- Fin du contenu principal -->
                    </div>
                    <!-- Fin du wrapper de contenu (réserve l'espace pour la vidéo) -->
            </div>

                    <!-- Quick View - Vidéo de présentation (positionnée à droite, en dehors du wrapper de contenu) -->
                    <div class="freelancer-quick-view-v2" data-freelancer-id="{{ $freelancer->id }}">
                      <div class="quick-view-content-v2">
                        <!-- Vidéo de présentation avec miniature réelle -->
                        <div class="quick-view-video-section">
                          <div class="video-thumbnail-wrapper">
                            @php
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
                            @endphp
                            
                            @if($hasThumbnail && !empty($thumbnailUrl))
                              <!-- VRAIE MINIATURE VIDÉO (pas de gradient) -->
                              <img src="{{ $thumbnailUrl }}" 
                                   alt="Vidéo de présentation - {{ $displayName }}" 
                                   class="video-thumbnail-img"
                                   loading="lazy"
                                   onerror="this.onerror=null; this.style.display='none'; this.parentElement.querySelector('.video-placeholder-fallback').style.display='flex';">
            @endif
                            
                            <!-- Fallback élégant avec dégradé Cours UNIQUEMENT si aucune miniature n'est disponible -->
                            <div class="video-placeholder-fallback" style="display: {{ ($hasThumbnail && !empty($thumbnailUrl)) ? 'none' : 'flex' }}; flex-direction: column; align-items: center; justify-content: center; width: 100%; height: 100%; background: linear-gradient(135deg, #06B6D4 0%, #22D3EE 50%, #2563EB 100%); color: white; text-align: center; position: absolute; top: 0; left: 0; right: 0; bottom: 0; z-index: 1;">
                              <div style="position: relative; z-index: 2; display: flex; flex-direction: column; align-items: center; gap: 16px;">
                                <div style="width: 80px; height: 80px; background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(10px); border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 2px solid rgba(255, 255, 255, 0.3);">
                                  <i class="fas fa-video" style="font-size: 36px; opacity: 0.95;"></i>
          </div>
          </div>
                              <!-- Overlay subtil pour plus de profondeur -->
                              <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: radial-gradient(circle at 30% 40%, rgba(255, 255, 255, 0.1) 0%, transparent 60%); pointer-events: none; z-index: 1;"></div>
                            </div>
                            
                            <!-- Bouton Play centré (toujours visible) -->
                            <button class="video-play-btn-v2" data-freelancer-id="{{ $freelancer->id }}" data-video-url="{{ $videoUrl ?? '' }}" aria-label="Lire la vidéo de présentation" style="z-index: 10;">
                              <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="rgba(255, 255, 255, 0.9)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <polygon points="6 4 18 12 6 20 6 4" fill="rgba(255, 255, 255, 0.15)"></polygon>
                              </svg>
                            </button>
                            
                          </div>
                        </div>

                        <!-- Boutons d'action -->
                        <div class="quick-view-actions-v2">
                          <a href="{{ route('freelance.show', $freelancer->id) }}" 
                             class="quick-view-btn-primary-v2">
                            Voir le profil de {{ $displayName }}
                          </a>
                          <a href="{{ route('freelance.show', $freelancer->id) }}#agenda" 
                             class="quick-view-btn-secondary-v2">
                            Voir tout l'agenda
                          </a>
                        </div>
                      </div>
                    </div>
                    <!-- Fin de la carte vidéo (positionnée à droite, en dehors du wrapper de contenu) -->
                  </div>
                </div>
            @endforeach
            @endif
      </div>

      {{-- Pagination --}}
      @if($freelancers->hasPages())
        <div style="margin-top: 40px; display: flex; justify-content: center;">
          {{ $freelancers->links() }}
        </div>
      @endif
    </div>
  </section>
</div>

<script>
  function toggleDescription() {
    const desc = document.getElementById('introDescription');
    const btn = event.target;
    
    if (desc.classList.contains('collapsed')) {
      desc.classList.remove('collapsed');
      desc.classList.add('expanded');
      btn.textContent = 'Masquer';
    } else {
      desc.classList.remove('expanded');
      desc.classList.add('collapsed');
      btn.textContent = 'Voir plus';
    }
  }

  function openPersonalizeModal() {
    // Fonctionnalité désactivée
  }

  function sortTeachers(value) {
    if (typeof applyFiltersAjax === 'function') {
      applyFiltersAjax({ sort: value });
    }
  }

  var currentAbortController = null;
  function applyFiltersAjax(params) {
    var resultsSection = document.getElementById('results');
    var resultsContainer = document.getElementById('resultsContainer');
    if (!resultsSection || !resultsContainer) return;
    if (currentAbortController) currentAbortController.abort();
    currentAbortController = new AbortController();
    resultsSection.classList.add('is-loading');
    resultsContainer.style.opacity = '0.5';
    resultsContainer.style.pointerEvents = 'none';
    var form = document.getElementById('preplyFiltersForm');
    var formData = new FormData(form);
    var searchParams = new URLSearchParams();
    for (var it = formData.entries(), entry; !(entry = it.next()).done;) {
      var kv = entry.value;
      if (kv[1]) searchParams.append(kv[0], kv[1]);
    }
    if (params) {
      for (var k in params) {
        searchParams.delete(k);
        var v = params[k];
        if (v !== null && v !== undefined && v !== '') {
          if (Array.isArray(v) && v.length) { v.forEach(function(x){ searchParams.append(k + '[]', x); }); }
          else if (!Array.isArray(v)) searchParams.set(k, v);
        }
      }
    }
    var url = form.action + (searchParams.toString() ? '?' + searchParams.toString() : '');
    window.history.replaceState({}, '', url);
    fetch(url, { method: 'GET', headers: { 'Accept': 'text/html', 'X-Requested-With': 'XMLHttpRequest' }, signal: currentAbortController.signal })
    .then(function(r){ if (!r.ok) throw new Error(); return r.text(); })
    .then(function(html) {
      var doc = new DOMParser().parseFromString(html, 'text/html');
      var newRes = doc.querySelector('.preply-results-section');
      if (newRes) resultsSection.innerHTML = newRes.innerHTML;
      resultsSection.classList.remove('is-loading');
      resultsContainer.style.opacity = '1';
      resultsContainer.style.pointerEvents = 'auto';
      var sortEl = document.getElementById('sortSelect');
      if (sortEl) sortEl.addEventListener('change', function(){ sortTeachers(this.value); }, true);
    })
    .catch(function(err) {
      if (err.name === 'AbortError') return;
      resultsSection.classList.remove('is-loading');
      resultsContainer.style.opacity = '1';
      resultsContainer.style.pointerEvents = 'auto';
    });
  }

  // ============================================
  // GESTION VIDÉO
  // ============================================
  function openVideoModal(videoUrl) {
    const modal = document.getElementById('videoModal');
    const content = document.getElementById('videoModalContent');
    
    if (!modal || !content) return;
    
    // Convertir l'URL YouTube en URL embed si nécessaire
    let embedUrl = videoUrl;
    if (videoUrl.includes('youtube.com/watch')) {
      const videoId = videoUrl.split('v=')[1]?.split('&')[0];
      if (videoId) {
        embedUrl = `https://www.youtube.com/embed/${videoId}`;
      }
    } else if (videoUrl.includes('youtu.be/')) {
      const videoId = videoUrl.split('youtu.be/')[1]?.split('?')[0];
      if (videoId) {
        embedUrl = `https://www.youtube.com/embed/${videoId}`;
      }
    }
    
    content.innerHTML = `<iframe src="${embedUrl}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`;
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
  }

  function closeVideoModal() {
    const modal = document.getElementById('videoModal');
    const content = document.getElementById('videoModalContent');
    
    if (!modal || !content) return;
    
    modal.classList.remove('active');
    content.innerHTML = '';
    document.body.style.overflow = '';
  }

  // Initialiser la modale vidéo
  document.addEventListener('DOMContentLoaded', function() {
    const videoModal = document.getElementById('videoModal');
    const videoModalClose = document.getElementById('videoModalClose');
    
    if (videoModalClose) {
      videoModalClose.addEventListener('click', closeVideoModal);
  }
    
    if (videoModal) {
      videoModal.addEventListener('click', function(e) {
        if (e.target === videoModal) {
          closeVideoModal();
        }
      });
    }
    
    // Fermer la modale avec la touche ESC
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape' && videoModal && videoModal.classList.contains('active')) {
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
    @php
      $savedTimes = request('availability_times', []);
      $savedDays = request('availability_days', []);
    @endphp
    selectedTimes = @json($savedTimes);
    selectedDays = @json($savedDays);
    
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
    const form = document.querySelector('.preply-filters-section form');
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
    
    // Soumettre le formulaire
    form.submit();
  }

  // Auto-submit form on filter change (sauf #specializationSelect, géré en AJAX)
  document.querySelectorAll('.preply-filter-select, .preply-filter-input').forEach(el => {
    if (el.id === 'specializationSelect') return;
    el.addEventListener('change', function() {
      document.getElementById('preplyFiltersForm').submit();
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
          <div id="popover-placeholder" style="width: 100%; height: 100%; background: linear-gradient(135deg, #2563EB 0%, #06B6D4 50%, #22D3EE 100%); display: flex; align-items: center; justify-content: center; color: white;">
            <i class="fas fa-video" style="font-size: 2.5rem; opacity: 0.8;"></i>
          </div>
          <button class="preply-popover-play-btn" id="popover-play-btn" aria-label="Lire la vidéo">
            <i class="fas fa-play"></i>
          </button>
        </div>
        <div class="preply-popover-actions">
          <a href="#" class="preply-popover-action-btn" id="popover-agenda-btn">Voir tout l'agenda</a>
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
      popover.querySelector('#popover-profile-btn').href = profileUrl;
      popover.querySelector('#popover-profile-btn').textContent = `Voir le profil de ${firstName}`;
      
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
  function openVideoModal(freelancerId) {
    // TODO: Implémenter modal vidéo mobile
    alert('Modal vidéo mobile à implémenter pour le freelance #' + freelancerId);
  }
  // Dropdown Premium Pays de naissance
  (function initCountryDropdown() {
    // Liste complète des pays avec drapeaux (ISO2)
    const countriesData = [
      // Populaires (dans l'ordre spécifié)
      { code: 'GB', name: 'Royaume-Uni', flag: '🇬🇧', popular: true },
      { code: 'FR', name: 'France', flag: '🇫🇷', popular: true },
      { code: 'US', name: 'États-Unis d\'Amérique', flag: '🇺🇸', popular: true },
      { code: 'CA', name: 'Canada', flag: '🇨🇦', popular: true },
      { code: 'ZA', name: 'Afrique du Sud', flag: '🇿🇦', popular: true },
      // Autres pays
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

    if (!countryTrigger || !countryMenu || !countrySelectedText || !countryInput) {
      return;
    }

    let selectedCountryCode = countryInput.value || '';
    let searchDebounceTimer = null;

    // Mettre à jour le texte affiché
    function updateSelectedText() {
      if (selectedCountryCode) {
        const country = countriesData.find(c => c.code === selectedCountryCode);
        countrySelectedText.textContent = country ? country.name : 'Tous les pays';
      } else {
        countrySelectedText.textContent = 'Tous les pays';
      }
    }

    // Créer un élément de pays
    function createCountryOption(country) {
      const option = document.createElement('div');
      option.className = 'country-option';
      option.setAttribute('data-code', country.code);
      if (selectedCountryCode === country.code) {
        option.classList.add('selected');
      }

      option.innerHTML = `
        <span class="country-flag">${country.flag}</span>
        <span class="country-name">${country.name}</span>
        <span class="country-checkbox"></span>
      `;

      option.addEventListener('click', function(e) {
        e.stopPropagation();
        selectCountry(country.code);
      });

      return option;
    }

    // Rendre la liste des pays populaires
    function renderPopularCountries() {
      if (!countryPopularList) return;
      countryPopularList.innerHTML = '';
      const popularCountries = countriesData.filter(c => c.popular);
      popularCountries.forEach(country => {
        countryPopularList.appendChild(createCountryOption(country));
      });
    }

    // Rendre la liste complète filtrée
    function renderFilteredCountries(searchTerm = '') {
      if (!countryAllList) return;

      const normalizedSearch = searchTerm.toLowerCase().trim();
      let filteredCountries = [];

      if (normalizedSearch === '') {
        // Si pas de recherche, afficher tous les pays non-populaires
        filteredCountries = countriesData.filter(c => !c.popular);
        countryAllSection.style.display = filteredCountries.length > 0 ? 'block' : 'none';
        countryNoResults.style.display = 'none';
      } else {
        // Filtrer par recherche
        filteredCountries = countriesData.filter(country => 
          country.name.toLowerCase().includes(normalizedSearch)
        );
        countryAllSection.style.display = filteredCountries.length > 0 ? 'block' : 'none';
        countryNoResults.style.display = filteredCountries.length === 0 ? 'block' : 'none';
        // Masquer la section populaire si recherche active
        const popularSection = document.querySelector('.country-popular-section');
        if (popularSection) {
          popularSection.style.display = 'none';
        }
      }

      countryAllList.innerHTML = '';
      filteredCountries.forEach(country => {
        countryAllList.appendChild(createCountryOption(country));
      });
    }

    // Sélectionner un pays
    function selectCountry(code) {
      selectedCountryCode = code;
      countryInput.value = code;
      updateSelectedText();
      updateSelectedState();
      closeDropdown();

      // Soumettre le formulaire
      const form = document.getElementById('preplyFiltersForm');
      if (form) {
        form.submit();
      }
    }

    // Mettre à jour l'état visuel de sélection
    function updateSelectedState() {
      const allOptions = countryMenu.querySelectorAll('.country-option');
      allOptions.forEach(opt => {
        const code = opt.getAttribute('data-code');
        if (code === selectedCountryCode) {
          opt.classList.add('selected');
        } else {
          opt.classList.remove('selected');
        }
      });
    }

    // Ouvrir le dropdown
    function openDropdown() {
      countryMenu.style.display = 'block';
      countryTrigger.classList.add('active');
      // Réafficher la section populaire si recherche vide
      if (!countrySearchInput.value.trim()) {
        const popularSection = document.querySelector('.country-popular-section');
        if (popularSection) {
          popularSection.style.display = 'block';
        }
      }
      // Focus sur le champ de recherche
      setTimeout(() => {
        if (countrySearchInput) {
          countrySearchInput.focus();
        }
      }, 100);
    }

    // Fermer le dropdown
    function closeDropdown() {
      countryMenu.style.display = 'none';
      countryTrigger.classList.remove('active');
      if (countrySearchInput) {
        countrySearchInput.value = '';
      }
      // Réafficher la section populaire
      const popularSection = document.querySelector('.country-popular-section');
      if (popularSection) {
        popularSection.style.display = 'block';
      }
      countryAllSection.style.display = 'none';
      countryNoResults.style.display = 'none';
    }

    // Toggle dropdown
    countryTrigger.addEventListener('click', function(e) {
      e.stopPropagation();
      if (countryMenu.style.display === 'none' || !countryMenu.style.display) {
        openDropdown();
      } else {
        closeDropdown();
      }
    });

    // Recherche avec debounce
    if (countrySearchInput) {
      countrySearchInput.addEventListener('input', function(e) {
        const searchTerm = e.target.value;
        
        if (searchDebounceTimer) {
          clearTimeout(searchDebounceTimer);
        }

        searchDebounceTimer = setTimeout(() => {
          if (searchTerm.trim() === '') {
            // Réafficher la section populaire
            const popularSection = document.querySelector('.country-popular-section');
            if (popularSection) {
              popularSection.style.display = 'block';
            }
            renderFilteredCountries('');
          } else {
            // Masquer la section populaire et afficher les résultats filtrés
            const popularSection = document.querySelector('.country-popular-section');
            if (popularSection) {
              popularSection.style.display = 'none';
            }
            renderFilteredCountries(searchTerm);
          }
        }, 200);
      });
    }

    // Fermeture au click outside
    document.addEventListener('click', function(e) {
      if (!countryTrigger.contains(e.target) && !countryMenu.contains(e.target)) {
        closeDropdown();
      }
    });

    // Fermeture avec ESC
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape' && countryMenu.style.display === 'block') {
        closeDropdown();
      }
    });

    // Option "Tous les pays"
    const allCountriesOption = document.createElement('div');
    allCountriesOption.className = 'country-option';
    allCountriesOption.setAttribute('data-code', '');
    if (!selectedCountryCode) {
      allCountriesOption.classList.add('selected');
    }
    allCountriesOption.innerHTML = `
      <span class="country-flag">🌍</span>
      <span class="country-name">Tous les pays</span>
      <span class="country-checkbox"></span>
    `;
    allCountriesOption.addEventListener('click', function(e) {
      e.stopPropagation();
      selectCountry('');
    });

    // Insérer "Tous les pays" en haut de la liste populaire
    if (countryPopularList) {
      countryPopularList.insertBefore(allCountriesOption, countryPopularList.firstChild);
    }

    // Initialiser
    updateSelectedText();
    renderPopularCountries();
    renderFilteredCountries('');

    // Restaurer la sélection au chargement
    const urlParams = new URLSearchParams(window.location.search);
    const urlCountry = urlParams.get('country');
    if (urlCountry) {
      selectedCountryCode = urlCountry;
      countryInput.value = urlCountry;
      updateSelectedText();
      updateSelectedState();
    }
  })();

  // Hero Cours & Tutorat : Pays + Ville + micro-indicateurs (identique HomeSwap) — cascade pays → ville, assistant + popover
  (function initLessonsHeroCountryCity() {
    var citiesByCountry = {
      'FR': ['Paris', 'Lyon', 'Marseille', 'Bordeaux', 'Nantes', 'Lille', 'Strasbourg', 'Rennes', 'Montpellier', 'Toulouse', 'Nice'],
      'BE': ['Bruxelles', 'Anvers', 'Liège'],
      'CH': ['Zurich', 'Genève', 'Bâle'],
      'ES': ['Barcelone', 'Palma de Majorque', 'Valence', 'Séville', 'Madrid', 'Ibiza', 'Tenerife'],
      'DE': ['Berlin', 'Munich', 'Hambourg'],
      'IT': ['Rome', 'Milan', 'Turin', 'Palerme', 'Toscane', 'Florence', 'Naples'],
      'PT': ['Lisbonne', 'Porto', 'Faro', 'Coimbra'],
      'NL': ['Amsterdam', 'Rotterdam', 'La Haye'],
      'GB': ['Londres', 'Manchester', 'Birmingham', 'Brighton', 'Édimbourg'],
      'CA': ['Montréal', 'Toronto', 'Vancouver'],
      'US': ['New York', 'Los Angeles', 'Chicago', 'San Francisco', 'Miami'],
      'MT': ['Valetta', 'Sliema', 'Saint Julien', 'Msida', 'Gzira', 'Ta\'Xbiex', 'Pieta'],
      'MC': ['Monte-Carlo', 'La Condamine', 'Fontvieille'],
      'LU': ['Luxembourg-Ville', 'Kirchberg', 'Esch-sur-Alzette'],
      'MA': ['Casablanca', 'Rabat', 'Tanger'],
      'TN': ['Tunis', 'Sfax', 'Sousse'],
      'SN': ['Dakar', 'Diamniadio', 'Thiès'],
      'CI': ['Abidjan', 'Yamoussoukro', 'San Pedro'],
      'IE': ['Dublin'],
      'HR': ['Split', 'Dubrovnik'],
      'GP': ['Pointe-à-Pitre', 'Basse-Terre', 'Saint-François'],
      'MQ': ['Fort-de-France', 'Le Lamentin', 'Sainte-Anne'],
      'GF': ['Cayenne', 'Kourou', 'Saint-Laurent-du-Maroni'],
      'RE': ['Saint-Denis', 'Saint-Pierre', 'Saint-Gilles-les-Bains'],
      'NC': ['Nouméa', 'Dumbéa', 'Mont-Dore'],
      'PF': ['Papeete', 'Faa\'a', 'Moorea']
    };
    var cityBadges = {
      'Paris': ['Business', 'Langue'], 'Lyon': ['Business', 'Famille'], 'Marseille': ['Famille', 'Langue'], 'Bordeaux': ['Workation', 'Repos'],
      'Nantes': ['Business', 'Famille'], 'Lille': ['Business', 'Famille'], 'Strasbourg': ['Business', 'Langue'], 'Rennes': ['Business', 'Famille'],
      'Montpellier': ['Workation', 'Famille'], 'Toulouse': ['Business', 'Famille'], 'Nice': ['Repos', 'Famille'],
      'Barcelone': ['Workation', 'Famille'], 'Madrid': ['Business', 'Langue'], 'Palma de Majorque': ['Repos', 'Famille'], 'Valence': ['Famille', 'Repos'],
      'Séville': ['Famille', 'Culture'], 'Ibiza': ['Repos'], 'Tenerife': ['Workation', 'Famille'],
      'Lisbonne': ['Workation', 'Business'], 'Porto': ['Repos', 'Langue'], 'Faro': ['Repos', 'Famille'], 'Coimbra': ['Langue', 'Culture'],
      'Londres': ['Business', 'Langue'], 'Brighton': ['Langue', 'Famille'], 'Manchester': ['Business', 'Langue'], 'Birmingham': ['Business', 'Famille'], 'Édimbourg': ['Culture', 'Langue'],
      'Dublin': ['Langue', 'Business'], 'Montréal': ['Langue', 'Famille'], 'Toronto': ['Business', 'Langue'], 'Vancouver': ['Workation', 'Repos'],
      'New York': ['Business'], 'San Francisco': ['Business', 'Workation'], 'Miami': ['Repos', 'Business'], 'Los Angeles': ['Business', 'Repos'], 'Chicago': ['Business', 'Famille'],
      'Rome': ['Famille', 'Culture'], 'Florence': ['Repos', 'Culture'], 'Milan': ['Business'], 'Turin': ['Business', 'Famille'], 'Palerme': ['Repos', 'Famille'], 'Toscane': ['Repos', 'Culture'], 'Naples': ['Famille', 'Culture'],
      'Amsterdam': ['Business', 'Langue'], 'Rotterdam': ['Business', 'Famille'], 'La Haye': ['Business', 'Famille'],
      'Berlin': ['Business', 'Langue'], 'Munich': ['Business', 'Famille'], 'Hambourg': ['Business', 'Langue'],
      'Zurich': ['Business', 'Langue'], 'Genève': ['Business', 'Langue'], 'Bâle': ['Business', 'Famille'],
      'Bruxelles': ['Business', 'Langue'], 'Anvers': ['Business', 'Famille'], 'Liège': ['Famille', 'Langue'],
      'Valetta': ['Repos', 'Culture'], 'Sliema': ['Repos', 'Famille'], 'Saint Julien': ['Repos', 'Famille'],
      'Monte-Carlo': ['Repos', 'Business'], 'La Condamine': ['Repos', 'Famille'], 'Fontvieille': ['Repos', 'Famille'],
      'Luxembourg-Ville': ['Business', 'Langue'], 'Kirchberg': ['Business'], 'Esch-sur-Alzette': ['Famille', 'Business'],
      'Casablanca': ['Business', 'Langue'], 'Rabat': ['Business', 'Famille'], 'Tanger': ['Repos', 'Langue'],
      'Tunis': ['Business', 'Langue'], 'Sfax': ['Business', 'Famille'], 'Sousse': ['Repos', 'Famille'],
      'Dakar': ['Business', 'Langue'], 'Diamniadio': ['Business'], 'Thiès': ['Famille', 'Repos'],
      'Abidjan': ['Business', 'Langue'], 'Yamoussoukro': ['Famille', 'Repos'], 'San Pedro': ['Repos', 'Famille'],
      'Split': ['Repos', 'Famille'], 'Dubrovnik': ['Repos', 'Culture']
    };
    var highDemandCitiesLaunch = ['Paris', 'Lyon', 'Barcelone', 'Lisbonne', 'Palma de Majorque', 'Montréal', 'Guadeloupe', 'Martinique', 'La Réunion'];
    var allowedObjectives = ['Workation', 'Famille', 'Langue', 'Business', 'Repos'];
    function getDisplayBadges(badges) {
      if (!badges || !Array.isArray(badges)) return [];
      return badges.filter(function(b) { return allowedObjectives.indexOf(b) !== -1; }).slice(0, 2);
    }
    var objectiveIcons = {
      'Business': '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3.5 4.5V11.5H10.5V4.5M3.5 4.5H10.5M3.5 4.5V2.5C3.5 2.22386 3.72386 2 4 2H10C10.2761 2 10.5 2.22386 10.5 2.5V4.5M5.5 7H8.5" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/></svg>',
      'Workation': '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.5 3.5C2.5 3.22386 2.72386 3 3 3H11C11.2761 3 11.5 3.22386 11.5 3.5V10.5C11.5 10.7761 11.2761 11 11 11H3C2.72386 11 2.5 10.7761 2.5 10.5V3.5Z" stroke="currentColor" stroke-width="1.25"/><path d="M5.5 7L6.5 8L8.5 6" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/></svg>',
      'Famille': '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7 2.5L3.5 5.5V11.5H5.5V7.5H8.5V11.5H10.5V5.5L7 2.5Z" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/></svg>',
      'Langue': '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="7" cy="7" r="5" stroke="currentColor" stroke-width="1.25"/><path d="M2 7H12M7 2C7.5 3.5 7.5 4.5 7 7C6.5 9.5 6.5 10.5 7 12" stroke="currentColor" stroke-width="1.25" stroke-linecap="round"/></svg>',
      'Repos': '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3.5 7C3.5 5.067 5.067 3.5 7 3.5C8.933 3.5 10.5 5.067 10.5 7C10.5 8.933 8.933 10.5 7 10.5C5.067 10.5 3.5 8.933 3.5 7Z" stroke="currentColor" stroke-width="1.25"/><path d="M5 7L6.5 8.5L9 6" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"/></svg>',
      'Culture': '<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7 2V12M2 7H12" stroke="currentColor" stroke-width="1.25" stroke-linecap="round"/><circle cx="7" cy="7" r="4" stroke="currentColor" stroke-width="1.25"/></svg>'
    };
    function run() {
      var countrySelect = document.getElementById('lessonsFilterCountry');
      var citySelect = document.getElementById('lessonsFilterCity');
      var cityWrapper = document.getElementById('lessonsCityWrapper');
      if (!countrySelect || !citySelect) return;

      function updateLessonsCityAssistant() {
        if (!citySelect || !cityWrapper) return;
        var existingAssistant = cityWrapper.querySelector('.lessons-city-assistant');
        if (existingAssistant) existingAssistant.remove();
        citySelect.style.paddingRight = '';
        var selectedOption = citySelect.options[citySelect.selectedIndex];
        if (!selectedOption || !selectedOption.value) return;
        var cityName = selectedOption.value;
        var badgesJson = selectedOption.getAttribute('data-badges');
        var isVeryPopular = selectedOption.getAttribute('data-very-popular') === 'true';
        var badges = [];
        if (badgesJson) { try { badges = JSON.parse(badgesJson); } catch (e) {} }
        var displayBadgesForAssistant = getDisplayBadges(badges);
        if (displayBadgesForAssistant.length === 0 && !isVeryPopular) return;
        var assistant = document.createElement('div');
        assistant.className = 'lessons-city-assistant';
        assistant.setAttribute('role', 'group');
        assistant.setAttribute('aria-label', 'Informations sur ' + cityName);
        var displayBadges = getDisplayBadges(badges);
        if (displayBadges.length > 0) {
          var iconsContainer = document.createElement('div');
          iconsContainer.className = 'lessons-city-icons';
          for (var i = 0; i < displayBadges.length; i++) {
            var iconWrapper = document.createElement('span');
            iconWrapper.className = 'lessons-city-icon';
            iconWrapper.setAttribute('aria-label', displayBadges[i]);
            iconWrapper.innerHTML = objectiveIcons[displayBadges[i]] || '';
            iconsContainer.appendChild(iconWrapper);
          }
          assistant.appendChild(iconsContainer);
        }
        if (isVeryPopular) {
          var popularIcon = document.createElement('span');
          popularIcon.className = 'lessons-city-icon lessons-city-icon-popular';
          popularIcon.setAttribute('aria-label', 'Ville très demandée en ce moment');
          popularIcon.innerHTML = '<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="6" cy="6" r="4.5" stroke="currentColor" stroke-width="1.25"/><circle cx="6" cy="6" r="1.5" fill="currentColor"/></svg>';
          assistant.appendChild(popularIcon);
        }
        if (displayBadgesForAssistant.length > 0 || isVeryPopular) {
          var infoBtn = document.createElement('button');
          infoBtn.type = 'button';
          infoBtn.className = 'lessons-city-info-btn';
          infoBtn.setAttribute('aria-label', 'Informations sur ' + cityName);
          infoBtn.setAttribute('aria-expanded', 'false');
          infoBtn.innerHTML = '<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="6" cy="6" r="5" stroke="currentColor" stroke-width="1.25"/><path d="M6 4V4.5M6 7.5V8" stroke="currentColor" stroke-width="1.25" stroke-linecap="round"/></svg>';
          infoBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            toggleLessonsCityPopover(cityName, displayBadgesForAssistant, isVeryPopular, infoBtn);
          });
          assistant.appendChild(infoBtn);
        }
        cityWrapper.appendChild(assistant);
        citySelect.style.paddingRight = '4.5rem';
      }

      function toggleLessonsCityPopover(cityName, badges, isVeryPopular, triggerBtn) {
        var existingPopover = document.querySelector('.lessons-city-popover');
        if (existingPopover && existingPopover.dataset.city === cityName) {
          existingPopover.remove();
          triggerBtn.setAttribute('aria-expanded', 'false');
          return;
        }
        document.querySelectorAll('.lessons-city-popover').forEach(function(p) { p.remove(); });
        document.querySelectorAll('.lessons-city-info-btn').forEach(function(btn) { btn.setAttribute('aria-expanded', 'false'); });
        var popover = document.createElement('div');
        popover.className = 'lessons-city-popover';
        popover.setAttribute('role', 'dialog');
        popover.setAttribute('aria-label', 'Informations sur ' + cityName);
        popover.dataset.city = cityName;
        var popoverContent = document.createElement('div');
        popoverContent.className = 'lessons-city-popover-content';
        var displayBadgesPopover = badges && badges.length > 0 ? getDisplayBadges(badges) : [];
        if (displayBadgesPopover.length > 0) {
          var lineObjectives = document.createElement('p');
          lineObjectives.className = 'lessons-city-popover-text';
          lineObjectives.textContent = 'Souvent choisie pour : ' + displayBadgesPopover.join(' • ');
          popoverContent.appendChild(lineObjectives);
        }
        if (isVeryPopular) {
          var linePopular = document.createElement('p');
          linePopular.className = 'lessons-city-popover-text lessons-city-popover-badge';
          linePopular.textContent = 'Ville très demandée en ce moment';
          popoverContent.appendChild(linePopular);
        }
        popover.appendChild(popoverContent);
        document.body.appendChild(popover);
        var rect = triggerBtn.getBoundingClientRect();
        var popoverWidth = popover.offsetWidth || 280;
        var popoverHeight = popover.offsetHeight || 120;
        var leftPos = rect.left + rect.width / 2 - popoverWidth / 2;
        var topPos = rect.bottom + 8;
        if (leftPos < 8) leftPos = 8;
        if (leftPos + popoverWidth > window.innerWidth - 8) leftPos = window.innerWidth - popoverWidth - 8;
        if (topPos + popoverHeight > window.innerHeight - 8) topPos = rect.top - popoverHeight - 8;
        popover.style.left = leftPos + 'px';
        popover.style.top = topPos + 'px';
        triggerBtn.setAttribute('aria-expanded', 'true');
        setTimeout(function() {
          document.addEventListener('click', function closePopover(e) {
            if (!popover.contains(e.target) && e.target !== triggerBtn) {
              popover.remove();
              triggerBtn.setAttribute('aria-expanded', 'false');
              document.removeEventListener('click', closePopover);
            }
          });
        }, 10);
      }

      function updateLessonsCities() {
        var country = countrySelect.value;
        citySelect.innerHTML = '<option value="">Sélectionner une ville</option>';
        citySelect.disabled = !country;
        if (country && citiesByCountry[country]) {
          var cities = citiesByCountry[country];
          for (var i = 0; i < cities.length; i++) {
            var cityName = cities[i];
            var opt = document.createElement('option');
            opt.value = cityName;
            opt.textContent = cityName;
            var badges = cityBadges[cityName];
            if (badges && badges.length) opt.setAttribute('data-badges', JSON.stringify(badges));
            if (highDemandCitiesLaunch.indexOf(cityName) !== -1) opt.setAttribute('data-very-popular', 'true');
            citySelect.appendChild(opt);
          }
          if (cityWrapper) cityWrapper.classList.add('show');
          var form = document.getElementById('preplyFiltersForm');
          var selectedCity = (form && form.getAttribute('data-initial-city')) ? form.getAttribute('data-initial-city') : '';
          if (selectedCity && cities.indexOf(selectedCity) !== -1) citySelect.value = selectedCity;
          setTimeout(updateLessonsCityAssistant, 50);
        } else {
          if (cityWrapper) cityWrapper.classList.remove('show');
        }
      }

      countrySelect.addEventListener('change', updateLessonsCities);
      citySelect.addEventListener('change', updateLessonsCityAssistant);
      updateLessonsCities();
      setTimeout(function() { if (citySelect.value) updateLessonsCityAssistant(); }, 100);
    }
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', run);
    } else {
      run();
    }
  })();

  // Domaine → Spécialisation et Univers d'activité : init gérés par le composant search-filter (module réutilisable)

  // ---------- Engagement Rituel + Tarif Lessons : accordéon, slider, sync, Recommandation Junspro + Express ----------
  (function initLessonsEngagementRituel() {
    const RITUEL_STORAGE_KEY = 'junspro_day_base_hours';
    const PALIERS_B = [4, 8, 16, 24, 32, 48, 56, 64, 72, 80, 88];
    var lessonsExpressMultiplier = 1;
    function getLessonsExpressMultiplier() {
      var input = document.querySelector('[data-express-input]');
      var mode = (input && input.value) ? input.value : 'none';
      return { none: 1, '24': 1.3, '48': 1.2, '72': 1.1 }[mode] || 1;
    }
    function getBaseHours() {
      var v = parseInt(localStorage.getItem(RITUEL_STORAGE_KEY), 10);
      return (v === 7 || v === 8) ? v : 7;
    }
    function setBaseHours(v) {
      localStorage.setItem(RITUEL_STORAGE_KEY, String(v));
    }
    function snapToPalierB(targetHours) {
      for (var i = 0; i < PALIERS_B.length; i++) {
        if (PALIERS_B[i] >= targetHours) return PALIERS_B[i];
      }
      return PALIERS_B[PALIERS_B.length - 1];
    }
    function topupCapB(palier) {
      return palier <= 32 ? palier : 32;
    }
    var budgetMapping = {
      '0-1000': { min: 0, max: 1000 },
      '1000-2500': { min: 1000, max: 2500 },
      '2500-5000': { min: 2500, max: 5000 },
      '5000-10000': { min: 5000, max: 10000 },
      '10000-20000': { min: 10000, max: 20000 },
      '20000-60000': { min: 20000, max: 60000 },
      '60000+': { min: 60000, max: 999999 }
    };
    function applyLessonsExpress() {
      lessonsExpressMultiplier = getLessonsExpressMultiplier();
      var scope = document.querySelector('.page-lessons');
      if (!scope) return;
      scope.querySelectorAll('[data-express-target]').forEach(function(el) {
        var base = parseFloat(el.getAttribute('data-base-value')) || 0;
        el.textContent = String(Math.round(base * lessonsExpressMultiplier));
      });
    }
    window.addEventListener('express:changed', function(e) {
      lessonsExpressMultiplier = e.detail && e.detail.multiplier ? e.detail.multiplier : 1;
      applyLessonsExpress();
    });
      function run() {
      var engagementBlock = document.querySelector('.lessons-engagement-block');
      if (!engagementBlock) return;
      var budgetSelect = document.getElementById('lessonsBudgetFilter');
      var estimateEl = document.getElementById('lessonsBudgetEstimate');
      var recEl = document.getElementById('lessonsRecommandationJunspro');
      var affinerLink = document.getElementById('lessonsAffinerTarifLink');
      var accordion = document.getElementById('lessonsTarifAccordion');
      var minInput = document.getElementById('lessons-rituel-price-min');
      var maxInput = document.getElementById('lessons-rituel-price-max');
      if (!budgetSelect || !estimateEl) return;
      function getRate() {
        if (minInput && maxInput) {
          var mn = parseInt(minInput.value, 10) || 10;
          var mx = parseInt(maxInput.value, 10) || 50;
          return (mn + mx) / 2;
        }
        return 50;
      }
      function updateBudgetEstimate() {
        var val = budgetSelect.value;
        var volumeEl = estimateEl.querySelector('.budget-estimate-volume');
        var pricesEl = estimateEl.querySelector('.budget-estimate-prices');
        var hourlyEl = estimateEl.querySelector('[data-express-target="engagement-hourly-avg"]');
        var dailyEl = estimateEl.querySelector('[data-express-target="engagement-daily-avg"]');
        if (!val || !budgetMapping[val]) {
          if (volumeEl) volumeEl.textContent = 'Sélectionnez un engagement pour afficher une estimation en rituels.';
          if (pricesEl) pricesEl.style.display = 'none';
          if (recEl) recEl.style.display = 'none';
          return;
        }
        var budget = budgetMapping[val];
        var rate = getRate();
        var rituelsMin = Math.ceil(budget.min / rate);
        var rituelsMax = budget.max === 999999 ? null : Math.floor(budget.max / rate);
        var rMin = rituelsMin;
        var rMax = rituelsMax || rituelsMin;
        var targetHours = rMin;
        var palier = snapToPalierB(targetHours);
        var topup = topupCapB(palier);
        var base = getBaseHours();
        var tjm = Math.round(rate * base);
        var rateRounded = Math.round(rate);
        if (volumeEl) volumeEl.textContent = 'Volume estimé : ~' + rMin + (rMax ? '-' + rMax : '+') + ' rituels (~' + rMin + (rMax ? '-' + rMax : '+') + ' h)';
        if (pricesEl) pricesEl.style.display = 'block';
        if (hourlyEl) hourlyEl.setAttribute('data-base-value', String(rateRounded));
        if (dailyEl) dailyEl.setAttribute('data-base-value', String(tjm));
        applyLessonsExpress();
        if (recEl) {
          recEl.textContent = 'Recommandation Junspro : Recommandé : ' + palier + 'h / 4 semaines + jusqu\'à ' + topup + 'h supplémentaires';
          recEl.style.display = 'block';
        }
      }
      function updateRituelSummary() {
        var summaryEl = document.getElementById('lessons-rituel-price-summary');
        if (!minInput || !maxInput || !summaryEl) return;
        var hourlyMinEl = summaryEl.querySelector('[data-express-target="slider-hourly-min"]');
        var hourlyMaxEl = summaryEl.querySelector('[data-express-target="slider-hourly-max"]');
        var dailyMinEl = summaryEl.querySelector('[data-express-target="slider-daily-min"]');
        var dailyMaxEl = summaryEl.querySelector('[data-express-target="slider-daily-max"]');
        if (!hourlyMinEl || !hourlyMaxEl || !dailyMinEl || !dailyMaxEl) return;
        var base = getBaseHours();
        var mn = Math.max(10, Math.min(parseInt(minInput.value, 10) || 10, 299));
        var mx = Math.max(mn, Math.min(299, parseInt(maxInput.value, 10) || 50));
        minInput.value = mn;
        maxInput.value = mx;
        var jourMin = mn * base;
        var jourMax = mx * base;
        hourlyMinEl.setAttribute('data-base-value', String(mn));
        hourlyMaxEl.setAttribute('data-base-value', String(mx));
        dailyMinEl.setAttribute('data-base-value', String(Math.round(jourMin)));
        dailyMaxEl.setAttribute('data-base-value', String(Math.round(jourMax)));
        applyLessonsExpress();
      }
      function syncFromTarifToBudget() {
        var rate = getRate();
        var val = budgetSelect.value;
        if (!val || !budgetMapping[val]) return;
        var budget = budgetMapping[val];
        var midBudget = (budget.min + (budget.max === 999999 ? budget.min + 10000 : budget.max)) / 2;
        var volEst = Math.round(midBudget / rate);
        updateBudgetEstimate();
      }
      if (affinerLink && accordion) {
        affinerLink.addEventListener('click', function(e) {
          e.preventDefault();
          accordion.classList.toggle('is-open');
          accordion.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        });
      }
      budgetSelect.addEventListener('change', function() {
        updateBudgetEstimate();
        if (minInput && maxInput && typeof jQuery !== 'undefined' && jQuery('#lessons-rituel-price-slider').length) {
          var rate = getRate();
          var val = budgetSelect.value;
          if (val && budgetMapping[val]) {
            var budget = budgetMapping[val];
            var mid = (budget.min + (budget.max === 999999 ? budget.min + 10000 : budget.max)) / 2;
            var sugg = Math.round(mid / rate);
            var suggMin = Math.max(10, Math.min(50, Math.round(rate * 0.8)));
            var suggMax = Math.max(suggMin, Math.min(299, Math.round(rate * 1.2)));
            if (minInput && maxInput) {
              minInput.value = suggMin;
              maxInput.value = suggMax;
              if (jQuery('#lessons-rituel-price-slider').slider('instance')) {
                jQuery('#lessons-rituel-price-slider').slider('values', [suggMin, suggMax]);
              }
              updateRituelSummary();
            }
          }
        }
        updateBudgetEstimate();
      });
      engagementBlock.querySelectorAll('.engagement-base-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
          var base = parseInt(this.getAttribute('data-base'), 10);
          setBaseHours(base);
          engagementBlock.querySelectorAll('.engagement-base-btn').forEach(function(b) {
            b.classList.toggle('is-active', parseInt(b.getAttribute('data-base'), 10) === base);
          });
          updateBudgetEstimate();
          updateRituelSummary();
        });
      });
      if (minInput && maxInput) {
        minInput.addEventListener('change', function() { updateRituelSummary(); syncFromTarifToBudget(); });
        maxInput.addEventListener('change', function() { updateRituelSummary(); syncFromTarifToBudget(); });
        minInput.addEventListener('input', updateRituelSummary);
        maxInput.addEventListener('input', updateRituelSummary);
      }
      var tarifWrap = document.querySelector('.lessons-affiner-tarif-wrap');
      if (tarifWrap) {
        tarifWrap.querySelectorAll('.rituel-base-btn').forEach(function(btn) {
          btn.addEventListener('click', function() {
            var base = parseInt(this.getAttribute('data-base'), 10);
            setBaseHours(base);
            tarifWrap.querySelectorAll('.rituel-base-btn').forEach(function(b) {
              b.classList.toggle('is-active', parseInt(b.getAttribute('data-base'), 10) === base);
            });
            if (engagementBlock) {
              engagementBlock.querySelectorAll('.engagement-base-btn').forEach(function(b) {
                b.classList.toggle('is-active', parseInt(b.getAttribute('data-base'), 10) === base);
              });
            }
            updateRituelSummary();
            updateBudgetEstimate();
          });
        });
      }
      var base = getBaseHours();
      if (engagementBlock) {
        engagementBlock.querySelectorAll('.engagement-base-btn').forEach(function(b) {
          b.classList.toggle('is-active', parseInt(b.getAttribute('data-base'), 10) === base);
        });
      }
      if (tarifWrap) {
        tarifWrap.querySelectorAll('.rituel-base-btn').forEach(function(b) {
          b.classList.toggle('is-active', parseInt(b.getAttribute('data-base'), 10) === base);
        });
      }
      if (typeof jQuery !== 'undefined' && jQuery.ui && jQuery.ui.slider) {
        var sliderEl = document.getElementById('lessons-rituel-price-slider');
        if (sliderEl) {
          var mn = parseInt(minInput && minInput.value ? minInput.value : 10, 10);
          var mx = parseInt(maxInput && maxInput.value ? maxInput.value : 50, 10);
          jQuery(sliderEl).slider({
            range: true,
            min: 10,
            max: 299,
            values: [Math.max(10, mn), Math.min(299, mx)],
            slide: function(ev, ui) {
              if (minInput) minInput.value = ui.values[0];
              if (maxInput) maxInput.value = ui.values[1];
              updateRituelSummary();
            },
            change: function(ev, ui) {
              if (minInput) minInput.value = ui.values[0];
              if (maxInput) maxInput.value = ui.values[1];
              updateRituelSummary();
              syncFromTarifToBudget();
            }
          });
          updateRituelSummary();
        }
      }
      updateBudgetEstimate();
    }
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', run);
    } else {
      run();
    }
  })();

  document.addEventListener('DOMContentLoaded', function() {
    // Gestion du dropdown Mon expérience (Critères avancés) — Niveau d'expertise attendu
    var experienceTrigger = document.getElementById('experienceDropdownTrigger');
    var experienceMenu = document.getElementById('experienceDropdownMenu');
    var experienceLevelInput = document.getElementById('experienceLevelInput');
    var experienceSelectedText = document.getElementById('experienceSelectedText');
    var experienceArrow = document.getElementById('experienceArrow');
    if (experienceTrigger && experienceMenu && experienceLevelInput && experienceSelectedText) {
      experienceTrigger.addEventListener('click', function(e) {
        e.stopPropagation();
        var isOpen = experienceMenu.style.display === 'block';
        experienceMenu.style.display = isOpen ? 'none' : 'block';
        experienceTrigger.classList.toggle('active', !isOpen);
        if (experienceArrow) experienceArrow.style.transform = isOpen ? 'rotate(0deg)' : 'rotate(180deg)';
      });
      document.addEventListener('click', function(e) {
        if (!experienceMenu.contains(e.target) && !experienceTrigger.contains(e.target)) {
          experienceMenu.style.display = 'none';
          experienceTrigger.classList.remove('active');
          if (experienceArrow) experienceArrow.style.transform = 'rotate(0deg)';
        }
      });
      document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && experienceMenu.style.display === 'block') {
          experienceMenu.style.display = 'none';
          experienceTrigger.classList.remove('active');
          if (experienceArrow) experienceArrow.style.transform = 'rotate(0deg)';
        }
      });
      document.querySelectorAll('.experience-option').forEach(function(opt) {
        opt.addEventListener('click', function(e) {
          e.stopPropagation();
          var value = this.getAttribute('data-value');
          var text = this.textContent.trim();
          experienceLevelInput.value = value;
          experienceSelectedText.textContent = text;
          document.querySelectorAll('.experience-option').forEach(function(o) { o.classList.remove('selected'); });
          this.classList.add('selected');
          experienceMenu.style.display = 'none';
          experienceTrigger.classList.remove('active');
          if (experienceArrow) experienceArrow.style.transform = 'rotate(0deg)';
          if (typeof applyFiltersAjax === 'function') applyFiltersAjax({ experience_level: value });
          else { var f = document.getElementById('preplyFiltersForm'); if (f) f.submit(); }
        });
      });
      var currentExp = experienceLevelInput.value || '';
      var expOpt = document.querySelector('.experience-option[data-value="' + currentExp + '"]');
      if (expOpt) expOpt.classList.add('selected');
    }

    // Gestion du filtre "Objectif du cours" - soumission automatique
    const lessonGoalSelect = document.querySelector('select[name="lesson_goal"]');
    if (lessonGoalSelect) {
      lessonGoalSelect.addEventListener('change', function() {
        const form = document.getElementById('preplyFiltersForm');
        if (form) {
          form.submit();
        }
      });
    }
  });
</script>

<!-- Modale vidéo -->
<div id="videoModal" class="video-modal-overlay">
  <div class="video-modal-container">
    <button class="video-modal-close" id="videoModalClose" aria-label="Fermer la vidéo">&times;</button>
    <div class="video-modal-content" id="videoModalContent">
      <!-- Le contenu vidéo sera injecté ici -->
    </div>
  </div>
</div>
@endsection
